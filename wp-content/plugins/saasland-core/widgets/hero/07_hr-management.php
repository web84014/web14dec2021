<section class="startup_banner_area_three">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="startup_content_three">
                    <style>
                        .startup_banner_area_three:before {
                            background: url(<?php echo esc_url( $settings['hr_management_shape']['url'] ) ?>)
                            no-repeat scroll center bottom/cover;
                        }
                    </style>
                    <?php if (!empty($settings['title'])) : ?>
                        <<?php echo $title_tag; ?> class="typewrite_title"> <?php echo saasland_hero_title($settings['title']); ?> </<?php echo $title_tag; ?>>
                    <?php endif; ?>
                    <?php if (!empty($settings['subtitle'])) : ?>
                        <p> <?php echo wp_kses_post(nl2br($settings['subtitle'])) ?> </p>
                    <?php endif; ?>
                    <?php
                    $i = 0;
                    foreach ($buttons as $button) {
                        ++$i;
                        echo "<a " .
                            "href='{$button['btn_url']['url']}' " .
                            "class='btn_six slider_btn elementor-repeater-item-{$button['_id']}'> " .
                            "{$button['btn_title']} " .
                            "</a>";
                    }
                    if ( $settings['is_play_btn'] == 'yes' ) : ?>
                        <a href="<?php echo esc_url($settings['play_url']) ?>" class="popup-youtube btn_six slider_btn">
                            <i class="fa fa-play-circle"></i> <?php echo esc_html($settings['play_btn_title']) ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="stratup_app_screen">
        <?php if (!empty($settings['fimage1'] ['url'])) : ?>
            <img class="phone wow slideInnew" data-wow-delay="0.8s" src="<?php echo esc_url($settings['fimage1']['url']) ?>" alt="<?php echo esc_attr($settings['title']); ?>">
        <?php endif; ?>
        <?php if (!empty($settings['fimage2']['url'])) : ?>
            <img class="laptop wow slideInnew" data-wow-delay="0.3s" src="<?php echo esc_url($settings['fimage2']['url']) ?>" alt="<?php echo esc_attr($settings['subtitle']); ?>">
        <?php endif; ?>
    </div>
</section>

<?php saasland_typed_words_js( $settings['title'] ); ?>