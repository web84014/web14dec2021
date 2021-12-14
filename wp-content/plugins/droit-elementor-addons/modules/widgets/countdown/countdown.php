<?php
namespace DROIT_ELEMENTOR\Widgets;

if (!defined('ABSPATH')) {exit;}

class Droit_Addons_Countdown extends \Elementor\Widget_Base {

    // Get Control ID
	protected function get_control_id( $control_id ) {
        return $control_id;
    }

    final public function get_countdown_settings( $control_key ) {
        $control_id = $this->get_control_id( $control_key );
        return $this->get_settings( $control_id );
    }

    public function get_name() {
        return 'droit-countdown';
    }
    
    public function get_title() {
        return esc_html__( 'Countdown', 'droit-addons' );
    }

    public function get_icon() {
        return 'dlicons-countdown addons-icon';
    }

    public function get_keywords() {
        return [ 'countdown', 'number', 'timer', 'time', 'date', 'evergreen', 'dl countdown', 'droit-countdown', 'droit countdown', 'count down', 'dr count down', 'droit', 'dl', 'addons', 'addon' ];
    }
    
    public function get_categories() {
        return ['droit_addons'];
    }

    protected function _register_controls(){
        $this->register_countdown_time_controls();
        $this->register_countdown_time_settings_controls();
        $this->register_countdown_time_expire_controls();
        $this->register_countdown_time_general_style_controls();
        $this->register_countdown_time_digit_label_style_controls();
        do_action('dl_widget/section/style/custom_css', $this);
    }

    //Time
    public function register_countdown_time_controls(){
        $this->start_controls_section(
            '_countdown_time_section',
            [
                'label' => esc_html__('Select Due Date & Time', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            '_dl_countdown_due_time',
            [
                'label'       => esc_html__( 'Due Date', 'droit-addons' ),
                'type'        => \Elementor\Controls_Manager::DATE_TIME,
                'default'     => date( "Y-m-d", strtotime( "+ 1 day" ) ),
                'description' => esc_html__( 'Set the due date & time', 'droit-addons' ),
            ]
        );
        $this->end_controls_section();
    }

    //Time Setting
    public function register_countdown_time_settings_controls(){
        $this->start_controls_section(
            '_countdown_time_settings_section',
            [
                'label' => esc_html__('Set Settings', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            '_dl_show_days',
            [
                'label'     => __( 'Days', 'droit-addons' ),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'label_on'  => __( 'Show', 'droit-addons' ),
                'label_off' => __( 'Hide', 'droit-addons' ),
                'default'   => 'yes',
                'condition' => [
                    $this->get_control_id('_dl_custom_labels!') => '',
                ],
            ]
        );

        $this->add_control(
            '_dl_show_hours',
            [
                'label'     => __( 'Hours', 'droit-addons' ),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'label_on'  => __( 'Show', 'droit-addons' ),
                'label_off' => __( 'Hide', 'droit-addons' ),
                'default'   => 'yes',
                'condition' => [
                    $this->get_control_id('_dl_custom_labels!') => '',
                ],
            ]
        );

        $this->add_control(
            '_dl_show_minutes',
            [
                'label'     => __( 'Minutes', 'droit-addons' ),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'label_on'  => __( 'Show', 'droit-addons' ),
                'label_off' => __( 'Hide', 'droit-addons' ),
                'default'   => 'yes',
                'condition' => [
                    $this->get_control_id('_dl_custom_labels!') => '',
                ],
            ]
        );

        $this->add_control(
            '_dl_show_seconds',
            [
                'label'     => __( 'Seconds', 'droit-addons' ),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'label_on'  => __( 'Show', 'droit-addons' ),
                'label_off' => __( 'Hide', 'droit-addons' ),
                'default'   => 'yes',
                'condition' => [
                    $this->get_control_id('_dl_custom_labels!') => '',
                ],
            ]
        );

        $this->add_control(
            '_dl_custom_labels',
            [
                'label'   => __( 'Custom Label', 'droit-addons' ),
                'type'    => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            '_dl_label_days',
            [
                'label'       => __( 'Days', 'droit-addons' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => __( 'Days', 'droit-addons' ),
                'placeholder' => __( 'Days', 'droit-addons' ),
                'condition'   => [
                    $this->get_control_id('_dl_custom_labels!') => '',
                    $this->get_control_id('_dl_show_days') => ['yes'],  
                ],
            ]
        );

        $this->add_control(
            '_dl_label_hours',
            [
                'label'       => __( 'Hours', 'droit-addons' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => __( 'Hours', 'droit-addons' ),
                'placeholder' => __( 'Hours', 'droit-addons' ),
                'condition'   => [
                    $this->get_control_id('_dl_custom_labels!') => '',
                    $this->get_control_id('_dl_show_hours') => ['yes'],
                ],
            ]
        );

        $this->add_control(
            '_dl_label_minutes',
            [
                'label'       => __( 'Minutes', 'droit-addons' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => __( 'Minutes', 'droit-addons' ),
                'placeholder' => __( 'Minutes', 'droit-addons' ),
                'condition'   => [
                    $this->get_control_id('_dl_custom_labels!') => '',
                    $this->get_control_id('_dl_show_minutes') => ['yes'],
                ],
            ]
        );

        $this->add_control(
            '_dl_label_seconds',
            [
                'label'       => __( 'Seconds', 'droit-addons' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => __( 'Seconds', 'droit-addons' ),
                'placeholder' => __( 'Seconds', 'droit-addons' ),
                'condition'   => [
                    $this->get_control_id('_dl_custom_labels!') => '',
                    $this->get_control_id('_dl_show_seconds') => ['yes'],
                ],
            ]
        );
       
        $this->end_controls_section();
    }

    //Time Message
    public function register_countdown_time_expire_controls(){
        $this->start_controls_section(
            '_countdown_time_expire_section',
            [
                'label' => esc_html__('Actions After Expire', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            '_dl_countdown_expire_type',
            [
                'label'       => esc_html__( 'Action Type', 'droit-addons' ),
                'label_block' => false,
                'type'        => \Elementor\Controls_Manager::SELECT,
                'description' => esc_html__( 'Choose type if you want to set a message or a redirect link', 'droit-addons' ),
                'options'     => [
                    'none'     => esc_html__( 'None', 'droit-addons' ),
                    'text'     => esc_html__( 'Message', 'droit-addons' ),
                    'url'      => esc_html__( 'Redirection Link', 'droit-addons' ),
                ],
                'default'     => 'none',
            ]
        );

        $this->add_control(
            '_dl_countdown_expiry_text_title',
            [
                'label'     => esc_html__( 'Title', 'droit-addons' ),
                'type'      => \Elementor\Controls_Manager::TEXTAREA,
                'default'   => esc_html__( 'Session is expired!', 'droit-addons' ),
                'condition' => [
                    $this->get_control_id('_dl_countdown_expire_type') => ['text'],
                ],
            ]
        );

        $this->add_control(
            '_dl_countdown_expiry_text',
            [
                'label'     => esc_html__( 'End Content', 'droit-addons' ),
                'type'      => \Elementor\Controls_Manager::WYSIWYG,
                'default'   => esc_html__( 'Sorry! your allocated time is over', 'droit-addons' ),
                'condition' => [
                    $this->get_control_id('_dl_countdown_expire_type') => ['text'],
                ],
            ]
        );

        $this->add_control(
            '_dl_countdown_expiry_redirection',
            [
                'label'     => esc_html__( 'Redirect To (URL)', 'droit-addons' ),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    $this->get_control_id('_dl_countdown_expire_type') => ['url'],                
                ],
                'default'   => '#',
            ]
        );

        $this->end_controls_section();
    }

    // Time General
    public function register_countdown_time_general_style_controls(){
        $this->start_controls_section(
            '_countdown_time_general_style_section',
            [
                'label' => esc_html__('General', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,  
            ]
        );

        $this->add_responsive_control(
			'_dl_accordions_items_alignment',
			[
				'label' => __( 'Content Alignment', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'droit-addons' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'droit-addons' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'droit-addons' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'droit-addons' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .dl_countdown_content .dl_countdown_running' => 'text-align: {{VALUE}};',
				],
			]
		);
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => '_dl_countdown_section_bgtype',
                'label'    => __( 'Background', 'droit-addons' ),
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .droit-countdown-wrapper .dl_countdown_content'
            ]
        );
        $this->add_responsive_control(
            '_dl_countdown__section_padding',
            [
                'label'      => esc_html__('Padding', 'droit-elementor-addons'),
                'type'       => \ELEMENTOR\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .droit-countdown-wrapper .dl_countdown_content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            '_countdown_time_general_item_style_section',
            [
                'label' => esc_html__('Item', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,  
            ]
        );
    
        $this->add_responsive_control(
            '_dl_countdown_item_padding',
            [
                'label'      => esc_html__('Padding', 'droit-elementor-addons'),
                'type'       => \ELEMENTOR\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .droit-countdown-wrapper .droit-countdown-content .droit-countdown-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );



        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => '_dl_accordions_items_bgtype',
                'label'    => __( 'Background', 'droit-addons' ),
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .droit-countdown-wrapper .droit-countdown-content .droit-countdown-inner'
            ]
        );

        $this->add_responsive_control(
            'countdown_image_space_second',
            [
                'label' => __( 'Item Height', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'default' => [
                    'size' => 123,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl_countdown_inner.droit-countdown-inner' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'countdown_image_space_width',
            [
                'label'   => __( 'Item Width', 'droit-addons' ),
                'type'    => \Elementor\Controls_Manager::SLIDER,
                'default' => [
                    'size' => 123,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl_countdown_inner.droit-countdown-inner' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
			'dl_cowntdown_column_gap',
			[
				'label' => __( 'Column Gap', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .dl_countdown_wrapper .dl_colum_4' => 'column-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => '_count_down_item_border',
				'label'    => esc_html__('Border', 'droit-addons'),
                'selector' => '{{WRAPPER}} .dl_countdown_inner.droit-countdown-inner'
			]
		);

        $this->add_responsive_control(
            'countdown_image_space_width_border_radius',
            [
                'label'   => __( 'Border Radius', 'droit-addons' ),
                'type'    => \Elementor\Controls_Manager::SLIDER,
                'default' => [
                    'size' => 50,
                ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl_countdown_inner.droit-countdown-inner' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );     

        $this->end_controls_section();
    }

    //Time Digit & Number
    public function register_countdown_time_digit_label_style_controls(){
        $this->start_controls_section(
            '_dl_countdown_time_digit_label_style_section',
            [
                'label' => esc_html__('Digit & Number', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            '_dl_countdown_digits_heading',
            [
                'label' => __( 'Digits', 'droit-addons' ),
                'type'  => \Elementor\Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
			'dl_text_spacing_width',
			[
				'label' => __( 'Spacing', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				
				'selectors' => [
					'{{WRAPPER}} .dl_countdown_wrapper.dl_style_08 .dl_countdown_inner span' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => '_dl_countdown_time_digits_typography',
                'selector' => '{{WRAPPER}} .droit-countdown-wrapper .droit-countdown-content .droit-countdown-inner .droit-countdown-digits',
            ]
        );

       
        
        $this->start_controls_tabs('_dl_countdown_time_digit_header_tabs');

        $this->start_controls_tab('_dl_countdown_time_digit_header_normal_tab', 
            ['label' => esc_html__('Normal', 'droit-addons')]
        );
        
        $this->add_control(
            '_dl_countdown_time_digits_text_color_days',
            [
                'label'     => esc_html__('Days Color', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} span.dl_days.droit-countdown-digits' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            '_dl_countdown_time_digits_text_color_hours',
            [
                'label'     => esc_html__('Hours Color', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} span.dl_hours.dl_text_blue.droit-countdown-digits' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            '_dl_countdown_time_digits_text_color_minutes',
            [
                'label'     => esc_html__('Minutes Color', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} span.dl_minutes.dl_text_yellow.droit-countdown-digits' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            '_dl_countdown_time_digits_text_color_seconds',
            [
                'label'     => esc_html__('Seconds Color', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} span.dl_seconds.dl_text_orange.droit-countdown-digits' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('_dl_countdown_time_digit_header_hover_tab', 
            ['label' => esc_html__('Hover', 'droit-addons')]
        );
 
        $this->add_control(
            '_dl_countdown_time_digits_text_color_days_hover',
            [
                'label'     => esc_html__('Days Color', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} span.dl_days.droit-countdown-digits:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            '_dl_countdown_time_digits_text_color_hours_hover',
            [
                'label'     => esc_html__('Hours Color', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} span.dl_hours.dl_text_blue.droit-countdown-digits:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            '_dl_countdown_time_digits_text_color_minutes_hover',
            [
                'label'     => esc_html__('Minutes Color', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} span.dl_minutes.dl_text_yellow.droit-countdown-digits:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            '_dl_countdown_time_digits_text_color_seconds_hover',
            [
                'label'     => esc_html__('Seconds Color', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} span.dl_seconds.dl_text_orange.droit-countdown-digits:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            '_dl_countdown_labels_heading',
            [
                'label'     => __( 'Labels', 'droit-addons' ),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    $this->get_control_id('_dl_custom_labels!') => '',
                ],
                
            ]
        );
            $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'      => '_dl_countdown_time_labels_typography',
                'selector'  => '{{WRAPPER}} .droit-countdown-wrapper .droit-countdown-content .droit-countdown-inner .droit-countdown-labels',
                'condition' => [
                    $this->get_control_id('_dl_custom_labels!') => '',
                ],
            ]
        );

        
        $this->start_controls_tabs('_dl_countdown_time_label_header_tabs');

        $this->start_controls_tab('_dl_countdown_time_label_header_normal_tab', 
            [
                'label'     => esc_html__('Normal', 'droit-addons'),
                'condition' => [
                    $this->get_control_id('_dl_custom_labels!') => '',
                ],
            ]
        );
        
        $this->add_control(
            '_dl_countdown_time_digits_text_color_days_label',
            [
                'label'     => esc_html__('Days Color', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .dl_countdown_inner.droit-countdown-inner.countdown-days .dl_countdown p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            '_dl_countdown_time_digits_text_color_hours_label',
            [
                'label'     => esc_html__('Hours Color', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .dl_countdown_inner.droit-countdown-inner.countdown-hours .dl_countdown p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            '_dl_countdown_time_digits_text_color_minutes_label',
            [
                'label'     => esc_html__('Minutes Color', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .dl_countdown_inner.droit-countdown-inner.countdown-minutes .dl_countdown p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            '_dl_countdown_time_digits_text_color_seconds_label',
            [
                'label'     => esc_html__('Seconds Color', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .dl_countdown_inner.droit-countdown-inner.countdown-seconds .dl_countdown p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('_dl_countdown_time_label_header_hover_tab', 
            [
                'label'     => esc_html__('Hover', 'droit-addons'),
                'condition' => [
                    $this->get_control_id('_dl_custom_labels!') => '',
                ],
            ]
        );
 
        $this->add_control(
            '_dl_countdown_time_digits_text_color_days_label_hover',
            [
                'label'     => esc_html__('Days Color', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .dl_countdown_inner.droit-countdown-inner.countdown-days .dl_countdown p:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            '_dl_countdown_time_digits_text_color_hours_label_hover',
            [
                'label'     => esc_html__('Hours Color', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .dl_countdown_inner.droit-countdown-inner.countdown-hours .dl_countdown p:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            '_dl_countdown_time_digits_text_color_minutes_label_hover',
            [
                'label'     => esc_html__('Minutes Color', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .dl_countdown_inner.droit-countdown-inner.countdown-minutes .dl_countdown p:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            '_dl_countdown_time_digits_text_color_seconds_label_hover',
            [
                'label'     => esc_html__('Seconds Color', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .dl_countdown_inner.droit-countdown-inner.countdown-seconds .dl_countdown p:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->end_controls_tab();

        $this->end_controls_tabs();
        $this->end_controls_section();
    }

    //Html render
    protected function render() {
        $settings          = $this->get_settings_for_display();
        $get_due_date_time = esc_attr( $this->get_countdown_settings('_dl_countdown_due_time') );
        $due_date_time     = date( "M d Y G:i:s", strtotime( $get_due_date_time ) );
        $id_int            = substr( $this->get_id_int(), 0, 4 );
        

        $this->add_render_attribute( 'droit-countdown-wrapper', [
            'id'                => 'countdown-' . $id_int,
            'class'             => [ 'dl_countdown_wrapper', 'dl_style_08', 'droit-countdown-wrapper' ],
            'data-countdown-id' => esc_attr( $this->get_id() ),
            'data-end-type'     => $this->get_countdown_settings('_dl_countdown_expire_type'),
            
        ] );

        if ( $this->get_countdown_settings('_dl_countdown_expire_type') == 'text' ) {
            if ( !empty( $this->get_countdown_settings('_dl_countdown_expiry_text') ) ) {
                $this->add_render_attribute( 'droit-countdown-wrapper', 'data-end-text', wp_kses_post( $this->get_countdown_settings('_dl_countdown_expiry_text') ) );
            }

            if ( !empty( $this->get_countdown_settings('_dl_countdown_expiry_text_title') ) ) {
                $this->add_render_attribute( 'droit-countdown-wrapper', 'data-end-title', wp_kses_post( $this->get_countdown_settings('countdown_expiry_text_title') ) );
            }
        } elseif ( $this->get_countdown_settings('_dl_countdown_expire_type') == 'url' ) {
            $this->add_render_attribute( 'droit-countdown-wrapper', 'data-redirect-url', $this->get_countdown_settings('_dl_countdown_expiry_redirection') );
        }else {
            //Nothing
        }
        ?>
        
        <div <?php echo $this->get_render_attribute_string( 'droit-countdown-wrapper' ); ?>>

            <div class="dl_countdown_content droit-countdown-content d_8">
                <div id="droit-countdown-<?php echo esc_attr( $this->get_id() ); ?>" class="dl_countdown_running dl_colum_4" data-date="<?php echo esc_attr( $due_date_time ); ?>">
                        <div class="dl_countdown_inner droit-countdown-inner countdown-days">
                            <div class="dl_countdown">
                                <span data-days class="dl_days droit-countdown-digits"></span>
                                <?php if ( $this->get_countdown_settings('_dl_custom_labels') == 'yes' ): ?>
                                    <?php if ( $this->get_countdown_settings('_dl_show_days') == 'yes' ): ?>
                                        <p class="dl_desc droit-countdown-labels"><?php echo $this->get_countdown_settings('_dl_label_days'); ?></p>
                                    <?php endif; ?>
                                <?php endif; ?>
                        </div>                
                    </div>
                        <div class="dl_countdown_inner droit-countdown-inner countdown-hours">
                            <div class="dl_countdown">
                                <span data-hours class="dl_hours dl_text_blue droit-countdown-digits"></span>
                                <?php if ( $this->get_countdown_settings('_dl_custom_labels') == 'yes' ): ?>
                                    <?php if ($this->get_countdown_settings('_dl_show_hours') == 'yes') : ?>
                                        <p class="dl_desc droit-countdown-labels"><?php echo $this->get_countdown_settings('_dl_label_hours'); ?></p>
                                    <?php endif; ?>
                                <?php endif; ?>
                        </div>
                    </div>
                        <div class="dl_countdown_inner droit-countdown-inner countdown-minutes">
                            <div class="dl_countdown">
                                <span data-minutes class="dl_minutes dl_text_yellow droit-countdown-digits"></span>
                                <?php if ( $this->get_countdown_settings('_dl_custom_labels') == 'yes' ): ?>
                                    <?php if ($this->get_countdown_settings('_dl_show_minutes') == 'yes') : ?>
                                        <p class="dl_desc droit-countdown-labels"><?php echo $this->get_countdown_settings('_dl_label_minutes'); ?></p>
                                    <?php endif; ?>
                                <?php endif; ?>
                        </div>              
                    </div>
                        <div class="dl_countdown_inner droit-countdown-inner countdown-seconds">
                            <div class="dl_countdown">
                                <span data-seconds class="dl_seconds dl_text_orange droit-countdown-digits"></span>
                                <?php if ( $this->get_countdown_settings('_dl_custom_labels') == 'yes' ): ?>
                                    <?php if ($this->get_countdown_settings('_dl_show_seconds') == 'yes') : ?>
                                        <p class="dl_desc droit-countdown-labels"><?php echo $this->get_countdown_settings('_dl_label_seconds'); ?></p>
                                    <?php endif; ?>
                                <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php 
    }

    protected function content_template(){}
}