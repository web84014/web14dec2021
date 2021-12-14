<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
$short_description = apply_filters( 'woocommerce_short_description', $post->post_excerpt );
$opt = get_option( 'saasland_opt' );
$shop_layout = !empty($opt['shop_layout']) ? $opt['shop_layout'] : 'shop_grid';
?>

<?php
$view_style = !empty($_GET['view']) ? $_GET['view'] : '';

if ($shop_layout == 'shop_grid' ) {
    if ($view_style == 'list' ) {
        get_template_part( 'woocommerce/wc-template-parts/content', 'list' );
    }
    else {
        get_template_part( 'woocommerce/wc-template-parts/content', 'grid' );
    }
}

elseif ($shop_layout == 'shop_list' ) {
    if ($view_style == 'grid' ) {
        get_template_part( 'woocommerce/wc-template-parts/content', 'grid' );
    }
    else {
        get_template_part( 'woocommerce/wc-template-parts/content', 'list' );
    }
}
else {
    get_template_part( 'woocommerce/wc-template-parts/content', 'list' );
}