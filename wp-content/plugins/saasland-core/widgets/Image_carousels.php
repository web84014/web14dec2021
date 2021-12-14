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
class Image_carousels extends Widget_Base {
	public function get_name() {
		return 'saasland-image-carousels';
	}

	public function get_title() {
		return __( 'Saasland Carousels', 'saasland-core' );
	}

	public function get_icon() {
		return 'eicon-post-slider';
	}

	public function get_style_depends() {
		return [ 'saasland-demo' ];
	}

	public function get_categories() {
		return [ 'saasland-elements' ];
	}

	public function get_keywords() {
		return [ 'Image Carousel' ];
	}

	protected function _register_controls() {
        $this->start_controls_section(
            'section_bg_style',
            [
                'label' => __( 'Section Style', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'style', [
                'label' => esc_html__( 'Carousel Style', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [
                    'style_01' => esc_html__( '01 Screenshot Carousel', 'saasland-core' ),
                    'style_02' => esc_html__( '02 Auto Carousel Rows', 'saasland-core' ),
                    'style_03' => esc_html__( '03 One Slide Focus', 'saasland-core' ),
                    'style_04' => esc_html__( '04', 'saasland-core' ),
                    'style_05' => esc_html__( '05', 'saasland-core' ),
                    'style_06' => esc_html__( '06 Blog Slider', 'saasland-core' ),
                ],
                'default' => 'style_01',
            ]
        );

        $this->end_controls_section();

        /**
         * Title
         * 'style_01', 'style_04', 'style_05', 'style_06'
         */
        include ( 'image-carousels/settings/title-options.php' );

		/**
         * Images
         * 'style_01', 'style_02', 'style_03', 'style_04'
         **/
        include ( 'image-carousels/settings/images.php' );

        /**
         * Carousel
         * 'style_05'
         */
        include ( 'image-carousels/settings/carousel-style5.php' );

        /**
         * Carousel
         * 'style_06'
         */
        include ( 'image-carousels/settings/carousel-style6.php' );

        /**
         * Slider Settings
         */
        include ( 'image-carousels/settings/carousel-settings.php' );

		/**
		 * Style Tab
		 * @Title, @Subtitle, @Section
		 */
		include ( 'image-carousels/settings/style-tab.php' );
	}

	protected function render() {
		$settings = $this->get_settings();
		$images = isset($settings['images']) ? $settings['images'] : '';
		$title_tag = !empty($settings['title_html_tag']) ? $settings['title_html_tag'] : 'h2';

        /**
         * Carousel Js Settings
         */
        $is_auto_play = ($settings['is_auto_play'] == 'yes') ? 'true' : 'false';
        $is_loop = isset($settings['is_loop']) ? $settings['is_loop'] : '';
        $autoplay_speed = '';
        if ( $settings['is_auto_play'] == 'yes' ) {
            $autoplay_speed = !empty($settings['autoplay_speed']) ? "autoplaySpeed: {$settings['autoplay_speed']}," : 'autoplaySpeed: 1000,';
        }

        if ( $settings['style'] == 'style_01' ) {
            include 'image-carousels/views/01_screenshot-carousel.php';
        }

        if ( $settings['style'] == 'style_02' ) {
            include 'image-carousels/views/02_carousel-rows.php';
        }

        if ( $settings['style'] == 'style_03' ) {
            include 'image-carousels/views/03_portfolio_slider.php';
        }

        if ( $settings['style'] == 'style_04' ) {
            include 'image-carousels/views/04_.php';
        }

        if ( $settings['style'] == 'style_05' ) {
            include 'image-carousels/views/05_.php';
        }

        if ( $settings['style'] == 'style_06' ) {
            include 'image-carousels/views/06_.php';
        }
	}

}