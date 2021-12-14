<?php
namespace SaaslandCore\WPML;

use WPML_Elementor_Module_With_Items;

/**
 * Pricing Table
 */

defined( 'ABSPATH' ) || die();

class Appart_pricing_table extends WPML_Elementor_Module_With_Items  {

    /**
     * @return string
     */
    public function get_items_field() {
        return 'tables';
    }

    /**
     * @return array
     */
    public function get_fields() {
        return ['title', 'sub_title', 'currency', 'price', 'duration', 'list_items', 'try_btn_label', 'purchase_btn_label'];
    }

    /**
     * @param string $field
     * @return string
     */
    protected function get_title( $field ) {
        switch ( $field ) {
            case 'title':
                return __( 'Pricing Table: Title', 'saasland-core' );
            case 'sub_title':
                return __( 'Pricing Table: Subtitle', 'saasland-core' );
            case 'currency':
                return __( 'Pricing Table: Currency', 'saasland-core' );
            case 'price':
                return __( 'Pricing Table: Price', 'saasland-core' );
            case 'duration':
                return __( 'Pricing Table: Duration', 'saasland-core' );
            case 'list_items':
                return __( 'Pricing Table: List items', 'saasland-core' );
            case 'try_btn_label':
                return __( 'Pricing Table: Button Title', 'saasland-core' );
            case 'purchase_btn_label':
                return __( 'Pricing Table: Purchase Button Title', 'saasland-core' );
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
            case 'sub_title':
                return 'LINE';
            case 'currency':
                return 'LINE';
            case 'price':
                return 'LINE';
            case 'duration':
                return 'LINE';
            case 'list_items':
                return 'AREA';
            case 'purchase_btn_label':
                return 'LINE';
            default:
                return '';
        }
    }
}
