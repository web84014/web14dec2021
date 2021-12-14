<?php
namespace SaaslandCore\WPML;

use WPML_Elementor_Module_With_Items;

/**
 * Bar Chart integration
 */

defined( 'ABSPATH' ) || die();

class Hero_buttons extends WPML_Elementor_Module_With_Items  {

    /**
     * @return string
     */
    public function get_items_field() {
        return 'buttons';
    }

    /**
     * @return array
     */
    public function get_fields() {
        return ['btn_title'];
    }

    /**
     * @param string $field
     * @return string
     */
    protected function get_title( $field ) {
        switch ( $field ) {
            case 'btn_title':
                return __( 'Hero: Button Title', 'saasland-core' );
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
            case 'btn_title':
                return 'LINE';
            default:
                return '';
        }
    }
}