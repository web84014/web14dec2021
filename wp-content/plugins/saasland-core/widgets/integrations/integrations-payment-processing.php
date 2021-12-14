<section class="payment_clients_area">
    <div class="clients_bg_shape_top"></div>
    <div class="clients_bg_shape_right"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="payment_features_content pr_70 wow fadeInLeft" data-wow-delay="0.2s">
                    <div class="icon">
                        <img class="img_shape" src="<?php echo SC_IMAGES. 'home9/icon_shape.png' ?>" alt="<?php echo esc_attr($settings['title']); ?>">
                        <img class="icon_img" src="<?php echo esc_url($settings['title_icon']['url']); ?>" alt="<?php echo esc_attr($settings['title']); ?>">
                    </div>

                    <?php if (!empty($settings['title'])) : ?>
                        <<?php echo $title_tag; ?> class="title_color"> <?php echo nl2br($settings['title']) ?> </<?php echo $title_tag; ?>>
                    <?php endif; ?>
                    <?php if (!empty($settings['subtitle'])) : ?>
                        <p> <?php echo nl2br($settings['subtitle']) ?> </p>
                    <?php endif; ?>

                    <?php if (!empty($settings['btn_label'])): ?>
                        <a <?php saasland_el_btn($settings['btn_url']) ?> class="<?php /*echo $settings['btn_normal_stat'].' '.$settings['btn_hover_stat'] */?> btn_hover agency_banner_btn pay_btn pay_btn_one">
                            <?php echo esc_html($settings['btn_label']); ?>
                        </a>
                    <?php endif; ?>

                    <?php if (!empty($settings['btn2_label'])): ?>
                        <a <?php saasland_el_btn($settings['btn2_url']) ?> class="btn_hover agency_banner_btn pay_btn pay_btn_two">
                            <?php echo esc_html($settings['btn2_label']); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="payment_clients_inner">
                    <?php
                    if ( !empty($planets) ) {
                        $delay = 0.2;
                        foreach ( $planets as $i => $planet ) {
                            $width = !empty($planet['dimension']['width']) ? "width: {$planet['dimension']['width']}px; " : '';
                            $height = !empty($planet['dimension']['height']) ? "height: {$planet['dimension']['height']}px; " : '';
                            $top = !empty($planet['position']['top']) ? "top: {$planet['position']['top']}px; " : '';
                            $right = !empty($planet['position']['right']) ? "right: {$planet['position']['right']}px; " : '';
                            $bottom = !empty($planet['position']['bottom']) ? "bottom: {$planet['position']['bottom']}px; " : '';
                            $left = !empty($planet['position']['left']) ? "left:{$planet['position']['left']}px; " : '';
                            $index = 'one';
                            switch ($i) {
                                case 0;
                                    $index = 'one';
                                    break;
                                case 1;
                                    $index = 'two';
                                    break;
                                case 2;
                                    $index = 'three';
                                    break;
                                case 3;
                                    $index = 'four';
                                    break;
                                case 4;
                                    $index = 'five';
                                    break;
                                case 5;
                                    $index = 'six';
                                    break;
                                case 6;
                                    $index = 'seven';
                                    break;
                                case 7;
                                    $index = 'eight';
                                    break;
                                case 8;
                                    $index = 'nine';
                                    break;
                            }
                            ?>
                            <div class="clients_item <?php echo esc_attr($index).' elementor-repeater-item-' . $planet['_id'] . '' ?> wow fadeInLeft"
                                 data-wow-delay="<?php echo esc_attr($delay) ?>s"
                                 style="<?php echo $width.$height.$top.$right.$bottom.$left; ?>">
                                <?php echo wp_get_attachment_image($planet['logo']['id'], 'full' ) ?>
                            </div>
                            <?php
                            $delay = $delay + 0.1;
                        }}
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>