<?php
/**
 * Elementor support — SCN styled widgets.
 *
 * @package smartcodenucleo
 */

add_action(
	'after_setup_theme',
	function () {
		add_theme_support( 'elementor' );
	}
);

add_filter(
	'theme_page_templates',
	function ( $templates ) {
		$templates['templates/elementor-fullwidth.php'] = __( 'Elementor — Ancho completo', 'smartcodenucleo' );
		$templates['templates/elementor-canvas.php']    = __( 'Elementor — Solo contenido (canvas)', 'smartcodenucleo' );
		return $templates;
	}
);

function scn_is_elementor_page( $post_id = null ) {
	$post_id = $post_id ?: get_the_ID();
	if ( ! $post_id || ! class_exists( '\Elementor\Plugin' ) ) {
		return false;
	}
	return 'builder' === get_post_meta( $post_id, '_elementor_edit_mode', true );
}

// Load custom widgets only when Elementor is active.
add_action(
	'plugins_loaded',
	function () {
		if ( did_action( 'elementor/loaded' ) || class_exists( '\Elementor\Plugin' ) ) {
			require_once SCN_DIR . '/inc/elementor/bootstrap.php';
		}
	}
);

// Also try immediately if Elementor already loaded.
if ( class_exists( '\Elementor\Plugin' ) ) {
	require_once SCN_DIR . '/inc/elementor/bootstrap.php';
}

add_action(
	'admin_notices',
	function () {
		if ( ! current_user_can( 'edit_pages' ) || ! class_exists( '\Elementor\Plugin' ) ) {
			return;
		}
		$screen = function_exists( 'get_current_screen' ) ? get_current_screen() : null;
		if ( ! $screen || ! in_array( $screen->id, array( 'dashboard', 'edit-page' ), true ) ) {
			return;
		}
		$home_id = (int) get_option( 'page_on_front' );
		$url     = $home_id ? admin_url( 'post.php?post=' . $home_id . '&action=elementor' ) : admin_url( 'edit.php?post_type=page' );
		echo '<div class="notice notice-info is-dismissible"><p>';
		echo 'Smart Code Núcleo: edita las páginas con Elementor usando los widgets <em>Smart Núcleo</em>. ';
		echo '<a href="' . esc_url( $url ) . '">Abrir Home</a></p></div>';
	}
);
