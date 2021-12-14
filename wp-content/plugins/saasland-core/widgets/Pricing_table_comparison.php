<?php
namespace SaaslandCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Pricing Plan Comparison
 */
class Pricing_table_comparison extends Widget_Base {
    public function get_name() {
        return 'saasland_pricing_table_features';
    }

    public function get_title() {
        return esc_html__( 'Pricing Plan Comparison', 'saasland-hero' );
    }

    public function get_icon() {
        return 'eicon-price-table';
    }

    public function get_keywords() {
        return [ 'pricing table', 'features pricing', 'comparison', 'compare' ];
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    protected function _register_controls() {

        //*****************************  Feature Section  *********************************//
        $this->start_controls_section(
            'feature_title_sec', [
                'label' => esc_html__( 'Feature Section', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'feature_title',
            [
                'label' => esc_html__( 'Feature Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Time tracking',
            ]
        );

        $this->end_controls_section();

        //*****************************  Plan 01 Section  *********************************//
        $this->start_controls_section(
            'plan1_title_sec', [
                'label' => esc_html__( 'Plan One', 'saasland-core' ),
            ]
        );
        $this->add_control(
            'plan_visibility_1',
            [
                'label' => __( 'Plan Visibility', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'saasland-core' ),
                'label_off' => __( 'Hide', 'saasland-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'plan1_title',
            [
                'label' => esc_html__( 'Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Free',
                'condition' => [
                    'plan_visibility_1' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'plan1_price',
            [
                'label' => esc_html__( 'Price', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '$0.0',
                'condition' => [
                    'plan_visibility_1' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'plan1_duration',
            [
                'label' => esc_html__( 'Duration', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'mo',
                'condition' => [
                    'plan_visibility_1' => 'yes'
                ]
            ]
        );
        $this->add_control(
            'show_btn',
            [
                'label' => __( 'Show Button', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'saasland-core' ),
                'label_off' => __( 'Hide', 'saasland-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'plan_visibility_1' => 'yes'
                ]
            ]
        );
        $this->add_control(
            'btn1_label',
            [
                'label' => esc_html__( 'Button Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Choose This',
                'condition' => [
                    'show_btn' => 'yes',
                    'plan_visibility_1' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'btn1_url',
            [
                'label' => esc_html__( 'Button URL', 'saasland-core' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url'   => '#'
                ],
                'condition' => [
                    'show_btn' => 'yes',
                    'plan_visibility_1' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();


        //*****************************  Plan 02 Section  *********************************//
        $this->start_controls_section(
            'plan2_title_sec', [
                'label' => esc_html__( 'Plan Two', 'saasland-core' ),
            ]
        );
        $this->add_control(
            'plan_visibility_2',
            [
                'label' => __( 'Plan Visibility', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'saasland-core' ),
                'label_off' => __( 'Hide', 'saasland-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'plan2_title',
            [
                'label' => esc_html__( 'Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Enterprise',
                'condition' => [
                    'plan_visibility_2' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'plan2_price',
            [
                'label' => esc_html__( 'Price', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '$30.0',
                'condition' => [
                    'plan_visibility_2' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'plan2_duration',
            [
                'label' => esc_html__( 'Duration', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'mo',
                'condition' => [
                    'plan_visibility_2' => 'yes'
                ]
            ]
        );
        $this->add_control(
            'show_btn2',
            [
                'label' => __( 'Show Button', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'saasland-core' ),
                'label_off' => __( 'Hide', 'saasland-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'plan_visibility_2' => 'yes'
                ]
            ]
        );
        $this->add_control(
            'btn2_label',
            [
                'label' => esc_html__( 'Button Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Choose This',
                'condition' => [
                    'show_btn2' => 'yes',
                    'plan_visibility_2' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'btn2_url',
            [
                'label' => esc_html__( 'Button URL', 'saasland-core' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url'   => '#'
                ],
                'condition' => [
                    'show_btn2' => 'yes',
                    'plan_visibility_2' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();


        //*****************************  Plan3 Section  *********************************//
        $this->start_controls_section(
            'plan3_title_sec', [
                'label' => esc_html__( 'Plan Three', 'saasland-core' ),
            ]
        );
        $this->add_control(
            'plan_visibility_3',
            [
                'label' => __( 'Plan Visibility', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'saasland-core' ),
                'label_off' => __( 'Hide', 'saasland-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'plan3_title',
            [
                'label' => esc_html__( 'Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Unlimited',
                'condition' => [
                    'plan_visibility_3' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'plan3_price',
            [
                'label' => esc_html__( 'Price', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '$40.0 ',
                'condition' => [
                    'plan_visibility_3' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'plan3_duration',
            [
                'label' => esc_html__( 'Duration', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'mo',
                'condition' => [
                    'plan_visibility_3' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'show_btn3',
            [
                'label' => __( 'Show Button', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'saasland-core' ),
                'label_off' => __( 'Hide', 'saasland-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'plan_visibility_3' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'btn3_label',
            [
                'label' => esc_html__( 'Button Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Choose This',
                'condition' => [
                    'show_btn3' => 'yes',
                    'plan_visibility_3' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'btn3_url',
            [
                'label' => esc_html__( 'Button URL', 'saasland-core' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url'   => '#'
                ],
                'condition' => [
                    'show_btn3' => 'yes',
                    'plan_visibility_3' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();



        // ********************************* Features Table tabs ***********************************//
        $this->start_controls_section(
            'features_table_sec',
            [
                'label' => esc_html__( 'Features', 'saasland-core' ),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'feature_item',
            [
                'label' => esc_html__( 'Feature Item', 'saasland-core' ),
                'type' =>Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'feature Item',
            ]
        );

        $repeater->add_control(
            'tooltip',
            [
                'label' => esc_html__( 'Tooltip Text', 'saasland-core' ),
                'type' =>Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'Save time by using keyboard shortcuts all across SaasLand',
            ]
        );

        $repeater->add_control(
            'is_yes',
            [
                'label' => esc_html__( 'Plan one', 'saasland-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'saasland-core' ),
                'label_off' => esc_html__( 'No', 'saasland-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $repeater->add_control(
            'is_yes2',
            [
                'label' => esc_html__( 'Plan two', 'saasland-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'saasland-core' ),
                'label_off' => esc_html__( 'No', 'saasland-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $repeater->add_control(
            'is_yes3',
            [
                'label' => esc_html__( 'Plan three', 'saasland-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'saasland-core' ),
                'label_off' => esc_html__( 'No', 'saasland-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'features',
            [
                'label' => esc_html__( 'Feature Item', 'saasland-core' ),
                'type' =>Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{feature_item}}}'
            ]
        );

        $this->end_controls_section();

        /**
         * Icon
         */
        $this->start_controls_section(
            'icon_sec_opt',
            [
                'label' => esc_html__( 'Icon', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'icon_type', [
                'label' => __( 'Yes Icon Type', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'default' => esc_html__( 'Default Icons', 'saasland-core' ),
                    'el_icon' => esc_html__( 'Elegant Icons', 'saasland-core' ),
                ],
                'default' => 'el_icon'
            ]
        );

        $this->add_control(
            'icon_fa', [
                'label' => __( 'Icon', 'saasland-core' ),
                'type' => Controls_Manager::ICONS,
                'condition' => [
                    'icon_type' => 'default'
                ]
            ]
        );

        $this->add_control(
            'icon_el', [
                'label' => __( 'Icon', 'saasland-core' ),
                'type' => Controls_Manager::ICON,
                'options' => saasland_elegant_icons(),
                //include' => saasland_thimify_include_icons(),
                'default' => 'icon_check_alt2',
                'condition' => [
                    'icon_type' => 'el_icon'
                ]
            ]
        );

        $this->add_control(
            'no_icon_type', [
                'label' => __( 'No Icon Type', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'separator' => 'before',
                'options' => [
                    'default' => esc_html__( 'Default Icons', 'saasland-core' ),
                    'el_icon' => esc_html__( 'Elegant Icons', 'saasland-core' ),
                ],
                'default' => 'el_icon'
            ]
        );

        $this->add_control(
            'no_icon_fa', [
                'label' => __( 'Icon', 'saasland-core' ),
                'type' => Controls_Manager::ICONS,
                'condition' => [
                    'no_icon_type' => 'default'
                ]
            ]
        );

        $this->add_control(
            'no_icon_el', [
                'label' => __( 'Icon', 'saasland-core' ),
                'type' => Controls_Manager::ICON,
                'options' => saasland_elegant_icons(),
                //include' => saasland_thimify_include_icons(),
                'default' => 'icon_close',
                'condition' => [
                    'icon_type' => 'el_icon'
                ]
            ]
        );

        $this->end_controls_section();


        /**
         * Style Tabs
         * Color
         * Background Shapes
         */
        // *********************************** Feature Title Color ******************************//
        $this->start_controls_section(
            'feature_title_style', [
                'label' => esc_html__( 'Feature Title', 'saasland-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'feature_title_color',
            [
                'label' => esc_html__( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price_info_two .price_head .p_head h4' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'feature_title_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .p_head.time' => 'background-color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'feature_title_typography',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .price_info_two .price_head .p_head h4',
            ]
        );

        $this->end_controls_section();


        // *********************************** Plan1  Color ******************************//
        $this->start_controls_section(
            'plan1_title_color_sec', [
                'label' => esc_html__( 'Plan One', 'saasland-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'plan1_price_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price_info_two .price_head .p_head:nth-child(2)' => 'background-color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'plan1_title_color',
            [
                'label' => esc_html__( 'Title Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price_info_two .price_head .p_head h5' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'plan1_title_typography',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .price_info_two .price_head .p_head h5',
            ]
        );


        $this->add_control(
            'plan1_price_color',
            [
                'label' => esc_html__( 'Price Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price_info_two .price_head .p_head p' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'plan1_price_typography',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .price_info_two .price_head .p_head p',
            ]
        );

        $this->end_controls_section();


        // *********************************** Plan2  Color ******************************//
        $this->start_controls_section(
            'plan2_title_color_sec', [
                'label' => esc_html__( 'Plan Two', 'saasland-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'plan2_price_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price_info_two .price_head .p_head:nth-child(3)' => 'background-color: {{VALUE}}',
                ]
            ]
        );

        $this->end_controls_section();


        // *********************************** Plan3 Color ******************************//
        $this->start_controls_section(
            'plan3_title_color_sec', [
                'label' => esc_html__( 'Plan Three', 'saasland-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'plan3_price_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price_info_two .price_head .p_head:nth-child(4)' => 'background-color: {{VALUE}}',
                ]
            ]
        );

        $this->end_controls_section();



        // *********************************** Feature Item Color ******************************//
        $this->start_controls_section(
            'features_table_style', [
                'label' => esc_html__( 'Feature Item', 'saasland-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );


        //---------------------------- Normal and Hover ---------------------------//
        $this->start_controls_tabs(
            'features_table_style_tabs'
        );


        // Normal Color
        $this->start_controls_tab(
            'feature_normal_btn_style',
            [
                'label' => __( 'Normal', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'feature_normal_icon_color', [
                'label' => __( 'Icon Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price_info_two .price_item .pr_title:before' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'feature_normal_text_color', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price_info_two .price_item h5' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'feature_item_typography',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .price_info_two .price_item h5',
            ]
        );

        $this->end_controls_tab();


        // Hover Color
        $this->start_controls_tab(
            'feature_hover_btn_style',
            [
                'label' => __( 'Hover', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'feature_hover_icon_color', [
                'label' => __( 'Icon Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price_info_two .price_item .pr_title:hover:before' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'feature_hover_text_color', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price_info_two .price_item h5:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();


        // ***********************************  Item Color ******************************//
        $this->start_controls_section(
            'features_table_icon_style', [
                'label' => esc_html__( 'Table Icon', 'saasland-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'feature_check_color',
            [
                'label' => esc_html__( 'Icon Check Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price_info_two .price_item .check' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'feature_close_color',
            [
                'label' => esc_html__( 'Icon Cross Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price_info_two .price_item .cros' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->end_controls_section();


        // ***********************************  Item Color ******************************//
        $this->start_controls_section(
            'btn_style_sec', [
                'label' => esc_html__( 'Buttons', 'saasland-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        //---------------------------- Normal and Hover ---------------------------//
        $this->start_controls_tabs(
            'style_tabs'
        );


        // Normal Color
        $this->start_controls_tab(
            'normal_btn_style',
            [
                'label' => __( 'Normal', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'normal_text_color', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price_info_two .price_btn' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'normal_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price_info_two .price_btn' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'normal_border_color', [
                'label' => __( 'Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price_info_two .price_btn' => 'border: 1px solid {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();


        // Hover Color
        $this->start_controls_tab(
            'hover_btn_style',
            [
                'label' => __( 'Hover', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'hover_text_color', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price_info_two .price_btn:hover' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'hover_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price_info_two .price_btn:hover' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'hover_border_color', [
                'label' => __( 'Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price_info_two .price_btn:hover' => 'border: 1px solid {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings();

        $icon_fa = !empty($settings['icon_fa']['value']) ? $settings['icon_fa']['value'] : '';
        $icon_yes = $settings['icon_type'] == 'default' ? $icon_fa : $settings['icon_el'];

        $icon_fa = !empty($settings['no_icon_fa']['value']) ? $settings['no_icon_fa']['value'] : '';
        $icon_no = $settings['no_icon_type'] == 'default' ? $icon_fa : $settings['no_icon_el'];
        ?>

        <section class="priceing_area_four">
            <div class="container">
                <div class="price_info_two">
                    <div class="price_head">
                        <div class="p_head time">
                            <?php if ( !empty($settings['feature_title']) ) : ?>
                                <h4><?php echo esc_html( $settings['feature_title']) ?></h4>
                            <?php endif; ?>
                        </div>
                        <?php
                        if( $settings['plan_visibility_1'] == 'yes' ){ ?>
                            <div class="p_head">
                                <?php if ( !empty($settings['plan1_title']) ) : ?>
                                    <h5><?php echo esc_html( $settings['plan1_title'] ) ?></h5>
                                <?php endif; ?>
                                <p>
                                    <?php echo !empty($settings['plan1_price']) ? wp_kses_post($settings['plan1_price']).'/' : ''; ?>
                                    <?php echo !empty($settings['plan1_duration']) ? wp_kses_post($settings['plan1_duration']) : ''; ?>
                                </p>
                            </div>
                            <?php
                        }

                        if( $settings['plan_visibility_2'] == 'yes' ){ ?>
                            <div class="p_head">
                                <?php if ( !empty($settings['plan2_title']) ) : ?>
                                    <h5><?php echo esc_html( $settings['plan2_title'] ) ?></h5>
                                <?php endif; ?>
                                <p>
                                    <?php echo !empty($settings['plan2_price']) ? wp_kses_post($settings['plan2_price']).'/' : ''; ?>
                                    <?php echo !empty($settings['plan2_duration']) ? wp_kses_post($settings['plan2_duration']) : ''; ?>
                                </p>
                            </div>
                            <?php
                        }

                        if( $settings['plan_visibility_3'] == 'yes' ){ ?>
                            <div class="p_head">
                                <?php if ( !empty($settings['plan3_title']) ) : ?>
                                    <h5><?php echo esc_html( $settings['plan3_title'] ) ?></h5>
                                <?php endif; ?>
                                <p>
                                    <?php echo !empty($settings['plan3_price']) ? wp_kses_post($settings['plan3_price']).'/' : ''; ?>
                                    <?php echo !empty($settings['plan3_duration']) ? wp_kses_post($settings['plan3_duration']) : ''; ?>
                                </p>
                            </div>
                            <?php
                        }
                        ?>
                    </div>

                    <div class="price_body">
                            <?php
                            if ( !empty($settings['features']) ) {
                                foreach ( $settings['features'] as $i => $feature ) {
                                    $tooltip = !empty($feature['tooltip']) ? $feature['tooltip'] : '';
                                    $is_yes = ($feature['is_yes'] == 'yes' ) ? $icon_yes : $icon_no;
                                    $class = ($feature['is_yes'] == 'yes' ) ? 'check' : 'cros';
                                    $is_yes_two = ($feature['is_yes2'] == 'yes' ) ? $icon_yes : $icon_no;
                                    $class_two = ($feature['is_yes2'] == 'yes' ) ? 'check' : 'cros';
                                    $is_yes_three = ($feature['is_yes3'] == 'yes' ) ? $icon_yes : $icon_no;
                                    $class_three = ($feature['is_yes3'] == 'yes' ) ? 'check' : 'cros';
                                    ?>
                                    <div class="pr_list">
                                        <div class="price_item">
                                            <?php if ( !empty($feature['feature_item']) ) : ?>
                                                <h5 class="pr_title" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $tooltip ?>">
                                                    <?php echo esc_html( $feature['feature_item'] ) ?>
                                                </h5>
                                            <?php endif ?>
                                        </div>
                                        <?php
                                        if( $settings['plan_visibility_1'] == 'yes' ){ ?>
                                            <div class="price_item" data-title="<?php echo esc_attr($settings['plan1_title']) ?>">
                                                <h5 class="<?php echo esc_attr($class) ?>"><i class="<?php echo esc_attr($is_yes) ?>"></i></h5>
                                            </div>
                                            <?php
                                        }
                                        if( $settings['plan_visibility_2'] == 'yes' ){ ?>
                                            <div class="price_item" data-title="<?php echo esc_attr($settings['plan2_title']) ?>">
                                                <h5 class="<?php echo esc_attr($class_two) ?>"><i class="<?php echo esc_attr($is_yes_two) ?>"></i></h5>
                                            </div>
                                            <?php
                                        }
                                        if( $settings['plan_visibility_3'] == 'yes' ){ ?>
                                            <div class="price_item" data-title="<?php echo esc_attr($settings['plan3_title']) ?>">
                                                <h5 class="<?php echo esc_attr($class_three) ?>"><i class="<?php echo esc_attr($is_yes_three) ?>"></i></h5>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        <div class="pr_list">
                            <div class="price_item"></div>

                            <?php
                            if( $settings['plan_visibility_1'] == 'yes' ){ ?>
                                <div class="price_item">
                                    <?php if ( !empty($settings['btn1_label']) && $settings['show_btn'] == 'yes' ) : ?>
                                        <a href="<?php echo esc_url( $settings['btn1_url']['url']) ?>" class="price_btn btn_hover"
                                            <?php saasland_is_external($settings['btn1_url']) ?>>
                                            <?php echo esc_html( $settings['btn1_label']) ?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                                <?php
                            }
                            if( $settings['plan_visibility_2'] == 'yes' ){ ?>
                                <div class="price_item">
                                    <?php if ( !empty( $settings['btn2_label'] ) && $settings['show_btn2'] == 'yes' ) : ?>
                                        <a href="<?php echo esc_url( $settings['btn2_url']['url']) ?>" class="price_btn btn_hover"
                                            <?php saasland_is_external($settings['btn2_url']) ?>>
                                            <?php echo esc_html( $settings['btn2_label']) ?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                                <?php
                            }
                            if( $settings['plan_visibility_3'] == 'yes' ){ ?>
                                <div class="price_item">
                                    <?php if ( !empty( $settings['btn3_label'] ) && $settings['show_btn3'] == 'yes' ) : ?>
                                        <a href="<?php echo esc_url( $settings['btn3_url']['url']) ?>" class="price_btn btn_hover"
                                            <?php saasland_is_external($settings['btn3_url']) ?>>
                                            <?php echo esc_html( $settings['btn3_label']) ?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                                <?php
                            }
                            ?>
                        </div>

                    </div>
                </div>

            </div>
        </section>

        <script>
            ;(function($){
                "use strict";
                $( 'docuemnt' ).ready(function() {
                    if ($( '[data-toggle="tooltip"]' ).length) {
                        $( '[data-toggle="tooltip"]' ).tooltip()
                    }
                })
            })(jQuery)
        </script>

        <?php
    }
}