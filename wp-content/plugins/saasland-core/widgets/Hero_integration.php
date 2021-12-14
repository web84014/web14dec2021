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
class Hero_integration extends Widget_Base {

    public function get_name() {
        return 'saasland_hero_integration';
    }

    public function get_title() {
        return __( 'Hero Integrations', 'saasland-core' );
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
                'default' => [
                    'url' => plugins_url( 'images/laptop_two.png', __FILE__)
                ]
            ]
        );

        $this->end_controls_section(); // End Featured image


        // --------------------------------------- Featured image 1 ------------------------------
        $this->start_controls_section(
            'images_sec', [
                'label' => __( 'Integrations', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'integrations', [
                'label' => esc_html__( 'Integration Images', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'title_field' => '{{{ title }}}',
                'fields' => [
                    [
                        'name' => 'title',
                        'label' => esc_html__( 'Image alt text', 'saasland-core' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => 'Animated image'
                    ],
                    [
                        'name' => 'image',
                        'label' => esc_html__( 'Image', 'saasland-core' ),
                        'type' => Controls_Manager::MEDIA,
                    ],
                ]
            ]
        );

        $this->end_controls_section(); // End Animated Images


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
                    '{{WRAPPER}} .payment_banner_area_two .title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
                {{WRAPPER}} .payment_banner_area_two .title',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(), [
                'name' => 'text_shadow_title',
                'selector' => '
                    {{WRAPPER}} .app_banner_contentmt .title',
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


        //------------------------------ Style Section ------------------------------
        $this->start_controls_section(
            'style_section', [
                'label' => __( 'Style Section', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'bg_color', [
                'label' => __( 'Background Color 01', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
            ]
        );

        $this->add_control(
            'bg_color2', [
                'label' => __( 'Background Color 02', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
            ]
        );

        $this->add_control(
            'bg_color3', [
                'label' => __( 'Background Color 03', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .payment_banner_area_two' => 'background-image: -webkit-linear-gradient(125deg, {{bg_color.VALUE}} 0%, {{bg_color2.VALUE}} 64%, {{VALUE}} 100%);',
                )
            ]
        );

        $this->add_responsive_control(
            'sec_padding', [
                'label' => __( 'Section padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .payment_banner_area_two' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
        $integrations = !empty($settings['integrations']) ? $settings['integrations'] : '';
        $title_tag = !empty($settings['title_html_tag']) ? $settings['title_html_tag'] : 'h2';
        ?>
        <section class="payment_banner_area_two">
            <div class="container">
                <div class="payment_content_two text-center">
                    <?php if (!empty($settings['title'])) : ?>
                        <<?php echo $title_tag ?> class="title"> <?php echo saasland_hero_title($settings['title']); ?> </<?php echo $title_tag ?>>
                    <?php endif; ?>
                    <div class="action_btn d-flex align-items-center justify-content-center">
                        <?php
                        $i = 0;
                        foreach ($buttons as $button) {
                            ++$i;
                            $strip_class = ($i % 2 == 1) ? 'slider_btn btn_hover' : 'video_btn';
                            $strip_icon = ($i % 2 == 1) ? '<i class="ti-plus"></i>' : '';
                            echo "<a " .
                                "href='{$button['btn_url']['url']}' " .
                                "class='$strip_class elementor-repeater-item-{$button['_id']}'> " . $strip_icon .
                                "{$button['btn_title']} " .
                                "</a>";
                        }
                        ?>
                    </div>
                    <div class="payment_img">
                        <?php if (!empty($settings['fimage']['url'])) : ?>
                            <img src="<?php echo esc_url($settings['fimage']['url']) ?>" alt="<?php echo esc_attr($settings['title']) ?>">
                        <?php endif; ?>
                        <div ></div>
                        <?php
                        if (is_array($integrations)) {
                            foreach ($integrations as $i => $integration) {
                                switch ($i) {
                                    case 0:
                                        $index = 'icon_one';
                                        break;
                                    case 1:
                                        $index = 'icon_two';
                                        break;
                                    case 2:
                                        $index = 'icon_three';
                                        break;
                                    case 3:
                                        $index = 'icon_four';
                                        break;
                                    case 4:
                                        $index = 'icon_five';
                                        break;
                                    case 5:
                                        $index = 'icon_six';
                                        break;
                                    case 6:
                                        $index = 'icon_seven';
                                        break;
                                    case 7:
                                        $index = 'icon_eight';
                                        break;
                                    case 8:
                                        $index = 'icon_nine';
                                        break;
                                    default:
                                        $index = 'icon_'.$i;
                                        break;
                                }
                                echo '<img class="payment_icon '.$index.'" src="'.$integration['image']['url'].'" alt="'.$integration['title'].'">';
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="symbols-pulse active">
                    <div class="pulse-1"></div>
                    <div class="pulse-2"></div>
                    <div class="pulse-3"></div>
                    <div class="pulse-4"></div>
                    <div class="pulse-x"></div>
                </div>
            </div>
        </section>
        <?php
        saasland_typed_words_js( $settings['title'] );
    }
}
