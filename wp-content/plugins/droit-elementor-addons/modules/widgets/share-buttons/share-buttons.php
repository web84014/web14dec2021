<?php
namespace DROIT_ELEMENTOR\Widgets;

if (!defined('ABSPATH')) {exit;}

class Droit_Addons_Share_Buttons extends \Elementor\Widget_Base {

    // Get Control ID
	protected function get_control_id( $control_id ) {
        return $control_id;
    }

    final public function get_share_settings( $control_key ) {
        $control_id = $this->get_control_id( $control_key );
        return $this->get_settings( $control_id );
    }

    public function get_name() {
        return 'droit-share_Buttons';
    }
    
    public function get_title() {
        return esc_html__( 'Share Buttons', 'droit-addons' );
    }

    public function get_icon() {
        return 'dlicons-social-share addons-icon';
    }

    public function get_keywords() {
        return [
            'sharing',
            'social',
            'icon',
            'button',
            'like',
            'droit',
            'dl',
            'addons',
            'addon'
        ];
    }
    
    public function get_categories() {
        return ['droit_addons'];
    }

    protected function _register_controls(){
        $this->register_share_icons_buttons_skin_one_control();
        //$this->register_share_icons_buttons_skin_all_control();
        $this->_droit_register_share_buttons_icon_style_controls();
        do_action('dl_widget/section/style/custom_css', $this);
    }

	// share_buttons Content Skin 1
	public function register_share_icons_buttons_skin_one_control(){
		$this->start_controls_section(
            '_dl_share_buttons_default_section',
            [
                'label' => esc_html__('Share Icons', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                
            ]
        );

		$repeater = new \Elementor\Repeater();

		$repeater->start_controls_tabs( '_dl_share_buttons_repeat_tabs' );

		$repeater->start_controls_tab( '_dl_share_buttons_repeat_content',
			[ 
				'label' => esc_html__( 'Content', 'droit-addons'),
			] 
		);

        $repeater->add_control(
            '_dl_share_buttons_network',
            [
                'label' => esc_html__( 'Social Network', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'facebook',
                'options' => [
                    'facebook'      => esc_html__( 'Facebook', 'droit-addons' ),
                    'twitter'       => esc_html__( 'Twitter', 'droit-addons' ),
                    'pinterest'     => esc_html__( 'Pinterest', 'droit-addons' ),
                    'instagram'    => esc_html__( 'Instagram', 'droit-addons' ),
                    'odnoklassniki' => esc_html__( 'Odnoklassniki', 'droit-addons' ),
                    'tumblr'        => esc_html__( 'Tumblr', 'droit-addons' ),
                    'linkedin'      => esc_html__( 'Linkedin', 'droit-addons' ),
                    'snapchat'        => esc_html__( 'Snapchat', 'droit-addons' ),
                    'vkontakte'     => esc_html__( 'Vkontakte', 'droit-addons' ),
                    'moimir'        => esc_html__( 'Moimir', 'droit-addons' ),
                    'flicker'        => esc_html__( 'Flicker', 'droit-addons' ),
                    'live journal'   => esc_html__( 'Live journal', 'droit-addons' ),
                    'blogger'       => esc_html__( 'Blogger', 'droit-addons' ),
                    'evernote'      => esc_html__( 'Evernote', 'droit-addons' ),
                    'reddit'        => esc_html__( 'Reddit', 'droit-addons' ),
                    'digg'          => esc_html__( 'Digg', 'droit-addons' ),
                    'delicious'     => esc_html__( 'Delicious', 'droit-addons' ),
                    'pocket'        => esc_html__( 'Pocket', 'droit-addons' ),
                    'surfingbird'   => esc_html__( 'Surfingbird', 'droit-addons' ),
                    'stumbleupon'   => esc_html__( 'Stumbleupon', 'droit-addons' ),
                    'liveinternet'  => esc_html__( 'Liveinternet', 'droit-addons' ),
                    'instapaper'    => esc_html__( 'Instapaper', 'droit-addons' ),
                    'xing'          => esc_html__( 'Xing', 'droit-addons' ),
                    'buffer'        => esc_html__( 'Buffer', 'droit-addons' ),
                    'wordpress'     => esc_html__( 'WordPress', 'droit-addons' ),
                    'renren'        => esc_html__( 'Renren', 'droit-addons' ),
                    'weibo'         => esc_html__( 'Weibo', 'droit-addons' ),
                    'baidu'         => esc_html__( 'Baidu', 'droit-addons' ),
                    'skype'         => esc_html__( 'Skype', 'droit-addons' ),
                    'telegram'      => esc_html__( 'Telegram', 'droit-addons' ),
                    'viber'         => esc_html__( 'Viber', 'droit-addons' ),
                    'whatsapp'      => esc_html__( 'Whatsapp', 'droit-addons' ),
                    'line'          => esc_html__( 'Line', 'droit-addons' ),
                ],
            ]
        );

		$repeater->add_control(
            '_dl_share_buttons_icon_show',
            [
                'label'        => esc_html__('Enable Icon', 'droit-addons'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'return_value' => 'yes',
            ]
        );

		$repeater->add_control(
            '_dl_share_buttons_selected_icon',
            [
                'label' => __( 'Icon', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fab fa-facebook-f',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    $this->get_control_id( '_dl_share_buttons_icon_show' ) => [ 'yes' ],
                ],
            ]
        );

        $repeater->add_control(
			'_dl_share_buttons_label',
			[
				'label'       => __( 'Label', 'droit-addons' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( 'Facebook', 'droit-addons' ),
				'placeholder' => __( 'Enter media name', 'droit-addons' ),
				'label_block' => true,
				'separator'   => 'before',
			]
		);
	
		$repeater->end_controls_tab();

		$repeater->start_controls_tab( '_dl_share_buttons_repeat_style',
			[ 
				'label' => esc_html__( 'Style', 'droit-addons')
			] 
		);

        $repeater->add_control(
            '_dl_share_buttons_icon_color',
            [
                'label' => esc_html__( 'Color', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .droit-share-buttons-wrapper {{CURRENT_ITEM}}.droit-share-icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .droit-share-buttons-wrapper {{CURRENT_ITEM}}.droit-share-icon svg' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .droit-share-buttons-wrapper {{CURRENT_ITEM}}.droit-share-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $repeater->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => '_dl_share_buttons_bg_color',
                'label' => 'Color',
                'fields_options' => [
                    'background' => [
                        'label' => __( 'Background Color', 'droit-addons' ),
                    ],
                ],
                'types' => [ 'classic', 'gradient' ],
                'selector' =>
                    '{{WRAPPER}} .droit-share-buttons-wrapper {{CURRENT_ITEM}}.droit-share-icon',
            ]
        );
        
        $repeater->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'label' => __( 'Typography', 'droit-addons' ),
				'selector' => '{{WRAPPER}} .dl_social_icon.dl_social_ixon_style_1.droit-share-buttons-wrapper',
			]
		);

        $repeater->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => '_dl_share_buttons_icon_border',
                'label' => esc_html__('Border', 'droit-addons'),
                'selector' => '{{WRAPPER}} .droit-share-buttons-wrapper {{CURRENT_ITEM}}.droit-share-icon',
            ]
        );

        $repeater->add_control(
            '_dl_share_buttons_icon_border_radious',
            [
                'label' => esc_html__( 'Border Radius', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                     '{{WRAPPER}} .droit-share-buttons-wrapper {{CURRENT_ITEM}}.droit-share-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
  

		$repeater->end_controls_tab();
		

        $repeater->start_controls_tab( '_dl_share_buttons_repeat_hover_style',
            [ 
                'label' => esc_html__( 'Hover', 'droit-addons')
            ] 
        );

        $repeater->add_control(
            '_dl_share_buttons_icon_hover_color',
            [
                'label' => esc_html__( 'Color', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .droit-share-buttons-wrapper {{CURRENT_ITEM}}.droit-share-icon:hover i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .droit-share-buttons-wrapper {{CURRENT_ITEM}}.droit-share-icon:hover svg' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .droit-share-buttons-wrapper {{CURRENT_ITEM}}.droit-share-icon:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $repeater->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => '_dl_share_buttons_hover_bg_color',
                'label' => 'Color',
                'fields_options' => [
                    'background' => [
                        'label' => __( 'Background Color', 'droit-addons' ),
                    ],
                ],
                'types' => [ 'classic', 'gradient' ],
                'selector' =>
                    '{{WRAPPER}} .droit-share-buttons-wrapper {{CURRENT_ITEM}}.droit-share-icon:hover',
            ]
        );

        $repeater->end_controls_tab();
        

		$repeater->end_controls_tabs();

		$this->add_control(
			'_dl_share_buttons_lists',
			[
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default' => [
                    [
                        '_dl_share_buttons_label' => __( 'facebook', 'droit-addons' ),
                        '_dl_share_buttons_network' => 'facebook',
                        '_dl_share_buttons_selected_icon' => [
                            'value' => 'fab fa-facebook-f',
                            'library' => 'fa-solid',
                        ],
                    ],
                    [
                        '_dl_share_buttons_label' => __( 'Twitter', 'droit-addons' ),
                         '_dl_share_buttons_network' => 'twitter',
                        '_dl_share_buttons_selected_icon' => [
                            'value' => 'fab fa-twitter',
                            'library' => 'fa-solid',
                        ],
                    ],
                    [
                        '_dl_share_buttons_label' => __( 'Telegram', 'droit-addons' ),
                        '_dl_share_buttons_network' => 'telegram',
                        '_dl_share_buttons_selected_icon' => [
                            'value' => 'fab fa-telegram',
                            'library' => 'fa-solid',
                        ],
                    ],
                    [
                        '_dl_share_buttons_label' => __( 'Linkedin', 'droit-addons' ),
                        '_dl_share_buttons_network' => 'linkedin',
                        '_dl_share_buttons_selected_icon' => [
                            'value' => 'fab fa-linkedin-in',
                            'library' => 'fa-solid',
                        ],
                    ],
                    [
                        '_dl_share_buttons_label' => __( 'Instagram', 'droit-addons' ),
                        '_dl_share_buttons_network' => 'instagram',
                        '_dl_share_buttons_selected_icon' => [
                            'value' => 'fab fa-instagram',
                            'library' => 'fa-solid',
                        ],
                    ],
                ],
				'title_field' => '<i class="{{ _dl_share_buttons_selected_icon.value }}" aria-hidden="true"></i>',
			]
		);

        $this->end_controls_section();   
	}

    // share_buttons Content Skin other
    public function register_share_icons_buttons_skin_all_control(){
        $this->start_controls_section(
            '_dl_share_buttons_others_section',
            [
                'label' => esc_html__('Share Icons', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    $this->get_control_id('_share_buttons_skin!') => ['_skin_1']
                ]
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->start_controls_tabs( '_dl_share_buttons_repeat_tabs' );

        $repeater->start_controls_tab( '_dl_share_buttons_repeat_content',
            [ 
                'label' => esc_html__( 'Content', 'droit-addons'),
            ] 
        );

        $repeater->add_control(
            '_dl_share_buttons_network',
            [
                'label' => esc_html__( 'Social Network', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'facebook',
                'options' => [
                    'facebook'      => esc_html__( 'Facebook', 'droit-addons' ),
                    'twitter'       => esc_html__( 'Twitter', 'droit-addons' ),
                    'pinterest'     => esc_html__( 'Pinterest', 'droit-addons' ),
                    'instagram'    => esc_html__( 'Instagram', 'droit-addons' ),
                    'odnoklassniki' => esc_html__( 'Odnoklassniki', 'droit-addons' ),
                    'tumblr'        => esc_html__( 'Tumblr', 'droit-addons' ),
                    'linkedin'      => esc_html__( 'Linkedin', 'droit-addons' ),
                    'snapchat'        => esc_html__( 'Snapchat', 'droit-addons' ),
                    'vkontakte'     => esc_html__( 'Vkontakte', 'droit-addons' ),
                    'moimir'        => esc_html__( 'Moimir', 'droit-addons' ),
                    'flicker'        => esc_html__( 'Flicker', 'droit-addons' ),
                    'live journal'   => esc_html__( 'Live journal', 'droit-addons' ),
                    'blogger'       => esc_html__( 'Blogger', 'droit-addons' ),
                    'evernote'      => esc_html__( 'Evernote', 'droit-addons' ),
                    'reddit'        => esc_html__( 'Reddit', 'droit-addons' ),
                    'digg'          => esc_html__( 'Digg', 'droit-addons' ),
                    'delicious'     => esc_html__( 'Delicious', 'droit-addons' ),
                    'pocket'        => esc_html__( 'Pocket', 'droit-addons' ),
                    'surfingbird'   => esc_html__( 'Surfingbird', 'droit-addons' ),
                    'stumbleupon'   => esc_html__( 'Stumbleupon', 'droit-addons' ),
                    'liveinternet'  => esc_html__( 'Liveinternet', 'droit-addons' ),
                    'instapaper'    => esc_html__( 'Instapaper', 'droit-addons' ),
                    'xing'          => esc_html__( 'Xing', 'droit-addons' ),
                    'buffer'        => esc_html__( 'Buffer', 'droit-addons' ),
                    'wordpress'     => esc_html__( 'WordPress', 'droit-addons' ),
                    'renren'        => esc_html__( 'Renren', 'droit-addons' ),
                    'weibo'         => esc_html__( 'Weibo', 'droit-addons' ),
                    'baidu'         => esc_html__( 'Baidu', 'droit-addons' ),
                    'skype'         => esc_html__( 'Skype', 'droit-addons' ),
                    'telegram'      => esc_html__( 'Telegram', 'droit-addons' ),
                    'viber'         => esc_html__( 'Viber', 'droit-addons' ),
                    'whatsapp'      => esc_html__( 'Whatsapp', 'droit-addons' ),
                    'line'          => esc_html__( 'Line', 'droit-addons' ),
                ],
            ]
        );

        $repeater->add_control(
            '_dl_share_buttons_icon_show',
            [
                'label'        => esc_html__('Enable Icon', 'droit-addons'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'return_value' => 'yes',
            ]
        );

        $repeater->add_control(
            '_dl_share_buttons_selected_icon',
            [
                'label' => __( 'Icon', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fab fa-facebook-f',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    $this->get_control_id( '_dl_share_buttons_icon_show' ) => [ 'yes' ],
                ],
            ]
        );

        $repeater->end_controls_tab();

        $repeater->start_controls_tab( '_dl_share_buttons_repeat_style',
            [ 
                'label' => esc_html__( 'Style', 'droit-addons')
            ] 
        );

        $repeater->add_control(
            '_dl_share_buttons_icon_color',
            [
                'label'     => esc_html__( 'Color', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .droit-share-buttons-wrapper {{CURRENT_ITEM}}.droit-share-icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .droit-share-buttons-wrapper {{CURRENT_ITEM}}.droit-share-icon svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $repeater->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => '_dl_share_buttons_bg_color',
                'label' => 'Color',
                'fields_options' => [
                    'background' => [
                        'label' => __( 'Background Color', 'droit-addons' ),
                    ],
                ],
                'types' => [ 'classic', 'gradient' ],
                'selector' =>
                    '{{WRAPPER}} .droit-share-buttons-wrapper {{CURRENT_ITEM}}.droit-share-icon',
            ]
        );

        $repeater->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => '_dl_share_buttons_icon_border',
                'label'    => esc_html__('Border', 'droit-addons'),
                'selector' => '{{WRAPPER}} .droit-share-buttons-wrapper {{CURRENT_ITEM}}.droit-share-icon',
            ]
        );

        $repeater->add_control(
            '_dl_share_buttons_icon_border_radious',
            [
                'label'      => esc_html__( 'Border Radius', 'droit-addons' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                     '{{WRAPPER}} .droit-share-buttons-wrapper {{CURRENT_ITEM}}.droit-share-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $repeater->end_controls_tab();
        

        $repeater->start_controls_tab( '_dl_share_buttons_repeat_hover_style',
            [ 
                'label' => esc_html__( 'Hover', 'droit-addons')
            ] 
        );

        $repeater->add_control(
            '_dl_share_buttons_icon_hover_color',
            [
                'label'     => esc_html__( 'Color', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .droit-share-buttons-wrapper {{CURRENT_ITEM}}.droit-share-icon:hover i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .droit-share-buttons-wrapper {{CURRENT_ITEM}}.droit-share-icon:hover svg' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .droit-share-buttons-wrapper {{CURRENT_ITEM}}.droit-share-icon:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $repeater->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => '_dl_share_buttons_hover_bg_color',
                'label' => 'Color',
                'fields_options' => [
                    'background' => [
                        'label' => __( 'Background Color', 'droit-addons' ),
                    ],
                ],
                'types' => [ 'classic', 'gradient' ],
                'selector' =>
                    '{{WRAPPER}} .droit-share-buttons-wrapper {{CURRENT_ITEM}}.droit-share-icon:hover',
            ]
        );

        $repeater->end_controls_tab();
        

        $repeater->end_controls_tabs();

        $this->add_control(
            '_dl_share_buttons_other_lists',
            [
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default' => [
                    [
                        '_dl_share_buttons_label' => __( 'facebook', 'droit-addons' ),
                        '_dl_share_buttons_network' => 'facebook',
                        '_dl_share_buttons_selected_icon' => [
                            'value' => 'fab fa-facebook-f',
                            'library' => 'fa-solid',
                        ],
                    ],
                    [
                        '_dl_share_buttons_label' => __( 'Twitter', 'droit-addons' ),
                         '_dl_share_buttons_network' => 'twitter',
                        '_dl_share_buttons_selected_icon' => [
                            'value' => 'fab fa-twitter',
                            'library' => 'fa-solid',
                        ],
                    ],
                    [
                        '_dl_share_buttons_label' => __( 'Telegram', 'droit-addons' ),
                        '_dl_share_buttons_network' => 'telegram',
                        '_dl_share_buttons_selected_icon' => [
                            'value' => 'fab fa-telegram',
                            'library' => 'fa-solid',
                        ],
                    ],
                    [
                        '_dl_share_buttons_label' => __( 'Linkedin', 'droit-addons' ),
                        '_dl_share_buttons_network' => 'linkedin',
                        '_dl_share_buttons_selected_icon' => [
                            'value' => 'fab fa-linkedin-in',
                            'library' => 'fa-solid',
                        ],
                    ],
                    [
                        '_dl_share_buttons_label' => __( 'Instagram', 'droit-addons' ),
                        '_dl_share_buttons_network' => 'instagram',
                        '_dl_share_buttons_selected_icon' => [
                            'value' => 'fab fa-instagram',
                            'library' => 'fa-solid',
                        ],
                    ],
                ],
                'title_field' => '<i class="{{ _dl_share_buttons_selected_icon.value }}" aria-hidden="true"></i>',
            ]
        );

        $this->end_controls_section();   
    }

	//Icon
	public function _droit_register_share_buttons_icon_style_controls(){
		$this->start_controls_section(
            '_dl_share_buttons_style_icon',
            [
                'label' => esc_html__('Icon', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'dl_share_button_typography',
				'label' => __( 'Typography', 'plugin-domain' ),
				'selector' => '{{WRAPPER}} .dl_social_icon.dl_social_ixon_style_1.droit-share-buttons-wrapper a',
			]
		);
        
        $this->add_responsive_control(
            '_dl_share_buttons_icon_top_spacing',
            [
                'label' => __('Icon Top Spacing', 'droit-addons'),
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
                    '{{WRAPPER}} .droit-share-buttons-wrapper .droit-share-icon i' => 'top: {{SIZE}}{{UNIT}};'
                ],
            ]);

        $this->add_responsive_control(
        '_dl_share_buttons_icon_size',
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
                '{{WRAPPER}} .droit-share-buttons-wrapper .droit-share-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                '{{WRAPPER}} .droit-share_buttons-items .droit-share-icon svg' => 'width: {{SIZE}}{{UNIT}};',
            ],
            
        ]);

        $this->add_responsive_control(
            '_dl_share_buttons_icon_padding',
            [
                'label' => esc_html__( 'Padding', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                     '{{WRAPPER}} .dl_social_icon.dl_social_ixon_style_1 .dl_social_btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
			'dl_icon_height',
			[
				'label' => __( 'Height', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 5,
					],
				],
				
				'selectors' => [
					'{{WRAPPER}} .dl_social_icon.dl_social_ixon_style_1 .dl_social_btn' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
			'dl_icon_width',
			[
				'label' => __( 'Width', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 1,
					],
				],
				
				'selectors' => [
					'{{WRAPPER}} .dl_social_icon.dl_social_ixon_style_1 .dl_social_btn' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
        
        $this->add_responsive_control(
            '_dl_share_buttons_icon_spacing',
            [
                'label' => __('Spacing', 'droit-addons'),
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
                    '{{WRAPPER}} .dl_social_icon.dl_social_ixon_style_1.droit-share-buttons-wrapper a' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]);

        $this->end_controls_section();
	}

    //Html render
    protected function render(){
        $settings = $this->get_settings_for_display();

        $this->_first_share_buttons_layout();

    }

    // share_buttons first
    protected function _first_share_buttons_layout(){
        $settings = $this->get_settings_for_display();
    ?>
    <div class="dl_social_icon dl_social_ixon_style_1 droit-share-buttons-wrapper">
        <?php foreach ($this->get_share_settings('_dl_share_buttons_lists') as $index => $item):
            $item_count = $index + 1;
            $migrated = isset( $item['__fa4_migrated']['_dl_share_buttons_selected_icon'] );

            if ( ! isset( $item['icon'] ) && ! \ELEMENTOR\Icons_Manager::is_migration_allowed() ) {
                $item['icon'] = 'fas fa-check';
            }

            $is_new = empty( $item['icon'] ) && \ELEMENTOR\Icons_Manager::is_migration_allowed();
            $has_icon = ( ! $is_new || ! empty( $item['_dl_share_buttons_selected_icon']['value'] ) );

            $has_title_text = ! empty( $item['_dl_share_buttons_title'] );
            $has_dec_text   = ! empty( $item['_dl_share_buttons_description_text'] );
            $has_image      = ! empty( $item['_dl_share_buttons_image']['url'] );

            $columns = !empty($this->get_share_settings('_share_buttons_columns')) ? $this->get_share_settings('_share_buttons_columns') : 3;


            if ( ! empty( $item['_dl_share_buttons_link']['url'] ) ) {
                $this->add_link_attributes( '_dl_share_buttons_link', $item['_dl_share_buttons_link'] );
            }
            $link_attributes = $this->get_render_attribute_string( '_dl_share_buttons_link' );
            $tab_title_setting_key = $this->get_repeater_setting_key( '_dl_faq_list', '_dl_share_buttons_lists', $index );
            $this->add_render_attribute( $tab_title_setting_key, [
                
                'class' => [ "dl_social_btn", "droit-share-icon", "elementor-repeater-item-{$item['_id']}", esc_attr((preg_replace('/[#$%^&*()+=\-\[\]\';,.\/{}|":<>?~\\\\ ]/', '', strtolower($item['_dl_share_buttons_network'])))) ],
                'data-item' => $item_count,
            ] );
         ?>
         <a <?php echo $this->get_render_attribute_string( $tab_title_setting_key ); ?> data-social="<?php echo  esc_attr((preg_replace('/[#$%^&*()+=\-\[\]\';,.\/{}|":<>?~\\\\ ]/', '', strtolower($item['_dl_share_buttons_network']))))?>" href="#"> 
            <?php \ELEMENTOR\Icons_Manager::render_icon( $item['_dl_share_buttons_selected_icon'] ); ?> 
            <?php if (!empty($item['_dl_share_buttons_label'])): ?>
                <?php echo esc_html($item['_dl_share_buttons_label']); ?>
            <?php endif; ?>
        </a>
            
        <?php endforeach; ?>
    </div>
  <?php }

    protected function content_template(){}
}