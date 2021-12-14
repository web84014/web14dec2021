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
 * Image Hotspots
 *
 */
class Hotspot extends Widget_Base {

    public function get_name() {
        return 'saasland_hotspot';
    }

    public function get_title() {
        return esc_html__( 'Image Hotspots', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-site-search';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    protected function _register_controls() {

        // ------------------------------  Title  ------------------------------
        $this->start_controls_section(
            'title_sec', [
                'label' => esc_html__( 'Title', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'title', [
                'label' => esc_html__( 'Title Text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'Device friendly widget'
            ]
        );

        $this->add_control(
            'title_html_tag',
            [
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
                'default' => 'h2',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'color_title', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .t_color3.l_height45.mb-30' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
                    {{WRAPPER}} .t_color3.l_height45.mb-30
                    '
            ]
        );

        $this->end_controls_section(); // End title section


        // ------------------------------  Subtitle ------------------------------
        $this->start_controls_section(
            'subtitle_sec', [
                'label' => __( 'Subtitle', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'subtitle', [
                'label' => esc_html__( 'Text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'color_subtitle', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_subtitle',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} p',
            ]
        );

        $this->end_controls_section(); // End title section


        // ------------------------------ Featured Image ------------------------------
        $this->start_controls_section(
            'featured_img_sec', [
                'label' => esc_html__( 'Screen Image', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'featured_image', [
                'label' => esc_html__( 'Image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/iPhonex.png', __FILE__)
                ]
            ]
        );

        $hotspots = new \Elementor\Repeater();
        $hotspots->add_control(
            'image',
            [
                'label' => __( 'Pointer Image', 'saasland-core' ),
                'description' => __( "It's a marker image with describing the pointed spot. See the default image as example.", 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/text_one.png', __FILE__)
                ]
            ]
        );
        $hotspots->add_control(
            'img_alt',
            [
                'label' => __( 'Image Alt Text', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Hot Spot'
            ]
        );
        $hotspots->add_responsive_control(
            'position',
            [
                'label' => __( 'Image Position', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'default' => [
                    'isLinked' => false
                ],
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .text_bg' => 'top: {{TOP}}{{UNIT}}; right: {{RIGHT}}{{UNIT}}; bottom: {{BOTTOM}}{{UNIT}}; left: {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $hotspots->add_responsive_control(
            'pointer_position',
            [
                'label' => __( 'Pointer Position', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'default' => [
                    'isLinked' => false
                ],
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .dot' => 'top: {{TOP}}{{UNIT}}; right: {{RIGHT}}{{UNIT}}; bottom: {{BOTTOM}}{{UNIT}}; left: {{LEFT}}{{UNIT}};',
                ],

            ]
        );
        $hotspots->add_control(
            'pointer_anim',
            [
                'label' => __( 'Pointer Animation Effect', 'saasland-core' ),
                'type' => Controls_Manager::ANIMATION,
                'default' => 'fadeIn'
            ]
        );
        $hotspots->add_control(
            'image_anim',
            [
                'label' => __( 'Image Animation Effect', 'saasland-core' ),
                'type' => Controls_Manager::ANIMATION,
                'default' => 'fadeInLeft'
            ]
        );

        $this->add_control(
            'hotspots', [
                'label' => __( 'Hotspots', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'title_field' => '{{{ img_alt }}}',
                'fields' => $hotspots->get_controls(),
            ]
        );

        $this->end_controls_section();



        // ------------------------------ Button ------------------------------
        $this->start_controls_section(
            'button', [
                'label' => esc_html__( 'Button', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'btn_label', [
                'label' => esc_html__( 'Button label', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Get Started',
            ]
        );

        $this->add_control(
            'btn_url', [
                'label' => esc_html__( 'Button URL', 'saasland-core' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#'
                ]
            ]
        );

        $this->start_controls_tabs(
            'style_tabs_btn'
        );

        /// Normal Button Style
        $this->start_controls_tab(
            'style_normal_btn',
            [
                'label' => __( 'Normal', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'btn_text_color', [
                'label' => esc_html__( 'Text color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .app_btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_bg_color', [
                'label' => esc_html__( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .app_btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'normal_border_color', [
                'label' => __( 'Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .app_btn' => 'border: 1px solid {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        /// Hover Button Style
        $this->start_controls_tab(
            'style_hover_btn',
            [
                'label' => __( 'Hover', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'btn_text_color_hover', [
                'label' => esc_html__( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .app_btn:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_bg_color_hover', [
                'label' => esc_html__( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .app_btn:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hover_border_color', [
                'label' => __( 'Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .app_btn:hover' => 'border: 1px solid {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section(); // End the Button


        /**
         * Style Tab
         */
        //------------------------------ Style Section ------------------------------
        $this->start_controls_section(
            'style_section', [
                'label' => __( 'Style section', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'is_triangle_shape',
            [
                'label' => __( 'Triangle Shape', 'saasland-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'saasland-core' ),
                'label_off' => __( 'No', 'saasland-core' ),
                'return_value' => 'yes',
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'triangle_bg_color', [
                'label' => __( 'Triangle Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .triangle_shape' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'triangle_bg_dimension', [
                'label' => __( 'Triangle Dimension', 'saasland-core' ),
                'type' => Controls_Manager::IMAGE_DIMENSIONS,
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings();
        $title_tag = !empty($settings['title_html_tag']) ? $settings['title_html_tag'] : 'h2';

        ?>
        <section class="app_featured_area_two">
            <?php if ( $settings['is_triangle_shape'] == 'yes' ) : ?>
                <div class="triangle_shape"></div>
            <?php endif; ?>
            <div class="container">
            <div class="row app_feature_info">
                <div class="col-lg-5">
                    <div class="app_img">
                        <?php
                        if (!empty($settings['hotspots'])) {
                            foreach ($settings['hotspots'] as $i => $hotspot) { ?>

                                <div class="dot_object elementor-repeater-item-<?php echo esc_attr(  $hotspot['_id'] ) ?>">
                                    <div class="dot dot_three wow <?php echo esc_attr($hotspot['pointer_anim']) ?>" data-wow-delay="0.3s">
                                        <span class="dot1"></span><span class="dot2"></span>
                                    </div>
                                    <img class="text_bg pointer_img<?php echo esc_attr($i) ?> one wow <?php echo esc_attr($hotspot['image_anim']) ?>" data-wow-delay="0.8s"
                                         src="<?php echo esc_url($hotspot['image']['url']) ?>"
                                         alt="<?php echo esc_attr($hotspot['img_alt']) ?>">
                                </div>
                                <?php
                            }
                        }
                        ?>
                        <img class="wow fadeIn phone_img" src="<?php echo esc_url($settings['featured_image']['url']) ?>" alt="<?php echo esc_attr($settings['title']) ?>">
                    </div>
                </div>
                <div class="col-lg-7 d-flex align-items-center">
                    <div class="app_featured_content">
                        <?php if (!empty($settings['title'])) : ?>
                            <<?php echo $title_tag; ?> class="f_p f_size_30 f_700 t_color3 l_height45 mb-30">
                                <?php echo wp_kses_post(nl2br($settings['title'])) ?>
                            </<?php echo $title_tag; ?>>
                        <?php endif; ?>
                        <?php if (!empty($settings['subtitle'])) : ?>
                            <p class="f_300">
                                <?php echo nl2br($settings['subtitle']) ?>
                            </p>
                        <?php endif; ?>
                        <?php if (!empty($settings['btn_label'])): ?>
                            <a href="<?php echo esc_url($settings['btn_url']['url']); ?>"
                                <?php saasland_is_external($settings['btn_url']) ?>
                                <?php echo saasland_is_external($settings['btn_url']); ?>
                               class="app_btn btn_hover mt_40">
                                <?php echo esc_html($settings['btn_label']); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            </div>
        </section>
        <?php
    }
}