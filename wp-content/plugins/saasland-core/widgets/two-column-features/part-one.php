<section class="features_area">
    <div class="container">
        <?php if ( $settings['is_row_reverse'] != 'yes' ) { ?>
        <div class="row feature_info">
            <div class="col-lg-7">
                <div class="feature_img f_img_one">
                    <?php
                    if (!empty($settings['images'])) {
                        foreach ($settings['images'] as $i => $image) {
                            $anim_delay = !empty($image['delay']['size']) ? $image['delay']['size'] : '0.2';
                            $animation = !empty($image['animation']) ? $image['animation'] : 'fadeIn';
                            ?>
                            <style>
                                .feature_info .feature_img.f_img_two .elementor-repeater-item-<?php echo $image['_id'] ?> {
                                <?php echo !empty($image['position']['top']) ? "top: {$image['position']['top']}px;" : ''; ?>
                                <?php echo !empty($image['position']['right']) ? "right: {$image['position']['right']}px;" : ''; ?>
                                <?php echo !empty($image['position']['bottom']) ? "bottom: {$image['position']['bottom']}px;" : ''; ?>
                                <?php echo !empty($image['position']['left']) ? "left: {$image['position']['left']}px;" : ''; ?>
                                }
                            </style>
                            <?php
                            switch ($i) {
                                case 0:
                                    $index = 'one';
                                    break;
                                case 1:
                                    $index = 'two';
                                    break;
                                case 2:
                                    $index = 'three';
                                    break;
                                case 3:
                                    $index = 'four';
                                    break;
                                default:
                                    $index = 'one';
                            }
                            echo "<img data-wow-delay='$anim_delay' class='leaf $index wow $animation elementor-repeater-item-{$image['_id']}' 
                                   src='{$image['image']['url']}' alt='{$image['alt']}'>";
                        }}
                    ?>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="f_content">
                    <div class="icon">
                        <?php if (!empty($settings['image_icon']['url'])) : ?>
                            <img src="<?php echo esc_url($settings['image_icon']['url']) ?>" alt="">
                        <?php endif; ?>
                        <?php if (!empty($settings['icon_type'] == 'ti')) : ?>
                            <i class="<?php echo esc_attr($settings['ti']) ?>"></i>
                        <?php endif; ?>
                    </div>
                    <?php if (!empty($settings['title'])) : ?>
                    <<?php echo $title_tag; ?> class="f_600 f_size_30 title_color saasland_title_color"> <?php echo wp_kses_post( nl2br($settings['title'] )) ?> </<?php echo $title_tag ?>>
                <?php endif; ?>
                <?php if (!empty($settings['subtitle'])) : ?>
                    <p> <?php echo wp_kses_post($settings['subtitle']) ?> </p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php
    }

    elseif ( $settings['is_row_reverse'] == 'yes' ) {
        ?>
        <div class="row feature_info flex-row-reverse mt_130">
            <div class="col-lg-5 offset-lg-2">
                <div class="feature_img f_img_two">
                    <?php
                    if (!empty($settings['images'])) {
                        foreach ($settings['images'] as $i => $image) {
                            ?>
                            <style>
                                .feature_info .feature_img.f_img_two .elementor-repeater-item-<?php echo $image['_id'] ?> {
                                <?php echo !empty($image['position']['top']) ? "top: {$image['position']['top']}px;" : ''; ?>
                                <?php echo !empty($image['position']['right']) ? "right: {$image['position']['right']}px;" : ''; ?>
                                <?php echo !empty($image['position']['bottom']) ? "bottom: {$image['position']['bottom']}px;" : ''; ?>
                                <?php echo !empty($image['position']['left']) ? "left: {$image['position']['left']}px;" : ''; ?>
                                }
                            </style>
                            <?php
                            $anim_delay = !empty($image['delay']['size']) ? $image['delay']['size'] : '0.2';
                            $animation = !empty($image['animation']) ? $image['animation'] : 'fadeIn';
                            switch ($i) {
                                case 0:
                                    $index = 'one';
                                    break;
                                case 1:
                                    $index = 'two';
                                    break;
                                case 2:
                                    $index = 'three';
                                    break;
                                case 3:
                                    $index = 'four';
                                    break;
                                default:
                                    $index = 'one';
                            }
                            echo "<img data-wow-delay='$anim_delay' class='leaf $index wow $animation elementor-repeater-item-{$image['_id']}' src='{$image['image']['url']}' alt='{$image['alt']}'>";
                        }}
                    ?>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="f_content">
                    <div class="icon">
                        <?php if (!empty($settings['image_icon']['url'])) : ?>
                            <img src="<?php echo esc_url($settings['image_icon']['url']) ?>" alt="">
                        <?php endif; ?>
                        <?php if (!empty($settings['icon_type'] == 'ti')) : ?>
                            <i class="<?php echo esc_attr($settings['ti']) ?>"></i>
                        <?php endif; ?>
                    </div>
                    <?php if (!empty($settings['title'])) : ?>
                    <<?php echo $title_tag; ?> class="f_600 f_size_30 title_color"> <?php echo wp_kses_post($settings['title']) ?> </<?php echo $title_tag; ?>>
                <?php endif; ?>
                <?php if (!empty($settings['subtitle'])) : ?>
                    <p> <?php echo wp_kses_post($settings['subtitle']) ?> </p>
                <?php endif; ?>
            </div>
        </div>
        </div>
        <?php
    }
    ?>
    </div>
</section>