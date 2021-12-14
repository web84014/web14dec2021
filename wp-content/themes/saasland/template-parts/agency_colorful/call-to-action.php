<?php
$title = get_sub_field( 'title' );
$featured_img = get_sub_field( 'featured_images' );
$floating_img = get_sub_field( 'floating_images' );
$bg_img = get_sub_field( 'background_image' );
$button = get_sub_field( 'button' );

// Background properties
$background_image = get_sub_field( 'background_image' );
$background_image = !empty($bg_img['url']) ? "style=background-image:url({$bg_img['url']});" : '';
/*$background = get_sub_field('background');
$background_image = !empty($background['background_image']) ? "style=background-image:url({$background['background_image']});" : '';
$overlay_color = "style='background-image: -webkit-linear-gradient( -120deg, {$background['overlay_color_01']} 0%, {$background['overlay_color_02']} 100%); opacity: .9;'";*/
?>

<div class="scroll-wrap">
    <div class="round_line one"></div>
    <div class="round_line two"></div>
    <div class="round_line three"></div>
    <div class="round_line four"></div>
    <?php
    if ( $floating_img['image_one']['id'] ) {
        echo wp_get_attachment_image( $floating_img['image_one']['id'], 'full', '', array('class' => 'p_absoulte pp_triangle') );
    }
    if ( $floating_img['image_two']['id'] ) {
        echo wp_get_attachment_image( $floating_img['image_two']['id'], 'full', '', array('class' => 'p_absoulte pp_snak') );
    }
    if ( $floating_img['image_three']['id'] ) {
        echo wp_get_attachment_image( $floating_img['image_three']['id'], 'full', '', array('class' => 'p_absoulte pp_block') );
    }
    ?>
    <div class="p-section-bg" <?php echo wp_kses_post($background_image); ?>></div>
    <div class="scrollable-content">
        <div class="vertical-centred">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <div class="section_one_img">
                            <div class="round"></div>
                            <?php
                            if ( $featured_img['featured_image']['id'] ) {
                                echo wp_get_attachment_image( $featured_img['featured_image']['id'], 'full' );
                            }
                            if ( $featured_img['featured_image_two']['id'] ) {
                                echo wp_get_attachment_image( $featured_img['featured_image_two']['id'], 'full', '', array( 'class' => 'dots' ) );
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="section_one-content">
                            <?php if ( !empty( $title ) ) : ?>
                                <h2><?php echo wp_kses_post(nl2br($title)) ?></h2>
                            <?php endif; ?>
                            <?php if (!empty( $button['button_label'] ) ) : ?>
                                <a href="<?php echo esc_url($button['button_url']['url']) ?>" class="btn_scroll btn_hover">
                                    <?php echo esc_html( $button['button_label'] ); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>