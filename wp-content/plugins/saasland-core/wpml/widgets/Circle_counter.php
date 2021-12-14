<?php
namespace SaaslandCore\WPML;

use WPML_Elementor_Module_With_Items;

/**
 * Circle Counter integration
 */

defined( 'ABSPATH' ) || die();

class Circle_counter extends WPML_Elementor_Module_With_Items  {

    /**
     * @return string
     */
    public function get_items_field() {
        return 'counters';
    }

    /**
     * @return array
     */
    public function get_fields() {
        return ['title', 'subtitle'];
    }

    /**
     * @param string $field
     * @return string
     */
    protected function get_title( $field ) {
        switch ( $field ) {
            case 'title':
                return __( 'Circle Counter: Title', 'saasland-core' );
            case 'subtitle':
                return __( 'Circle Counter: Subtitle', 'saasland-core' );
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
            case 'subtitle':
                return 'AREA';
            default:
                return '';
        }
    }
}