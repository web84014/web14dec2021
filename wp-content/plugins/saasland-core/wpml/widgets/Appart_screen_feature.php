<?php
namespace SaaslandCore\WPML;

use WPML_Elementor_Module_With_Items;

/**
 * Screen Features integration
 */

defined( 'ABSPATH' ) || die();

class Appart_screen_feature extends WPML_Elementor_Module_With_Items  {

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
        return ['title', 'desc'];
    }

    /**
     * @param string $field
     * @return string
     */
    protected function get_title( $field ) {
        switch ( $field ) {
            case 'title':
                return __( 'Screen Features: Title', 'saasland-core' );
            case 'desc':
                return __( 'Screen Features: Description', 'saasland-core' );
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
            case 'desc':
                return 'AREA';
            default:
                return '';
        }
    }
}
