<?php
namespace SaaslandCore\WPML;

use WPML_Elementor_Module_With_Items;

/**
 * App info integration
 */

defined( 'ABSPATH' ) || die();

class App_info extends WPML_Elementor_Module_With_Items  {

	/**
	 * @return string
	 */
	public function get_items_field() {
		return 'infos';
	}

	/**
	 * @return array
	 */
	public function get_fields() {
		return ['title', 'rating_label', 'info_items'];
	}

	/**
	 * @param string $field
	 * @return string
	 */
	protected function get_title( $field ) {
		switch ( $field ) {
			case 'title':
				return __( 'App info: Title', 'saasland-core' );
			case 'rating_label':
				return __( 'App info: Rating label', 'saasland-core' );
			case 'info_items':
                return __( 'App info: Items', 'saasland-core' );
			default:
				return '';
		}
	}

	/**
	 * @param string $field
	 * @return string
	 */
	protected function get_editor_type( $field ) {
		switch ( $field ) {
			case 'title':
				return 'LINE';
			case 'rating_label':
				return 'LINE';
			case 'info_items':
				return 'AREA';
			default:
				return '';
		}
	}
}
