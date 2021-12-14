<?php
namespace SaaslandCore\WPML;

use WPML_Elementor_Module_With_Items;

/**
 * Counter integration
 */

defined( 'ABSPATH' ) || die();

class Counter extends WPML_Elementor_Module_With_Items  {

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
        return ['label', 'count_value', 'count_append'];
    }

    /**
     * @param string $field
     * @return string
     */
    protected function get_title( $field ) {
        switch ( $field ) {
            case 'label':
                return __( 'Counter: Label', 'saasland-core' );
            case 'count_value':
                return __( 'Counter: Count Value', 'saasland-core' );
            case 'count_append':
                return __( 'Counter: Count Append Text', 'saasland-core' );
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
            case 'label':
                return 'LINE';
            case 'count_value':
                return 'LINE';
            case 'count_append':
                return 'LINE';
            default:
                return '';
        }
    }
}