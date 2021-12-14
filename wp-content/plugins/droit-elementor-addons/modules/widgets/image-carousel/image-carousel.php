<?php
namespace DROIT_ELEMENTOR\Widgets;

if (!defined('ABSPATH')) {exit;}

class Droit_Addons_Image_Carousel extends \Elementor\Widget_Base {
    

    // Get Control ID
	protected function get_control_id( $control_id ) {
        return $control_id;
    }

    final public function get_images_settings( $control_key ) {
        $control_id = $this->get_control_id( $control_key );
        return $this->get_settings( $control_id );
    }

    public function get_name() {
        return 'droit-image_Carousel';
    }
    
    public function get_title() {
        return esc_html__( 'Image Carousel', 'droit-addons' );
    }

    public function get_icon() {
        return 'dlicons-image-carosel addons-icon';
    }

    public function get_keywords() {  
        return [
            'Image Carousel',
            'image carousel',
            'Image Slider',
            'Droit Image Slider',
            'dl Image Slider',
            'droit image carousel',
            'droit-image carousel',
            'dl image carousel',
            'dl-image carousel',
            'Images',
            'images',
            'Carousel',
            'carousel',
            'Slider',
            'Sliders',
            'slider',
            'sliders',
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
        $this->register_images_content_controls();
        $this->register_images_option_section_controls();
        $this->register_images_carousel_navigation_controls();
        $this->register_images_carousel_general_style_control();
        $this->register_images_carousel_content_style_control();
        do_action('dl_widget/section/style/custom_css', $this);
      }

    //Content
    public function register_images_content_controls(){
    	$this->start_controls_section(
            '_dl_images_content_layout_section',
            [
                'label' => esc_html__('Content', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT, 
            ]
        );
    	$this->register_images_type_controls();
    	$this->register_images_type_custom_controls();
    	$this->register_images_type_media_controls();
    	
        $this->end_controls_section();
    }

    // Media type
    protected function register_images_type_controls(){
    	$this->add_control(
            '_dl_carousel_type',
            [   
                'label' => esc_html__('Carousel Type', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'custom' => [
                        'title' => esc_html__('Custom', 'droit-addons'),
                        'icon' => 'eicon-apps',
                    ],
                    'media' => [
                        'title' => esc_html__('Media', 'droit-addons'),
                        'icon' => 'eicon-image',
                    ],
                ],
                'default' => 'custom',
            ]
        );    
    }

     // Media type
    protected function register_images_size_custom_controls(){
    	$this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'full',
                'separator' => 'before',

            ]
        );
    }

     // Media type Custom
    protected function register_images_type_custom_controls(){
    	$placeholder_image_src = \Elementor\Utils::get_placeholder_image_src();

    	$repeater = new \Elementor\Repeater();

    	$repeater->add_control(
			'_dl_images_title',
			[
				'label' => __( 'Title', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Title Here...', 'droit-addons' ),
				'placeholder' => __( 'Enter your title', 'droit-addons' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'_dl_images_subtitle',
			[
				'label'       => 'Description',
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
				'default'     => __( 'Design', 'droit-addons' ),
				'placeholder' => __( 'Enter your description', 'droit-addons' ),
				'show_label'  => true,
                'rows'  => 10,
			]
		);

		$repeater->add_control(
             '_dl_images_image',
             [   
                 'label' => esc_html__('Image', 'droit-addons'),
                 'type' => \Elementor\Controls_Manager::MEDIA,
                 'default' => [
                    'url' => $placeholder_image_src,
                ],
             ]
        );

		$repeater->add_control(
			'_dl_images_link',
			[
				'label' => __( 'Link', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'droit-addons' ),
			]
		);

		$repeater->add_control(
            '_dl_images_title_size',
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
                'condition' => [
                    $this->get_control_id('_dl_carousel_type') =>  [ 'custom' ],
                ]
            ]
        );

        $this->add_control(
			'_dl_images_custom_lists',
			[
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default' => [
					[
						'_dl_images_title' => __( 'Title #1', 'droit-addons' ),
						'_dl_images_image' => [
                            'url' => $placeholder_image_src,
                        ],
					],
					[
						'_dl_images_title' => __( 'Title #2', 'droit-addons' ),
						'_dl_images_image' => [
                            'url' => $placeholder_image_src,
                        ],
					],
					[
						'_dl_images_title' => __( 'Title #3', 'droit-addons' ),
						'_dl_images_image' => [
                            'url' => $placeholder_image_src,
                        ],
					],
					[
						'_dl_images_title' => __( 'Title #4', 'droit-addons' ),
						'_dl_images_image' => [
                            'url' => $placeholder_image_src,
                        ],
					],
				],
				'condition' => [
                    $this->get_control_id( '_dl_carousel_type' ) => [ 'custom' ],
                ],
				'title_field' => '{{ _dl_images_title }}',
			]
		);

        $this->register_images_size_custom_controls();
    }

    // Slider Option
    public function register_images_option_section_controls(){

        $this->start_controls_section(
            'section_tab_style',
            [
                'label' => esc_html__('Slider Options', 'droit-addons'),
            ]
        );

        $this->add_control(
            '_dl_images_slider_autoplay',
            [
                'label'        => esc_html__('Autoplay', 'droit-addons'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'droit-addons'),
                'label_off'    => esc_html__('No', 'droit-addons'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            '_dl_images_slider_speed',
            [
                'label'   => esc_html__('Autoplay Speed', 'droit-addons'),
                'type'    => \Elementor\Controls_Manager::NUMBER,
                'default' => 2000,
            ]
        );

        $this->add_control(
            '_dl_images_slider_loop',
            [
                'label'        => esc_html__('Infinite Loop', 'droit-addons'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'droit-addons'),
                'label_off'    => esc_html__('No', 'droit-addons'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_responsive_control(
            '_dl_images_slider_space',
            [
                'label'   => esc_html__('Slider Space', 'droit-addons'),
                'type'    => \Elementor\Controls_Manager::NUMBER,
                'default' => 55,
            ]
        );

        $this->add_control(
            '_dl_images_slider_perpage',
            [
                'label'   => esc_html__('Slider Item', 'droit-addons'),
                'type'    => \Elementor\Controls_Manager::NUMBER,
                'default' => 4,
                'condition' => [
                    $this->get_control_id('_dl_images_slider_breakpoints_one') => ['']
                ]
            ]
        );

        $this->add_responsive_control(
            '_dl_images_slider_center',
            [
                'label'        => esc_html__('Center', 'droit-addons'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'droit-addons'),
                'label_off'    => esc_html__('No', 'droit-addons'),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );

        $this->add_control(
            '_dl_images_slider_drag',
            [
                'label'        => esc_html__('MouseDrag', 'droit-addons'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'droit-addons'),
                'label_off'    => esc_html__('No', 'droit-addons'),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );

        $this->add_control(
            '_dl_images_slider_breakpoints_one',
            [
                'label'        => esc_html__('Responsive', 'droit-addons'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'droit-addons'),
                'label_off'    => esc_html__('No', 'droit-addons'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            '_dl_images_breakpoints_device_width_one',
            [
                'label' => __( 'Max Width', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::HIDDEN,
                'min' => 0,
                'max' => 3000,
                'step' => 1,
                'default' => '',
            ]
        );

        $repeater->add_control(
            '_dl_images_breakpoints_per_view_one',
            [
                'label' => __( 'Slides Per View', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 10,
                'step' => 1,
                'default' => 4,
            ]
        );

        $repeater->add_control(
            '_dl_images_breakpoints_space_one',
            [
                'label' => __( 'Space Between', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1000,
                'step' => 1,
                'default' => 0,
            ]
        );

        $this->add_control(
            '_dl_images_breakpoints_one',
            [
                'label'       => __('Content', 'droit-addons'),
                'show_label'  => false,
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        '_dl_images_breakpoints_device_width_one'    => 1440,
                        '_dl_images_breakpoints_per_view_one'        => 4,
                        '_dl_images_breakpoints_space_one'           => 0,
                    ],
                    [
                        '_dl_images_breakpoints_device_width_one'    => 1024,
                        '_dl_images_breakpoints_per_view_one'        => 3,
                        '_dl_images_breakpoints_space_one'           => 0,
                    ],
                    [
                        '_dl_images_breakpoints_device_width_one'    => 768,
                        '_dl_images_breakpoints_per_view_one'        => 2,
                        '_dl_images_breakpoints_space_one'           => 0,
                    ],
                    [
                        '_dl_images_breakpoints_device_width_one'    => 576,
                        '_dl_images_breakpoints_per_view_one'        => 1,
                        '_dl_images_breakpoints_space_one'           => 0,
                    ],

                ],
                'title_field' => 'Max Width: {{{ _dl_images_breakpoints_device_width_one }}}',
                'condition' => [
                    $this->get_control_id('_dl_images_slider_breakpoints_one') => ['yes']
                ]
            ]
        );

        $this->end_controls_section();
    }

    // Navigation
    public function register_images_carousel_navigation_controls( ) {
        $this->start_controls_section(
            '_dl_images_nav_control',
            [
                'label' => __( 'Navigation', 'droit-addons' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            '_dl_images_slider_nav_show',
            [
                'label'        => esc_html__('Nav Show', 'droit-addons'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'droit-addons'),
                'label_off'    => esc_html__('No', 'droit-addons'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            '_dl_pagination_type',
            [   
                'label' => esc_html__('Pagination Type', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'arrow' => [
                        'title' => esc_html__('Arrow', 'droit-addons'),
                        'icon' => 'eicon-arrow-circle-left',
                    ],
                    'dot' => [
                        'title' => esc_html__('Dot', 'droit-addons'),
                        'icon' => 'eicon-dot-circle-o',
                    ],
                ],
                'default' => 'arrow',
                'condition' => [
	                $this->get_control_id('_dl_images_slider_nav_show') =>  [ 'yes' ],
	            ],
            ]
        );

        $this->add_control(
			'dl_icon_position',
			[
				'label'   => __( 'Position', 'plugin-domain' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'relative',
				'options' => [
                    'relative' => __( 'Relative', 'droit-addons-pro' ),
                    'absolute' => __( 'Absolute', 'droit-addons-pro' ),
				],
                'selectors' => [
                    '{{WRAPPER}} .dl_swiper_navigation.style_1 .swiper_button_next'   => 'position: {{VALUE}};',
                    '{{WRAPPER}} .dl_swiper_navigation.style_1 .swiper_button_prev'   => 'position: {{VALUE}};',
                ],
                'condition' => [
	                '_dl_pagination_type' =>  [ 'arrow' ],
	            ],
			]
		);

        $this->add_responsive_control(
            'dl_image_icon_top_bottom',
            [
                'label'     => __('Top/ Bottom', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'default'   => 'bottom',
                'options'   => [
                    'top'   => [
                        'title' => __('Top', 'droit-addons'),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'bottom' => [
                        'title' => __('Bottom', 'droit-addons'),
                        'icon'  => 'eicon-v-align-bottom',
                    ],
                ],
                'condition' => [
	                'dl_icon_position' =>  [ 'relative' ],
	            ],
            ]
        );

        $this->add_responsive_control(
            'dl_image_icon_alignment',
            [
                'label'     => __('Nav Alignment', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => __('Left', 'droit-addons'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'droit-addons'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title' => __('Right', 'droit-addons'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl_swiper_navigation.style_1'   => 'text-align: {{VALUE}};',
                ],
                'condition' => [
	                'dl_icon_position' =>  [ 'relative' ],
	            ],
            ]
        );

        
		$this->start_controls_tabs( '_dl_images_nav_style_tabs' );

		$this->start_controls_tab( '_dl_images_nav_style_normal_tab',
			[ 
				'label' => esc_html__( 'Normal', 'droit-addons'),
			] 
		);

		$this->add_control(
			'_dl_images_dots_style',
			[
				'label' => __( 'Change Style', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 1,
				'options' => [
					'1' => __( 'Style 1', 'droit-addons' ),
					'2' => __( 'Style 2', 'droit-addons' ),
				],
				'condition' => [
                    $this->get_control_id('_dl_pagination_type') =>  [ 'dot' ],
                ]
			]
		);

		$this->add_control(
            '_dl_images_nav_normal_color',
            [
                'label' => esc_html__('Color', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
					'{{WRAPPER}} .droit-image-carousel-wrap .droit-carouse-next-prev > i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .droit-image-carousel-wrap .droit-carouse-next-prev > svg' => 'fill: {{VALUE}};',
				],
				'condition' => [
	                $this->get_control_id('_dl_images_slider_nav_show') =>  [ 'yes' ],
	                $this->get_control_id('_dl_pagination_type') =>  [ 'arrow'],
	            ],
            ]
        );
		 $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => '_dl_images_nav_normal_color_bg',
                'types' => [ 'classic', 'gradient' ],
                'fields_options' => [
					'background' => [
						'label' => __( 'Background Color', 'droit-addons' ),
					],
				],
                'selector' => '{{WRAPPER}} .droit-image-carousel-wrap .droit-carouse-next-prev',
                'condition' => [
	                $this->get_control_id('_dl_images_slider_nav_show') =>  [ 'yes' ],
	                $this->get_control_id('_dl_pagination_type') =>  [ 'arrow' ],
	            ],
            ]
        );

		$this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => '_dl_images_nav_normal_color_bg_dots',
                'types' => [ 'gradient' ],
                'fields_options' => [
					'background' => [
						'label' => __( 'Background Color', 'droit-addons' ),
					],
				],
                'selector' => 
                	'{{WRAPPER}} .droit-image-carousel-wrap .droit-pagination-bg .swiper-pagination-bullet:not(.swiper-pagination-bullet-active)',
                
                'condition' => [
	                $this->get_control_id('_dl_images_slider_nav_show') =>  [ 'yes' ],
	                $this->get_control_id('_dl_pagination_type') =>  [ 'dot'  ],
	            ],
            ]
        );

		$this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => '_dl_images_nav_normal_border',
                'label' => esc_html__('Border', 'droit-addons'),
                'selector' => '{{WRAPPER}} .droit-image-carousel-wrap .droit-carouse-next-prev',
                'condition' => [
	                $this->get_control_id('_dl_images_slider_nav_show') =>  [ 'yes' ],
	                $this->get_control_id('_dl_pagination_type') =>  [ 'arrow' ],
	            ],
            ]
        );

		$this->add_responsive_control(
            '_dl_images_nav_normal_border_radius',
            [
                'label' => esc_html__('Border Radius', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .droit-image-carousel-wrap .droit-carouse-next-prev' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .droit-image-carousel-wrap .swiper-pagination-bullet' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    $this->get_control_id('_dl_images_slider_nav_show') =>  [ 'yes' ],
                    $this->get_control_id('_dl_images_dots_style!') =>  [ '2' ],
                ],
            ]
        );

        $this->add_responsive_control(
            '_dl_images_nav_normal_spacing',
            [
                'label' => esc_html__('Margin', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .dl_swiper_navigation.style_1' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    $this->get_control_id('dl_icon_position') =>  [ 'relative' ]
                ]
            ]
        );

        $this->add_control(
			'dl_icon_between_spacing',
			[
				'label'      => __( 'Icon Spacing', 'droit-addons' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
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
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .dl_swiper_navigation.style_1 .swiper_button_next' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
                'condition' => [
                    $this->get_control_id('dl_icon_position') =>  [ 'relative' ]
                ]
			]
		);

		$this->end_controls_tab();
		$this->start_controls_tab( '_dl_images_nav_style_hover_tab',
			[ 
				'label' => esc_html__( 'Hover', 'droit-addons')
			] 
		);

		$this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => '_dl_images_nav_hover_color_bg_dots',
                'types' => [ 'gradient' ],
                'fields_options' => [
					'background' => [
						'label' => __( 'Active Color', 'droit-addons' ),
					],
				],
                'selector' => 
                	'{{WRAPPER}} .droit-image-carousel-wrap .droit-pagination-bg .swiper-pagination-bullet.swiper-pagination-bullet-active',
                
                'condition' => [
	                $this->get_control_id('_dl_images_slider_nav_show') =>  [ 'yes' ],
	                $this->get_control_id('_dl_pagination_type') =>  [ 'dot'  ],
	            ],
            ]
        );

		$this->add_control(
            '_dl_images_nav_hover_color',
            [
                'label' => esc_html__('Color', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .droit-image-carousel-wrap .droit-carouse-next-prev:hover > i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .droit-image-carousel-wrap .droit-carouse-next-prev:hover > svg' => 'fill: {{VALUE}};',
                ],
                'condition' => [
                    $this->get_control_id('_dl_images_slider_nav_show') =>  [ 'yes' ],
                    $this->get_control_id('_dl_pagination_type') =>  [ 'arrow' ],
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => '_dl_images_nav_hover_color_bg',
                'types' => [ 'gradient' ],
                'fields_options' => [
                    'background' => [
                        'label' => __( 'Background Color', 'droit-addons' ),
                    ],
                ],
                'selector' => '{{WRAPPER}} .droit-image-carousel-wrap .droit-carouse-next-prev:hover',
                'condition' => [
                    $this->get_control_id('_dl_images_slider_nav_show') =>  [ 'yes' ],
                    $this->get_control_id('_dl_pagination_type') =>  [ 'arrow' ],
                ],
            ]
        );

		$this->end_controls_tab();
				
		$this->end_controls_tabs();

        $this->add_control( 
            'dl_image_carousel_item_position',
            [
                'label'        => __( 'Image PopOver', 'droit-addons-pro' ),
                'type'         => \Elementor\Controls_Manager::POPOVER_TOGGLE,
                'label_off'    => __( 'Default', 'droit-addons-pro' ),
                'label_on'     => __( 'Custom', 'droit-addons-pro' ),
                'return_value' => 'yes',
                'condition' => [
                    'dl_icon_position' => 'absolute'
                ]
            ]
        );

        $this->start_popover();

        $this->add_control(
            'dl_offset_orientation_h',
            [
                'label' => __( 'Horizontal Orientation', 'elementor' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'toggle' => false,
                'default' => 'start',
                'render_type' => 'ui',
               
            ]
        );

        $this->add_responsive_control(
            'dl_offset_x',
            [
                'label' => __( 'Prev Horizontal Offset', 'elementor' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                    'vw' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                    'vh' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'default' => [
                    'size' => '0',
                ],
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .dl_swiper_navigation.style_1 .swiper_button_prev' => 'left: {{SIZE}}{{UNIT}}',
                    
                ],
            ]
        );

        $this->add_responsive_control(
            'dl_offset_x_end',
            [
                'label' => __( 'Next Horizontal Offset', 'elementor' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 0.1,
                    ],
                    '%' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                    'vw' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                    'vh' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'default' => [
                    'size' => '0',
                ],
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .dl_swiper_navigation.style_1 .swiper_button_next' => 'right: {{SIZE}}{{UNIT}}',
                ],
                
            ]
        );

        $this->add_control(
            'dl_offset_orientation_v',
            [
                'label' => __( 'Vertical Orientation', 'elementor' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'toggle' => false,
                'default' => 'start',
                'render_type' => 'ui',
            ]
        );

        $this->add_responsive_control(
            'dl_offset_y',
            [
                'label' => __( 'Prev Verticle Offset', 'elementor' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                    'vh' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                    'vw' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'size_units' => [ 'px', '%' ],
                'default' => [
                    'unit' => '%',
                    'size' => '50'
                ],
                'selectors' => [
                     '{{WRAPPER}} .dl_swiper_navigation.style_1 .swiper_button_prev' => 'top: {{SIZE}}{{UNIT}}',
                    
                ],
                
            ]
        );

        $this->add_responsive_control(
            'dl_offset_y_end',
            [
                'label' => __( 'Next Verticle Offset', 'elementor' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                    'vh' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                    'vw' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'size_units' => [ 'px', '%' ],
                'default' => [
                    'unit' => '%',
                    'size' => '50'
                ],
                'selectors' => [
                   '{{WRAPPER}} .dl_swiper_navigation.style_1 .swiper_button_next' => 'top: {{SIZE}}{{UNIT}}',
                ],
            ]
        );
       
        $this->end_popover();

		$this->add_responsive_control(
        '_dl_images_nav_size',
        [
            'label' => __('Icon Size', 'droit-addons'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'default' => [
                'size' => '',
                'unit' => 'px',
            ],
            'size_units' => ['px', '%', 'em', 'rem'],
                'range' => [
                    'em' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 0.1,
                    ],
                    'rem' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 0.1,
                    ],
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],
                'render_type' => 'ui',
            'selectors' => [
                '{{WRAPPER}} .droit-image-carousel-wrap .droit-carouse-next-prev i' => 'font-size: {{SIZE}}{{UNIT}};',
                '{{WRAPPER}} .droit-image-carousel-wrap .droit-carouse-next-prev img' => 'width: {{SIZE}}{{UNIT}};',
                '{{WRAPPER}} .droit-image-carousel-wrap .droit-carouse-next-prev svg' => 'width: {{SIZE}}{{UNIT}};',
            ],
            'condition' => [
                $this->get_control_id('_dl_images_slider_nav_show') =>  [ 'yes' ],
                $this->get_control_id('_dl_pagination_type') =>  [ 'arrow' ],
            ],
            
        ]
    	);

		$this->start_controls_tabs( '_dl_images_icon_next_prev_style_tabs' );

		$this->start_controls_tab( '_dl_images_icon_next_tab',
			[ 
				'label' => esc_html__( 'Next', 'droit-addons'),
				'condition' => [
	                $this->get_control_id('_dl_images_slider_nav_show') =>  [ 'yes' ],
	                $this->get_control_id('_dl_pagination_type') =>  [ 'arrow' ],
	            ],
			] 
		);

        $this->add_control(
            '_dl_images_nav_next_icon',
            [
                'label' => __( 'Change Icon', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'fa4compatibility' => 'icon_next',
                'default' => [
                    'value' => 'fas fa-angle-right',
                    'library' => 'fa-solid',
                ],
                'recommended' => [
                	'fa-brands' => [
                		'angle-right',
                		'arrow-right',
                		'arrow-circle-right',
                		'arrow-alt-circle-right',
                	],
                	'fa-solid' => [
						'angle-right',
						'arrow-right',
						'arrow-circle-right',
						'arrow-alt-circle-right',
					],
                ],
                'condition' => [
                    $this->get_control_id('_dl_images_slider_nav_show') =>  [ 'yes' ],
                    $this->get_control_id('_dl_pagination_type') =>  [ 'arrow' ],
                ],
            ]
        );

		$this->end_controls_tab();

		$this->start_controls_tab( '_dl_images_icon_prev_tab',
			[ 
				'label' => esc_html__( 'Prev', 'droit-addons'),
				'condition' => [
	                $this->get_control_id('_dl_images_slider_nav_show') =>  [ 'yes' ],
	                $this->get_control_id('_dl_pagination_type') =>  [ 'arrow' ],
	            ],
			] 

		);

        $this->add_control(
            '_dl_images_nav_prev_icon',
            [
                'label' => __( 'Change Icon', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'fa4compatibility' => 'icon_prev',
                'default' => [
                    'value' => 'fas fa-angle-left',
                    'library' => 'fa-solid',
                ],
                'recommended' => [
                	'fa-brands' => [
                		'angle-left',
                		'arrow-left',
                		'arrow-circle-left',
                		'arrow-alt-circle-left',
                	],
                	'fa-solid' => [
						'angle-left',
						'arrow-left',
						'arrow-circle-left',
						'arrow-alt-circle-left',
					],
                ],
                'condition' => [
                    $this->get_control_id('_dl_images_slider_nav_show') =>  [ 'yes' ],
                    $this->get_control_id('_dl_pagination_type') =>  [ 'arrow' ],
                ],
            ]
        );

		$this->end_controls_tab();
				
		$this->end_controls_tabs();
        
        $this->end_controls_section();
    }

	//General Style
    public function register_images_carousel_general_style_control(){
		$this->start_controls_section(
            '_dl_images_style_general',
            [
                'label' => esc_html__('General', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );     

        $this->add_control(
            'dl_image_carousel_text_alignment',
            [
                'label'     => __('Texts Alignment', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => __('Left', 'droit-addons'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'droit-addons'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title' => __('Right', 'droit-addons'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
					'{{WRAPPER}} .dl_image_carousel_desc' => 'text-align: {{VALUE}};',
				],
                
            ]
        ); 


        $this->add_control(
			'dl_image_carousel_height',
			[
				'label' => __( 'Image Height', 'droit-addons' ),
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
					'{{WRAPPER}} .dl_img_carousel_thumb a img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
			'dl_image_carousel_width',
			[
				'label' => __( 'Image Width', 'droit-addons' ),
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
					'{{WRAPPER}} .dl_img_carousel_thumb a img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
			'dl_image_bottom_spacing',
			[
				'label' => __( 'Image Bottom Spacing', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 400,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				
				'selectors' => [
					'{{WRAPPER}} .dl_image_carousel_desc' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

       $this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => '_dl_images_box_shadow',
				'selector' => '{{WRAPPER}} .droit-image-carousel-wrap .droit-image-carousel-inner:hover .droit-carousel-image-shadow',
				'fields_options' => [
					'box_shadow_type' => [
						'default' => 'yes',
					],
					'box_shadow' => [
						'default' => [
							'horizontal' => 0,
							'vertical' => 40,
							'blur' => 40,
							'spread' => -20,
							'color' => 'rgba(51, 51, 51, 0.41)',
						],
					],
				],
			]
		);
        $this->end_controls_section();
	}

	//Content Style
    public function register_images_carousel_content_style_control(){
        $this->start_controls_section(
            '_dl_images_carousel_content_style_section',
            [
                'label'     => __('Content', 'droit-addons'),
                'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
                
            ]
        );

        $this->start_controls_tabs( '_dl_images_carousel_content_title_style_tabs' );

        $this->start_controls_tab( 'title_normal', [ 'label' => esc_html__( 'Normal', 'droit-addons') ] );
        $this->add_control(
            '_dl_images_carousel_content_title_heading',
            [
                'label' => __( 'Title', 'droit-addons' ),
                'type'  => \Elementor\Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
			'dl_image_title_bottom_spacing',
			[
				'label' => __( 'Title Bottom Spacing', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 400,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				
				'selectors' => [
					'{{WRAPPER}} .dl_title.droit-carousel-title' => 'display: block; margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
             'name' => '_dl_images_carousel_content_title_typography',
                'selector' => '{{WRAPPER}} .droit-image-carousel-wrap .droit-carousel-title > a',
            ]
        );
        
        $this->add_control(
            '_dl_images_carousel_content_title_color',
            [
                'label' => esc_html__( 'Color', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .droit-image-carousel-wrap .droit-carousel-title > a' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control(
            '_dl_images_carousel_content_title_ofset',
            [
                'label'        => __('Offset', 'droit-addons'),
                'type'         => \Elementor\Controls_Manager::POPOVER_TOGGLE,
                'label_on'     => __('Custom', 'droit-addons'),
                'label_off'    => __('None', 'droit-addons'),
                'return_value' => 'yes',
            ]
        );
        $this->start_popover();

        $this->add_responsive_control(
            'content_title_offset_x',
            [
                'label'       => __('Offset Left', 'droit-addons'),
                'type'        => \Elementor\Controls_Manager::SLIDER,
                'size_units'  => ['px', '%', 'em', 'rem'],
                'condition'   => [
                    '_dl_images_carousel_content_title_ofset' => 'yes',
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
            'content_title_offset_y',
            [
                'label'      => __('Offset Top', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'condition'  => [
                    $this->get_control_id('_dl_images_carousel_content_title_ofset') =>  [ 'yes' ],
                ],
                'range'      => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .droit-image-carousel-wrap .droit-carousel-title' => 'margin-top: {{SIZE}}{{UNIT}};',
                    '(desktop){{WRAPPER}} .droit-image-carousel-wrap .droit-carousel-title'  => '-ms-transform: translate({{content_title_offset_x.SIZE || 0}}{{UNIT}}, {{content_title_offset_y.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{content_title_offset_x.SIZE || 0}}{{UNIT}}, {{content_title_offset_y.SIZE || 0}}{{UNIT}}); transform: translate({{content_title_offset_x.SIZE || 0}}{{UNIT}}, {{content_title_offset_y.SIZE || 0}}{{UNIT}});',
                    '(tablet){{WRAPPER}} .droit-image-carousel-wrap .droit-carousel-title'   => '-ms-transform: translate({{content_title_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{content_title_offset_y_tablet.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{content_title_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{content_title_offset_y_tablet.SIZE || 0}}{{UNIT}}); transform: translate({{content_title_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{content_title_offset_y_tablet.SIZE || 0}}{{UNIT}});',
                    '(mobile){{WRAPPER}} .droit-image-carousel-wrap .droit-carousel-title'   => '-ms-transform: translate({{content_title_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{content_title_offset_y_mobile.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{content_title_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{content_title_offset_y_mobile.SIZE || 0}}{{UNIT}}); transform: translate({{content_title_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{content_title_offset_y_mobile.SIZE || 0}}{{UNIT}});',
                ],

            ]
        );

        $this->end_popover();
        $this->end_controls_tab();

        $this->start_controls_tab( '_dl_images_carousel_content_title_hover', [ 
            'label' => esc_html__( 'Hover', 'droit-addons'),
             ] );

        $this->add_control(
            '_dl_images_carousel_content_title_hover_color',
            [
                'label' => esc_html__( 'Color', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .droit-image-carousel-wrap .droit-carousel-title > a:hover' => 'color: {{VALUE}};',
                ],
                'condition' => [
                     $this->get_control_id('_dl_images_slider_nav_show') =>  [ 'yes' ],
                    $this->get_control_id('_dl_pagination_type') =>  [ 'arrow' ],
                ]
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();

        //content tab

        $this->start_controls_tabs( '_dl_images_carousel_content_style_tabs' );

        $this->start_controls_tab( 'content_normal', [ 
                'label' => esc_html__( 'Normal', 'droit-addons'),
                
            ] 
        );

        $this->add_control(
            '_dl_images_carousel_content_heading',
            [
                'label' => __( 'Content', 'droit-addons' ),
                'type'  => \Elementor\Controls_Manager::HEADING,
                
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
	            'name' => '_dl_images_carousel_content_typography',
	            'selector' => '{{WRAPPER}} .droit-image-carousel-wrap .droit-carousel-subtitle',
	            
            ]
        );
        
        $this->add_control(
            '_dl_images_carousel_content_color',
            [
                'label' => esc_html__( 'Color', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .droit-image-carousel-wrap .droit-carousel-subtitle' => 'color: {{VALUE}};',
                ],
               
            ]
        );
        
        $this->add_control(
            '_dl_images_carousel_content_ofset',
            [
                'label'        => __('Offset', 'droit-addons'),
                'type'         => \Elementor\Controls_Manager::POPOVER_TOGGLE,
                'label_on'     => __('Custom', 'droit-addons'),
                'label_off'    => __('None', 'droit-addons'),
                'return_value' => 'yes',
              
            ]
        );
        $this->start_popover();

        $this->add_responsive_control(
            'content_offset_x',
            [
                'label'       => __('Offset Left', 'droit-addons'),
                'type'        => \Elementor\Controls_Manager::SLIDER,
                'size_units'  => ['px', '%', 'em', 'rem'],
                
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
                'range'      => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .droit-image-carousel-wrap .droit-carousel-subtitle' => 'margin-top: {{SIZE}}{{UNIT}};',
                    '(desktop){{WRAPPER}} .droit-image-carousel-wrap .droit-carousel-subtitle'  => '-ms-transform: translate({{content_offset_x.SIZE || 0}}{{UNIT}}, {{content_offset_y.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{content_offset_x.SIZE || 0}}{{UNIT}}, {{content_offset_y.SIZE || 0}}{{UNIT}}); transform: translate({{content_offset_x.SIZE || 0}}{{UNIT}}, {{content_offset_y.SIZE || 0}}{{UNIT}});',
                    '(tablet){{WRAPPER}} .droit-image-carousel-wrap .droit-carousel-subtitle'   => '-ms-transform: translate({{content_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{content_offset_y_tablet.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{content_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{content_offset_y_tablet.SIZE || 0}}{{UNIT}}); transform: translate({{content_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{content_offset_y_tablet.SIZE || 0}}{{UNIT}});',
                    '(mobile){{WRAPPER}} .droit-image-carousel-wrap .droit-carousel-subtitle'   => '-ms-transform: translate({{content_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{content_offset_y_mobile.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{content_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{content_offset_y_mobile.SIZE || 0}}{{UNIT}}); transform: translate({{content_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{content_offset_y_mobile.SIZE || 0}}{{UNIT}});',
                ],
                
            ]
        );

        $this->end_popover();
        $this->end_controls_tab();

        $this->start_controls_tab( '_dl_images_carousel_content_hover', [ 
            'label' => esc_html__( 'Hover', 'droit-addons'), 
            
            ] 
        );

        $this->add_control(
            '_dl_images_carousel_content_hover_color',
            [
                'label' => esc_html__( 'Color', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .droit-image-carousel-wrap .droit-carousel-subtitle:hover' => 'color: {{VALUE}};',
                ],
                
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();
        
        $this->end_controls_section();
    }

    // Media type Custom
    protected function register_images_type_media_controls(){
    	$this->add_control(
			'_dl_images_carousels',
			[
				'label' => __( 'Add Images', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::GALLERY,
				'default' => [],
				'show_label' => false,
				'dynamic' => [
					'active' => true,
				],
				'condition' => [
                    $this->get_control_id('_dl_carousel_type') =>  [ 'media' ],
                ]
			]
		);

		$this->add_control(
			'_dl_images_caption_type',
			[
				'label' => __( 'Title Caption', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'None', 'droit-addons' ),
					'title' => __( 'Title', 'droit-addons' ),
					'caption' => __( 'Caption', 'droit-addons' ),
					'description' => __( 'Description', 'droit-addons' ),
				],
				'condition' => [
                    $this->get_control_id('_dl_carousel_type') =>  [ 'media' ],
                    
                ]
			]
		);

		$this->add_control(
			'_dl_images_subtitle_caption_type',
			[
				'label' => __( 'Sub Title Caption', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'None', 'droit-addons' ),
					'title' => __( 'Title', 'droit-addons' ),
					'caption' => __( 'Caption', 'droit-addons' ),
					'description' => __( 'Description', 'droit-addons' ),
				],
				'condition' => [
                    $this->get_control_id('_dl_carousel_type') =>  [ 'media' ],
                   
                ]
			]
		);
        
		$this->add_control(
			'_dl_images_link_to',
			[
				'label' => __( 'Link', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none' => __( 'None', 'droit-addons' ),
					'file' => __( 'Media File', 'droit-addons' ),
					'custom' => __( 'Custom URL', 'droit-addons' ),
				],
				'condition' => [
                    $this->get_control_id('_dl_carousel_type') =>  [ 'media' ],
                ]
			]
		);

		$this->add_control(
			'_dl_images_custom_link',
			[
				'label' => __( 'Link', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'droit-addons' ),
				'condition' => [
                    $this->get_control_id('_dl_carousel_type') =>  [ 'media' ],
                    $this->get_control_id('_dl_images_link_to') =>  [ 'custom' ],
                ],
				'show_label' => false,
			]
		);

		$this->add_control(
            '_dl_images_cap_title_size',
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
                'condition' => [
                    $this->get_control_id('_dl_carousel_type') =>  [ 'media' ],
                ]
            ]
        );
    }

      //Html render
    protected function render(){
        $settings = $this->get_settings_for_display();
 
        $this->_first_images_layout();
    }

    protected function _first_images_layout(){
       $settings = $this->get_settings_for_display();
       extract($settings);
       $dl_slider_item_check =            'yes' === $this->get_images_settings('_dl_images_slider_breakpoints_one') ? '' : $this->get_images_settings('_dl_images_slider_perpage');
       //Slider Option
       $slider_autoplay                = $this->get_images_settings('_dl_images_slider_autoplay');
       $slider_speed                   = $this->get_images_settings('_dl_images_slider_speed');
       $slider_loop                    = $this->get_images_settings('_dl_images_slider_loop');
       $slider_space                   = $this->get_images_settings('_dl_images_slider_space');
       $slider_item                    = $dl_slider_item_check;
       $slider_center                  = $this->get_images_settings('_dl_images_slider_center');
       $slider_drag                    = $this->get_images_settings('_dl_images_slider_drag');
   
       /*Responsive Item*/
       $dl_break_points = [];
       if('yes' === $this->get_images_settings('_dl_images_slider_breakpoints_one')){
           $dl_breakpoints_items = $this->get_images_settings('_dl_images_breakpoints_one');
           foreach ($dl_breakpoints_items as $dl_breakpoints_item) {
               $dl_break_points[$dl_breakpoints_item['_dl_images_breakpoints_device_width_one']] = [
                   'slidesPerView' => $dl_breakpoints_item['_dl_images_breakpoints_per_view_one'],
                   'spaceBetween' => $dl_breakpoints_item['_dl_images_breakpoints_space_one'],
               ];
           }
       }
   
       $dl_break_points_controls = $dl_break_points;
   
       $slide_controls = [
           'slide_autoplay'                => $slider_autoplay,
           'slider_speed'                  => $slider_speed,
           'slider_loop'                   => $slider_loop,
           'slider_space'                  => $slider_space,
           'slider_item'                   => $slider_item,
           'slider_drag'                   => $slider_drag,
           'slider_next'                   => '.image_slider_next',
           'slider_prev'                   => '.image_slider_prev',
           'slider_paginationtype'         => 'bullets',
           'slider_pagination'             => '.img_carousel_pagination',
           'slider_effect'                 => '',
           'slider_center'                 => $slider_center,
           'slider_breakpoints'            => $dl_break_points_controls,
        ];

       $slide_controls = \json_encode($slide_controls);
       ?>

   <div class="dl_image_carousel_slider img_slider_with_description droit-image-carousel-wrap"> 
        <div class="swiper-container" data-controls="<?php echo esc_attr($slide_controls); ?>">
        <?php if($dl_icon_position === 'relative' && $dl_image_icon_top_bottom === 'top'){$this->dl_icons();} ?>
            <div class="swiper-wrapper">
                <?php 
                    if ($this->get_images_settings('_dl_carousel_type') == 'custom'){
                       $this->_dl_carousel_type_custom();
                    }else{
                       $this->_dl_carousel_type_media();
                    } 
                ?>
            </div>
            <?php if(($dl_icon_position === 'relative' && $dl_image_icon_top_bottom === 'bottom') || $dl_icon_position === 'absolute' ){$this->dl_icons();} ?>
        </div>
    </div>
  <?php }

  public function dl_icons() {
      ?>
    <?php if ($this->get_images_settings('_dl_images_slider_nav_show') == 'yes'): ?>
        <?php if ($this->get_images_settings('_dl_pagination_type') == 'arrow'): ?>
            <?php 
                $migrated_next = isset( $this->get_images_settings('__fa4_migrated')['_dl_images_nav_next_icon'] );
                $is_new_next   = empty( $this->get_images_settings('icon_next') ) && \ELEMENTOR\Icons_Manager::is_migration_allowed();
                $has_icon_next = ( ! $is_new_next || ! empty( $this->get_images_settings('_dl_images_nav_next_icon')['value'] ) );
                $migrated_prev = isset( $this->get_images_settings('__fa4_migrated')['_dl_images_nav_prev_icon'] );
                $is_new_prev   = empty( $this->get_images_settings('icon_prev') ) && \ELEMENTOR\Icons_Manager::is_migration_allowed();
                $has_icon_prev = ( ! $is_new_prev || ! empty( $this->get_images_settings('_dl_images_nav_prev_icon')['value'] ) );
             ?>

            <div class="dl_swiper_navigation style_1">
                <div class="swiper_button_prev droit-carouse-prev droit-carouse-next-prev image_slider_prev">
                    <?php 
                    if($has_icon_prev){
                        if ( $is_new_prev || $migrated_prev ) { 
                            \ELEMENTOR\Icons_Manager::render_icon( $this->get_images_settings('_dl_images_nav_prev_icon') ); 
                        }
                    }
                        ?>
                </div>
                <div class="swiper_button_next droit-carouse-next droit-carouse-next-prev image_slider_next">
                    <?php 
                    if($has_icon_next){
                        if ( $is_new_next || $migrated_next ) { 
                            \ELEMENTOR\Icons_Manager::render_icon( $this->get_images_settings('_dl_images_nav_next_icon') ); 
                        }
                    }
                        ?>
                </div>
            </div>
            <?php else: ?>
                <?php 
                    $dots_style = $this->get_images_settings('_dl_images_dots_style');
                ?>
            <div class="dl_swiper_pagination droit-pagination-bg style_<?php echo $dots_style; ?> img_carousel_pagination img_carousel_pagination"></div>
        <?php endif; ?>
    <?php endif; ?>
<?php
  }

    // Custom
    protected function _dl_carousel_type_custom(){
        $settings = $this->get_settings_for_display();
        if (!empty($this->get_images_settings('_dl_images_custom_lists'))):

      foreach ( $this->get_images_settings('_dl_images_custom_lists') as $item ) : 
            
            $has_title_text = ! empty( $item['_dl_images_title'] );
            $has_subtitle_text = ! empty( $item['_dl_images_subtitle'] );
            $has_image_url = ! empty( $item['_dl_images_image']['url'] );
            $link_attributes = ($item['_dl_images_link']['url'])?? '#';

            $carousel_image = $item['_dl_images_image'];
            $carousel_image_url = \Elementor\Group_Control_Image_Size::get_attachment_image_src( $carousel_image['id'], 'thumbnail', $settings );  

            if( empty( $carousel_image_url ) ) : $carousel_image_url = $carousel_image['url']; else: $carousel_image_url = $carousel_image_url; endif;

            ?>
            <div class="swiper-slide">
                <div class="dl_image_carousel dl_style_03 droit-image-carousel-inner">
                    <div class="dl_img_carousel_thumb">
                        <a href="<?php echo esc_url($link_attributes); ?>" class="droit-image-link">
                         <img src="<?php echo esc_url($carousel_image_url);?>" alt="<?php echo esc_attr( get_post_meta($carousel_image['id'], '_wp_attachment_image_alt', true) ); ?>" class="droit-carousel-image-shadow">
                        </a>
                    </div>

                    <div class="dl_image_carousel_desc">
                        <?php if ( $has_title_text ) : ?>
                            <<?php echo dl_title_tag($item['_dl_images_title_size']); ?> class="dl_title droit-carousel-title">
                            <a href="<?php echo esc_url($link_attributes); ?>" ><?php echo do_shortcode($item['_dl_images_title']); ?></a>
                            </<?php echo dl_title_tag($item['_dl_images_title_size']); ?>>
                        <?php endif; ?>

                        <?php if ($has_subtitle_text): ?>
                            <a href="<?php echo esc_url($link_attributes); ?>" class="dl_tag droit-carousel-subtitle"><?php echo do_shortcode($item['_dl_images_subtitle']); ?></a>
                        <?php endif ?>
                    </div>
                    
                </div>
            </div>
        <?php endforeach;  endif;  }
    

    // Media
    protected function _dl_carousel_type_media(){
        $settings = $this->get_settings_for_display();
        if (!empty($this->get_images_settings('_dl_images_carousels'))):
         
        foreach ( $this->get_images_settings('_dl_images_carousels') as $index => $item ) : 
            
            $carousel_image_url = \Elementor\Group_Control_Image_Size::get_attachment_image_src( $item['id'], 'thumbnail', $settings );
            $image_caption = $this->get_image_caption( $item );
            $image_caption_subtitle = $this->get_image_caption_subtitle( $item );

            $link_tag = '';

            $link = $this->get_link_url( $item, $settings );

            if ( $link ) {
                $link_key = 'link_' . $index;

                $this->add_link_attributes( $link_key, $link );

                $link_tag = $this->get_render_attribute_string( $link_key );
            }
            ?>
            <div class="swiper-slide">
                <div class="dl_image_carousel dl_style_03 droit-image-carousel-inner">
                    <div class="dl_img_carousel_thumb">
                        <a <?php echo $link_tag; ?> class="droit-image-link">
                         <img src="<?php echo esc_url($carousel_image_url);?>" alt="<?php echo esc_attr( \Elementor\Control_Media::get_image_alt( $item ) ); ?>" class="droit-carousel-image-shadow">
                        </a>
                    </div>
                    
                        <div class="dl_image_carousel_desc">
                            <?php if ( $image_caption ) : ?>
                                <<?php echo esc_html( dl_title_tag($this->get_images_settings('_dl_images_cap_title_size')) ); ?> class="dl_title droit-carousel-title">
                                <a <?php echo $link_tag; ?>>
                                <?php echo do_shortcode($image_caption); ?>
                                </a>
                                </<?php echo esc_html( dl_title_tag($this->get_images_settings('_dl_images_cap_title_size')) ); ?>>
                            <?php endif; ?>

                            <?php if ($image_caption_subtitle): ?>
                                <a <?php echo $link_tag; ?> class="dl_tag droit-carousel-subtitle"><?php echo do_shortcode($image_caption_subtitle); ?></a>
                            <?php endif ?>
                        </div>
                    
                </div>
            </div>
        <?php endforeach;  endif;  }

    private function get_image_caption( $item ) {
        $caption_type = $this->get_images_settings( '_dl_images_caption_type' );

        if ( empty( $caption_type ) ) {
            return '';
        }

        $item_post = get_post( $item['id'] );

        if ( 'caption' === $caption_type ) {
            return $item_post->post_excerpt;
        }

        if ( 'title' === $caption_type ) {
            return $item_post->post_title;
        }

        return $item_post->post_content;
    }

    private function get_image_caption_subtitle( $item ) {
        $caption_type = $this->get_images_settings( '_dl_images_subtitle_caption_type' );

        if ( empty( $caption_type ) ) {
            return '';
        }

        $item_post = get_post( $item['id'] );

        if ( 'caption' === $caption_type ) {
            return $item_post->post_excerpt;
        }

        if ( 'title' === $caption_type ) {
            return $item_post->post_title;
        }

        return $item_post->post_content;
    }
    /*Link*/
    private function get_link_url( $item, $instance ) {
        if ( 'none' === $instance['_dl_images_link_to'] ) {
            return false;
        }

        if ( 'custom' === $instance['_dl_images_link_to'] ) {
            if ( empty( $instance['_dl_images_custom_link']['url'] ) ) {
                return false;
            }

            return $instance['_dl_images_custom_link'];
        }

        return [
            'url' => wp_get_attachment_url( $item['id'] ),
        ];
    }

    protected function content_template(){}
}