<section class="hosting_banner_area">
    <ul class="list-unstyled b_line">
        <?php if (!empty($settings['hos_shape1']['url'])) : ?>
            <li class="wow fadeInUp" data-wow-delay="0.4s">
                <img src="<?php echo esc_url($settings['hos_shape1']['url']) ?>" alt="<?php echo esc_attr($settings['title']) ?>">
            </li>
        <?php endif; ?>
        <?php if (!empty($settings['hos_shape2']['url'])) : ?>
            <li class="wow fadeInUp" data-wow-delay="0.7s">
                <img src="<?php echo esc_url($settings['hos_shape2']['url']) ?>" alt="<?php echo esc_attr($settings['title']) ?>">
            </li>
        <?php endif; ?>
        <?php if (!empty($settings['hos_shape3']['url'])) : ?>
            <li class="wow fadeInUp" data-wow-delay="0.9s">
                <img src="<?php echo esc_url($settings['hos_shape3']['url']) ?>" alt="<?php echo esc_attr($settings['title']) ?>">
            </li>
        <?php endif; ?>
        <?php if (!empty($settings['hos_shape4']['url'])) : ?>
            <li class="wow fadeInUp" data-wow-delay="1.2s">
                <img src="<?php echo esc_url($settings['hos_shape4']['url']) ?>" alt="<?php echo esc_attr($settings['title']) ?>">
            </li>
        <?php endif; ?>
        <?php if (!empty($settings['hos_shape5']['url'])) : ?>
            <li class="wow fadeInUp" data-wow-delay="0.4s">
                <img src="<?php echo esc_url($settings['hos_shape5']['url']) ?>" alt="<?php echo esc_attr($settings['title']) ?>">
            </li>
        <?php endif; ?>
        <?php if (!empty($settings['hos_shape6']['url'])) : ?>
            <li class="wow fadeInUp" data-wow-delay="1s">
                <img src="<?php echo esc_url($settings['hos_shape6']['url']) ?>" alt="<?php echo esc_attr($settings['title']) ?>">
            </li>
        <?php endif; ?>
        <?php if (!empty($settings['hos_shape7']['url'])) : ?>
            <li class="wow fadeInUp" data-wow-delay="1s">
                <img src="<?php echo esc_url($settings['hos_shape7']['url']) ?>" alt="<?php echo esc_attr($settings['title']) ?>">
            </li>
        <?php endif; ?>
        <?php if (!empty($settings['hos_shape8']['url'])) : ?>
            <li class="wow fadeInUp" data-wow-delay="1.3s">
                <img src="<?php echo esc_url($settings['hos_shape8']['url']) ?>" alt="<?php echo esc_attr($settings['title']) ?>">
            </li>
        <?php endif; ?>
    </ul>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-7 d-flex align-items-center">
                <div class="hosting_content">
                    <?php if ( !empty($settings['title']) ) : ?>
                    <<?php echo $title_tag; ?> class="typewrite_title hosting_color_s wow fadeInUp" data-wow-delay="0.3s"><?php echo saasland_hero_title($settings['title']) ?></<?php echo $title_tag; ?>>
                <?php endif; ?>
                <?php if (!empty($settings['subtitle'])) : ?>
                    <p class="wow fadeInUp" data-wow-delay="0.5s"><?php echo wp_kses_post(nl2br($settings['subtitle'])) ?></p>
                <?php endif; ?>

                <?php
                if (!empty( $buttons )) {
                    foreach ( $buttons as $button ) {
                        ?>
                        <?php if (!empty($button['btn_title'])) : ?>
                            <a href="<?php echo esc_url($button['btn_url']['url']) ?>" class="hosting_btn btn_hover wow fadeInUp elementor-repeater-item-<?php echo $button['_id'] ?>" data-wow-delay="0.7s"
                                <?php saasland_is_external($button['btn_url']) ?>>
                                <?php echo esc_html($button['btn_title']) ?>
                            </a>
                        <?php endif; ?>
                        <?php
                    }}
                ?>
            </div>
        </div>
        <div class="col-lg-6 col-md-5">
            <img class="img-fluid wow fadeInRight" data-wow-delay="0.7s" src="<?php echo esc_url($settings['fimage3']['url']) ?>" alt="<?php echo esc_attr($settings['title']) ?>">
        </div>
    </div>
    </div>
</section>

<?php saasland_typed_words_js( $settings['title'] ); ?>