<?php
$contents = get_sub_field( 'contents' );
$galleries = get_sub_field( 'featured_image_gallery' );
$floating_img = get_sub_field( 'floating_images' );
$bg_img = get_sub_field( 'background_image' );
$button = get_sub_field( 'button' );
?>

<div class="scroll-wrap">
    <div class="round_line three"></div>
    <div class="round_line four"></div>
    <?php
    if ( $floating_img['image_one']['id'] ){
        echo wp_get_attachment_image( $floating_img['image_one']['id'], 'full', '', array( 'class' => 'p_absoulte pp_triangle t_left' ) );
    }
    if ( $floating_img['image_two']['id'] ){
        echo wp_get_attachment_image( $floating_img['image_two']['id'], 'full', '', array( 'class' => 'p_absoulte pp_block' ) );
    }
    ?>
    <div class="p-section-bg">
        <?php
        if ( !empty( $bg_img['url'] ) ) :
            ?>
            <style>
                .pagepiling .section-2 .p-section-bg {
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
                    <div class="col-lg-5">
                        <div class="pp_work_content">
                            <div class="hosting_title pp_sec_title">
                                <?php if ( $contents['upper_title'] ) : ?>
                                    <h3><?php echo esc_html($contents['upper_title']) ?></h3>
                                <?php endif; ?>
                                <?php if ( $contents['title'] ) : ?>
                                    <h2><?php echo esc_html($contents['title']) ?></h2>
                                <?php endif; ?>
                            </div>
                            <?php echo !empty( $contents['subtitle']) ? wpautop ($contents['subtitle'] ) : ''; ?>
                            <?php if ( $button['button_label'] ) : ?>
                                <a href="<?php echo esc_url($button['button_url']['url']) ?>" class="btn_scroll btn_hover">
                                    <?php echo esc_html( $button['button_label'] ); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="pp_mackbook_img">
                            <div class="round"></div>
                            <?php
                            if ( !empty( $galleries ) ) {
                                foreach ( $galleries as $index => $gallery ) {
                                    switch ($index) {
                                        case 0:
                                            $align_class = 'one';
                                            break;
                                        case 1:
                                            $align_class = 'two';
                                            break;
                                        case 2:
                                            $align_class = 'three';
                                            break;
                                        case 3:
                                            $align_class = 'four';
                                            break;
                                        default:
                                            $align_class = 'one';
                                            break;
                                    }
                                    ?>
                                    <img class="p_absoulte <?php echo esc_attr($align_class) ?>" src="<?php echo esc_url($gallery['url']); ?>" alt="<?php echo esc_attr($contents['title']) ?>">
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