<section class="software_featured_area_two sec_pad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="software_featured_img wow fadeInLeft" data-wow-delay="0.2s">
                    <img src="<?php echo esc_url($settings['featured_image']['url']) ?>" class="img-fluid" alt="<?php echo esc_attr($settings['title']); ?>">
                </div>
            </div>
            <div class="col-lg-5 offset-lg-1 d-flex align-items-center pl-0">
                <div class="software_featured_content">
                    <?php if (!empty($settings['title'])) : ?>
                    <<?php echo $title_tag; ?> class="f_700 f_size30 l_height_40 w_color f_p mb-30 wow fadeInRight" data-wow-delay="0.2s">
                    <?php echo wp_kses_post(nl2br($settings['title'])) ?>
                </<?php echo $title_tag; ?>>
                <?php endif; ?>
                <?php if (!empty($settings['subtitle'])) : ?>
                    <p class="w_color f_300 mb_50 wow fadeInRight" data-wow-delay="0.4s">
                        <?php echo nl2br($settings['subtitle']) ?>
                    </p>
                <?php endif; ?>
                <?php if (!empty($settings['btn_label'])): ?>
                    <a href="<?php echo esc_url($settings['btn_url']['url']); ?>"
                        <?php saasland_is_external($settings['btn_url']) ?>
                        <?php echo saasland_is_external($settings['btn_url']); ?>
                       class="btn_hover btn_four wow fadeInRight" data-wow-delay="0.6s">
                        <?php echo esc_html($settings['btn_label']); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    </div>
</section>