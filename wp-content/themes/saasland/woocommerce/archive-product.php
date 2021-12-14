<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;
$opt = get_option( 'saasland_opt' );

$shop_sidebar = !empty($opt['shop_sidebar']) ? $opt['shop_sidebar'] : '';
if (!isset($opt['shop_sidebar'])) {
    $is_sidebar = (is_active_sidebar( 'shop_sidebar')) ? '9 shop_left' : '12';
}else {
    $is_sidebar = ($shop_sidebar == 'left' || $shop_sidebar == 'right' ) ? '9 shop_left' : '12';
}

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );
?>


    <?php
    if (!is_active_sidebar( 'shop_sidebar' )) {
        if (woocommerce_product_loop()) {
            echo '<div class="row align-items-center">';
            /**
             * Hook: woocommerce_before_shop_loop.
             *
             * @hooked wc_print_notices - 10
             * @hooked woocommerce_result_count - 20
             * @hooked woocommerce_catalog_ordering - 30
             */
            do_action( 'woocommerce_before_shop_loop' );
            echo '</div>';
        }
    }

	// Start page wrapper row
	?>

    <?php
    $is_sidebar_switch = ($shop_sidebar == 'left' ) ? 'flex-row-reverse' : '';;
    ?>

    <div class="row <?php echo esc_attr($is_sidebar_switch) ?>">
        <div class="col-md-<?php echo esc_attr($is_sidebar) ?>">

            <?php
            if (is_active_sidebar( 'shop_sidebar' )) {
                if (woocommerce_product_loop()) {
                    echo '<div class="row align-items-center">';
                    /**
                     * Hook: woocommerce_before_shop_loop.
                     *
                     * @hooked wc_print_notices - 10
                     * @hooked woocommerce_result_count - 20
                     * @hooked woocommerce_catalog_ordering - 30
                     */
                    do_action( 'woocommerce_before_shop_loop' );
                    echo '</div>';
                }
            }
            ?>

            <div class="row">
                <?php
                if ( woocommerce_product_loop() ) {
                woocommerce_product_loop_start();
                if ( wc_get_loop_prop( 'total' ) ) {
                    $wc_loop_i = 1;
                    while ( have_posts() ) {
                        the_post();

                        /**
                         * Hook: woocommerce_shop_loop.
                         *
                         * @hooked WC_Structured_Data::generate_product_data() - 10
                         */
                        do_action( 'woocommerce_shop_loop' );

                        wc_get_template_part( 'content', 'product' );
                        ++$wc_loop_i;
                    }
                }
                woocommerce_product_loop_end();
                ?>
                <div class="hr"></div>

                <?php
                /**
                 * Hook: woocommerce_after_shop_loop.
                 *
                 * @hooked woocommerce_pagination - 10
                 */
                do_action( 'woocommerce_after_shop_loop' );
                } else {
                    /**
                     * Hook: woocommerce_no_products_found.
                     *
                     * @hooked wc_no_products_found - 10
                     */
                    do_action( 'woocommerce_no_products_found' );
                }
                ?>
            </div>
        </div>

        <?php
        /**
         * Hook: woocommerce_sidebar.
         *
         * @hooked woocommerce_get_sidebar - 10
         */
        if ($shop_sidebar != 'full' ) {
            do_action( 'woocommerce_sidebar' );
        }
        ?>

    </div>

    <?php

    /**
     * Hook: woocommerce_after_main_content.
     *
     * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
     */
    do_action( 'woocommerce_after_main_content' );
    ?>

<?php
get_footer( 'shop' );