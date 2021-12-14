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
 * Featured Video
 * Class Single_video
 * @package SaaslandCore\Widgets
 */
class Single_video extends Widget_Base {
    public function get_name() {
        return 'saasland_single_video';
    }

    public function get_title() {
        return __( 'Featured Video', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-youtube';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'select_sec',
            [
                'label' => __( 'Select Style', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'style',
            [
                'label' => __( 'Border Style', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'style_01'  => __( 'Style One', 'saasland-core' ),
                    'style_02'  => __( 'Style Two', 'saasland-core' ),
                ],
                'default' => 'style_01',
            ]
        );

        $this->end_controls_section();

        // ---------------------------------- Title ------------------------------//
        $this->start_controls_section(
            'title_sec', [
                'label' => esc_html__( 'Contents', 'saasland-core' ),
                'condition' => [
                    'style' => 'style_02'
                ]
            ]
        );

        $this->add_control(
            'title', [
                'label' => esc_html__( 'Title Text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA
            ]
        );

        $this->add_control(
            'subtitle', [
                'label' => esc_html__( 'Subtitle Text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA
            ]
        );

        $this->add_control(
            'author_name', [
                'label' => esc_html__( 'Name', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'designation', [
                'label' => esc_html__( 'Designation', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        // -------------------- Featured Video ------------------------------
        $this->start_controls_section(
            'video_sec', [
                'label' => esc_html__( 'Featured Video', 'saasland-core' ),
                'condition' => [
                    'style' => ['style_01', 'style_02']
                ]
            ]
        );

        $this->add_control(
            'video_url', [
                'label' => esc_html__( 'Video URL', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true
            ]
        );

        $this->add_control(
            'bg_title', [
                'label' => esc_html__( 'Video Background Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'SaasLand',
                'condition' => [
                    'style' => 'style_01'
                ]
            ]
        );

        $this->add_control(
            'video_image', [
                'label' => esc_html__( 'Video Poster Image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'condition' => [
                    'style' => 'style_01'
                ]
            ]
        );

        $this->add_control(
            'top_ornament', [
                'label' => esc_html__( 'Top Ornament', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/leaf.png', __FILE__)
                ],
                'condition' => [
                    'style' => 'style_01'
                ]
            ]
        );

        $this->add_control(
            'btm_ornament', [
                'label' => esc_html__( 'Bottom Ornament', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/cup.png', __FILE__)
                ],
                'condition' => [
                    'style' => 'style_01'
                ]
            ]
        );

        $this->end_controls_section();

        // -------------------- Featured Image  ------------------------------
        $this->start_controls_section(
            'featured_img_sec', [
                'label' => esc_html__( 'Featured Image', 'saasland-core' ),
                'condition' => [
                    'style' => 'style_02'
                ]
            ]
        );

        $this->add_control(
            'fimage', [
                'label' => esc_html__( 'Featured Image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'video_style', [
                'label' => esc_html__( 'Style', 'saasland-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => 'style_01'
                ]
            ]
        );
        $this->add_responsive_control(
            'video_max_width',
            [
                'label' => __( 'Width', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1200,
                    ],
                ],
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'desktop_default' => [
                    'size' => 770,
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'size' => 450,
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'size' => 350,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .video_info' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'video_height',
            [
                'label' => __( 'Height', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 800,
                    ],
                ],
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'desktop_default' => [
                    'size' => 450,
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'size' => 450,
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'size' => 350,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .video_info' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => __( 'Background', 'saasland-core' ),
                'types' => [ 'gradient' ],
                'selector' => '{{WRAPPER}} .video_info::after',
            ]
        );
        $this->end_controls_section();

        /**
         * Tab Style
         */
        // ---------------------------------- Title ------------------------------//
        $this->start_controls_section(
            'style_title_sec', [
                'label' => esc_html__( 'Title', 'saasland-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => 'style_02'
                ]
            ]
        );

        $this->add_control(
            'title_text_color',
            [
                'label' => __( 'Text Color', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .h_action_content h2' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_text_typography',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .h_action_content h2',
            ]
        );

        $this->end_controls_section();


        // ---------------------------------- Subtitle ------------------------------//
        $this->start_controls_section(
            'subtitle_text_color_sec', [
                'label' => esc_html__( 'Subtitle', 'saasland-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => 'style_02'
                ]
            ]
        );

        $this->add_control(
            'subtitle_text_color',
            [
                'label' => __( 'Text Color', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .h_action_content p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle_text_typography',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .h_action_content p',
            ]
        );

        $this->end_controls_section();

        // ------------------------------ Shape Images  ------------------------------//
        $this->start_controls_section(
            'analytics_shape_img_sec', [
                'label' => esc_html__( 'Shape Images', 'saasland-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => 'style_02'
                ]
            ]
        );

        $this->add_control(
            'analytics_shape1', [
                'label' => esc_html__( 'Image One', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/home-analytics/shap_one.png', __FILE__)
                ],
                'condition' => [
                    'style' => 'style_02'
                ]
            ]
        );

        $this->add_control(
            'analytics_shape2', [
                'label' => esc_html__( 'Image Two', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/home-analytics/shap_two.png', __FILE__)
                ],
                'condition' => [
                    'style' => 'style_02'
                ]
            ]
        );

        $this->end_controls_section();

        // ---------------------------------- Background Section ------------------------------//
        $this->start_controls_section(
            'section_bg_style', [
                'label' => esc_html__( 'Section Background', 'saasland-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => 'style_02'
                ]
            ]
        );

        $this->add_control(
            'sec_bg_color',
            [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .h_action_area_three' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'section_margin',
            [
                'label' => __( 'Margin', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .h_action_area_three' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'section_padding',
            [
                'label' => __( 'Padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .h_action_area_three' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

    }

    protected function render()
    {
        $settings = $this->get_settings();
        $video_image = '';
        if ( !empty($settings['video_image']['url']) ) {
            $video_image = "style='background: url({$settings['video_image']['url']}) no-repeat; background-size: cover;'";
        }

        if ( $settings['style'] == 'style_01' ) {
            ?>
            <section class="video_area">
                <div class="container">
                    <div class="video_content">
                        <div class="video_info" <?php echo $video_image; ?>>
                            <div class="ovarlay_color"></div>
                            <a class="popup-youtube video_icon" href="<?php echo esc_url($settings['video_url']) ?>"><i class="arrow_triangle-right"></i></a>
                            <?php echo (!empty($settings['bg_title'])) ? '<h2>'.$settings['bg_title'].'</h2>' : ''; ?>
                        </div>
                        <?php if (!empty($settings['top_ornament']['url'])) : ?>
                            <img class="video_leaf" src="<?php echo esc_url($settings['top_ornament']['url']) ?>" alt="<?php echo esc_attr($settings['bg_title']); ?>">
                        <?php endif; ?>
                        <?php if (!empty($settings['btm_ornament']['url'])) : ?>
                            <img class="cup" src="<?php echo esc_url($settings['btm_ornament']['url']) ?>" alt="<?php echo esc_attr($settings['bg_title']) ?>">
                        <?php endif; ?>
                    </div>
                </div>
            </section>
            <?php
        }
        elseif ($settings['style'] == 'style_02' ) {
            ?>
            <section class="h_action_area_three">
                <?php if ( !empty( $settings['analytics_shape1']['url'] ) ) : ?>
                    <img class="shap_img one" src="<?php echo esc_url( $settings['analytics_shape1']['url'] ) ?>" alt="<?php echo esc_attr( $settings['title'] ) ?>">
                <?php endif; ?>
                <?php if ( !empty( $settings['analytics_shape2']['url'] ) ) : ?>
                    <img class="shap_img two" src="<?php echo esc_url( $settings['analytics_shape2']['url'] ) ?>" alt="<?php echo esc_attr( $settings['title'] ) ?>">
                <?php endif; ?>
                <div class="container">
                    <div class="row align-items-center">
                        <?php if ( !empty( $settings['fimage']['url'] ) ) : ?>
                            <div class="col-md-6">
                                <div class="h_action_img wow fadeInLeft">
                                    <img class="img-fluid" src="<?php echo esc_url( $settings['fimage']['url'] ) ?>" alt="<?php echo esc_attr( $settings['title'] ) ?>">
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="col-md-6">
                            <div class="h_action_content">
                                <a class="popup-youtube video_icon"
                                   href="<?php echo esc_url( $settings['video_url'] ) ?>">
                                    <i class="arrow_triangle-right"></i>
                                </a>
                                <?php echo (!empty( $settings['title'] )) ? '<h2>' . $settings['title'] . '</h2>' : ''; ?>
                                <?php echo !empty( $settings['subtitle'] ) ? wpautop( $settings['subtitle'] ) : ''; ?>
                                <div class="author">
                                    <?php if ( $settings['author_name'] ) : ?>
                                        <h6><?php echo esc_html( $settings['author_name'] ) ?></h6>
                                    <?php endif; ?>
                                    <?php echo !empty( $settings['designation'] ) ? wpautop( $settings['designation'] ) : ''; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php
        }
    }
}