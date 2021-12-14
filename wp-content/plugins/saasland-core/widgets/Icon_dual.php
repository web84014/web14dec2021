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
 * Elementor icon widget.
 *
 * Elementor widget that displays an icon from over 600+ icons.
 *
 * @since 1.0.0
 */
class Icon_dual extends Widget_Base {


    public function get_name() {
        return 'saasland_icon_dual';
    }

    public function get_title() {
        return __( 'Dual Icon', 'saasland-core' );
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

    protected function _register_controls() {
        $this->start_controls_section(
            'section_icon',
            [
                'label' => __( 'Icon', 'saasland-core' ),
            ]
        );

        // Icon Type
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
                'default' => 'fontawesome',
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
                'default' => 'fontawesome',
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
                'default' => 'arrow_right',
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

        // ---------------------------------------- Icon 01
        $this->start_controls_section(
            'section_style_icon',
            [
                'label' => __( 'Icon 01', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'size1',
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
                    '{{WRAPPER}} .icon_two .small' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon1_color',
            [
                'label' => __( 'Icon 01 Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .icon_two .small' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->end_controls_section();


        // ---------------------------------------- Icon 01
        $this->start_controls_section(
            'section_style_icon2',
            [
                'label' => __( 'Icon 02', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'size2',
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
                    '{{WRAPPER}} .icon_two i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon2_color',
            [
                'label' => __( 'Icon 02 Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .icon_two i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();


        // ---------------------------------------- Box
        $this->start_controls_section(
            'section_style_icon_box',
            [
                'label' => __( 'Icon Box', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'bg_color',
            [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .icon_two' => 'background-color: {{VALUE}};',
                ],
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

        $this->add_render_attribute( 'wrapper', 'class', 'elementor-icon-wrapper get_icon icon_two' );

        $this->add_render_attribute( 'icon-wrapper', 'class', 'elementor-icon' );

        if ( ! empty( $settings['hover_animation'] ) ) {
            $this->add_render_attribute( 'icon-wrapper', 'class', 'elementor-animation-' . $settings['hover_animation'] );
        }

        switch ($settings['icon_type']) {
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
        $icon_class = (!empty($icon)) ? "class='small $icon'" : '';

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
        $icon2_class = !empty($icon2) ? "class='$icon2'" : '';
        ?>

        <div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
            <?php if (!empty($icon_class)) : ?>
                <i aria-hidden="true" <?php echo $icon_class; ?>></i>
            <?php endif; ?>
            <?php if (!empty($icon2_class)) : ?>
                <i <?php echo $icon2_class; ?>></i>
            <?php endif; ?>
        </div>
        <?php
    }
}
