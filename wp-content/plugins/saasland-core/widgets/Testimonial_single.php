<?php
namespace SaaslandCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Border;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class Testimonial_single
 * @package SaaslandCore\Widgets
 */
class Testimonial_single extends \Elementor\Widget_Base {

    public function get_name() {
        return 'Saasland_testimonial_single';
    }

    public function get_title() {
        return __( 'Testimonial Single', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-testimonial';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    public function get_script_depends() {
        return [ 'slick', 'imagesloaded', 'isotope' ];
    }

    protected function render() {
        $settings = $this->get_settings();
        ?>
        <section class="payment_testimonial_area">
            <div class="container">
                <div class="row payment_testimonial_info flex-row-reverse">
                    <div class="col-lg-7 d-flex align-items-center">
                        <div class="testimonial_content">
                            <div class="icon">,,</div>
                            <?php if (!empty($settings['testimonial_text'])) : ?>
                                <p class="f_p f_size_20"> <?php echo wp_kses_post(nl2br($settings['testimonial_text'])) ?> </p>
                            <?php endif; ?>
                            <?php if (!empty($settings['author'])) : ?>
                                <div class="author f_600 f_p t_color f_size_20"> <?php echo esc_html($settings['author']) ?> </div>
                            <?php endif; ?>
                            <?php if (!empty($settings['author_designation'])) : ?>
                                <div class="author_description f_p f_size_15"> <?php echo esc_html($settings['author_designation']) ?> </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="testimonial_img">
                            <?php echo wp_get_attachment_image($settings['author_image']['id'], 'full' ) ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }


    protected function _register_controls() {

        // ------------------------------  Title ------------------------------
        $this->start_controls_section(
            'contents', [
                'label' => __( 'Contents', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'author_image', [
                'label' => esc_html__( 'Testimonial Author Image', 'saasland-core' ),
                'description' => esc_html__( 'The recommended image dimension is 390x590', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'testimonial_text', [
                'label' => esc_html__( 'Testimonial Text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'This theme aute irure dolor in reprehe erit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur for the life sint occaecat cupidatat non proident, sunt in culpa qui officia de est laborum.'
            ]
        );

        $this->add_control(
            'author', [
                'label' => esc_html__( 'Testimonial Author', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'James Anderson'
            ]
        );

        $this->add_control(
            'author_designation', [
                'label' => esc_html__( 'Author Designation', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'UI/UX designer'
            ]
        );

        $this->end_controls_section(); // End title section


        // ------------------------------------- Style Testimonials Sections  ---------------------------//
        $this->start_controls_section(
            'style_author_sec', [
                'label' => __( 'Item Author Name', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'author_name_color', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .author.f_600.f_p.t_color.f_size_20' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'author_name_typography',
                'label' => __( 'Typography', 'saasland-core' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .author.f_600.f_p.t_color.f_size_20',
            ]
        );

        $this->end_controls_section();


        // ------------------------------------- Style Designation Section  ---------------------------//
        $this->start_controls_section(
            'designation_sec', [
                'label' => __( 'Item Designation', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'designation_color', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .author_description.f_p.f_size_15' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'designation_typography',
                'label' => __( 'Typography', 'saasland-core' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .author_description.f_p.f_size_15',
            ]
        );

        $this->end_controls_section();


        // ------------------------------------- Style Testimonials Sections  ---------------------------//
        $this->start_controls_section(
            'style_des_sec', [
                'label' => __( 'Item Description', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'description_color', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial_content p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'label' => __( 'Typography', 'saasland-core' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .testimonial_content p',
            ]
        );

        $this->end_controls_section();


        // ------------------------------------- Style Section ---------------------------//
        $this->start_controls_section(
            'style_section', [
                'label' => __( 'Style section', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'quote_color', [
                'label' => __( 'Quote Icon Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .payment_testimonial_info .testimonial_content .icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .payment_testimonial_area' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'sec_padding', [
                'label' => __( 'Section padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .payment_testimonial_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',

                ],
            ]
        );

        $this->end_controls_section();
    }



}