<?php
namespace SaaslandCore\WPML;

use WPML_Elementor_Module_With_Items;

defined( 'ABSPATH' ) || die();

/**
 * Class Tickets
 * @package SaaslandCore\WPML
 */
class Tickets extends WPML_Elementor_Module_With_Items  {
    /**
     * @return string
     */
    public function get_items_field() {
        return 'tickets';
    }

    /**
     * @return array
     */
    public function get_fields() {
        return ['title', 'subtitle'];
    }

    /**
     * @param string $field
     * @return string
     */
    protected function get_title( $field ) {
        switch ( $field ) {
            case 'title':
                return __( 'Ticket Price Plan: Title', 'saasland-core' );
            case 'subtitle':
                return __( 'Ticket Price Plan: Subtitle', 'saasland-core' );
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
                return 'LINE';
            default:
                return '';
        }
    }
}