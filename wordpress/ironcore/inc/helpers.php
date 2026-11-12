<?php
/**
 * Small helpers used by templates.
 *
 * @package IronCore
 */

defined( 'ABSPATH' ) || exit;

/**
 * Theme setting with a default. Значения задаются в Customizer;
 * секреты можно задать константой в wp-config.php (см. ic_secret()).
 */
function ic_opt( $key, $default = '' ) {
	$v = get_theme_mod( 'ic_' . $key, $default );
	return ( '' === $v || null === $v ) ? $default : $v;
}

/** wp-config constant wins over the Customizer value (for tokens). */
function ic_secret( $const, $key ) {
	if ( defined( $const ) && constant( $const ) ) {
		return (string) constant( $const );
	}
	return (string) ic_opt( $key, '' );
}

/** Phone as shown on the page. */
function ic_phone() {
	return ic_opt( 'phone', '8 (928) 416-09-38' );
}

/** tel: link built from the displayed phone; a leading 8 becomes +7. */
function ic_phone_href() {
	$d = preg_replace( '/\D+/', '', ic_phone() );
	if ( 11 === strlen( $d ) && '8' === $d[0] ) {
		$d = '7' . substr( $d, 1 );
	}
	return 'tel:+' . $d;
}

/** Anchor that also works from inner pages (policy page, 404). */
function ic_anchor( $hash ) {
	return is_front_page() ? $hash : home_url( '/' ) . $hash;
}

/**
 * Menu links for a location. If no menu is assigned, the approved defaults are used,
 * so the site looks right right after activation.
 *
 * @return array[] [ [ 'url' => ..., 'label' => ... ], ... ]
 */
function ic_menu_links( $location ) {
	$defaults = array(
		'primary' => array(
			'#solutions' => 'Решения',
			'#services'  => 'Услуги',
			'#process'   => 'Как мы работаем',
			'#why'       => 'Почему IronCore',
			'#materials' => 'Для заказчика',
			'#contact'   => 'Контакты',
		),
		'footer'  => array(
			'#solutions' => 'Решения',
			'#services'  => 'Услуги',
			'#process'   => 'Как мы работаем',
			'#why'       => 'Почему IronCore',
			'#materials' => 'Для заказчика',
			'#faq'       => 'FAQ',
			'#contact'   => 'Контакты',
		),
	);

	$links     = array();
	$locations = get_nav_menu_locations();
	if ( ! empty( $locations[ $location ] ) ) {
		$items = wp_get_nav_menu_items( $locations[ $location ] );
		foreach ( (array) $items as $item ) {
			if ( ! empty( $item->menu_item_parent ) ) {
				continue; // flat menu only, as in the design.
			}
			$url = $item->url;
			// "#section" or "/#section" items should jump in place on the front page.
			if ( preg_match( '~^(?:' . preg_quote( home_url( '/' ), '~' ) . '|/)?(#[\w-]+)$~', $url, $m ) ) {
				$url = ic_anchor( $m[1] );
			}
			$links[] = array( 'url' => $url, 'label' => $item->title );
		}
	}
	if ( ! $links && isset( $defaults[ $location ] ) ) {
		foreach ( $defaults[ $location ] as $hash => $label ) {
			$links[] = array( 'url' => ic_anchor( $hash ), 'label' => $label );
		}
	}
	return $links;
}

/** Prints <a> list for header/drawer. */
function ic_menu_anchors( $location ) {
	foreach ( ic_menu_links( $location ) as $l ) {
		printf( '<a href="%s">%s</a>' . "\n", esc_url( $l['url'] ), esc_html( $l['label'] ) );
	}
}

/** Messenger links set in the Customizer (empty = not shown). */
function ic_messengers() {
	$out = array();
	foreach ( array( 'telegram_url' => 'Telegram', 'max_url' => 'MAX' ) as $key => $label ) {
		$url = ic_opt( $key );
		if ( $url ) {
			$out[] = array( 'url' => $url, 'label' => $label );
		}
	}
	return $out;
}
