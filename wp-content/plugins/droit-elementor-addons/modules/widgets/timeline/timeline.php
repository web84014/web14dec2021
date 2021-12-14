<?php
namespace DROIT_ELEMENTOR\Widgets;

if (!defined('ABSPATH')) {exit;}

class Droit_Addons_Timeline extends \Elementor\Widget_Base {

    // Get Control ID
	protected function get_control_id( $control_id ) {
        return $control_id;
    }

    final public function get_timeline_settings( $control_key ) {
        $control_id = $this->get_control_id( $control_key );
        return $this->get_settings( $control_id );
    }

    public function get_name() {
        return 'droit-timeline';
    }
    
    public function get_title() {
        return esc_html__( 'Timeline', 'droit-addons' );
    }

    public function get_icon() {
        return 'dlicons-timeline addons-icon';
    }

    public function get_keywords() {
        return [
            'timeline',
            'timelines',
            'droit timeline',
            'droit timelines',
            'dl timeline',
            'dl timelines',
            'content',
            'droit content',
            'dl content',
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
        $this->register_timeline_content_skin_2_controls();
        $this->register_timeline_options_controls();
        $this->register_timeline_general_style_controls();
        $this->register_timeline_icon_style_controls();
        $this->register_timeline_border_line_style_controls();
        $this->register_timeline_content_style_control();
        do_action('dl_widget/section/style/custom_css', $this);
    }

    //Content Skin one
    public function register_timeline_content_skin_2_controls(){
        $this->start_controls_section(
            '_dl_timeline_content_skin_2_layout_section',
            [
                'label' => esc_html__('Content', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->register_timeline_repeater_for_second_layout();

        $this->end_controls_section();
    }

    // Content Repeater
    protected function register_timeline_repeater_for_second_layout(){
        
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            '_dl_timeline_title',
            [
                'label' => __( 'Title', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Title Here...', 'droit-addons' ),
                'placeholder' => __( 'Enter your title', 'droit-addons' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            '_dl_timeline_desc',
            [
                'label' => 'Description',
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptates eligendiniour dignissimos ads',
                'placeholder' => __( 'Enter your description', 'droit-addons' ),
                'show_label' => true,
                'rows' => 10,
            ]
        );

        $repeater->add_control(
            '_dl_timeline_icon_show',
            [
                'label' => esc_html__('Enable Icon', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
                'return_value' => 'yes',
            ]
        );

        $repeater->add_control(
            '_dl_timeline_icon_type',
            [   
                'label'       => esc_html__('Icon Type', 'droit-addons'),
                'type'        => \Elementor\Controls_Manager::CHOOSE,
                'label_block' => false,
                'options'     => [
                    'none' => [
                        'title' => esc_html__('None', 'droit-addons'),
                        'icon'  => 'fa fa-ban',
                    ],
                    'icon' => [
                        'title' => esc_html__('Icon', 'droit-addons'),
                        'icon'  => 'eicon-user-circle-o',
                    ],
                    'image' => [
                        'title' => esc_html__('Image', 'droit-addons'),
                        'icon'  => 'eicon-image',
                    ],
                ],
                'default' => 'icon',
                'condition' => [
                    $this->get_control_id( '_dl_timeline_icon_show' ) => [ 'yes' ],
                ],
            ]
        );

        $repeater->add_control(
            '_dl_timeline_selected_icon',
            [
                'label' => __( 'Icon', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fas fa-check',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    $this->get_control_id( '_dl_timeline_icon_show' ) => [ 'yes' ],
                    $this->get_control_id( '_dl_timeline_icon_type' ) => [ 'icon' ],
                ],
            ]
        );

        $repeater->add_control(
             '_dl_timeline_icon_image',
             [   
                 'label' => esc_html__('Image', 'droit-addons'),
                 'type' => \Elementor\Controls_Manager::MEDIA,
                 'default' => [
                     'url' => '',
                 ],
                 'condition' => [
                 	$this->get_control_id( '_dl_timeline_icon_show' ) => [ 'yes' ],
                    $this->get_control_id( '_dl_timeline_icon_type' ) => [ 'image' ],
                ],
             ]
        );

        $repeater->add_control(
			'_dl_timeline_style',
			[
				'label' => __('Time', 'droit-addons'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'timeline_calender' => __('Calender', 'droit-addons'),
					'timeline_text' => __('Text', 'droit-addons'),
				],
				'default' => 'timeline_calender',
				'style_transfer' => true,
			]
		);

		$repeater->add_control(
			'_dl_timeline_time',
			[
				'label' => __('Calender', 'droit-addons'),
				'show_label' => false,
				'type' => \Elementor\Controls_Manager::DATE_TIME,
				'default' => date('M d Y g:i a'),
				'condition' => [
					$this->get_control_id('_dl_timeline_style') => ['timeline_calender'],
				],
			]
		);

		$repeater->add_control(
			'_dl_timeline_time_text',
			[
				'label' => __('Text Time', 'droit-addons'),
				'show_label' => false,
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __('2020 - 2021', 'droit-addons'),
				'placeholder' => __('Text Time', 'droit-addons'),
				'condition' => [
					$this->get_control_id('_dl_timeline_style') => ['timeline_text'],
				],
			]
		);

        $repeater->add_control(
            '_dl_timeline_content_date_ofset',
            [
                'label'        => __('Offset', 'droit-addons'),
                'type'         => \Elementor\Controls_Manager::POPOVER_TOGGLE,
                'label_on'     => __('Custom', 'droit-addons'),
                'label_off'    => __('None', 'droit-addons'),
                'return_value' => 'yes',
                
            ]
        );

		$repeater->start_popover();

        $repeater->add_responsive_control(
            'content_date_offset_x',
            [
                'label'       => __('Offset Left', 'droit-addons'),
                'type'        => \Elementor\Controls_Manager::SLIDER,
                'size_units'  => ['px', '%', 'em', 'rem'],
                'condition'   => [
                    '_dl_timeline_content_date_ofset' => 'yes',
                ],
                'range'       => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ]
                ],
                'selectors'  => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .dl_timeline_coutent_inner' => 'left: {{SIZE}}{{UNIT}};', 
                    
                ],
            ]
        );

        $repeater->add_responsive_control(
            'content_date_offset_y',
            [
                'label'      => __('Offset Top', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'condition'  => [
                    '_dl_timeline_content_date_ofset' => 'yes',
                ],
                'range'      => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ]
                ],
                'selectors'  => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .dl_timeline_coutent_inner' => 'top: {{SIZE}}{{UNIT}};',
                   
                ],
                
            ]
        );

        $repeater->end_popover();

        $repeater->add_control(
            '_dl_timeline_title_size',
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

        $this->add_control(
            '_dl_timeline_items_skin_second',
            [
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default' => [
                    [
                        '_dl_timeline_title' => __( 'Title #1', 'droit-addons' ),
                        
                        '_dl_timeline_desc' =>__( 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptates eligendiniour dignissimos ads', 'droit-addons' ),
                    ],
                    [
                        '_dl_timeline_title' => __( 'Title #2', 'droit-addons' ),

                        '_dl_timeline_desc' =>__( 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptates eligendiniour dignissimos ads', 'droit-addons' ),
                    ],
                    [
                        '_dl_timeline_title' => __( 'Title #3', 'droit-addons' ),

                        '_dl_timeline_desc' =>__( 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptates eligendiniour dignissimos ads', 'droit-addons' ),
                    ],
                    [
                        '_dl_timeline_title' => __( 'Title #4', 'droit-addons' ),

                        '_dl_timeline_desc' =>__( 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptates eligendiniour dignissimos ads', 'droit-addons' ),
                    ],
                ],

                'title_field' => '{{ _dl_timeline_title }}',
            ]
        );
    }

    //Options
    public function register_timeline_options_controls(){
        $this->start_controls_section(
            '_dl_timeline_options_layout_section',
            [
                'label' => esc_html__('Options', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT, 
            ]
        );

        $this-> register_option_controls();
       

        $this->end_controls_section();
    }

    // Options Control
    protected function register_option_controls(){
    	$this->add_control(
			'show_title',
			[
				'label' => __('Show Title?', 'droit-addons'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'droit-addons'),
				'label_off' => __('Hide', 'droit-addons'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

    	$this->add_control(
			'show_desc',
			[
				'label' => __('Show Description?', 'droit-addons'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'droit-addons'),
				'label_off' => __('Hide', 'droit-addons'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

    	$this->add_control(
			'show_date_time',
			[
				'label' => __('Show Date Time?', 'droit-addons'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'droit-addons'),
				'label_off' => __('Hide', 'droit-addons'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

    	$this->add_control(
			'show_date',
			[
				'label' => __('Show Date?', 'droit-addons'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'droit-addons'),
				'label_off' => __('Hide', 'droit-addons'),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					$this->get_control_id('show_date_time') => ['yes'],
				],
			]
		);

		$this->add_control(
			'show_time',
			[
				'label' => __('Show Time?', 'droit-addons'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'droit-addons'),
				'label_off' => __('Hide', 'droit-addons'),
				'return_value' => 'yes',
				'default' => '',
				'condition' => [
					$this->get_control_id('show_date_time') => ['yes'],
				],
			]
		);
		
		$this->add_control(
			'date_format',
			[
				'label' => __('Date Format', 'droit-addons'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'd M Y' => date("d M Y"),
					'm.d.y' => date("m.d.y"),
					'j, n, Y' => date("j, n, Y"),
					'Ymd' => date("Ymd"),
					'D M j, Y' => date("D M j, Y"),
					'F j, Y' => date("F j, Y"),
					'j M, Y' => date("j M, Y"),
					'Y-m-d' => date("Y-m-d"),
					'Y/m/d' => date("Y/m/d"),
				],
				'default' => 'd M Y',
				'condition' => [
					$this->get_control_id('show_date_time') => ['yes'],
					$this->get_control_id('show_date') => ['yes'],
				],
			]
		);

		$this->add_control(
			'time_format',
			[
				'label' => __('Time Format', 'droit-addons'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'g:i a' => date("g:i a"),
					'g:i A' => date("g:i A"),
					'g:i' => date("g:i"),
					'G:i a' => date("G:i a"),
					'G:i A' => date("G:i A"),
					'G:i' => date("G:i"),
					'H:i:s a' => date("H:i:s a"),
					'H:i:s A' => date("H:i:s A"),
					'H:i:s' => date("H:i:s"),
					'H:m:s a' => date("H:m:s a"),
					'H:m:s A' => date("H:m:s A"),
					'H:m:s' => date("H:m:s"),
				],
				'default' => 'g:i a',
				'condition' => [
					$this->get_control_id('show_date_time') => ['yes'],
					$this->get_control_id('show_time') => ['yes'],
				],
			]
		);

		$this->add_control(
			'show_content_arrow',
			[
				'label' => __('Show Content Arrow?', 'droit-addons'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'show' => __('Show', 'droit-addons'),
					'hide' => __('Hide', 'droit-addons'),
				],
				'default' => 'show',
				'prefix_class' => 'droit-content-arrow-',
			]
		);

		$this->add_control(
			'icon_box_align',
			[
				'label' => __('Icon Box Alignment', 'droit-addons'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'top' => [
						'title' => __('Top', 'droit-addons'),
						'icon' => 'eicon-v-align-top',
					],
					'center' => [
						'title' => __('Center', 'droit-addons'),
						'icon' => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title' => __('Bottom', 'droit-addons'),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'toggle' => false,
				'default' => 'top',
				'prefix_class' => 'droit-timeline-icon-align-',
			]
		);
    }

    protected function register_responsive_controls() {
        $this->add_control(
            'dl_breakpoints_enable_free',
            [
                'label'        => esc_html__('Responsive', 'droit-addons-pro'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'droit-addons-pro'),
                'label_off'    => esc_html__('No', 'droit-addons-pro'),
                'return_value' => 'yes',
                'default'      => 'label_off',
                'separator'    => 'before'
            ]
        );
        
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'dl_breakpoints_width',
            [
                'label'   => __('Max Width', 'droit-addons-pro'),
                'type'    => \Elementor\Controls_Manager::NUMBER,
                'min'     => 0,
                'max'     => 3000,
                'step'    => 1,
                'default' => '',
            ]
        );
        $repeater->add_control(
            'dl_breakpoints_perpage',
            [
                'label'   => __('Slides Per View', 'droit-addons-pro'),
                'type'    => \Elementor\Controls_Manager::NUMBER,
                'min'     => 0,
                'max'     => 10,
                'step'    => 1,
                'default' => 1,
            ]
        );
        $repeater->add_control(
            'dl_breakpoints_space',
            [
                'label'   => __('Space Between', 'droit-addons-pro'),
                'type'    => \Elementor\Controls_Manager::NUMBER,
                'min'     => 0,
                'max'     => 1000,
                'step'    => 1,
                'default' => 30,
            ]
        );
        $repeater->add_control(
            'dl_breakpoints_center',
            [
                'label'        => esc_html__('Center', 'droit-addons-pro'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'droit-addons-pro'),
                'label_off'    => esc_html__('No', 'droit-addons-pro'),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );
        
        $this->add_control(
            'dl_breakpoints_free',
            [
                'label'      => __('Content', 'droit-addons-pro'),
                'show_label' => false,
                'type'       => \Elementor\Controls_Manager::REPEATER,
                'fields'     => $repeater->get_controls(),
                'default'    => [
                    [
                        'dl_breakpoints_width' => 1440,
                        'dl_breakpoints_perpage' => 1,
                        'dl_breakpoints_space' => 30,
                    ],
                    [
                        'dl_breakpoints_width' => 1024,
                        'dl_breakpoints_perpage' => 1,
                        'dl_breakpoints_space' => 30,
                    ],
                    [
                        'dl_breakpoints_width' => 768,
                        'dl_breakpoints_perpage' => 1,
                        'dl_breakpoints_space' => 30,
                    ],
                    [
                        'dl_breakpoints_width' => 576,
                        'dl_breakpoints_perpage' => 1,
                        'dl_breakpoints_space' => 30,
                    ],

                ],
                'title_field' => 'Max Width: {{{ dl_breakpoints_width }}}',
                'condition' => [
                    'dl_breakpoints_enable_free' => ['yes'],
                ],
            ]
        );
        
    } 

    // General Control
     public function register_timeline_general_style_controls(){
        $this->start_controls_section(
            '_dl_timeline_general_style_layout_section',
            [
                'label' => esc_html__('General', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            '_dl_timeline_margin',
            [
                'label' => esc_html__('Margin', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .droit-timeline-section .droit-timeline-section-inner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],

            ]
        );
       

        $this->end_controls_section();
    }
    // Icon Control
    public function register_timeline_icon_style_controls(){
        $this->start_controls_section(
            '_dl_timeline_icon_style_layout_section',
            [
                'label' => esc_html__('Icon Box', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE, 
            ]
        );
        $this->register_icon_controls();

        $this->end_controls_section();
    }

    protected function register_icon_controls() {
        $this->add_control(
			'dl_timeline_item_bg_width',
			[
				'label'      => __( 'Box Width', 'droit-addons' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
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
					'{{WRAPPER}} .dl_timeline_section.dl_timeline_default_style .dl_limeline_counter' => 'width: {{SIZE}}{{UNIT}};',
				],
                
			]
		);

        $this->add_control(
			'dl_timeline_item_bg_height',
			[
				'label'      => __( 'Box Height', 'droit-addons' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
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
					'{{WRAPPER}} .dl_timeline_section.dl_timeline_default_style .dl_limeline_counter' => 'height: {{SIZE}}{{UNIT}};',
				],
                
			]
		);

        $this->add_responsive_control(
            '_dl_timeline_icon_height_size',[
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
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .droit-timeline-section .droit-timeline-inner-wraper .droit-timeline-counter i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .droit-timeline-section .droit-timeline-inner-wraper .droit-timeline-counter img' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .droit-timeline-section .droit-timeline-inner-wraper .droit-timeline-counter svg' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
                    
                    '{{WRAPPER}} .droit-timeline-section .droit-timeline-inner-wraper .droit-timeline-counter img' => '',
                    '{{WRAPPER}} .droit-timeline-section .droit-timeline-inner-wraper .droit-timeline-counter svg' => '',
                ],
                
            ]
        );

    	$this->add_responsive_control(
			'_dl_timeline_icon_rotate', [
				'label' => __( 'Rotate', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'deg' ],
				'default' => [
					'size' => 0,
					'unit' => 'deg',
				],
				'tablet_default' => [
					'unit' => 'deg',
				],
				'mobile_default' => [
					'unit' => 'deg',
				],
				'selectors' => [
					'{{WRAPPER}} .droit-timeline-section .droit-timeline-inner-wraper .droit-timeline-counter i, {{WRAPPER}} .droit-timeline-section .droit-timeline-inner-wraper .droit-timeline-counter svg' => 'transform: rotate({{SIZE}}{{UNIT}});',
				],
				
			]
		);

    	$this->add_control(
			'_dl_timeline_icon_color_skin_2',
			[
				'label' => esc_html__( 'Icon Color', 'droit-addons'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .droit-timeline-section .droit-timeline-inner-wraper .droit-timeline-counter i' => 'color: {{VALUE}};',

					'{{WRAPPER}} .droit-timeline-section .droit-timeline-inner-wraper .droit-timeline-counter svg' => 'fill: {{VALUE}};',
				],
				
			]
		);

		$this->add_group_control(
	        \Elementor\Group_Control_Background::get_type(),
	        [
	            'name' => '_dl_timeline_icon_background',
	            'label' => 'Color',
	            'fields_options' => [
					'background' => [
						'label' => __( 'Icon Background', 'droit-addons' ),
					],
				],
	            'types' => [ 'classic', 'gradient' ],
	            'selector' =>
	             	'{{WRAPPER}} .droit-timeline-section .droit-timeline-inner-wraper .droit-timeline-counter',
	            
	        ]
	    );

        
		$this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => '_dl_timeline_icon_border',
                'label' => esc_html__('Border', 'droit-addons'),
                'selector' => '{{WRAPPER}} .droit-timeline-section .droit-timeline-inner-wraper .droit-timeline-counter, {{WRAPPER}} .droit-timeline-section .dl_timeline_inner .droit-timeline-inner-wraper span.droit-bullet-top',
            ]
        );

        $this->add_control(
            '_dl_timeline_icon_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .dl_timeline_section.dl_style_01 .dl_limeline_counter' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
    }
    
    // Border Control
    public function register_timeline_border_line_style_controls() {
        $this->start_controls_section(
            '_dl_timeline_border_line_style_layout_section',
            [
                'label' => esc_html__('Border line', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE, 
            ]
        );
        $this->register_icon_border_line_controls();

        $this->end_controls_section();
    }

    protected function register_icon_border_line_controls(){
		$this->add_group_control(
          \Elementor\Group_Control_Border::get_type(),
	            [
	                'name' => '_dl_timeline_border_color_skin_2',
	                'label' => esc_html__('Border', 'droit-addons'),
	                'selector' => '{{WRAPPER}} .droit-timeline-section .droit-timeline-section-inner:before',
	                  
	            ]
      	);

		$this->add_responsive_control(
	        '_dl_timeline_border_position',
	        [
	            'label' => __('Position', 'droit-addons'),
	            'type' => \Elementor\Controls_Manager::SLIDER,
	            'default' => [
	                'size' => '',
	                'unit' => 'px',
	            ],
	            'size_units' => ['px'],
	            'range' => [
	                'px' => [
	                    'min' => -100,
	                    'max' => 100,
	                    'step' => 1,
	                ],
	            ],
	            'selectors' => [
	                '{{WRAPPER}} .droit-timeline-section .droit-timeline-section-inner:before' => 'margin-left: {{SIZE}}{{UNIT}};',
	            ],
	            
	            
	        ]
		);
    }

    // timeline Style
	public function register_timeline_content_style_control(){
		$this->start_controls_section(
            '_dl_timeline_content_style_section',
            [
                'label'     => __('Content', 'droit-addons'),
                'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_group_control(
	        \Elementor\Group_Control_Background::get_type(),
	        [
	            'name'  => '_dl_timeline_icon_box_background',
	            'label' => 'Color',
	            'fields_options' => [
					'background' => [
						'label' => __( 'Background', 'droit-addons' ),
					],
				],
	            'types' => [ 'classic', 'gradient' ],
	            'selector' =>
	             	'{{WRAPPER}} .dl_timeline_section.dl_style_01 .dl_timeline_main_coutent_inner',
	            
	        ]
	    );

        $this->add_group_control(
	        \Elementor\Group_Control_Background::get_type(),
	        [
	            'name'  => '_dl_timeline_icon_shape_background',
	            'label' => 'Color',
	            'fields_options' => [
					'background' => [
						'label' => __( 'Shape Background', 'droit-addons' ),
					],
				],
	            'types' => [ 'classic', 'gradient' ],
	            'selector' =>
                    '{{WRAPPER}} .dl_timeline_section.dl_style_01 .dl_timeline_main_coutent_inner:before, {{WRAPPER}} .dl_timeline_section.dl_style_01 .dl_limeline_section_inner_wrapper:nth-child(even) .dl_timeline_main_coutent_inner:before'   
	        ]
	    );

        $this->add_responsive_control(
            '_dl_timeline_nav_normal_padding',
            [
                'label'      => esc_html__('Padding', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .dl_timeline_section.dl_style_01 .dl_timeline_main_coutent_inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

		$this->add_control(
            '_dl_timeline_content_title_heading',
            [
                'label'     => __( 'Title Text', 'droit-addons' ),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
					$this->get_control_id('show_title') => ['yes'],
				],
            ]
        );

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
            'name'      => '_dl_timeline_content_title_typography',
			'selector'  => '{{WRAPPER}} .droit-timeline-section .droit-timeline-section-inner .droit-timeline-inner-wraper .droit-timeline-title',
			'condition' => [
					$this->get_control_id('show_title') => ['yes'],
				],
			]
		);
		
		$this->add_control(
			'_dl_timeline_content_title_color',
			[
				'label'     => esc_html__( 'Color', 'droit-addons'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .droit-timeline-section .droit-timeline-section-inner .droit-timeline-inner-wraper .droit-timeline-title' => 'color: {{VALUE}};',
				],
				'condition' => [
					$this->get_control_id('show_title') => ['yes'],
				],
			]
		);

		//content tab

		$this->add_control(
            '_dl_timeline_content_heading',
            [
                'label'     => __( 'Content', 'droit-addons' ),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
					$this->get_control_id('show_desc') => ['yes'],
				],
            ]
        );

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
             'name'     => '_dl_timeline_content_typography',
			'selector'  => '{{WRAPPER}} .droit-timeline-section .droit-timeline-section-inner .droit-timeline-inner-wraper .droit-timeline-content, .droit-timeline-section .droit-timeline-section-inner .droit-timeline-inner-wraper .droit-timeline-content p',
			'condition' => [
					$this->get_control_id('show_desc') => ['yes'],
				],
			]
		);
		
		$this->add_control(
			'_dl_timeline_content_color',
			[
				'label'     => esc_html__( 'Color', 'droit-addons'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .droit-timeline-section .droit-timeline-section-inner .droit-timeline-inner-wraper .droit-timeline-content, .droit-timeline-section .droit-timeline-section-inner .droit-timeline-inner-wraper .droit-timeline-content p' => 'color: {{VALUE}};',
				],
				'condition' => [
					$this->get_control_id('show_desc') => ['yes'],
				],
			]
		);
		
		$this->add_control(
            '_dl_timeline_content_ofset',
            [
                'label'        => __('Offset', 'droit-addons'),
                'type'         => \Elementor\Controls_Manager::POPOVER_TOGGLE,
                'label_on'     => __('Custom', 'droit-addons'),
                'label_off'    => __('None', 'droit-addons'),
                'return_value' => 'yes',
                'condition' => [
					$this->get_control_id('show_desc') => ['yes'],
				],
            ]
        );
		$this->start_popover();

        $this->add_responsive_control(
            'content_offset_x',
            [
                'label'       => __('Offset Left', 'droit-addons'),
                'type'        => \Elementor\Controls_Manager::SLIDER,
                'size_units'  => ['px', '%', 'em', 'rem'],
                'condition'   => [
                	$this->get_control_id('show_desc') => ['yes'],
                    $this->get_control_id('_dl_timeline_content_ofset') => [ 'yes' ]
                ],
                'range'       => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'render_type' => 'ui',
            ]
        );

        $this->add_responsive_control(
            'content_offset_y',
            [
                'label'      => __('Offset Top', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'condition'  => [
                	$this->get_control_id('show_desc') => ['yes'],
                    $this->get_control_id('_dl_timeline_content_ofset') => [ 'yes' ]
                ],
                'range'      => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .droit-timeline-section .droit-timeline-section-inner .droit-timeline-inner-wraper .droit-timeline-content' => 'margin-top: {{SIZE}}{{UNIT}};',
                    '(desktop){{WRAPPER}} .droit-timeline-section .droit-timeline-section-inner .droit-timeline-inner-wraper .droit-timeline-content'  => '-ms-transform: translate({{content_offset_x.SIZE || 0}}{{UNIT}}, {{content_offset_y.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{content_offset_x.SIZE || 0}}{{UNIT}}, {{content_offset_y.SIZE || 0}}{{UNIT}}); transform: translate({{content_offset_x.SIZE || 0}}{{UNIT}}, {{content_offset_y.SIZE || 0}}{{UNIT}});',
                    '(tablet){{WRAPPER}} .droit-timeline-section .droit-timeline-section-inner .droit-timeline-inner-wraper .droit-timeline-content'   => '-ms-transform: translate({{content_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{content_offset_y_tablet.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{content_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{content_offset_y_tablet.SIZE || 0}}{{UNIT}}); transform: translate({{content_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{content_offset_y_tablet.SIZE || 0}}{{UNIT}});',
                    '(mobile){{WRAPPER}} .droit-timeline-section .droit-timeline-section-inner .droit-timeline-inner-wraper .droit-timeline-content'   => '-ms-transform: translate({{content_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{content_offset_y_mobile.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{content_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{content_offset_y_mobile.SIZE || 0}}{{UNIT}}); transform: translate({{content_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{content_offset_y_mobile.SIZE || 0}}{{UNIT}});',
                ],            ]
        );

        $this->end_popover();

        $this->add_control(
            '_dl_timeline_content_date_heading',
            [
                'label'     => __( 'Date Time', 'droit-addons' ),
                'separator' => 'before',
                'type'      => \Elementor\Controls_Manager::HEADING,
                'condition' => [
                    $this->get_control_id('show_date_time') => ['yes'],
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
            'name'       => '_dl_timeline_content_date_typography',
            'selector'   => '{{WRAPPER}} .droit-timeline-section .droit-timeline-section-inner .droit-timeline-inner-wraper .droit-timeline-date-time .droit-date-time',
            'condition'  => [
                    $this->get_control_id('show_date_time') => ['yes'],
                ],
            ]
        );
        
        $this->add_control(
            '_dl_timeline_content_date_color',
            [
                'label'     => esc_html__( 'Color', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .droit-timeline-section .droit-timeline-section-inner .droit-timeline-inner-wraper .droit-timeline-date-time .droit-date-time' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    $this->get_control_id('show_date_time') => ['yes'],
                ],
            ]
        );
		
     $this->end_controls_section();
    }

    //Html render
    protected function render() {
        $this->_second_timeline_layout();
    }

    protected function _second_timeline_layout() {

       $settings = $this->get_settings_for_display();
       ?>
      <div class="dl_timeline_section dl_timeline_default_style dl_style_01 droit-timeline-section droit-timeline-default-style">
           <div class="dl_timeline_section_inner droit-timeline-section-inner">
               <?php if ($this->get_timeline_settings('_dl_timeline_items_skin_second')):
                   foreach ( $this->get_timeline_settings('_dl_timeline_items_skin_second') as $index => $item ):

                  /*   echo '<pre>';
                    print_r($item['_id']); */
   
                       $item_count = $index + 1;
   
                       /*Inner Wrapper*/
                       $timeline_id_key = $this->get_repeater_setting_key( '_id', '_dl_timeline_items_skin_second', $index );
                       $this->add_render_attribute( $timeline_id_key, [
                           'id' => 'timeline-' . $item['_id'],
                           'class' => [ "dl_limeline_section_inner_wrapper", "elementor-repeater-item-{$item['_id']}", "droit-timeline-inner-wraper" ],
                           'data-item' => $item_count,
                       ] );
                       $timeline_inner_wraper = $this->get_render_attribute_string( $timeline_id_key );
   
                       /*Title*/
                       $timeline_title_key = $this->get_repeater_setting_key( '_dl_timeline_title', '_dl_timeline_items_skin_second', $index );
                       
                       $this->add_render_attribute( $timeline_title_key, [
                           'class' => [ "dl_title", "droit-timeline-title" ],
                       ] );
   
                       $timeline_title_class = $this->get_render_attribute_string( $timeline_title_key );
                       $has_title_text = ! empty( $item['_dl_timeline_title'] );
   
                       /*Content*/
                       $timeline_content_key = $this->get_repeater_setting_key( '_dl_timeline_desc', '_dl_timeline_items_skin_second', $index );
                       
                       $this->add_render_attribute( $timeline_content_key, [
                           'class' => [ "dl_desc", "droit-timeline-content" ],
                       ] );
   
                       $timeline_content_class = $this->get_render_attribute_string( $timeline_content_key );
                       $has_timeline_text = ! empty( $item['_dl_timeline_desc'] );
   
                       /*Date*/
                       $date_format = !empty($this->get_timeline_settings('date_format')) ? $this->get_timeline_settings('date_format') : 'F j, Y';
                       $date = date( $date_format, strtotime($item['_dl_timeline_time']));
                       if('timeline_text' == $item['_dl_timeline_style']){
                           $date = $item['_dl_timeline_time_text'];
                       }
                       $time_format = !empty($this->get_timeline_settings('time_format')) ? $this->get_timeline_settings('time_format') : 'g:i a';
                       $time = 'timeline_calender' == $item['_dl_timeline_style'] ? date($time_format, strtotime($item['_dl_timeline_time'])) : '';
   
                       /*Icon*/
   
                       $migrated = isset( $item['__fa4_migrated']['_dl_timeline_selected_icon'] );
   
                       if ( ! isset( $item['icon'] ) && ! \ELEMENTOR\Icons_Manager::is_migration_allowed() ) {
                           $item['icon'] = 'fas fa-check';
                       }
                       $is_new = empty( $item['icon'] ) && \ELEMENTOR\Icons_Manager::is_migration_allowed();
                       $has_icon = ( ! $is_new || ! empty( $item['_dl_timeline_selected_icon']['value'] ) );
   
                       ?>
                   <div <?php echo $timeline_inner_wraper;  ?>>
                       <?php if ( $item['_dl_timeline_icon_show'] === 'yes' ): ?>
                           <div class="dl_limeline_counter dl_single_limeline_icon droit-timeline-counter">
                               <?php
                                   if($item['_dl_timeline_icon_type'] == 'icon'){
                                       if ( $is_new || $migrated ) { ?>
                                          <?php \ELEMENTOR\Icons_Manager::render_icon( $item['_dl_timeline_selected_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                      <?php }
                                   }
                                   if( $item['_dl_timeline_icon_type'] == 'image' ){ 
                                       if(!empty($item['_dl_timeline_icon_image']['url'])){ ?>
                                       <img src="<?php echo esc_url($item['_dl_timeline_icon_image']['url']); ?>" alt="<?php echo esc_attr( get_post_meta($item['_dl_timeline_icon_image']['id'], '_wp_attachment_image_alt', true) ); ?>">
                               <?php }} ?>
                           </div>
                       <?php endif; ?>
                       <div class="dl_timeline_main_coutent_inner droit-timeline-content-inner <?php echo esc_attr_e('elementor-repeater-item-'.$item['_id']);?>">
                           <?php if ($this->get_timeline_settings('show_title') == 'yes'): ?>
                               <?php if ($has_title_text): ?>  
                                   <<?php echo dl_title_tag($item['_dl_timeline_title_size']); ?> <?php echo $timeline_title_class; ?>><?php echo esc_html($item['_dl_timeline_title']); ?></<?php echo dl_title_tag($item['_dl_timeline_title_size']); ?>>
                               <?php endif; ?>
                           <?php endif; ?>
                           <?php if ($this->get_timeline_settings('show_desc') == 'yes'): ?>
                               <?php if ($has_timeline_text): ?>
                                   <p <?php echo $timeline_content_class; ?>>
                                       <?php echo dl_parse_txt($item['_dl_timeline_desc']); ?>
                                   </p>
                               <?php endif ?>
                           <?php endif ?>
                           <?php if ($this->get_timeline_settings('show_date_time') == 'yes'): ?>
                               <div class="dl_timeline_coutent_inner droit-timeline-date-time">
                                   <p class="dl_date droit-date-time ">
                                       <?php
                                           if ($date && $this->get_timeline_settings('show_date')) {
                                               printf('<span class="date">%s</span>', esc_html($date));
                                           }
                                           if ($time && $this->get_timeline_settings('show_time')) {
                                               printf('<span class="time">%s</span>', esc_html($time));
                                           }
                                       ?>
                                   </p>
                               </div>
                           <?php endif; ?>
                       </div>
                   </div>
           <?php endforeach; endif; ?>
           </div>
       </div>
   <?php }

   
    protected function content_template(){}
}