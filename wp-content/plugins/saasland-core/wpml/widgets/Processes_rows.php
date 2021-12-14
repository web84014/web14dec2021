<?php
namespace SaaslandCore\WPML;

use WPML_Elementor_Module_With_Items;

/**
 * Processes Rows
 */

defined( 'ABSPATH' ) || die();

class Processes_rows extends WPML_Elementor_Module_With_Items  {
    /**
     * @return string
     */
    public function get_items_field() {
        return 'rows';
    }

    /**
     * @return array
     */
    public function get_fields() {
        return ['title', 'subtitle', 'btn_title'];
    }

    /**
     * @param string $field
     * @return string
     */
    protected function get_title( $field ) {
        switch ( $field ) {
            case 'title':
                return __( 'Process: Title', 'saasland-core' );
            case 'subtitle':
                return __( 'Process: Subtitle', 'saasland-core' );
            case 'btn_title':
                return __( 'Process: Button Title', 'saasland-core' );
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
                return 'LINE';
            case 'btn_title':
                return 'LINE';
            default:
                return '';
        }
    }
}