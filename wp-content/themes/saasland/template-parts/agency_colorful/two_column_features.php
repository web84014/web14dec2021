<?php
$title_sec = get_sub_field( 'title_section' );
$features = get_sub_field( 'features_list' );
$floating_img = get_sub_field( 'floating_images' );
$featured_images = get_sub_field( 'featured_images_sec' );
$bg_img = get_sub_field( 'background_image' );
?>

<div class="scroll-wrap">
    <div class="round_line three"></div>
    <div class="round_line four"></div>
    <?php
    if ( $floating_img['image_one']['id'] ) {
        echo wp_get_attachment_image( $floating_img['image_one']['url'], 'full', '', array( 'class', 'p_absoulte pp_triangle t_left' ) );
    }
    if ( $floating_img['image_two']['id'] ) {
        echo wp_get_attachment_image( $floating_img['image_two']['url'], 'full', '', array( 'class', 'p_absoulte pp_block' ) );
    }
    ?>
    <div class="p-section-bg">
        <?php
        if ( !empty( $bg_img['url'] ) ) :
            ?>
            <style>
                .pagepiling .section-3 .p-section-bg {
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
                <div class="row flex-row-reverse">
                    <div class="col-lg-4">
                        <div class="section_one_img">
                            <div class="round p_absoulte"></div>
                            <?php
                            if ( $featured_images['featured_image_one']['id'] ) {
                                echo wp_get_attachment_image( $featured_images['featured_image_one']['id'], 'full' );
                            }
                            if ( $featured_images['featured_image_two']['id'] ) {
                                echo wp_get_attachment_image( $featured_images['featured_image_two']['id'], 'full', '', array( 'class' => 'p_absoulte dots') );
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="pp_features_info">
                            <div class="hosting_title pp_sec_title">
                                <?php if ( !empty( $title_sec['upper_title'] ) ) : ?>
                                    <h3><?php echo esc_html( $title_sec['upper_title'] ) ?></h3>
                                <?php endif; ?>
                                <?php if ( !empty( $title_sec['title'] ) ) : ?>
                                    <h2><?php echo esc_html( $title_sec['title'] ) ?></h2>
                                <?php endif; ?>
                            </div>
                            <div class="row">
                                <?php
                                if ( !empty( $features ) ) {
                                    foreach ( $features as  $feature ) {
                                        ?>
                                        <div class="col-sm-6">
                                            <div class="pp_features_item">
                                                <?php if ( !empty( $feature['icon_image']['id'] ) ) : ?>
                                                    <div class="icon">
                                                        <?php echo wp_get_attachment_image( $feature['icon_image']['id'], 'full' ); ?>
                                                    </div>
                                                <?php endif; ?>
                                                <?php
                                                 echo !empty( $feature['title'] ) ? '<h4>' . esc_html($feature['title']) . '</h4>' : '';
                                                 echo !empty( $feature['subtitle'] ) ? wpautop($feature['subtitle']) : '';
                                                 ?>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>