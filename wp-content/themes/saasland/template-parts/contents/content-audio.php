<?php
$read_more = isset($opt['read_more']) ? $opt['read_more'] : esc_html__( 'Read More', 'saasland' );
?>
<div <?php post_class( 'blog_list_item blog_list_item_two' ); ?>>

    <div class="audio_player">
        <?php echo do_shortcode( '[audio]' ); ?>
    </div>

    <div class="blog_content">
        <a href="<?php the_permalink() ?>">
            <h5 class="blog_title"> <?php the_title() ?>  </h5>
        </a>
        <p> <?php echo strip_shortcodes(saasland_excerpt( 'blog_excerpt', false) ); ?> </p>
        <div class="post-info-bottom">
            <a href="<?php the_permalink() ?>" class="learn_btn_two">
                <?php echo esc_html($read_more) ?> <i class="ti-arrow-right"></i>
            </a>
            <a class="post-info-comments" href="<?php the_permalink() ?>#comments">
                <i class="icon_comment_alt" aria-hidden="true"></i>
                <span> <?php saasland_comment_count(get_the_ID()) ?> </span>
            </a>
        </div>
    </div>

</div>
