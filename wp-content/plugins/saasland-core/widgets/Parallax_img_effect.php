<?php
namespace SaaslandCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class Parallax_img_effect
 * @package SaaslandCore\Widgets
 */
class Parallax_img_effect extends Widget_Base {

    public function get_name() {
        return 'saasland_parallax_img_effect-system';
    }

    public function get_title() {
        return __( 'Parallax images', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-parallax';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    public function get_style_depends() {
        return [ 'parallax-image' ];
    }

    protected function _register_controls() {

        // ---------------------------------------- Parallax Images Effect  ----------------------------------------//
        $this->start_controls_section(
            'parallax_img_sec',
            [
                'label' => __( 'Images', 'saasland-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'alt_text',
            [
                'label' => __( 'Alt Text', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Default'
            ]
        );

        $repeater->add_control(
            'parallax_img', [
                'label' => __( 'Image', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
            ]
        );

        $repeater->add_responsive_control(
            'x_number',
            [
                'label' => __( 'X Number', 'saasland-core' ),
                'description' => __( 'X axis angle number for parallax animation', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => -500,
                'max' => 500,
                'step' => 1,
            ]
        );

        $repeater->add_responsive_control(
            'y_number',
            [
                'label' => __( 'Y Number', 'saasland-core' ),
                'description' => __( 'Y axis angle number for parallax animation', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => -500,
                'max' => 500,
                'step' => 1,
            ]
        );

        $repeater->add_responsive_control(
            'hr_position',
            [
                'label' => __( 'Horizontal Position', 'saasland-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'left: {{SIZE}}{{UNIT}}; right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $repeater->add_responsive_control(
            'vr_position',
            [
                'label' => __( 'Vertical Position', 'saasland-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'top: {{SIZE}}{{UNIT}}; bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'images',
            [
                'label' => __( 'Images', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ alt_text }}}',
            ]
        );

        $this->add_control(
            'img_box_bg_color', [
                'label' => esc_html__( 'Image Box Color 01', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
            ]
        );

        $this->add_control(
            'img_box_bg_color2', [
                'label' => esc_html__( 'Image Box Color 02', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .chat_features_img' => 'background: -webkit-linear-gradient(-140deg, {{img_box_bg_color.VALUE}} 0%, {{VALUE}} 100%);',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings(); ?>
        <div class="chat_features_img chat_features_img_one">
            <?php
            if ( !empty( $settings['images'] ) ) {
                foreach ( $settings['images'] as  $index => $image  ) {
                    $parallax_image = isset( $image['parallax_img']['id'] ) ? $image['parallax_img']['id'] : '';
                    $parallax_image = wp_get_attachment_image_src( $parallax_image, 'full' );
                    $x_number = isset ( $image['x_number'] ) ? $image['x_number'] : '';
                    $y_number = isset ( $image['y_number'] ) ? $image['y_number'] : '';
                    switch ( $index ) {
                        case 0:
                            $align_classes = 'p_absoulte dot_bg';
                            break;
                        case 1:
                            $align_classes = 'chat_one';
                            break;
                        case 2:
                            $align_classes = 'p_absoulte chat_two';
                            break;
                    }

                    if ( $parallax_image ) {  ?>
                        <img class="<?php echo esc_attr( $align_classes ) ?> elementor-repeater-item-<?php echo $image['_id']; ?>"
                             data-parallax='{"x": <?php echo esc_attr( $x_number ); ?>, "y": <?php echo esc_attr( $y_number ); ?>}'
                             src="<?php echo esc_url( $parallax_image[0] ) ?>"
                             alt="<?php echo esc_attr( $image['alt_text'] ) ?>">
                        <?php
                    }
                }
            } ?>
        </div>
       <?php
    }
}