<?php
namespace DROIT_ELEMENTOR\Manager;
defined( 'ABSPATH' ) || exit;

class Enqueue{

    private static $instance;

    public function register(){
        
        if(current_user_can('manage_options')){
            // admin script
            add_action( 'admin_enqueue_scripts', [ $this , 'admin_enqueue'] );
        }

        // public script
        if ( defined( 'ELEMENTOR_VERSION' ) && is_callable( '\Elementor\Plugin::instance' ) ) {
            add_action('elementor/editor/after_enqueue_scripts', [$this, 'public_enqueue'], 9997);
            add_action('elementor/frontend/before_register_scripts', [$this, 'public_enqueue'], 9998);
        }
        add_action( 'wp_enqueue_scripts', [ $this , 'public_enqueue'], 9999);
        
    }

    public function admin_enqueue(){
        
        do_action('dlAddons/admin/enqueue/before');

        wp_register_script( 'droit-settings', drdt_core()->js . 'settings' . drdt_core()->suffix . '.js', ['jquery'], drdt_core()->version, true ); 
        wp_localize_script(
            'droit-settings',
            'dtdr',
            [
                'ajax_url'           => admin_url( 'admin-ajax.php' ),
                'rest_url'           => get_rest_url(),
            ]
        );
        wp_register_script( 'droit-ajax-chimp', drdt_core()->vendor . 'mailchimp/ajax-chimp' . drdt_core()->minify . '.js', ['jquery'], drdt_core()->version, true ); 
        wp_register_script( 'droit-plugins', drdt_core()->js . 'plugins' . drdt_core()->minify . '.js', ['jquery'], drdt_core()->version, true ); 
        wp_register_script( 'droit-global', drdt_core()->js . 'global' . drdt_core()->minify . '.js', ['jquery'], drdt_core()->version, true ); 
        wp_localize_script(
            'droit-global',
            'DroitGlobal',
            [
                'version'        => DROIT_ADDONS_VERSION_,
                'has_pro'        => did_action('droitPro/loaded') ? true : false,
            ]
        );

        wp_register_style( 'font-awesome', drdt_core()->assets . 'font-awesome/css/all.css', false, drdt_core()->version );
        wp_register_style( 'droit-settings', drdt_core()->css . 'settings' . drdt_core()->suffix . '.css', false, drdt_core()->version );
        wp_register_style( 'droit-icons', drdt_core()->css . 'icons' . drdt_core()->minify . '.css', false, drdt_core()->version );
        wp_register_style( 'droit-plugins', drdt_core()->css . 'plugins' . drdt_core()->minify . '.css', false, drdt_core()->version );
        wp_register_style( 'droit-global', drdt_core()->css . 'global' . drdt_core()->minify . '.css', false, drdt_core()->version );
        

        $screen = get_current_screen();
        
        if( in_array($screen->id, [ 'toplevel_page_droit-addons', 'droit-addons_page_droit-pro', 'droit-addons_page_droit-addons-upgrade']) ){
            //style
            wp_enqueue_style('font-awesome');
            wp_enqueue_style('droit-icons');
            wp_enqueue_style('droit-plugins');
            wp_enqueue_style('droit-settings');
           
            //script
            wp_enqueue_script('droit-ajax-chimp');
            wp_enqueue_script('droit-plugins');
            wp_enqueue_script('droit-settings');
        }
       
        //Global;
        wp_enqueue_style('droit-global');
        wp_enqueue_script('droit-global');

        do_action('dlAddons/admin/enqueue/after');

    }

    public function public_enqueue(){
        do_action('dlAddons/public/enqueue/before');

        // common css
        wp_enqueue_style( 'droit-icons', drdt_core()->css . 'icons' . drdt_core()->minify . '.css', [], drdt_core()->version );
        wp_enqueue_style( 'droit-common', drdt_core()->css . 'editor-common' . drdt_core()->minify . '.css', [], drdt_core()->version );
        wp_enqueue_style( 'droit-widget', drdt_core()->css . 'widget' . drdt_core()->minify . '.css', [], drdt_core()->version );
        wp_enqueue_style( 'droit-animate', drdt_core()->vendor . 'animation/animate' . drdt_core()->minify . '.css', [], drdt_core()->version );
        wp_enqueue_style( 'reset', drdt_core()->vendor . 'reset' . drdt_core()->minify . '.css', [], drdt_core()->version );
        wp_enqueue_style( 'grid', drdt_core()->vendor . 'grid' . drdt_core()->minify . '.css', [], drdt_core()->version );
        wp_enqueue_style( 'button', drdt_core()->vendor . 'button' . drdt_core()->minify . '.css', [], drdt_core()->version );
        
        wp_register_style( 'owl-carousel', drdt_core()->vendor . 'owl_carousel/css/owl.carousel.css', [], drdt_core()->version );
        wp_register_style( 'swiper', drdt_core()->vendor . 'swiper/swiper.min.css', [], drdt_core()->version );
        wp_register_script( 'chart-js', drdt_core()->vendor . 'chart/chart.js', ['jquery'], drdt_core()->version, true ); 
        
        // common js
        wp_register_script( 'owl-carousel', drdt_core()->vendor . 'owl_carousel/js/owl.carousel.min.js', ['jquery'], drdt_core()->version, true ); 
        wp_register_script( 'swiper', drdt_core()->vendor . 'swiper/swiper.min.js', ['jquery'], drdt_core()->version, true ); 
        wp_register_script( 'jquery-parallax-move', drdt_core()->vendor . 'parallax/parallax_move.js', ['jquery'], drdt_core()->version, true ); 
        wp_register_script( 'jquery-parallax', drdt_core()->vendor . 'parallax/jquery.parallax-scroll.js', ['jquery'], drdt_core()->version, true ); 
        wp_register_script( 'jquery-imagesloaded', drdt_core()->vendor . 'imagesloaded/imagesloaded.pkgd.min.js', ['jquery'], drdt_core()->version, true ); 
        wp_register_script( 'jquery-isotope', drdt_core()->vendor . 'isotop/isotope.pkgd.min.js', ['jquery'], drdt_core()->version, true ); 
        wp_register_script( 'isotope-mode', drdt_core()->vendor . 'isotop/packery-mode.pkgd.min.js', ['jquery'], drdt_core()->version, true ); 
        wp_register_script( 'jquery-masonary', drdt_core()->vendor . 'masonry/masonry_grid.js', ['jquery'], drdt_core()->version, true ); 
        wp_register_script( 'countdown-jquery', drdt_core()->vendor . 'countdown/countdown.min.js', ['jquery'], drdt_core()->version, true ); 
        wp_register_script( 'dl-goodshare', drdt_core()->vendor . 'goodshare/goodshare.min.js', ['jquery'], drdt_core()->version, true ); 
        wp_register_script( 'animated_text', drdt_core()->vendor . 'animation/animated_heading.js', ['jquery'], drdt_core()->version, true ); 
        
        do_action('dlAddons/public/enqueue/after'); 
    }

    public static function css_minify($input){
        if(trim($input) === "") return $input;
        return preg_replace(
            array(
                // Remove comment(s)
                '#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')|\/\*(?!\!)(?>.*?\*\/)|^\s*|\s*$#s',
                // Remove unused white-space(s)
                '#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\'|\/\*(?>.*?\*\/))|\s*+;\s*+(})\s*+|\s*+([*$~^|]?+=|[{};,>~]|\s(?![0-9\.])|!important\b)\s*+|([[(:])\s++|\s++([])])|\s++(:)\s*+(?!(?>[^{}"\']++|"(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')*+{)|^\s++|\s++\z|(\s)\s+#si',
                // Replace `0(cm|em|ex|in|mm|pc|pt|px|vh|vw|%)` with `0`
                '#(?<=[\s:])(0)(cm|em|ex|in|mm|pc|pt|px|vh|vw|%)#si',
                // Replace `:0 0 0 0` with `:0`
                '#:(0\s+0|0\s+0\s+0\s+0)(?=[;\}]|\!important)#i',
                // Replace `background-position:0` with `background-position:0 0`
                '#(background-position):0(?=[;\}])#si',
                // Replace `0.6` with `.6`, but only when preceded by `:`, `,`, `-` or a white-space
                '#(?<=[\s:,\-])0+\.(\d+)#s',
                // Minify string value
                '#(\/\*(?>.*?\*\/))|(?<!content\:)([\'"])([a-z_][a-z0-9\-_]*?)\2(?=[\s\{\}\];,])#si',
                '#(\/\*(?>.*?\*\/))|(\burl\()([\'"])([^\s]+?)\3(\))#si',
                // Minify HEX color code
                '#(?<=[\s:,\-]\#)([a-f0-6]+)\1([a-f0-6]+)\2([a-f0-6]+)\3#i',
                // Replace `(border|outline):none` with `(border|outline):0`
                '#(?<=[\{;])(border|outline):none(?=[;\}\!])#',
                // Remove empty selector(s)
                '#(\/\*(?>.*?\*\/))|(^|[\{\}])(?:[^\s\{\}]+)\{\}#s'
            ),
            array(
                '$1',
                '$1$2$3$4$5$6$7',
                '$1',
                ':0',
                '$1:0 0',
                '.$1',
                '$1$3',
                '$1$2$4$5',
                '$1$2$3',
                '$1:0',
                '$1$2'
            ),
        $input);
    }

    
    public static function instance(){
        if ( is_null( self::$instance ) ){
            self::$instance = new self();
        }
        return self::$instance;
    }
}

