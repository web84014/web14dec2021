<section class="erp_call_action_area analytices_action_area_two">
    <style>
        .erp_call_action_area:before {
            background: url(<?php echo esc_url( $settings['bg_image']['url']) ?>)
            no-repeat scroll center bottom/cover;
        }
    </style>
    <div class="container">
        <div class="erp_action_content text-center">
            <?php echo wp_get_attachment_image( $settings['featured_image']['id'], 'full' ); ?>
            <?php if ( !empty( $settings['title'] ) ) : ?>
                <<?php echo $title_tag; ?> class="saasland_c2a_s"><?php echo wp_kses_post( nl2br( $settings['title'] ) ) ?></<?php echo $title_tag ?>>
            <?php endif; ?>
            <?php echo !empty( wp_kses_post($settings['subtitle'] )) ? wpautop($settings['subtitle']) : ''; ?>
            <?php if ( !empty( $settings['btn_label'] ) ) : ?>
                <a href="<?php echo esc_url( $settings['btn_url']['url'] ) ?>" class="er_btn er_btn_two"
                    <?php saasland_is_external( $settings['btn_url'] ) ?>>
                    <?php echo esc_html( $settings['btn_label'] ) ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
    <style>
        .analytices_action_area_two:after {
            background: url(<?php echo esc_url( $settings['bottom_bg_image']['url']) ?>)
            no-repeat scroll;
        }
    </style>
</section>