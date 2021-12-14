<section class="action_area_two">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 d-flex align-items-center">
                <div class="action_content">
                    <?php if (!empty($settings['title'])) : ?>
                    <<?php echo $title_tag; ?> class="f_600 f_size_30 l_height45 t_color3 mb-0 wow fadeInLeft" data-wow-delay="0.3s">
                    <?php echo wp_kses_post(nl2br($settings['title'])) ?>
                </<?php echo $title_tag ?>>
                <?php endif; ?>
                <?php if (!empty($settings['btn_label'])): ?>
                    <a href="<?php echo esc_url($settings['btn_url']['url']); ?>"
                        <?php saasland_is_external($settings['btn_url']) ?>
                        <?php echo saasland_is_external($settings['btn_url']); ?>
                       class="btn_three btn_hover wow fadeInLeft" data-wow-delay="0.5s">
                        <?php echo esc_html($settings['btn_label']); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
        <?php if (!empty($settings['featured_image']['url'])) : ?>
            <div class="col-lg-4">
                <div class="action_img wow fadeInRight" data-wow-delay="0.5s">
                    <img src="<?php echo esc_url($settings['featured_image']['url']) ?>" alt="<?php echo esc_attr($settings['title']); ?>">
                </div>
            </div>
        <?php endif; ?>
    </div>
    </div>
</section>