<?php
namespace SaaslandCore\WPML;

use WPML_Elementor_Module_With_Items;

defined( 'ABSPATH' ) || die();

/**
 * Class Table_tabs
 * @package SaaslandCore\WPML
 */
class Table_tabs extends WPML_Elementor_Module_With_Items  {
    /**
     * @return string
     */
    public function get_items_field() {
        return 'tabs';
    }

    /**
     * @return array
     */
    public function get_fields() {
        return ['tab_title', 'table_subtitle', 'table_contents'];
    }

    /**
     * @param string $field
     * @return string
     */
    protected function get_title( $field ) {
        switch ( $field ) {
            case 'tab_title':
                return __( 'Table Tab: Title', 'saasland-core' );
            case 'table_subtitle':
                return __( 'Table Tab: Subtitle', 'saasland-core' );
            case 'table_contents':
                return __( 'Table Tab: Contents', 'saasland-core' );
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
            case 'tab_title':
                return 'LINE';
            case 'table_subtitle':
                return 'AREA';
            case 'table_contents':
                return 'VISUAL';
            default:
                return '';
        }
    }
}