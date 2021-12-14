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
 * Circle Counter
 */
class Circle_counter extends Widget_Base {

    public function get_name() {
        return 'saasland_circle_counter';
    }

    public function get_title() {
        return __( 'Circle Counter', 'saasland-hero' );
    }

    public function get_icon() {
        return ' eicon-counter-circle';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    public function get_script_depends() {
        return [ 'waypoints', 'appear', 'counterup', 'circle-progress' ];
    }

    protected function _register_controls() {


        // ------------------------------ Feature list ------------------------------
        $this->start_controls_section(
            'counters_sec', [
                'label' => __( 'Counter', 'saasland-core' ),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->start_controls_tabs(
			'circle_settings_tabs'
		);

		$repeater->start_controls_tab(
			'circle_content_tab',
			[
				'label' => __( 'Content', 'plugin-name' ),
			]
		);
        $repeater->add_control(
            'title',
            [
                'label' => __( 'Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Innovations'
            ]
        );
        $repeater->add_control(
            'subtitle',
            [
                'label' => __( 'Subtitle', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'count_to',
            [
                'label' => __( 'Count to %', 'saasland-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 72,
                ],
            ]
        );

		$repeater->end_controls_tab();
		$repeater->start_controls_tab(
			'circle_style_tab',
			[
				'label' => __( 'Style', 'plugin-name' ),
			]
		);
        $repeater->add_control(
            'circle_title_color',
            [
                'label' => __( 'Title Color', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => ['{{WRAPPER}} {{CURRENT_ITEM}} h4' => 'color: {{VALUE}};'],
            ]
        );
        $repeater->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'circle_title_typography',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} h4',
            ]
        );
        $repeater->add_control(
            'circle_subtitle_color',
            [
                'label' => __( 'Sub-title Color', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => ['{{WRAPPER}} {{CURRENT_ITEM}} p' => 'color: {{VALUE}};'],
                'separator' => 'before'
            ]
        );
        $repeater->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'circle_subtitle_typography',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} p',
            ]
        );
        $repeater->add_control(
            'color',
            [
                'label' => __( 'Circle Color', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#aa6ffa',
                'separator' => 'before'
            ]
        );
		$repeater->end_controls_tab();
		$repeater->end_controls_tabs();

        $this->add_control(
            'counters', [
                'label' => __( 'Counters', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'title_field' => '{{{ title }}}',
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'title' => 'Happy Clients',
                        'subtitle' => 'Charles Jeffrey up the kyver loo in my flat blimey.!',
                        'count_to' => [ 'unit' => '%', 'size' => 92 ],
                        'color' => '#00c99c'
                    ],
                ]
            ]
        );

        $this->end_controls_section(); // Facts

        // Circle section style ------------------------------------
        $this->start_controls_section(
            'circle_sec_style', [
                'label' => __( 'Section Settings', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'circle_sec_margin', [
                'label' => esc_html__( 'Margin', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .progress_bar_area' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',

                ],
            ]
        );
        $this->add_responsive_control(
            'circle_sec_padding', [
                'label' => esc_html__( 'Padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .progress_bar_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',

                ],
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'circle_sec_bg',
				'label' => __( 'Background', 'saasland-core' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .progress_bar_area',
			]
		);

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings();
        $counters = isset($settings['counters']) ? $settings['counters'] : '';
        ?>
        <section class="progress_bar_area">
            <div class="container">
                <div class="row">
                <?php
                $i = 0;
                $count_items = count($counters);
                if (is_array($counters)) {
                    foreach ($counters as $counter) { ?>
                        <div class="col-lg-3 col-md-4 progress_item <?php echo "elementor-repeater-item-{$counter['_id']}"; ?>">
                            <div class="circle" data-value="0.<?php echo esc_attr($counter['count_to']['size']) ?>" data-fill="{&quot;color&quot;: &quot;<?php echo $counter['color'] ?>&quot;}" data-trackcolor="">
                                <div class="number"><span class="counter"> <?php echo esc_html($counter['count_to']['size']) ?> </span>%</div>
                            </div>
                            <?php if (!empty($counter['title'])) : ?>
                                <h4> <?php echo saasland_kses_post(nl2br($counter['title'])) ?> </h4>
                            <?php endif; ?>
                            <?php if (!empty($counter['subtitle'])) : ?>
                                <?php echo saasland_kses_post(wpautop($counter['subtitle'])) ?>
                            <?php endif; ?>
                        </div>
                <?php ++$i; }} ?>
                </div>
            </div>
        </section>

        <script>
            ;(function($){
                "use strict";
                $(document).ready(function () {
                    $(".circle").each(function() {
                        $(".circle").appear(function() {
                            $( '.circle' ).circleProgress({
                                startAngle:-14.1,
                                size: 200,
                                duration: 9000,
                                easing: "circleProgressEase",
                                emptyFill: '#f1f1fa ',
                                lineCap: 'round',
                                thickness:10,
                            })
                        }, {
                            triggerOnce: true,
                            offset: 'bottom-in-view'
                        })
                    })
                });
            })(jQuery)
        </script>
        <?php
    }

}