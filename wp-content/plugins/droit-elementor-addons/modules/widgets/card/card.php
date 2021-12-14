<?php
namespace DROIT_ELEMENTOR\Widgets;

if (!defined('ABSPATH')) {exit;}

class Droit_Addons_Card extends \Elementor\Widget_Base {

    // Get Control ID
	protected function get_control_id( $control_id ) {
        return $control_id;
    }

    final public function get_card_settings( $control_key ) {
        $control_id = $this->get_control_id( $control_key );
        return $this->get_settings( $control_id );
    }

    public function get_name() {
        return 'droit-card';
    }
    
    public function get_title() {
        return esc_html__( 'Card', 'droit-addons' );
    }

    public function get_icon() {
        return 'dlicons-card addons-icon';
    }

    public function get_keywords() {
        return [
            'cards',
            'card',
            'dl cards',
            'dl card',
            'droit cards',
            'droit card',
            'droit',
            'dl',
            'addons',
            'addon'
        ];
    }
    
    public function get_categories() {
        return ['droit_addons'];
    }

    protected function _register_controls(){
        $this->_droit_register_card_content_controls();
		$this->_droit_register_card_style_box_controls();
        $this->_droit_register_card_image_style_controls_first_layout();
        $this->_droit_register_card_style_title_controls();
        $this->_droit_register_card_style_content_controls();
        $this->_droit_register_card_style_button_controls();
        
        do_action('dl_widget/section/style/custom_css', $this);
    }

    // Content
    public function _droit_register_card_content_controls() {
		$this->start_controls_section(
			'_card_section',
			[
				'label' => __( 'Card', 'droit-addons' ),
			]
		);
		$this->add_control(
			'_card_skin',
			[
				'label' => esc_html__( 'Design Format', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'label_block' => false,
				'options'   => [
					'_skin_1' => 'Style 01',
					'_skin_3' => 'Style 02',
				],
				'default' => '_skin_1'
			]
		);

        $this->add_control(
            '_card_image', [
                'label'      => __('Image', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::MEDIA,
                'default'    => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'show_label' => true,
                'condition' => [
					$this->get_control_id('_card_skin!') => ['_skin_3'],
                ]
            ]
        );
		$this->register_card_repeater_section_controls();
        $this->add_control(
			'_card_title_text',
			[
				'label' => __( 'Title', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'This is the heading', 'droit-addons' ),
				'placeholder' => __( 'Enter your title', 'droit-addons' ),
				'label_block' => true,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'_card_description_text',
			[
				'label' => 'Description',
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				
				'default' => __( 'Lorem Ipsum is dolor', 'droit-addons' ),
				'placeholder' => __( 'Enter your description', 'droit-addons' ),
				'rows' => 10,
				'separator' => 'none',
				'show_label' => true,
				'condition'	 => [
					$this->get_control_id('_card_skin!') => ['_skin_3'],
				]
			]
		);

        $this->add_control(
			'show_title_description_reverse',
			[
				'label' => __( 'Content Reverse', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'ON', 'droit-addons' ),
				'label_off' => __( 'OFF', 'droit-addons' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'_card_btn_text',
			[
				'label' => __( 'Button Text', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				
				'default' => __( 'View More', 'droit-addons' ),
				'placeholder' => __( 'Enter your text', 'droit-addons' ),
				'label_block' => true,
				'separator' => 'before',
				'condition' => [
					$this->get_control_id('_card_skin') => ['_skin_1'],
                ],
			]
		);
		$this->add_control(
			'_card_link',
			[
				'label' => __( 'Link', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::URL,
				
				'placeholder' => __( 'https://your-link.com', 'droit-addons' ),
				
			]
		);
		$this->add_control(
			'_card_position',
			[
				'label' => __( 'Image Position', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'default' => 'top',
				'options' => [
					'left' => [
						'title' => __( 'Left', 'droit-addons' ),
						'icon' => 'eicon-h-align-left',
					],
					'top' => [
						'title' => __( 'Top', 'droit-addons' ),
						'icon' => 'eicon-v-align-top',
					],
					'right' => [
						'title' => __( 'Right', 'droit-addons' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'prefix_class' => 'droit-position-',
				
				'toggle' => false,
				'condition' => [
					$this->get_control_id('_card_skin!') => ['_skin_3'],
                ],
			]
		);
		$this->add_control(
            '_card_title_size',
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
                'default' => 'h4',
                'toggle' => false,
                
            ]
        );
		$this->end_controls_section();
	}
	protected function register_card_repeater_section_controls()
    {
    	$this->add_control(
            '_shape_skin',
            [
                'label' => esc_html__( 'Shape Skin', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'label_block' => true,
                'options' => [
                    'dl_style_01'  => [
                        'title' => __( 'Shape 1', 'droit-addons' ),
                        'icon' => 'eicon-layout-settings'
                    ],
                    'dl_style_2'  => [
                        'title' => __( 'Shape 2', 'droit-addons' ),
                        'icon' => 'eicon-layout-settings'
                    ],
                    'dl_style_3'  => [
                        'title' => __( 'Shape 3', 'droit-addons' ),
                        'icon' => 'eicon-layout-settings'
                    ],
                ],
                'toggle' => false,
                'default' => 'dl_style_01',
                'seperator' => 'before',
                'condition' => [
                	$this->get_control_id('_card_skin') => ['_skin_3'],
                ]
            ]
        );
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            '_card_shape_name', [
                'label'       => __('Name', 'droit-addons'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'placeholder'     => __('Enter Name', 'droit-addons'),
                'default'     => __('Circle', 'droit-addons'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            '_card_shape_depth', [
                'label'       => __('Depth', 'droit-addons'),
                'type'        => \Elementor\Controls_Manager::NUMBER,
                'placeholder'     => __('Example: -0.90, 0.50, 0.40, -0.80, 0.80', 'droit-addons'),
                'default'     => -0.90,
                'label_block' => false,
            ]
        );
        $repeater->add_control(
			'_card_shape_delay',
			[
				'label' => __( 'Delay', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'default' => [
					'size' => 0.3,
				],
				'range' => [
					'px' => [
						'max' => 3,
						'step' => 0.1,
					],
				],
			]
		);
        $repeater->add_control(
            '_card_shape_image', [
                'label'      => __('Card Image', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::MEDIA,
                'default'    => [
                    'url' => dl_place_img(),
                ],
                'show_label' => false,
            ]
        );
        $this->add_control(
            '_card_shape_list',
            [
                'label'       => __('Shape Image', 'droit-addons'),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        '_card_shape_name'       => 'Circle',
                        '_card_shape_image'       => '',
                        '_card_shape_depth'       => -0.90,
                        '_card_shape_delay'       => '.3s',
                    ],
                    [
                        '_card_shape_name'       => 'Dash',
                        '_card_shape_image'       => '',
                        '_card_shape_depth'       => 0.50,
                        '_card_shape_delay'       => '.3s',
                    ],
                    [
                        '_card_shape_name'       => 'Small Circle',
                        '_card_shape_image'       => '',
                        '_card_shape_depth'       => 0.40,
                        '_card_shape_delay'       => '.3s',
                    ],
                    [
                        '_card_shape_name'       => 'Medium Circle',
                        '_card_shape_image'       => '',
                        '_card_shape_depth'       => -0.80,
                        '_card_shape_delay'       => '.3s',
                    ],
                    [
                        '_card_shape_name'       => 'Circle',
                        '_card_shape_image'       => '',
                        '_card_shape_depth'       => 0.80,
                        '_card_shape_delay'       => '.3s',
                    ],

                ],
                'title_field' => '{{{ _card_shape_name }}}',
                'condition' => [
					$this->get_control_id('_card_skin') => ['_skin_3'],
                ]
            ]
        );
    }

	// General Settings 

	public function _droit_register_card_style_box_controls(){
		$this->start_controls_section(
			'_card_section_style',
			[
				'label' => __( 'General Settings', 'droit-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'_card_text_align',
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
					'{{WRAPPER}} .droit-card-box-wrapper' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
            '_card_section_padding',
            [
                'label'      => esc_html__('Padding', 'droit-elementor-addons'),
                'type'       => \ELEMENTOR\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .dl_card_box.dl_card_style_01' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

		$this->start_controls_tabs( '_card_tabs_border' );

		$this->start_controls_tab(
			'_card_tab_border_normal',
			[
				'label' => __( 'Normal', 'droit-addons' ),
			]
		);

		$this->add_control(
			'_card_box_bg_color',
			[
				'label' => __( 'Background Color', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .droit-card-box-wrapper' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => '_card_border',
				'label'    => esc_html__('Border', 'droit-addons'),
                'selector' => '{{WRAPPER}} .droit-card-box-wrapper'
			]
		);

		$this->add_responsive_control(
			'_card_border_radius',
			[
				'label' => __( 'Border Radius', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .droit-card-box-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => '_card_box_shadow',
				'selector' => '{{WRAPPER}} .droit-card-box-wrapper',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'_card_tab_border_hover',
			[
				'label' => __( 'Hover', 'droit-addons' ),
			]
		);

		$this->add_control(
			'_card_box_hover_bg_color',
			[
				'label' => __( 'Background Color', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .droit-card-box-wrapper:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => '_card_border_hover',
				'selector' => '{{WRAPPER}} .droit-card-box-wrapper:hover',
			]
		);

		$this->add_responsive_control(
			'_card_border_radius_hover',
			[
				'label' => __( 'Border Radius', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .droit-card-box-wrapper:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => '_card_box_shadow_hover',
				'selector' => '{{WRAPPER}} .droit-card-box-wrapper:hover',
			]
		);

		$this->add_control(
			'_card_border_hover_transition',
			[
				'label' => __( 'Transition Duration', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'separator' => 'before',
				'default' => [
					'size' => 0.3,
				],
				'range' => [
					'px' => [
						'max' => 3,
						'step' => 0.1,
					],
				],
				
				'selectors' => [
					'{{WRAPPER}} .droit-card-box-wrapper' => 'transition: background {{_card_background_hover_transition.SIZE}}s, border {{SIZE}}s, border-radius {{SIZE}}s, box-shadow {{SIZE}}s',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}
	//Image Style
    public function _droit_register_card_image_style_controls_first_layout(){
        $this->start_controls_section(
            '_card_section_style_first_image',
            [
                'label' => __( 'Image', 'droit-addons' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    
                    $this->get_control_id('_card_skin') => ['_skin_1'],
                ]
            ]
        );

        $this->add_responsive_control(
            '_card_image_space_first',
            [
                'label' => __( 'Spacing', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'default' => [
                    'size' => 15,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}.droit-position-right .droit-card-image' => 'margin-left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}}.droit-position-left .droit-card-image' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}}.droit-position-top .droit-card-image' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '(mobile){{WRAPPER}} .droit-card-image' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            '_card_image_size_width_first',
            [
                'label'      => __('Width', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'default' => [
                    'size' => '100',
                    'unit' => '%',
                ],
                'size_units' => ['px', '%'],
                'range'      => [
                    'px'  => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%'   => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'em'  => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    'rem' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],

                'selectors'  => [
                    '{{WRAPPER}} .droit-card-image img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            '_card_image_size_height_first',
            [
                'label'      => __('Height', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'default' => [
                    'size' => '195',
                ],
                'size_units' => ['px', '%', 'em', 'rem'],
                'range'      => [
                    'px'  => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%'   => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'em'  => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    'rem' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],

                'selectors'  => [
                    '{{WRAPPER}} .droit-card-image img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            '_card_image_padding_first',
            [
                'label' => esc_html__('Padding', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .droit-card-box-wrapper .droit-card-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        /* $this->add_control(
            '_card_hover_animation_first',
            [
                'label' => __( 'Hover Animation', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
            ]
        ); */

        $this->start_controls_tabs( '_card_image_effects_first' );

        $this->start_controls_tab( 'normal_first',
            [
                'label' => __( 'Normal', 'droit-addons' ),
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Css_Filter::get_type(),
            [
                'name' => '_card_css_filters_first',
                'selector' => '{{WRAPPER}} .droit-card-image img',
            ]
        );

        $this->add_control(
            '_card_image_opacity_first',
            [
                'label' => __( 'Opacity', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 1,
                        'min' => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .droit-card-image img' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->add_control(
            '_card_background_hover_first_transition',
            [
                'label' => __( 'Transition Duration', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0.3,
                ],
                'range' => [
                    'px' => [
                        'max' => 3,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .droit-card-image img' => 'transition-duration: {{SIZE}}s',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab( 'hover_first',
            [
                'label' => __( 'Hover', 'droit-addons' ),
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Css_Filter::get_type(),
            [
                'name' => '_card_css_filters_first_hover',
                'selector' => '{{WRAPPER}}:hover .droit-card-image img',
            ]
        );

        $this->add_control(
            '_card_image_opacity_first_hover',
            [
                'label' => __( 'Opacity', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 1,
                        'min' => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}:hover .droit-card-image img' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();
        $this->add_control(
            '_card_image_border_heading_first',
            [
                'label' => __( 'Border', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->start_controls_tabs( '_card_image_tabs_border_first' );

        $this->start_controls_tab(
            '_card_image_tab_border_normal_first',
            [
                'label' => __( 'Normal', 'droit-addons' ),
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => '_card_image_border_first',
                'label'    => esc_html__('Border', 'droit-addons'),
                'selector' => '{{WRAPPER}} .droit-card-image'
            ]
        );

        $this->add_responsive_control(
            '_card_image_border_radius_first',
            [
                'label' => __( 'Border Radius', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .droit-card-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        
        $this->end_controls_tab();

        $this->start_controls_tab(
            '_card_image_tab_border_hover_first',
            [
                'label' => __( 'Hover', 'droit-addons' ),
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => '_card_image_border_hover_first',
                'selector' => '{{WRAPPER}} .droit-card-image:hover',
            ]
        );

        $this->add_responsive_control(
            '_card_image_border_radius_hover_first',
            [
                'label' => __( 'Border Radius', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .droit-card-image:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            '_card_image_border_hover_transition_first',
            [
                'label' => __( 'Transition Duration', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'separator' => 'before',
                'default' => [
                    'size' => 0.3,
                ],
                'range' => [
                    'px' => [
                        'max' => 3,
                        'step' => 0.1,
                    ],
                ],
                
                'selectors' => [
                    '{{WRAPPER}} .droit-card-image' => 'transition: background {{_card_image_background_hover_transition.SIZE}}s, border {{SIZE}}s, border-radius {{SIZE}}s, box-shadow {{SIZE}}s',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }



	//Title
	public function _droit_register_card_style_title_controls(){
		$this->start_controls_section(
			'_card_section_style_title',
			[
				'label' => __( 'Title', 'droit-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs( '_card_title_effects' );

		$this->start_controls_tab( '_title_normal',
			[
				'label' => __( 'Normal', 'droit-addons' ),
			]
		);

		$this->add_control(
			'_card_title_color',
			[
				'label' => __( 'Color', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .droit-card-title, {{WRAPPER}} .droit-card-title a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => '_card_title_typography',
				'selector' => '{{WRAPPER}} .droit-card-title, {{WRAPPER}} .droit-card-title a',
				
			]
		);

		$this->add_control(
			'_card_title_transition',
			[
				'label' => __( 'Transition Duration', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'default' => [
					'size' => 0.3,
				],
				'range' => [
					'px' => [
						'max' => 3,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .droit-card-title, {{WRAPPER}} .droit-card-title a' => 'transition-duration: {{SIZE}}s',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab( '_title_hover',
			[
				'label' => __( 'Hover', 'droit-addons' ),
			]
		);

		$this->add_control(
			'_card_title_hover_color',
			[
				'label' => __( 'Color', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .droit-card-title:hover, {{WRAPPER}} .droit-card-title a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'_card_title_hover_transition',
			[
				'label' => __( 'Transition Duration', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'default' => [
					'size' => 0.3,
				],
				'range' => [
					'px' => [
						'max' => 3,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .droit-card-title:hover, {{WRAPPER}} .droit-card-title a:hover' => 'transition-duration: {{SIZE}}s',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'_card_title_bottom_space',
			[
				'label' => __( 'Spacing', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .droit-card-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
	}

	//Conetnt
	public function _droit_register_card_style_content_controls(){
		$this->start_controls_section(
			'_card_section_style_content',
			[
				'label' => __( 'Content', 'droit-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					$this->get_control_id('_card_skin!') => ['_skin_3'],
                ],
			]
		);

		$this->add_control(
			'_card_description_color',
			[
				'label' => __( 'Text Color', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .droit-card-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => '_card_description_typography',
				'selector' => '{{WRAPPER}} .droit-card-text',
				'separator' => 'after',
			]
		);

		$this->add_responsive_control(
			'_card_desc_bottom_space',
			[
				'label' => __( 'Spacing', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .droit-card-text' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->end_controls_section();
	}

	//Button
	public function _droit_register_card_style_button_controls(){

		$this->start_controls_section(
			'_card_section_style_button',
			[
				'label' => __( 'Button', 'droit-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					$this->get_control_id('_card_skin') => ['_skin_1'],
					
                ],
			]
		);

		$this->start_controls_tabs( '_card_button_effects' );

		$this->start_controls_tab( '_button_normal',
			[
				'label' => __( 'Normal', 'droit-addons' ),
			]
		);

		$this->add_control(
			'_card_button_color',
			[
				'label' => __( 'Color', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .droit-card-btn' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'_card_button_bg_color',
			[
				'label' => __( 'Background Color', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .droit-card-btn' => 'background-color: {{VALUE}}; border-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => '_card_button_typography',
				'selector' => '{{WRAPPER}} .droit-card-btn',
				
			]
		);

		$this->add_control(
			'_card_btn_border_radius',
			[
				'label' => __( 'Border Radius', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .droit-card-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'_card_button_transition',
			[
				'label' => __( 'Transition Duration', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'default' => [
					'size' => 0.3,
				],
				'range' => [
					'px' => [
						'max' => 3,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .droit-card-btn' => 'transition-duration: {{SIZE}}s',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( '_button_hover',
			[
				'label' => __( 'Hover', 'droit-addons' ),
			]
		);

		$this->add_control(
			'_card_button_hover_color',
			[
				'label' => __( 'Color', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .droit-card-btn:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'_card_button_hover_bg_color',
			[
				'label' => __( 'Background Color', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .droit-card-btn:hover' => 'background-color: {{VALUE}};border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'_card_hover_border_radius',
			[
				'label' => __( 'Border Radius', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .droit-card-btn:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'_card_button_hover_transition',
			[
				'label' => __( 'Transition Duration', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'default' => [
					'size' => 0.3,
				],
				'range' => [
					'px' => [
						'max' => 3,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .droit-card-btn:hover, {{WRAPPER}} .droit-card-btn a:hover' => 'transition-duration: {{SIZE}}s',
				],
			]
		);
        
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'_card_title_button_space',
			[
				'label' => __( 'Spacing', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .droit-card-btn' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
	}
	

    protected function render(){
        $settings = $this->get_settings_for_display();

        $_card_skin  = !empty($this->get_card_settings('_card_skin')) ? $this->get_card_settings('_card_skin') : '_skin_1';

        switch ($_card_skin) {
            case '_skin_1':
                $this->_card_box_one();
               break;
           case '_skin_3':
                $this->_card_box_three();
               break;
            default:
                $this->_card_box_one();
                break;
        }  
    }

    protected function _card_box_one(){
        $settings = $this->get_settings_for_display();
        extract($settings);
        $this->add_render_attribute( '_card_title_text', 'class', 'dl_title droit-card-title' );
        $this->add_render_attribute( '_card_description_text', 'class', 'dl_tag droit-card-tag droit-card-text' );
        $this->add_render_attribute( '_card_btn_text', 'class', 'droit-card-btn dl_cu_btn btn_4 dl_round_1 text_upper' );

        $link_tag = 'span';
        if ( ! empty( $this->get_card_settings('_card_link')['url'] ) ) {
            $link_tag = 'a';
            $this->add_link_attributes( '_card_link', $this->get_card_settings('_card_link') );
        }

        $has_image            = ! empty( $this->get_card_settings('_card_image') );
        $has_title_text       = ! empty( $this->get_card_settings('_card_title_text') );
        $has_description_text = ! empty( $this->get_card_settings('_card_description_text') );
        $has_btn_text         = ! empty( $this->get_card_settings('_card_btn_text') );


        $link_attributes = $this->get_render_attribute_string( '_card_link' );


        $this->add_inline_editing_attributes( '_card_title_text', 'none' );
        $this->add_inline_editing_attributes( '_card_description_text', 'none' );
        $this->add_inline_editing_attributes( '_card_btn_text', 'none' );
        ?>
        <div class="dl_card_box dl_card_style_01 dl_text_center droit-card-box-wrapper">

            <?php if ( $has_image ) : ?>
                <?php 
                $this->add_render_attribute( '_card_image', 'class', 'droit-card-image dl_thumbnail_fluid' );
                if ( $this->get_card_settings('_card_hover_animation') ) {
                        $this->add_render_attribute( '_card_image', 'class', 'elementor-animation-' . $this->get_card_settings('_card_hover_animation') );
                    }
                 ?>
             <<?php echo implode( ' ', [ $link_tag, $link_attributes ] ); ?> <?php echo $this->get_render_attribute_string( '_card_image' ); ?>>
                <?php 
                if ( ! empty( $this->get_card_settings('_card_image')['url'] ) ) {
                    ?><?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', '_card_image' ); ?>
                <?php }

                 ?>
            </<?php echo esc_html($link_tag); ?>>
            <?php endif; ?>

            <div class="dl_single_info_box_content">
                <?php if ( $has_description_text && $show_title_description_reverse === 'yes' ) : ?>
                <<?php echo implode( ' ', [ $link_tag, $link_attributes ] ); ?> <?php echo $this->get_render_attribute_string( '_card_description_text' ); ?>><?php echo $this->get_card_settings('_card_description_text'); ?>
                </<?php echo esc_html($link_tag); ?>>
                <?php endif; ?>
                 
                <?php if ( $has_title_text ) : ?>
                 <<?php echo esc_html( dl_title_tag($this->get_card_settings('_card_title_size')) ); ?> <?php echo $this->get_render_attribute_string( '_card_title_text' ); ?>>
                 <<?php echo implode( ' ', [ $link_tag, $link_attributes ] ); ?>>
                    <?php echo esc_html( $this->get_card_settings('_card_title_text') ); ?>
                  </<?php echo esc_html($link_tag); ?>>
                </<?php echo esc_html( dl_title_tag($this->get_card_settings('_card_title_size')) ); ?>>
                <?php endif; ?>

                <?php if ( $has_description_text && $show_title_description_reverse !== 'yes' ) : ?>
                <<?php echo implode( ' ', [ $link_tag, $link_attributes ] ); ?> <?php echo $this->get_render_attribute_string( '_card_description_text' ); ?>><?php echo $this->get_card_settings('_card_description_text'); ?>
                </<?php echo esc_html($link_tag); ?>>
                <?php endif; ?>
                

                <?php if ( $has_btn_text ) : ?>
                <<?php echo implode( ' ', [ $link_tag, $link_attributes ] ); ?> <?php echo $this->get_render_attribute_string( '_card_btn_text' ); ?>><?php echo $this->get_card_settings('_card_btn_text'); ?></<?php echo $link_tag; ?>>
                <?php endif; ?>
            </div>
        </div>  
    <?php }
    
    //Layout Three
    protected function _card_box_three() {
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute( '_card_title_text', 'class', 'dl_title droit-card-title' );
        $this->add_render_attribute( '_card_image', 'class', 'droit-card-image dl_card_thumb' );
        $link_tag = 'span';
        if ( ! empty( $this->get_card_settings('_card_link')['url'] ) ) {
            $link_tag = 'a';
            $this->add_link_attributes( '_card_link', $this->get_card_settings('_card_link') );
        }

        $has_image            = ! empty( $this->get_card_settings('_card_shape_list') );
        $has_title_text       = ! empty( $this->get_card_settings('_card_title_text') );
        $has_description_text = ! empty( $this->get_card_settings('_card_description_text') );

        $link_attributes = $this->get_render_attribute_string( '_card_link' );

        $this->add_inline_editing_attributes( '_card_title_text', 'none' );
        ?>
        <div class="dl_card_box dl_card_style_05 mouse_move_animation droit-card-box-wrapper">
            <?php if ( $has_image ) : ?>
                <div class="dl_card_box_shape <?php echo $this->get_card_settings('_shape_skin');?>">
                   <?php foreach ($this->get_card_settings('_card_shape_list') as $_shape_list): ?>

                        <div class="dl_parallax_img wow slideInUp" data-wow-delay="<?php echo $_shape_list['_card_shape_delay']['size'];?>s">
                            <div class="layer layer2" data-depth="<?php echo $_shape_list['_card_shape_depth'];?>"><img src="<?php echo esc_url($_shape_list['_card_shape_image']['url']);?>" alt="<?php echo $_shape_list['_card_shape_name'];?>"></div>
                        </div>

                    <?php endforeach; ?>
                   
                </div>
            <?php endif; ?>

                <?php if ( $has_title_text ) : ?>
                 <<?php echo esc_html( dl_title_tag($this->get_card_settings('_card_title_size')) ); ?> <?php echo $this->get_render_attribute_string( '_card_title_text' ); ?>>
                 <<?php echo implode( ' ', [ $link_tag, $link_attributes ] ); ?>>
                    <?php echo esc_html( $this->get_card_settings('_card_title_text') ); ?>
                  </<?php echo esc_html($link_tag); ?>>
                </<?php echo esc_html( dl_title_tag($this->get_card_settings('_card_title_size')) ); ?>>
                <?php endif; ?>
        </div>  
    <?php }
    
    protected function content_template(){}
}
