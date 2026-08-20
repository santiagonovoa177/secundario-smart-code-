<?php
/**
 * Elementor integration bootstrap — custom widgets keep SCN styles.
 *
 * @package smartcodenucleo
 */

add_action(
	'elementor/elements/categories_registered',
	function ( $elements_manager ) {
		$elements_manager->add_category(
			'smart-nucleo',
			array(
				'title' => 'Smart Núcleo',
				'icon'  => 'fa fa-plug',
			)
		);
	}
);

add_action(
	'elementor/widgets/register',
	function ( $widgets_manager ) {
		require_once SCN_DIR . '/inc/elementor/class-scn-widget-base.php';
		require_once SCN_DIR . '/inc/elementor/widgets/class-hero.php';
		require_once SCN_DIR . '/inc/elementor/widgets/class-text-media.php';
		require_once SCN_DIR . '/inc/elementor/widgets/class-cards.php';
		require_once SCN_DIR . '/inc/elementor/widgets/class-about.php';
		require_once SCN_DIR . '/inc/elementor/widgets/class-partners.php';
		require_once SCN_DIR . '/inc/elementor/widgets/class-news.php';
		require_once SCN_DIR . '/inc/elementor/widgets/class-tech.php';
		require_once SCN_DIR . '/inc/elementor/widgets/class-contact.php';

		$widgets_manager->register( new \SCN\Elementor\Widget_Hero() );
		$widgets_manager->register( new \SCN\Elementor\Widget_Text_Media() );
		$widgets_manager->register( new \SCN\Elementor\Widget_Cards() );
		$widgets_manager->register( new \SCN\Elementor\Widget_About() );
		$widgets_manager->register( new \SCN\Elementor\Widget_Partners() );
		$widgets_manager->register( new \SCN\Elementor\Widget_News() );
		$widgets_manager->register( new \SCN\Elementor\Widget_Tech() );
		$widgets_manager->register( new \SCN\Elementor\Widget_Contact() );
	}
);

add_action(
	'elementor/frontend/after_enqueue_styles',
	function () {
		wp_enqueue_style( 'scn-main', SCN_URI . '/assets/css/main.css', array(), SCN_VERSION );
	}
);

add_action(
	'elementor/editor/after_enqueue_styles',
	function () {
		wp_enqueue_style( 'scn-main', SCN_URI . '/assets/css/main.css', array(), SCN_VERSION );
		wp_enqueue_style( 'scn-elementor-editor', SCN_URI . '/assets/css/elementor-editor.css', array(), SCN_VERSION );
	}
);
