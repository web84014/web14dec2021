<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 4.4.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>


    <div class="cart_title">
        <div class="row">
            <div class="col-md-5 col-4">
                <h6 class="f_p"> <?php esc_html_e( 'PRODUCT', 'saasland' ) ?> </h6>
            </div>
            <div class="col-md-2 col-3">
                <h6 class="f_p"> <?php esc_html_e( 'PRICE', 'saasland' ) ?> </h6>
            </div>
            <div class="col-md-2 col-3">
                <h6 class="f_p"> <?php esc_html_e( 'QUANTITY', 'saasland' ) ?> </h6>
            </div>
            <div class="col-md-3 col-2">
                <h6 class="f_p"> <?php esc_html_e( 'TOTAL', 'saasland' ) ?> </h6>
            </div>
        </div>
    </div>

    <form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">

        <?php do_action( 'woocommerce_before_cart_table' ); ?>

        <div class="table-responsive">
            <table class="row table cart_table mb-0 shop_table_responsive woocommerce-cart-form__contents">
                <tbody>
                <?php do_action( 'woocommerce_before_cart_contents' );

                foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                    if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                        $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
                        ?>
                        <tr>
                            <td class="product col-lg-5 col-md-5 col-sm-5 col-xs-5 <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>" data-title="<?php esc_attr_e( 'PRODUCT', 'saasland' ) ?>">
                                <div class="media">
                                    <div class="media-left">
                                        <?php
                                        $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

                                        if ( ! $product_permalink ) {
                                            echo saasland_kses_post( $thumbnail );
                                        } else {
                                            printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), saasland_kses_post( $thumbnail ) );
                                        }
                                        ?>
                                    </div>
                                    <div class="media-body">
                                        <h5 class="mb-0">
                                            <?php
                                            if ( ! $product_permalink ) {
                                                echo saasland_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
                                            } else {
                                                echo saasland_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
                                            }

                                            do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

                                            // Meta data.
                                            echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

                                            // Backorder notification.
                                            if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
                                                echo saasland_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'saasland' ) . '</p>' ) );
                                            }
                                            ?>
                                        </h5>
                                    </div>
                                </div>
                            </td>
                            <td class="col-lg-2 col-md-2 col-sm-2 col-xs-2" data-title="<?php esc_attr_e( 'PRICE', 'saasland' ) ?>">
                                <div class="total"> <?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); ?> </div>
                            </td>
                            <td class="col-lg-2 col-md-2 col-sm-2 col-xs-2" data-title="<?php esc_attr_e( 'QUANTITY', 'saasland' ) ?>">
                                <div class="quantity">
                                    <div class="product-qty">
                                        <?php
                                        if ( $_product->is_sold_individually() ) {
                                            $product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
                                        } else {
                                            $product_quantity = woocommerce_quantity_input( array(
                                                'input_name'   => "cart[{$cart_item_key}][qty]",
                                                'input_value'  => $cart_item['quantity'],
                                                'max_value'    => $_product->get_max_purchase_quantity(),
                                                'min_value'    => '0',
                                                'product_name' => $_product->get_name(),
                                            ), $_product, false );
                                        }
                                        echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
                                        ?>
                                    </div>
                                </div>
                            </td>
                            <td class="col-lg-3 col-md-3 col-sm-3 col-xs-3" data-title="<?php esc_attr_e( 'TOTAL', 'saasland' ) ?>">
                                <div class="del-item product-remove">
                                    <a href="#" class="total">
                                        <?php
                                        echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                                        ?>
                                    </a>
                                    <?php
                                    // @codingStandardsIgnoreLine
                                    echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
                                        '<a href="%s" class="cart_remove" aria-label="%s" data-product_id="%s" data-product_sku="%s"> <i class="icon_close"></i> </a>',
                                        esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                                        esc_html__( 'Remove this item', 'saasland' ),
                                        esc_attr( $product_id ),
                                        esc_attr( $_product->get_sku() )
                                    ), $cart_item_key );
                                    ?>
                                </div>
                            </td>
                        </tr>
                        <?php
                    }
                }
                do_action( 'woocommerce_cart_contents' ); ?>
                </tbody>
            </table>
        </div>

        <div class="hr"></div>

        <div class="row">
            <div class="col-lg-8 col-md-6 actions">
                <div class="action_btn shopping_cart_area">
                    <a href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ) ?>" class="cart_btn"> <?php esc_html_e( 'Continue Shopping', 'saasland' ) ?> </a>
                    <button type="submit" class="cart_btn cart_btn_two update-cart" name="update_cart" value="Update cart">
                        <?php esc_html_e( 'Update cart', 'saasland' ) ?>
                    </button>
                    <?php do_action( 'woocommerce_cart_actions' );
                    wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
                </div>
                <h5 class="f_p f_600 f_size_18 mt_60 mb_20">
                    <?php esc_html_e( 'Discount Code:', 'saasland' ); ?>
                </h5>
                <?php if ( wc_coupons_enabled() ) { ?>
                    <div class="coupon">
                        <input type="text" name="coupon_code" class="input_text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Enter your coupon code', 'saasland' ); ?>" />
                        <button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'saasland' ); ?>"><?php esc_html_e( 'Apply', 'saasland' ); ?></button>
                        <?php do_action( 'woocommerce_cart_coupon' ); ?>
                    </div>
                <?php } ?>
            </div>
            <?php do_action( 'woocommerce_before_cart_collaterals' ); ?>
            <div class="col-lg-4 col-md-6">
                <div class="cart_box">
                    <?php
                    /**
                     * Cart collaterals hook.
                     *
                     * @hooked woocommerce_cross_sell_display
                     * @hooked woocommerce_cart_totals - 10
                     */
                    do_action( 'woocommerce_cart_collaterals' );
                    ?>
                </div>
            </div>
        </div>
        <?php do_action( 'woocommerce_after_cart_contents' ); ?>
        <?php do_action( 'woocommerce_after_cart_table' ); ?>
    </form>

<?php
do_action( 'woocommerce_after_cart' );
