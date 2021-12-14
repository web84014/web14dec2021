<?php
namespace SaaslandCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class Slider
 * @package SaaslandCore\Widgets
 */
class Slider extends Widget_Base {

    public function get_name() {
        return 'saasland_slider';
    }

    public function get_title() {
        return __( 'Saasland Slider', 'saasland-hero' );
    }

    public function get_icon() {
        return 'eicon-post-slider';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    public function get_style_depends() {
        return [ 'owl-carousel' ];
    }

    public function get_script_depends() {
        return [ 'owl-carousel' ];
    }

    protected function _register_controls() {

        // ------------------------------ Slider Style ------------------------------
        $this->start_controls_section(
            'slider_style_sec', [
                'label' => __( 'Slider Style', 'saasland-core' ),
            ]
        );
        $this->add_control(
            'slider_style', [
                'label' => __( 'Slider Style', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => __( 'Style One', 'saasland-core' ),
                    '2' => __( 'Style Two', 'saasland-core' ),
                    '3' => __( 'Style Three', 'saasland-core' ),
                    '4' => __( 'Style Four [Creative]', 'saasland-core' ),
                ],
                'default' => '1',
                'label_block' => true
            ]
        );
        $this->end_controls_section();

        //Slider 1 Settings =======================
        include 'slider/settings/slider-1.php';

        //Slider 2 Settings =======================
        include 'slider/settings/slider-2.php';

        //Slider 4 Settings =======================
        include 'slider/settings/slider-4.php';

    }

    protected function render() {
        $settings = $this->get_settings();

        if( $settings['slider_style'] == '1' ){
            include 'slider/views/slider-1.php';
        }
        elseif ( $settings['slider_style'] == '2' ){
            include 'slider/views/slider-2.php';
        }
        elseif ( $settings['slider_style'] == '3' ){
            include 'slider/views/slider-3.php';
        }
        elseif ( $settings['slider_style'] == '4' ){
            include 'slider/views/slider-4.php';
        }

    }
}
