<section class="saas_signup_area sec_pad dk_bg_two">
    <div class="container">
        <div class="sec_title text-center mb_70 wow fadeInUp" data-wow-delay="0.3s">
            <?php if (!empty($settings['title'])) : ?>
                <<?php echo $title_tag; ?> class="f_p f_size_30 l_height50 f_600 w_color saas_subscribe_color">
                    <?php echo wp_kses_post(nl2br($settings['title'])) ?>
                </<?php echo $title_tag ?>>
            <?php endif; ?>
            <?php if (!empty($settings['subtitle'])) : ?>
                <p class="d_p_color f_300 f_size_15">
                    <?php echo wp_kses_post(nl2br($settings['subtitle'])) ?>
                </p>
            <?php endif; ?>
        </div>
        <form class="saas_signup_form mailchimp row validate" method="post">
            <div class="col-md-6 col-sm-6">
                <div class="input-group subcribes wow fadeInLeft" data-wow-delay="0.3s">
                    <input type="text" class="form-control " name="FNAME" placeholder="<?php echo esc_attr($settings['name_placeholder']) ?>" >
                    <label></label>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="input-group wow fadeInLeft" data-wow-delay="0.5s">
                    <input type="text" class="form-control memail" name="EMAIL" placeholder="<?php echo esc_attr($settings['email_placeholder']) ?>">
                    <label></label>
                </div>
            </div>
            <?php if (!empty($settings['btn_label'])) : ?>
                <div class="col-lg-12 text-center wow fadeInUp" data-wow-delay="0.8s">
                    <button class="signup_btn btn_hover saas_banner_btn mt_60" type="submit">
                        <?php echo esc_html($settings['btn_label']); ?>
                    </button>
                </div>
            <?php endif; ?>
            <p class="mchimp-errmessage" style="display: none;"></p>
            <p class="mchimp-sucmessage" style="display: none;"></p>
        </form>
    </div>
</section>