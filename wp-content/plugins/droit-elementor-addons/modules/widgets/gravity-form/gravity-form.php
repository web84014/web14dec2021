<?php
namespace DROIT_ELEMENTOR\Widgets;

if (!defined('ABSPATH')) {exit;}

class Droit_Addons_Gravity_Form extends \Elementor\Widget_Base {
    public function get_name() {
        return 'droit-gravity_form';
    }
    
    public function get_title() {
        return esc_html__( 'Gravity Form', 'droit-addons' );
    }

    public function get_icon() {
        return 'dlicons-contact-form addons-icon';
    }

    public function get_keywords() {
        return [ 
            'contact form', 
            'dl contact form', 
            'droit contact form', 
            'form styler', 
            'elementor form', 
            'feedback', 
            'caldera_form', 
            'form', 
            'dl', 
            'droit' 
        ];
    }
    
    public function get_categories() {
        return ['droit_addons'];
    }
    
    protected function _register_controls() {
        $this->register_gravity_form_general_control();
        $this->register_gravity_form_style_control();
        do_action('dl_widget/section/style/custom_css', $this);
    }

    public function register_gravity_form_general_control() {
        $this->start_controls_section(
            '_dl_gravity_form_layout_section',
            [
                'label' => esc_html__('Gravity Form', 'droit-addons-pro'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        if ( ! \DROIT_ELEMENTOR\DL_Helper::gravity_form_activated() ) {
        	$this->register_gravity_form_notice();
        }
        else{
			$this->register_gravity_form_selector();
        }
    	
        $this->end_controls_section();
    } 

    public function register_gravity_form_style_control() {

        $this-> _dl_form_fields_style_controls();
        $this-> _dl_form_labels_style_controls();
        $this-> _dl_form_button_controls();

    } 

    public function _dl_form_fields_style_controls() {
        $this->start_controls_section(
            '_dl_gravity_form_layout_style',
            [
                'label' => esc_html__('Form Fields', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
			'dl_large_field_width',
			[
				'label' => __( 'Field Width', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 800,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .gform_body .gfield input.large' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .gform_body .gfield  textarea.large' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
			'dl_field_margin_spacing',
			[
				'label'      => __( 'Field Spacing', 'droit-addons' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .gform_body .gform_fields .gfield' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
			'dl_gravityform_field_padding',
			[
				'label'      => __( 'Padding', 'droit-addons' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .gform_body .gfield .ginput_container:not(.ginput_container_fileupload) > input:not(.ginput_quantity)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .gform_body .gfield .ginput_container.ginput_complex input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .gform_body .gfield .ginput_container.ginput_complex input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file])' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .gform_body .gfield textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
			'dl_gravity_form_field_border_radius',
			[
				'label'      => __( 'Border Radius', 'droit-addons' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .gfield .ginput_container:not(.ginput_container_fileupload) > input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .gfield .ginput_container.ginput_complex input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .gform_body .gfield textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'dl_elementor_field_typography',
				'label'    => __( 'Typography', 'droit-addons' ),
				'selector' => '{{WRAPPER}} .gfield .ginput_container > input, {{WRAPPER}} .gform_body .gfield textarea, {{WRAPPER}} .gfield .ginput_container.ginput_complex input',
			]
		);

        $this->add_control(
			'dl_gravity_form_textcolor',
			[
				'label' => __( 'Text Color', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gfield .ginput_container > input' => 'color: {{VALUE}};',
					'{{WRAPPER}} .gfield .ginput_container.ginput_complex input' => 'color: {{VALUE}};',
					'{{WRAPPER}} .gform_body .gfield textarea' => 'color: {{VALUE}};',
					'{{WRAPPER}} .gform_body .gfield select' => 'color: {{VALUE}};',
					'{{WRAPPER}} .gfield_list tbody td input' => 'color: {{VALUE}};',
					'{{WRAPPER}} .ginput_container_address input' => 'color: {{VALUE}};',
				],
			]
		);

        $this->add_control(
			'dl_gravity_form_placeholder_color',
			[
				'label'     => __( 'Placeholder Color', 'droit-addons' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} ::-webkit-input-placeholder'	=> 'color: {{VALUE}};',
					'{{WRAPPER}} ::-moz-placeholder'			=> 'color: {{VALUE}};',
					'{{WRAPPER}} ::-ms-input-placeholder'		=> 'color: {{VALUE}};',
				],
			]
		);

        $this->start_controls_tabs( 'dl_gravity_form_tabs' );
        $this->start_controls_tab(
			'dl_tab_field_normal',
			[
				'label' => __( 'Normal', 'droit-addons' ),
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'dl_gr_form_border',
				'selector' => '{{WRAPPER}} .gfield .ginput_container:not(.ginput_container_fileupload) > input,
				{{WRAPPER}} .gfield .ginput_complex input,
				{{WRAPPER}} .gfield .ginput_container_address input,
				{{WRAPPER}} .gfield_list_cell input,
				{{WRAPPER}} .gfield .ginput_container select,
				{{WRAPPER}} .gform_body .gfield textarea',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'dl_gform_box_shadow',
				'selector' => '{{WRAPPER}} .gfield .ginput_container:not(.ginput_container_fileupload) > input,
				{{WRAPPER}} .gfield .ginput_complex input,
				{{WRAPPER}} .gfield .ginput_container_address input,
				{{WRAPPER}} .gform_body .gfield textarea',
			]
		);

		$this->add_control(
			'dl_gr_form_bg_color',
			[
				'label' => __( 'Background Color', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gfield .ginput_container:not(.ginput_container_fileupload) > input' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .gfield .ginput_complex input' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .gfield .ginput_container_address input' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .gfield .ginput_container_list input' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .gform_body .gfield textarea' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .gform_body .gfield select' => 'background-color: {{VALUE}}',
				],
			]
		);

        $this->end_controls_tab();

		$this->start_controls_tab(
			'dl_tab_field_focus',
			[
				'label' => __( 'Focus', 'droit-addons' ),
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'dl_gform_focus_border',
				'selector' => '{{WRAPPER}} .gfield .ginput_container > input:focus,
				{{WRAPPER}} .gfield .ginput_complex input:focus,
				{{WRAPPER}} .gfield .ginput_container_address input:focus,
				{{WRAPPER}} .gfield_list_cell input:focus,
				{{WRAPPER}} .gform_body .gfield textarea:focus'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'dl_gform_focus_box_shadow',
				'selector' => '{{WRAPPER}} .gfield .ginput_container > input:focus,
				{{WRAPPER}} .gfield .ginput_complex input:focus,
				{{WRAPPER}} .gfield .ginput_container_address input:focus,
				{{WRAPPER}} .gform_body .gfield textarea:focus',
			]
		);

		$this->add_control(
			'dl_gform_focus_bg_color',
			[
				'label' => __( 'Background Color', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gfield .ginput_container > input:focus' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .gfield .ginput_complex input:focus' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .gform_body .gfield textarea:focus' => 'background-color: {{VALUE}}',
				],
			]
		);

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
    } 
    
    public function _dl_form_labels_style_controls() {
        $this->start_controls_section(
            '_dl_gravity_form_labels_style',
            [
                'label' => esc_html__('Form Labels', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
			'dl_gravity_form_label',
			[
				'label'      => __( 'Margin', 'droit-addons' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .gform_body .gfield .gfield_label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
			'dl_gravity_label_padding',
			[
				'label'      => __( 'Padding', 'droit-addons' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .gform_body .gfield .gfield_label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} table.gfield_list thead th' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
			'dl_gravity_sub_label_margin',
			[
				'label' => __( 'Sub Label Margin', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'separator' => 'after',
				'selectors' => [
					'{{WRAPPER}} .gform_body .gfield .gfield_description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'dl_gform_label_typography',
				'label'    => __( 'Typography', 'droit-addons' ),
				'selector' => '{{WRAPPER}} .gform_body .gfield .gfield_label, {{WRAPPER}} table.gfield_list thead th',
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'dl_gform_sub_label_typography',
				'label'    => __( 'Sub Label Typography', 'droit-addons' ),
				'selector' => '{{WRAPPER}} .gform_body .gfield .gfield_description',
			]
		);

        $this->add_control(
			'dl_gform_label_color',
			[
				'label' => __( 'Label Text Color', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gform_body .gfield .gfield_label' => 'color: {{VALUE}}',
					'{{WRAPPER}} .gform_body .gfield .ginput_complex label' => 'color: {{VALUE}}',
					'{{WRAPPER}} table.gfield_list thead th' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'dl_gform_sub_label_color',
			[
				'label' => __( 'Sub Label Text Color', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gform_body .gfield .gfield_description' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'dl_gform_requered_label',
			[
				'label' => __( 'Required Label Color', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gform_body .gfield .gfield_label .gfield_required' => 'color: {{VALUE}}',
				],
			]
		);

        $this->end_controls_section();
    } 

    public function _dl_form_button_controls() {
        $this->start_controls_section(
            '_dl_gravity_form_button_style',
            [
                'label' => esc_html__('Button', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
			'dl_gform_submit_btn',
			[
				'label'        => __( 'Button Full Width?', 'droit-addons' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'droit-addons' ),
				'label_off'    => __( 'No', 'droit-addons' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

        $this->add_responsive_control(
			'dl_gform_button_width',
			[
				'label' => __( 'Button Width', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'condition' => [
					'dl_gform_submit_btn' => 'yes'
				],
				'default' => [
					'unit' => '%',
					'size' => 100
				],

				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 800,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .gform_wrapper .gform_button' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
			'dl_gform_submit_btn_position',
			[
				'label' => __( 'Button Position', 'droit-addons' ),
				'type'  => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'droit-addons' ),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'droit-addons' ),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'droit-addons' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'condition' => [
					'dl_gform_submit_btn' => ''
				],
				'default' => 'left',
				'selectors' => [
					'{{WRAPPER}} .gform_wrapper .gform_footer' => 'text-align: {{Value}};',
				],
			]
		);

        $this->add_responsive_control(
			'dl_gform_submit_padding',
			[
				'label' => __( 'Padding', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .gform_wrapper .gform_button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
			'dl_gform_submit_margin',
			[
				'label' => __( 'Margin', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .gform_wrapper .gform_footer' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'dl_gform_submit_typography',
				'selector' => '{{WRAPPER}} .gform_wrapper .gform_button',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'dl_gform_submit_border',
				'selector' => '{{WRAPPER}} .gform_wrapper .gform_button',
			]
		);

        $this->add_control(
			'dl_gform_submit_border_radius',
			[
				'label'      => __( 'Border Radius', 'droit-addons' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .gform_wrapper .gform_button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'dl_gform_submit_box_shadow',
				'selector'  => '{{WRAPPER}} .gform_wrapper .gform_button',
				'separator' => 'after'
			]
		);

        $this->start_controls_tabs( 'dl_gform_tabs_button_style' );

		$this->start_controls_tab(
			'dl_gform_tab_button_normal',
			[
				'label' => __( 'Normal', 'droit-addons' ),
			]
		);
        
		$this->add_control(
			'dl_gform_submit_bg_color',
			[
				'label'     => __( 'Background Color', 'droit-addons' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gform_wrapper .gform_button' => 'background-color: {{VALUE}};',
				],
			]
		);

        $this->add_control(
			'dl_gform_submit_color',
			[
				'label'     => __( 'Text Color', 'droit-addons' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .gform_wrapper .gform_button' => 'color: {{VALUE}};',
				],
			]
		);

        $this->end_controls_tab();

        $this->start_controls_tab(
			'dl_gform_tab_button_hover',
			[
				'label' => __( 'Hover', 'droit-addons' ),
			]
		);

        $this->add_control(
			'dl_gform_submit_hover_color',
			[
				'label' => __( 'Text Color', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gform_wrapper .gform_button:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .gform_wrapper .gform_button:focus' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'dl_gform_submit_hover_bg_color',
			[
				'label'     => __( 'Background Color', 'droit-addons' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gform_wrapper .gform_button:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .gform_wrapper .gform_button:focus' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'dl_gform_submit_hover_border_color',
			[
				'label'     => __( 'Border Color', 'droit-addons' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gform_wrapper .gform_button:hover' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .gform_wrapper .gform_button:focus' => 'border-color: {{VALUE}};',
				],
			]
		);
		
        $this->end_controls_tab();
		$this->end_controls_tabs();
        $this->end_controls_section();
    } 

    //Html render
    protected function render(){
        if ( ! \DROIT_ELEMENTOR\DL_Helper::gravity_form_activated()  ) {
            return;
        }
        
        $settings = $this->get_settings_for_display();
        extract($settings);
    
        $ajax = false;
        if( 'yes' === $dl_ajax_submit ) {
            $ajax = true;
        }

        if ( ! empty( $_dl_gravity_form_id ) ) {
            gravity_form( $_dl_gravity_form_id, $dl_gravity_form_title, true, false, null, $ajax );
        }
    }

    public function register_gravity_form_notice() {
        
        $this->add_control(
            'gravity_form_missing_notice',
            [
                'type' => \Elementor\Controls_Manager::RAW_HTML,
                    'raw' => sprintf(__( "It looks gravity form isn't installed in your site. Please install and activate gravity form in your site. ", 'droit-addons-pro' )
                ),
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-danger',
            ]
        );
        
        return;
    } 

    public function register_gravity_form_selector() {
        $this->add_control(
            '_dl_gravity_form_id',
            [
                'label'       => __( 'Select Your Form', 'droit-addons-pro' ),
                'type'        => \Elementor\Controls_Manager::SELECT,
                'label_block' => true,
                'options'     => \DROIT_ELEMENTOR\DL_Helper::gravity_form_list(),
                'default'     => ''
            ]
        );

        $this->add_control(
            'dl_gravity_form_title',
            [
                'label'        => __( 'Form Title', 'droit-addons-pro' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'separator'    => 'before',
                'label_on'     => __( 'Show', 'droit-addons-pro' ),
                'label_off'    => __( 'Hide', 'droit-addons-pro' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'dl_ajax_submit',
            [
                'label'        => __( 'Enable Ajax Submit', 'droit-addons-pro' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'droit-addons-pro' ),
                'label_off'    => __( 'No', 'droit-addons-pro' ),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );
        
    } 

    protected function content_template(){}

}
 