<?php
namespace SaaslandCore\WPML;

use WPML_Elementor_Module_With_Items;

defined( 'ABSPATH' ) || die();

/**
 * Class Testimonials3
 * @package SaaslandCore\WPML
 */
class Testimonials3 extends WPML_Elementor_Module_With_Items  {
    /**
     * @return string
     */
    public function get_items_field() {
        return 'testimonials3';
    }

    /**
     * @return array
     */
    public function get_fields() {
        return ['content2', 'name', 'designation'];
    }

    /**
     * @param string $field
     * @return string
     */
    protected function get_title( $field ) {
        switch ( $field ) {
            case 'contents':
                return __( 'Testimonial: Contents', 'saasland-core' );
            case 'name':
                return __( 'Testimonial: Author Name', 'saasland-core' );
            case 'designation':
                return __( 'Testimonial: Author Designation', 'saasland-core' );
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
            case 'name':
                return 'LINE';
            case 'designation':
                return 'LINE';
            default:
                return '';
        }
    }
}