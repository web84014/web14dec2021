<?php
namespace SaaslandCore\WPML;

use WPML_Elementor_Module_With_Items;

/**
 * Serialized Feature List
 */

defined( 'ABSPATH' ) || die();

class Serialized_feature_list extends WPML_Elementor_Module_With_Items  {
    /**
     * @return string
     */
    public function get_items_field() {
        return 'feature_list';
    }

    /**
     * @return array
     */
    public function get_fields() {
        return ['title', 'contents'];
    }

    /**
     * @param string $field
     * @return string
     */
    protected function get_title( $field ) {
        switch ( $field ) {
            case 'title':
                return __( 'Prototype Feature: Title', 'saasland-core' );
            case 'contents':
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
            case 'contents':
                return 'AREA';
            default:
                return '';
        }
    }
}