<?php
namespace SaaslandCore\Widgets;

use Elementor\Repeater;
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
 * Class Featured_image_with_shape
 * @package SaaslandCore\Widgets
 */
class Featured_image_with_shape extends Widget_Base {

    public function get_name() {
        return 'saasland_featured_image';
    }

    public function get_title() {
        return __( 'Image with Shape', 'saasland-hero' );
    }

    public function get_icon() {
        return 'eicon-featured-image';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    protected function _register_controls() {

        //------------------------------ Style Section ------------------------------
        $this->start_controls_section(
            'style_section', [
                'label' => __( 'Style section', 'saasland-core' ),
            ]
        );

        // Style
        $this->add_control(
            'style', [
                'label' => __( 'Style', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_01' => esc_html__( 'Style 01 (single image)', 'saasland-core' ),
                    'style_02' => esc_html__( 'Style 02 (single image)', 'saasland-core' ),
                    'style_03' => esc_html__( 'Style 03 (two images)', 'saasland-core' ),
                    'style_04' => esc_html__( 'Style 04 (single image)', 'saasland-core' ),
                    'style_05' => esc_html__( 'Style 05 (two images)', 'saasland-core' ),
                    'style_06' => esc_html__( 'Style 06 (single image)', 'saasland-core' ),
                    'style_07' => esc_html__( 'Style 06 (Three images with layer)', 'saasland-core' ),
                ],
                'default' => 'style_01'
            ]
        );

        $this->end_controls_section();


        // ---------------------------------  Hero content ------------------------------
        $this->start_controls_section(
            'contents_sec',
            [
                'label' => __( 'Image', 'saasland-core' ),
            ]
        );

        /// --------------- Images ----------------
        $this->add_control(
            'image', [
                'label' => __( 'Featured Image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'image_box_shadow',
                'label' => __( 'Box Shadow', 'saasland-core' ),
                'selector' => '{{WRAPPER}} .typgraphy_img img',
                'condition' => [
                    'style' => ['style_06']
                ]
            ]
        );

        $this->add_control(
            'image2', [
                'label' => __( 'Image 02', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'condition' => [
                    'style' => ['style_03', 'style_05']
                ]
            ]
        );

        $this->add_control(
            'bg_shape', [
                'label' => __( 'Background Shape', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/new_shape.png', __FILE__)
                ],
                'condition' => [
                    'style' => ['style_03', 'style_04', 'style_05']
                ]
            ]
        );

        $this->end_controls_section();


        //------------------------------ Style Section ------------------------------
        $this->start_controls_section(
            'shape_section', [
                'label' => __( 'Shape', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => ['style_01', 'style_02']
                ]
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
                'label'     => esc_html__( 'Shape 01 Color', 'saasland-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .seo_features_img .round_circle' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .typgraphy_img .circle_shape_1' => 'background: {{VALUE}};',
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
                'label' => __( 'Shape 02', 'saasland-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'saasland-core' ),
                'label_off' => __( 'No', 'saasland-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'shape2_color', [
                'label'     => esc_html__( 'Shape 02 Color', 'saasland-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .round_circle.two' => 'background: {{VALUE}};',
                ),
                'condition' => [
                    'is_shape2' => ['yes'],
                ],
            ]
        );

        $this->end_controls_section();



        //------------------------------ Style Section ------------------------------
        $this->start_controls_section(
            'shape_section6', [
                'label' => __( 'Shape', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => ['style_06']
                ]
            ]
        );

        $this->add_control(
            'shape_color', [
                'label'     => esc_html__( 'Shape 01 Color', 'saasland-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .typgraphy_img .circle_shape_1' => 'background: {{VALUE}};',
                ),
            ]
        );

        $this->add_control(
            'shape_x_position', [
                'label' => __( 'Horizontal Position', 'saasland-core' ),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .circle_shape_1' => 'right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'shape_y_position', [
                'label' => __( 'Vertical Position', 'saasland-core' ),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .circle_shape_1' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'shape_round', [
                'label' => __( 'Shape Round', 'saasland-core' ),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .circle_shape_1' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $layers = new Repeater();
        $this->start_controls_section(
            'image_with_layer_sec', [
                'label' => __( 'Feature Image with layer', 'saasland-core' ),
                'condition' => [
                    'style' => ['style_07']
                ]
            ]
        );
        $this->add_control(
            'feature_image_01', [
                'label' => __( 'Feature Image 01', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );
        $this->add_control(
            'feature_image_02', [
                'label' => __( 'Feature Image 02', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );
        $this->add_control(
            'feature_image_03', [
                'label' => __( 'Feature Image 03', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $layers->add_control(
            'feature_image_layer', [
                'label' => __( 'Feature Image Layer', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
            ]
        );
        $this->add_control(
            'layers_label',
            [
                'label' => __( 'Layer Labels', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'fields' => $layers->get_controls(),
                'title_field' => '{{{ feature_image_layer }}}',
            ]
        );

        $this->end_controls_section();


    }

    protected function render() {
        $settings = $this->get_settings();

        if ( $settings['style'] == 'style_01' || $settings['style'] == 'style_02' ) {
            ?>
            <div class="seo_features_img <?php echo ($settings['style'] == 'style_02' ) ? 'seo_features_img_two' : ''; ?>">
                <?php if ($settings['is_shape1'] == 'yes' ) : ?>
                    <div class="round_circle"></div>
                <?php endif; ?>
                <?php if ($settings['is_shape2'] == 'yes' ) : ?>
                    <div class="round_circle two"></div>
                <?php endif; ?>
                <?php echo wp_get_attachment_image($settings['image']['id'], 'full' ) ?>
            </div>
            <?php
        }
        elseif ( $settings['style'] == 'style_03' ) {
            if (!empty($settings['bg_shape']['url'])) :
                ?>
                <style>
                    .stratup_service_img .shape {
                        background: url(<?php echo esc_url($settings['bg_shape']['url']) ?>) no-repeat scroll left 0;
                    }
                </style>
            <?php endif; ?>
            <div class="stratup_service_img">
                <div class="shape"></div>
                <?php echo wp_get_attachment_image($settings['image']['id'], 'full', '', array( 'class' => 'laptop_img')) ?>
                <?php echo wp_get_attachment_image($settings['image2']['id'], 'full', '', array( 'class' => 'phone_img')) ?>
            </div>
            <?php
        }
        elseif ( $settings['style'] == 'style_04' ) {
            if (!empty($settings['image']['url'])) :
                ?>
                <style>
                    .payment_features_img:before {
                        content: "";
                        background: url(<?php echo esc_url($settings['bg_shape']['url']) ?>) no-repeat scroll center left;
                    }
                </style>
            <?php endif; ?>
            <div class="payment_features_img">
                <?php echo wp_get_attachment_image($settings['image']['id'], 'full' ) ?>
            </div>
            <?php
        }
        elseif ( $settings['style'] == 'style_05' ) {
            if (!empty($settings['bg_shape']['url'])) : ?>
                <style>
                    .startup_tab_img:before {
                        background: url(<?php echo esc_url($settings['bg_shape']['url']) ?>) no-repeat scroll center 0/contain;
                    }
                </style>
                <?php
            endif;
            ?>
            <div class="startup_tab_img">
                <div class="web_img">
                    <?php echo wp_get_attachment_image($settings['image']['id'], 'full' ) ?>
                </div>
                <div class="phone_img">
                    <?php echo wp_get_attachment_image($settings['image2']['id'], 'full' ); ?>
                </div>
            </div>
            <?php
        }
        elseif ( $settings['style'] == 'style_06' ) {
            ?>
            <div class="typgraphy_img">
                <?php echo wp_get_attachment_image( $settings['image']['id'], 'full' ) ?>
                <div class="circle_shape_1 wow fadeInUp" data-wow-delay="600ms"></div>
            </div>
            <style>
                @-webkit-keyframes circleAnimation {
                    0%, 100% {
                        border-radius: 42% 58% 70% 30%/45% 45% 55% 55%;
                        -webkit-transform: translate3d(0, 0, 0) rotateZ(0.01deg);
                        transform: translate3d(0, 0, 0) rotateZ(0.01deg);
                    }
                    34% {
                        border-radius: 70% 30% 46% 54%/30% 29% 71% 70%;
                        -webkit-transform: translate3d(0, 5px, 0) rotateZ(0.01deg);
                        transform: translate3d(0, 5px, 0) rotateZ(0.01deg);
                    }
                    50% {
                        -webkit-transform: translate3d(0, 0, 0) rotateZ(0.01deg);
                        transform: translate3d(0, 0, 0) rotateZ(0.01deg);
                    }
                    67% {
                        border-radius: 100% 60% 60% 100%/100% 100% 60% 60%;
                        -webkit-transform: translate3d(0, -3px, 0) rotateZ(0.01deg);
                        transform: translate3d(0, -3px, 0) rotateZ(0.01deg);
                    }
                }
                @keyframes circleAnimation {
                    0%, 100% {
                        border-radius: 42% 58% 70% 30%/45% 45% 55% 55%;
                        -webkit-transform: translate3d(0, 0, 0) rotateZ(0.01deg);
                        transform: translate3d(0, 0, 0) rotateZ(0.01deg);
                    }
                    34% {
                        border-radius: 70% 30% 46% 54%/30% 29% 71% 70%;
                        -webkit-transform: translate3d(0, 5px, 0) rotateZ(0.01deg);
                        transform: translate3d(0, 5px, 0) rotateZ(0.01deg);
                    }
                    50% {
                        -webkit-transform: translate3d(0, 0, 0) rotateZ(0.01deg);
                        transform: translate3d(0, 0, 0) rotateZ(0.01deg);
                    }
                    67% {
                        border-radius: 100% 60% 60% 100%/100% 100% 60% 60%;
                        -webkit-transform: translate3d(0, -3px, 0) rotateZ(0.01deg);
                        transform: translate3d(0, -3px, 0) rotateZ(0.01deg);
                    }
                }
                .typgraphy_img {
                    position: relative;
                }
                .typgraphy_img .circle_shape_1 {
                    border-radius: 50%;
                    background: #fef5f3;
                    position: absolute;
                    right: 47px;
                    width: 400px;
                    height: 400px;
                    animation: circleAnimation 7s linear infinite;
                    z-index: -1;
                    bottom: 70px;
                }
                .typgraphy_img img {
                    box-shadow: 30px 10px 70px rgba(18, 1, 64, 0.1);
                }
            </style>
            <?php
        }
        elseif ( $settings['style'] == 'style_07' ) { ?>
            <section class="product_features_area">
                <div class="container">
                    <div class="battery_mockup">
                        <figure class="macbook_body">
                            <?php
                            if( !empty( $settings['feature_image_01']['url'] ) ){
                                echo '<img class="top wow fadeInDown" data-wow-delay="0.1s" src="'. esc_url( $settings['feature_image_01']['url'] ) .'" alt="'. esc_attr__( 'Feature image One', 'saasland-core' ) .'">';
                            }
                            if( !empty( $settings['feature_image_02']['url'] ) ){
                                echo '<img class="middle wow fadeInDown" data-wow-delay="0.3s" src="'. esc_url( $settings['feature_image_02']['url'] ) .'" alt="'. esc_attr__( 'Feature image two', 'saasland-core' ) .'">';
                            }
                            if( !empty( $settings['feature_image_03']['url'] ) ){
                                echo '<img class="bottom wow fadeInDown" data-wow-delay="0.6s" src="'. esc_url( $settings['feature_image_03']['url'] ) .'" alt="'. esc_attr__( 'Feature image Three', 'saasland-core' ) .'">';
                            }
                            ?>
                        </figure>
                        <ul class="list-unstyled battery_info">
                            <?php
                            if( is_array( $settings['layers_label'] ) ) {
                                $inc = 2;
                                $animation_class = count( $settings['layers_label'] ) % 2 == 0 ? 'fadeInRight' : 'fadeInLeft';
                                foreach ( $settings['layers_label'] as $layer ){

                                    ?>
                                    <li class="wow <?php echo esc_attr( $animation_class ) ?>" data-wow-delay="0.<?php echo esc_attr( $inc++ )?>s">
                                        <span class="text"><?php echo esc_html( $layer['feature_image_layer'] ) ?></span>
                                        <span class="line"></span>
                                    </li>
                                    <?php
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </section>
            <?php
        }

    }
}