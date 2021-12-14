<?php
namespace SaaslandCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Border;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class Solar_Integration
 * @package SaaslandCore\Widgets
 */
class Solar_Integration extends Widget_Base {

    public function get_name() {
        return 'saasland_solar-system';
    }

    public function get_title() {
        return __( 'Integrations <br> Solar System', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-share';
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
                'description' => esc_html__( 'Use <br> tag for line braking.', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Software Integrations'
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
                    '{{WRAPPER}} .t_color' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .t_color',
            ]
        );

        $this->end_controls_section(); // End title section



        // ------------------------------  Subtitle ------------------------------
        $this->start_controls_section(
            'subtitle_sec', [
                'label' => __( 'Subtitle', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'subtitle', [
                'label' => esc_html__( 'Subtitle text', 'saasland-core' ),
                'description' => esc_html__( 'Use <br> tag for line breaking.', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'color_subtitle', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sec_title p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_subtitle',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .sec_title p',
            ]
        );

        $this->end_controls_section(); // End title section


        // ------------------------ Central Logo ------------------------------
        $this->start_controls_section(
            'sun_sec', [
                'label' => __( 'The Central Logo', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'center_logo', [
                'label' => esc_html__( 'Logo Image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/saasland_logo.png', __FILE__)
                ],
            ]
        );

        $this->add_control(
            'center_logo_url', [
                'label' => esc_html__( 'URL', 'saasland-core' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => home_url()
                ],
            ]
        );

        $this->end_controls_section(); // End title section


        // ------------------------------  Contents ------------------------------
        $this->start_controls_section(
            'content_sec', [
                'label' => __( 'Contents', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'planets', [
                'label' => __( 'Integration Items', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'title_field' => '{{{ title }}}',
                'fields' => [
                    [
                        'name' => 'title',
                        'label' => __( 'Title', 'saasland-core' ),
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default' => 'Default Text'
                    ],
                    [
                        'name' => 'logo',
                        'label' => __( 'Logo', 'saasland-core' ),
                        'type' => Controls_Manager::MEDIA,
                    ],
                    [
                        'name' => 'dimension',
                        'label' => __( 'Dimension', 'saasland-core' ),
                        'type' => Controls_Manager::IMAGE_DIMENSIONS,
                    ],
                    [
                        'name' => 'position',
                        'label' => __( 'Position', 'saasland-core' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'default' => [
                            'isLinked' => false
                        ]
                    ],
                    [
                        'name'      => 'bg_color',
                        'label'     => esc_html__( 'Background Color', 'saasland-core' ),
                        'type'      => Controls_Manager::COLOR,
                    ],
                ],
            ]
        );

        $this->end_controls_section();


        //------------------------------ Style Section ------------------------------
        $this->start_controls_section(
            'style_section', [
                'label' => __( 'Style section', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'sec_padding', [
                'label' => __( 'Section padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .software_promo_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [

                ],
            ]
        );

        $this->add_control(
            'bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .software_promo_area' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'is_animation',
            [
                'label' => __( 'Animation', 'saasland-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'saasland-core' ),
                'label_off' => __( 'No', 'saasland-core' ),
                'return_value' => 'yes',
                'default' => ''
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();
        $planets = isset($settings['planets']) ? $settings['planets'] : '';
        $title_tag = !empty($settings['title_html_tag']) ? $settings['title_html_tag'] : 'h2';
        ?>
        <!--============ Car Testimonial Area ==============-->
        <section class="software_promo_area sec_pad">
            <div class="container">
                <div class="sec_title text-center wow fadeInUp" data-wow-delay="0.3s">
                    <?php if (!empty($settings['title'])) : ?>
                        <<?php echo $title_tag; ?> class="f_p f_size_30 l_height50 f_600 t_color"><?php echo wp_kses_post($settings['title']); ?> </<?php echo $title_tag; ?>>
                    <?php endif; ?>
                    <?php if (!empty($settings['subtitle'])) : ?>
                        <p class="f_300 f_size_18 l_height34"> <?php echo wp_kses_post($settings['subtitle']) ?> </p>
                    <?php endif; ?>
                </div>
                <div class="round_shape mt_30">
                    <div class="symbols-pulse active">
                        <div class="pulse-1"></div>
                        <div class="pulse-2"></div>
                        <div class="pulse-3"></div>
                        <div class="pulse-4"></div>
                        <div class="pulse-x"></div>
                    </div>
                    <div class="r_shape r_shape_five">
                        <span class="text">
                            <a href="<?php echo esc_url($settings['center_logo_url']['url']) ?>" <?php saasland_is_external($settings['center_logo_url']) ?>>
                                <?php
                                if (!empty($settings['center_logo']['url'])) {
                                    ?> <img src="<?php echo esc_url($settings['center_logo']['url']) ?>" alt="<?php echo esc_attr($settings['title']) ?>">
                                    <?php
                                }
                                ?>
                            </a>
                        </span>
                    </div>
                    <div class="s_promo_info">
                        <?php
                        if (!empty($planets)) {
                        foreach ($planets as $i => $planet) {
                            $width = !empty($planet['dimension']['width']) ? "width: {$planet['dimension']['width']}px; " : '';
                            $height = !empty($planet['dimension']['height']) ? "height: {$planet['dimension']['height']}px; " : '';
                            $top = !empty($planet['position']['top']) ? "top: {$planet['position']['top']}px; " : '';
                            $right = !empty($planet['position']['right']) ? "right: {$planet['position']['right']}px; " : '';
                            $bottom = !empty($planet['position']['bottom']) ? "bottom: {$planet['position']['bottom']}px; " : '';
                            $left = !empty($planet['position']['left']) ? "left:{$planet['position']['left']}px; " : '';
                            $index = 'item_one';
                            switch ($i) {
                                case 0:
                                    $index = 'item_one';
                                    break;
                                case 1:
                                    $index = 'item_two';
                                    break;
                                case 2:
                                    $index = 'item_three';
                                    break;
                                case 3:
                                    $index = 'item_four';
                                    break;
                                case 4:
                                    $index = 'item_five';
                                    break;
                                case 5:
                                    $index = 'item_six';
                                    break;
                                case 6:
                                    $index = 'item_seven';
                                    break;
                                case 7:
                                    $index = 'item_eight';
                                    break;
                                case 8:
                                    $index = 'item_nine';
                                    break;
                            }
                            ?>
                            <div class="promo_item <?php echo esc_attr($index) ?> scroll_animation" style="<?php echo $width.$height.$top.$right.$bottom.$left; ?>">
                                <div class="text">
                                    <?php echo wp_get_attachment_image($planet['logo']['id'], 'full' ) ?>
                                    <?php echo !empty($planet['title']) ? '<p>'.$planet['title'].'</p>' : ''; ?>
                                </div>
                            </div>
                            <?php
                        }}
                        ?>
                    </div>
                </div>
            </div>
        </section>

        <?php
        if ( $settings['is_animation'] == 'yes' ) : ?>
            <script>
                ;(function($){
                    "use strict";
                    $(document).ready(function () {
                        var $animation_elements = $( '.scroll_animation' );
                        var $window = $(window);

                        function check_if_in_view() {
                            var window_height = $window.height();
                            var window_top_position = $window.scrollTop();
                            var window_bottom_position = (window_top_position + window_height);

                            $.each($animation_elements, function() {
                                var $element = $(this);
                                var element_height = $element.outerHeight();
                                var element_top_position = $element.offset().top;
                                var element_bottom_position = (element_top_position + element_height);

                                //check to see if this current container is within viewport
                                if ((element_bottom_position >= window_top_position) &&
                                    (element_top_position <= window_bottom_position)) {
                                    $element.addClass( 'in-view' );
                                } else {
                                    $element.removeClass( 'in-view' );
                                }
                            });
                        }

                        if ($(window).width() > 576){
                            $window.on( 'scroll resize', check_if_in_view);
                            $window.trigger( 'scroll' );
                        }

                    });
                })(jQuery)
            </script>
            <?php
        endif;
    }
}