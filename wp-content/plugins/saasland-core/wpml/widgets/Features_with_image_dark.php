<?php
namespace SaaslandCore\WPML;

use WPML_Elementor_Module_With_Items;

/**
 * Features with Image (Dark) integration
 */

defined( 'ABSPATH' ) || die();

class Features_with_image_dark extends WPML_Elementor_Module_With_Items  {

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
        return ['title', 'subtitle', 'btn_label'];
    }

    /**
     * @param string $field
     * @return string
     */
    protected function get_title( $field ) {
        switch ( $field ) {
            case 'title':
                return __( 'Features (Dark): Title', 'saasland-core' );
            case 'subtitle':
                return __( 'Features (Dark): Subtitle', 'saasland-core' );
            case 'btn_label':
                return __( 'Features (Dark): Button Title', 'saasland-core' );
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
                return 'AREA';
            case 'btn_label':
                return 'LINE';
            default:
                return '';
        }
    }
}
