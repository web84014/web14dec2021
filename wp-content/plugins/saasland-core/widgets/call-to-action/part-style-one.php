<section class="call_action_area">
    <img class="leaf action_one" data-parallax='{"x": -50, "y": 0}'
         src="<?php echo esc_url($settings['featured_image']['url']) ?>" alt="<?php echo esc_attr($settings['title']) ?>">
    <img class="leaf action_two" data-parallax='{"x": 40, "y": 0}' src="<?php echo esc_url($settings['bg_image']['url']) ?>" alt="<?php echo esc_attr($settings['title']) ?>">
    <div class="container">
        <div class="action_content text-center">
            <?php if (!empty($settings['title'])) : ?>
            <<?php echo esc_html($title_tag) ?> class="f_p f_size_40 l_height50 f_700"> <?php echo wp_kses_post(nl2br($settings['title'])) ?> </<?php echo esc_html($title_tag); ?>>
        <?php endif; ?>
        <?php echo wpautop($settings['subtitle']) ?>
        <?php if (!empty($settings['btn_label'])): ?>
            <a href="<?php echo esc_url($settings['btn_url']['url']); ?>"
                <?php saasland_is_external($settings['btn_url']) ?>
                <?php echo saasland_is_external($settings['btn_url']); ?>
               class="action_btn btn_hover mt_40">
                <?php echo esc_html($settings['btn_label']); ?>
            </a>
        <?php endif; ?>
    </div>
    </div>
</section>