<?php
namespace DROIT_ELEMENTOR\Widgets;

if (!defined('ABSPATH')) {exit;}

class Droit_Addons_Iconbox extends \Elementor\Widget_Base {
    
    // Get Control ID
	protected function get_control_id( $control_id ) {
        return $control_id;
    }

    final public function get_iconbox_settings( $control_key ) {
        $control_id = $this->get_control_id( $control_key );
        return $this->get_settings( $control_id );
    }

    public function get_name() {
        return 'droit-iconbox';
    }
    
    public function get_title() {
        return esc_html__( 'Icon Box', 'droit-addons' );
    }

    public function get_icon() {
        return 'dlicons-iconbox addons-icon';
    }

    public function get_keywords() {
        return [ 'icon box', 'icon', 'icon list', 'list', 'droit icon box', 
        'droit icon', 'droit icon list', 'droit list', 'dl icon box', 'drdloit icon', 
        'dl icon list', 'dl list', 'droit', 'dl', 'addons', 'addon' ];
    }
    
    public function get_categories() {
        return ['droit_addons'];
    }

    protected function _register_controls() {

		$this-> droit_register_iconbox_alignment();
        $this->_droit_register_iconbox_controls();
        do_action('dl_widget/section/style/custom_css', $this);
    }

    public function _droit_register_iconbox_controls() {
		$this->start_controls_section(
			'_iconbox_section_icon',
			[
				'label' => __( 'Icon Box', 'droit-addons' ),
			]
		);


		$this->add_control(
			'dl_choose_icon_style',
			[
				'label' => __( 'Icon Position', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'relative',
				'options' => [
					'relative'  => __( 'Relative', 'droit-addons' ),
					'absolute'  => __( 'Absolute', 'droit-addons' ),
				],
				'selectors' => [
					'{{WRAPPER}} .dl_icon_box_wrapper.dl_style_01 .dl_icon' => 'position: {{VALUE}};',	
				]
				
			]
		);

		$this->add_control( 
            'dl_image_icon_item_position',
            [
                'label'        => __( 'Icon PopOver', 'droit-addons-pro' ),
                'type'         => \Elementor\Controls_Manager::POPOVER_TOGGLE,
                'label_off'    => __( 'Default', 'droit-addons-pro' ),
                'label_on'     => __( 'Custom', 'droit-addons-pro' ),
                'return_value' => 'yes',
                'condition' => [
                    'dl_choose_icon_style' => 'absolute'
                ]
            ]
        );

        $this->start_popover();

		$this->add_control(
            'dl_offset_orientation_icon',
            [
                'label'       => __( 'Horizontal Orientation', 'elementor' ),
                'type'        => \Elementor\Controls_Manager::CHOOSE,
                'toggle'      => false,
                'default'     => 'start',
                'render_type' => 'ui',
            ]
        );

        $this->add_responsive_control(
            'dl_offset_icon',
            [
                'label' => __( 'Left Horizontal Offset', 'elementor' ),
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
					'unit' => '%',
                    'size' => '34',
                ],
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .dl_icon_box_wrapper.dl_style_01 .dl_icon.dl_icon_box_abs' => 'left: {{SIZE}}{{UNIT}}',
                    
                ],
            ]
        );

		$this->add_control(
            'dl_offset_orientation_icon_v',
            [
                'label'       => __( 'Vertical Orientation', 'elementor' ),
                'type'        => \Elementor\Controls_Manager::CHOOSE,
                'toggle'      => false,
                'default'     => 'start',
                'render_type' => 'ui',
            ]
        );

        $this->add_responsive_control(
            'dl_offset_icon_v',
            [
                'label' => __( 'Icon Verticle Offset', 'elementor' ),
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
                    'size' => '-18'
                ],
                'selectors' => [
                     '{{WRAPPER}} .dl_icon_box_wrapper.dl_style_01 .dl_icon.dl_icon_box_abs' => 'top: {{SIZE}}{{UNIT}}',
                    
                ],
                
            ]
        );

		$this->end_popover();

		$this->add_control(
			'_iconbox_selected_icon',
			[
				'label'            => __( 'Icon', 'droit-addons' ),
				'type'             => \Elementor\Controls_Manager::ICONS,
				'default'          => [
					'value'   => 'fas fa-star',
					'library' => 'fa-solid',
				],
			]
		);

		$this->add_control(
            'dl_addons_heading_title_switcher',
            [
                'label'        => esc_html__('Show Title', 'droit-addons'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __('yes', 'droit-addons'),
                'label_off'    => __('no', 'droit-addons'),
                'default'      => 'yes',
                'return_value' => 'yes',
            ]
        );

		$this->add_control(
			'_iconbox_title_text',
			[
				'label' => __( 'Title', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				
				'default'     => __( 'This is the heading', 'droit-addons' ),
				'placeholder' => __( 'Enter your title', 'droit-addons' ),
				'label_block' => true,
				'condition' => [
                    'dl_addons_heading_title_switcher' => ['yes'],
                ],
				
			]
		);

		$this->add_control(
            '_iconbox_title_size',
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
                'default' => 'h5',
                'toggle' => false,
				'condition' => [
                    'dl_addons_heading_title_switcher' => ['yes'],
                ],
                
            ]
        );

		$this->add_control(
			'_iconbox_description_text',
			[
				'label' => 'Description',
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				
				'default' => __( 'Premium Chat Support', 'droit-addons' ),
				'placeholder' => __( 'Enter your description', 'droit-addons' ),
				'rows' => 10,
				'separator' => 'none',
				'show_label' => true,
			]
		);

		$this->add_control(
			'_iconbox_link',
			[
				'label' => __( 'Link', 'droit-addons' ),
				'type'  => \Elementor\Controls_Manager::URL,
				
				'placeholder' => __( 'https://your-link.com', 'droit-addons' ),
				'separator'   => 'before',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'_iconbox_section_style_general',
			[
				'label' => __( 'General', 'droit-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => '_iconbox_primary_bg_color_div',
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .dl_icon_box_wrapper',
            ]
        );

		$this->add_responsive_control(
            '_iconbox_primary_padding',
            [
                'label'      => esc_html__('Padding', 'droit-addons'),
                'type'       => \ELEMENTOR\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .dl_icon_box_wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
			'_iconbox_section_style_icon',
			[
				'label' => __( 'Icon', 'droit-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => '_iconbox_selected_icon[value]',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);
 
		$this->start_controls_tabs( 'icon_colors' );

		$this->start_controls_tab(
			'_iconbox_icon_colors_normal',
			[
				'label' => __( 'Normal', 'droit-addons' ),
			]
		);

		$this->add_control(
			'_iconbox_primary_color',
			[
				'label' => __( 'Icon Color', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .dl_icon_box_wrapper.dl_style_01 .dl_icon' => 'color: {{VALUE}};', 

					'{{WRAPPER}} .dl_icon_box_wrapper.dl_style_01 .dl_icon svg path' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'_iconbox_icon_bg_color_div',
			[
				'label' => __( 'Icon Background Color', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dl_icon_box_wrapper.dl_style_01 .dl_icon' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'_iconbox_icon_colors_hover',
			[
				'label' => __( 'Hover', 'droit-addons' ),
			]
		);

		$this->add_control(
			'_iconbox_hover_primary_color',
			[
				
				'label' => __( 'Icon Color', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .dl_icon_box_wrapper.dl_style_01 .dl_icon:hover' => 'color: {{VALUE}};', 

					'{{WRAPPER}} .dl_icon_box_wrapper.dl_style_01 .dl_icon svg path:hover' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'_iconbox_hover_animation',
			[
				'label' => __( 'Hover Animation', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'_iconbox_icon_space',
			[
				'label' => __( 'Spacing', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .dl_icon_wrapper' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .dl_icon_wrapper' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .dl_icon_wrapper' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .dl_icon_wrapper' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'_iconbox_icon_size',
			[
				'label' => __( 'Icon Size', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .dl_icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .dl_icon svg' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->add_control(
			'_iconbox_rotate',
			[
				'label' => __( 'Rotate', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
					'unit' => 'deg',
				],
				'selectors' => [
					'{{WRAPPER}} .dl_icon i' => 'transform: rotate({{SIZE}}{{UNIT}});',
					'{{WRAPPER}} .dl_icon svg' => 'transform: rotate({{SIZE}}{{UNIT}});',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => '_iconbox_border_width',
				'label'    => esc_html__('Border', 'droit-addons'),
                'selector' => '{{WRAPPER}} .dl_icon'
			]
		);

		$this->add_control(
			'_iconbox_border_radius',
			[
				'label' => __( 'Border Radius', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .dl_icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				
			]
		);
        
        $this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'dl_icon_box_shadow',
				'label'    => __( 'Box Shadow', 'droit-addons' ),
				'selector' => '{{WRAPPER}} .dl_icon_box_wrapper.dl_style_01 .dl_icon.dl_icon_box_abs',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'_iconbox_section_style_content',
			[
				'label' => __( 'Content', 'droit-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'_iconbox_heading_title',
			[
				'label'     => __( 'Title', 'droit-addons' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				
			]
		);

		$this->add_responsive_control(
			'_iconbox_title_bottom_space',
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
					'{{WRAPPER}} .dl_icon_box_wrapper .droit-icon-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				
			]
		);

		$this->add_control(
			'_iconbox_title_color',
			[
				'label' => __( 'Color', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .icon_title' => 'color: {{VALUE}};',
				],
				
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => '_iconbox_title_typography',
				'selector' => '{{WRAPPER}} .icon_title span',
				
			]
		);

		$this->add_control(
			'_iconbox_heading_description',
			[
				'label' => __( 'Description', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);


		$this->add_control(
			'_iconbox_description_color',
			[
				'label' => __( 'Color', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} span.icon_desc' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => '_iconbox_description_typography',
				'selector' => '{{WRAPPER}} span.icon_desc',
			]
		);
		
		$this->end_controls_section();
	}

	protected function droit_register_iconbox_alignment() {

		$this->start_controls_section(
			'_iconbox_section_icon_alignment',
			[
				'label' => __( 'Alignment', 'droit-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_responsive_control(
			'_iconbox_items_alignment',
			[
				'label' => __( 'Items Alignment', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'droit-addons' ),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'droit-addons' ),
						'icon' => 'eicon-v-align-top',
					],
					'right' => [
						'title' => __( 'Right', 'droit-addons' ),
						'icon' => 'eicon-h-align-right',
					],					
				],
			]
		);

		$this->add_control(
			'_iconbox_position',
			[
				'label' => __( 'Icon Alignment', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'default' => 'flex-start',
				'options' => [
					'flex-start' => [
						'title' => __( 'Left', 'droit-addons' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Top', 'droit-addons' ),
						'icon' => 'eicon-text-align-center',
					],
					'flex-end' => [
						'title' => __( 'Right', 'droit-addons' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'prefix_class' => 'elementor-position-',
				'selectors' => [
					'{{WRAPPER}} .dl_icon_box_wrapper .dl_icon_wrapper' => 'justify-content: {{VALUE}};',	
				],
				'toggle' => false,
				'condition' => [
					'_iconbox_items_alignment' => 'center'
				],
			]
		);
		
		$this->add_responsive_control(
			'_iconbox_text_align',
			[
				'label' => __( 'Texts Alignment', 'droit-addons' ),
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
					'{{WRAPPER}} .droit-icon-box-wrapper' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
            '_dl_iconbox_margin',
            [
                'label' => esc_html__('Item Spacing', 'droit-addons'),
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
                    '{{WRAPPER}} .dl_icon_box_wrapper.dl_style_01 .dl_icon' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'_iconbox_items_alignment' => 'left'
				]
            ]
        );

		$this->add_responsive_control(
            '_dl_iconbox_margin_left',
            [
                'label' => esc_html__('Item Spacing', 'droit-addons'),
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
                    '{{WRAPPER}} .dl_icon_box_wrapper.dl_style_01 .dl_icon' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'_iconbox_items_alignment' => 'right'
				]
            ]
        );

		$this->add_responsive_control(
            '_dl_iconbox_margin_bottom',
            [
                'label' => esc_html__('Item Spacing', 'droit-addons'),
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
                    '{{WRAPPER}} .dl_icon_box_wrapper.dl_style_01 .dl_icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'_iconbox_items_alignment' => 'center'
				]
            ]
        );

		$this->end_controls_section();
	}

    //Html render
    protected function render(){

		$settings = $this->get_settings_for_display();
		extract($settings); 

        $this->add_render_attribute( '_iconbox_icon', 'class', [ 'droit-icon', 'elementor-animation-' . $settings['_iconbox_hover_animation'] ] );

        $link_tag = 'span';

        if ( ! empty( $settings['_iconbox_link']['url'] ) ) {
            $link_tag = 'a';

            $this->add_link_attributes( '_iconbox_link', $settings['_iconbox_link'] );
        }

        $link_attributes = $this->get_render_attribute_string( '_iconbox_link' );

        $this->add_render_attribute( '_iconbox_description_text', 'class', 'dl_desc droit-icon-description' );

        $this->add_inline_editing_attributes( '_iconbox_title_text', 'none' );
        $this->add_inline_editing_attributes( '_iconbox_description_text' );
     

        ?>

        <div class="droit-icon-box-wrapper">
            <div class="dl_icon_box_colum">
                <div class="dl_icon_box_wrapper dl_style_01 <?php if($_iconbox_items_alignment === 'left'){ echo 'dl_item_left';}if($_iconbox_items_alignment === 'right'){ echo 'dl_item_right';} ?>">
                    <div class="dl_icon_wrapper">
                        <?php if ( !empty( $_iconbox_selected_icon ) ) : ?>
                        <div class="dl_icon <?php if($dl_choose_icon_style === 'absolute'){echo 'dl_icon_box_abs';} ?> dl_color_1">
                            <?php
                            if ( !empty( $_iconbox_selected_icon ) ) {
                                \ELEMENTOR\Icons_Manager::render_icon( $_iconbox_selected_icon, [ 'aria-hidden' => 'true' ] );
                            } 
                            ?>
                        </div>
                    </div>
                    <?php endif; ?>
                    
					<?php if ( ! \Elementor\Utils::is_empty( $this->get_iconbox_settings('_iconbox_description_text') ) ) : ?>
						<h4 <?php echo $this->get_render_attribute_string( '_iconbox_description_text' ); ?>>
						<<?php echo implode( ' ', [ $link_tag, $link_attributes ] ); ?>>
							<span class="icon_desc"><?php echo $this->get_iconbox_settings('_iconbox_description_text'); ?></span>
							
							<?php if( $settings[ 'dl_addons_heading_title_switcher' ] === 'yes' ): ?>
								<div class="icon_title">
								<<?php echo esc_html( dl_title_tag($this->get_iconbox_settings('_iconbox_title_size')) ); ?> 
									<?php echo $this->get_render_attribute_string( '_iconbox_title_text' ); ?>>
									<<?php echo implode( ' ', [ $link_tag, $link_attributes ] ); ?>>
									<?php echo $this->get_iconbox_settings('_iconbox_title_text'); ?>
									</<?php echo esc_html( $link_tag ); ?>>
								</<?php echo esc_html( dl_title_tag($this->get_iconbox_settings('_iconbox_title_size')) ); ?>>
							<?php endif; ?>
							</div>
						</<?php echo esc_html( $link_tag ); ?>>
						</h4>
					<?php endif; ?>
                </div>
            </div>
        </div>
    <?php

    }  

    protected function content_template() {}

}