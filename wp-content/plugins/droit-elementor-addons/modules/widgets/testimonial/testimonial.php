<?php
namespace DROIT_ELEMENTOR\Widgets;

if (!defined('ABSPATH')) {exit;}

class Droit_Addons_Testimonial extends \Elementor\Widget_Base {

    // Get Control ID
    protected function get_control_id( $control_id ) {
        return $control_id;
    }

    final public function get_testimonial_settings( $control_key ) {
        $control_id = $this->get_control_id( $control_key );
        return $this->get_settings( $control_id );
    }

    public function get_name() {
        return 'droit-testimonial';
    }
    
    public function get_title() {
        return esc_html__( 'Testimonial', 'droit-addons' );
    }

    public function get_icon() {
        return 'dlicons-quote addons-icon';
    }

    public function get_keywords() {
        return [
            'testimonial',
            'team',
            'blockquote',
            'droit',
            'dl',
            'addons',
            'addon'
        ];
    }
    
    public function get_categories() {
        return ['droit_addons'];
    }

    protected function _register_controls() {
        $this->register_skin_section_controls();
        $this->register_testimonial_content_section_controls();
        $this->register_testimonial_shape_controls();
        $this->register_testimonial_layout_section_controls();
        $this->register_testimonial_option_section_controls();
        $this->register_testimonial_navigation_controls();
        $this->register_testimonial_alignment_controls();
        $this->register_section_image_border_style_controls();
        $this->register_style_name_section_controls();
        $this->register_style_content_section_controls();
        $this->register_style_designation_section_controls();
        $this->register_section_image_controls();
        do_action('dl_widget/section/style/custom_css', $this);
    }

    // Skin Section
    public function register_skin_section_controls() {
        $this->start_controls_section(
            'section_skin',
            [
                'label' => __('Preset', 'droit-addons'),
            ]
        );

        $this->add_control(
            '_testimonial_skin_type',
            [
                'label'   => __('Design Format', 'droit-addons'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'dl_slider',
                'options' => [
                    'dl_slider'        => __('Design 1', 'droit-addons'),
                    'dl_slider_second' => __('Design 2', 'droit-addons'),
                    'dl_slider_three'  => __('Design 3', 'droit-addons'),
                ],
            ]
        );
        $this->end_controls_section();
    }

    // Testimonial Content
    public function register_testimonial_content_section_controls()
    {

        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Testimonial Content', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->register_testimonial_repeater_section_controls();
        $this->end_controls_section();
    }

    // Testimonial Repeater
    protected function register_testimonial_repeater_section_controls()
    {
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'testimonial_heading', [
                'label'       => __('Heading', 'droit-addons'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __('Enter Heading', 'droit-addons'),
                'default'     => __('Testimonial', 'droit-addons'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'testimonial_name', [
                'label'       => __('Name', 'droit-addons'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __('Enter Name', 'droit-addons'),
                'default'     => __('Enter Name', 'droit-addons'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'testimonial_designation', [
                'label'       => __('Designation', 'droit-addons'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __('Enter Designation', 'droit-addons'),
                'default'     => __('Enter Designation', 'droit-addons'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'testimonial_text', [
                'label'       => __('Content', 'droit-addons'),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'placeholder' => __('Enter Content', 'droit-addons'),
                'default'     => __('Enter Content', 'droit-addons'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'testimonial_image', [
                'label'      => __('Client Image', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::MEDIA,
                'default'    => [
                    'url' => dl_place_img(),
                ],
                'show_label' => false,
            ]
        );
      
        $repeater->add_control(
            'testimonial_link',
            [
                'label'         => __( 'Link', 'droit-addons' ),
                'type'          => \Elementor\Controls_Manager::URL,
                'placeholder'   => __( 'https://your-link.com', 'droit-addons' ),
                'show_external' => true,
                'default' => [
                    'url'         => '',
                    'is_external' => true,
                    'nofollow'    => true,
                ],
                
            ]
        );
        $this->add_control(
            'testimonial_list',
            [
                'label'       => __('Testimonials', 'droit-addons'),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'testimonial_heading'     => __('Testimonial', 'droit-addons'),
                        'testimonial_name'        => __('Filip Justić', 'droit-addons'),
                        'testimonial_designation' => __('CTO, Droitthemes', 'droit-addons'),
                        'testimonial_text'        => __(' “ The best support in the planet! I was having problems with the plug-in, Droitadons presents your services with flexible, convenient and multipurpose layouts. “', 'droit-addons'),
                        'testimonial_image'       => dl_place_img(),
                    ],
                    [
                        'testimonial_heading'     => __('Testimonial', 'droit-addons'),
                        'testimonial_name'        => __('lip Justić', 'droit-addons'),
                        'testimonial_designation' => __('CTO, Droitthemes', 'droit-addons'),
                        'testimonial_text'        => __(' “ The best support in the planet! I was having problems with the plug-in, Droitadons presents your services with flexible, convenient and multipurpose layouts. “', 'droit-addons'),
                        'testimonial_image'       => dl_place_img(),
                    ],
                    [
                        'testimonial_heading'     => __('Testimonial', 'droit-addons'),
                        'testimonial_name'        => __('John Justić', 'droit-addons'),
                        'testimonial_designation' => __('CTO, Droitthemes', 'droit-addons'),
                        'testimonial_text'        => __(' “ The best support in the planet! I was having problems with the plug-in, Droitadons presents your services with flexible, convenient and multipurpose layouts. “', 'droit-addons'),
                        'testimonial_image'       => dl_place_img(),
                    ],
                ],
                'title_field' => '{{{ testimonial_name }}}',
            ]
        );
    }

    // Testimonial Layout
    public function register_testimonial_layout_section_controls()
    {

        $this->start_controls_section(
            'layout_section',
            [
                'label' => __('Testimonial Layout', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'heading_tag',
            [
                'label'   => __('Heading Tag', 'droit-addons'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'h1'   => 'H1',
                    'h2'   => 'H2',
                    'h3'   => 'H3',
                    'h4'   => 'H4',
                    'h5'   => 'H5',
                    'h6'   => 'H6',
                    'div'  => 'div',
                    'span' => 'span',
                    'p'    => 'p',
                ],
                'default' => 'h2',
                'condition'    => [
                    $this->get_control_id('dl_slider') => ['_testimonial_skin_type'],
                ],
            ]
        );

        $this->add_control(
            '_s_h_title',
            [
                'label'        => esc_html__('Show/Hide Heading', 'droit-addons'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'label_on'     => esc_html__('Yes', 'droit-addons'),
                'label_off'    => esc_html__('No', 'droit-addons'),
                'return_value' => 'yes',
                'condition'    => [
                    $this->get_control_id('dl_slider') => ['_testimonial_skin_type'],
                ],
            ]
        );

        $this->add_control(
            '_s_h_shap',
            [
                'label'        => esc_html__('Show/Hide Shape', 'droit-addons'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'droit-addons'),
                'label_off'    => esc_html__('No', 'droit-addons'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );
        $this->add_control(
            '_s_h_image',
            [
                'label'        => esc_html__('Show/Hide Image', 'droit-addons'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'droit-addons'),
                'label_off'    => esc_html__('No', 'droit-addons'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );
        $this->add_control(
            '_s_h_name',
            [
                'label'        => esc_html__('Show/Hide Name', 'droit-addons'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'droit-addons'),
                'label_off'    => esc_html__('No', 'droit-addons'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );
        $this->add_control(
            '_s_h_deg',
            [
                'label'        => esc_html__('Show/Hide Designation', 'droit-addons'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'droit-addons'),
                'label_off'    => esc_html__('No', 'droit-addons'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );
        $this->add_control(
            '_s_h_con',
            [
                'label'        => esc_html__('Show/Hide Content', 'droit-addons'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'droit-addons'),
                'label_off'    => esc_html__('No', 'droit-addons'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );


        $this->end_controls_section();
    }

    // Slider Option
    public function register_testimonial_option_section_controls() {

        $this->start_controls_section(
            'section_tab_style',
            [
                'label' => esc_html__('Slider Options', 'droit-addons'),
            ]
        );

        $this->add_responsive_control(
			'_dl_testimonial_image_content_gap',
			[
				'label' => __( 'Content Gap', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					
				],
				'selectors' => [
					'{{WRAPPER}} .dl_single_testimonial_slider.style_01 .dl_client_info' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
            'testimonial_slider_autoplay',
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
            'testimonial_slider_speed',
            [
                'label'   => esc_html__('Autoplay Speed', 'droit-addons'),
                'type'    => \Elementor\Controls_Manager::NUMBER,
                'default' => 2000,
            ]
        );

        $this->add_control(
            'testimonial_slider_loop',
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
            'testimonial_slider_space',
            [
                'label'   => esc_html__('Slider Space', 'droit-addons'),
                'type'    => \Elementor\Controls_Manager::NUMBER,
                'default' => 50,
            ]
        );

        $this->add_control(
            'testimonial_slider_perpage',
            [
                'label'   => esc_html__('Slider Item', 'droit-addons'),
                'type'    => \Elementor\Controls_Manager::NUMBER,
                'default' => 1,
                'condition' => [
                    $this->get_control_id('_dl_testimonial_slider_breakpoints_one') => ['']
                ]
            ]
        );

        $this->add_control(
            'testimonial_slider_drag',
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
            '_dl_testimonial_slider_breakpoints_one',
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
            '_dl_testimonial_breakpoints_device_width_one',
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
            '_dl_testimonial_breakpoints_per_view_one',
            [
                'label' => __( 'Slides Per View', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 10,
                'step' => 1,
                'default' => 1,
            ]
        );

        $repeater->add_control(
            '_dl_testimonial_breakpoints_space_one',
            [
                'label' => __( 'Space Between', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1000,
                'step' => 1,
                'default' => 30,
            ]
        );

        $this->add_control(
            '_dl_testimonial_breakpoints_one',
            [
                'label'       => __('Content', 'droit-addons'),
                'show_label'  => false,
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        '_dl_testimonial_breakpoints_device_width_one'    => 1440,
                        '_dl_testimonial_breakpoints_per_view_one'        => 3,
                        '_dl_testimonial_breakpoints_space_one'           => 30,
                    ],
                    [
                        '_dl_testimonial_breakpoints_device_width_one'    => 1024,
                        '_dl_testimonial_breakpoints_per_view_one'        => 2,
                        '_dl_testimonial_breakpoints_space_one'           => 30,
                    ],
                    [
                        '_dl_testimonial_breakpoints_device_width_one'    => 768,
                        '_dl_testimonial_breakpoints_per_view_one'        => 2,
                        '_dl_testimonial_breakpoints_space_one'           => 30,
                    ],
                    [
                        '_dl_testimonial_breakpoints_device_width_one'    => 576,
                        '_dl_testimonial_breakpoints_per_view_one'        => 2,
                        '_dl_testimonial_breakpoints_space_one'           => 30,
                    ],

                ],
                'title_field' => 'Max Width: {{{ _dl_testimonial_breakpoints_device_width_one }}}',
                'condition' => [
                    $this->get_control_id('_dl_testimonial_slider_breakpoints_one') => ['yes']
                ]
            ]
        );
        $this->end_controls_section();
    }

    // Name Style
    public function register_style_name_section_controls() {

        $this->start_controls_section(
            'section_style_heading',
            [
                'label' => __('Heading', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    $this->get_control_id('_testimonial_skin_type') => ['dl_slider']
                ]
            ]
        );

        $this->add_control(
            'heading_color',
            [
                'label'     => __('Color', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dl_single_testimonial_slider.style_01 .dl_sub_title' => 'color: {{VALUE}};',
                ],
                'global'    => [
                    'default' => '',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'heading_typography',
                'label'    => 'Typography',
                'selector' => '{{WRAPPER}} .dl_single_testimonial_slider.style_01 .dl_sub_title',
                'global'   => [
                    'default' => '',
                ],
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_name',
            [
                'label' => __('Name', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => __('Color', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .droit-testimonial .dl_client_info .droit-testimonial-name' => 'color: {{VALUE}};',
                ],
                'global'    => [
                    'default' => '',
                ],
            ]
        );


        $this->add_group_control(
            \Elementor\Group_Control_Css_Filter::get_type(),
            [
                'name'     => 'name_filter_css',
                'selector' => '{{WRAPPER}} .droit-testimonial .dl_client_info .droit-testimonial-name',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'name_typography',
                'label'    => 'Typography',
                'selector' => '{{WRAPPER}} .droit-testimonial .dl_client_info .droit-testimonial-name',
                'global'   => [
                    'default' => '',
                ],
            ]
        );

        $this->add_control(
            '_testimonial_name_ofset',
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
            'testimonial_offset_x',
            [
                'label'       => __('Offset Left', 'droit-addons'),
                'type'        => \Elementor\Controls_Manager::SLIDER,
                'size_units'  => ['px', '%', 'em', 'rem'],
                'condition'   => [
                    $this->get_control_id('_testimonial_name_ofset') => ['yes'],
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
            'testimonial_offset_y',
            [
                'label'      => __('Offset Top', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'condition'  => [
                    $this->get_control_id('_testimonial_name_ofset') => ['yes'],
                ],
                'range'      => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .droit-testimonial .dl_client_info .droit-testimonial-name' => 'margin-top: {{SIZE}}{{UNIT}};',
                    '(desktop){{WRAPPER}} .droit-testimonial .dl_client_info .droit-testimonial-name'  => '-ms-transform: translate({{testimonial_offset_x.SIZE || 0}}{{UNIT}}, {{testimonial_offset_y.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{testimonial_offset_x.SIZE || 0}}{{UNIT}}, {{testimonial_offset_y.SIZE || 0}}{{UNIT}}); transform: translate({{testimonial_offset_x.SIZE || 0}}{{UNIT}}, {{testimonial_offset_y.SIZE || 0}}{{UNIT}});',
                    '(tablet){{WRAPPER}} .droit-testimonial .dl_client_info .droit-testimonial-name'   => '-ms-transform: translate({{testimonial_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{testimonial_offset_y_tablet.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{testimonial_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{testimonial_offset_y_tablet.SIZE || 0}}{{UNIT}}); transform: translate({{testimonial_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{testimonial_offset_y_tablet.SIZE || 0}}{{UNIT}});',
                    '(mobile){{WRAPPER}} .droit-testimonial .dl_client_info .droit-testimonial-name'   => '-ms-transform: translate({{testimonial_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{testimonial_offset_y_mobile.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{testimonial_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{testimonial_offset_y_mobile.SIZE || 0}}{{UNIT}}); transform: translate({{testimonial_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{testimonial_offset_y_mobile.SIZE || 0}}{{UNIT}});',
                ],
            ]
        );

        $this->end_popover();

        $this->end_controls_section();
    }

    // Content Style
    public function register_style_content_section_controls()
    {
        $this->start_controls_section(
            'section_style_content',
            [
                'label' => __('Content', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label'     => __('Color', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .droit-testimonial .droit-testimonial-content' => 'color: {{VALUE}};',
                ],
                'global'    => [
                    'default' => '',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Css_Filter::get_type(),
            [
                'name'     => 'content_filter_css',
                'selector' => '{{WRAPPER}} .droit-testimonial .droit-testimonial-content',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'content_typography',
                'label'    => 'Typography',
                'selector' => '{{WRAPPER}} .droit-testimonial .droit-testimonial-content',
                'global'   => [
                    'default' => '',
                ],
            ]
        );

        $this->add_control(
            '_testimonial_content_ofset',
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
            'testimonial_content_offset_x',
            [
                'label'       => __('Offset Left', 'droit-addons'),
                'type'        => \Elementor\Controls_Manager::SLIDER,
                'size_units'  => ['px', '%', 'em', 'rem'],
                'condition'   => [
                     $this->get_control_id('_testimonial_content_ofset') => ['yes'],
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
            'testimonial_content_offset_y',
            [
                'label'      => __('Offset Top', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'condition'  => [
                    $this->get_control_id('_testimonial_content_ofset') => ['yes'],
                ],
                'range'      => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .droit-testimonial-content' => 'margin-top: {{SIZE}}{{UNIT}};',
                    '(desktop){{WRAPPER}} .droit-testimonial-content'  => '-ms-transform: translate({{testimonial_content_offset_x.SIZE || 0}}{{UNIT}}, {{testimonial_content_offset_y.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{testimonial_content_offset_x.SIZE || 0}}{{UNIT}}, {{testimonial_content_offset_y.SIZE || 0}}{{UNIT}}); transform: translate({{testimonial_content_offset_x.SIZE || 0}}{{UNIT}}, {{testimonial_content_offset_y.SIZE || 0}}{{UNIT}});',
                    '(tablet){{WRAPPER}} .droit-testimonial-content'   => '-ms-transform: translate({{testimonial_content_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{testimonial_content_offset_y_tablet.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{testimonial_content_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{testimonial_content_offset_y_tablet.SIZE || 0}}{{UNIT}}); transform: translate({{testimonial_content_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{testimonial_content_offset_y_tablet.SIZE || 0}}{{UNIT}});',
                    '(mobile){{WRAPPER}} .droit-testimonial-content'   => '-ms-transform: translate({{testimonial_content_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{testimonial_content_offset_y_mobile.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{testimonial_content_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{testimonial_content_offset_y_mobile.SIZE || 0}}{{UNIT}}); transform: translate({{testimonial_content_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{testimonial_content_offset_y_mobile.SIZE || 0}}{{UNIT}});',
                ],
            ]
        );

        $this->end_popover();
        $this->end_controls_section();
    }

    // Designation Style
    public function register_style_designation_section_controls() {
        $this->start_controls_section(
            'section_style_designation',
            [
                'label' => __('Designation', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'designation_color',
            [
                'label'     => __('Color', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .droit-testimonial .droit-testimonial-designation' => 'color: {{VALUE}};',
                ],
                'global'    => [
                    'default' => '',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Css_Filter::get_type(),
            [
                'name'     => 'designation_filter_css',
                'selector' => '{{WRAPPER}} .droit-testimonial .droit-testimonial-designation',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'designation_typography',
                'label'    => 'Typography',
                'selector' => '{{WRAPPER}} .droit-testimonial .droit-testimonial-designation',
                'global'   => [
                    'default' => '',
                ],
            ]
        );

        $this->add_control(
            '_testimonial_desig_ofset',
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
            'testimonial_desig_offset_x',
            [
                'label'       => __('Offset Left', 'droit-addons'),
                'type'        => \Elementor\Controls_Manager::SLIDER,
                'size_units'  => ['px', '%', 'em', 'rem'],
                'condition'   => [
                    $this->get_control_id('_testimonial_desig_ofset') => ['yes'],
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
            'testimonial_desig_offset_y',
            [
                'label'      => __('Offset Top', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'condition'  => [
                    $this->get_control_id('_testimonial_desig_ofset') => ['yes'],
                ],
                'range'      => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .droit-testimonial .droit-testimonial-designation' => 'margin-top: {{SIZE}}{{UNIT}};',
                    '(desktop){{WRAPPER}} .droit-testimonial .droit-testimonial-designation'  => '-ms-transform: translate({{testimonial_desig_offset_x.SIZE || 0}}{{UNIT}}, {{testimonial_desig_offset_y.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{testimonial_desig_offset_x.SIZE || 0}}{{UNIT}}, {{testimonial_desig_offset_y.SIZE || 0}}{{UNIT}}); transform: translate({{testimonial_desig_offset_x.SIZE || 0}}{{UNIT}}, {{testimonial_desig_offset_y.SIZE || 0}}{{UNIT}});',
                    '(tablet){{WRAPPER}} .droit-testimonial .droit-testimonial-designation'   => '-ms-transform: translate({{testimonial_desig_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{testimonial_desig_offset_y_tablet.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{testimonial_desig_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{testimonial_desig_offset_y_tablet.SIZE || 0}}{{UNIT}}); transform: translate({{testimonial_desig_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{testimonial_desig_offset_y_tablet.SIZE || 0}}{{UNIT}});',
                    '(mobile){{WRAPPER}} .droit-testimonial .droit-testimonial-designation'   => '-ms-transform: translate({{testimonial_desig_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{testimonial_desig_offset_y_mobile.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{testimonial_desig_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{testimonial_desig_offset_y_mobile.SIZE || 0}}{{UNIT}}); transform: translate({{testimonial_desig_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{testimonial_desig_offset_y_mobile.SIZE || 0}}{{UNIT}});',
                ],
            ]
        );

        $this->end_popover();
        $this->end_controls_section();
    }

    public function register_section_image_border_style_controls() {
        $this->start_controls_section(
            'section_image_border_style',
            [
                'label' => __('Image', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition'  => [
                    $this->get_control_id('_testimonial_skin_type') => ['dl_slider_three'],
                ],
            ]
        );

        $this->add_responsive_control(
            '_dl_testimonial_image_width',
            [
                'label'      => __('Width', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'default' => [
                    'size' => '250',
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
                    '{{WRAPPER}} .droit-testimonial .dl_client_img .dl_client_thumb' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            '_dl_testimonial_image_height',
            [
                'label'      => __('Height', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'default' => [
                    'size' => '250',
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
                    '{{WRAPPER}} .droit-testimonial .dl_client_img .dl_client_thumb' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            '_dl_testimonial_image_fit',
            [
                'label' => __( 'Object Fit', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::SELECT,

                'condition' => [
                    $this->get_control_id('_dl_testimonial_image_width[size]!') => '',
                    $this->get_control_id('_dl_testimonial_image_height[size]!') => '',
                ],
                'options' => [
                    '' => __( 'Default', 'droit-addons' ),
                    'fill' => __( 'Fill', 'droit-addons' ),
                    'cover' => __( 'Cover', 'droit-addons' ),
                    'contain' => __( 'Contain', 'droit-addons' ),
                ],
                'default' => 'cover',
                'selectors' => [
                    '{{WRAPPER}} .droit-testimonial .dl_client_img .dl_client_thumb' => 'object-fit: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            '_dl_testimonial_image_fit_position',
            [
                'label' => __( 'Object Position', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::SELECT,

                'condition' => [
                    $this->get_control_id('_dl_testimonial_image_width[size]!') => '',
                    $this->get_control_id('_dl_testimonial_image_height[size]!') => '',
                ],
                'options' => [
                    '' => __( 'Default', 'droit-addons' ),
                    'top' => __( 'Top', 'droit-addons' ),
                    'bottom' => __( 'Bottom', 'droit-addons' ),
                    'left' => __( 'Left', 'droit-addons' ),
                    'right' => __( 'Right', 'droit-addons' ),
                    'center' => __( 'Center', 'droit-addons' ),
                ],
                'default' => 'top',
                'selectors' => [
                    '{{WRAPPER}} .droit-testimonial .dl_client_img .dl_client_thumb' => 'object-position: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => '_dl_testimonial_image_border',
                'label' => esc_html__('Border', 'droit-addons'),
                'selector' => '{{WRAPPER}} .droit-testimonial .dl_client_info .dl_client_img',
                'condition' => [
                    $this->get_control_id('_testimonial_skin_type') => ['dl_slider'],
                ],
            ]
        );

        $this->add_responsive_control(
            '_dl_testimonial_image_border_radius',
            [
                'label' => esc_html__('Border Radius', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .droit-testimonial .dl_client_info .dl_client_img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    $this->get_control_id('_testimonial_skin_type') => ['dl_slider'],
                ],
            ]
        );
        $this->end_controls_section();
    }

    // Change Image
    public function register_section_image_controls() {
        $this->start_controls_section(
            'section_image_style',
            [
                'label' => __('Quote/Shape Image', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            '_shape_image', [
                'label'      => __('Image', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::MEDIA,
                'default'    => [
                    'url' => dl_place_img(),
                ],
                'show_label' => false,
            ]
        );

        $this->add_responsive_control(
            'dl_image_icon_text_alignment',
            [
                'label'     => __('Alignment', 'droit-addons'),
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
                    '{{WRAPPER}} .dl_single_testimonial_slider.style_01'   => 'text-align: {{VALUE}};',
                ],
                'condition' => [
                    '_testimonial_skin_type' => 'dl_slider',
                ]
            ]
        );

        $this->end_controls_section();
    }

    // Shape Control
    public function register_testimonial_shape_controls( ) {
        $this->start_controls_section(
            '_droit_testimonial_section_background_image',
            [
                'label' => __( 'Shape Image', 'droit-addons' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    $this->get_control_id('_testimonial_skin_type') => ['dl_slider'],
                ],
            ]
        );

        $this->add_control(
            '_s_h_section_shape',
            [
                'label'        => esc_html__('Show/Hide Shape', 'droit-addons'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'default'      => 'no',
                'label_on'     => esc_html__('Yes', 'droit-addons'),
                'label_off'    => esc_html__('No', 'droit-addons'),
                'return_value' => 'yes',

            ]
        );

        $this->add_control(
            '_testimonial_shape_image_one', [
                'label'      => __('Image', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::MEDIA,
                'default'    => [
                    'url' => dl_place_img(),
                ],
                'show_label' => false,
                'condition' => [
                    $this->get_control_id('_s_h_section_shape') => ['yes'],
                ],
            ]
        );

        $this->add_control(
        '_testimonial_shape_image_one_ofset',
        [
            'label'        => __('Offset', 'droit-addons'),
            'type'         => \Elementor\Controls_Manager::POPOVER_TOGGLE,
            'label_on'     => __('Custom', 'droit-addons'),
            'label_off'    => __('None', 'droit-addons'),
            'return_value' => 'yes',
            'condition' => [
                $this->get_control_id('_s_h_section_shape') => ['yes'],
            ],
        ]
    );

    $this->start_popover();

        $this->add_responsive_control(
            '_testimonial_shape_image_one_move_top',
            [
                'label'       => __('Top/Bottom', 'droit-addons'),
                'type'        => \Elementor\Controls_Manager::SLIDER,
                'size_units'  => ['px', '%', 'em', 'rem'],
                'condition'   => [
                    $this->get_control_id('_testimonial_shape_image_one_ofset') => ['yes'],
                ],
                'range' => [
                    'em' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 0.1,
                    ],
                    'rem' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 0.1,
                    ],
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],
                'render_type' => 'ui',
                'default' => [
                        'unit' => '%',
                    ],
                'selectors' => [
                    '{{WRAPPER}} .dl_testimonial_section_shape .dl_parallax_img_1' => 'top: {{SIZE}}{{UNIT}};',
                    '(desktop){{WRAPPER}} .dl_testimonial_section_shape .dl_parallax_img_1' => 'top: {{SIZE}}{{UNIT}};',
                    '(tablet){{WRAPPER}} .dl_testimonial_section_shape .dl_parallax_img_1' => 'top: {{SIZE}}{{UNIT}};',
                    '(mobile){{WRAPPER}} .dl_testimonial_section_shape .dl_parallax_img_1' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            '_testimonial_shape_image_one_move_left',
            [
                'label'      => __('Left/Right', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'condition'  => [
                    $this->get_control_id('_testimonial_shape_image_one_ofset') => ['yes'],
                ],
                'range' => [
                    'em' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 0.1,
                    ],
                    'rem' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 0.1,
                    ],
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],
                'render_type' => 'ui',
                'default' => [
                        'unit' => '%',
                    ],
                'selectors' => [
                    '{{WRAPPER}} .dl_testimonial_section_shape .dl_parallax_img_1' => 'left: {{SIZE}}{{UNIT}};',
                    '(desktop){{WRAPPER}} .dl_testimonial_section_shape .dl_parallax_img_1' => 'left: {{SIZE}}{{UNIT}};',
                    '(tablet){{WRAPPER}} .dl_testimonial_section_shape .dl_parallax_img_1' => 'left: {{SIZE}}{{UNIT}};',
                    '(mobile){{WRAPPER}} .dl_testimonial_section_shape .dl_parallax_img_1' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_popover();
        $this->add_control(
            '_testimonial_shape_image_two', [
                'label'      => __('Image', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::MEDIA,
                'default'    => [
                    'url' => dl_place_img(),
                ],
                'show_label' => false,
                'condition' => [
                    $this->get_control_id('_s_h_section_shape') => ['yes'],
                ],
            ]
        );

        $this->add_control(
        '_testimonial_shape_image_two_ofset',
        [
            'label'        => __('Offset', 'droit-addons'),
            'type'         => \Elementor\Controls_Manager::POPOVER_TOGGLE,
            'label_on'     => __('Custom', 'droit-addons'),
            'label_off'    => __('None', 'droit-addons'),
            'return_value' => 'yes',
            'condition' => [
                $this->get_control_id('_s_h_section_shape') => ['yes'],
            ],
        ]
    );

    $this->start_popover();

        $this->add_responsive_control(
            '_testimonial_shape_image_two_move_top',
            [
                'label'       => __('Top/Bottom', 'droit-addons'),
                'type'        => \Elementor\Controls_Manager::SLIDER,
                'size_units'  => ['px', '%', 'em', 'rem'],
                'condition'   => [
                    $this->get_control_id('_testimonial_shape_image_two_ofset') => ['yes'],
                ],
                'range' => [
                    'em' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 0.1,
                    ],
                    'rem' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 0.1,
                    ],
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],
                'render_type' => 'ui',
                'default' => [
                    'unit' => '%',
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl_testimonial_section_shape .dl_parallax_img_2' => 'top: {{SIZE}}{{UNIT}};',
                    '(desktop){{WRAPPER}} .dl_testimonial_section_shape .dl_parallax_img_2' => 'top: {{SIZE}}{{UNIT}};',
                    '(tablet){{WRAPPER}} .dl_testimonial_section_shape .dl_parallax_img_2' => 'top: {{SIZE}}{{UNIT}};',
                    '(mobile){{WRAPPER}} .dl_testimonial_section_shape .dl_parallax_img_2' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            '_testimonial_shape_image_two_move_left',
            [
                'label'      => __('Left/Right', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'condition'  => [
                    $this->get_control_id('_testimonial_shape_image_two_ofset') => ['yes'],
                ],
                'range' => [
                    'em' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 0.1,
                    ],
                    'rem' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 0.1,
                    ],
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],
                'render_type' => 'ui',
                'default' => [
                    'unit' => '%',
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl_testimonial_section_shape .dl_parallax_img_2' => 'left: {{SIZE}}{{UNIT}};',
                    '(desktop){{WRAPPER}} .dl_testimonial_section_shape .dl_parallax_img_2' => 'left: {{SIZE}}{{UNIT}};',
                    '(tablet){{WRAPPER}} .dl_testimonial_section_shape .dl_parallax_img_2' => 'left: {{SIZE}}{{UNIT}};',
                    '(mobile){{WRAPPER}} .dl_testimonial_section_shape .dl_parallax_img_2' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_popover();
        $this->add_control(
            '_testimonial_shape_image_three', [
                'label'      => __('Image', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::MEDIA,
                'default'    => [
                    'url' => dl_place_img(),
                ],
                'show_label' => false,
                'condition' => [
                    $this->get_control_id('_s_h_section_shape') => ['yes'],
                ],
            ]
        );

        $this->add_control(
        '_testimonial_shape_image_three_ofset',
        [
            'label'        => __('Offset', 'droit-addons'),
            'type'         => \Elementor\Controls_Manager::POPOVER_TOGGLE,
            'label_on'     => __('Custom', 'droit-addons'),
            'label_off'    => __('None', 'droit-addons'),
            'return_value' => 'yes',
            'condition' => [
                $this->get_control_id('_s_h_section_shape') => ['yes'],
            ],
        ]
    );
    
    $this->start_popover();

        $this->add_responsive_control(
            '_testimonial_shape_image_three_move_top',
            [
                'label'       => __('Top/Bottom', 'droit-addons'),
                'type'        => \Elementor\Controls_Manager::SLIDER,
                'size_units'  => ['px', '%', 'em', 'rem'],
                'condition'   => [
                    $this->get_control_id('_testimonial_shape_image_three_ofset') => ['yes'],
                ],
                'range' => [
                    'em' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 0.1,
                    ],
                    'rem' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 0.1,
                    ],
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],
                'render_type' => 'ui',
                'default' => [
                    'unit' => '%',
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl_testimonial_section_shape .dl_parallax_img_3' => 'top: {{SIZE}}{{UNIT}};',
                    '(desktop){{WRAPPER}} .dl_testimonial_section_shape .dl_parallax_img_3' => 'top: {{SIZE}}{{UNIT}};',
                    '(tablet){{WRAPPER}} .dl_testimonial_section_shape .dl_parallax_img_3' => 'top: {{SIZE}}{{UNIT}};',
                    '(mobile){{WRAPPER}} .dl_testimonial_section_shape .dl_parallax_img_3' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            '_testimonial_shape_image_three_move_left',
            [
                'label'      => __('Left/Right', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'condition'  => [
                    $this->get_control_id('_testimonial_shape_image_three_ofset') => ['yes'],
                ],
                'range' => [
                    'em' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 0.1,
                    ],
                    'rem' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 0.1,
                    ],
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],
                'render_type' => 'ui',
                'default' => [
                    'unit' => '%',
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl_testimonial_section_shape .dl_parallax_img_3' => 'left: {{SIZE}}{{UNIT}};',
                    '(desktop){{WRAPPER}} .dl_testimonial_section_shape .dl_parallax_img_3' => 'left: {{SIZE}}{{UNIT}};',
                    '(tablet){{WRAPPER}} .dl_testimonial_section_shape .dl_parallax_img_3' => 'left: {{SIZE}}{{UNIT}};',
                    '(mobile){{WRAPPER}} .dl_testimonial_section_shape .dl_parallax_img_3' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_popover();
        $this->end_controls_section();
    }

    // Navigation
    public function register_testimonial_navigation_controls( ) {
        $this->start_controls_section(
            '_droit_testimonial_nav_control',
            [
                'label' => __( 'Navigation', 'droit-addons' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    $this->get_control_id('_testimonial_skin_type') => [ 'dl_slider_second', 'dl_slider_three' ],
                ],
            ]
        );

        $this->add_control(
            'testimonial_slider_nav_show',
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
        '_testimonial_nav_left_top_ofset',
        [
            'label'        => __('Left Button', 'droit-addons'),
            'type'         => \Elementor\Controls_Manager::POPOVER_TOGGLE,
            'label_on'     => __('Custom', 'droit-addons'),
            'label_off'    => __('None', 'droit-addons'),
            'return_value' => 'yes',
            'condition' => [
                $this->get_control_id('testimonial_slider_nav_show') => [ 'yes' ],
            ],
        ]
    );

    $this->start_popover();

        $this->add_responsive_control(
            '_testimonial_nav_left_top',
            [
                'label'       => __('Top/Bottom', 'droit-addons'),
                'type'        => \Elementor\Controls_Manager::SLIDER,
                'size_units'  => ['px', '%', 'em', 'rem'],
                'condition'   => [
                    $this->get_control_id('_testimonial_nav_left_top_ofset') => [ 'yes' ],
                ],
                'range' => [
                    'em' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 0.1,
                    ],
                    'rem' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 0.1,
                    ],
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],
                'render_type' => 'ui',
                'default' => [
                        'unit' => '%',
                    ],
                'selectors' => [
                    '{{WRAPPER}} .swiper_button_prev' => 'top: {{SIZE}}{{UNIT}};',
                    '(desktop){{WRAPPER}} .swiper_button_prev' => 'top: {{SIZE}}{{UNIT}};',
                    '(tablet){{WRAPPER}} .swiper_button_prev' => 'top: {{SIZE}}{{UNIT}};',
                    '(mobile){{WRAPPER}} .swiper_button_prev' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            '_testimonial_nav_left_left',
            [
                'label'      => __('Left/Right', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'condition'  => [
                    $this->get_control_id('_testimonial_nav_left_top_ofset') => [ 'yes' ],
                ],
                'range' => [
                    'em' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 0.1,
                    ],
                    'rem' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 0.1,
                    ],
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],
                'render_type' => 'ui',
                'default' => [
                        'unit' => '%',
                    ],
                'selectors' => [
                    '{{WRAPPER}} .swiper_button_prev' => 'left: {{SIZE}}{{UNIT}};',
                    '(desktop){{WRAPPER}} .swiper_button_prev' => 'left: {{SIZE}}{{UNIT}};',
                    '(tablet){{WRAPPER}} .swiper_button_prev' => 'left: {{SIZE}}{{UNIT}};',
                    '(mobile){{WRAPPER}} .swiper_button_prev' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_popover();

        $this->add_control(
        '_testimonial_nav_right_top_ofset',
        [
            'label'        => __('Right', 'droit-addons'),
            'type'         => \Elementor\Controls_Manager::POPOVER_TOGGLE,
            'label_on'     => __('Custom', 'droit-addons'),
            'label_off'    => __('None', 'droit-addons'),
            'return_value' => 'yes',
            'condition' => [
                $this->get_control_id('testimonial_slider_nav_show') => [ 'yes' ],
            ],
        ]
    );
    
    $this->start_popover();

        $this->add_responsive_control(
            '_testimonial_nav_right_top',
            [
                'label'       => __('Top/Bottom', 'droit-addons'),
                'type'        => \Elementor\Controls_Manager::SLIDER,
                'size_units'  => ['px', '%', 'em', 'rem'],
                'condition'   => [
                    $this->get_control_id('_testimonial_nav_right_top_ofset') => [ 'yes' ],
                ],
                'range' => [
                    'em' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 0.1,
                    ],
                    'rem' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 0.1,
                    ],
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],
                'render_type' => 'ui',
                'default' => [
                    'unit' => '%',
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper_button_next' => 'top: {{SIZE}}{{UNIT}};',
                    '(desktop){{WRAPPER}} .swiper_button_next' => 'top: {{SIZE}}{{UNIT}};',
                    '(tablet){{WRAPPER}} .swiper_button_next' => 'top: {{SIZE}}{{UNIT}};',
                    '(mobile){{WRAPPER}} .swiper_button_next' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            '_testimonial_nav_right_left',
            [
                'label'      => __('Left/Right', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'condition'  => [
                    $this->get_control_id('_testimonial_nav_right_top_ofset') => [ 'yes' ],
                ],
                'range' => [
                    'em' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 0.1,
                    ],
                    'rem' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 0.1,
                    ],
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],
                'render_type' => 'ui',
                'default' => [
                    'unit' => '%',
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper_button_next' => 'left: {{SIZE}}{{UNIT}};',
                    '(desktop){{WRAPPER}} .swiper_button_next' => 'left: {{SIZE}}{{UNIT}};',
                    '(tablet){{WRAPPER}} .swiper_button_next' => 'left: {{SIZE}}{{UNIT}};',
                    '(mobile){{WRAPPER}} .swiper_button_next' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_popover();
        $this->end_controls_section();
    }

    public function register_testimonial_alignment_controls() {
        $this->start_controls_section(
            '_droit_testimonial_alignment_control',
            [
                'label' => __( 'Alignment', 'droit-addons' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    $this->get_control_id('_testimonial_skin_type') => [ 'dl_slider_three' ],
                ],
            ]
        );

        $this->add_control(
            'dl_image_icon_text_alignment_control',
            [
                'label'     => __('Align Items', 'droit-addons'),
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
                'condition' => [
                    $this->get_control_id('_testimonial_skin_type') => [ 'dl_slider_three' ],
                ],
            ]
        );

        $this->add_control(
            'dl_image_text_alignment',
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
                    '{{WRAPPER}} .dl_single_testimonial_slider.style_06' => 'text-align: {{VALUE}};',
                ],
                'condition' => [
                    $this->get_control_id('_testimonial_skin_type') => [ 'dl_slider_three' ],
                ],
            ]
        ); 

        $this->add_control(
            '_dl_testimonial_content_gap',
            [
                'label'      => esc_html__('Content Gap', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .dl_single_testimonial_slider.style_06 .dl_client_img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                
            ]
        );


        $this->end_controls_section();
    } 

    protected function _title_link_header() {
        $settings = $this->get_settings_for_display();

        if (!$this->get_testimonial_settings('_testimonial_link')['url']) {
            return;
        }
        printf('<a %1$s>', dl_generate_link($this->get_testimonial_settings('_testimonial_link'), false));

    }

    protected function _title_link_footer() {
        $settings = $this->get_settings_for_display();

        if (!$this->get_testimonial_settings('_testimonial_link')['url']) {
            return;
        }
        printf('</a>');
    }


    protected function _testimonial_shape($shap_image = "") {
        $settings = $this->get_settings_for_display();

        if (!$this->get_testimonial_settings('_s_h_shap')) {
            return;
        }
        $class_name = '';
        if ($this->get_testimonial_settings('_testimonial_skin_type') == 'dl_slider_second') {
            $class_name =  'quote_img';
        }elseif($this->get_testimonial_settings('_testimonial_skin_type') == 'dl_slider_three'){
            $class_name =  'quotation_mark';
        }else{
            $class_name =  'dl_img_shape_1';
        }
        if(!empty($shap_image)){
        ?>
        <img src="<?php echo $shap_image; ?>" alt="shape image" class="<?php echo esc_attr($class_name); ?>">
    <?php }}

    //Image
    protected function _testimonial_image($image_url, $alt_text = "Testimonial Image") {
        $settings = $this->get_settings_for_display();
        if (!$this->get_testimonial_settings('_s_h_image')) {
            return;
        }
        $thumb_class = $this->get_testimonial_settings('_testimonial_skin_type') == 'dl_slider_three' ? 'dl_client_thumb' : 'dl_client_img dl_inline_block';
        ?>
        <img class="<?php echo $thumb_class; ?>" src="<?php echo esc_url($image_url); ?>" alt="<?php echo __($alt_text, 'droit-addons'); ?>">
<?php }

    //Heading
    protected function _testimonial_heading($name) {
        $settings = $this->get_settings_for_display();
        if (!$this->get_testimonial_settings('_s_h_title')) {
            return;
        }
        ?>
        <h5 class="dl_sub_title"><?php echo __($name, 'droit-addons'); ?></h5>
<?php }

    //Name
    protected function _testimonial_name($name) {
        $settings = $this->get_settings_for_display();
        if (!$this->get_testimonial_settings('_s_h_name')) {
            return;
        }
        ?>
        <h4 class="dl_name droit-testimonial-name"><?php echo __($name, 'droit-addons'); ?></h4>
<?php }

    //Designation
    protected function _testimonial_position($position) {
        $settings = $this->get_settings_for_display();
        if (!$this->get_testimonial_settings('_s_h_deg')) {
            return;
        }
        ?>
        <p class="dl_position droit-testimonial-designation">
          <?php echo __($position, 'droit-addons'); ?>
        </p>
<?php }

    //Content
    protected function _testimonial_content($content)
    {
        $settings = $this->get_settings_for_display();
        if (!$this->get_testimonial_settings('_s_h_con')) {
            return;
        }
        ?>
        <h4 class="dl_content droit-testimonial-content"><?php echo __(nl2br($content), 'droit-addons'); ?></h4>
<?php }

    //Html render
    protected function render() {
        $settings  = $this->get_settings_for_display();
        $_testimonial_skin_type = $this->get_testimonial_settings('_testimonial_skin_type');

        switch ($_testimonial_skin_type) {
            case 'dl_slider':
               $this->_testimonial_slider();   
                break;

            case 'dl_slider_second':
               $this->_testimonial_slider_second();
                break;

            case 'dl_slider_three':
               $this->_testimonial_slider_three();
                break;
            
            default:
                $this->_testimonial_slider();
                break;
        }
    }

    // Slider Render
    protected function _testimonial_slider() {  
        $settings                       = $this->get_settings_for_display();
        extract($settings);
        $testimonial_items              = $this->get_testimonial_settings('testimonial_list');
        $_shape_image                   = $this->get_testimonial_settings('_shape_image');
        $dl_slider_item_check           = 'yes' === $this->get_testimonial_settings('_dl_testimonial_slider_breakpoints_one') ? '' : $this->get_testimonial_settings('testimonial_slider_perpage');
        //Slider Option
        $slider_autoplay                = $this->get_testimonial_settings('testimonial_slider_autoplay');
        $slider_speed                   = $this->get_testimonial_settings('testimonial_slider_speed');
        $slider_loop                    = $this->get_testimonial_settings('testimonial_slider_loop');
        $slider_space                   = $this->get_testimonial_settings('testimonial_slider_space');
        $slider_item                    = $dl_slider_item_check;
        $slider_drag                    = $this->get_testimonial_settings('testimonial_slider_drag');
        
        /*Responsive Item*/
        $dl_break_points = [];
        if('yes' === $this->get_testimonial_settings('_dl_testimonial_slider_breakpoints_one')){
            $dl_breakpoints_items = $this->get_testimonial_settings('_dl_testimonial_breakpoints_one');
            foreach ($dl_breakpoints_items as $dl_breakpoints_item) {
                $dl_break_points[$dl_breakpoints_item['_dl_testimonial_breakpoints_device_width_one']] = [
                    'slidesPerView' => $dl_breakpoints_item['_dl_testimonial_breakpoints_per_view_one'],
                    'spaceBetween' => $dl_breakpoints_item['_dl_testimonial_breakpoints_space_one'],
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
            'slider_next'                   => '.image_slider_next_'.$this->get_testimonial_settings('_testimonial_skin_type'),
            'slider_prev'                   => '.image_slider_prev_'.$this->get_testimonial_settings('_testimonial_skin_type'),
            'slider_paginationtype'         => 'bullets',
            'slider_pagination'             => '.img_carousel_pagination',
            'slider_effect'                 => '',
            'slider_center'                 => '',
            'slider_breakpoints'            => $dl_break_points_controls,
        ];
        $slide_controls = \json_encode($slide_controls);
        ?> 
        <div class="mouse_move_animation dl_testimonial_section_shape">
        <div class="dl_testimonial_slider droit-testimonial">
             <div class="swiper-container" data-controls="<?php echo esc_attr($slide_controls); ?>">
                <div class="swiper-wrapper">
                     <?php if (isset($testimonial_items) && !empty($testimonial_items)):
                    foreach ($testimonial_items as $item):
                        $t_img = $item['testimonial_image']['url'];
                        $img   = !empty($t_img) ? $t_img : dl_place_img();
                        ?>
                    <div class="swiper-slide">
                        <div class="dl_single_testimonial_slider style_01">
                             <?php $this->_testimonial_heading($item['testimonial_heading']);?>
                            
                            <?php $this->_testimonial_content($item['testimonial_text']);?>
                            <div class="dl_client_info">
                                <?php 
                                //print_r($item['on_off_client_image']);
                                    //if($item['on_off_client_image'] === 'yes'){
                                        $this->_testimonial_image($img, $item['testimonial_name']);
                                    //}
                                    $this->_testimonial_name($item['testimonial_name']);
                                    $this->_testimonial_position($item['testimonial_designation']);
                                    if(!empty($_shape_image)){
                                        $this->_testimonial_shape($_shape_image['url']);
                                    }
                                    
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach;endif;?>
                </div>
            </div>
        </div>
        <?php if ($this->get_testimonial_settings('_s_h_section_shape') == 'yes'): ?>
            <div class="parallax-shape">
                <div class="dl_parallax_img_1 wow slideInnew" data-wow-delay="1s">
                    <?php if(!empty($this->get_testimonial_settings('_testimonial_shape_image_one')['url'])): ?>
                        <div class="layer layer2" data-depth="0.30"><img src="<?php echo $this->get_testimonial_settings('_testimonial_shape_image_one')['url'] ?>" alt="#" data-parallax='{"x":50, "y": 80}'></div>
                    <?php endif; ?>
                </div>
                <div class="dl_parallax_img_2 wow slideInnew" data-wow-delay="1s">
                    <?php if(!empty($this->get_testimonial_settings('_testimonial_shape_image_two')['url'])): ?>
                        <div class="layer layer2" data-depth="-0.30"><img src="<?php echo $this->get_testimonial_settings('_testimonial_shape_image_two')['url'] ?>" alt="#" data-parallax='{"x": 80, "y": 80, "rotateY":2000}'></div>
                    <?php endif; ?>
                </div>
                <div class="dl_parallax_img_3 wow slideInnew" data-wow-delay="1s">
                    <?php if(!empty($this->get_testimonial_settings('_testimonial_shape_image_three')['url'])): ?>
                        <div class="layer layer2" data-depth="0.40"><img src="<?php echo $this->get_testimonial_settings('_testimonial_shape_image_three')['url'] ?>" alt="#" data-parallax='{"x": -180, "y": 80, "rotateY":2000}'></div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
         </div>
<?php }

    protected function _testimonial_slider_second() {
        $settings                       = $this->get_settings_for_display();
        $testimonial_items              = $this->get_testimonial_settings('testimonial_list');
        $_shape_image                   = $this->get_testimonial_settings('_shape_image');
        $dl_slider_item_check           = 'yes' === $this->get_testimonial_settings('_dl_testimonial_slider_breakpoints_one') ? '' : $this->get_testimonial_settings('testimonial_slider_perpage');
        //Slider Option
        $slider_autoplay                = $this->get_testimonial_settings('testimonial_slider_autoplay');
        $slider_speed                   = $this->get_testimonial_settings('testimonial_slider_speed');
        $slider_loop                    = $this->get_testimonial_settings('testimonial_slider_loop');
        $slider_space                   = $this->get_testimonial_settings('testimonial_slider_space');
        $slider_item                    = $dl_slider_item_check;
        $slider_drag                    = $this->get_testimonial_settings('testimonial_slider_drag');

        /*Responsive Item*/
        $dl_break_points = [];
        if('yes' === $this->get_testimonial_settings('_dl_testimonial_slider_breakpoints_one')){
            $dl_breakpoints_items = $this->get_testimonial_settings('_dl_testimonial_breakpoints_one');
            foreach ($dl_breakpoints_items as $dl_breakpoints_item) {
                $dl_break_points[$dl_breakpoints_item['_dl_testimonial_breakpoints_device_width_one']] = [
                    'slidesPerView' => $dl_breakpoints_item['_dl_testimonial_breakpoints_per_view_one'],
                    'spaceBetween' => $dl_breakpoints_item['_dl_testimonial_breakpoints_space_one'],
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
            'slider_next'                   => '.image_slider_next_'.$this->get_testimonial_settings('_testimonial_skin_type'),
            'slider_prev'                   => '.image_slider_prev_'.$this->get_testimonial_settings('_testimonial_skin_type'),
            'slider_paginationtype'         => 'bullets',
            'slider_pagination'             => '.img_carousel_pagination',
            'slider_effect'                 => '',
            'slider_center'                 => '',
            'slider_breakpoints'            => $dl_break_points_controls,
        ];
        $slide_controls = \json_encode($slide_controls);
        ?>
        <div class="dl_testimonial_slider droit-testimonial">
            <div class="swiper-container" data-controls="<?php echo esc_attr($slide_controls); ?>">
                <div class="swiper-wrapper">
                    <?php if (isset($testimonial_items) && !empty($testimonial_items)):
                    foreach ($testimonial_items as $item): ?>
                    <div class="swiper-slide">
                        <div class="dl_single_testimonial_slider style_03">
                             <?php 
                                $this->_testimonial_shape($_shape_image['url']);
                                $this->_testimonial_content($item['testimonial_text']);
                             ?>
                            <div class="dl_client_info">
                                 <?php 
                                  $this->_testimonial_name($item['testimonial_name']);
                                  $this->_testimonial_position($item['testimonial_designation']);
                                 ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; endif; ?>
                </div>
            </div>
            <?php if ($this->get_testimonial_settings('testimonial_slider_nav_show') == 'yes'): ?>
                <div class="dl_testimonial_navigation">
                    <div class="swiper_button_prev image_slider_prev_<?php echo $this->get_testimonial_settings('_testimonial_skin_type'); ?>" tabindex="0" role="button" aria-label="Previous slide">
                        <img src="<?php echo drdt_core()->images; ?>prev.svg" alt="#">
                    </div>
                    <div class="swiper_button_next image_slider_next_<?php echo $this->get_testimonial_settings('_testimonial_skin_type'); ?>" tabindex="0" role="button" aria-label="Next slide">
                        <img src="<?php echo drdt_core()->images; ?>next.svg" alt="#">
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <?php if (isset($testimonial_items) && !empty($testimonial_items)): ?>
         <div class="dl_client_logo_list">
             <?php
            foreach ($testimonial_items as $item):
                $t_img = $item['testimonial_image']['url'];
                $img   = !empty($t_img) ? $t_img : dl_place_img();
                ?>
                <a href="<?php echo esc_url($item['testimonial_link']['url']); ?>">
                   <?php  $this->_testimonial_image($img, $item['testimonial_name']); ?>
                </a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
<?php }

    // Without Slider Render
    protected function _testimonial_slider_three() {
        $settings                       = $this->get_settings_for_display();
        extract($settings);
        $testimonial_items              = $this->get_testimonial_settings('testimonial_list');
        $_shape_image                   = $this->get_testimonial_settings('_shape_image');
        $dl_slider_item_check           = 'yes' === $this->get_testimonial_settings('_dl_testimonial_slider_breakpoints_one') ? '' : $this->get_testimonial_settings('testimonial_slider_perpage');
        //Slider Option
        $slider_autoplay                = $this->get_testimonial_settings('testimonial_slider_autoplay');
        $slider_speed                   = $this->get_testimonial_settings('testimonial_slider_speed');
        $slider_loop                    = $this->get_testimonial_settings('testimonial_slider_loop');
        $slider_space                   = $this->get_testimonial_settings('testimonial_slider_space');
        $slider_item                    = $dl_slider_item_check;
        $slider_drag                    = $this->get_testimonial_settings('testimonial_slider_drag');
        /*Responsive Item*/
        $dl_break_points = [];
        if('yes' === $this->get_testimonial_settings('_dl_testimonial_slider_breakpoints_one')){
            $dl_breakpoints_items = $this->get_testimonial_settings('_dl_testimonial_breakpoints_one');
            foreach ($dl_breakpoints_items as $dl_breakpoints_item) {
                $dl_break_points[$dl_breakpoints_item['_dl_testimonial_breakpoints_device_width_one']] = [
                    'slidesPerView' => $dl_breakpoints_item['_dl_testimonial_breakpoints_per_view_one'],
                    'spaceBetween' => $dl_breakpoints_item['_dl_testimonial_breakpoints_space_one'],
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
            'slider_next'                   => '.image_slider_next_'.$this->get_testimonial_settings('_testimonial_skin_type'),
            'slider_prev'                   => '.image_slider_prev_'.$this->get_testimonial_settings('_testimonial_skin_type'),
            'slider_paginationtype'         => 'bullets',
            'slider_pagination'             => '.img_carousel_pagination',
            'slider_effect'                 => '',
            'slider_center'                 => '',
            'slider_breakpoints'            => $dl_break_points_controls,
        ];
        $slide_controls = \json_encode($slide_controls);
    ?>
    <div class="dl_testimonial_slider droit-testimonial">
    <div class="swiper-container" data-controls="<?php echo esc_attr($slide_controls); ?>">
        <div class="swiper-wrapper">
            <?php if (isset($testimonial_items) && !empty($testimonial_items)):
            foreach ($testimonial_items as $item): 
                $t_img = $item['testimonial_image']['url'];
                $img   = !empty($t_img) ? $t_img : dl_place_img();
                ?>
            <div class="swiper-slide">
                <div class="dl_single_testimonial_slider style_06 <?php if($dl_image_icon_text_alignment_control == 'right'){echo 'item_right ';}
                                                                        if($dl_image_icon_text_alignment_control == 'left'){echo 'item_left';}
                 ?> ">
                    <div class="dl_client_img">
                        <?php  $this->_testimonial_image($img, $item['testimonial_name']); ?>
                    </div>
                    <div class="dl_client_description">
                        <?php 
                            $this->_testimonial_shape($_shape_image['url']);
                            $this->_testimonial_content($item['testimonial_text']);
                         ?>
                        <div class="dl_client_info">
                            <?php 
                              $this->_testimonial_name($item['testimonial_name']);
                              $this->_testimonial_position($item['testimonial_designation']);
                             ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; endif; ?>
        </div>
    </div>
    <?php if ($this->get_testimonial_settings('testimonial_slider_nav_show') == 'yes'): ?>
        <div class="dl_testimonial_navigation">
            <div class="swiper_button_prev image_slider_prev_<?php echo $this->get_testimonial_settings('_testimonial_skin_type'); ?>" tabindex="0" role="button" aria-label="Previous slide">
                <img src="<?php echo drdt_core()->images; ?>prev.svg" alt="#">
            </div>
            <div class="swiper_button_next image_slider_next_<?php echo $this->get_testimonial_settings('_testimonial_skin_type'); ?>" tabindex="0" role="button" aria-label="Next slide">
                <img src="<?php echo drdt_core()->images; ?>next.svg" alt="#">
            </div>
        </div>
    <?php endif; ?>
    </div>
<?php }

    protected function content_template(){}
}
