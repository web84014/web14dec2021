<?php
namespace DROIT_ELEMENTOR\Widgets;

if (!defined('ABSPATH')) {exit;}

class Droit_Addons_Faq extends \Elementor\Widget_Base {

    // Get Control ID
    protected function get_control_id( $control_id ) {
        return $control_id;
    }

    final public function get_faq_settings( $control_key ) {
        $control_id = $this->get_control_id( $control_key );
        return $this->get_settings( $control_id );
    }

    public function get_name() {
        return 'droit-faq';
    }
    
    public function get_title() {
        return esc_html__( 'Faq', 'droit-addons' );
    }

    public function get_icon() {
        return 'dlicons-faq addons-icon';
    }

    public function get_keywords() {
       return [ 'Faq', 'faq', 'toggle', 'droit Faq', 'dl Faq', 'dl advanced Faq', 'panel', 'navigation', 'group', 'Faq content', 'product Faq', 'droit', 'dl', 'addons', 'addon' ];
    }
    
    public function get_categories() {
        return ['droit_addons'];
    }

    protected function _register_controls()
    {
        $this->_droit_register_dl_faq_preset_controls();
        $this->_droit_register_dl_faq_content_controls();
        $this->_droit_register_dl_faq_general_style_controls();
        $this-> _droit_register_dl_faq_item_style_controls();
        $this->_droit_register_dl_faq_title_style_controls();
        $this->_droit_register_dl_faq_content_style_controls();
        do_action('dl_widget/section/style/custom_css', $this);
    }

   //Preset
   public function _droit_register_dl_faq_preset_controls() {
       $this->start_controls_section(
           '_dl_faq_preset_section',
           [
               'label' => __( 'Icons', 'droit-addons' ),
           ]
        );

       $this->add_control(
           '_dl_faq_icon_show',
           [
               'label'        => esc_html__('Enable Icon', 'droit-addons'),
               'type'         => \Elementor\Controls_Manager::SWITCHER,
               'default'      => 'yes',
               'return_value' => 'yes',
           ]
        );

        $this->add_control(
            '_dl_faq_icon_shift',
            [
                'label'        => esc_html__('Show Left Icon', 'droit-addons'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'default'      => '',
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
			'dl_faq_icon_spacing',
			[
				'label' => __( 'Width', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 1,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .droit-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
                'condition' => [
                    '_dl_faq_icon_shift' => 'yes'
                ]
			]
		);

        $this->add_control(
           '_dl_faq_icon_type',
           [   
               'label' => esc_html__('Icon Type', 'droit-addons'),
               'type' => \Elementor\Controls_Manager::CHOOSE,
               'label_block' => false,
               'options' => [
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
                   $this->get_control_id( '_dl_faq_icon_show' ) => [ 'yes' ],
                   
               ],
           ]
        );

       $this->add_control(
           '_dl_faq_selected_icon',
           [
               'label' => __( 'Down Icon', 'droit-addons' ),
               'type' => \Elementor\Controls_Manager::ICONS,
               'fa4compatibility' => 'icon',
               'default' => [
                   'value' => 'fas fa-angle-down',
                   'library' => 'fa-solid',
               ],
               'recommended' => [
                   'fa-solid' => [
                       'chevron-down',
                       'angle-down',
                       'angle-double-down',
                       'caret-down',
                       'caret-square-down',
                   ],
                   'fa-regular' => [
                       'caret-square-down',
                   ],
               ],
               'condition' => [
                   $this->get_control_id( '_dl_faq_icon_show' ) => [ 'yes' ],
                   $this->get_control_id( '_dl_faq_icon_type' ) => [ 'icon' ],
                   
               ],
           ]
        );
   
       $this->add_control(
           '_dl_faq_icon_image',
           [   
               'label' => esc_html__('Image', 'droit-addons'),
               'type' => \Elementor\Controls_Manager::MEDIA,
               'default' => [
                   'url' => '',
               ],
               'condition' => [
               $this->get_control_id( '_dl_faq_icon_show' ) => [ 'yes' ],
               $this->get_control_id( '_dl_faq_icon_type' ) => [ 'image' ],
               
           ],
           ]
        );

       $this->add_control(
           'selected_active_icon',
           [
               'label' => __( 'Up Icon', 'droit-addons' ),
               'type' => \Elementor\Controls_Manager::ICONS,
               'fa4compatibility' => 'icon_active',
               'default' => [
                   'value'   => 'fas fa-angle-up',
                   'library' => 'fa-solid',
               ],
               'recommended' => [
                   'fa-solid' => [
                       'chevron-up',
                       'angle-up',
                       'angle-double-up',
                       'caret-up',
                       'caret-square-up',
                   ],
                   'fa-regular' => [
                       'caret-square-up',
                   ],
               ],
               
               'condition' => [
                   $this->get_control_id( '_dl_faq_icon_show' ) => [ 'yes' ],
                   $this->get_control_id( '_dl_faq_icon_type' ) => 'icon',
                   $this->get_control_id( '_dl_faq_icon_type!' ) => 'none',
               ],
           ]
        );

       $this->add_control(
           '_dl_faq_active_image',
           [   
               'label' => esc_html__('Image', 'droit-addons'),
               'type' => \Elementor\Controls_Manager::MEDIA,
               'default' => [
                   'url' => '',
               ],
               'condition' => [
                   $this->get_control_id( '_dl_faq_icon_show' ) => [ 'yes' ],
                   $this->get_control_id( '_dl_faq_icon_type' ) => [ 'image' ],
                   $this->get_control_id( '_dl_faq_icon_type!' ) => 'none',
                   
               ],
           ]
        );
        $this->add_responsive_control(
            '_dl_faq_icon_size',
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
                    '{{WRAPPER}} .droit-advance-faq .droit-faq-wrapper .droit-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .droit-advance-faq .droit-faq-wrapper .droit-icon img' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .droit-advance-faq .droit-faq-wrapper .droit-icon svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );




       $this->end_controls_section();
    }

    //Content
    public function _droit_register_dl_faq_content_controls() {
        $this->start_controls_section(
            '_dl_faq_content_section',
            [
                'label' => __( 'Content', 'droit-addons' ),
            ]
        );
        
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            '_dl_faq_title',
            [
                'label' => __( 'Title', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Title Here', 'droit-addons' ),
                'placeholder' => __( 'Enter your title', 'droit-addons' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            '_dl_faq_title_size',
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
        
        $repeater->add_control(
            '_dl_faq_show_as_default',
            [
                'label' => __('Set as Default', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => '',
                'return_value' => 'yes',
            ]
        );

        $repeater->add_control(
            '_dl_faq_description_text',
            [
                'label' => 'Description',
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __( 'Choose your training and register for free. If you are a freelancer, the courses are entirely taken care of, you have nothing to pay and no money to advance.', 'droit-addons' ),
                'placeholder' => __( 'Enter your description', 'droit-addons' ),
                'show_label' => true,
                'rows' => 10,
            ]
        );
        
        $repeater->add_control(
            '_dl_faq_button_show',
            [
                'label' => esc_html__('Enable Button', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => '',
                'return_value' => 'yes',
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            '_dl_faq_button_text',
            [
                'label' => __( 'Button', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Work With Us', 'droit-addons' ),
                'placeholder' => __( 'Enter your text', 'droit-addons' ),
                'label_block' => true,
                'condition' => [
                    $this->get_control_id( '_dl_faq_button_show' ) => [ 'yes' ],
                ],
            ]
        );

        $repeater->add_control(
            '_dl_faq_link',
            [
                'label' => __( 'Link', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'droit-addons' ),
                'condition' => [
                    $this->get_control_id( '_dl_faq_button_show' ) => [ 'yes' ],
                ],
            ]
        );

        

       

        $this->add_control(
            '_dl_faq_list',
            [
                'label'       => __('Faq', 'droit-addons'),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    ['_dl_faq_title' => esc_html__('Faq Title 1', 'droit-addons')],
                    ['_dl_faq_title' => esc_html__('Faq Title 2', 'droit-addons')],
                    ['_dl_faq_title' => esc_html__('Faq Title 3', 'droit-addons')]
                ],
                'title_field' => '{{{ _dl_faq_title }}}',
            ]
        );
        
        $this->end_controls_section();
    }

    //General
    public function _droit_register_dl_faq_general_style_controls(){
        $this->start_controls_section(
            '_dl_faq_style_general',
            [
                'label' => esc_html__('General', 'droit-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'dl_faq_background',
            [
                'label' => esc_html__('Background Color', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .dl_accordion' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'dl_faq_padding',
            [
                'label' => esc_html__('Tab Padding', 'droit-addons'),
                'type'  => \Elementor\Controls_Manager:: DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .dl_accordion' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            '_dl_faq_button_border_radius_hover',
            [
                'label' => esc_html__('Border Radius', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .dl_accordion ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    public function _droit_register_dl_faq_item_style_controls() {
        $this->start_controls_section(
            '_dl_faq_item_style_settings',
            [
                'label' => esc_html__('Faq Item', 'droit-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'dl_faq_item_padding',
            [
                'label' => esc_html__('Item Padding', 'droit-addons'),
                'type'  => \Elementor\Controls_Manager:: DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .droit-advance-faq .droit-faq-wrapper ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control(
            'dl_faq_item_background',
            [
                'label' => esc_html__('Background Color', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .droit-advance-faq .droit-faq-wrapper' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            '_dl_faq_margin',
            [
                'label' => esc_html__('Tab Margin', 'droit-addons'),
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
                    '{{WRAPPER}} .droit-advance-faq .droit-faq-wrapper' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => '_dl_faq_item_border',
                'label'    => esc_html__('Border', 'droit-addons'),
                'selector' => '{{WRAPPER}} .droit-advance-faq .droit-faq-wrapper',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => '_dl_faq_box_shadow',
                'selector' => '{{WRAPPER}} .droit-advance-faq .droit-faq-wrapper',
            ]
        );

        $this->add_responsive_control(
            '_dl_faq_border_radius',
            [
                'label' => esc_html__('Border Radius', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .droit-advance-faq .droit-faq-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
    
        $this->end_controls_section();
    }

    //faq Title Style
    public function _droit_register_dl_faq_title_style_controls() {
        $this->start_controls_section(
            '_dl_faq_title_style_settings',
            [
                'label' => esc_html__('Title', 'droit-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => '_dl_faq_title_typography',
                'selector' => '{{WRAPPER}} .droit-advance-faq .droit-faq-wrapper .droit-faq-title',
            ]
        );

        $this->add_responsive_control(
            '_dl_faq_padding',
            [
                'label' => esc_html__('Padding', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .droit-advance-faq .droit-faq-wrapper .droit-faq-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            '_dl_faq_icon_gap',
            [
                'label' => esc_html__('Icon Gap', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .droit-advance-faq .droit-faq-wrapper .droit-icon i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                    '{{WRAPPER}} .droit-advance-faq .droit-faq-wrapper .droit-icon img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                    '{{WRAPPER}} .droit-advance-faq .droit-faq-wrapper .droit-icon svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    $this->get_control_id( '_dl_faq_skin!' ) => [ '_skin_4' ],
                ],
            ]
        );

        $this->start_controls_tabs('_dl_faq_header_tabs');

        $this->start_controls_tab('_dl_faq_header_normal', 
            ['label' => esc_html__('Normal', 'droit-addons')]
        );

        $this->add_control(
            '_dl_faq_text_color',
            [
                'label' => esc_html__('Text Color', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .droit-advance-faq .droit-faq-wrapper .droit-faq-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            '_dl_faq_icon_color',
            [
                'label' => esc_html__('Icon Color', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .droit-advance-faq .droit-faq-wrapper .droit-faq-title .droit-icon i' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    $this->get_control_id( '_dl_faq_icon_show' ) => [ 'yes' ],
                    $this->get_control_id( '_dl_faq_icon_type' ) => 'icon',
                    $this->get_control_id( '_dl_faq_skin!' ) => [ '_skin_4' ],
                ],
            ]

        );

        $this->end_controls_tab();

        $this->start_controls_tab('_dl_faq_header_hover', 
            ['label' => esc_html__('Hover', 'droit-addons')]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => '_dl_faq_bgtype_hover',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .droit-advance-faq .droit-faq-wrapper .droit-faq-title:hover'
            ]
        );

        $this->add_control(
            '_dl_faq_text_color_hover',
            [
                'label' => esc_html__('Text Color', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .droit-advance-faq .droit-faq-wrapper .droit-faq-title:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => '_dl_faq_border_hover',
                'label' => esc_html__('Border', 'droit-addons'),
                'selector' => '{{WRAPPER}} .droit-advance-faq .droit-faq-wrapper .droit-faq-title:hover',
            ]
        );

        $this->add_responsive_control(
            '_dl_faq_border_radius_hover',
            [
                'label' => esc_html__('Border Radius', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .droit-advance-faq .droit-faq-wrapper .droit-faq-title:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('_dl_faq_header_active', 
            ['label' => esc_html__('Active', 'droit-addons')]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => '_dl_faq_bgtype_active',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .droit-advance-faq .droit-faq-wrapper .droit-faq-title.dl-active'
            ]
        );

        $this->add_control(
            '_dl_faq_text_color_active',
            [
                'label' => esc_html__('Text Color', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .droit-advance-faq .droit-faq-wrapper .droit-faq-title.dl-active .droit-faq-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            '_dl_faq_icon_color_active',
            [
                'label' => esc_html__('Icon Color', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .droit-advance-faq .droit-faq-wrapper .droit-faq-title.dl-active .droit-icon i' => 'color: {{VALUE}};',

                    
                ],
                'condition' => [
                    $this->get_control_id( '_dl_faq_icon_show' ) => [ 'yes' ],
                    $this->get_control_id( '_dl_faq_icon_type' ) => 'icon',
                    $this->get_control_id( '_dl_faq_skin!' ) => [ '_skin_4' ],
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => '_dl_faq_border_active',
                'label' => esc_html__('Border', 'droit-addons'),
                'selector' => '{{WRAPPER}} .droit-advance-faq .droit-faq-wrapper .droit-faq-title.dl-active',
            ]
        );

        $this->add_responsive_control(
            '_dl_faq_radius_active',
            [
                'label' => esc_html__('Border Radius', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .droit-advance-faq .droit-faq-wrapper .droit-faq-title.dl-active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }

//Content Style
public function _droit_register_dl_faq_content_style_controls(){
    $this->start_controls_section(
        '_dl_faq_content_style_settings',
        [
            'label' => esc_html__('Content', 'droit-addons'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );
    
    $this->add_control(
        '_dl_faq_content_text_color',
        [
            'label' => esc_html__('Text Color', 'droit-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
                '{{WRAPPER}} .droit-advance-faq .droit-faq-wrapper .droit-faq-content-wrapper ' => 'color: {{VALUE}};',
                '{{WRAPPER}} .droit-advance-faq .droit-faq-wrapper .droit-faq-content-wrapper p' => 'color: {{VALUE}};',
            ],
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name' => '_dl_faq_content_typography',
            'selector' => 
                '{{WRAPPER}} .droit-advance-faq .droit-faq-wrapper .droit-faq-content-wrapper p',
          
        ]
    );

    $this->add_responsive_control(
        '_dl_faq_content_padding',
        [
            'label' => esc_html__('Padding', 'droit-addons'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .droit-advance-faq .droit-faq-wrapper .droit-faq-content-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    $this->end_controls_section();

    $this->start_controls_section(
        '_dl_faq_button_style_settings',
        [
            'label' => esc_html__('Button', 'droit-addons'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );

    $this->start_controls_tabs( '_dl_faq_button_tabs' );

    $this->start_controls_tab( '_dl_faq_normal_style',
        [ 
            'label' => esc_html__( 'Style', 'droit-addons')
        ]  
    );

    $this->add_control(
        '_dl_faq_button_text_color',
        [
            'label' => esc_html__('Text Color', 'droit-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
                '{{WRAPPER}} .droit-advance-faq .droit-faq-wrapper .droit-faq-content-wrapper .droit-faq-button' => 'color: {{VALUE}};',
            ],
        ]
    );

    $this->add_control(
        '_dl_faq_button_bg_color',
        [
            'label' => esc_html__('Background Color', 'droit-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
                '{{WRAPPER}} .droit-advance-faq .droit-faq-wrapper .droit-faq-content-wrapper .droit-faq-button' => 'background-color: {{VALUE}};',
            ],
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name' => '_dl_faq_button_typography',
            'selector' => 
                '{{WRAPPER}} .droit-advance-faq .droit-faq-wrapper .droit-faq-content-wrapper .droit-faq-button',
            'condition' => [
                $this->get_control_id( '_dl_faq_skin!' ) => [ '_skin_4' ],
            ],
          
        ]
    );

    $this->add_responsive_control(
        '_dl_faq_button_padding',
        [
            'label' => esc_html__('Padding', 'droit-addons'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .droit-advance-faq .droit-faq-wrapper .droit-faq-content-wrapper .droit-faq-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->add_responsive_control(
        '_dl_faq_button_margin',
        [
            'label' => esc_html__('Margin', 'droit-addons'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .droit-advance-faq .droit-faq-wrapper .droit-faq-content-wrapper .droit-faq-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name' => '_dl_faq_border_button',
            'label' => esc_html__('Border', 'droit-addons'),
            'selector' => '{{WRAPPER}} .droit-advance-faq .droit-faq-wrapper .droit-faq-content-wrapper .droit-faq-button',
        ]
    );

    $this->add_responsive_control(
        '_dl_faq_button_border_radius',
        [
            'label' => esc_html__('Border Radius', 'droit-addons'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .droit-advance-faq .droit-faq-wrapper .droit-faq-content-wrapper .droit-faq-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'condition' => [
                $this->get_control_id( '_dl_faq_skin!' ) => [ '_skin_4' ],
            ],
        ]
    );
    $this->end_controls_tab();
    $this->start_controls_tab( '_dl_faq_button_hover',
        [ 
            'label' => esc_html__( 'Hover', 'droit-addons')
        ] 
    );

    $this->add_control(
        '_dl_faq_button_text_color_hover',
        [
            'label' => esc_html__('Text Color', 'droit-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
                '{{WRAPPER}} .droit-advance-faq .droit-faq-wrapper .droit-faq-content-wrapper .droit-faq-button:hover' => 'color: {{VALUE}};',
            ],
            'condition' => [
                $this->get_control_id( '_dl_faq_skin!' ) => [ '_skin_4' ],
            ],
        ]
    );

    $this->add_control(
        '_dl_faq_button_bg_color_hover',
        [
            'label' => esc_html__('Background Color', 'droit-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
                '{{WRAPPER}} .droit-advance-faq .droit-faq-wrapper .droit-faq-content-wrapper .droit-faq-button:hover' => 'background-color: {{VALUE}};',
            ],
        ]
    );
    
    $this->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name' => '_dl_faq_border_button_hover',
            'label' => esc_html__('Border', 'droit-addons'),
            'selector' => '{{WRAPPER}} .droit-advance-faq .droit-faq-wrapper .droit-faq-content-wrapper .droit-faq-button:hover',
        ]
    );

    $this->add_responsive_control(
        '_dl_faq_button_border_radius_hover_res',
        [
            'label' => esc_html__('Border Radius', 'droit-addons'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .droit-advance-faq .droit-faq-wrapper .droit-faq-content-wrapper .droit-faq-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->end_controls_tab();
    $this->end_controls_tabs();
    $this->end_controls_section();
    
    }

    protected function render(){
        
        $settings = $this->get_settings_for_display();
        extract($settings);
        $migrated = isset( $settings['__fa4_migrated']['_dl_faq_selected_icon'] );

        if ( ! empty( $this->get_faq_settings('icon') ) && ! \ELEMENTOR\Icons_Manager::is_migration_allowed() ) {
           
            $settings['icon'] = 'fas fa-angle-up';
            $settings['icon_active'] = 'fas fa-angle-down';
        }

        $is_new = empty( $this->get_faq_settings('icon') ) && \ELEMENTOR\Icons_Manager::is_migration_allowed();
        $has_icon = ( ! $is_new || ! empty( $this->get_faq_settings('_dl_faq_selected_icon')['value'] ) );
        
        $this->add_render_attribute(
            'dl_faq_wrapper',
            [
                'id' => "droit-advance-faq-{$this->get_id()}",
                'class' => ['droit-advance-faq dl_accordion_container', $this->get_faq_settings('_dl_faq_skin')],
                'data-faqid' => $this->get_id(),
            ]
        );
        
        $has_faq = ! empty( $this->get_faq_settings('_dl_faq_list') );
        $id_int = substr( $this->get_id_int(), 0, 4 );
        ?>
        <?php if ($has_faq): ?>
        <div <?php echo $this->get_render_attribute_string('dl_faq_wrapper'); ?> >
            <div class="dl_accordion">
                <?php
                $i = 1;
            foreach ( $this->get_faq_settings('_dl_faq_list') as $index => $item ) :
                
                $tab_count = $index + 1;

                
                $has_title_text = ! empty( $item['_dl_faq_title'] );

                $has_description_text = ! empty( $item['_dl_faq_description_text'] );

                $has_image = ! empty( $item['_dl_faq_image']['url'] );

                $tab_title_setting_key = $this->get_repeater_setting_key( '_dl_faq_title', '_dl_faq_list', $index );

                $tab_content_setting_key = $this->get_repeater_setting_key( '_dl_faq_description_text', '_dl_faq_list', $index );

                $title_active_class = '';
                $dl_left = '';
                if($_dl_faq_icon_shift === 'yes'){$dl_left = 'dl_show_icon_left';}
                $content_active_class = '';

                if ($item['_dl_faq_show_as_default'] == 'yes') {
                    $title_active_class = 'dl-active-default';
                    $content_active_class = 'dl-active-default';
                }

                $this->add_render_attribute( $tab_title_setting_key, [
                    'id' => 'faq-tab-title-' . $id_int . $tab_count,
                    'class' => [ 'dl_accordion_item_title droit-faq-title', $title_active_class, $dl_left ],
                    'data-speed' => 400,
                ] );

                $this->add_render_attribute( $tab_content_setting_key, [
                    'id' => 'faq-tab-content-' . $id_int . $tab_count,
                    'class' => [ 'dl_accordion_panel', 'droit-faq-content-wrapper', $content_active_class ],
                ] );

                ?>
                    <div class="dl_accordion_item dl_accordion_style_02 droit-faq-wrapper">
                    <div <?php echo $this->get_render_attribute_string( $tab_title_setting_key ); ?>>

                    <?php if($_dl_faq_icon_shift == 'yes'): ?>
                        <div class="droit-icon-left">
                            <?php 
                            if ($this->get_faq_settings('_dl_faq_icon_show') === 'yes' ) {
                                if($this->get_faq_settings('_dl_faq_icon_type') == 'icon'){
                                    if ( $is_new || $migrated ) { ?>
                                        
                                        <span class="droit-accordion-icon-closed"><?php \ELEMENTOR\Icons_Manager::render_icon( $this->get_faq_settings('_dl_faq_selected_icon') ); ?></span>

                                        <span class="droit-accordion-icon-opend"><?php \ELEMENTOR\Icons_Manager::render_icon( $this->get_faq_settings('selected_active_icon') ); ?></span>
                                        
                                   <?php }
                                }elseif( $this->get_faq_settings('_dl_faq_icon_type') == 'image' ){ ?>

                                    <span class="droit-accordion-icon-closed">
                                        <img src="<?php echo esc_url($this->get_faq_settings('_dl_faq_icon_image')['url']); ?>" alt="closed Icon">
                                    </span>
                                    <span class="droit-accordion-icon-opend">
                                        <img src="<?php echo esc_url($this->get_faq_settings('_dl_faq_active_image')['url']); ?>" alt="Opend Icon">
                                    </span>

                               <?php }
                            }
                             ?>
                        </div>
                    <?php endif; ?>
                        <?php if ( $has_title_text ) : ?>
                            <<?php echo dl_title_tag($item['_dl_faq_title_size']); ?> class="dl_accordion_title droit-faq-title"><?php echo do_shortcode($item['_dl_faq_title']); ?></<?php echo dl_title_tag($item['_dl_faq_title_size']); ?>>
                        <?php endif; ?>
                        
                    <?php if($_dl_faq_icon_shift != 'yes'): ?>
                        <?php //echo 'NO'; ?>
                        <div class="droit-icon">
                            <?php 
                            if ($this->get_faq_settings('_dl_faq_icon_show') === 'yes' ) {
                                if($this->get_faq_settings('_dl_faq_icon_type') == 'icon'){
                                    if ( $is_new || $migrated ) { ?>
                                        
                                        <span class="droit-accordion-icon-closed"><?php \ELEMENTOR\Icons_Manager::render_icon( $this->get_faq_settings('_dl_faq_selected_icon') ); ?></span>

                                        <span class="droit-accordion-icon-opend"><?php \ELEMENTOR\Icons_Manager::render_icon( $this->get_faq_settings('selected_active_icon') ); ?></span>
                                        
                                   <?php }
                                }elseif( $this->get_faq_settings('_dl_faq_icon_type') == 'image' ){ ?>
                                    <?php if(!empty($this->get_faq_settings('_dl_faq_icon_image')['url'])): ?>
                                        <span class="droit-accordion-icon-closed">
                                            <img src="<?php echo esc_url($this->get_faq_settings('_dl_faq_icon_image')['url']); ?>" alt="closed Icon">
                                        </span>
                                    <?php endif; ?>
                                    <?php if(!empty($this->get_faq_settings('_dl_faq_active_image')['url'])): ?>
                                        <span class="droit-accordion-icon-opend">
                                            <img src="<?php echo esc_url($this->get_faq_settings('_dl_faq_active_image')['url']); ?>" alt="Opend Icon">
                                        </span>
                                    <?php endif; ?>

                               <?php }
                            }

                             ?>
                        </div>
                    <?php endif; ?>
                    </div>
                    <div <?php echo $this->get_render_attribute_string( $tab_content_setting_key ); ?>>
                        <?php if ( $has_description_text ) : ?>
                            <p class="dl_desc">
                                <?php echo do_shortcode($item['_dl_faq_description_text']); ?>
                            </p>
                        <?php endif; ?>

                         <?php if ( 'yes' == $item['_dl_faq_button_show'] ) : ?>
                            <a href="<?php if ( ! empty( $item['_dl_faq_link']['url'] ) ) { echo esc_url($item['_dl_faq_link']['url']); } ?>" class="dl_cu_btn btn_2 droit-faq-button">
                                <?php echo dl_kses($item['_dl_faq_button_text']); ?>
                            </a>
                         <?php endif; ?>
                    </div>
                    </div>
                <?php $i++; endforeach; ?>
            </div>
        </div>
         <?php endif; ?>  
    <?php }

    protected function content_template(){}
}
