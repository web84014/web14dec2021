<?php
namespace SaaslandCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
//use WP_Query;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class Team
 * @package SaaslandCore\Widgets
 */
class Saasland_heading extends Widget_Base {

    public function get_name() {
        return 'Saasland_heading';
    }

    public function get_title()
    {
        return __('Heading [Saasland]', 'saasland-core');
    }

    public function get_icon()
    {
        return 'eicon-heading';
    }

    public function get_categories()
    {
        return ['saasland-elements'];
    }


    protected function _register_controls() {

        // ------------------------------  Title Section ------------------------------
        $this->start_controls_section(
            'saasland_headning_sec', [
                'label' => __('Heading', 'saasland-core'),

            ]
        );
        $this->add_control(
            'heading_text', [
                'label' => esc_html__('Title', 'saasland-core'),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'Title Text'
            ]
        );
        $this->add_control(
            'heading_link', [
                'label' => esc_html__('Link', 'saasland-core'),
                'type' => Controls_Manager::URL,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'heading_html_tag',
            [
                'label' => __('HTML Tag', 'saasland-core'),
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
            'heading_text_align',
            [
                'label' => __( 'Alignment', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
                        'title' => __( 'Left', 'saasland-core' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'saasland-core' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'end' => [
                        'title' => __( 'Right', 'saasland-core' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'start',
                'toggle' => true,
            ]
        );
        $this->end_controls_section(); // End title section




        //---------------------------------------- Style Item Author Name -------------------------------------------
        $this->start_controls_section(
            'heading_style', [
                'label' => __('Style', 'saasland-core'),
                'tab' => Controls_Manager::TAB_STYLE,

            ]
        );
        $this->add_control(
            'heading_text_color',
            [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .saasland_heading' => 'color: {{VALUE}}',
                ],
            ]
        );


        $this->add_control(
            'heading_text_gradient2',
            [
                'label' => __( 'Text Gradient Color 2', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
            ]
        );
        $this->add_control(
            'text_color2_percentage',
            [
                'label' => __( 'Second Color Percentage', 'plugin-domain' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 50,
                ],
            ]
        );
        $this->add_control(
            'heading_text_gradient3',
            [
                'label' => __( 'Text Gradient Color 3', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,

            ]
        );
        $this->add_control(
            'text_color3_percentage',
            [
                'label' => __( 'Third Color Percentage', 'plugin-domain' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 50,
                ],
                'separator' => 'after'
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'heading_typo',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .saasland_heading',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'heading_text_shadow',
                'label' => __( 'Text Shadow', 'saasland-core' ),
                'selector' => '{{WRAPPER}} .saasland_heading',
            ]
        );

        $this->end_controls_section();


    }

    protected function render() {
        $settings = $this->get_settings();
        $html_tag = !empty( $settings['heading_html_tag'] ) ? $settings['heading_html_tag'] : 'h2';

        $title_style = !empty( $settings['heading_text_gradient2'] ) ? '
            style="background-image: linear-gradient(95deg, '.$settings['heading_text_color'].' 20%, '.$settings['heading_text_gradient2'].' '.$settings['text_color2_percentage']['size'].'%, '.$settings['heading_text_gradient3'].' '.$settings['text_color3_percentage']['size'].'%);
                -webkit-background-clip: text;-webkit-text-fill-color: transparent;"
        ' : '';

        echo '<div class="heading_wrap d-flex justify-content-'.esc_attr( $settings['heading_text_align'] ).'">';

            if( !empty( $settings['heading_link']['url'] ) ){
                echo '<a href="'. esc_url( $settings['heading_link']['url'] ) .'">';
            }
            echo '<'.esc_html($html_tag).' class="saasland_heading" '.wp_kses_post( $title_style ).'>'.wp_kses_post( nl2br( $settings['heading_text'] ) ).'</'.esc_html($html_tag).'>';

            if( !empty( $settings['heading_link']['url'] ) ){
                echo '</a>';
            }
        echo '</div>';
    }
}