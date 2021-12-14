<?php
namespace SaaslandCore\WPML;

use WPML_Elementor_Module_With_Items;

/**
 * Bar Chart integration
 */

defined( 'ABSPATH' ) || die();

class Features_tabs extends WPML_Elementor_Module_With_Items  {

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
        return ['tab_title', 'tab_subtitle'];
    }

    /**
     * @param string $field
     * @return string
     */
    protected function get_title( $field ) {
        switch ( $field ) {
            case 'tab_title':
                return __( 'Features Tabs: Tab Title', 'saasland-core' );
            case 'tab_subtitle':
                return __( 'Features Tabs: Tab Subtitle', 'saasland-core' );
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
            case 'tab_title':
                return 'LINE';
            case 'tab_subtitle':
                return 'AREA';
            default:
                return '';
        }
    }
}
