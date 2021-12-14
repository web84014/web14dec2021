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
 * Class Testimonial_bubble
 * @package SaaslandCore\Widgets
 */
class Testimonial_bubble extends \Elementor\Widget_Base {

    public function get_name() {
        return 'saasland_testimonial_bubble';
    }

    public function get_title() {
        return __( 'Bubble Testimonials', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-testimonial-carousel';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    public function get_style_depends() {
        return [ 'owl-carousel' ];
    }

    public function get_script_depends() {
        return [ 'owl-carousel' ];
    }

    protected function render() {
        $settings = $this->get_settings();
        $testimonials = isset($settings['testimonials']) ? $settings['testimonials'] : '';

        if ( $settings['style'] == 'style_01' ) :
            if (!empty($settings['testimonial_bg_shape']['url'])) {
                ?>
                <style>
                    .testimonial_area_five .stratup_testimonial_info:before {
                        background: url(<?php echo esc_url($settings['testimonial_bg_shape']['url']) ?>) no-repeat scroll center 0/contain;
                    }
                </style>
                <?php
            }
            $bg_shape =  !empty($settings['bg_shape']['url']) ? "style=\"background: url({$settings['bg_shape']['url']}) no-repeat bottom left;\"" : '';
            ?>
            <section class="testimonial_area_five sec_pad" <?php echo $bg_shape ?>>
                <div class="testimonial_shap_img" ></div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 d-flex align-items-center">
                            <div class="testimonial_title">
                                <?php if (!empty($settings['subtitle'])) : ?>
                                    <h6> <?php echo esc_html($settings['subtitle']) ?> </h6>
                                <?php endif; ?>
                                <?php if (!empty($settings['title'])) : ?>
                                    <h2 class="f_p f_size_30 l_height45 f_600 t_color"> <?php echo wp_kses_post(nl2br($settings['title'])) ?> </h2>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-6 offset-lg-2">
                            <div class="stratup_testimonial_info d-flex align-items-center">
                                <div class="testimonial_slider_four owl-carousel">
                                    <?php
                                    foreach ($testimonials as $testimonial) {
                                        ?>
                                        <div class="item">
                                            <div class="author_img">
                                                <?php echo wp_get_attachment_image($testimonial['author_image']['id'], 'saasland_70x70' ) ?>
                                            </div>
                                            <?php echo wpautop($testimonial['content']) ?>
                                            <?php echo (!empty($testimonial['name'])) ? '<h5>'.$testimonial['name'].'</h5>' : ''; ?>
                                            <?php echo (!empty($testimonial['designation'])) ? '<h6>'.$testimonial['designation'].'</h6>' : ''; ?>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php
        elseif ( $settings['style'] == 'style_02' ) :
            ?>
            <section class="testimonial_area sec_pad">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5 d-flex align-items-center">
                            <div class="testimonial_title">
                                <div class="seo_sec_title wow fadeInUp" data-wow-delay="0.3s">
                                    <?php
                                    echo (!empty($settings['title'])) ? '<h2>'.($settings['title']).'</h2>' : '';
                                    echo (!empty($settings['subtitle'])) ? wpautop($settings['subtitle']) : '';
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 offset-lg-1">
                            <div class="stratup_testimonial_info d-flex align-items-center">
                                <div class="testimonial_slider_four owl-carousel">
                                    <?php
                                    foreach ($testimonials as $testimonial) {
                                        ?>
                                        <div class="item">
                                            <?php
                                            if( !empty( $testimonial['author_image']['id'] ) ){ ?>
                                                <div class="author_img">
                                                    <?php echo wp_get_attachment_image($testimonial['author_image']['id'], 'saasland_70x70' ) ?>
                                                </div>
                                            <?php
                                            }
                                            echo wpautop($testimonial['content']);
                                            echo (!empty($testimonial['name'])) ? '<h5>'.$testimonial['name'].'</h5>' : '';
                                            echo (!empty($testimonial['designation'])) ? '<h6>'.$testimonial['designation'].'</h6>' : '';
                                            ?>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php
        endif;
        ?>

        <script>
            ;(function($){
                "use strict";
                $(document).ready(function () {
                    var tSlider = $(".testimonial_slider_four");
                    if (tSlider.length) {
                        tSlider.owlCarousel({
                            loop: true,
                            margin: 10,
                            items: 1,
                            autoplay: true,
                            smartSpeed: 1000,
                            responsiveClass: true,
                            nav: true,
                            <?php echo ( is_rtl() ) ? "rtl: true," : ''; ?>
                            dots: false,
                            <?php if ( !is_rtl() ) : ?>
                            navText: ['<i class="ti-angle-left"></i>', '<i class="ti-angle-right"></i>'],
                            <?php endif; ?>
                            <?php if ( is_rtl() ) : ?>
                            navText: ['<i class="ti-angle-right"></i>', '<i class="ti-angle-left"></i>'],
                            <?php endif; ?>
                            navContainer: '.testimonial_title'
                        })
                    }
                })
            })(jQuery)
        </script>
        <?php
    }


    protected function _register_controls() {

        // ------------------------------  Title ------------------------------
        $this->start_controls_section(
            'title_sec', [
                'label' => __( 'Title', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'title', [
                'label' => esc_html__( 'Title text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => "We've heard things like"
            ]
        );

        $this->add_control(
            'color_title', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} h2' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .seo_sec_title h2' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} h2, {{WRAPPER}} .seo_sec_title h2',
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
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'color_subtitle', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial_title > h6' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .seo_sec_title > p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_subtitle',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .testimonial_title > h6, {{WRAPPER}} .seo_sec_title > p',
            ]
        );

        $this->end_controls_section(); // End title section


        // ------------------------------  Contents ------------------------------
        $this->start_controls_section(
            'content_sec', [
                'label' => __( 'Testimonials Section', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'testimonials', [
                'label' => __( 'Testimonials', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'title_field' => '{{{ name }}}',
                'fields' => [
                    [
                        'name' => 'name',
                        'label' => __( 'Name', 'saasland-core' ),
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default' => 'Mark Tony'
                    ],
                    [
                        'name' => 'designation',
                        'label' => __( 'Designation', 'saasland-core' ),
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default' => 'Software Developer'
                    ],
                    [
                        'name' => 'content',
                        'label' => __( 'Testimonial Text', 'saasland-core' ),
                        'type' => Controls_Manager::TEXTAREA,
                        'label_block' => true,
                    ],
                    [
                        'name' => 'author_image',
                        'label' => __( 'Author Image', 'saasland-core' ),
                        'type' => Controls_Manager::MEDIA,
                    ],
                ],
            ]
        );

        $this->add_control(
            'testimonial_bg_shape', [
                'label' => __( 'Background Shape', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
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

        // Style
        $this->add_control(
            'style', [
                'label' => __( 'Style', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_01' => esc_html__( 'Style One', 'saasland-core' ),
                    'style_02' => esc_html__( 'Style Two', 'saasland-core' ),
                ],
                'default' => 'style_01'
            ]
        );

        $this->add_control(
            'bg_shape', [
                'label' => __( 'Background Shape', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/testimonial_bg_shap.png', __FILE__)
                ]
            ]
        );

        $this->add_responsive_control(
            'sec_padding', [
                'label' => __( 'Section padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .testimonial_area_five' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .testimonial_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',

                ],
            ]
        );

        $this->end_controls_section();
    }



}