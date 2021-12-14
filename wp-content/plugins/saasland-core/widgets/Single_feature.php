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
 * Single Feature
 * Class Single_feature
 * @package SaaslandCore\Widgets
 */
class Single_feature extends Widget_Base {
    public function get_name() {
        return 'saasland_single_feature';
    }

    public function get_title() {
        return __( 'Single Feature', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-post-info';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    protected function _register_controls() {
// ------------------------------  Title ------------------------------
        $this->start_controls_section(
            'title_sec', [
                'label' => __( 'Title', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'title', [
                'label' => esc_html__( 'Title text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => "Default Title"
            ]
        );

        $this->add_control(
            'color_title', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} h4' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} h4',
            ]
        );

        $this->end_controls_section(); // End title section

        // ------------------------------  Subtitle ------------------------------
        $this->start_controls_section(
            'subtitle_sec', [
                'label' => __( 'Description', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'subtitle', [
                'label' => esc_html__( 'Text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'color_subtitle', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_subtitle',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} p',
            ]
        );

        $this->end_controls_section(); // End title section


        // -------------------- Icon ------------------------------
        $this->start_controls_section(
            'icon_sec', [
                'label' => esc_html__( 'Icon', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'image_icon', [
                'label' => esc_html__( 'Image Icon', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/icon.png', __FILE__)
                ]
            ]
        );

        $this->end_controls_section();

        // -------------------- Button ------------------------------
        $this->start_controls_section(
            'btn_sec', [
                'label' => esc_html__( 'Link', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'btn_title', [
                'label' => esc_html__( 'Link Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Learn More',
                'label_block' => true
            ]
        );

        $this->add_control(
            'btn_url', [
                'label' => esc_html__( 'Link URL', 'saasland-core' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#'
                ],
            ]
        );

        $this->end_controls_section();

        // -------------------- Style Section ------------------------------
        $this->start_controls_section(
            'style_section', [
                'label' => esc_html__( 'Style Section', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'text_align',
            [
                'label' => __( 'Alignment', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'saasland-core' ),
                        'icon' => 'fab fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'saasland-core' ),
                        'icon' => 'fab fa-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'saasland-core' ),
                        'icon' => 'fab fa-align-right',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
            ]
        );

        $this->add_control(
            'padding', [
                'label' => __( 'Padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .payment_features_item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings();
        ?>
        <div class="payment_features_item text-<?php echo esc_attr($settings['text_align']) ?>">
            <?php echo wp_get_attachment_image($settings['image_icon']['id'], 'full' ) ?>
            <?php echo (!empty($settings['title'])) ? '<h4>'.$settings['title'].'</h4>' : ''; ?>
            <?php echo wpautop($settings['subtitle']) ?>
            <a <?php saasland_el_btn($settings['btn_url']) ?> class="learn_btn_two">
                <?php echo esc_html($settings['btn_title']) ?> <i class="ti-arrow-right"></i>
            </a>
        </div>
        <?php
    }
}