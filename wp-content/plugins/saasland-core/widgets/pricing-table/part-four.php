<section class="support_price_area sec_pad">
    <div class="container custom_container p0">
        <div class="sec_title text-center mb_70 wow fadeInUp" data-wow-delay="0.3s">
            <?php if (!empty($settings['title'])) : ?>
                <<?php echo esc_html($title_tag); ?> class="f_p f_size_30 l_height50 f_600 t_color3">
                    <?php echo wp_kses_post($settings['title']); ?>
                </<?php echo esc_html($title_tag); ?>>
            <?php endif; ?>
            <?php if (!empty($settings['subtitle'])) : ?>
                <p class="f_400 f_size_16 mb-0"><?php echo wp_kses_post($settings['subtitle']) ?></p>
            <?php endif; ?>
        </div>
        <div class="price_content price_content_two">
            <div class="row">
                <?php
                if (!empty( $table4 )) {
                    foreach ( $table4 as $table ) {
                    ?>
                    <div class="col-lg-<?php echo esc_attr($settings['column']) ?> col-sm-6">
                        <div class="price_item">
                            <?php if (!empty($table['ribbon_label'])) : ?>
                                <div class="tag"><span><?php echo esc_html($table['ribbon_label']) ?></span></div>
                            <?php endif; ?>
                            <?php if (!empty($table['icon_bg']['url'])) : ?>
                                <img src="<?php echo esc_url($table['icon_bg']['url']) ?>" alt="<?php echo esc_attr($table['title']) ?>">
                            <?php endif; ?>
                            <?php if (!empty($table['title'])) : ?>
                                <h5 class="f_p f_size_20 f_600 t_color2 mt_30"><?php echo esc_html($table['title']) ?></h5>
                            <?php endif; ?>
                            <?php echo !empty($table['subtitle']) ? wp_kses_post($table['subtitle']) : ''; ?>
                            <div class="price f_700 f_size_40 t_color2">
                                <?php echo esc_html($table['price']) ?>
                                <?php if (!empty($table['duration'])) : ?>
                                    <sub class="f_size_16 f_400">/ <?php echo esc_html($table['duration']) ?></sub>
                                <?php endif; ?>
                            </div>
                            <ul class="list-unstyled p_list">
                                <?php echo wp_kses_post($table['contents']) ?>
                            </ul>
                            <?php if (!empty($table['btn_label'])) : ?>
                                <a href="<?php echo esc_url($table['btn_url']['url']) ?>" class="price_btn btn_hover"
                                    <?php saasland_is_external($table['btn_url']) ?>>
                                    <?php echo esc_html($table['btn_label']) ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</section>