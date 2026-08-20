<?php
/**
 * Theme helpers.
 *
 * @package smartcodenucleo
 */

function scn_get( $key, $default = null ) {
	$defaults = scn_defaults();
	if ( null === $default && isset( $defaults[ $key ] ) ) {
		$default = $defaults[ $key ];
	}
	return get_theme_mod( $key, $default );
}

function scn_text( $key ) {
	echo esc_html( scn_get( $key ) );
}

function scn_attr( $key ) {
	echo esc_attr( scn_get( $key ) );
}

function scn_url( $key ) {
	echo esc_url( scn_get( $key ) );
}

function scn_logo_url() {
	$custom = get_theme_mod( 'custom_logo' );
	if ( $custom ) {
		$url = wp_get_attachment_image_url( $custom, 'full' );
		if ( $url ) {
			return $url;
		}
	}
	return scn_get( 'default_logo' );
}

function scn_img( $key, $alt = '', $class = '' ) {
	printf(
		'<img src="%s" alt="%s" class="%s" loading="lazy" />',
		esc_url( scn_get( $key ) ),
		esc_attr( $alt ),
		esc_attr( $class )
	);
}
