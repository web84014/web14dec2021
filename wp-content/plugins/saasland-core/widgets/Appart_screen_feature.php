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
 * Text Typing Effect
 *
 * Elementor widget for text typing effect.
 *
 * @since 1.7.0
 */
class Appart_screen_feature extends Widget_Base {

    public function get_name() {
        return 'saasland_appart_screen_feature';
    }

    public function get_title() {
        return __( 'Screen Features', 'saasland-core' );
    }

    public function get_icon() {
        return ' eicon-posts-group';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    public function get_keywords() {
        return [ 'accordion', 'faq', 'features' ];
    }

    public function get_script_depends_depends() {
        return [ 'appart-custom' ];
    }

    public function get_style_depends() {
        return [ 'appart-style', 'appart-responsive' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'sec_style', [
                'label' => __( 'Section Style', 'saasland-core' ),
            ]
        );
        $this->add_control(
            'style', [
                'label' => esc_html__( 'Style', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_01' => esc_html__( 'Style one ', 'saasland-core' ),
                    'style_02' => esc_html__( 'Style two ', 'saasland-core' ),
                    'style_03' => esc_html__( 'Style three ', 'saasland-core' ),
                ],
                'default' => 'style_01'
            ]
        );
        $this->end_controls_section();

        // ------------------------------  Title Section ------------------------------
        $this->start_controls_section(
            'title_sec',
            [
                'label' => __( 'Title section', 'saasland-core' ),
            ]
        );
        $this->add_control(
            'title_text',
            [
                'label' => esc_html__( 'Title text', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Data Analytics'
            ]
        );
        $this->add_control(
            'subtitle_text', [
                'label' => esc_html__( 'Subtitle text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );
        $this->end_controls_section(); // End title section

        // ------------------------------  Featured image ------------------------------
        $this->start_controls_section(
            'featured_image', [
                'label' => __( 'Featured image', 'saasland-core' ),
            ]
        );
        $this->add_control(
            'the_featured_image', [
                'label' => esc_html__( 'Featured image', 'saasland-core' ),
                'desc' => esc_html__( 'Upload the featured image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );
        $this->add_control(
            'featured_image_margin', [
                'label' => __( 'Padding', 'saasland-core' ),
                'description' => __( 'Padding around the featured image', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .features_area .f_img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .b_screen_img img .f_img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section(); // End title section


        // ------------------------------ Feature list ------------------------------
        $this->start_controls_section(
            'feature_list', [
                'label' => __( 'Feature list', 'saasland-core' ),
            ]
        );
        $this->add_control(
            'features', [
                'label' => __( 'Features list', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'title_field' => '{{{ title }}}',
                'fields' => [
                    [
                        'name' => 'title',
                        'label' => __( 'Feature Title', 'saasland-core' ),
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default' => 'Enterprise Reporting with Tiered Access'
                    ],
                    [
                        'name' => 'desc',
                        'label' => __( 'Feature description', 'saasland-core' ),
                        'type' => Controls_Manager::TEXTAREA,
                        'label_block' => true,
                        'default' => 'Hollywood hype would have us believe that a hypnotist can control and direct our actions, and '
                    ],
                    [
                        'name' => 'icon_type',
                        'label' => __( 'Icon type', 'saasland-core' ),
                        'type' => Controls_Manager::SELECT,
                        'default' => 'font_icon',
                        'options' => [
                            'font_icon' => __( 'Font icon', 'saasland-core' ),
                            'image_icon' => __( 'Image icon', 'saasland-core' ),
                        ],
                    ],
                    [
                        'name' => 'font_icon',
                        'label' => __( 'Social icon', 'saasland-core' ),
                        'type' => Controls_Manager::ICON,
                        'options' => saasland_themify_icons(),

                        'default' => 'ti-pie-chart',
                        'condition' => [
                            'icon_type' => 'font_icon'
                        ]
                    ],
                    [
                        'name' => 'image_icon',
                        'label' => __( 'Image icon', 'saasland-core' ),
                        'type' => Controls_Manager::MEDIA,
                        'condition' => [
                            'icon_type' => 'image_icon'
                        ]
                    ],
                ],
            ]
        );
        $this->end_controls_section(); // End Buttons


        /**
         * Style Tab
         * ------------------------------ Style Title ------------------------------
         *
         */
        $this->start_controls_section(
            'style_title', [
                'label' => __( 'Style section title', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'color_prefix', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title-four h2' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_prefix',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .title-four h2',
            ]
        );
        $this->end_controls_section();


        //------------------------------ Style subtitle ------------------------------
        $this->start_controls_section(
            'style_subtitle', [
                'label' => __( 'Style subtitle', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'color_subtitle', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .features_content_three p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .title-four p' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_subtitle',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
				    {{WRAPPER}} .title-four p,
				    {{WRAPPER}} .features_content_three p',
            ]
        );
        $this->end_controls_section();

        //------------------------------ Shape Images Section ------------------------------
        $this->start_controls_section(
            'shape_img_sec', [
                'label' => __( 'Floating Images', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => 'style_02'
                ]
            ]
        );

        $this->add_control(
            'shape_img1', [
                'label' => esc_html__( 'Image One', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/appart-new/line_07.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'shape_img2', [
                'label' => esc_html__( 'Image Two', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/appart-new/line_08.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'shape_img3', [
                'label' => esc_html__( 'Image Three', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/appart-new/line_09.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'shape_img4', [
                'label' => esc_html__( 'Image Four', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/appart-new/line_11.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'shape_img5', [
                'label' => esc_html__( 'Image Five', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/appart-new/line_12.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'shape_img6', [
                'label' => esc_html__( 'Image Six', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/appart-new/line_13.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'shape_img7', [
                'label' => esc_html__( 'Image Seven', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/appart-new/line_14.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'shape_img8', [
                'label' => esc_html__( 'Image Eight', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/appart-new/line_15.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'shape_img9', [
                'label' => esc_html__( 'Image Nine', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/appart-new/line_16.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'shape_img10', [
                'label' => esc_html__( 'Image Ten', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/appart-new/line_10.png', __FILE__)
                ]
            ]
        );

        $this->end_controls_section();

        //------------------------------ Shape Images Section ------------------------------
        $this->start_controls_section(
            'flotation_images_sec', [
                'label' => __( 'Floating Images', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => 'style_03'
                ]
            ]
        );

        $this->add_control(
            'shape_img11', [
                'label' => esc_html__( 'Image One', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/appart-new/line_17.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'shape_img12', [
                'label' => esc_html__( 'Image Two', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/appart-new/line_18.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'shape_img13', [
                'label' => esc_html__( 'Image Three', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/appart-new/line_09.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'shape_img14', [
                'label' => esc_html__( 'Image Four', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/appart-new/line_20.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'shape_img15', [
                'label' => esc_html__( 'Image Five', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/appart-new/line_21.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'shape_img16', [
                'label' => esc_html__( 'Image Six', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/appart-new/line_22.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'shape_img17', [
                'label' => esc_html__( 'Image Seven', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/appart-new/line_23.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'shape_img18', [
                'label' => esc_html__( 'Image Eight', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/appart-new/line_24.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'shape_img19', [
                'label' => esc_html__( 'Image Nine', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/appart-new/line_25.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'shape_img20', [
                'label' => esc_html__( 'Image Ten', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/appart-new/line_15.png', __FILE__)
                ]
            ]
        );

        $this->end_controls_section();

        //------------------------------ Style 02 Background Color ------------------------------
        $this->start_controls_section(
            'style2_bg_sec', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => 'style_02'
                ]
            ]
        );
        $this->add_control(
            'style2_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .best_screen_features_area' => 'background: {{VALUE}};',
                ]
            ]
        );

        $this->end_controls_section();

        //------------------------------ Style Section ------------------------------
        $this->start_controls_section(
            'style_feature_list', [
                'label' => __( 'Style Feature Items', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'color_feature_title', [
                'label' => __( 'Title Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .features_content_three .media .media-body' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .b_features_item h3' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .faq_accordian_two .card .card-header h5 .btn-link' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'label' => 'Title typography',
                'name' => 'typography_feature_item',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
                    {{WRAPPER}} .features_content_three .media .media-body,
                    {{WRAPPER}} .faq_accordian_two .card .card-header h5 .btn-link,
                    {{WRAPPER}} .b_features_item h3',
            ]
        );
        $this->add_control(
            'feature_item_title_margin', [
                'label' => __( 'Margin Around Title', 'saasland-core' ),
                'description' => __( 'Margin around the each feature list title.', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .features_content_three .media' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',
                ],
            ]
        );

        $this->add_control(
            'hr1',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->add_control(
            'color_feature_icon', [
                'label' => __( 'Icon Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .faq_accordian_two .card .card-header h5 .btn-link i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .features_content_three .media .media-left .icon' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .b_features_icon .icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .b_features_icon' => 'border-color: {{VALUE}};'
                ],
            ]
        );

        $this->add_control(
            'color_feature_subtitle', [
                'label' => __( 'Subtitle Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .features_content_three .scree_feature_item p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .best_screen_features_area p' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'style' => ['style_01', 'style_02']
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'label' => esc_html__( 'Subtitle typography', 'saasland-core' ),
                'name' => 'typography_feature_item_subtitle',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .features_content_three .scree_feature_item p, {{WRAPPER}} .best_screen_features_area p',
                'condition' => [
                    'style' => ['style_01', 'style_02']
                ]
            ]
        );

        $this->add_control(
            'hr2',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->add_control(
            'feature_item_margin', [
                'label' => __( 'Margin', 'saasland-core' ),
                'description' => __( 'Margin around the each feature list.', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .scree_feature_item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .faq_accordian_two .card' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',
                ],
            ]
        );
        $this->end_controls_section();


        // Active/Hover Feature Items
        $this->start_controls_section(
            'style_feature_list_active', [
                'label' => __( 'Active/Hover Feature Items', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => ['style_02', 'style_03']
                ]
            ]
        );

        $this->add_control(
            'color_feature_title_active', [
                'label' => __( 'Title Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .faq_accordian_two .card.active .card-header h5 .btn-link' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .b_features_item:hover h3' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'color_feature_title_active_hr',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->add_control(
            'color_feature_active_color', [
                'label' => __( 'Icon Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,'selectors' => [
                    '{{WRAPPER}} .faq_accordian_two .card.active .card-header h5 .btn-link, {{WRAPPER}} .faq_accordian_two .card.active .card-header h5 .btn-link i, {{WRAPPER}}  .faq_accordian_two .card.active .card-body p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .b_features_item:hover .b_features_icon .icon i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'color_feature_active_bg', [
                'label' => __( 'Item Background Color 01', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
            ]
        );

        $this->add_control(
            'color_feature_active_bg2', [
                'label' => __( 'Item Background Color 02', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .faq_accordian_two .card:before' => 'background-image: -webkit-linear-gradient( 0deg, {{color_feature_active_bg.VALUE}} 0%, {{VALUE}} 100%);',
                    '{{WRAPPER}} .b_features_icon .hover_color' => 'background-image: -webkit-linear-gradient( -120deg, {{color_feature_active_bg.VALUE}} 0%, {{VALUE}} 100%);',
                ],
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
            'is_revers_column', [
                'label' => __( 'Reverse column', 'saasland-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'saasland-core' ),
                'label_off' => __( 'No', 'saasland-core' ),
                'return_value' => 'yes',
                'condition' => [
                        'style' => ['style_01', 'style_02']
                ]
            ]
        );

        $this->add_control(
            'is_row_reverse', [
                'label' => __( 'Row Reverse', 'saasland-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'saasland-core' ),
                'label_off' => __( 'No', 'saasland-core' ),
                'return_value' => 'yes',
                'condition' => [
                    'style' => 'style_03',
                ]
            ]
        );
        $this->add_responsive_control(
            'sec_padding', [
                'label' => __( 'Section padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .features_area_pad' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => '15',
                    'right' => '0',
                    'bottom' => '120',
                    'left' => '0',
                    'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',

                ],
            ]
        );
        $this->add_control(
            'animation_bg', [
                'label'     => esc_html__( 'Background Floating Images', 'saasland-core' ),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'label_on'  => esc_html__( 'Show', 'saasland-core' ),
                'label_off' => esc_html__( 'Hide', 'saasland-core' ),
                'return_value' => 'yes',
                'condition' => [
                    'style' => ['style_02', 'style_03']
                ]
            ]
        );
        $this->add_control(
            'is_bg_shape', [
                'label' => __( 'Show/hide background shape', 'saasland-core' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on' => __( 'Show', 'saasland-core' ),
                'label_off' => __( 'Hide', 'saasland-core' ),
                'return_value' => 'yes',
                'condition' => [
                    'style' => ['style_01', 'style_02']
                ]
            ]
        );
        $this->add_control(
            'bg_shape_color', [
                'label' => __( 'Background shape color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .shape:before' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .features_area' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'style' => ['style_01', 'style_02']
                ]
            ]
        );
        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings();
        $features = isset($settings['features']) ? $settings['features'] : '';
        if ( $settings['style'] == 'style_01' ) { ?>
            <section class="features_area features_area_pad feature-bg <?php echo $settings['is_bg_shape'] == 'yes' ? 'shape' : ''; ?>">
                <div class="container">
                    <div class="row <?php echo $settings['is_revers_column']=='yes' ? 'flex-row-reverse' : ''; ?>">
                        <?php if (!empty($settings['the_featured_image']['url'])) : ?>
                            <div class="col-lg-<?php echo $settings['is_revers_column']=='yes' ? '6' : '7'; ?> col-sm-12 f_img text-right">
                                <img src="<?php echo esc_url($settings['the_featured_image']['url']) ?>" alt="featured">
                            </div>
                        <?php endif; ?>
                        <div class="col-lg-<?php echo $settings['is_revers_column']=='yes' ? '6' : '5'; ?> col-sm-12 features_content_three">
                            <div class="title-four">
                                <?php if (!empty($settings['title_text'])) : ?>
                                    <h2> <?php echo esc_html($settings['title_text']); ?></h2>
                                <?php endif; ?>
                            </div>
                            <?php if (!empty($settings['subtitle_text'])) : ?>
                                <?php echo wpautop($settings['subtitle_text']);
                            endif;

                            if ($features) {
                            foreach ($features as $feature) {
                                ?>
                                <div class="scree_feature_item">
                                    <div class="media">
                                        <div class="media-left">
                                            <?php
                                            if ($feature['icon_type']=='font_icon' ) {
                                                echo '<div class="icon">';
                                                echo "<i class='{$feature['font_icon']}'></i>";
                                                echo '</div>';
                                            }else {
                                                echo "<img src='{$feature['image_icon']['url']}' alt='{$feature['title']}'>";
                                            }
                                            ?>
                                        </div>
                                        <div class="media-body"> <?php echo esc_html($feature['title']) ?> </div>
                                    </div>
                                    <?php if (!empty($feature['desc'])) : ?>
                                        <p><?php echo saasland_kses_post( nl2br( $feature['desc'] ) ) ?></p>
                                    <?php endif; ?>
                                </div>
                                <?php
                            }}
                            ?>
                        </div>
                    </div>
                </div>
            </section>
            <?php
        } elseif ( $settings['style'] == 'style_02' ) {
            ?>
            <section class="best_screen_features_area features_area_pad">
                <?php if ( 'yes' === $settings['is_bg_shape']) : ?>
                    <svg xmlns="http://www.w3.org/2000/svg">
                        <path fill="<?php echo esc_attr($settings['bg_shape_color']);?>" id="down_bg_copy_2" data-name="down / bg copy 2" class="cls-1" d="M444.936,252.606c-148.312,0-305.161-29.63-444.936-80.214V0H1920V12S808.194,234.074,444.936,252.606Z"/>
                    </svg>
                <?php endif; ?>
                <?php if ( 'yes' === $settings['animation_bg'] ) : ?>
                    <!--Parallax-->
                    <ul class="memphis-parallax hidden-xs hidden-sm white_border">
                        <?php if ( !empty($settings['shape_img1']['url'] ) ) : ?>
                            <li data-parallax='{"x": -00, "y": 100}'>
                                <img class="br_shape" src="<?php echo esc_url( $settings['shape_img1']['url'] ) ?>" alt="<?php echo esc_attr( $settings['title_text'] ) ?>">
                            </li>
                        <?php endif; ?>
                        <?php if ( !empty($settings['shape_img2']['url'] ) ) : ?>
                            <li data-parallax='{"x": 200, "y": 200}'>
                                <img class="br_shape" src="<?php echo esc_url( $settings['shape_img2']['url'] ) ?>" alt="<?php echo esc_attr( $settings['title_text'] ) ?>">
                            </li>
                        <?php endif; ?>
                        <?php if ( !empty($settings['shape_img3']['url'] ) ) : ?>
                            <li data-parallax='{"x": 150, "y": 150}'>
                                <img class="br_shape" src="<?php echo esc_url( $settings['shape_img3']['url'] ) ?>" alt="<?php echo esc_attr( $settings['title_text'] ) ?>">
                            </li>
                        <?php endif; ?>
                        <?php if ( !empty($settings['shape_img4']['url'] ) ) : ?>
                            <li data-parallax='{"x": 50, "y": 50}'>
                                <img class="br_shape" src="<?php echo esc_url( $settings['shape_img4']['url'] ) ?>" alt="<?php echo esc_attr( $settings['title_text'] ) ?>">
                            </li>
                        <?php endif; ?>
                        <?php if ( !empty($settings['shape_img5']['url'] ) ) : ?>
                            <li data-parallax='{"x": 150, "y": 150}'>
                                <img src="<?php echo esc_url( $settings['shape_img5']['url'] ) ?>" alt="<?php echo esc_attr( $settings['title_text'] ) ?>">
                            </li>
                        <?php endif; ?>
                        <?php if ( !empty($settings['shape_img6']['url'] ) ) : ?>
                            <li data-parallax='{"x": 100, "y": 100}'>
                                <img src="<?php echo esc_url( $settings['shape_img6']['url'] ) ?>" alt="<?php echo esc_attr( $settings['title_text'] ) ?>">
                            </li>
                        <?php endif; ?>
                        <?php if ( !empty($settings['shape_img7']['url'] ) ) : ?>
                            <li data-parallax='{"x": 50, "y": 50}'>
                                <img src="<?php echo esc_url( $settings['shape_img7']['url'] ) ?>" alt="<?php echo esc_attr( $settings['title_text'] ) ?>">
                            </li>
                        <?php endif; ?>
                        <?php if ( !empty($settings['shape_img8']['url'] ) ) : ?>
                            <li data-parallax='{"y": 250}'>
                                <img src="<?php echo esc_url( $settings['shape_img8']['url'] ) ?>" alt="<?php echo esc_attr( $settings['title_text'] ) ?>">
                            </li>
                        <?php endif; ?>
                        <?php if ( !empty($settings['shape_img9']['url'] ) ) : ?>
                            <li data-parallax='{"x": 250, "y": 250}'>
                                <img src="<?php echo esc_url( $settings['shape_img9']['url'] ) ?>" alt="<?php echo esc_attr( $settings['title_text'] ) ?>">
                            </li>
                        <?php endif; ?>
                        <?php if ( !empty($settings['shape_img10']['url'] ) ) : ?>
                            <li data-parallax='{"x": 150, "y": 150}'>
                                <img class="br_shape" src="<?php echo esc_url( $settings['shape_img10']['url'] ) ?>" alt="<?php echo esc_attr( $settings['title_text'] ) ?>">
                            </li>
                        <?php endif; ?>
                    </ul>
                <?php endif; ?>
                <div class="container">
                    <div class="title-four h_color text-center mb_0">
                        <?php if (!empty($settings['title_text'])) : ?> <h2 class="wow fadeInUp"> <?php echo esc_html($settings['title_text']); ?> </h2> <?php endif; ?>
                        <?php
                        if (!empty($settings['subtitle_text'])) : ?>
                            <?php echo '<p class="p_color wow fadeInUp" data-wow-delay="200ms">'.$settings['subtitle_text']."</p>";
                        endif;
                        ?>
                    </div>

                    <div class="row <?php echo $settings['is_revers_column']=='yes' ? 'flex-row-reverse' : ''; ?>">
                        <?php if (!empty($settings['the_featured_image']['url'])) : ?>
                            <div class="col-lg-4">
                                <div class="b_screen_img wow fadeInUp">
                                    <img src="<?php echo esc_url($settings['the_featured_image']['url']) ?>" alt="featured">
                                </div>
                            </div>
                        <?php endif;?>
                        <div class="col-lg-<?php echo !empty($settings['the_featured_image']['url']) ? '8' : '12'; ?>">
                            <div class="row b_features_info">
                                <?php
                                if ($features) {
                                    foreach ($features as $feature) {
                                        ?>
                                        <div class="col-sm-6">
                                            <div class="b_features_item wow fadeInUp">
                                                <div class="b_features_icon">
                                                    <?php
                                                    if ($feature['icon_type'] == 'font_icon' ){
                                                        echo '<div class="icon">';
                                                        echo "<i class='{$feature['font_icon']}'></i>";
                                                        echo "<span class='hover_color'></span>";
                                                        echo '</div>';
                                                    } else {
                                                        echo "<img src='{$feature['image_icon']['url']}' alt='{$feature['title']}'>";
                                                    }
                                                    ?>
                                                </div>
                                                <?php if (!empty($feature['title'])) : ?>
                                                    <h3> <?php echo esc_html($feature['title']) ?> </h3>
                                                <?php endif; ?>
                                                <?php if (!empty($feature['desc'])) : ?>
                                                    <p><?php echo saasland_kses_post( nl2br( $feature['desc'] ) ) ?></p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                </div>
            </section>
            <?php
        }
        elseif ( $settings['style'] == 'style_03' ) {
            ?>
            <section class="faq_solution_area features_area_pad">
                <?php if ( 'yes' === $settings['animation_bg'] ) : ?>
                    <!--Parallax-->
                    <ul class="memphis-parallax hidden-xs hidden-sm white_border">
                        <?php if ( !empty($settings['shape_img11']['url'] ) ) : ?>
                            <li data-parallax='{"x": -100, "y": 100}'>
                                <img class="br_shape" src="<?php echo esc_url( $settings['shape_img11']['url'] ) ?>" alt="<?php echo esc_attr( $settings['title_text'] ) ?>">
                            </li>
                        <?php endif; ?>
                        <?php if ( !empty($settings['shape_img12']['url'] ) ) : ?>
                            <li data-parallax='{"x": -200, "y": 200}'>
                                <img class="br_shape" src="<?php echo esc_url( $settings['shape_img12']['url'] ) ?>" alt="<?php echo esc_attr( $settings['title_text'] ) ?>"
                            </li>
                        <?php endif; ?>
                        <?php if ( !empty($settings['shape_img13']['url'] ) ) : ?>
                            <li data-parallax='{"x": -150, "y": 150}'>
                                <img class="br_shape" src="<?php echo esc_url( $settings['shape_img13']['url'] ) ?>" alt="<?php echo esc_attr( $settings['title_text'] ) ?>">
                            </li>
                        <?php endif; ?>
                        <?php if ( !empty($settings['shape_img14']['url'] ) ) : ?>
                            <li data-parallax='{"x": 50, "y": -50}'>
                                <img class="br_shape" src="<?php echo esc_url( $settings['shape_img14']['url'] ) ?>" alt="<?php echo esc_attr( $settings['title_text'] ) ?>">
                            </li>
                        <?php endif; ?>
                        <?php if ( !empty($settings['shape_img15']['url'] ) ) : ?>
                            <li data-parallax='{"x": -150, "y": 150}'>
                                <img src="<?php echo esc_url( $settings['shape_img15']['url'] ) ?>" alt="<?php echo esc_attr( $settings['title_text'] ) ?>">
                            </li>
                        <?php endif; ?>
                        <?php if ( !empty($settings['shape_img16']['url'] ) ) : ?>
                            <li data-parallax='{"x": -100, "y": 100}'>
                                <img src="<?php echo esc_url( $settings['shape_img16']['url'] ) ?>" alt="<?php echo esc_attr( $settings['title_text'] ) ?>">
                            </li>
                        <?php endif; ?>
                        <?php if ( !empty($settings['shape_img17']['url'] ) ) : ?>
                            <li data-parallax='{"x": 50, "y": -50}'>
                                <img src="<?php echo esc_url( $settings['shape_img17']['url'] ) ?>" alt="<?php echo esc_attr( $settings['title_text'] ) ?>">
                            </li>
                        <?php endif; ?>
                        <?php if ( !empty($settings['shape_img18']['url'] ) ) : ?>
                            <li data-parallax='{"x": 250, "y": -250}'>
                                <img src="<?php echo esc_url( $settings['shape_img18']['url'] ) ?>" alt="<?php echo esc_attr( $settings['title_text'] ) ?>">
                            </li>
                        <?php endif; ?>
                        <?php if ( !empty($settings['shape_img19']['url'] ) ) : ?>
                            <li data-parallax='{"x": 150, "y": -150}'>
                                <img src="<?php echo esc_url( $settings['shape_img19']['url'] ) ?>" alt="<?php echo esc_attr( $settings['title_text'] ) ?>">
                            </li>
                        <?php endif; ?>
                        <?php if ( !empty($settings['shape_img20']['url'] ) ) : ?>
                            <li data-parallax='{"y": -180}'>
                                <img src="<?php echo esc_url( $settings['shape_img20']['url'] ) ?>" alt="<?php echo esc_attr( $settings['title_text'] ) ?>">
                            </li>
                        <?php endif; ?>
                    </ul>
                <?php endif;?>
                <div class="container">
                    <div class="title-four h_color text-center">
                        <?php if (!empty($settings['title_text'])) : ?> <h2 class="wow fadeInUp"> <?php echo esc_html($settings['title_text']); ?> </h2> <?php endif; ?>
                        <?php if (!empty($settings['subtitle_text'])) : ?>
                            <?php echo '<p class="p_color wow fadeInUp" data-wow-delay="200ms">'.$settings['subtitle_text']."</p>";
                        endif;
                        ?>
                    </div>
                    <div class="row <?php echo $settings['is_row_reverse']=='yes' ? 'flex-row-reverse' : ''; ?>">
                        <div class="col-md-<?php echo !empty($settings['the_featured_image']['url']) ? '6' : '12'; ?> d_flex <?php echo $settings['is_revers_column'] == 'yes' ? 'flex-column-reverse' : ''; ?>">
                            <div id="accordion-<?php echo esc_attr($this->get_id()) ?>" class="faq_accordian_two">
                                <?php
                                if (is_array($features)) {
                                    $count = 0;
                                    $ac     = 1;
                                    foreach ($features as $feature) {
                                        ?>
                                        <div class="card wow fadeInUp <?php if ($count == 0) { echo esc_attr( 'active' ); }?>">
                                            <div class="card-header" id="heading-<?php echo esc_attr($feature['_id']); ?>">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapse-<?php echo esc_attr($feature['_id']); ?>" aria-expanded="true" aria-controls="collapse-<?php echo esc_attr($feature['_id']); ?>">
                                                        <?php
                                                        if ( $feature['icon_type'] == 'font_icon' ) {
                                                            echo "<i class='{$feature['font_icon']}'></i>";
                                                        } else {
                                                            echo "<img src='{$feature['image_icon']['url']}' alt='{$feature['title']}'>";
                                                        }
                                                        if ( !empty($feature['title']) ) {
                                                            echo esc_html($feature['title']);
                                                        }
                                                        ?>
                                                    </button>
                                                </h5>
                                            </div>
                                            <div id="collapse-<?php echo esc_attr($feature['_id']); ?>" class="collapse <?php if ($count == 0){echo esc_attr( 'show' );}?>" aria-labelledby="heading-<?php echo esc_attr($feature['_id']); ?>" data-parent="#accordion-<?php echo $this->get_id(); ?>">
                                                <?php if (!empty($feature['desc'])) : ?>
                                                    <div class="card-body">
                                                        <p><?php echo saasland_kses_post( nl2br( $feature['desc'] ) ); ?></p>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <?php
                                        $ac++;
                                        $count++;
                                    }}
                                ?>
                            </div>
                        </div>
                        <?php
                        if (!empty($settings['the_featured_image']['url'])) : ?>
                            <div class="col-md-6">
                                <div class="faq_image_mockup wow fadeInUp" data-wow-delay="200ms">
                                    <img src="<?php echo esc_url($settings['the_featured_image']['url']) ?>" alt="featured">
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
            <?php
        }
    }

}