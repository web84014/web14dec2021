<?php
namespace DROIT_ELEMENTOR\Widgets;

if (!defined('ABSPATH')) {exit;}

class Droit_Addons_Wpform extends \Elementor\Widget_Base {
    public function get_name() {
        return 'droit-wpform';
    }
    
    public function get_title() {
        return esc_html__( 'WPForm', 'droit-addons' );
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
            'wpform', 
            'form', 
            'dl', 
            'droit' 
        ];
    }
    
    public function get_categories() {
        return ['droit_addons'];
    }
    
    protected function _register_controls() {
        $this->register_wpform_general_control();
        $this->register_wpform_style_control();
        do_action('dl_widget/section/style/custom_css', $this);
    }

    public function register_wpform_general_control() {
        $this->start_controls_section(
            '_dl_wp_form_layout_section',
            [
                'label' => esc_html__('WPForms', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        if ( ! \DROIT_ELEMENTOR\DL_Helper::wpform_activated() ) {
        	$this->register_wpform_notice();
        }
        else{
			$this->register_wpform_selector();
        }
    	
        $this->end_controls_section();
    } 

    public function register_wpform_style_control() {
        $this->register_wpform_fields_style();
        $this->register_wpform_labels_style();
        $this->register_wpform_button_style();
    } 

    public function register_wpform_fields_style() {
        $this->start_controls_section(
            '_dl_wpforms_form_field_styles',
            [
                'label' => esc_html__( 'Form Fields', 'droit-addons' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            '_dl_wpforms_field_margin',
            [
                'label' => __( 'Spacing', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .dl-wpform-render .wpforms-field:not(.wpforms-submit), .wpforms-field-required:not(.wpforms-submit)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            '_dl_wpforms_field_padding',
            [
                'label' => __( 'Padding', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .dl-wpform-render .wpforms-field input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .dl-wpform-render .wpforms-field textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            '_dl_wpforms_field_border_radius',
            [
                'label' => __( 'Border Radius', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .dl-wpform-render .wpforms-field input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .dl-wpform-render .wpforms-field textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => '_dl_wpforms_field_typography',
                'label'    => __( 'Typography', 'droit-addons' ),
                'selector' => '{{WRAPPER}} .dl-wpform-render .wpforms-field input, {{WRAPPER}} .dl-wpform-render .wpforms-field-textarea textarea',
            ]
        );

        $this->add_control(
            '_dl_wpforms_field_textcolor',
            [
                'label' => __( 'Text Color', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dl-wpform-render .wpforms-field input, {{WRAPPER}} .dl-wpform-render .wpforms-field-textarea textarea' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            '_dl_wpforms_field_placeholder_color',
            [
                'label' => __( 'Placeholder Color', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dl-wpform-render ::-webkit-input-placeholder'	=> 'color: {{VALUE}};',
                    '{{WRAPPER}} .dl-wpform-render ::-moz-placeholder'			=> 'color: {{VALUE}};',
                    '{{WRAPPER}} .dl-wpform-render ::-ms-input-placeholder'		=> 'color: {{VALUE}};',
                ],
            ]
        );

        $this->start_controls_tabs( '_dl_wpforms_tabs_field_state' );

        $this->start_controls_tab(
            '_dl_wpforms_tab_field_normal',
            [
                'label' => __( 'Normal', 'droit-addons' ),
            ]
        );

		$this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => '_dl_wpforms_field_border',
                'selector' => '{{WRAPPER}} .dl-wpform-render .wpforms-field input, {{WRAPPER}} .dl-wpform-render .wpforms-field-textarea textarea',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => '_dl_wpforms_field_box_shadow',
                'selector' => '{{WRAPPER}} .dl-wpform-render .wpforms-field input, {{WRAPPER}} .dl-wpform-render .wpforms-field-textarea textarea',
            ]
        );

        $this->add_control(
            '_dl_wpforms_field_bg_color',
            [
                'label' => __( 'Background Color', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dl-wpform-render .wpforms-field input, {{WRAPPER}} .dl-wpform-render .wpforms-field-textarea textarea' => 'background-color: {{VALUE}}',
                ],
            ]
		);

		$this->end_controls_tab();

        $this->start_controls_tab(
            '_dl_wpforms_tab_field_focus',
            [
                'label' => __( 'Focus', 'droit-addons' ),
            ]
        );

		$this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => '_dl_wpforms_field_focus_border',
                'selector' => '{{WRAPPER}} .dl-wpform-render .wpforms-field input:focus, {{WRAPPER}} .dl-wpform-render .wpforms-field-textarea textarea:focus',
            ]
		);

		$this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => '_dl_wpforms_field_focus_box_shadow',
                'exclude' => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .dl-wpform-render .wpforms-field input:focus, {{WRAPPER}} .dl-wpform-render .wpforms-field-textarea textarea:focus',
            ]
		);

		$this->add_control(
            '_dl_wpforms_field_focus_bg_color',
            [
                'label' => __( 'Background Color', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dl-wpform-render .wpforms-field input:focus, {{WRAPPER}} .dl-wpform-render .wpforms-field-textarea textarea:focus' => 'background-color: {{VALUE}}',
                ],
            ]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
        
        $this->end_controls_section();
    } 

    public function register_wpform_labels_style() {
        $this->start_controls_section(
            '_dl_wpforms_form_label_styles',
            [
                'label' => esc_html__( 'Form Labels', 'droit-addons' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            '_dl_wpforms_label_margin',
            [
                'label' => __( 'Margin', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .dl-wpform-render .wpforms-field-container label.wpforms-field-label' => 'display: inline-block; padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            '_dl_wpforms_label_padding',
            [
                'label' => __( 'Padding', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .dl-wpform-render .wpforms-field-container label.wpforms-field-label' => 'display: inline-block; padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => '_dl_wpforms_label_typography',
                'label' => __( 'Label Typography', 'droit-addons' ),
                'selector' => '{{WRAPPER}} .dl-wpform-render .wpforms-field-container label.wpforms-field-label'
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => '_dl_wpforms_sublabel_typography',
                'label' => __( 'Sub Label Typography', 'droit-addons' ),
                'selector' => '{{WRAPPER}} .dl-wpform-render .wpforms-field-sublabel'
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => '_dl_wpforms_desc_typography',
                'label' => __( 'Desc Typography', 'droit-addons' ),
                'selector' => '{{WRAPPER}} .dl-wpform-render .wpforms-field-description',
            ]
        );

        $this->add_control(
            '_dl_wpforms_label_color_popover',
            [
                'label' => __( 'Colors', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
                'label_off' => __( '', 'droit-addons' ),
                'label_on' => __( 'Custom', 'droit-addons' ),
                'return_value' => 'yes',
            ]
        );

        $this->start_popover();

        $this->add_control(
            '_dl_wpforms_label_color',
            [
                'label' => __( 'Label Text Color', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dl-wpform-render .wpforms-field-container label.wpforms-field-label' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    '_dl_wpforms_label_color_popover' => 'yes'
                ],
            ]
		);

        $this->add_control(
            '_dl_wpforms_requered_label',
            [
                'label' => __( 'Required Label Color', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dl-wpform-render .wpforms-required-label' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    '_dl_wpforms_label_color_popover' => 'yes'
                ],
            ]
        );

        $this->add_control(
            '_dl_wpforms_sublabel_color',
            [
                'label' => __( 'Sub Label Text Color', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dl-wpform-render .wpforms-field-sublabel' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    '_dl_wpforms_label_color_popover' => 'yes'
                ],
            ]
        );

		$this->add_control(
            '_dl_wpforms_desc_label_color',
            [
                'label' => __( 'Description Text Color', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dl-wpform-render .wpforms-field-description' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    '_dl_wpforms_label_color_popover' => 'yes'
                ],
            ]
        );

        $this->end_popover();

        $this->end_controls_section();
    } 

    public function register_wpform_button_style() {
        $this->start_controls_section(
            '_dl_wpforms_button_field_styles',
            [
                'label' => esc_html__( 'Button', 'droit-addons' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            '_dl_wpforms_submit_btn_width',
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
            '_dl_wpforms_button_width',
            [
                'label' => __( 'Button Width', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'condition' => [
                    '_dl_wpforms_submit_btn_width' => 'yes'
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
                'default' => [
                    'unit' => '%',
                    'size' => 100
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl-wpform-render .wpforms-submit' => 'display: block; width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            '_dl_wpforms_submit_btn_position',
            [
                'label' => __( 'Button Position', 'droit-addons' ),
                'type'  => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'droit-addons' ),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'droit-addons' ),
                        'icon'  => 'eicon-h-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'droit-addons' ),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'condition' => [
                    '_dl_wpforms_submit_btn_width' => '',

                ],
                'desktop_default' => 'left',
                'toggle'          => false,
				'selectors'       => [
                    '{{WRAPPER}} .dl-wpform-render .wpforms-submit-container' => 'text-align: {{Value}};',
                ],
            ]
        );

        $this->add_responsive_control(
            '_dl_wpforms_submit_margin',
            [
                'label'      => __( 'Margin', 'droit-addons' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .dl-wpform-render .wpforms-submit' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            '_dl_wpforms_padding',
            [
                'label'      => __( 'Padding', 'droit-addons' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .dl-wpform-render .wpforms-submit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => '_dl_wpforms_submit_typography',
                'selector' => '{{WRAPPER}} .dl-wpform-render .wpforms-submit',
            ]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => '_dl_wpforms_submit_border',
                'selector' => '{{WRAPPER}} .dl-wpform-render .wpforms-form .wpforms-submit-container button[type=submit]',
            ]
        );

        $this->add_control(
            '_dl_wpforms_submit_border_radius',
            [
                'label'      => __( 'Border Radius', 'droit-addons' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .dl-wpform-render .wpforms-submit' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => '_dl_wpforms_submit_box_shadow',
                'selector' => '{{WRAPPER}} .dl-wpform-render .wpforms-submit',
                'separator'=> 'after'
            ]
        );

        $this->start_controls_tabs( '_dl_wpforms_tabs_button' );

        $this->start_controls_tab(
            '_dl_wpforms_tab_normal',
            [
                'label' => __( 'Normal', 'droit-addons' ),
            ]
        );

        $this->add_control(
            '_dl_wpforms_submit_color',
            [
                'label'     => __( 'Text Color', 'droit-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .dl-wpform-render .wpforms-submit' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            '_dl_wpforms_submit_bg_color',
            [
                'label' => __( 'Background Color', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dl-wpform-render .wpforms-submit' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_dl_wpforms_tab_hover',
            [
                'label' => __( 'Hover', 'droit-addons' ),
            ]
        );

        $this->add_control(
            '_dl_wpforms_submit_hover_color',
            [
                'label'     => __( 'Text Color', 'droit-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dl-wpform-render .wpforms-submit:hover, {{WRAPPER}} .dl-wpform-render .wpforms-submit:focus' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            '_dl_wpforms_submit_hover_bg_color',
            [
                'label'     => __( 'Background Color', 'droit-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dl-wpform-render .wpforms-submit:hover, {{WRAPPER}} .dl-wpform-render .wpforms-submit:focus' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            '_dl_wpforms_submit_hover_border_color',
            [
                'label' => __( 'Border Color', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dl-wpform-render .wpforms-submit:hover, {{WRAPPER}} .dl-wpform-render .wpforms-submit:focus' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
    } 

    public function register_wpform_notice() {
        $wpform = 'wpforms-lite/wpforms.php';
        $droit_plugins_name = 'Droit Elementor Addons for Elementor';

        if ($this->is_wp_form_installed_or_not($wpform)) {

            $activation_url = wp_nonce_url('plugins.php?action=activate&amp;plugin=' . $wpform . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $wpform);

            $message = __('To activate and run <strong>'.$droit_plugins_name.'</strong> please activate WPform. You can activate WPform from here', 'droit-addons');
            
            $_button_text = __('Activate WPform', 'droit-addons');
        } else {
            $activation_url = wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin=wpforms-lite'), 'install-plugin_wpforms');

            $message = sprintf(__('To activate and run <strong>'.$droit_plugins_name.'</strong> please install and activate WPForms. You can install and activate WPForms from here', 'droit-addons'), '<strong>', '</strong>');
            $_button_text = __('Install WPForm', 'droit-addons');
        }

        $_button = '<p><a href="' . $activation_url . '" class="button-primary" target="_blank">' . $_button_text . '</a></p>';
        
        $this->add_control(
            'wpform_missing_notice',
            [
                'type' => \Elementor\Controls_Manager::RAW_HTML,
                'raw' => sprintf( __( '%1$s, %2$s', 'droit-addons' ), $message, $_button ),
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-danger',
            ]
        );
        return;
    } 

    public function is_wp_form_installed_or_not($basename) {
        if (!function_exists('get_plugins')) {
            include_once ABSPATH . '/wp-admin/includes/plugin.php';
        }

        $installed_plugins = get_plugins();

        return isset($installed_plugins[$basename]);
        
    } 

    public function register_wpform_selector() {
        $this->add_control(
            '_dl_wpform_id',
            [
                'label'       => __( 'Select Your Form', 'droit-addons' ),
                'type'        => \Elementor\Controls_Manager::SELECT,
                'label_block' => true,
                'options'     => \DROIT_ELEMENTOR\DL_Helper::wpform_list(),
                'default'     => ''
            ]
        );
        
    }

    public function render() {
        if ( ! \DROIT_ELEMENTOR\DL_Helper::wpform_activated()  ) {
            return;
        }
        
        $settings = $this->get_settings_for_display();
        extract($settings);
    
        ?>
        <div class="dl-wpform-render">
            <?php echo do_shortcode( '[wpforms id="'. esc_html($_dl_wpform_id) .'"]' ); ?>
        </div>
      <?php
        
    } 
}