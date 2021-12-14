<section class="c2a_six saas_subscribe_area">
    <div class="container">
        <div class="row saas_action_content wow fadeInUp" data-wow-delay="0.2s">
            <div class="col-lg-8">
                <?php if (!empty($settings['title'])) : ?>
                    <h4 class="f_p f_size_30 l_height50 f_400 t_color mb-0">
                        <?php echo wp_kses_post(nl2br($settings['title'])) ?>
                    </h4>
                <?php endif; ?>
            </div>
            <?php if (!empty($settings['btn_label'])) : ?>
                <div class="col-lg-4 d-flex justify-content-end">
                    <a href="<?php echo esc_url($settings['btn_url']['url']); ?>" class="gr_btn" <?php saasland_is_external($settings['btn_url']) ?>>
                        <span class="text"> <?php echo esc_html($settings['btn_label']); ?> </span>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>