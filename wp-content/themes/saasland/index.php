<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package saasland
 */

get_header();
$opt = get_option( 'saasland_opt' );
$blog_column = is_active_sidebar( 'sidebar_widgets' ) ? '8' : '12';
$blog_layout = !empty($opt['blog_layout']) ? $opt['blog_layout'] : 'list';
?>
    <section class="blog_area blog_area_two sec_pad">
        <div class="container">
            <div class="row">
                <div class="col-lg-<?php echo esc_attr($blog_column) ?> blog_grid_info">
                    <?php
                    if ( $blog_layout == 'list' ) {
                        while ( have_posts() ) : the_post();
                            get_template_part( 'template-parts/contents/content', get_post_format());
                        endwhile;
                    }
                    elseif ( $blog_layout == 'grid' ) { ?>
                        <div class="row"> <?php
                            while ( have_posts() ) : the_post();
                                get_template_part( 'template-parts/contents/content-grid', get_post_format());
                            endwhile;
                            ?>
                        </div> <?php
                    }
                    elseif ( $blog_layout == 'masonry' ) {
                        wp_enqueue_script( 'imagesloaded' );
                        wp_enqueue_script( 'isotope' );
                        ?>
                        <div class="row blog_grid_info" id="blog_masonry">
                            <?php
                            while ( have_posts() ) : the_post();
                                get_template_part( 'template-parts/contents/content-grid-masonry' );
                            endwhile;
                            ?>
                        </div>
                        <?php
                    }
                    saasland_pagination();
                    ?>
                </div>
                <?php get_sidebar() ?>
            </div>
        </div>
    </section>

<?php
get_footer();