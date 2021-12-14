<?php
namespace SaaslandCore\WPML;

use WPML_Elementor_Module_With_Items;

/**
 * Pricing Tables
 */

defined( 'ABSPATH' ) || die();

class Pricing_tables extends WPML_Elementor_Module_With_Items  {
    /**
     * @return string
     */
    public function get_items_field() {
        return 'info_items';
    }

    /**
     * @return array
     */
    public function get_fields() {
        return ['title', 'subtitle', 'price', 'duration', 'contents', 'btn_label'];
    }

    /**
     * @param string $field
     * @return string
     */
    protected function get_title( $field ) {
        switch ( $field ) {
            case 'title':
                return __( 'Pricing Table: Title', 'saasland-core' );
            case 'subtitle':
                return __( 'Pricing Table: Subtitle', 'saasland-core' );
            case 'ribbon_label':
                return __( 'Pricing Table: Ribbon Label', 'saasland-core' );
            case 'price':
                return __( 'Pricing Table: Price', 'saasland-core' );
            case 'duration':
                return __( 'Pricing Table: Duration', 'saasland-core' );
            case 'contents':
                return __( 'Pricing Table: List items', 'saasland-core' );
            case 'btn_label':
                return __( 'Pricing Table: Button Label', 'saasland-core' );
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
            case 'price':
                return 'LINE';
            case 'duration':
                return 'LINE';
            case 'contents':
                return 'AREA';
            case 'btn_label':
                return 'LINE';
            default:
                return '';
        }
    }
}