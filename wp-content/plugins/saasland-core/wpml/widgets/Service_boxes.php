<?php
namespace SaaslandCore\WPML;

use WPML_Elementor_Module_With_Items;

/**
 * Service Boxes
 */

defined( 'ABSPATH' ) || die();

class Service_boxes extends WPML_Elementor_Module_With_Items  {
    /**
     * @return string
     */
    public function get_items_field() {
        return 'service_box';
    }

    /**
     * @return array
     */
    public function get_fields() {
        return ['title', 'content', 'link_title'];
    }

    /**
     * @param string $field
     * @return string
     */
    protected function get_title( $field ) {
        switch ( $field ) {
            case 'title':
                return __( 'Service Box: Title', 'saasland-core' );
            case 'content':
                return __( 'Service Box: Contents', 'saasland-core' );
            case 'link_title':
                return __( 'Service Box: Link Title', 'saasland-core' );
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
            case 'content':
                return 'AREA';
            case 'link_title':
                return 'LINE';
            default:
                return '';
        }
    }
}