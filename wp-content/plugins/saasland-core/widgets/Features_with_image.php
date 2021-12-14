<?php
namespace SaaslandCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Features with Image (Dark)
 */
class Features_with_image extends Widget_Base {

    public function get_name() {
        return 'Saasland_features_with_image';
    }

    public function get_title() {
        return __( 'Features <br> with Image (Dark)', 'saasland-hero' );
    }

    public function get_icon() {
        return 'eicon-column';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    protected function _register_controls() {

        // ----------------------------------------  Hero content ------------------------------
        $this->start_controls_section(
            'contents_sec',
            [
                'label' => __( 'Contents', 'saasland-core' ),
            ]
        );

        /// --------------- Images ----------------
        /// Image Fields
        $repeater_fields = new \Elementor\Repeater();

        $repeater_fields->add_control(
            'title',
            [
                'label' => esc_html__( 'Title text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );

        $repeater_fields->add_control(
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

        $repeater_fields->add_control(
            'subtitle',
            [
                'label' => esc_html__( 'Description text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );

        $repeater_fields->add_control(
            'image', [
                'label' => __( 'Featured Image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        // ------------------------------ Button ------------------------------
        $repeater_fields->start_controls_section(
            'button', [
                'label' => esc_html__( 'Button', 'saasland-core' ),
            ]
        );

        $repeater_fields->add_control(
            'btn_label', [
                'label' => esc_html__( 'Button label', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Get Started',
            ]
        );

        $repeater_fields->add_control(
            'btn_url', [
                'label' => esc_html__( 'Button URL', 'saasland-core' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#'
                ]
            ]
        );

        $repeater_fields->start_controls_tabs(
            'style_tabs'
        );

        $repeater_fields->start_controls_tab(
            'style_normal_tab',
            [
                'label' => __( 'Normal', 'saasland-core' ),
            ]
        );

        $repeater_fields->add_control(
            'btn_text_color', [
                'label' => esc_html__( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .saas_featured_info .saas_featured_content .saas_banner_btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $repeater_fields->add_control(
            'btn_bg_color', [
                'label' => esc_html__( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .saas_featured_info .saas_featured_content .saas_banner_btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $repeater_fields->end_controls_tab();

        // --- Hover
        $repeater_fields->start_controls_tab(
            'style_hover_tab',
            [
                'label' => __( 'Hover', 'saasland-core' ),
            ]
        );

        $repeater_fields->add_control(
            'btn_text_color_hover', [
                'label' => esc_html__( 'Text Color Hover', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .saas_featured_info .saas_featured_content .saas_banner_btn:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $repeater_fields->add_control(
            'btn_bg_color_hover', [
                'label' => esc_html__( 'Background Hover Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .saas_featured_info .saas_featured_content .saas_banner_btn:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $repeater_fields->end_controls_tab();

        $repeater_fields->end_controls_tabs();


        $repeater_fields->end_controls_section(); // End the Button

        $repeater_fields->add_control(
            'is_row_reverse',
            [
                'label' => __( 'Row Reverse', 'saasland-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'saasland-core' ),
                'label_off' => __( 'No', 'saasland-core' ),
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'features', [
                'label' => __( 'Features Rows', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'title_field' => '{{{ title }}}',
                'fields' => $repeater_fields->get_controls(),
            ]
        );

        $this->end_controls_section(); // End Hero content


        //------------------------------ Feature Item Title Section ---------------------------------------//
        $this->start_controls_section(
			'feature_item_sec',
			[
				'label' => __( 'Feature Item Title', 'saasland-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'feature_item_title_color',
			[
				'label' => __( 'Text Color', 'saasland-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mb_20' => 'color: {{VALUE}}',
				],
			]
        );
        
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'feature_item_typography',
				'label' => __( 'Typography', 'saasland-core' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .mb_20',
			]
		);

        $this->end_controls_section();


        //------------------------------ Feature Item Description Section ---------------------------------------//
        $this->start_controls_section(
			'feature_des_sec',
			[
				'label' => __( 'Feature Item Description', 'saasland-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'feature_item_des_color',
			[
				'label' => __( 'Text Color', 'saasland-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .saas_featured_info .saas_featured_content p' => 'color: {{VALUE}}',
				],
			]
        );
        
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'feature_item_des_typography',
				'label' => __( 'Typography', 'saasland-core' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .saas_featured_info .saas_featured_content p',
			]
		);

        $this->end_controls_section();


         //------------------------------ Feature Item Description Section ---------------------------------------//
         $this->start_controls_section(
			'bg_color_sec',
			[
				'label' => __( 'Background Color', 'saasland-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);


        //------------------------------ Section Background Color-------------------------------------------//
		$this->add_control(
			'bg_color',
			[
				'label' => __( 'Background Color', 'saasland-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dk_bg_one' => 'background: {{VALUE}}',
				],
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
                    '{{WRAPPER}} .saas_featured_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',

                ],
            ]
        );

        $this->add_control(
            'is_shape1',
            [
                'label' => __( 'Triangle Shape 1', 'saasland-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'saasland-core' ),
                'label_off' => __( 'No', 'saasland-core' ),
                'return_value' => 'yes',
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'shape1_color_left', [
                'label'     => esc_html__( 'Shape 1  Color Left', 'saasland-core' ),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'is_shape1' => ['yes'],
                ]
            ]
        );

        $this->add_control(
            'shape1_color_right', [
                'label'     => esc_html__( 'Shape 1 Color Right', 'saasland-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .square_box.box_three' => 'background-image: -webkit-linear-gradient(140deg, {{shape1_color_left.VALUE}} 0%, {{VALUE}} 100%)',
                ),
                'condition' => [
                    'is_shape1' => ['yes'],
                ],
            ]
        );

        $this->add_control(
            'is_shape2',
            [
                'label' => __( 'Bottom Triangle Shape 2', 'saasland-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'saasland-core' ),
                'label_off' => __( 'No', 'saasland-core' ),
                'return_value' => 'yes',
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'shape2_color_left', [
                'label'     => esc_html__( 'Shape 2  Color Left', 'saasland-core' ),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'is_shape2' => ['yes'],
                ]
            ]
        );

        $this->add_control(
            'shape2_color_right', [
                'label'     => esc_html__( 'Shape 2 Color Right', 'saasland-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .square_box.box_four' => 'background-image: -webkit-linear-gradient(140deg, {{shape2_color_left.VALUE}} 0%, {{VALUE}} 100%)',
                ),
                'condition' => [
                    'is_shape2' => ['yes'],
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings();
        ?>
        <section class="saas_featured_area sec_pad dk_bg_one">
            <?php if ( $settings['is_shape1'] == 'yes' ) : ?>
                <div class="square_box box_three"></div>
            <?php endif; ?>
            <?php if ( $settings['is_shape2'] == 'yes' ) : ?>
                <div class="square_box box_four"></div>
            <?php endif; ?>
            <div class="container">
                <?php
                if (!empty($settings['features'])) {
                foreach ($settings['features'] as $i => $feature) {
                    $title_tag = !empty($feature['title_html_tag']) ? $feature['title_html_tag'] : 'h2';
                    ?>
                    <div class="row <?php echo ($feature['is_row_reverse'] == 'yes' ) ? 'flex-row-reverse' : ''; ?> saas_featured_info">
                        <?php if (!empty($feature['image']['id'])) : ?>
                            <div class="col-lg-6">
                                <div class="<?php echo ($i == 0) ? 'f_img_one' : 'f_img_two'; ?> img_border wow fadeInLeft" data-wow-delay="0.3s">
                                    <?php echo wp_get_attachment_image($feature['image']['id'], 'full', '', array( 'class' => 'img-fluid')) ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="col-lg-6 d-flex align-items-center <?php echo ($feature['is_row_reverse'] == 'yes' ) ? 'pr_70' : 'pl_100'; ?>">
                            <div class="saas_featured_content wow fadeInRight" data-wow-delay="0.4s">
                                <?php
                                if (!empty($feature['title'])) : ?>
                                    <<?php echo $title_tag; ?> class="f_size_30 f_600 f_p w_color l_height40 mb_20">
                                        <?php echo wp_kses_post(nl2br($feature['title'])) ?>
                                    </<?php echo $title_tag; ?>>
                                <?php endif; ?>
                                <?php if (!empty($feature['subtitle'])) : ?>
                                    <p class="d_p_color f_300 f_size_15 l_height28">
                                        <?php echo wp_kses_post($feature['subtitle']) ?>
                                    </p>
                                <?php endif; ?>
                                <?php if (!empty($feature['btn_label'])): ?>
                                    <a href="<?php echo esc_url($feature['btn_url']['url']); ?>"
                                        <?php saasland_is_external($feature['btn_url']) ?>
                                        <?php echo saasland_is_external($feature['btn_url']); ?>
                                       class="btn_hover saas_banner_btn mt_40">
                                        <?php echo esc_html($feature['btn_label']); ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }}
                ?>
            </div>
        </section>
        <?php
    }
}