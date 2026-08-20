<?php
/**
 * Seed default flexible sections on pages.
 *
 * @package smartcodenucleo
 */

function scn_seed_sections_for_pages( $force = false ) {
	if ( ! $force && get_option( 'scn_sections_seeded_v2' ) ) {
		return;
	}

	$d   = scn_defaults();
	$map = array(
		'home'       => array(
			array(
				'id'         => 'home_hero',
				'type'       => 'hero',
				'title'      => $d['hero_title'],
				'video'      => $d['hero_video'],
				'poster'     => $d['hero_poster'],
				'cta1_label' => 'About Us',
				'cta1_url'   => '/about-us/',
				'cta2_label' => 'Contact',
				'cta2_url'   => '/contact/',
			),
			array(
				'id'           => 'home_smart_code',
				'type'         => 'text_media',
				'title'        => $d['home_section_title'],
				'lead'         => $d['home_lead'],
				'text'         => $d['home_p1'] . "\n\n" . $d['home_p2'] . "\n\n" . $d['home_p3'],
				'image'        => $d['home_side_image'],
				'button_label' => 'Contact',
				'button_url'   => '/contact/',
			),
		),
		'about-us'   => array(
			array(
				'id'       => 'about_cards',
				'type'     => 'cards',
				'title'    => $d['solutions_title'],
				'subtitle' => $d['solutions_subtitle'],
				'items'    => array_map(
					function ( $i ) use ( $d ) {
						return array(
							'title' => $d[ "sol_{$i}_title" ],
							'text'  => $d[ "sol_{$i}_text" ],
							'image' => $d[ "sol_{$i}_image" ],
						);
					},
					range( 1, 6 )
				),
			),
		),
		'partners'   => array(
			array(
				'id'       => 'partners',
				'type'     => 'partners',
				'title'    => $d['partners_title'],
				'subtitle' => $d['partners_subtitle'],
				'cta'      => $d['partners_cta'],
				'image1'   => $d['partner_1_image'],
				'image2'   => $d['partner_2_image'],
				'image3'   => $d['partner_3_image'],
			),
		),
		'news'       => array(
			array(
				'id'       => 'news',
				'type'     => 'news',
				'title'    => $d['news_title'],
				'subtitle' => $d['news_subtitle'],
				'items'    => array_map(
					function ( $i ) use ( $d ) {
						return array(
							'title' => $d[ "news_{$i}_title" ],
							'text'  => $d[ "news_{$i}_text" ],
							'date'  => $d[ "news_{$i}_date" ],
							'image' => $d[ "news_{$i}_image" ],
						);
					},
					range( 1, 3 )
				),
			),
		),
		'contact'    => array(
			array(
				'id'           => 'connect',
				'type'         => 'contact',
				'title'        => $d['connect_title'],
				'subtitle'     => $d['connect_subtitle'],
				'text'         => $d['connect_text'],
				'email'        => $d['connect_email'],
				'button_label' => 'Connect',
			),
		),
		// Legacy pages kept for content archive (not in menu).
		'who-we-are'    => array(
			array(
				'id'       => 'who',
				'type'     => 'about',
				'title'    => $d['who_title'],
				'subtitle' => $d['who_subtitle'],
				'image'    => $d['who_image'],
				'text'     => $d['who_p1'] . "\n\n" . $d['who_p2'],
				'vision'   => $d['who_vision'],
				'mission'  => $d['who_mission'],
			),
		),
		'ourtechnology' => array(
			array(
				'id'       => 'tech',
				'type'     => 'tech',
				'title'    => $d['tech_title'],
				'subtitle' => $d['tech_subtitle'],
				'lead'     => $d['tech_lead'],
				'items'    => array_map(
					function ( $i ) use ( $d ) {
						return array(
							'title' => $d[ "tech_{$i}_title" ],
							'text'  => $d[ "tech_{$i}_text" ],
						);
					},
					range( 1, 3 )
				),
			),
			array(
				'id'       => 'tech_cards',
				'type'     => 'cards',
				'title'    => 'Capabilities',
				'subtitle' => '',
				'items'    => array_map(
					function ( $i ) use ( $d ) {
						return array(
							'title' => $d[ "sol_{$i}_title" ],
							'text'  => $d[ "sol_{$i}_text" ],
							'image' => $d[ "sol_{$i}_image" ],
						);
					},
					range( 1, 3 )
				),
			),
		),
		'demo'          => array(
			array(
				'id'           => 'demo',
				'type'         => 'contact',
				'title'        => $d['demo_title'],
				'subtitle'     => $d['demo_subtitle'],
				'text'         => $d['demo_text'],
				'email'        => $d['connect_email'],
				'button_label' => 'Request Demo',
			),
		),
	);

	foreach ( $map as $slug => $sections ) {
		$page = get_page_by_path( $slug );
		if ( ! $page ) {
			continue;
		}
		update_post_meta( $page->ID, '_scn_sections', wp_json_encode( $sections ) );
		// Use flexible page template.
		update_post_meta( $page->ID, '_wp_page_template', 'default' );
	}

	// Front page uses front-page.php automatically.
	$home = get_page_by_path( 'home' );
	if ( $home ) {
		update_post_meta( $home->ID, '_wp_page_template', 'default' );
	}

	update_option( 'scn_sections_seeded_v2', 1 );
}

add_action(
	'after_switch_theme',
	function () {
		scn_seed_sections_for_pages( true );
	},
	20
);

add_action(
	'init',
	function () {
		if ( is_admin() && current_user_can( 'manage_options' ) && ! get_option( 'scn_sections_seeded_v2' ) ) {
			scn_seed_sections_for_pages( true );
		}
	},
	30
);
