<?php
namespace SaaslandCore\WPML;

use WPML_Elementor_Module_With_Items;

/**
 * Locations
 */

defined( 'ABSPATH' ) || die();

class Map3_locations extends WPML_Elementor_Module_With_Items  {
    /**
     * @return string
     */
    public function get_items_field() {
        return 'locations';
    }

    /**
     * @return array
     */
    public function get_fields() {
        return ['place_name'];
    }

    /**
     * @param string $field
     * @return string
     */
    protected function get_title( $field ) {
        switch ( $field ) {
            case 'place_name':
                return __( 'Locations: Place Name', 'saasland-core' );
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
            case 'place_name':
                return 'LINE';
            default:
                return '';
        }
    }
}