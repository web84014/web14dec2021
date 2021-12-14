<?php
namespace DROIT_ELEMENTOR\Widgets;

if (!defined('ABSPATH')) {exit;}

class Droit_Addons_Ninjaform extends \Elementor\Widget_Base {

    public function get_name() {
        return 'droit-ninja_form';
    }
    
    public function get_title() {
        return esc_html__( 'Ninja Form', 'droit-addons' );
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
            'ninjaform', 
            'form', 
            'dl', 
            'droit' 
        ];
    }
    
    public function get_categories() {
        return ['droit_addons'];
    }
    
    protected function _register_controls() {
        $this->register_ninjaform_general_control();
        $this->register_ninjaform_style_control();
        do_action('dl_widget/section/style/custom_css', $this);
    }

    public function register_ninjaform_general_control() {
        $this->start_controls_section(
            '_dl_ninja_form_layout_section',
            [
                'label' => esc_html__('Ninja Forms', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        if ( ! \DROIT_ELEMENTOR\DL_Helper::ninja_form_activated() ) {
        	$this->register_ninja_form_notice();
        }else{
			$this->register_ninja_form_selector();
        }
    	
        $this->end_controls_section();
        
    } 

    public function register_ninjaform_style_control() {   
        $this->register_form_fields_style();
        $this->register_form_labels_style();
        $this->register_form_button_style();
    } 

    public function register_form_fields_style() {
        $this->start_controls_section(
            '_dl_ninja_forms_field_styles',
            [
                'label' => esc_html__( 'Form Fields', 'droit-addons' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
			'_dl_ninja_forms_field_margin',
			[
				'label'      => __( 'Spacing', 'droit-addons' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .nf-field-container:not(.submit-container)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
			'_dl_ninja_forms_field_padding',
			[
				'label'      => __( 'Padding', 'droit-addons' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .textbox-wrap input[type=text], {{WRAPPER}} .email-wrap input, {{WRAPPER}} .textarea-wrap textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
            'dl_ninja_forms_border_radius',
            [
                'label'      => __( 'Border Radius', 'droit-addons' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .textbox-wrap input[type=text], {{WRAPPER}} .email-wrap input, {{WRAPPER}} .textarea-wrap textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'dl_ninja_form_typography',
                'label'    => __( 'Typography', 'droit-addons' ),
                'selector' => '{{WRAPPER}} .textbox-wrap input[type=text], {{WRAPPER}} .email-wrap input, {{WRAPPER}} .textarea-wrap textarea',
            ]
        );
        
        $this->add_control(
            'dl_ninja_form_field_textcolor',
            [
                'label'     => __( 'Text Color', 'droit-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .textbox-wrap input[type=text], {{WRAPPER}} .email-wrap input, {{WRAPPER}} .textarea-wrap textarea' => 'color: {{VALUE}}',
                ],
            ]
		);

        $this->add_control(
            'dl_ninja_form_field_placeholder_color',
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

        $this->start_controls_tabs( 'ninja_form_tabs' );

        $this->start_controls_tab(
            'ninja_form_tab_normal',
            [
                'label' => __( 'Normal', 'droit-addons' ),
            ]
		);

		$this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'ninja_form_field_border',
                'selector' => '{{WRAPPER}} .textbox-wrap input[type=text], {{WRAPPER}} .email-wrap input, {{WRAPPER}} .textarea-wrap textarea',
            ]
		);

		$this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ninja_form_field_box_shadow',
                'selector' => '{{WRAPPER}} .textbox-wrap input[type=text], {{WRAPPER}} .email-wrap input, {{WRAPPER}} .textarea-wrap textarea',
            ]
        );

        $this->add_control(
            'ninja_form_field_bg_color',
            [
                'label' => __( 'Background Color', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .textbox-wrap input[type=text], {{WRAPPER}} .email-wrap input, {{WRAPPER}} .textarea-wrap textarea' => 'background-color: {{VALUE}}',
                ],
            ]
        );

		$this->end_controls_tab();

		$this->start_controls_tab(
            'ninja_form_tab_field_focus',
            [
                'label' => __( 'Focus', 'droit-addons' ),
            ]
		);

		$this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'ninja_form_field_focus_border',
                'selector' => '{{WRAPPER}} .textbox-wrap input[type=text]:focus, {{WRAPPER}} .email-wrap input:focus, {{WRAPPER}} .textarea-wrap textarea:focus',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ninja_form_field_focus_box_shadow',
                'exclude' => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .textbox-wrap input[type=text]:focus, {{WRAPPER}} .email-wrap input:focus, {{WRAPPER}} .textarea-wrap textarea:focus',
            ]
		);

		$this->add_control(
            'ninja_form_field_focus_bg_color',
            [
                'label' => __( 'Background Color', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .textbox-wrap input[type=text]:focus, {{WRAPPER}} .email-wrap input:focus, {{WRAPPER}} .textarea-wrap textarea:focus' => 'background-color: {{VALUE}}',
                ],
            ]
        );

		$this->end_controls_tab();
		$this->end_controls_tabs();

        $this->end_controls_section();
    } 

    public function register_form_labels_style() {
        $this->start_controls_section(
            '_dl_ninja_forms_label_styles',
            [
                'label' => esc_html__( 'Form Labels', 'droit-addons' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            '_dl_ninja_forms_label_margin',
            [
                'label' => __( 'Margin', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .textbox-wrap label, {{WRAPPER}} .email-wrap label, {{WRAPPER}} .textarea-wrap label' => 'display: inline-block; padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            '_dl_ninja_forms_label_padding',
            [
                'label' => __( 'Padding', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .textbox-wrap label, {{WRAPPER}} .email-wrap label, {{WRAPPER}} .textarea-wrap label' => 'display: inline-block; padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => '_dl_ninja_forms_label_typography',
                'label' => __( 'Typography', 'droit-addons' ),
                'selector' => '{{WRAPPER}} .textbox-wrap label, {{WRAPPER}} .email-wrap label, {{WRAPPER}} .textarea-wrap label',
            ]
        );

		$this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => '_dl_ninja_forms_desc_typography',
                'label' => __( 'Description Typography', 'droit-addons' ),
                'selector' => '{{WRAPPER}} .nf-field-description p',
            ]
        );

        $this->add_control(
            '_dl_ninja_forms_label_color',
            [
                'label'     => __( 'Text Color', 'droit-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .textbox-wrap label, {{WRAPPER}} .email-wrap label, {{WRAPPER}} .textarea-wrap label' => 'color: {{VALUE}}',
                ],
            ]
		);

		$this->add_control(
            '_dl_ninja_forms_requered_label',
            [
                'label'     => __( 'Label Color', 'droit-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ninja-forms-req-symbol' => 'color: {{VALUE}}',
                ],
            ]
        );

		$this->add_control(
            '_dl_ninja_forms_desc_color',
            [
                'label'     => __( 'Description Text Color', 'droit-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .nf-field-description p' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->end_controls_section();
    } 

    public function register_form_button_style() {
        $this->start_controls_section(
            '_dl_ninja_forms_button_styles',
            [
                'label' => esc_html__( 'Button', 'droit-addons' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            '_dl_ninja_forms_submit_btn_position',
            [
                'label' => __( 'Button Position', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
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
                'toggle' => false, 
				'selectors' => [
                    '{{WRAPPER}} .field-wrap.submit-wrap' => 'text-align: {{Value}};',
                ],
            ]
        );

        $this->add_responsive_control(
            '_dl_ninja_forms_submit_margin',
            [
                'label' => __( 'Margin', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .submit-container input' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            '_dl_ninja_forms_submit_padding',
            [
                'label' => __( 'Padding', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .submit-container input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => '_dl_ninja_forms_submit_typography',
                'selector' => '{{WRAPPER}} .submit-container input',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => '_dl_ninja_forms_submit_border',
                'selector' => '{{WRAPPER}} .submit-container input',
            ]
        );

        $this->add_control(
            '_dl_ninja_forms_submit_border_radius',
            [
                'label' => __( 'Border Radius', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .submit-container input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => '_dl_ninja_forms_submit_box_shadow',
                'selector' => '{{WRAPPER}} .submit-container input',
                'separator' => 'after'
            ]
        );

        $this->start_controls_tabs( '_dl_ninja_forms_tabs_button_style' );

        $this->start_controls_tab(
            '_dl_ninja_forms_tab_button_normal',
            [
                'label' => __( 'Normal', 'droit-addons' ),
            ]
        );

        $this->add_control(
            '_dl_ninja_forms_submit_color',
            [
                'label' => __( 'Text Color', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .submit-container input' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            '_dl_ninja_forms_submit_bg_color',
            [
                'label' => __( 'Background Color', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .submit-container input' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_button_hover',
            [
                'label' => __( 'Hover', 'droit-addons' ),
            ]
        );

        $this->add_control(
            '_dl_ninja_forms_submit_hover_color',
            [
                'label' => __( 'Text Color', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .submit-container input:hover, {{WRAPPER}} .submit-container input:focus' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            '_dl_ninja_forms_submit_hover_bg_color',
            [
                'label'     => __( 'Background Color', 'droit-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .submit-container input:hover, {{WRAPPER}} .submit-container input:focus' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            '_dl_ninja_forms_submit_hover_border_color',
            [
                'label'     => __( 'Border Color', 'droit-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .submit-container input:hover, {{WRAPPER}} .submit-container input:focus' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        
        $this->end_controls_section();
    } 



    protected function register_ninja_form_notice(){
          
        $ninja_form = 'ninja-forms/ninja-forms.php';
        $droit_plugins_name = 'Droit Elementor Addons for Elementor';

        if ($this->is_ninja_form_installed_or_not($ninja_form)) {

            $activation_url = wp_nonce_url('plugins.php?action=activate&amp;plugin=' . $ninja_form . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $ninja_form);

            $message = __('To activate and run <strong>'.$droit_plugins_name.'</strong> please activate Ninja Form. You can activate ninja form from here', 'droit-addons');
            
            $_button_text = __('Activate Ninja Form', 'droit-addons');
        } else {
            $activation_url = wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin=ninja-forms'), 'install-plugin_ninja_forms');

            $message = sprintf(__('To activate and run <strong>'.$droit_plugins_name.'</strong> please install and activate Ninja Forms. You can install and activate Ninja Forms from here', 'droit-addons'), '<strong>', '</strong>');
            $_button_text = __('Install Ninja Form', 'droit-addons');
        }

        $_button = '<p><a href="' . $activation_url . '" class="button-primary" target="_blank">' . $_button_text . '</a></p>';
        
        $this->add_control(
            'ninja_form_missing_notice',
            [
                'type' => \Elementor\Controls_Manager::RAW_HTML,
                    'raw' => sprintf(__( '%1$s, %2$s', 'droit-addons' ), $message, $_button
                ),
                    'content_classes' => 'elementor-panel-alert elementor-panel-alert-danger',
            ]
        );
        return;
	}

    //Form Selector
	protected function register_ninja_form_selector(){
        $this->add_control(
           '_dl_ninja_form_id',
           [
               'label'       => __( 'Select Your Form', 'droit-addons' ),
               'type'        => \Elementor\Controls_Manager::SELECT,
               'label_block' => true,
               'options'     => \DROIT_ELEMENTOR\DL_Helper::ninja_form_list(),
               'default'     => ''
           ]
       ); 
    }

    /**
     * Check if a plugin is installed or Not
     * @access public
     * @since 1.0.0
     * Feature added by : DroitLab Team
     */
    protected function is_ninja_form_installed_or_not($basename) {
        if (!function_exists('get_plugins')) {
            include_once ABSPATH . '/wp-admin/includes/plugin.php';
        }

        $installed_plugins = get_plugins();

        return isset($installed_plugins[$basename]);
    }

    //Html render
    protected function render(){
        if ( ! \DROIT_ELEMENTOR\DL_Helper::ninja_form_activated()  ) {
            return;
        }
        
        $settings = $this->get_settings_for_display();
        extract($settings);
    
        ?>
        <div>
            <?php echo do_shortcode( '[ninja_form id="'. esc_html($_dl_ninja_form_id) .'"]' ); ?>
        </div>
      <?php
    }
        
    protected function content_template(){}

}