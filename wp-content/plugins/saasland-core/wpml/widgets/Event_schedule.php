<?php
namespace SaaslandCore\WPML;

use WPML_Elementor_Module_With_Items;

/**
 * Event Schedule integration
 */

defined( 'ABSPATH' ) || die();

class Event_schedule extends WPML_Elementor_Module_With_Items  {

    /**
     * @return string
     */
    public function get_items_field() {
        return 'event_tabs';
    }

    /**
     * @return array
     */
    public function get_fields() {
        return ['tab_title', 'schedule_title', 'author_name', 'event_contents'];
    }

    /**
     * @param string $field
     * @return string
     */
    protected function get_title( $field ) {
        switch ( $field ) {
            case 'tab_title':
                return __( 'Event Schedule Tabs: Tab Title', 'saasland-core' );
            case 'schedule_title':
                return __( 'Event Schedule Tabs: Schedule Title', 'saasland-core' );
            case 'author_name':
                return __( 'Event Schedule Tabs: Author Name', 'saasland-core' );
            case 'event_contents':
                return __( 'Event Schedule Tabs: Contents', 'saasland-core' );
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
            case 'schedule_title':
                return 'LINE';
            case 'author_name':
                return 'LINE';
            case 'event_contents':
                return 'AREA';
            default:
                return '';
        }
    }
}