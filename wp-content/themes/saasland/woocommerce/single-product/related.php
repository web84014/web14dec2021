<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$opt = get_option( 'saasland_opt' );

if ( $related_products ) : ?>

	<section class="shop_grid_area related_products sec_pad">
        <div class="container">
            <div class="sec_title text-center mb_<?php echo !empty($opt['related_products_subtitle']) ? '70' : '40'; ?>">
                <?php if (!empty($opt['related_products_title'])) : ?>
                    <h2 class="f_p f_size_30 l_height50 f_600 t_color3">
                        <?php echo wp_kses_post($opt['related_products_title']) ?>
                    </h2>
                <?php endif; ?>
                <?php if (!empty($opt['related_products_subtitle'])) : ?>
                    <p class="f_400 f_size_16 mb-0">
                        <?php echo wp_kses_post(nl2br($opt['related_products_subtitle'])) ?>
                    </p>
                <?php endif; ?>
            </div>

            <div class="row mb_30">
                <?php woocommerce_product_loop_start(); ?>

                    <?php foreach ( $related_products as $related_product ) : ?>

                        <?php
                        $post_object = get_post( $related_product->get_id() );

                        setup_postdata( $GLOBALS['post'] =& $post_object );

                        wc_get_template_part( 'content', 'product' ); ?>

                    <?php endforeach; ?>

                <?php woocommerce_product_loop_end(); ?>
            </div>
        </div>
	</section>

<?php endif;

wp_reset_postdata();
