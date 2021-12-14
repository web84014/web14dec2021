<?php
namespace SaaslandCore\WPML;

use WPML_Elementor_Module_With_Items;

/**
 * Image Hotspots
 */

defined( 'ABSPATH' ) || die();

class Hotspots extends WPML_Elementor_Module_With_Items  {

    /**
     * @return string
     */
    public function get_items_field() {
        return 'hotspots';
    }

    /**
     * @return array
     */
    public function get_fields() {
        return ['img_alt'];
    }

    /**
     * @param string $field
     * @return string
     */
    protected function get_title( $field ) {
        switch ( $field ) {
            case 'img_alt':
                return __( 'Hotspot: Image Alt Text', 'saasland-core' );
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
            case 'img_alt':
                return 'LINE';
            default:
                return '';
        }
    }
}