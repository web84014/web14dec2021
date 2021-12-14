<?php
namespace DROIT_ELEMENTOR\Widgets;

if (!defined('ABSPATH')) {exit;}

class Droit_Addons_Tab extends \Elementor\Widget_Base {

    // Get Control ID
    protected function get_control_id( $control_id ) {
        return $control_id;
    }

    final public function get_tab_settings( $control_key ) {
        $control_id = $this->get_control_id( $control_key );
        return $this->get_settings( $control_id );
    }

    public function get_name() {
        return 'droit-tab';
    }
    
    public function get_title() {
        return esc_html__( 'Tab', 'droit-addons' );
    }

    public function get_icon() {
        return 'dlicons-Tab addons-icon';
    }

    public function get_keywords() {
        return [
            'tabs',
            'accordion',
            'toggle',
            'droit tab',
            'dl tabs',
            'dl advanced tabs',
            'panel',
            'navigation',
            'group',
            'tabs content',
            'product tabs'
        ];
    }
    
    public function get_categories() {
        return ['droit_addons'];
    }

    protected function _register_controls() {
        $this->_droit_register_dl_tabs_content_controls();
        $this->_droit_register_dl_tabs_general_style_controls();
        $this->_droit_register_dl_tabs_title_style_controls();
        $this->_droit_register_dl_tabs_title_caret_style_controls();
        $this->_droit_register_dl_tabs_content_style_controls();
        do_action('dl_widget/section/style/custom_css', $this);
    }

    //Content
    public function _droit_register_dl_tabs_content_controls(){
        $this->start_controls_section(
            '_dl_tabs_content_section',
            [
                'label' => __( 'Content', 'droit-addons' ),
                
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            '_dl_tabs_icon_show',
            [
                'label'         => esc_html__('Enable Media', 'droit-addons'),
                'type'          => \Elementor\Controls_Manager::SWITCHER,
                'default'       => 'yes',
                'return_value'  => 'yes',
                
            ]
        );

        $repeater->add_control(
            '_dl_tabs_title',
            [
                'label'       => __( 'Tab Title', 'droit-addons' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => __( 'Tab Title', 'droit-addons' ),
                'placeholder' => __( 'Enter your title', 'droit-addons' ),
                'label_block' => true,
            ] 
        );

        $repeater->add_control(
            '_dl_tabs_icon_type',
            [   
                'label'       => esc_html__('Icon Type', 'droit-addons'),
                'type'        => \Elementor\Controls_Manager::CHOOSE,
                'label_block' => false,
                'options'     => [
                    'none' => [
                        'title' => esc_html__('None', 'droit-addons'),
                        'icon' => 'fa fa-ban',
                    ],
                    'icon' => [
                        'title' => esc_html__('Icon', 'droit-addons'),
                        'icon' => 'fas fa-smile-wink',
                    ],
                    'image' => [
                        'title' => esc_html__('Image', 'droit-addons'),
                        'icon' => 'fa fa-image',
                    ],
                ],
                'default' => 'icon',   
                'condition' => [
                    '_dl_tabs_icon_show' => 'yes'
                ]         
            ]
        );

        $repeater->add_control(
            '_dl_tabs_tab_title_icon_new',
            [   
                'label'            => esc_html__('Icon', 'droit-addons'),
                'type'             => \Elementor\Controls_Manager::ICONS,
                'fa4compatibility' => '_dl_tabs_tab_title_icon',
                'default'          => [
                    'value'   => 'fas fa-laptop-code',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    $this->get_control_id('_dl_tabs_icon_type') =>  [ 'icon' ],
                    '_dl_tabs_icon_show' => 'yes'
                ],
                
                
            ]
        );

        $repeater->add_control(
            '_dl_tabs_tab_title_image',
            [   
                'label' => esc_html__('Image', 'droit-addons'),
                'type'  => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    $this->get_control_id('_dl_tabs_icon_type') =>  [ 'image' ],
                    '_dl_tabs_icon_show' => 'yes'
                ],
                
            ]
        );

        $repeater->add_control(
            '_dl_tabs_show_as_default',
            [
                'label'        => __('Set as Default', 'droit-addons'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'default'      => 'dl_inactive',
                'return_value' => 'active-default',
            ]
        );

        $repeater->add_control(
            '_dl_tabs_content_heading',
            [
                'label'     => __( 'Content', 'droit-addons' ),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            '_dl_tabs_title_text',
            [
                'label'       => __( 'Title', 'droit-addons' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => __( 'Best for the web developers', 'droit-addons' ),
                'placeholder' => __( 'Enter your title', 'droit-addons' ),
                'label_block' => true,
                'separator'   => 'before',
            ]
        );

        $repeater->add_control(
            '_dl_tabs_description_text',
            [
                'label'       => 'Description',
                'type'        => \Elementor\Controls_Manager::WYSIWYG,
                'default'     => __( '<p>Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet. Minim mollit non deserunt ullamco est sit aliqua dolor do amet sint.</p>', 'droit-addons' ),
                'placeholder' => __( 'Enter your description', 'droit-addons' ),
                'show_label'  => true,
            ]
        );

        $repeater->add_control(
            '_dl_tabs_button_show',
            [
                'label'        => esc_html__('Enable Button', 'droit-addons'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'return_value' => 'yes',
                'separator'    => 'before',
            ]
        );

        $repeater->add_control(
            '_dl_tabs_button_text',
            [
                'label'       => __( 'Button', 'droit-addons' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => __( 'Learn More', 'droit-addons' ),
                'placeholder' => __( 'Enter your text', 'droit-addons' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            '_dl_tabs_link',
            [
                'label'       => __( 'Link', 'droit-addons' ),
                'type'        => \Elementor\Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'droit-addons' ),
            ]
        );

        $repeater->add_control(
            '_dl_tabs_title_size',
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

        $this->add_control(
            '_dl_tabs_list',
            [
                'label'       => __('Tabs', 'droit-addons'),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    ['_dl_tabs_title' => esc_html__('Tab Title 1', 'droit-addons')],
                    ['_dl_tabs_title' => esc_html__('Tab Title 2', 'droit-addons')],
                    ['_dl_tabs_title' => esc_html__('Tab Title 3', 'droit-addons')],
                    ['_dl_tabs_title' => esc_html__('Tab Title 4', 'droit-addons')],
                ],
                'title_field' => '{{{ _dl_tabs_title }}}',
            ]
        );
        
        $this->end_controls_section();
    }

    //General
    public function _droit_register_dl_tabs_general_style_controls(){
        $this->start_controls_section(
            '_dl_tabs_style_general',
            [
                'label' => esc_html__('General', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
    
        $this->add_responsive_control(
            '_dl_accordions_content_general',
            [
                'label' => __( 'Content Alignment', 'droit-elementor-addons' ),
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
                    '{{WRAPPER}} .dl_tab_content_wrapper' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            '_dl_tabs_padding',
            [
                'label'      => esc_html__('Padding', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .droit-advance-tabs' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            '_dl_tabs_margin',
            [
                'label'      => esc_html__('Margin', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .droit-advance-tabs' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => '_dl_tabs_border',
                'label'    => esc_html__('Border', 'droit-addons'),
                'selector' => '{{WRAPPER}} .droit-advance-tabs',
            ]
        );

        $this->add_responsive_control(
            '_dl_tabs_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .droit-advance-tabs' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => '_dl_tabs_box_shadow',
                'selector' => '{{WRAPPER}} .droit-advance-tabs',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_dl_tabs_style_icon',
            [
                'label' => esc_html__('Icon Settings', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_responsive_control(
            '_dl_tabs_icon_repeater_size',
            [
                'label'      => __('Icon Size', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl_tab_menu_item img' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .dl_tab_menu .dl_tab_menu_item.droit-tab-nav-items i' => 'font-size: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            '_dl_tabs_title_width_gap_below',
            [
                'label'      => __('Icon Bottom Gap', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl_tab_menu .dl_tab_menu_item.droit-tab-nav-items i' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );     

        $this->end_controls_section();
    }

    //Tab Title Style
    public function _droit_register_dl_tabs_title_style_controls() {
        $this->start_controls_section(
            '_dl_tabs_title_style_settings',
            [
                'label' => esc_html__('Tab Title', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => '_dl_tabs_tab_title_typography',
                'selector' => '{{WRAPPER}} .droit-advance-tabs .droit-advance-tabs-navs > ul li',
            ]
        );

        $this->add_responsive_control(
            '_dl_tabs_title_width_gap',
            [
                'label'      => __('Items Gap', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 10000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 10000,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .droit-advance-tabs-navs .droit-advance-navs' => 'column-gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            '_dl_tabs_title_margin_bottom_gap',
            [
                'label'      => __('Bottom Spacing', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .droit-advance-tabs .droit-advance-tabs-navs ul li' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

       

        $this->add_responsive_control(
            '_dl_tabs_tab_padding',
            [
                'label' => esc_html__('Padding', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .droit-advance-tabs .droit-advance-tabs-navs > ul li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('_dl_tabs_header_tabs');

        $this->start_controls_tab('_dl_tabs_header_normal', 
            ['label' => esc_html__('Normal', 'droit-addons')]
        );
      
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => '_dl_tabs_tab_bgtype',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .droit-advance-tabs .droit-advance-tabs-navs > ul li'
            ]
        );

        $this->add_control(
            '_dl_tabs_tab_text_color',
            [
                'label' => esc_html__('Text Color', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .droit-advance-tabs .droit-advance-tabs-navs > ul li, {{WRAPPER}} .droit-advance-tabs .droit-advance-tabs-navs > ul li .droit-tab-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            '_dl_tabs_tab_icon_color',
            [
                'label' => esc_html__('Icon Color', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .droit-advance-tabs .droit-advance-tabs-navs ul li i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .droit-advance-tabs .droit-advance-tabs-navs ul li svg path' => 'fill: {{VALUE}};',
                ],
                'condition' => [
                    $this->get_control_id('_dl_tabs_icon_show') =>  [ 'yes' ],
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => '_dl_tabs_tab_border',
                'label' => esc_html__('Border', 'droit-addons'),
                'selector' => '{{WRAPPER}} .droit-advance-tabs .droit-advance-tabs-navs > ul li',
            ]
        );

        $this->add_responsive_control(
            '_dl_tabs_tab_border_radius',
            [
                'label' => esc_html__('Border Radius', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .droit-advance-tabs .droit-advance-tabs-navs > ul li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('_dl_tabs_header_hover', 
            ['label' => esc_html__('Hover', 'droit-addons')]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => '_dl_tabs_tab_bgtype_hover',
                'types' => [ 'gradient' ],
                'selector' => '{{WRAPPER}} .droit-advance-tabs .droit-advance-tabs-navs > ul li:hover'
            ]
        );

        $this->add_control(
            '_dl_tabs_tab_text_color_hover',
            [
                'label' => esc_html__('Text Color', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .droit-advance-tabs .droit-advance-tabs-navs > ul li:hover .droit-tab-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            '_dl_tabs_tab_icon_color_hover',
            [
                'label' => esc_html__('Icon Color', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .droit-advance-tabs .droit-advance-tabs-navs ul li:hover i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .droit-advance-tabs .droit-advance-tabs-navs ul li:hover svg path' => 'fill: {{VALUE}};',
                ],
                'condition' => [
                    $this->get_control_id('_dl_tabs_icon_show') =>  [ 'yes' ],
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => '_dl_tabs_tab_border_hover',
                'label' => esc_html__('Border', 'droit-addons'),
                'selector' => '{{WRAPPER}} .droit-advance-tabs .droit-advance-tabs-navs ul li:hover',
            ]
        );

        $this->add_responsive_control(
            '_dl_tabs_tab_border_radius_hover',
            [
                'label' => esc_html__('Border Radius', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .droit-advance-tabs .droit-advance-tabs-navs ul li:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('_dl_tabs_header_active', 
            ['label' => esc_html__('Active', 'droit-addons')]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => '_dl_tabs_tab_bgtype_active',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .droit-advance-tabs .droit-advance-tabs-navs ul li.dl_active, {{WRAPPER}} .droit-advance-tabs .droit-advance-tabs-navs ul li.active-default'
            ]
        );

        $this->add_control(
            '_dl_tabs_tab_text_color_active',
            [
                'label' => esc_html__('Text Color', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .droit-advance-tabs .droit-advance-tabs-navs ul li.dl_active .droit-tab-title' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .droit-advance-tabs .droit-advance-tabs-navs ul li.active-default .droit-tab-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            '_dl_tabs_tab_icon_color_active',
            [
                'label' => esc_html__('Icon Color', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .droit-advance-tabs .droit-advance-tabs-navs ul li.dl_active i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .droit-advance-tabs .droit-advance-tabs-navs ul li.active-default i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .droit-advance-tabs .droit-advance-tabs-navs ul li.active-default svg path' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .droit-advance-tabs .droit-advance-tabs-navs ul li.active-default svg path' => 'fill: {{VALUE}};',
                ],
                'condition' => [
                    $this->get_control_id('_dl_tabs_icon_show') =>  [ 'yes' ],
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => '_dl_tabs_tab_border_active',
                'label' => esc_html__('Border', 'droit-addons'),
                'selector' => '{{WRAPPER}} .droit-advance-tabs .droit-advance-tabs-navs ul li.dl_active, {{WRAPPER}} .droit-advance-tabs .droit-advance-tabs-navs ul li.active-default',
            ]
        );

        $this->add_responsive_control(
            '_dl_tabs_tab_border_radius_active',
            [
                'label' => esc_html__('Border Radius', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .droit-advance-tabs .droit-advance-tabs-navs ul li.dl_active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .droit-advance-tabs .droit-advance-tabs-navs ul li.active-default' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }

    //Caret Style
    public function _droit_register_dl_tabs_title_caret_style_controls(){
        $this->start_controls_section(
            '_dl_tabs_tab_caret_style_settings',
            [
                'label' => esc_html__('Shape', 'droit-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                
            ]
        );
        
        $this->add_control(
            '_dl_tabs_border_bottom_show',
            [
                'label'        => esc_html__('Bottom Shape', 'droit-addons'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            '_dl_tabs_border_color_item',
            [
                'label'     => esc_html__('Shape Color', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .dl_tab_container.dl_style_01 .dl_tab_menu .dl_tab_menu_item.dl_active .border-style' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            '_dl_tabs_tab_border_bottom_width_active',
            [
                'label'      => esc_html__('Shape Bottom Width', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range' => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 1000,
                        'step' => 1,
                    ],
                    'em' => [
                        'min'  => 0,
                        'max'  => 50,
                        'step' => 1,
                    ],
                    '%' => [
                        'min'  => 0,
                        'max'  => 1000,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .droit-advance-tabs .droit-tab-nav-items .border-style' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    $this->get_control_id('_dl_tabs_border_bottom_show') => ['yes'],
                ],
            ]
        );

        $this->add_responsive_control(
            '_dl_tabs_tab_border_bottom_height_active',
            [
                'label' => esc_html__('Shape Bottom Height', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .droit-advance-tabs .droit-tab-nav-items .border-style' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    $this->get_control_id('_dl_tabs_border_bottom_show') => ['yes'],
                ],
            ]
        );

        $this->add_responsive_control(
            '_dl_tabs_tab_border_bottom_position_top_active',
            [
                'label' => esc_html__('Shape Bottom Top/Bottom', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .droit-advance-tabs .droit-tab-nav-items .border-style' => 'top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    $this->get_control_id('_dl_tabs_border_bottom_show') => ['yes'],
                ],
            ]
        );

        $this->add_responsive_control(
            '_dl_tabs_tab_border_bottom_position_left_active',
            [
                'label' => esc_html__('Shape Bottom Left/Right', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .droit-advance-tabs .droit-tab-nav-items .border-style' => 'left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    $this->get_control_id('_dl_tabs_border_bottom_show') => ['yes'],
                ],
            ]
        );

        $this->end_controls_section();
    }

    //Content Style
    public function _droit_register_dl_tabs_content_style_controls(){
        $this->start_controls_section(
            '_dl_tabs_tab_content_style_settings',
            [
                'label' => esc_html__('Content', 'droit-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => '_dl_tabs_content_bgtype',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .droit-advance-tabs .droit-tab-content-wrapper > div'
            ]
        );

        $this->add_responsive_control(
            '_dl_tabs_content_padding',
            [
                'label' => esc_html__('Padding', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .droit-advance-tabs .droit-tab-content-wrapper > div' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            '_dl_tabs_content_margin',
            [
                'label' => esc_html__('Margin', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .droit-advance-tabs .droit-tab-content-wrapper > div' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => '_dl_tabs_content_border',
                'label' => esc_html__('Border', 'droit-addons'),
                'selector' => '{{WRAPPER}} .droit-advance-tabs .droit-tab-content-wrapper > div',
            ]
        );

        $this->add_responsive_control(
            '_dl_tabs_content_radius',
            [
                'label' => esc_html__('Border Radius', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .dl_tab_content_wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => '_dl_tabs_content_shadow',
                'selector' => '{{WRAPPER}} .droit-advance-tabs .droit-tab-content-wrapper > div',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            '_dl_tabs_title_heading',
            [
                'label' => __( 'Title', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            '_dl_tabs_title_text_color',
            [
                'label' => esc_html__('Text Color', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .droit-advance-tabs .droit-tab-content-wrapper .droit-tab-title' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .droit-advance-tabs .droit-tab-content-wrapper .droit-tab-title p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => '_dl_tabs_title_typography',
                'selector' =>
                    '{{WRAPPER}} .droit-advance-tabs .droit-tab-content-wrapper .droit-tab-title',
                
            ]
        );

        $this->add_responsive_control(
            '_dl_tabs_icon_title_size',
            [
                'label'      => __('Bottom Spacing', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl_tab_content_wrapper.dl_active a' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    
                ],
            ]
        );


        $this->add_control(
            '_dl_tabs_content_heading',
            [
                'label' => __( 'Description', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            '_dl_tabs_content_text_color',
            [
                'label' => esc_html__('Text Color', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .droit-advance-tabs .droit-tab-content-wrapper .droit-tab-text' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .droit-advance-tabs .droit-tab-content-wrapper .droit-tab-text p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => '_dl_tabs_content_typography',
                'selector' => 
                    '{{WRAPPER}} .droit-advance-tabs .droit-tab-content-wrapper .droit-tab-text p',
            
            ]
        );

        $this->add_responsive_control(
            '_dl_tabs_desc_bottom_spacing',
            [
                'label'      => __('Bottom Spacing', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl_desc.droit-tab-text' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    
                ],
            ]
        );

        $this->add_control(
            '_dl_tabs_button_heading',
            [
                'label' => __( 'Button', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs( 'tab_content_tabs' );

		$this->start_controls_tab(
			'_tab_content_button_normal',
			[
				'label' => __( 'Normal', 'droit-addons' ),
			]
		);

        $this->add_control(
            '_dl_tabs_button_text_color',
            [
                'label'     => esc_html__('Text Color', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .droit-advance-tabs .droit-tab-content-wrapper .droit-tab-button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            '_dl_tabs_button_bg_color',
            [
                'label'     => esc_html__('Background Color', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .droit-advance-tabs .droit-tab-content-wrapper .droit-tab-button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => '_dl_tabs_button_typography',
                'selector' => 
                    '{{WRAPPER}} .droit-advance-tabs .droit-tab-content-wrapper .droit-tab-button',
            
            ]
        );

        $this->add_responsive_control(
            '_dl_tabs_button_padding',
            [
                'label'      => esc_html__('Padding', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .droit-advance-tabs .droit-tab-content-wrapper .droit-tab-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            '_dl_tabs_button_margin',
            [
                'label'      => esc_html__('Margin', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .droit-advance-tabs .droit-tab-content-wrapper .droit-tab-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => '_dl_tabs_border_button',
                'label'    => esc_html__('Border', 'droit-addons'),
                'selector' => '{{WRAPPER}} .droit-advance-tabs .droit-tab-content-wrapper .droit-tab-button',
            ]
        );

        $this->add_responsive_control(
            '_dl_tabs_button_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .droit-advance-tabs .droit-tab-content-wrapper .droit-tab-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

		$this->start_controls_tab(
			'_tab_content_button_hover',
			[
				'label' => __( 'Hover', 'droit-addons' ),
			]
		);

        $this->add_control(
            '_dl_tabs_button_text_color_hover',
            [
                'label'     => esc_html__('Text Color', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .droit-advance-tabs .droit-tab-content-wrapper .droit-tab-button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            '_dl_tabs_button_bg_color_hover',
            [
                'label'     => esc_html__('Background Color', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .droit-advance-tabs .droit-tab-content-wrapper .droit-tab-button:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => '_dl_tabs_border_button_hover',
                'label'    => esc_html__('Border', 'droit-addons'),
                'selector' => '{{WRAPPER}} .droit-advance-tabs .droit-tab-content-wrapper .droit-tab-button:hover',
            ]
        );


        $this->end_controls_tab();
        $this->end_controls_tabs();
        
        $this->end_controls_section();
    }

    //Html render
    protected function render(){
       
        $this->_dl_tabs_one();
     
    }

    //Layout One
    protected function _dl_tabs_one() {
        $settings = $this->get_settings_for_display();
        extract($settings);
        

        $this->add_render_attribute(
            'dl_tab_wrapper',
            [
                'id'         => "droit-advance-tabs-{$this->get_id()}",
                'class'      => ['droit-advance-tabs dl_tab_container dl_style_01', $this->get_tab_settings('_dl_tabs_skin')],
                'data-tabid' => $this->get_id(),
            ]
        );
        $this->add_render_attribute( '_dl_tab_title_attr', 'class', 'dl_title droit-tab-title' );
        $this->add_render_attribute( '_dl_tab_description_attr', 'class', 'dl_desc droit-tab-text' );
        $has_tabs = ! empty( $this->get_tab_settings('_dl_tabs_list') );
        $id_int = substr( $this->get_id_int(), 0, 4 );
        ?>
        <?php if ($has_tabs): ?>
            <div <?php echo $this->get_render_attribute_string('dl_tab_wrapper'); ?>>
            <div class="droit-tabs-nav droit-advance-tabs-navs">
                <ul class="dl_tab_menu droit-advance-navs">
                    <?php foreach ($this->get_tab_settings('_dl_tabs_list') as $index => $tab): 

                        $tab_count = $index + 1;
                        $tab_title_setting_key = $this->get_repeater_setting_key( '_dl_tabs_title', '_dl_tabs_list', $index );
                        
                        $this->add_render_attribute( $tab_title_setting_key, [
                            'id' => 'droit-tab-title-' . $id_int . $tab_count,
                            'class' => [ 'dl_tab_menu_item droit-tab-nav-items' ],
                            'data-tab' => $tab_count,
                        ] );

                        $this->add_render_attribute($tab_title_setting_key, 'class', $tab['_dl_tabs_show_as_default']);

                        if (!empty($this->get_tab_settings('_dl_tabs_border_bottom_none'))) {
                            $this->add_render_attribute($tab_title_setting_key, 'class', $this->get_tab_settings('_dl_tabs_border_bottom_none'));  
                        }
                        
                        ?>
                        <li <?php echo $this->get_render_attribute_string( $tab_title_setting_key ); ?> >
                        <?php if ($tab['_dl_tabs_icon_show'] == 'yes'):?> 
                            <?php if( $tab['_dl_tabs_icon_type'] === 'icon'): ?>
                            
                            <?php 
                                \ELEMENTOR\Icons_Manager::render_icon( $tab['_dl_tabs_tab_title_icon_new'], [ 'aria-hidden' => 'true' ] );
                             ?>
                            <?php endif;?>
                            <?php if ($tab['_dl_tabs_icon_type'] === 'image'): ?>
                                <img src="<?php echo esc_attr($tab['_dl_tabs_tab_title_image']['url']); ?>" alt="">
                            
                            <?php endif; ?>
                        <?php endif;?>
                        <span class="droit-tab-title"><?php echo $tab['_dl_tabs_title'] ?></span><?php if($_dl_tabs_border_bottom_show == 'yes'){echo '<span class="border-style"></span>'; } ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            
            <div class="tab_container droit-tab-content-wrapper">
                <?php foreach ($this->get_tab_settings('_dl_tabs_list') as $index => $tab):
                    $tab_count = $index + 1;
                    $has_title_text = ! empty( $tab['_dl_tabs_title_text'] );
                    $has_description_text = ! empty( $tab['_dl_tabs_description_text'] );
                    $tab_link_setting_key = $this->get_repeater_setting_key( '_dl_tabs_link', '_dl_tabs_list', $index );
                    $icon_tag = 'span';
                    if ( ! empty( $tab['_dl_tabs_link']['url'] ) ) {
                        $icon_tag = 'a';
                        $this->add_link_attributes( $tab_link_setting_key, $tab['_dl_tabs_link'] );
                    }
                    $link_attributes = $this->get_render_attribute_string( $tab_link_setting_key );

                    $tab_content_setting_key = $this->get_repeater_setting_key( '_dl_tabs_description_text', '_dl_tabs_list', $index );
                        
                    $this->add_render_attribute( $tab_content_setting_key, [
                        'id' => 'droit-tab-content-' . $id_int . $tab_count,
                        'class' => [ 'dl_tab_content_wrapper' ],
                        'data-tab' => $tab_count,
                    ] );
                    $this->add_render_attribute($tab_content_setting_key, 'class', $tab['_dl_tabs_show_as_default']);
                    ?>
                <div class="dl_tab_content_wrapper <?php echo esc_attr($tab['_dl_tabs_show_as_default']); ?>">
                    
                    <?php if ( $has_title_text ) : ?>
                        <<?php echo implode( ' ', [ $icon_tag, $link_attributes ] ); ?>>
                            <<?php echo $tab['_dl_tabs_title_size']; ?> <?php echo $this->get_render_attribute_string('_dl_tab_title_attr'); ?>><?php echo dl_kses($tab['_dl_tabs_title_text']); ?></<?php echo $tab['_dl_tabs_title_size']; ?>>
                    </<?php echo $icon_tag; ?>>
                    <?php endif; ?>
                    <?php if ( $has_description_text ) : ?>
                        <div <?php echo $this->get_render_attribute_string('_dl_tab_description_attr'); ?>>
                            <?php echo do_shortcode($tab['_dl_tabs_description_text']); ?>       
                        </div>
                    <?php endif; ?>
                        <?php if ( 'yes' == $tab['_dl_tabs_button_show'] ) : ?> 
                        <<?php echo implode( ' ', [ $icon_tag, $link_attributes ] ); ?> class="dl_cu_btn btn_4 dl_round_50 droit-tab-button">
                            <?php echo dl_kses($tab['_dl_tabs_button_text']); ?>
                        </<?php echo $icon_tag; ?>>
                        <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    <?php }

    protected function content_template(){}
}