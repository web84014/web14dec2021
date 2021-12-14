<?php
$opt = get_option( 'saasland_opt' );
$is_mini_cart = !empty($opt['is_mini_cart']) ? $opt['is_mini_cart'] : '';
$is_search = !empty($opt['is_search']) ? $opt['is_search'] : '';
$icon_classes = ( $is_search == '1' ) ? 'search_exist' : '';
$icon_classes .= ( $is_mini_cart == '1' ) ? ' mini_cart_exist' : '';
?>
    <div class="alter_nav <?php echo esc_attr($icon_classes) ?>">
        <ul class="navbar-nav search_cart menu">

            <?php if ( $is_search == '1' ) : ?>
                <li class="nav-item search"><a class="nav-link search-btn" href="javascript:void(0);"><i class="ti-search"></i></a></li>
            <?php endif; ?>

            <?php
            if ( class_exists( 'WooCommerce' ) && $is_mini_cart == '1' ) : ?>
                <li class="nav-item shpping-cart dropdown submenu">
                    <a class="cart-btn nav-link dropdown-toggle" href="<?php echo wc_get_cart_url() ?>" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                    <ul class="dropdown-menu saasland_ajax_minicart"></ul>
                </li>
                <?php
            endif;
            ?>
        </ul>
    </div>