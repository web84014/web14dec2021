<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package saasland
 */

get_header();
?>

    <section class="blog_area blog_area_two sec_pad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <?php
                    if ( have_posts() ) {
                        while (have_posts()) : the_post();
                            get_template_part( 'template-parts/contents/content', get_post_format());
                        endwhile;
                    }
                    else {
                        get_template_part( 'template-parts/contents/content', 'none' );
                    }
                    ?>
                    <?php saasland_pagination(); ?>
                </div>
                <?php get_sidebar() ?>
            </div>
        </div>
    </section>

<?php
get_footer();