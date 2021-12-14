<?php
namespace DROIT_ELEMENTOR\Widgets;

if (!defined('ABSPATH')) {exit;}

class Droit_Addons_Infobox extends \Elementor\Widget_Base {

    // Get Control ID
    protected function get_control_id( $control_id ) {
        return $control_id;
    }

    final public function get_infobox_settings( $control_key ) {
        $control_id = $this->get_control_id( $control_key );
        return $this->get_settings( $control_id );
    }

    public function get_name() {
        return 'droit-infobox';
    }
    
    public function get_title() {
        return esc_html__( 'Info Box', 'droit-addons' );
    }

    public function get_icon() {
        return 'dlicons-inforbox addons-icon';
    }

    public function get_keywords() {
         return [
            'infobox',
            'info',
            'box',
            'droit infobox',
            'droit info',
            'droit box',
            'dl infobox',
            'dl info',
            'dl box',
            'droit',
            'dl',
            'addons',
            'addon'
        ];
    }
    public function get_custom_help_url() {
         return '';
    }
    
    public function get_categories() {
        return ['droit_addons'];
    }

    protected function _register_controls()
    {
       
        $this->register_infobox_image_icon_section_controls();
        $this->register_infobox_content_section_controls();
        $this->_droit_register_dl_infobox_general_style_controls();
        $this->register_infobox_image_style_section_controls();
        $this->register_style_infobox_title_section_controls();
        $this->register_style_infobox_content_section_controls();
        $this->register_style_infobox_button_section_controls();
        $this->register_style_infobox_animation_section_controls();
        $this->register_style_infobox_icon();
        $this->register_style_infobox_image();
        do_action('dl_widget/section/style/custom_css', $this);
    }


    // Image/Icon
    public function register_infobox_image_icon_section_controls()
    {

        $this->start_controls_section(
            '_infobox_image_section',
            [
                'label' => esc_html__('Image/Icon', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
       
        $this->add_control(
            '_free_media_type',
            [
                'label'          => __('Media Type', 'droit-addons'),
                'type'           => \Elementor\Controls_Manager::CHOOSE,
                'label_block'    => false,
                'options'        => [
                    '_free_icon'  => [
                        'title'   => __('Icon', 'droit-addons'),
                        'icon'    => 'far fa-smile-wink',
                    ],

                    '_free_image' => [
                        'title' => __('Image', 'droit-addons'),
                        'icon'  => 'fa fa-image',
                    ],
                ],
                'default'        => '_free_image',
                'toggle'         => false,
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            '_dl_info_box_title_icon',
            [   
                'label'            => esc_html__('Icon', 'droit-addons'),
                'type'             => \Elementor\Controls_Manager::ICONS,
                'fa4compatibility' => '_dl_tabs_tab_title_icon',
                'default'          => [
                    'value'   => 'fas fa-laptop-code',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    '_free_media_type' => '_free_icon'
                    
                ],
                
                
            ]
        );
      
        $this->add_control(
            '_free_info_image',
            [
                'label'     => __('Image', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::MEDIA,
                'default'   => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    '_free_media_type' => ['_free_image'],
                ],
                'dynamic'   => [
                    'active' => true,
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name'      => '_free_info_image',
                'default'   => 'full',
                'separator' => 'none',
                'condition' => [
                    '_free_media_type' => '_free_info_image',
                ],
            ]
        );

        $this->end_controls_section();
    }

    public function register_infobox_image_style_section_controls(){

        $this->start_controls_section(
            'section_style_title',
            [
                'label'     => __('Image/Icon', 'droit-addons'),
                'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    '_free_media_type' => ['_free_image'],
                ],
            ]
        );

        $this->add_responsive_control(
            '_free_infobox_image_width',
            [
                'label'      => __('Width', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
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
                    '{{WRAPPER}} .info_box_icon img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            '_free_infobox_image_height',
            [
                'label'      => __('Height', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
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
                    '{{WRAPPER}} .info_box_icon img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            '_free_info_shape_img_background',
            [
                'label'       => __('Image Background', 'droit-addons'),
                'type'        => \Elementor\Controls_Manager::COLOR,
                'selectors'   => [
                    '{{WRAPPER}} .info_box_icon img' => 'background: {{VALUE}};',
                ],
                'description' => __('Change Image Background Color', 'droit-addons'),

            ]
        );

        $this->add_control(
            '_free_image_background_ofset',
            [
                'label'        => __('Icon Offset', 'droit-addons'),
                'type'         => \Elementor\Controls_Manager::POPOVER_TOGGLE,
                'label_on'     => __('Custom', 'droit-addons'),
                'label_off'    => __('None', 'droit-addons'),
                'return_value' => 'yes',
            ]
        );

        $this->start_popover();

        $this->add_responsive_control(
            'image_bg_offset_y',
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
                    '{{WRAPPER}} .info_box_icon img' => 'transform: translateY({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->end_popover();

        $this->add_responsive_control(
            'image_background_spacing',
            [
                'label'      => __('Background Spacing', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .info_box_icon img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                
            ]
        );

        $this->add_responsive_control(
            'image_background_spacing_border_radius',
            [
                'label'      => __('Border Radius', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .info_box_icon img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                
            ]
        );

        $this->add_control(
            '_free_image_ofset',
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
            'image_offset_x',
            [
                'label'       => __('Offset Left', 'droit-addons'),
                'type'        => \Elementor\Controls_Manager::SLIDER,
                'size_units'  => ['px', '%', 'em', 'rem'],
                'condition'   => [
                    '_free_image_ofset' => 'yes',
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
            'image_offset_y',
            [
                'label'      => __('Offset Top', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'condition'  => [
                    '_free_image_ofset' => 'yes',
                ],
                'range'      => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .dl-infobox-content-area' => 'margin-top: {{SIZE}}{{UNIT}};',
                    '(desktop){{WRAPPER}} .info_box_icon'  => '-ms-transform: translate({{image_offset_x.SIZE || 0}}{{UNIT}}, {{image_offset_y.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{image_offset_x.SIZE || 0}}{{UNIT}}, {{image_offset_y.SIZE || 0}}{{UNIT}}); transform: translate({{image_offset_x.SIZE || 0}}{{UNIT}}, {{image_offset_y.SIZE || 0}}{{UNIT}});',
                    '(tablet){{WRAPPER}} .info_box_icon'   => '-ms-transform: translate({{image_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{image_offset_y_tablet.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{image_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{image_offset_y_tablet.SIZE || 0}}{{UNIT}}); transform: translate({{image_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{image_offset_y_tablet.SIZE || 0}}{{UNIT}});',
                    '(mobile){{WRAPPER}} .info_box_icon'   => '-ms-transform: translate({{image_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{image_offset_y_mobile.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{image_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{image_offset_y_mobile.SIZE || 0}}{{UNIT}}); transform: translate({{image_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{image_offset_y_mobile.SIZE || 0}}{{UNIT}});',
                ],
            ]
        );

        $this->end_popover();

        $this->add_responsive_control(
            'image_spacing',
            [
                'label'      => __('Spacing', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .info_box_icon_wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'after',
            ]
        );
        
        $this->end_controls_section();
    }

    //Content
    public function register_infobox_content_section_controls(){

        $this->start_controls_section(
            '_infobox_content_section',
            [
                'label' => esc_html__('Info Box Content', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'dl_infobox_title',
            [
                'label'       => esc_html__( 'Title', 'droit-addons' ),
                'label_block' => true,
                'type'        => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __( 'Type Info Box Title', 'droit-addons' ),
                'default'     => __( 'Droit info box Title', 'droit-addons' ),
                'dynamic'     => [
                    'active' => false,
                ]
            ]
        );

        $this->add_control(
            '_infobox_title_tag',
            [
                'label' => esc_html__( 'Title Tag', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'toggle' => false,
                'label_block' => false,
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
                ],
                'default' => 'h4',
            ]
        );

        $this->add_control(
            '_infobox_content',
            [
                'label'       => esc_html__( 'Description', 'droit-addons' ),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => __( 'Elements blocks from a range of categories to build pages that are rich in visual style.', 'droit-addons' ),
                'placeholder' => __( 'Type info box description.', 'droit-addons' ),
                'rows'        => 6,
                'dynamic'     => [
                    'active' => false,
                ]
            ]
        );

        $this->add_control(
            '_infobox_btn',
            [
                'label'       => esc_html__( 'Button Text', 'droit-addons' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => __( 'Learn More', 'droit-addons' ),
                'placeholder' => __( 'Type info box button text.', 'droit-addons' ),                
                'dynamic' => [
                    'active' => false,
                ]
            ]
        );

        $this->add_control(
            '_infobox_link',
            [
                'label'   => esc_html__( 'Button Link', 'droit-addons' ),
                'type'    => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => '#'
                ],
                'placeholder' => 'https://example.com',
                'dynamic'     => [
                    'active' => false,
                ]
            ]
        );

        $this->end_controls_section();
    }

    //General
    public function _droit_register_dl_infobox_general_style_controls(){
        $this->start_controls_section(
            '_dl_infobox_style_general',
            [
                'label' => esc_html__('General', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'dl_image_icon_alignment',
            [
                'label'     => __('Image/ Icon Alignment', 'droit-addons'),
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
            ]
        );
        
        $this->add_responsive_control(
            '_free_image_icon_align',
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
                    '{{WRAPPER}} .infobox-container'   => 'text-align: {{VALUE}};',
                ],
            ]
        );
        

        $this->add_control(
            '_infobox_content_bg_color',
            [
                'label'     => __('Background Color', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dl_single_info_box' => 'background-color: {{VALUE}};',
                ],
                'global'    => [
                    'default' => '',
                ],
                
            ]
        );

        $this->add_responsive_control(
            '_infobox_content_padding_new',
            [
                'label'      => __('Padding', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .infobox-container.dl_single_info_box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            '_dl_infobox_margin',
            [
                'label'      => esc_html__('Margin', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .infobox-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'dl_infobox_box_shadow',
				'label' => __( 'Box Shadow', 'plugin-domain' ),
				'selector' => '{{WRAPPER}} .infobox-container.dl_single_info_box',
			]
		);

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => '_infobox_content_border',
                'label' => esc_html__('Border', 'droit-addons'),
                'selector' => '{{WRAPPER}} .infobox-container.dl_single_info_box',
            ]
        );

        $this->add_responsive_control(
            '_infobox_content_border_radius',
            [
                'label'      => __('Border Radius', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .infobox-container.dl_single_info_box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
    
        $this->end_controls_section();
    }
    
    // Title Style
    public function register_style_infobox_title_section_controls(){
        $this->start_controls_section(
            '_infobox_style_title',
            [
                'label' => esc_html__('Title', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            '_infobox_title_color',
            [
                'label'     => __('Color', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dl-infobox-content-area .droit-infobox-title' => 'color: {{VALUE}};',
                ],
                'global'    => [
                    'default' => '',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => '_infobox__typography',
                'label'    => 'Title Typography',
                'selector' => '{{WRAPPER}} .dl-infobox-content-area .droit-infobox-title',
                'global'   => [
                    'default' => '',
                ],
            ]
        );
        $this->add_responsive_control(
            '_infobox_title_padding',
            [
                'label'      => __('Padding', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .dl-infobox-content-area .droit-infobox-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
    
        $this->end_controls_section();
    }
    
    // Content Style
    public function register_style_infobox_content_section_controls(){
        $this->start_controls_section(
            '_infobox_style_content', 
            [
                'label' => esc_html__('Content', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            '_infobox_content_color',
            [
                'label'     => __('Color', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dl-infobox-content-area .droit-infobox-description' => 'color: {{VALUE}};',
                ],
                'global'    => [
                    'default' => '',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => '_infobox_content_typography',
                'label'    => 'Typography',
                'selector' => '{{WRAPPER}} .dl-infobox-content-area .droit-infobox-description',
                'global'   => [
                    'default' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            '_infobox_content_padding',
            [
                'label'      => __('Padding', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .infobox-container.dl_single_info_box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();
        
    }
    // Button
    public function register_style_infobox_button_section_controls()
    {

        $this->start_controls_section(
            '_infobox_section_style_button',
            [
                'label'       => __('Button', 'droit-addons'),
                'tab'         => \Elementor\Controls_Manager::TAB_STYLE,
                
            ]
        );

        $this->start_controls_tabs( '_infobox_tabs_button_style' );

        $this->start_controls_tab(
                '_button_normal_tab',
                [
                    'label' => esc_html__( 'Normal', 'droit-addons' ),
                ]
        );

        $this->add_control(
            '_infobox_button_bg_color',
            [
                'label'     => __('Background Color', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dl-infobox-content-area .droit-infobox-button' => 'background-color: {{VALUE}};',
                ],
                'global'    => [
                    'default' => '',
                ],
                
            ]
        );

        $this->add_control(
            '_infobox_button_color',
            [
                'label'     => __('Color', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dl-infobox-content-area .droit-infobox-button' => 'color: {{VALUE}};',
                ],
                'global'    => [
                    'default' => '',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => '_infobox_button_typography',
                'label'    => 'Typography',
                'selector' => '{{WRAPPER}} .dl-infobox-content-area .droit-infobox-button',
                'global'   => [
                    'default' => '',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => '_infobox_button_border_',
                'label' => esc_html__('Border', 'droit-addons'),
                'selector' => '{{WRAPPER}} .dl-infobox-content-area .droit-infobox-button',
            ]
        );

        $this->add_responsive_control(
            '_infobox_button_border_radius',
            [
                'label'      => __('Border Radius', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .dl-infobox-content-area .droit-infobox-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            '_infobox_button_padding',
            [
                'label'      => __('Padding', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .dl-infobox-content-area .droit-infobox-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

    
        $this->end_controls_tab();

        $this->start_controls_tab(
                    '_button_hover_tab',
                    [
                        'label' => esc_html__( 'Hover', 'droit-addons' ),
                    ]
        );

        $this->add_control(
            '_infobox_button_hover_color',
            [
                'label'     => __('Text Color', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .infobox-container:hover .droit-infobox-button:hover' => 'color: {{VALUE}};',
                ],
                'global'    => [
                    'default' => '',
                ],
            ]
        );

        $this->add_control(
            '_infobox_button_hover_bg_color',
            [
                'label'     => __('Background Color', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .infobox-container .droit-infobox-button:hover' => 'background-color: {{VALUE}};',
                ],
                'global'    => [
                    'default' => '',
                ],
            ]
        );

        $this->add_control(
            '_infobox_button_hover_border_color',
            [
                'label'     => __('Border Color', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .infobox-container .droit-infobox-button:hover' => 'border: 1px solid {{VALUE}};',
                ],
                'global'    => [
                    'default' => '',
                ],
            ]
        );

        $this->add_control(
            '_infobox_button_opacity_hover',
            [
                'label'     => __('Opacity', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max'  => 1,
                        'min'  => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .infobox-container:hover .droit-infobox-button:hover' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    public function register_style_infobox_animation_section_controls()
    {
        $this->start_controls_section(
            '_infobox_style_animation',
            [
                'label' => esc_html__('Animation', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            '_infobox_animation',
            [
                'label' => esc_html__( 'Title Animation', 'droit-addons' ),
                'type'  => \Elementor\Controls_Manager::ANIMATION,
                
            ]
        );

        $this->end_controls_section();
    }

    public function register_style_infobox_icon() {
        $this->start_controls_section(
            '_infobox_icon_style',
            [
                'label' => esc_html__('Icon', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    $this->get_control_id('_free_media_type') =>  [ '_free_icon' ],
                ], 
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'dl_icon_background',
				'label' => __( 'Background', 'droit-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .infobox-container.dl_single_info_box i',
			]
		);

        $this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .infobox-container.dl_single_info_box i' => 'color: {{VALUE}}',
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
            'dl_infobox_offset_y',
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
                    '{{WRAPPER}} .infobox-container.dl_single_info_box i' => 'transform: translateY({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->end_popover();

        $this->add_responsive_control(
            'dl_icon_background_padding',
            [
                'label'      => __('Icon Padding', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .infobox-container.dl_single_info_box i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                
            ]
        );

        $this->add_responsive_control(
            'dl_info_box_icon_background_spacing',
            [
                'label'      => __('Icon Margin', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .infobox-container.dl_single_info_box i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                
            ]
        );

        $this->add_responsive_control(
            'dl_icon_background_spacing',
            [
                'label'      => __('Border Radius', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .infobox-container.dl_single_info_box i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                
            ]
        );

        $this->end_controls_section(); 
    } 

    public function register_style_infobox_image() {
        $this->start_controls_section(
            'dl_infobox_icon_style',
            [
                'label' => esc_html__('Image', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    $this->get_control_id('_free_media_type') =>  [ '_free_image' ],
                ], 
            ]
        );

        $this->add_responsive_control(
            'dl_image_background_spacing',
            [
                'label'      => __('Image Spacing', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .info_box_icon img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                
            ]
        );
        

        $this->end_controls_section();
    } 

    protected function _free_infobox_header_link() {
        $settings = $this->get_settings_for_display();

        if (!$this->get_infobox_settings('_infobox_link')['url']) {
            return;
        }
        printf('<a %1$s>', dl_generate_link($this->get_infobox_settings('_infobox_link'), false));
    }

    protected function _free_infobox_footer_link() {
        $settings = $this->get_settings_for_display();

        if (!$this->get_infobox_settings('_infobox_link')['url']) {
            return;
        }
        printf('</a>');
    }

    //Image/Icon
    protected function _free_infobox_image_icon()
    {
        $settings       = $this->get_settings_for_display();
        $_infobox_skin  = !empty($this->get_infobox_settings('_infobox_skin')) ? $this->get_infobox_settings('_infobox_skin') : '_skin_1';
        $_shape_class   =  $_infobox_skin == ' _skin_1 ' ? ' shape_1 ' : '';
        $_bg_color_2    =  '';

        ?>
        <?php if ($this->get_infobox_settings('_free_media_type') === '_free_image' && ($this->get_infobox_settings('_free_info_image')['url'] || $this->get_infobox_settings('_free_info_image')['id'])): ?>
            <div class="info_box_icon_wrap">
                    <div class="info_box_icon <?php echo $_shape_class . $_bg_color_2; ?>">
                    <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html($settings, 'full', '_free_info_image'); ?>
                    
               </div>
           </div>
       <?php endif;?>

   <?php }

    protected function render() {
        $settings               = $this->get_settings_for_display();
        extract($settings);
        $_container_class       = '';
        $_free_image_icon_align = $this->get_infobox_settings('_free_image_icon_align');

        switch ($_free_image_icon_align) {
            case 'left':
                $_container_class = 'container-left';
            break;

            case 'center':
                $_container_class = 'container-center';
            break;

            case 'right':
                $_container_class = 'container-right';
            break;
        }
        ?>
        <div class="infobox-container dl_single_info_box <?php if($dl_image_icon_alignment =='left'){ echo 'align-property-left '; }if($dl_image_icon_alignment =='right'){ echo 'align-property-right '; } ?><?php if($this->get_infobox_settings('_free_media_type') === '_free_image'){echo 'style_2';}?><?php echo esc_attr($_container_class); ?>">
            <?php
                if($this->get_infobox_settings('_free_media_type') === '_free_image'){
                    $this->_free_infobox_image_icon();
                }
                if($this->get_infobox_settings('_free_media_type') === '_free_icon'){

                    \Elementor\Icons_Manager::render_icon( $settings['_dl_info_box_title_icon'], [ 'aria-hidden' => 'true' ] );
                }
            ?>
            <div class="dl-infobox-content-area">
                <?php 
                    $this-> _free_infobox_title();
                    $this-> _free_infobox_content();
                    $this-> _free_infobox_btn();
                ?>
            </div>
        </div>
    <?php
    }

    //title
    protected function _free_infobox_title() {
        $settings = $this->get_settings_for_display();
        extract($settings);
        
        $_infobox_title_tag = $this->get_infobox_settings('_infobox_title_tag')
        ?>

        <<?php echo esc_attr($_infobox_title_tag); ?> class="dl_title droit-infobox-title <?php echo $this->get_infobox_settings('_infobox_animation'); ?>"> <?php echo esc_html($dl_infobox_title); ?></<?php echo esc_attr($_infobox_title_tag); ?>>
    
        <?php
    }

    //Content
    protected function _free_infobox_content() {
        $settings = $this->get_settings_for_display();
        if (!$this->get_infobox_settings('_infobox_content')) {
            return;
        }
        ?>
        <p class="dl_description droit-infobox-description"> <?php echo wp_kses_post(nl2br($this->get_infobox_settings('_infobox_content'))); ?></p>
    <?php }

    //btn
    protected function _free_infobox_btn() {
        $settings       = $this->get_settings_for_display();
        $_btn_class     =  'dl_cu_btn btn_2';
        $_btn_icon      =  '';

        if (!$this->get_infobox_settings('_infobox_btn')) {
            return;
        }

        printf('<a %1$s class="%3$s droit-infobox-button"> %2$s  %4$s  </a>', dl_generate_link($this->get_infobox_settings('_infobox_link'), false), $this->get_infobox_settings('_infobox_btn'), $_btn_class, $_btn_icon);
        ?>
    
    <?php }

    protected function content_template(){}
}