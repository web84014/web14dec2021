<section class="software_banner_area d-flex align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 d-flex align-items-center">
                <div class="software_banner_content">
                    <?php
                    if (!empty($settings['title'])) : ?>
                        <<?php echo $title_tag; ?> class="typewrite_title f_500 f_size_50 w_color wow fadeInLeft" data-wow-delay="0.2s">
                            <?php echo saasland_hero_title($settings['title']); ?>
                        </<?php echo $title_tag; ?>>
                    <?php endif; ?>
                    <?php if (!empty($settings['subtitle'])) : ?>
                        <p class="w_color f_size_18 l_height30 mt_30 wow fadeInLeft" data-wow-delay="0.4s">
                            <?php echo wp_kses_post(nl2br($settings['subtitle'])) ?>
                        </p>
                    <?php endif; ?>
                    <div class="action_btn d-flex align-items-center mt_40 wow fadeInLeft" data-wow-delay="0.6s">
                        <?php
                        $buttons = $settings['buttons'];
                        foreach ( $buttons as $button ) {
                            echo "<a ".saasland_el_btn($button['btn_url'], false)." class='software_banner_btn elementor-repeater-item-{$button['_id']}'> {$button['btn_title']} </a>";
                        }
                        ?>
                        <?php
                        if (!empty($settings['is_play_btn'] == 'yes')) : ?>
                            <a href="<?php echo esc_url( $settings['play_url'] ) ?>" class="video_btn popup-youtube">
                                <div class="icon"><i class="ti-control-play"></i></div><span> <?php echo esc_html($settings['play_btn_title']) ?> </span>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php
            if (!empty($settings['fimage3']['url'])) : ?>
                <div class="col-lg-6">
                    <div class="software_img wow fadeInRight" data-wow-delay="0.2s">
                        <img src="<?php echo esc_url($settings['fimage3']['url']); ?>" alt="<?php echo esc_attr($settings['title']) ?>">
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php saasland_typed_words_js( $settings['title'] ); ?>