<?php
namespace SaaslandCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor icon widget.
 *
 * Elementor widget that displays an icon from over 600+ icons.
 *
 * @since 1.0.0
 */
class Icons extends Widget_Base {


    public function get_name() {
        return 'saasland_icons';
    }

    public function get_title() {
        return __( 'Saasland Icon', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-favorite';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    public function get_keywords() {
        return [ 'icon' ];
    }

    public function get_style_depends()
    {
        return ['simple-line-icon'];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'section_icon',
            [
                'label' => __( 'Icon', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'icon_type',
            [
                'label' => __( 'Icon Type', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'eicon' => esc_html__( 'Elegant Icon', 'saasland-core' ),
                    'ticon' => esc_html__( 'Themify Icon', 'saasland-core' ),
                    'slicon' => esc_html__( 'Simple Line Icon', 'saasland-core' ),
                    'flaticon' => esc_html__( 'Flaticon', 'saasland-core' ),
                ],
                'default' => 'eicon',
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
                'default'   => 'icon-cloud-upload',
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

        $this->add_control(
            'view',
            [
                'label' => __( 'View', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'default' => __( 'Default', 'saasland-core' ),
                    'stacked' => __( 'Stacked', 'saasland-core' ),
                    'framed' => __( 'Framed', 'saasland-core' ),
                ],
                'default' => 'default',
                'prefix_class' => 'elementor-view-',
            ]
        );

        $this->add_control(
            'shape',
            [
                'label' => __( 'Shape', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'circle' => __( 'Circle', 'saasland-core' ),
                    'square' => __( 'Square', 'saasland-core' ),
                ],
                'default' => 'circle',
                'condition' => [
                    'view!' => 'default',
                ],
                'prefix_class' => 'elementor-shape-',
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => __( 'Link', 'saasland-core' ),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => __( 'https://your-link.com', 'saasland-core' ),
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => __( 'Alignment', 'saasland-core' ),
                'type' => Controls_Manager::CHOOSE,
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
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon-wrapper' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_icon',
            [
                'label' => __( 'Icon', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( 'icon_colors' );

        $this->start_controls_tab(
            'icon_colors_normal',
            [
                'label' => __( 'Normal', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'primary_color',
            [
                'label' => __( 'Primary Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}}.elementor-view-stacked .elementor-icon' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}}.elementor-view-framed .elementor-icon, {{WRAPPER}}.elementor-view-default .elementor-icon' => 'color: {{VALUE}}; border-color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
            ]
        );

        $this->add_control(
            'secondary_color',
            [
                'label' => __( 'Secondary Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'condition' => [
                    'view!' => 'default',
                ],
                'selectors' => [
                    '{{WRAPPER}}.elementor-view-framed .elementor-icon' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}}.elementor-view-stacked .elementor-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'icon_colors_hover',
            [
                'label' => __( 'Hover', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'hover_primary_color',
            [
                'label' => __( 'Primary Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}}.elementor-view-stacked .elementor-icon:hover' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}}.elementor-view-framed .elementor-icon:hover, {{WRAPPER}}.elementor-view-default .elementor-icon:hover' => 'color: {{VALUE}}; border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hover_secondary_color',
            [
                'label' => __( 'Secondary Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'condition' => [
                    'view!' => 'default',
                ],
                'selectors' => [
                    '{{WRAPPER}}.elementor-view-framed .elementor-icon:hover' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}}.elementor-view-stacked .elementor-icon:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'size',
            [
                'label' => __( 'Size', 'saasland-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 6,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon_padding',
            [
                'label' => __( 'Padding', 'saasland-core' ),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon' => 'padding: {{SIZE}}{{UNIT}};',
                ],
                'range' => [
                    'em' => [
                        'min' => 0,
                        'max' => 5,
                    ],
                ],
                'condition' => [
                    'view!' => 'default',
                ],
            ]
        );

        $this->add_control(
            'rotate',
            [
                'label' => __( 'Rotate', 'saasland-core' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0,
                    'unit' => 'deg',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon i' => 'transform: rotate({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->add_control(
            'border_width',
            [
                'label' => __( 'Border Width', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'view' => 'framed',
                ],
            ]
        );

        $this->add_control(
            'border_radius',
            [
                'label' => __( 'Border Radius', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'view!' => 'default',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'icon_box_shadow',
                'label' => __( 'Box Shadow', 'saasland-core' ),
                'selector' => '{{WRAPPER}} .elementor-icon-wrapper .elementor-icon',
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render icon widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute( 'wrapper', 'class', 'elementor-icon-wrapper' );

        $this->add_render_attribute( 'icon-wrapper', 'class', 'elementor-icon' );

        if ( ! empty( $settings['hover_animation'] ) ) {
            $this->add_render_attribute( 'icon-wrapper', 'class', 'elementor-animation-' . $settings['hover_animation'] );
        }

        $icon_tag = 'div';

        if ( ! empty( $settings['link']['url'] ) ) {
            $this->add_render_attribute( 'icon-wrapper', 'href', $settings['link']['url'] );
            $icon_tag = 'a';

            if ( ! empty( $settings['link']['is_external'] ) ) {
                $this->add_render_attribute( 'icon-wrapper', 'target', '_blank' );
            }

            if ( $settings['link']['nofollow'] ) {
                $this->add_render_attribute( 'icon-wrapper', 'rel', 'nofollow' );
            }
        }

        switch ($settings['icon_type']) {
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

        ?>
        <div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
            <<?php echo $icon_tag . ' ' . $this->get_render_attribute_string( 'icon-wrapper' ); ?>>
            <i aria-hidden="true" <?php echo $icon_class; ?>></i>
            </<?php echo $icon_tag; ?>>
        </div>
        <?php
    }
}
