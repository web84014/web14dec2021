<?php
wp_enqueue_script( 'tinvwl');
wp_enqueue_script( 'woocommerce' );
wp_enqueue_script( 'isotope' );
wp_enqueue_script( 'imagesloaded' );
?>
<section class="shop_product_area">
    <div class="container">
        <div id="pr_filter" class="product_filter mb_60">
            <div data-filter="*" class="work_portfolio_item active">All</div>
            <?php
            $product_cats = get_terms( array(
                'taxonomy' => 'product_cat',
                'hide_empty' => true,
            ));

            if( is_array( $product_cats ) ){
                foreach ( $product_cats as $cat ) {
                    echo '<div data-filter=".'.esc_attr( $cat->slug ).'" class="work_portfolio_item">'. esc_html( $cat->name ) .'</div>';
                }
            }
            ?>
        </div>
        <div class="row product_gallery mb_30" id="pr_gallery">
            <?php
            $query = new WP_Query(array(
                'post_type'           => 'product',
                'post_status'         => 'publish',
                'ignore_sticky_posts' => 1,
                'posts_per_page'      => !empty($settings['_product_show_count']) ? $settings['_product_show_count'] : '8',
                'order'               => !empty($settings['_tab_product_order']) ? $settings['_tab_product_order'] : 'DESC',
                'post__not_in'        => !empty($settings['_tab_product_exclude']) ? explode(',', $settings['_tab_product_exclude']) : '',
            ));

            $column = !empty( $settings['product_col'] ) ? $settings['product_col'] : '3';

            if( $query->have_posts() ){
                while ( $query->have_posts() ){
                    $query->the_post();
                    global $product;
                    $terms = get_the_terms( get_the_ID(), 'product_cat' );
                    $cat_name = array();
                    foreach ( $terms as $term ) {
                        $cat_name[] = $term->slug;
                    }
                    $on_cat = join( " ", $cat_name );

                    ?>
                    <div class="col-lg-<?php echo esc_attr( $column ) ?> col-sm-4 portfolio-item fadeInUp <?php echo esc_attr( $on_cat ) ?>">
                        <div class="gadget_pr_item">
                            <div class="pr_img">
                                <?php
                                if ( $product->is_on_sale() ) {
                                    echo ' <div class="badge sale">'. esc_html__( 'Sale', 'saasland-core' ) .'</div>';
                                } ?>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('saasland_270x350');?>
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

                                <?php woocommerce_template_loop_price(); ?>

                            </div>
                        </div>
                    </div>
                    <?php
                }
                wp_reset_postdata();
            }
            ?>
        </div>
    </div>
</section>
<script>
    ;(function($){
        "use strict";
        $(document).ready(function () {

            /*---------gallery isotope js-----------*/
            function productMasonry(){
                if ( $('#pr_gallery').length ){
                    $('#pr_gallery').imagesLoaded( function() {
                        // images have loaded
                        // Activate isotope in container
                        $("#pr_gallery").isotope({
                            filter: '',
                            layoutMode: 'masonry',
                            animationOptions: {
                                duration: 750,
                                easing: 'linear'
                            }
                        });

                        // Add isotope click function
                        $("#pr_filter div").on('click',function(){
                            $("#pr_filter div").removeClass("active");
                            $(this).addClass("active");

                            var selector = $(this).attr("data-filter");
                            $("#pr_gallery").isotope({
                                filter: selector,
                                animationOptions: {
                                    animationDuration: 750,
                                    easing: 'linear',
                                    queue: false
                                }
                            })
                            return false;
                        })
                    })
                }
            }
            productMasonry();

        })
    })(jQuery)
</script>