<?php
/**
 * @package droitelementoraddonspro
 * @developer DroitLab Team
 *
 */

namespace DROIT_ELEMENTOR_PRO;
use DROIT_ELEMENTOR_PRO\Core\Utils as Pro_Utils;

if ( ! defined( 'ABSPATH' ) ) {exit;}

class Enqueue_Manager{
    public $notice;
    /**
     * Constructor
     * @since 1.0.0
     * @access private
     * Feature added by : DroitLab Team
     */
    public function __construct(){
        $this->init_hooks();
    }

    /**
     * Action hooks
     * @since 1.0.0
     * @access private
     * Feature added by : DroitLab Team
     */
    public function init_hooks(){
        add_filter( 'droit_addons_pro_style', [ __CLASS__, 'droit_pro_widgets_file_path' ], 10, 3 );

        add_action( 'wp_enqueue_scripts', [ __CLASS__, 'droit_pro_frontend_file_load' ] );

        add_action( 'droit_enqueue_assets', [ __CLASS__, 'droit_pro_frontend_enqueue' ] );
    }

    /**
     * Load Style Script
     * @since 1.0.0
     * @access private
     * Feature added by : DroitLab Team
     */
    public static function droit_pro_widgets_file_path( $file_path, $file_name, $is_pro ) {
        if ( $is_pro ) {
             $file_path = DROIT_EL_PRO_PATH . "includes/Elements/{$file_name}/scripts/dl_{$file_name}.min.css";
        }
        return $file_path;
    }
    /**
     * Droit Elementor Front Scripts
     * @return string
     * Feature added by : DroitLab Team
     * @since : 1.0.0
     */
    public static function droit_pro_frontend_file_load() {
        
        $min_suffix = droit_addons_script_debug() ? '.' : '.min';
        
        //editor
        wp_register_style(
            'droit-addons-pro',
             Pro_Utils::droit_pro_protocol( '/assets/css/editor-pro'. $min_suffix .'.css' ),
            ['elementor-frontend'],
            Pro_Utils::droit_el_pro_version()
        );
        
        wp_register_script(
            "droit-addons-pro",
            Pro_Utils::droit_pro_protocol( '/assets/js/droit-addons-pro.js' ),
           ['jquery'],
           Pro_Utils::droit_el_pro_version(),
            true
        );   
    }

    /**
     * Droit Elementor Front Enqueue
     * @param Post_CSS $file
     * @return string
     * Feature added by : DroitLab Team
     * @since : 1.0.0
     */
    public static function droit_pro_frontend_enqueue( $is_cache ) {
        if ( ! $is_cache ) {
            wp_enqueue_style( 'droit-addons-pro' );
            wp_enqueue_script( 'droit-addons-pro' );
        } else {
            wp_enqueue_script( 'droit-addons-pro' );
        }
    }
}