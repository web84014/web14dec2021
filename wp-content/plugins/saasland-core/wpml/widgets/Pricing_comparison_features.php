<?php
namespace SaaslandCore\WPML;

use WPML_Elementor_Module_With_Items;

/**
 * Pricing Table Comparison Features
 */

defined( 'ABSPATH' ) || die();

class Pricing_comparison_features extends WPML_Elementor_Module_With_Items  {
    /**
     * @return string
     */
    public function get_items_field() {
        return 'features';
    }

    /**
     * @return array
     */
    public function get_fields() {
        return ['feature_item', 'tooltip'];
    }

    /**
     * @param string $field
     * @return string
     */
    protected function get_title( $field ) {
        switch ( $field ) {
            case 'feature_item':
                return __( 'Pricing Comparison Feature: Title', 'saasland-core' );
            case 'tooltip':
                return __( 'Pricing Comparison Feature: Tooltip Text', 'saasland-core' );
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
            case 'feature_item':
                return 'LINE';
            case 'tooltip':
                return 'AREA';
            default:
                return '';
        }
    }
}