<section class="action_area_three sec_pad">
    <div class="curved"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="action_content text-center">
                    <?php if (!empty($settings['title'])) : ?>
                    <<?php echo $title_tag; ?> class="f_600 f_size_30 l_height45 mb_40">
                    <?php echo wp_kses_post(nl2br($settings['title'])) ?>
                </<?php echo $title_tag; ?>>
                <?php endif; ?>
                <?php if (!empty($settings['btn_label'])): ?>
                    <a href="<?php echo esc_url($settings['btn_url']['url']); ?>"
                        <?php saasland_is_external($settings['btn_url']) ?>
                        <?php echo saasland_is_external($settings['btn_url']); ?>
                       class="about_btn white_btn wow fadeInLeft" data-wow-delay="0.3s">
                        <?php echo esc_html($settings['btn_label']); ?>
                    </a>
                <?php endif; ?>
                <?php if (!empty($settings['btn_label2'])): ?>
                    <a href="<?php echo esc_url($settings['btn_url2']['url']); ?>"
                        <?php saasland_is_external($settings['btn_url2']) ?>
                        <?php echo saasland_is_external($settings['btn_url2']); ?>
                       class="about_btn wow fadeInRight" data-wow-delay="0.4s">
                        <?php echo esc_html($settings['btn_label2']); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    </div>
</section>