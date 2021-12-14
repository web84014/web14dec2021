<?php
$title_sec = get_sub_field( 'title_section' );
$informations = get_sub_field( 'informations' );
$floating_img = get_sub_field( 'floating_images' );
$shortcode = get_sub_field( 'shortcode' );
$bg_img = get_sub_field( 'background_image' );
?>
<div class="scroll-wrap">
    <div class="round_line three"></div>
    <div class="round_line four"></div>
    <?php if ( $floating_img['image_one']['url'] ) : ?>
        <img class="p_absoulte pp_triangle t_left" src="<?php echo esc_url($floating_img['image_one']['url']); ?>" alt="<?php echo esc_attr($title_sec['title']) ?>">
    <?php endif; ?>
    <?php if ( $floating_img['image_two']['url'] ) : ?>
    <img class="p_absoulte pp_block" src="<?php echo esc_url($floating_img['image_two']['url']); ?>" alt="<?php echo esc_attr($title_sec['title']) ?>">
    <?php endif; ?>
    <div class="p-section-bg">
        <?php
        if ( !empty( $bg_img['url'] ) ) :
            ?>
            <style>
                .pagepiling .section-5 .p-section-bg {
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
                <div class="hosting_title pp_sec_title">
                    <?php if ( !empty( $title_sec['upper_title'] ) ) : ?>
                        <h3><?php echo esc_html( $title_sec['upper_title'] ) ?></h3>
                    <?php endif; ?>
                    <?php if ( !empty( $title_sec['title'] ) ) : ?>
                        <h2> <?php echo esc_html( $title_sec['title'] ) ?> </h2>
                    <?php endif; ?>
                </div>
                <div class="row">
                    <div class="col-lg-5">
                        <div class="pp_contact_info">
                            <?php
                            if ( !empty( $informations ) ) {
                                foreach ( $informations as  $information ) {
                                    ?>
                                    <div class="media pp_contact_item">
                                        <?php if (!empty( $information['icon'] ) ) : ?>
                                            <div class="icon">
                                                <i class="<?php echo esc_attr( $information['icon'] ) ?>"></i>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ( $information['info'] ) : ?>
                                            <div class="mmedia-body">
                                                <?php echo wp_kses_post( $information['info'] ) ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <?php if ( !empty($shortcode) ) : ?>
                        <div class="col-lg-7">
                            <?php echo do_shortcode($shortcode) ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>