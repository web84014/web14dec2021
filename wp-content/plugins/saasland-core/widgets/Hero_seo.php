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
 * Text Typing Effect
 *
 * Elementor widget for text typing effect.
 *
 * @since 1.7.0
 */
class Hero_seo extends Widget_Base {

    public function get_name() {
        return 'saasland_hero_seo';
    }

    public function get_title() {
        return __( 'Hero SEO', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-device-desktop';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    public function get_script_depends() {
        return [ 'typed' ];
    }

    protected function _register_controls() {

        // ----------------------------------------  Hero content ------------------------------
        $this->start_controls_section(
            'hero_content',
            [
                'label' => __( 'Hero Contents', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
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

        $this->end_controls_section();

        // ----------------------------------------  Hero content ------------------------------
        $this->start_controls_section(
            'subtitle_sec',
            [
                'label' => __( 'Subtitle', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => esc_html__( 'Subtitle text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );

        $this->end_controls_section(); // End Hero content


        // --------------------------------------- Featured image 1 ------------------------------
        $this->start_controls_section(
            'fimage_sec', [
                'label' => __( 'Featured image', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'fimage', [
                'label' => esc_html__( 'Upload the featured image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $this->end_controls_section(); // End Featured image



        /// --------------------  Buttons ----------------------------
        $this->start_controls_section(
            'buttons_sec',
            [
                'label' => __( 'Buttons', 'saasland-core' ),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'btn_title', [
                'label' => __( 'Button Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Get Started'
            ]
        );

        $repeater->add_control(
            'btn_url', [
                'label' => __( 'Button URL', 'saasland-core' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#'
                ]
            ]
        );


        $repeater->start_controls_tabs(
            'style_tabs'
        );

        /// Normal Button Style
        $repeater->start_controls_tab(
            'style_normal_btn',
            [
                'label' => __( 'Normal', 'saasland-core' ),
            ]
        );

        $repeater->add_control(
            'font_color', [
                'label' => __( 'Font Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}}',
                )
            ]
        );

        $repeater->add_control(
            'bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'background-color: {{VALUE}}; border-color: {{VALUE}}',
                )
            ]
        );

        $repeater->add_control(
            'border_color', [
                'label' => __( 'Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'border: 1px solid {{VALUE}}',
                )
            ]
        );

        $repeater->end_controls_tab();

        /// ----------------------------- Hover Button Style
        $repeater->start_controls_tab(
            'style_hover_btn',
            [
                'label' => __( 'Hover', 'saasland-core' ),
            ]
        );

        $repeater->add_control(
            'hover_font_color', [
                'label' => __( 'Font Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'color: {{VALUE}}',
                )
            ]
        );

        $repeater->add_control(
            'hover_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'background: {{VALUE}}',
                )
            ]
        );

        $repeater->add_control(
            'hover_border_color', [
                'label' => __( 'Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'border: 1px solid {{VALUE}}',
                )
            ]
        );

        $repeater->end_controls_tab();

        $this->add_control(
            'buttons', [
                'label' => __( 'Create buttons', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'title_field' => '{{{ btn_title }}}',
                'fields' => $repeater->get_controls(),
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
                    '{{WRAPPER}} .typewrite_title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
                {{WRAPPER}} .typewrite_title',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(), [
                'name' => 'text_shadow_title',
                'selector' => '
                    {{WRAPPER}} .typewrite_title',
            ]
        );

        $this->add_control(
            'color_typed_text', [
                'label' => __( 'Typed Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .typewrite_title mark' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'border_height',
            [
                'label' => __( 'Height', 'saasland-core' ),
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

        $this->add_control(
            'color_underline_typed_text', [
                'label' => __( 'Typed Text Underline Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .typewrite_title mark:after' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typewrite_title_hero_seo',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .typewrite_title mark span',
            ]
        );

        $this->end_controls_section();


        //  ------------------------------ Style Subtitle ------------------------------
        $this->start_controls_section(
            'style_subtitle', [
                'label' => __( 'Style Subtitle', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'color_subtitle', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .subtitle' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_subtitle',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
                {{WRAPPER}} .subtitle',
            ]
        );

        $this->end_controls_section();


        //------------------------------ Style Section ------------------------------
        $this->start_controls_section(
            'bg_objects', [
                'label' => __( 'Background Objects', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'is_bg_objects',
            [
                'label' => __( 'Background Objects', 'saasland-core' ),
                'description' => __( 'Enable/Disable the background floating objects.', 'saasland-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Enable', 'saasland-core' ),
                'label_off' => __( 'Disable', 'saasland-core' ),
                'return_value' => 'yes',
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'shape1',
            [
                'label' => __( 'Shape 01', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/seo/triangle_one.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'shape2',
            [
                'label' => __( 'Shape 02', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/seo/triangle_two.png', __FILE__)
                ],
                'condition' => [
                    'is_bg_objects' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'shape3',
            [
                'label' => __( 'Shape 02', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/seo/triangle_three.png', __FILE__)
                ],
                'condition' => [
                    'is_bg_objects' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'bubble1', [
                'label' => __( 'Bubble Color 01', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .home_bubble .bubble.b_one' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'is_bg_objects' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'bubble2', [
                'label' => __( 'Bubble Color 02', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .home_bubble .bubble.b_two' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'is_bg_objects' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'bubble3', [
                'label' => __( 'Bubble Color 03', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .home_bubble .bubble.b_three' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'is_bg_objects' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'bubble4', [
                'label' => __( 'Bubble Color 04', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .home_bubble .bubble.b_four' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'is_bg_objects' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'bubble5', [
                'label' => __( 'Bubble Color 05', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .home_bubble .bubble.b_five' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'is_bg_objects' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'bubble6', [
                'label' => __( 'Bubble Color 06', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .home_bubble .bubble.b_six' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();


        // Style Background
        $this->start_controls_section(
            'style_section', [
                'label' => __( 'Style Background', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'color_sec_bg', [
                'label' => __( 'Section Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .seo_home_area' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'sec_padding',
            [
                'label' => __( 'Section padding', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .seo_home_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',

                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {

        $settings = $this->get_settings();
        $buttons = $settings['buttons'];
        $title_tag = !empty($settings['title_html_tag']) ? $settings['title_html_tag'] : 'h2';
        ?>
        <section class="seo_home_area">
            <?php if ( $settings['is_bg_objects'] == 'yes' ) : ?>
                <div class="home_bubble">
                    <div class="bubble b_one"></div>
                    <div class="bubble b_two"></div>
                    <div class="bubble b_three"></div>
                    <div class="bubble b_four"></div>
                    <div class="bubble b_five"></div>
                    <div class="bubble b_six"></div>
                    <?php if ( !empty($settings['shape1']['url']) ) : ?>
                        <div class="triangle b_seven" data-parallax='{"x": 20, "y": 150}'>
                            <img src="<?php echo esc_url($settings['shape1']['url']) ?>" alt="<?php esc_attr($settings['title']); ?>">
                        </div>
                    <?php endif; ?>
                    <?php if ( !empty($settings['shape2']['url']) ) : ?>
                        <div class="triangle b_eight" data-parallax='{"x": 120, "y": -10}'>
                            <img src="<?php echo esc_url($settings['shape2']['url']) ?>" alt="<?php esc_attr($settings['title']); ?>">
                        </div>
                    <?php endif; ?>
                    <?php if ( !empty($settings['shape3']['url']) ) : ?>
                        <div class="triangle b_nine"><img src="<?php echo esc_url($settings['shape3']['url']) ?>" alt="<?php esc_attr($settings['title']); ?>"></div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <div class="banner_top">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center seo_banner_content">
                            <?php if (!empty($settings['title'])) : ?>
                                <<?php echo $title_tag; ?> class="title typewrite_title wow fadeInUp" data-wow-delay="0.3s"> <?php echo saasland_hero_title($settings['title']); ?> </<?php echo $title_tag; ?>>
                            <?php endif; ?>
                            <?php if (!empty($settings['subtitle'])) : ?>
                                <p class="subtitle wow fadeInUp" data-wow-delay="0.5s"> <?php echo wp_kses_post(nl2br($settings['subtitle'])); ?> </p>
                            <?php endif; ?>
                            <?php
                            $i = 0;
                            foreach ($buttons as $button) {
                                ++$i;
                                $strip_class = ($i % 2 == 1) ? 'seo_btn_one' : 'seo_btn_two';
                                echo "<a " .
                                    "href='{$button['btn_url']['url']}' ". saasland_is_external_return($button['btn_url']) .
                                    " class='$strip_class seo_btn btn_hover elementor-repeater-item-{$button['_id']}'> ".
                                    "{$button['btn_title']} " .
                                    "</a>";
                            }
                            ?>
                        </div>
                    </div>
                    <?php if (!empty($settings['fimage']['url'])) : ?>
                        <div class="saas_home_img wow fadeInUp" data-wow-delay="0.8s">
                            <img src="<?php echo esc_url($settings['fimage']['url']) ?>" alt="<?php echo esc_attr($settings['title']) ?>">
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
        <?php
        saasland_typed_words_js( $settings['title'] );
    }
}