<?php
namespace SaaslandCore\WPML;

use WPML_Elementor_Module_With_Items;

/**
 * Bar Chart integration
 */

defined( 'ABSPATH' ) || die();

class Image_carousel5 extends WPML_Elementor_Module_With_Items  {
    /**
     * @return string
     */
    public function get_items_field() {
        return 'carousel5';
    }

    /**
     * @return array
     */
    public function get_fields() {
        return ['site_title'];
    }

    /**
     * @param string $field
     * @return string
     */
    protected function get_title( $field ) {
        switch ( $field ) {
            case 'site_title':
                return __( 'Saasland Carousels: Carousel Title', 'saasland-core' );
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
            case 'site_title':
                return 'LINE';
            default:
                return '';
        }
    }
}