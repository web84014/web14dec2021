<?php
namespace DROIT_ELEMENTOR\Widgets;

if (!defined('ABSPATH')) {exit;}

class Droit_Addons_Pricing extends \Elementor\Widget_Base {

    // Get Control ID
	protected function get_control_id( $control_id ) {
        return $control_id;
    }

    final public function get_pricing_settings( $control_key ) {
        $control_id = $this->get_control_id( $control_key );
        return $this->get_settings( $control_id );
    }

    public function get_name() {
        return 'droit-pricing';
    }
    
    public function get_title() {
        return esc_html__( 'Pricing Table', 'droit-addons' );
    }

    public function get_icon() {
        return 'dlicons-pricing-Table addons-icon';
    }
    
    public function get_keywords() {
        return [
            'price',
            'pricing',
            'table',
            'product',
            'plan',
            'button',
            'droit-pricing',
            'droit-table',
            'droit-product',
            'droit-plan',
            'droit-button',
            'dl-pricing',
            'dl-table',
            'dl-product',
            'dl-plan',
            'dl-button',
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
        $this->register_pricing_table_general_controls();
        $this->register_pricing_header_control();
        $this->register_pricing_currency_control();
        $this->register_pricing_feature_control();
        $this->register_pricing_populated_control();
        $this->register_pricing_button_control();
    }

	/**  pricing general control **/
    public function register_pricing_table_general_controls(){
    	$this->start_controls_section(
            '_dl_pricing_table_general_section',
            [
                'label' => esc_html__('General', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
    	$this->register_pricing_general_controls();
    	
        $this->end_controls_section();
    }
    
	protected function register_pricing_general_controls() {

		$this->start_controls_tabs(
			'_pricing_style_02_style_tabs_control'
		);

		$this->start_controls_tab(
			'_pricing_style_02_style_tab_control',
			[
				'label' => __( 'Normal', 'droit-addons' ),
			]
		);

		$this->add_responsive_control(
			'_dl_pricing_style_02_table_alignment',
			[
				'label' => __( 'Alignment', 'droit-addons' ),
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
					'{{WRAPPER}} .droit-pricing-plan' => 'text-align: {{VALUE}};',
				],
			]
		); 

		$this->add_responsive_control(
			'_dl_pricing_style_02_table_bgcolor',
			[
				'label' => __( 'Padding', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .droit-pricing-plan' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'pricing_style_02_background',
				'label' => __( 'Background', 'droit-addons' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .droit-pricing-plan',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'pricing_style_02_box_shadow',
				'label' => __( 'Box Shadow', 'droit-addons' ),
				'selector' => '{{WRAPPER}} .droit-pricing-plan',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'_pricing_style_02_hover_style_tab_control',
			[
				'label' => __( 'Hover', 'droit-addons' ),
			]
		);
        
        $this->add_responsive_control(
			'dl_pricing_top_spacing',
			[
				'label' => __( 'Spacing Top', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
						'step' => 1,
					]
				],
				
				'selectors' => [
					'{{WRAPPER}} .dl_pricing_plan.dl_style_02:hover:not(.dl_popular_package)' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'pricing_style_02_hover_background',
				'label' => __( 'Background', 'droit-addons' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .droit-pricing-plan:hover',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'pricing_style_02_hover_box_shadow',
				'label' => __( 'Box Shadow', 'droit-addons' ),
				'selector' => '{{WRAPPER}} .droit-pricing-plan',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
	}

	// Pricing Header
	public function register_pricing_header_control(){

		$this->start_controls_section(
            '_dl_pricing_header_section',
            [
                'label' => esc_html__('Header', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

		$this->start_controls_tabs( '_dl_pricing_header_tabs' );

		$this->start_controls_tab( '_dl_header_pricing_content',
			[ 
				'label' => esc_html__( 'Content', 'droit-addons'),
			] 
		);
        
		
        $this->add_control(
			'_dl_pricing_heading_text',
			[
				'label' => __( 'Title', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Basic Package', 'droit-addons' ),
			]
		);

        $this->add_control(
			'_dl_pricing_heading_desc',
			[
				'label' => 'Description',
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => __( 'Our most popular plan', 'droit-addons' ),
				'placeholder' => __( 'Enter your description', 'droit-addons' ),
				'show_label' => true,
                'rows' => 10,
			]
		);  

        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'dl_pricing_header_border',
				'label' => __( 'Border', 'droit-addons' ),
				'selector' => '{{WRAPPER}} .dl_pricing_plan .dl_top_pricing_title',
                
			]
		);

		$this->add_control(
			'_dl_pricing_link',
			[
				'label' => __( 'Link', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'droit-addons' ),
			]
		);

		$this->add_control(
            '_dl_pricing_title_tag',
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
             '_dl_pricing_heading_image',
             [   
                 'label' => esc_html__('Image', 'droit-addons'),
                 'type' => \Elementor\Controls_Manager::MEDIA,
                 'default' => [
                     'url' => dl_place_img(),
                 ],
                
             ]
         );

         $this->add_control(
            '_dl_pricing_enable_image',
            [
                'label'        => esc_html__('Enable Top Header', 'droit-addons'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'default'      => '',
                'return_value' => 'yes',
                
            ]
        );

		$this->end_controls_tab();

		$this->start_controls_tab( '_dl_header_pricing_content_style',
			[ 
				'label' => esc_html__( 'Style', 'droit-addons')
			] 
		);

		$this->add_control(
            '_dl_pricing_header_color',
            [
                'label' => __( 'Text Color', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'global' => [
                    'default' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .droit-pricing-plan .droit-pricing-heading' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .droit-pricing-plan .droit-pricing-heading a' => 'color: {{VALUE}}',
                ],
                'condition' =>[
                    $this->get_control_id('_dl_pricing_heading_text!') => '',
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => '_dl_pricing_header_title_color_typography',
                'selector' => '{{WRAPPER}} .droit-pricing-plan .droit-pricing-heading, {{WRAPPER}} .droit-pricing-plan .droit-pricing-heading a',
            ]
        );

		$this->add_control(
            '_dl_pricing_header_desc_color',
            [
                'label' => __( 'Description Color', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'global' => [
                    'default' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} span.elementor-inline-editing' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => '_dl_pricing_header_desc_color_typography',
                'selector' => '{{WRAPPER}} .droit-pricing-plan .heading-desc',
            ]
        );

		$this->add_responsive_control(
            '_dl_pricing_header__position',
            [
                'label'      => __('Position', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors'  => [
                    '{{WRAPPER}} .droit-pricing-plan .droit-pricing-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            '_dl_pricing_price__image_size',
            [
                'label'      => __('Image Size', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .droit-pricing-plan .droit-pricing-img img ' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' =>[
					$this->get_control_id('_dl_pricing_enable_currency_price') => ['yes'],
					$this->get_control_id( '_dl_pricing_table_skin' ) => [ '_skin_3' ],
				]
            ]
        );
        
        $this->add_control(

            'dl_img_top_gap',

            [

                'label' => __( 'Image Top Gap', 'droit-addons' ),

                'type' => \Elementor\Controls_Manager::SLIDER,

                'size_units' => [ 'px' ],

                'range' => [

                'px' => [

                'min' => 0,

                'max' => 500,

                'step' => 1,

                ]

            ],

            'selectors' => [ '{{WRAPPER}} .dl_pricing_img.droit-pricing-img' => 'margin-top: {{SIZE}}{{UNIT}};',]
            ]

        );
        
       

		$this->end_controls_tab();

		$this->start_controls_tab( '_dl_header_pricing_content_hover',
			[ 
				'label' => esc_html__( 'Hover', 'droit-addons')
			] 
		);
		
		$this->add_control(
            '_dl_pricing_header_hover_color',
            [
                'label' => __( 'Text Color', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'global' => [
                    'default' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .droit-pricing-plan:hover .droit-pricing-heading' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .droit-pricing-plan:hover .droit-pricing-heading a' => 'color: {{VALUE}}',
                ],
                'condition' =>[
                    $this->get_control_id('_dl_pricing_heading_text!') => '',
                ]
            ]
        );

		$this->end_controls_tab();
				
		$this->end_controls_tabs();

        $this->end_controls_section(); 
	}

	//Pricing Populated
	public function register_pricing_populated_control(){

		$this->start_controls_section(
            '_dl_pricing_populated_section',
            [
                'label' => esc_html__('Populated', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                
            ]
        );

		$this->start_controls_tabs( '_dl_pricing_populated_tabs' );

		$this->start_controls_tab( '_dl_populated_pricing_content',
			[ 
				'label' => esc_html__( 'Content', 'droit-addons'),
			] 
		);

        $this->add_control(
            '_dl_pricing_enable_as_active',
            [
                'label' => esc_html__('Enable as Highlited', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => '',
                'return_value' => 'yes',
                
            ]
        );

		$this->add_control(
            '_dl_pricing_enable_as_populated',
            [
                'label' => esc_html__('Show Popular', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'no',
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
			'_dl_pricing_populated_text',
			[
				'label' => __( 'Title', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Popular', 'droit-addons' ),
				'condition' => [
					$this->get_control_id('_dl_pricing_enable_as_populated') => ['yes']
				]
			]
		);

        $this->add_control(
             '_dl_pricing_populated_image',
             [   
                 'label' => esc_html__('Image', 'droit-addons'),
                 'type' => \Elementor\Controls_Manager::MEDIA,
                 'default' => [
                     'url' => dl_place_img(),
                 ],
                 'condition' => [
                    $this->get_control_id('_dl_pricing_enable_as_populated') => ['yes']
                ],
             ]
        );

        $this->add_control(
			'_dl_populated_position',
			[
				'label' => __( 'Position', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'droit-addons' ),
						'icon' => 'eicon-h-align-left',
					],
					'right' => [
						'title' => __( 'Right', 'droit-addons' ),
						'icon' => 'eicon-h-align-right',
					],
				],

				'condition' => [
					$this->get_control_id('_dl_pricing_enable_as_populated') => ['yes']
				]
			]
		);

		$this->add_control(
            '_dl_pricing_populated_tag',
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
					$this->get_control_id('_dl_pricing_enable_as_populated') => ['yes']
				]
            ]
        );	

		$this->end_controls_tab();

		$this->start_controls_tab( '_dl_populated_pricing_content_style',
			[ 
				'label' => esc_html__( 'Style', 'droit-addons'),
				'condition' =>[
					$this->get_control_id('_dl_pricing_enable_as_populated') => ['yes']
				]
			] 
		);

		$this->add_control(
			'_dl_populated_text_color',
			[
				'label' => __( 'Text Color', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .droit-pricing-plan .droit-popular-tricker .droit-pricing-populated-text' => 'color: {{VALUE}}',
				],
				'condition' =>[
					$this->get_control_id('_dl_pricing_enable_as_populated') => ['yes']
				]
			]
		);

		$this->add_control(
			'_dl_populated_bg_color',
			[
				'label' => __( 'Background Color', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .droit-pricing-plan .droit-popular-tricker .droit-pricing-populated-text' => 'background-color: {{VALUE}}',
				],
				'condition' =>[
					$this->get_control_id('_dl_pricing_enable_as_populated') => ['yes']
				]
			]
		);

		$this->add_responsive_control(
            '_dl_populated_image_size',
            [
                'label'      => __('Image Size', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .droit-pricing-plan .droit-popular-tricker img ' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' =>[
					$this->get_control_id( '_dl_pricing_table_skin' ) => [ '_skin_3' ],
					$this->get_control_id('_dl_pricing_enable_as_populated') => ['yes']
				]
            ]
        );

		$this->end_controls_tab();

		$this->start_controls_tab( '_dl_populated_pricing_content_hover',
			[ 
				'label' => esc_html__( 'Hover', 'droit-addons')
			]
		);
		
		$this->add_control(
			'_dl_populated_text_hover_color',
			[
				'label' => __( 'Text Color', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .droit-pricing-plan .droit-popular-tricker:hover .droit-pricing-populated-text' => 'color: {{VALUE}}',
				],
				'condition' =>[
					$this->get_control_id('_dl_pricing_enable_as_populated') => ['yes']
				]
			]
		);

		$this->add_control(
			'_dl_populated_bg_hover_color',
			[
				'label' => __( 'Background Color', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .droit-pricing-plan .droit-popular-tricker:hover .droit-pricing-populated-text' => 'background-color: {{VALUE}}',
				],
				'condition' =>[
					$this->get_control_id('_dl_pricing_enable_as_populated') => ['yes']
				]
			]
		);

		$this->end_controls_tab();
				
		$this->end_controls_tabs();

        $this->end_controls_section();   
	}

	// Pricing Price
    public function register_pricing_currency_control(){

        $this->start_controls_section(
            '_dl_pricing_currency_section',
            [
                'label' => esc_html__('Price', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->start_controls_tabs( '_dl_pricing_currency_tabs' );

        $this->start_controls_tab( '_dl_pricing_price_content',
            [ 
                'label' => esc_html__( 'Content', 'droit-addons'),
            ] 
        );

        $this->add_control(
            '_dl_pricing_enable_currency_price',
            [
                'label' => esc_html__('Show Price', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
			'_dl_pricing_currency_symbol',
			[
				'label'   => __( 'Currency Symbol', 'droit-addons' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					''             => __( 'None', 'droit-addons' ),
					'dollar'       => '&#36; ' . esc_html__( 'Dollar', 'droit-addons' ),
					'euro'         => '&#128; ' . esc_html__( 'Euro', 'droit-addons' ),
					'baht'         => '&#3647; ' . esc_html__( 'Baht', 'droit-addons' ),
					'franc'        => '&#8355; ' . esc_html__( 'Franc', 'droit-addons' ),
					'guilder'      => '&fnof; ' . esc_html__( 'Guilder', 'droit-addons' ),
					'krona'        => 'kr ' . esc_html__( 'Krona', 'droit-addons' ),
					'lira'         => '&#8356; ' . esc_html__( 'Lira', 'droit-addons' ),
					'peseta'       => '&#8359 ' . esc_html__( 'Peseta', 'droit-addons' ),
					'peso'         => '&#8369; ' . esc_html__( 'Peso', 'droit-addons' ),
					'pound'        => '&#163; ' . esc_html__( 'Pound Sterling', 'droit-addons' ),
					'real'         => 'R$ ' . esc_html__( 'Real', 'droit-addons' ),
					'ruble'        => '&#8381; ' . esc_html__( 'Ruble', 'droit-addons' ),
					'rupee'        => '&#8360; ' . esc_html__( 'Rupee', 'droit-addons' ),
					'indian_rupee' => '&#8377; ' . esc_html__( 'Rupee (Indian)', 'droit-addons' ),
					'shekel'       => '&#8362; ' . esc_html__( 'Shekel', 'droit-addons' ),
					'yen'          => '&#165; ' . esc_html__( 'Yen/Yuan', 'droit-addons' ),
					'won'          => '&#8361; ' . esc_html__( 'Won', 'droit-addons' ),
					'custom'       => __( 'Custom', 'droit-addons' ),
				],
				'default'   => 'dollar',
				'condition' =>[
					$this->get_control_id('_dl_pricing_enable_currency_price') => ['yes'],
				]
			]
		);

		$this->add_control(
			'_dl_pricing_currency_symbol_custom',
			[
				'label'     => __( 'Custom Symbol', 'droit-addons' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					$this->get_control_id('_dl_pricing_enable_currency_price') => ['yes'],
					$this->get_control_id('_dl_pricing_currency_symbol') => ['custom'],
				]
			]
		);

        $this->add_control(
            '_dl_pricing_price_text',
            [
                'label'     => __( 'Price', 'droit-addons' ),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'default'   => '49',
                'condition' => [
					$this->get_control_id('_dl_pricing_enable_currency_price') => ['yes']
				]
            ]
        );

        $this->add_control(
			'_dl_pricing_currency_format',
			[
				'label'   => __( 'Currency Format', 'droit-addons' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					',' => '1.234,56 (Default)',
					''  => '1,234.56',
				],

				'condition' =>[
					$this->get_control_id('_dl_pricing_enable_currency_price') => ['yes'],
				]
			]
		); 
        $this->add_control(
			'_dl_pricing_sale',
			[
				'label'     => __( 'Sale', 'droit-addons' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label_on'  => __( 'On', 'droit-addons' ),
				'label_off' => __( 'Off', 'droit-addons' ),
				'default'   => '',
				'condition' => [
					$this->get_control_id('_dl_pricing_enable_currency_price') => ['yes'],
				]
			]
		);

		$this->add_control(
			'_dl_pricing_original_price',
			[
				'label'     => __( 'Original Price', 'droit-addons' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'default'   => '30',
				'condition' => [
					$this->get_control_id('_dl_pricing_enable_currency_price') => ['yes'],
					$this->get_control_id('_dl_pricing_sale') => ['yes'],
				]
			]
		);

		$this->add_control(
			'_dl_pricing_period',
			[
				'label'     => __( 'Period', 'droit-addons' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'default'   => __( '/ Monthly', 'droit-addons' ),
				'condition' => [
					$this->get_control_id('_dl_pricing_enable_currency_price') => ['yes'],
				]
			]
		);
            
		$this->add_control(
			'_dl_pricing_period_position',
			[
				'label'       => __( 'Position', 'droit-addons' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'label_block' => false,
				'options'     => [
					'beside' => __( 'Beside', 'droit-addons' ),
					'below'  => __( 'Below', 'droit-addons' ),
				],
				'default'   => 'beside',
				'condition' => [
					$this->get_control_id('_dl_pricing_period!') => '',
					$this->get_control_id('_dl_pricing_enable_currency_price') => ['yes'],
				]
			]
		);

        $this->end_controls_tab();

        $this->start_controls_tab( '_dl_pricing_price_content_style',
            [ 
                'label' => esc_html__( 'Style', 'droit-addons')
            ] 
        );

        /* $this->add_responsive_control(
            '_dl_pricing_content_general',
            [
                'label' => __( 'Alignment', 'droit-elementor-addons' ),
                'type' => \ELEMENTOR\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'droit-elementor-addons' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'droit-elementor-addons' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'droit-elementor-addons' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl_pricing_plan .dl_top_pricing_title' => 'text-align: {{VALUE}};',
                ],
            ]
        ); */
		
       $this->add_control(
			'_dl_price_text_color',
			[
				'label' => __( 'Price Color', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .droit-pricing-plan .droit-price .droit-price-integer' => 'color: {{VALUE}}',
					'{{WRAPPER}} .droit-pricing-plan .droit-price .droit-price-floating' => 'color: {{VALUE}}',
				],
				'condition' =>[
					$this->get_control_id('_dl_pricing_enable_currency_price') => ['yes'],
				]
			]
		);

		$this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => '_dl_pricing_header_price_typography',
                'selector' => '{{WRAPPER}} .droit-pricing-plan .droit-price .droit-price-integer, {{WRAPPER}} .droit-pricing-plan .droit-price .droit-price-floating, {{WRAPPER}} .droit-pricing-plan .droit-price .droit-currency-symbol',
            ]
        );

        $this->add_control(
			'_dl_price_currency_color',
			[
				'label'  => __( 'Currency Color', 'droit-addons' ),
				'type'   => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .droit-pricing-plan .droit-price .droit-currency-symbol' => 'color: {{VALUE}}',
				],
				'condition' =>[
					$this->get_control_id('_dl_pricing_enable_currency_price') => ['yes'],
				]
			]
		);
        $this->add_control(
			'_dl_price_regular_color',
			[
				'label'  => __( 'Regular Price Color', 'droit-addons' ),
				'type'   => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .droit-pricing-plan .droit-price .dl-regular-price' => 'color: {{VALUE}}',
				],
				'condition' =>[
					$this->get_control_id('_dl_pricing_enable_currency_price') => ['yes'],
				]
			]
		);
       $this->add_control(
			'_dl_price_period_color',
			[
				'label'  => __( 'Period Color', 'droit-addons' ),
				'type'   => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .droit-pricing-plan .droit-price .droit-price-period' => 'color: {{VALUE}}',
				],
				'condition' =>[
					$this->get_control_id('_dl_pricing_enable_currency_price') => ['yes'],
					
				]
			]
		);
		$this->add_responsive_control(
            '_dl_pricing_price__position',
            [
                'label'      => __('Position', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .droit-pricing-plan .droit-price ' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
                'condition' =>[
					$this->get_control_id('_dl_pricing_enable_currency_price') => ['yes'],
				]
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab( '_dl_pricing_price_content_hover',
            [ 
                'label' => esc_html__( 'Hover', 'droit-addons')
            ] 
        );
        
        $this->add_control(
            '_dl_price_text_color_hover',
            [
                'label'  => __( 'Price Color', 'droit-addons' ),
                'type'   => \Elementor\Controls_Manager::COLOR,
                'global' => [
                    'default' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .droit-pricing-plan:hover .droit-price .droit-price-integer' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .droit-pricing-plan:hover .droit-price .droit-price-floating' => 'color: {{VALUE}}',
                ],
                'condition' =>[
                    $this->get_control_id('_dl_pricing_enable_currency_price') => ['yes'],
                ]
            ]
        );
        
       $this->add_control(
            '_dl_price_currency_color_hover',
            [
                'label'  => __( 'Currency Color', 'droit-addons' ),
                'type'   => \Elementor\Controls_Manager::COLOR,
                'global' => [
                    'default' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .droit-pricing-plan .droit-price:hover .droit-currency-symbol' => 'color: {{VALUE}}',
                ],
                'condition' =>[
                    $this->get_control_id('_dl_pricing_enable_currency_price') => ['yes'],
                ]
            ]
        );
       $this->add_control(
            '_dl_price_regular_color_hover',
            [
                'label'  => __( 'Regular Price Color', 'droit-addons' ),
                'type'   => \Elementor\Controls_Manager::COLOR,
                'global' => [
                    'default' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .droit-pricing-plan .droit-price:hover .dl-regular-price' => 'color: {{VALUE}}',
                ],
                'condition' =>[
                    $this->get_control_id('_dl_pricing_enable_currency_price') => ['yes'],
                ]
            ]
        );
       $this->add_control(
            '_dl_price_period_color_hover',
            [
                'label'  => __( 'Period Color', 'droit-addons' ),
                'type'   => \Elementor\Controls_Manager::COLOR,
                'global' => [
                    'default' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .droit-pricing-plan .droit-price:hover .droit-price-period' => 'color: {{VALUE}}',
                ],
                'condition' =>[
                    $this->get_control_id('_dl_pricing_enable_currency_price') => ['yes'],
                ]
            ]
        );
        

        $this->end_controls_tab();
                
        $this->end_controls_tabs();

        $this->end_controls_section();   
    }

    // Pricing Feature
	public function register_pricing_feature_control(){

		$this->start_controls_section(
            '_dl_pricing_feature_section',
            [
                'label'      => esc_html__('Feature', 'droit-addons'),
                'tab'        => \Elementor\Controls_Manager::TAB_CONTENT,
                'show_label' => false,
                
            ]
        );

		$this->start_controls_tabs( '_dl_pricing_feature_tabs' );

		$this->start_controls_tab( '_dl_pricing_feature_normal',
			[ 
				'label' => esc_html__( 'Content', 'droit-addons'),
			] 
		);

		$this->register_pricing_feature_content_control();

		$this->end_controls_tab();

		$this->start_controls_tab( '_dl_pricing_feature_style',
			[ 
				'label' => esc_html__( 'Style', 'droit-addons')
			] 
		);

		$this->register_pricing_feature_style_control();

		$this->end_controls_tab();
				
		$this->end_controls_tabs();

        $this->end_controls_section();   
	}

	// Pricing Content
    protected function register_pricing_feature_content_control(){

        $repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'_dl_pricing_item_text',
			[
				'label'   => __( 'Text', 'droit-addons' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'List Item', 'droit-addons' ),
			]
		);

		$default_icon = [
			'value'   => 'fas fa-check',
			'library' => 'fa-regular',
		];

		$repeater->add_control(
			'_dl_pricing_selected_item_icon',
			[
				'label'            => __( 'Icon', 'droit-addons' ),
				'type'             => \Elementor\Controls_Manager::ICONS,
				'fa4compatibility' => 'item_icon',
				'default'          => $default_icon,
			]
		);

		$repeater->add_control(
			'_dl_pricing_item_icon_color',
			[
				'label'     => __( 'Icon Color', 'droit-addons' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} i' => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} svg' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'_dl_pricing_features_list',
			[
				'type'    => \Elementor\Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'default' => [
					[
						'_dl_pricing_item_text' => __( 'Tincidunt ut laoreet dolor', 'droit-addons' ),
						'_dl_pricing_selected_item_icon' => $default_icon,
					],
					[
						'_dl_pricing_item_text' => __( 'Sincidunt ut laoreet dolor', 'droit-addons' ),
						'_dl_pricing_selected_item_icon' => $default_icon,
					],
					[
						'_dl_pricing_item_text' => __( 'Tincidunt ut laoreet dolor', 'droit-addons' ),
						'_dl_pricing_selected_item_icon' => $default_icon,
					],
					[
						'_dl_pricing_item_text' => __( 'Sincidunt ut laoreet dolor', 'droit-addons' ),
						'_dl_pricing_selected_item_icon' => $default_icon,
					],
					[
						'_dl_pricing_item_text' => __( 'Tincidunt ut laoreet dolor', 'droit-addons' ),
						'_dl_pricing_selected_item_icon' => $default_icon,
					],
					[
						'_dl_pricing_item_text' => __( 'Sincidunt ut laoreet dolor', 'droit-addons' ),
						'_dl_pricing_selected_item_icon' => $default_icon,
					],
				],
				'title_field' => '{{{ _dl_pricing_item_text }}}',
			]
		); 
    }

	// Pricing Feature Style
	protected function register_pricing_feature_style_control(){
		$this->add_control(
			'_dl_pricing_features_list_bg_color',
			[
				'label'     => __( 'Background Color', 'droit-addons' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .droit-pricing-plan .droit-pricing-feature' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'_dl_pricing_features_list_padding',
			[
				'label'      => __( 'Padding', 'droit-addons' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .droit-pricing-plan .droit-pricing-feature' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'_dl_pricing_features_list_color',
			[
				'label'  => __( 'Color', 'droit-addons' ),
				'type'   => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => '',
				],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .dl_pricing_plan .dl_pricing_list li span' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => '_dl_pricing_features_list_typography',
				'selector' => '{{WRAPPER}} .droit-pricing-plan .droit-pricing-feature li',
				'global'   => [
					'default' => '',
				],
			]
		);

		$this->add_responsive_control(
			'_dl_pricing_item_width',
			[
				'label' => __( 'Width', 'droit-addons' ),
				'type'  => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'%' => [
						'min' => 25,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .droit-pricing-plan .droit-pricing-feature' => 'margin-left: calc((100% - {{SIZE}}%)/2); margin-right: calc((100% - {{SIZE}}%)/2)',
				],
			]
		);

		$this->add_control(
			'_dl_pricing_list_divider',
			[
				'label'     => __( 'Divider', 'droit-addons' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'_dl_pricing_divider_style',
			[
				'label'   => __( 'Style', 'droit-addons' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					''       => __( 'None', 'droit-addons' ),
					'solid'  => __( 'Solid', 'droit-addons' ),
					'double' => __( 'Double', 'droit-addons' ),
					'dotted' => __( 'Dotted', 'droit-addons' ),
					'dashed' => __( 'Dashed', 'droit-addons' ),
				],
				'default'   => '',
				'condition' => [
					$this->get_control_id('_dl_pricing_list_divider') => ['yes'],
				],
				'selectors' => [
					'{{WRAPPER}} .droit-pricing-plan .droit-pricing-feature li:before' => 'border-top-style: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'_dl_pricing_divider_color',
			[
				'label'   => __( 'Color', 'droit-addons' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				
				'condition' => [
					$this->get_control_id('_dl_pricing_list_divider') => ['yes'],
				],
				'selectors' => [
					'{{WRAPPER}} .droit-pricing-plan .droit-pricing-feature li:before' => 'border-top-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'_dl_pricing_divider_weight',
			[
				'label'   => __( 'Weight', 'droit-addons' ),
				'type'    => \Elementor\Controls_Manager::SLIDER,
				'default' => [
					'size' => '',
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 10,
					],
				],
				'condition' => [
					$this->get_control_id('_dl_pricing_list_divider') => ['yes'],
				],
				'selectors' => [
					'{{WRAPPER}} .droit-pricing-plan .droit-pricing-feature li:before' => 'border-top-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'divider_width',
			[
				'label'     => __( 'Width', 'droit-addons' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'condition' => [
					$this->get_control_id('_dl_pricing_list_divider') => ['yes'],
				],
				'selectors' => [
					'{{WRAPPER}} .droit-pricing-plan .droit-pricing-feature li:before' => 'margin-left: calc((100% - {{SIZE}}%)/2); margin-right: calc((100% - {{SIZE}}%)/2)',
				],
			]
		);

		$this->add_control(
			'divider_gap',
			[
				'label'   => __( 'Gap', 'droit-addons' ),
				'type'    => \Elementor\Controls_Manager::SLIDER,
				'default' => [
					'size' => '',
					'unit' => 'px',
				],
				'range'  => [
					'px' => [
						'min' => 1,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .droit-pricing-plan .droit-pricing-feature li:before' => 'margin-top: {{SIZE}}{{UNIT}}; margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);
		
        $this->add_control(
			'icon_and_text_divider_gap',
			[
				'label'   => __( 'Gap Between Icon & Texts', 'droit-addons' ),
				'type'    => \Elementor\Controls_Manager::SLIDER,
				'default' => [
					'size' => '',
					'unit' => 'px',
				],
				'range'  => [
					'px' => [
						'min' => 1,
						'max' => 100,
					],
				],
				
				'selectors' => [
					'{{WRAPPER}} .droit-pricing-plan .droit-pricing-feature li svg' => 'margin-right: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .dl_pricing_plan.dl_style_02 .dl_pricing_list li i' => 'margin-right: {{SIZE}}{{UNIT}}',
				],
			]
		);
	}

	// Pricing Button
	public function register_pricing_button_control(){

		$this->start_controls_section(
            '_dl_pricing_button_section',
            [
                'label'      => esc_html__('Button', 'droit-addons'),
                'tab'        => \Elementor\Controls_Manager::TAB_CONTENT,
                'show_label' => false,
            ]
        );

		$this->start_controls_tabs( '_dl_pricing_button_tabs' );

		$this->start_controls_tab( '_dl_pricing_button_normal',
			[ 
				'label' => esc_html__( 'Content', 'droit-addons'),
			] 
		);

		$this->register_pricing_button_content_control();

		$this->end_controls_tab();

		$this->start_controls_tab( '_dl_pricing_button_style',
			[ 
				'label' => esc_html__( 'Style', 'droit-addons'),
				'condition' => [
					$this->get_control_id('_dl_pricing_button_text!') => '',
				],
			] 
		);

		$this->register_pricing_button_style_control();

		$this->end_controls_tab();

		$this->start_controls_tab( '_dl_pricing_button_style_hover',
			[ 
				'label' => esc_html__( 'Hover', 'droit-addons'),
				'condition' => [
					$this->get_control_id('_dl_pricing_button_text!') => '',
				],
			] 
		);

		$this->register_pricing_button_style_hover_control();

		$this->end_controls_tab();
				
		$this->end_controls_tabs();

        $this->end_controls_section();   
	}

	// Pricing Button Content
	protected function register_pricing_button_content_control(){
		$this->add_control(
			'_dl_pricing_button_text',
			[
				'label'   => __( 'Button Text', 'droit-addons' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Buy Package', 'droit-addons' ),
			]
		);

		$this->add_control(
			'_dl_pricing_button_link',
			[
				'label'       => __( 'Link', 'droit-addons' ),
				'type'        => \Elementor\Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'droit-addons' ),
			]
		);
	}

	// Pricing Button Style
	protected function register_pricing_button_style_control(){
		$this->add_control(
			'_dl_pricing_button_text_color',
			[
				'label'     => __( 'Text Color', 'droit-addons' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .droit-pricing-plan .droit-price-button' => 'color: {{VALUE}};',
				],
			]
		);
        
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => '_dl_pricing_button_text_typography',
				'label'    => __( 'Typography', 'plugin-domain' ),
				'selector' => '{{WRAPPER}} a.dl_cu_btn.btn_4.droit-price-button',
				
			]
		);  
        
		$this->add_control(
			'_dl_pricing_button_bg_color',
			[
				'label'     => __( 'Background Color', 'droit-addons' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .droit-pricing-plan .droit-price-button' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'_dl_pricing_button_padding',
			[
				'label'      => __( 'Padding', 'droit-addons' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .droit-pricing-plan .droit-price-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => '_dl_pricing_button_border',
                'label'    => esc_html__('Border', 'droit-addons'),
                'selector' => '{{WRAPPER}} .droit-pricing-plan .droit-price-button', 
            ]
        );
		$this->add_control(
			'_dl_pricing_button_border_radius',
			[
				'label'      => __( 'Border Radius', 'droit-addons' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .droit-pricing-plan .droit-price-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
            '_dl_pricing_button_position',
            [
                'label'      => __('Position', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .droit-pricing-plan .droit-price-button' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],

            ]
        );
	}

	// Pricing Button Style Hover
	protected function register_pricing_button_style_hover_control(){
		$this->add_control(
			'_dl_pricing_button_hover_color',
			[
				'label'     => __( 'Text Color', 'droit-addons' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .droit-pricing-plan:hover .droit-price-button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'_dl_pricing_button_background_hover_color',
			[
				'label'     => __( 'Background Color', 'droit-addons' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .droit-pricing-plan:hover .droit-price-button' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'_dl_pricing_button_hover_border_color',
			[
				'label'     => __( 'Border Color', 'droit-addons' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .droit-pricing-plan:hover .droit-price-button' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'_dl_pricing_button_hover_animation',
			[
				'label' => __( 'Animation', 'droit-addons' ),
				'type'  => \Elementor\Controls_Manager::HOVER_ANIMATION,
			]
		);
	}

	protected function register_pricing_feature__text_control(){
		$this->add_control(
			'_dl_pricing_description_text',
			[
				'label'       => 'Description',
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
				'default'     => __( 'My lady bits and bobs cup of tea bubble and squeak brolly.', 'droit-addons' ),
				'placeholder' => __( 'Enter your description', 'droit-addons' ),
				'show_label'  => true,
                'rows'        => 10,
			]
		);    
	}

	protected function register_pricing_feature__text_style_control(){
		$this->add_control(
			'_dl_pricing_features_text_color',
			[
				'label'  => __( 'Color', 'droit-addons' ),
				'type'   => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => '',
				],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .droit-pricing-plan .droit-pricing-desc' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => '_dl_pricing_features_text_typography',
				'selector' => '{{WRAPPER}} .droit-pricing-plan .droit-pricing-desc',
				'global'   => [
					'default' => '',
				],
			]
		);   
	}

    //Html render
    protected function render(){
        $settings = $this->get_settings_for_display();
        $this->_first_pricing_table_layout();
       
    }

    // First Layout
    protected function _first_pricing_table_layout(){
        $settings = $this->get_settings_for_display();
        extract($settings);
        
        // Heading
        $this->add_render_attribute( '_dl_pricing_heading_text', 'class', 'dl_title droit-pricing-heading' );
        $heading_attributes = $this->get_render_attribute_string( '_dl_pricing_heading_text' );

        // Link
        $icon_tag = '';

        if ( ! empty( $this->get_pricing_settings('_dl_pricing_link')['url'] ) ) {
            $icon_tag = 'a';

            $this->add_link_attributes( '_dl_pricing_link', $this->get_pricing_settings('_dl_pricing_link') );
        }

        $link_attributes = $this->get_render_attribute_string( '_dl_pricing_link' );

        //Check Popular price
        $populated_class = 'dl_normal_package';
        if($this->get_pricing_settings('_dl_pricing_enable_as_active') == 'yes'){
            $populated_class = 'dl_popular_package';
        }

        //Pricing Wrapper
        if( !empty( $_dl_pricing_populated_image['url'] ) ){
            $this->add_render_attribute( '_dl_pricing_wrapper', [
                'class' => [ "dl_pricing_plan", 'dl_style_01', 'dl_text_center', "droit-pricing-plan", "{$populated_class}" ],
            ] );
        }else {
            $this->add_render_attribute( '_dl_pricing_wrapper', [
                'class' => [ "dl_pricing_plan", 'dl_style_02', "droit-pricing-plan", "{$populated_class}" ],
            ] );
        }

        $_dl_pricing_wrapper = $this->get_render_attribute_string( '_dl_pricing_wrapper' );

        // Populated
        $this->add_render_attribute( '_dl_pricing_populated_text', 'class', 'dl_text droit-pricing-populated-text' );
        $populated_attributes = $this->get_render_attribute_string( '_dl_pricing_populated_text' );
        
        $this->add_render_attribute( '_dl_populated_position', [
            'class' => [ "dl_popular_tricker", "droit-popular-tricker", "droit-popular-tricker-{$this->get_pricing_settings('_dl_populated_position')}" ],
        ] );

        $populated_position_attributes = $this->get_render_attribute_string( '_dl_populated_position' );

        //Pricing
        $symbol = '';

        if ( ! empty( $this->get_pricing_settings('_dl_pricing_currency_symbol') ) ) {
            if ( '_dl_pricing_custom' !== $this->get_pricing_settings('_dl_pricing_currency_symbol') ) {
                $symbol = $this->droit_get_currency_symbol( $this->get_pricing_settings('_dl_pricing_currency_symbol') );
            } else {
                $symbol = $this->get_pricing_settings('_dl_pricing_currency_symbol_custom');
            }
        }
        $currency_format = empty( $this->get_pricing_settings('_dl_pricing_currency_format') ) ? '.' : $this->get_pricing_settings('_dl_pricing_currency_format');
        $price           = explode( $currency_format, $this->get_pricing_settings('_dl_pricing_price_text') );
        $intpart         = $price[0];
        $fraction        = '';
        if ( 2 === count( $price ) ) {
            $fraction = $price[1];
        }

        $period_position = $this->get_pricing_settings('_dl_pricing_period_position');
        $period_element = '<span class="dl_price_duration droit-price-period " ' . $this->get_render_attribute_string( '_dl_pricing_period' ) . '>' . $this->get_pricing_settings('_dl_pricing_period') . '</span>';
       
        $migration_allowed = \ELEMENTOR\Icons_Manager::is_migration_allowed();


        //Button
        
        $this->add_render_attribute( 'button_text', 'class', [
            'dl_cu_btn btn_4',
            'droit-price-button',
        ] );

        if ( ! empty( $this->get_pricing_settings('_dl_pricing_button_link')['url'] ) ) {
            $this->add_link_attributes( 'button_text', $this->get_pricing_settings('_dl_pricing_button_link') );
        }

        if ( ! empty( $this->get_pricing_settings('_dl_pricing_button_hover_animation') ) ) {
            $this->add_render_attribute( 'button_text', 'class', 'elementor-animation-' . $this->get_pricing_settings('_dl_pricing_button_hover_animation') );
        }
        ?>
       <div <?php echo $_dl_pricing_wrapper; ?>>
            <?php if ($this->get_pricing_settings('_dl_pricing_enable_as_populated') == 'yes'): ?>
                
                <div <?php echo $populated_position_attributes; ?>>
                    <?php if (!empty($this->get_pricing_settings('_dl_pricing_populated_image')['url'])): ?>
                        <img src="<?php echo esc_url($this->get_pricing_settings('_dl_pricing_populated_image')['url']); ?>" alt="<?php echo esc_attr( get_post_meta($this->get_pricing_settings('_dl_pricing_populated_image')['id'], '_wp_attachment_image_alt', true) ); ?>">
                    <?php endif; ?>
                    <<?php echo esc_html( dl_title_tag($this->get_pricing_settings('_dl_pricing_populated_tag')) ); ?> <?php echo $populated_attributes; ?>><?php echo esc_html($this->get_pricing_settings('_dl_pricing_populated_text')); ?></<?php echo esc_html( dl_title_tag($this->get_pricing_settings('_dl_pricing_populated_tag')) ); ?>>
                </div>
            <?php endif; ?>

            <?php if( $_dl_pricing_enable_image === 'yes' ): ?>
                <<?php echo esc_html( dl_title_tag($this->get_pricing_settings('_dl_pricing_title_tag')) ); ?> <?php echo $heading_attributes ?>>
                    <?php if (!empty($icon_tag)): ?>
                            <<?php echo implode( ' ', [ $icon_tag, $link_attributes ] ); ?>>
                    <?php endif; ?>
                    <?php echo esc_html($this->get_pricing_settings('_dl_pricing_heading_text')); ?>
                    <?php if (!empty($icon_tag)): ?>
                        </<?php echo $icon_tag; ?>>
                    <?php endif; ?>

                </<?php echo esc_html( dl_title_tag($this->get_pricing_settings('_dl_pricing_title_tag')) ); ?>>
                <?php if (!empty($this->get_pricing_settings('_dl_pricing_heading_desc'))): ?>
                    <p class="dl_desc heading-desc"><?php echo esc_html($this->get_pricing_settings('_dl_pricing_heading_desc')); ?></p>
                <?php endif; ?>
            
                <?php if (!empty($this->get_pricing_settings('_dl_pricing_heading_image')['url'])): ?>
                    <div class="dl_pricing_img droit-pricing-img">
                        <img src="<?php echo esc_url($this->get_pricing_settings('_dl_pricing_heading_image')['url']) ?>" alt="<?php echo esc_attr( get_post_meta($this->get_pricing_settings('_dl_pricing_heading_image')['id'], '_wp_attachment_image_alt', true) ); ?>">
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <?php if ($this->get_pricing_settings('_dl_pricing_enable_currency_price') == 'yes'): ?>  
                <div class="dl_top_pricing_title">
                    <div class="dl_price droit-price <?php echo $period_position;?>">
                        <?php if ( 'yes' === $this->get_pricing_settings('_dl_pricing_sale') && ! empty( $this->get_pricing_settings('_dl_pricing_original_price') ) ) : ?>
                            <span class="dl_regular_price dl-regular-price"><?php echo esc_html($symbol . $this->get_pricing_settings('_dl_pricing_original_price')); ?></span>
                        <?php endif; ?>
                        <?php $this->droit_render_currency_symbol( $symbol, 'before' ); ?>

                        <?php if ( ! empty( $intpart ) || 0 <= $intpart ) : ?>
                            <span class="droit-price-integer"><?php echo $intpart; ?></span>
                        <?php endif; ?>

                        <?php if ( '' !== $fraction || ( ! empty( $this->get_pricing_settings('_dl_pricing_period') ) && 'beside' === $period_position ) ) : ?>
                        <div class="droit-price-price-after">
                            <span class="droit-price-floating"><?php echo $fraction; ?></span>
                        </div>
                    <?php endif; ?>

                     <?php if ( ! empty( $this->get_pricing_settings('_dl_pricing_period') )  ) : ?>
                        <?php echo $period_element; ?>
                    <?php endif; ?>
                    </div>
                </div>
               
            <?php endif; ?>
            <<?php echo esc_html( dl_title_tag($this->get_pricing_settings('_dl_pricing_title_tag')) ); ?> <?php echo $heading_attributes ?>>
                <?php if (!empty($icon_tag)): ?>
                        <<?php echo implode( ' ', [ $icon_tag, $link_attributes ] ); ?>>
                <?php endif; ?>
                <?php if($_dl_pricing_enable_image !== 'yes'){echo esc_html($this->get_pricing_settings('_dl_pricing_heading_text')); } ?>
                <?php if (!empty($icon_tag)): ?>
                    </<?php echo $icon_tag; ?>>
                <?php endif; ?>

            </<?php echo esc_html( dl_title_tag($this->get_pricing_settings('_dl_pricing_title_tag')) ); ?>>
            <?php if ( ! empty( $settings['_dl_pricing_features_list'] ) ) : ?>
            <ul class="dl_pricing_list droit-pricing-feature">
                <?php
                    foreach ( $settings['_dl_pricing_features_list'] as $index => $item ) :
                        $repeater_setting_key = $this->get_repeater_setting_key( '_dl_pricing_item_text', '_dl_pricing_features_list', $index );
                        $this->add_inline_editing_attributes( $repeater_setting_key );

                        $migrated = isset( $item['__fa4_migrated']['_dl_pricing_selected_item_icon'] );
                        // add old default
                        if ( ! isset( $item['_dl_pricing_item_icon'] ) && ! $migration_allowed ) {
                            $item['_dl_pricing_item_icon'] = 'fa fa-check-circle';
                        }
                        $is_new = ! isset( $item['_dl_pricing_item_icon'] ) && $migration_allowed;
                        ?>
                        <li class="elementor-repeater-item-<?php echo $item['_id']; ?>">
                            
                                <?php if ( ! empty( $item['_dl_pricing_item_icon'] ) || ! empty( $item['_dl_pricing_selected_item_icon'] ) ) :
                                    if ( $is_new || $migrated ) :
                                        \ELEMENTOR\Icons_Manager::render_icon( $item['_dl_pricing_selected_item_icon'], [ 'aria-hidden' => 'true' ] );
                                    else : ?>
                                        <i class="<?php echo esc_attr( $item['_dl_pricing_item_icon'] ); ?>" aria-hidden="true"></i>
                                        <?php
                                    endif;
                                endif; ?>
                                <?php if ( ! empty( $item['_dl_pricing_item_text'] ) ) : ?>
                                    <span <?php echo $this->get_render_attribute_string( $repeater_setting_key ); ?>>
                                        <?php echo $item['_dl_pricing_item_text']; ?>
                                    </span>
                                    <?php
                                else :
                                    echo '&nbsp;';
                                endif;
                                ?>
                        </li>
                    <?php endforeach; ?>
            </ul>
            <?php endif; ?>
            <?php if ( ! empty( $this->get_pricing_settings('_dl_pricing_button_text') )) : ?> 
                <a <?php echo $this->get_render_attribute_string( 'button_text' ); ?>><?php echo esc_html($this->get_pricing_settings('_dl_pricing_button_text')); ?></a>
            <?php endif; ?>
        </div>
    <?php }


    private function droit_render_currency_symbol( $symbol, $location ) {
        $currency_position = $this->get_settings( '_dl_pricing_currency_position' );
        $location_setting = ! empty( $currency_position ) ? $currency_position : 'before';
        if ( ! empty( $symbol ) && $location === $location_setting ) {
    echo '<span class="dl_currancy droit_currency_symbol droit-currency-symbol droit-currency--' . $location . '">'. $symbol .' </span>';
        }
    }
    
    private function droit_get_currency_symbol( $symbol_name ) {
        $symbols = [
            'dollar'       => '&#36;',
            'euro'         => '&#128;',
            'franc'        => '&#8355;',
            'pound'        => '&#163;',
            'ruble'        => '&#8381;',
            'shekel'       => '&#8362;',
            'baht'         => '&#3647;',
            'yen'          => '&#165;',
            'won'          => '&#8361;',
            'guilder'      => '&fnof;',
            'peso'         => '&#8369;',
            'peseta'       => '&#8359',
            'lira'         => '&#8356;',
            'rupee'        => '&#8360;',
            'indian_rupee' => '&#8377;',
            'real'         => 'R$',
            'krona'        => 'kr',
        ];
        return isset( $symbols[ $symbol_name ] ) ? $symbols[ $symbol_name ] : '';
    }

    protected function content_template(){}
}