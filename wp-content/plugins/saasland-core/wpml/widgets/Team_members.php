<?php
namespace SaaslandCore\WPML;

use WPML_Elementor_Module_With_Items;

defined( 'ABSPATH' ) || die();

/**
 * Class Team_members
 * @package SaaslandCore\WPML
 */
class Team_members extends WPML_Elementor_Module_With_Items  {
    /**
     * @return string
     */
    public function get_items_field() {
        return 'members';
    }

    /**
     * @return array
     */
    public function get_fields() {
        return ['name', 'designation'];
    }

    /**
     * @param string $field
     * @return string
     */
    protected function get_title( $field ) {
        switch ( $field ) {
            case 'name':
                return __( 'Team: Name', 'saasland-core' );
            case 'designation':
                return __( 'Table Tab: Designation', 'saasland-core' );
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
            default:
                return '';
        }
    }
}