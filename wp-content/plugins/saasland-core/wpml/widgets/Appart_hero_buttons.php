<?php
namespace SaaslandCore\WPML;

use WPML_Elementor_Module_With_Items;

/**
 * App Hero integration
 */

defined( 'ABSPATH' ) || die();

class Appart_hero_buttons extends WPML_Elementor_Module_With_Items  {

    /**
     * @return string
     */
    public function get_items_field() {
        return 'buttons';
    }

    /**
     * @return array
     */
    public function get_fields() {
        return ['label'];
    }

    /**
     * @param string $field
     * @return string
     */
    protected function get_title( $field ) {
        switch ( $field ) {
            case 'label':
                return __( 'App Hero: Button Title', 'saasland-core' );
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
            case 'label':
                return 'LINE';
            default:
                return '';
        }
    }
}