<?php
namespace SaaslandCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Border;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class Testimonial_ratting
 * @package SaaslandCore\Widgets
 */
class Testimonial_ratting extends \Elementor\Widget_Base {

    public function get_name() {
        return 'saasland_testimonial_ratting';
    }

    public function get_title() {
        return __( 'Testimonials with Ratting', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-testimonial-carousel';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }
    public function get_script_depends() {
        return [ '' ];
    }

    protected function render() {
        $settings = $this->get_settings();
        $testimonials = isset($settings['testimonials']) ? $settings['testimonials'] : '';

        if ( $settings['style'] == 'style_01' ) {
            include 'testimonials-ratting/1.php';
        }

        if ( $settings['style'] == 'style_02' ) {
            include 'testimonials-ratting/2.php';
        }

        if ( $settings['style'] == 'style_03' ) {
            include 'testimonials-ratting/3.php';
        }

        if ( $settings['style'] == 'style_04' ) {
            include 'testimonials-ratting/4.php';
        }
    }

    protected function _register_controls() {

        // ----------------------------------------  Select Style  ------------------------------
        $this->start_controls_section(
            'style_sec',
            [
                'label' => __( 'Select Style', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'style', [
                'label' => esc_html__( 'Testimonials Style', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [
                    'style_01' => esc_html__( 'Style One', 'saasland-core' ),
                    'style_02' => esc_html__( 'Style Two', 'saasland-core' ),
                    'style_03' => esc_html__( 'Style Three', 'saasland-core' ),
                    'style_04' => esc_html__( 'Style Four (Demo Landing)', 'saasland-core' ),
                ],
                'default' => 'style_01'
            ]
        );

        $this->end_controls_section();


        // ------------------------------  Title ------------------------------
        $this->start_controls_section(
            'title_sec', [
                'label' => __( 'Title', 'saasland-core' ),
                'condition' => [
                    'style' => ['style_01', 'style_02', 'style_03']
                ]
            ]
        );

        $this->add_control(
            'title', [
                'label' => esc_html__( 'Title text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => "Satisfied Users"
            ]
        );

        $this->add_control(
            'color_title', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} h2' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .hosting_title h2' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
                    {{WRAPPER}} h2,
                    {{WRAPPER}} .hosting_title h2
                    ',
            ]
        );

        $this->end_controls_section(); // End title section


        // ------------------------------  Subtitle ------------------------------
        $this->start_controls_section(
            'subtitle_sec', [
                'label' => __( 'Subtitle', 'saasland-core' ),
                'condition' => [
                    'style' => 'style_01',
                ]

            ]
        );

        $this->add_control(
            'subtitle', [
                'label' => esc_html__( 'Text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'color_subtitle', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .feedback_area_two .sec_title p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_subtitle',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .feedback_area_two .sec_title p',
            ]
        );

        $this->end_controls_section(); // End title section


        // ------------------------------  Contents ------------------------------
        $this->start_controls_section(
            'content_sec', [
                'label' => __( 'Testimonials', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'testimonials', [
                'label' => __( 'Testimonials', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'title_field' => '{{{ name }}}',
                'condition' => [
                    'style' => ['style_01', 'style_02']
                ],
                'fields' => [
                    [
                        'name' => 'name',
                        'label' => __( 'Name', 'saasland-core' ),
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                    ],
                    [
                        'name' => 'designation',
                        'label' => __( 'Designation', 'saasland-core' ),
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                    ],
                    [
                        'name' => 'content',
                        'label' => __( 'Testimonial Text', 'saasland-core' ),
                        'type' => Controls_Manager::TEXTAREA,
                        'label_block' => true,
                    ],
                    [
                        'name' => 'author_image',
                        'label' => __( 'Author Image', 'saasland-core' ),
                        'type' => Controls_Manager::MEDIA,
                    ],
                    [
                        'name' => 'ratting',
                        'label' => __( 'Star Ratting', 'saasland-core' ),
                        'type' => Controls_Manager::SELECT,
                        'options' => [
                            '1' => 'One',
                            '2' => 'Two',
                            '3' => 'Three',
                            '4' => 'Four',
                            '5' => 'Five',
                            'no' => 'None',
                        ]
                    ],
                ],
            ]
        );

        /** === Style 03 Testimonials Repeater === **/
        $testimonails3 = new \Elementor\Repeater();
        $testimonails3->add_control(
            'contents',
            [
                'label' => esc_html__( 'Contents', 'saasland-core' ),
                'type' =>Controls_Manager::TEXTAREA,
            ]
        );

        $testimonails3->add_control(
            'name',
            [
                'label' => esc_html__( 'Name', 'saasland-core' ),
                'type' =>Controls_Manager::TEXTAREA,
                'default' => 'Lance Bogrol, <span>Chief Financial</span>'
            ]
        );

        $testimonails3->add_control(
            'designation',
            [
                'label' => esc_html__( 'Designation', 'saasland-core' ),
                'type' =>Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $testimonails3->add_control(
            'author_image',
            [
                'label' => esc_html__( 'Author Image', 'saasland-core' ),
                'type' =>Controls_Manager::MEDIA,
            ]
        );

        $testimonails3->add_control(
            'ratting',
            [
                'label' => esc_html__( 'Star Ratting', 'saasland-core' ),
                'type' =>Controls_Manager::SELECT,
                'options' => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                ]
            ]
        );

        $this->add_control(
            'testimonials3',
            [
                'label' => esc_html__( 'Testimonials List', 'saasland-core' ),
                'type' =>Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'fields' => $testimonails3->get_controls(),
                'title_field' => '{{{ name }}}',
                'condition' => [
                    'style' =>  'style_03'
                ]
            ]
        );

        /** Testimonials Style 04 **/
        $testimonails4 = new \Elementor\Repeater();
        $testimonails4->add_control(
            'name',
            [
                'label' => esc_html__( 'Name', 'saasland-core' ),
                'type' =>Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $testimonails4->add_control(
            'designation',
            [
                'label' => esc_html__( 'Designation', 'saasland-core' ),
                'type' =>Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $testimonails4->add_control(
            'contents',
            [
                'label' => esc_html__( 'Contents', 'saasland-core' ),
                'type' =>Controls_Manager::TEXTAREA,
            ]
        );

        $testimonails4->add_control(
            'ratting',
            [
                'label' => esc_html__( 'Star Ratting', 'saasland-core' ),
                'type' =>Controls_Manager::SELECT,
                'options' => [
                    '1' => 'One',
                    '2' => 'Two',
                    '3' => 'Three',
                    '4' => 'Four',
                    '5' => 'Five',
                ]
            ]
        );

        $this->add_control(
            'testimonials4',
            [
                'label' => esc_html__( 'Testimonials List', 'saasland-core' ),
                'type' =>Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'fields' => $testimonails4->get_controls(),
                'title_field' => '{{{ name }}}',
                'condition' => [
                    'style' =>  'style_04'
                ],
            ]
        );

        $this->end_controls_section();


        /** === Owl Carousel Slider Settings === */
        $this->start_controls_section(
            'slider_settings', [
                'label' => __( 'Slider Settings', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'loop',
            [
                'label' => __( 'Loop', 'saasland-core' ),
                'description' => __( 'Loop true mean the carousel slide is changing always, false mean not change the carousel slide again after the first time slide changes.', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'true' => esc_html__( 'True', 'saasland-core' ),
                    'false' => esc_html__( 'False', 'saasland-core' ),
                ],
                'default' => 'true'
            ]
        );

        $this->add_control(
            'slide_speed',
            [
                'label' => __( 'Smart Speed', 'saasland-core' ),
                'description' => __( 'The smart speed is the slide transition speed. Input the Smart Speed in millisecond.', 'saasland-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 2000
            ]
        );

        $this->end_controls_section();


        // ------------------------------------- Style Section ---------------------------//
        $this->start_controls_section(
            'style_testimonial4', [
                'label' => __( 'Style section', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => ['style_04']
                ]
            ]
        );

        $this->add_control(
            'testimonial_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .feedback_slider_two .feedback_item' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .feedback_slider_three .feedback_item' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'testimonial_bg_color2', [
                'label' => __( 'Background Color 02', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .demo_testimonial_slider .slick-slide.slick-center .item' => 'background: linear-gradient(135deg, {{testimonial_bg_color.VALUE}}, {{VALUE}});',
                ],
                'condition' => [
                    'style' => ['style_04']
                ]
            ]
        );

        $this->add_responsive_control(
            'testimonial4_inner_padding', [
                'label' => __( 'Items Inner Padding', 'saasland-core' ),
                'description' => __( 'Inner padding around the Testimonial item boxes. Default is 50px 55px 50px 55px', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .demo_testimonial_slider .slick-slide .item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',
                ],
                'condition' => [
                    'style' => ['style_04']
                ]
            ]
        );

        $this->add_responsive_control(
            'testimonial4_outer_padding', [
                'label' => __( 'Items Outer Padding', 'saasland-core' ),
                'description' => __( 'Outer padding around the Testimonial item boxes.', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .demo_testimonial_slider .slick-slide' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',
                ],
                'condition' => [
                    'style' => ['style_04']
                ]
            ]
        );

        $this->end_controls_section();

        // ------------------------------------- Style Section ---------------------------//
        $this->start_controls_section(
            'style_section', [
                'label' => __( 'Style section', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'style' => 'style_01',
                ]
            ]
        );

        $this->add_control(
            'bg_color2', [
                'label' => __( 'Background Color 02', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .feedback_area_two' => 'background-image: -webkit-linear-gradient(30deg, {{bg_color.VALUE}} 0%, {{VALUE}} 100%);',
                ],
                'condition' => [
                    'style' => 'style_01',
                ]
            ]
        );

        $this->add_control(
            'sec_bg_color',
            [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bg_color' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'style' => 'style_02',
                ]
            ]
        );

        $this->add_responsive_control(
            'sec_padding', [
                'label' => __( 'Section padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .feedback_area_two' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} feedback_area_three ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',
                    'isLinked' => false,
                ],
            ]
        );

        $this->end_controls_section();
    }
}