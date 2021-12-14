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
class Hero_videos extends Widget_Base {

    public function get_name() {
        return 'saasland_hero_videos';
    }

    public function get_title() {
        return __( 'Hero Video Slides', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-slider-video';
    }

    public function get_style_depends() {
        return [ 'owl-carousel' ];
    }

    public function get_script_depends() {
        return [ 'owl-carousel' ];
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    protected function _register_controls() {

        // ----------------------------------------  Hero content ------------------------------
        $this->start_controls_section(
            'hero_content',
            [
                'label' => __( 'Hero Contents', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'content',
            [
                'label' => esc_html__( 'Contents', 'saasland-core' ),
                'type' => Controls_Manager::WYSIWYG,
                'label_block' => true,
            ]
        );

        $this->end_controls_section(); // End Hero content


        // --------------------------------------- Featured image 1 ------------------------------
        $this->start_controls_section(
            'videos_sec', [
                'label' => __( 'Videos', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'videos', [
                'label' => esc_html__( 'Video Slides', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'title_field' => '{{{ title }}}',
                'fields' => [
                    [
                        'name' => 'title',
                        'label' => esc_html__( 'Title', 'saasland-core' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => 'Default Title'
                    ],
                    [
                        'name' => 'image',
                        'label' => esc_html__( 'Image', 'saasland-core' ),
                        'type' => Controls_Manager::MEDIA,
                    ],
                    [
                        'name' => 'video_url',
                        'label' => esc_html__( 'Video URL', 'saasland-core' ),
                        'type' => Controls_Manager::TEXT,
                    ],
                ]
            ]
        );

        $this->end_controls_section(); // End Animated Images


        /// --------------------  Buttons ----------------------------
        $this->start_controls_section(
            'buttons_sec',
            [
                'label' => __( 'Buttons', 'saasland-core' ),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'btn_title', [
                'label' => __( 'Button Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Get Started'
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
                'label' => __( 'Font Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}}',
                )
            ]
        );

        $repeater->add_control(
            'bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'background-color: {{VALUE}}; border-color: {{VALUE}}',
                )
            ]
        );

        $repeater->add_control(
            'border_color', [
                'label' => __( 'Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'border: 1px solid {{VALUE}}',
                )
            ]
        );

        $repeater->end_controls_tab();

        /// ----------------------------- Hover Button Style
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
                    '{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'background: {{VALUE}}',
                )
            ]
        );

        $repeater->add_control(
            'hover_border_color', [
                'label' => __( 'Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'border: 1px solid {{VALUE}}',
                )
            ]
        );

        $repeater->end_controls_tab();

        $this->add_control(
            'buttons', [
                'label' => __( 'Create buttons', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'title_field' => '{{{ btn_title }}}',
                'fields' => $repeater->get_controls(),
            ]
        );

        $this->end_controls_section(); // End Buttons



        /**
         * Style Tab
         * ------------------------------ Style Title ------------------------------
         */
        $this->start_controls_section(
            'style_content', [
                'label' => __( 'Style Content', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'color_title', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .digital_content' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .digital_content h6' => 'border-bottom-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {

        $settings = $this->get_settings();
        $buttons = $settings['buttons'];
        $videos = !empty($settings['videos']) ? $settings['videos'] : '';
        ?>
        <section class="digital_banner_area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-8">
                        <div class="digital_content">
                            <?php echo (!empty($settings['content'])) ? $settings['content'] : ''; ?>
                            <?php
                            foreach ($buttons as $button) {
                                echo "<a href='{$button['btn_url']['url']}' class='btn_six slider_btn elementor-repeater-item-{$button['_id']}'> {$button['btn_title']} </a>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="digital_video_slider owl-carousel">
                <?php
                if (is_array($videos)) {
                    foreach ($videos as $video) {
                        ?>
                        <div class="video_item">
                            <img src="<?php echo esc_url($video['image']['url']) ?>" alt="<?php echo esc_attr($video['title']) ?>">
                            <a class="popup-youtube video_icon" href="<?php echo esc_url($video['video_url']) ?>"><i class="arrow_triangle-right"></i></a>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
            <div class="digital_banner_shap"></div>
            <div class="round_shap one"></div>
            <div class="round_shap two"></div>
            <div class="round_shap three"></div>
        </section>

        <script>
            ;(function($){
                "use strict";
                $(document).ready(function () {
                var dSlider = $(".digital_video_slider");
                if ( dSlider.length ){
                    dSlider.owlCarousel({
                        loop:true,
                        margin:30,
                        items: 1,
                        center:true,
                        <?php echo ( is_rtl() ) ? "rtl: true," : ''; ?>autoplay:true,
                        smartSpeed: 1000,
                        stagePadding: 200,
                        responsiveClass:true,
                        nav: false,
                        dots: false,
                        responsive:{
                            0:{
                                items: 1,
                                stagePadding: 0,
                            },
                            575:{
                                items:1,
                                stagePadding: 100,
                            },
                            768:{
                                items:1,
                                stagePadding: 40,
                            },
                            992:{
                                items:1,
                                stagePadding: 100,
                            },
                            1250:{
                                items:1,
                                stagePadding: 200,
                            }
                        },
                    })
                }
                });
            })(jQuery)
        </script>
        <?php
    }
}
