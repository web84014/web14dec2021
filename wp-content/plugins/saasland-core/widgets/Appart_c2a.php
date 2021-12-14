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
class Appart_c2a extends Widget_Base {

    public function get_name() {
        return 'saasland_appart_c2a';
    }

    public function get_title() {
        return __( 'Call to Action <br> with Image', 'saasland-core' );
    }

    public function get_icon() {
        return ' eicon-call-to-action';
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
            'choose_style', [
                'label' => __( 'Choose Section Style', 'saasland-core' ),
            ]
        );
        $this->add_control(
            'style', [
                'label' => esc_html__( 'Style', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_01' => esc_html__( 'Style one ', 'saasland-core' ),
                    'style_02' => esc_html__( 'Style two ', 'saasland-core' ),
                    'style_03' => esc_html__( 'Style three ', 'saasland-core' ),
                ],
                'default' => 'style_01'
            ]
        );
        $this->end_controls_section();

        
        $this->start_controls_section(
            'title_sec', [
                'label' => __( 'Title section', 'saasland-core' ),
            ]
        );
        $this->add_control(
            'title_text', [
                'label' => esc_html__( 'Title text', 'saasland-core' ),
                'description' => esc_html__( 'Use <br> tag for line breaking.', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );
        $this->add_control(
            'subtitle_text', [
                'label' => esc_html__( 'Subtitle text', 'saasland-core' ),
                'type' => Controls_Manager::WYSIWYG,
                'label_block' => true,
            ]
        );
        $this->end_controls_section(); // End title section

        // ------------------------------ Button ------------------------------
        $this->start_controls_section(
            'button', [
                'label' => __( 'Button', 'saasland-core' ),
            ]
        );
        $this->add_control(
            'btn_label', [
                'label' => esc_html__( 'Button label', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Learn More',
            ]
        );
        $this->add_control(
            'btn_url', [
                'label' => __( 'Button URL', 'saasland-core' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#'
                ]
            ]
        );
        $this->add_control(
            'is_box_shadow', [
                'label'     => esc_html__( 'Box Shadow', 'saasland-core' ),
                'type'      => Controls_Manager::SWITCHER,
            ]
        );
        $this->end_controls_section(); // End the Button

        // ------------------------------  Featured image ------------------------------
        $this->start_controls_section(
            'featured_image', [
                'label' => __( 'Featured image', 'saasland-core' ),
            ]
        );
        $this->add_control(
            'the_featured_image', [
                'label' => esc_html__( 'Featured image', 'saasland-core' ),
                'desc' => esc_html__( 'Upload the featured image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );
        $this->end_controls_section(); // End title section


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
                'selectors' => [
                    '{{WRAPPER}} .title-four h2' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .about_content h2' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .features_content h2' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_prefix',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
				    {{WRAPPER}} .features_content h2,
				    {{WRAPPER}} .about_content h2,
				    {{WRAPPER}} .title-four h2',
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
                    '{{WRAPPER}} .features_content p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .overview-details p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .about_content p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .title-four p' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_subtitle',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
				    {{WRAPPER}} .features_content p,
				    {{WRAPPER}} .about_content p,
				    {{WRAPPER}} .title-four p,
				    {{WRAPPER}} .overview-details p',
            ]
        );
        $this->end_controls_section();


        //------------------------------ Style button ------------------------------
        $this->start_controls_section(
            'style_button', [
                'label' => __( 'Style button', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs('call_to_action_btn_tab');
        $this->start_controls_tab( 'cta_btn_normal', [
            'label' => __( 'Normal', 'saasland-core' )
            ]
        );
        $this->add_control(
            'color_btn', [
                'label' => __( 'Text color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .n_banner_btn' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .learn-btn-two' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'bg_color_btn', [
                'label' => __( 'Background color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
            ]
        );
        $this->add_control(
            'bg_color2_btn', [
                'label' => __( 'Background color 02', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .n_banner_btn' => 'background-image: -webkit-linear-gradient( 0deg, {{bg_color_btn.VALUE}} 0%, {{VALUE}} 100%);',
                    '{{WRAPPER}} .learn-btn-two' => 'background-image: -webkit-linear-gradient( 0deg, {{bg_color_btn.VALUE}} 0%, {{VALUE}} 100%);',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_btn',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .learn-btn-two',
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab( 'cta_btn_hover', [
                'label' => __( 'Hover', 'saasland-core' )
            ]
        );
        $this->add_control(
            'color_btn_hover', [
                'label' => __( 'Text color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .n_banner_btn:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .learn-btn-two:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'bg_color_btn_hover', [
                'label' => __( 'Background color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
            ]
        );
        $this->add_control(
            'bg_color2_btn_hover', [
                'label' => __( 'Background color 02', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .n_banner_btn:hover' => 'background-image: -webkit-linear-gradient( 0deg, {{bg_color_btn_hover.VALUE}} 0%, {{VALUE}} 100%);',
                    '{{WRAPPER}} .learn-btn-two:hover' => 'background-image: -webkit-linear-gradient( 0deg, {{bg_color_btn_hover.VALUE}} 0%, {{VALUE}} 100%);',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();


        //------------------------------ Shape Images Section ------------------------------
        $this->start_controls_section(
            'shape_img_sec', [
                'label' => __( 'Floating Images', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                        'style' => 'style_02'
                ]
            ]
        );

        $this->add_control(
            'background_animation', [
                'label'     => esc_html__( 'Background animation?', 'saasland-core' ),
                'type'      => Controls_Manager::SWITCHER,
                'condition' => [
                    'style' => 'style_02',
                ]
            ]
        );

        $this->add_control(
            'shape_img1', [
                'label' => esc_html__( 'Image One', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/appart-new/line_01.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'shape_img2', [
                'label' => esc_html__( 'Image Two ', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/appart-new/line_02.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'shape_img3', [
                'label' => esc_html__( 'Image Three', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/appart-new/line_03.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'shape_img4', [
                'label' => esc_html__( 'Image Four', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/appart-new/line_04.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'shape_img5', [
                'label' => esc_html__( 'Image Five', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/appart-new/line_05.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'shape_img6', [
                'label' => esc_html__( 'Image Six', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/appart-new/line_06.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'shape_img7', [
                'label' => esc_html__( 'Image Seven', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/appart-new/shape_01.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'shape_img8', [
                'label' => esc_html__( 'Image Eight', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/appart-new/shape_02.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'shape_img9', [
                'label' => esc_html__( 'Image Nine', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/appart-new/shape_03.png', __FILE__)
                ]
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
            'sec_padding', [
                'label' => __( 'Section padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .overview-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .about_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .ex_features_one_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings();
        if ( $settings['style'] == 'style_01' ) { ?>
            <section class="overview-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 col-12 overview-details-left">
                            <?php if (!empty($settings['the_featured_image']['url'])) : ?>
                                <img src="<?php echo esc_url($settings['the_featured_image']['url']); ?>"
                                     class="img-responsive" alt="<?php echo esc_attr($settings['title_text']); ?>">
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6 col-12 overview-details-right">
                            <div class="overview-details">
                                <div class="title-four">
                                    <?php if (!empty($settings['title_text'])) : ?>
                                        <h2> <?php echo esc_html($settings['title_text']); ?> </h2>
                                    <?php endif; ?>
                                </div>
                                <?php if (!empty($settings['subtitle_text'])) : ?><?php echo wpautop($settings['subtitle_text']); endif; ?>
                                <?php if (!empty($settings['btn_label'])) :
                                    $is_external = $settings['btn_url']['is_external'] == true ? 'target="_blank"' : '';
                                    $is_box_shadow = $settings['is_box_shadow'] != 'yes' ? 'no_box_shadow' : '';
                                    ?>
                                    <a href="<?php echo esc_url($settings['btn_url']['url']) ?>" <?php echo $is_external; ?>
                                       class="btn learn-btn-two <?php echo $is_box_shadow; ?>">
                                        <?php echo esc_html($settings['btn_label']) ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php
        }
        elseif ( $settings['style']=='style_02' ) {
            ?>
            <section class="about_area">
                <?php if (true == $settings['background_animation']) : ?>
                    <!--Parallax-->
                    <ul class="memphis-parallax hidden-xs hidden-sm white_border">
                        <?php if ( !empty($settings['shape_img1']['url'] ) ) : ?>
                            <li data-parallax='{"x": -100, "y": 100}'>
                                <img class="br_shape" src="<?php echo esc_url( $settings['shape_img1']['url'] ) ?>" alt="<?php echo esc_attr( $settings['title_text'] ) ?>">
                            </li>
                        <?php endif; ?>
                        <?php if ( !empty($settings['shape_img2']['url'] ) ) : ?>
                            <li data-parallax='{"x": -200, "y": 200}'>
                                <img class="br_shape" src="<?php echo esc_url( $settings['shape_img2']['url'] ) ?>" alt="<?php echo esc_attr( $settings['title_text'] ) ?>">
                            </li>
                        <?php endif; ?>
                        <?php if ( !empty($settings['shape_img3']['url'] ) ) : ?>
                            <li data-parallax='{"x": -150, "y": 150}'>
                                <img class="br_shape" src="<?php echo esc_url( $settings['shape_img3']['url'] ) ?>" alt="<?php echo esc_attr( $settings['title_text'] ) ?>">
                            </li>
                        <?php endif; ?>
                        <?php if ( !empty($settings['shape_img4']['url'] ) ) : ?>
                            <li data-parallax='{"x": 50, "y": -50}'>
                                <img class="br_shape" src="<?php echo esc_url( $settings['shape_img4']['url'] ) ?>" alt="<?php echo esc_attr( $settings['title_text'] ) ?>">
                            </li>
                        <?php endif; ?>
                        <?php if ( !empty($settings['shape_img5']['url'] ) ) : ?>
                            <li data-parallax='{"x": -150, "y": 150}'><img
                                    src="<?php echo esc_url( $settings['shape_img5']['url'] ) ?>" alt="<?php echo esc_attr( $settings['title_text'] ) ?>">
                            </li>
                        <?php endif; ?>
                        <?php if ( !empty($settings['shape_img6']['url'] ) ) : ?>
                            <li data-parallax='{"x": -100, "y": 100}'><img
                                    src="<?php echo esc_url( $settings['shape_img6']['url'] ) ?>" alt="<?php echo esc_attr( $settings['title_text'] ) ?>">
                            </li>
                        <?php endif; ?>
                        <?php if ( !empty($settings['shape_img7']['url'] ) ) : ?>
                            <li data-parallax='{"x": 50, "y": -50}'><img
                                    src="<?php echo esc_url( $settings['shape_img7']['url'] ) ?>" alt="<?php echo esc_attr( $settings['title_text'] ) ?>">
                            </li>
                        <?php endif; ?>
                        <?php if ( !empty($settings['shape_img8']['url'] ) ) : ?>
                            <li data-parallax='{"x": 250, "y": -250}'><img
                                    src="<?php echo esc_url( $settings['shape_img8']['url'] ) ?>" alt="<?php echo esc_attr( $settings['title_text'] ) ?>">
                            </li>
                        <?php endif; ?>
                    </ul>
                    <?php if ( !empty($settings['shape_img9']['url'] ) ) : ?>
                        <img class="shape wow fadeInRight" src="<?php echo esc_url( $settings['shape_img9']['url'] ) ?>" alt="<?php echo esc_attr( $settings['title_text'] ) ?>">
                    <?php endif; ?>
                <?php endif; ?>
                <div class="container">
                    <div class="row row_reverse align_items_center">
                        <div class="col-lg-7">
                            <?php if (!empty($settings['the_featured_image']['url'])) : ?>
                                <div class="about_img text-right">
                                    <img src="<?php echo esc_url($settings['the_featured_image']['url']); ?>" alt="<?php echo esc_attr( $settings['title_text'] ) ?>">
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-lg-5">
                            <div class="about_content">
                                <?php if (!empty($settings['title_text'])) : ?>
                                    <h2 class="h_color f_36 wow fadeInUp"> <?php echo saasland_kses_post($settings['title_text']); ?> </h2>
                                <?php endif; ?>
                                <?php if (!empty($settings['subtitle_text'])) : ?>
                                    <div class="wow fadeInUp"
                                         data-wow-delay="300ms"><?php echo wpautop($settings['subtitle_text']); ?></div>
                                <?php endif; ?>
                                <?php
                                if (!empty($settings['btn_label'])) :
                                    $is_external = $settings['btn_url']['is_external'] == true ? 'target="_blank"' : '';
                                    $is_box_shadow = $settings['is_box_shadow'] != 'yes' ? 'no_box_shadow' : '';
                                    ?>
                                    <a href="<?php echo esc_url($settings['btn_url']['url']) ?>" <?php echo $is_external ?>
                                       class="n_banner_btn wow fadeInUp <?php echo $is_box_shadow; ?>"
                                       data-wow-delay="450ms">
                                        <?php echo esc_html($settings['btn_label']) ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php
        }

        elseif ( $settings['style']=='style_03' ) {
            ?>
            <section class="ex_features_one_area ex-featured">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-7 features_content">
                            <?php if (!empty($settings['title_text'])) : ?>
                                <h2 class="title_three color-b"> <?php echo saasland_kses_post($settings['title_text']); ?> </h2>
                            <?php endif; ?>
                            <?php if (!empty($settings['subtitle_text'])) : ?>
                                <?php echo wpautop($settings['subtitle_text']);
                            endif; ?>
                            <?php if (!empty($settings['btn_label'])) :
                                $is_external = $settings['btn_url']['is_external'] == true ? 'target="_blank"' : '';
                                $is_box_shadow = $settings['is_box_shadow'] != 'yes' ? 'no_box_shadow' : '';
                                ?>
                                <a href="<?php echo esc_url($settings['btn_url']['url']) ?>" <?php echo $is_external; ?>
                                   class="btn learn_btn <?php echo $is_box_shadow; ?>">
                                    <?php echo esc_html($settings['btn_label']) ?>
                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="col-lg-5 offset-lg-1 col-md-5">
                            <div class="f_img text-center">
                                <?php if (!empty($settings['the_featured_image']['url'])) : ?>
                                    <img src="<?php echo esc_url($settings['the_featured_image']['url']); ?>"
                                         class="img-responsive" alt="<?php echo esc_attr($settings['title_text']); ?>">
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php
        }
    }
}