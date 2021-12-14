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

class Appart_hero extends Widget_Base {

    public function get_name() {
        return 'saasland_appart_hero';
    }

    public function get_title() {
        return __( 'App Hero', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-device-desktop';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    public function get_style_depends() {
        return [ 'appart-style', 'appart-responsive' ];
    }

    protected function _register_controls() {

        // ----------------------------------------  Hero content ------------------------------
        $this->start_controls_section(
            'app_hero_style',
            [
                'label' => __( 'Hero Design', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'style', [
                'label' => esc_html__( 'Design/Style', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [
                    'style_01' => esc_html__( 'Style one (Static background)', 'saasland-core' ),
                    'style_02' => esc_html__( 'Style two (Parallax animation)', 'saasland-core' ),
                    'style_03' => esc_html__( 'Style three (Background circle shapes)', 'saasland-core' ),
                    'style_04' => esc_html__( 'Style four (All centered)', 'saasland-core' ),
                    'style_05' => esc_html__( 'Style five (Two featured image)', 'saasland-core' ),
                ],
                'default' => 'style_01'
            ]
        );

        $this->end_controls_section();

        // ----------------------------------------  Hero content ------------------------------
        $this->start_controls_section(
            'hero_content',
            [
                'label' => __( 'Hero content', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'title_text',
            [
                'label' => esc_html__( 'Title text', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Welcome To Saasland'
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
            'subtitle_text',
            [
                'label' => esc_html__( 'Subtitle text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );

        $buttons = new \Elementor\Repeater();

        $buttons->add_control(
            'label', [
                'label' => __( 'Button name', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Get app now'
            ]
        );

        $buttons->add_control(
            'url', [
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
                'label' => __( 'Normal', 'plugin-name' ),
            ]
        );
        $buttons->add_control(
            'font_color', [
                'label' => __( 'Font Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}}',
                ),
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
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'border: 1px solid {{VALUE}};',
                ),
            ]
        );
        $buttons->end_controls_tab();
        /// ----------------------------- Hover Button Style
        $buttons->start_controls_tab(
            'style_hover_btn',
            [
                'label' => __( 'Hover', 'plugin-name' ),
            ]
        );
        $buttons->add_control(
            'hover_font_color', [
                'label' => __( 'Font Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'color: {{VALUE}};',
                ),
            ]
        );
        $buttons->add_control(
            'hover_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'background: {{VALUE}}',
                ),
            ]
        );
        $buttons->add_control(
            'hover_border_color', [
                'label' => __( 'Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'border: 1px solid {{VALUE}}',
                ),
            ]
        );
        $buttons->end_controls_tab();
        $buttons->end_controls_tabs();

        $this->add_control(
            'buttons', [
                'label' => __( 'Create buttons', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'title_field' => '{{{ label }}}',
                'fields' => $buttons->get_controls(),
            ]
        );

        $this->end_controls_section();

        // -------------------------------------------------- Featured image ------------------------------
        $this->start_controls_section(
            'featured_image_sec', [
                'label' => __( 'Featured image', 'saasland-core' ),
            ]
        );
        $this->add_control(
            'featured_image', [
                'label' => esc_html__( 'Upload the featured image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );
        $this->add_control(
            'featured_image2_size',
            [
                'label' => __( 'Image Width', 'plugin-domain' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1920,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} .col-header-img img' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .images-container img' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .mockup-flow.skrollable img' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .mockup_img img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section(); // End Featured image


        $this->start_controls_section(
            'featured_image2_sec', [
                'label' => __( 'Second Featured image', 'saasland-core' ),
                'condition' => [
                    'style' => 'style_05'
                ]
            ]
        );
        $this->add_control(
            'featured_image2', [
                'label' => esc_html__( 'Upload the image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );
        $this->end_controls_section(); // End Featured image


        /**
         * Style Tab
         * ------------------------------ Style Title ------------------------------
         *
         */
        $this->start_controls_section(
            'style_title', [
                'label' => __( 'Style Title', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'color_prefix', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .n_banner_content .title' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .banner-content .title' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .hero-content .title' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .page_contain .title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_prefix',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
				    {{WRAPPER}} .n_banner_content .title,
				    {{WRAPPER}} .banner-content .title,
				    {{WRAPPER}} .page_contain .title,
				    {{WRAPPER}} .hero-content .title',
            ]
        );
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(), [
                'name' => 'text_shadow_prefix',
                'selector' => '
				    {{WRAPPER}} .n_banner_content .title, 
				    {{WRAPPER}} .banner-content .title, 
				    {{WRAPPER}} .page_contain .title, 
				    {{WRAPPER}} .hero-content .title',
            ]
        );
        $this->end_controls_section();


        //------------------------------ Style Subtitle ------------------------------
        $this->start_controls_section(
            'style_subtitle', [
                'label' => __( 'Style subtitle', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'color_suffix', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .page_contain p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .n_banner_content p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .banner-content p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .hero-content p' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_suffix',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
				    {{WRAPPER}} .page_contain p, 
				    {{WRAPPER}} .n_banner_content p, 
				    {{WRAPPER}} .banner-content p, 
				    {{WRAPPER}} .hero-content p',
            ]
        );
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(), [
                'name' => 'text_shadow_suffix',
                'selector' => '
				    {{WRAPPER}} .page_contain p, 
				    {{WRAPPER}} .n_banner_content p, 
				    {{WRAPPER}} .banner-content p, 
				    {{WRAPPER}} .hero-content p',
            ]
        );

        $this->end_controls_section();


        //------------------------------ Style Section ------------------------------
        $this->start_controls_section(
            'style_section', [
                'label' => __( 'Style Background', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'is_first_circle', [
                'label' => __( 'First circle', 'saasland-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'saasland-core' ),
                'label_off' => __( 'No', 'saasland-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'style' => ['style_03']
                ]
            ]
        );
        $this->add_control(
            'first_circle_color', [
                'label' => __( 'First circle color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .first .hero-circle.circle-1' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'style' => 'style_03',
                    'is_first_circle' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'is_second_circle', [
                'label' => __( 'Second circle', 'saasland-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'saasland-core' ),
                'label_off' => __( 'No', 'saasland-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'style' => ['style_03'],
                ]
            ]
        );
        $this->add_control(
            'second_circle_color', [
                'label' => __( 'Second circle color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .first .hero-circle.circle-2' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'style' => 'style_03',
                    'is_second_circle' => 'yes'
                ]
            ]
        );
        $this->add_control(
            'is_third_circle', [
                'label' => __( 'Third circle', 'saasland-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'saasland-core' ),
                'label_off' => __( 'No', 'saasland-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'style' => ['style_03'],
                ]
            ]
        );
        $this->add_control(
            'third_circle_color', [
                'label' => __( 'Third circle color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .first .hero-circle.circle-3' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'style' => 'style_03',
                    'is_third_circle' => 'yes'
                ]
            ]
        );
        $this->add_control(
            'sec_bg_type', [
                'label' => esc_html__( 'Background type', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image' => 'Image',
                    'video' => 'Video',
                    'slide_show' => 'Slide Show'
                ],
                'condition' => [
                    'style'     => 'style_01',
                ]
            ]
        );
        $this->add_control(
            'sec_bg_images', [
                'label' => esc_html__( 'Background images', 'saasland-core' ),
                'type' => Controls_Manager::GALLERY,
                'condition' => [
                    'sec_bg_type' => 'slide_show',
                    'style'     => 'style_01',
                ],
            ]
        );
        $this->add_control(
            'sec_bg_image', [
                'label' => esc_html__( 'Background image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/hero_banner.png', __FILE__)
                ],
                'condition' => [
                    'style' => ['style_01', 'style_04', 'style_05'],
                ]
            ]
        );
        $this->add_control(
            'sec_bg_video', [
                'label' => esc_html__( 'Background video url', 'saasland-core' ),
                'description' => esc_html__( '.mp4, .webm, youtube video supported.', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'https://www.youtube.com/watch?v=5_-NKRVn7IQ&t=21s',
                'condition' => [
                    'sec_bg_type' => 'video',
                    'style'     => 'style_01',
                ]
            ]
        );
        $this->add_control(
            'section_svg_color', [
                'label'     => esc_html__( 'Background Color Left', 'saasland-core' ),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'style' => ['style_01', 'style_02', 'style_04', 'style_05'],
                ]
            ]
        );
        $this->add_control(
            'section_svg_color_right', [
                'label'     => esc_html__( 'Background Color Right', 'saasland-core' ),
                'type'           => Controls_Manager::COLOR,
                'condition' => [
                    'style' => ['style_01', 'style_02', 'style_04', 'style_05'],
                ]
            ]
        );

        $this->add_control(
            'style2_shape_color1', [
                'label' => __( 'Bottom Shape First Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'style' => 'style_02'
                ]
            ]
        );
        $this->add_control(
            'style2_shape_color2', [
                'label' => __( 'Bottom Shape Second Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'style' => 'style_02'
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {

        $settings = $this->get_settings();
        $buttons = $settings['buttons'];
        $top = !empty($settings['featured_image_position']['top']) ? "top: {$settings['featured_image_position']['top']}px; " : '';
        $right = !empty($settings['featured_image_position']['right']) ? "right: {$settings['featured_image_position']['right']}px; " : '';
        $bottom = !empty($settings['featured_image_position']['bottom']) ? "bottom: {$settings['featured_image_position']['bottom']}px; " : '';
        $left = !empty($settings['featured_image_position']['left']) ? "left:{$settings['featured_image_position']['left']}px; " : '';
        $title_tag = !empty($settings['title_html_tag']) ? $settings['title_html_tag'] : 'h2';
        if ( $settings['style'] == 'style_01' ) {
            $banner_class = '';
            switch ( $settings['sec_bg_type'] ) {
                case 'image':
                    $banner_class = 'hero-banner-six';
                    break;
                case 'video':
                    $banner_class = 'video_bg';
                    break;
                case 'slide_show':
                    $banner_class = 'backgroud_slidshow';
                    break;
            }
            $bg_color = !empty($settings['section_svg_color']) ? "
                style='background-image: -moz-linear-gradient( 0deg, {$settings['section_svg_color']} 0%, {$settings['section_svg_color_right']} 100%);
                background-image: -webkit-linear-gradient( 0deg, {$settings['section_svg_color']} 0%, {$settings['section_svg_color_right']} 100%);
                background-image: -ms-linear-gradient( 0deg, {$settings['section_svg_color']} 0%, {$settings['section_svg_color_right']} 100%);'" : '';
            ?>
            <?php
            if (!empty($settings['sec_bg_image']['url'])) { ?>
                <style>
                    .hero-one:after {
                        content: "";
                        width: 100%;
                        height: 100%;
                        left: 0;
                        top: 0;
                        position: absolute;
                        background: url(<?php echo $settings['sec_bg_image']['url'] ?>) no-repeat scroll center 100%;
                        background-size: cover;
                        z-index: -1;
                    }
                </style>
            <?php } ?>
            <section class="row hero-banner-area hero-one <?php echo $banner_class; ?>" <?php echo $bg_color; ?>>
                <?php
                if ($settings['sec_bg_type'] == 'video' ) {
                    if (strpos($settings['sec_bg_video'], 'youtube' ) == true) : ?>
                        <div class="video-background">
                            <div id="bgndVideo" class="player"
                                 data-property="{videoURL:'<?php echo $settings['sec_bg_video'] ?>', containment:'#home', showControls:false, autoPlay:true, loop:true, mute:true, startAt:0, opacity:0.2, addRaster:true, quality:'default'}"></div>
                        </div>
                    <?php else : ?>
                        <video id="bgvid" loop autoplay muted>
                            <source src="<?php echo esc_url($settings['sec_bg_video']) ?>" type="video/mp4">
                        </video>
                    <?php endif;
                } elseif ( $settings['sec_bg_type'] == 'slide_show' ) {
                    ?>
                    <div data-ride="carousel" class="carousel carousel-fade" id="carousel-example-captions"
                         data-pause="none" data-interval="5000" data-scroll-index="0">
                        <div role="listbox" class="carousel-inner">
                            <?php
                            $bg_images = !empty($settings['sec_bg_images']) ? $settings['sec_bg_images'] : '';
                            if (is_array($bg_images)) {
                                $i = 1;
                                foreach ($bg_images as $slide_img) { ?>
                                    <div class="carousel-item <?php echo $i == 1 ? 'active' : ''; ?>">
                                        <img src="<?php echo $slide_img['url'] ?>"
                                             alt="<?php echo $settings['title_text'] . ' ' . $i; ?>"
                                             class="slide-image"/>
                                    </div>
                                    <?php
                                    ++$i;
                                }}
                            ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <div class="col-md-6 p0 display-flex">
                    <div class="flex">
                        <div class="banner-content">
                            <?php if (!empty($settings['title_text'])) : ?>
                                <<?php echo $title_tag ?> class="title"> <?php echo $settings['title_text'] ?> </<?php echo $title_tag ?>>
                            <?php endif; ?>
                            <?php if (!empty($settings['subtitle_text'])) : ?>
                                <p> <?php echo $settings['subtitle_text'] ?> </p>
                            <?php endif; ?>
                            <?php
                            if (is_array($buttons)) {
                            $i = 1;
                            foreach ($buttons as $button) {
                                if ($button['btn_style'] == 'white' ) {
                                    echo '<a class="banner_btn btn-white" href="'.esc_url($button['url']['url']).'" '.saasland_is_external_return($button['url']).'>' . esc_html($button['label']) . '</a>';
                                } elseif ($button['btn_style'] == 'outline' ) {
                                    echo '<a class="banner_btn btn-transparent" href="'.esc_url($button['url']['url']).'" '.saasland_is_external_return($button['url']).'>' . esc_html($button['label']) . '</a>';
                                } else {
                                    ?>
                                    <style>
                                        .banner_btn<?php echo $i; ?>:hover {
                                            color: <?php echo $button['font_hover_color']; ?> !important;
                                            background-color: <?php echo $button['bg_hover_color']; ?> !important;
                                            border-color: <?php echo $button['border_hover_color']; ?> !important;
                                        }
                                    </style>
                                    <a class="banner_btn<?php echo $i; ?> banner_btn" href="<?php echo esc_url($button['url']['url']); ?>" <?php echo saasland_is_external_return($button['url']); ?> style="background: <?php echo $button['bg_color']; ?>; color: <?php echo $button['font_color']; ?>; border-color: <?php echo $button['border_color']; ?>;">
                                        <?php echo esc_html($button['label']) ?>
                                    </a>
                                    <?php
                                    ++$i;
                                }
                            }}
                            ?>
                        </div>
                    </div>
                </div>
                <?php if (!empty($settings['featured_image']['url'])) { ?>
                    <div class="col-md-6 col-header-img p0">
                        <img src="<?php echo esc_url($settings['featured_image']['url']); ?>" style="<?php echo $top.$right.$bottom.$left; ?>"
                             alt="<?php echo $settings['title_text'] ?>" class="img-header-sm">
                    </div>
                    <div class="shape"></div>
                <?php } ?>
            </section>
            <?php
        }

        elseif ( $settings['style'] == 'style_02' ) {
            $bg_color = !empty($settings['section_svg_color']) ? "style='background-image: -moz-linear-gradient( 40deg, {$settings['section_svg_color']} 0%, {$settings['section_svg_color_right']} 100%);
            background-image: -webkit-linear-gradient( 40deg, {$settings['section_svg_color']} 0%, {$settings['section_svg_color_right']} 100%);
            background-image: -ms-linear-gradient( 40deg, {$settings['section_svg_color']} 0%, {$settings['section_svg_color_right']} 100%);'" : '';
            $style2_shape_color1 = !empty($settings['style2_shape_color1']) ? $settings['style2_shape_color1'] : 'rgba(29,62,222, 0.20)';
            $style2_shape_color2 = !empty($settings['style2_shape_color2']) ? $settings['style2_shape_color2'] : 'rgba(3,218,246, 0.20)';
            $style2_shape_color1_4k = !empty($settings['style2_shape_color1']) ? $settings['style2_shape_color1'] : 'rgb(224, 215, 251)';
            $style2_shape_color2_4k = !empty($settings['style2_shape_color2']) ? $settings['style2_shape_color2'] : 'rgb(224, 215, 251)';
            ?>
            <section class="n_hero_banner_area" <?php echo $bg_color; ?>>
                <svg id="hero_shape2_normal" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <defs>
                        <linearGradient id="PSgrad_0" x1="0%" x2="76.604%" y1="64.279%" y2="0%">
                            <stop offset="0%" stop-color="<?php echo $style2_shape_color1_4k; ?>" stop-opacity="1"></stop>
                            <stop offset="100%" stop-color="<?php echo $style2_shape_color2_4k; ?>" stop-opacity="1"></stop>
                        </linearGradient>
                    </defs>
                    <path fill-rule="evenodd" fill="rgb(255, 255, 255)" d="M0.000,246.000 C0.000,246.000 326.728,190.237 710.653,123.017 C937.017,83.384 1398.662,3.976 1398.662,3.976 C1398.662,3.976 1524.189,5.641 1668.565,26.591 C1813.299,47.594 1920.000,84.745 1920.000,84.745 L1920.000,323.000 L0.000,323.000 L0.000,246.000 Z"></path>
                    <path fill="url(#PSgrad_0)" d="M0.000,323.249 C0.000,-57.945 0.000,623.445 0.000,242.251 C0.000,242.251 141.533,218.272 347.776,183.613 C479.132,161.538 636.827,133.656 800.746,105.827 C943.681,81.561 1097.680,52.804 1239.269,28.559 C1291.889,19.548 1358.059,5.849 1393.180,1.251 C1434.086,-4.103 1581.001,11.184 1661.097,24.221 C1818.678,49.869 1920.000,84.251 1920.000,84.251 L1920.000,190.407 C1813.062,96.085 1433.376,28.053 1285.064,28.053 L0.000,323.249 Z"></path>
                </svg>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7 col-md-12">
                            <div class="n_banner_content">
                                <?php if (!empty($settings['title_text'])) : ?>
                                    <<?php echo $title_tag ?> class="wow fadeInUp title" data-wow-delay="300ms">
                                        <?php echo esc_html($settings['title_text']) ?>
                                    </<?php echo $title_tag ?>>
                                <?php endif; ?>
                                <?php if (!empty($settings['subtitle_text'])) : ?>
                                    <p class="wow fadeInUp"
                                       data-wow-delay="500ms"><?php echo $settings['subtitle_text'] ?></p>
                                <?php endif; ?>
                                <?php
                                if ( !empty($buttons) ) {
                                foreach ( $buttons as $button ) {
                                    if ( $button['btn_style'] == 'gradient' ) {
                                        echo '<a class="n_banner_btn wow fadeInUp elementor-repeater-item-'.$button['_id'].'" data-wow-delay="600ms" href="'.esc_url($button['url']['url']).'" '.saasland_is_external_return($button['url']).'>' . esc_html($button['label']) . '</a>';
                                    } else {
                                        ?>
                                        <a class="agency_banner_btn  btn_custom elementor-repeater-item-<?php echo esc_attr($button['_id']) ?>" href="<?php echo esc_url($button['url']['url']); ?>" <?php echo saasland_is_external_return($button['url']) ?>>
                                            <?php echo esc_html($button['label']) ?>
                                        </a>
                                        <?php
                                    }
                                }}
                                ?>
                            </div>
                        </div>
                        <?php if (!empty($settings['featured_image']['url'])) : ?>
                            <div class="col-lg-4 offset-lg-1 col-md-12">
                                <div class="mobile_img wow fadeInUp animated" data-wow-delay="0.2s">
                                    <img src="<?php echo esc_url($settings['featured_image']['url']); ?>" alt="f_img">
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="shape_banners">
                    <img class="img3 wow fadeIn" data-wow-delay="1.5s" src="<?php echo plugin_dir_url(__FILE__).'images/appart-new/3D.png'; ?>" alt="f_img">
                </div>
                <div class="shape_banners_left">
                    <img class="header-btm-shape wow fadeIn" data-wow-delay="1.5s" src="<?php echo plugin_dir_url(__FILE__).'images/appart-new/header-btm-shape.png'; ?>" alt="f_img">
                </div>
            </section>
            <?php
        }

        elseif ( $settings['style'] == 'style_03' ) {
            ?>
            <section class="page-main page-current hero_three">
                <div class="page-toload home-page">
                    <div class="page-header">
                        <div class="circles-container">
                            <div class="first">
                                <?php if ( $settings['is_first_circle'] == 'yes' ) { ?>
                                    <span class="hero-circle circle-1"></span>
                                <?php } ?>
                                <?php if ( $settings['is_second_circle'] == 'yes' ) { ?>
                                    <span class="hero-circle circle-2"></span>
                                <?php } ?>
                                <?php if ( $settings['is_third_circle'] == 'yes' ) { ?>
                                    <span class="hero-circle circle-3"></span>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container display-flex">
                    <div class="row">
                        <div class="col-sm-7 col-12 display-flex">
                            <div class="page_contain flex">
                                <?php if (!empty($settings['title_text'])) : ?>
                                    <<?php echo $title_tag ?> class="title"> <?php echo $settings['title_text'] ?> </<?php echo $title_tag ?>>
                                <?php endif; ?>
                                <?php if (!empty($settings['subtitle_text'])) : ?>
                                    <p> <?php echo $settings['subtitle_text'] ?> </p>
                                <?php endif; ?>
                                <div class="appart-hero3-btns">
                                <?php
                                if ( !empty($buttons) ) {
                                foreach ( $buttons as $button ) {
                                        ?>
                                        <a class="agency_banner_btn  btn_custom elementor-repeater-item-<?php echo esc_attr($button['_id']) ?>" href="<?php echo esc_url($button['url']['url']); ?>" <?php echo saasland_is_external_return($button['url']) ?>>
                                            <?php echo esc_html($button['label']) ?>
                                        </a>
                                        <?php
                                }}
                                ?>
                                </div>
                            </div>
                        </div>
                        <?php
                        if (!empty($settings['featured_image']['url'])) { ?>
                            <div class="col-sm-5 col-12 display-flex">
                                <div class="images-container flex">
                                    <img class="first-image" src="<?php echo esc_url($settings['featured_image']['url']); ?>" alt="<?php echo $settings['title_text'] ?>">
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </section>
            <?php
        }

        elseif ( $settings['style'] == 'style_04' ) {
            $banner_class = '';
            switch ($settings['sec_bg_type']) {
                case 'image':
                    $banner_class = 'hero-banner-six';
                    break;
                case 'video':
                    $banner_class = 'video_bg';
                    break;
                case 'slide_show':
                    $banner_class = 'backgroud_slidshow';
                    break;
            }
            $bg_color = !empty($settings['section_svg_color']) ? "
                style='background-image: -moz-linear-gradient( 0deg, {$settings['section_svg_color']} 0%, {$settings['section_svg_color_right']} 100%);
                background-image: -webkit-linear-gradient( 0deg, {$settings['section_svg_color']} 0%, {$settings['section_svg_color_right']} 100%);
                background-image: -ms-linear-gradient( 0deg, {$settings['section_svg_color']} 0%, {$settings['section_svg_color_right']} 100%);'" : '';
            ?>
            <?php
            if (!empty($settings['sec_bg_image']['url'])) { ?>
                <style>
                    .hero-two.hero_04:after {
                        content: "";
                        width: 100%;
                        height: 100%;
                        left: 0;
                        top: 0;
                        position: absolute;
                        background: url(<?php echo $settings['sec_bg_image']['url'] ?>) no-repeat scroll center 100%;
                        background-size: cover;
                        z-index: -1;
                        opacity: 0.6;
                    }
                </style>
            <?php } ?>
            <section class="hero-two hero_04 <?php echo $banner_class; ?>" <?php echo $bg_color; ?>>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="col-header-text hero-content">
                                <?php if (!empty($settings['title_text'])) : ?>
                                    <<?php echo $title_tag ?> class="title"> <?php echo $settings['title_text'] ?> </<?php echo $title_tag ?>>
                                <?php endif; ?>
                                <?php if (!empty($settings['subtitle_text'])) : ?>
                                    <p> <?php echo $settings['subtitle_text'] ?> </p>
                                <?php endif; ?>
                                <?php
                                if ( !empty($buttons) ) {
                                    foreach ( $buttons as $button ) {
                                        if ( $button['btn_style'] == 'gradient' ) {
                                            echo '<a class="n_banner_btn wow fadeInUp elementor-repeater-item-'.$button['_id'].'" data-wow-delay="600ms" href="'.esc_url($button['url']['url']).'" '.saasland_is_external_return($button['url']).'>' . esc_html($button['label']) . '</a>';
                                        } else {
                                            ?>
                                            <a class="agency_banner_btn  btn_custom elementor-repeater-item-<?php echo esc_attr($button['_id']) ?>" href="<?php echo esc_url($button['url']['url']); ?>" <?php echo saasland_is_external_return($button['url']) ?>>
                                                <?php echo esc_html($button['label']) ?>
                                            </a>
                                            <?php
                                        }
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    if (!empty($settings['featured_image']['url'])) { ?>
                        <div class="mockup-flow skrollable skrollable-after" data-bottom="transform:translateY(150px) translateX(-50%);" data-top="transform:translateY(100px) translateX(-55%);">
                            <img src="<?php echo esc_url($settings['featured_image']['url']); ?>" alt="<?php echo $settings['title_text'] ?>">
                        </div>
                    <?php } ?>
                </div>
            </section>
            <?php
        }

        elseif ( $settings['style'] == 'style_05' ) {
            $bg_color = !empty($settings['section_svg_color']) ? "
                style='background-image: -moz-linear-gradient( 0deg, {$settings['section_svg_color']} 0%, {$settings['section_svg_color_right']} 100%);
                background-image: -webkit-linear-gradient( 0deg, {$settings['section_svg_color']} 0%, {$settings['section_svg_color_right']} 100%);
                background-image: -ms-linear-gradient( 0deg, {$settings['section_svg_color']} 0%, {$settings['section_svg_color_right']} 100%);'" : '';
            ?>
            <?php if (!empty($settings['sec_bg_image']['url'])) : ?>
                <style>
                    section.hero-three.hero_five:before {
                        background: url(<?php echo $settings['sec_bg_image']['url'] ?>) no-repeat scroll center 0/cover;
                    }
                </style>
            <?php endif; ?>
            <section class="hero-three hero_five" <?php echo $bg_color; ?>>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="col-header-text hero-content">
                                <?php if (!empty($settings['title_text'])) : ?>
                                    <<?php echo $title_tag ?> class="title"> <?php echo $settings['title_text'] ?> </<?php echo $title_tag ?>>
                                <?php endif; ?>
                                <?php if (!empty($settings['subtitle_text'])) : ?>
                                    <p> <?php echo $settings['subtitle_text'] ?> </p>
                                <?php endif; ?>
                                <?php
                                if ( !empty($buttons) ) {
                                    foreach ( $buttons as $button ) {
                                        if ( $button['btn_style'] == 'gradient' ) {
                                            echo '<a class="n_banner_btn wow fadeInUp elementor-repeater-item-'.$button['_id'].'" data-wow-delay="600ms" href="'.esc_url($button['url']['url']).'" '.saasland_is_external_return($button['url']).'>' . esc_html($button['label']) . '</a>';
                                        } else {
                                            ?>
                                            <a class="agency_banner_btn  btn_custom elementor-repeater-item-<?php echo esc_attr($button['_id']) ?>" href="<?php echo esc_url($button['url']['url']); ?>" <?php echo saasland_is_external_return($button['url']) ?>>
                                                <?php echo esc_html($button['label']) ?>
                                            </a>
                                            <?php
                                        }
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="mockup_img">
                        <?php
                        if (!empty($settings['featured_image']['url'])) { ?>
                            <img src="<?php echo esc_url($settings['featured_image']['url']); ?>" alt="<?php echo $settings['title_text'] ?>">
                        <?php } ?>
                        <?php if (!empty($settings['featured_image2']['url'])) : ?>
                            <img class="small_img" src="<?php echo esc_url($settings['featured_image2']['url']); ?>" alt="<?php echo $settings['title_text'] ?>">
                        <?php endif; ?>
                    </div>
                </div>
            </section>
            <?php
        }
    }
}
