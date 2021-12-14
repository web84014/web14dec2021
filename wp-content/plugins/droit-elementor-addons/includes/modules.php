<?php
namespace DROIT_ELEMENTOR\Manager;
defined( 'ABSPATH' ) || exit;

class Modules{

    private static $instance;

    public function init(){
        // load modules control
        $data = drdt_manager()->modules->modules_data();

        do_action('dlAddons/modules/before', $data);

        // load sticky 
        if( in_array('sticky', $data) ){
            \DROIT_ELEMENTOR\DL_Sticky::instance()->init();
        }
        
         // icons loading
         if( in_array('droit_icons', $data) ){
            \DROIT_ELEMENTOR\Module\Controls\Icons\Droit_Icons::instance()->load();
        }

        //common sections
        if( in_array('droit_section', $data) ){
            \DROIT_ELEMENTOR\Module\Extention\Common_Section::instance()->load();
        }

        //custom column
        if( in_array('custom_column', $data) ){
            \DROIT_ELEMENTOR\Module\Extention\Custom_Column::instance()->load();
        }

        // generate font
        if(current_user_can('manage_options') && DROIT_ADDONS_ICON_RENDER){
           \DROIT_ELEMENTOR\Module\Controls\Icons\Droit_Icons::instance()->generate_font();
        }

        // parallax
        if( in_array('back_parallax', $data) ){
            \DROIT_ELEMENTOR\Module\Back_Parallax::instance()->init();
        }

        // templates
        \DROIT_ELEMENTOR\Templates\DL_Import::instance()->load();
        \DROIT_ELEMENTOR\Templates\Dl_Load::instance()->load();
        \DROIT_ELEMENTOR\Templates\DL_Templates::instance()->init();
        
        do_action('dlAddons/modules/after', $data);
        
    }

    public function modules_data(){
        $save_options = get_option( drdt_manager()->ajax::$option_keys, true);
        return isset($save_options['modules']) ? $save_options['modules'] : [
            'droit_icons', 'droit_section', 'custom_column', 'sticky'
        ];
    }

    public static function modules_map(){
        return apply_filters('dlAddons/modules/mapping', [
            'sticky' => [
                'title' => __('Sticky Section', 'droit-addons'),
                'icon' => 'dlpro dlpro-sticky-section',
                'is_pro' => false,
            ],
            'droit_icons' => [
                'title' => __('Icons', 'droit-addons'),
                'icon' => 'dlpro dlpro-icon',
                'is_pro' => false,
            ],

            'droit_section' => [
                'title' => __('Section Link', 'droit-addons'),
                'icon' => 'dlpro dlpro-section-link',
                'is_pro' => false,
            ],

            'custom_column' => [
                'title' => __('Custom Column', 'droit-addons'),
                'icon' => 'dlpro dlpro-custom-column',
                'is_pro' => false,
            ],
            'clone' => [
                'title' => __('Droit Clone', 'droit-addons-pro'),
                'icon' => 'dlpro dlpro-droit-copy',
                'is_pro' => true,
            ],
            'parallax' => [
                'title' => __('Parallax', 'droit-addons-pro'),
                'icon' => 'dlpro dlpro-paralax',
                'is_pro' => true,
            ],
            'lottie' => [
                'title' => __('Lottie', 'droit-addons-pro'),
                'icon' => 'dlpro dlpro-lottie',
                'is_pro' => true,
            ],
            'one_page_scroll' => [
                'title' => __('One/Full Page Scroll', 'droit-addons-pro'),
                'icon' => 'dlpro dlpro-one-page-scroll',
                'is_pro' => true,
            ],
            'dl_effect' => [
                'title' => __('CSS Effect', 'droit-addons-pro'),
                'icon' => 'dlpro dlpro-css-effect',
                'is_pro' => true,
            ],
            'dl_transform' => [
                'title' => __('CSS Transform', 'droit-addons-pro'),
                'icon' => 'dlpro dlpro-css-transformation',
                'is_pro' => true,
            ],
           
            'dl_custom_css' => [
                'title' => __('Custom Css', 'droit-addons-pro'),
                'icon' => 'dlpro dlpro-custom-css',
                'is_pro' => true,
            ],
            'header_footer' => [
                'title' => __('Header / Footer & MegaMenu', 'droit-addons-pro'),
                'icon' => 'dlpro dlpro-header-footer',
                'is_pro' => true,
            ],
            'popup_builder' => [
                'title' => __('Popup Builder', 'droit-addons-pro'),
                'icon' => 'dlpro dlpro-pop-up',
                'is_pro' => true,
            ],
            'live_copy' => [
                'title' => __('Live Copy /  paste', 'droit-addons-pro'),
                'icon' => 'dlpro dlpro-live-copy-paste',
                'is_pro' => true,
            ],
            'woocommerce' => [
                'title' => __('Woocommerce Swatch', 'droit-addons-pro'),
                'icon' => 'dlpro dlpro-swatches',
                'is_pro' => true,
            ],
            'back_parallax' => [
                'title' => __('Background Parallax', 'droit-addons-pro'),
                'icon' => 'dlpro dlpro-paralax',
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