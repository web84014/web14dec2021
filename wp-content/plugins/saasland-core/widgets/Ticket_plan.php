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
 * Class Ticket_plan
 * @package SaaslandCore\Widgets
 */
class Ticket_plan extends Widget_Base {

    public function get_name() {
        return 'saasland_ticket_plan';
    }

    public function get_title() {
        return __( 'Ticket Price Plan', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-price-list';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    protected function _register_controls() {

        //************************************** Feature List ********************************//
        $this->start_controls_section(
            'feature_sec',
            [
                'label' => esc_html__( 'Ticket List', 'saasland-core' ),
            ]
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'saasland-core' ),
                'type' =>Controls_Manager::TEXT,
                'label_block' => true
            ]
        );

        $repeater->add_control(
            'subtitle',
            [
                'label' => esc_html__( 'Subtitle', 'saasland-core' ),
                'type' =>Controls_Manager::TEXTAREA,
            ]
        );

        $repeater->add_control(
            'icon_img',
            [
                'label' => esc_html__( 'Icon', 'saasland-core' ),
                'type' =>Controls_Manager::MEDIA,
            ]
        );

        $repeater->add_control(
            'icon_img_bg_color', [
                'label' => esc_html__( 'Icon Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'background: {{VALUE}};',
                ],
            ]
        );

        $repeater->add_control(
            'bottom_img',
            [
                'label' => esc_html__( 'Bottom Image', 'saasland-core' ),
                'type' =>Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'tickets',
            [
                'label' => esc_html__( 'Ticket Price list', 'saasland-core' ),
                'type' =>Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ title }}}'
            ]
        );

        $this->end_controls_section();

        //********************************** Shape Images ********************************//
        $this->start_controls_section(
            'shape_img_sec', [
                'label' => esc_html__( 'Shape Images', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'shape_img', [
                'label' => esc_html__( 'Shape Image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/home-pos/shape.png', __FILE__)
                ],
            ]
        );

        $this->add_control(
            'pattern_img', [
                'label' => esc_html__( 'Pattern Image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/home-pos/pattern_01.png', __FILE__)
                ],
            ]
        );

        $this->end_controls_section();


        /**
         * === Tab Style ===
         * Text Color
         * Background
         * Typography
         */
        // ***************************  Title Style ******************************//
        $this->start_controls_section(
            'color_title_sec', [
                'label' => esc_html__( 'Item Title', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'color_title', [
                'label' => esc_html__( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ticket_item h2' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .ticket_item h2',
            ]
        );

        $this->end_controls_section();

        // *************************** Section Serial Number Style ******************************//
        $this->start_controls_section(
            'subtitle_color_sec', [
                'label' => esc_html__( 'Item Subtitle', 'saasland-core' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'subtitle_color', [
                'label' => esc_html__( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ticket_item p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_subtitle',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .ticket_item p',
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings();
        $tickets = $settings['tickets'];
        ?>
        <section class="ticket_area">
                <div class="ticket_shap" style="background: url(<?php echo esc_url( $settings['shape_img']['url']) ?>);"></div>
            <?php if ( !empty( $settings['pattern_img']['url'] ) ) : ?>
                <div class="pattern" style="background: url(<?php echo esc_url( $settings['pattern_img']['url']) ?>);"></div>
            <?php endif; ?>
            <div class="container">
                <?php
                if (!empty( $tickets )) {
                    foreach ( $tickets as $ticket ) {
                        ?>
                        <div class="ticket_item">
                            <style>
                                .ticket_item:before {
                                    background: url(<?php echo esc_url($ticket['bottom_img']['url'])?>) no-repeat scroll center bottom/cover;
                                }
                            </style>
                            <div class="icon elementor-repeater-item-<?php echo $ticket['_id'] ?>">
                                <?php echo wp_get_attachment_image( $ticket['icon_img']['id'], 'full' ) ?>
                            </div>
                            <?php if (!empty( $ticket['title'] )) : ?>
                                <h2><?php echo wp_kses_post(nl2br( $ticket['title']) ) ?></h2>
                            <?php endif; ?>
                            <?php if (!empty( $ticket['subtitle'] )) : ?>
                                <?php echo wpautop( $ticket['subtitle'] ) ?>
                            <?php endif; ?>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </section>
        <?php
    }
}