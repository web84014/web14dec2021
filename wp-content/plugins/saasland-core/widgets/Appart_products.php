<?php
namespace SaaslandCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use WP_Query;

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
class Appart_products extends Widget_Base {

    public function get_name() {
        return 'Saasland_appart_products';
    }

    public function get_title() {
        return __( 'Products (Grid View)', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-products';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    public function get_style_depends() {
        return [ 'appart-style', 'appart-responsive' ];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'filter', [
                'label' => __( 'Filter', 'saasland-core' ),
            ]
        );
        $this->add_control(
            'show_count', [
                'label' => esc_html__( 'Show products', 'saasland-core' ),
                'description' => esc_html__( 'How much featured products do you want to show in this section?', 'saasland-core' ),
                'type' => Controls_Manager::NUMBER,
                'label_block' => true,
                'default' => 6
            ]
        );
        $this->add_control(
            'order', [
                'label' => esc_html__( 'Order', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'ASC' => 'ASC',
                    'DESC' => 'DESC'
                ],
                'default' => 'ASC'
            ]
        );
        $this->add_control(
            'excerpt', [
                'label' => esc_html__( 'Excerpt Limit', 'saasland-core' ),
                'type' => Controls_Manager::NUMBER,
                'label_block' => true,
                'default' => 7
            ]
        );
        $this->end_controls_section();


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
        $this->end_controls_section(); // End the Button


        //------------------------------ Style button ------------------------------
        $this->start_controls_section(
            'style_button', [
                'label' => __( 'Style button', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'bg_color_btn', [
                'label' => __( 'Background color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trending_product_area .new_banner_btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'color_btn', [
                'label' => __( 'Text color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trending_product_area .new_banner_btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_btn',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .trending_product_area .new_banner_btn',
            ]
        );
        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings();
        $query = new WP_Query( array(
            'post_type'           => 'product',
            'post_status'         => 'publish',
            'ignore_sticky_posts' => 1,
            'posts_per_page'      => !empty($settings['show_count']) ? $settings['show_count'] : -1,
            'order'               => !empty($settings['order']) ? $settings['order'] : 'DESC',
        ) );
        $excerpt = !empty($settings['excerpt']) ? $settings['excerpt'] : 7;
        ?>
        <section class="trending_product_area post-type-archive-product woocommerce">
            <div class="container custom_container">
                <div class="row">
                    <?php
                    while($query->have_posts()) : $query->the_post(); ?>
                        <div <?php wc_product_class( 'col-lg-3 col-md-4 col-sm-6' ) ?>>
                            <div class="tr_product_item">
                                <?php the_post_thumbnail( 'saasland_350x360', array( 'class'=>'img-fluid')) ?>
                                <div class="prduct_details">
                                    <a href="<?php the_permalink() ?>" title="<?php the_title() ?>">
                                        <h5> <?php echo wp_trim_words(get_the_title(), 3, '') ?> </h5>
                                    </a>
                                    <a href="<?php the_permalink() ?>" class="price">
                                        <?php woocommerce_template_loop_price(); ?>
                                    </a>

                                    <?php if ($excerpt > 0) : ?>
                                        <p> <?php echo wp_trim_words(get_the_excerpt(), $excerpt, '') ?> </p>
                                    <?php endif; ?>

                                    <?php woocommerce_template_single_rating() ?>

                                </div>
                            </div>
                        </div>
                    <?php
                    endwhile;
                    wp_reset_postdata(); ?>

                    <?php
                    if (!empty($settings['btn_label'])) :
                        $is_external = $settings['btn_url']['is_external'] == true ? 'target="_blank"' : ''; ?>
                        <div class="col-lg-12 text-center">
                            <a href="<?php echo esc_url($settings['btn_url']['url']) ?>"
                               class="new_banner_btn" <?php echo $is_external; ?>>
                                <?php echo esc_html($settings['btn_label']) ?>
                            </a>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </section>
        <?php
    }

}