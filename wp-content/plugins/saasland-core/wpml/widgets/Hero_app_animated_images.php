<?php
namespace SaaslandCore\WPML;

use WPML_Elementor_Module_With_Items;

/**
 * Hero Animated Images integration
 */

defined( 'ABSPATH' ) || die();

class Hero_app_animated_images extends WPML_Elementor_Module_With_Items  {

    /**
     * @return string
     */
    public function get_items_field() {
        return 'animated_images';
    }

    /**
     * @return array
     */
    public function get_fields() {
        return ['image_title'];
    }

    /**
     * @param string $field
     * @return string
     */
    protected function get_title( $field ) {
        switch ( $field ) {
            case 'image_title':
                return __( 'Hero Animated Image: Alt Text', 'saasland-core' );
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
            case 'image_title':
                return 'LINE';
            default:
                return '';
        }
    }
}