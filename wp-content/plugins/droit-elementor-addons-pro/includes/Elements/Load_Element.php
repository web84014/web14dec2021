<?php
/**
 * @package droitelementoraddonspro
 * @developer DroitLab Team
 *
 */
 
namespace DROIT_ELEMENTOR_PRO\Elements;

use DROIT_ELEMENTOR\Core\Utils as Droit_Utils;
use DROIT_ELEMENTOR_PRO\Core\Utils as Pro_Utils;

if ( ! defined( 'ABSPATH' ) ) {exit;}

class Load_Element{

    /**
     * Constructor
     * @since 1.0.0
     * @access private
     * Feature added by : DroitLab Team
     */
    public function __construct(){
        add_filter( 'droit_pro_cache_widgets_map', [ __CLASS__, 'droit_addons_cache_widget_map' ] );
        add_filter( 'add_droit_elementor_addons', [__CLASS__, 'droit_addons_widget_map' ] );
        add_action( 'elementor/widgets/widgets_registered', [$this, 'droit_pro_widget_register'] );   
    }
    /**
     * Droit Elementor Cache Widgets Marge
     * @return
     * Feature added by : DroitLab Team
     * @since : 1.0.0
     */
    public static function droit_addons_cache_widget_map( $widgets ) {
        return array_merge( $widgets, self::droit_addons_widget_cache_pro() );
    }
    /**
     * Droit Elementor Widgets Cache
     * @return
     * Feature added by : DroitLab Team
     * @since : 1.0.0
     */
    public static function droit_addons_widget_cache_pro() {
        $elements = [
            
        ];
        return $elements;
    }

    /**
     * Droit Elementor Widgets Marge
     * @return
     * Feature added by : DroitLab Team
     * @since : 1.0.0
     */
    public static function droit_addons_widget_map( $widgets ) {
        return array_merge( $widgets, self::droit_addons_widget_map_pro() );
    }
    /**
     * Droit Elementor Widgets Map
     * @return
     * Feature added by : DroitLab Team
     * @since : 1.0.0
     */
    public static function droit_addons_widget_map_pro() {
      $elements = [
            '_pro_content' => [
                '_heading' => __( 'Pro Elements', 'droit-elementor-addons' ),
                'elements' => [
                    
                ],
            ],
        ];
        return $elements;
    }

    /**
     * Droit Elementor Shortcode
     * @return string
     * Feature added by : DroitLab Team
     * @since : 1.0.0
     */
    public function droit_pro_widget_register( $widgets_manager ) {
    
        $load_widget = self::droit_load_pro_widget();
        $active_widgets = Pro_Utils::droit_addons_get_widgets_pro();

        if ( !empty( $active_widgets ) ) {
            foreach ( $active_widgets as $_key ) {
                $class_name = Pro_Utils::droit_pro_widget_classname( $_key );
                if ( class_exists( $class_name ) ) {
                    $widgets_manager->register_widget_type( new $class_name() );
                }
            }
        }
    }
    /**
     * Droit Elementor Load Widget
     * @return string
     * Feature added by : DroitLab Team
     * @since : 1.0.0
     */

    public static function droit_load_pro_widget() {
        $active_widgets = Pro_Utils::droit_addons_get_widgets_pro();
        if ( !empty( $active_widgets ) ) {
            foreach ( $active_widgets as $_key ) {
                $widgets_file = include_once(DROIT_EL_PRO_PATH . 'includes/Elements/' . $_key . '/' . strtolower($_key) . '.php');
                $widgets_module = include_once(DROIT_EL_PRO_PATH . 'includes/Elements/' . $_key . '/' . strtolower($_key) . '_module.php');
                if ( is_readable( $widgets_file && $widgets_module) ) {
                    return;
                }
            }
        }
    }  
}