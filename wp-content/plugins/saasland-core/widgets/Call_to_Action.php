<?php
namespace SaaslandCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Call to Action
 */
class Call_to_Action extends Widget_Base {
    public function get_name() {
        return 'saasland_c2a';
    }

    public function get_title() {
        return __( 'Call to Action', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-call-to-action';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'section_style', [
                'label' => __( 'Style section', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'style', [
                'label' => __( 'Style', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_01' => esc_html__( 'Style One', 'saasland-core' ),
                    'style_02' => esc_html__( 'Style Two', 'saasland-core' ),
                    'style_03' => esc_html__( 'Style Three', 'saasland-core' ),
                    'style_04' => esc_html__( 'Style Four', 'saasland-core' ),
                    'style_05' => esc_html__( 'Style Five (Title & Icon)', 'saasland-core' ),
                    'style_06' => esc_html__( 'Style Six (Title & Gradient Button)', 'saasland-core' ),
                    'style_07' => esc_html__( 'Style Seven', 'saasland-core' ),
                    'style_08' => esc_html__( 'Style Eight', 'saasland-core' ),
                    'style_09' => esc_html__( 'Style Nine (Demo Landing Page)', 'saasland-core' ),
                    'style_10' => esc_html__( 'Style Ten', 'saasland-core' ),
                ],
                'default' => 'style_01'
            ]
        );

        $this->end_controls_section();

        // ------------------------------  Title  ------------------------------
        $this->start_controls_section(
            'title_sec', [
                'label' => __( 'Title', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'title', [
                'label' => esc_html__( 'Title Text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Device friendly widget'
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
            'icon', [
                'label' => esc_html__( 'Title Icon', 'saasland-core' ),
                'description' => esc_html__( 'Thee title icon will display above the section title', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/home9/icon2.png', __FILE__)
                ],
                'condition' => [
                    'style' => ['style_05']
                ]
            ]
        );

        $this->add_control(
            'color_title', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .f_p.f_size_40.l_height50.f_700' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .l_height45.t_color3.mb-0' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .f_size_30.l_height45.mb_40' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .w_color.f_p.mb-30' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .f_p.t_color.f_700' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .saasland_c2a_s' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .saas_action_content h4' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .footer_part .title_cta_9' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .get_started_section .title_text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
                    {{WRAPPER}} .f_p.f_size_40.l_height50.f_700, 
                    {{WRAPPER}} .l_height45.t_color3.mb-0,
                    {{WRAPPER}} .f_size_30.l_height45.mb_40,
                    {{WRAPPER}} .w_color.f_p.mb-30,
                    {{WRAPPER}} .f_p.t_color.f_700,
                    {{WRAPPER}} .saasland_c2a_s,
                    {{WRAPPER}} .saas_action_content h4,
                    {{WRAPPER}} .footer_part .title_cta_9,
                    {{WRAPPER}} .get_started_section .title_text
                    ',
            ]
        );

        $this->end_controls_section(); // End title section


        // ------------------------------  Subtitle ------------------------------
        $this->start_controls_section(
            'subtitle_sec', [
                'label' => __( 'Subtitle', 'saasland-core' ),
                'condition' => [
                    'style' => ['style_01', 'style_04', 'style_05', 'style_07', 'style_08'],
                ]
            ]
        );

        $this->add_control(
            'subtitle', [
                'label' => esc_html__( 'Text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );

        $this->add_control(
            'color_subtitle', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .call_action_area .action_content p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .software_featured_area_two p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .payment_action_content p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .erp_action_content p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_subtitle',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
                    {{WRAPPER}} .call_action_area .action_content p, 
                    {{WRAPPER}} .software_featured_area_two p,
                    {{WRAPPER}} .payment_action_content p,
                    {{WRAPPER}} .erp_action_content p
                    ',
            ]
        );

        $this->end_controls_section(); // End title section


        // ------------------------------ Featured Image ------------------------------
        $this->start_controls_section(
            'featured_img_sec', [
                'label' => esc_html__( 'Featured Image', 'saasland-core' ),
                'condition' => [
                    'style' => [ 'style_01', 'style_02', 'style_04', 'style_07', 'style_08', 'style_09' ],
                ]
            ]
        );

        $this->add_control(
            'featured_image', [
                'label' => esc_html__( 'Image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/c2a_featured_image.png', __FILE__)
                ]
            ]
        );

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

        $this->add_control(
            'btn_icon',
            [
                'label' => esc_html__( 'Icon', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::ICON,
                'options' => saasland_elegant_icons(),
                'include' => saasland_include_elegant_icons(),
                'default' => 'icon_cart_alt',
                'condition' => [
                    'style' => ['style_09'],
                ]
            ]
        );

        $this->start_controls_tabs(
            'style_tabs'
        );

        //Normal Style
        $this->start_controls_tab(
            'style_normal',
            [
                'label' => __( 'Normal', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'btn_font_color', [
                'label' => esc_html__( 'Font color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .call_action_area .action_content .action_btn' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .action_content .btn_three' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .action_area_three .action_content .white_btn' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .software_featured_content .btn_four' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .pay_btn.pay_btn_two' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .saas_subscribe_area .saas_action_content .gr_btn' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .er_btn_two' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .erp_action_content .er_btn' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .footer_part .btn_cta_9' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .get_started_section .btn_four' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_bg_color1', [
                'label' => esc_html__( 'Background Color 01', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'style' => ['style_06']
                ]
            ]
        );

        $this->add_control(
            'btn_bg_color22', [
                'label' => esc_html__( 'Background Color 02', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'style' => ['style_06']
                ]
            ]
        );

        $this->add_control(
            'btn_bg_color', [
                'label' => esc_html__( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .call_action_area .action_content .action_btn' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .action_content .btn_three' => 'background-color: {{VALUE}}; border-color: {{VALUE}};',
                    '{{WRAPPER}} .action_content .btn_three:hover' => 'color: {{VALUE}}; background: transparent;',
                    '{{WRAPPER}} .action_area_three .action_content .white_btn' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .software_featured_content .btn_four:hover' => 'color: {{VALUE}}; background: transparent;',
                    '{{WRAPPER}} .saas_subscribe_area .saas_action_content .gr_btn' => 'background-image: -webkit-linear-gradient(-48deg, {{btn_bg_color1.VALUE}} 0%, {{btn_bg_color1.VALUE}} 46%, {{VALUE}} 100%);',
                    '{{WRAPPER}} .er_btn_two' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .erp_action_content .er_btn' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .footer_part .btn_cta_9' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .get_started_section .btn_four' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_bg_color2', [
                'label' => esc_html__( 'Background Color 02', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .payment_action_content .pay_btn_two::before' => 'background-image: -webkit-linear-gradient(0deg, {{btn_bg_color.VALUE}} 0%, {{VALUE}} 100%);',
                ],
                'condition' => [
                    'style' => [ 'style_05' ]
                ]
            ]
        );

        $this->add_control(
            'btn_border_color', [
                'label' => __( 'Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .er_btn_two' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .action_area_three .action_content .white_btn' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .saas_subscribe_area .saas_action_content .gr_btn' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .erp_action_content .er_btn' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .footer_part .btn_cta_9' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .get_started_section .btn_four' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'style' => [ 'style_03', 'style_07', 'style_08', 'style_09', 'style_10' ]
                ]
            ]
        );

        $this->end_controls_tab();

        //Hover Color
        $this->start_controls_tab(
            'style_hover_btn',
            [
                'label' => __( 'Hover', 'saasland-core' ),
                'condition' => [
                    'style' => ['style_02', 'style_03', 'style_05', 'style_06', 'style_07', 'style_08', 'style_09', 'style_10']
                ]
            ]
        );

        $this->add_control(
            'hover_font_color', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .payment_action_content .pay_btn:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .btn_three:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .er_btn_two:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .action_area_three .action_content .white_btn:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .saas_subscribe_area .saas_action_content .gr_btn:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .erp_action_content .er_btn:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .footer_part .btn_cta_9:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .get_started_section .btn_four:hover' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'style' => [ 'style_02', 'style_03', 'style_05', 'style_06', 'style_07', 'style_08', 'style_09', 'style_10' ]
                ]
            ]
        );

        $this->add_control(
            'hover_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .payment_action_content .pay_btn' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .gr_btn:before' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .btn_three:hover' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .call_action_area .action_content .action_btn:hover' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .action_area_three .action_content .white_btn:hover' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .er_btn_two:hover' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .erp_action_content .er_btn:hover' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .footer_part .btn_cta_9:hover' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .get_started_section .btn_four:hover' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'style' => ['style_02', 'style_03', 'style_05', 'style_06', 'style_07', 'style_08', 'style_09', 'style_10']
                ]
            ]
        );

        $this->add_control(
            'hover_border_color', [
                'label' => __( 'Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn_three:hover' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .er_btn_two:hover' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .action_area_three .action_content .white_btn:hover' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .erp_action_content .er_btn:hover' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .footer_part .btn_cta_9:hover' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .get_started_section .btn_four:hover' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'style' => ['style_02', 'style_03', 'style_07', 'style_08', 'style_09', 'style_10']
                ]

            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section(); // End the Button


        // ------------------------------ Button 02 ------------------------------
        $this->start_controls_section(
            'button2_sec', [
                'label' => esc_html__( 'Button 02', 'saasland-core' ),
                'condition' => [
                    'style' => 'style_03'
                ]
            ]
        );

        $this->add_control(
            'btn_label2', [
                'label' => esc_html__( 'Button Label', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Get Started',
            ]
        );

        $this->add_control(
            'btn_url2', [
                'label' => esc_html__( 'Button URL', 'saasland-core' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#'
                ]
            ]
        );

        $this->add_control(
            'btn_text_color2', [
                'label' => esc_html__( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .call_action_area .action_content .action_btn' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .action_content .btn_three' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .action_area_three .action_content .about_btn+.about_btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn2_bg_color2', [
                'label' => esc_html__( 'Background color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .call_action_area .action_content .action_btn' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .action_area_three .action_content .about_btn+.about_btn' => 'background-color: {{VALUE}}; border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section(); // End the Button


        /*---------------------------- Background Object and Shape -----------------------------*/
        $this->start_controls_section(
            'bg_shape_object', [
                'label' => __( 'Shape & Object', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => 'style_10'
                ]
            ]
        );
        $this->add_control(
            'cta_shape_1', [
                'label' => esc_html__( 'shape 1', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'label_block' => true,
            ]
        );
        $this->add_control(
            'cta_shape_2', [
                'label' => esc_html__( 'shape 2', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'label_block' => true,
            ]
        );
        $this->add_control(
            'cta_shape_3', [
                'label' => esc_html__( 'shape 3', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'label_block' => true,
            ]
        );
        $this->add_control(
            'cta_shape_4', [
                'label' => esc_html__( 'shape 4', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'label_block' => true,
            ]
        );
        $this->add_control(
            'cta_shape_5', [
                'label' => esc_html__( 'shape 5', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'label_block' => true,
            ]
        );
        $this->add_control(
            'cta_shape_6', [
                'label' => esc_html__( 'shape 6', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'label_block' => true,
            ]
        );
        $this->end_controls_section(); // End the Button


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

        $this->add_control(
            'bg_image', [
                'label' => esc_html__( 'Background Image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'condition' => [
                    'style' => ['style_01', 'style_07', 'style_08'],
                ]
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'action_area_three_bg',
				'label' => __( 'Background', 'saasland-core' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .action_area_three .curved',
                'condition' => [
                    'style' => 'style_03'
                ]
			]
		);
        $this->add_control(
            'bottom_bg_image', [
                'label' => esc_html__( 'Background Bottom Image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'condition' => [
                    'style' => 'style_08'
                ]
            ]
        );

        $this->add_control(
            'bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .action_area_two, {{WRAPPER}} .saas_subscribe_area .saas_action_content, {{WRAPPER}} .payment_action_area, {{WRAPPER}} .erp_call_action_area' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .footer_part' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'bg_color2', [
                'label' => __( 'Background Color 2', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'style' => ['style_01', 'style_03', 'style_04']
                ],
                'selectors' => [
                    '{{WRAPPER}} .call_action_area' => 'background-image: -webkit-linear-gradient(180deg, {{VALUE}} 0%, {{bg_color.VALUE}} 100%);',
                    '{{WRAPPER}} .action_area_three' => 'background-image: -webkit-linear-gradient(0deg, {{VALUE}} 0%, {{bg_color.VALUE}} 100%);',
                    '{{WRAPPER}} .software_featured_area_two' => 'background: -webkit-linear-gradient(40deg, {{VALUE}} 0%, {{bg_color.VALUE}} 100%);',
                    '{{WRAPPER}} .saas_subscribe_area' => 'background-image: -webkit-linear-gradient(180deg, {{VALUE}} 0%, {{bg_color.VALUE}} 100%);',
                ]
            ]
        );

        $this->add_responsive_control(
            'sec_padding', [
                'label' => __( 'Section padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .call_action_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .action_area_three' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .software_featured_area_two' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .payment_action_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .saas_subscribe_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .erp_call_action_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .analytices_action_area_two' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .saas_subscribe_area .saas_action_content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .footer_part' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'style' => ['style_01', 'style_03', 'style_04', 'style_06', 'style_07', 'style_08']
                ],
                'default' => [
                    'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',
                    'isLinked' => true,
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings();
        $title_tag = !empty($settings['title_html_tag']) ? $settings['title_html_tag'] : 'h2';


        if ( $settings['style'] == 'style_01' ) {
            include 'call-to-action/part-style-one.php';
        }

        if ( $settings['style'] == 'style_02' ) {
            include 'call-to-action/part-style-two.php';
        }

        if ( $settings['style'] == 'style_03' ) {
            include 'call-to-action/part-style-three.php';
        }

        if ( $settings['style'] == 'style_04' ) {
            include 'call-to-action/part-style-four.php';
        }

        if ( $settings['style'] == 'style_05' ) {
            include 'call-to-action/part-style-five.php';
        }

        if ( $settings['style'] == 'style_06' ) {
            include 'call-to-action/part-style-six.php';
        }

        if ( $settings['style'] == 'style_07' ) {
            include 'call-to-action/part-style-seven.php';
        }

        if ( $settings['style'] == 'style_08' ) {
            include 'call-to-action/part-style-eight.php';
        }

        if ( $settings['style'] == 'style_09' ) {
            wp_enqueue_style('saasland-demo');
            include 'call-to-action/demo-landing-c2a.php';
        }
        if ( $settings['style'] == 'style_10' ) {
            wp_enqueue_style('saasland-digital-agency');
            include 'call-to-action/style_10.php';
        }

    }
}