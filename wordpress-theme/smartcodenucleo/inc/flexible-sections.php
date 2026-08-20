<?php
/**
 * Flexible page sections — easy dynamic content.
 *
 * @package smartcodenucleo
 */

function scn_section_types() {
	return array(
		'hero'       => __( 'Hero (video + título)', 'smartcodenucleo' ),
		'text_media' => __( 'Texto + imagen', 'smartcodenucleo' ),
		'cards'      => __( 'Tarjetas / Solutions', 'smartcodenucleo' ),
		'about'      => __( 'Who We Are', 'smartcodenucleo' ),
		'partners'   => __( 'Partners', 'smartcodenucleo' ),
		'news'       => __( 'News / Noticias', 'smartcodenucleo' ),
		'tech'       => __( 'Our Technology', 'smartcodenucleo' ),
		'contact'    => __( 'Contacto / Demo', 'smartcodenucleo' ),
		'richtext'   => __( 'Texto libre', 'smartcodenucleo' ),
	);
}

add_action(
	'init',
	function () {
		register_post_meta(
			'page',
			'_scn_sections',
			array(
				'show_in_rest'      => true,
				'single'            => true,
				'type'              => 'string',
				'auth_callback'     => function () {
					return current_user_can( 'edit_pages' );
				},
				'sanitize_callback' => function ( $value ) {
					if ( is_array( $value ) ) {
						$value = wp_json_encode( $value );
					}
					return is_string( $value ) ? $value : '[]';
				},
			)
		);
	}
);

add_action(
	'add_meta_boxes',
	function () {
		add_meta_box(
			'scn_sections_box',
			__( 'Secciones de la página (fácil y dinámico)', 'smartcodenucleo' ),
			'scn_render_sections_metabox',
			'page',
			'normal',
			'high'
		);
	}
);

function scn_render_sections_metabox( $post ) {
	wp_nonce_field( 'scn_save_sections', 'scn_sections_nonce' );
	$raw      = get_post_meta( $post->ID, '_scn_sections', true );
	$sections = json_decode( (string) $raw, true );
	if ( ! is_array( $sections ) ) {
		$sections = array();
	}

	$json = wp_json_encode( $sections );
	if ( ! is_string( $json ) ) {
		$json = '[]';
	}
	?>
	<div id="scn-sections-app">
		<p class="scn-admin-help">
			<?php esc_html_e( 'Agrega, reordena o elimina secciones. Luego pulsa Actualizar para guardar.', 'smartcodenucleo' ); ?>
		</p>
		<div class="scn-toolbar">
			<label for="scn-add-type"><strong><?php esc_html_e( 'Agregar sección:', 'smartcodenucleo' ); ?></strong></label>
			<select id="scn-add-type">
				<?php foreach ( scn_section_types() as $key => $label ) : ?>
					<option value="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $label ); ?></option>
				<?php endforeach; ?>
			</select>
			<button type="button" class="button button-primary" id="scn-add-section"><?php esc_html_e( '+ Agregar', 'smartcodenucleo' ); ?></button>
		</div>
		<div id="scn-sections-list"></div>
		<textarea name="scn_sections_json" id="scn_sections_json" class="scn-json-store" style="display:none"><?php echo esc_textarea( $json ); ?></textarea>
		<p id="scn-sections-status" class="description"></p>
	</div>
	<?php
}

add_action(
	'save_post_page',
	function ( $post_id ) {
		if ( ! isset( $_POST['scn_sections_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['scn_sections_nonce'] ) ), 'scn_save_sections' ) ) {
			return;
		}
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}
		if ( ! isset( $_POST['scn_sections_json'] ) ) {
			return;
		}

		$json = wp_unslash( $_POST['scn_sections_json'] );
		$data = json_decode( $json, true );
		if ( ! is_array( $data ) ) {
			$data = array();
		}

		$clean = array();
		foreach ( $data as $section ) {
			if ( empty( $section['type'] ) ) {
				continue;
			}
			$item = array(
				'type' => sanitize_key( $section['type'] ),
				'id'   => sanitize_text_field( $section['id'] ?? uniqid( 's_' ) ),
			);
			foreach ( $section as $key => $value ) {
				if ( in_array( $key, array( 'type', 'id' ), true ) ) {
					continue;
				}
				if ( is_array( $value ) ) {
					$item[ $key ] = array_map(
						function ( $row ) {
							if ( ! is_array( $row ) ) {
								return sanitize_text_field( (string) $row );
							}
							$out = array();
							foreach ( $row as $rk => $rv ) {
								$is_url = ( 'image' === $rk || 'video' === $rk || 'poster' === $rk || str_ends_with( (string) $rk, '_image' ) || str_ends_with( (string) $rk, '_url' ) );
								$out[ sanitize_key( $rk ) ] = $is_url ? esc_url_raw( (string) $rv ) : sanitize_textarea_field( (string) $rv );
							}
							return $out;
						},
						$value
					);
				} elseif ( str_contains( (string) $key, 'image' ) || str_contains( (string) $key, 'video' ) || str_contains( (string) $key, 'url' ) || 'poster' === $key ) {
					$item[ $key ] = esc_url_raw( (string) $value );
				} else {
					$item[ $key ] = sanitize_textarea_field( (string) $value );
				}
			}
			$clean[] = $item;
		}

		update_post_meta( $post_id, '_scn_sections', wp_json_encode( $clean ) );
	}
);

add_action(
	'admin_enqueue_scripts',
	function ( $hook ) {
		if ( ! in_array( $hook, array( 'post.php', 'post-new.php' ), true ) ) {
			return;
		}

		$screen = function_exists( 'get_current_screen' ) ? get_current_screen() : null;
		$is_page = $screen && isset( $screen->post_type ) && 'page' === $screen->post_type;

		// Fallback if screen is not ready yet.
		if ( ! $is_page ) {
			$post_id = isset( $_GET['post'] ) ? (int) $_GET['post'] : 0;
			if ( $post_id && 'page' === get_post_type( $post_id ) ) {
				$is_page = true;
			}
			if ( isset( $_GET['post_type'] ) && 'page' === $_GET['post_type'] ) {
				$is_page = true;
			}
		}

		if ( ! $is_page ) {
			return;
		}

		wp_enqueue_media();
		wp_enqueue_style( 'scn-admin-sections', SCN_URI . '/assets/css/admin-sections.css', array(), SCN_VERSION );
		wp_enqueue_script( 'scn-admin-sections', SCN_URI . '/assets/js/admin-sections.js', array( 'jquery' ), SCN_VERSION, true );

		$post_id  = isset( $_GET['post'] ) ? (int) $_GET['post'] : 0;
		$raw      = $post_id ? get_post_meta( $post_id, '_scn_sections', true ) : '[]';
		$sections = json_decode( (string) $raw, true );
		if ( ! is_array( $sections ) ) {
			$sections = array();
		}

		wp_localize_script(
			'scn-admin-sections',
			'SCN_SECTIONS',
			array(
				'sections' => $sections,
				'types'    => scn_section_types(),
				'defaults' => scn_defaults(),
				'i18n'     => array(
					'added'   => __( 'Sección agregada. Recuerda pulsar Actualizar.', 'smartcodenucleo' ),
					'removed' => __( 'Sección eliminada. Recuerda pulsar Actualizar.', 'smartcodenucleo' ),
					'confirm' => __( '¿Eliminar esta sección?', 'smartcodenucleo' ),
					'ready'   => __( 'Editor de secciones listo.', 'smartcodenucleo' ),
				),
			)
		);
	}
);

/**
 * Render flexible sections for a page.
 */
function scn_render_page_sections( $post_id = null ) {
	$post_id  = $post_id ?: get_the_ID();
	$raw      = get_post_meta( $post_id, '_scn_sections', true );
	$sections = json_decode( (string) $raw, true );
	if ( empty( $sections ) || ! is_array( $sections ) ) {
		return false;
	}

	foreach ( $sections as $section ) {
		$type = $section['type'] ?? '';
		$file = SCN_DIR . '/template-parts/sections/' . $type . '.php';
		if ( file_exists( $file ) ) {
			include $file;
		}
	}
	return true;
}
