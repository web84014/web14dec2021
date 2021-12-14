<?php
namespace DROIT_ELEMENTOR\Widgets;

if (!defined('ABSPATH')) {exit;}

class Droit_Addons_Bar_Chart extends \Elementor\Widget_Base {

    public function get_name() {
        return 'droit-bar-chart';
    }

    public function get_title() {
        return esc_html__( 'Bar Chart', 'droit-addons' );
    }

    public function get_icon() {
        return 'dlpro dlpro-bar-chart addons-icon';
    }

    public function get_categories() {
        return [ 'droit_addons' ];
    }

    public function get_keywords() {
        return [
            'Bar Chart',
            'barchart',
            'bar chart',
            'bar-chart',
            'Droit Bar Chart',
            'droit-bar-chart',
            'droit bar chart',
            'droit',
            'dl',
            'addons',
            'addon',
        ];
    }

    protected function _register_controls() {
        // init custom hook
        do_action('dl_widgets/bar-chart/register_control/start', $this);

        // layout
        $this->dlbarchart_content();
        $this->dlbarchart_settings();

        // for style controls
        $this->dlstyle();

        do_action('dl_widgets/bar-chart/register_control/end', $this);

        do_action('dl_widget/section/style/custom_css', $this);
    }

    /** 
     * integrate chart shettings
     * dlbarchat
     * return settings key with value
     */
    protected function dlbarchart_content(){
        $this->start_controls_section(
            'dl_barchart_content_section',
            array(
                'label' => esc_html__( 'Bar Chart Content', 'droit-addons' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
			'dl_barchart_type',
			[
				'label'   => __( 'Chart Type', 'droit-addons' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
                    'x'         => __( 'Vertical', 'droit-addons' ),
					'y'         => __( 'Horizontal', 'droit-addons' ),                    
				],
                'default' => 'x',
			]
		);

        $this->add_control(
			'dl_barchart_labels',
			[
				'label'         => __( 'Chart Labels', 'droit-addons' ),
				'type'          => \Elementor\Controls_Manager::TEXT,
                'label_block'   => true,
                'default'       => 'January, February, March, April, May, June',
				'placeholder'   => __( 'January, February, March, April', 'droit-addons' ),
                'description'   => __('Please enter multiple labes with ( , ) separator, Exmple: January, February, March, April etc.', 'droit-addons'),
			]
		);

        $repeater = new \Elementor\Repeater();
        $repeater->start_controls_tabs('dl_barchart_dataset_tabs');

        $repeater->start_controls_tab('dl_barchart_dataset_tab',
            [
                'label' => esc_html__( 'Dataset', 'droit-addons' ),
            ]
        );

        $repeater->add_control(
			'dl_barchart_dataset_label',
			[
				'label'         => __( 'Label', 'droit-addons' ),
				'type'          => \Elementor\Controls_Manager::TEXT,
				'label_block'   => true,
                'default'       => 'Droit Addons Free',
				'placeholder'   => __( 'Droit Addons', 'droit-addons' ),
				'description' 	=> __( 'Specifies the data set label of the chart', 'droit-addons' ),
			]
		);
		$repeater->add_control(
			'dl_barchart_dataset',
			[
				'label'         => __( 'Data Values', 'droit-addons' ),
				'type'          => \Elementor\Controls_Manager::TEXT,
                'default'       => '6, 9, 5, 2, 7',
                'placeholder'   => __( '6, 9, 5, 2, 7', 'droit-addons' ),
				'description' 	=> __( 'Please write data values with ( , ) separator. Example 1, 2, 5, 7 etc.', 'droit-addons' ),
			]
		);  
        $repeater->end_controls_tab(); // end dataset

        // start color style here
        $repeater->start_controls_tab('dl_barchart_dataset_style',
            [
                'label' => esc_html__( 'Style', 'droit-addons' ),
            ]
        );

        $repeater->add_control(
            'dl_dataset_bg_color',
            [
                'label'   => __( 'Background Color', 'droit-addons' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffe0e6'
            ]
        );
        $repeater->add_control(
            'dl_dataset_bg_hover_color',
            [
                'label'   => __( 'Background Hover Color', 'droit-addons' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
                'default' => '#FFE0E6'
            ]
        );
        $repeater->add_control(
            'dl_dataset_border_color',
            [
                'label'   => __( 'Border Color', 'droit-addons' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
                'default' => '#36A2EB'
            ]
        );
        $repeater->add_control(
            'dl_dataset_border_hover_color',
            [
                'label'   => __( 'Border Hover Color', 'droit-addons' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
                'default' => '#75CFCF'
            ]
        );
        $repeater->add_control(
            'dl_dataset_border_width',
            [
                'label'   => __( 'Border Width', 'droit-addons' ),
				'type'          => \Elementor\Controls_Manager::SLIDER,
                'default'   => [
                    'size' => '2',
                    'unit' => 'px',
                ],
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
            ]
        );

        $repeater->end_controls_tab(); // end dataset style
        $repeater->end_controls_tabs(); // end tabs

        $this->add_control(
			'dl_barchart_dataset_list',
			[
				'label'     	=> __( 'Chart Data', 'droit-addons' ),
				'type'      	=> \Elementor\Controls_Manager::REPEATER,
				'fields'    	=> $repeater->get_controls(),
				'default'   => [
					[
						'dl_barchart_dataset_label'      => 'Droit Addons Free',
						'dl_barchart_dataset'            => '4,2,7,2,6,3',
                        'dl_dataset_bg_color'           => '#EDDB9E',
                        'dl_dataset_bg_hover_color'     => '#DEE5CC',
                        'dl_dataset_border_color'       => '#9FD3F6',
                        'dl_dataset_border_hover_color' => '#B5F1F1',
                        'dl_dataset_border_width'       => '1',
					],
					[
						'dl_barchart_dataset_label'      => 'Droit Addons Pro',
						'dl_barchart_dataset'            => '9,2,7,3,4,8',
                        'dl_dataset_bg_color'           => '#ED8C9F',
                        'dl_dataset_bg_hover_color'     => '#EEA9E0',
                        'dl_dataset_border_color'       => '#B3FFEA',
                        'dl_dataset_border_hover_color' => '#B5A9F0',
                        'dl_dataset_border_width'       => '1',
					],
				],
				'title_field' 	=> ' {{{ dl_barchart_dataset_label }}}',
			]
		);

        $this->end_controls_section();
    }

    /**
     * dlbarchart_settings
     * returns all chart settings
     * key&values
     */
    protected function dlbarchart_settings() {
        $this->start_controls_section(
            'dl_barchart_settings_section',
            array(
                'label' => esc_html__( 'Chart Settings', 'droit-addons' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );
        $this->add_control(
			'dl_barchart_height',
			[
				'label'         => __( 'Height', 'droit-addons' ),
				'type'          => \Elementor\Controls_Manager::SLIDER,
                'default'   => [
                    'size' => '400',
                    'unit' => 'px',
                ],
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 150,
                        'max' => 1500,
                        'step' => 1,
                    ],
                ],
                'description'   => __( 'Please set chart height.', 'droit-addons' ),
			]
		);
        $this->add_control(
			'dl_barchart_x_axes_grid_line',
			[
				'label'         => __( 'Show X Axes Grid Line?', 'droit-addons' ),
				'type'          => \Elementor\Controls_Manager::SWITCHER,
				'default'       => 'yes',
                'return_value'  => 'yes',
                'description' => __( 'Turn off the switch if you want to don\'t see X axes grid line of the chart!', 'droit-addons' )
			]
		);
        $this->add_control(
			'dl_barchart_y_axes_grid_line',
			[
				'label'         => __( 'Show Y Axes Grid Line?', 'droit-addons' ),
				'type'          => \Elementor\Controls_Manager::SWITCHER,
				'default'       => 'yes',
                'return_value'  => 'yes',
                'description' => __( 'Turn off the switch if you want to don\t see Y axes grid line of the chart!', 'droit-addons' )
			]
		);
        $this->add_control(
			'dl_barchart_x_axes_labes',
			[
				'label'         => __( 'Show X Axes Labes?', 'droit-addons' ),
				'type'          => \Elementor\Controls_Manager::SWITCHER,
				'default'       => 'yes',
                'return_value'  => 'yes',
                'description' => __( 'Turn off the switch if you want to don\t see X axes labes of the chart!', 'droit-addons' )
			]
		);
        $this->add_control(
			'dl_barchart_y_axes_labes',
			[
				'label'         => __( 'Show Y Axes Labes?', 'droit-addons' ),
				'type'          => \Elementor\Controls_Manager::SWITCHER,
				'default'       => 'yes',
                'return_value'  => 'yes',
                'description' => __( 'Turn off the switch if you want to don\t see Y axes labes of the chart!', 'droit-addons' )
			]
		);
        $this->add_control(
			'dl_barchart_show_tooltips',
			[
				'label'         => __( 'Show Tooltips?', 'droit-addons' ),
				'type'          => \Elementor\Controls_Manager::SWITCHER,
				'default'       => 'yes',
                'return_value'  => 'yes',
                'description' => __( 'Turn off the switch if you want to don\t see tooltips of the chart!', 'droit-addons' )
			]
		);
        $this->add_control(
			'dl_barchart_scale_axes_size',
			[
				'label'         => __( 'Set Scale Axes', 'droit-addons' ),
				'type'          => \Elementor\Controls_Manager::NUMBER,
				'min'           => 10,
				'max'           => 100,
				'step'          => 10,
				'default'       => 10,
                'description'   => __( 'Please set maximum number of chart scale axes range.', 'droit-addons' )
			]
		);
        $this->add_control(
			'dl_barchart_scale_step',
			[
				'label'         => __( 'Set Scale Step', 'droit-addons' ),
				'type'          => \Elementor\Controls_Manager::NUMBER,
				'min'           => 1,
				'max'           => 100,
				'step'          => 1,
				'default'       => 1,
                'description'   => __( 'Please set maximum number of chart scale step.', 'droit-addons' )
			]
		);

        // for legend
        $this->add_control(
			'dl_barchat_legend_settings',
			[
				'label'     => __( 'Legend', 'droit-addons' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        $this->add_control(
			'dl_barchart_show_title',
			[
				'label'         => __( 'Show Chart Title?', 'droit-addons' ),
				'type'          => \Elementor\Controls_Manager::SWITCHER,
				'default'       => 'yes',
                'return_value'  => 'yes',
                'description' => __('Turn off the switch if you want don\t see the title of the chart!', 'droit-addons')
			]
		);
        
        $this->add_control(
			'dl_barchart_title',
			[
				'label'         => __( 'Chart Title', 'droit-addons' ),
				'type'          => \Elementor\Controls_Manager::TEXT,
                'label_block'   => true,
				'placeholder'   => __( 'Droit Bar Charts', 'droit-addons' ),
				'default'       => 'Droit Bar Charts',
                'description'   => __('Please enter chart title here', 'droit-addons'),
                'condition'     => [ 'dl_barchart_show_title' => 'yes' ]
			]
		);

        $this->add_control(
			'dl_barchart_title_aligment',
			[
				'label'   => __( 'Title Position', 'droit-addons' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
                    'start'  => __( 'Start', 'droit-addons' ),
                    'center' => __( 'Center', 'droit-addons' ),
					'end'    => __( 'End', 'droit-addons' ),
                    
				],
                'default'     => 'center',
                'description' => __( 'Set title position of the chart legend.', 'droit-addons' ),
                'condition'   => [ 'dl_barchart_show_title' => 'yes' ]
			]
		);

        $this->add_control(
			'dl_barchart_show_legend',
			[
				'label'         => __( 'Show Legend?', 'droit-addons' ),
				'type'          => \Elementor\Controls_Manager::SWITCHER,
				'default'       => 'yes',
                'return_value'  => 'yes',
                'description' => __( 'Turn off the switch if you want to don\'t see legend of the chart!', 'droit-addons' )
			]
		);

        $this->add_control(
			'dl_barchart_lagend_type',
			[
				'label'   => __( 'Legend Type', 'droit-addons' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
                    'rectangle' => __( 'Rectangle Style', 'droit-addons' ),
					'point'     => __( 'Point Style', 'droit-addons' ),
                    
				],
                'default' => 'rectangle',
                'condition' => ['dl_barchart_show_legend' => 'yes']
			]
		);

        $this->add_control(
			'dl_barchart_lagend_position',
			[
				'label'   => __( 'Legend Position', 'droit-addons' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
                    'top'       => __( 'Top', 'droit-addons' ),
					'right'     => __( 'Right', 'droit-addons' ),
					'bottom'    => __( 'Bottom', 'droit-addons' ),
					'left'      => __( 'Left', 'droit-addons' ),
                    
				],
                'default' => 'top',
                'condition' => ['dl_barchart_show_legend' => 'yes']
			]
		);

    }

    /**
     * dlstyle
     * return styles with key&value
     */
    protected function dlstyle() {
        # code...
    }

    /**
     * load html preview
     * render
     */
    protected function render() { 
        $settings = $this->get_settings_for_display();
        extract( $settings ); 

        $id = $this->get_id(); 

        // generate datasets
        $datasets = [];
        if( $dl_barchart_dataset_list ){
            foreach( $dl_barchart_dataset_list as $item ) {
                $bgColor            = [];
                $bgHoverColor       = [];
                $borderColor        = [];
                $borderHoverColor   = [];
                $bgColor[]          = ($item['dl_dataset_bg_color']) ?? '';
                $bgHoverColor[]     = ($item['dl_dataset_bg_hover_color']) ?? '';
                $borderColor[]      = ($item['dl_dataset_border_color']) ?? '';
                $borderHoverColor[] = ($item['dl_dataset_border_hover_color']) ?? '';

                $item_dat['label']                  = ($item['dl_barchart_dataset_label']) ?? '';
                $item_dat['data']                   = ($item['dl_barchart_dataset']) ? explode(',', $item['dl_barchart_dataset']) : [];
                $item_dat['backgroundColor']        = $bgColor;
                $item_dat['hoverBackgroundColor']   = $bgHoverColor;
                $item_dat['borderColor']            = $borderColor;
                $item_dat['hoverBorderColor']       = $borderHoverColor;
                $item_dat['borderWidth']            = ($item['dl_dataset_border_width']['size']) ?? 0;

                $datasets[] = $item_dat;
            }
        }

        $barchart_settings = [
            'chart_type'    => $dl_barchart_type,
            'labels'        => ($dl_barchart_labels) ? explode( ',', $dl_barchart_labels ) : [],
            'datasets'      => $datasets,
            // for settings
            'x_axes_grid_line'  => ($dl_barchart_x_axes_grid_line == 'yes') ? true : false,
            'y_axes_grid_line'  => ($dl_barchart_y_axes_grid_line == 'yes') ? true : false,
            'x_axes_labels'     => ($dl_barchart_x_axes_labes == 'yes' ) ? true : false,
            'y_axes_labels'     => ($dl_barchart_y_axes_labes == 'yes') ? true : false,
            'show_tooltips'     => ($dl_barchart_show_tooltips == 'yes') ? true : false,
            'set_scale_axes'    => $dl_barchart_scale_axes_size ?? 10,
            'set_scale_step'    => $dl_barchart_scale_step ?? 1,
            // for legend
            'show_title'        => ($dl_barchart_show_title == 'yes') ? true : false,
            'title'             => ($dl_barchart_title) ?? '',
            'title_position'    => ($dl_barchart_title_aligment) ?? '',
            'show_legend'       => ($dl_barchart_show_legend) ?? '',
            'legend_type'       => ($dl_barchart_lagend_type) ?? '',
            'legend_position'   => ($dl_barchart_lagend_position) ?? '',
        ];

        $cheight = ($dl_barchart_height) && ($dl_barchart_height['size']) ? $dl_barchart_height['size'] : 400;

    ?>
        <canvas class="droit-barchart" id="barchat-<?php echo esc_attr($id);?>" data-barchatid="<?php echo esc_attr($id);?>" data-settings='<?php echo json_encode($barchart_settings, true);?>' height="<?php echo $cheight;?>"></canvas>

    <?php

    }

    protected function content_template() {}

}