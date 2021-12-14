<?php

namespace DROIT_ELEMENTOR\Widgets;

if (!defined('ABSPATH')) {exit;}

class Droit_Addons_Animated_Text extends \Elementor\Widget_Base {

    public function get_name() {
        return 'droit-animated_text';
    }
    
    public function get_title() {
        return esc_html__( 'Animated Text', 'droit-addons' );
    }

    public function get_icon() {
        return 'dlicons-animated-title addons-icon';
    }

    public function get_keywords() {
       return [ 
            'animated heading',
            'heading',
            'animatedtitle',
            'animated text',
            'toggle',
            'droit animatedtitle',
            'dl animatedtitle',
            'dl advanced animatedtitle',
            'panel',
            'navigation',
            'group', 'Animated title content',
            'product Animated title',
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

        $this->_droit_register_dl_animatedtitle_content_controls();
        $this->_droit_register_dl_animated_text_general_style_controls();
        $this->_droit_register_dl_animated_text_title_style_controls();

    }
   
	//General
	public function _droit_register_dl_animated_text_general_style_controls(){
		$this->start_controls_section(
            '_dl_animated_text_style_general',
            [
                'label' => esc_html__('General', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_responsive_control(
            '_dl_animated_text_margin',
            [
                'label'   => esc_html__('Margin', 'droit-addons'),
                'type'    => \Elementor\Controls_Manager::SLIDER,
                'default' => [
                    'size' => '',
                    'unit' => 'px',
                ],
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 200,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl_animated_title_section .dl_animated_title_list .dl_animated_headline' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
    
        $this->end_controls_section();
    }
    
    //Content Section
    public function _droit_register_dl_animatedtitle_content_controls(){
        $this->start_controls_section(
            '_dl_animatedtitle_content_section',
            [
                'label' => __( 'Content', 'droit-addons' ),
            ]
        );

        $this->add_control(
            '_dl_animatedtitl_animation_type',
            [
                'label'   => __('Animation Type', 'droit-addons'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'rotate-1',
                'options' => [
                    'rotate-1'         => __('Rotate 1', 'droit-addons'),
                    'letters type'     => __('Type', 'droit-addons'),
                    'letters rotate-2' => __('Rotate 2', 'droit-addons'),
                    'clip'             => __('Clip', 'droit-addons'),
                    'loading-bar'      => __('Loading Bar', 'droit-addons'),
                    'slide'            => __('Slide', 'droit-addons'),
                    'zoom'             => __('Zoom', 'droit-addons'),
                    'letters rotate-3' => __('Rotate 3', 'droit-addons'),
                    'letters scale'    => __('Scale', 'droit-addons'),
                    'push'             => __('Push', 'droit-addons'),
                ],
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            '_dl_animatedtitle_before_text',
            [
                'label'       => __( 'Before Text', 'droit-addons' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => __( 'Build project with <br> Droit Elementor', 'droit-addons' ),
                'placeholder' => __( 'Before Text', 'droit-addons' ),
                'label_block' => true,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->start_controls_tabs( '_dl_animated_heading_repeat_tabs' );
  
        $repeater->add_control(
            '_dl_animated_heading_repeater_text',
            [
                'label'       => __( 'Text', 'droit-addons' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => __( 'Droit Addons', 'droit-addons' ),
                'placeholder' => __( 'Enter your title', 'droit-addons' ),
                'label_block' => true,
                'separator'   => 'before',
            ]
        );
                
        $repeater->end_controls_tabs();
         $this->add_control(
                '_dl_animated_heading_repeater',
                [
                    'type' => \Elementor\Controls_Manager::REPEATER,
                    'fields'      => $repeater->get_controls(),
                    
                    'default' => [
                        [
                            '_dl_animated_heading_repeater_text' => __( 'Droit Addons', 'droit-addons' ),
                        ],
                        [
                            '_dl_animated_heading_repeater_text' => __( 'Droit Themes', 'droit-addons' ),
                        ],
                        [
                            '_dl_animated_heading_repeater_text' => __( 'Droit Plugins', 'droit-addons' ),
                        ],
                        
                    ],
                    
                    'title_field' => '{{ _dl_animated_heading_repeater_text }}',
                ]
            );
    
    $this->end_controls_section();
     //Content  End  
}

	//banner Title Style
	public function _droit_register_dl_animated_text_title_style_controls() {
		$this->start_controls_section(
            '_dl_animated_title_style_settings',
            [
                'label' => esc_html__('Content Style', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => '_dl_animated_text_title_typography',
                'selector' => '{{WRAPPER}} .dl_animated_headline span',
            ]
        );

        $this->add_control(
            '_dl_animated_text_text_color',
            [
                'label'     => esc_html__('Text Color', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .dl_animated_headline span' => 'color: {{VALUE}};',
                ],
            ]
        );
		
        $this->end_controls_section();

        $this->start_controls_section(
            '_dl_animated_text_title_style_settings',
            [
                'label' => esc_html__('Animated Text Style', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => '_dl_animation_text_title_typography',
                'selector' => '{{WRAPPER}} .dl_animated_headline .dl_words_wrapper',
            ]
        );

        $this->add_control(
            '_dl_animation_text_text_color',
            [
                'label'     => esc_html__('Text Color', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .dl_animated_headline .dl_words_wrapper' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
			'_dl_animation_title_bottom_space',
			[
				'label'  => __( 'Spacing', 'droit-addons' ),
				'type'   => \Elementor\Controls_Manager::SLIDER,
				'range'  => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .dl_animated_headline .dl_words_wrapper' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
        $this->end_controls_section();
	}

    //Html render
    protected function render(){
        $settings = $this->get_settings_for_display();
        extract($settings);
        ?>
        <div class="dl_animated_title_section">
            <div class="dl_animated_title_list dl_cd_intro dl_animated_title_style_01">
                <h3 class="dl_animated_headline <?php if(!empty($_dl_animatedtitl_animation_type))echo esc_html($_dl_animatedtitl_animation_type); ?>" data-animation-delay="2500">
                    <span><?php if(!empty($_dl_animatedtitle_before_text))echo wp_kses_post($_dl_animatedtitle_before_text); ?></span>
                    <span class="dl_words_wrapper">
                        <?php foreach ($_dl_animated_heading_repeater as $index => $item): 
                        $item_count = $index + 1;
                        $is_visible = 1 === $item_count ? 'is-visible' : '';
    
                        $tab_heading_setting_key = $this->get_repeater_setting_key( '_dl_animated_heading_repeater_text', '_dl_animated_heading_repeater', $index );
                        $this->add_render_attribute( $tab_heading_setting_key, [
                            'class'     => [ 'dl_animated_heading_color',  $is_visible, "elementor-repeater-item-{$item['_id']}" ],
                            'data-item' => $item_count,
                        ] );
                        ?>
                        <b <?php echo $this->get_render_attribute_string( $tab_heading_setting_key ); ?> ><?php echo $item['_dl_animated_heading_repeater_text']; ?></b>
                    <?php endforeach; ?>
                    </span>
                </h3>
            </div>
        </div>  
        <?php 
    }
      
    protected function content_template(){}
}