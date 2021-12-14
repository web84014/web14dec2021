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
class Button_icons extends Widget_Base {


    public function get_name() {
        return 'saasland_button_icons';
    }

    public function get_title() {
        return __( 'Text Button with Icon', 'saasland-core' );
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
            'btn_label',
            [
                'label' => esc_html__( 'Button Label', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Learn More'
            ]
        );

        // Icon Type
        $this->add_control(
            'icon_type',
            [
                'label' => __( 'Icon Type', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'fontawesome' => esc_html__( ' Font-Awesome', 'saasland-core' ),
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

        $this->end_controls_section();

        /**
         * Style Tab
         * ------------------------------ Style Title ------------------------------
         *
         */
        $this->start_controls_section(
            'style_title', [
                'label' => __( 'Button Style', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs('saasland_button_tabs');
        $this->start_controls_tab( 'saasland_button_tab_normal', [
            'label' => __( 'Normal', 'saasland-core' ),
        ]);
        $this->add_control(
            'color_prefix', [
                'label' => __( 'Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .saasland_btn_w_icon .erp_btn_learn' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'saasland_btn_bg', [
                'label' => __( 'Background', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .saasland_btn_w_icon .erp_btn_learn' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'saasland_btn_border',
                'label' => __( 'Border', 'saasland-core' ),
                'selector' => '{{WRAPPER}} .saasland_btn_w_icon .erp_btn_learn',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'saasland_btn_box_shadow',
                'label' => __( 'Box Shadow', 'saasland-core' ),
                'selector' => '{{WRAPPER}} .saasland_btn_w_icon .erp_btn_learn',
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab( 'saasland_button_tab_hover', [
            'label' => __( 'Hover', 'saasland-core' ),
        ]);
        $this->add_control(
            'color_hover', [
                'label' => __( 'Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .saasland_btn_w_icon .erp_btn_learn:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'saasland_btn_hover_bg', [
                'label' => __( 'Background', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .saasland_btn_w_icon .erp_btn_learn:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'saasland_btn_hover_border',
                'label' => __( 'Border', 'saasland-core' ),
                'selector' => '{{WRAPPER}} .saasland_btn_w_icon .erp_btn_learn:hover',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'saasland_btn_hover_box_shadow',
                'label' => __( 'Box Shadow', 'saasland-core' ),
                'selector' => '{{WRAPPER}} .saasland_btn_w_icon .erp_btn_learn:hover',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();


        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_prefix',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
				    {{WRAPPER}} .saasland_btn_w_icon .erp_btn_learn
				    ',
            ]
        );

        $this->add_control(
            'icon_size',
            [
                'label' => __( 'Icon Size', 'saasland-core' ),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .saasland_btn_w_icon .erp_btn_learn i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
            ]
        );

        $this->add_control(
            'icon_padding_i',
            [
                'label' => __( 'Icon Padding', 'saasland-core' ),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .saasland_btn_w_icon .erp_btn_learn i' => 'padding-left: {{SIZE}}{{UNIT}};',
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
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
        $settings = $this->get_settings();
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
        ?>
        <div class="saasland_btn_w_icon">
            <a <?php saasland_el_btn($settings['link']); ?> class="erp_btn_learn" <?php saasland_is_external( $settings['link'] ) ?>>
                <?php echo !empty( $settings['btn_label'] ) ? esc_html( $settings['btn_label'] ) : ''; ?>
                <i class="<?php echo esc_attr( $icon ) ?>"></i>
            </a>
        </div>
        <?php
    }
}
