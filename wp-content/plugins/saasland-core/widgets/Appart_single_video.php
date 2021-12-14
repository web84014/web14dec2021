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
 * Text Typing Effect
 *
 * Elementor widget for text typing effect.
 *
 * @since 1.7.0
 */
class Appart_single_video extends Widget_Base {

    public function get_name() {
        return 'Saasland_appart_single_video';
    }

    public function get_title() {
        return __( 'Single Video 02', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-play';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    public function get_style_depends() {
        return [ 'appart-style', 'appart-responsive' ];
    }

    protected function _register_controls() {

        // ------------------------------  Title Section ------------------------------
        $this->start_controls_section(
            'title_sec', [
                'label' => __( 'Title section', 'saasland-core' ),
            ]
        );
        $this->add_control(
            'title_text', [
                'label' => esc_html__( 'Title text', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Discover The New App'
            ]
        );
        $this->add_control(
            'subtitle_text', [
                'label' => esc_html__( 'Subtitle text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );
        $this->end_controls_section(); // End title section

        // ------------------------------ Video ------------------------------
        $this->start_controls_section(
            'video_atts', [
                'label' => __( 'Video', 'saasland-core' ),
            ]
        );
        $this->add_control(
            'video_url', [
                'label' => esc_html__( 'Video url', 'saasland-core' ),
                'description' => esc_html__('Just Copy the scr URL from YouTube Video embed code. Sample url here https://www.youtube.com/embed/hgzzLIa-93c', 'saasland-core'),
                'type' => Controls_Manager::TEXT,
                'default' => 'https://www.youtube.com/embed/hgzzLIa-93c',
                'label_block' => true,
            ]
        );
        $this->add_control(
            'video_poster', [
                'label' => esc_html__( 'Video poster', 'saasland-core' ),
                'desc' => esc_html__( 'Upload here the video poster image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );
        $this->add_control(
            'play_btn_label', [
                'label' => esc_html__( 'Play button label', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Play the video'
            ]
        );
        $this->end_controls_section(); // End title section



        /**
         * Style Tab
         * ------------------------------ Style Title ------------------------------
         */
        $this->start_controls_section(
            'style_title',
            [
                'label' => __( 'Style section title', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'color_prefix', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title-four h2' => 'color: {{VALUE}};',
                ],
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
                'selectors' => [
                    '{{WRAPPER}} .video-left .video-inner p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .demo-video .app-video p' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_subtitle',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .video-left .video-inner p, {{WRAPPER}} .demo-video .app-video p',
            ]
        );
        $this->end_controls_section();


        //------------------------------ Style Video ------------------------------
        $this->start_controls_section(
            'style_video', [
                'label' => __( 'Style video', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'style', [
                'label' => esc_html__( 'Style', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [
                    'style_01' => esc_html__( 'Style one', 'saasland-core' ),
                    'style_02' => esc_html__( 'Style two', 'saasland-core' ),
                ],
                'default' => 'style_01'
            ]
        );
        $this->add_control(
            'video_overlay', [
                'label' => _x( 'Video overlay type', 'Background Control', 'saasland-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'gradient' => [
                        'title' => 'Gradient',
                        'icon' => 'eicon-barcode'
                    ],
                    'solid' => [
                        'title' => 'Solid',
                        'icon' => 'eicon-paint-brush'
                    ]
                ],
                'condition' => [
                    'style' =>  'style_01'
                ]
            ]
        );
        $this->add_control(
            'color', [
                'label' => _x( 'Color', 'Background Control', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'title' => _x( 'Background Color', 'Background Control', 'saasland-core' ),
                'condition' => [
                    'video_overlay' => [ 'solid', 'gradient' ],
                    'style' =>  'style_01'
                ],
            ]
        );
        $this->add_control(
            'color_b', [
                'label' => _x( 'Second Color', 'Background Control', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'render_type' => 'ui',
                'condition' => [
                    'video_overlay' => [ 'gradient' ],
                    'style' =>  'style_01'
                ],
                'of_type' => 'gradient'
            ]
        );
        $this->add_control(
            'gradient_angle', [
                'label' => _x( 'Angle', 'Background Control', 'saasland-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'deg' ],
                'default' => [
                    'unit' => 'deg',
                    'size' => 0,
                ],
                'condition' => [
                    'video_overlay' => [ 'gradient' ],
                    'style' => 'style_01'
                ],
                'range' => [
                    'deg' => [
                        'step' => 10,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .videoWrapper .videoPoster:after' => 'background-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{color.VALUE}} {{color_stop.SIZE}}{{color_stop.UNIT}}, {{color_b.VALUE}} {{color_b_stop.SIZE}}{{color_b_stop.UNIT}})',
                ],
                'of_type' => 'gradient',
            ]
        );
        $this->end_controls_section();
    }


    protected function render() {
        $settings = $this->get_settings();
        $poster = !empty($settings['video_poster']['url']) ? 'style="background: url( '.esc_url($settings['video_poster']['url']).' ) no-repeat scroll center 0;"' : '';
        if ( $settings['style']=='style_01' ) {
            ?>
            <section class="video_area">
                <div class="video-left">
                    <div class="video-inner">
                        <div class="title-four">
                            <?php if (!empty($settings['title_text'])) : ?>
                                <h2> <?php echo esc_html($settings['title_text']); ?> </h2>
                            <?php endif; ?>
                        </div>
                        <?php if (!empty($settings['subtitle_text'])) : ?><?php echo wpautop($settings['subtitle_text']); endif; ?>
                        <button class="play-btn"> <?php echo esc_html($settings['play_btn_label']); ?> </button>
                    </div>
                </div>
                <div class="video-right">
                    <div class="videoWrapper videoWrapper169 js-videoWrapper">
                        <iframe class="videoIframe js-videoIframe"
                                data-src="<?php echo esc_url($settings['video_url']) ?>?autoplay=1&amp; modestbranding=1&amp;rel=0&amp;hl=sv"></iframe>
                        <button class="videoPoster js-videoPoster" <?php echo $poster; ?>></button>
                    </div>
                </div>
            </section>

            <script>
                ;(function($){
                    "use strict";
                    $(document).ready(function () {

                        // poster frame click event
                        $(".js-videoPoster").on('click',function(ev) {
                            ev.preventDefault();
                            var $poster = $(this);
                            var $wrapper = $poster.closest('.js-videoWrapper');
                            videoPlay($wrapper);
                        });

                        // play the targeted video (and hide the poster frame)
                        function videoPlay($wrapper) {
                            var $iframe = $wrapper.find('.js-videoIframe');
                            var src = $iframe.data('src');
                            // hide poster
                            $wrapper.addClass('videoWrapperActive');
                            // add iframe src in, starting the video
                            $iframe.attr('src',src);
                        }
                        // stop the targeted/all videos (and re-instate the poster frames)
                        $(".play-btn").on("click",function(ev){
                            var $wrapper = $('.js-videoWrapper');
                            var $iframe = $wrapper.find('.js-videoIframe');
                            var src = $iframe.data('src');
                            if( $wrapper.hasClass('videoWrapperActive')){
                                $wrapper.removeClass('videoWrapperActive');
                                $iframe.attr('src','');
                            }
                            else{
                                $wrapper.addClass('videoWrapperActive');
                                $iframe.attr('src',src);
                            }
                            return false;
                        });

                    })
                })(jQuery)
            </script>
            <?php
        }

        elseif ( $settings['style']=='style_02' ) {
            ?>
            <div class="row demo-video">
                <div class="col-md-6 col-sm-12 display-flex">
                    <div class="app-video">
                        <?php if (!empty($settings['title_text'])) : ?>
                            <div class="title-four">
                                <h2> <?php echo $settings['title_text']; ?> </h2>
                                <div class="br"></div>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($settings['subtitle_text'])) : ?><?php echo wpautop($settings['subtitle_text']); endif; ?>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <?php if (!empty($settings['video_poster']['url'])) : ?>
                        <div class="video-promo">
                            <img src="<?php echo $settings['video_poster']['url'] ?>" alt="">
                            <a id="video-item" href="<?php echo esc_url($settings['video_url']) ?>"><i class="fab fa-play"></i></a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <script src="<?php echo plugin_dir_url(__FILE__).'js/jquery.magnific-popup.min.js' ?>"> </script>
            <script>
                if (jQuery("#video-item").length > 0){
                    jQuery("#video-item").magnificPopup({
                        type: "iframe"
                    });
                }
            </script>
            <?php
        }
    }

}