<?php
$opt = get_option( 'saasland_opt' );
?>
<div class="row">
    <div class="col-lg-6">
        <div class="portfolio_details_gallery gallery_two">
            <?php
            while (have_posts()) : the_post();
                $images = get_field( 'portfolio_images' );

                if (empty($images)) {
                    the_post_thumbnail( 'full', array( 'class' => 'img-fluid mb_20'));
                }

                if ($images) {
                    wp_enqueue_script( 'owl-carousel' );
                    wp_enqueue_style( 'saasland-owl.carousel' );
                    echo '<div class="pr_slider owl-carousel mb_50">';
                    the_post_thumbnail( 'full' );
                    foreach ($images as $image) {
                        echo wp_get_attachment_image($image['ID'], 'full' );
                    }
                    echo '</div>';
                }
                ?>
            <?php endwhile; ?>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="portfolio_details_info pr_50 pl_100">
            <?php
            while (have_posts()) : the_post();
                the_content();
            endwhile;

            // check if the repeater field has rows of data
            if (have_rows( 'portfolio_attributes')):
                echo '<div class="portfolio_category mt_60">';
                    // loop through the rows of data
                    while (have_rows( 'portfolio_attributes')) : the_row();
                        ?>
                        <div class="p_category_item mb-30">
                            <h6 class="f_p f_size_15 f_400 t_color3 mb-0 l_height28">
                                <?php echo get_sub_field('attribute_title'); ?>
                            </h6>
                            <p class="f_size_15 f_300 mb-0"> <?php echo get_sub_field('attribute_value'); ?> </p>
                        </div>
                    <?php
                endwhile;
                echo '</div>';
            endif;
            ?>

            <?php
            if ($opt['share_options'] == '1' ) {
                ?>
                <div class="p_category_item">
                    <p class="f_400 f_size_15 mb-0">
                        <?php echo !empty($opt['share_title']) ? esc_html($opt['share_title']) : esc_html__( 'Share on', 'saasland' ) ?>
                    </p>
                    <div class="social_icon">
                        <?php if ($opt['is_portfolio_googleplus'] == '1' ) : ?>
                            <a href="//facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"><i
                                        class="ti-facebook"></i></a>
                        <?php endif; ?>
                        <?php if ($opt['is_portfolio_twitter'] == '1' ) : ?>
                            <a href="//twitter.com/intent/tweet?text=<?php the_permalink(); ?>"><i
                                        class="ti-twitter-alt"></i></a>
                        <?php endif; ?>
                        <?php if ($opt['is_portfolio_googleplus'] == '1' ) : ?>
                            <a href="//plus.google.com/share?url=<?php the_permalink() ?>"><i
                                        class="ti-google"></i></a>
                        <?php endif; ?>
                        <?php if ($opt['is_portfolio_linkedin'] == '1' ) : ?>
                            <a href="//www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink() ?>"><i
                                        class="ti-linkedin"></i></a>
                        <?php endif; ?>
                        <?php if ($opt['is_portfolio_pinterest'] == '1' ) : ?>
                            <a href="//www.pinterest.com/pin/create/button/?url=<?php the_permalink() ?>"><i
                                        class="ti-pinterest"></i></a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php
            }
            ?>

            <div class="portfolio_pagination portfolio_pagination_two mt_100">
                <?php
                $prev_post = get_previous_post();
                $next_post = get_next_post();
                if ($prev_post) : ?>
                    <a href="<?php echo get_permalink($prev_post->ID) ?>" class="prev">
                        <i class="ti-arrow-left"></i>
                        <?php esc_html_e( 'Prev Project', 'saasland' ) ?>
                    </a>
                <?php endif; ?>
                <?php if ($next_post) : ?>
                    <a href="<?php echo get_permalink($next_post->ID) ?>" class="next">
                        <?php esc_html_e( 'Next Project', 'saasland' ) ?>
                        <i class="ti-arrow-right"></i></a>
                <?php endif; ?>
            </div>
        </div>
    </div>

</div>
