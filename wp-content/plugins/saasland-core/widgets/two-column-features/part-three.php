<section class="h_analytices_features_area">
    <div class="container">
        <div class="row h_analytices_features_item <?php echo esc_attr($is_show) ?><?php echo esc_attr( $settings['is_row_reverse'] == 'yes' ) ? 'flex-row-reverse' : ''; ?>">
            <div class="col-lg-6">
                <div class="h_analytices_img">
                    <?php
                    if (!empty($settings['images'])) {
                        foreach ($settings['images'] as $i => $image) {
                            $anim_delay = !empty($image['delay']['size']) ? $image['delay']['size'] : '0.3';
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
                                default:
                                    $index = '';
                            }
                            ?>
                            <img class="analytices_img_<?php echo esc_attr( $index ) ?> wow <?php echo esc_attr( $animation ) ?> elementor-repeater-item-<?php echo $image['_id']; ?>" data-wow-delay="<?php echo esc_attr( $anim_delay ) ?>s"
                                 src="<?php echo esc_url( $image['image']['url'] ) ?>" alt="<?php echo esc_attr( $image['alt']) ?>">
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="h_analytices_content">
                    <?php if ( !empty( $settings['title'] ) ) : ?>
                        <<?php echo $title_tag; ?> class="wow fadeInUp saasland_title_color" data-wow-delay="0.1s"><?php echo wp_kses_post( nl2br($settings['title'] )) ?></<?php echo $title_tag ?>>
                    <?php endif; ?>
                    <?php if ( !empty( $settings['subtitle'] ) ) : ?>
                        <p class="wow fadeInUp" data-wow-delay="0.3s"><?php echo esc_html( $settings['subtitle'] ) ?></p>
                    <?php endif; ?>
                    <ul class="list-unstyled">
                        <?php
                        $delay = 0.3;
                        if ( !empty( $features3 ) ) {
                            foreach ( $features3 as $feature ) {
                                ?>
                                <?php if ( !empty( $feature['contents'] ) ) : ?>
                                    <li class="wow fadeInUp elementor-repeater-item-<?php echo $feature['_id']; ?>" data-wow-delay="<?php echo esc_attr( $delay) ?>s"><?php echo wp_kses_post( $feature['contents']) ?></li>
                                <?php endif; ?>
                                <?php
                                $delay = $delay + 0.3;
                            }}
                        ?>
                    </ul>
                </div>
            </div>
        </div>
        <?php if ( !empty( $settings['btn_label'] ) ) : ?>
            <div class="text-center wow fadeInUp" data-wow-delay="0.3s">
                <a href="<?php echo esc_url( $settings['btn_url']['url'] ) ?>" class="er_btn"
                    <?php saasland_is_external( $settings['btn_url'] ) ?>>
                    <?php echo esc_html( $settings['btn_label'] ) ?>
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>