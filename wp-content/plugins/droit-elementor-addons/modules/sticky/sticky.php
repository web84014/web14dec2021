<?php
namespace DROIT_ELEMENTOR;

defined('ABSPATH') || die();

if (!class_exists('DL_Sticky')) {
    class DL_Sticky
    {
        private static $instance = null;

        public static function url(){
            if (defined('DROIT_ADDONS_FILE_')) {
                $file = trailingslashit(plugin_dir_url( DROIT_ADDONS_FILE_ )). 'modules/sticky/';
            } else {
                $file = trailingslashit(plugin_dir_url( __FILE__ ));
            }
            return $file;
        }
    
        public static function dir(){
            if (defined('DROIT_ADDONS_FILE_')) {
                $file = trailingslashit(plugin_dir_path( DROIT_ADDONS_FILE_ )). 'modules/sticky/';
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
                wp_enqueue_style( "dl-sticky-css", self::url() . 'js/sticky.css' , null, self::version() );  
                wp_enqueue_script("dl-sticky-js", self::url() . 'js/sticky.js', ['jquery'], self::version(), true); 
             } 
            );
            add_action('elementor/element/section/section_advanced/after_section_end', [$this, 'sticky_option'], 99, 1);
            add_action('elementor/frontend/section/before_render', [ $this, 'sticky_render'], 1 );

        }


        public function sticky_option($el){
            if ( 'section' === $el->get_name()) {
                $el->start_controls_section(
                    'dl_sticky_section',
                    [
                        'label' => __( 'Section Sticky', 'droit-elementor-addons' ) . dl_get_icon(),
                        'tab' => \Elementor\Controls_Manager::TAB_ADVANCED,
                    ]
                );
    
                $el->add_control(
                    'dl_sticky_section_enable',
                    [
                        'label' => __( 'Enable', 'droit-elementor-addons' ),
                        'type' => \Elementor\Controls_Manager::SWITCHER,
                        'label_on' => __( 'Yes', 'droit-elementor-addons' ),
                        'label_off' => __( 'No', 'droit-elementor-addons' ),
                        'return_value' => 'yes',
                        'default' => 'no',
                    ]
                );

                $el->add_control(
                    'dl_sticky_position',
                    [
                        'label' => __( 'Position', 'droit-addons-pro' ),
                        'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
                        'label_off' => __( 'Default', 'your-plugin' ),
                        'label_on' => __( 'Custom', 'your-plugin' ),
                        'return_value' => 'yes',
                        'condition' => [
                            'dl_sticky_section_enable' => 'yes',
                        ],
                    ]
                );
        
                $el->start_popover();
        
                $start = is_rtl() ? __( 'Right', 'droit-addons' ) : __( 'Left', 'droit-addons' );
                $end = ! is_rtl() ? __( 'Right', 'droit-addons' ) : __( 'Left', 'droit-addons' );
    
                $el->add_control(
                    'dl_sticky_offset_orientation_h',
                    [
                        'label' => __( 'Horizontal Orientation', 'droit-addons' ),
                        'type' => \Elementor\Controls_Manager::CHOOSE,
                        'toggle' => false,
                        'default' => 'start',
                        'options' => [
                            'start' => [
                                'title' => $start,
                                'icon' => 'eicon-h-align-left',
                            ],
                            'end' => [
                                'title' => $end,
                                'icon' => 'eicon-h-align-right',
                            ],
                        ],
                        'classes' => 'elementor-control-start-end',
                        'render_type' => 'ui',
                       
                    ]
                );
    
                $el->add_responsive_control(
                    'dl_sticky_offset_x',
                    [
                        'label' => __( 'Offset', 'droit-addons' ),
                        'type' => \Elementor\Controls_Manager::SLIDER,
                        'range' => [
                            'px' => [
                                'min' => -1000,
                                'max' => 1000,
                                'step' => 1,
                            ],
                            '%' => [
                                'min' => -200,
                                'max' => 200,
                            ],
                            'vw' => [
                                'min' => -200,
                                'max' => 200,
                            ],
                            'vh' => [
                                'min' => -200,
                                'max' => 200,
                            ],
                        ],
                        'default' => [
                            'size' => '0',
                        ],
                        'size_units' => [ 'px', '%', 'vw', 'vh' ],
                        'selectors' => [
                            'body:not(.rtl) {{WRAPPER}}.drdt_sticky_fixed' => 'left: {{SIZE}}{{UNIT}}',
                            'body.rtl {{WRAPPER}}.drdt_sticky_fixed' => 'right: {{SIZE}}{{UNIT}}',
                        ],
                        'condition' => [
                            'dl_sticky_offset_orientation_h!' => 'end',
                        ],
                    ]
                );
    
                $el->add_responsive_control(
                    'dl_sticky_offset_x_end',
                    [
                        'label' => __( 'Offset', 'droit-addons' ),
                        'type' => \Elementor\Controls_Manager::SLIDER,
                        'range' => [
                            'px' => [
                                'min' => -1000,
                                'max' => 1000,
                                'step' => 0.1,
                            ],
                            '%' => [
                                'min' => -200,
                                'max' => 200,
                            ],
                            'vw' => [
                                'min' => -200,
                                'max' => 200,
                            ],
                            'vh' => [
                                'min' => -200,
                                'max' => 200,
                            ],
                        ],
                        'default' => [
                            'size' => '0',
                        ],
                        'size_units' => [ 'px', '%', 'vw', 'vh' ],
                        'selectors' => [
                            'body:not(.rtl) {{WRAPPER}}.drdt_sticky_fixed' => 'right: {{SIZE}}{{UNIT}}',
                            'body.rtl {{WRAPPER}}.drdt_sticky_fixed' => 'left: {{SIZE}}{{UNIT}}',
                        ],
                        'condition' => [
                            'dl_sticky_offset_orientation_h' => 'end',
                        ],
                    ]
                );
    
                $el->add_control(
                    'dl_sticky_offset_orientation_v',
                    [
                        'label' => __( 'Vertical Orientation', 'droit-addons' ),
                        'type' => \Elementor\Controls_Manager::CHOOSE,
                        'toggle' => false,
                        'default' => 'start',
                        'options' => [
                            'start' => [
                                'title' => __( 'Top', 'droit-addons' ),
                                'icon' => 'eicon-v-align-top',
                            ],
                            'end' => [
                                'title' => __( 'Bottom', 'droit-addons' ),
                                'icon' => 'eicon-v-align-bottom',
                            ],
                        ],
                        'render_type' => 'ui',
                        
                    ]
                );
    
                $el->add_responsive_control(
                    'dl_sticky_offset_y',
                    [
                        'label' => __( 'Offset', 'droit-addons' ),
                        'type' => \Elementor\Controls_Manager::SLIDER,
                        'range' => [
                            'px' => [
                                'min' => -1000,
                                'max' => 1000,
                                'step' => 1,
                            ],
                            '%' => [
                                'min' => -200,
                                'max' => 200,
                            ],
                            'vh' => [
                                'min' => -200,
                                'max' => 200,
                            ],
                            'vw' => [
                                'min' => -200,
                                'max' => 200,
                            ],
                        ],
                        'size_units' => [ 'px', '%', 'vh', 'vw' ],
                        'default' => [
                            'size' => '0',
                        ],
                        'selectors' => [
                            '{{WRAPPER}}.drdt_sticky_fixed' => 'top: {{SIZE}}{{UNIT}}',
                        ],
                        'condition' => [
                            'dl_sticky_offset_orientation_v!' => 'end',
                        ],
                    ]
                );
    
                $el->add_responsive_control(
                    'dl_sticky_offset_y_end',
                    [
                        'label' => __( 'Offset', 'droit-addons' ),
                        'type' => \Elementor\Controls_Manager::SLIDER,
                        'range' => [
                            'px' => [
                                'min' => -1000,
                                'max' => 1000,
                                'step' => 1,
                            ],
                            '%' => [
                                'min' => -200,
                                'max' => 200,
                            ],
                            'vh' => [
                                'min' => -200,
                                'max' => 200,
                            ],
                            'vw' => [
                                'min' => -200,
                                'max' => 200,
                            ],
                        ],
                        'size_units' => [ 'px', '%', 'vh', 'vw' ],
                        'default' => [
                            'size' => '0',
                        ],
                        'selectors' => [
                            '{{WRAPPER}}.drdt_sticky_fixed' => 'bottom: {{SIZE}}{{UNIT}}',
                        ],
                        'condition' => [
                            'dl_sticky_offset_orientation_v' => 'end',
                        ],
                    ]
                );
               
                $el->add_control(
                    'dl_sticky_zindex',   [
                        'label' => esc_html__('z-index', 'droit-addons-pro' ),
                        'type' => \Elementor\Controls_Manager::NUMBER,
                        'description' => __( 'Set z-index for the current layer, default 5', 'droit-addons-pro' ),
                        'default' => esc_html__('5', 'droit-addons-pro'),
                        'selectors' => [
                            "{{WRAPPER}}.drdt_sticky_fixed" => 'z-index: {{UNIT}}',
                        ],
                    ]
                );
               

                $el->end_popover();
    
                

                $el->end_controls_section();
            }
        }
    
        public function sticky_render( $el ){
            if ( 'section' === $el->get_name() ) {
                $settings = $el->get_settings_for_display();
                $id = $el->get_id();
                $sctionEnable = isset($settings['dl_sticky_section_enable']) ? $settings['dl_sticky_section_enable'] : 'no';
                if($sctionEnable == 'yes'){
                    $attr['class'] = 'drdt_sticky_section';
                    $el->add_render_attribute(
                        '_wrapper',
                        $attr
                    );
                }
            }
    
        }

        public static function instance(){
            if( is_null(self::$instance) ){
                self::$instance = new self();
            }
            return self::$instance;
        }
    }
}
