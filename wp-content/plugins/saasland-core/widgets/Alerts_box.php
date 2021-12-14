<?php
namespace SaaslandCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor alert widget.
 *
 * Elementor widget that displays a collapsible display of content in an toggle
 * style, allowing the user to open multiple items.
 *
 * @since 1.0.0
 */
class Alerts_box extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve alert widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'saasland_alerts_box';
    }

    /**
     * Get widget title.
     *
     * Retrieve alert widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __( 'Saasland Alert', 'saasland-core' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve alert widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-alert';
    }

    /**
     * Get widget keywords.
     *
     * Retrieve the list of keywords the widget belongs to.
     *
     * @since 2.1.0
     * @access public
     *
     * @return array Widget keywords.
     */
    public function get_keywords() {
        return [ 'alert', 'notice', 'message' ];
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    /**
     * Register alert widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls() {


        $this->start_controls_section(
            'section_alert',
            [
                'label' => __( 'Alert', 'saasland-core' ),
            ]
        );

        // Icon 01
        $this->add_control(
            'box_size',
            [
                'label' => __( 'Alert Box Size', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'small_box' => esc_html__( 'Small Box', 'saasland-core' ),
                    'medium_box' => esc_html__( 'Medium Box', 'saasland-core' ),
                    'big_box' => esc_html__( 'Big Box', 'saasland-core' ),
                ],
                'default' => 'small_box',
            ]
        );

        $this->add_control(
            'alert_type',
            [
                'label' => __( 'Type', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'info',
                'options' => [
                    'notice' => __( 'Notice', 'saasland-core' ),
                    'error' => __( 'Error', 'saasland-core' ),
                    'warning' => __( 'Warning', 'saasland-core' ),
                    'info' => __( 'Info', 'saasland-core' ),
                    'success' => __( 'Success', 'saasland-core' ),
                    'message' => __( 'Message', 'saasland-core' ),
                    'danger' => __( 'Danger', 'saasland-core' ),
                ],
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'alert_title',
            [
                'label' => __( 'Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Notice Message! Your message here'
            ]
        );

        $this->add_control(
            'alert_description',
            [
                'label' => __( 'Description', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'condition' => [
                    'box_size' =>  'big_box'
                ]
            ]
        );

        $this->add_control(
            'show_dismiss',
            [
                'label' => __( 'Dismiss Button', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'show',
                'options' => [
                    'show' => __( 'Show', 'saasland-core' ),
                    'hide' => __( 'Hide', 'saasland-core' ),
                ],
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_icon',
            [
                'label' => __( 'Icon', 'saasland-core' ),
            ]
        );

        // Icon 01
        $this->add_control(
            'icon_type',
            [
                'label' => __( 'Icon Type 01', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'fontawesome' => esc_html__( 'Font-Awesome', 'saasland-core' ),
                    'eicon' => esc_html__( 'Elegant Icon', 'saasland-core' ),
                    'ticon' => esc_html__( 'Themify Icon', 'saasland-core' ),
                    'slicon' => esc_html__( 'Simple Line Icon', 'saasland-core' ),
                    'flaticon' => esc_html__( 'Flaticon', 'saasland-core' ),
                ],
                'default' => 'slicon',
            ]
        );

        $this->add_control(
            'fontawesome',
            [
                'label' => __( 'Font-Awesome', 'saasland-core' ),
                'type' => Controls_Manager::ICON,
                'condition' => [
                    'icon_type' => 'fontawesome'
                ]
            ]
        );

        $this->add_control(
            'eicon',
            [
                'label' => __( 'Elegant Icon', 'saasland-core' ),
                'type' => Controls_Manager::ICON,
                'options' => saasland_elegant_icons(),
                'include' => saasland_include_elegant_icons(),
                'default' => 'arrow_right',
                'condition' => [
                    'icon_type' => 'eicon'
                ]
            ]
        );

        $this->add_control(
            'ticon',
            [
                'label' => __( 'Themify Icon', 'saasland-core' ),
                'type' => Controls_Manager::ICON,
                'options' => saasland_themify_icons(),
                'include' => saasland_include_themify_icons(),
                'default' => 'ti-panel',
                'condition' => [
                    'icon_type' => 'ticon'
                ]
            ]
        );

        $this->add_control(
            'slicon',
            [
                'label'     => __( 'Simple Line Icon', 'saasland-core' ),
                'type'      => Controls_Manager::ICON,
                'options'   => saasland_simple_line_icons(),
                'include'   => saasland_include_simple_line_icons(),
                'default'   => 'icon-volume-2',
                'condition' => [
                    'icon_type' => 'slicon'
                ]
            ]
        );

        $this->add_control(
            'flaticon',
            [
                'label'      => __( 'Flaticon', 'saasland-core' ),
                'type'       => Controls_Manager::ICON,
                'options'    => saasland_flaticons(),
                'include'    => saasland_include_flaticons(),
                'default'    => 'flaticon-mortarboard',
                'condition'  => [
                    'icon_type' => 'flaticon'
                ]
            ]
        );

        // Icon 02
        $this->add_control(
            'icon2_divider',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        $this->add_control(
            'icon2_type',
            [
                'label' => __( 'Icon Type 02', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'fontawesome2' => esc_html__( 'Font-Awesome', 'saasland-core' ),
                    'eicon2' => esc_html__( 'Elegant Icon', 'saasland-core' ),
                    'ticon2' => esc_html__( 'Themify Icon', 'saasland-core' ),
                    'slicon2' => esc_html__( 'Simple Line Icon', 'saasland-core' ),
                    'flaticon2' => esc_html__( 'Flaticon', 'saasland-core' ),
                ],
                'default' => 'eicon2',
            ]
        );

        $this->add_control(
            'fontawesome2',
            [
                'label' => __( 'Font-Awesome', 'saasland-core' ),
                'type' => Controls_Manager::ICON,
                'condition' => [
                    'icon2_type' => 'fontawesome2'
                ]
            ]
        );

        $this->add_control(
            'eicon2',
            [
                'label' => __( 'Elegant Icon', 'saasland-core' ),
                'type' => Controls_Manager::ICON,
                'options' => saasland_elegant_icons(),
                'include' => saasland_include_elegant_icons(),
                'default' => 'icon_close',
                'condition' => [
                    'icon2_type' => 'eicon2'
                ]
            ]
        );

        $this->add_control(
            'ticon2',
            [
                'label' => __( 'Themify Icon', 'saasland-core' ),
                'type' => Controls_Manager::ICON,
                'options' => saasland_themify_icons(),
                'include' => saasland_include_themify_icons(),
                'default' => 'ti-panel',
                'condition' => [
                    'icon2_type' => 'ticon2'
                ]
            ]
        );

        $this->add_control(
            'slicon2',
            [
                'label'     => __( 'Simple Line Icon', 'saasland-core' ),
                'type'      => Controls_Manager::ICON,
                'options'   => saasland_simple_line_icons(),
                'include'   => saasland_include_simple_line_icons(),
                'default'   => 'icon-cloud-upload',
                'condition' => [
                    'icon2_type' => 'slicon2'
                ]
            ]
        );

        $this->add_control(
            'flaticon2',
            [
                'label'      => __( 'Flaticon', 'saasland-core' ),
                'type'       => Controls_Manager::ICON,
                'options'    => saasland_flaticons(),
                'include'    => saasland_include_flaticons(),
                'default'    => 'flaticon-mortarboard',
                'condition'  => [
                    'icon2_type' => 'flaticon2'
                ]
            ]
        );


        $this->end_controls_section();

        /**
         * Tab: Style
         */
        $this->start_controls_section(
            'section_type',
            [
                'label' => __( 'Alert', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .alert' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .alert.big_alert' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .box_alert' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'background',
            [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .alert' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .alert.big_alert' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .box_alert' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'border_color',
            [
                'label' => __( 'Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .alert' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .alert.big_alert' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .box_alert' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'border_left-width',
            [
                'label' => __( 'Left Border Width', 'saasland-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .alert' => 'border-left-width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .alert.big_alert' => 'border-left-width: {{{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .box_alert' => 'border-left-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Render alert widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings();

        switch ( $settings['icon_type'] ) {
            case 'fontawesome':
                $icon = !empty($settings['fontawesome']) ? $settings['fontawesome'] : '';
                break;
            case 'eicon':
                $icon = !empty($settings['eicon']) ? $settings['eicon'] : '';
                break;
            case 'ticon':
                $icon = !empty($settings['ticon']) ? $settings['ticon'] : '';
                break;
            case 'slicon':
                wp_enqueue_style( 'simple-line-icon' );
                $icon = !empty($settings['slicon']) ? $settings['slicon'] : '';
                break;
            case 'flaticon':
                $icon = !empty($settings['flaticon']) ? $settings['flaticon'] : '';
                break;
        }
        $icon_class = (!empty($icon)) ? "class='$icon'" : '';


        switch ($settings['icon2_type']) {
            case 'fontawesome2':
                $icon2 = !empty($settings['fontawesome2']) ? $settings['fontawesome2'] : '';
                break;
            case 'eicon2':
                $icon2 = !empty($settings['eicon2']) ? $settings['eicon2'] : '';
                break;
            case 'ticon2':
                $icon2 = !empty($settings['ticon2']) ? $settings['ticon2'] : '';
                break;
            case 'slicon2':
                wp_enqueue_style( 'simple-line-icon' );
                $icon2 = !empty($settings['slicon2']) ? $settings['slicon2'] : '';
                break;
            case 'flaticon2':
                $icon2 = !empty($settings['flaticon2']) ? $settings['flaticon2'] : '';
                break;
        }
        $icon2_class = (!empty($icon2)) ? "class='$icon2'" : '';
        ?>


                <?php
                if ( $settings['box_size'] == 'small_box' ) {
                    ?>
                    <div class="alert <?php echo esc_attr($settings['alert_type']) ?>">
                        <div class="alert_body">
                            <i <?php echo $icon_class; ?>></i>
                            <?php if (!empty($settings['alert_title'])) : ?>
                                <?php echo esc_html($settings['alert_title']) ?>
                            <?php endif; ?>
                        </div>
                        <?php if ( 'show' === $settings['show_dismiss'] ) : ?>
                            <div class="alert_close">
                                <i <?php echo $icon2_class; ?>></i>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php
                }
                elseif ( $settings['box_size'] == 'medium_box' ) {
                    ?>
                    <div class="alert <?php echo esc_attr($settings['alert_type']) ?> big_alert">
                        <div class="alert_body">
                            <i <?php echo $icon_class; ?>></i>
                            <?php if (!empty($settings['alert_title'])) : ?>
                                <?php echo esc_html($settings['alert_title']) ?>
                            <?php endif; ?>
                        </div>
                        <?php if ( 'show' === $settings['show_dismiss'] ) : ?>
                            <div class="alert_close">
                                <i <?php echo $icon2_class; ?>></i>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php
                }
                elseif ( $settings['box_size'] == 'big_box' ) {
                    ?>
                    <div class="box_alert media box_<?php echo esc_attr($settings['alert_type']) ?>">
                        <?php if ( 'show' === $settings['show_dismiss']) : ?>
                            <div class="alert_close">
                                <i <?php echo $icon2_class; ?>></i>
                            </div>
                        <?php endif; ?>
                        <div class="icon">
                            <i <?php echo $icon_class; ?>></i>
                        </div>
                        <div class="media-body">
                            <?php if (!empty($settings['alert_title'])) : ?>
                                <h5><?php echo esc_html($settings['alert_title']) ?></h5>
                            <?php endif; ?>
                            <?php if (!empty($settings['alert_description'])) : ?>
                                <?php echo wpautop($settings['alert_description']) ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <script>
                        ;(function($){
                            "use strict";
                            $(document).ready(function () {
                                $( '.alert_close' ).on( 'click', function(e){
                                    $(this).parent().hide();
                                });
                            })
                        })(jQuery)

                    </script>
                    <?php
                }
                ?>
        <?php

    }
}
