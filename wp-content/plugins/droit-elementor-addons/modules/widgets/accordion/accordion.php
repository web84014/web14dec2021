<?php

namespace DROIT_ELEMENTOR\Widgets;

if (!defined('ABSPATH')) {exit;}

class Droit_Addons_Accordion extends \Elementor\Widget_Base {

    // Get Control ID
    protected function get_control_id( $control_id ) {
        return $control_id;
    }

    final public function get_accordion_settings( $control_key ) {
        $control_id = $this->get_control_id( $control_key );
        return $this->get_settings( $control_id );
    }

    public function get_name() {
        return 'droit-accordion';
    }

    public function get_title() {
        return esc_html__( 'Accordion', 'droit-addons' );
    }

    public function get_icon() {
        return 'dlicons-accordian addons-icon';
    }

    public function get_categories() {
        return ['droit_addons'];
    }

    public function get_keywords() {
        return [ 'Accordions', 'accordion', 'toggle', 'droit Accordion', 'dl Accordions', 'dl advanced Accordions', 'panel', 'navigation', 'group', 'Accordions content', 'product Accordions', 'droit', 'dl', 'addons', 'addon' ];
    }

    protected function _register_controls() {
        $this->_droit_register_dl_accordions_preset_controls();
        $this->_droit_register_dl_accordions_content_controls();
        $this->_droit_register_dl_accordions_general_style_controls();
        $this->_droit_register_dl_accordions_title_style_controls();
        $this->_droit_register_dl_accordions_content_style_controls();
        $this->_droit_button_dl_control();
        $this->_droit_register_dl_accordion_image_control();
    }

    //Preset
   public function _droit_register_dl_accordions_preset_controls() {

    $this->start_controls_section(
        '_dl_accordions_preset_section',
        [
            'label' => __( 'Icons', 'droit-elementor-addons' ),
        ]
    );

    $this->add_control(
        '_dl_accordions_icon_show',
        [
            'label'        => esc_html__('Enable Icon', 'droit-elementor-addons'),
            'type'         => \ELEMENTOR\Controls_Manager::SWITCHER,
            'default'      => 'yes',
            'return_value' => 'yes',
        ]
    );

    $this->add_control(
        '_dl_accordions_icon_type',
        [   
            'label'       => esc_html__('Icon Type', 'droit-elementor-addons'),
            'type'        => \ELEMENTOR\Controls_Manager::CHOOSE,
            'label_block' => false,
            'options'     => [
                'none' => [
                    'title' => esc_html__('None', 'droit-elementor-addons'),
                    'icon' => 'fa fa-ban',
                ],
                'icon' => [
                    'title' => esc_html__('Icon', 'droit-elementor-addons'),
                    'icon' => 'fas fa-smile-wink',
                ],
                'image' => [
                    'title' => esc_html__('Image', 'droit-elementor-addons'),
                    'icon' => 'fa fa-image',
                ],
            ],
            'default' => 'icon',
            'condition' => [
                $this->get_control_id( '_dl_accordions_icon_show' ) => [ 'yes' ],
            ],
        ]
    );

    $this->add_control(
        '_dl_accordion_selected_icon',
        [
            'label'            => __( 'Down Icon', 'droit-elementor-addons' ),
            'type'             => \ELEMENTOR\Controls_Manager::ICONS,
            'fa4compatibility' => 'icon',
            'default'          => [
                'value'   => 'fas fa-angle-down',
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
                $this->get_control_id( '_dl_accordions_icon_show' ) => [ 'yes' ],
                $this->get_control_id( '_dl_accordions_icon_type' ) => [ 'icon' ],
            ],
        ]
    );
    
   
     $this->add_control(
         '_dl_accordions_icon_image',
         [   
             'label' => esc_html__('Down Image', 'droit-elementor-addons'),
             'type' => \ELEMENTOR\Controls_Manager::MEDIA,
             'default' => [
                 'url' => '',
             ],
             'condition' => [
                $this->get_control_id( '_dl_accordions_icon_show' ) => [ 'yes' ],
                $this->get_control_id( '_dl_accordions_icon_type' ) => [ 'image' ],
            ],
         ]
     );


    $this->add_control(
        'selected_active_icon',
        [
            'label'            => __( 'Up Icon', 'droit-elementor-addons' ),
            'type'             => \ELEMENTOR\Controls_Manager::ICONS,
            'fa4compatibility' => 'icon_active',
            'default' => [
                'value' => 'fas fa-angle-up',
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
                $this->get_control_id( '_dl_accordions_icon_show' ) => [ 'yes' ],
                $this->get_control_id( '_dl_accordions_icon_type' ) => 'icon',
                $this->get_control_id( '_dl_accordions_icon_type!' ) => 'none',
            ],
        ]
    );

    $this->add_control(
         '_dl_accordions_active_image',
         [   
             'label' => esc_html__('Up Image', 'droit-elementor-addons'),
             'type'  => \ELEMENTOR\Controls_Manager::MEDIA,
             'default' => [
                 'url' => '',
             ],
             'condition' => [
                $this->get_control_id( '_dl_accordions_icon_show' ) => [ 'yes' ],
                $this->get_control_id( '_dl_accordions_icon_type' ) => [ 'image' ],
                $this->get_control_id( '_dl_accordions_icon_type!' ) => 'none',
            ],
         ]
     );

    $this->end_controls_section();
}

    //Content
    public function _droit_register_dl_accordions_content_controls(){
        
        $this->start_controls_section(
            '_dl_accordions_content_section',
            [
                'label' => __( 'Content', 'droit-elementor-addons' ),
            ]
        );
        
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            '_dl_accordions_title',
            [
                'label'       => __( 'Accordion Title', 'droit-elementor-addons' ),
                'type'        => \ELEMENTOR\Controls_Manager::TEXT,
                'default'     => __( 'Accordion Title', 'droit-elementor-addons' ),
                'placeholder' => __( 'Enter your title', 'droit-elementor-addons' ),
                'label_block' => true,
            ]
        );
        

        $repeater->add_control(
            '_dl_accordions_show_as_default',
            [
                'label'        => __('Set as Default', 'droit-elementor-addons'),
                'type'         => \ELEMENTOR\Controls_Manager::SWITCHER,
                'default'      => '',
                'return_value' => 'yes',
            ]
        );
        $repeater->add_control(
            '_dl_accordions_content_heading',
            [
                'label'     => __( 'Content', 'droit-elementor-addons' ),
                'type'      => \ELEMENTOR\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            '_dl_accordions_description_text',
            [
                'label'       => 'Description',
                'type'        => \ELEMENTOR\Controls_Manager::TEXTAREA,
                'default'     => __( 'Choose your training and register for free. If you are a freelancer, the courses are entirely taken care of, you have nothing to pay and no money to advance.', 'droit-elementor-addons' ),
                'placeholder' => __( 'Enter your description', 'droit-elementor-addons' ),
                'show_label'  => true,
                'rows'        => 10,
            ]
        );
        $repeater->add_control(
            '_dl_accordions_image_show',
            [
                'label'        => esc_html__('Enable Image', 'droit-elementor-addons'),
                'type'         => \ELEMENTOR\Controls_Manager::SWITCHER,
                'default'      => 'no',
                'return_value' => 'yes',
                'separator'    => 'before',
            ]
        );
        $repeater->add_control(
            '_dl_accordions_image', [
                'label'      => __('Image', 'droit-elementor-addons'),
                'type'       => \ELEMENTOR\Controls_Manager::MEDIA,
                'show_label' => false,
                'condition' => [
                    $this->get_control_id( '_dl_accordions_image_show' ) => [ 'yes' ],
                ],
                'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
            ]
        );
        $repeater->add_control(
            '_dl_accordions_button_show',
            [
                'label'        => esc_html__('Enable Button', 'droit-elementor-addons'),
                'type'         => \ELEMENTOR\Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'return_value' => 'yes',
                'separator'    => 'before',
            ]
        );
        $repeater->add_control(
            '_dl_accordions_button_text',
            [
                'label'       => __( 'Button', 'droit-elementor-addons' ),
                'type'        => \ELEMENTOR\Controls_Manager::TEXT,
                'default'     => __( 'Work With Us', 'droit-elementor-addons' ),
                'placeholder' => __( 'Enter your text', 'droit-elementor-addons' ),
                'label_block' => true,
                'condition'   => [
                    $this->get_control_id( '_dl_accordions_button_show' ) => [ 'yes' ],
                ],
            ]
        );
        $repeater->add_control(
            '_dl_accordions_link',
            [
                'label' => __( 'Link', 'droit-elementor-addons' ),
                'type' => \ELEMENTOR\Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'droit-elementor-addons' ),
                'condition' => [
                    $this->get_control_id( '_dl_accordions_button_show' ) => [ 'yes' ],
                ],
            ]
        );
        $repeater->add_control(
            '_dl_accordions_title_size',
            [
                'label' => __( 'Title HTML Tag', 'droit-elementor-addons' ),
                'type' => \ELEMENTOR\Controls_Manager::CHOOSE,
                'label_block' => true,
                'options' => [
                    'h1'  => [
                        'title' => __( 'H1', 'droit-elementor-addons' ),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2'  => [
                        'title' => __( 'H2', 'droit-elementor-addons' ),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3'  => [
                        'title' => __( 'H3', 'droit-elementor-addons' ),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4'  => [
                        'title' => __( 'H4', 'droit-elementor-addons' ),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5'  => [
                        'title' => __( 'H5', 'droit-elementor-addons' ),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6'  => [
                        'title' => __( 'H6', 'droit-elementor-addons' ),
                        'icon' => 'eicon-editor-h6'
                    ],
                    'p'  => [
                        'title' => __( 'P', 'droit-elementor-addons' ),
                        'icon' => 'eicon-editor-paragraph'
                    ],
                ],
                'default' => 'h3',
                'toggle' => false,
            ]
        );

        $this->add_control(
            '_dl_accordions_list',
            [
                'label'       => __('Accordions', 'droit-elementor-addons'),
                'type'        => \ELEMENTOR\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    ['_dl_accordions_title' => esc_html__('Accordion Title 1', 'droit-elementor-addons')],
                    ['_dl_accordions_title' => esc_html__('Accordion Title 2', 'droit-elementor-addons')],
                    ['_dl_accordions_title' => esc_html__('Accordion Title 3', 'droit-elementor-addons')],
                    ['_dl_accordions_title' => esc_html__('Accordion Title 4', 'droit-elementor-addons')],
                ],
                'title_field' => '{{{ _dl_accordions_title }}}',
            ]
        );
        
        $this->end_controls_section();
    }

    //General
    public function _droit_register_dl_accordions_general_style_controls(){
        $this->start_controls_section(
            '_dl_accordions_style_general',
            [
                'label' => esc_html__('General', 'droit-elementor-addons'),
                'tab'   => \ELEMENTOR\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \ELEMENTOR\Group_Control_Background::get_type(),
            [
                'name'     => '_dl_accordions_section_bg',
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .dl_accordion_item.dl_accordion_style_08'
            ]
        );

        $this->add_control(
            'dl_image_alignment_control',
            [
                'label'     => __('Content Alignment', 'droit-addons'),
                'description'=> __('If you set Content feature images, You can change Content Alignment', 'droit-addons'),
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
                ]
            ]
        ); 

        $this->add_control(
            '_dl_accordions_general_padding',
            [
                'label'      => esc_html__('Padding', 'droit-elementor-addons'),
                'type'       => \ELEMENTOR\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .droit-advance-accordions .droit-accordion-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            '_dl_accordions_margin',
            [
                'label' => esc_html__('Margin Bottom', 'droit-elementor-addons'),
                'type'  => \ELEMENTOR\Controls_Manager::SLIDER,
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
                    '{{WRAPPER}} .droit-advance-accordions .droit-accordion-wrapper' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \ELEMENTOR\Group_Control_Border::get_type(),
            [
                'name'     => '_dl_accordions_item_border',
                'label'    => esc_html__('Border', 'droit-elementor-addons'),
                'selector' => '{{WRAPPER}} .droit-advance-accordions .droit-accordion-wrapper',
            ]
        );

        $this->add_group_control(
            \ELEMENTOR\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => '_dl_accordions_box_shadow',
                'selector' => '{{WRAPPER}} .droit-advance-accordions .droit-accordion-wrapper',
            ]
        );
        $this->end_controls_section();
    }

    //Accordion Title Style
    public function _droit_register_dl_accordions_title_style_controls() {
        $this->start_controls_section(
            '_dl_accordions_icon_style_settings',
            [
                'label' => esc_html__('Icon', 'droit-elementor-addons'),
                'tab'   => \ELEMENTOR\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            '_dl_accordions_icon_color',
            [
                'label'     => esc_html__('Icon Color', 'droit-elementor-addons'),
                'type'      => \ELEMENTOR\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .droit-advance-accordions .droit-accordion-wrapper .droit-icon i' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    $this->get_control_id( '_dl_accordions_icon_show' ) => [ 'yes' ],
                    $this->get_control_id( '_dl_accordions_icon_type' ) => 'icon',
                ],
            ]
        );

        $this->add_responsive_control(
            '_dl_accordions_icon_size',
            [
                'label' => __('Icon Size', 'droit-elementor-addons'),
                'type' => \ELEMENTOR\Controls_Manager::SLIDER,
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
                    '{{WRAPPER}} .droit-advance-accordions .droit-accordion-wrapper .droit-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .droit-advance-accordions .droit-accordion-wrapper .droit-icon img' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .droit-advance-accordions .droit-accordion-wrapper .droit-icon svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
                
            ]
        );
    
        $this->add_responsive_control(
            '_dl_accordions_icon_gap',
            [
                'label' => esc_html__('Icon Gap', 'droit-elementor-addons'),
                'type' => \ELEMENTOR\Controls_Manager::SLIDER,
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
                    '{{WRAPPER}} .droit-advance-accordions .droit-accordion-wrapper .droit-icon i' => 'margin: {{SIZE}}{{UNIT}} {{SIZE}}{{UNIT}} {{SIZE}}{{UNIT}} {{SIZE}}{{UNIT}};',

                    '{{WRAPPER}} .droit-advance-accordions .droit-accordion-wrapper .droit-icon img' => 'margin: {{SIZE}}{{UNIT}} {{SIZE}}{{UNIT}} {{SIZE}}{{UNIT}} {{SIZE}}{{UNIT}};',

                    '{{WRAPPER}} .droit-advance-accordions .droit-accordion-wrapper .droit-icon svg' => 'margin: {{SIZE}}{{UNIT}} {{SIZE}}{{UNIT}} {{SIZE}}{{UNIT}} {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            '_dl_accordions_title_style_settings',
            [
                'label' => esc_html__('Title', 'droit-elementor-addons'),
                'tab'   => \ELEMENTOR\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \ELEMENTOR\Group_Control_Typography::get_type(),
            [
                'name'     => '_dl_accordions_title_typography',
                'selector' => '{{WRAPPER}} .droit-advance-accordions .droit-accordion-wrapper .droit-accordions-title',
            ]
        );


        $this->add_responsive_control(
            '_dl_accordions_padding',
            [
                'label'      => esc_html__('Padding', 'droit-elementor-addons'),
                'type'       => \ELEMENTOR\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .droit-advance-accordions .droit-accordion-wrapper .droit-accordion-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        

        $this->start_controls_tabs('_dl_accordions_header_tabs');

        $this->start_controls_tab('_dl_accordions_header_normal', 
            ['label' => esc_html__('Normal', 'droit-elementor-addons')]
        );

        $this->add_group_control(
            \ELEMENTOR\Group_Control_Background::get_type(),
            [
                'name'     => '_dl_accordions_bgtype',
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .droit-advance-accordions .droit-accordion-wrapper .droit-accordion-title'
            ]
        );
        $this->add_control(
            '_dl_accordions_text_color',
            [
                'label'     => esc_html__('Text Color', 'droit-elementor-addons'),
                'type'      => \ELEMENTOR\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .droit-advance-accordions .droit-accordion-wrapper .droit-accordions-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \ELEMENTOR\Group_Control_Border::get_type(),
            [
                'name'     => '_dl_accordions_border',
                'label'    => esc_html__('Border', 'droit-elementor-addons'),
                'selector' => '{{WRAPPER}} .droit-advance-accordions .droit-accordion-wrapper .droit-accordion-title',
            ]
        );

        $this->add_responsive_control(
            '_dl_accordions_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'droit-elementor-addons'),
                'type'       => \ELEMENTOR\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .droit-advance-accordions .droit-accordion-wrapper .droit-accordion-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();


        $this->start_controls_tab('_dl_accordions_header_active', 
            ['label' => esc_html__('Active', 'droit-elementor-addons')]
        );

        $this->add_group_control(
            \ELEMENTOR\Group_Control_Background::get_type(),
            [
                'name'     => '_dl_accordions_bgtype_active',
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .droit-advance-accordions .droit-accordion-wrapper .droit-accordion-title.dl-active'
            ]
        );

        $this->add_control(
            '_dl_accordions_text_color_active',
            [
                'label'     => esc_html__('Text Color', 'droit-elementor-addons'),
                'type'      => \ELEMENTOR\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .droit-advance-accordions .droit-accordion-wrapper .droit-accordion-title.dl-active .droit-accordions-title' => 'color: {{VALUE}};',
                    
                ],
            ]
        );

        $this->add_control(
            '_dl_accordions_icon_color_active',
            [
                'label'     => esc_html__('Icon Color', 'droit-elementor-addons'),
                'type'      => \ELEMENTOR\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .droit-advance-accordions .droit-accordion-wrapper .droit-accordion-title.dl-active .droit-icon i' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    $this->get_control_id( '_dl_accordions_icon_show' ) => [ 'yes' ],
                    $this->get_control_id( '_dl_accordions_icon_type' ) => 'icon',
                ],
            ]
        );

        $this->add_group_control(
            \ELEMENTOR\Group_Control_Border::get_type(),
            [
                'name'     => '_dl_accordions_border_active',
                'label'    => esc_html__('Border', 'droit-elementor-addons'),
                'selector' => '{{WRAPPER}} .droit-advance-accordions .droit-accordion-wrapper .droit-accordion-title.dl-active',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }

    //Content Style
    public function _droit_register_dl_accordions_content_style_controls(){
        $this->start_controls_section(
            '_dl_accordions_content_style_settings',
            [
                'label' => esc_html__('Content', 'droit-elementor-addons'),
                'tab'   => \ELEMENTOR\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            '_dl_accordions_content_bg_color',
            [
                'label'     => esc_html__('Background Color', 'droit-elementor-addons'),
                'type'      => \ELEMENTOR\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .droit-advance-accordions .droit-accordion-wrapper .droit-accordion-content-wrapper' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \ELEMENTOR\Group_Control_Background::get_type(),
            [
                'name'     => '_dl_accordions_content_bgtype',
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .droit-advance-accordions .droit-accordion-wrapper .droit-accordion-content-wrapper'
            ]
        );

        $this->add_responsive_control(
            '_dl_accordions_content_padding',
            [
                'label'      => esc_html__('Padding', 'droit-elementor-addons'),
                'type'       => \ELEMENTOR\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .droit-advance-accordions .droit-accordion-wrapper .droit-accordion-content-wrapper .dl_accordion_inner_content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \ELEMENTOR\Group_Control_Border::get_type(),
            [
                'name'     => '_dl_accordions_content_border',
                'label'    => esc_html__('Border', 'droit-elementor-addons'),
                'selector' => '{{WRAPPER}} .droit-advance-accordions .droit-accordion-wrapper .droit-accordion-content-wrapper',
            ]
        );
        
        $this->add_group_control(
            \ELEMENTOR\Group_Control_Box_Shadow::get_type(),
            [
                'name'      => '_dl_accordions_content_shadow',
                'selector'  => '{{WRAPPER}} .droit-advance-accordions .droit-accordion-wrapper .droit-accordion-content-wrapper',
                'separator' => 'before',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            '_dl_accordions_content_heading',
            [
                'label' => esc_html__('Description', 'droit-elementor-addons'),
                'tab'   => \ELEMENTOR\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            '_dl_accordions_content_text_color',
            [
                'label'     => esc_html__('Text Color', 'droit-elementor-addons'),
                'type'      => \ELEMENTOR\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .droit-advance-accordions .droit-accordion-wrapper .droit-accordion-content-wrapper .dl_accordion_inner_content' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .droit-advance-accordions .droit-accordion-wrapper .droit-accordion-content-wrapper .dl_accordion_inner_content p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \ELEMENTOR\Group_Control_Typography::get_type(),
            [
                'name'     => '_dl_accordions_content_typography',
                'selector' => 
                    '{{WRAPPER}} .droit-advance-accordions .droit-accordion-wrapper .droit-accordion-content-wrapper .dl_accordion_inner_content p',
            ]
        );
       
        $this->end_controls_section();
    }

    public function _droit_button_dl_control() {
        $this->start_controls_section(
            '_dl_accordions_content_button_settings',
            [
                'label' => esc_html__('Button Style', 'droit-elementor-addons'),
                'tab'   => \ELEMENTOR\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( '_dl_accordion_button_tabs' );

        $this->start_controls_tab( '_dl_accordion_normal_style',
            [ 
                'label' => esc_html__( 'Normal', 'droit-elementor-addons')
            ] 
        );

        $this->add_control(
            '_dl_accordions_button_bg_color',
            [
                'label'   => esc_html__('Background Color', 'droit-elementor-addons'),
                'type'    => \ELEMENTOR\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .droit-advance-accordions .droit-accordion-wrapper .droit-accordion-content-wrapper .dl_accordion_inner_content .droit-accordion-button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            '_dl_accordions_button_text_color',
            [
                'label'     => esc_html__('Text Color', 'droit-elementor-addons'),
                'type'      => \ELEMENTOR\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .droit-advance-accordions .droit-accordion-wrapper .droit-accordion-content-wrapper .dl_accordion_inner_content .droit-accordion-button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \ELEMENTOR\Group_Control_Typography::get_type(),
            [
                'name' => '_dl_accordions_button_typography',
                'selector' => 
                    '{{WRAPPER}} .droit-advance-accordions .droit-accordion-wrapper .droit-accordion-content-wrapper .dl_accordion_inner_content .droit-accordion-button',
            
            ]
        );

        $this->add_group_control(
            \ELEMENTOR\Group_Control_Border::get_type(),
            [
                'name'     => '_dl_accordions_border_button',
                'label'    => esc_html__('Border', 'droit-elementor-addons'),
                'selector' => '{{WRAPPER}} .droit-advance-accordions .droit-accordion-wrapper .droit-accordion-content-wrapper .dl_accordion_inner_content .droit-accordion-button',
            ]
        );

        $this->add_responsive_control(
            '_dl_accordions_button_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'droit-elementor-addons'),
                'type'       => \ELEMENTOR\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .droit-advance-accordions .droit-accordion-wrapper .droit-accordion-content-wrapper .dl_accordion_inner_content .droit-accordion-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            '_dl_accordions_button_padding',
            [
                'label'      => esc_html__('Padding', 'droit-elementor-addons'),
                'type'       => \ELEMENTOR\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .droit-advance-accordions .droit-accordion-wrapper .droit-accordion-content-wrapper .dl_accordion_inner_content .droit-accordion-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab( '_dl_accordion_button_hover',
            [ 
                'label' => esc_html__( 'Hover', 'droit-elementor-addons')
            ] 
        );


        $this->add_control(
            '_dl_accordions_button_bg_color_hover',
            [
                'label'     => esc_html__('Background Color', 'droit-elementor-addons'),
                'type'      => \ELEMENTOR\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .droit-advance-accordions .droit-accordion-wrapper .droit-accordion-content-wrapper .dl_accordion_inner_content .droit-accordion-button:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            '_dl_accordions_button_text_color_hover',
            [
                'label'     => esc_html__('Text Color', 'droit-elementor-addons'),
                'type'      => \ELEMENTOR\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .droit-advance-accordions .droit-accordion-wrapper .droit-accordion-content-wrapper .dl_accordion_inner_content .droit-accordion-button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \ELEMENTOR\Group_Control_Border::get_type(),
            [
                'name'     => '_dl_accordions_border_button_hover',
                'label'    => esc_html__('Border', 'droit-elementor-addons'),
                'selector' => '{{WRAPPER}} .droit-advance-accordions .droit-accordion-wrapper .droit-accordion-content-wrapper .dl_accordion_inner_content .droit-accordion-button:hover',
            ]
        );

        $this->end_controls_tab();
                
        $this->end_controls_tabs();

        $this->end_controls_section();
    } 

    public function _droit_register_dl_accordion_image_control() {
        $this->start_controls_section(
            '_dl_accordions_content_image_settings',
            [
                'label' => esc_html__('Image', 'droit-elementor-addons'),
                'tab'   => \ELEMENTOR\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
			'dl_accordion_image_height',
			[
				'label' => __( 'Height', 'droit-elementor-addons' ),
				'type'  => \Elementor\Controls_Manager::SLIDER,
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
					'{{WRAPPER}} .dl_accordion_thumb a img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
			'dl_accordion_image_width',
			[
				'label' => __( 'Width', 'droit-elementor-addons' ),
				'type'  => \Elementor\Controls_Manager::SLIDER,
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
					'{{WRAPPER}} .dl_accordion_thumb a img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_group_control(
            \ELEMENTOR\Group_Control_Border::get_type(),
            [
                'name'     => 'dl_accordion_image_border',
                'label'    => esc_html__('Border', 'droit-elementor-addons'),
                'selector' => '{{WRAPPER}} .dl_accordion_thumb a img',
            ]
        ); 
        
        $this->add_responsive_control(
            'dl_accordion_image_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'droit-elementor-addons'),
                'type'       => \ELEMENTOR\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .dl_accordion_thumb a img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    } 

    protected function render() {
    
        $settings = $this->get_settings_for_display();
        extract($settings);
        $migrated = isset( $this->get_accordion_settings('__fa4_migrated')['_dl_accordion_selected_icon'] );

        if (  !empty( $this->get_accordion_settings('icon') ) && ! \ELEMENTOR\Icons_Manager::is_migration_allowed() ) {
        
            $settings['icon']        = 'fas fa-angle-up';
            $settings['icon_active'] = 'fas fa-angle-down';
        }

        $is_new = empty( $this->get_accordion_settings('icon') ) && \ELEMENTOR\Icons_Manager::is_migration_allowed();
        $has_icon = ( ! $is_new || ! empty( $this->get_accordion_settings('_dl_accordion_selected_icon')['value'] ) );
        
        $this->add_render_attribute(
            'dl_accordion_wrapper',
            [
                'id'               => "droit-advance-accordions-{$this->get_id()}",
                'class'            => ['droit-advance-accordions dl_accordion_container', $this->get_accordion_settings('_dl_accordions_skin')],
                'data-Accordionid' => $this->get_id(),
            ]
        );
        
        $has_accordions = ! empty( $this->get_accordion_settings('_dl_accordions_list') );
        $id_int         = substr( $this->get_id_int(), 0, 4 );
        ?>
        <?php if ($has_accordions): ?>
        <div <?php echo $this->get_render_attribute_string('dl_accordion_wrapper'); ?> >
            <div class="dl_accordion">
                <?php
                $i = 1;
            foreach ( $this->get_accordion_settings('_dl_accordions_list') as $index => $item ) :
                
                $tab_count = $index + 1;

                $has_title_text = ! empty( $item['_dl_accordions_title'] );

                $has_description_text = ! empty( $item['_dl_accordions_description_text'] );

                $has_image = ! empty( $item['_dl_accordions_image']['url'] );

                $tab_title_setting_key = $this->get_repeater_setting_key( '_dl_accordions_title', '_dl_accordions_list', $index );

                $tab_content_setting_key = $this->get_repeater_setting_key( '_dl_accordions_description_text', '_dl_accordions_list', $index );

                $icon_tag = '';
                if ( ! empty( $item['_dl_accordions_link']['url'] ) ) {
                    $icon_tag = 'a';
                    $this->add_link_attributes( '_dl_accordions_link', $item['_dl_accordions_link'] );
                }
                $link_attributes = $this->get_render_attribute_string( '_dl_accordions_link' );


                $title_active_class = '';
                $content_active_class = '';

                if ($item['_dl_accordions_show_as_default'] == 'yes') {
                    $title_active_class   = 'dl-active-default dl-active';
                    $content_active_class = 'dl-active-default dl-active';
                }

                $this->add_render_attribute( $tab_title_setting_key, [
                    'id'         => 'accordion-tab-title-' . $id_int . $tab_count,
                    'class'      => [ 'dl_accordion_item_title droit-accordion-title', $title_active_class ],
                    'data-speed' => 400,
                ] );

                $this->add_render_attribute( $tab_content_setting_key, [
                    'id'    => 'droit-tab-content-' . $id_int . $tab_count,
                    'class' => [ 'dl_accordion_panel', 'droit-accordion-content-wrapper', $content_active_class ],
                ] );

                ?>
                    <div class="dl_accordion_item dl_accordion_style_08 droit-accordion-wrapper">
                    <div <?php echo $this->get_render_attribute_string( $tab_title_setting_key ); ?>>
                        <?php if ( $has_title_text ) : ?>
                            <<?php echo esc_html( dl_title_tag($this->get_accordion_settings('_dl_accordions_title_size')) ); ?> class="dl_accordion_title droit-accordions-title">
                                <?php echo do_shortcode($item['_dl_accordions_title']); ?>
                            </<?php echo esc_html( dl_title_tag($this->get_accordion_settings('_dl_accordions_title_size')) ); ?>>
                        <?php endif; ?>
                        <div class="droit-icon">
                            <?php 
                            if ($this->get_accordion_settings('_dl_accordions_icon_show') === 'yes' ) {
                                if($this->get_accordion_settings('_dl_accordions_icon_type') == 'icon'){
                                    if ( $is_new || $migrated ) { ?>
                                        <span class="droit-accordion_icon" aria-hidden="true">
                                            <span class="droit-accordion-icon-closed"><?php \ELEMENTOR\Icons_Manager::render_icon( $this->get_accordion_settings('_dl_accordion_selected_icon') ); ?></span>

                                            <span class="droit-accordion-icon-opend"><?php \ELEMENTOR\Icons_Manager::render_icon( $this->get_accordion_settings('selected_active_icon') ); ?></span>
                                        </span>
                                <?php }
                                }elseif( $this->get_accordion_settings('_dl_accordions_icon_type') == 'image' ){ ?>
                                    <span class="droit-accordion_icon" aria-hidden="true">
                                        <?php if(!empty($this->get_accordion_settings('_dl_accordions_icon_image')['url'])): ?>
                                            <span class="droit-accordion-icon-closed">
                                                <img src="<?php echo esc_url($this->get_accordion_settings('_dl_accordions_icon_image')['url']); ?>" alt="closed Icon">
                                            </span>
                                        <?php endif; ?>
                                        <?php if(!empty($this->get_accordion_settings('_dl_accordions_active_image')['url'])): ?>
                                            <span class="droit-accordion-icon-opend">
                                                <img src="<?php echo esc_url($this->get_accordion_settings('_dl_accordions_active_image')['url']); ?>" alt="Opend Icon">
                                            </span>
                                        <?php endif; ?>
                                    </span>

                            <?php }
                                
                            }
                            ?>
                        </div>
                    </div>
                    <div <?php echo $this->get_render_attribute_string( $tab_content_setting_key ); ?>>
                        <div class="dl_accordion_inner <?php if($dl_image_alignment_control == 'center'){echo 'dl_item_left';} if($dl_image_alignment_control == 'right'){echo 'dl_item_right ';} ?>">
                            <?php if ( 'yes' == $item['_dl_accordions_image_show'] ) : ?>
                                <?php if ( $has_image ): ?>
                                <div class="dl_accordion_thumb">
                                    <a <?php echo $link_attributes; ?> >
                                    <img src="<?php echo esc_url($item['_dl_accordions_image']['url']); ?>" alt="#" class="dl_img_res">
                                    </a>
                                </div>
                                <?php endif; ?>
                            <?php endif; ?>
                            <div class="dl_accordion_inner_content">
                                <?php if ( $has_description_text ) : ?>
                                <p class="dl_desc">
                                    <?php echo do_shortcode($item['_dl_accordions_description_text']); ?>
                                </p>
                                <?php endif; ?>
                                
                                <?php if ( 'yes' == $item['_dl_accordions_button_show'] ) : ?>
                                    <a <?php echo $link_attributes; ?> class="dl_cu_btn btn_2 droit-accordion-button">
                                        <?php echo dl_kses($item['_dl_accordions_button_text']); ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    </div>
                <?php $i++; endforeach; ?>
            </div>
        </div>
        <?php endif; ?>  
<?php 
    }

    protected function content_template(){}
}