<?php
/**
 *  Template Name: Portfolio
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package filix
 */

get_header();
?>

<section class="case_study_details_area">
    <div class="container">
        <div class="study_details">
            <div class="row">
                <div class="col-lg-8">
                    <div class="details_img">
                        <?php the_post_thumbnail( 'full' ); ?>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="details_info">
                        <?php
                        $cs_title = function_exists( 'get_field' ) ? get_field( 'cs_title' ) : '';
                        if ( !empty($cs_title) ) : ?>
                            <h2> <?php echo wp_kses_post($cs_title) ?> </h2>
                        <?php endif; ?>
                        <?php
                        if ( have_rows( 'cs_attributes' ) ):
                            ?>
                            <ul class="list-unstyled">
                                <?php while ( have_rows( 'cs_attributes' ) ) : the_row(); ?>
                                    <li><span> <?php the_sub_field( 'cs_attr_key' ) ?> </span> <?php the_sub_field( 'cs_attr_value' ) ?> </li>
                                <?php endwhile; ?>
                            </ul>
                        <?php endif; ?>
                        <?php
                        $cs_button = function_exists( 'get_field' ) ? get_field( 'cs_button' ) : '';
                        $cs_title = function_exists( 'get_field' ) ? get_field( 'cs_title' ) : '';
                        ?>
                        <div class="btn_info d-flex">
                            <?php if ( $cs_button ) :
                                $link_target = $cs_button['target'] ? $cs_button['target'] : '_self';
                                ?>
                                <a href="<?php echo esc_url($cs_button['url']) ?>" target="<?php echo esc_attr($link_target) ?>" class="btn_hover agency_banner_btn">
                                    <?php echo esc_html($cs_button['title']) ?>
                                </a>
                            <?php endif; ?>
                            <?php echo saasland_post_love_display() ?>
                            <!--<a href="" class="tag"><i class="ti-heart"></i></a>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php
while (have_posts()) : the_post();
    the_content();
endwhile;
?>


<?php
get_footer();