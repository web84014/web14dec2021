<?php
wp_enqueue_script( 'tinvwl');
wp_enqueue_script( 'woocommerce' );
?>

<section class="gadget_product_area">
    <?php
    if( !empty( $settings['backgropund_shape_1']['id'] ) ){
        echo wp_get_attachment_image( $settings['backgropund_shape_1']['id'], 'full', '', array('class'=>'left_img') );
    }
    if( !empty( $settings['backgropund_shape_2']['id'] ) ){
        echo wp_get_attachment_image( $settings['backgropund_shape_2']['id'], 'full', '', array('class'=>'right_img') );
    }  ?>
    <div class="container">
        <div class="row">
            <?php
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

            $column = !empty( $settings['product_col'] ) ? $settings['product_col'] : '4';
            while( $query->have_posts()) : $query->the_post();
            global $product;
                $sku = $product->get_sku() ? $product->get_sku() : esc_html__( 'N/A', 'saasland-core' ); ?>
                <div class="col-lg-<?php echo esc_attr( $column ) ?> col-sm-6 wow fadeInUp">
                    <div class="gadget_pr_item">
                        <div class="pr_img">
                            <?php
                            if ( $product->is_on_sale() ) {
                                echo ' <div class="badge sale">'. esc_html__( 'Sale', 'saasland-core' ) .'</div>';
                            } ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('saasland_370x440');?>
                            </a>
                            <div class="hover_content">
                                <a href="<?php echo $product->add_to_cart_url() ?>" value="<?php echo esc_attr( $product->get_id() ); ?>" class="cart_btn_gadget ajax_add_to_cart add_to_cart_button" data-product_id="<?php echo get_the_ID(); ?>" data-product_sku="<?php echo esc_attr($sku) ?>" aria-label="Add “<?php the_title_attribute() ?>” to your cart"><img src="<?php echo esc_url( plugins_url() ) ?>/saasland-core/widgets/images/cart_icon.png" alt="<?php echo esc_attr( 'home gadget product', 'saasland-core' )?>"></a>
                                <?php echo shortcode_exists('ti_wishlists_addtowishlist') ? do_shortcode('[ti_wishlists_addtowishlist]') : '';?>
                            </div>
                        </div>
                        <div class="single_pr_details">
                            <a href="<?php the_permalink();?>">
                                <h3><?php the_title() ?></h3>
                            </a>
                            <div class="price">
                                <?php woocommerce_template_loop_price(); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            endwhile;
            wp_reset_postdata();
            ?>
        </div>
    </div>
</section>