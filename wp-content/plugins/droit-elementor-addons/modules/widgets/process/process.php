<?php
namespace DROIT_ELEMENTOR\Widgets;

if (!defined('ABSPATH')) {exit;}

class Droit_Addons_Process extends \Elementor\Widget_Base {

    // Get Control ID
	protected function get_control_id( $control_id ) {
        return $control_id;
    }

    final public function get_process_settings( $control_key ) {
        $control_id = $this->get_control_id( $control_key );
        return $this->get_settings( $control_id );
    }

    public function get_name() {
        return 'droit-process';
    }
    
    public function get_title() {
        return esc_html__( 'Process', 'droit-addons' );
    }

    public function get_icon() {
        return 'dlicons-process addons-icon';
    }

    public function get_keywords() {
        return [
            'progress',
            'bar',
            'step',
            'process',
            'dl-process',
            'dl-progress',
            'droit-process',
            'droit-progress',
            'dlprocess',
            'dlprogress',
            'droitprocess',
            'droit progress',
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
        $this->register_process_preset_controls();
        $this->register_process_content_skin_1_control();
        $this->register_process_content_skin_2_control();
        $this->_droit_register_process_general_style_controls();
        $this->_droit_register_process_icon_style_controls();
        $this->register_process_content_style_control();
        do_action('dl_widget/section/style/custom_css', $this);
      }

      //Preset
    public function register_process_preset_controls(){
    	$this->start_controls_section(
            '_blog_list_layout_section',
            [
                'label' => esc_html__('Preset', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
               
            ]
        );
    	$this->register_process_skin();
    	$this->register_process_columns_controls();
    	
        $this->end_controls_section();
    }

	//Skin
	protected function register_process_skin(){
        $this->add_control(
			'_process_skin',
			[
				'label' => esc_html__( 'Design Format', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'label_block' => false,
				'options'   => [
					'_skin_1' => 'Style 01',
					'_skin_2' => 'Style 02',
				],
				'default' => '_skin_1'
			]
		);  
	}

	//Column
    protected function register_process_columns_controls() {
        $this->add_responsive_control(
            '_process_columns',
            [
                'label' => __( 'Columns', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 4,
                'tablet_default' => 6,
                'mobile_default' => 12,
                'options' => [
                    '12' => '1',
                    '6' => '2',
                    '4' => '3',
                    '3' => '4',
                    '5' => '5',
                    '2' => '6',
                ],
                'condition' => [
					$this->get_control_id('_process_skin') => ['_skin_1']
				]
            ]
        );
    }
	// Process Content Skin 1
	public function register_process_content_skin_1_control(){
		$this->start_controls_section(
            '_dl_process_content_section',
            [
                'label' => esc_html__('Content', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
					$this->get_control_id('_process_skin') => ['_skin_1']
				]
            ]
        );
 
		$repeater = new \Elementor\Repeater();

		$repeater->start_controls_tabs( '_dl_process_repeat_tabs' );

		$repeater->start_controls_tab( '_dl_process_repeat_content',
			[ 
				'label' => esc_html__( 'Content', 'droit-addons'),
			] 
		);

		$repeater->add_control(
            '_dl_process_icon_show',
            [
                'label' => esc_html__('Enable Icon', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
                'return_value' => 'yes',
            ]
        );

		$repeater->add_control(
            '_dl_process_icon_type',
            [   
                'label' => esc_html__('Icon Type', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'none' => [
                        'title' => esc_html__('None', 'droit-addons'),
                        'icon' => 'fa fa-ban',
                    ],
                    'icon' => [
                        'title' => esc_html__('Icon', 'droit-addons'),
                        'icon' => 'eicon-user-circle-o',
                    ],
                    'image' => [
                        'title' => esc_html__('Image', 'droit-addons'),
                        'icon' => 'eicon-image',
                    ],
                ],
                'default' => 'icon',
                'condition' => [
                    $this->get_control_id( '_dl_process_icon_show' ) => [ 'yes' ],
                ],
            ]
        );

		$repeater->add_control(
            '_dl_process_selected_icon',
            [
                'label' => __( 'Icon', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fas fa-check',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    $this->get_control_id( '_dl_process_icon_show' ) => [ 'yes' ],
                    $this->get_control_id( '_dl_process_icon_type' ) => [ 'icon' ],
                ],
            ]
        );

        $repeater->add_control(
             '_dl_process_icon_image',
             [   
                 'label' => esc_html__('Image', 'droit-addons'),
                 'type' => \Elementor\Controls_Manager::MEDIA,
                 'default' => [
                     'url' => '',
                 ],
                 'condition' => [
                    $this->get_control_id( '_dl_process_icon_show' ) => [ 'yes' ],
                    $this->get_control_id( '_dl_process_icon_type' ) => [ 'image' ],
                ],
             ]
         );

         $repeater->add_control(
			'_dl_process_title',
			[
				'label' => __( 'Title', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Title Here...', 'droit-addons' ),
				'placeholder' => __( 'Enter your title', 'droit-addons' ),
				'label_block' => true,
				'separator' => 'before',
			]
		);
		
		$repeater->add_control(
			'_dl_process_description_text',
			[
				'label' => 'Description',
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => __( 'Cheeky chap hotpot blimey victoria sponge cuppa bonnet oxford squiffy!', 'droit-addons' ),
				'placeholder' => __( 'Enter your description', 'droit-addons' ),
				'show_label' => true,
                'rows' => 10,
			]
		);
		$repeater->add_control(
             '_dl_process_image',
             [   
                 'label' => esc_html__('Step Image', 'droit-addons'),
                 'type' => \Elementor\Controls_Manager::MEDIA,
                 'default' => [
                     'url' => '',
                 ],
                 
             ]
        );

		$repeater->add_control(
			'_dl_process_link',
			[
				'label' => __( 'Link', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                ],
				'placeholder' => __( 'https://your-link.com', 'droit-addons' ),
			]
		);

		$repeater->add_control(
            '_dl_process_title_size',
            [
                'label' => __( 'Title Tag', 'droit-addons' ),
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
                'separator' => 'before',
                
            ]
        );	

		$repeater->end_controls_tab();

		$repeater->start_controls_tab( '_dl_process_repeat_style',
			[ 
				'label' => esc_html__( 'Style', 'droit-addons')
			] 
		);

        $repeater->add_control(
            '_dl_process_icon_box_show',
            [
                'label'        => esc_html__('Box Shadow', 'droit-addons'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'return_value' => 'yes',
            ]
        );


		$repeater->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => '_dl_process_circle_bg_color',
                'label' => 'Circle Background',
                'types' => [ 'classic', 'gradient' ],
				'selector' => 
					'{{WRAPPER}} {{CURRENT_ITEM}}.droit-process-items .droit-process-box .droit-process-box-icon .droit-process-box-icon-inner',
				
                'separator' => 'before',
                'fields_options' => [
					'background' => [
						'label' => __( 'Background Color', 'droit-addons' ),
					],
				],
            ]
        );


		$repeater->end_controls_tab();
				
		$repeater->end_controls_tabs();

		$this->add_control(
			'_dl_process_lists',
			[
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				
				'default' => [
					[
						'_dl_process_title' => __( 'User Research', 'droit-addons' ),
					],
					[
						'_dl_process_title' => __( 'Developed App', 'droit-addons' ),
					],
					[
						'_dl_process_title' => __( 'Testing Project', 'droit-addons' ),
					],
					
				],
				
				'title_field' => '{{ _dl_process_title }}',
			]
		);

        $this->end_controls_section();   
	}

	// Process Content Skin 2
	public function register_process_content_skin_2_control(){
		$this->start_controls_section(
            '_dl_process_content_skin_2_section',
            [
                'label' => esc_html__('Content', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
					$this->get_control_id('_process_skin') => ['_skin_2']
				]
            ]
        );

		$repeater = new \Elementor\Repeater();

		$repeater->start_controls_tabs( '_dl_process_repeat_tabs' );

		$repeater->start_controls_tab( '_dl_process_repeat_content',
			[ 
				'label' => esc_html__( 'Content', 'droit-addons'),
			] 
		);

		$repeater->add_control(
            '_dl_process_icon_show',
            [
                'label'        => esc_html__('Enable Icon', 'droit-addons'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'return_value' => 'yes',
            ]
        );

		$repeater->add_control(
            '_dl_process_icon_type',
            [   
                'label' => esc_html__('Icon Type', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'none' => [
                        'title' => esc_html__('None', 'droit-addons'),
                        'icon' => 'fa fa-ban',
                    ],
                    'icon' => [
                        'title' => esc_html__('Icon', 'droit-addons'),
                        'icon' => 'eicon-user-circle-o',
                    ],
                    'image' => [
                        'title' => esc_html__('Image', 'droit-addons'),
                        'icon' => 'eicon-image',
                    ],
                ],
                'default' => 'icon',
                'condition' => [
                    $this->get_control_id( '_dl_process_icon_show' ) => [ 'yes' ],
                ],
            ]
        );

		$repeater->add_control(
            '_dl_process_selected_icon',
            [
                'label' => __( 'Icon', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fas fa-check',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    $this->get_control_id( '_dl_process_icon_show' ) => [ 'yes' ],
                    $this->get_control_id( '_dl_process_icon_type' ) => [ 'icon' ],
                ],
            ]
        );

        $repeater->add_control(
             '_dl_process_icon_image',
             [   
                 'label' => esc_html__('Image', 'droit-addons'),
                 'type' => \Elementor\Controls_Manager::MEDIA,
                 'default' => [
                     'url' => '',
                 ],
                 'condition' => [
                    $this->get_control_id( '_dl_process_icon_show' ) => [ 'yes' ],
                    $this->get_control_id( '_dl_process_icon_type' ) => [ 'image' ],
                ],
             ]
        );

        $repeater->add_control(
			'_dl_process_title',
			[
				'label' => __( 'Title', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Title Here...', 'droit-addons' ),
				'placeholder' => __( 'Enter your title', 'droit-addons' ),
				'label_block' => true,
				'separator' => 'before',
			]
		);

		$repeater->add_control(
			'_dl_process_link',
			[
				'label' => __( 'Link', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'droit-addons' ),
			]
		);

		$repeater->add_control(
            '_dl_process_title_size',
            [
                'label' => __( 'Title Tag', 'droit-addons' ),
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
                'separator' => 'before',
                
            ]
        );	

		$repeater->end_controls_tab();
				
		$repeater->end_controls_tabs();

		$this->add_control(
			'_dl_process_skin_second_lists',
			[
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				
				'default' => [
					[
						'_dl_process_title' => __( 'Title #1', 'droit-addons' ),
					],
					[
						'_dl_process_title' => __( 'Title #2', 'droit-addons' ),
					],
					[
						'_dl_process_title' => __( 'Title #3', 'droit-addons' ),
					],
					
				],
				
				'title_field' => '{{ _dl_process_title }}',
			]
		);

        $this->end_controls_section();   
	}

	//General
	public function _droit_register_process_general_style_controls(){
		$this->start_controls_section(
            '_dl_process_style_general',
            [
                'label' => esc_html__('General', 'droit-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_group_control(
	        \Elementor\Group_Control_Background::get_type(),
	        [
	            'name'  => '_dl_process_style_general_background',
	            'label' => 'Color',
	            'fields_options' => [
					'background' => [
						'label' => __( 'Background', 'droit-addons' ),
					],
				],
	            'types' => [ 'classic', 'gradient' ],
	            'selector' =>
	             	'{{WRAPPER}} .droit-process-wrapper',
	            
	        ]
	    );
        
        $this->add_responsive_control(
            '_dl_process_box_padding',
            [
                'label'      => __('Padding', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .droit-process-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => '_dl_process_box_shadow',
                'selector' => '{{WRAPPER}} .droit-process-wrapper',
                'condition' => [
					$this->get_control_id('_process_skin') => ['_skin_1']
				]
            ]
        );

        
        $this->add_control(
			'dl_process_border_radius',
			[
				'label' => __( 'Border Radius', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .dl_single_process_box.dl_style_01 .dl_process_icon_inner' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
                'condition' => [
					$this->get_control_id('_process_skin') => ['_skin_1']
				]
			]
		);

        $this->add_control(
			'dl_process_border_rotate',
			[
				'label' => __( 'Rotate', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => -360,
						'max' => 360,
						'step' => 1,
					],
					
				],
				'selectors' => [
					'{{WRAPPER}} .dl_single_process_box.dl_style_01 .dl_process_box_icon' => 'transform: rotate({{SIZE}}deg);',
				],
                'condition' => [
					$this->get_control_id('_process_skin') => ['_skin_1']
				]
			]
		);

        $this->add_responsive_control(
			'dl_show_border',
			[
				'label' => __( 'Show Border', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'your-plugin' ),
				'label_off' => __( 'Hide', 'your-plugin' ),
                'default' => 'no',
				'return_value' => 'yes',
                'condition' => [
					$this->get_control_id('_process_skin') => ['_skin_1']
				]
				
			]
		);

        $this->add_control(
			'dl_process_top_spacing',
			[
				'label'      => __( 'Top Spacing', 'droit-addons' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 1,
					],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1
                    ]
				],
				'selectors' => [
					'{{WRAPPER}} .dl_row.droit-process-wrapper.dl_show_border:after' => 'top: {{SIZE}}{{UNIT}};',
				],
                'condition' => [
                    'dl_show_border' => 'yes'
                ]
			]
		);

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => '_dl_precess_border_color_skin_2',
                'label' => esc_html__('Border', 'droit-addons'),
                'selector' => '{{WRAPPER}} .dl_row.droit-process-wrapper.dl_show_border:after',
                'condition' => [
                    'dl_show_border' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();
	}

	//Icon
	public function _droit_register_process_icon_style_controls(){
		$this->start_controls_section(
            '_dl_process_style_icon',
            [
                'label' => esc_html__('Icon', 'droit-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                
            ]
        );


        $this->add_control(
			'dl_icon_bg_height',
			[
				'label' => __( 'Box Height', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .dl_single_process_box.dl_style_01 .dl_process_icon_inner' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
			'dl_icon_bg_width',
			[
				'label' => __( 'Box Width', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .dl_single_process_box.dl_style_01 .dl_process_icon_inner' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);       

        $this->add_responsive_control(
        '_dl_process_icon_size',
        [
            'label' => __('Icon Size', 'droit-addons'),
            'type' => \Elementor\Controls_Manager::SLIDER,
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
                '{{WRAPPER}} .droit-process-items .droit-process-box .droit-process-box-icon i:not(.dl_arrow_img)' => 'font-size: {{SIZE}}{{UNIT}};',
                '{{WRAPPER}} .droit-process-items .droit-process-box .droit-process-box-icon img:not(.dl_arrow_img)' => 'width: {{SIZE}}{{UNIT}};',
                '{{WRAPPER}} .droit-process-items .droit-process-box .droit-process-box-icon svg:not(.dl_arrow_img)' => 'width: {{SIZE}}{{UNIT}};',
            ],
            
        ]);

        $this->add_responsive_control(
        '_dl_process_icon_size_shape',
        [
            'label' => __('Shape Size', 'droit-addons'),
            'type' => \Elementor\Controls_Manager::SLIDER,
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
                '{{WRAPPER}} .droit-process-items .droit-process-box .droit-process-box-icon img.dl_arrow_img' => 'width: {{SIZE}}{{UNIT}};',
            ],
            'condition' => [
                $this->get_control_id('_process_skin') => ['_skin_1']
            ]
        ]);

		$this->start_controls_tabs( '_dl_process_content_icon_style_tabs' );

		$this->start_controls_tab( 'icon_normal', [ 
			'label' => esc_html__( 'Normal', 'droit-addons'), 
            'condition' => [
                $this->get_control_id('_process_skin') => ['_skin_1']
            ]
            ] );

		$this->add_control(
			'_dl_process_content_icon_color_skin_1',
			[
				'label' => esc_html__( 'Color', 'droit-addons'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .droit-process-wrapper .droit-process-items .droit-process-box .droit-process-box-icon .droit-process-box-icon-inner i' => 'color: {{VALUE}};',

					'{{WRAPPER}} .droit-process-wrapper .droit-process-items .droit-process-box .droit-process-box-icon .droit-process-box-icon-inner svg' => 'fill: {{VALUE}};',
				],
				'condition' => [
					$this->get_control_id('_process_skin') => ['_skin_1'],
				]
			]
		);
		
		$this->end_controls_tab();

		$this->start_controls_tab( '_dl_process_content_icon_hover', 
        [ 'label' => esc_html__( 'Hover', 'droit-addons'), 
          'condition' => [
            $this->get_control_id('_process_skin') => ['_skin_1']
        ] ] );

		$this->add_control(
			'_dl_process_content_icon_hover_color_skin_1',
			[
				'label' => esc_html__( 'Color', 'droit-addons'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .droit-process-wrapper .droit-process-items .droit-process-box .droit-process-box-icon .droit-process-box-icon-inner:hover i' => 'color: {{VALUE}};',
				],
				'condition' => [
					$this->get_control_id('_process_skin') => ['_skin_1'],
				]
			]
		);

		$this->add_group_control(
	        \Elementor\Group_Control_Border::get_type(),
	        [
	            'name' => '_dl_precess_border_hover_color_skin_2',
	            'label' => esc_html__('Border', 'droit-addons'),
	            'selector' => '{{WRAPPER}} .droit-process-wrapper.droit-process-box-container-border:hover:after',
	            'condition' => [
					$this->get_control_id('_process_skin') => ['_skin_2'],
				]
	        ]
	    );
		
		$this->end_controls_tab();
		
		$this->end_controls_tabs();

        $this->end_controls_section();
	}

	// Process Style
	public function register_process_content_style_control(){
		$this->start_controls_section(
            '_dl_process_content_style_section',
            [
                'label'     => __('Content', 'droit-addons'),
                'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
                
            ]
        );
        
        $this->add_control(
            '_dl_process_content_title_heading',
            [
                'label' => __( 'Title', 'droit-addons' ),
                'type'  => \Elementor\Controls_Manager::HEADING,
            ]
        );
		$this->start_controls_tabs( '_dl_process_content_title_style_tabs' );

		$this->start_controls_tab( 
            'title_normal', 
            [ 
                'label' => esc_html__( 'Normal', 'droit-addons'),
                'condition' => [
					$this->get_control_id('_process_skin') => ['_skin_1']
				]
            ]            
         );

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
             'name' => '_dl_process_content_title_typography',
				'selector' => '{{WRAPPER}} .droit-process-items .droit-process-box .droit-process-title > a',
			]
		);
		
		$this->add_control(
			'_dl_process_content_title_color',
			[
				'label' => esc_html__( 'Color', 'droit-addons'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dl_single_process_box .dl_title span' => 'color: {{VALUE}};',
				],
                'condition' => [
					$this->get_control_id('_process_skin') => ['_skin_2']
				]
			]
		);

        $this->add_control(
			'_dl_process_content_title_col',
			[
				'label' => esc_html__( 'Color', 'droit-addons'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dl_single_process_box .dl_title a' => 'color: {{VALUE}};',
				],
                'condition' => [
					$this->get_control_id('_process_skin') => ['_skin_1']
				]
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab( '_dl_process_content_title_hover', [ 
			'label' => esc_html__( 'Hover', 'droit-addons'),
			'condition' => [
					$this->get_control_id('_process_skin') => ['_skin_1']
				]

			 ] );

		$this->add_control(
			'_dl_process_content_title_hover_color',
			[
				'label' => esc_html__( 'Color', 'droit-addons'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .droit-process-items .droit-process-box .droit-process-title > a:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					$this->get_control_id('_process_skin') => ['_skin_1']
				]
			]
		);
		
		$this->end_controls_tab();
		
		$this->end_controls_tabs();

		//content tab

        $this->add_control(
            '_dl_process_content_heading',
            [
                'label' => __( 'Content', 'droit-addons' ),
                'type'  => \Elementor\Controls_Manager::HEADING,
                'condition' => [
					$this->get_control_id('_process_skin') => ['_skin_1']
				]
            ]
        );

		$this->start_controls_tabs( '_dl_process_content_style_tabs' );

		$this->start_controls_tab( 'content_normal', [ 
				'label' => esc_html__( 'Normal', 'droit-addons'),
				'condition' => [
					$this->get_control_id('_process_skin') => ['_skin_1']
				]
			] 
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
             'name' => '_dl_process_content_typography',
				'selector' => '{{WRAPPER}} .droit-process-items .droit-process-box .droit-process-desc',
				'condition' => [
					$this->get_control_id('_process_skin') => ['_skin_1']
				]
			]
		);
		
		$this->add_control(
			'_dl_process_content_color',
			[
				'label' => esc_html__( 'Color', 'droit-addons'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .droit-process-items .droit-process-box .droit-process-desc' => 'color: {{VALUE}};',
				],
				'condition' => [
					$this->get_control_id('_process_skin') => ['_skin_1']
				]
			]
		);
		
		$this->end_controls_tab();

		$this->start_controls_tab( '_dl_process_content_hover', [ 
			'label' => esc_html__( 'Hover', 'droit-addons'), 
			'condition' => [
					$this->get_control_id('_process_skin') => ['_skin_1']
				]
			] 
		);

		$this->add_control(
			'_dl_process_content_hover_color',
			[
				'label' => esc_html__( 'Color', 'droit-addons'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .droit-process-items .droit-process-box .droit-process-desc:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					$this->get_control_id('_process_skin') => ['_skin_1']
				]
			]
		);
		
		$this->end_controls_tab();
		
		$this->end_controls_tabs();
		
        $this->end_controls_section();
    }
  
      //Html render
      protected function render(){
          $settings = $this->get_settings_for_display();
  
          $_process_skin  = !empty($this->get_process_settings('_process_skin')) ? $this->get_process_settings('_process_skin') : '_skin_1';
  
          switch ($_process_skin) {
              case '_skin_1':
                  $this->_first_process_layout();
                  break; 
              case '_skin_2':
                  $this->_second_process_layout();
                  break;
              default:
                  $this->_first_process_layout();
                  break;
  
          }
      }
  
      // process first
      protected function _first_process_layout(){
        $settings = $this->get_settings_for_display();
        extract($settings);
  
      ?>
      <div class="dl_row droit-process-wrapper <?php if($dl_show_border === 'yes'){echo 'dl_show_border';} ?>">
          <?php foreach ($this->get_process_settings('_dl_process_lists') as $index => $item):
              $item_count = $index + 1;
              $migrated = isset( $item['__fa4_migrated']['_dl_process_selected_icon'] );


  
              if ( ! isset( $item['icon'] ) && ! \ELEMENTOR\Icons_Manager::is_migration_allowed() ) {
                  $item['icon'] = 'fas fa-check';
              }
  
              $is_new = empty( $item['icon'] ) && \ELEMENTOR\Icons_Manager::is_migration_allowed();
              $has_icon = ( ! $is_new || ! empty( $item['_dl_process_selected_icon']['value'] ) );
  
              $has_title_text = ! empty( $item['_dl_process_title'] );
              $has_dec_text = ! empty( $item['_dl_process_description_text'] );
              $has_image = ! empty( $item['_dl_process_image']['url'] );
  
              $columns = !empty($this->get_process_settings('_process_columns')) ? $this->get_process_settings('_process_columns') : 3;
              $process_link_setting_key = $this->get_repeater_setting_key( '_dl_process_link', '_dl_process_lists', $index );
              $link_tag = 'span';
  
              if ( ! empty( $item['_dl_process_link']['url'] ) ) {
                  $link_tag = 'a';
                  $this->add_link_attributes( $process_link_setting_key, $item['_dl_process_link'] );
              }
              $link_attributes = $this->get_render_attribute_string( $process_link_setting_key );
              $tab_title_setting_key = $this->get_repeater_setting_key( '_dl_process_title', '_dl_process_lists', $index );
              $this->add_render_attribute( $tab_title_setting_key, [
                  'id' => 'process-' . $item['_id'],
                  'class' => [ "dl_col_lg_{$columns}", 'dl_col_sm_6', 'droit-process-items', "elementor-repeater-item-{$item['_id']}" ],
                  'data-item' => $item_count,
              ] );
           ?>
          <div <?php echo $this->get_render_attribute_string( $tab_title_setting_key ); ?>>
              <div class="dl_single_process_box dl_style_01 droit-process-box">
                  <div class="dl_process_box_icon droit-process-box-icon">
                      <div class="dl_process_icon_inner dl_color_01 droit-process-box-icon-inner <?php if( $item['_dl_process_icon_box_show'] === 'yes' ){echo 'dl_process_shadow';} ?>">
                          <?php 
                              if ($item['_dl_process_icon_show'] === 'yes' ) {
                                  if($item['_dl_process_icon_type'] == 'icon'){
                                      if ( $is_new || $migrated ) { ?>
                                         <?php \ELEMENTOR\Icons_Manager::render_icon( $item['_dl_process_selected_icon'] ); ?>
                                     <?php }
                                  }elseif( $item['_dl_process_icon_type'] == 'image' ){ ?>
                                      <img src="<?php echo esc_url($item['_dl_process_icon_image']['url']); ?>" alt="<?php echo esc_attr( get_post_meta($item['_dl_process_icon_image']['id'], '_wp_attachment_image_alt', true) ); ?>">
                                 <?php }  
                              }
                          ?>
                      </div>
                      <?php if ( $has_image ): ?>
                          <img src="<?php echo $item['_dl_process_image']['url']; ?>" alt="<?php echo esc_attr( get_post_meta($item['_dl_process_image']['id'], '_wp_attachment_image_alt', true) ); ?>" class="dl_arrow_img">
                      <?php endif ?>
                  </div>
                  <?php if ( $has_title_text ) : ?>
                      <<?php echo dl_title_tag($item['_dl_process_title_size']); ?> class="dl_title droit-process-title">
                      <<?php echo implode( ' ', [ $link_tag, $link_attributes ] ); ?>>
                      <?php echo do_shortcode($item['_dl_process_title']); ?>
                       </<?php echo esc_html( $link_tag ); ?>>
                      </<?php echo dl_title_tag($item['_dl_process_title_size']); ?>>
                  <?php endif; ?>
                  <?php if ($has_dec_text): ?>
                      <p class="dl_desc droit-process-desc">
                          <?php echo do_shortcode($item['_dl_process_description_text']); ?>
                      </p>
                  <?php endif; ?>
              </div>
          </div>
          <?php endforeach; ?>
      </div>
    <?php }
      
    // process second
    protected function _second_process_layout(){
        $settings = $this->get_settings_for_display();
      ?>
      <div class="dl_process_box_container dl_process_box_container_border droit-process-wrapper droit-process-box-container-border">
          <?php foreach ($this->get_process_settings('_dl_process_skin_second_lists') as $index => $item):
              $item_count = $index + 1;
              $migrated = isset( $item['__fa4_migrated']['_dl_process_selected_icon'] );
  
              if ( ! isset( $item['icon'] ) && ! \ELEMENTOR\Icons_Manager::is_migration_allowed() ) {
                  $item['icon'] = 'fas fa-check';
              }
  
              $is_new = empty( $item['icon'] ) && \ELEMENTOR\Icons_Manager::is_migration_allowed();
              $has_icon = ( ! $is_new || ! empty( $item['_dl_process_selected_icon']['value'] ) );
  
              $has_title_text = ! empty( $item['_dl_process_title'] );
              $process_link_setting_key = $this->get_repeater_setting_key( '_dl_process_link', '_dl_process_lists', $index );
              $link_tag = 'span';
              if ( ! empty( $item['_dl_process_link']['url'] ) ) {
                  $link_tag = 'a';
                  $this->add_link_attributes( $process_link_setting_key, $item['_dl_process_link'] );
              }
              $link_attributes = $this->get_render_attribute_string( $process_link_setting_key );
              $tab_title_setting_key = $this->get_repeater_setting_key( '_dl_process_title', '_dl_process_skin_second_lists', $index );
              $this->add_render_attribute( $tab_title_setting_key, [
                  'id' => 'process-' . $item['_id'],
                  'class' => [ 'dl_process_box_colum', 'droit-process-items' ],
                  'data-item' => $item_count,
              ] );
           ?>
          <div <?php echo $this->get_render_attribute_string( $tab_title_setting_key ); ?>>
              <div class="dl_single_process_box dl_style_02 droit-process-box">
                  <div class="dl_icon droit-process-box-icon">
                      <?php 
                          if ($item['_dl_process_icon_show'] === 'yes' ) {
                              if($item['_dl_process_icon_type'] == 'icon'){
                                  if ( $is_new || $migrated ) { ?>
                                     <?php \ELEMENTOR\Icons_Manager::render_icon( $item['_dl_process_selected_icon'] ); ?>
                                 <?php }
                              }elseif( $item['_dl_process_icon_type'] == 'image' ){ ?>
                                  <img src="<?php echo esc_url($item['_dl_process_icon_image']['url']); ?>" alt="<?php echo esc_attr( get_post_meta($item['_dl_process_icon_image']['id'], '_wp_attachment_image_alt', true) ); ?>">
                             <?php }  
                          }
                      ?>
                  </div>
                  <div class="dl_separator_pointer droit-process-separator"></div>
                  <?php if ( $has_title_text ) : ?>
                      <<?php echo dl_title_tag($item['_dl_process_title_size']); ?> class="dl_title droit-process-title">
                       <<?php echo implode( ' ', [ $link_tag, $link_attributes ] ); ?>>
                       <?php echo do_shortcode($item['_dl_process_title']); ?>
                    </<?php echo esc_html( $link_tag ); ?>>
                      </<?php echo dl_title_tag($item['_dl_process_title_size']); ?>>
                  <?php endif; ?>
                 
              </div>
          </div>
          <?php endforeach; ?>
      </div>
    <?php }
      
  
  
    protected function content_template(){}
}