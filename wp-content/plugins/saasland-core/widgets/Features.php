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
 * Features
 */
class Features extends Widget_Base {

    public function get_name() {
        return 'saasland_main_features';
    }

    public function get_title() {
        return __( 'Features', 'saasland-hero' );
    }

    public function get_icon() {
        return 'eicon-posts-grid';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    public function get_style_depends()
    {
        return [ 'chat-features' ];
    }

    protected function _register_controls() {

        //------------------------------ Style subtitle ------------------------------
        $this->start_controls_section(
            'style_section', [
                'label' => __( 'Style section', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'style', [
                'label' => __( 'Style', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_01' => esc_html__( '01 Icon with Background Color', 'saasland-core' ),
                    'style_02' => esc_html__( '02 Font Icon with Background Image', 'saasland-core' ),
                    'style_03' => esc_html__( '03 Image Icon with Image Background', 'saasland-core' ),
                    'style_04' => esc_html__( '04 Image Icon with Background', 'saasland-core' ),
                    'style_05' => esc_html__( '05 Image Icon', 'saasland-core' ),
                    'style_06' => esc_html__( '06 Image Rotate Animation', 'saasland-core' ),
                ],
                'default' => 'style_01'
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
                'default' => '4'
            ]
        );

        $this->end_controls_section(); // End title section


        // ------------------------------  Title  ------------------------------
        $this->start_controls_section(
            'title_sec', [
                'label' => __( 'Title', 'saasland-core' ),
                'condition' => [
                    'style' => [ 'style_01', 'style_02', 'style_03', 'style_04', 'style_05' ]
                ]
            ]
        );

        $this->add_control(
            'title', [
                'label' => esc_html__( 'Title Text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'Awesome Features'
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
            'color_title', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .prototype_service_info h2' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .text-center.mb_90' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .software_featured_area h2' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .f_600.f_size_30.t_color3' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .sl_color_s.wow' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
                    {{WRAPPER}} .text-center.mb_90, 
                    {{WRAPPER}} .prototype_service_info h2, 
                    {{WRAPPER}} .software_featured_area h2,
                    {{WRAPPER}} .f_600.f_size_30.t_color3,
                    {{WRAPPER}} .sl_color_s.wow
                    ',
            ]
        );

        $this->end_controls_section(); // End title section


        // ------------------------------  Title  ------------------------------
        $this->start_controls_section(
            'subtitle_sec', [
                'label' => __( 'Subtitle', 'saasland-core' ),
                'condition' => [
                    'style' => ['style_03', 'style_04']
                ]
            ]
        );

        $this->add_control(
            'subtitle', [
                'label' => esc_html__( 'Subtitle Text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );

        $this->add_control(
            'color_subtitle', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .software_featured_area .container > p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .hosting_title p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_subtitle',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
                    {{WRAPPER}} .software_featured_area .container > p,
                    {{WRAPPER}} .hosting_title p
                    ',
            ]
        );

        $this->end_controls_section(); // End title section


        // ------------------------------ Feature list ------------------------------
        $this->start_controls_section(
            'contents', [
                'label' => __( 'Contents', 'saasland-core' ),
            ]
        );

        // Features for Style 01
        $this->add_control(
            'features', [
                'label' => __( 'Features', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'title_field' => '{{{ title }}}',
                'condition' => [
                    'style' => ['style_01']
                ],
                'fields' => [
                    [
                        'name' => 'title',
                        'label' => __( 'Feature title', 'saasland-core' ),
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default' => 'Default Title'
                    ],
                    [
                        'name' => 'subtitle',
                        'label' => __( 'Subtitle', 'saasland-core' ),
                        'type' => Controls_Manager::TEXTAREA,
                        'label_block' => true,
                    ],
                    [
                        'name' => 'icon_type',
                        'label' => __( 'Icon Type', 'saasland-core' ),
                        'type' => Controls_Manager::SELECT,
                        'default' => 'ti',
                        'options' => [
                            'ti' => __( 'Themify Icon', 'saasland-core' ),
                            'image_icon' => __( 'Image icon', 'saasland-core' ),
                        ],
                    ],
                    [
                        'name' => 'ti',
                        'label' => __( 'Themify Icon', 'saasland-core' ),
                        'type' => Controls_Manager::ICON,
                        'options' => saasland_themify_icons(),
                        'include' => saasland_include_themify_icons(),
                        'default' => 'ti-panel',
                        'condition' => [
                            'icon_type' => 'ti'
                        ]
                    ],
                    [
                        'name' => 'bg_color',
                        'label' => __( 'Icon Background Color', 'saasland-core' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .p_service_item {{CURRENT_ITEM}}.icon, {{WRAPPER}} .p_service_item {{CURRENT_ITEM}}.icon:before' => 'background-color: {{VALUE}};',
                        ],
                        'condition' => [
                            'icon_type' => 'ti'
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

        // Features for Style 02
        $this->add_control(
            'features2', [
                'label' => __( 'Features', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'title_field' => '{{{ title }}}',
                'condition' => [
                    'style' => ['style_02']
                ],
                'fields' => [
                    [
                        'name' => 'title',
                        'label' => __( 'Feature title', 'saasland-core' ),
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default' => 'Default Title'
                    ],
                    [
                        'name' => 'subtitle',
                        'label' => __( 'Description', 'saasland-core' ),
                        'type' => Controls_Manager::TEXTAREA,
                        'label_block' => true,
                    ],
                    [
                        'name' => 'ti',
                        'label' => __( 'Icon', 'saasland-core' ),
                        'type' => Controls_Manager::ICON,
                        'options' => saasland_themify_icons(),
                        'include' => saasland_include_themify_icons(),
                        'default' => 'ti-panel',
                    ],
                    [
                        'name' => 'image_icon',
                        'label' => __( 'Icon Background Image', 'saasland-core' ),
                        'type' => Controls_Manager::MEDIA,
                        'default' => [
                            'url' => plugins_url( 'images/icon_shape1.png', __FILE__)
                        ]
                    ],
                    [
                        'name' => 'link_title',
                        'label' => __( 'Link Title', 'saasland-core' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => 'Read More'
                    ],
                    [
                        'name' => 'link_url',
                        'label' => __( 'Link URL', 'saasland-core' ),
                        'type' => Controls_Manager::URL,
                        'default' => [
                            'url' => '#'
                        ]
                    ],
                ],
            ]
        );


        // Features for Style 03
        $this->add_control(
            'features3', [
                'label' => __( 'Features', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'title_field' => '{{{ title }}}',
                'condition' => [
                    'style' => ['style_03']
                ],
                'fields' => [
                    [
                        'name' => 'title',
                        'label' => __( 'Feature title', 'saasland-core' ),
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default' => 'Default Title'
                    ],
                    [
                        'name' => 'subtitle',
                        'label' => __( 'Description', 'saasland-core' ),
                        'type' => Controls_Manager::TEXTAREA,
                        'label_block' => true,
                    ],
                    [
                        'name' => 'image_icon',
                        'label' => __( 'Icon', 'saasland-core' ),
                        'type' => Controls_Manager::MEDIA,
                        'default' => [
                            'url' => plugins_url( 'images/icon1.png', __FILE__)
                        ]
                    ],
                    [
                        'name' => 'icon_bg',
                        'label' => __( 'Icon Background Image', 'saasland-core' ),
                        'type' => Controls_Manager::MEDIA,
                        'default' => [
                            'url' => plugins_url( 'images/icon_shape.png', __FILE__)
                        ]
                    ],
                    [
                        'name' => 'link_title',
                        'label' => __( 'Link Title', 'saasland-core' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => 'Read More'
                    ],
                    [
                        'name' => 'link_url',
                        'label' => __( 'Link URL', 'saasland-core' ),
                        'type' => Controls_Manager::URL,
                        'default' => [
                            'url' => '#'
                        ]
                    ],
                ],
            ]
        );

        $this->add_control(
            'icon_bg_color', [
                'label' => __( 'Icon Background', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'style' =>  'style_04'
                ],
                'selectors' => [
                    '{{WRAPPER}} .hosting_service_item .icon' => 'background: {{VALUE}};',
                ],
            ]
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'title', [
                'label' => esc_html__( 'Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Shared Hosting'
            ]
        );

        $repeater->add_control(
            'link_url', [
                'label' => esc_html__( 'Title URL', 'saasland-core' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url'   => '#'
                ]
            ]
        );

        $repeater->add_control(
            'subtitle', [
                'label' => esc_html__( 'Subtitle', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );

        $repeater->add_control(
            'f_img', [
                'label' => esc_html__( 'Icon Image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url'   => '#'
                ]
            ]
        );

        $repeater->add_control(
            'top_border_color', [
                'label' => __( 'Hover Accent Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .hosting_service_item:hover' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} {{CURRENT_ITEM}} .pos_service_info .hosting_service_item:hover' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} {{CURRENT_ITEM}} .pos_service_info .hosting_service_item h4:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} {{CURRENT_ITEM}} a .h_head:hover' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'features4', [
                'label' => esc_html__( 'Feature', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'title_field' => '{{{ title }}}',
                'fields' => $repeater->get_controls(),
                'condition' => [
                    'style' => [ 'style_04', 'style_05' ]
                ],
            ]
        );


        // Features 05, Style 06
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'fimage', [
                'label' => esc_html__( 'Featured Image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $repeater->add_control(
            'rotate_img', [
                'label' => esc_html__( 'Rotate Animation Image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $repeater->add_control(
            'title', [
                'label' => esc_html__( 'Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'subtitle', [
                'label' => esc_html__( 'Subtitle', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );

        $repeater->add_control(
            'bg_box_color', [
                'label' => __( 'Item Box Color 01', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
            ]
        );

        $repeater->add_control(
            'bg_box_color2', [
                'label' => __( 'Item Box Color 02', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'background-image: -webkit-linear-gradient(-140deg, {{bg_box_color.VALUE}} 0%, {{VALUE}} 100%);',
                )
            ]
        );

        $this->add_control(
            'features5', [
                'label' => esc_html__( 'Features', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'title_field' => '{{{ title }}}',
                'fields' => $repeater->get_controls(),
                'condition' => [
                    'style' => [ 'style_06' ]
                ],
            ]
        );

        $this->end_controls_section();


        /**
         * Feature Item Title
         */
        $this->start_controls_section(
            'style_feature_item_title', [
                'label' => __( 'Feature Item Title', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'feature_item_title_tag',
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
                'separator' => 'after',
            ]
        );

        $this->add_control(
            'color_feature_item_title', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .p_service_item h5' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .f_600.t_color3' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .h_head' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .chat_features_item h4' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_feature_item_title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
                    {{WRAPPER}} .p_service_item h5,
                    {{WRAPPER}} .f_600.t_color3,
                    {{WRAPPER}} .h_head,
                    {{WRAPPER}} .chat_features_item h4
                    ',
            ]
        );

        $this->end_controls_section();


        // ----------- Feature Item Description
        $this->start_controls_section(
            'style_feature_item_subtitle', [
                'label' => __( 'Feature Item Description', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'color_feature_item_subtitle', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .p_service_item p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .software_featured_item p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .hosting_service_item p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .chat_features_item p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_feature_item_subtitle',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
                    {{WRAPPER}} .p_service_item p, 
                    {{WRAPPER}} .software_featured_item p,
                    {{WRAPPER}} .hosting_service_item p,
                    {{WRAPPER}} .chat_features_item p
                    ',
            ]
        );

        $this->end_controls_section();


        /** === Read More Styling === **/
        $this->start_controls_section(
            'style_read_more', [
                'label' => __( 'Style Read More', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => ['style_02']
                ]
            ]
        );

        $this->add_control(
            'read_more_color', [
                'label' => __( 'Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .agency_service_item a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .agency_service_item p i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .agency_service_item a:before' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            '', [
                'label' => __( 'Hover Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .agency_service_item p:hover a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .agency_service_item p:hover i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .agency_service_item p:hover a:before' => 'background: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_feature_item_readmore',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => ' {{WRAPPER}} .agency_service_item a'
            ]
        );

        $this->end_controls_section();


        //------------------------------ Background Styling ------------------------------
        $this->start_controls_section(
            'bg_styling_section', [
                'label' => __( 'Background Styling', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'pattern_shape_img', [
                'label' => esc_html__( 'Shape Image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/home-pos/pattern_02.png', __FILE__)
                ],
                'condition' => [
                    'style' =>  'style_05'
                ],
            ]
        );

        $this->add_responsive_control(
            'sec_padding', [
                'label' => __( 'Section padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .agency_service_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .prototype_service_info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .software_featured_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .sec_pad' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',
                ],
            ]
        );

        $this->add_control(
            'wave_color', [
                'label' => __( 'Wave Color 01', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'style' => ['style_01']
                ]
            ]
        );

        $this->add_control(
            'wave_color_02', [
                'label' => __( 'Wave Color 02', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .symbols-pulse > div' => 'background-image: linear-gradient(-180deg, {{wave_color.VALUE}} 0%, {{VALUE}} 65%, rgba(227, 221, 246, 0.1) 100%);',
                ],
                'condition' => [
                    'style' => ['style_01']
                ]
            ]
        );

        $this->add_control(
            'col_padding', [
                'label' => __( 'Column Padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .software_featured_item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',
                    'isLinked' => false,
                ],
                'condition' => [
                    "style" => ['style_03']
                ]
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings();
        $features = isset($settings['features']) ? $settings['features'] : '';
        $features2 = isset($settings['features2']) ? $settings['features2'] : '';
        $features3 = isset($settings['features3']) ? $settings['features3'] : '';
        $features4 = isset($settings['features4']) ? $settings['features4'] : '';
        $features5 = is_array($settings['features5']) ? $settings['features5'] : '';
        $column = isset($settings['column']) ? $settings['column'] : '3';
        $title_tag = !empty($settings['title_html_tag']) ? $settings['title_html_tag'] : 'h2';
        $feature_item_title_tag = !empty($settings['feature_item_title_tag']) ? $settings['feature_item_title_tag'] : 'h5';

        if ( $settings['style'] == 'style_01' ) : ?>
            <section class="prototype_service_area_three">
                <div class="container">
                    <div class="prototype_service_info">
                        <div class="symbols-pulse active">
                            <div class="pulse-1"></div>
                            <div class="pulse-2"></div>
                            <div class="pulse-3"></div>
                            <div class="pulse-4"></div>
                            <div class="pulse-x"></div>
                        </div>

                        <?php if (!empty($settings['title'])) : ?>
                            <<?php echo $title_tag; ?> class="f_size_30 f_600 t_color3 l_height45 text-center mb_90 wow fadeInUp" data-wow-delay="0.3s">
                                <?php echo wp_kses_post(nl2br($settings['title'])) ?>
                            </<?php echo $title_tag; ?>>
                        <?php endif; ?>

                        <div class="row p_service_info">
                            <?php
                            if (is_array($features)) {
                                $i = 0.2;
                                $padding = '';
                                foreach ($features as $i1 => $feature) {
                                    if ( $column == '3' ) {
                                        if ( $i1 % 4 == 0 ) {
                                            $padding = 'pr_70';
                                        }
                                        if ( $i1 % 4 == 0 ) {
                                            $padding = 'pl_20 pr_70';
                                        }
                                    }
                                    ?>
                                    <div class="col-lg-<?php echo esc_attr($column); ?> col-sm-6">
                                        <div class="p_service_item pr_70 wow fadeInLeft" data-wow-delay="<?php echo esc_attr($i); ?>s">
                                            <div class="icon icon_one elementor-repeater-item-<?php echo $feature['_id'] ?>">
                                                <?php
                                                if ( $feature['icon_type'] == 'ti' ) { ?>
                                                    <i class="<?php echo esc_attr($feature['ti']) ?>"></i>
                                                    <?php
                                                } elseif ( $feature['icon_type'] == 'image_icon' ) {
                                                    echo "<img src='{$feature['image_icon']['url']}' alt='{$feature['title']}'>";
                                                }
                                                ?>
                                            </div>
                                            <<?php echo $feature_item_title_tag ?> class="f_600 f_p t_color3">
                                                <?php echo esc_html($feature['title']) ?>
                                            </<?php echo $feature_item_title_tag ?>>
                                            <?php if (!empty($feature['subtitle'])) : ?>
                                                <p class="f_300"> <?php echo $feature['subtitle']; ?> </p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php
                                    $i = $i + 0.2;
                                }}
                            ?>
                        </div>
                    </div>
                </div>
            </section>

        <?php
        elseif ( $settings['style'] == 'style_02' ) : ?>
            <section class="agency_service_area">
                <div class="container custom_container">
                    <?php if (!empty($settings['title'])) : ?>
                        <<?php echo $title_tag; ?> class="f_size_30 f_600 t_color3 l_height40 text-center mb_90 wow fadeInUp" data-wow-delay="0.3s">
                            <?php echo wp_kses_post(nl2br($settings['title'])) ?>
                        </<?php echo $title_tag; ?>>
                    <?php endif; ?>
                <div class="row mb_30">
                    <?php
                    unset($i, $feature);
                    if (is_array($features2)) {
                        $i = 0.3;
                        $i2 = 1;
                        foreach ($features2 as $feature) {
                            if ( $i2 % 2 == 0 ) {
                                $padding = 'pr_70';
                            }
                            ?>
                            <div class="col-lg-<?php echo esc_attr($column); ?> col-sm-6">
                                <div class="p_service_item agency_service_item pr_70 wow fadeInUp" data-wow-delay="<?php echo esc_attr($i); ?>s">
                                    <div class="icon">
                                        <?php if (!empty($feature['image_icon']['url'])) : ?>
                                            <img src="<?php echo esc_url($feature['image_icon']['url']); ?>" alt="<?php echo esc_attr($feature['title']) ?>">
                                        <?php endif; ?>
                                        <i class="<?php echo esc_attr($feature['ti']) ?>"></i>
                                    </div>
                                    <?php if (!empty($feature['title'])) : ?>
                                        <<?php echo $feature_item_title_tag ?> class="f_600 f_p t_color3"> <?php echo esc_html($feature['title']) ?> </<?php echo $feature_item_title_tag; ?>>
                                    <?php endif; ?>
                                    <?php echo wpautop($feature['subtitle']); ?>
                                    <?php if (!empty($feature['link_title'])) : ?>
                                        <p class="mb-0">
                                            <?php if ( !empty($feature['link_url']) ) : ?> <a <?php saasland_el_btn($feature['link_url']) ?>> <?php endif; ?>
                                                <?php echo esc_html($feature['link_title']) ?>
                                            <?php if ( !empty($feature['link_url']['url']) ) : ?> </a> <?php endif; ?>
                                            <i class="ti-arrow-right"></i>
                                        </p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php
                            ++$i2;
                            $i = $i + 0.2;
                        }}
                    ?>
                </div>
                </div>
            </section>
        <?php

        elseif ( $settings['style'] == 'style_03' ) :
            ?>
            <section class="software_featured_area <?php echo !empty($settings['subtitle']) ? 'has_subtitle' : ''; ?>">
                <div class="container">
                    <?php if (!empty($settings['title'])) : ?>
                    <<?php echo $title_tag; ?> class="f_600 f_size_30 t_color3 text-center l_height40 mb_70 wow fadeInUp" data-wow-delay="0.3s">
                    <?php echo wp_kses_post(nl2br($settings['title'])) ?>
                </<?php echo $title_tag; ?>>
                <?php endif; ?>
                <?php if (!empty($settings['subtitle'])) : ?>
                    <p class="f_300 f_size_16 wow fadeInUp" data-wow-delay="0.4s">
                        <?php echo wp_kses_post(nl2br($settings['subtitle'])) ?>
                    </p>
                <?php endif; ?>
                <div class="row software_featured_info">
                    <?php
                    unset($i, $feature);
                    if (is_array($features3)) {
                        $i = 0.3;
                        foreach ($features3 as $feature) {
                            ?>
                            <div class="col-lg-<?php echo esc_attr($column); ?> col-sm-6 wow fadeInUp" data-wow-delay="<?php echo esc_attr($i) ?>s">
                                <div class="software_featured_item text-center mb_20">
                                    <div class="s_icon">
                                        <?php if (!empty($feature['icon_bg']['url'])) : ?>
                                            <img src="<?php echo esc_url($feature['icon_bg']['url']) ?>" alt="<?php echo esc_attr($feature['title']) ?>">
                                        <?php endif; ?>
                                        <?php if (!empty($feature['image_icon']['url'])) : ?>
                                            <img class="icon" src="<?php echo esc_url($feature['image_icon']['url']); ?>" alt="<?php echo esc_attr($feature['title']) ?>">
                                        <?php endif; ?>
                                    </div>
                                    <?php if (!empty($feature['title'])) : ?>
                                        <<?php echo $feature_item_title_tag ?> class="f_600 t_color3"><?php echo esc_html($feature['title']) ?></<?php echo $feature_item_title_tag ?>>
                                    <?php endif; ?>
                                    <?php if (!empty($feature['subtitle'])) : ?>
                                        <p class="f_size_15 mb-30"> <?php echo wp_kses_post(nl2br($feature['subtitle'])); ?> </p>
                                    <?php endif; ?>
                                    <?php if (!empty($feature['link_title'])) : ?>
                                        <a href="<?php echo esc_url($feature['link_url']['url']) ?>" class="learn_btn">
                                            <?php echo esc_html($feature['link_title']) ?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php
                            $i = $i + 0.2;
                        }}
                    ?>
                </div>
                </div>
            </section>
        <?php

        elseif ( $settings['style'] == 'style_04' ) :
            ?>
            <section class="hosting_service_area sec_pad">
                <div class="container">
                    <div class="hosting_title text-center">
                        <?php if (!empty($settings['title'])) : ?>
                        <<?php echo $title_tag ?> class="sl_color_s wow fadeInUp" data-wow-delay="0.3s">
                        <?php echo wp_kses_post(nl2br($settings['title'])) ?>
                    </<?php echo $title_tag ?>>
                    <?php endif; ?>
                    <?php if (!empty($settings['subtitle'])) : ?>
                        <p class="wow fadeInUp" data-wow-delay="0.5s">
                            <?php echo wp_kses_post(nl2br($settings['subtitle'])) ?>
                        </p>
                    <?php endif; ?>
                </div>
                <div class="container">
                    <div class="row">
                        <?php
                        if (!empty( $features4 )) {
                            foreach ( $features4 as $feature ) {
                                ?>
                                <div class="col-lg-<?php echo esc_attr($column); ?> col-sm-6 elementor-repeater-item-<?php echo esc_attr($feature['_id']) ?>">
                                    <div class="hosting_service_item">
                                        <div class="icon">
                                            <?php echo wp_get_attachment_image( $feature['f_img']['id'], 'full' ); ?>
                                        </div>
                                        <?php if (!empty($feature['title'])) : ?>
                                            <?php if ( !empty($feature['link_url']['url']) ) : ?> <a <?php saasland_el_btn($feature['link_url']) ?>> <?php endif; ?>
                                                <<?php echo $feature_item_title_tag ?> class="h_head"> <?php echo esc_html($feature['title']) ?> </<?php echo $feature_item_title_tag; ?>>
                                            <?php if ( !empty($feature['link_url']['url']) ) : ?> </a> <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if (!empty($feature['subtitle'])) : ?>
                                            <?php echo wp_kses_post(wpautop($feature['subtitle'])) ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php
                            }}
                        ?>
                    </div>
                </div>
            </section>
        <?php
        elseif ( $settings['style'] == 'style_05' ) :
            ?>
            <section class="hosting_service_area sec_pad">
                <?php if ( !empty( $settings['pattern_shape_img'] ) ) : ?>
                    <div data-parallax='{"x": 0, "y": 100}'>
                        <div class="pattern_shap" style="background: url(<?php echo esc_url($settings['pattern_shape_img']['url']) ?>);"></div>
                    </div>
                <?php endif; ?>
                <div class="container">
                    <div class="hosting_title text-center">
                        <<?php echo $title_tag ?> class="sl_color_s wow fadeInUp" data-wow-delay="0.3s">
                        <?php echo wp_kses_post(nl2br($settings['title'])) ?>
                    </<?php echo $title_tag ?>>
                </div>
                <div class="row pos_service_info">
                    <?php
                    if ( !empty($features4 ) ) {
                        foreach ( $features4 as $feature ) {
                            ?>
                            <div class="col-lg-<?php echo esc_attr($column); ?> col-sm-6 elementor-repeater-item-<?php echo esc_attr($feature['_id']) ?>">
                                <div class="hosting_service_item">
                                    <?php echo wp_get_attachment_image( $feature['f_img']['id'], 'full' ); ?>
                                    <?php if (!empty($feature['title'])) : ?>
                                        <?php if ( !empty($feature['link_url']['url']) ) : ?> <a <?php saasland_el_btn($feature['link_url']) ?>> <?php endif; ?>
                                            <<?php echo $feature_item_title_tag ?> class="h_head"><?php echo esc_html($feature['title']) ?></<?php echo $feature_item_title_tag ?>>
                                        <?php if ( !empty($feature['link_url']['url']) ) : ?> </a> <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if ( !empty($feature['subtitle']) ) : ?>
                                        <?php echo wp_kses_post(wpautop($feature['subtitle'])) ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php
                        }}
                    ?>
                </div>
                </div>
            </section>

        <?php
        elseif ( $settings['style'] == 'style_06' ) :
            ?>
            <div class="row">
                <?php
                if ( !empty($features5 ) ) {
                    foreach ( $features5 as $feature ) {
                        ?>
                        <div class="col-lg-<?php echo esc_attr($column); ?> col-md-6">
                            <div class="chat_features_item wow fadeInUp">
                                <div class="round">
                                    <div class="round_circle elementor-repeater-item-<?php echo $feature['_id'] ?>"></div>
                                    <?php
                                    if ( !empty( $feature['rotate_img']['id'] ) ) {
                                        echo wp_get_attachment_image( $feature['rotate_img']['id'], 'full', false, array( 'class' => 'top_img p_absoulte' ) );
                                    }
                                    if ( !empty( $feature['fimage']['id'] ) ) {
                                        echo wp_get_attachment_image( $feature['fimage']['id'], 'full' );
                                    }
                                    ?>
                                </div>
                                <?php
                                if ( !empty( $feature['title'] ) ) {
                                    echo "<a href='#'> <$feature_item_title_tag> {$feature['title']} </$feature_item_title_tag> </a>";
                                }
                                if ( !empty( $feature['subtitle'] ) ) {
                                    echo wp_kses_post ( wpautop($feature['subtitle'] ) ) ;
                                }
                                ?>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
            <?php
        endif;
    }
}