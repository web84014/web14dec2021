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
 * Services & Features with Shapes
 * Class Services_shapes
 * @package SaaslandCore\Widgets
 */
class Services_shapes extends Widget_Base {
    public function get_name() {
        return 'saasland_services_shapes';
    }

    public function get_title() {
        return __( 'Services & Features <br> with Shapes', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-posts-grid';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    protected function _register_controls() {
        // ------------------------------  Title ------------------------------
        $this->start_controls_section(
            'title_sec', [
                'label' => esc_html__( 'Section Title', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'title', [
                'label' => esc_html__( 'Title text', 'saasland-core' ),
                'description' => esc_html__( 'Use <br> tag for line spacing.', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
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

        $this->end_controls_section();


        // ------------------------------  Subtitle ------------------------------
        $this->start_controls_section(
            'subtitle_sec', [
                'label' => __( 'Section Subtitle', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'subtitle', [
                'label' => esc_html__( 'Subtitle text', 'saasland-core' ),
                'description' => esc_html__( 'Use <br> tag for line breaking.', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );

        $this->end_controls_section(); // End title section


        // ------------------------------  Contents ------------------------------
        $this->start_controls_section(
            'content_sec', [
                'label' => __( 'Contents', 'saasland-core' ),
            ]
        );

        $service_fields = new \Elementor\Repeater();

        $service_fields->add_control(
            'title',
            [
                'label' => __( 'Service Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Default Title'
            ]
        );

        $service_fields->add_control(
            'title_html_tag_service',
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
                'default' => 'h5',
                'separator' => 'before',
            ]
        );
        $service_fields->add_control(
            'ti_icon',
            [
                'label' => __( 'Icon', 'karpartz-core' ),
                'type' => Controls_Manager::ICON,
                'options' => saasland_themify_icons(),
                'include' => saasland_include_themify_icons(),
                'default' => 'icon-trophy',
            ]
        );
        $service_fields->add_control(
            'content',
            [
                'label' => __( 'Service Content', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );
        $service_fields->add_control(
            'link_title',
            [
                'label'     => esc_html__( 'Link Title', 'saasland-core' ),
                'type'      => Controls_Manager::TEXT,
            ]
        );
        $service_fields->add_control(
            'link_url',
            [
                'label'     => esc_html__( 'Link URL', 'saasland-core' ),
                'type'      => Controls_Manager::URL,
                'default'   => [
                    'url' => '#'
                ]
            ]
        );

        // Color Tabs Start
        $service_fields->start_controls_tabs(
            'colors_tabs'
        );
        $service_fields->start_controls_tab(
            'icon_colors_tab',
            [
                'label' => __( 'Icon Colors', 'saasland-core' ),
            ]
        );
        $service_fields->add_control(
            'icon_color',
            [
                'label'     => esc_html__( 'Icon Color', 'saasland-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .icon' => 'color: {{VALUE}};',
                ],
            ]
        );
        $service_fields->add_control(
            'icon_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'saasland-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .icon' => 'background-color: {{VALUE}};',
                ],
                'default' => 'rgba(255, 255, 255, 0.059)'
            ]
        );
        $service_fields->add_control(
            'icon_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'saasland-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .icon' => 'border-color: {{VALUE}};',
                ],
                'default' => 'rgba(255, 255, 255, 0.3)'
            ]
        );
        $service_fields->end_controls_tab();

        $service_fields->start_controls_tab(
            'background_color_tab',
            [
                'label' => __( 'Background Color', 'saasland-core' ),
            ]
        );
        $service_fields->add_control(
            'bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'saasland-core' ),
                'type'      => Controls_Manager::COLOR,
            ]
        );
        $service_fields->add_control(
            'bg_color2',
            [
                'label'     => esc_html__( 'Background Color 02', 'saasland-core' ),
                'type'      => Controls_Manager::COLOR,
            ]
        );
        $service_fields->add_control(
            'bg_angle',
            [
                'label' => __( 'Angle', 'saasland-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'deg' => [
                        'min' => 0,
                        'max' => 360,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'size' => 40,
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'background-image: -webkit-linear-gradient({{SIZE}}deg, {{bg_color.VALUE}} 0%, {{bg_color2.VALUE}} 100%);',
                ],
            ]
        );

        $service_fields->end_controls_tab();

        $service_fields->end_controls_tabs();

        $this->add_control(
            'service_box', [
                'label' => __( 'Service Boxes', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ title }}}',
                'fields' => $service_fields->get_controls(),
                'prevent_empty' => false
            ]
        );

        $this->add_control(
            'list_services', [
                'label' => __( 'Service Lists', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ title }}}',
                'prevent_empty' => false,
                'fields' => [
                    [
                        'name' => 'is_row_reverse',
                        'label' => __( 'Row Reverse', 'saasland-core' ),
                        'type' => Controls_Manager::SWITCHER,
                        'label_on' => __( 'Yes', 'saasland-core' ),
                        'label_off' => __( 'No', 'saasland-core' ),
                        'return_value' => 'yes',
                        'default' => 'yes',
                    ],
                    [
                        'name' => 'title',
                        'label' => __( 'Service Title', 'saasland-core' ),
                        'description' => esc_html__( 'Use <br> tag for line breaking.', 'saasland-core' ),
                        'type' => Controls_Manager::TEXTAREA,
                        'label_block' => true,
                        'default' => 'Default Title',
                    ],
                    [
                        'name' => 'title_html_tag_list',
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
                    ],
                    [
                        'name' => 'featured_image',
                        'label' => __( 'Featured Image', 'saasland-core' ),
                        'type' => Controls_Manager::MEDIA,
                    ],
                    [
                        'name' => 'content',
                        'label' => __( 'Service Content', 'saasland-core' ),
                        'type' => Controls_Manager::TEXTAREA,
                        'label_block' => true,
                        'default' => "Use Timeline to plan projects right the first time. See how the pieces fit together so you can spot gaps and overlaps before you start."
                    ],
                    [
                        'name'       => 'ti_icon',
                        'label'      => esc_html__( 'Icon', 'saasland-core' ),
                        'type'       => Controls_Manager::ICON,
                        'options'    => saasland_themify_icons(),
                        'include'    => saasland_include_themify_icons(),
                        'default'    => 'ti-loop',
                    ],
                    [
                        'name'      => 'icon_color',
                        'label'     => esc_html__( 'Icon Color', 'saasland-core' ),
                        'type'      => Controls_Manager::COLOR,
                    ],
                    [
                        'name'      => 'icon_bg_color',
                        'label'     => esc_html__( 'Icon Background Color', 'saasland-core' ),
                        'type'      => Controls_Manager::COLOR,
                    ],
                    [
                        'name'      => 'icon_border_color',
                        'label'     => esc_html__( 'Icon Border Color', 'saasland-core' ),
                        'type'      => Controls_Manager::COLOR,
                    ],
                    [
                        'name'      => 'link_title',
                        'label'     => esc_html__( 'Link Title', 'saasland-core' ),
                        'type'      => Controls_Manager::TEXT,
                        'default'   => 'Get Started Now! '
                    ],
                    [
                        'name'      => 'link_url',
                        'label'     => esc_html__( 'Link URL', 'saasland-core' ),
                        'type'      => Controls_Manager::URL,
                        'default'   => [
                            'url' => '#'
                        ]
                    ],
                ],
            ]
        );

        $this->end_controls_section();


        // ------------------------------  Title ------------------------------
        $this->start_controls_section(
            'feature_column_sec', [
                'label' => esc_html__( 'Box Feature Column', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'column', [
                'label' => __( 'column', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '6' => esc_html__( 'Two', 'saasland-core' ),
                    '4' => esc_html__( 'Three', 'saasland-core' ),
                    '3' => esc_html__( 'Four', 'saasland-core' ),
                ],
                'default' => '3'
            ]
        );

        $this->end_controls_section();


        // ----------------------------- Style Title ----------------------------------//
        $this->start_controls_section(
            'style_title_sec', [
                'label' => esc_html__( 'Style Title', 'saasland-core' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_control(
            'color_title', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .t_color.text-center' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .t_color.text-center, {{WRAPPER}} .bike_section_title',
            ]
        );
        $this->end_controls_section();

        // ----------------------------- Style Subtitle ----------------------------------//
        $this->start_controls_section(
            'style_subtitle_sec', [
                'label' => esc_html__( 'Style Subtitle', 'saasland-core' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'color_subtitle', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .s_service_section .custom_container>p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_subtitle',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .s_service_section .custom_container>p',
            ]
        );

        $this->end_controls_section();


        // ----------------------------- Box Style Item Title Section  ----------------------------------//
        $this->start_controls_section(
            'item_title_style', [
                'label' => esc_html__( 'Box Item Title', 'saasland-core' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'item_title_color', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .t_color.color_box' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_content_title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .t_color.color_box',
            ]
        );

        $this->end_controls_section();


        // ----------------------------- Style Item Description Section  ----------------------------------//
        $this->start_controls_section(
            'item_des_sec', [
                'label' => esc_html__( 'Box item description', 'saasland-core' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'item_des_color', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} p.l_height28' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_item_des',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} p.l_height28',
            ]
        );

        $this->end_controls_section();


        // ----------------------------- Style Item Description Section  ----------------------------------//
        $this->start_controls_section(
            'style_box_feature_btn_settings', [
                'label' => esc_html__( 'Box Item Button', 'saasland-core' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'box_item_btn_color', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .s_service_item .learn_btn_two' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .learn_btn_two:before' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_box_item_typo',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .s_service_item .learn_btn_two',
            ]
        );

        $this->end_controls_section();


        // ----------------------------- List Style Item Title Section  ----------------------------------//
        $this->start_controls_section(
            'list_item_title_style', [
                'label' => esc_html__( 'List item title', 'saasland-core' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'list_item_title_color', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .f_p.f_size_30.f_600.t_color.title_color1.l_height45' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_list_content_title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .f_p.f_size_30.f_600.t_color.title_color1.l_height45',
            ]
        );

        $this->end_controls_section();


        // ----------------------------- List Style Item Description Section  ----------------------------------//
        $this->start_controls_section(
            'list_item_des_sec', [
                'label' => esc_html__( 'List item description', 'saasland-core' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'list_item_des_color', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} p.f_size_18.l_height30.f_400' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_item_des_list',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} p.f_size_18.l_height30.f_400',
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
            'sec_padding', [
                'label' => __( 'Section padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .s_service_section' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',

                ],
            ]
        );

        $this->end_controls_section();


        //------------------------------ Background Shapes ------------------------------
        $this->start_controls_section(
            'bg_shapes_sec', [
                'label' => __( 'Background Shapes', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'is_shape1',
            [
                'label' => __( 'Shape 01', 'saasland-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'saasland-core' ),
                'label_off' => __( 'No', 'saasland-core' ),
                'return_value' => 'yes',
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'is_shape2',
            [
                'label' => __( 'Shape 02', 'saasland-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'saasland-core' ),
                'label_off' => __( 'No', 'saasland-core' ),
                'return_value' => 'yes',
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'is_shape3',
            [
                'label' => __( 'Shape 03', 'saasland-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'saasland-core' ),
                'label_off' => __( 'No', 'saasland-core' ),
                'return_value' => 'yes',
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'is_shape4',
            [
                'label' => __( 'Shape 04', 'saasland-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'saasland-core' ),
                'label_off' => __( 'No', 'saasland-core' ),
                'return_value' => 'yes',
                'default' => 'yes'
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings();
        $services = isset($settings['service_box']) ? $settings['service_box'] : '';
        $list_services = isset($settings['list_services']) ? $settings['list_services'] : '';
        $title_tag = !empty($settings['title_html_tag']) ? $settings['title_html_tag'] : 'h2';
       ?>
       <!--============ Car Testimonial Area ==============-->
        <section class="service_promo_area">
        <div class="shape_top">
            <?php if ( $settings['is_shape1'] == 'yes' ) : ?>
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="shape shape_one">
                    <defs>
                        <linearGradient>
                            <stop offset="0%" stop-color="rgb(76,1,124)" stop-opacity="0.95" />
                            <stop offset="100%" stop-color="rgb(103,84,226)" stop-opacity="0.95" />
                        </linearGradient>
                    </defs>
                    <path d="M121.891,264.576 L818.042,11.198 C914.160,-23.786 1020.439,25.773 1055.424,121.890 L1308.802,818.041 C1343.786,914.159 1294.227,1020.439 1198.109,1055.422 L501.958,1308.801 C405.840,1343.785 299.560,1294.226 264.576,1198.108 L11.198,501.957 C-23.786,405.839 25.773,299.560 121.891,264.576 Z"/>
                </svg>
            <?php endif; ?>

            <?php if ( $settings['is_shape2'] == 'yes' ) : ?>
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="shape shape_two">
                    <defs>
                        <linearGradient id="PSgrad_0">
                            <stop offset="0%" stop-color="rgb(76,1,124)" stop-opacity="0.95" />
                            <stop offset="100%" stop-color="rgb(103,84,226)" stop-opacity="0.95" />
                        </linearGradient>

                    </defs>
                    <path fill="url(#PSgrad_0)"
                          d="M121.891,264.575 L818.042,11.198 C914.160,-23.786 1020.439,25.772 1055.424,121.890 L1308.802,818.040 C1343.786,914.159 1294.227,1020.439 1198.109,1055.423 L501.958,1308.801 C405.840,1343.785 299.560,1294.226 264.576,1198.107 L11.198,501.957 C-23.786,405.839 25.773,299.560 121.891,264.575 Z"/>
                </svg>
            <?php endif; ?>

            <?php if ( $settings['is_shape3'] == 'yes' ) : ?>
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="shape shape_three">
                    <defs>
                        <linearGradient id="PSgrad_1">
                            <stop offset="0%" stop-color="rgb(76,1,124)" stop-opacity="0.95" />
                            <stop offset="100%" stop-color="rgb(103,84,226)" stop-opacity="0.95" />
                        </linearGradient>

                    </defs>
                    <path fill="url(#PSgrad_1)"
                          d="M1198.109,264.576 L501.958,11.198 C405.840,-23.787 299.560,25.772 264.576,121.891 L11.198,818.041 C-23.786,914.159 25.773,1020.439 121.891,1055.422 L818.042,1308.801 C914.160,1343.785 1020.439,1294.226 1055.424,1198.108 L1308.802,501.957 C1343.786,405.839 1294.227,299.560 1198.109,264.576 Z"/>
                </svg>
            <?php endif; ?>

            <?php if ( $settings['is_shape4'] == 'yes' ) : ?>
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="shape shape_four">
                    <defs>
                        <linearGradient id="PSgrad_2">
                            <stop offset="0%" stop-color="rgb(76,1,124)" stop-opacity="0.95" />
                            <stop offset="100%" stop-color="rgb(103,84,226)" stop-opacity="0.95" />
                        </linearGradient>

                    </defs>
                    <path fill="url(#PSgrad_2)"
                          d="M1198.109,264.575 L501.958,11.198 C405.840,-23.787 299.560,25.772 264.576,121.890 L11.198,818.040 C-23.786,914.158 25.773,1020.439 121.891,1055.423 L818.042,1308.801 C914.160,1343.785 1020.440,1294.225 1055.424,1198.107 L1308.802,501.957 C1343.786,405.839 1294.227,299.560 1198.109,264.575 Z"/>
                </svg>
            <?php endif; ?>
         </div>
         <div class="s_service_section">
             <div class="container custom_container">
                     <<?php echo $title_tag ?> class="f_p f_size_30 l_height50 f_600 t_color text-center">
                         <?php echo wp_kses_post($settings['title']) ?>
                     </<?php echo $title_tag ?>>

                 <?php if (!empty($settings['subtitle'])) : ?>
                     <p class="f_300 text-center f_size_18 l_height34"> <?php echo wp_kses_post($settings['subtitle']) ?> </p>
                 <?php endif; ?>
                 <div class="row s_service_info mt_70">
                 <?php
                 if ( !empty($services) ) :
                 foreach ($services as $service) :
                     $title_tag_service = !empty($service['title_html_tag_service']) ? $service['title_html_tag_service'] : 'h5';
                     ?>
                     <div class="col-lg-<?php echo esc_attr($settings['column']) ?> col-sm-6">
                     <div class="s_service_item elementor-repeater-item-<?php echo $service['_id'] ?>">
                         <div class="icon icon_1">
                             <i class="<?php echo esc_attr($service['ti_icon']) ?>"></i>
                         </div>
                         <<?php echo $title_tag_service; ?> class="f_p f_size_20 f_600 t_color color_box"> <?php echo esc_html($service['title']) ?> </<?php echo $title_tag_service ?>>
                         <p class="l_height28"> <?php echo $service['content'] ?> </p>
                         <?php if (!empty($service['link_title'])) : ?>
                             <a href="<?php echo esc_attr($service['link_url']['url']) ?>" class="learn_btn_two" <?php saasland_is_external($service['link_url']) ?>>
                                 <?php echo esc_html($service['link_title']) ?>
                                 <i class="ti-arrow-right"></i>
                             </a>
                         <?php endif; ?>
                     </div>
                     </div>
                 <?php endforeach; ?>
                 <?php endif; ?>
                 </div>
             </div>
         </div>
         <?php if ( $list_services ) : ?>
         <div class="s_features_section">
             <div class="container custom_container">
                 <?php
                 foreach ($list_services as $index => $list_service) {
                     $icon_color = !empty($list_service['icon_color']) ? 'color:'.$list_service['icon_color'].';' : '';
                     $icon_bg_color = !empty($list_service['icon_bg_color']) ? 'background-color:'.$list_service['icon_bg_color'].';' : '';
                     $icon_border_color = !empty($list_service['icon_border_color']) ? 'border-color:'.$list_service['icon_border_color'].';' : '';
                     $is_row_reverse = $list_service['is_row_reverse']=='yes' ? 's_features_item_two flex-row-reverse' : '';
                     $title_tag_list = !empty($list_service['title_html_tag_list']) ? $list_service['title_html_tag_list'] : 'h2';
                     ?>
                     <div class="row s_features_item <?php echo ($index > 0) ? 'mt_100 ' : ''; echo $is_row_reverse; ?>">
                         <?php if (!empty($list_service['featured_image']['id'])) : ?>
                         <div class="col-lg-6">
                             <div class="s_features_img ml_50">
                                 <?php echo wp_get_attachment_image($list_service['featured_image']['id'], 'full' ) ?>
                             </div>
                         </div>
                        <?php endif; ?>
                         <div class="col-lg-6 d-flex align-items-center">
                             <div class="s_features_content pl_120">
                                 <div class="icon_square" style="<?php echo $icon_color.$icon_bg_color.$icon_border_color; ?>">
                                     <i class="<?php echo esc_attr($list_service['ti_icon']) ?>"></i>
                                 </div>
                                 <?php if (!empty($list_service['title'])) : ?>
                                    <<?php echo $title_tag_list; ?> class="f_p f_size_30 f_600 t_color title_color1  l_height45"><?php echo wp_kses_post($list_service['title']) ?></<?php echo $title_tag_list; ?>>
                                 <?php endif; ?>
                                 <p class="f_size_18 l_height30 f_300"> <?php echo $list_service['content'] ?> </p>
                                <?php if (!empty($list_service['link_title'])) : ?>
                                     <a href="<?php echo esc_attr($list_service['link_url']['url']) ?>" class="learn_btn" <?php saasland_is_external($list_service['link_url']) ?>>
                                         <?php echo esc_html($list_service['link_title']) ?> <i class="ti-arrow-right"></i>
                                     </a>
                                 <?php endif; ?>
                             </div>
                         </div>
                     </div>
                     <?php
                 }
                 ?>
             </div>
         </div>
         <?php endif; ?>
        </section>
       <?php
    }
}