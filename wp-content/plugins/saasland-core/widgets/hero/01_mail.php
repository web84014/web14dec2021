<section class="slider_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 d-flex align-items-center">
                <div class="slider_content">
                    <?php if (!empty($settings['title'])) : ?>
                        <<?php echo $title_tag; ?> class="typewrite_title f_p f_700 f_size_40 l_height60"> <?php echo saasland_hero_title($settings['title']); ?> </<?php echo $title_tag;  ?>>
                    <?php endif; ?>
                    <?php if (!empty($settings['subtitle'])) : ?>
                        <p class="f_300 l_height28 mt_30"> <?php echo wp_kses_post(wpautop($settings['subtitle'])); ?> </p>
                    <?php endif; ?>
                    <?php
                    foreach ($buttons as $button) {
                        echo "<a href='{$button['btn_url']['url']}' class='slider_btn btn_hover mt_30 elementor-repeater-item-{$button['_id']}'> {$button['btn_title']} </a>";
                    }
                    ?>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="mobile_img">
                    <?php if (!empty($settings['fimage1']['url'])) : ?>
                        <div class="img">
                            <img class="women_img leaf wow fadeInDown" data-wow-delay="0.4s" src="<?php echo esc_url($settings['fimage1']['url']) ?>" alt="<?php echo esc_attr($settings['title']); ?>">
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($settings['fimage2']['url'])) : ?>
                        <img class="mobile wow fadeInRight" data-wow-delay="0.1s" src="<?php echo esc_url($settings['fimage2']['url']) ?>" alt="<?php echo esc_attr($settings['subtitle']); ?>">
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <?php if ( !empty( $settings['mail_shape_img4']['url'] ) ) : ?>
        <img class="leaf l_left" src="<?php echo esc_url( $settings['mail_shape_img1']['url'] ) ?>" alt="<?php echo esc_attr($settings['title']) ?>">
    <?php endif; ?>
    <?php if ( !empty( $settings['mail_shape_img2']['url'] ) ) : ?>
        <img class="leaf l_right" src="<?php echo esc_url( $settings['mail_shape_img2']['url'] ) ?>" alt="<?php echo esc_attr($settings['title']) ?>">
    <?php endif; ?>
    <?php if ( !empty( $settings['mail_shape_img3']['url'] ) ) : ?>
        <img class="middle_shape" src="<?php echo esc_url( $settings['mail_shape_img3']['url'] ) ?>" alt="<?php echo esc_attr($settings['title']) ?>">
    <?php endif; ?>
    <?php if ( !empty( $settings['mail_shape_img4']['url'] ) ) : ?>
        <img class="bottom_shoape" src="<?php echo esc_url( $settings['mail_shape_img4']['url'] ) ?>" alt="<?php echo esc_attr($settings['title']) ?>">
    <?php endif; ?>
</section>
<?php
saasland_typed_words_js( $settings['title'] );