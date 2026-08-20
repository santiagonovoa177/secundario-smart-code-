<?php
/**
 * Create default pages and menus on theme activation.
 *
 * @package smartcodenucleo
 */

add_action(
	'after_switch_theme',
	function () {
		if ( get_option( 'scn_pages_created' ) ) {
			return;
		}

		$pages = array(
			'home'     => array( 'title' => 'Home', 'template' => 'front-page.php' ),
			'about-us' => array( 'title' => 'About Us', 'template' => 'default' ),
			'partners' => array( 'title' => 'Partners', 'template' => 'page-partners.php' ),
			'news'     => array( 'title' => 'News', 'template' => 'page-news.php' ),
			'contact'  => array( 'title' => 'Contact', 'template' => 'default' ),
		);

		$created = array();

		foreach ( $pages as $slug => $data ) {
			$existing = get_page_by_path( $slug );
			if ( $existing ) {
				$created[ $slug ] = $existing->ID;
				continue;
			}

			$id = wp_insert_post(
				array(
					'post_title'   => $data['title'],
					'post_name'    => $slug,
					'post_status'  => 'publish',
					'post_type'    => 'page',
					'post_content' => '',
				)
			);

			if ( $id && ! is_wp_error( $id ) ) {
				update_post_meta( $id, '_wp_page_template', $data['template'] );
				$created[ $slug ] = $id;
			}
		}

		if ( ! empty( $created['home'] ) ) {
			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', $created['home'] );
		}

		$menu_id = wp_create_nav_menu( 'Primary' );
		if ( ! is_wp_error( $menu_id ) ) {
			$order = array( 'home', 'about-us', 'partners', 'news', 'contact' );
			$pos   = 1;
			foreach ( $order as $slug ) {
				if ( empty( $created[ $slug ] ) ) {
					continue;
				}
				wp_update_nav_menu_item(
					$menu_id,
					0,
					array(
						'menu-item-title'     => get_the_title( $created[ $slug ] ),
						'menu-item-object'    => 'page',
						'menu-item-object-id' => $created[ $slug ],
						'menu-item-type'      => 'post_type',
						'menu-item-status'    => 'publish',
						'menu-item-position'  => $pos++,
					)
				);
			}
			$locations            = get_theme_mod( 'nav_menu_locations', array() );
			$locations['primary'] = $menu_id;
			set_theme_mod( 'nav_menu_locations', $locations );
		}

		update_option( 'scn_pages_created', 1 );
		flush_rewrite_rules();
	}
);
