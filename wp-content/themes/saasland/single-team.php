<?php
get_header();
?>
<section class="team_details_area sec_pad">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="team_img">
                    <?php
                    if( has_post_thumbnail() ){
                        the_post_thumbnail('full', array( 'class'=>'img-fluid' ));
                    }
                    ?>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="team_details_content">
                    <h2><?php the_title(); ?></h2>
                    <?php
                    $designation    = function_exists( 'get_field' ) ? get_field('member_designation') : '';
                    $s_description  = function_exists( 'get_field' ) ? get_field('short_desc') : '';

                    if( $designation ){
                        echo '<div class="postition">'. esc_html( $designation ) .'</div>';
                    }

                    if( $s_description ){
                        echo '<p>'. saasland_kses_post( $s_description ) .'</p>';
                    }

                    if( have_rows('member_social_profile') ){ ?>
                        <h5><?php echo esc_html__( 'On Socials', 'saasland' ); ?></h5>
                        <ul class="social_icon list-unstyled">
                            <?php
                            while ( have_rows('member_social_profile') ) : the_row();
                                if( get_sub_field('social_icon') ){
                                    echo '<li><a href="'. esc_url( get_sub_field('social_url') ) .'"><i class="ti-'.esc_attr( get_sub_field('social_icon') ).'"></i></a></li>';
                                }
                            endwhile; ?>
                        </ul>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
// Team Single Content Area
while (have_posts()) : the_post();
    the_content();
endwhile;


get_footer();
