<?php
/**
 * Shared helpers for SCN Elementor widgets.
 *
 * @package smartcodenucleo
 */

namespace SCN\Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

abstract class Widget_Base extends \Elementor\Widget_Base {

	public function get_categories() {
		return array( 'smart-nucleo' );
	}

	public function get_icon() {
		return 'eicon-favorite';
	}

	protected function scn_url_control( $id, $label, $default = '' ) {
		$this->add_control(
			$id,
			array(
				'label'       => $label,
				'type'        => \Elementor\Controls_Manager::URL,
				'placeholder' => 'https://',
				'default'     => array(
					'url'         => $default,
					'is_external' => false,
					'nofollow'    => false,
				),
			)
		);
	}

	protected function scn_image_control( $id, $label, $default_url = '' ) {
		$default = array( 'url' => $default_url );
		$this->add_control(
			$id,
			array(
				'label'   => $label,
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => $default,
			)
		);
	}

	protected function scn_img_url( $setting ) {
		if ( is_array( $setting ) && ! empty( $setting['url'] ) ) {
			return $setting['url'];
		}
		return '';
	}

	protected function scn_link_url( $setting ) {
		if ( is_array( $setting ) && ! empty( $setting['url'] ) ) {
			return $setting['url'];
		}
		return '';
	}
}
