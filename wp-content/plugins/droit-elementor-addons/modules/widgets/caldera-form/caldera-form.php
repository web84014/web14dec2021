<?php
namespace DROIT_ELEMENTOR\Widgets;

if (!defined('ABSPATH')) {exit;}

class Droit_Addons_Caldera_Form extends \Elementor\Widget_Base {
    public function get_name() {
        return 'droit-caldera_form';
    }
    
    public function get_title() {
        return esc_html__( 'Caldera Form', 'droit-addons-pro' );
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
        $this->register_caldera_form_general_control();
        $this->register_caldera_form_style_control();
        do_action('dl_widget/section/style/custom_css', $this);
    }

    public function register_caldera_form_general_control() {
        $this->start_controls_section(
            '_dl_caldera_form_layout_section',
            [
                'label' => esc_html__('Caldera Form', 'droit-addons-pro'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        if ( ! \DROIT_ELEMENTOR\DL_Helper::caldera_form_activated() ) {
        	$this->register_caldera_form_notice();
        }
        else{
			$this->register_caldera_form_selector();
        }
    	
        $this->end_controls_section();
    } 

    public function register_caldera_form_style_control() {
        $this->register_caldera_form_fields_style();
        $this->register_caldera_form_labels_style();
        $this->register_caldera_form_button_style();
    } 

    public function register_caldera_form_fields_style() {
        $this->start_controls_section(
            '_dl_caldera_form_field_styles',
            [
                'label' => esc_html__( 'Form Fields', 'droit-addons-pro' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            '_dl_caldera_field_margin',
            [
                'label' => __( 'Spacing', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .form-group:not(.btn)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            '_dl_caldera_field_padding',
            [
                'label' => __( 'Padding', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .form-group input:not(.btn)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            '_dl_caldera_field_border_radius',
            [
                'label' => __( 'Border Radius', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .form-group input:not(.btn), {{WRAPPER}} .form-group textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => '_dl_caldera_field_typography',
                'label' => __( 'Typography', 'droit-addons-pro' ),
                'selector' => '{{WRAPPER}} .form-group input:not(.btn), {{WRAPPER}} .form-group textarea',
            ]
        );

        $this->add_control(
            'field_textcolor',
            [
                'label' => __( 'Text Color', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .form-group input:not(.btn), {{WRAPPER}} .form-group textarea' => 'color: {{VALUE}}',
                ],
            ]
		);

        $this->add_control(
            'field_placeholder_color',
            [
                'label' => __( 'Placeholder Color', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ::-webkit-input-placeholder'	=> 'color: {{VALUE}};',
                    '{{WRAPPER}} ::-moz-placeholder'			=> 'color: {{VALUE}};',
                    '{{WRAPPER}} ::-ms-input-placeholder'		=> 'color: {{VALUE}};',
                ],
            ]
		);

        $this->start_controls_tabs( '_dl_caldera_tabs' );

        $this->start_controls_tab(
            '_dl_caldera_tab_field_normal',
            [
                'label' => __( 'Normal', 'droit-addons-pro' ),
            ]
		);

		$this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => '_dl_caldera_field_border',
                'selector' => '{{WRAPPER}} .form-group input:not(.btn), {{WRAPPER}} .form-group textarea',
            ]
        );

		$this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => '_dl_caldera_field_box_shadow',
                'selector' => '{{WRAPPER}} .form-group input:not(.btn), {{WRAPPER}} .form-group textarea',
            ]
        );

        $this->add_control(
            '_dl_caldera_field_bg_color',
            [
                'label' => __( 'Background Color', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .form-group input:not(.btn), {{WRAPPER}} .form-group textarea' => 'background-color: {{VALUE}}',
                ],
            ]
		);

		$this->end_controls_tab();

        $this->start_controls_tab(
            '_dl_caldera_tab_field_focus',
            [
                'label' => __( 'Focus', 'droit-addons-pro' ),
            ]
		);

		$this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => '_dl_caldera_focus_border',
                'selector' => '{{WRAPPER}} .form-group input:focus:not(.btn), {{WRAPPER}} .form-group textarea:focus',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => '_dl_caldera_focus_box_shadow',
                'exclude' => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .form-group input:focus:not(.btn), {{WRAPPER}} .form-group textarea:focus',
            ]
		);

		$this->add_control(
            '_dl_caldera_focus_bg_color',
            [
                'label' => __( 'Background Color', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .form-group input:focus:not(.btn), {{WRAPPER}} .form-group textarea:focus' => 'background-color: {{VALUE}}',
                ],
            ]
        );

		$this->end_controls_tab();
		$this->end_controls_tabs();

        $this->end_controls_section();
    } 

    public function register_caldera_form_labels_style() {
        $this->start_controls_section(
            '_dl_caldera_form_label_field_styles',
            [
                'label' => esc_html__( 'Form Label', 'droit-addons-pro' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            '_dl_caldera_label_margin',
            [
                'label' => __( 'Margin', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .caldera-grid label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            '_dl_caldera_label_padding',
            [
                'label' => __( 'Padding', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .caldera-grid label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => '_dl_caldera_label_typography',
                'label' => __( 'Typography', 'droit-addons-pro' ),
                'selector' => '{{WRAPPER}} .caldera-grid label',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => '_dl_caldera_desc_typography',
                'label' => __( 'Desc Typography', 'droit-addons-pro' ),
                'selector' => '{{WRAPPER}} .caldera-grid .help-block',
            ]
        );

        $this->add_control(
            '_dl_caldera_label_color',
            [
                'label' => __( 'Text Color', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .caldera-grid label' => 'color: {{VALUE}}',
                ],
            ]
		);

        $this->add_control(
            '_dl_caldera_requered_label',
            [
                'label' => __( 'Required Label Color', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .field_required' => 'color: {{VALUE}} !important',
                ],
            ]
        );

		$this->add_control(
            '_dl_caldera_desc_color',
            [
                'label' => __( 'Desc Color', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .caldera-grid .help-block' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();
    } 

    public function register_caldera_form_button_style() {
        $this->start_controls_section(
            '_dl_caldera_form_button_field_styles',
            [
                'label' => esc_html__( 'Button', 'droit-addons-pro' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            '_dl_caldera_submit_btn',
            [
                'label' => __( 'Full Width Button?', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'droit-addons-pro' ),
                'label_off' => __( 'No', 'droit-addons-pro' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_responsive_control(
            '_dl_caldera_button_width',
            [
                'label' => __( 'Button Width', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'condition' => [
                    '_dl_caldera_submit_btn' => 'yes'
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
                    '{{WRAPPER}} .form-group .btn' => 'display: block; width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            '_dl_caldera_submit_margin',
            [
                'label' => __( 'Margin', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .form-group .btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            '_dl_caldera_submit_padding',
            [
                'label' => __( 'Padding', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .form-group .btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => '_dl_caldera_submit_typography',
                'selector' => '{{WRAPPER}} .form-group .btn',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => '_dl_caldera_submit_border',
                'selector' => '{{WRAPPER}} .form-group .btn',
            ]
        );

        $this->add_control(
            '_dl_caldera_submit_border_radius',
            [
                'label' => __( 'Border Radius', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .form-group .btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'      => '_dl_caldera_submit_box_shadow',
                'selector'  => '{{WRAPPER}} .form-group .btn',
                'separator' => 'after'
            ]
        );

        $this->start_controls_tabs( '_dl_caldera_tabs_button' );

        $this->add_control(
            '_dl_caldera_submit_color',
            [
                'label' => __( 'Text Color', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .form-group .btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            '_dl_caldera_submit_bg_color',
            [
                'label' => __( 'Background Color', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .form-group .btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_dl_caldera_tab_button_hover',
            [
                'label' => __( 'Hover', 'droit-addons-pro' ),
            ]
        );

        $this->add_control(
            '_dl_caldera_submit_hover_color',
            [
                'label' => __( 'Text Color', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .form-group .btn:hover, {{WRAPPER}} .form-group .btn:focus' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            '_dl_caldera_submit_hover_bg_color',
            [
                'label' => __( 'Background Color', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .form-group .btn:hover, {{WRAPPER}} .form-group .btn:focus' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            '_dl_caldera_submit_hover_border_color',
            [
                'label' => __( 'Border Color', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .form-group .btn:hover, {{WRAPPER}} .form-group .btn:focus' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        

        $this->end_controls_section();
    } 


    //Html render
    protected function render(){
        if ( ! \DROIT_ELEMENTOR\DL_Helper::caldera_form_activated()  ) {
            return;
        }
        
        $settings = $this->get_settings_for_display();
        extract($settings);
    
        ?>
        <div>
            <?php echo do_shortcode( '[caldera_form id="'. esc_html($_dl_caldera_form_id) .'"]' ); ?>
        </div>
      <?php
    }

    public function register_caldera_form_notice() {
        $caldera_form = 'caldera-forms/caldera-core.php';
        $droit_plugins_name = 'Droit Elementor Addons for Elementor';

        if ($this->is_caldera_form_installed_or_not($caldera_form)) {

            $activation_url = wp_nonce_url('plugins.php?action=activate&amp;plugin=' . $caldera_form . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $caldera_form);

            $message = __('To activate and run <strong>'.$droit_plugins_name.'</strong> please activate caldera form. You can activate caldera form from here', 'droit-addons-pro');
            
            $_button_text = __('Activate caldera form', 'droit-addons-pro');
        } else {
            $activation_url = wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin=caldera-forms'), 'install-plugin_caldera_forms');

            $message = sprintf(__('To activate and run <strong>'.$droit_plugins_name.'</strong> please install and activate caldera form. You can install and activate caldera form from here', 'droit-addons-pro'), '<strong>', '</strong>');
            $_button_text = __('Install caldera form', 'droit-addons-pro');
        }

        $_button = '<p><a href="' . $activation_url . '" class="button-primary" target="_blank">' . $_button_text . '</a></p>';
        
        $this->add_control(
            'caldera_form_missing_notice',
            [
                'type' => \Elementor\Controls_Manager::RAW_HTML,
                    'raw' => sprintf(__( '%1$s, %2$s', 'droit-addons-pro' ), $message, $_button
                ),
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-danger',
            ]
        );
        
        return;
    } 
    
    /**
     * Check if a plugin is installed or Not
     * @access public
     * @since 1.0.0
     * Feature added by : DroitLab Team
     */
    protected function is_caldera_form_installed_or_not($basename) {
        if (!function_exists('get_plugins')) {
            include_once ABSPATH . '/wp-admin/includes/plugin.php';
        }

        $installed_plugins = get_plugins();

        return isset($installed_plugins[$basename]);
    }

    public function register_caldera_form_selector() {
        $this->add_control(
            '_dl_caldera_form_id',
            [
                'label'       => __( 'Select Your Form', 'droit-addons-pro' ),
                'type'        => \Elementor\Controls_Manager::SELECT,
                'label_block' => true,
                'options'     => \DROIT_ELEMENTOR\DL_Helper::caldera_form_list(),
                'default'     => ''
            ]
        );
    } 

    protected function content_template(){}

}