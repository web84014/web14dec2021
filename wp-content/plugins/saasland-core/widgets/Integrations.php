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
 *
 * Integrations with Button
 *
 */
class Integrations extends Widget_Base {
    public function get_name() {
        return 'saasland_integrations';
    }

    public function get_title() {
        return __( 'Integrations <br> with Button', 'saasland-core' );
    }

    public function get_icon() {
        return ' eicon-thumbnails-half';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    protected function _register_controls() {

        // ----------------------------------------  Hero content ------------------------------
        $this->start_controls_section(
            'select_style_sec',
            [
                'label' => __( 'Integration Style', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'style', [
                'label' => esc_html__( 'Style', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [
                    'style_01' => esc_html__( 'Style One', 'saasland-core' ),
                    'style_02' => esc_html__( 'Style Two', 'saasland-core' ),
                ],
                'default' => 'style_01'
            ]
        );

        $this->end_controls_section(); // End Hero content


        // --------------------------  Title  ------------------------------
        $this->start_controls_section(
            'title_sec',
            [
                'label' => __( 'Title', 'saasland-core' ),
            ]
        );


        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title Text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'Quick & Easy Process'
            ]
        );

        $this->add_control(
            'title_html_tag',
            [
                'label' => __( 'Title HTML Tag', 'elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                ],
                'default' => 'h2',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'title_icon', [
                'label' => esc_html__( 'Title Icon', 'saasland-core' ),
                'description' => esc_html__( 'Thee title icon will display above the section title', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/home9/icon2.png', __FILE__)
                ],
                'condition' => [
                    'style' => 'style_01'
                ]

            ]
        );

        $this->add_control(
            'color_title', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .payment_features_content .title_color' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .hosting_title .sassland_erp_color' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
                    {{WRAPPER}} .payment_features_content .title_color,
                    {{WRAPPER}} .hosting_title .sassland_erp_color',
            ]
        );

        $this->end_controls_section(); // End title section


        // ------------------------------  Subtitle ------------------------------
        $this->start_controls_section(
            'subtitle_sec', [
                'label' => __( 'Subtitle', 'saasland-core' ),
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
                    '{{WRAPPER}} .payment_features_content p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .hosting_title p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_subtitle',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
                    {{WRAPPER}} .payment_features_content p,
                    {{WRAPPER}} .hosting_title p',
            ]
        );

        $this->end_controls_section(); // End title section


        // ------------------------------  Contents ------------------------------
        $this->start_controls_section(
            'integrations_sec', [
                'label' => __( 'Integrations', 'saasland-core' ),
                'condition' => [
                    'style' => 'style_01',
                ]
            ]

        );

        $this->add_control(
            'integrations_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .payment_clients_area .clients_bg_shape_right' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'integrations', [
                'label' => __( 'Integration Items', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'title_field' => '{{{ title }}}',
                'fields' => [
                    [
                        'name' => 'title',
                        'label' => __( 'Title', 'saasland-core' ),
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default' => 'Default Text'
                    ],
                    [
                        'name' => 'logo',
                        'label' => __( 'Logo', 'karpartz-core' ),
                        'type' => Controls_Manager::MEDIA,
                    ],
                    [
                        'name' => 'dimension',
                        'label' => __( 'Dimension', 'saasland-core' ),
                        'type' => Controls_Manager::IMAGE_DIMENSIONS,
                    ],
                    [
                        'name' => 'position',
                        'label' => __( 'Position', 'saasland-core' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'default' => [
                            'isLinked' => false
                        ]
                    ],
                    [
                        'name'      => 'bg_color',
                        'label'     => esc_html__( 'Background Color', 'saasland-core' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => array(
                            '{{WRAPPER}} {{CURRENT_ITEM}}' => 'background-color: {{VALUE}}'
                        )
                    ],
                    [
                        'name'      => 'border_color',
                        'label'     => esc_html__( 'Border Color', 'saasland-core' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => array(
                            '{{WRAPPER}} {{CURRENT_ITEM}}' => 'border: 1px solid {{VALUE}}',
                        )
                    ],
                ],
            ]
        );

        $this->end_controls_section();


        /**
         * Button Colors
         */
        $this->start_controls_section(
            'button_colors', [
                'label' => esc_html__( 'Button Colors', 'saasland-core' ),
                'condition' => [
                    'style' => 'style_01'
                ]
            ]
        );
        // Tabs Start
        $this->start_controls_tabs(
            'btn_type_tabs'
        );
        // Solid Tab
        $this->start_controls_tab(
            'btn_solid_tab',
            [
                'label' => __( 'Solid Stat', 'saasland-core' ),
            ]
        );
        $this->add_control(
            'solid_btn_text_color', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pay_btn, {{WRAPPER}} .pay_btn.pay_btn_two:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'solid_btn_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pay_btn' => 'background: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        // Gradient Tab
        $this->start_controls_tab(
            'btn_gradient_tab',
            [
                'label' => __( 'Gradient Stat', 'saasland-core' ),
            ]
        );
        $this->add_control(
            'gradient_btn_text_color', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pay_btn.pay_btn_two, {{WRAPPER}} .pay_btn:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'gradient_btn_bg_color', [
                'label' => __( 'Background Color 01', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
            ]
        );
        $this->add_control(
            'gradient_btn_bg_color_02', [
                'label' => __( 'Background Color 02', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pay_btn::before' => 'background-image: -webkit-linear-gradient(0deg, {{gradient_btn_bg_color.VALUE}} 0%, {{VALUE}} 100%)',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        // ------------------------------ Button ------------------------------
        $this->start_controls_section(
            'button', [
                'label' => esc_html__( 'Button', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'btn_label', [
                'label' => esc_html__( 'Button label', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Get Started',
            ]
        );

        $this->add_control(
            'btn_url', [
                'label' => esc_html__( 'Button URL', 'saasland-core' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#'
                ]
            ]
        );

        /*$this->add_control(
            'btn_normal_stat', [
                'label' => esc_html__( 'Normal Stat', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'normal-solid' => 'Solid',
                    'normal-gradient' => 'Gradient'
                ],
                'default' => 'normal-solid'
            ]
        );

        $this->add_control(
            'btn_hover_stat', [
                'label' => esc_html__( 'Hover Stat', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'hover-solid' => 'Solid',
                    'hover-gradient' => 'Gradient'
                ],
                'default' => 'hover-gradient'
            ]
        );*/


        //---------------------------- Normal and Hover ---------------------------//
        $this->start_controls_tabs(
            'style_btn_tabs'
        );

        /**---------------------------- Normal Color ----------------------------*/
        $this->start_controls_tab(
            'btn_style_normal',
            [
                'label' => __( 'Normal', 'saasland-core' ),
                'condition' => [
                    'style' => 'style_02',
                ]
            ]
        );
        $this->add_control(
            'normal_font_color', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .er_btn' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'style' => 'style_02',
                ]
            ]
        );
        $this->add_control(
            'normal_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .er_btn' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'style' => 'style_02',
                ]
            ]
        );
        $this->add_control(
            'normal_border_color', [
                'label' => __( 'Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .er_btn' => 'border: 1px solid {{VALUE}}',
                ],
                'condition' => [
                    'style' => 'style_02',
                ]
            ]
        );
        $this->end_controls_tab();

        //**************************** Hover Color *****************************//
        $this->start_controls_tab(
            'btn_style_hover',
            [
                'label' => __( 'Hover', 'saasland-core' ),
                'condition' => [
                    'style' => 'style_02',
                ]
            ]
        );
        $this->add_control(
            'hover_font_color', [
                'label' => __( 'Font Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .er_btn:hover' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'style' => 'style_02',
                ]
            ]
        );
        $this->add_control(
            'hover_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pay_btn:hover:before' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .er_btn:hover' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'style' => 'style_02',
                ]
            ]
        );
        $this->add_control(
            'hover_border_color', [
                'label' => __( 'Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title:hover' => 'border: 1px solid {{VALUE}}',
                    '{{WRAPPER}} .er_btn:hover' => 'border: 1px solid {{VALUE}}',
                ],
                'condition' => [
                    'style' => 'style_02',
                ]
            ]
        );
        $this->end_controls_tab();

        $this->end_controls_section(); // End the Button

        // ------------------------------ Button 2 ------------------------------
        $this->start_controls_section(
            'button2_sec', [
                'label' => esc_html__( 'Button 02', 'saasland-core' ),
                'condition' => [
                    'style' => 'style_01',
                ]
            ]
        );

        $this->add_control(
            'btn2_label', [
                'label' => esc_html__( 'Button label', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Get Started',
            ]
        );

        $this->add_control(
            'btn2_url', [
                'label' => esc_html__( 'Button URL', 'saasland-core' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#'
                ]
            ]
        );

        $this->end_controls_section(); // End the Button

        /**
         * Integrations ERP Repeater
         */
        /// ------------------------- Customer Logos ----------------------------
        $this->start_controls_section(
            'logo_sec',
            [
                'label' => esc_html__( 'Logos', 'saasland-core' ),
                'condition' => [
                    'style' =>  'style_02'
                ]
            ]
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'alt_text', [
                'label' => esc_html__( 'Alt Text', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Logo Name'
            ]
        );

        $repeater->add_control(
            'logo', [
                'label' => esc_html__( 'Logo', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'logos', [
                'label' => esc_html__( 'Logos', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'title_field' => '{{{ alt_text }}}',
                'fields' => $repeater->get_controls(),
            ]
        );

        $this->end_controls_section();


        /**
         * Style Tab
         */
        //------------------------------ Style Section ------------------------------
        $this->start_controls_section(
            'style_section', [
                'label' => __( 'Style section', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'sec_padding', [
                'label' => __( 'Section padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .payment_clients_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .erp_customer_logo_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',
                    'isLinked' => false,
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings();
        $planets = isset($settings['integrations']) ? $settings['integrations'] : '';
        $title_tag = !empty($settings['title_html_tag']) ? $settings['title_html_tag'] : 'h2';

        if ( $settings['style'] == 'style_01' ) {
            include 'integrations/integrations-payment-processing.php';
        }

        if ( $settings['style'] == 'style_02' ) {
            include 'integrations/integrations-erp.php';
        }

    }
}