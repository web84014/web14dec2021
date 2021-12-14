<?php
namespace SaaslandCore\WPML;

use WPML_Elementor_Module_With_Items;

defined( 'ABSPATH' ) || die();

/**
 * Class Two_column_features
 * @package SaaslandCore\WPML
 */
class Two_column_features extends WPML_Elementor_Module_With_Items  {

    /**
     * @return string
     */
    public function get_items_field() {
        return 'features3';
    }

    /**
     * @return array
     */
    public function get_fields() {
        return ['contents'];
    }

    /**
     * @param string $field
     * @return string
     */
    protected function get_title( $field ) {
        switch ( $field ) {
            case 'contents':
                return __( 'Two Column Feature: Title', 'saasland-core' );
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
            case 'contents':
                return 'AREA';
            default:
                return '';
        }
    }
}
