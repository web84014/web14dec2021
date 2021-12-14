<?php
namespace SaaslandCore\WPML;

use WPML_Elementor_Module_With_Items;

/**
 * Saasland Slider Slides
 */

defined( 'ABSPATH' ) || die();

class Slider_slides extends WPML_Elementor_Module_With_Items  {
    /**
     * @return string
     */
    public function get_items_field() {
        return 'slides';
    }

    /**
     * @return array
     */
    public function get_fields() {
        return ['content', 'btn_label', 'btn2_label'];
    }

    /**
     * @param string $field
     * @return string
     */
    protected function get_title( $field ) {
        switch ( $field ) {
            case 'content':
                return __( 'Saasland Slider: Content', 'saasland-core' );
            case 'btn_label':
                return __( 'Saasland Slider: Button Label', 'saasland-core' );
            case 'btn2_label':
                return __( 'Saasland Slider: Button 02 Label', 'saasland-core' );
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
            case 'btn_label':
                return 'LINE';
            case 'btn2_label':
                return 'LINE';
            default:
                return '';
        }
    }
}