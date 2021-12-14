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
 * Hero CRM Software
 */
class Hero_crm extends Widget_Base {

    public function get_name() {
        return 'saasland_hero_crm';
    }

    public function get_title() {
        return __( 'Hero CRM Software', 'saasland-core' );
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
                'description' => esc_html__( 'Wrap up the bold text with span tag (<span>Text</span>)', 'saasland-core' ),
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
            'featured_image', [
                'label' => esc_html__( 'Featured image', 'saasland-core' ),
                'description' => esc_html__( 'Upload here the featured image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'fimage_size', [
                'label' => __( 'Image max width', 'saasland-core' ),
                'description' => esc_html__( 'Default image width is 100% and height is auto. Input the size in pixel unit.', ''),
                'type' => Controls_Manager::NUMBER,
                'selectors' => [
                    '{{WRAPPER}} .new_startup_img img' => 'max-width: {{SIZE}}px;',
                ],
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
         * ------------------------------ Clipping Shape Images ------------------------------
         */
        $this->start_controls_section(
            'clipping_images', [
                'label' => __( 'Clipping Shape Images', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'line1', [
                'label' => esc_html__( 'Shape 01', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/line_01.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'line2', [
                'label' => esc_html__( 'Shape 02', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/line_02.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'line3', [
                'label' => esc_html__( 'Shape 03', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/line_03.png', __FILE__)
                ]
            ]
        );

        $this->end_controls_section();

        /* ------------------------------ Style Title ------------------------------ */
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
                    '{{WRAPPER}} .new_startup_content h2' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
                {{WRAPPER}} .new_startup_content h2',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(), [
                'name' => 'text_shadow_title',
                'selector' => '
                    {{WRAPPER}} .new_startup_content h2',
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
                    '{{WRAPPER}} h2 mark:after' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();



        //--------------------------- Style Subtitle ------------------------------
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
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .new_startup_content p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_subtitle',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
                {{WRAPPER}} .new_startup_content p',
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
            'bg_color', [
                'label'     => esc_html__( 'Background Color 02', 'saasland-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '.new_startup_banner_area'  => 'background: {{VALUE}};',
                ),
            ]
        );

        $this->add_control(
            'bg_shape', [
                'label' => esc_html__( 'Background Shape', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {

        $settings = $this->get_settings();
        $buttons = $settings['buttons'];

        if (!empty($settings['bg_shape']['url'])) : ?>
            <style>
                .new_startup_banner_area:before {
                    content: "";
                    background: url(<?php echo esc_url($settings['bg_shape']['url']) ?>) no-repeat scroll center bottom;
                }
            </style>
        <?php endif; ?>
        <section class="new_startup_banner_area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.4s">
                        <div class="new_startup_img">
                            <?php if (!empty($settings['line1']['url'])) : ?>
                                <div class="line line_one">
                                    <img src="<?php echo esc_url($settings['line1']['url']) ?>" alt="<?php esc_attr_e( 'Shape 01', 'saasland-core' ) ?>">
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($settings['line2']['url'])) : ?>
                                <div class="line line_two"><img src="<?php echo esc_url($settings['line2']['url']) ?>" alt="<?php esc_attr_e( 'Shape 02', 'saasland-core' ) ?>"></div>
                            <?php endif; ?>
                            <?php if (!empty($settings['line3']['url'])) : ?>
                                <div class= "line line_three"> <img src="<?php echo esc_url($settings['line3']['url']) ?>" alt="<?php esc_attr_e( 'Shape 03', 'saasland-core' ) ?>"></div>
                            <?php endif; ?>
                            <?php echo wp_get_attachment_image($settings['featured_image']['id'], 'full' ) ?>
                        </div>
                    </div>
                    <div class="col-lg-6 d-flex align-items-center">
                        <div class="new_startup_content">
                            <?php if (!empty($settings['title'])) : ?>
                                <h2 class="f_700 f_size_40 l_height50 w_color mb_20 wow fadeInRight" data-wow-delay="0.3s">
                                    <?php echo saasland_hero_title($settings['title']) ?>
                                </h2>
                            <?php endif; ?>
                            <?php if (!empty($settings['subtitle'])) : ?>
                                <p class="f_400 w_color l_height28 wow fadeInRight" data-wow-delay="0.4s">
                                    <?php echo wp_kses_post(nl2br($settings['subtitle'])) ?>
                                </p>
                            <?php endif; ?>

                            <div class="action_btn d-flex align-items-center mt_40 wow fadeInRight" data-wow-delay="0.6s">
                                <?php
                                foreach ($buttons as $button) {
                                    echo "<a " .
                                        "href='{$button['btn_url']['url']}' " .
                                        "class='btn_hover app_btn elementor-repeater-item-{$button['_id']}'> " .
                                        "{$button['btn_title']} " .
                                        "<i class='ti-arrow-right'></i> </a>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
        saasland_typed_words_js( $settings['title'] );
    }
}