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
query_posts(array(
    'post_type' => 'case_study',
    'showposts' => -1
));
?>

<section class="case_study_area sec_pad">
    <div class="container">
        <div class="row">
            <?php
            while ( have_posts() ) : the_post();
                ?>
                <div class="col-lg-4 col-sm-6">
                    <div class="case_study_item">
                        <?php the_post_thumbnail( 'saasland_370x350' ) ?>
                        <div class="text">
                            <p class="date"><?php echo get_the_date() ?></p>
                            <a href="<?php the_permalink() ?>">
                                <h3><?php the_title() ?></h3>
                            </a>
                            <?php echo wp_trim_words( get_the_excerpt(), 5, '...' ); ?>
                        </div>
                    </div>
                </div>
                <?php
            endwhile;
            wp_reset_postdata();
            ?>
        </div>
    </div>
</section>

<?php
get_footer();