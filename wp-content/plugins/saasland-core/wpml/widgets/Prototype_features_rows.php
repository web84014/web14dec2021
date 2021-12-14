<?php
namespace SaaslandCore\WPML;

use WPML_Elementor_Module_With_Items;

/**
 * Prototype Features Rows
 */

defined( 'ABSPATH' ) || die();

class Prototype_features_rows extends WPML_Elementor_Module_With_Items  {
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
        return ['title', 'subtitle'];
    }

    /**
     * @param string $field
     * @return string
     */
    protected function get_title( $field ) {
        switch ( $field ) {
            case 'title':
                return __( 'Prototype Feature: Title', 'saasland-core' );
            case 'subtitle':
                return __( 'Prototype Feature: Subtitle', 'saasland-core' );
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