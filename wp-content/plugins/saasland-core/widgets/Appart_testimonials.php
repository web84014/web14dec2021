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
 * Text Typing Effect
 *
 * Elementor widget for text typing effect.
 *
 * @since 1.7.0
 */
class Appart_testimonials extends Widget_Base {

    public function get_name() {
        return 'saasland_appart_testimonials';
    }

    public function get_title() {
        return __( 'Testimonials Style', 'saasland-core' );
    }

    public function get_icon() {
        return ' eicon-testimonial-carousel';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    public function get_style_depends() {
        return [ 'appart-style', 'appart-responsive', 'owl-carousel' ];
    }

    public function get_script_depends() {
        return [ 'owl-carousel' ];
    }

    protected function _register_controls() {

        // ------------------------------  Title Section ------------------------------
        $this->start_controls_section(
            'title_sec', [
                'label' => __( 'Title section', 'saasland-core' ),
                'condition' => [
                    'style' => ['style_01', 'style_02']
                ]
            ]
        );
        $this->add_control(
            'title_text', [
                'label' => esc_html__( 'Title text', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Users Review'
            ]
        );
        $this->add_control(
            'subtitle_text', [
                'label' => esc_html__( 'Subtitle text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut<br> fugit, sed consequuntur magni dolores ratione voluptatem sequi nesciunt.'
            ]
        );
        $this->end_controls_section(); // End title section

        // ------------------------------ Testimonial items ------------------------------
        $this->start_controls_section(
            'testimonial_sec', [
                'label' => __( 'Testimonial items', 'saasland-core' ),
            ]
        );
        $this->add_control(
            'testimonials', [
                'label' => __( 'Testimonials', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'title_field' => '{{{ author_name }}}',
                'fields' => [
                    [
                        'name' => 'author_name',
                        'label' => esc_html__( 'Quote Author Name', 'saasland-core' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => 'Eh Jewel',
                    ],
                    [
                        'name' => 'author_url',
                        'type' =>  Controls_Manager::TEXT,
                        'label' => esc_html__( 'Quote Author URL', 'saasland-core' ),
                        'default' => '#',
                    ],
                    [
                        'name' => 'author_designation',
                        'type' => Controls_Manager::TEXT,
                        'label' => esc_html__( 'Author Designation', 'saasland-core' ),
                        'default' => 'Programmer @ DroitLab'
                    ],
                    [
                        'name' => 'quote',
                        'type' => Controls_Manager::TEXTAREA,
                        'label' => esc_html__( 'Quote Text', 'saasland-core' ),
                        'default' => 'Lorem ipsum dolor sit amet consectetur adipiscing elit donec tempus pellentesque dui vel tristique purus justo vestibulum eget lectus non gravida ultrices'
                    ],
                    [
                        'name' => 'author_image',
                        'type' => Controls_Manager::MEDIA,
                        'label' => esc_html__( 'Quote Author image', 'saasland-core' ),
                    ],
                ],
            ]
        );
        $this->end_controls_section();


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
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .title-four h2' => 'color: {{VALUE}};',
                ],
                'default' => '#1a264a'
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_prefix',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .title-four h2',
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
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .title-four p' => 'color: {{VALUE}};',
                ],
                'default' => '#585e68'
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_subtitle',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .title-four p',
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
        $this->add_control(
            'style', [
                'label' => esc_html__( 'Style', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_01' => esc_html__( 'Style one ', 'saasland-core' ),
                    'style_02' => esc_html__( 'Style two ', 'saasland-core' ),
                    'style_03' => esc_html__( 'Style three', 'saasland-core' ),
                ],
                'default' => 'style_01'
            ]
        );
        $this->add_control(
            'sec_bg_image', [
                'label' => esc_html__( 'Background image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'condition' => [
                    'style' => 'style_03'
                ]
            ]
        );
        $this->add_responsive_control (
            'sec_padding', [
                'label' => __( 'Section padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .testimonial_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .testimonial-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .testimonial_area_two' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => '110',
                    'right' => '0',
                    'bottom' => '100',
                    'left' => '0',
                    'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',

                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();
        $quotes = isset($settings['testimonials']) ? $settings['testimonials'] : '';

        if ( $settings['style'] == 'style_01' ) {
            ?>
            <section class="testimonial_area">
                <div class="container">
                    <div class="title-four text-center">
                        <?php if (!empty($settings['title_text'])) : ?>
                            <h2 class="wow fadeInUp"> <?php echo esc_html($settings['title_text']); ?> </h2>
                        <?php endif; ?>
                        <?php if (!empty($settings['subtitle_text'])) : ?>
                            <div class="wow fadeInUp" data-wow-delay="300ms"><?php echo wpautop($settings['subtitle_text']); ?></div>
                        <?php endif;?>
                    </div>
                    <div class="row">
                        <div class="testimonial-carousel owl-carousel">
                            <?php
                            if (is_array($quotes)) {
                                foreach ($quotes as $quote) {
                                    ?>
                                    <div class="testimonial-item">
                                        <?php if (!empty($quote['author_image']['url'])) : ?>
                                            <div class="icon">
                                                <img src="<?php echo esc_url($quote['author_image']['url']); ?>" alt="">
                                            </div>
                                        <?php endif; ?>
                                        <p> <?php echo $quote['quote'] ?> </p>
                                        <div class="media">
                                            <div class="media-body">
                                                <h2> <?php echo $quote['author_name']; ?> </h2>
                                                <h6> <?php echo $quote['author_designation']; ?> </h6>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </section>

            <script>
                ;(function($){
                    "use strict";
                    $(document).ready(function () {
                        var testimonials = $(".testimonial-carousel");
                        if (testimonials.length) {
                            testimonials.owlCarousel({
                                loop:true,
                                <?php echo ( is_rtl() ) ? "rtl: true," : ''; ?>
                                margin:0,
                                items:2,
                                autoplay:true,
                                autoplayHoverPause: true,
                                smartSpeed:1000,
                                nav: false,
                                responsiveClass:true,
                                responsive:{
                                    0:{
                                        items:1,
                                    },
                                    720:{
                                        items:2,
                                    },
                                },
                            })
                        }
                    })
                })(jQuery)
            </script>
            <?php
        }

        elseif ( $settings['style']=='style_02' ) {
            ?>
            <section class="testimonial_area_two">
                <div class="container">
                    <div class="title-four h_color text-center">
                        <?php if (!empty($settings['title_text'])) : ?> <h2 class="wow fadeInUp"> <?php echo esc_html($settings['title_text']); ?> </h2> <?php endif; ?>
                        <?php if (!empty($settings['subtitle_text'])) : ?>
                            <?php echo '<p class="p_color wow fadeInUp" data-wow-delay="300ms">'.$settings['subtitle_text']."</p>";
                        endif; ?>
                    </div>
                    <div id="carouselExampleIndicators" class="carousel slide testimonial_info" data-ride="carousel">
                        <div class="carousel-inner">
                            <?php
                            if (is_array($quotes)) {
                                $count  = 0;
                                foreach ($quotes as $quote) {
                                    ?>
                                    <div class="carousel-item <?php if ($count === 1){echo esc_attr( 'active' );}?>">
                                        <div class="carousel_text">
                                            <img src="<?php echo plugin_dir_url(__FILE__).'images/appart-new/quote2.png'; ?>" alt="f_img">
                                            <?php if (!empty($quote['quote'])) : ?>
                                                <p><?php echo $quote['quote']; ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php
                                    $count++;
                                }}
                            ?>
                        </div>
                        <ol class="carousel-indicators">
                            <?php
                            if (is_array($quotes)) {
                                $count  = 0;
                                foreach ($quotes as $quote) {
                                    ?>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $count ?>" class="<?php if ($count === 1){echo esc_attr( 'active' );}?>">
                                        <div class="slider_thumbs">
                                            <?php if (!empty($quote['author_image']['url'])) : ?>
                                                <img src="<?php echo esc_url($quote['author_image']['url']); ?>" alt="<?php echo $quote['author_name']; ?>">
                                            <?php endif; ?>
                                            <div class="thumbs_text">
                                                <h2><?php echo $quote['author_name']; ?></h2>
                                                <p><?php echo $quote['author_designation']; ?></p>
                                            </div>
                                        </div>
                                    </li>
                                    <?php
                                    $count++;
                                }}
                            ?>
                        </ol>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <i class="ti-arrow-left"></i>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <i class="ti-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </section>
            <?php
        }

        elseif ( $settings['style']=='style_03' ) {
            wp_enqueue_style( 'slick' );
            wp_enqueue_style( 'slick-theme' );
            if (!empty($settings['sec_bg_image']['url'])) : ?>
                <style>
                    .testimonial-area:before {
                        background: url(<?php echo esc_url($settings['sec_bg_image']['url']) ?>) no-repeat center 0/cover;
                    }
                </style>
            <?php endif; ?>
            <section class="testimonial-area testimonial-three">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5 col-12">
                            <div class="slick testimonial-img">
                                <?php
                                if (is_array($quotes)) {
                                    $count  = 0;
                                    foreach ($quotes as $quote) {
                                        ?>
                                        <div class="item">
                                            <?php if (!empty($quote['author_image']['url'])) : ?>
                                                <img src="<?php echo esc_url($quote['author_image']['url']); ?>" alt="<?php echo $quote['author_name']; ?>">
                                            <?php endif; ?>
                                        </div>
                                        <?php
                                    }}
                                ?>
                            </div>
                        </div>
                        <div class="col-md-7 col-12">
                            <div class="slick testimonial_slider_five">
                                <?php
                                if (is_array($quotes)) {
                                    $count  = 0;
                                    foreach ($quotes as $quote) {
                                        ?>
                                        <div class="testimonial-content flex">
                                            <img class="quote" src="<?php echo plugin_dir_url(__FILE__).'images/quote3.png'; ?>" alt="<?php esc_attr_e( 'quot icon', 'saasland-core' ) ?>">
                                            <?php if (!empty($quote['quote'])) : ?>
                                                <p>“<?php echo $quote['quote']; ?>”</p>
                                            <?php endif; ?>
                                            <h5><a href="#"> <?php echo $quote['author_name']; ?> </a> <?php echo $quote['author_designation']; ?> </h5>
                                        </div>
                                        <?php
                                    }}
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <script src="<?php echo plugin_dir_url(__FILE__).'js/slick.min.js' ?>"> </script>
            <script>
                jQuery( '.testimonial_slider_five' ).slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                    dots: true,
                    asNavFor: '.testimonial-img'
                });
                jQuery( '.testimonial-img' ).slick({
                    slidesToShow: 1,
                    Padding: '0px',
                    slidesToScroll: 1,
                    asNavFor: '.testimonial_slider_five',
                    dots: false,
                    arrows: false,
                    fade: true,
                });
            </script>
            <?php
        }
    }
}