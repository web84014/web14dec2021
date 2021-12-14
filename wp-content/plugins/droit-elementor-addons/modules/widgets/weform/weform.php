<?php
namespace DROIT_ELEMENTOR\Widgets;

if (!defined('ABSPATH')) {exit;}

class Droit_Addons_Weform extends \Elementor\Widget_Base {
    public function get_name() {
        return 'droit-weform';
    }
    
    public function get_title() {
        return esc_html__( 'weForm', 'droit-addons' );
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
            'weform', 
            'form', 
            'dl', 
            'droit' 
        ];
    }
    
    public function get_categories() {
        return ['droit_addons'];
    }
    
    protected function _register_controls() {
        $this->register_weform_general_control();
        $this->register_weform_style_control();
        do_action('dl_widget/section/style/custom_css', $this);
    }

    public function register_weform_general_control() {
        $this->start_controls_section(
            '_dl_we_form_layout_section',
            [
                'label' => esc_html__('weForms', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        if ( ! \DROIT_ELEMENTOR\DL_Helper::weform_activated() ) {
        	$this->register_weform_notice();
        }
        else{
			$this->register_weform_selector();
        }
    	
        $this->end_controls_section();
    }
    
    public function register_weform_style_control() {
        $this->register_weform_fields_style();
        $this->register_weform_labels_style();
        $this->register_weform_button_style();
    } 

    public function register_weform_fields_style() {
        $this->start_controls_section(
            '_dl_weforms_form_field_styles',
            [
                'label' => esc_html__( 'Form Fields', 'droit-addons' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            '_dl_weforms_field_width',
            [
                'label' => __( 'Field Width', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'default' => [
                    'unit' => '%',
                    'size' => 99
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
                    '{{WRAPPER}} .wpuf-form > li.wpuf-el.field-size-large > .wpuf-fields input:not([type=radio]):not([type=checkbox])' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .wpuf-form > li.wpuf-el.field-size-large > .wpuf-fields textarea' => 'width: {{SIZE}}{{UNIT}};',

                ],
            ]
        );

        $this->add_responsive_control(
            '_dl_weforms_field_margin',
            [
                'label' => __( 'Spacing', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wpuf-el:not(.wpuf-submit)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            '_dl_weforms_field_padding',
            [
                'label' => __( 'Padding', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wpuf-fields input:not(.weforms_submit_btn)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-fields textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            '_dl_weforms_border_radius_field',
            [
                'label' => __( 'Border Radius', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wpuf-fields input:not(.weforms_submit_btn), {{WRAPPER}} .wpuf-fields textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => '_dl_weforms_field_typography',
                'label' => __( 'Typography', 'droit-addons' ),
                'selector' => '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-fields input:not(.weforms_submit_btn), .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-fields textarea',
            ]
        );

        $this->add_control(
            '_dl_weforms_field_textcolor',
            [
                'label' => __( 'Text Color', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-fields input:not(.weforms_submit_btn), {{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-fields textarea' => 'color: {{VALUE}};',
                ],
            ]
		);

        $this->add_control(
            '_dl_weforms_field_placeholder_color',
            [
                'label' => __( 'Placeholder Color', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ::-webkit-input-placeholder'	=> 'color: {{VALUE}};',
                    '{{WRAPPER}} ::-moz-placeholder'			=> 'color: {{VALUE}};',
                    '{{WRAPPER}} ::-ms-input-placeholder'		=> 'color: {{VALUE}};',
                ],
            ]
		);

        $this->start_controls_tabs( '_dl_weforms_tabs' );

        $this->start_controls_tab(
            '_dl_weforms_tab_field_normal',
            [
                'label' => __( 'Normal', 'droit-addons' ),
            ]
		);

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => '_dl_weforms_field_border',
                'selector' => '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-fields input:not(.weforms_submit_btn), {{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-fields textarea',
            ]
        );

		$this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => '_dl_weforms_field_box_shadow',
                'selector' => '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-fields input:not(.weforms_submit_btn), {{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-fields textarea',
            ]
        );

        $this->add_control(
            '_dl_weforms_field_bg_color',
            [
                'label' => __( 'Background Color', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-fields input:not(.weforms_submit_btn), {{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-fields textarea' => 'background-color: {{VALUE}}',
                ],
            ]
		);

		$this->end_controls_tab();

        $this->start_controls_tab(
            '_dl_weforms_tab_field_focus',
            [
                'label' => __( 'Focus', 'droit-addons' ),
            ]
		);

		$this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => '_dl_weforms_focus_border',
                'selector' => '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-fields input:focus:not(.weforms_submit_btn), {{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-fields textarea:focus',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => '_dl_weforms_focus_box_shadow',
                'exclude' => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-fields input:focus:not(.weforms_submit_btn), {{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-fields textarea:focus',
            ]
		);

		$this->add_control(
            '_dl_weforms_field_focus_bg_color',
            [
                'label' => __( 'Background Color', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-fields input:focus:not(.weforms_submit_btn), {{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-fields textarea:focus' => 'background-color: {{VALUE}}',
                ],
            ]
        );

		$this->end_controls_tab();
		$this->end_controls_tabs();

        $this->end_controls_section();
    } 

    public function register_weform_labels_style() {
        $this->start_controls_section(
            '_dl_weforms_label_field_styles',
            [
                'label' => esc_html__( 'Label Fields', 'droit-addons' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            '_dl_weforms_label_margin',
            [
                'label' => __( 'Margin', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wpuf-label label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            '_dl_weforms_label_padding',
            [
                'label' => __( 'Padding', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wpuf-label label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => '_dl_weforms_label_typography',
                'label' => __( 'Label Typography', 'droit-addons' ),
                'selector' => '{{WRAPPER}} .wpuf-label label, {{WRAPPER}} .wpuf-form-sub-label',
            ]
        );

		$this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => '_dl_weforms_desc_typography',
                'label' => __( 'Desc Typography', 'droit-addons' ),
                'selector' => '{{WRAPPER}} .wpuf-fields .wpuf-help',
            ]
        );

        $this->add_control(
            '_dl_weforms_label_color',
            [
                'label' => __( 'Text Color', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpuf-label label, {{WRAPPER}} .wpuf-form-sub-label' => 'color: {{VALUE}}',
                ],
            ]
		);

		$this->add_control(
            '_dl_weforms_requered_label',
            [
                'label' => __( 'Required Label Color', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpuf-label .required' => 'color: {{VALUE}} !important',
                ],
            ]
        );

		$this->add_control(
            '_dl_weforms_desc_color',
            [
                'label' => __( 'Desc Color', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpuf-fields .wpuf-help' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();
        
    } 

    public function register_weform_button_style() {
        $this->start_controls_section(
            '_dl_weforms_button_field_styles',
            [
                'label' => esc_html__( 'Button', 'droit-addons' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            '_dl_weforms_submit_btn_width',
            [
                'label' => __( 'Full Width Button?', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'droit-addons' ),
                'label_off' => __( 'No', 'droit-addons' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_responsive_control(
            '_dl_weforms_button_width',
            [
                'label' => __( 'Button Width', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'condition' => [
                    '_dl_weforms_submit_btn_width' => 'yes'
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
                    '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-submit .weforms_submit_btn' => 'display: block; width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            '_dl_weforms_submit_btn_position',
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
                'condition' => [
                    '_dl_weforms_submit_btn_width' => ''
                ],
                'desktop_default' => 'left',
                'toggle' => false,
				'selectors' => [
                    '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-submit' => 'text-align: {{Value}};',
                ],
            ]
        );

        $this->add_responsive_control(
            '_dl_weforms_submit_margin',
            [
                'label' => __( 'Margin', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-submit input[type=submit]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            '_dl_weforms_submit_padding',
            [
                'label' => __( 'Padding', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-submit input[type=submit]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => '_dl_weforms_submit_typography',
                'selector' => '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-submit input[type=submit]',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => '_dl_weforms_submit_border',
                'selector' => '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-submit input[type=submit]',
            ]
        );

        $this->add_control(
            '_dl_weforms_border_radius',
            [
                'label' => __( 'Border Radius', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-submit input[type=submit]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => '_dl_weforms_submit_box_shadow',
                'selector' => '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-submit input[type=submit]',
            ]
        );

		$this->add_group_control(
            \Elementor\Group_Control_Text_Shadow::get_type(),
            [
                'name'     => '_dl_weforms_submit_text_shadow',
                'selector' => '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-submit input[type=submit]',
                'separator'=> 'after'
            ]
        );

        $this->start_controls_tabs( '_dl_weforms_tabs_button' );

        $this->start_controls_tab(
            '_dl_weforms_tab_button_normal',
            [
                'label' => __( 'Normal', 'droit-addons' ),
            ]
        );

        $this->add_control(
            '_dl_weforms_submit_color',
            [
                'label' => __( 'Text Color', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-submit input[type=submit]' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            '_dl_weforms_submit_bg_color',
            [
                'label' => __( 'Background Color', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-submit input[type=submit]' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_dl_weforms_tab_hover',
            [
                'label' => __( 'Hover', 'droit-addons' ),
            ]
        );

        $this->add_control(
            '_dl_weforms_submit_hover_color',
            [
                'label' => __( 'Text Color', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-submit input[type=submit]:hover, {{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-submit input[type=submit]:focus' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            '_dl_weforms_submit_hover_bg_color',
            [
                'label' => __( 'Background Color', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-submit input[type=submit]:hover, {{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-submit input[type=submit]:focus' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            '_dl_weforms_submit_hover_border_color',
            [
                'label' => __( 'Border Color', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-submit input[type=submit]:hover, {{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-submit input[type=submit]:focus' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
        
    } 


    public function register_weform_notice() {
        $weform = 'weforms/weforms.php';
        $droit_plugins_name = 'Droit Elementor Addons for Elementor';

        if ($this->is_we_form_installed_or_not($weform)) {

            $activation_url = wp_nonce_url('plugins.php?action=activate&amp;plugin=' . $weform . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $weform);

            $message = __('To activate and run <strong>'.$droit_plugins_name.'</strong> please activate weform. You can activate weform from here', 'droit-addons');
            
            $_button_text = __('Activate weform', 'droit-addons');
        } else {
            $activation_url = wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin=weforms'), 'install-plugin_weforms');

            $message = sprintf(__('To activate and run <strong>'.$droit_plugins_name.'</strong> please install and activate weForms. You can install and activate weForms from here', 'droit-addons'), '<strong>', '</strong>');
            $_button_text = __('Install weForm', 'droit-addons');
        }

        $_button = '<p><a href="' . $activation_url . '" class="button-primary" target="_blank">' . $_button_text . '</a></p>';
        
        $this->add_control(
            'weform_missing_notice',
            [
                'type' => \Elementor\Controls_Manager::RAW_HTML,
                    'raw' => sprintf(__( '%1$s, %2$s', 'droit-addons' ), $message, $_button
                ),
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-danger',
            ]
        );
        return;
        
    } 

    public function register_weform_selector() {
        $this->add_control(
            '_dl_weform_id',
            [
                'label'       => __( 'Select Your Form', 'droit-addons' ),
                'type'        => \Elementor\Controls_Manager::SELECT,
                'label_block' => true,
                'options'     => \DROIT_ELEMENTOR\DL_Helper::weform_list(),
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
    protected function is_we_form_installed_or_not($basename) {
        if (!function_exists('get_plugins')) {
            include_once ABSPATH . '/wp-admin/includes/plugin.php';
        }

        $installed_plugins = get_plugins();

        return isset($installed_plugins[$basename]);
    }

    //Html render
    protected function render(){
        if ( ! \DROIT_ELEMENTOR\DL_Helper::weform_activated()  ) {
            return;
        }
        
        $settings = $this->get_settings_for_display();
        extract($settings);
    
        ?>
        <div>
            <?php echo do_shortcode( '[weforms id="'. esc_html($_dl_weform_id) .'"]' ); ?>
        </div>
      <?php
        
    }
        
    protected function content_template(){}
}
