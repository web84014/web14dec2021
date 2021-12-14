<section class="payment_banner_area">
    <div class="shape one"></div>
    <div class="shape two"></div>
    <div class="container">
        <div class="payment_banner_content wow fadeInLeft" data-wow-delay="0.4s">
            <?php if (!empty($settings['title'])) : ?>
                <<?php echo $title_tag; ?> class="typewrite_title f_p f_700 f_size_50 w_color">
                    <?php echo saasland_hero_title($settings['title']); ?>
            </<?php echo $title_tag; ?>>
        <?php endif; ?>

        <?php if (!empty($settings['subtitle'])) : ?>
            <p class="w_color f_p f_size_18">
                <?php echo wp_kses_post(nl2br($settings['subtitle'])) ?>
            </p>
        <?php endif; ?>
        <div class="action_btn d-flex align-items-center mt_60">
            <?php
            $i = 0;
            foreach ($buttons as $button) {
                ++$i;
                $strip_class = ($i % 2 == 1) ? 'btn_hover agency_banner_btn' : 'agency_banner_btn_two';
                echo "<a " .
                    "href='{$button['btn_url']['url']}' " .
                    "class='$strip_class elementor-repeater-item-{$button['_id']}'> " .
                    "{$button['btn_title']} " .
                    "</a>";
            }
            ?>
        </div>
    </div>
    </div>
    <div class="animation_img_two wow fadeInRight" data-wow-delay="0.5s">
        <?php echo wp_get_attachment_image($settings['fimage3']['id'], 'full' ) ?>
    </div>
    <?php if ( !empty( $settings['payment_pro_shape_img']['url'] ) ) : ?>
        <img class="svg_intro_bottom" src="<?php echo esc_url( $settings['payment_pro_shape_img']['url'] ) ?>" alt="<?php echo esc_attr($settings['title']) ?>">
    <?php endif; ?>
</section>

<?php saasland_typed_words_js( $settings['title'] ); ?>