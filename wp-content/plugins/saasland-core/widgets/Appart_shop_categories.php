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
 * Shop Categories
 */
class Appart_shop_categories extends Widget_Base {

    public function get_name() {
        return 'Saasland_appart_shop_categories';
    }

    public function get_title() {
        return __( 'Shop Categories', 'saasland-core' );
    }

    public function get_icon() {
        return ' eicon-cart-medium';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    public function get_style_depends() {
        return [ 'appart-style', 'appart-responsive' ];
    }

    protected function _register_controls() {
        $products_cats = new \Elementor\Repeater();
        $this->start_controls_section(
            'filter', [
                'label' => __( 'Shop Categories', 'saasland-core' ),
            ]
        );
        $products_cats->add_control(
            'product_cat_id', [
                'label' => __( 'Category Name', 'saasland-core' ),
                'description' => __( 'Choose a category name to display.', 'saasland-core' ),
                'separator' => 'before',
                'type' => Controls_Manager::SELECT,
                'options' => saasland_cat_array('product_cat'),
                'default' => 'uncategorized'
            ]
        );
        $products_cats->add_control(
            'product_cat_img', [
                'label' => __( 'Featured Image', 'saasland-core' ),
                'separator' => 'before',
                'type' => Controls_Manager::MEDIA,
            ]
        );
        $this->add_control(
            'shop_categories', [
                'label' => __( 'Categories', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ product_cat_id }}}',
                'fields' => $products_cats->get_controls(),

            ]
        );
        $this->end_controls_section();

        /*-------------------------- Style Job Content --------------------------*/
        $this->start_controls_section(
            'product_cart_style', [
                'label' => __( 'Style', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'product_cat_lable', [
                'label' => __( 'Category Label Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .p_category_item .content h3' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'category_label_typo',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
                    {{WRAPPER}} .p_category_item .content h3',
            ]
        );
        $this->add_control(
            'product_cat_hover', [
                'label' => __( 'Category Hover Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .p_category_item:hover .content h3' => 'color: {{VALUE}};',
                ],
                'separator' => 'after'
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'cat_item_border',
                'label' => __( 'Category Item Border', 'saasland-core' ),
                'selector' => '{{WRAPPER}} .p_category_item',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'category_hover_box_shadow',
                'label' => __( 'Item Hover Box Shadow', 'plugin-domain' ),
                'selector' => '{{WRAPPER}} .p_category_item:hover',
            ]
        );
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();
        ?>
        <section class="popular_category_area">
            <div class="container custom_container">
                <div class="row p_category_info">
                    <?php
                    if ( is_array( $settings['shop_categories'] ) ) {
                        foreach ($settings['shop_categories'] as $cat) {
                            $term   = get_term_by( 'slug', $cat['product_cat_id'], 'product_cat' ); ?>
                            <div class="col-lg-3 col-sm-6">
                                <div class="p_category_item">
                                    <?php echo wp_get_attachment_image( $cat['product_cat_img']['id'], 'saasland_350x400', '', array('class'=>'img-fluid') ) ?>
                                    <div class="content">
                                        <a href="<?php echo esc_url( get_term_link( $term->term_id ) ); ?>"> <h3> <?php echo $term->name ?> </h3></a>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </section>
        <?php
    }

}