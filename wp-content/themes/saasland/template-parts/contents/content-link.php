<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package saasland
 */

$allowed_html = array(
    'a' => array(
        'href' => array(),
        'title' => array()
    ),
    'br' => array(),
    'em' => array(),
    'strong' => array(),
    'iframe' => array(
        'src' => array(),
    )
);
$opt = get_option( 'saasland_opt' );
$blog_excerpt = !empty($opt['blog_excerpt']) ? $opt['blog_excerpt'] : 40;
$is_post_meta = isset($opt['is_post_meta']) ? $opt['is_post_meta'] : '1';
$is_post_author = isset($opt['is_post_author']) ? $opt['is_post_author'] : '1';
$is_post_date = isset($opt['is_post_date']) ? $opt['is_post_date'] : '1';
$is_post_cat = isset($opt['is_post_cat']) ? $opt['is_post_cat'] : '';
$read_more = isset($opt['read_more']) ? $opt['read_more'] : esc_html__( 'Read More', 'saasland' );
?>

<div <?php post_class( 'blog_list_item qutoe_post qutoe_post_two' ); ?>>
    <div class="blog_content">
            <i class=" icon_link"></i>
            <a href="<?php the_permalink() ?>"><h5 class="blog_title"> <?php the_title() ?> </h5></a>
    </div>
</div>
