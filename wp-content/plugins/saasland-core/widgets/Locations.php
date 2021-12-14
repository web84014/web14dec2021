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
 * Locations
 */
class Locations extends Widget_Base {
    public function get_name() {
        return 'saasland_map3';
    }

    public function get_title() {
        return __( 'Locations', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-google-maps';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    protected function _register_controls() {

        // ------------------------------  Title Section ------------------------------ //
        $this->start_controls_section(
            'title_sec', [
                'label' => __( 'Title', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'title', [
                'label' => esc_html__( 'Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Service your customers around <br> the world from 15 regions.'
            ]
        );

        $this->add_control(
            'color_title', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hosting_title h2' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
                    {{WRAPPER}} .hosting_title h2',
            ]
        );


        $this->end_controls_section(); // End Title

        // ------------------------------  Subtitle Section ------------------------------ //
        $this->start_controls_section(
            'subtitle_sec', [
                'label' => esc_html__( 'Subtitle', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'subtitle', [
                'label' => esc_html__( 'Subtitle', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );

        $this->add_control(
            'color_subtitle', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hosting_title p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_subtitle',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
                    {{WRAPPER}} .hosting_title p',
            ]
        );

        $this->end_controls_section(); // End Subtitle Section

        // ------------------------------  Map Section ------------------------------ //
        $this->start_controls_section(
            'map_sec', [
                'label' => esc_html__( 'Locations', 'saasland-core' ),
            ]
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'place_name', [
                'label' => esc_html__( 'Place Name', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Dhaka, Bangladesh'
            ]
        );

        $repeater->add_control(
            'horizontal',
            [
                'label' => __( 'Horizontal Position', 'saasland-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => -500,
                        'max' => 1200,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'left: {{SIZE}}{{UNIT}}; right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $repeater->add_control(
            'vertical',
            [
                'label' => __( 'Vertical Position', 'saasland-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => -500,
                        'max' => 1200,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'top: {{SIZE}}{{UNIT}}; bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $repeater->end_controls_tab();

        $this->add_control(
            'locations', [
                'label' => esc_html__( 'Location', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'title_field' => '{{{ place_name }}}',
                'fields' => $repeater->get_controls(),
            ]
        );

        $this->end_controls_section(); // End Map Section


        /**
         * Style Tab
         * ------------------------------ Style Title ------------------------------
         *
         */
        $this->start_controls_section(
            'bg_style_sec',
            [
                'label' => __( 'Background Style', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'bg_img', [
                'label' => esc_html__( 'Background Image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( '/images/region_map.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .h_map_area' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'map_style_sec',
            [
                'label' => __( 'Map Style', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'text_color', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .h_map ul li .place_name' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'text_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .h_map ul li .place_name' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'border_color', [
                'label' => __( 'Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .h_map ul li .place_name:before' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'round_color', [
                'label' => __( 'Round Color 01', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .h_map ul li .round' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'round_color2', [
                'label' => __( 'Round Color 02', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .h_map ul li .round:before, .h_map ul li .round:after' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'wave_color', [
                'label' => __( 'Wave Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .h_map ul li .round .dot' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        //-------------------------- Box Shadow -----------------------------------//
        $this->start_controls_section(
            'box_shadow_sec',
            [
                'label' => __( 'Box Shadow', 'saasland-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'label' => __( 'Box Shadow', 'saasland-core' ),
                'selector' => '{{WRAPPER}} .h_map ul li .place_name',
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings();
        $locations = $settings['locations'];
        ?>
        <section class="h_map_area">
            <div class="container">
                <div class="hosting_title text-center">
                    <?php if (!empty($settings['title'])) : ?>
                        <h2><?php echo wp_kses_post(nl2br($settings['title'])) ?></h2>
                    <?php endif; ?>
                    <?php if (!empty($settings['subtitle'])) : ?>
                        <?php echo wpautop($settings['subtitle']) ?>
                    <?php endif; ?>
                </div>
                <div class="h_map" style="background: url(<?php echo esc_url($settings['bg_img']['url']) ?>) no-repeat scroll center top;">
                    <ul class="list-unstyled">
                        <?php
                        if ( !empty( $locations ) ) {
                            $delay = 0.1;
                            $delay2 = 0.2;
                            foreach ( $locations as $location ) {
                                ?>
                                <?php if (!empty($location['place_name'])) : ?>
                                    <li class="wow fadeIn elementor-repeater-item-<?php echo $location['_id'] ?>" data-wow-delay="<?php echo esc_attr( $delay) ?>s">
                                        <div class="place_name wow fadeInUp" data-wow-delay="<?php echo esc_attr( $delay2) ?>s">
                                            <?php echo esc_html($location['place_name']) ?>
                                        </div>
                                        <div class="round"><div class="dot"></div></div>
                                    </li>
                                <?php endif; ?>
                                <?php
                                $delay = $delay + 0.2;
                                $delay2 = $delay2 + 0.2;
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </section>
        <?php
    }

}