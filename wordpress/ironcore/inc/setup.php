<?php
/**
 * Theme supports, menus, assets, <head>.
 *
 * @package IronCore
 */

defined( 'ABSPATH' ) || exit;

add_action(
	'after_setup_theme',
	function () {
		add_theme_support( 'title-tag' );
		add_theme_support( 'html5', array( 'script', 'style', 'navigation-widgets' ) );
		add_theme_support( 'responsive-embeds' );
		register_nav_menus(
			array(
				'primary' => 'Шапка и мобильное меню (6 пунктов)',
				'footer'  => 'Футер, колонка «Разделы»',
			)
		);
	}
);

/** Version by file time, so browsers pick up edits without manual bumps. */
function ic_ver( $rel ) {
	$f = IC_DIR . '/' . $rel;
	return file_exists( $f ) ? (string) filemtime( $f ) : IC_VERSION;
}

add_action(
	'wp_enqueue_scripts',
	function () {
		wp_enqueue_style( 'ironcore', IC_ASSETS . 'css/styles.css', array(), ic_ver( 'assets/css/styles.css' ) );
		if ( ! is_front_page() ) {
			wp_enqueue_style( 'ironcore-page', get_template_directory_uri() . '/theme-assets/page.css', array( 'ironcore' ), ic_ver( 'theme-assets/page.css' ) );
		}

		$args = version_compare( get_bloginfo( 'version' ), '6.3', '>=' ) ? array( 'in_footer' => true, 'strategy' => 'defer' ) : true;
		wp_enqueue_script( 'ironcore', IC_ASSETS . 'js/main.js', array(), ic_ver( 'assets/js/main.js' ), $args );

		$cfg = array(
			'ajaxUrl'   => admin_url( 'admin-ajax.php' ),
			'nonce'     => wp_create_nonce( 'ironcore_lead' ),
			'phone'     => ic_phone(),
			'phoneHref' => ic_phone_href(),
			'maxFiles'  => IC_FORM_MAX_FILES,
			'maxFileMb' => IC_FORM_MAX_MB,
		);
		wp_add_inline_script( 'ironcore', 'window.IRONCORE = ' . wp_json_encode( $cfg ) . ';', 'before' );

		// The landing page is hand-built: block-editor CSS is not used there and could shift the layout.
		if ( is_front_page() ) {
			foreach ( array( 'wp-block-library', 'wp-block-library-theme', 'global-styles', 'classic-theme-styles' ) as $h ) {
				wp_dequeue_style( $h );
			}
		}
	},
	20
);

/* No emoji polyfill: the site does not use emoji, and it costs a request. */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

/** Preload the hero image and the two fonts used above the fold. */
add_action(
	'wp_head',
	function () {
		if ( is_front_page() ) {
			$h = IC_ASSETS . 'images/hero/hero-overview';
			printf(
				'<link rel="preload" as="image" href="%1$s-1024w.webp" imagesrcset="%1$s-640w.webp 640w, %1$s-1024w.webp 1024w, %1$s.webp 1672w" imagesizes="(max-width: 600px) 190vw, (max-width: 960px) 132vw, 78vw" fetchpriority="high">' . "\n",
				$h // already escaped (IC_ASSETS).
			);
		}
		foreach ( array( '400', '600' ) as $w ) {
			printf( '<link rel="preload" href="%sfonts/onest-cyrillic-%s-normal.woff2" as="font" type="font/woff2" crossorigin>' . "\n", IC_ASSETS, $w ); // phpcs:ignore
		}
		if ( ! has_site_icon() ) {
			printf( '<link rel="icon" href="%slogos/current/ironcore-symbol.svg" type="image/svg+xml">' . "\n", IC_ASSETS ); // phpcs:ignore
		}
		// Fixed header must sit below the admin bar for logged-in users.
		if ( is_admin_bar_showing() ) {
			echo '<style>.admin-bar .header{top:32px}@media (max-width:782px){.admin-bar .header{top:46px}}</style>' . "\n";
		}
	},
	2
);

/** True if an SEO plugin will print title/description itself. */
function ic_has_seo_plugin() {
	return defined( 'WPSEO_VERSION' ) || defined( 'RANK_MATH_VERSION' ) || defined( 'AIOSEO_VERSION' ) || defined( 'SEOPRESS_VERSION' );
}

/* Title and description of the approved demo, unless an SEO plugin takes over. */
add_filter(
	'pre_get_document_title',
	function ( $title ) {
		if ( is_front_page() && ! ic_has_seo_plugin() ) {
			return ic_opt( 'seo_title', 'IronCore — проектирование ЦОД' );
		}
		return $title;
	}
);

add_action(
	'wp_head',
	function () {
		if ( is_front_page() && ! ic_has_seo_plugin() ) {
			$d = ic_opt( 'seo_description', 'IronCore проектирует дата-центры с учетом физических угроз – от выбора площадки и архитектуры до защиты критической инженерной инфраструктуры.' );
			printf( '<meta name="description" content="%s">' . "\n", esc_attr( $d ) );
		}
	},
	3
);
