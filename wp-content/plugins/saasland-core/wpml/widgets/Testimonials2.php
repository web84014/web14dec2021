<?php
namespace SaaslandCore\WPML;

use WPML_Elementor_Module_With_Items;

defined( 'ABSPATH' ) || die();

/**
 * Class Testimonials2
 * @package SaaslandCore\WPML
 */
class Testimonials2 extends WPML_Elementor_Module_With_Items  {
    /**
     * @return string
     */
    public function get_items_field() {
        return 'testimonials2';
    }

    /**
     * @return array
     */
    public function get_fields() {
        return ['name', 'designation', 'content'];
    }

    /**
     * @param string $field
     * @return string
     */
    protected function get_title( $field ) {
        switch ( $field ) {
            case 'name':
                return __( 'Testimonial: Author Name', 'saasland-core' );
            case 'designation':
                return __( 'Testimonial: Author Designation', 'saasland-core' );
            case 'content':
                return __( 'Testimonial: Testimonial Text', 'saasland-core' );
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
            case 'name':
                return 'LINE';
            case 'designation':
                return 'LINE';
            case 'content':
                return 'AREA';
            default:
                return '';
        }
    }
}