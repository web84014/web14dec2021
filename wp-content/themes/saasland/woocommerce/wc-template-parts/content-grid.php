<?php
global $wc_loop_i;
global $product;
$opt = get_option( 'saasland_opt' );
$column = wc_get_loop_prop( 'columns' );
$is_product_lightbox = isset($opt['is_product_lightbox']) ? $opt['is_product_lightbox'] : '1';
$is_add_to_cart = isset($opt['is_add_to_cart']) ? $opt['is_add_to_cart'] : '1';

switch ($column) {
    case '3':
        $col = '4';
        $image_size = 'saasland_270x320';
        break;
    case '4':
        $col = '3';
        $image_size = 'saasland_300x320';
        break;
    case '2':
        $col = '6';
        $image_size = 'full';
        break;
    default:
        $col = '4';
        $image_size = 'saasland_270x320';
        break;
}
?>
<div <?php wc_product_class( 'col-md-'.$col.' col-sm-6' ); ?>>
    <div class="single_product_item">
        <div class="product_img">
            <?php the_post_thumbnail($image_size, array( 'class' => 'img-fluid')) ?>
            <div class="hover_content">
                <?php
                echo shortcode_exists( 'ti_wishlists_addtowishlist' ) ? do_shortcode( '[ti_wishlists_addtowishlist]' ) : '';
                if ( $is_add_to_cart == '1' ) :
                    woocommerce_template_loop_add_to_cart();
                endif;
                if ( $is_product_lightbox == '1' ) : ?>
                    <a class="saasland-quick-view" id="product_id_<?php echo esc_attr( $product->get_id() ) ?>" data-product_id="<?php echo esc_attr( $product->get_id() ) ?>" data-toggle="modal"
                       data-target=".product_compair_modal" aria-label="Quickview" href="#"
                       target="_blank" rel="nofollow">
                        <i class="ti-eye"></i>
                    </a>
                <?php endif; ?>
            </div>
        </div>
        <div class="single_pr_details">
            <a href="<?php the_permalink() ?>">
                <h3 class="f_p f_500 f_size_16"> <?php the_title() ?> </h3>
            </a>
            <?php woocommerce_template_loop_price(); ?>
            <?php woocommerce_template_single_rating() ?>
        </div>
    </div>
</div>