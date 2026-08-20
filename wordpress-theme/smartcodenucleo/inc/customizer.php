<?php
/**
 * Theme Customizer — all texts and images editable.
 *
 * @package smartcodenucleo
 */

add_action(
	'customize_register',
	function ( $wp_customize ) {
		$defaults = scn_defaults();

		$wp_customize->add_panel(
			'scn_panel',
			array(
				'title'       => __( 'Smart Code Núcleo — Contenido', 'smartcodenucleo' ),
				'description' => __( 'Edita textos, imágenes y secciones del sitio.', 'smartcodenucleo' ),
				'priority'    => 10,
			)
		);

		$sections = array(
			'scn_global'    => __( 'Global (logo, fondo, loader)', 'smartcodenucleo' ),
			'scn_home'      => __( 'Home', 'smartcodenucleo' ),
			'scn_solutions' => __( 'Solutions', 'smartcodenucleo' ),
			'scn_who'       => __( 'Who We Are', 'smartcodenucleo' ),
			'scn_partners'  => __( 'Partners', 'smartcodenucleo' ),
			'scn_news'      => __( 'News', 'smartcodenucleo' ),
			'scn_connect'   => __( "Let's Connect", 'smartcodenucleo' ),
			'scn_tech'      => __( 'Our Technology', 'smartcodenucleo' ),
			'scn_demo'      => __( 'Demo', 'smartcodenucleo' ),
			'scn_footer'    => __( 'Footer / Redes', 'smartcodenucleo' ),
		);

		foreach ( $sections as $id => $title ) {
			$wp_customize->add_section(
				$id,
				array(
					'title' => $title,
					'panel' => 'scn_panel',
				)
			);
		}

		$fields = array(
			// Global.
			array( 'background_image', 'image', 'scn_global', __( 'Imagen de fondo', 'smartcodenucleo' ) ),
			array( 'loader_image', 'image', 'scn_global', __( 'Imagen del loader (bolita)', 'smartcodenucleo' ) ),
			array( 'default_logo', 'image', 'scn_global', __( 'Logo (si no usas Logo del sitio)', 'smartcodenucleo' ) ),

			// Home.
			array( 'hero_title', 'text', 'scn_home', __( 'Título del hero', 'smartcodenucleo' ) ),
			array( 'hero_video', 'url', 'scn_home', __( 'URL del video hero', 'smartcodenucleo' ) ),
			array( 'hero_poster', 'image', 'scn_home', __( 'Poster del video', 'smartcodenucleo' ) ),
			array( 'home_section_title', 'text', 'scn_home', __( 'Título sección Smart Code', 'smartcodenucleo' ) ),
			array( 'home_lead', 'textarea', 'scn_home', __( 'Lead', 'smartcodenucleo' ) ),
			array( 'home_p1', 'textarea', 'scn_home', __( 'Párrafo 1', 'smartcodenucleo' ) ),
			array( 'home_p2', 'textarea', 'scn_home', __( 'Párrafo 2', 'smartcodenucleo' ) ),
			array( 'home_p3', 'textarea', 'scn_home', __( 'Párrafo 3', 'smartcodenucleo' ) ),
			array( 'home_side_image', 'image', 'scn_home', __( 'Imagen lateral', 'smartcodenucleo' ) ),

			// Solutions.
			array( 'solutions_title', 'text', 'scn_solutions', __( 'Título', 'smartcodenucleo' ) ),
			array( 'solutions_subtitle', 'text', 'scn_solutions', __( 'Subtítulo', 'smartcodenucleo' ) ),
		);

		for ( $i = 1; $i <= 6; $i++ ) {
			$fields[] = array( "sol_{$i}_title", 'text', 'scn_solutions', sprintf( __( 'Solución %d — título', 'smartcodenucleo' ), $i ) );
			$fields[] = array( "sol_{$i}_text", 'textarea', 'scn_solutions', sprintf( __( 'Solución %d — texto', 'smartcodenucleo' ), $i ) );
			$fields[] = array( "sol_{$i}_image", 'image', 'scn_solutions', sprintf( __( 'Solución %d — imagen', 'smartcodenucleo' ), $i ) );
		}

		// Who.
		$fields = array_merge(
			$fields,
			array(
				array( 'who_title', 'text', 'scn_who', __( 'Título', 'smartcodenucleo' ) ),
				array( 'who_subtitle', 'textarea', 'scn_who', __( 'Subtítulo / pregunta', 'smartcodenucleo' ) ),
				array( 'who_image', 'image', 'scn_who', __( 'Imagen', 'smartcodenucleo' ) ),
				array( 'who_p1', 'textarea', 'scn_who', __( 'Párrafo 1', 'smartcodenucleo' ) ),
				array( 'who_p2', 'textarea', 'scn_who', __( 'Párrafo 2', 'smartcodenucleo' ) ),
				array( 'who_vision', 'textarea', 'scn_who', __( 'Vision', 'smartcodenucleo' ) ),
				array( 'who_mission', 'textarea', 'scn_who', __( 'Mission', 'smartcodenucleo' ) ),

				array( 'partners_title', 'text', 'scn_partners', __( 'Título', 'smartcodenucleo' ) ),
				array( 'partners_subtitle', 'textarea', 'scn_partners', __( 'Subtítulo', 'smartcodenucleo' ) ),
				array( 'partners_cta', 'text', 'scn_partners', __( 'CTA inferior', 'smartcodenucleo' ) ),
				array( 'partner_1_image', 'image', 'scn_partners', __( 'Imagen partner 1', 'smartcodenucleo' ) ),
				array( 'partner_2_image', 'image', 'scn_partners', __( 'Imagen partner 2', 'smartcodenucleo' ) ),
				array( 'partner_3_image', 'image', 'scn_partners', __( 'Imagen partner 3', 'smartcodenucleo' ) ),

				array( 'news_title', 'text', 'scn_news', __( 'Título', 'smartcodenucleo' ) ),
				array( 'news_subtitle', 'textarea', 'scn_news', __( 'Subtítulo', 'smartcodenucleo' ) ),
			)
		);

		for ( $i = 1; $i <= 3; $i++ ) {
			$fields[] = array( "news_{$i}_title", 'text', 'scn_news', sprintf( __( 'Noticia %d — título', 'smartcodenucleo' ), $i ) );
			$fields[] = array( "news_{$i}_text", 'textarea', 'scn_news', sprintf( __( 'Noticia %d — texto', 'smartcodenucleo' ), $i ) );
			$fields[] = array( "news_{$i}_date", 'text', 'scn_news', sprintf( __( 'Noticia %d — fecha', 'smartcodenucleo' ), $i ) );
			$fields[] = array( "news_{$i}_image", 'image', 'scn_news', sprintf( __( 'Noticia %d — imagen', 'smartcodenucleo' ), $i ) );
		}

		$fields = array_merge(
			$fields,
			array(
				array( 'connect_title', 'text', 'scn_connect', __( 'Título', 'smartcodenucleo' ) ),
				array( 'connect_subtitle', 'text', 'scn_connect', __( 'Subtítulo', 'smartcodenucleo' ) ),
				array( 'connect_text', 'textarea', 'scn_connect', __( 'Texto', 'smartcodenucleo' ) ),
				array( 'connect_email', 'text', 'scn_connect', __( 'Email de contacto', 'smartcodenucleo' ) ),

				array( 'tech_title', 'text', 'scn_tech', __( 'Título', 'smartcodenucleo' ) ),
				array( 'tech_subtitle', 'text', 'scn_tech', __( 'Subtítulo', 'smartcodenucleo' ) ),
				array( 'tech_lead', 'textarea', 'scn_tech', __( 'Lead', 'smartcodenucleo' ) ),
				array( 'tech_1_title', 'text', 'scn_tech', __( 'Punto 1 — título', 'smartcodenucleo' ) ),
				array( 'tech_1_text', 'textarea', 'scn_tech', __( 'Punto 1 — texto', 'smartcodenucleo' ) ),
				array( 'tech_2_title', 'text', 'scn_tech', __( 'Punto 2 — título', 'smartcodenucleo' ) ),
				array( 'tech_2_text', 'textarea', 'scn_tech', __( 'Punto 2 — texto', 'smartcodenucleo' ) ),
				array( 'tech_3_title', 'text', 'scn_tech', __( 'Punto 3 — título', 'smartcodenucleo' ) ),
				array( 'tech_3_text', 'textarea', 'scn_tech', __( 'Punto 3 — texto', 'smartcodenucleo' ) ),

				array( 'demo_title', 'text', 'scn_demo', __( 'Título', 'smartcodenucleo' ) ),
				array( 'demo_subtitle', 'text', 'scn_demo', __( 'Subtítulo', 'smartcodenucleo' ) ),
				array( 'demo_text', 'textarea', 'scn_demo', __( 'Texto', 'smartcodenucleo' ) ),

				array( 'footer_location', 'text', 'scn_footer', __( 'Ubicación', 'smartcodenucleo' ) ),
				array( 'instagram_url', 'url', 'scn_footer', __( 'URL Instagram', 'smartcodenucleo' ) ),
				array( 'linkedin_url', 'url', 'scn_footer', __( 'URL LinkedIn', 'smartcodenucleo' ) ),
				array( 'facebook_url', 'url', 'scn_footer', __( 'URL Facebook', 'smartcodenucleo' ) ),
				array( 'twitter_url', 'url', 'scn_footer', __( 'URL Twitter / X', 'smartcodenucleo' ) ),
			)
		);

		foreach ( $fields as $field ) {
			list( $id, $type, $section, $label ) = $field;
			$default = isset( $defaults[ $id ] ) ? $defaults[ $id ] : '';

			$wp_customize->add_setting(
				$id,
				array(
					'default'           => $default,
					'sanitize_callback' => ( 'image' === $type || 'url' === $type ) ? 'esc_url_raw' : ( 'textarea' === $type ? 'sanitize_textarea_field' : 'sanitize_text_field' ),
					'transport'         => 'refresh',
				)
			);

			if ( 'image' === $type ) {
				$wp_customize->add_control(
					new WP_Customize_Image_Control(
						$wp_customize,
						$id,
						array(
							'label'   => $label,
							'section' => $section,
							'settings'=> $id,
						)
					)
				);
			} elseif ( 'textarea' === $type ) {
				$wp_customize->add_control(
					$id,
					array(
						'label'   => $label,
						'section' => $section,
						'type'    => 'textarea',
					)
				);
			} else {
				$wp_customize->add_control(
					$id,
					array(
						'label'   => $label,
						'section' => $section,
						'type'    => 'text',
					)
				);
			}
		}
	}
);
