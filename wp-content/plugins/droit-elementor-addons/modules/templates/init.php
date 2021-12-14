<?php
namespace DROIT_ELEMENTOR\Templates;

defined('ABSPATH') || die();

class DL_Templates
{
    private static $instance = null;

    public static function url(){
        if (defined('DROIT_ADDONS_FILE_')) {
            $file = trailingslashit(plugin_dir_url( DROIT_ADDONS_FILE_ )). 'modules/templates/';
        } else {
            $file = trailingslashit(plugin_dir_url( __FILE__ ));
        }
        return $file;
    }

    public static function dir(){
        if (defined('DROIT_ADDONS_FILE_')) {
            $file = trailingslashit(plugin_dir_path( DROIT_ADDONS_FILE_ )). 'modules/templates/';
        } else {
            $file = trailingslashit(plugin_dir_path( __FILE__ ));
        }
        return $file;
    }

    public static function version(){
        if( defined('DROIT_ADDONS_VERSION_') ){
            return DROIT_ADDONS_VERSION_;
        } else {
            return apply_filters('dladdons_pro_version', '1.0.0');
        }
        
    }

    public function init()
    {
        add_action( 'wp_enqueue_scripts', function() {       
            wp_enqueue_style( "droit-el-template-front", self::url() . 'assets/css/template-frontend.min.css' , ['elementor-frontend'], self::version() );  
            } 
        );
        
        add_action( 'elementor/editor/after_enqueue_scripts', function() {     
            wp_enqueue_style( "dlAdd-template-editor", self::url() . 'assets/css/template-library.min.css' , ['elementor-editor'], self::version() );  
            wp_enqueue_script("dlAdd-template-editor", self::url() . 'assets/js/template-library.min.js', ['elementor-editor'], self::version(), true); 
            $pro = get_option('__validate_author_dtaddons__', false);
            
            $localize_data = [
                'hasPro'                          => !$pro ? false : true,
                'templateLogo'                    => self::url() . 'assets/template_logo.svg',
                'i18n' => [
                    'templatesEmptyTitle'       => esc_html__( 'No Templates Found', 'droit-addons' ),
                    'templatesEmptyMessage'     => esc_html__( 'Try different category or sync for new templates.', 'droit-addons' ),
                    'templatesNoResultsTitle'   => esc_html__( 'No Results Found', 'droit-addons' ),
                    'templatesNoResultsMessage' => esc_html__( 'Please make sure your search is spelled correctly or try a different words.', 'droit-addons' ),
                ],
                'tab_style' => json_encode(self::get_tabs()),
                'default_tab' => 'section'
            ];
            wp_localize_script(
                'dlAdd-template-editor',
                'droitEditor',
                $localize_data
            );

            } 
        );

        add_action( 'elementor/preview/enqueue_styles', function(){
            $data = '.elementor-add-new-section .dl_templates_add_button {
                background-color: #6045bc;
                margin-left: 5px;
                font-size: 18px;
                vertical-align: bottom;
            }
            ';
            wp_add_inline_style( 'droit-el-template-front', $data );
        } );
    }

    public static function get_tabs(){
        return apply_filters('dl_editor/templates_tabs', [
            'section' => [ 'title' => 'Blocks'],
            'page' => [ 'title' => 'Ready Pages'],
        ]);
    }
    public static function instance(){
        if( is_null(self::$instance) ){
            self::$instance = new self();
        }
        return self::$instance;
    }
}

