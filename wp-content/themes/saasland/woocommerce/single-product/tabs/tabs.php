<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.8.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 *
 * @see woocommerce_default_product_tabs()
 */
$product_tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $product_tabs ) ) : ?>

    <div class="pr_details_area">
        <div class="container">
            <div class="woocommerce-tabs wc-tabs-wrapper product_info_details">
                <ul class="tabs wc-tabs nav nav-tabs pr_tab mb_50" role="tablist">
                    <?php foreach ( $product_tabs as $key => $tab ) : ?>
                        <li class="<?php echo esc_attr( $key ); ?>_tab nav-item" id="tab-title-<?php echo esc_attr( $key ); ?>" role="tab" aria-controls="tab-<?php echo esc_attr( $key ); ?>">
                            <a href="#tab-<?php echo esc_attr( $key ); ?>" class="nav-link"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <?php foreach ( $product_tabs as $key => $tab ) : ?>
                    <div class="tab-content service_tab_content woocommerce-Tabs-panel woocommerce-Tabs-panel--<?php echo esc_attr( $key ); ?> panel entry-content wc-tab" id="tab-<?php echo esc_attr( $key ); ?>" role="tabpanel" aria-labelledby="tab-title-<?php echo esc_attr( $key ); ?>">
                        <div class="aditional_info">
                            <?php if ( isset( $tab['callback'] ) ) { call_user_func( $tab['callback'], $key, $tab ); } ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

<?php endif; ?>
