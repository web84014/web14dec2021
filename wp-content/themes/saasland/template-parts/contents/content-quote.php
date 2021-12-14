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
$is_post_author = isset($opt['is_post_author']) ? $opt['is_post_author'] : '1';
$is_post_date = isset($opt['is_post_date']) ? $opt['is_post_date'] : '1';
$is_post_cat = isset($opt['is_post_cat']) ? $opt['is_post_cat'] : '';
$read_more = isset($opt['read_more']) ? $opt['read_more'] : esc_html__( 'Read More', 'saasland' );

$quote_author = function_exists( 'get_field' ) ? get_field( 'quote_author_name' ) : '';
$title = function_exists( 'get_field' ) ? get_field( 'quote' ) : get_the_title();

$content = trim(get_the_content());
// Make sure content isn't empty

?>

<div <?php post_class( 'blog_list_item qutoe_post' ); ?>>
    <div class="blog_content">
        <i class="fas fa-quote-left"></i>
        <?php saasland_get_html_tag( 'blockquote', get_the_content()); ?>
    </div>
</div>