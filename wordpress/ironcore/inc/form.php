<?php
/**
 * Lead form: one handler for the inline form (#contact) and the modal.
 *
 * Flow: JS posts FormData to admin-ajax.php (action=ironcore_lead) →
 * checks (honeypot, fill time, rate limit, fields, files) →
 * lead is saved as a private post of type ic_lead (admin menu «Заявки») →
 * e-mail with attachments → Telegram message (if bot is configured).
 * The visitor sees «отправлена» only after the lead is saved.
 *
 * @package IronCore
 */

defined( 'ABSPATH' ) || exit;

if ( ! defined( 'IC_FORM_MAX_FILES' ) ) {
	define( 'IC_FORM_MAX_FILES', 5 );
}
if ( ! defined( 'IC_FORM_MAX_MB' ) ) {
	define( 'IC_FORM_MAX_MB', 10 ); // per file; check upload_max_filesize / post_max_size on the server.
}
if ( ! defined( 'IC_FORM_RATE' ) ) {
	define( 'IC_FORM_RATE', 5 ); // leads per IP per 10 minutes.
}

/** Allowed attachments. DWG and other CAD files — inside a ZIP. */
function ic_form_mimes() {
	return apply_filters(
		'ironcore_form_mimes',
		array(
			'pdf'      => 'application/pdf',
			'doc'      => 'application/msword',
			'docx'     => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
			'xls'      => 'application/vnd.ms-excel',
			'xlsx'     => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
			'odt'      => 'application/vnd.oasis.opendocument.text',
			'ods'      => 'application/vnd.oasis.opendocument.spreadsheet',
			'jpg|jpeg' => 'image/jpeg',
			'png'      => 'image/png',
			'zip'      => 'application/zip',
		)
	);
}

/* ---------- Post type «Заявки» ---------- */

add_action(
	'init',
	function () {
		register_post_type(
			'ic_lead',
			array(
				'labels'          => array(
					'name'          => 'Заявки',
					'singular_name' => 'Заявка',
					'menu_name'     => 'Заявки',
					'all_items'     => 'Все заявки',
					'edit_item'     => 'Заявка',
					'search_items'  => 'Найти заявку',
					'not_found'     => 'Заявок пока нет',
				),
				'public'          => false,
				'show_ui'         => true,
				'show_in_menu'    => true,
				'show_in_rest'    => false,
				'menu_position'   => 25,
				'menu_icon'       => 'dashicons-email-alt',
				'supports'        => array( 'title' ),
				'capability_type' => 'page', // editors and admins only.
				'capabilities'    => array( 'create_posts' => 'do_not_allow' ),
				'map_meta_cap'    => true,
			)
		);
	}
);

/* ---------- AJAX handler ---------- */

add_action( 'wp_ajax_ironcore_lead', 'ic_handle_lead' );
add_action( 'wp_ajax_nopriv_ironcore_lead', 'ic_handle_lead' );

function ic_lead_fail( $msg, $code = 400 ) {
	wp_send_json_error( array( 'message' => $msg ), $code );
}

function ic_client_ip() {
	return isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '';
}

function ic_handle_lead() {
	// phpcs:disable WordPress.Security.NonceVerification.Missing -- see note below.
	/*
	 * Nonce is enforced for logged-in users only. For visitors the page is usually served
	 * from a page cache, where a nonce goes stale after 12–24 h and would block real leads.
	 * Visitors are filtered by honeypot, fill time and per-IP rate limit instead.
	 */
	if ( is_user_logged_in() && ! check_ajax_referer( 'ironcore_lead', 'nonce', false ) ) {
		ic_lead_fail( 'Страница устарела. Обновите её и отправьте заявку ещё раз.', 403 );
	}

	$ok_message = 'Заявка отправлена. Мы свяжемся с вами.';

	// Bots: pretend success, store nothing.
	$hp      = isset( $_POST['website'] ) ? trim( (string) wp_unslash( $_POST['website'] ) ) : '';
	$elapsed = isset( $_POST['elapsed'] ) ? (int) $_POST['elapsed'] : 0;
	if ( '' !== $hp || ( $elapsed > 0 && $elapsed < 1500 ) ) {
		wp_send_json_success( array( 'message' => $ok_message ) );
	}

	$ip   = ic_client_ip();
	$rkey = 'ic_rl_' . md5( $ip );
	$hits = (int) get_transient( $rkey );
	if ( $hits >= IC_FORM_RATE ) {
		ic_lead_fail( 'Слишком много заявок подряд. Попробуйте через несколько минут.', 429 );
	}

	$name    = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
	$phone   = isset( $_POST['phone'] ) ? sanitize_text_field( wp_unslash( $_POST['phone'] ) ) : '';
	$comment = isset( $_POST['comment'] ) ? sanitize_textarea_field( wp_unslash( $_POST['comment'] ) ) : '';
	$source  = isset( $_POST['source'] ) ? sanitize_text_field( wp_unslash( $_POST['source'] ) ) : '';
	$page    = isset( $_POST['page_url'] ) ? esc_url_raw( wp_unslash( $_POST['page_url'] ) ) : '';
	$consent = ! empty( $_POST['consent'] );
	// phpcs:enable

	$digits = preg_replace( '/\D+/', '', $phone );
	if ( '' === $name || mb_strlen( $name ) > 120 ) {
		ic_lead_fail( 'Укажите имя.' );
	}
	if ( strlen( $digits ) < 10 || strlen( $digits ) > 15 ) {
		ic_lead_fail( 'Укажите телефон, не меньше 10 цифр.' );
	}
	if ( ic_privacy_url() && ! $consent ) {
		ic_lead_fail( 'Подтвердите согласие на обработку персональных данных.' );
	}
	$comment = mb_substr( $comment, 0, 5000 );
	$source  = mb_substr( $source, 0, 200 );

	$files = ic_take_files();
	if ( is_wp_error( $files ) ) {
		ic_lead_fail( $files->get_error_message() );
	}

	set_transient( $rkey, $hits + 1, 10 * MINUTE_IN_SECONDS );

	$post_id = wp_insert_post(
		array(
			'post_type'   => 'ic_lead',
			'post_status' => 'private',
			'post_title'  => $name . ' — ' . $phone,
		),
		true
	);
	if ( is_wp_error( $post_id ) ) {
		ic_delete_files( $files );
		ic_lead_fail( 'Не удалось сохранить заявку.', 500 );
	}

	$lead = array(
		'name'    => $name,
		'phone'   => $phone,
		'comment' => $comment,
		'source'  => $source,
		'page'    => $page,
		'consent' => $consent ? current_time( 'mysql' ) : '',
		'ip'      => $ip,
		'files'   => $files,
	);
	foreach ( $lead as $k => $v ) {
		update_post_meta( $post_id, '_ic_' . $k, $v );
	}

	$delivery = array(
		'mail' => ic_send_mail( $lead, $post_id ),
		'tg'   => ic_send_telegram( $lead, $post_id ),
	);
	update_post_meta( $post_id, '_ic_delivery', $delivery );

	do_action( 'ironcore_lead_saved', $post_id, $lead, $delivery ); // hook for CRM integration.

	wp_send_json_success( array( 'message' => $ok_message ) );
}

/** Privacy policy URL if the page is published (Settings → Privacy). */
function ic_privacy_url() {
	$url = get_privacy_policy_url();
	return $url ? $url : '';
}

/* ---------- Files ---------- */

function ic_lead_dir() {
	$up = wp_upload_dir();
	return array(
		'base' => trailingslashit( $up['basedir'] ) . 'ironcore-leads',
		'url'  => trailingslashit( $up['baseurl'] ) . 'ironcore-leads',
	);
}

/** Keep lead files out of public reach (Apache). For nginx see docs/wordpress-handoff.md. */
function ic_protect_dir( $dir ) {
	if ( ! is_dir( $dir ) ) {
		wp_mkdir_p( $dir );
	}
	if ( ! file_exists( $dir . '/.htaccess' ) ) {
		file_put_contents( $dir . '/.htaccess', "Require all denied\n<IfModule !mod_authz_core.c>\nDeny from all\n</IfModule>\n" ); // phpcs:ignore
	}
	if ( ! file_exists( $dir . '/index.php' ) ) {
		file_put_contents( $dir . '/index.php', "<?php // Silence.\n" ); // phpcs:ignore
	}
}

/**
 * Validates and stores $_FILES['files'].
 *
 * @return array|WP_Error list of [ 'path', 'name', 'size' ].
 */
function ic_take_files() {
	if ( empty( $_FILES['files'] ) || empty( $_FILES['files']['name'] ) ) { // phpcs:ignore
		return array();
	}
	$raw  = $_FILES['files']; // phpcs:ignore
	$list = array();
	foreach ( (array) $raw['name'] as $i => $n ) {
		if ( '' === $n || UPLOAD_ERR_NO_FILE === (int) $raw['error'][ $i ] ) {
			continue;
		}
		$list[] = array(
			'name'     => $n,
			'type'     => $raw['type'][ $i ],
			'tmp_name' => $raw['tmp_name'][ $i ],
			'error'    => $raw['error'][ $i ],
			'size'     => $raw['size'][ $i ],
		);
	}
	if ( ! $list ) {
		return array();
	}
	if ( count( $list ) > IC_FORM_MAX_FILES ) {
		return new WP_Error( 'files', 'Можно прикрепить не больше ' . IC_FORM_MAX_FILES . ' файлов.' );
	}

	require_once ABSPATH . 'wp-admin/includes/file.php';
	$mimes = ic_form_mimes();
	foreach ( $list as $f ) {
		if ( UPLOAD_ERR_OK !== (int) $f['error'] ) {
			return new WP_Error( 'files', 'Файл «' . sanitize_file_name( $f['name'] ) . '» не загрузился. Возможно, он слишком большой.' );
		}
		if ( $f['size'] > IC_FORM_MAX_MB * MB_IN_BYTES ) {
			return new WP_Error( 'files', 'Файл «' . sanitize_file_name( $f['name'] ) . '» больше ' . IC_FORM_MAX_MB . ' МБ.' );
		}
		$chk = wp_check_filetype_and_ext( $f['tmp_name'], $f['name'], $mimes );
		if ( empty( $chk['ext'] ) ) {
			return new WP_Error( 'files', 'Формат файла «' . sanitize_file_name( $f['name'] ) . '» не принимается. Подходят PDF, DOC(X), XLS(X), ODT, ODS, JPG, PNG, ZIP.' );
		}
	}

	$dir = ic_lead_dir();
	ic_protect_dir( $dir['base'] );
	$sub = '/' . gmdate( 'Y/m' );
	$cb  = function ( $u ) use ( $dir, $sub ) {
		$u['subdir'] = $sub;
		$u['path']   = $dir['base'] . $sub;
		$u['url']    = $dir['url'] . $sub;
		return $u;
	};
	add_filter( 'upload_dir', $cb );

	$saved = array();
	foreach ( $list as $f ) {
		$orig      = sanitize_file_name( $f['name'] );
		$f['name'] = wp_generate_password( 10, false ) . '-' . $orig; // unguessable name.
		$res       = wp_handle_upload(
			$f,
			array(
				'test_form' => false,
				'mimes'     => $mimes,
			)
		);
		if ( empty( $res['file'] ) ) {
			remove_filter( 'upload_dir', $cb );
			ic_delete_files( $saved );
			return new WP_Error( 'files', 'Не удалось сохранить файл «' . $orig . '».' );
		}
		$saved[] = array(
			'path' => $res['file'],
			'name' => $orig,
			'size' => (int) $f['size'],
		);
	}
	remove_filter( 'upload_dir', $cb );
	return $saved;
}

function ic_delete_files( $files ) {
	foreach ( (array) $files as $f ) {
		if ( ! empty( $f['path'] ) && file_exists( $f['path'] ) ) {
			wp_delete_file( $f['path'] );
		}
	}
}

/* Deleting a lead removes its files. */
add_action(
	'before_delete_post',
	function ( $id ) {
		if ( 'ic_lead' === get_post_type( $id ) ) {
			ic_delete_files( get_post_meta( $id, '_ic_files', true ) );
		}
	}
);

/* ---------- Delivery ---------- */

function ic_lead_text( $lead, $post_id ) {
	$lines = array(
		'Новая заявка с сайта ' . wp_parse_url( home_url(), PHP_URL_HOST ),
		'',
		'Имя: ' . $lead['name'],
		'Телефон: ' . $lead['phone'],
		'Откуда: ' . ( $lead['source'] ? $lead['source'] : '—' ),
	);
	if ( $lead['comment'] ) {
		$lines[] = '';
		$lines[] = 'Комментарий:';
		$lines[] = $lead['comment'];
	}
	if ( $lead['files'] ) {
		$lines[] = '';
		$lines[] = 'Файлы (' . count( $lead['files'] ) . '): ' . implode( ', ', wp_list_pluck( $lead['files'], 'name' ) );
	}
	$lines[] = '';
	$lines[] = 'Заявка в админке: ' . admin_url( 'post.php?post=' . (int) $post_id . '&action=edit' );
	return implode( "\n", $lines );
}

/** @return bool|null null = channel not configured. */
function ic_send_mail( $lead, $post_id ) {
	$to = ic_opt( 'lead_email', get_option( 'admin_email' ) );
	if ( ! $to ) {
		return null;
	}
	$attach = array();
	$total  = 0;
	foreach ( $lead['files'] as $f ) {
		$total += $f['size'];
		if ( $total <= 20 * MB_IN_BYTES ) { // keep under typical mailbox limits; the rest stays in admin.
			$attach[] = $f['path'];
		}
	}
	$subject = 'Заявка с сайта: ' . ( $lead['source'] ? $lead['source'] : $lead['name'] );
	return (bool) wp_mail( $to, $subject, ic_lead_text( $lead, $post_id ), array( 'Content-Type: text/plain; charset=UTF-8' ), $attach );
}

/** @return bool|null null = channel not configured. */
function ic_send_telegram( $lead, $post_id ) {
	$token = ic_secret( 'IRONCORE_TG_TOKEN', 'tg_token' );
	$chat  = ic_secret( 'IRONCORE_TG_CHAT', 'tg_chat' );
	if ( ! $token || ! $chat ) {
		return null;
	}
	$res = wp_remote_post(
		'https://api.telegram.org/bot' . rawurlencode( $token ) . '/sendMessage',
		array(
			'timeout' => 8,
			'body'    => array(
				'chat_id'                  => $chat,
				'text'                     => mb_substr( ic_lead_text( $lead, $post_id ), 0, 4000 ),
				'disable_web_page_preview' => 'true',
			),
		)
	);
	return ! is_wp_error( $res ) && 200 === (int) wp_remote_retrieve_response_code( $res );
}

/* ---------- Admin: list columns, read-only card, file download ---------- */

add_filter(
	'manage_ic_lead_posts_columns',
	function () {
		return array(
			'cb'       => '<input type="checkbox">',
			'title'    => 'Имя — телефон',
			'source'   => 'Откуда',
			'files'    => 'Файлы',
			'delivery' => 'Доставка',
			'date'     => 'Дата',
		);
	}
);

function ic_delivery_label( $d ) {
	$map = array(
		'mail' => 'Почта',
		'tg'   => 'Telegram',
	);
	$out = array();
	foreach ( $map as $k => $label ) {
		if ( ! is_array( $d ) || ! array_key_exists( $k, $d ) || null === $d[ $k ] ) {
			continue;
		}
		$out[] = $label . ( $d[ $k ] ? ' ✓' : ' ✗' );
	}
	return $out ? implode( ', ', $out ) : 'только в админке';
}

add_action(
	'manage_ic_lead_posts_custom_column',
	function ( $col, $id ) {
		if ( 'source' === $col ) {
			echo esc_html( get_post_meta( $id, '_ic_source', true ) );
		} elseif ( 'files' === $col ) {
			echo (int) count( (array) get_post_meta( $id, '_ic_files', true ) );
		} elseif ( 'delivery' === $col ) {
			echo esc_html( ic_delivery_label( get_post_meta( $id, '_ic_delivery', true ) ) );
		}
	},
	10,
	2
);

add_action(
	'add_meta_boxes_ic_lead',
	function () {
		add_meta_box( 'ic_lead_card', 'Данные заявки', 'ic_lead_card', 'ic_lead', 'normal', 'high' );
	}
);

function ic_lead_card( $post ) {
	$m     = function ( $k ) use ( $post ) {
		return get_post_meta( $post->ID, '_ic_' . $k, true );
	};
	$rows  = array(
		'Имя'         => esc_html( $m( 'name' ) ),
		'Телефон'     => '<a href="tel:' . esc_attr( preg_replace( '/[^\d+]/', '', $m( 'phone' ) ) ) . '">' . esc_html( $m( 'phone' ) ) . '</a>',
		'Откуда'      => esc_html( $m( 'source' ) ),
		'Комментарий' => nl2br( esc_html( $m( 'comment' ) ) ),
		'Страница'    => esc_html( $m( 'page' ) ),
		'Согласие ПДн' => $m( 'consent' ) ? esc_html( $m( 'consent' ) ) : '—',
		'IP'          => esc_html( $m( 'ip' ) ),
		'Доставка'    => esc_html( ic_delivery_label( $m( 'delivery' ) ) ),
	);
	$files = (array) $m( 'files' );
	if ( $files ) {
		$links = array();
		foreach ( $files as $i => $f ) {
			$url     = wp_nonce_url( admin_url( 'admin-post.php?action=ironcore_lead_file&lead=' . $post->ID . '&i=' . $i ), 'ic_file_' . $post->ID );
			$links[] = '<a href="' . esc_url( $url ) . '">' . esc_html( $f['name'] ) . '</a> (' . esc_html( size_format( $f['size'] ) ) . ')';
		}
		$rows['Файлы'] = implode( '<br>', $links );
	}
	echo '<table class="form-table" role="presentation"><tbody>';
	foreach ( $rows as $k => $v ) {
		echo '<tr><th scope="row">' . esc_html( $k ) . '</th><td>' . $v . '</td></tr>'; // phpcs:ignore -- escaped above.
	}
	echo '</tbody></table>';
}

/* Files are stored outside public access; admins download them through WordPress. */
add_action(
	'admin_post_ironcore_lead_file',
	function () {
		$id = isset( $_GET['lead'] ) ? (int) $_GET['lead'] : 0;
		$i  = isset( $_GET['i'] ) ? (int) $_GET['i'] : -1;
		if ( ! $id || ! current_user_can( 'edit_post', $id ) || 'ic_lead' !== get_post_type( $id ) ) {
			wp_die( 'Нет доступа.', 403 );
		}
		check_admin_referer( 'ic_file_' . $id );
		$files = (array) get_post_meta( $id, '_ic_files', true );
		if ( empty( $files[ $i ]['path'] ) || ! file_exists( $files[ $i ]['path'] ) ) {
			wp_die( 'Файл не найден.', 404 );
		}
		$f = $files[ $i ];
		nocache_headers();
		header( 'Content-Type: application/octet-stream' );
		header( 'Content-Disposition: attachment; filename*=UTF-8\'\'' . rawurlencode( $f['name'] ) );
		header( 'Content-Length: ' . filesize( $f['path'] ) );
		readfile( $f['path'] ); // phpcs:ignore
		exit;
	}
);
