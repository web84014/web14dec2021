<?php
namespace SaaslandCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Box_Shadow;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Hero ERP
 */
class Hero_erp extends Widget_Base {

    public function get_name() {
        return 'Saasland_hero_erp';
    }

    public function get_title() {
        return __( 'Hero ERP', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-device-desktop';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    protected function _register_controls() {

        // ----------------------------------------  Hero content ------------------------------
        $this->start_controls_section(
            'hero_content',
            [
                'label' => esc_html__( 'Hero Contents', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'title_text',
            [
                'label' => esc_html__( 'Title Text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Cloud ERP Software for Small and medium business'
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
                'default' => 'h1',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => esc_html__( 'Subtitle text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );

        $this->end_controls_section(); // End Hero content

        /* --------------------------------------- Featured Image ------------------------------*/
        $this->start_controls_section(
            'f_img_sec', [
                'label' => esc_html__( 'Featured Image', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'fimage', [
                'label' => esc_html__( 'Upload the featured image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'dafault' => [
                    'url'   => '#'
                ]
            ]
        );

        $this->end_controls_section(); // End Featured image


        /// ------------------------- Shape Images ---------------------------- ////
        $this->start_controls_section(
            'cloud_image_sec',
            [
                'label' => esc_html__( 'Moving Images', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'shape1', [
                'label' => esc_html__( 'Image One', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( '/images/home-erp/shape/cloud_01.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'shape2', [
                'label' => esc_html__( 'Image Two', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( '/images/home-erp/shape/cloud_02.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'shape3', [
                'label' => esc_html__( 'Image Three', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( '/images/home-erp/shape/cloud_03.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'shape4', [
                'label' => esc_html__( 'Image Four', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( '/images/home-erp/shape/cloud_04.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'shape5', [
                'label' => esc_html__( 'Image Five', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( '/images/home-erp/shape/cloud_05.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'shape6', [
                'label' => esc_html__( 'Image Six', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( '/images/home-erp/shape/cloud_06.png', __FILE__)
                ]
            ]
        );

        $this->end_controls_section(); // End Shape Images


        /// ------------------------- Buttons ---------------------------- ////
        $this->start_controls_section(
            'buttons_sec',
            [
                'label' => esc_html__( 'Buttons', 'saasland-core' ),
            ]
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'btn_label', [
                'label' => esc_html__( 'Button Label', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Get Started'
            ]
        );

        $repeater->add_control(
            'btn_url', [
                'label' => esc_html__( 'Button URL', 'saasland-core' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#'
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
                'label' => esc_html__( 'Normal', 'saasland-core' ),
            ]
        );

        $repeater->add_control(
            'font_color', [
                'label' => esc_html__( 'Font Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}}',
                )
            ]
        );

        $repeater->add_control(
            'bg_color', [
                'label' => esc_html__( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'background-color: {{VALUE}}',
                )
            ]
        );

        $repeater->add_control(
            'border_color', [
                'label' => esc_html__( 'Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'border: 1px solid {{VALUE}}',
                )
            ]
        );

        $repeater->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'btn_box_shadow_normal',
                'label' => __( 'Box Shadow', 'saasland-core' ),
                'selector' => '{{WRAPPER}} .erp_banner_area_two .section_container .intro_content .er_btn',
            ]
        );

        $repeater->end_controls_tab();

        /// ----------------------------- Hover Button Style-------------------------/////
        $repeater->start_controls_tab(
            'style_hover_btn',
            [
                'label' => esc_html__( 'Hover', 'saasland-core' ),
            ]
        );

        $repeater->add_control(
            'hover_font_color', [
                'label' => esc_html__( 'Font Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'color: {{VALUE}}',
                )
            ]
        );

        $repeater->add_control(
            'hover_bg_color', [
                'label' => esc_html__( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'background-color: {{VALUE}}',
                )
            ]
        );

        $repeater->add_control(
            'hover_border_color', [
                'label' => esc_html__( 'Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'border: 1px solid {{VALUE}}',
                )
            ]
        );

        $repeater->end_controls_tab();

        $this->add_control(
            'buttons', [
                'label' => esc_html__( 'Create buttons', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'title_field' => '{{{ btn_label }}}',
                'fields' => $repeater->get_controls(),
            ]
        );

        $this->end_controls_section(); // End Buttons




        /**
         * Style Tab
         * ------------------------------ Style Title ------------------------------
         */
        $this->start_controls_section(
            'style_title', [
                'label' => __( 'Title', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'color_title', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title_erp' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
                    {{WRAPPER}} .title_erp',
            ]
        );

        $this->add_control(
            'color_typed_text', [
                'label' => __( 'Typed Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} h2 mark' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'color_underline_typed_text', [
                'label' => __( 'Typed Text Underline Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} h2 mark:after' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();


        //  ------------------------------ Style Subtitle ------------------------------
        $this->start_controls_section(
            'style_subtitle', [
                'label' => __( 'Subtitle', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'color_subtitle', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .intro_content p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_subtitle',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
                    {{WRAPPER}} .intro_content p',
            ]
        );

        $this->end_controls_section();


        //------------------------------ Style Section ------------------------------
        $this->start_controls_section(
            'style_section', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'color_sec_bg', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .erp_banner_area_two' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        /* --------------------------------------- Background Image ------------------------------*/
        $this->start_controls_section(
            'bg_img_sec', [
                'label' => esc_html__( 'Background Image', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'bg_image', [
                'label' => esc_html__( 'Upload the featured image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'dafault' => [
                    'url'   => '#'
                ]
            ]
        );

        $this->end_controls_section(); // End Featured image

        $this->start_controls_section(
            'sec_padding_sec', [
                'label' => esc_html__( 'Section padding', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'sec_padding', [
                'label' => __( 'Section padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .erp_banner_area_two' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {

        $settings = $this->get_settings();
        $buttons = $settings['buttons']; $title_tag = !empty($settings['title_html_tag']) ? $settings['title_html_tag'] : 'h1';
        ?>
        <section class="erp_banner_area_two">
            <ul class="list-unstyled cloud_animation">
                <?php if (!empty($settings['shape1']['url'])) : ?>
                    <li><img src="<?php echo esc_url($settings['shape1']['url']) ?>" alt="<?php echo esc_attr($settings['title_text']) ?>"></li>
                <?php endif; ?>

                <?php if (!empty($settings['shape2']['url'])) : ?>
                    <li><img src="<?php echo esc_url($settings['shape2']['url']) ?>" alt="<?php echo esc_attr($settings['title_text']) ?>"></li>
                <?php endif; ?>

                <?php if (!empty($settings['shape3']['url'])) : ?>
                    <li><img src="<?php echo esc_url($settings['shape3']['url']) ?>" alt="<?php echo esc_attr($settings['title_text']) ?>"></li>
                <?php endif; ?>

                <?php if (!empty($settings['shape4']['url'])) : ?>
                    <li><img src="<?php echo esc_url($settings['shape4']['url']) ?>" alt="<?php echo esc_attr($settings['title_text']) ?>"></li>
                <?php endif; ?>

                <?php if (!empty($settings['shape5']['url'])) : ?>
                    <li><img src="<?php echo esc_url($settings['shape5']['url']) ?>" alt="<?php echo esc_attr($settings['title_text']) ?>"></li>
                <?php endif; ?>

                <?php if (!empty($settings['shape6']['url'])) : ?>
                    <li><img src="<?php echo esc_url($settings['shape6']['url']) ?>" alt="<?php echo esc_attr($settings['title_text']) ?>"></li>
                <?php endif; ?>

            </ul>
            <div class="erp_shap"></div>
            <div class="erp_shap_two" style="background: url(<?php echo esc_url($settings['bg_image']['url']) ?>) no-repeat scroll top left;"></div>
            <div class="section_intro">
                <div class="section_container">
                    <div class="intro">
                        <div class=" intro_content">
                            <?php if ( !empty($settings['title_text']) ) : ?>
                                <<?php echo $title_tag; ?> class="title_erp"><?php echo esc_html($settings['title_text']) ?></<?php echo $title_tag ?>>
                            <?php endif; ?>
                            <?php if ( !empty($settings['subtitle']) ) : ?>
                                <?php echo wpautop($settings['subtitle']) ?>
                            <?php endif; ?>
                            <?php
                            if (!empty( $buttons )) {
                            foreach ( $buttons as $button ) {
                                ?>
                                <?php if (!empty($button['btn_label'])) : ?>
                                    <a href="<?php echo esc_url($button['btn_url']['url']) ?>" class="er_btn er_btn_two elementor-repeater-item-<?php echo $button['_id'] ?>"
                                        <?php saasland_is_external($button['btn_url']) ?>>
                                        <?php echo esc_html($button['btn_label']) ?>
                                    </a>
                                <?php endif; ?>
                                <?php
                            }}
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="animation_img wow fadeInUp" data-wow-delay="0.3s">
                <div class="container">
                    <?php echo wp_get_attachment_image( $settings['fimage']['id'], 'full' ); ?>
                </div>
            </div>
        </section>
        <?php
    }
}
