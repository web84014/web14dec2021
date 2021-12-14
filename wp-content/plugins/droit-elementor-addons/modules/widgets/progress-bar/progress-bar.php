<?php
namespace DROIT_ELEMENTOR\Widgets;

class Droit_Addons_Progress_Bar extends \Elementor\Widget_Base {

    public function get_name()
    {
        return 'droit-progress-bar';
    }

    public function get_title()
    {
        return esc_html__('Progress Bar', 'droit-addons');
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
        $this->dl_progress_bar_content();
        $this->dl_progress_bar_style();


    }

    public function dl_progress_bar_content() {
        $this->start_controls_section(
            '_dl_progress_bar_content',
            [
                'label' => __( 'Content', 'droit-addons' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                
            ]
        );

        $this->add_control(
			'dl_number_input_field',
			[
				'label' => __( 'Progress', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 100,
				'step' => 1,
				'default' => 82,
			]
		);

        $this->add_control(
			'dl_number_input_width',
			[
				'label' => __( 'Progress Bar Width', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 350,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} svg.radial-progress' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'dl_number_input_stroke_width',
			[
				'label' => __( 'Stroke Width', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 350,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} svg.radial-progress circle' => 'stroke-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
        
        $this->add_control(
			'dl_number_input_radius',
			[
				'label' => __( 'Radius', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 10,
				'max' => 200,
				'step' => 1,
				'default' => 35,
			]
		);
        
        $this->end_controls_section();
    }
    
    public function dl_progress_bar_style() {
        $this->start_controls_section(
            '_dl_progress_bar_style',
            [
                'label' => __( 'Style', 'droit-addons' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                
            ]
        );

		$this->add_control(
			'dl_progress_bar_all_alignment',
			[
				'label'     => __('Alignment', 'droit-addons'),
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
					'{{WRAPPER}} .dl-row'   => 'text-align: {{VALUE}};',
				],
			]
		);

        $this->add_control(
			'dl_progress_bar_incomplete_color',
			[
				'label' => __( 'Incomplete Color', 'droit-addons' ),
				'type'  => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} svg.radial-progress circle.incomplete' => 'stroke: {{VALUE}}',
				],
			]
		);
        
        $this->add_control(
			'dl_progress_bar_complete_color',
			[
				'label' => __( 'Complete Color', 'droit-addons' ),
				'type'  => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} svg.radial-progress circle.complete' => 'stroke: {{VALUE}}',
				],
			]
		);
        
        $this->add_control(
			'dl_progress_bar_fill_color',
			[
				'label' => __( 'Completed Text Color', 'droit-addons' ),
				'type'  => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dl-percentage' => 'fill: {{VALUE}}',
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
		<div class="dl-row">
			<svg class="radial-progress" data-percentage="<?php echo esc_html($dl_number_input_field); ?>" viewBox="0 0 80 80">
				<circle class="incomplete" cx="40" cy="40" r="<?php echo esc_html($dl_number_input_radius); ?>"></circle>
				<circle class="complete" cx="40" cy="40" r="<?php echo esc_html($dl_number_input_radius); ?>" ></circle>
				<text class="dl-percentage" x="50%" y="57%" transform="matrix(0, 1, -1, 0, 80, 0)"><?php echo esc_html($dl_number_input_field); ?>%</text>  
			</svg>
		</div>
        <?php

    }

    protected function content_template(){}


}