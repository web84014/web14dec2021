<?php
$opt = get_option('saasland_opt');
$thumb_size = is_active_sidebar( 'sidebar_widgets' ) ? 'saasland_240x250' : 'saasland_350x365';
$rp_title_char_limit = !empty($opt['rp_title_char_limit']) ? $opt['rp_title_char_limit'] : '';
?>
<div <?php post_class( 'col-lg-4 col-sm-4' ) ?>>
    <div class="blog_list_item blog_list_item_two">
        <?php
        if (has_post_thumbnail()) : ?>
            <div class="post_date">
                <h2> <?php the_time( 'd' ) ?> <span> <?php the_time( 'M' ) ?> </span></h2>
            </div>
        <?php endif; ?>
        <a href="<?php the_permalink() ?>">
            <?php the_post_thumbnail( $thumb_size, array( 'class' => 'img-fluid' ) ); ?>
        </a>

        <div class="blog_content">
            <a href="<?php the_permalink() ?>" title="<?php echo the_title_attribute() ?>">
                <h5 class="blog_title">
                    <?php saasland_limit_latter(get_the_title(), $rp_title_char_limit, ''); ?>
                </h5>
            </a>
        </div>

    </div>
</div>