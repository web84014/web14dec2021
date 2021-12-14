<?php
namespace DROIT_ELEMENTOR\Module;

use \Elementor\Control_Media;
use \Elementor\Controls_Stack;
use \Elementor\Element_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Back_Parallax{

	private static $instance;

	public static function url(){ 
		return trailingslashit(plugin_dir_url( __FILE__ ));
	}

	public static function dir(){
		return trailingslashit(plugin_dir_path( __FILE__ ));
	}

	public static function version(){
		if( defined('DROIT_ADDONS_VERSION_') ){
            return DROIT_ADDONS_VERSION_;
        } else {
            return apply_filters('dladdons_pro_version', '1.0.0');
        }
        
	}

	public function init() {
		add_action('elementor/frontend/before_enqueue_scripts', [$this, 'editor_scripts'], 99);
		add_action( 'elementor/element/section/section_layout/after_section_end', [$this, '_register_controls' ], 10 );
        add_action( 'elementor/frontend/section/before_render', [ $this, 'dl_before_render' ], 10, 1 );
	}
	
	public function editor_scripts(){
		wp_enqueue_script( 'dladdons-nJsParallax', self::url() . 'assets/js/NextBackParallaxJs.min.js', array( ), self::version(), true );
	}

	public function _register_controls($control)
    {
        $id = $control->get_id();
        if ( 'section' === $control->get_name() ) {
            $control->start_controls_section(
                'dl_bcparallax_section',
                [
                    'label' => __( 'Background Parallax', 'droit-addons-pro' ) . dl_get_icon(),
                    'tab' => \Elementor\Controls_Manager::TAB_LAYOUT,
                ]
            );

            $control->add_control(
                'dl_bcparallax_enable',
                [
                    'label' => __( 'Enable Parallax', 'droit-addons-pro' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => __( 'Yes', 'droit-addons-pro' ),
                    'label_off' => __( 'No', 'droit-addons-pro' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                    'frontend_available' => false,
                ]
            );
            
            $control->add_control(
                'dl_bcparallax_ratio', [
                    'label' => esc_html__( 'Ratio', 'droit-addons-pro' ),
                    'type' => \Elementor\Controls_Manager::NUMBER,
                    'default' => '0.1',
                    'condition' => [
                        'dl_bcparallax_enable' => 'yes',
                    ],
                    'frontend_available' => false,
                    'render_type' => 'none',
                ]
            );

            $control->add_control(
                'dl_bcparallax_offset', [
                    'label' => esc_html__( 'Offset', 'droit-addons-pro' ),
                    'type' => \Elementor\Controls_Manager::NUMBER,
                    'default' => '0',
                    'condition' => [
                        'dl_bcparallax_enable' => 'yes',
                    ],
                    'frontend_available' => false,
                    'render_type' => 'none',
                ]
            );
            
            $control->add_control(
                'dl_bcparallax_h_enable',
                [
                    'label' => __( 'Horizontal mode', 'droit-addons-pro' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => __( 'Yes', 'droit-addons-pro' ),
                    'label_off' => __( 'No', 'droit-addons-pro' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                    'condition' => [
                        'dl_bcparallax_enable' => 'yes',
                    ],
                    'frontend_available' => false,
                ]
            );

            $control->add_control(
                'dl_bcparallax_t_enable',
                [
                    'label' => __( 'Foreground mode', 'droit-addons-pro' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => __( 'Yes', 'droit-addons-pro' ),
                    'label_off' => __( 'No', 'droit-addons-pro' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                    'condition' => [
                        'dl_bcparallax_enable' => 'yes',
                    ],
                    'frontend_available' => false,
                ]
            );
            
            $control->end_controls_section();

        }
    }

    public function dl_before_render( $element ) {
		$settings = $element->get_settings_for_display();

        $sctionEnable = isset($settings['dl_bcparallax_enable']) ? $settings['dl_bcparallax_enable'] : 'no';

        if ( 'section' === $element->get_name() && $sctionEnable == 'yes') {
            
            $attr['class'] = 'dl-backparalax-section';
            $repeater = isset($settings['dl_dataparallax_data']) ? $settings['dl_dataparallax_data'] : [];
            if( !empty($repeater) ){
                $attr['data-dl_bkparallax'] = wp_json_encode( $repeater );
            }

            $attr['njs-ratio'] = isset($settings['dl_bcparallax_ratio']) ? $settings['dl_bcparallax_ratio'] : '0.1';
            $attr['njs-offset'] = isset($settings['dl_bcparallax_offset']) ? $settings['dl_bcparallax_offset'] : '0';
            $attr['njs-direction'] = 'vertical';
            $attr['njs-type'] = 'background';

            $direction = isset($settings['dl_bcparallax_h_enable']) ? $settings['dl_bcparallax_h_enable'] : 'no';
		    if( $direction == 'yes'){
                $attr['njs-direction'] = 'horizontal';
            }

            $direction = isset($settings['dl_bcparallax_t_enable']) ? $settings['dl_bcparallax_t_enable'] : 'no';
		    if( $direction == 'yes'){
                $attr['njs-type'] = 'foreground';
            }

            $element->add_render_attribute(
                '_wrapper',
                $attr
            );
        }

	}

	public static function instance(){
        if( is_null(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }
}
