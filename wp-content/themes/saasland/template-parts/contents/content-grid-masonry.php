<?php


$opt = get_option( 'saasland_opt' );
$is_post_meta = isset($opt['is_post_meta']) ? $opt['is_post_meta'] : '1';
$is_post_author = isset($opt['is_post_author']) ? $opt['is_post_author'] : '1';
$is_post_date = isset($opt['is_post_date']) ? $opt['is_post_date'] : '1';
$read_more = isset($opt['read_more']) ? $opt['read_more'] : esc_html__( 'Read More', 'saasland' );
$blog_column = !empty($opt['blog_column']) ? $opt['blog_column'] : '6';
$post_title_length = isset($opt['post_title_length']) ? $opt['post_title_length'] : '';
?>

<div <?php post_class("col-lg-$blog_column") ?>>
    <div class="blog_list_item blog_list_item_two">
        <?php
        if ( has_post_thumbnail() && $is_post_date == '1' ) : ?>
            <div class="post_date">
                <h2> <?php the_time( 'd' ) ?> <span> <?php the_time( 'M' ) ?> </span></h2>
            </div>
        <?php endif; ?>
        <a href="<?php the_permalink() ?>">
            <?php the_post_thumbnail( 'full', array( 'class' => 'img-fluid' ) ) ?>
        </a>
        <div class="blog_content">
            <a href="<?php the_permalink() ?>" title="<?php echo the_title_attribute() ?>">
                <h5 class="blog_title">
                    <?php saasland_limit_latter(get_the_title(), $post_title_length); ?>
                </h5>
            </a>
            <p> <?php echo strip_shortcodes(saasland_excerpt( 'blog_excerpt', false)); ?> </p>
            <div class="post-info-bottom">
                <a href="<?php the_permalink() ?>" class="learn_btn_two">
                    <?php echo esc_html($read_more) ?> <i class="arrow_right"></i>
                </a>
                <a class="post-info-comments" href="<?php the_permalink() ?>#comments">
                    <i class="icon_comment_alt" aria-hidden="true"></i>
                    <span> <?php saasland_comment_count(get_the_ID()) ?> </span>
                </a>
            </div>
        </div>
    </div>
</div>