<section class="saas_banner_area d-flex align-items-center">
    <?php if ( !empty( $settings['dark_shape_img1']['url'] ) ) : ?>
        <img class="saas_shap" src="<?php echo esc_url( $settings['dark_shape_img1']['url'] ) ?>" alt="<?php echo esc_attr($settings['title']) ?>">
    <?php endif; ?>
    <?php if ( !empty( $settings['dark_shape_img2']['url'] ) ) : ?>
        <img class="saas_shap" src="<?php echo esc_url( $settings['dark_shape_img2']['url'] ) ?>" alt="<?php echo esc_attr($settings['title']) ?>">
    <?php endif; ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="saas_banner_content text-center">
                    <?php if (!empty($settings['title'])) : ?>
                        <<?php echo $title_tag; ?> class="typewrite_title f_700 f_size_40 w_color mb-0 wow fadeInUp" data-wow-delay="0.3s">
                            <?php echo saasland_hero_title($settings['title']); ?>
                        </<?php echo $title_tag ?>>
                <?php endif; ?>
                <?php if (!empty($settings['subtitle'])) : ?>
                    <p class="w_color f_300 f_size_18 l_height30 mt_30 wow fadeInUp" data-wow-delay="0.4s">
                        <?php echo wp_kses_post(nl2br($settings['subtitle'])) ?>
                    </p>
                <?php endif; ?>
                <div class="hero-btns d-flex justify-content-center align-items-center">
                    <?php
                    foreach ($buttons as $button) {
                        echo '<div class="action_btn mt_40 wow fadeInUp" data-wow-delay="0.5s">';
                        echo "<a href='{$button['btn_url']['url']}' class='btn_hover saas_banner_btn elementor-repeater-item-{$button['_id']}'> {$button['btn_title']} </a>";
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
            <?php
            if ( $settings['fimage3']['url']) : ?>
                <div class="dasboard_img mt_60 wow fadeInUp" data-wow-delay="0.7s">
                    <img class="img-fluid" src="<?php echo esc_url($settings['fimage3']['url']) ?>" alt="<?php echo esc_attr($settings['title']) ?>">
                </div>
            <?php endif; ?>
        </div>
    </div>
    </div>
</section>

<?php saasland_typed_words_js( $settings['title'] ); ?>