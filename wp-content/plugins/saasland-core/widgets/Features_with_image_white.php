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
 *
 * Features with Image (White)
 *
 */
class Features_with_image_white extends Widget_Base {

    public function get_name() {
        return 'Saasland_features_with_image_white';
    }

    public function get_title() {
        return __( 'Features <br> with Image (White)', 'saasland-hero' );
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

        $repeater_fields->add_control(
            'icon', [
                'label' => __( 'Icon Image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/home9/icon1.png', __FILE__)
                ]
            ]
        );

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

        $repeater_fields->add_control(
            'btn_colors_heading',
            [
                'label'     => __( 'Button Colors', 'happy-elementor-addons' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $repeater_fields->start_controls_tabs(
            'style_tabs'
        );

        $repeater_fields->start_controls_tab(
            'style-solid-btn_tab',
            [
                'label' => __( 'Solid Stat', 'saasland-core' ),
            ]
        );

        $repeater_fields->add_control(
            'style-solid-btn_color', [
                'label' => esc_html__( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .pay_btn, {{WRAPPER}} {{CURRENT_ITEM}} .pay_btn.pay_btn_two:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $repeater_fields->add_control(
            'style-solid-btn_bg_color', [
                'label' => esc_html__( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .pay_btn' => 'background: {{VALUE}}',
                ],
            ]
        );

        $repeater_fields->end_controls_tab();

        // --- Hover
        $repeater_fields->start_controls_tab(
            'style_gradient_btn_tab',
            [
                'label' => __( 'Gradient Stat', 'saasland-core' ),
            ]
        );

        $repeater_fields->add_control(
            'gradient_btn_text_color', [
                'label' => esc_html__( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .pay_btn.pay_btn_two, {{WRAPPER}} {{CURRENT_ITEM}} .pay_btn:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $repeater_fields->add_control(
            'gradient_btn_bg_color', [
                'label' => esc_html__( 'Background Color 01', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
            ]
        );

        $repeater_fields->add_control(
            'gradient_btn_bg_color2', [
                'label' => esc_html__( 'Background Color 02', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .pay_btn::before' => 'background-image: -webkit-linear-gradient(0deg, {{gradient_btn_bg_color.VALUE}} 0%, {{VALUE}} 100%)',
                ],
            ]
        );

        $repeater_fields->end_controls_tab();

        $repeater_fields->end_controls_tabs();

        // ------------------------------ Button 01 ------------------------------
        $repeater_fields->add_control(
            'btn1_heading',
            [
                'label'     => __( 'Button 01', 'happy-elementor-addons' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $repeater_fields->add_control(
            'btn_label', [
                'label' => esc_html__( 'Button label', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Sign Up for Free',
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

        // ------------------------------ Button 02 ------------------------------
        $repeater_fields->add_control(
            'btn2_heading',
            [
                'label'     => __( 'Button 02', 'happy-elementor-addons' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $repeater_fields->add_control(
            'btn2_label', [
                'label' => esc_html__( 'Button label', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater_fields->add_control(
            'btn2_url', [
                'label' => esc_html__( 'Button URL', 'saasland-core' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#'
                ]
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


         //------------------------------ Style Feature Title  ------------------------------
         $this->start_controls_section(
            'style_f_color_sec', [
                'label' => __( 'Feature Title', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
			'f_title_color',
			[
				'label' => __( 'Text Color', 'saasland-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .payment_features_content .title_color' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'f_title_typography',
				'label' => __( 'Typography', 'saasland-core' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .payment_features_content .title_color',
			]
		);

        $this->end_controls_section();


         //------------------------------ Style Feature Subtitle  ------------------------------
         $this->start_controls_section(
            'style_f_color', [
                'label' => __( 'Feature Subtitle', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
			'f_subtitle_color',
			[
				'label' => __( 'Text Color', 'saasland-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .payment_features_content p' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'f_subtitle_typography',
				'label' => __( 'Typography', 'saasland-core' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .payment_features_content p',
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
                    '{{WRAPPER}} .payment_features_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',

                ],
            ]
        );

        // Shape 01
        $this->add_control(
            'is_shape1',
            [
                'label' => __( 'Shape 01', 'saasland-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'saasland-core' ),
                'label_off' => __( 'No', 'saasland-core' ),
                'return_value' => 'yes',
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'shape1_color', [
                'label'     => esc_html__( 'Shape 1 Color', 'saasland-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .square_box.box_three' => 'background-image: -webkit-linear-gradient(140deg, {{shape1_color_left.VALUE}} 0%, {{VALUE}} 100%)',
                ),
                'condition' => [
                    'is_shape1' => ['yes'],
                ],
            ]
        );

        // Shape 2
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
            'shape2_color', [
                'label'     => esc_html__( 'Shape 2 Color', 'saasland-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .square_box.box_four' => 'background-image: -webkit-linear-gradient(140deg, {{shape2_color_left.VALUE}} 0%, {{VALUE}} 100%)',
                ),
                'condition' => [
                    'is_shape2' => ['yes'],
                ],
            ]
        );

        // Shape 03
        $this->add_control(
            'is_shape3',
            [
                'label' => __( 'Shape 3', 'saasland-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'saasland-core' ),
                'label_off' => __( 'No', 'saasland-core' ),
                'return_value' => 'yes',
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'shape3_color', [
                'label'     => esc_html__( 'Shape 2  Color Left', 'saasland-core' ),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'is_shape2' => ['yes'],
                ]
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings();
        ?>
        <section class="payment_features_area">
            <?php if ( $settings['is_shape1'] == 'yes' ) : ?>
                <div class="bg_shape shape_one"></div>
            <?php endif; ?>
            <?php if ( $settings['is_shape2'] == 'yes' ) : ?>
                <div class="bg_shape shape_two"></div>
            <?php endif; ?>
            <?php if ( $settings['is_shape3'] == 'yes' ) : ?>
                <div class="bg_shape shape_three"></div>
            <?php endif; ?>
            <div class="container">
                <?php
                if (!empty($settings['features'])) {
                foreach ($settings['features'] as $i => $feature) {
                    $title_tag = !empty($feature['title_html_tag']) ? $feature['title_html_tag'] : 'h2';
                    ?>
                    <div class="row featured_item <?php echo ($feature['is_row_reverse'] == 'yes' ) ? 'flex-row-reverse' : ''; echo " elementor-repeater-item-{$feature['_id']}"; ?>">

                        <?php if (!empty($feature['image']['id'])) : ?>
                        <div class="col-lg-6">
                            <div class="payment_featured_img <?php echo ($feature['is_row_reverse'] == 'yes' ) ? 'img_two' : ''; ?> wow fadeInLeft" data-wow-delay="0.2s">
                                <?php echo wp_get_attachment_image($feature['image']['id'], 'full' ) ?>
                            </div>
                        </div>
                        <?php endif; ?>

                        <div class="col-lg-<?php echo !empty($feature['image']['id']) ? '6' : '12'; ?> d-flex align-items-center">
                            <div class="payment_features_content <?php echo ($feature['is_row_reverse'] == 'yes' ) ? 'pr_70' : 'pl_70'; ?> wow fadeInRight" data-wow-delay="0.3s">

                                <div class="icon">
                                    <img class="img_shape"
                                         src="<?php echo plugins_url( 'images/home9/icon_shape.png', __FILE__) ?>" alt="<?php echo esc_attr($feature['title']) ?>">
                                    <img class="icon_img" src="<?php echo $feature['icon']['url'] ?>" alt="<?php echo esc_attr($feature['title']) ?>">
                                </div>

                                <?php echo !empty($feature['title']) ? "<{$title_tag} class=title_color>{$feature['title']}</{$title_tag}>" : ''; ?>

                                <?php echo !empty($feature['subtitle']) ? "<p>{$feature['subtitle']}</p>" : ''; ?>

                                <?php if (!empty($feature['btn_label'])): ?>
                                    <a href="<?php echo esc_url($feature['btn_url']['url']); ?>"
                                        <?php saasland_is_external($feature['btn_url']) ?>
                                       class="btn_hover agency_banner_btn pay_btn pay_btn_one">
                                        <?php echo esc_html($feature['btn_label']); ?>
                                    </a>
                                <?php endif; ?>

                                <?php if (!empty($feature['btn2_label'])): ?>
                                    <a href="<?php echo esc_url($feature['btn2_url']['url']); ?>"
                                        <?php saasland_is_external($feature['btn2_url']) ?>
                                       class="btn_hover agency_banner_btn pay_btn pay_btn_two">
                                        <?php echo esc_html($feature['btn2_label']); ?>
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