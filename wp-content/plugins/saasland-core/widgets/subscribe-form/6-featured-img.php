<section class="saas_banner_area_two">
    <div class="section_intro">
        <div class="section_container">
            <div class="intro">
                <div class="intro_content">
                    <?php if (!empty($settings['title'])) : ?>
                        <<?php echo $title_tag; ?> class="f_700 f_size_50 w_color f_p saas_subscribe_color">
                            <?php echo wp_kses_post(nl2br($settings['title'])) ?>
                        </<?php echo $title_tag; ?>>
                    <?php endif; ?>
                    <?php if (!empty($settings['subtitle'])) : ?>
                        <p class="w_color f_size_18">
                            <?php echo wp_kses_post(nl2br($settings['subtitle'])) ?>
                        </p>
                    <?php endif; ?>
                    <form class="mailchimp" method="post">
                        <div class="input-group subcribes">
                            <input type="text" name="EMAIL" class="form-control memail" placeholder="<?php echo esc_attr($settings['email_placeholder']) ?>">
                            <?php if (!empty($settings['btn_label'])) : ?>
                                <button class="btn btn_submit f_size_15 f_500" type="submit">
                                    <?php echo esc_html($settings['btn_label']); ?>
                                </button>
                            <?php endif ?>
                        </div>
                        <p class="mchimp-errmessage" style="display: none;"></p>
                        <p class="mchimp-sucmessage" style="display: none;"></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <img class="shap_img" src="<?php echo SC_IMAGES.'home10/shape.png' ?>" alt="<?php echo esc_attr($settings['title']) ?>">
    <?php if (!empty($settings['featured_img']['id'])) : ?>
        <div class="animation_img wow fadeInUp" data-wow-delay="0.3s">
            <?php echo wp_get_attachment_image($settings['featured_img']['id'], 'full' ) ?>
        </div>
    <?php endif; ?>
</section>