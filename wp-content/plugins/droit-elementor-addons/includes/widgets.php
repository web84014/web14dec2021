<?php
namespace DROIT_ELEMENTOR\Manager;
defined( 'ABSPATH' ) || exit;

class Widgets{

    private static $instance;

    private static $elementor;

    private $widgets = [];


    public function init(){
        $cssFiles = drdt_core()->widgets_dir . 'widgets.css';
        if( filesize($cssFiles) == 0 || DROIT_ADDONS_CSS_RENDER_){
            add_action('init', [$this, 'render_css']);
        }
        add_action('dlAddons/admin/ajax/after', [$this, 'render_css']);

        if ( defined( 'ELEMENTOR_VERSION' ) && is_callable( '\Elementor\Plugin::instance' ) ) {
            self::$elementor = \Elementor\Plugin::instance();
            add_action( 'elementor/elements/categories_registered', [$this, 'register_category'] );
            add_action( 'elementor/widgets/widgets_registered', [$this, 'register_widgets' ] );
            add_action( 'elementor/frontend/before_render', [$this, 'render_attributes'] );

            // load script global
            add_action('elementor/frontend/before_register_scripts', [$this, 'script_load'], 998);
            add_action('wp_enqueue_scripts', [$this, 'script_load'], 999);

            // add pro widgets
            add_filter('dlAddons/widgets/mapping', [ $this, 'pro_widgets_maping']);
            
        }


    }

    public static function widgets_map(){

        return apply_filters('dlAddons/widgets/mapping', [
            'accordion' => [
                '_key'        => 'accordion',
                '_title'      => __( 'Accordion', 'droit-addons' ),
                '_icon'       => 'dlicons-accordian',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => false,
                'css'     => ['accordion'],
                'js'      => [],
                'vendor' => [
                    'css' => [],
                    'js'  => [],
                ],
            ],

            'alert' => [
                '_key'        => 'alert',
                '_title'      => __( 'Alert', 'droit-addons' ),
                '_icon'       => 'dlicons-alert',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => false,
                'css'     => ['alert'],
                'js'      => [],
                'vendor' => [
                    'css' => [],
                    'js'  => [],
                ],
            ],

            'animated_text' => [
                '_key'        => 'animated-text',
                '_title'      => __( 'Animated Text', 'droit-addons' ),
                '_icon'       => 'dlicons-animated-title',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => false,
                'css'     => ['animated_text'],
                'js'      => [],
                'vendor' => [
                    'css' => [],
                    'js'  => ['animated_text'],
                ],
            ],

            'blog' => [
                '_key'        => 'blog',
                '_title'      => __( 'Blog', 'droit-addons' ),
                '_icon'       => 'dlicons-blog-post',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => false,
                'css'     => ['blog'],
                'js'      => [],
                'vendor' => [
                    'css' => [],
                    'js'  => ['jquery-imagesloaded', 'jquery-isotope', 'isotope-mode', 'jquery-masonary'],
                ],
            ],
            'bloglist' => [
                '_key'        => 'bloglist',
                '_title'      => __( 'Blog List', 'droit-addons' ),
                '_icon'       => 'dlicons-blog',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => false,
                'css'     => ['bloglist'],
                'js'      => [],
                'vendor' => [
                    'css' => [],
                    'js'  => [],
                ],
            ],
            'card' => [
                '_key'        => 'card',
                '_title'      => __( 'Card', 'droit-addons' ),
                '_icon'       => 'dlicons-card',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => false,
                'css'     => ['card'],
                'js'      => [],
                'vendor' => [
                    'css' => [],
                    'js'  => ['jquery-parallax-move']
                ],
            ],
            'countdown' => [
                '_key'        => 'countdown',
                '_title'      => __( 'Countdown', 'droit-addons' ),
                '_icon'       => 'dlicons-countdown',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => false,
                'css'     => ['countdown'],
                'js'      => [],
                'vendor' => [
                    'css' => [],
                    'js'  => ['countdown-jquery']
                ],
            ],
            
            'faq' => [
                '_key'        => 'faq',
                '_title'      => __( 'Faq', 'droit-addons' ),
                '_icon'       => 'dlicons-faq',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => false,
                'css'     => ['faq'],
                'js'      => [],
                'vendor' => [
                    'css' => [],
                    'js'  => []
                ],
            ],
            'infobox' => [
                '_key'        => 'infobox',
                '_title'      => __( 'Info Box', 'droit-addons' ),
                '_icon'       => 'dlicons-inforbox icon',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => false,
                'css'     => ['infobox'],
                'js'      => [],
                'vendor' => [
                    'css' => [],
                    'js'  => [],
                ],
            ],
            'iconbox' => [
                '_key'        => 'iconbox',
                '_title'      => __( 'Icon Box', 'droit-addons' ),
                '_icon'       => 'dlicons-iconbox',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => false,
                'css'     => ['iconbox'],
                'js'      => [],
                'vendor' => [
                    'css' => [],
                    'js'  => [],
                ],
            ], 
            'image_carousel' => [
                '_key'        => 'image-carousel',
                '_title'      => __( 'Image Carousel', 'droit-addons' ),
                '_icon'       => 'dlicons-image-carosel',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => false,
                'css'     => ['image_carousel'],
                'js'      => [],
                'vendor' => [
                    'css' => ['swiper'],
                    'js'  => ['swiper']
                ],
            ],
            'newstricker' => [
                '_key'        => 'newstricker',
                '_title'      => __( 'News Sticker', 'droit-addons' ),
                '_icon'       => 'dlicons-newsticky',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => false,
                'css'     => ['newstricker'],
                'js'      => [],
                'vendor' => [
                    'css' => [],
                    'js'  => [],
                ],
            ], 
            'pricing' => [
                '_key'        => 'pricing',
                '_title'      => __( 'Pricing', 'droit-addons' ),
                '_icon'       => 'dlicons-pricing-Table',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => false,
                'css'     => ['pricing'],
                'js'      => [],
                'vendor' => [
                    'css' => [],
                    'js'  => []
                ],
            ], 
            'process' => [
                '_key'        => 'process',
                '_title'      => __( 'Process Bar', 'droit-addons' ),
                '_icon'       => 'dlicons-process',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => false,
                'css'     => ['process'],
                'js'      => [],
                'vendor' => [
                    'css' => [],
                    'js'  => []
                ],
            ],
            'share_buttons' => [
                '_key'        => 'share-buttons',
                '_title'      => __( 'Share Button', 'droit-addons' ),
                '_icon'       => 'dlicons-social-share',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => false,
                'css'     => ['share_buttons'],
                'js'      => [],
                'vendor' => [
                    'css' => [],
                    'js'  => ['dl-goodshare']
                ],
            ],
            'tab' => [
                '_key'        => 'tab',
                '_title'      => __( 'Tab', 'droit-addons' ),
                '_icon'       => 'dlicons-Tab',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => false,
                'css'     => ['tab'],
                'js'      => [],
                'vendor' => [
                    'css' => [],
                    'js'  => []
                ],
            ],
            'team' => [
                '_key'        => 'team',
                '_title'      => __( 'Team Member', 'droit-addons' ),
                '_icon'       => 'dlicons-Team',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => false,
                'css'     => ['team'],
                'js'      => [],
                'vendor' => [
                    'css' => [],
                    'js'  => []
                ],
            ],
            'testimonial' => [
                '_key'        => 'testimonial',
                '_title'      => __( 'Testimonial', 'droit-addons' ),
                '_icon'       => 'dlicons-quote',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => false,
                'css'     => ['testimonial'],
                'js'      => [],
                'vendor' => [
                    'css' => ['swiper'],
                    'js'  => ['swiper']
                ],
            ],
            'timeline' => [
                '_key'        => 'timeline',
                '_title'      => __( 'Timeline', 'droit-addons' ),
                '_icon'       => 'dlicons-timeline',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => false,
                'css'     => ['timeline'],
                'js'      => [],
                'vendor' => [
                    'css' => ['owl-carousel'],
                    'js'  => ['owl-carousel'],
                ],
            ],

            'table' => [
                '_key'        => 'table',
                '_title'      => __( 'Table', 'droit-addons' ),
                '_icon'       => 'dlicons-table',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => false,
                'css'     => ['table'],
                'js'      => [],
                'vendor' => [
                    'css' => [],
                    'js'  => [],
                ],
            ],
            'title' => [
                '_key'        => 'title',
                '_title'      => __( 'Title', 'droit-addons' ),
                '_icon'       => 'eicon-post-title',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => false,
                'css'     => ['title'],
                'js'      => [],
                'vendor' => [
                    'css' => [],
                    'js'  => [],
                ],
            ],

            'google_map' => [
                '_key'        => 'google-map',
                '_title'      => __( 'Google Map', 'droit-addons' ),
                '_icon'       => 'eicon-google-maps',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => false,
                'css'     => [],
                'js'      => [],
                'vendor' => [
                    'css' => [''],
                    'js'  => ['']
                ],
            ],

            'twitter_feed' => [
                '_key'        => 'twitter-feed',
                '_title'      => __( 'Twitter Feed', 'droit-addons' ),
                '_icon'       => 'eicon-twitter-embed',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => false,
                'css'     => [],
                'js'      => [], 
                'vendor' => [
                    'css' => [],
                    'js'  => []
                ],
            ],
            
            'ninjaform' => [
                '_key'        => 'ninjaform',
                '_title'      => __( 'Ninja Form', 'droit-addons' ),
                '_icon'       => 'dlicons-contact-form',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => false,
                'css'     => [],
                'js'      => [], 
                'vendor' => [
                    'css' => [],
                    'js'  => []
                ],
            ],

            'weform' => [
                '_key'        => 'weform',
                '_title'      => __( 'weForm', 'droit-addons' ),
                '_icon'       => 'dlicons-contact-form',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => false,
                'css'     => [],
                'js'      => [],
                'vendor' => [
                    'css' => [],
                    'js'  => []
                ],
            ],
            'contact_form_7' => [
                '_key'        => 'contact-form-7',
                '_title'      => __( 'Contact Form 7', 'droit-addons' ),
                '_icon'       => 'dlicons-contact-form',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => false,
                'css'     => ['contact_form_7'],
                'js'      => [],
                'vendor' => [
                    'css' => [],
                    'js'  => []
                ],
            ],

            'caldera_form' => [
                '_key'        => 'caldera-form',
                '_title'      => __( 'Caldera Form', 'droit-addons' ),
                '_icon'       => 'dlicons-contact-form',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => false,
                'css'     => [],
                'js'      => [],
                'vendor' => [
                    'css' => [],
                    'js'  => []
                ],
            ],

            'gravity_form' => [
                '_key'        => 'gravity-form',
                '_title'      => __( 'Gravity Form', 'droit-addons' ),
                '_icon'       => 'dlicons-contact-form',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => false,
                'css'     => [],
                'js'      => [],
                'vendor' => [
                    'css' => [],
                    'js'  => []
                ],
            ],

            'wpform' => [
                '_key'        => 'wpform',
                '_title'      => __( 'WPForm', 'droit-addons' ),
                '_icon'       => 'dlicons-contact-form',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => false,
                'css'     => [],
                'js'      => [],
                'vendor' => [
                    'css' => [],
                    'js'  => []
                ],
            ],

            'product_list' => [
                '_key'        => 'product-list',
                '_title'      => __( 'Product List', 'droit-addons' ),
                '_icon'       => 'eicon-post-title',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => false,
                'css'     => ['product_list'],
                'js'      => [],
                'vendor' => [
                    'css' => [],
                    'js'  => [],
                ],
            ],
            // start bar charts
            'bar_chart' => [
                '_key'        => 'bar-chart',
                '_title'      => __( 'Bar Chart', 'droit-addons' ),
                '_icon'       => 'dlpro dlpro-bar-chart',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => false,
                'css'     => ['bar_chart'],
                'js'      => [],
                'vendor' => [
                    'css' => [],
                    'js'  => ['chart-js'],
                ],
            ],

            'product_grid' => [
                '_key'        => 'product-grid',
                '_title'      => __( 'Product Grid', 'droit-addons' ),
                '_icon'       => 'eicon-products',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => false,
                'css'     => ['product_grid'],
                'js'      => [],
                'vendor' => [
                    'css' => [],
                    'js'  => [],
                ],
            ],
            'subscribe' => [
                '_key'        => 'subscribe',
                '_title'      => __( 'Subscribe', 'droit-addons' ),
                '_icon'       => 'eicon-post-title',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => false,
                'css'     => [],
                'js'      => [],
                'vendor' => [
                    'css' => [],
                    'js'  => [],
                ],
            ],
            'progress_bar' => [
                '_key'        => 'progress-bar',
                '_title'      => __( 'Progress Bar', 'droit-addons' ),
                '_icon'       => 'eicon-post-title',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => false,
                'css'     => [],
                'js'      => [],
                'vendor' => [
                    'css' => [],
                    'js'  => [],
                ],
            ],
            'skill_bar' => [
                '_key'        => 'skill-bar',
                '_title'      => __( 'Skill Bar', 'droit-addons' ),
                '_icon'       => 'eicon-post-title',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => false,
                'css'     => [],
                'js'      => [],
                'vendor' => [
                    'css' => [],
                    'js'  => [],
                ],
            ],

        ]);
    }

    public function register_widgets(){

        $this->widgets = self::widgets_map();
        $widgetsOption = drdt_manager()->widgets->widgets_data();

        if( !empty($this->widgets) ){
            foreach($this->widgets as $k => $v){

                if ( !in_array($k, $widgetsOption)) {
                    continue;
                }
                $key  = isset($v['_key']) ? $v['_key'] : $k;
                $files = drdt_core()->widgets_dir . strtolower($key) .'/'. strtolower($key) .'.php';
               
                $clsssName = str_replace([' ', '-', ''], '_', ucwords(str_replace([' ', '-', ''], ' ', $key)) );
                
                $class = "\DROIT_ELEMENTOR\Widgets\Droit_Addons_".$clsssName;
                $class2 = "\DROIT_ELEMENTOR_PRO\Widgets\Droit_Addons_".$clsssName;

                if( did_action('droitPro/loaded') && get_option('__validate_author_dtaddons__', false) ){
                    $file = drdt_core()->widgets_pro_dir . strtolower($key) .'/'. strtolower($key) .'.php';
                    if ( is_readable( $file)) {
                       $files = $file;
                       $class = $class2;
                    }
                    
                    $control = drdt_core()->widgets_pro_dir . strtolower($key) .'/'. strtolower($key) . '-control.php';
                    if( is_readable($control) && is_file($control) ){
                        require_once( $control );
                    }
                    $module = drdt_core()->widgets_pro_dir . strtolower($key) .'/'. strtolower($key) . '-module.php';
                    if( is_readable($module) && is_file($module) ){
                        require_once( $module );
                    }
                } 

                $control = drdt_core()->widgets_dir . strtolower($key) .'/'. strtolower($key) . '-control.php';
                if( is_readable($control) && is_file($control) ){
                    require_once( $control );
                }
                $module = drdt_core()->widgets_dir . strtolower($key) .'/'. strtolower($key) . '-module.php';
                if( is_readable($module) && is_file($module) ){
                    require_once( $module );
                }
                
                if( !is_readable($files) || !is_file($files) ){
                    continue;
                }

                require_once( $files );

                if( class_exists($class) ){
                    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new $class() );
                }
                
            }
        }
    }

    public function register_category(){
        if( !empty( $this->category_map() ) ){
            foreach($this->category_map() as $k=>$v){
                \Elementor\Plugin::$instance->elements_manager->add_category(
                    $k,
                    [
                        'title' => esc_html__( $v, 'droit-addons' ),
                        'icon'  => 'fa fa-plug',
                    ]
                );
            }
        }
    }

    public function category_map(){
        return apply_filters('dlAddons/category/mapping', [
            'droit_addons' => __('DROIT ADDONS', 'droit-addons'),
            'droit_addons_pro' => __('DROIT PRO', 'droit-addons')
        ]);
    }

    public function render_attributes( \Elementor\Element_Base $widget ){
        if ( $widget->get_data( 'widgetType' ) === 'global' && method_exists( $widget, 'get_original_element_instance' ) ) {
            $original_instance = $widget->get_original_element_instance();
            if ( method_exists( $original_instance, 'get_html_wrapper_class' ) && strpos( $original_instance->get_data( 'widgetType' ), 'droit-' ) !== false ) {
                $widget->add_render_attribute( '_wrapper', [
                    'class' => $original_instance->get_html_wrapper_class(),
                ] );
            }
        }
    }

    public function script_load(){
        
        // load global widgets css
        wp_enqueue_style('dlAddons-widgets', drdt_core()->widgets . 'widgets.css', [], drdt_core()->version);   
        
        do_action('dlAddons/widgets/css/enqueue/before');


        $widgetsOption = drdt_manager()->widgets->widgets_data();

        // load js files
        $this->widgets = self::widgets_map();
        if( !empty($this->widgets) ){
            foreach($this->widgets as $k=>$v){

                if ( !in_array($k, $widgetsOption)) {
                    continue;
                }
                $key  = isset($v['_key']) ? $v['_key'] : $k;

                $js_arr = isset($v['js']) ? $v['js'] : [];
                $js_vendor = isset($v['vendor']['js']) ? $v['vendor']['js'] : [];
                $css_vendor = isset($v['vendor']['css']) ? $v['vendor']['css'] : [];
                // js vendor loading
                if( !empty($js_vendor) ){
                    foreach($js_vendor as $jv){
                        wp_enqueue_script($jv);
                    }
                }
                // css vendor
                if( !empty($css_vendor) ){
                    foreach($css_vendor as $cv){
                        wp_enqueue_style($cv);
                    }
                }
                
                $files_default = 'dl_'.strtolower( str_replace(['-', ' '], ['_', ''], $k) ).'.min.js';
                if( !in_array($files_default, $js_arr) ){
                    array_push($js_arr, $files_default);
                }

                if( empty($js_arr) ){
                    continue;
                }
                $m = 1;
                foreach($js_arr as $cs){
                    $exp = explode('.', $cs);
                    if( end($exp) != 'js'){
                        $cs = $cs.'.js';
                    }
                    $files = drdt_core()->widgets_dir . strtolower($key) .'/scripts/' . $cs;
                    if( is_readable($files) && is_file($files) ){
                        wp_enqueue_script('dlAddons-' . strtolower($key) . '-'.$m, drdt_core()->widgets . strtolower($k) .'/scripts/' . $cs, [], drdt_core()->version, true);
                        $m++;
                    }
                    if( did_action('droitPro/loaded') ){
                        $filesPro = drdt_core()->widgets_pro_dir . strtolower($key) .'/scripts/' . $cs;
                        if( is_readable($filesPro) && is_file($filesPro) ){
                            wp_enqueue_script('dlAddons' . strtolower($key) . '-'.$m, drdt_core()->widgets_pro . strtolower($k) .'/scripts/' . $cs, [], drdt_core()->version, true);
                            $m++;
                        }
                    }
                }

            }
        }

        do_action('dlAddons/widgets/css/enqueue/after');

        // load global widgets js
        wp_enqueue_script('dlAddons-widgets', drdt_core()->widgets . 'widgets.js', ['imagesloaded', 'jquery'], drdt_core()->version, true);
        wp_localize_script(
            'dlAddons-widgets',
            'dlAddons',
            array(
                'ajax_url' => admin_url('admin-ajax.php'),
                'admin_url' => admin_url('post.php'),
                'wp_nonce' => wp_create_nonce('dlAddons_widget_nonce'),
            )
        );

        do_action('dlAddons/widgets/css/enqueue/end');

    }

    public function render_css(){

        $cssFiles = drdt_core()->widgets_dir . 'widgets.css';
       
        $widgetsOption = drdt_manager()->widgets->widgets_data();

        $this->widgets = self::widgets_map();
        $css = '';
        if( !empty($this->widgets) ){
            foreach($this->widgets as $k=>$v){
                if ( !in_array($k, $widgetsOption)) {
                    continue;
                }
                $key  = isset($v['_key']) ? $v['_key'] : $k;

                $css_arr = isset($v['css']) ? $v['css'] : [];
                
                // default css load
                $files_default = 'dl_'.strtolower( str_replace(['-', ' '], ['_', ''], $k) ).'.min.css';
                
                if( !in_array($files_default, $css_arr) ){
                    array_push($css_arr, $files_default);
                }
                if( !empty($css_arr) ){
                    foreach($css_arr as $cs){
                        $exp = explode('.', $cs);
                        if( end($exp) != 'css'){
                            $cs = $cs.'.css';
                        }
                        $files = drdt_core()->widgets_dir . strtolower($key) .'/scripts/' . $cs;
                        if( is_readable($files) && is_file($files) ){
                            $css .= file_get_contents($files);
                        }

                        if( did_action('droitPro/loaded') ){
                            $filesPro = drdt_core()->widgets_pro_dir . strtolower($key) .'/scripts/' . $cs;
                            if( is_readable($filesPro) && is_file($filesPro) ){
                                $css .= file_get_contents($filesPro);
                            }
                        }
                    }
                    
                }
            }
        }

        do_action('dlAddons/widgets/css/render/before', $css, $cssFiles);

        $save_options = get_option( drdt_manager()->ajax::$option_keys, true);
        $autominify = ($save_options['enable_minify']) ? true : false;
        
        if( DROIT_ADDONS_CSS_RENDER_MINIFY || $autominify){
            $css = drdt_manager()->enqueue::css_minify($css);
        }
        
        do_action('dlAddons/widgets/css/render/after', $css, $cssFiles);

        file_put_contents($cssFiles, $css);
        return $css;
    }

    public function widgets_data(){
        $save_options = get_option( drdt_manager()->ajax::$option_keys, true);
        return isset($save_options['widgets']) ? $save_options['widgets'] : [
            'accordion', 'alert', 'animated_text', 'banner', 'blog', 'bloglist', 'card', 'countdown', 'contact_form_7', 'faq', 'infobox', 'iconbox', 'image_carousel', 'newstricker', 'pricing', 'process', 'share_buttons', 'tab', 'team', 'timeline', 'twitter_feed', 'table', 'title'
        ];
    }

    public function pro_widgets_maping( $widgets ){
        $newWidgtes = apply_filters('dlAddons/widgetsPro/mapping',  [
            'advanced_accordion' => [
                '_key'        => 'advanced-accordion',
                '_title'      => __( 'Advanced Accordion', 'droit-addons-pro' ),
                '_icon'       => 'dlicons-accordian',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => true,
                'css'     => ['advanced_accordion'],
                'js'      => [],
                'vendor' => [
                    'css' => [],
                    'js'  => [],
                ],
            ],
            
            'blogs_grid' => [
                '_key'        => 'blogs-grid',
                '_title'      => __( 'Post Grid', 'droit-addons-pro' ),
                '_icon'       => 'dlicons-blog-post',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => true,
                'css'     => ['blogs_grid'],
                'js'      => [],
                'vendor' => [
                    'css' => [],
                    'js'  => [],
                ],
            ],
            'advanced_button' => [
                '_key'        => 'advanced-button',
                '_title'      => __( 'Advanced Button', 'droit-addons-pro' ),
                '_icon'       => 'eicon-button',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => true,
                'css'     => ['advanced_button'],
                'js'      => [],
                'vendor' => [
                    'css' => [],
                    'js'  => [],
                ],
            ],
            'breadcrumbs' => [
                '_key'        => 'breadcrumbs',
                '_title'      => __( 'Breadcrumbs', 'droit-addons-pro' ),
                '_icon'       => 'eicon-product-breadcrumbs',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => true,
                'css'     => ['breadcrumbs'],
                'js'      => [],
                'vendor' => [
                    'css' => [],
                    'js'  => [],
                ],
            ],
            'dual_button' => [
                '_key'        => 'dual-button',
                '_title'      => __( 'Dual Button', 'droit-addons-pro' ),
                '_icon'       => 'eicon-dual-button',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => true,
                'css'     => ['dual_button'],
                'js'      => [],
                'vendor' => [
                    'css' => [],
                    'js'  => [],
                ],
            ],
            'card_pro' => [
                '_key'        => 'card-pro',
                '_title'      => __( 'Card Pro', 'droit-addons-pro' ),
                '_icon'       => 'dlicons-card',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => true,
                'css'     => ['card_pro'],
                'js'      => [],
                'vendor' => [
                    'css' => [],
                    'js'  => [],
                ],
            ],
            
            'fun_fact' => [
                '_key'        => 'fun-fact',
                '_title'      => __( 'Fun Fact', 'droit-addons-pro' ),
                '_icon'       => 'eicon-number-field',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => true,
                'css'     => ['fun_fact'],
                'js'      => [],
                'vendor' => [
                    'css' => [],
                    'js'  => ['waypoints-jquery' ,'counterup-jquery'],
                ],
            ],
            'image_compare' => [
                '_key'        => 'image-compare',
                '_title'      => __( 'Image Compare', 'droit-addons-pro' ),
                '_icon'       => 'eicon-image-before-after',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => true,
                'css'     => ['image_compare'],
                'js'      => [],
                'vendor' => [
                    'css' => ['compare_style'],
                    'js'  => ['compare_imagesloaded', 'compare_move', 'compare_script'],
                ],
            ],
            
            'advanced_tab' => [
                '_key'        => 'advanced-tab',
                '_title'      => __( 'Advanced Tab', 'droit-addons-pro' ),
                '_icon'       => 'dlicons-Tab',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => true,
                'css'     => ['advanced_tab'],
                'js'      => [],
                'vendor' => [
                    'css' => [],
                    'js'  => []
                ],
            ],
            'team_pro' => [
                '_key'        => 'team-pro',
                '_title'      => __( 'Team Pro', 'droit-addons-pro' ),
                '_icon'       => 'dlicons-Team',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => true,
                'css'     => ['team_pro'],
                'js'      => [],
                'vendor' => [
                    'css' => [],
                    'js'  => []
                ],
            ],
            'testimonial_pro' => [
                '_key'        => 'testimonial-pro',
                '_title'      => __( 'Testimonial Pro', 'droit-addons-pro' ),
                '_icon'       => 'dlicons-quote',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => true,
                'css'     => ['testimonial_pro'],
                'js'      => [],
                'vendor' => [
                    'css' => ['swiper'],
                    'js'  => ['swiper']
                ],
            ],
            
            'subscriber' => [
                '_key'        => 'subscriber',
                '_title'      => __( 'Subscriber', 'droit-addons-pro' ),
                '_icon'       => 'eicon-form-horizontal',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => true,
                'css'     => ['subscriber'],
                'js'      => [],
                'vendor' => [
                    'css' => [],
                    'js'  => ['dl_addons_subscriber']
                ],
            ], 
            'advance_pricing' => [
                '_key'        => 'advance-pricing',
                '_title'      => __( 'Pricing With Switch', 'droit-addons-pro' ),
                '_icon'       => 'dlicons-pricing-Table addons-icon',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => true,
                'css'     => ['advance_pricing'],
                'js'      => [],
                'vendor' => [
                    'css' => [],
                    'js'  => []
                ],
            ], 
            'advance_slider' => [
                '_key'        => 'advance-slider',
                '_title'      => __( 'Advanced Slider', 'droit-addons-pro' ),
                '_icon'       => 'eicon-slider-3d',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => true,
                'css'     => ['advance_slider'],
                'js'      => [],
                'vendor' => [
                    'css' => ['swiper'],
                    'js'  => ['swiper']
                ],
            ], 
            'video_popup' => [
                '_key'        => 'video-popup',
                '_title'      => __( 'Video Popup', 'droit-addons-pro' ),
                '_icon'       => 'eicon-video-playlist',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => true,
                'css'     => ['video_popup'],
                'js'      => [],
                'vendor' => [
                    'css' => [''],
                    'js'  => ['magnific']
                ],
            ],
            
            'pricing_pro' => [
                '_key'        => 'pricing-pro',
                '_title'      => __( 'Pricing Pro', 'droit-addons-pro' ),
                '_icon'       => 'eicon-price-table',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => true,
                'css'     => ['pricing_pro'],
                'js'      => [],
                'vendor' => [
                    'css' => [''],
                    'js'  => ['']
                ],
            ],
            
            'animated_image' => [
                '_key'        => 'animated-image',
                '_title'      => __( 'Animated Image', 'droit-addons-pro' ),
                '_icon'       => 'eicon-animation addons-icon',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => true,
                'css'     => ['animated_image'],
                'js'      => [],
                'vendor' => [
                    'css' => [''],
                    'js'  => ['']
                ],
            ],
            'process_pro' => [
                '_key'        => 'process-pro',
                '_title'      => __( 'Process Pro', 'droit-addons-pro' ),
                '_icon'       => 'dlicons-process',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => true,
                'css'     => ['process_pro'],
                'js'      => [],
                'vendor' => [
                    'css' => [''],
                    'js'  => ['']
                ],
            ],
            'timeline_pro' => [
                '_key'        => 'timeline-pro',
                '_title'      => __( 'Timeline Pro', 'droit-addons-pro' ),
                '_icon'       => 'dlicons-timeline',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => true,
                'css'     => ['timeline_pro'],
                'js'      => [],
                'vendor' => [
                    'css' => [''],
                    'js'  => ['']
                ],
            ],
            'timeline_slider' => [
                '_key'        => 'timeline-slider',
                '_title'      => __( 'Timeline Slider', 'droit-elementor-addons-pro' ),
                '_icon'       => 'dlicons-social-share',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => true,
                'css'     => [],
                'js'      => [],
                'vendor' => [
                    'css' => [''],
                    'js'  => ['']
                ],
            ],
            'animate_title_pro' => [
                '_key'        => 'animate-title-pro',
                '_title'      => __( 'Animated Title', 'droit-addons-pro' ),
                '_icon'       => 'eicon-animated-headline',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => true,
                'css'     => ['animated_title_pro'],
                'js'      => [],
                'vendor' => [
                    'css' => [''],
                    'js'  => ['animated_text']
                ],
            ],

            'post_slider_pro' => [
                '_key'        => 'post-slider-pro',
                '_title'      => __( 'Post Slider Pro', 'droit-addons-pro' ),
                '_icon'       => 'eicon-slider-push',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => true,
                'css'     => ['post_slider_pro'],
                'js'      => [],
                'vendor' => [
                    'css' => ['swiper'],
                    'js'  => ['swiper']
                ],
            ],

            'post_filter_pro' => [
                '_key'        => 'post-filter-pro',
                '_title'      => __( 'Post Filter Pro', 'droit-elementor-addons-pro' ),
                '_icon'       => 'eicon-gallery-masonry',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => true,
                'css'     => ['post_filter_pro'],
                'js'      => [], 
                'vendor' => [
                    'css' => [],
                    'js'  => []
                ],
            ],

            'twitter_feed_pro' => [
                '_key'        => 'twitter-feed-pro',
                '_title'      => __( 'Twitter Feed Pro', 'droit-addons-pro' ),
                '_icon'       => 'eicon-twitter-embed',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => true,
                'css'     => [],
                'js'      => [], 
                'vendor' => [
                    'css' => [],
                    'js'  => []
                ],
            ],

            'pinterest_feed' => [
                '_key'        => 'pinterest-feed',
                '_title'      => __( 'Pinterest Feed', 'droit-addons-pro' ),
                '_icon'       => 'eicon-pinterest',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => true,
                'css'     => ['dl_pinterest_feed'],
                'js'      => [],
               
            ],

            'dribble_feed' => [
                '_key'        => 'dribble-feed',
                '_title'      => __( 'Dribble Feed', 'droit-addons-pro' ),
                '_icon'       => 'eicon-globe',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => true,
                'css'     => [],
                'js'      => [],
                
            ],

            'comparison_table' => [
                '_key'        => 'comparison-table',
                '_title'      => __( 'Comparison Table', 'droit-addons-pro' ),
                '_icon'       => 'eicon-table',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => true,
                'css'     => [],
                'js'      => [],
                'vendor' => [
                    'css' => [''],
                    'js'  => ['']
                ],
            ],

            'google_map_pro' => [
                '_key'        => 'google-map-pro',
                '_title'      => __( 'Google Map Pro', 'droit-addons-pro' ),
                '_icon'       => 'eicon-google-maps',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => true,
                'css'     => [],
                'js'      => [],
                'vendor' => [
                    'css' => [''],
                    'js'  => ['']
                ],
            ],

            'flip_box_pro' => [
                '_key'        => 'flip-box-pro',
                '_title'      => __( 'Flip Box', 'droit-addons-pro' ),
                '_icon'       => 'eicon-flip-box',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => true,
                'css'     => [],
                'js'      => [],
                'vendor' => [
                    'css' => [''],
                    'js'  => ['']
                ],
            ],

            'popup' => [
                '_key'        => 'popup',
                '_title'      => __( 'Popup Modal', 'droit-addons-pro' ),
                '_icon'       => 'eicon-preview-medium',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => true,
                'css'     => [],
                'js'      => [],
                'vendor' => [
                    'css' => [''],
                    'js'  => ['']
                ],
            ],

            'woo_list' => [
                '_key'        => 'woo-list',
                '_title'      => __( 'Woo List', 'droit-addons-pro' ),
                '_icon'       => 'eicon-editor-list-ul',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => true,
                'css'     => [],
                'js'      => [],
                'vendor' => [
                    'css' => [],
                    'js'  => [],
                ],
            ],
            
            'woo_slider' => [
                '_key'          => 'woo-slider',
                '_title'        => __( 'Woo Slider', 'droit-addons-pro' ),
                '_icon'         => 'eicon-slider-device',
                '_icon_class'   => 'icon_bg_color',
                '_demo_url'     => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'    => true,
                'css'           => [],
                'js'            => [],
                'vendor' => [
                    'css' => ['swiper'],
                    'js'  => ['swiper']
                ],
            ],
            
            'woo_filter' => [
                '_key'          => 'woo-filter',
                '_title'        => __( 'Woo Filter', 'droit-addons-pro' ),
                '_icon'         => 'eicon-filter',
                '_icon_class'   => 'icon_bg_color',
                '_demo_url'     => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'    => true,
                'css'           => [],
                'js'            => [],
                'vendor' => [
                    'css' => [],
                    'js'  => []
                ],
            ],

            // start charts here
            'line_chart' => [
                '_key'        => 'line-chart',
                '_title'      => __( 'Line Chart', 'droit-addons' ),
                '_icon'       => 'dlpro dlpro-Line-Chart',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => true,
                'css'         => [],
                'js'          => [],
                'vendor'      => [
                    'css' => [],
                    'js'  => ['chart-js'],
                ],
            ],

            'pie_chart' => [
                '_key'        => 'pie-chart',
                '_title'      => __( 'Pie/Doughnut Chart', 'droit-addons' ),
                '_icon'       => 'dlpro dlpro-Pie-Chart',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => true,
                'css'         => [],
                'js'          => [],
                'vendor'      => [
                    'css' => [],
                    'js'  => ['chart-js'],
                ],
            ],

            'radar_chart' => [
                '_key'        => 'radar-chart',
                '_title'      => __( 'Radar Chart', 'droit-addons' ),
                '_icon'       => 'dlpro dlpro-Polar-Chart',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => true,
                'css'         => [],
                'js'          => [],
                'vendor'      => [
                    'css' => [],
                    'js'  => ['chart-js'],
                ],
            ],
            
            'polararea_chart' => [
                '_key'        => 'polararea-chart',
                '_title'      => __( 'Polar Area Chart', 'droit-addons' ),
                '_icon'       => 'dlpro dlpro-Radar-Chart',
                '_icon_class' => 'icon_bg_color',
                '_demo_url'   => 'https://droitthemes.com/droit-elementor-addons/',
                '_droit_pro'  => true,
                'css'         => [],
                'js'          => [],
                'vendor'      => [
                    'css' => [],
                    'js'  => ['chart-js'],
                ],
            ],
            
        ]);
        
        return array_merge($widgets, $newWidgtes);
    }
    
    public static function instance(){
        if ( is_null( self::$instance ) ){
            self::$instance = new self();
        }
        return self::$instance;
    }

}