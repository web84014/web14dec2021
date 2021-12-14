<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_mini_cart' ); ?>

<?php if ( ! WC()->cart->is_empty() ) :
		do_action( 'woocommerce_before_mini_cart_contents' );
            $total_items = count(WC()->cart->get_cart());
            $i = 0;
            foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                $is_single_item = ($total_items == 1) ? 'only_single_item' : '';
                $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

                $product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
                $thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
                $product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
                $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );

                if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
                    $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
                    ?>
                <li class="cart-single-item clearfix <?php echo esc_attr($is_single_item); echo ( ++$i === $total_items ) ? ' last_cart_item' : '';  ?>">
                    <div class="cart-img">
                        <?php
                        $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image( 'saasland_75x75' ), $cart_item, $cart_item_key);
                        if (!$product_permalink) {
                            echo wp_kses_post($thumbnail);
                        } else {
                            printf( '<a href="%s">%s</a>', esc_url($product_permalink), wp_kses_post($thumbnail));
                        }
                        ?>
                    </div>
                    <div class="cart-content text-left">
                        <p class="cart-title">
                            <a href="<?php echo esc_url($product_permalink) ?>">
                                <?php
                                if (!$product_permalink) {
                                    echo wp_kses_post(apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key) . '&nbsp;' );
                                } else {
                                    echo wp_kses_post(apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url($product_permalink), $_product->get_name()), $cart_item, $cart_item_key));
                                }

                                do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key);

                                // Meta data.
                                echo wc_get_formatted_cart_item_data($cart_item); // PHPCS: XSS ok.

                                // Backorder notification.
                                if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity'])) {
                                    echo wp_kses_post(apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'saasland' ) . '</p>'));
                                }
                                ?>
                            </a>
                        </p>
                        <p><?php echo esc_html( $cart_item['quantity'] ) ?> x <?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key); ?> </p>
                    </div>
                    <div class="cart-remove">
                        <?php
                        echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                            'woocommerce_cart_item_remove_link',
                            sprintf(
                                '<a href="%s" class="remove_from_cart_button" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s"><span class="ti-close"></span></a>',
                                esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                                esc_html__( 'Remove this item', 'saasland' ),
                                esc_attr( $product_id ),
                                esc_attr( $cart_item_key ),
                                esc_attr( $_product->get_sku() )
                            ),
                            $cart_item_key
                        );
                        ?>
                    </div>
                </li>
                <?php
                }
            }
            do_action( 'woocommerce_mini_cart_contents' );
        ?>
        <li class="cart_f">
            <div class="cart-pricing">
                <p class="total"> <?php esc_html_e( 'Subtotal :', 'saasland' ) ?> <span class="p-total text-right"> <?php wc_cart_totals_order_total_html(); ?> </span></p>
            </div>
            <div class="cart-button text-center">
                <a class="btn btn-cart get_btn pink" href="<?php echo wc_get_cart_url() ?>"> <?php esc_html_e( 'View Cart', 'saasland' ) ?> </a>
                <a class="btn btn-cart get_btn dark" href="<?php echo wc_get_checkout_url() ?>"> <?php esc_html_e( 'Checkout', 'saasland' ) ?> </a>
            </div>
        </li>


<?php else : ?>
    <li class="empty_mini_cart"><p><?php esc_html_e( 'No products in the cart.', 'saasland' ); ?></p></li>
<?php endif;
do_action( 'woocommerce_after_mini_cart' ); ?>
