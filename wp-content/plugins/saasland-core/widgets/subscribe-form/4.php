<div class="subscribe_form_info text-center">
    <?php if (!empty($settings['title'])) : ?>
    <<?php echo $title_tag; ?> class="f_600 f_size_30 l_height30 t_color3 mb_50 saas_subscribe_color">
    <?php echo wp_kses_post(nl2br($settings['title'])) ?>
</<?php echo $title_tag; ?>>
<?php endif; ?>
<form class="mailchimp subscribe-form" method="post">
    <input type="text" name="EMAIL" class="form-control memail" placeholder="<?php echo esc_attr($settings['email_placeholder']) ?>">
    <?php if (!empty($settings['btn_label'])) : ?>
        <button class="btn_hover btn_four mt_40" type="submit">
            <?php echo esc_html($settings['btn_label']); ?>
        </button>
    <?php endif; ?>
    <p class="mchimp-errmessage" style="display: none;"></p>
    <p class="mchimp-sucmessage" style="display: none;"></p>
</form>
</div>