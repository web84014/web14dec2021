<section class="payment_action_area">
    <div class="clients_bg_shape_bottom"></div>
    <div class="container">
        <div class="payment_action_content text-center wow fadeInUp" data-wow-delay="0.2s">
            <div class="pay_icon">
                <div class="icon_shape"></div>
                <img class="icon_img" src="<?php echo esc_url($settings['icon']['url']) ?>" alt="<?php echo esc_attr($settings['title']); ?>">
            </div>
            <?php if (!empty($settings['title'])) : ?>
                <<?php echo $title_tag; ?> class="f_p t_color f_700">
                    <?php echo wp_kses_post(nl2br($settings['title'])) ?>
                </<?php echo $title_tag; ?>>
            <?php endif; ?>
            <?php if (!empty($settings['subtitle'])) : ?>
                <p> <?php echo nl2br($settings['subtitle']) ?> </p>
            <?php endif; ?>
            <?php if (!empty($settings['btn_label'])): ?>
                <a <?php saasland_el_btn($settings['btn_url']) ?> class="btn_hover agency_banner_btn pay_btn pay_btn_two">
                    <?php echo esc_html($settings['btn_label']); ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>