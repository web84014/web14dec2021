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
class Curve_counter extends Widget_Base {

    public function get_name() {
        return 'saasland_curve_counter';
    }

    public function get_title() {
        return __( 'Curve counter', 'saasland-hero' );
    }

    public function get_icon() {
        return 'eicon-counter-circle';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    public function get_style_depends() {
        return [ 'curve-counter-event' ];
    }

    public function get_script_depends() {
        return [ 'waypoints', 'counterup' ];
    }

    protected function _register_controls() {


        //-------------------------------------------- Select Style ------------------------------------------------ //
        $this->start_controls_section(
            'section_style', [
                'label' => __( 'Section Style', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'style',
            [
                'label' => esc_html__( 'Style', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_01' => esc_html__( 'Style One ', 'saasland-core' ),
                    'style_02' => esc_html__( 'Style Two ', 'saasland-core' ),
                ],
                'default' => 'style_01'
            ]
        );

        $this->end_controls_section();

        // ------------------------------  Title  ------------------------------
        $this->start_controls_section(
            'title_sec', [
                'label' => __( 'Title', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'title', [
                'label' => esc_html__( 'Title Text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'Trusted'
            ]
        );

        $this->add_control(
            'color_title', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .seo_sec_title h2' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .seo_sec_title h2',
            ]
        );

        $this->end_controls_section(); // End title section


        // ------------------------------ Feature list ------------------------------
        $this->start_controls_section(
            'counters_sec', [
                'label' => __( 'Counter', 'saasland-core' ),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'label',
            [
                'label' => __( 'Count label', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Trusted Users'
            ]
        );

        $repeater->add_control(
            'count_value',
            [
                'label' => __( 'Count to', 'saasland-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '453'
            ]
        );

        $repeater->add_control(
            'color',
            [
                'label' => __( 'Color', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}}'
                ],
            ]
        );

        $this->add_control(
            'counters', [
                'label' => __( 'Counters', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'title_field' => '{{{ label }}}',
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'label' => 'Happy Clients',
                        'count_value' => '693',
                        'color' => '#00c99c'
                    ]
                ]
            ]
        );

        $this->end_controls_section(); // Facts


        //------------------------------ Style Section ------------------------------
        $this->start_controls_section(
            'style_section', [
                'label' => __( 'Style section', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'sec_padding', [
                'label' => __( 'Section padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .seo_fact_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .event_fact_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .seo_fact_area' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .event_fact_area' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'is_bg_objects',
            [
                'label' => __( 'Background Objects', 'saasland-core' ),
                'description' => __( 'Enable/Disable the background animated objects.', 'saasland-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Enable', 'saasland-core' ),
                'label_off' => __( 'Disable', 'saasland-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'style' => 'style_01'
                ]
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        wp_enqueue_style( 'simple-line-icons' );
        $settings = $this->get_settings();
        $counters = isset($settings['counters']) ? $settings['counters'] : '';

        if ( $settings['style'] == 'style_01' ) { ?>
            <section class="seo_fact_area sec_pad">
                <?php if ( $settings['is_bg_objects'] == 'yes' ) : ?>
                    <div class="home_bubble">
                        <div class="bubble b_one"></div>
                        <div class="bubble b_three"></div>
                        <div class="bubble b_four"></div>
                        <div class="bubble b_six"></div>
                        <div class="triangle b_eight" data-parallax='{"x": 120, "y": -10}'>
                            <img src="<?php echo plugins_url( 'images', __FILE__) ?>/seo/triangle_one.png" alt="">
                        </div>
                    </div>
                <?php endif; ?>
                <div class="container">
                    <div class="seo_sec_title text-center mb_70 wow fadeInUp" data-wow-delay="0.3s">
                        <?php if (!empty($settings['title'])) : ?>
                            <h2> <?php echo saasland_kses_post(nl2br($settings['title'])) ?> </h2>
                        <?php endif; ?>
                    </div>
                    <div class="seo_fact_info">
                        <?php
                        $i = 0;
                        $count_items = count($counters);
                        if (is_array($counters)) {
                            foreach ($counters as $counter) {
                                ?>
                                <div class="seo_fact_item <?php echo ($i == $count_items - 1) ? ' last' : ''; ?>">
                                    <div class="text">
                                        <div class="counter one elementor-repeater-item-<?php echo $counter['_id']; ?>"> <?php echo esc_html($counter['count_value']) ?> </div>
                                        <p> <?php echo saasland_kses_post(nl2br($counter['label'])) ?> </p>
                                    </div>
                                </div>
                                <?php ++$i; }} ?>
                    </div>
                </div>
            </section>
            <?php
        }
        elseif ( $settings['style'] == 'style_02' ) { ?>
            <section class="event_fact_area sec_pad">
                <div class="container">
                    <?php
                    if ( !empty( $settings['title'] ) ) {
                        echo '<div class="hosting_title security_title text-center"><h2>' . saasland_kses_post( $settings['title'] ) . '</h2></div>';
                    } ?>
                    <div class="seo_fact_info">
                        <?php
                        if ( !empty( $counters ) ) {
                            $i = 0;
                            foreach ( $counters as $index => $counter ) {
                                switch($index) {
                                    case 0:
                                        $align_class = 'one';
                                        break;
                                    case 1:
                                        $align_class = 'two';
                                        break;
                                    case 2:
                                        $align_class = 'three';
                                        break;
                                    case 3:
                                        $align_class = 'four';
                                        break;
                                    default:
                                        $align_class = 'one';
                                } ?>
                                <div class="seo_fact_item wow fadeIn" data-wow-delay="<?php echo esc_attr( $i ); ?>s">
                                    <style>
                                        .event_fact_area .seo_fact_info:before {
                                            background: url( <?php echo esc_url( plugins_url( '/images/dot.png', __FILE__ ) ) ?> )
                                            no-repeat center center;
                                        }
                                    </style>
                                    <div class="text">
                                        <?php
                                        if ( !empty( $counter['count_value'] ) ) {
                                            echo '<div class="counter '.esc_attr( $align_class ).' elementor-repeater-item-' . $counter['_id'] . '">' . esc_html( $counter['count_value'] ) . '</div>';
                                        }

                                        if ( !empty( $counter['label'] ) ) {
                                            echo '<p>' . esc_html( $counter['label'] ) . '</p>';
                                        } ?>
                                    </div>
                                </div>
                                <?php
                                $i = $i + 0.3;
                            }
                        } ?>
                    </div>
                </div>
            </section>
           <?php
        }
    }
}