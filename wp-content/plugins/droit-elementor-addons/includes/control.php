<?php
namespace DROIT_ELEMENTOR\Manager;
defined( 'ABSPATH' ) || exit;

class Control{

    private static $instance;

    public function init(){
        $data = drdt_manager()->control->controls_data();

        do_action('dlAddons/controls/before', $data);
        
        do_action('dlAddons/controls/after', $data);

    }

    public function controls_data(){
        $save_options = get_option( drdt_manager()->ajax::$option_keys, true);
        return isset($save_options['controls']) ? $save_options['controls'] : [];
    }

    public static function controls_map(){
        return apply_filters('dlAddons/controls/mapping', [
            'droit_icons' => [
                'title' => __('Icons', 'droit-addons'),
                'is_pro' => false,
            ],
            
        ]);
    }

    public static function instance(){
        if ( is_null( self::$instance ) ){
            self::$instance = new self();
        }
        return self::$instance;
    }

}