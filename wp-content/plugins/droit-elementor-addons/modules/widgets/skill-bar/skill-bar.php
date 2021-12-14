<?php
namespace DROIT_ELEMENTOR\Widgets;

class Droit_Addons_Skill_Bar extends \Elementor\Widget_Base {

    public function get_name()
    {
        return 'droit-skill-bar';
    }

    public function get_title()
    {
        return esc_html__( 'Skill Bar', 'droit-addons' );
    }

    public function get_icon()
    {
        return 'eicon-posts-grid addons-icon';
    }

    public function get_categories()
    {
        return ['droit_addons'];
    }

    public function get_keywords() {
        return [
            'Progress Bar',
            'Skill Bar',
            'Progress',
            'droit progress',
            'dl skill bar'
        ];
    }

    protected function _register_controls() {
        $this->dl_skill_bar_content();
        $this->dl_skill_general_style();
        $this->dl_skill_bar_style();
    }

    public function dl_skill_bar_content() {
        $this->start_controls_section(
            '_dl_skill_bar_content',
            [
                'label' => __( 'Content', 'droit-addons' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                
            ]
        );

        
        $repeater = new \Elementor\Repeater();

		$repeater->start_controls_tabs( 'dl_progressbar_repeat_tabs' );

		$repeater->start_controls_tab( 'dl_progressbar_repeat_content',
			[ 
				'label' => esc_html__( 'Content', 'droit-elementor-addons'),
			] 
		);

        $repeater->add_control(
            'dl_progressbar_name', [
                'label' => __('Skill Name', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __('Enter Name', 'droit-addons'),
                'default' => __('Enter Name', 'droit-addons'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
			'dl_progressbar_limit',
			[
				'label'     => esc_html__( 'Limit Display', 'droit-addons' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'min'       => 1,
				'max'       => 100,
			]
		);
        $repeater->add_control(
			'dl_progressbar_duration',
			[
				'label'     => esc_html__( 'Duration', 'droit-addons' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'min'       => 1,
				'max'       => 10000,
			]
		);

        $repeater->end_controls_tab();

        $repeater->start_controls_tab( 'dl_progressbar_repeat_style',
			[ 
				'label' => esc_html__( 'Style', 'droit-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			] 
		);

        $repeater->add_control(
			'dl_skill_title_color',
			[
				'label' => __( 'Skill Title', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .dl-progress-content p' => 'color: {{VALUE}}',
				],
			]
		);

        
        $repeater->add_control(
			'dl_skill_percent_color',
			[
				'label' => __( 'Percent Color', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .dl-progress .dl-progress-bar span' => 'color: {{VALUE}}',
				],
			]
		);

        
        $repeater->add_control(
			'dl_skill_complete_color',
			[
				'label' => __( 'Complete Bar Color', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .dl-progress' => 'background: {{VALUE}}',
				],
			]
		);

        $repeater->add_control(
			'dl_skill_incomplete_color',
			[
				'label' => __( 'Incomplete Bar Color', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .dl-progress .dl-progress-bar' => 'background: {{VALUE}}',
				],
			]
		);



        $repeater->end_controls_tab();

        $this->add_control(
            'dl_progressbar_list',
            [
                'label' => __('Progress Bar', 'droit-addons'),
                'show_label' => false,
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'dl_progressbar_name' => __('John Theme', 'droit-addons'),
                        'dl_progressbar_limit' => 75,
                        'dl_progressbar_duration' => 1200,
                    ],
                    [
                        'dl_progressbar_name' => __('John Theme', 'droit-addons'),
                        'dl_progressbar_limit' => 80,
                        'dl_progressbar_duration' => 1800,
                    ],
                    [
                        'dl_progressbar_name' => __('John Theme', 'droit-addons'),
                        'dl_progressbar_limit' => 50,
                        'dl_progressbar_duration' => 1300,
                    ],
                    [
                        'dl_progressbar_name' => __('John Theme', 'droit-addons'),
                        'dl_progressbar_limit' => 20,
                        'dl_progressbar_duration' => 1700,
                    ],

                ],
                'title_field' => '{{{ dl_progressbar_name }}}',
            ]
        );

        $this->end_controls_section();

    }

    public function dl_skill_general_style() {
        $this->start_controls_section(
            '_dl_skill_bar_general_style',
            [
                'label' => __( 'General', 'droit-addons' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                
            ]
        );

        $this->add_control(
			'dl_margin_bottom_progress_bar',
			[
				'label' => __( 'Spacing', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				
				'selectors' => [
					'{{WRAPPER}} .dl-progress-element' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
			'dl_margin_bottom_progress_width',
			[
				'label' => __( 'Skill Bar Height', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				
				'selectors' => [
					'{{WRAPPER}} .dl-progress-element .dl-progress' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);


        $this->add_control(
			'dl_dimension_border_radius',
			[
				'label' => __( 'Border Radius', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .dl-progress-element .dl-progress .dl-progress-bar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        $this->end_controls_section();
        
    } 
    
    public function dl_skill_bar_style() {
        $this->start_controls_section(
            '_dl_skill_bar_style',
            [
                'label' => __( 'Content', 'droit-addons' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'dl_content_typography',
				'label' => __( 'Title Typography', 'droit-addons' ),
				'selector' => '{{WRAPPER}} .dl-progress-content p',
			]
		);
        
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'dl_percent_typography',
				'label' => __( 'Percent Typography', 'droit-addons' ),
				'selector' => '{{WRAPPER}} .dl-progress-content .dl-count-tip',
			]
		);


        $this->add_control(
			'dl_position_top',
			[
				'label' => __( 'Top', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				
				'selectors' => [
					'{{WRAPPER}} .dl-progress-element .dl-progress-content' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);
        
        $this->add_control(
			'dl_position_left',
			[
				'label' => __( 'Left', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 500,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				
				'selectors' => [
					'{{WRAPPER}} .dl-progress-element .dl-progress-content' => 'left: {{SIZE}}{{UNIT}};',
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

        <?php foreach($dl_progressbar_list as $v){?>

        <div class="dl-progress-element <?php echo esc_attr('elementor-repeater-item-'.$v['_id']);?>">
            <div class="dl-progress">
                <div class="dl-progress-bar" role="progressbar" data-value="<?php echo esc_attr($v['dl_progressbar_limit']); ?>" data-min="0" data-max="100" data-duration="<?php echo esc_attr($v['dl_progressbar_duration']); ?>">
                <div class="dl-progress-content">
                    <p><?php echo esc_html_e($v['dl_progressbar_name'], 'droit-addons')?></p>
                    <span class="dl-count-tip"><span class="dl-counter"><?php echo esc_attr($v['dl_progressbar_limit']); ?></span>%</span>
                </div>  
                </div>
            </div>
        </div>
        <?php } ?>

        <?php

    }

    protected function content_template(){}


}
