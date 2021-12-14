<?php
$button_label = !empty( $settings['btn_label'] ) ? $settings['btn_label'] : esc_html__('Subscribe', 'saasland-core');
?>
<form action="#" class="mailchimp digital_agency_newsletter" method="post" novalidate="true">
    <div class="newsletter_form input-group">
        <label for="colFormLabelSm" class="col-form-label col-form-label-sm"><i class="fas fa-envelope mr-1"></i> <?php echo esc_html__('Newsletter', 'saasland-core' )?></label>
        <input type="text" id="colFormLabelSm" name="EMAIL" class="form-control memail" placeholder="<?php echo esc_attr($settings['email_placeholder']) ?>">
        <button type="submit" class="submit_btn"><?php echo esc_html( $button_label ) ?></button>
        <p class="mchimp-errmessage" style="display: none;"></p>
        <p class="mchimp-sucmessage" style="display: none;"></p>
    </div>
</form>
