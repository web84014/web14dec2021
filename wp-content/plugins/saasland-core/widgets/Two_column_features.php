<?php
namespace SaaslandCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class Two_column_features
 * @package SaaslandCore\Widgets
 */
class Two_column_features extends Widget_Base {

    public function get_name() {
        return 'saasland_two_column_features';
    }

    public function get_title() {
        return __( 'Two Column Features', 'saasland-hero' );
    }

    public function get_icon() {
        return ' eicon-column';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    protected function _register_controls() {

        // ---------------------------------------- Select Style  ------------------------------ //
        $this->start_controls_section(
            'select_style',
            [
                'label' => __( 'Feature Style', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'style', [
                'label' => esc_html__( 'Feature Style', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [
                    'style_01' => esc_html__( 'Style One (Mail Home)', 'saasland-core' ),
                    'style_02' => esc_html__( 'Style Two', 'saasland-core' ),
                    'style_03' => esc_html__( 'Style Three', 'saasland-core' ),
                ],
                'default' => 'style_01'
            ]
        );

        $this->end_controls_section();


        // ----------------------------------------  Hero content ------------------------------
        $this->start_controls_section(
            'contents_sec',
            [
                'label' => __( 'Contents', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title Text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'Manage conversations with leads and customers at scale'
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
                'label' => esc_html__( 'Description Text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'condition' => [
                    'style' => ['style_01', 'style_03']
                ]
            ]
        );

        //--------------------------- Features List ----------------------------------//
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'contents', [
                'label' => __( 'Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => '<span>Flexible, fast reporting:</span> On your bike mate cobblers I don\'t want no agro bleeding crikey'
            ]
        );

        $this->add_control(
            'features3', [
                'label' => __( 'Feature List', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'title_field' => '{{{ contents }}}',
                'fields' => $repeater->get_controls(),
                'condition' => [
                    'style' => 'style_03'
                ]
            ]
        );

        /// --------------- Featured Images ----------------//
        /// Image Fields
        $image_fields = new \Elementor\Repeater();

        $image_fields->add_control(
            'alt', [
                'label' => __( 'Image Alt Text', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Featured Image'
            ]
        );

        $image_fields->add_control(
            'image', [
                'label' => __( 'Image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/featureimg1.png', __FILE__)
                ]
            ]
        );

        $image_fields->add_control(
            'delay', [
                'label' => __( 'Animation Delay', 'saasland-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 's'],
                'range' => [
                    's' => [
                        'min' => 1,
                        'max' => 10,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'data-wow-delay: 0.{{SIZE}}s;',
                ],
            ]
        );

        $image_fields->add_control(
            'animation', [
                'label' => __( 'Animation', 'saasland-core' ),
                'type' => Controls_Manager::ANIMATION,
            ]
        );

        $image_fields->add_responsive_control(
            'horizontal',
            [
                'label' => __( 'Horizontal Position', 'saasland-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => -500,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'left: {{SIZE}}{{UNIT}}; right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $image_fields->add_responsive_control(
            'vertical',
            [
                'label' => __( 'Vertical Position', 'saasland-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => -500,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'top: {{SIZE}}{{UNIT}}; bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $image_fields->add_responsive_control(
            'z_index',
            [
                'label' => __( 'Z-Index', 'elementor' ),
                'type' => Controls_Manager::NUMBER,
                'min' => -9999,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'z-index: {{VALUE}};',
                ],
                'label_block' => false,
            ]
        );

        $image_fields->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'label' => __( 'Box Shadow', 'saasland-core' ),
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}',
            ]
        );

        $this->add_control(
            'images', [
                'label' => __( 'Featured Images', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'title_field' => '{{{ alt }}}',
                'fields' => $image_fields->get_controls(),
                'condition' => [
                    'style' => ['style_01', 'style_03']
                ]
            ]
        );

        $this->add_control(
            'show_bottom_border',
            [
                'label' => __( 'Show Bottom Border', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'your-plugin' ),
                'label_off' => __( 'Hide', 'your-plugin' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->end_controls_section(); // End Hero content


        // ------------------------------ Featured Image Home pos ------------------------------
        $this->start_controls_section(
            'buttons_sec', [
                'label' => __( 'Buttons', 'saasland-core' ),
                'condition' => [
                    'style' => 'style_03'
                ]
            ]
        );
        $this->add_control(
            'btn_label', [
                'label' => esc_html__( 'Button Label', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Explore More Features'
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
                    '{{WRAPPER}} .h_analytices_features_area .er_btn' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'normal_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .h_analytices_features_area .er_btn' => 'background: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'normal_border_color', [
                'label' => __( 'Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .h_analytices_features_area .er_btn' => 'border: 1px solid {{VALUE}}',
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
                    '{{WRAPPER}} .h_analytices_features_area .er_btn:hover' => 'color: {{VALUE}}',
                ]
            ]
        );
        $this->add_control(
            'hover_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .h_analytices_features_area .er_btn:hover' => 'background: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'hover_border_color', [
                'label' => __( 'Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ..h_analytices_features_area .er_btn:hover' => 'border: 1px solid {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();


        // ------------------------------ Featured Image Home pos ------------------------------
        $this->start_controls_section(
            'f_img_sec', [
                'label' => __( 'Featured Images', 'saasland-core' ),
                'condition' => [
                    'style' => 'style_02'
                ]
            ]
        );

        $this->add_control(
            'fimage', [
                'label' => __( 'Featured Image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/featureimg1.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'shape_img_bg', [
                'label' => __( 'Image Background', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pos_features_img .shap_img' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'shape_bg_color', [
                'label' => __( 'Shape Background', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pos_features_img .shape_img' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section(); // End Featured

        // ------------------------------ Icon ------------------------------
        $this->start_controls_section(
            'icon_sec', [
                'label' => __( 'Icon', 'saasland-core' ),
                'condition' => [
                    'style' => 'style_01'
                ]
            ]
        );

        $this->add_control(
            'icon_type',
            [
                'label' => __( 'Icon type', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'ti',
                'options' => [
                    'ti' => __( 'Themify Icon', 'saasland-core' ),
                    'image_icon' => __( 'Image Icon', 'saasland-core' ),
                ],
            ]
        );

        $this->add_control(
            'ti',
            [
                'label' => __( 'Icon', 'saasland-core' ),
                'type' => Controls_Manager::ICON,
                'options' => saasland_themify_icons(),
                'include' => saasland_include_themify_icons(),
                'default' => 'ti-comments',
                'condition' => [
                    'icon_type' => 'ti'
                ]
            ]
        );

        $this->add_control(
            'image_icon',
            [
                'label' => __( 'Image Icon', 'saasland-core' ),
                'description' => 'This image will be used as the background image if you use font icon (Themify)',
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/f_icon_shape1.png', __FILE__),
                ],
            ]
        );
        $this->end_controls_section(); // End Hero content


        /// -----------------------------  Featured Section pos  ----------------------------------//
        $this->start_controls_section(
            'featured_sec',
            [
                'label' => __( 'Features', 'saasland-core' ),
                'condition' => [
                    'style' => 'style_02'
                ]
            ]
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'title', [
                'label' => __( 'Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Benzersiz Stok ve Sube Yonetimi'

            ]
        );

        $repeater->add_control(
            'Subtitle', [
                'label' => __( 'Subtitle', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,

            ]
        );

        $repeater->add_control(
            'f_icon',
            [
                'label' => __( 'Icon', 'saasland-core' ),
                'type' => Controls_Manager::ICON,
                'options' => saasland_elegant_icons(),
                'include' => saasland_include_elegant_icons(),
            ]
        );

        $repeater->add_control(
            'bg_color', [
                'label' => __( 'Icon Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'features2', [
                'label' => __( 'Feature List', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'title_field' => '{{{ title }}}',
                'fields' => $repeater->get_controls(),
            ]
        );

        $this->end_controls_section(); // End Buttons

        $this->start_controls_section(
            'style_sec', [
                'label' => __( 'Row Reverse', 'saasland-core' ),
                'tab' => Controls_Manager::TAB
            ]
        );

        $this->add_control(
            'bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .features_area' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'style' => 'style_01'
                ]
            ]
        );

        $this->add_control(
            'is_row_reverse',
            [
                'label' => __( 'Row Reverse', 'saasland-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'saasland-core' ),
                'label_off' => __( 'No', 'saasland-core' ),
                'return_value' => 'yes',
            ]
        );

        $this->end_controls_section(); // Features (Style 02)


        /**
         * Style Tab
         */
        //------------------------------  Title ------------------------------//
        $this->start_controls_section(
            'style_title_sec', [
                'label' => __( 'Title', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'color_title', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .saasland_title_color' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
                    {{WRAPPER}} .saasland_title_color',
            ]
        );

        $this->end_controls_section(); //End Title


        /**
         * Subtitle
         */
        $this->start_controls_section(
            'style_subtitle_sec', [
                'label' => __( 'Subtitle', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => ['style_01', 'style_03']
                ]
            ]
        );

        $this->add_control(
            'color_subtitle', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .feature_info .f_content p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .h_analytices_features_item .h_analytices_content p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_subtitle',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
                    {{WRAPPER}} .feature_info .f_content p,
                    {{WRAPPER}} .h_analytices_features_item .h_analytices_content p
                    ',
            ]
        );

        $this->end_controls_section();

        /**
         * Style Features
         */
        $this->start_controls_section(
            'features_sec', [
                'label' => __( 'Style Features', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => ['style_03']
                ]
            ]
        );

        $this->add_control(
            'feature_title_color', [
                'label' => __( 'Title', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .h_analytices_features_item .h_analytices_content ul li' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'feature_title_bold_color', [
                'label' => __( 'Bold Title Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .h_analytices_features_item .h_analytices_content ul li span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'feature_bullet_color', [
                'label' => __( 'Bullet Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .h_analytices_features_item .h_analytices_content ul li:before' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        /**
         * Section Padding
         */
        $this->start_controls_section(
            'section_style',
            [
                'label' => __( 'Section Style', 'saasland-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'margin',
            [
                'label' => __( 'Margin', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .sec_pad' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .h_analytices_features_area' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'padding',
            [
                'label' => __( 'Padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .sec_pad' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .h_analytices_features_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'section_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .features_area' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .h_analytices_features_area' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .sec_pad' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings();
        $features = isset($settings['features']) ? $settings['features'] : '';
        $features2 = $settings['features2'];
        $features3 = $settings['features3'];
        $title_tag = !empty($settings['title_html_tag']) ? $settings['title_html_tag'] : 'h2';
        $class_name = !empty( $settings ['is_row_reverse']) ? $settings['is_row_reverse'] : 'img_left';
        $class2_name = !empty( $settings ['is_row_reverse']) ? $settings['is_row_reverse'] : 'pl_70';
        $is_show = ($settings['show_bottom_border'] == 'yes' ) ? 'analytics_border_bottom' : '';

        if ( $settings['style'] == 'style_01' ) {
            include 'two-column-features/part-one.php';
        }

        if ( $settings['style'] == 'style_02' ) {
            include 'two-column-features/part-two.php';
        }
        if ( $settings['style'] == 'style_03' ) {
            include 'two-column-features/part-three.php';
        }
    }
}