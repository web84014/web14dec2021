<div class="dl_subscription_info_box dl_border_radius dl_subscribe_style_one dl_pt_50 dl_pb_60"> 
    <div class="dl_subscribe_form dl_border_radius45">
        <div class="dl_form_control_wrap">
            <input type="text" class="dl_form_control dl_border_radius45 currect_name" name="NAME" placeholder="Name">
        </div>
        <div class="dl_form_control_wrap">
            <input type="email" class="dl_form_control dl_border_radius45 currect_email" name="EMAIL" placeholder="Email">
        </div>
        <button data-nonce="<?php echo wp_create_nonce('droit-subscription'); ?>" type="button" class="dl_cu_btn dl_round_50 dl_btn_hover_style_one send-subscription"><?php esc_html_e('Subscribe', 'droit-addons');?></button>
    </div>
    <p class="mchimp-errmessage" style="display: none;"></p>
    <p class="mchimp-sucmessage" style="display: none;"></p>
</div>