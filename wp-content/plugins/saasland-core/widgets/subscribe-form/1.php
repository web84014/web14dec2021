<section class="saas_home_area">
    <div class="banner_top">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <?php if (!empty($settings['title'])) : ?>
                        <<?php echo $title_tag; ?> class="f_p f_size_40 l_height60 saas_subscribe_color">
                            <?php echo wp_kses_post(nl2br($settings['title'])) ?>
                        </<?php echo $title_tag ?>>
                    <?php endif; ?>
                    <?php if (!empty($settings['subtitle'])) : ?>
                        <p class="f_size_18 l_height30"> <?php echo wp_kses_post(nl2br($settings['subtitle'])) ?> </p>
                    <?php endif; ?>
                    <form class="mailchimp" method="post">
                        <div class="input-group subcribes">
                            <input type="text" name="EMAIL" class="form-control memail"
                                   placeholder="<?php echo esc_attr($settings['email_placeholder']) ?>">
                            <?php if (!empty($settings['btn_label'])) : ?>
                                <button class="btn btn_submit f_size_15 f_500" type="submit">
                                    <?php echo esc_html($settings['btn_label']); ?>
                                </button>
                            <?php endif; ?>
                        </div>
                        <p class="mchimp-errmessage" style="display: none;"></p>
                        <p class="mchimp-sucmessage" style="display: none;"></p>
                    </form>
                </div>
            </div>
            <?php if (!empty($settings['featured_img']['id'])) : ?>
                <div class="saas_home_img">
                    <?php echo wp_get_attachment_image($settings['featured_img']['id'], 'full' ) ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>