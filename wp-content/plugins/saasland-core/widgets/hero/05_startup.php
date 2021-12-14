<section class="agency_banner_area_two">
    <div class="dot_shap one"></div>
    <div class="dot_shap two"></div>
    <div class="dot_shap three"></div>
    <div class="container">
        <div class="row">
            <?php
            if ( $settings['fimage3']['url']) : ?>
                <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.4s">
                    <img class="agency_banner_img" src="<?php echo esc_url($settings['fimage3']['url']) ?>" alt="<?php echo esc_attr($settings['title']) ?>">
                </div>
            <?php endif; ?>
            <div class="col-lg-5 offset-lg-1 d-flex align-items-center">
                <div class="agency_content_two">
                    <?php if (!empty($settings['title'])) : ?>
                        <<?php echo $title_tag; ?> class="typewrite_title f_700 f_size_40 l_height50 w_color mb_20 wow fadeInRight" data-wow-delay="0.3s">
                            <?php echo saasland_hero_title($settings['title']); ?>
                        </<?php echo $title_tag; ?>>
                    <?php endif; ?>
                    <?php
                    if (!empty($settings['subtitle'])) : ?>
                        <p class="f_300 w_color l_height28 wow fadeInRight" data-wow-delay="0.4s">
                            <?php echo wp_kses_post(nl2br($settings['subtitle'])) ?>
                        </p>
                    <?php endif; ?>
                    <div class="action_btn d-flex align-items-center mt_40 wow fadeInRight" data-wow-delay="0.6s">
                        <?php
                        foreach ($buttons as $button) {
                            echo "<a href='{$button['btn_url']['url']}' class='btn_hover agency_banner_btn elementor-repeater-item-{$button['_id']}'> {$button['btn_title']} </a>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php saasland_typed_words_js( $settings['title'] ); ?>