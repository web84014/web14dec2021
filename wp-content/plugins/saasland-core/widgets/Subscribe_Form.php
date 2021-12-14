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
 * Class Subscribe_Form
 * @package SaaslandCore\Widgets
 */
class Subscribe_Form extends Widget_Base {

    public function get_name() {
        return 'saasland_subsciribe';
    }

    public function get_title() {
        return __( 'Subscribe form', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-mailchimp';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    public function get_keywords() {
        return [ 'mailchimp', 'form' ];
    }

    public function get_script_depends() {
        return [ 'ajax-chimp' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'sec_style', [
                'label' => __( 'Section Style', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'style', [
                'label' => __( 'Style', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_01' => esc_html__( 'Style One (with featured image)', 'saasland-core' ),
                    'style_02' => esc_html__( 'Style Two', 'saasland-core' ),
                    'style_03' => esc_html__( 'Style Three (with featured image)', 'saasland-core' ),
                    'style_04' => esc_html__( 'Style Four', 'saasland-core' ),
                    'style_05' => esc_html__( 'Style Five', 'saasland-core' ),
                    'style_06' => esc_html__( 'Style Six (with featured image)', 'saasland-core' ),
                    'style_07' => esc_html__( 'Style Seven', 'saasland-core' ),
                    'style_08' => esc_html__( 'Style Eight (with featured image)', 'saasland-core' ),
                    'style_09' => esc_html__( 'Style Nine', 'saasland-core' ),
                    'style_10' => esc_html__( 'Style Ten', 'saasland-core' )
                ],
                'default' => 'style_01'
            ]
        );

        $this->end_controls_section();


        // ------------------------------  Title Section ------------------------------
        $this->start_controls_section(
            'title_sec', [
                'label' => __( 'Title Section', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'title', [
                'label' => esc_html__( 'Title text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'Increase team productivity  with this powerful Project Management Tool'
            ]
        );

        $this->add_control(
            'title_html_tag',
            [
                'label' => __( 'Title HTML Tag', 'saasland-core' ),
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

        $this->end_controls_section(); //End Title Section


        // ------------------------------  Subtitle Section ------------------------------ //
        $this->start_controls_section(
            'subtitle_sec', [
                'label' => __( 'Subtitle Section', 'saasland-core' ),
                'condition' => [
                    'style' => ['style_01', 'style_02', 'style_03', 'style_05', 'style_06', 'style_07', 'style_08', 'style_09']
                ]
            ]
        );

        $this->add_control(
            'subtitle', [
                'label' => esc_html__( 'Subtitle text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,

            ]
        );

        $this->end_controls_section(); // End subtitle section


        // ------------------------------ MailChimp form ------------------------------
        $this->start_controls_section(
            'form_settings', [
                'label' => __( 'Form settings', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'email_placeholder', [
                'label' => esc_html__( 'Email Filed Placeholder', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Type your email...',
            ]
        );

        $this->add_control(
            'name_placeholder', [
                'label' => esc_html__( 'Name Filed Placeholder', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Name',
                'condition' => [
                    'style' => ['style_05']
                ]
            ]
        );

        $this->add_control(
            'action_url', [
                'label' => esc_html__( 'Action URL', 'saasland-core' ),
                'description' => __( 'Enter here your MailChimp action URL. <a href="https://goo.gl/k5a2tA" target="_blank"> How to </a>', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'btn_label', [
                'label' => esc_html__( 'Submit Button Label', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Subscribe',
                'condition' => [
                    'style' => ['style_01', 'style_03', 'style_04', 'style_05', 'style_06', 'style_07', 'style_08', 'style_10']
                ]
            ]
        );

        //---------------------------- Normal and Hover ---------------------------//
        $this->start_controls_tabs(
            'style_tabs'
        );

        /************************** Normal Color *****************************/
        $this->start_controls_tab(
            'btn_style_normal',
            [
                'label' => __( 'Normal', 'saasland-core' ),
                'condition' => [
                    'style' => ['style_01', 'style_03', 'style_04', 'style_05', 'style_06', 'style_07', 'style_08']
                ]
            ]
        );

        $this->add_control(
            'normal_font_color', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn_four' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .saas_banner_btn' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .banner_top .subcribes .btn_submit' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .prototype_content .btn_three' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .section_container .intro_content .subcribes .btn_submit' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'style' => ['style_01', 'style_03', 'style_04', 'style_05', 'style_06', 'style_07', 'style_08']
                ]
            ]
        );

        $this->add_control(
            'normal_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn_four' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .saas_banner_btn' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .banner_top .subcribes .btn_submit' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .prototype_content .btn_three' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .section_container .intro_content .subcribes .btn_submit' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'style' => ['style_01', 'style_03', 'style_04', 'style_05', 'style_06', 'style_07', 'style_08']
                ]
            ]
        );

        $this->add_control(
            'normal_border_color', [
                'label' => __( 'Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn_four' => 'border: 1px solid {{VALUE}}',
                    '{{WRAPPER}} .saas_banner_btn' => 'border: 1px solid {{VALUE}}',
                    '{{WRAPPER}} .banner_top .subcribes .btn_submit' => 'border: 1px solid {{VALUE}}',
                    '{{WRAPPER}} .prototype_content .btn_three' => 'border: 1px solid {{VALUE}}',
                    '{{WRAPPER}} .section_container .intro_content .subcribes .btn_submit' => 'border: 1px solid {{VALUE}}',
                ],
                'condition' => [
                    'style' => ['style_01', 'style_03', 'style_04', 'style_05', 'style_06', 'style_07', 'style_08']
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
                    'style' => ['style_01', 'style_03', 'style_04', 'style_05', 'style_06', 'style_07', 'style_08']
                ]
            ]
        );

        $this->add_control(
            'hover_font_color', [
                'label' => __( 'Font Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn_four:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .saas_banner_btn:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .banner_top .subcribes .btn_submit:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .prototype_content .btn_three:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .section_container .intro_content .subcribes .btn_submit:hover' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'hover_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn_four:hover' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .saas_banner_btn:hover' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .banner_top .subcribes .btn_submit:hover' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .prototype_content .btn_three:hover' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .section_container .intro_content .subcribes .btn_submit:hover' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'hover_border_color', [
                'label' => __( 'Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn_four:hover' => 'border: 1px solid {{VALUE}}',
                    '{{WRAPPER}} .saas_banner_btn:hover' => 'border: 1px solid {{VALUE}}',
                    '{{WRAPPER}} .banner_top .subcribes .btn_submit:hover' => 'border: 1px solid {{VALUE}}',
                    '{{WRAPPER}} .section_container .intro_content .subcribes .btn_submit:hover' => 'border: 1px solid {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();


        // ----------------------- The Featured Image ----------------------
        $this->start_controls_section(
            'featured_image_sec', [
                'label' => esc_html__( 'Featured Image', 'saasland-core' ),
                'condition' => [
                    'style' => ['style_01', 'style_03', 'style_06', 'style_08', 'style_09']
                ]
            ]
        );

        $this->add_control(
            'featured_img', [
                'label' => esc_html__( 'The Featured Image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'condition' => [
                    'style' => ['style_01', 'style_03', 'style_06', 'style_08', 'style_09']
                ]
            ]
        );

        $this->add_control(
            'right_fimg', [
                'label' => esc_html__( 'Right Featured', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'condition' => [
                    'style' => 'style_09',
                ]
            ]
        );

        $this->end_controls_section();



        /**
         * Style Tab
         * ------------------------------ Style Title ------------------------------
         */
        $this->start_controls_section(
            'style_title', [
                'label' => __( 'Style title', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'color_title', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .saas_subscribe_color' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .saas_subscribe_color',
            ]
        );

        $this->end_controls_section();


        //------------------------------ Style subtitle ------------------------------
        $this->start_controls_section(
            'style_subtitle',
            [
                'label' => __( 'Style subtitle', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => ['style_01', 'style_02', 'style_03', 'style_05', 'style_06', 'style_08', 'style_09']
                ],
            ]
        );

        $this->add_control(
            'color_subtitle', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .banner_top p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .f_300.f_size_18.l_height34.subtitle_color' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .section_container .intro_content p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .prototype_content p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .none p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography_subtitle',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
                    {{WRAPPER}} .banner_top p, 
                    {{WRAPPER}} .f_300.f_size_18.l_height34.subtitle_color, 
                    {{WRAPPER}} .section_container .intro_content p, 
                    {{WRAPPER}} .prototype_content p,
                    {{WRAPPER}} p.f_400.f_size_16.mb-0
                    ',
            ]
        );

        $this->end_controls_section();


        /**
         * Form Styling
         */
        $this->start_controls_section(
            'form_style_sec',
            [
                'label' => __( 'Form Styling', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' =>  [ 'style_02', 'style_04', 'style_08' ],
                ],
            ]
        );

        $this->add_control(
            'form_background_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .s_subcribes .form-control' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .subscribe_form_info .subscribe-form .form-control' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .support_home_area .banner_top .subcribes .form-control' => 'background: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'form_border_color', [
                'label' => __( 'Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .s_subcribes .form-control' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .subscribe_form_info .subscribe-form .form-control' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .support_home_area .banner_top .subcribes .form-control' => 'border-color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'form_submit_btn_color', [
                'label' => __( 'Submit Button Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .s_subcribes .btn-submit' => 'color: {{VALUE}};',
                    'condition' => [
                        'style' =>  [ 'style_02'],
                    ],
                ]
            ]
        );

        $this->end_controls_section();


        /**
         * Background Styling
         */
        $this->start_controls_section(
            'style_bg_color_sec',
            [
                'label' => __( 'Background Styling', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' =>  ['style_02', 'style_03', 'style_04', 'style_08'],
                ],
            ]
        );

        $this->add_control(
            'background_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .s_subscribe_area' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .prototype_banner_area' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .subscribe_form_info' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .support_home_area' => 'background: {{VALUE}};',
                ]
            ]
        );

        $this->end_controls_section();


        //------------------------------ Style Section ------------------------------
        $this->start_controls_section(
            'style_section', [
                'label' => __( 'Style section', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'sec_bg_image', [
                'label' => esc_html__( 'Background image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'condition' => [
                    'style' => 'style_02'
                ],
                'default' => [
                    'url' => plugins_url( 'images/map.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'section_color_left', [
                'label'     => esc_html__( 'Background Color', 'saasland-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .saas_signup_area' => 'background: {{VALUE}};'
                ],
                'condition' => [
                    'style' => ['style_05', 'style_06', 'style_07'],
                ]
            ]
        );

        $this->add_control(
            'section_color_right', [
                'label'     => esc_html__( 'Background Color 02', 'saasland-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '.saas_banner_area_two .section_intro' => 'background-image: -webkit-linear-gradient(-50deg, {{section_color_left.VALUE}} 0%, {{VALUE}} 46%, {{VALUE}} 100%)',
                ),
                'condition' => [
                    'style' => ['style_06', 'style_07'],
                ]
            ]
        );

        $this->add_control(
            'sec_bg_color3', [
                'label' => esc_html__( 'Background Color 03', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'style' => 'style_07'
                ],
                'selectors' => [
                    '{{WRAPPER}} .payment_subscribe_info' => 'background-image: -webkit-linear-gradient(50deg, {{section_color_left.VALUE}} 0%, {{section_color_right.VALUE}} 64%, {{VALUE}} 100%);'
                ]
            ]
        );

        $this->add_responsive_control(
            'sec_padding', [
                'label' => __( 'Section padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .banner_top' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .s_subscribe_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .subscribe_form_info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .saas_signup_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .saas_banner_area_two' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .prototype_banner_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .payment_subscribe_info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',

                ],
            ]
        );

        $this->add_responsive_control(
            'sec_height', [
                'label' => esc_html__( 'Section Height', 'plugin-domain' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1500,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .saas_home_area' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'style' => ['style_01']
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();
        $bg_img = !empty($settings['sec_bg_image']['url']) ? 'style="background: url( '.esc_url($settings['sec_bg_image']['url']).' ) no-repeat scroll center 0/cover;"' : '';
        $title_tag = !empty($settings['title_html_tag']) ? $settings['title_html_tag'] : 'h2';

        if ( $settings['style'] == 'style_01' ) {
            include 'subscribe-form/1.php';
        }

        if ( $settings['style'] == 'style_02' ) {
            include 'subscribe-form/2.php';
        }

        if ( $settings['style'] == 'style_03' ) {
            include 'subscribe-form/3.php';
        }

        if ( $settings['style'] == 'style_04' ) {
            include 'subscribe-form/4.php';
        }

        if ( $settings['style'] == 'style_05' ) {
            include 'subscribe-form/5.php';
        }

        if ( $settings['style'] == 'style_06' ) {
            include 'subscribe-form/6-featured-img.php';
        }

        if ( $settings['style'] == 'style_07' ) {
            include 'subscribe-form/7.php';
        }

        if ( $settings['style'] == 'style_08' ) {
            include 'subscribe-form/8.php';
        }

        if ( $settings['style'] == 'style_09' ) {
            include 'subscribe-form/9.php';
        }

        if ( $settings['style'] == 'style_10' ) {
            include 'subscribe-form/10.php';
        }
        ?>

        <script>
            ;(function($){
                "use strict";
                $(document).ready(function () {
                    // MAILCHIMP
                    if ($(".mailchimp").length > 0) {
                        $(".mailchimp").ajaxChimp({
                            callback: mailchimpCallback,
                            url: "<?php echo esc_js($settings['action_url']) ?>"
                        });
                    }
                    if ($(".mailchimp_two").length > 0) {
                        $(".mailchimp_two").ajaxChimp({
                            callback: mailchimpCallback,
                            url: "<?php echo esc_js($settings['action_url']) ?>" //Replace this with your own mailchimp post URL. Don't remove the "". Just paste the url inside "".
                        });
                    }
                    $(".memail").on("focus", function () {
                        $(".mchimp-errmessage").fadeOut();
                        $(".mchimp-sucmessage").fadeOut();
                    });
                    $(".memail").on("keydown", function () {
                        $(".mchimp-errmessage").fadeOut();
                        $(".mchimp-sucmessage").fadeOut();
                    });
                    $(".memail").on("click", function () {
                        $(".memail").val("");
                    });

                    function mailchimpCallback(resp) {
                        if (resp.result === "success") {
                            $(".mchimp-errmessage").html(resp.msg).fadeIn(1000);
                            $(".mchimp-sucmessage").fadeOut(500);
                        } else if (resp.result === "error") {
                            $(".mchimp-errmessage").html(resp.msg).fadeIn(1000);
                        }
                    }
                });
            })(jQuery)
        </script>

        <?php

    }
}