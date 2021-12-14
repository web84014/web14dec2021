<?php
namespace SaaslandCore\WPML;

use WPML_Elementor_Module_With_Items;

/**
 * Testimonials Style integration
 */

defined( 'ABSPATH' ) || die();

class Appart_testimonials extends WPML_Elementor_Module_With_Items  {

    /**
     * @return string
     */
    public function get_items_field() {
        return 'testimonials';
    }

    /**
     * @return array
     */
    public function get_fields() {
        return ['author_name', 'author_designation', 'quote'];
    }

    /**
     * @param string $field
     * @return string
     */
    protected function get_title( $field ) {
        switch ( $field ) {
            case 'author_name':
                return __( 'Testimonials Style: Author Name', 'saasland-core' );
            case 'rating_label':
                return __( 'Testimonials Style: Rating label', 'saasland-core' );
            case 'quote':
                return __( 'Testimonials Style: Quote Text', 'saasland-core');
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
            case 'author_name':
                return 'LINE';
            case 'author_designation':
                return 'LINE';
            case 'quote':
                return 'AREA';
            default:
                return '';
        }
    }
}
