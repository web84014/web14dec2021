<?php
$title_sec = get_sub_field( 'title_section' );
$featured_img = get_sub_field( 'testimonials_featured_images' );
$floating_img = get_sub_field( 'floating_images' );
$testimonials = get_sub_field( 'testimonials_list' );
$bg_img = get_sub_field( 'background_image' );
?>

<div class="scroll-wrap">
    <div class="round_line three"></div>
    <div class="round_line four"></div>
    <?php
    if ( $floating_img['image_one']['id'] ) {
        echo wp_get_attachment_image( $floating_img['image_one']['id'], 'full', '', array( 'class' => 'p_absoulte pp_triangle') );
    }
    if ( $floating_img['image_two']['id'] ) {
        echo wp_get_attachment_image( $floating_img['image_two']['id'], 'full', '', array( 'class' => 'p_absoulte pp_block') );
    }
    ?>
    <div class="p-section-bg">
        <?php
        if ( !empty( $bg_img['url'] ) ) :
            ?>
            <style>
                .pagepiling .section-4 .p-section-bg {
                    background-image:url(<?php echo esc_url($bg_img['url']) ?>);
                    background-size: cover;
                    background-position: center;
                }
            </style>
            <?php
        endif;
        ?>
    </div>
    <div class="scrollable-content">
        <div class="vertical-centred">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <div class="section_one_img">
                            <div class="round p_absoulte"></div>
                            <?php
                            if ( $featured_img['featured_image']['id'] ) {
                                echo wp_get_attachment_image( $featured_img['featured_image']['id'], 'full' );
                            }
                            if ( $featured_img['another_featured_image']['id'] ) {
                                echo wp_get_attachment_image( $featured_img['another_featured_image']['id'], 'full', '', array( 'class' => 'p_absoulte phon_img' ) );
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-5 offset-lg-1 col-sm-12">
                        <div class="pp_testimonial_info">
                            <div class="hosting_title pp_sec_title">
                                <?php if ( !empty( $title_sec['upper_title'] ) ) : ?>
                                    <h3><?php echo esc_html( $title_sec['upper_title'] ) ?></h3>
                                <?php endif; ?>
                                <?php if ( !empty( $title_sec['title'] ) ) : ?>
                                    <h2><?php echo esc_html( $title_sec['title'] ) ?></h2>
                                <?php endif; ?>
                            </div>
                            <div class="pp_testimonial_slider">
                                <?php
                                if ( !empty( $testimonials ) ) {
                                    foreach ( $testimonials as  $testimonial ) {
                                        ?>
                                        <div class="item">
                                            <div class="media">
                                                <div class="img">
                                                    <?php echo wp_get_attachment_image( $testimonial['author_image']['id'], 'full' ); ?>
                                                </div>
                                                <div class="media-body">
                                                    <?php echo !empty( $testimonial['contents'] ) ? '<h4>' . esc_html($testimonial['contents']) . '</h4>' : ''; ?>
                                                    <div class="author_ratting">
                                                        <?php echo !empty( $testimonial['author_name'] ) ? '<h5>' . esc_html($testimonial['author_name']) . '</h5>' : ''; ?>
                                                        <div class="rating">
                                                            <?php
                                                            switch ( $testimonial['star_ratting'] ) {
                                                            case '1': ?>
                                                                <i class="icon_star"></i>
                                                                <i class="icon_star_alt"></i>
                                                                <i class="icon_star_alt"></i>
                                                                <i class="icon_star_alt"></i>
                                                                <i class="icon_star_alt"></i>
                                                            <?php break;
                                                            case '1.5': ?>
                                                                <i class="icon_star"></i>
                                                                <i class="icon_star-half_alt"></i>
                                                                <i class="icon_star_alt"></i>
                                                                <i class="icon_star_alt"></i>
                                                                <i class="icon_star_alt"></i>
                                                            <?php break;
                                                            case '2': ?>
                                                                <i class="icon_star"></i>
                                                                <i class="icon_star"></i>
                                                                <i class="icon_star_alt"></i>
                                                                <i class="icon_star_alt"></i>
                                                                <i class="icon_star_alt"></i>
                                                            <?php break;
                                                            case '2.5': ?>
                                                                <i class="icon_star"></i>
                                                                <i class="icon_star"></i>
                                                                <i class="icon_star-half_alt"></i>
                                                                <i class="icon_star_alt"></i>
                                                                <i class="icon_star_alt"></i>
                                                            <?php break;
                                                            case '3': ?>
                                                                <i class="icon_star"></i>
                                                                <i class="icon_star"></i>
                                                                <i class="icon_star"></i>
                                                                <i class="icon_star_alt"></i>
                                                                <i class="icon_star_alt"></i>
                                                            <?php break;
                                                            case '3.5': ?>
                                                                <i class="icon_star"></i>
                                                                <i class="icon_star"></i>
                                                                <i class="icon_star"></i>
                                                                <i class="icon_star-half_alt"></i>
                                                                <i class="icon_star_alt"></i>
                                                            <?php break;
                                                            case '4': ?>
                                                                <i class="icon_star"></i>
                                                                <i class="icon_star"></i>
                                                                <i class="icon_star"></i>
                                                                <i class="icon_star"></i>
                                                                <i class="icon_star_alt"></i>
                                                            <?php break;
                                                            case '4.5': ?>
                                                                <i class="icon_star"></i>
                                                                <i class="icon_star"></i>
                                                                <i class="icon_star"></i>
                                                                <i class="icon_star"></i>
                                                                <i class="icon_star-half_alt"></i>
                                                            <?php break;
                                                            case '5': ?>
                                                                <i class="icon_star"></i>
                                                                <i class="icon_star"></i>
                                                                <i class="icon_star"></i>
                                                                <i class="icon_star"></i>
                                                                <i class="icon_star"></i>
                                                            <?php break;
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                            <div class="slider_nav">
                                <i class="arrow_left prev"></i>
                                <i class="arrow_right next"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>