<?php
namespace SaaslandCore\WPML;

use WPML_Elementor_Module_With_Items;

/**
 * Client Logo integration
 */

defined( 'ABSPATH' ) || die();

class Client_logos extends WPML_Elementor_Module_With_Items  {

    /**
     * @return string
     */
    public function get_items_field() {
        return 'logos';
    }

    /**
     * @return array
     */
    public function get_fields() {
        return ['title'];
    }

    /**
     * @param string $field
     * @return string
     */
    protected function get_title( $field ) {
        switch ( $field ) {
            case 'title':
                return __( 'Client Logo: Title', 'saasland-core' );
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
            default:
                return '';
        }
    }
}