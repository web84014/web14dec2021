<?php
/**
 * Checkout coupon form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-coupon.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.4
 */

defined( 'ABSPATH' ) || exit;

if ( ! wc_coupons_enabled() ) { // @codingStandardsIgnoreLine.
    return;
}

?>

<div class="row" id="checkout_top_forms">

    <?php
    if (!is_user_logged_in()) :
        ?>
        <div class="col-lg-6">
        <div class="checkout_content">
            <!-- Login Form -->
            <div class="return_customer">
                <i class="icon_error-circle_alt"></i>
                <?php esc_html_e( 'Returning customer?', 'saasland' ) ?>
                <a data-toggle="collapse" href="#coupon" aria-expanded="false" class="collapsed"> <?php esc_html_e( 'Click here to login', 'saasland' ) ?> </a>
            </div>
            <div class="collapse tab_content" id="coupon">
                <p class="f_p f_300"> <?php esc_html_e( 'If you have shopped with us before, please enter your details below. If you are a new customer, please proceed to the Billing & Shipping section.', 'saasland' ) ?></p>
                <form class="login_form" name="loginform" action="<?php echo esc_url( site_url( 'wp-login.php', 'login_post' ) ); ?>" method="post">
                    <div class="row">
                        <div class="col-lg-6">
                            <input type="text" name="log" class="form-control" placeholder="<?php esc_attr_e( 'Username or Email', 'saasland' ) ?>">
                        </div>
                        <div class="col-lg-6">
                            <input type="password" name="pwd" class="form-control" placeholder="<?php esc_attr_e( 'Password', 'saasland' ) ?>">
                        </div>
                        <div class="col-lg-12">
                            <div class="login_button">
                                <input type="checkbox" id="squared1" name="rememberme" value="forever">
                                <label class="l_text" for="squared1"> <?php esc_html_e( 'Remember Me', 'saasland' ) ?> </label>
                                <button class="btn login_btn" type="submit" name="wp-submit">Login</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </div>
    <?php
    endif;
    ?>

    <div class="col-lg-6">
        <div class="checkout_content coupon_form">
            <!-- Coupon code apply form -->
            <div class="return_customer">
                <i class="icon_error-circle_alt"></i>
                <?php
                echo apply_filters( 'woocommerce_checkout_coupon_message', esc_html__( 'Have a coupon?', 'saasland' ) .
                ' <a data-toggle="collapse" href="#coupon_two" aria-expanded="false" class="collapsed">' . esc_html__( 'Click here to enter your code', 'saasland' ) . '</a>' );
                ?>
            </div>

            <div CLASS="collapse tab_content" id="coupon_two">
                <p class="f_p f_300"> <?php esc_html_e( 'If you have a coupon code, please apply it below.', 'saasland' ) ?> </p>
                <form class="login_form coupon_form" method="post">
                    <!--<p><?php /*esc_html_e( 'If you have a coupon code, please apply it below.', 'saasland' ); */?></p>-->
                    <input type="text" name="coupon_code" class="form-control" placeholder="<?php esc_attr_e( 'Coupon code', 'saasland' ); ?>" id="coupon_code" value="" />
                    <button type="submit" class="btn login_btn" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'saasland' ); ?>">
                        <?php esc_html_e( 'Apply coupon', 'saasland' ); ?>
                    </button>
                </form>
            </div>
        </div>
    </div>

</div>