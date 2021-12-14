<?php
$opt = get_option( 'saasland_opt' );

    // Re-arrange the product tabs
    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
    add_action( 'woocommerce_single_product_after_main_content', 'woocommerce_output_product_data_tabs', 15);
    // Re-arrange the related products, upsell product
    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
    add_action( 'woocommerce_single_product_after_main_content', 'woocommerce_upsell_display', 20);
    add_action( 'woocommerce_single_product_after_main_content', 'woocommerce_output_related_products', 25);


/**
 * Checkout form fields customizing
 */
add_filter( 'woocommerce_checkout_fields' , function ( $fields ) {

    $woocommerce_checkout_company_field = get_option('woocommerce_checkout_company_field');

    $woocommerce_checkout_phone_field = get_option('woocommerce_checkout_phone_field');
    $woocommerce_checkout_phone_required = ($woocommerce_checkout_phone_field == 'required') ? true : false;

    // Billing Fields
    $fields['billing']['billing_first_name'] = array(
        'label'         => '',
        'placeholder'   => esc_html_x( 'First name *', 'placeholder', 'saasland' ),
        'class'         => array( 'col-md-6' ),
        'clear'         => true,
        'required'      => true
    );

    $fields['billing']['billing_last_name'] = array(
        'label'         => '',
        'placeholder'   => esc_html_x( 'Last name *', 'placeholder', 'saasland' ),
        'class'         => array( 'col-md-6' ),
        'clear'         => true,
        'required'      => true
    );

    $fields['billing']['billing_company'] = array(
        'label'         => '',
        'placeholder'   => esc_html_x( "Company name", 'placeholder', 'saasland' ),
        'class'         => array( 'col-md-12', $woocommerce_checkout_company_field ),
        'clear'         => true,
        'required'      => ( $woocommerce_checkout_company_field == 'required' ) ? true : false
    );

    $fields['billing']['billing_city'] = array(
        'label'         => '',
        'placeholder'   => esc_html_x( 'Town / City *', 'placeholder', 'saasland' ),
        'class'         => array( 'col-md-12' ),
        'clear'         => true
    );

    $fields['billing']['billing_postcode'] = array(
        'label'         => '',
        'placeholder'   => esc_html_x( 'Postcode / ZIP (optional)', 'placeholder', 'saasland' ),
        'class'         => array( 'col-md-12' ),
        'clear'         => true
    );

    $fields['billing']['billing_phone'] = array(
        'label'         => '',
        'placeholder'   => esc_html_x( 'Phone', 'placeholder', 'saasland' ),
        'required'      => $woocommerce_checkout_phone_required,
        'class'         => array( 'col-md-6', $woocommerce_checkout_phone_field ),
        'clear'         => true
    );

    $email_column = $woocommerce_checkout_phone_field=='hidden' ? '12' : '6';
    $fields['billing']['billing_email'] = array(
        'label'         => '',
        'placeholder'   => esc_html_x( 'Email address *', 'placeholder', 'saasland' ),
        'required'      => true,
        'class'         => array( "col-md-".$email_column ),
        'clear'         => true
    );

    // Shipping Fields
    $fields['shipping']['shipping_first_name'] = array(
        'label'         => '',
        'placeholder'   => esc_html_x( 'First name *', 'placeholder', 'saasland' ),
        'required'      => false,
        'class'         => array( 'col-md-6' ),
        'clear'         => true
    );

    $fields['shipping']['shipping_last_name'] = array(
        'label'         => '',
        'placeholder'   => esc_html_x( 'Last name *', 'placeholder', 'saasland' ),
        'required'      => false,
        'class'         => array( 'col-md-6' ),
        'clear'         => true
    );

    $fields['shipping']['shipping_company'] = array(
        'label'         => '',
        'placeholder'   => esc_html_x( 'Company name (optional)', 'placeholder', 'saasland' ),
        'required'      => false,
        'class'         => array( 'col-md-12' ),
        'clear'         => true
    );

    $fields['shipping']['shipping_city'] = array(
        'label'         => '',
        'placeholder'   => esc_html_x( 'Town / City *', 'placeholder', 'saasland' ),
        'class'         => array( 'col-md-12' ),
        'clear'         => true
    );

    $fields['shipping']['shipping_postcode'] = array(
        'label'         => '',
        'placeholder'   => esc_html_x( 'Postcode / ZIP (optional)', 'placeholder', 'saasland' ),
        'class'         => array( 'col-md-12' ),
        'clear'         => true
    );

    $fields['shipping']['shipping_phone'] = array(
        'label'         => '',
        'placeholder'   => esc_html_x( 'Phone', 'placeholder', 'saasland' ),
        'required'      => $woocommerce_checkout_phone_required,
        'class'         => array( 'col-md-6 '.$woocommerce_checkout_phone_field ),
        'clear'         => true
    );

    $fields['shipping']['shipping_email'] = array(
        'label'         => '',
        'placeholder'   => esc_html_x( 'Email address *', 'placeholder', 'saasland' ),
        'required'      => true,
        'class'         => array( 'col-md-6' ),
        'clear'         => true
    );

    return $fields;
});


// WooCommerce review list
function saasland_woocommerce_comments($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);
    ?>
    <li class="post-comment" id="comment-<?php comment_ID() ?>">
        <div class="comment-content">
            <a href="#" class="avatar">
                <?php echo get_avatar($comment, 70); ?>
            </a>
            <div class="post-body">
                <div class="comment-header">
                    <a href="#"> <?php comment_author(); ?> </a>
                    <?php echo get_comment_time(get_option( 'date_format')); ?>
                </div>
                <div class="rating">
                    <?php woocommerce_review_display_rating() ?>
                </div>
                <?php comment_text() ?>
                <div class="hr mt_30 mb-0"></div>
            </div>
        </div>
    </li>
    <?php
}


// Enabling the gallery in themes that declare
add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );


// Product Gallery thumbnail size
add_filter( 'woocommerce_get_image_size_gallery_thumbnail', function( $size ) {
    return array(
        'width' => 120,
        'height' => 140,
        'crop' => 1,
    );
} );
