<?php
namespace SaaslandCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Box_Shadow;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class Hero_Section
 * @package SaaslandCore\Widgets
 */
class Hero_Section extends Widget_Base {
    public function get_name() {
        return 'saasland_hero';
    }

    public function get_title() {
        return __( 'Hero Section', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-device-desktop';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    public function get_style_depends() {
        return [ 'hero-event', 'hero-chat' ];
    }

    public function get_script_depends() {
        return [ 'parallax', 'typed' ];
    }

    public function get_keywords() {
        return [ 'landing hero', 'Mail', 'Digital Marketing', 'Payment Processing', 'Hosting', 'Cloud', 'Background Slide Show', 'Chat', 'Event', 'Demo landing' ];
    }


    protected function _register_controls() {

        // ----------------------------------------  Hero content ------------------------------
        $this->start_controls_section(
            'hero_content',
            [
                'label' => __( 'Hero content', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'style', [
                'label' => esc_html__( 'Hero Style', 'saasland-core' ),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => [
                    'style_01' => esc_html__( '01 Mail', 'saasland-core' ),
                    'style_02' => esc_html__( '02 Digital Marketing', 'saasland-core' ),
                    'style_03' => esc_html__( '03 Cloud', 'saasland-core' ),
                    'style_04' => esc_html__( '04 Dark', 'saasland-core' ),
                    'style_05' => esc_html__( '05 Startup', 'saasland-core' ),
                    'style_06' => esc_html__( '06 Payment Processing', 'saasland-core' ),
                    'style_07' => esc_html__( '07 HR Management', 'saasland-core' ),
                    'style_08' => esc_html__( '08 Hosting', 'saasland-core' ),
                    'style_09' => esc_html__( '09 Background Slide Show', 'saasland-core' ),
                    'style_10' => esc_html__( '10 Analytics', 'saasland-core' ),
                    'style_11' => esc_html__( '11 Demo Landing', 'saasland-core' ),
                    'style_12' => esc_html__( '12 Chat', 'saasland-core' ),
                    'style_13' => esc_html__( '13 Event', 'saasland-core' ),
                    'style_14' => esc_html__( '14 Digital Agency', 'saasland-core' ),
                ],
                'default' => 'style_01'
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );

        $this->add_control(
            'title_note', [
                'label' => '',
                'type' => \Elementor\Controls_Manager::RAW_HTML,
                'raw' => __( 'Input the Typed words within curly braces. <br>Eg Title, True Multi-Purpose Theme for {Saas, Startup, Business} and more.', 'saasland-core' ),
                'content_classes' => 'elementor-warning',
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
            'subtitle',
            [
                'label' => esc_html__( 'Subtitle text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'condition' => [
                    'style' => ['style_01', 'style_02', 'style_03', 'style_04', 'style_05', 'style_06', 'style_07', 'style_08', 'style_09', 'style_10', 'style_11', 'style_14']
                ]
            ]
        );

        $this->end_controls_section(); // End Hero content


        // ---------------------------------------- Upper Title Home Chat --------------------------------
        $this->start_controls_section(
            'upper_title_sec',
            [
                'label' => __( 'Upper Title', 'saasland-core' ),
                'condition' => [
                    'style' => [ 'style_12', 'style_13' ]
                ]
            ]
        );

        $this->add_control(
            'upper_title_img',
            [
                'label' => esc_html__( 'Image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'condition' => [
                    'style' => 'style_12'
                ]
            ]
        );

        $this->add_control(
            'upper_title',
            [
                'label' => esc_html__( 'Upper Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Live chat'
            ]
        );

        $this->add_control(
            'upper_title_color_style', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .chat_banner_content .c_tag' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .event_banner_content h6' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'upper_title_bg_color_style', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .chat_banner_content .c_tag' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'style' => 'style_12'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'upper_title_typo',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} 
                    .chat_banner_content .c_tag,
                    .event_banner_content h6
                    ',
            ]
        );

        $this->end_controls_section(); // End Upper Title


        // ----------------------------------  Featured Images (style 11) -----
        $this->start_controls_section(
            'df_images_sec',
            [
                'label' => __( 'Featured Images', 'saasland-core' ),
                'condition' => [
                    'style' => ['style_11']
                ]
            ]
        );

        $df_images = new \Elementor\Repeater();

        $df_images->add_control(
            'df_items',
            [
                'label' => __( 'View', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::HIDDEN,
            ]
        );

        $df_images->add_control(
            'df_image', [
                'label' => __( 'Image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $df_images->add_responsive_control(
            'df_horizontal',
            [
                'label' => __( 'Horizontal Position', 'saasland-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => -1920,
                        'max' => 1920,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $df_images->add_responsive_control(
            'df_vertical',
            [
                'label' => __( 'Vertical Position', 'saasland-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => -1900,
                        'max' => 1900,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'demo_feature_images', [
                'label' => __( 'Image', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ df_items }}}',
                'fields' => $df_images->get_controls(),
                'prevent_empty' => false
            ]
        );

        $this->add_control(
            'is_parallax_f_images',
            [
                'label' => __( 'Parallax on Featured Images', 'saasland-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'saasland-core' ),
                'label_off' => __( 'No', 'saasland-core' ),
                'return_value' => 'yes',
                'default' => 'yes'
            ]
        );

        $this->end_controls_section(); // End Demo Featured Images

        // -------------------------------------------------- Featured image 1 ------------------------------
        $this->start_controls_section(
            'fimage1_sec', [
                'label' => __( 'Featured image', 'saasland-core' ),
                'condition' => [
                    'style' => ['style_01', 'style_02', 'style_07', 'style_10', 'style_14']
                ]
            ]
        );

        $this->add_control(
            'fimage1', [
                'label' => esc_html__( 'Upload the featured image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'hero/images/women.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'fimage1_size', [
                'label' => __( 'Image max width', 'saasland-core' ),
                'description' => esc_html__( 'Default image width is 100% and height is auto. Input the size in pixel unit.', ''),
                'type' => Controls_Manager::NUMBER,
                'size_units' => [ 'px', '%', 'rem' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .mobile_img .women_img' => 'max-width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .stratup_app_screen .phone' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section(); // End Featured image

        //------------------------------------ Second Featured image -----------------------------------//
        $this->start_controls_section(
            'fimage2_sec', [
                'label' => __( 'Second Featured image', 'saasland-core' ),
                'condition' => [
                    'style' => ['style_01', 'style_07']
                ]
            ]
        );

        $this->add_control(
            'fimage2', [
                'label' => esc_html__( 'Upload the image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'hero/images/mobile.png', __FILE__)
                ]
            ]
        );

        $this->end_controls_section(); // End Featured image

        // -------------------------------------------------- Featured image 1 ------------------------------
        $this->start_controls_section(
            'fimage3_sec', [
                'label' => __( 'Featured image', 'saasland-core' ),
                'condition' => [
                    'style' => ['style_03', 'style_04', 'style_05', 'style_06', 'style_08', 'style_12']
                ]
            ]
        );

        $this->add_control(
            'fimage3', [
                'label' => esc_html__( 'The Featured Image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'hero/images/banner_img.png', __FILE__)
                ]
            ]
        );

        /**
         * Featured Image for Home Chat
         */
        $this->add_control(
            'chat_fimage1', [
                'label' => esc_html__( 'Image One', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'condition' => [
                    'style' =>  'style_12'
                ]
            ]
        );

        $this->add_control(
            'chat_fimage2', [
                'label' => esc_html__( 'Image Two', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'condition' => [
                    'style' =>  'style_12'
                ]
            ]
        );

        $this->add_control(
            'chat_fimage3', [
                'label' => esc_html__( 'Image Three', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'condition' => [
                    'style' =>  'style_12'
                ]
            ]
        );

        $this->end_controls_section(); // End Featured image


        /// -----------------------------  Hero POS Slide Images ----------------------------------//
        $this->start_controls_section(
            'bg_slide-show_sec',
            [
                'label' => __( 'Background Slide Show', 'saasland-core' ),
                'condition' => [
                    'style' => 'style_09'
                ]
            ]
        );

        $this->add_control(
            'bg_overlay_color', [
                'label' => __( 'Overlay Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .pos_slider:before' => 'background: {{VALUE}}',
                )
            ]
        );

        $this->add_control(
            'pos_slide_images', [
                'label' => __( 'Slides', 'saasland-core' ),
                'type' => Controls_Manager::GALLERY,
            ]
        );

        $this->end_controls_section();


        // ------------------------------ Logos ------------------------------//
        $this->start_controls_section(
            'btm_logos', [
                'label' => __( 'Bottom Logos', 'saasland-core' ),
                'condition' => [
                    'style' => ['style_02']
                ]
            ]
        );

        $this->add_control(
            'logos', [
                'label' => esc_html__( 'Upload Logos', 'saasland-core' ),
                'type' => Controls_Manager::GALLERY,
            ]
        );

        $this->end_controls_section(); // End Featured image


        /// --------------------  Buttons ----------------------------------
        $this->start_controls_section(
            'buttons_sec',
            [
                'label' => __( 'Buttons', 'saasland-core' ),
            ]
        );

        $buttons = new \Elementor\Repeater();

        $buttons->add_control(
            'btn_title', [
                'label' => __( 'Button Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Get Started'
            ]
        );

        $buttons->add_control(
            'btn_url', [
                'label' => __( 'Button URL', 'saasland-core' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#'
                ]
            ]
        );

        $buttons->start_controls_tabs(
            'style_tabs'
        );

        /// Normal Button Style
        $buttons->start_controls_tab(
            'style_normal_btn',
            [
                'label' => __( 'Normal', 'saasland-core' ),
            ]
        );

        $buttons->add_control(
            'font_color', [
                'label' => __( 'Font Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}}',
                )
            ]
        );

        $buttons->add_control(
            'bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'background-color: {{VALUE}}; border-color: {{VALUE}}',
                )
            ]
        );

        $buttons->add_control(
            'border_color', [
                'label' => __( 'Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'border: 1px solid {{VALUE}}',
                )
            ]
        );

        $buttons->end_controls_tab();

        /// Hover Button Style
        $buttons->start_controls_tab(
            'style_hover_btn',
            [
                'label' => __( 'Hover', 'saasland-core' ),
            ]
        );

        $buttons->add_control(
            'hover_font_color', [
                'label' => __( 'Font Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'color: {{VALUE}}',
                )
            ]
        );

        $buttons->add_control(
            'hover_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'background: {{VALUE}}',
                )
            ]
        );

        $buttons->add_control(
            'hover_border_color', [
                'label' => __( 'Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '.header_area.navbar_fixed {{WRAPPER}} .nav_right_btn {{CURRENT_ITEM}}:hover' => 'border: 1px solid {{VALUE}}',
                    '{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'border: 1px solid {{VALUE}}',
                )
            ]
        );

        $buttons->end_controls_tab();
        $buttons->end_controls_tabs();

        $buttons->add_responsive_control(
            'btn_padding',
            [
                'label' => __( 'Padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $buttons->add_responsive_control(
            'btn_margin',
            [
                'label' => __( 'Margin', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $buttons->add_responsive_control(
            'btn_border_radius',
            [
                'label' => __( 'Border Radius', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'separator' => 'after',
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $buttons->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'btn_box_shadow',
                'label' => __( 'Box Shadow', 'saasland-core' ),
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}',
            ]
        );

        $buttons->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'btn_typo',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}',
            ]
        );

        // Buttons repeater field
        $this->add_control(
            'buttons', [
                'label' => __( 'Create buttons', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'title_field' => '{{{ btn_title }}}',
                'fields' => $buttons->get_controls(),
            ]
        );

        //------------------------------------------- Bottom Text Home Chat ----------------------------------------
        $this->add_control(
            'is_bottom_text_btn',
            [
                'label' => __( 'Bottom Button Text', 'saasland-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'saasland-core' ),
                'label_off' => __( 'No', 'saasland-core' ),
                'return_value' => 'yes',
                'condition' => [
                    'style' => ['style_12']
                ]
            ]
        );

        $this->add_control(
            'bottom_text_btn',
            [
                'label' => __( 'Button Label', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'condition' => [
                    'is_bottom_text_btn' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'bottom_text_btn_color_style', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .chat_banner_content span' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'is_bottom_text_btn' => 'yes'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'bottom_text_btn_content_typo',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .chat_banner_content span',
                'condition' => [
                    'is_bottom_text_btn' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'is_play_btn',
            [
                'label' => __( 'Play Button', 'saasland-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'saasland-core' ),
                'label_off' => __( 'No', 'saasland-core' ),
                'return_value' => 'yes',
                'condition' => [
                    'style' => ['style_03', 'style_07', 'style_09', 'style_13', 'style_14']
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'play_btn_title', [
                'label' => __( 'Play Button Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Watch Video',
                'condition' => [
                    'is_play_btn' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'play_url', [
                'label' => __( 'Video URL', 'saasland-core' ),
                'description' => __( 'Enter here a YouTube video URL', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'condition' => [
                    'is_play_btn' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'play_btn_color', [
                'label' => __( 'Play Button Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .video_btn .icon, {{WRAPPER}} .video_btn span:before' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .video_btn' => 'color: {{VALUE}}',
                    '{{WRAPPER}} a.popup-youtube.btn_six.slider_btn:hover' => 'background-color: {{VALUE}}; color: #fff;',
                    '{{WRAPPER}} a.popup-youtube.btn_six.slider_btn' => 'color: {{VALUE}}; border-color: {{VALUE}}',
                    '{{WRAPPER}} .event_btn_two' => 'color: {{VALUE}}; border-color: {{VALUE}}',
                    '{{WRAPPER}} .banner_content .play_btn span' => 'color: {{VALUE}}',
                ),
                'condition' => [
                    'is_play_btn' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'play_btn_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .banner_content .play_btn span' => 'background: {{VALUE}}',
                ),
                'condition' => [
                    'is_play_btn' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'play_btn_hover_text_color', [
                'label' => __( 'Hover Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .event_btn_two:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .banner_content .play_btn span:hover' => 'color: {{VALUE}}',
                ),
                'condition' => [
                    'is_play_btn' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'play_btn_hover_color', [
                'label' => __( 'Hover Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .event_btn_two:hover' => 'background: {{VALUE}}; border-color: {{VALUE}}',
                    '{{WRAPPER}} .banner_content .play_btn span:hover' => 'background: {{VALUE}}',
                ),
                'condition' => [
                    'is_play_btn' => 'yes'
                ]
            ]
        );

        $this->end_controls_section(); // End Buttons



        /**
         * Style Tab
         * ------------------------------ Style Title ------------------------------
         */
        $this->start_controls_section(
            'style_title', [
                'label' => __( 'Style Title', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'color_title', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .l_height60' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .f_700.t_color3.mb_40' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .f_500.f_size_50.w_color' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .f_size_40.w_color.mb-0' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .l_height50.w_color.mb_20' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .f_700.f_size_50.w_color' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .hosting_color_s.wow' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .pos_banner_text .saasland_hero_pos' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .saasland_html_class_color' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .banner_text h2' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .startup_content_three h2' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_prefix',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
                    {{WRAPPER}} .l_height50.w_color.mb_20,
                    {{WRAPPER}} .l_height60,
                    {{WRAPPER}} .f_700.t_color3.mb_40,
                    {{WRAPPER}} .f_500.f_size_50.w_color,
                    {{WRAPPER}} .f_size_40.w_color.mb-0,
                    {{WRAPPER}} .f_700.f_size_50.w_color,
                    {{WRAPPER}} .hosting_color_s.wow,
                    {{WRAPPER}} .pos_banner_text .saasland_hero_pos,
                    {{WRAPPER}} .saasland_html_class_color,
                    {{WRAPPER}} .banner_text h2,
                    {{WRAPPER}} .startup_content_three h2',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(), [
                'name' => 'text_shadow_prefix',
                'selector' => '
                    {{WRAPPER}} .l_height60,
                    {{WRAPPER}} .l_height50.w_color.mb_20,
                    {{WRAPPER}} .f_700.t_color3.mb_40,
                    {{WRAPPER}} .f_500.f_size_50.w_color,
                    {{WRAPPER}} .f_size_40.w_color.mb-0,
                    {{WRAPPER}} .f_700.f_size_50.w_color,
                    {{WRAPPER}} .hosting_color_s.wow,
                    {{WRAPPER}} .pos_banner_text .saasland_hero_pos,
                    {{WRAPPER}} .saasland_html_class_color,
                    {{WRAPPER}} .banner_text h2,
                    {{WRAPPER}} .startup_content_three h2
                    ',
            ]
        );

        $this->add_control(
            'color_typed_text', [
                'label' => __( 'Typed Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} h2 mark' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'color_underline_typed_text', [
                'label' => __( 'Typed Text Underline Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .typewrite_title mark:after' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_border_height',
            [
                'label' => __( 'Underline Height', 'saasland-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ]

                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .typewrite_title mark:after' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typewrite_title_typo',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .typewrite_title mark span',
            ]
        );


        $this->end_controls_section();


        //------------------------------ Style Subtitle ------------------------------
        $this->start_controls_section(
            'style_subtitle_sec', [
                'label' => __( 'Style Subtitle', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => ['style_01', 'style_02', 'style_03', 'style_04', 'style_05', 'style_06', 'style_07', 'style_08', 'style_09', 'style_10', 'style_11']
                ]
            ]
        );

        $this->add_control(
            'color_subtitle', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider_content p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .startup_content_three p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .f_300.l_height28' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .software_banner_content p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .saas_banner_content.text-center p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .payment_banner_content p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .hosting_content p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .pos_banner_text h6' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .h_analytics_content p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .banner_text p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_subtitle',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
                {{WRAPPER}} .slider_content p,
                {{WRAPPER}} .startup_content_three p,
                {{WRAPPER}} .f_300.l_height28,
                {{WRAPPER}} .software_banner_content p,
                {{WRAPPER}} .saas_banner_content.text-center p,
                {{WRAPPER}} .payment_banner_content p,
                {{WRAPPER}} .hosting_content p,
                {{WRAPPER}} .pos_banner_text h6,
                {{WRAPPER}} .h_analytics_content p,
                {{WRAPPER}} .banner_text p
                ',
            ]
        );

        $this->end_controls_section();

        /**
         * Shape Images (Style 01)
         **/
        $this->start_controls_section(
            'mail_shape_sec', [
                'label' => __( 'Shape Images', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => [ 'style_01', 'style_14' ]
                ]
            ]
        );

        $this->add_control(
            'mail_shape_img1', [
                'label' => esc_html__( 'Image One', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'hero/images/shape_02.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'mail_shape_img2', [
                'label' => esc_html__( 'Image Two', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'hero/images/shape_03.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'mail_shape_img3', [
                'label' => esc_html__( 'Image Three', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'hero/images/shape_01.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'mail_shape_img4', [
                'label' => esc_html__( 'Image Four', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'hero/images/shape.png', __FILE__)
                ]
            ]
        );

        $this->end_controls_section();


        /**
         * Shape Images (Style 04)
         **/
        $this->start_controls_section(
            'dark_shape_sec', [
                'label' => __( 'Shape Images', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => ['style_04']
                ]
            ]
        );

        $this->add_control(
            'dark_shape_img1', [
                'label' => esc_html__( 'Image One', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'hero/images/shape-1.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'dark_shape_img2', [
                'label' => esc_html__( 'Image Two', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'hero/images/shape2.png', __FILE__)
                ]
            ]
        );

        $this->end_controls_section();


        /**
         * Shape Images (Style 06)
         **/
        $this->start_controls_section(
            'payment_pro_shape_sec', [
                'label' => __( 'Shape Image', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => 'style_06'
                ]
            ]
        );

        $this->add_control(
            'payment_pro_shape_img', [
                'label' => esc_html__( 'Image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'hero/images/shape_home9.png', __FILE__)
                ]
            ]
        );

        $this->end_controls_section();


        /**
         * Shape Images (Style 07)
         **/
        $this->start_controls_section(
            'hr_management_shape_sec', [
                'label' => __( 'Shape Images', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => 'style_07'
                ]
            ]
        );

        $this->add_control(
            'hr_management_shape', [
                'label' => esc_html__( 'Image One', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'hero/images/startup_shap.png', __FILE__)
                ]
            ]
        );

        $this->end_controls_section();


        /**
         * Shape Images (Style 08)
         **/
        $this->start_controls_section(
            'hosting_shape_img_sec',
            [
                'label' => esc_html__( 'Shape Images', 'saasland-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => 'style_08'
                ]
            ]
        );

        $this->add_control(
            'hos_shape1', [
                'label' => esc_html__( 'Shape One', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( '/hero/images/home-hosting/line_01.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'hos_shape2', [
                'label' => esc_html__( 'Shape Two', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( '/hero/images/home-hosting/line_02.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'hos_shape3', [
                'label' => esc_html__( 'Shape Three', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( '/hero/images/home-hosting/line_03.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'hos_shape4', [
                'label' => esc_html__( 'Shape Four', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( '/hero/images/home-hosting/line_04.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'hos_shape5', [
                'label' => esc_html__( 'Shape Five', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( '/hero/images/home-hosting/line_05.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'hos_shape6', [
                'label' => esc_html__( 'Shape Six', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( '/hero/images/home-hosting/line_06.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'hos_shape7', [
                'label' => esc_html__( 'Shape Seven', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( '/hero/images/home-hosting/line_07.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'hos_shape8', [
                'label' => esc_html__( 'Shape Eight', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( '/hero/images/home-hosting/line_08.png', __FILE__)
                ]
            ]
        );

        $this->end_controls_section(); // End Hosting Shape Images


        /**
         * Shape Images (Style 10)
         **/
        $this->start_controls_section(
            'analytics_shape_sec', [
                'label' => __( 'Shape Images', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => 'style_10'
                ]
            ]
        );

        $this->add_control(
            'analytics_shape_img1', [
                'label' => esc_html__( 'Image One', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'hero/images/home-analytics/elements_one.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'analytics_shape_img2', [
                'label' => esc_html__( 'Image Two', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'hero/images/home-analytics/elements_two.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'analytics_shape_img3', [
                'label' => esc_html__( 'Image Three', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'hero/images/home-analytics/elements_three.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'analytics_shape_img4', [
                'label' => esc_html__( 'Image Four', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'hero/images/home-analytics/elements_four.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'analytics_shape_img5', [
                'label' => esc_html__( 'Image Five', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'hero/images/home-analytics/elements_five.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'analytics_shape_img6', [
                'label' => esc_html__( 'Image Six', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'hero/images/home-analytics/elements_six.png', __FILE__)
                ]
            ]
        );

        $this->end_controls_section();


        /**
         * Shape Images (Style 11)
         **/
        $this->start_controls_section(
            'demo_shape_images_sec', [
                'label' => __( 'Shape Images', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => ['style_11']
                ]
            ]
        );

        $this->add_control(
            'demo_shape1', [
                'label' => esc_html__( 'Shape One', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'hero/images/demo-landing/circle-2.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'demo_shape2', [
                'label' => esc_html__( 'Shape Two', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'hero/images/demo-landing/shape_02.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'demo_shape3', [
                'label' => esc_html__( 'Shape Three', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'hero/images/demo-landing/shape_03.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'demo_shape4', [
                'label' => esc_html__( 'Shape Four', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'hero/images/demo-landing/shape_04.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'demo_shape5', [
                'label' => esc_html__( 'Shape Five', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'hero/images/demo-landing/shape_05.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'demo_shape6', [
                'label' => esc_html__( 'Shape Six', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'hero/images/demo-landing/shape_06.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'demo_shape7', [
                'label' => esc_html__( 'Shape Seven', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'hero/images/demo-landing/shape_07.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'demo_shape8', [
                'label' => esc_html__( 'Shape Eight', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'hero/images/demo-landing/shape_08.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'demo_shape9', [
                'label' => esc_html__( 'Shape Nine', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'hero/images/demo-landing/dot.png', __FILE__)
                ]
            ]
        );

        $this->end_controls_section();

        /**
         * Shape Images (Style 12)
         **/
        $this->start_controls_section(
            'chat_shape_images_sec', [
                'label' => __( 'Shape Images', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => ['style_12']
                ]
            ]
        );

        $this->add_control(
            'chat_shape1', [
                'label' => esc_html__( 'Moving Cloud Shape', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'chat/img/cloud.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'chat_shape2', [
                'label' => esc_html__( 'Left Corner Shape', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'chat/img/left_leaf.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'chat_shape3', [
                'label' => esc_html__( 'Right Corner Shape', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'chat/img/right_leaf.png', __FILE__)
                ]
            ]
        );

        $this->end_controls_section();


        /**
         * Background Style
         */
        //------------------------------ Background Color ------------------------------
        $this->start_controls_section(
            'hr_bg_color_sec', [
                'label' => __( 'Style Section Background', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => ['style_07', 'style_11', 'style_12'],
                ]
            ]
        );

        $this->add_control(
            'hr_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .startup_banner_area_three' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .banner_area' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .chat_banner_area' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();


        //------------------------------ Style Gradient Background Section ------------------------------
        $this->start_controls_section(
            'background_style',
            [
                'label' => esc_html__( 'Background Gradient Color', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => ['style_01', 'style_02', 'style_03', 'style_04', 'style_05', 'style_06', 'style_10', 'style_13'],
                ]
            ]
        );

        $this->add_control(
            'bg_image_stl2', [
                'label' => esc_html__( 'Background Image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'hero/images/banner_bg_stl2.png', __FILE__)
                ],
                'condition' => [
                    'style' => [ 'style_02', 'style_13' ]
                ]
            ]
        );

        $this->add_control(
            'event_round_box_color', [
                'label'     => esc_html__( 'Round Box Color', 'saasland-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .event_banner_content .round' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'style' => 'style_13'
                ]
            ]
        );

        $this->add_control(
            'section_color_left', [
                'label'     => esc_html__( 'Background Color', 'saasland-core' ),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'style' => ['style_01', 'style_03', 'style_04', 'style_05', 'style_06', 'style_10', 'style_13'],
                ]
            ]
        );

        $this->add_control(
            'section_color_right', [
                'label'     => esc_html__( 'Background Color 02', 'saasland-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .slider_area'      => 'background-image: -webkit-linear-gradient(40deg, {{section_color_left.VALUE}} 0%, {{VALUE}} 100%)',
                    '{{WRAPPER}} .saas_banner_area' => 'background-image: -webkit-linear-gradient(40deg, {{section_color_left.VALUE}} 0%, {{VALUE}} 100%)',
                    '{{WRAPPER}} .agency_banner_area_two' => 'background-image: -webkit-linear-gradient(40deg, {{section_color_left.VALUE}} 0%, {{VALUE}} 100%)',
                    '{{WRAPPER}} .payment_banner_area' => 'background-image: -webkit-linear-gradient(40deg, {{section_color_left.VALUE}} 0%, {{VALUE}} 100%)',
                    '{{WRAPPER}} .software_banner_area' => 'background: -webkit-linear-gradient( 140deg, {{section_color_left.VALUE}} 0%, {{VALUE}} 100%)',
                    '{{WRAPPER}} .home_analytics_banner_area' => 'background: -webkit-linear-gradient(-50deg, {{section_color_left.VALUE}} 0%, {{VALUE}} 100%)',
                    '{{WRAPPER}} .event_banner_area' => 'background-image: -webkit-linear-gradient(-120deg, {{section_color_left.VALUE}} 0%, {{VALUE}} 100%)',
                ),
                'condition' => [
                    'style' => ['style_01', 'style_03', 'style_04', 'style_05', 'style_06', 'style_10', 'style_13'],
                ]
            ]
        );

        $this->end_controls_section();

        //------------------------------ Style Gradient Background Section ------------------------------
        $this->start_controls_section(
            'pos_bg_color_sec',
            [
                'label' => esc_html__( 'Background Overlay', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' =>  'style_09'
                ]
            ]
        );

        $this->add_control(
            'pos_bg_overlay_color', [
                'label' => __( 'Background Overlay', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pos_slider:before' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        //------------------------------ Style Gradient Background Section ------------------------------
        $this->start_controls_section(
            'hosting_bg_color_sec',
            [
                'label' => esc_html__( 'Background Color', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' =>  'style_08'
                ]
            ]
        );

        $this->add_control(
            'hosting_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hosting_banner_area' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        //------------------------------ Style Subtitle ------------------------------
        $this->start_controls_section(
            'style_bg_shape_sec', [
                'label' => __( 'Background Right Corner Shape', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => 'style_05',
                ]
            ]
        );

        $this->add_control(
            'shape_color', [
                'label' => __( 'Shape Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dot_shap' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'shape1_position', [
                'label' => __( 'Shape One Position', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => 'px',
                'selectors' => [
                    '{{WRAPPER}} .dot_shap.one' => 'top: {{TOP}}{{UNIT}}; right: {{RIGHT}}{{UNIT}}; bottom: {{BOTTOM}}{{UNIT}}; left: {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'isLinked' => false
                ],
            ]
        );

        $this->add_control(
            'shape2_position', [
                'label' => __( 'Shape Two Position', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => 'px',
                'selectors' => [
                    '{{WRAPPER}} .dot_shap.two' => 'top: {{TOP}}{{UNIT}}; right: {{RIGHT}}{{UNIT}}; bottom: {{BOTTOM}}{{UNIT}}; left: {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'isLinked' => false
                ],
            ]
        );

        $this->add_control(
            'shape3_position', [
                'label' => __( 'Shape Three Position', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .dot_shap.three' => 'top: {{TOP}}{{UNIT}}; right: {{RIGHT}}{{UNIT}}; bottom: {{BOTTOM}}{{UNIT}}; left: {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'isLinked' => false
                ],
            ]
        );

        $this->end_controls_section();


        //------------------------------ Style Shape one gradient ------------------------------
        $this->start_controls_section(
            'style_bg_gradient_sec', [
                'label' => __( 'Background Gradient Shape One', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => 'style_06',
                ]
            ]
        );

        $this->add_control(
            'shape_bg_color', [
                'label' => esc_html__( 'Color One', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
            ]
        );

        $this->add_control(
            'shape_bg_color2', [
                'label' => esc_html__( 'Color Two', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .payment_banner_area .shape' => 'background-image: -webkit-linear-gradient(-57deg, {{shape_bg_color2.VALUE}} 0%, {{VALUE}} 100%);',
                ],
            ]
        );

        $this->end_controls_section();

        //------------------------------ Style Shape Two gradient ------------------------------
        $this->start_controls_section(
            'style_bg_gradient_sec2', [
                'label' => __( 'Background Gradient Shape Two', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => 'style_06',
                ]
            ]
        );

        $this->add_control(
            'shape2_bg_color', [
                'label' => esc_html__( 'Color One', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
            ]
        );

        $this->add_control(
            'shape2_bg_color2', [
                'label' => esc_html__( 'Color Two', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .payment_banner_area .shape.two' => 'background-image: -webkit-linear-gradient(-75deg, {{shape2_bg_color2.VALUE}} 0%, {{VALUE}} 100%);',
                ],
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'style_bg_14', [
                'label' => __( 'Background', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => 'style_14',
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'sec_background_14',
                'label' => __( 'Background', 'saasland-core' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .banner_section.home_one_banner',
            ]
        );
        $this->end_controls_section();


    }

    protected function render() {
        $settings = $this->get_settings();
        $buttons = $settings['buttons'];
        $title_tag = !empty($settings['title_html_tag']) ? $settings['title_html_tag'] : 'h2';

        if ( $settings['style'] == 'style_01' ) {
            include 'hero/01_mail.php';
        }

        if ( $settings['style'] == 'style_02' ) {
            include 'hero/02_digital-marketing.php';
        }

        if ( $settings['style'] == 'style_03' ) {
            include 'hero/03_cloud.php';
        }

        if ( $settings['style'] == 'style_04' ) {
            include 'hero/04_dark.php';
        }

        if ( $settings['style'] == 'style_05' ) {
            include 'hero/05_startup.php';
        }

        if ( $settings['style'] == 'style_06' ) {
            include 'hero/06_payment-processing.php';
        }

        if ( $settings['style'] == 'style_07' ) {
            include 'hero/07_hr-management.php';
        }

        if ( $settings['style'] == 'style_08' ) {
            include 'hero/08_hosting.php';
        }

        if ( $settings['style'] == 'style_09' ) {
            include 'hero/09_pos.php';
        }

        if ( $settings['style'] == 'style_10' ) {
            include 'hero/10_analytics-software.php';
        }

        if ( $settings['style'] == 'style_11' ) {
            include 'hero/11_demo-landing.php';
        }

        if ( $settings['style'] == 'style_12' ) {
            include 'hero/chat/hero-chat.php';
        }

        if ( $settings['style'] == 'style_13' ) {
            include 'hero/event/hero-event.php';
        }

        if ( $settings['style'] == 'style_14' ) {
            include 'hero/agency/digital-agency.php';
        }
    }
}