<section class="payment_subscribe_area">
    <div class="container">
        <div class="payment_subscribe_info">
            <div class="payment_subscribe_content">
                <?php if (!empty($settings['title'])) : ?>
                    <<?php echo $title_tag; ?> class="saas_subscribe_color"> <?php echo wp_kses_post(nl2br($settings['title'])) ?> </<?php echo $title_tag ?>>
                <?php endif; ?>
                <?php if (!empty($settings['subtitle'])) : ?>
                    <p> <?php echo wp_kses_post(nl2br($settings['subtitle'])) ?> </p>
                <?php endif; ?>
            </div>
            <form  class="subscribe-form mailchimp" method="post">
                <input type="text" name="EMAIL" class="form-control" placeholder="<?php echo esc_attr($settings['email_placeholder']) ?>">
                <?php if (!empty($settings['btn_label'])) : ?>
                    <button class="btn_hover btn_four" type="submit">
                        <?php echo esc_html($settings['btn_label']); ?>
                    </button>
                <?php endif ?>
            </form>
        </div>
        <div class="messages">
            <p class="mchimp-errmessage" style="display: none;"></p>
            <p class="mchimp-sucmessage" style="display: none;"></p>
        </div>
    </div>
</section>