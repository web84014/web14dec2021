<?php
namespace SaaslandCore\WPML;

use WPML_Elementor_Module_With_Items;

/**
 * Bar Chart integration
 */

defined( 'ABSPATH' ) || die();

class Image_carousel6 extends WPML_Elementor_Module_With_Items  {
    /**
     * @return string
     */
    public function get_items_field() {
        return 'carousel6';
    }

    /**
     * @return array
     */
    public function get_fields() {
        return ['img_badge'];
    }

    /**
     * @param string $field
     * @return string
     */
    protected function get_title( $field ) {
        switch ( $field ) {
            case 'img_badge':
                return __( 'Saasland Carousels: Image Badge', 'saasland-core' );
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
            case 'img_badge':
                return 'LINE';
            default:
                return '';
        }
    }
}