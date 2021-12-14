<?php
namespace SaaslandCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Pricing Table
 */
class Pricing_table extends Widget_Base {
	public function get_name() {
		return 'saasland-pricing-table';
	}

	public function get_title() {
		return __( 'Pricing Table', 'saasland-hero' );
	}

	public function get_icon() {
		return 'eicon-price-list';
	}

	public function get_categories() {
		return [ 'saasland-elements' ];
	}

	public function get_style_depends() {
        return [ 'price-table-event' ];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'section_design', [
                'label' => __( 'Section Style', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'style',
            [
                'label' => esc_html__( 'Style', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_01' => esc_html__( 'Style One ', 'saasland-core' ),
                    'style_02' => esc_html__( 'Style Two ', 'saasland-core' ),
                    'style_03' => esc_html__( 'Style Three ', 'saasland-core' ),
                    'style_04' => esc_html__( 'Style Four ', 'saasland-core' ),
                    'style_05' => esc_html__( 'Style Five(Event) ', 'saasland-core' ),
                ],
                'default' => 'style_01'
            ]
        );

        $this->end_controls_section();


		// ------------------------------  Title Section ------------------------------
		$this->start_controls_section(
			'title_sec', [
				'label' => __( 'Title section', 'saasland-core' ),
                'condition' => [
                    'style' => ['style_01', 'style_02', 'style_04']
                ]
			]
		);

		$this->add_control(
			'title', [
				'label' => esc_html__( 'Title text', 'saasland-core' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => 'Pricing Table'
			]
		);

        $this->add_control(
            'title_html_tag',
            [
                'label' => __( 'Title HTML Tag', 'elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                ],
                'default' => 'h2',
                'separator' => 'before',
            ]
        );

        $this->end_controls_section(); // End Title Section

        // ------------------------------  Subtitle Section ------------------------------
        $this->start_controls_section(
            'subtitle_sec', [
                'label' => __( 'Subtitle section', 'saasland-core' ),
                'condition' => [
                    'style' => ['style_01', 'style_02', 'style_04']
                ]

            ]
        );

		$this->add_control(
			'subtitle', [
				'label' => esc_html__( 'Subtitle text', 'saasland-core' ),
                'description' => esc_html__( 'Use <br> tag for line breaking.', 'saasland-core' ),
				'type' => Controls_Manager::TEXTAREA,
			]
		);

		$this->end_controls_section(); // End Subtitle section


		// ------------------------------ Table Lists ------------------------------
		$this->start_controls_section(
			'contents', [
				'label' => __( 'Table Lists', 'saasland-core' ),
                'condition' => [
                    'style' => ['style_01', 'style_02']
                ],
			]
		);

        // ------------------------------ Tables 01 ------------------------------
		$this->add_control(
			'tables', [
				'label' => __( 'Pricing Tables', 'saasland-core' ),
				'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
				'title_field' => '{{{ title }}}',
				'condition' => [
				    'style' => 'style_01'
                ],
				'fields' => [
					[
						'name' => 'title',
						'label' => __( 'Title', 'saasland-core' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
						'default' => 'Education'
					],
					[
						'name' => 'title_html_tag',
						'label' => __( 'Title HTML Tag', 'saasland-core' ),
						'type' => Controls_Manager::SELECT,
                        'options' => [
                            'h1' => 'H1',
                            'h2' => 'H2',
                            'h3' => 'H3',
                            'h4' => 'H4',
                            'h5' => 'H5',
                            'h6' => 'H6',
                            'div' => 'div',
                        ],
                        'default' => 'h5',
                        'separator' => 'before',
					],
					[
						'name' => 'subtitle',
						'label' => __( 'Subtitle', 'saasland-core' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
						'default' => 'Create your first online course'
					],
					[
						'name' => 'ribbon_label',
						'label' => __( 'Ribbon Label', 'saasland-core' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
					],
					[
                        'name'      => 'icon_type',
                        'label'     => esc_html__( 'Icon Type', 'saasland-core' ),
                        'type'      => Controls_Manager::SELECT,
                        'options'   => [
                            'flaticon'     => esc_html__( 'Flat Icon', 'saasland-core' ),
                            'themify_icon'     => esc_html__( 'Themify Icon', 'saasland-core' ),
                        ],
                        'default' => 'flaticon',
                    ],
                    [
                        'name'       => 'flaticon',
                        'label'      => esc_html__( 'Icon', 'saasland-core' ),
                        'type'       => Controls_Manager::ICON,
                        'options'     => saasland_flaticons(),
                        'include'    => saasland_include_flaticons(),
                        'default'    => 'flaticon-mortarboard',
                        'condition'  => [
                             'icon_type' => 'flaticon',
                        ],
                    ],
                    [
                        'name'       => 'themify_icon',
                        'label'      => esc_html__( 'Icon', 'saasland-core' ),
                        'type'       => Controls_Manager::ICON,
                        'options'    => saasland_themify_icons(),
                        'include'    => saasland_include_themify_icons(),
                        'default'    => 'ti-ruler-pencil',
                        'condition'  => [
                             'icon_type' => 'themify_icon',
                        ],
                    ],
                    [
                        'name'       => 'icon_color',
                        'label'      => esc_html__( 'Icon Color', 'saasland-core' ),
                        'type'       => Controls_Manager::COLOR,
                    ],
                    [
                        'name'       => 'icon_bg',
                        'label'      => esc_html__( 'Icon Background Image', 'saasland-core' ),
                        'type'       => Controls_Manager::MEDIA,
                        'default'    => [
                            'url' => plugins_url( 'images/price_line1.png', __FILE__)
                        ]
                    ],
                    [
                        'name'       => 'bg_color',
                        'label'      => esc_html__( 'Background Color', 'saasland-core' ),
                        'type'       => Controls_Manager::COLOR,
                    ],
					[
						'name' => 'price',
						'label' => __( 'Price', 'saasland-core' ),
						'type' => Controls_Manager::TEXT,
						'default' => '$49.00',
					],
					[
						'name' => 'duration',
						'label' => __( 'Duration', 'saasland-core' ),
						'type' => Controls_Manager::TEXT,
						'default' => 'mo',
					],
					[
						'name' => 'contents',
						'label' => __( 'List items', 'saasland-core' ),
						'description' => __( 'Wrap up every list item with li tag (<li>Item Name</li>).', 'saasland-core' ),
						'type' => Controls_Manager::TEXTAREA,
						'label_block' => true,
						'default' =>'<li>Product Recommendations</li>
                                    <li>Abandoned Cart</li>
                                    <li>Facebook &amp; Instagram Ads</li>
                                    <li>Order Notifications</li>
                                    <li>Landing Pages</li>',
					],
					[
						'name' => 'btn_label',
						'label' => __( 'Button Label', 'saasland-core' ),
						'type' => Controls_Manager::TEXT,
						'default' => 'Choose This Plan',
                        'label_block' => true
					],
					[
						'name' => 'btn_url',
						'label' => __( 'Button URL', 'saasland-core' ),
						'type' => Controls_Manager::URL,
						'default' => [
							'url' => '#',
							'is_external' => '',
						],
						'show_external' => true,
					],
                    [
                        'name' => 'pricing_btn_id',
                        'label' => __( 'Button ID', 'saasland-core' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => '',
                        'label_block' => true
                    ],
				],
			]
		);

        // ------------------------------ Tables 02 ------------------------------
        $table2 = new \Elementor\Repeater();

        $table2->add_control(
            'title', [
                'label' => __( 'Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '$29.00'
            ]
        );

        $table2->add_control(
            'subtitle', [
                'label' => __( 'Subtitle', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $table2->add_control(
            'contents', [
                'label' => __( 'Contents', 'saasland-core' ),
                'type' => Controls_Manager::WYSIWYG,
                'label_block' => true,
            ]
        );

        $table2->add_control(
            'btn_title', [
                'label' => __( 'Button Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Get Started'
            ]
        );

        $table2->add_control(
            'btn_url', [
                'label' => __( 'Button URL', 'saasland-core' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#'
                ]
            ]
        );

        $table2->add_control(
            'is_highlighted',
            [
                'label' => __( 'Highlighted', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'saasland-core' ),
                'label_off' => __( 'No', 'saasland-core' ),
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $table2->add_control(
            'font_color', [
                'label' => __( 'Font Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}}',
                )
            ]
        );

        $table2->add_control(
            'bg_color', [
                'label' => __( 'Background Color 01', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
            ]
        );

        $table2->add_control(
            'bg_color2', [
                'label' => __( 'Background Color 02', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
            ]
        );

        $table2->add_control(
            'bg_color3', [
                'label' => __( 'Background Color 03', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}:before' => '    background-image: -webkit-linear-gradient(-140deg, {{bg_color.VALUE}} 0%, {{bg_color2.VALUE}} 36%, {{VALUE}} 100%);',
                )
            ]
        );


        $table2->start_controls_tabs(
            'style_tabs'
        );

        /// Normal Button Style
        $table2->start_controls_tab(
            'style_normal_btn',
            [
                'label' => __( 'Normal', 'saasland-core' ),
            ]
        );

        $table2->add_control(
            'btn_font_color', [
                'label' => __( 'Font Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}} .payment_price_btn' => 'color: {{VALUE}}',
                )
            ]
        );

        $table2->add_control(
            'btn_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}} .payment_price_btn' => 'background-color: {{VALUE}}; border-color: {{VALUE}}',
                )
            ]
        );

        $table2->add_control(
            'border_color', [
                'label' => __( 'Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}} .payment_price_btn' => 'border: 1px solid {{VALUE}}',
                )
            ]
        );

        $table2->end_controls_tab();

        /// ----------------------------- Hover Button Style
        $table2->start_controls_tab(
            'style_hover_btn',
            [
                'label' => __( 'Hover', 'saasland-core' ),
            ]
        );

        $table2->add_control(
            'btn_hover_font_color', [
                'label' => __( 'Font Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}} .payment_price_btn:hover' => 'color: {{VALUE}}',
                )
            ]
        );

        $table2->add_control(
            'btn_hover_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}} .payment_price_btn:hover' => 'background: {{VALUE}}',
                )
            ]
        );

        $table2->add_control(
            'hover_border_color', [
                'label' => __( 'Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}} .payment_price_btn:hover' => 'border: 1px solid {{VALUE}}',
                )
            ]
        );

        $table2->end_controls_tab();

        $this->add_control(
            'table2', [
                'label' => __( 'Tables', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'title_field' => '{{{ title }}}',
                'fields' => $table2->get_controls(),
                'condition' => [
                    'style' => 'style_02'
                ]
            ]
        );

		$this->end_controls_section(); // End Buttons


		//--------------------------------------- Table 03 -------------------------------------------//
        $this->start_controls_section(
            'table_list_sec3',
            [
                'label' => __( 'Table Lists', 'saasland-core' ),
				'condition' => [
					'style'	=> [ 'style_03', 'style_05' ]
				]
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'is_active',
            [
                'label' => __( 'Active Table', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'saasland-core' ),
                'label_off' => __( 'No', 'saasland-core' ),
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $repeater->add_control(
            'title', [
                'label' => __( 'Title', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'ribbon', [
                'label' => __( 'Ribbon Text', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'ribbon_icon', [
                'label' => __( 'Icon', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::ICON,
				'options' => saasland_elegant_icons(),
				'include' => saasland_include_elegant_icons(),
            ]
        );

        $repeater->add_control(
            'price', [
                'label' => __( 'Price', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'duration', [
                'label' => __( 'Duration', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'content_list', [
                'label' => __( 'Content', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => __( 'List Content' , 'saasland-core' ),
                'show_label' => false,
            ]
        );

        $repeater->add_control(
            'btn_label', [
                'label' => __( 'Button Label', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'btn_url', [
                'label' => __( 'Button URL', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::URL,
				'default' => [
					'url'	=> '#'
				]
            ]
        );

        //---------------------------- Normal and Hover ---------------------------//
        $repeater->start_controls_tabs(
            'table3_style_tabs'
        );


        // Normal Color
        $repeater->start_controls_tab(
            'table3_normal_btn_style',
            [
                'label' => __( 'Normal', 'saasland-core' ),
            ]
        );

        $repeater->add_control(
            'table3_normal_text_color', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_control(
            'table3_normal_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'background: {{VALUE}}',

                ],
            ]
        );

        $repeater->add_control(
            'table3_normal_border_color', [
                'label' => __( 'Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'table3_normal_box_shadow',
                'label' => __( 'Box Shadow', 'saasland-core' ),
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}',
            ]
        );

        $repeater->end_controls_tab();


        // Hover Color
        $repeater->start_controls_tab(
            'table3_hover_btn_style',
            [
                'label' => __( 'Hover', 'saasland-core' ),
            ]
        );

        $repeater->add_control(
            'table3_hover_text_color', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'color: {{VALUE}}',
                ]
            ]
        );

        $repeater->add_control(
            'table3_hover_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'background: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_control(
            'table3_hover_border_color', [
                'label' => __( 'Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'table3_hover_box_shadow',
                'label' => __( 'Box Shadow', 'saasland-core' ),
                'selector' => '
                    {{WRAPPER}} {{CURRENT_ITEM}}',
            ]
        );

        $repeater->end_controls_tab();

        $repeater->end_controls_tabs();

        $this->add_control(
            'table3',
            [
                'label' => __( 'Content List', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section(); //end table 03


        // *********************************  Start Table 04 ***********************************//
        $this->start_controls_section(
            'table_sec4',
            [
                'label' => esc_html__( 'Table Lists', 'saasland-core' ),
                'condition' => [
                    'style' => 'style_04'
                ]
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'saasland-core' ),
                'type' =>Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Education',
            ]
        );

        $repeater->add_control(
            'subtitle',
            [
                'label' => esc_html__( 'Subtitle', 'saasland-core' ),
                'type' =>Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'ribbon_label',
            [
                'label' => esc_html__( 'Ribbon', 'saasland-core' ),
                'type' =>Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'ribbon_text_color', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price_content .price_item .tag span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_control(
            'ribbon_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price_content_two .price_item .tag' => 'background: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_control(
            'ribbon_hr',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $repeater->add_control(
            'price',
            [
                'label' => esc_html__( 'Price', 'saasland-core' ),
                'type' =>Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'duration',
            [
                'label' => esc_html__( 'Duration', 'saasland-core' ),
                'type' =>Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'contents',
            [
                'label' => esc_html__( 'Contents', 'saasland-core' ),
                'type' =>Controls_Manager::WYSIWYG,
            ]
        );

        $repeater->add_control(
            'icon_bg',
            [
                'label' => esc_html__( 'Image', 'saasland-core' ),
                'type' =>Controls_Manager::MEDIA,
            ]
        );

        $repeater->add_control(
            'btn_label',
            [
                'label' => esc_html__( 'Button Label', 'saasland-core' ),
                'type' =>Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Start Today'
            ]
        );

        $repeater->add_control(
            'btn_url',
            [
                'label' => esc_html__( 'Button URL', 'saasland-core' ),
                'type' =>Controls_Manager::URL,
                'default' => [
                    'url'   => '#'
                ]
            ]
        );

        //---------------------------- Normal and Hover ---------------------------//
        $repeater->start_controls_tabs(
            'tables_item_style_tabs'
        );

        // Normal Color
        $repeater->start_controls_tab(
            'tables_item_normal_btn_style',
            [
                'label' => __( 'Normal', 'saasland-core' ),
            ]
        );

        $repeater->add_control(
            'tables_item_normal_text_color', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price_content_two .price_item .price_btn' => 'color: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_control(
            'tables_item_normal_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price_content_two .price_item .price_btn' => 'background: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_control(
            'tables_item_normal_border_color', [
                'label' => __( 'Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price_content_two .price_item .price_btn' => 'border: 1px solid {{VALUE}}',
                ],
            ]
        );

        $repeater->end_controls_tab();


        // Hover Color
        $repeater->start_controls_tab(
            'tables_item_hover_btn_style',
            [
                'label' => __( 'Hover', 'saasland-core' ),
            ]
        );

        $repeater->add_control(
            'tables_item_hover_text_color', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price_content_two .price_item .price_btn:hover' => 'color: {{VALUE}}',
                ]
            ]
        );

        $repeater->add_control(
            'tables_item_hover_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price_content_two .price_item .price_btn:hover' => 'background: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_control(
            'tables_item_hover_border_color', [
                'label' => __( 'Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price_content_two .price_item .price_btn:hover' => 'border: 1px solid {{VALUE}}',
                ],
            ]
        );

        $repeater->end_controls_tab();

        $repeater->end_controls_tabs();

        $this->add_control(
            'table4',
            [
                'label' => esc_html__( 'Table List', 'saasland-core' ),
                'type' =>Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{title}}}'
            ]
        );

        $this->end_controls_section(); // End table 04

		/**
		 * Style Tab
         *
		 * ------------------------------ Style Title ------------------------------
		 *
		 */
		$this->start_controls_section(
			'style_title', [
				'label' => __( 'Style title', 'saasland-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => ['style_01', 'style_02', 'style_04']
                ]
			]
		);
		$this->add_control(
			'color_prefix', [
				'label' => __( 'Text Color', 'saasland-core' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .f_p.f_size_30.l_height50.f_600.t_color' => 'color: {{VALUE}};',
					'{{WRAPPER}} .f_p.f_size_30.l_height50.f_600.t_color3' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name' => 'typography_prefix',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '
				        {{WRAPPER}} .f_p.f_size_30.l_height50.f_600.t_color,
				        {{WRAPPER}} .f_p.f_size_30.l_height50.f_600.t_color3
				        ',
			]
		);
		$this->end_controls_section();


		//------------------------------ Style subtitle ------------------------------
		$this->start_controls_section(
			'style_subtitle', [
				'label' => __( 'Style subtitle', 'saasland-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => ['style_01', 'style_02', 'style_04']
                ]
			]
		);
		$this->add_control(
			'color_subtitle', [
				'label' => __( 'Text Color', 'saasland-core' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .sec_title  p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name' => 'typography_subtitle',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .sec_title  p',
			]
		);
		$this->end_controls_section();


		//------------------------------ Style Table List Title ------------------------------
		$this->start_controls_section(
			'style_table_title_sec', [
				'label' => __( 'Style Table Title', 'saasland-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => ['style_03', 'style_04']
                ]
			]
		);
		$this->add_control(
			'color_table_title', [
				'label' => __( 'Text Color', 'saasland-core' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .t_color.mb-0.mt_40' => 'color: {{VALUE}};',
					'{{WRAPPER}} .analytices_price_item .p_head h5' => 'color: {{VALUE}};',
					'{{WRAPPER}} .price_content .price_item h5' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name' => 'typography_table_title',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '
				            {{WRAPPER}} .t_color.mb-0.mt_40,
				            {{WRAPPER}} .analytices_price_item .p_head h5,
				            {{WRAPPER}} .price_content .price_item h5
				            ',
			]
		);

		$this->end_controls_section();


		//------------------------------ Style Table List Subtitle ------------------------------
		$this->start_controls_section(
			'style_table_price_sec', [
				'label' => __( 'Style Table Price', 'saasland-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'style' => 'style_03'
				]
			]
		);
		$this->add_control(
			'color_table_price', [
				'label' => __( 'Text Color', 'saasland-core' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .analytices_price_item .p_head .rate' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name' => 'typography_table_price',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .analytices_price_item .p_head .rate
								',
			]
		);

		$this->end_controls_section();

        //------------------------------ Style Table List Item ------------------------------//
        $this->start_controls_section(
            'style_table_item_sec', [
                'label' => __( 'Style Table Item', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => 'style_03'
                ]
            ]
        );
        $this->add_control(
            'color_table_item', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .analytices_price_item .p_body li' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_table_item',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
				            {{WRAPPER}} .analytices_price_item .p_body li
				            ',
            ]
        );

        $this->end_controls_section();


		//------------------------------ Style 01 Button Color ------------------------------
		$this->start_controls_section(
			'style_btn1_sec', [
				'label' => __( 'Pricing Button Style', 'saasland-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => ['style_01', 'style_02', 'style_03']
                ]
			]
		);

        //---------------------------- Normal and Hover ---------------------------//
        $this->start_controls_tabs(
            'btn_style_tabs'
        );

        /************************** Normal Color *****************************/
        $this->start_controls_tab(
            'btn_style_normal',
            [
                'label' => __( 'Normal', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'btn_border_color', [
                'label' => __( 'Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn_three' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'normal_font_color', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn_three' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .er_btn_two' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .payment_price_item .payment_price_btn' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'normal_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn_three' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .er_btn_two' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .payment_price_item .payment_price_btn' => 'background: {{VALUE}}',
                ],
            ]
        );


        $this->end_controls_tab();


        //**************************** Hover Color *****************************//
        $this->start_controls_tab(
            'btn_style_hover',
            [
                'label' => __( 'Hover', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'hover_font_color', [
                'label' => __( 'Font Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn_three:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .er_btn_two:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .payment_price_item .payment_price_btn:hover' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'hover_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn_three:hover' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .er_btn_two:hover' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .payment_price_item .payment_price_btn:hover' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'hover_border_color', [
                'label' => __( 'Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn_three:hover' => 'border: 1px solid {{VALUE}}',
                    '{{WRAPPER}} .er_btn_two:hover' => 'border: 1px solid {{VALUE}}',
                    '{{WRAPPER}} .payment_price_item .payment_price_btn:hover' => 'border: 1px solid {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_section();


		//------------------------------ Border Radius ------------------------------
		$this->start_controls_section(
			'table4_border_radius_sec', [
				'label' => __( 'Table Border', 'saasland-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => 'style_04'
                ]
			]
		);

        $this->add_control(
            'table4_border_color',
            [
                'label' => __( 'Border Hover Color', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .price_content_two .price_item:hover' => 'border: 1px solid {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'table4_border', [
                'label' => __( 'Border', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .support_price_area .price_content .price_item' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'table_border_radius', [
                'label' => __( 'Border Radius', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .support_price_area .price_content .price_item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

		$this->end_controls_section();

        /*==================== Pricing Item Style ===========================*/
        $this->start_controls_section(
            'pricing_item_style', [
                'label' => __( 'Style Pricing Content', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => 'style_01'
                ]
            ]
        );
        $this->add_control(
            'popular_package_ribbon_color', [
                'label' => __( 'Popular Package Ribbon Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .s_pricing-item .tag_label' => 'color: {{VALUE}}',
                ]
            ]
        );
        $this->add_control(
            'popular_package_ribbon_bg', [
                'label' => __( 'Popular Package Ribbon Background', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .s_pricing-item .tag_label' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .s_pricing-item .tag_label.blue_bg:before' => 'border-top:20px solid {{VALUE}}; border-bottom:20px solid {{VALUE}}',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'package_ribbon_typo',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
                    {{WRAPPER}} .s_pricing-item .tag_label
                ',
            ]
        );

        $this->add_control(
            'package_title_color', [
                'label' => __( 'Package Title Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .s_pricing-item h5' => 'color: {{VALUE}}',
                ],
                'separator' => 'before'
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'package_title_typo',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
                    {{WRAPPER}} .s_pricing-item h5
                ',
            ]
        );
        $this->add_control(
            'package_price_color', [
                'label' => __( 'Package Price Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .s_pricing-item .price' => 'color: {{VALUE}}',
                ],
                'separator' => 'before'
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'package_price_typo',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
                    {{WRAPPER}} .s_pricing-item .price
                ',
            ]
        );
        $this->add_control(
            'package_my_color', [
                'label' => __( 'Package Mo/Year Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .s_pricing-item .price sub' => 'color: {{VALUE}}',
                ],
                'separator' => 'before'
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'package_my_typo',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
                    {{WRAPPER}} .s_pricing-item .price sub
                ',
            ]
        );
        $this->add_control(
            'package_list_color', [
                'label' => __( 'Features List Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .s_pricing-item ul li' => 'color: {{VALUE}}',
                ],
                'separator' => 'before'
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'package_list_typo',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
                    {{WRAPPER}} .s_pricing-item ul li
                ',
            ]
        );
        $this->add_control(
            'package_item_bg', [
                'label' => __( 'Package Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .s_pricing-item' => 'background-color: {{VALUE}}',
                ],
                'separator' => 'before'
            ]
        );
        $this->add_control(
            'package_hover_bg', [
                'label' => __( 'Package Hover Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .s_pricing-item:hover' => 'background-color: {{VALUE}}',
                ],
                'separator' => 'before'
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'package_box_shadow',
                'label' => __( 'Package Hover Box Shadow', 'saasland-core' ),
                'selector' => '{{WRAPPER}} .s_pricing-item:hover',
            ]
        );
		$this->end_controls_section();


		//------------------------------ Style Section ------------------------------
		$this->start_controls_section(
			'style_section', [
				'label' => __( 'Style section', 'saasland-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'sec_padding', [
				'label' => __( 'Section padding', 'saasland-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .s_pricing_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .payment_priceing_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .sec_pad' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'	=> [
					'style'	=> ['style_01', 'style_02', 'style_04']
				]
			]
		);

        $this->add_control(
            'column', [
                'label' => __( 'Column', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '6' => esc_html__( 'Two', 'saasland-core' ),
                    '4' => esc_html__( 'Three', 'saasland-core' ),
                    '3' => esc_html__( 'Four', 'saasland-core' ),
                ],
                'default' => '4',
                'condition' => [
                    'style' => ['style_01', 'style_03', 'style_04']
                ]
            ]
        );

		$this->end_controls_section();
	}

	protected function render() {

		$settings = $this->get_settings();
		$tables = isset($settings['tables']) ? $settings['tables'] : '';
		$table2 = isset($settings['table2']) ? $settings['table2'] : '';
		$table3 = isset($settings['table3']) ? $settings['table3'] : '';
		$table4 = isset($settings['table4']) ? $settings['table4'] : '';
        $title_tag = !empty($settings['title_html_tag']) ? $settings['title_html_tag'] : 'h2';

        if ( $settings['style'] == 'style_01' ) {
            include 'pricing-table/part-one.php';
        }

        if ( $settings['style'] == 'style_02' ) {
            include 'pricing-table/part-two.php';
        }

        if ( $settings['style'] == 'style_03' ) {
            include 'pricing-table/part-three.php';
        }

        if ( $settings['style'] == 'style_04' ) {
            include 'pricing-table/part-four.php';
        }

        if ( $settings['style'] == 'style_05' ) {
            include 'pricing-table/event/price-table-event.php';
        }

	}
}