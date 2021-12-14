<div class="row portfolio_gallery <?php echo ($settings['is_full_width'] == 'yes' ) ? 'ml-0 mr-0' : 'mb_30'; ?>" id="work-portfolio">
    <?php
    while ( $portfolios->have_posts() ) : $portfolios->the_post();
        $cats = get_the_terms( get_the_ID(), 'portfolio_cat' );
        $custom_url = function_exists('get_field') ? get_field('custom_url') : '';
        $the_permalink = !empty($custom_url) ? $custom_url : get_the_permalink(get_the_ID());
        $cat_slug = '';
        if (is_array($cats)) {
            foreach ( $cats as $cat ) {
                $cat_slug .= ' item_filter_id_'. esc_attr( $cat->term_id );
            }
        }
        $column = !empty($settings['column']) ? $settings['column'] : '6';
        if ( $settings['is_full_width'] == 'yes' ) {
            switch ($column) {
                case '6':
                    $image_size = 'saasland_960x500';
                    $title_size = '20';
                    break;
                case '4':
                    $image_size = 'saasland_640x450';
                    $title_size = '16';
                    break;
                case '3':
                    $image_size = 'saasland_480x450';
                    $title_size = '16';
                    break;
            }
        } else {
            switch ($column) {
                case '6':
                    $image_size = 'saasland_570x400';
                    $title_size = '20';
                    break;
                case '4':
                    $image_size = 'saasland_370x400';
                    $title_size = '16';
                    break;
                case '3':
                    $image_size = 'saasland_270x350';
                    $title_size = '16';
                    break;
            }
        }
        ?>
        <div class="col-sm-<?php echo esc_attr($column.' ' ); echo esc_attr($cat_slug); echo ($settings['is_full_width'] == 'yes' ) ? ' p0' : ' mb-30'; ?> portfolio_item">
            <div class="portfolio_img" onclick="window.location='<?php echo esc_url($the_permalink) ?>';">
                <?php the_post_thumbnail($image_size) ?>
                <div class="hover_content <?php echo ($column == '6' ) ? '' : 'h_content_two'; ?>">
                    <div class="portfolio-description leaf">
                        <a href="<?php echo esc_url($the_permalink) ?>" class="portfolio-title">
                            <h3 class="f_500 f_size_<?php echo esc_attr($title_size) ?> f_p">
                                <?php the_title() ?>
                            </h3>
                        </a>
                        <?php if ( $settings['is_cat'] == 'yes' ) : ?>
                            <div class="links">
                                <?php
                                if ( $cats ) {
                                    $cat_i = 0;
                                    $cat_count = count($cats);
                                    foreach ($cats as $cat) {
                                        $separator = '';
                                        if ( ++$cat_i != $cat_count ) {
                                            $separator .= ', ';
                                        }
                                        echo "<a href='".get_term_link($cat->term_id)."'> $cat->name $separator </a>";
                                    }
                                }
                                ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php if ( $settings['is_plus_icon'] == 'yes' ) : ?>
                <a href="<?php the_post_thumbnail_url() ?>" class="img_popup leaf"><i class="ti-plus"></i></a>
            <?php endif; ?>
        </div>
        <?php
    endwhile;
    wp_reset_postdata();
    ?>
</div>