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
 *
 * WPML_get_app_download
 */
class Downloads extends Widget_Base {

	public function get_name() {
		return 'saasland-download-sec';
	}

	public function get_title() {
		return __( 'Download Section', 'saasland-hero' );
	}

	public function get_icon() {
		return 'eicon-download-button';
	}

	public function get_categories() {
		return [ 'saasland-elements' ];
	}

	public function get_keywords() {
		return [ 'get app' ];
	}

	protected function _register_controls() {

		// ------------------------------  Title Section ------------------------------
		$this->start_controls_section(
			'title_sec', [
				'label' => __( 'Contents', 'saasland-core' ),
			]
		);
		$this->add_control(
			'contents', [
				'label' => esc_html__( 'Content', 'saasland-core' ),
				'desc' => esc_html__( 'You can place here any text (Eg, h1, h2, h3, p etc)', 'saasland-core' ),
				'type' => Controls_Manager::WYSIWYG,
				'label_block' => true,
			]
		);
		$this->end_controls_section(); // End title section


		// ------------------------------ Buttons ------------------------------
		$this->start_controls_section(
			'btn_sec', [
				'label' => __( 'Download Buttons', 'saasland-core' ),
			]
		);

		/// Button repeater
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'btn_title', [
                'label' => __( 'Button Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Google Play'
            ]
        );

        $repeater->add_control(
            'btn_url', [
                'label' => __( 'Button URL', 'saasland-core' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#'
                ]
            ]
        );

        $repeater->add_control(
            'btn_type', [
                'label' => __( 'Button Type', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'image' => esc_html__( 'Image Icon', 'saasland-core' ),
                    'icon' => esc_html__( 'Font Icon', 'saasland-core' ),
                ],
                'default' => 'image'
            ]
        );

        $repeater->add_control(
            'font_icon', [
                'label' => __( 'Icon', 'saasland-core' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fab fa-apple',
                    'library' => 'brand',
                ],
                'condition' => [
                    'btn_type' => 'icon'
                ]
            ]
        );

        $repeater->add_control(
            'image_icon', [
                'label' => __( 'Button Image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/google_icon.png', __FILE__)
                ],
                'condition' => [
                    'btn_type' => 'image'
                ]
            ]
        );

        $repeater->start_controls_tabs(
            'style_tabs'
        );

        /// Normal Button Style
        $repeater->start_controls_tab(
            'style_normal_btn',
            [
                'label' => __( 'Normal', 'saasland-core' ),
            ]
        );

        $repeater->add_control(
            'font_color', [
                'label' => __( 'Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}}; border-color: {{VALUE}}',
                )
            ]
        );

        $repeater->add_control(
            'bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'background: {{VALUE}};',
                )
            ]
        );

        $repeater->add_control(
            'border_color', [
                'label' => __( 'Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'border-color: {{VALUE}};',
                )
            ]
        );

        $repeater->end_controls_tab();

        /// Hover Button Style
        $repeater->start_controls_tab(
            'style_hover_btn',
            [
                'label' => __( 'Hover', 'saasland-core' ),
            ]
        );

        $repeater->add_control(
            'hover_font_color', [
                'label' => __( 'Font Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'color: {{VALUE}}',
                )
            ]
        );

        $repeater->add_control(
            'hover_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'background: {{VALUE}}; border-color: {{VALUE}}',
                )
            ]
        );

        $repeater->add_control(
            'hover_border_color', [
                'label' => __( 'Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'border-color: {{VALUE}}; border-color: {{VALUE}}',
                )
            ]
        );

        $repeater->end_controls_tab();

        // Buttons repeater field

        $this->add_control(
            'buttons', [
                'label' => __( 'Create Buttons', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'title_field' => '{{{ btn_title }}}',
                'fields' => $repeater->get_controls(),
            ]
        );

		$this->end_controls_section(); // End Buttons


		// ------------------------------  Featured image ------------------------------
		$this->start_controls_section(
			'featured_image', [
				'label' => __( 'Featured image', 'saasland-core' ),
			]
		);

		$this->add_control(
			'the_featured_image', [
				'label' => esc_html__( 'Featured image', 'saasland-core' ),
				'desc' => esc_html__( 'Upload the featured image', 'saasland-core' ),
				'type' => Controls_Manager::MEDIA,
			]
		);

		$this->end_controls_section(); // End title section


		/**
		 * Style Tab
         * @ Style Section
		 */
		$this->start_controls_section(
			'style_section', [
				'label' => __( 'Style section', 'saasland-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
            'triangle_color_opacity',
            [
                'label' => __( 'Triangle Color Opacity', 'saasland-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 9,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .get_started_area .shap' => 'opacity: 0.{{SIZE}};',
                ],
            ]
        );

        // Triangle 01
        $this->add_control(
            'is_triangle1',
            [
                'label' => __( 'Triangle 01', 'saasland-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'saasland-core' ),
                'label_off' => __( 'Hide', 'saasland-core' ),
                'return_value' => 'yes',
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'triangle1_color', [
                'label'     => esc_html__( 'Triangle 01 Color', 'saasland-core' ),
                'type'      => Controls_Manager::COLOR,'selectors' => [
                    '{{WRAPPER}} .get_started_area .shap.one' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'is_triangle1' => ['yes'],
                ]
            ]
        );

        // Triangle 02
        $this->add_control(
            'is_triangle2',
            [
                'label' => __( 'Triangle 02', 'saasland-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'saasland-core' ),
                'label_off' => __( 'Hide', 'saasland-core' ),
                'return_value' => 'yes',
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'triangle2_color', [
                'label'     => esc_html__( 'Triangle 02 Color', 'saasland-core' ),
                'type'      => Controls_Manager::COLOR,'selectors' => [
                    '{{WRAPPER}} .get_started_area .shap.two' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'is_triangle2' => ['yes'],
                ]
            ]
        );

        // Triangle 03
        $this->add_control(
            'is_triangle3',
            [
                'label' => __( 'Triangle 03', 'saasland-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'saasland-core' ),
                'label_off' => __( 'Hide', 'saasland-core' ),
                'return_value' => 'yes',
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'triangle3_color', [
                'label'     => esc_html__( 'Triangle 03 Color', 'saasland-core' ),
                'type'      => Controls_Manager::COLOR,'selectors' => [
                    '{{WRAPPER}} .get_started_area .shap.three' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'is_triangle3' => ['yes'],
                ]
            ]
        );

        // Triangle 04
        $this->add_control(
            'is_triangle4',
            [
                'label' => __( 'Triangle 04', 'saasland-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'saasland-core' ),
                'label_off' => __( 'Hide', 'saasland-core' ),
                'return_value' => 'yes',
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'triangle4_color', [
                'label'     => esc_html__( 'Triangle 04 Color', 'saasland-core' ),
                'type'      => Controls_Manager::COLOR,'selectors' => [
                    '{{WRAPPER}} .get_started_area .shap.four' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'is_triangle4' => ['yes'],
                ]
            ]
        );

		$this->add_control(
			'sec_padding', [
				'label' => __( 'Section padding', 'saasland-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .get_started_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'default' => [
					'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',

				],
			]
		);

        $this->add_control(
            'section_color_left', [
                'label'     => esc_html__( 'Background Color Left', 'saasland-core' ),
                'type'      => Controls_Manager::COLOR,
            ]
        );

        $this->add_control(
            'section_color_right', [
                'label'     => esc_html__( 'Background Color Right', 'saasland-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '.get_started_area' => 'background-image: -webkit-linear-gradient(40deg, {{section_color_left.VALUE}} 0%, {{VALUE}} 100%)',
                ),
            ]
        );

		$this->end_controls_section();
	}

	protected function render()
    {

        $settings = $this->get_settings_for_display();
        $buttons = isset($settings['buttons']) ? $settings['buttons'] : '';
        ?>
        <section class="get_started_area">
            <?php if ( $settings['is_triangle1'] =='yes' ) : ?>
                <div class="shap one"></div>
            <?php endif; ?>
            <?php if ( $settings['is_triangle2'] =='yes' ) : ?>
                <div class="shap two"></div>
            <?php endif; ?>
            <?php if ( $settings['is_triangle3'] =='yes' ) : ?>
                <div class="shap one three"></div>
            <?php endif; ?>
            <?php if ( $settings['is_triangle4'] =='yes' ) : ?>
                <div class="shap two four"></div>
            <?php endif; ?>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 d-flex align-items-center">
                        <div class="get_content">
                            <?php echo wp_kses_post($settings['contents']) ?>
                            <?php
                            $delay = 5;
                            if (!empty($buttons)) {
                            foreach ($buttons as $i => $button) {
                                $button_url = $button['btn_url'];
                                $btn_target = $button_url['is_external'] ? 'target="_blank"' : '';
                                $icon = $button['btn_type'] == 'image' ? '<img src="'.$button['image_icon']['url'].'" alt="download button">' : '<i class=" '. esc_attr($button['font_icon']['value']) . '"></i>';
                                if (!empty($button['btn_title'])) : ?>
                                    <a href="<?php echo esc_url($button_url['url']) ?>"
                                       class="app_btn app_btn_<?php echo ($i == 0) ? 'one' : 'two'; ?> wow fadeInLeft elementor-repeater-item-<?php echo esc_attr($button['_id']) ?>"
                                       data-wow-delay="0.<?php echo esc_attr($delay) ?>s" <?php echo $btn_target; ?>>
                                       <?php echo $icon; ?>
                                       <?php echo esc_html($button['btn_title']) ?>
                                    </a>
                                    <?php
                                endif;
                                ++$delay;
                            }}
                            ?>
                        </div>
                    </div>
                    <?php if (!empty($settings['the_featured_image']['url'])) : ?>
                        <div class="col-lg-6 text-right wow fadeInRight" data-wow-delay="0.7s">
                            <?php echo wp_get_attachment_image($settings['the_featured_image']['id'], 'full' ) ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
        <?php
    }
}