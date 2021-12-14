<section class="support_subscribe_area sec_pad">
    <?php if ( !empty( $settings['featured_img']['url'] ) ) : ?>
        <img class="h_leaf one wow fadeInUp" data-wow-delay="0.4s" src="<?php echo esc_url( $settings['featured_img']['url'] ) ?>" alt="<?php echo esc_attr( $settings['title']) ?>">
    <?php endif; ?>
    <?php if ( !empty( $settings['right_fimg']['url'] ) ) : ?>
        <img class="h_leaf two wow fadeInUp" data-wow-delay="0.6s" src="<?php echo esc_url( $settings['right_fimg']['url'] ) ?>" alt="<?php echo esc_attr( $settings['title']) ?>">
    <?php endif; ?>
    <div class="container">
        <div class="sec_title text-center mb_50 wow fadeInUp" data-wow-delay="0.3s">
            <?php if (!empty($settings['title'])) : ?>
                <<?php echo $title_tag; ?> class="f_p f_size_30 l_height50 f_600 t_color3 saas_subscribe_color">
                    <?php echo wp_kses_post(nl2br($settings['title'])) ?>
                </<?php $title_tag ?>>
            <?php endif; ?>
            <?php if (!empty($settings['subtitle'])) : ?>
                <p class="none f_400 f_size_16 mb-0"><?php echo wp_kses_post(nl2br($settings['subtitle'])) ?></p>
            <?php endif; ?>
        </div>
        <form action="#" class="support_subscribe mailchimp" method="post" novalidate="true">
            <input type="text" name="EMAIL" class="form-control memail" placeholder="<?php echo esc_attr($settings['email_placeholder']) ?>">
            <button class="btn btn-submit saasland_subscribe_btn" type="submit"><i class="ti-arrow-right"></i></button>

        </form>
        <p class="mchimp-errmessage text-center mt-3" style="display: none;"></p>
        <p class="mchimp-sucmessage text-center mt-3" style="display: none;"></p>
    </div>
</section>
