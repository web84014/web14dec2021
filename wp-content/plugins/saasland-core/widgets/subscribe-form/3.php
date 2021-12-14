<section class="prototype_banner_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 d-flex align-items-center">
                <div class="prototype_content">

                    <?php if (!empty($settings['title'])) : ?>
                    <<?php echo esc_html($title_tag) ?> class="f_size_40 f_700 t_color3 l_height50 pr_70 mb_20 wow fadeInLeft saas_subscribe_color" data-wow-delay="0.3s">
                    <?php echo wp_kses_post($settings['title']) ?>
                </<?php echo esc_html($title_tag) ?>>
                <?php endif; ?>

                <?php if (!empty($settings['subtitle'])) : ?>
                    <p class="f_300 l_height28 mb_40 wow fadeInLeft" data-wow-delay="0.5s"> <?php echo wp_kses_post($settings['subtitle']) ?> </p>
                <?php endif; ?>

                <form  class="mailchimp banner_subscribe" method="post">
                    <div class="input-group subcribes wow fadeInLeft" data-wow-delay="0.6s">
                        <input type="text" name="EMAIL" class="form-control memail" placeholder="<?php echo esc_attr( $settings['email_placeholder'] ) ?>">
                        <button class="btn btn_three btn_hover f_size_15 f_500 wow fadeInLeft" data-wow-delay="0.8s" type="submit">
                            <?php echo esc_html($settings['btn_label']) ?>
                        </button>
                    </div>
                    <p class="mchimp-errmessage" style="display: none;"></p>
                    <p class="mchimp-sucmessage" style="display: none;"></p>
                </form>
            </div>
        </div>
        <?php if (!empty($settings['featured_img']['id'])) : ?>
            <div class="col-lg-7">
                <?php echo wp_get_attachment_image($settings['featured_img']['id'], 'full', '', array( 'class' => 'protype_img wow fadeInRight', 'data-wow-delay' => '0.4s')) ?>
            </div>
        <?php endif; ?>
    </div>
    </div>
</section>