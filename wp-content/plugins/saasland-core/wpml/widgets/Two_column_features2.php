<?php
namespace SaaslandCore\WPML;

use WPML_Elementor_Module_With_Items;

defined( 'ABSPATH' ) || die();

/**
 * Class Two_column_features2
 * @package SaaslandCore\WPML
 */
class Two_column_features2 extends WPML_Elementor_Module_With_Items  {

    /**
     * @return string
     */
    public function get_items_field() {
        return 'features2';
    }

    /**
     * @return array
     */
    public function get_fields() {
        return ['title', 'Subtitle'];
    }

    /**
     * @param string $field
     * @return string
     */
    protected function get_title( $field ) {
        switch ( $field ) {
            case 'title':
                return __( 'Two Column Feature: Title', 'saasland-core' );
            case 'Subtitle':
                return __( 'Two Column Feature: Subtitle', 'saasland-core' );
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
            case 'Subtitle':
                return 'AREA';
            default:
                return '';
        }
    }
}
