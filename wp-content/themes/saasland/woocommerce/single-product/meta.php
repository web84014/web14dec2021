<?php
/**
 * Single Product Meta
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/meta.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$opt = get_option( 'saasland_opt' );
global $product;

$sku_v = ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'saasland' );

?>
<div class="pr_footer mt_40 mb-30">

    <ul class="product_meta list-unstyled">

        <?php do_action( 'woocommerce_product_meta_start' );

        if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) { ?>
            <li class="sku_wrapper"> <span> <?php esc_html_e( 'SKU:', 'saasland' ); ?> </span> <?php echo wp_kses_post($sku_v) ?></li>
        <?php
        }

        if( $opt['is_product_category'] == '1' ){
            echo wc_get_product_category_list( $product->get_id(), ', ', '<li class="posted_in"> <span>' . _n( 'Category:', 'Categories:', count( $product->get_category_ids() ), 'saasland' ) .'</span>' , '</li>' );
        }

        if( $opt['is_product_tags'] == '1' ){
            echo wc_get_product_tag_list( $product->get_id(), ', ', '<li class="tagged_as"><span>' . _n( 'Tag:', 'Tags: ', count( $product->get_tag_ids() ), 'saasland' ) . '</span>', '</li>' );
        }

        do_action( 'woocommerce_product_meta_end' ); ?>

    </ul>
    <?php
    if( $opt['is_product_share'] == '1' ){ ?>
        <div class="share-link">
            <label> <?php esc_html_e( 'Share ON:', 'saasland' ) ?> </label>
            <ul class="social-icon list-unstyled">
                <?php
                if( '1' == $opt['is_product_social_share_links']['facebook'] ){ ?>
                    <li><a href="https://facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank"><i class="ti-facebook"></i></a></li>
                    <?php
                }
                if( '1' == $opt['is_product_social_share_links']['twitter'] ){ ?>
                    <li><a href="https://twitter.com/intent/tweet?text=<?php the_permalink(); ?>" target="_blank"><i class="ti-twitter"> </i></a></li>
                    <?php
                }
                if( '1' == $opt['is_product_social_share_links']['pinterest'] ){ ?>
                    <li><a href="https://www.pinterest.com/pin/create/button/?url=<?php the_permalink() ?>" target="_blank"><i class="ti-pinterest"> </i></a></li>
                    <?php
                }
                if( '1' == $opt['is_product_social_share_links']['linkedin'] ){ ?>
                    <li><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink() ?>" target="_blank"><i class="ti-linkedin"> </i></a></li>
                    <?php
                }
                ?>
            </ul>
        </div>
        <?php
    } ?>
</div>