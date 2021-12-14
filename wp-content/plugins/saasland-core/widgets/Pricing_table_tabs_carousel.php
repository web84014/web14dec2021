<?php
namespace SaaslandCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Pricing Table Tabs Carousel
 *
 * @since 1.7.0
 */
class Pricing_table_tabs_carousel extends Widget_Base {
	public function get_name() {
		return 'saasland-pricing-table-tabs-carousel';
	}

	public function get_title() {
		return __( 'Pricing Table Tabs <br> Carousel', 'saasland-hero' );
	}

	public function get_icon() {
		return 'eicon-price-table';
	}

	public function get_style_depends() {
	    return [ 'slick' ];
    }

	public function get_script_depends() {
	    return [ 'slick', 'slick-theme' ];
    }

	public function get_categories() {
		return [ 'saasland-elements' ];
	}

	protected function _register_controls() {

		// -------------------------- Tab 01 ----------------------------
		$this->start_controls_section(
			'Tab 01', [
				'label' => __( 'Tab 01', 'saasland-core' ),
			]
		);

        $this->add_control(
            'tab1_title', [
                'label' => esc_html__( 'Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Billed monthly'
            ]
        );

		$this->add_control(
			'tables', [
				'label' => __( 'Pricing Tables', 'saasland-core' ),
				'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
				'title_field' => '{{{ title }}}',
				'fields' => [
					[
						'name' => 'title',
						'label' => __( 'Title', 'saasland-core' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
						'default' => 'Education'
					],
					[
						'name' => 'title_html_tag_table',
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
                        'name' => 'featured_image',
                        'label' => __( 'Featured Image', 'saasland-core' ),
                        'type' => Controls_Manager::MEDIA,
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
						'label' => __( 'Button label', 'saasland-core' ),
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
		$this->end_controls_section(); // End Buttons


		// -------------------------- Tab 01 ----------------------------
		$this->start_controls_section(
			'Tab 02', [
				'label' => __( 'Tab 02', 'saasland-core' ),
			]
		);

        $this->add_control(
            'tab2_title', [
                'label' => esc_html__( 'Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Billed monthly'
            ]
        );

		$this->add_control(
			'tables2', [
				'label' => __( 'Pricing Tables', 'saasland-core' ),
				'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
				'title_field' => '{{{ title }}}',
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
                        'name' => 'featured_image',
                        'label' => __( 'Featured Image', 'saasland-core' ),
                        'type' => Controls_Manager::MEDIA,
                    ],
					[
						'name' => 'price',
						'label' => __( 'Price', 'saasland-core' ),
						'type' => Controls_Manager::TEXT,
						'default' => '$999.00',
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
						'label' => __( 'Button label', 'saasland-core' ),
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
                        'name' => 'pricing2_btn_id',
                        'label' => __( 'Button ID', 'saasland-core' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => '',
                        'label_block' => true
                    ]
				],
			]
		);
		$this->end_controls_section(); // End Buttons



		/**
		 * Style Tab
		 * ------------------------------ Style Title ------------------------------
		 *
		 */
		$this->start_controls_section(
			'style_title', [
				'label' => __( 'Style title', 'saasland-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'color_prefix', [
				'label' => __( 'Text Color', 'saasland-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .f_600.t_color2.mt_30' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name' => 'typography_prefix',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .f_600.t_color2.mt_30',
			]
		);
		$this->end_controls_section();


		//------------------------------ Style subtitle ------------------------------
		$this->start_controls_section(
			'style_subtitle', [
				'label' => __( 'Style subtitle', 'saasland-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'color_subtitle', [
				'label' => __( 'Text Color', 'saasland-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .price_item p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name' => 'typography_subtitle',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .price_item  p',
			]
		);

		$this->end_controls_section();


		//------------------------------ Style Button Color ------------------------------
		$this->start_controls_section(
			'style_btn_sec', [
				'label' => __( 'Button Style', 'saasland-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        //---------------------------- Normal and Hover ---------------------------//
        $this->start_controls_tabs(
            'style_btn_tabs'
        );


        /************************** Normal Color *****************************/
        $this->start_controls_tab(
            'btn_style_normal',
            [
                'label' => __( 'Normal', 'saasland-core' ),
            ]
        );
        $this->add_control(
            'normal_font_color', [
                'label' => __( 'Font Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price_content .price_item .price_btn' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'normal_border_color', [
                'label' => __( 'Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price_content .price_item .price_btn' => 'border: 1px solid {{VALUE}}',
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
                    '{{WRAPPER}} .price_content .price_item .price_btn:hover' => 'color: {{VALUE}}',
                ]
            ]
        );
        $this->add_control(
            'hover_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price_content .price_item .price_btn:hover' => 'background: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
		$this->end_controls_section();

		//------------------------------ Tab Button Style ------------------------------
		$this->start_controls_section(
			'tab_btn_style', [
				'label' => __( 'Tab Button Style', 'saasland-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        //---------------------------- Normal and Hover ---------------------------//
        $this->start_controls_tabs(
            'tab_btn_style_tab'
        );


        /************************** Normal Color *****************************/
        $this->start_controls_tab(
            'tab_btn_style_normal',
            [
                'label' => __( 'Normal', 'saasland-core' ),
            ]
        );
        $this->add_control(
            'btn_label_color', [
                'label' => __( 'Label Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price_tab .nav-item .nav-link' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'tab_label_typography',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .price_tab .nav-item .nav-link',
            ]
        );
        $this->add_control(
            'tab_btn_bg', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price_tab' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();


        //**************************** Hover Color *****************************//
        $this->start_controls_tab(
            'tab_btn_style_active',
            [
                'label' => __( 'Active', 'saasland-core' ),
            ]
        );
        $this->add_control(
            'active_tab_label_color', [
                'label' => __( 'Label Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price_tab .nav-item .nav-link.active' => 'color: {{VALUE}}',
                ]
            ]
        );
        $this->add_control(
            'active_tab_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price_tab .nav-item .nav-link.active' => 'background: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings();
        $unique_id = $this->get_id();
		$tables = isset($settings['tables']) ? $settings['tables'] : '';
		$tables2 = isset($settings['tables2']) ? $settings['tables2'] : '';
        ?>
        <div class="container custom_container p0">

            <ul class="nav nav-tabs price_tab mt_70" id="myTab" role="tablist">
                <?php if ( !empty($settings['tab1_title']) ) : ?>
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab-<?php echo esc_attr( $unique_id ) ?>" data-toggle="tab" href="#home_<?php echo esc_attr( $unique_id ) ?>" role="tab" aria-controls="home" aria-selected="true">
                            <?php echo esc_html($settings['tab1_title']) ?>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if ( !empty($settings['tab2_title']) ) : ?>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile_<?php echo esc_attr( $unique_id ) ?>" role="tab" aria-controls="profile" aria-selected="false">
                            <?php echo esc_html($settings['tab2_title']) ?>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
            <div class="tab-content price_content" id="myTabContent">
                <div class="tab-pane fade show active" id="home_<?php echo esc_attr( $unique_id ) ?>" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row test_slicKSlider">
                        <?php
                        foreach ($tables as $i => $table) {
                        $title_tag = !empty($table['title_html_tag_table']) ? $table['title_html_tag_table'] : 'h5';
                        ?>
                        <div class="price_item">
                                <?php if (!empty($table['ribbon_label'])) : ?>
                                    <div class="tag"><span> <?php echo esc_html($table['ribbon_label']) ?> </span></div>
                                <?php endif; ?>

                                <?php echo wp_get_attachment_image($table['featured_image']['id'], 'full' ) ?>
                                <?php if (!empty($table['title'])) : ?>
                                    <<?php echo esc_html($title_tag); ?> class="f_p f_size_20 f_600 t_color2 mt_30"> <?php echo $table['title'] ?> </<?php echo esc_html($title_tag); ?>>
                                <?php endif; ?>

                            <?php echo wpautop($table['subtitle']) ?>

                            <div class="price f_700 f_size_40 t_color2">
                                <?php echo esc_html($table['price']) ?>
                                <?php if (!empty($table['duration'])) : ?>
                                    <sub class="f_size_16 f_300"> / <?php echo esc_html($table['duration']) ?> </sub>
                                <?php endif; ?>
                            </div>

                            <ul class="list-unstyled p_list">
                                <?php echo wp_kses_post($table['contents']) ?>
                            </ul>

                            <?php if (!empty($table['btn_label'])) :
                                $btn_id = !empty( $table['pricing_btn_id'] ) ? 'id="'.esc_attr( $table['pricing_btn_id'] ).'"' : '';
                                ?>
                                <a href="<?php echo $table['btn_url']['url'] ?>" <?php echo $btn_id; ?> class="price_btn btn_hover">
                                    <?php echo esc_html($table['btn_label']) ?>
                                </a>
                            <?php endif; ?>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="tab-pane fade" id="profile_<?php echo esc_attr( $unique_id ) ?>" role="tabpanel" aria-labelledby="profile-tab">
                <div class="row test_slicKSlider">
                    <?php
                    unset($table);
                    unset($i);
                    foreach ($tables2 as $i => $table) {
                    $title_tag = !empty($table['title_html_tag']) ? $table['title_html_tag'] : 'h5';
                    ?>
                    <div class="price_item">
                        <?php
                        if (!empty($table['ribbon_label'])) { ?>
                            <div class="tag"><span> <?php echo esc_html($table['ribbon_label']) ?> </span></div>
                            <?php
                        }

                        echo wp_get_attachment_image($table['featured_image']['id'], 'full' );

                        if (!empty($table['title'])) { ?>
                            <<?php echo esc_html($title_tag); ?> class="f_p f_size_20 f_600 t_color2 mt_30"> <?php echo $table['title'] ?> </<?php echo esc_html($title_tag); ?>>
                            <?php
                        } ?>

                        <?php echo wpautop($table['subtitle']) ?>

                        <div class="price f_700 f_size_40 t_color2">
                            <?php
                            echo esc_html($table['price']);

                            if (!empty($table['duration'])) { ?>
                                    <sub class="f_size_16 f_300"> / <?php echo esc_html($table['duration']) ?> </sub>
                                <?php
                            } ?>
                        </div>

                        <ul class="list-unstyled p_list">
                            <?php echo wp_kses_post($table['contents']) ?>
                        </ul>

                        <?php if (!empty($table['btn_label'])) {
                            $p2_btn_id = !empty( $table['pricing2_btn_id'] ) ? 'id="'.esc_attr( $table['pricing2_btn_id'] ).'"' : '';
                            ?>
                            <a href="<?php echo $table['btn_url']['url'] ?>" <?php echo $p2_btn_id; ?> class="price_btn btn_hover">
                                <?php echo esc_html($table['btn_label']) ?>
                            </a>
                            <?php
                        } ?>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>

        <script>
            ;(function($){
                "use strict";
                $(document).ready(function () {
                    $( '.test_slicKSlider' ).slick({
                        dots: true,
                        arrows: false,
                        autoplay: false,
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        responsive: [
                            {
                                breakpoint: 1024,
                                settings: {
                                    slidesToShow: 2,
                                }
                            },
                            {
                                breakpoint: 600,
                                settings: {
                                    slidesToShow: 1,
                                }
                            }
                        ]
                    });
                })
            })(jQuery)
        </script>
        <?php
	}
}