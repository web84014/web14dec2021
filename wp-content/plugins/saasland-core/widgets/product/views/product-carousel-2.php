<?php
wp_enqueue_style('slick');
wp_enqueue_style('slick-theme');
wp_enqueue_script('slick');


if( $settings['select_product_query'] == '2' ){
    $query = new WP_Query(array(
        'post_type'           => 'product',
        'post_status'         => 'publish',
        'ignore_sticky_posts' => 1,
        'posts_per_page'      => !empty($settings['product_show_count']) ? $settings['product_show_count'] : -1,
        'order'               => !empty($settings['product_order']) ? $settings['product_order'] : 'DESC',
        'post__not_in'        => !empty($settings['product_exclude']) ? explode(',', $settings['product_exclude']) : '',
        'tax_query' => array(
            array(
                'taxonomy' => 'product_cat',
                'field'    => 'slug',
                'terms'    => !empty($settings['product_cat_slug']) ? $settings['product_cat_slug'] : '',
            )
        ),

    ));
}
elseif( $settings['select_product_query'] == '3' ){
    $product_ids = is_array( $settings['saasland_featured_product'] ) ? array_values( $settings['saasland_featured_product'] ) : '';
    $query = new WP_Query( array(
        'post_type'           => 'product',
        'post_status'         => 'publish',
        'posts_per_page'      => -1,
        'ignore_sticky_posts' => 1,
        'post__in' => $product_ids
    ) );
}
else{
    $query = new WP_Query(array(
        'post_type'           => 'product',
        'post_status'         => 'publish',
        'ignore_sticky_posts' => 1,
        'posts_per_page'      => !empty($settings['product_show_count']) ? $settings['product_show_count'] : -1,
        'order'               => !empty($settings['product_order']) ? $settings['product_order'] : 'DESC',
        'post__not_in'        => !empty($settings['product_exclude']) ? explode(',', $settings['product_exclude']) : '',
    ));
}
?>
<section class="trending_product_area sec_pad">
    <div class="container">
        <div class="row align-items-center mb_70">
            <div class="col-sm-9">
                <div class="shop_title">
                    <?php
                    if( !empty( $settings['product_carousel_sec_title'] ) ){
                        echo '<h2 class="w_color">'. esc_html( $settings['product_carousel_sec_title'] ) .'</h2>';
                    }
                    ?>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="custom_arrow text-right">
                    <button class="prev"><i class="ti-arrow-left"></i></button>
                    <button class="next"><i class="ti-arrow-right"></i></button>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex">
        <div class="tr_pr_left"></div>
        <div class="tr_pr_right">
            <div class="row trending_product_slider">
                <?php
                while( $query->have_posts()) : $query->the_post();
                    global $product; ?>
                    <div class="col-lg-12 item">
                        <div class="gadget_pr_item one">
                            <div class="pr_img">
                                <?php
                                if ( $product->is_on_sale() ) {
                                    echo ' <div class="badge sale">'. esc_html__( 'Sale', 'saasland-core' ) .'</div>';
                                } ?>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('saasland_270x330');?>
                                </a>
                                <div class="hover_content">
                                    <a href="?add-to-cart=<?php echo get_the_ID() ?>" class="cart_btn_gadget"><img src="<?php echo esc_url( plugins_url() ) ?>/saasland-core/widgets/images/cart_icon.png" alt="<?php echo esc_attr( 'home gadget product', 'saasland-core' )?>"></a>
                                    <?php echo shortcode_exists('ti_wishlists_addtowishlist') ? do_shortcode('[ti_wishlists_addtowishlist]') : '';?>
                                </div>
                            </div>
                            <div class="single_pr_details">
                                <a href="<?php the_permalink(); ?>">
                                    <h3><?php the_title(); ?></h3>
                                </a>
                                <div class="price">
                                    <?php woocommerce_template_loop_price(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata(); ?>
            </div>
        </div>
    </div>
</section>
<?php
$carouel_loop   = !empty( $settings['carousel_loop'] ) ? $settings['carousel_loop'] : 'true';
$autoplay       = !empty( $settings['carousel_autoplay'] ) ? $settings['carousel_autoplay'] : 'true';
$smartSpeed     = !empty( $settings['carousel_slide_speed'] ) ? $settings['carousel_slide_speed'] : '2000';
$slideDelay     = !empty( $settings['carousel_slide_delay'] ) ? $settings['carousel_slide_delay'] : '5000';
$slideItem      = !empty( $settings['slide_item'] ) ? $settings['slide_item'] : '5';
?>

<script>
    ;(function($){
        "use strict";
        $(document).ready(function () {

            function trendingSlider() {
                var productCarousel2 = $(".trending_product_slider");
                if ( productCarousel2.length > 0) {
                    var PSlider = productCarousel2;
                    if (PSlider.length) {
                        PSlider.slick({
                            loop: <?php echo esc_js( $carouel_loop ) ?>,
                            autoplay: <?php echo esc_js( $autoplay ) ?>,
                            smartSpeed: <?php echo esc_js( $smartSpeed ) ?>,
                            autoplayTimeout: <?php echo esc_js( $slideDelay ) ?>,
                            slidesToShow: <?php echo esc_js( $slideItem ) ?>,
                            slidesToScroll: 1,
                            centerMode: true,
                            centerPadding:'85px',
                            autoplaySpeed: 3000,
                            rtl: <?php echo !is_rtl() ? 'false' : 'true'; ?>,
                            speed: 1000,
                            dots: false,
                            arrows: true,
                            prevArrow: ".prev",
                            nextArrow: ".next",
                            responsive: [
                                {
                                    breakpoint: 1200,
                                    settings: {
                                        slidesToShow: 4,
                                    },
                                },
                                {
                                    breakpoint: 992,
                                    settings: {
                                        slidesToShow: 3,
                                    },
                                },
                                {
                                    breakpoint: 650,
                                    settings: {
                                        slidesToShow: 2,
                                    },
                                },
                                {
                                    breakpoint: 480,
                                    settings: {
                                        slidesToShow: 1,
                                    },
                                }
                            ],
                        });
                    }
                }
            }
            trendingSlider();

        })
    })(jQuery)
</script>
