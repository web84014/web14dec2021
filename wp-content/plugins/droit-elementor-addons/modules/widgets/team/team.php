<?php
namespace DROIT_ELEMENTOR\Widgets;

if (!defined('ABSPATH')) {exit;}

class Droit_Addons_Team extends \Elementor\Widget_Base {

    // Get Control ID
	protected function get_control_id( $control_id ) {
        return $control_id;
    }

    final public function get_team_settings( $control_key ) {
        $control_id = $this->get_control_id( $control_key );
        return $this->get_settings( $control_id );
    }

    public function get_name() {
        return 'droit-team';
    }
    
    public function get_title() {
        return esc_html__( 'Team Member', 'droit-addons' );
    }

    public function get_icon() {
        return 'dlicons-Team addons-icon';
    }

    public function get_keywords() {
        return [
            'team',
            'member',
            'team member',
            'dl team member',
            'dl team members',
            'droit team member',
            'droit team members',
            'person',
            'card',
            'meet the team',
            'team builder',
            'our team',
            'droit',
            'dl',
            'droit elementor addons',
        ];
    }

    public function get_categories() {
        return ['droit_addons'];
    }

    protected function _register_controls(){
        $this->register_team_member_preset_controls();
        $this->register_team_member_content_control();
        $this->register_team_member_social_control(); 
        $this->register_team_member_image_control_second_layout(); 
        $this->register_team_member_image_control_third_layout();  
        $this->register_team_member_icon_control(); 
        $this->register_team_member_content_style_control();
        do_action('dl_widget/section/style/custom_css', $this); 
      }

      //Preset
    public function register_team_member_preset_controls() {
    	$this->start_controls_section(
            '_team_member_layout_section',
            [
                'label' => esc_html__('Preset', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

    	$this->register_team_member_skin();
    	
        $this->end_controls_section();
    }

	//Skin
	protected function register_team_member_skin(){
		$this->add_control(
            '_team_member_skin',
            [
                'label' => esc_html__( 'Design Format', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'label_block' => false,
                'options'   => [
                    '_skin_2' => 'Style 01',
                    '_skin_3' => 'Style 02',
                ],
                'default' => '_skin_2'
            ]
        );
    }
    
	//Content
	public function register_team_member_content_control(){
		$this->start_controls_section(
            '_team_member_content_section',
            [
                'label' => esc_html__('Content', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
    	
		$this->add_control(
			'_dl_team_member_image',
			[
				'label' => __( 'Avatar', 'droit-addons'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);


		$this->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'default' => 'full',
				'condition' => [
                    $this->get_control_id( '_dl_team_member_image[url]!' ) => '',
                ],
			]
		);

		$this->add_control(
			'_dl_team_member_name',
			[
				'label' => esc_html__( 'Name', 'droit-addons'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'John Smith', 'droit-addons'),
			]
		);
		
		$this->add_control(
			'_dl_team_member_job_title',
			[
				'label' => esc_html__( 'Job Title', 'droit-addons'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Software Engineer', 'droit-addons'),
			]
		);

		$this->add_control(
			'_dl_team_member_link',
			[
				'label' => esc_html__( 'Link', 'droit-addons'),
				'type' => \Elementor\Controls_Manager::URL,
				'label_block' => true,
				'default' => [
					'url' => '',
					'is_external' => 'true',
				],
				'placeholder' => esc_html__( 'Place URL here', 'droit-addons'),
				'condition' => [
                    $this->get_control_id( '_dl_team_member_name!' ) => '',
                ],
			]
		);

		$this->add_control(
            '_dl_team_member_tag',
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
                'condition' => [
                    $this->get_control_id( '_dl_team_member_name!' ) => '',
                ],
                
            ]
        );

        $this->end_controls_section();   
	}

	//Social
	public function register_team_member_social_control(){
		$this->start_controls_section(
            '_dl_team_member_social_section',
            [
                'label' => esc_html__('Social Profile', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                	$this->get_control_id('_team_member_skin!') => ['_skin_2']
                ]
            ]
        );
    	
		$this->add_control(
			'_dl_team_member_enable_social_profiles',
			[
				'label' => esc_html__( 'Display Social Profiles?', 'droit-addons'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$repeater = new \Elementor\Repeater();
		
		$repeater->add_control(
			'_dl_social_new',
			[
				'label' => esc_html__( 'Icon', 'droit-addons'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'fa4compatibility' => '_dl_social',
				'default' => [
					'value' => 'fab fa-wordpress',
					'library' => 'fa-brands',
				],
			]
		);

		$repeater->add_control(
			'_dl_link',
			[
				'label' => esc_html__( 'Link', 'droit-addons'),
				'type' => \Elementor\Controls_Manager::URL,
				'label_block' => true,
				'default' => [
					'url' => '',
					'is_external' => 'true',
				],
				'placeholder' => esc_html__( 'Place URL here', 'droit-addons'),
			]
		);

		$this->add_control(
			'_dl_team_member_social_profile_links',
			[
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'condition' => [
                    $this->get_control_id( '_dl_team_member_enable_social_profiles!' ) => '',
                ],
				'default' => [
					[
						'_dl_social_new' => [
							'value' => 'fab fa-facebook',
							'library' => 'fa-brands'
						]
					],
					[
						'_dl_social_new' => [
							'value' => 'fab fa-pinterest',
							'library' => 'fa-brands'
						]
					],
					[
						'_dl_social_new' => [
							'value' => 'fab fa-twitter',
							'library' => 'fa-brands'
						]
					],
					
				],
				
				'title_field' => '<i class="{{ _dl_social_new.value }}"></i>',
			]
		);

        $this->end_controls_section();   
	}

    public function register_team_member_image_control_second_layout(){

        $this->start_controls_section(
            '_dl_team_member_image_style_second_section',
            [
                'label'     => __('General', 'droit-addons'),
                'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    $this->get_control_id( '_dl_team_member_image[url]!' ) => '',
                    $this->get_control_id( '_team_member_skin' ) => ['_skin_2'],
                ],
            ]
        );
                
        $this->add_responsive_control(
            'image_pading_second',
            [
                'label'      => __('Padding', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .droit-team-member-wrapper .droit-team-member-thumb-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
                  [
                      'name' => '_dl_header_badge_border',
                      'label' => esc_html__('Border', 'droit-addons'),
                      'selector' => '{{WRAPPER}} .dl_thumbnail_fluid img',
                        
                  ]
            );

        $this->add_control(
			'_dl_header_badge_border_radius',
			[
				'label'      => __( 'Border Radius', 'droit-addons-pro' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ '%' ],
				'selectors'  => [
					'{{WRAPPER}} .dl_thumbnail_fluid img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


        $this->end_controls_section();
    }
    
    public function register_team_member_image_control_third_layout(){

        $this->start_controls_section(
            '_dl_team_member_image_style_third_section',
            [
                'label'     => __('Image', 'droit-addons'),
                'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    $this->get_control_id( '_dl_team_member_image[url]!' ) => '',
                    $this->get_control_id( '_team_member_skin' ) => ['_skin_3'],
                ],
            ]
        );

        $this->add_control(
            '_dl_team_member_image_ofset_third',
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
            'image_offset_x_third',
            [
                'label'       => __('Offset Left', 'droit-addons'),
                'type'        => \Elementor\Controls_Manager::SLIDER,
                'size_units'  => ['px', '%', 'em', 'rem'],
                'condition'   => [
                    $this->get_control_id( '_dl_team_member_image_ofset_third' ) => ['yes'],
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
            'image_offset_y_third',
            [
                'label'      => __('Offset Top', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'condition'  => [
                    $this->get_control_id( '_dl_team_member_image_ofset_third' ) => ['yes'],
                ],
                'range'      => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .droit-team-member-wrapper .droit-team-member-thumb-wrapper' => 'margin-top: {{SIZE}}{{UNIT}};',
                    '(desktop){{WRAPPER}} .droit-team-member-wrapper .droit-team-member-thumb-wrapper'  => '-ms-transform: translate({{image_offset_x_third.SIZE || 0}}{{UNIT}}, {{image_offset_y_third.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{image_offset_x_third.SIZE || 0}}{{UNIT}}, {{image_offset_y_third.SIZE || 0}}{{UNIT}}); transform: translate({{image_offset_x_third.SIZE || 0}}{{UNIT}}, {{image_offset_y_third.SIZE || 0}}{{UNIT}});',

                    '(tablet){{WRAPPER}} .droit-team-member-wrapper .droit-team-member-thumb-wrapper'   => '-ms-transform: translate({{image_offset_x_third_tablet.SIZE || 0}}{{UNIT}}, {{image_offset_y_third_tablet.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{image_offset_x_third_tablet.SIZE || 0}}{{UNIT}}, {{image_offset_y_third_tablet.SIZE || 0}}{{UNIT}}); transform: translate({{image_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{image_offset_y_third_tablet.SIZE || 0}}{{UNIT}});',
                    
                    '(mobile){{WRAPPER}} .droit-team-member-wrapper .droit-team-member-thumb-wrapper'   => '-ms-transform: translate({{image_offset_x_third_mobile.SIZE || 0}}{{UNIT}}, {{image_offset_y_third_mobile.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{image_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{image_offset_y_third_mobile.SIZE || 0}}{{UNIT}}); transform: translate({{image_offset_x_third_mobile.SIZE || 0}}{{UNIT}}, {{image_offset_y_third_mobile.SIZE || 0}}{{UNIT}});',
                ],
            ]
        );

        $this->end_popover();
       
        $this->add_responsive_control(
            'image_pading_third',
            [
                'label'      => __('Padding', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .droit-team-member-wrapper .droit-team-member-thumb-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_spacing_third',
            [
                'label'      => __('Border Radius', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .dl_team_member_wrapper.dl_style_4.zoom_in_effect.droit-team-member-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

	// Icon Style
	public function register_team_member_icon_control(){

        $this->start_controls_section(
            '_dl_team_member_icon_style_section',
            [
                'label'     => __('Icon', 'droit-addons'),
                'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                	$this->get_control_id('_team_member_skin!') => ['_skin_2']
                ]     
            ]
        );
        
        $this->add_control(
			'_dl_team_members_social_icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'droit-addons'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'default'	=> [
					'size'	=> '',
					'unit'	=> 'px'
				],
				'selectors' => [

					'{{WRAPPER}} .droit-team-member-wrapper .droit-team-member-social-wrapper > a i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .droit-team-member-wrapper .droit-team-member-social-wrapper > a img' => 'width: {{SIZE}}px; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'_dl_team_members_social_icons_padding',
			[
				'label'      => esc_html__( 'Icon Padding', 'droit-addons'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .droit-team-member-wrapper .droit-team-member-social-wrapper > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'_dl_team_members_social_icons_spacing',
			[
				'label'      => esc_html__( 'Icon Distance', 'droit-addons'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .droit-team-member-wrapper .droit-team-member-social-wrapper > a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( '_dl_team_members_social_icons_style_tabs' );

		$this->start_controls_tab( 'normal', [ 'label' => esc_html__( 'Normal', 'droit-addons') ] );

		$this->add_control(
			'_dl_team_members_social_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'droit-addons'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .droit-team-member-wrapper .droit-team-member-social-wrapper > a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
             'name' => '_dl_team_members_social_icon_typography',
				'selector' => '{{WRAPPER}} .droit-team-member-wrapper .droit-team-member-social-wrapper > a',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( '_dl_team_members_social_icon_hover', [ 'label' => esc_html__( 'Hover', 'droit-addons') ] );

		$this->add_control(
			'_dl_team_members_social_icon_hover_color',
			[
				'label' => esc_html__( 'Text Color', 'droit-addons'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .droit-team-member-wrapper .droit-team-member-social-wrapper > a:hover' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->end_controls_tab();
		
		$this->end_controls_tabs();

        $this->end_controls_section();
    }

    // Icon Style
	public function register_team_member_content_style_control(){
		$this->start_controls_section(
            '_dl_team_member_content_style_section',
            [
                'label'     => __('Content Style', 'droit-addons'),
                'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( '_dl_team_members_content_style_tabs' );

		$this->start_controls_tab( 'content_normal', [ 'label' => esc_html__( 'Normal', 'droit-addons') ] );

        $this->add_control(
			'_dl_team_members_content_name_color',
			[
				'label' => esc_html__( 'Name Color', 'droit-addons'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} h4.dl_name.droit-team-member-name a' => 'color: {{VALUE}};',
				],
			]
		);

        $this->add_control(
			'_dl_team_members_content_job_title_color',
			[
				'label' => esc_html__( 'Job Title Color', 'droit-addons'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} p.dl_position.droit-team-member-job-title span' => 'color: {{VALUE}};',
				],
                'separator' => 'after'
			]
		);
        
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'dl_team_heading_content_typography',
				'label'    => __( 'Name Typography', 'droit-addons' ),
				'selector' => '{{WRAPPER}} h4.dl_name.droit-team-member-name',
			]
		); 
        
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'dl_team_heading_desc_typography',
				'label'    => __( 'Desc Typography', 'droit-addons' ),
				'selector' => '{{WRAPPER}} p.dl_position.droit-team-member-job-title span',
			]
		);

        $this->add_control(
            '_dl_team_member_team_section_ofset',
            [
                'label'        => __('Content Offset', 'droit-addons'),
                'type'         => \Elementor\Controls_Manager::POPOVER_TOGGLE,
                'label_on'     => __('Custom', 'droit-addons'),
                'label_off'    => __('None', 'droit-addons'),
                'return_value' => 'yes',
            ]
        );

        $this->start_popover();

        $this->add_responsive_control(
            'team_title_offset_section_y',
            [
                'label'      => __('Offset Top', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .dl_team_content_inner.droit-team-member-inner' => 'transform: translateY({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->end_popover();

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => '_dl_team_members_content_inner_background',
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .dl_team_content_inner.droit-team-member-inner',
            ]
        );

		$this->end_controls_tab();

		$this->start_controls_tab( '_dl_team_members_content_items_hover', [ 'label' => esc_html__( 'Hover', 'droit-addons') ] );

        $this->add_control(
			'_dl_team_members_content_name_hover_color',
			[
				'label' => esc_html__( 'Name Color', 'droit-addons'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} h4.dl_name.droit-team-member-name a:hover' => 'color: {{VALUE}};',
				],
			]
		);

        $this->add_control(
			'_dl_team_members_content_job_title_hover_color',
			[
				'label' => esc_html__( 'Job Title Color', 'droit-addons'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} p.dl_position.droit-team-member-job-title span:hover' => 'color: {{VALUE}};',
				],
			]
		);

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => '_dl_team_members_content_inner_hover_background',
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .dl_team_content_inner.droit-team-member-inner:hover',
            ]
        );

		$this->end_controls_tab();
		
		$this->end_controls_tabs();

        $this->end_controls_section();
    }
  
    //Html render
    protected function render(){
        $settings = $this->get_settings_for_display();

        $_team_member_skin  = !empty($this->get_team_settings('_team_member_skin')) ? $this->get_team_settings('_team_member_skin') : '_skin_2';

        switch ($_team_member_skin) {
            case '_skin_2':
                $this->_second_team_member_layout();
                break;
            case '_skin_3':
                $this->_third_team_member_layout();
                break;
            default:
                $this->_second_team_member_layout();
                break;
        }
    }
  
    // Layout Second
    protected function _second_team_member_layout(){
  
        $settings = $this->get_settings_for_display();
        extract($settings);
        
        $is_name_target = $this->get_team_settings('_dl_team_member_link')['is_external'] ? ' target="_blank"' : '';
    
        $team_member_image = $this->get_team_settings( '_dl_team_member_image' );
            $team_member_image_url = \Elementor\Group_Control_Image_Size::get_attachment_image_src( $team_member_image['id'], 'thumbnail', $settings );    
        if( empty( $team_member_image_url ) ) : $team_member_image_url = $team_member_image['url']; else: $team_member_image_url = $team_member_image_url; endif;
    
        $id_int = substr( $this->get_id_int(), 0, 4 );
    
        $this->add_render_attribute( 'droit_team_member_wrapper', [
            'id'    => 'droit-team-' . $id_int,
            'class' => [ 'dl_team_member_wrapper dl_style_3', 'droit-team-member-wrapper' ],
        ] );
        $image_rounded = $this->get_team_settings( '_dl_team_members_image_rounded' );
        $image_rounded_classes = !empty($image_rounded) ? $image_rounded : '';
    
        $this->add_render_attribute( 'droit_team_member_thumb', [
            'id'    => 'droit-thumb-' . $id_int,
            'class' => [ 'dl_team_member_thumb', 'droit-team-member-thumb-wrapper', $image_rounded_classes ],
        ] );
       
        ?>
           <div <?php echo $this->get_render_attribute_string('droit_team_member_wrapper'); ?>>
                <div <?php echo $this->get_render_attribute_string('droit_team_member_thumb'); ?>>
                    <?php if (!empty($team_member_image['url'])): ?>
                        <a href="<?php echo esc_attr( $this->get_team_settings('_dl_team_member_link')['url']); ?>" <?php echo $is_name_target; ?> class="dl_team_member_thumb_inner dl_team_member_thumb_second">
                            <div class="dl_thumbnail_fluid"> 
                                <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', '_dl_team_member_image' ); ?>
                            </div>
                        </a>
                    <?php endif; ?>
                </div>
                <div class="dl_team_content_inner droit-team-member-inner">
                    <<?php echo esc_html( dl_title_tag($this->get_team_settings('_dl_team_member_tag')) ); ?> class="dl_name droit-team-member-name"> <a href="<?php echo esc_attr( $this->get_team_settings('_dl_team_member_link')['url']); ?>" <?php echo $is_name_target; ?>> <?php echo $this->get_team_settings('_dl_team_member_name'); ?></a></<?php echo esc_html( dl_title_tag($this->get_team_settings('_dl_team_member_tag')) ); ?>>
                    <p class="dl_position droit-team-member-job-title"> <span> <?php echo $this->get_team_settings('_dl_team_member_job_title'); ?></span></p>
                </div>
            </div>
        <?php }
  
      // Layout Third
    protected function _third_team_member_layout(){
  
        $settings = $this->get_settings_for_display();
        
        $is_name_target = $this->get_team_settings('_dl_team_member_link')['is_external'] ? ' target="_blank"' : '';
    
        $team_member_image = $this->get_team_settings( '_dl_team_member_image' );
            $team_member_image_url = \Elementor\Group_Control_Image_Size::get_attachment_image_src( $team_member_image['id'], 'thumbnail', $settings );    
        if( empty( $team_member_image_url ) ) : $team_member_image_url = $team_member_image['url']; else: $team_member_image_url = $team_member_image_url; endif;
    
        $id_int = substr( $this->get_id_int(), 0, 4 );
    
        $this->add_render_attribute( 'droit_team_member_wrapper', [
            'id' => 'droit-team-' . $id_int,
            'class' => [ 'dl_team_member_wrapper dl_style_4 zoom_in_effect', 'droit-team-member-wrapper' ],
        ] );
    
        $image_rounded = $this->get_team_settings( '_dl_team_members_image_rounded' );
    
        $image_rounded_classes = !empty($image_rounded) ? $image_rounded : '';
    
        $this->add_render_attribute( 'droit_team_member_thumb', [
            'id' => 'droit-thumb-' . $id_int,
            'class' => [ 'dl_team_member_thumb', 'droit-team-member-thumb-wrapper', $image_rounded_classes ],
        ] );
    
        $this->add_render_attribute( 'droit_team_member_social', [
            'id'    => 'droit-social-' . $id_int,
            'class' => [ 'dl_social_icon', 'droit-team-member-social-wrapper' ],
        ] );
        
        ?>
      <div <?php echo $this->get_render_attribute_string('droit_team_member_wrapper'); ?>>
               <?php if (!empty($team_member_image['url'])): ?>
                    <a href="<?php echo esc_attr( $this->get_team_settings('_dl_team_member_link')['url']); ?>" <?php echo $is_name_target; ?> <?php echo $this->get_render_attribute_string('droit_team_member_thumb'); ?>> 
                        <div class="dl_thumbnail_fluid dl_team_member_thumb_third zoom_in_img">
                           <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', '_dl_team_member_image' ); ?>
                       </div>
                       </a>
                <?php endif; ?>
               
           <div class="dl_team_content_inner droit-team-member-inner">
               <<?php echo esc_html( dl_title_tag($this->get_team_settings('_dl_team_member_tag')) ); ?> class="dl_name droit-team-member-name"> <a href="<?php echo esc_attr( $this->get_team_settings('_dl_team_member_link')['url']); ?>" <?php echo $is_name_target; ?>> <?php echo $this->get_team_settings('_dl_team_member_name'); ?></a></<?php echo esc_html( dl_title_tag($this->get_team_settings('_dl_team_member_tag')) ); ?>>
               <p class="dl_position droit-team-member-job-title"> <span> <?php echo $this->get_team_settings('_dl_team_member_job_title'); ?></span></p>
           </div>
   
           <div <?php echo $this->get_render_attribute_string('droit_team_member_social'); ?>>
                   <?php if (!empty($this->get_team_settings('_dl_team_member_social_profile_links'))): ?>
                       <?php foreach ( $this->get_team_settings('_dl_team_member_social_profile_links') as $item ) : 
                           $is_migrated = isset($item['__fa4_migrated']['_dl_social_new']);
                           $is_new = empty($item['_dl_social']);
                           
                           ?>
                           <?php if ( ! empty( $item['_dl_social'] ) || !empty($item['_dl_social_new'])) : 
                           $is_target = $item['_dl_link']['is_external'] ? ' target="_blank"' : '';
                           ?>
                           <?php if ($this->get_team_settings('_dl_team_member_enable_social_profiles') == 'yes'): ?>
                           <a href="<?php echo esc_attr( $item['_dl_link']['url'] ); ?>" <?php echo $is_target; ?>> 
                               <?php if ($is_new || $is_migrated) { ?>
                                   <?php if( isset( $item['_dl_social_new']['value']['url'] ) ) : ?>
                                       <img src="<?php echo esc_attr($item['_dl_social_new']['value']['url'] ); ?>" alt="<?php echo esc_attr(get_post_meta($item['_dl_social_new']['value']['id'], '_wp_attachment_image_alt', true)); ?>" class="dl_thumbnail_fluid"/>
                                   <?php else : ?>
                                       <i class="<?php echo esc_attr($item['_dl_social_new']['value'] ); ?>"></i>
                                   <?php endif; ?>
                               <?php } else { ?>
                                   <i class="<?php echo esc_attr($item['_dl_social']); ?>"></i>
                               <?php } ?>
                           </a>
                           <?php endif; ?>
                           <?php endif; ?>
                       <?php endforeach; ?>
                   <?php endif ?>
               </div>
       </div>
    <?php }

     protected function content_template() {}
}