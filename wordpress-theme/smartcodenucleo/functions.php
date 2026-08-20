<?php
/**
 * Smart Code Núcleo theme functions.
 *
 * @package smartcodenucleo
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'SCN_VERSION', '3.3.2' );
define( 'SCN_DIR', get_template_directory() );
define( 'SCN_URI', get_template_directory_uri() );

require_once SCN_DIR . '/inc/defaults.php';
require_once SCN_DIR . '/inc/helpers.php';
require_once SCN_DIR . '/inc/customizer.php';
require_once SCN_DIR . '/inc/setup-pages.php';
require_once SCN_DIR . '/inc/flexible-sections.php';
require_once SCN_DIR . '/inc/seed-sections.php';
require_once SCN_DIR . '/inc/elementor-support.php';

add_action(
	'after_setup_theme',
	function () {
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 80,
				'width'       => 280,
				'flex-height' => true,
				'flex-width'  => true,
			)
		);
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );

		register_nav_menus(
			array(
				'primary' => __( 'Menú principal', 'smartcodenucleo' ),
				'footer'  => __( 'Menú pie', 'smartcodenucleo' ),
			)
		);
	}
);

add_action(
	'wp_enqueue_scripts',
	function () {
		wp_enqueue_style( 'scn-main', SCN_URI . '/assets/css/main.css', array(), SCN_VERSION );
		wp_enqueue_script( 'scn-main', SCN_URI . '/assets/js/main.js', array(), SCN_VERSION, true );
		$defaults = scn_defaults();
		wp_localize_script(
			'scn-main',
			'SCN',
			array(
				'homeUrl'   => home_url( '/' ),
				'heroVideo' => isset( $defaults['hero_video'] ) ? $defaults['hero_video'] : '',
			)
		);
	}
);

add_action(
	'wp_head',
	function () {
		$defaults = scn_defaults();
		$video    = isset( $defaults['hero_video'] ) ? $defaults['hero_video'] : '';
		if ( ! $video ) {
			return;
		}
		printf(
			'<link rel="preload" as="video" href="%s" type="video/mp4" />' . "\n",
			esc_url( $video )
		);
	},
	1
);

/**
 * Fallback menu when no menu is assigned.
 */
function scn_fallback_menu() {
	$pages = array(
		'home'     => __( 'Home', 'smartcodenucleo' ),
		'about-us' => __( 'About Us', 'smartcodenucleo' ),
		'partners' => __( 'Partners', 'smartcodenucleo' ),
		'news'     => __( 'News', 'smartcodenucleo' ),
		'contact'  => __( 'Contact', 'smartcodenucleo' ),
	);

	echo '<ul class="nav-list">';
	foreach ( $pages as $slug => $label ) {
		$url     = ( 'home' === $slug ) ? home_url( '/' ) : home_url( '/' . $slug . '/' );
		$current = ( is_page( $slug ) || ( 'home' === $slug && is_front_page() ) ) ? ' is-active' : '';
		printf(
			'<li><a class="glass-btn%s" href="%s"><span>%s</span></a></li>',
			esc_attr( $current ),
			esc_url( $url ),
			esc_html( $label )
		);
	}
	echo '</ul>';
}
