<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package saasland
 */

get_header();
$opt = get_option( 'saasland_opt' );
$is_related = !empty($opt['is_related_posts']) ? $opt['is_related_posts'] : '';
$blog_column = is_active_sidebar( 'sidebar_widgets' ) ? '8' : '12';
$elementor_library = isset($_GET['elementor_library']) ? $_GET['elementor_library'] : '';
$is_single_post_date = isset ($opt['is_single_post_date']) ? $opt['is_single_post_date'] : '1';
$single_blog_comment = isset ($opt['is_single_comment_meta']) ? $opt['is_single_comment_meta'] : '1';
$is_comment_list = isset ($opt['is_single_comment_list']) ? $opt['is_single_comment_list'] : '1';
?>

<?php
if ( isset($_GET['elementor_library']) ) :
    while ( have_posts() ) : the_post();
        the_content();
        wp_link_pages( array(
            'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'saasland' ) . '</span>',
            'after'       => '</div>',
            'link_before' => '<span>',
            'link_after'  => '</span>',
            'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'saasland' ) . ' </span>%',
            'separator'   => '<span class="screen-reader-text">, </span>',
        ));
    endwhile;
else :
    ?>
    <section class="blog_area_two sec_pad">
    <div class="container">
    <div class="row">
        <div class="col-lg-<?php echo esc_attr($blog_column) ?> blog_single_info">
            <div <?php post_class( 'blog_list_item blog_list_item_two' ) ?>>
                <?php
                if ( has_post_thumbnail() ) :
                    if ( $is_single_post_date =='1' ) :
                        ?>
                       
                    <?php endif; ?>
                    <?php the_post_thumbnail( 'full', array('class' => 'img-fluid') ) ?>
                    <?php
                endif;
                ?>
                <div class="blog_content">
                    <?php
                    while ( have_posts() ) : the_post();
                        the_content();
                        wp_link_pages( array(
                            'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'saasland' ) . '</span>',
                            'after'       => '</div>',
                            'link_before' => '<span>',
                            'link_after'  => '</span>',
                            'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'saasland' ) . ' </span>%',
                            'separator'   => '<span class="screen-reader-text">, </span>',
                        ));
                    endwhile;
                    ?>
                    <div class="post-info-bottom <?php echo (!function_exists('saasland_social_share')) ? 'no_share' : ''; ?>">
                        <?php
                        if ( function_exists('saasland_social_share') ) {
                            saasland_social_share();
                        }
                        if( $single_blog_comment == '1' ){ ?> 
                            <a class="post-info-comments" href="#comments">
                                <i class="icon_comment_alt" aria-hidden="true"></i>
                                <span> <?php saasland_comment_count(get_the_ID()) ?> </span>
                            </a>
                            <?php 
                        } ?>
                    </div>
                    <?php if ( has_tag() ) : ?>
                        <div class="single_post_tags post-tags">
                            <?php the_tags(esc_html__( 'TAGS : ', 'saasland' ), ' ' ); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <?php
            $user_desc = get_the_author_meta( 'user_description' );
            if ( !empty($user_desc) ) : ?>
                <div class="media post_author_two">
                    <?php echo get_avatar(get_the_author_meta( 'ID' ), 90, '', get_the_author_meta( 'display_name' ), array( 'class' => 'img_rounded')); ?>
                    <div class="media-body">
                        <div class="comment_info">
                            <h3> <?php echo get_the_author_meta( 'display_name' ); ?> </h3>
                        </div>
                        <p> <?php echo get_the_author_meta( 'user_description' ); ?> </p>
                    </div>
                </div>
                <?php
            endif;

            if ( is_singular('post') ) :
                $cats = get_the_terms(get_the_ID(), 'category' );
                $cat_ids = wp_list_pluck($cats,'term_id' );
                $related_post_count = !empty($opt['related_posts_count']) ? $opt['related_posts_count'] : 3;
                $posts = new WP_Query( array(
                    'post_type' => 'post',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'category',
                            'field' => 'id',
                            'terms' => $cat_ids,
                            'operator'=> 'IN' //Or 'AND' or 'NOT IN'
                        )),
                    'posts_per_page' => $related_post_count,
                    'ignore_sticky_posts' => 1,
                    'orderby' => 'rand',
                    'post__not_in' => array($post->ID)
                ));

                if ( $is_related == '1' && $posts->have_posts() ) :
                    ?>
                    <div class="blog_related_post blog_grid_info">
                        <?php
                        if (!empty($opt['related_posts_title'])) : ?>
                            <h2 class="blog_titles"> <?php echo esc_html($opt['related_posts_title']) ?> </h2>
                        <?php endif; ?>
                        <div class="row">
                            <?php
                            while($posts->have_posts()) : $posts->the_post();
                                get_template_part( 'template-parts/contents/content-grid', 'related' );
                            endwhile;
                            wp_reset_postdata();
                            ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <?php
            if( $is_comment_list == '1' ){
                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;
            }
            ?>
        </div>
        <?php get_sidebar() ?>
    </div>
    </div>
    </section>

<?php endif; ?>

<?php
get_footer();