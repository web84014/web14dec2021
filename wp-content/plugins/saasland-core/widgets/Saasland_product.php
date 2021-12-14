<?php
namespace SaaslandCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor about widget.
 *
 * Elementor widget that displays a collapsible display of content in an toggle
 * style, allowing the user to open multiple items.
 *
 * @since 1.0.0
 */
class Saasland_product extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve about widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'saasland_product';
    }

    /**
     * Get widget title.
     *
     * Retrieve about widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __( 'Products [Saasland]', 'saasland-core' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve about widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-products';
    }

    /**
     * Get widget keywords.
     *
     * Retrieve the list of keywords the widget belongs to.
     *
     * @since 2.1.0
     * @access public
     *
     * @return array Widget keywords.
     */
    public function get_keywords() {
        return [ 'product', 'product carousel' ];
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    /**
     * Register about widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls() {

        // ------------------------------ Slider Style ------------------------------
        $this->start_controls_section(
            'product_style_sec', [
                'label' => __( 'Product Style', 'saasland-core' ),
            ]
        );
        $this->add_control(
            'product_style', [
                'label' => __( 'Product Style', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => __( 'Product Carousel', 'saasland-core' ),
                    '2' => __( 'product Grid', 'saasland-core' ),
                    '3' => __( 'product Carousel 2', 'saasland-core' ),
                    '4' => __( 'product Category Tab', 'saasland-core' ),
                    '5' => __( 'product Category Block', 'saasland-core' ),
                ],
                'default' => '1',
                'label_block' => true
            ]
        );
        $this->end_controls_section();

        include 'product/settings/product-carousel.php';
        include 'product/settings/product-grid.php';
        include 'product/settings/product-carousel-2.php';
        include 'product/settings/product-category-tab.php';
        include 'product/settings/product-category-block.php';

    }

    /**
     * Render about widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings();
        wp_enqueue_style( 'saasland-style-new' );

        if( $settings['product_style'] == '1' ) {
            include 'product/views/product-carousel.php';
        }
        if( $settings['product_style'] == '2' ) {
            include 'product/views/product-grid.php';
        }
        if( $settings['product_style'] == '3' ) {
            include 'product/views/product-carousel-2.php';
        }
        if( $settings['product_style'] == '4' ) {
            include 'product/views/product-category-tab.php';
        }
        if( $settings['product_style'] == '5' ) {
            include 'product/views/product-category-block.php';
        }

    }
}
