<?php

namespace DROIT_ELEMENTOR\Widgets;

if (!defined('ABSPATH')) {exit;}

class Droit_Addons_Alert extends \Elementor\Widget_Base {

    public function get_name() {
        return 'droit-alert';
    }
    
    public function get_title() {
        return esc_html__( 'Alert', 'droit-addons' );
    }

    public function get_icon() {
        return 'dlicons-alert addons-icon';
    }

    public function get_keywords() {
        return [ 'alert', 'dl alert', 'droit alert',  'data alert', 'alert styler', 'elementor alert', 'dl', 'droit' ];
    }
    
    public function get_categories() {
        return ['droit_addons'];
    }

    protected function _register_controls() {
        $this->_droit_register_dl_alert_content_controls();
        $this->_droit_register_dl_alert_general_style_controls();
        $this->_droit_register_dl_alert_title_style_controls();
        do_action('dl_widget/section/style/custom_css', $this);
    }

    //Content
    public function _droit_register_dl_alert_content_controls() {
        $this->start_controls_section(
            '_dl_alert_content_section',
            [
                'label' => __( 'Alert Content', 'droit-addons' ),
            ]
        );

        $this->add_control(
            '_dl_alert_design_format',
            [
                'label' => esc_html__( 'Alert Design', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'label_block' => false,
                'options'   => [
                    'dl_notice_alert'  => 'Notice Alert',
                    'dl_info_alert'    => 'Info Alert',
                    'dl_error_alert'   => 'Error Alert',
                    'dl_success_alert' => 'Success Alert',
                    'dl_warning_alert' => 'Warning Alert',
                    'dl_default_alert' => 'Default Alert',
                ],
                'default' => 'dl_notice_alert'
            ]
        );

        $this->add_control(
            '_dl_alert_title',
            [
                'label'       => __( 'Alert Title', 'droit-addons' ),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => __( 'The quickest & easiest service provider', 'droit-addons' ),
                'placeholder' => __( 'Enter your title', 'droit-addons' ),
                'label_block' => true,
            ]
        );
        
        $this->add_control(
            '_dl_alert_title_size',
            [
                'label' => __( 'Title HTML Tag', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'label_block' => true,
                'options' => [
                    'h1'  => [
                        'title' => __( 'H1', 'droit-addons' ),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2'  => [
                        'title' => __( 'H2', 'droit-addons' ),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3'  => [
                        'title' => __( 'H3', 'droit-addons' ),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4'  => [
                        'title' => __( 'H4', 'droit-addons' ),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5'  => [
                        'title' => __( 'H5', 'droit-addons' ),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6'  => [
                        'title' => __( 'H6', 'droit-addons' ),
                        'icon' => 'eicon-editor-h6'
                    ],
                    'p'  => [
                        'title' => __( 'P', 'droit-addons' ),
                        'icon' => 'eicon-editor-paragraph'
                    ],
                ],
                'default' => 'p',
                'toggle' => false,
                
            ]
        );
        
        $this->add_control(
            '_dl_alert_icon_show',
            [
                'label'        => __( 'Alert Icon', 'droit-addons' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'droit-addons' ),
                'label_off'    => __( 'NO', 'droit-addons' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );
        
        $this->add_control(
            '_dl_alert_icon',
            [
                'label'            => __( 'Alert Icon', 'droit-addons' ),
                'type'             => \Elementor\Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default'          => [
                    'value'   => 'fas fa-volume-up',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $this->add_control(
            '_dl_alert_cross_icon_show',
            [
                'label'        => __( 'Alert Cross Icon', 'droit-addons' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'droit-addons' ),
                'label_off'    => __( 'NO', 'droit-addons' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );
        
        $this->add_control(
            '_dl_alert_cross_icon',
            [
                'label'            => __( 'Alert Cross Icon', 'droit-addons' ),
                'type'             => \Elementor\Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default'          => [
                    'value'   => 'eicon-editor-close',
                    'library' => 'solid',
                ],
            ]
        );

        $this->end_controls_section();

    }

    //General
    public function _droit_register_dl_alert_general_style_controls(){
        $this->start_controls_section(
            '_dl_alert_style_general',
            [
                'label' => esc_html__('General', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'alert_background',
                'label'    => esc_html__('Background Color', 'droit-addons'),
                'types'    => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .dl_alert_box.dl_alert_box_style_01',
            ]
        );

        $this->add_group_control(
            \ELEMENTOR\Group_Control_Border::get_type(),
            [
                'name'     => '_dl_alert_box_border',
                'label'    => esc_html__('Border', 'droit-elementor-addons'),
                'selector' => '{{WRAPPER}} .dl_alert_box.dl_alert_box_style_01',
            ]
        );

        $this->add_control(
            '_dl_alert_box_border_radius',
            [
                'label'      => __( 'Border Radius', 'droit-addons' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .dl_alert_box.dl_alert_box_style_01' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            '_dl_alert_box_margin',
            [
                'label'   => esc_html__('Box Margin', 'droit-addons'),
                'type'    => \Elementor\Controls_Manager::SLIDER,
                'default' => [
                    'size' => '',
                    'unit' => 'px',
                ],
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl_alert_box.dl_alert_box_style_01' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            '_dl_alert_box_padding',
            [
                'label'      => esc_html__('Box Padding', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .dl_alert_box.dl_alert_box_style_01' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section();
    }

    //alert Title Style
    public function _droit_register_dl_alert_title_style_controls() {
        $this->start_controls_section(
            '_dl_alert_title_style_settings',
            [
                'label' => esc_html__('Alert Title', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => '_dl_alert_title_typography',
                'selector' => '{{WRAPPER}} .dl_alert_box .dl_alert_desc',
            ]
        );

        $this->add_control(
            '_dl_alert_text_color',
            [
                'label'     => esc_html__('Text Color', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .dl_alert_box .dl_alert_desc' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            '_alert_title_opacity',
            [
                'label'     => __('Opacity', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max'  => 10,
                        'min'  => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl_alert_box .dl_alert_desc' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            '_alert_title_padding',
            [
                'label'      => __('Padding', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .dl_alert_box .dl_alert_desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
        
        $this->start_controls_section(
            '_dl_alert_icon_style_settings',
            [
                'label' => esc_html__('Alert Icon', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            '_dl_alert_icon_bg_color',
            [
                'label'     => esc_html__('Icon Background Color', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .dl_alert_box.dl_alert_box_style_01 .dl_alert_desc i' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            '_dl_alert_icon_color',
            [
                'label'     => esc_html__('Icon Color', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .dl_alert_box.dl_alert_box_style_01 .dl_alert_desc i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            '_dl_alert_icon_size',
            [
                'label' => __( 'Icon Size', 'droit-addons' ),
                'type'  => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 6,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl_alert_box.dl_alert_box_style_01 .dl_alert_desc i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .dl_alert_box.dl_alert_box_style_01 .dl_alert_desc svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            '_alert_icon_padding',
            [
                'label'      => __('Padding', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .dl_alert_box.dl_alert_box_style_01 .dl_alert_desc i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            '_dl_alert_cross_icon_style_settings',
            [
                'label' => esc_html__('Cross Icon', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            '_dl_alert_cross_icon_bg_color',
            [
                'label'     => esc_html__('Icon Background Color', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .dl_alert_box.dl_alert_box_style_01 .dl_alert_close i' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            '_dl_alert_cross_icon_color',
            [
                'label'     => esc_html__('Icon Color', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .dl_alert_box.dl_alert_box_style_01 .dl_alert_close i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            '_dl_alert_cross_icon_size',
            [
                'label' => __( 'Icon Size', 'droit-addons' ),
                'type'  => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 6,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl_alert_box.dl_alert_box_style_01 .dl_alert_close i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .dl_alert_box.dl_alert_box_style_01 .dl_alert_close svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            '_alert_cross_icon_padding',
            [
                'label'   => __('Padding', 'droit-addons'),
                'type'    => \Elementor\Controls_Manager::SLIDER,
                'default' => [
                    'size' => '',
                    'unit' => 'px',
                ],
                'size_units' => ['px'],
                'range'  => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .dl_alert_box.dl_alert_box_style_01 .dl_alert_close i' => 'padding: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }

    //Html render
    protected function render(){
        $settings = $this->get_settings_for_display();
        extract($settings);

        $alert_style          =  ! empty($_dl_alert_design_format);
        $title_size           =  $_dl_alert_title_size ?? '';
        $alert_show_icon      =  ! empty($_dl_alert_icon_show);
        $alert_cross_show     =  ! empty($_dl_alert_cross_icon_show);
        ?>

        <div class="dl_alert_box dl_alert_box_style_01 <?php echo esc_html($_dl_alert_design_format); ?>">
            <<?php echo $title_size; ?> class="dl_alert_desc">
                <?php if($alert_show_icon): ?><?php \ELEMENTOR\Icons_Manager::render_icon( $_dl_alert_icon ); ?><?php endif; ?>
                <?php echo wp_kses_post($_dl_alert_title); ?>
            </<?php echo $title_size; ?>>

            <?php if($alert_cross_show): ?>
                <div class="dl_alert_close">
                    <?php \ELEMENTOR\Icons_Manager::render_icon( $_dl_alert_cross_icon ); ?>
                </div>
            <?php endif; ?>
        </div>
    <?php
    }

    protected function content_template(){}
}
