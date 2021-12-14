<section class="home_analytics_banner_area">
    <div class="elements">
        <?php if ( !empty( $settings['analytics_shape_img1']['url'] ) ) : ?>
            <div class="elements_item">
                <img src="<?php echo esc_url( $settings['analytics_shape_img1']['url'] ) ?>" alt="<?php echo esc_attr( $settings['title'] ) ?>">
            </div>
        <?php endif; ?>
        <?php if ( !empty( $settings['analytics_shape_img2']['url'] ) ) : ?>
            <div class="elements_item">
                <img src="<?php echo esc_url( $settings['analytics_shape_img2']['url'] ) ?>" alt="<?php echo esc_attr( $settings['title'] ) ?>"></div>
        <?php endif; ?>
        <?php if ( !empty( $settings['analytics_shape_img3']['url'] ) ) : ?>
            <div class="elements_item">
                <img src="<?php echo esc_url( $settings['analytics_shape_img3']['url'] ) ?>" alt="<?php echo esc_attr( $settings['title'] ) ?>">
            </div>
        <?php endif; ?>
        <?php if ( !empty( $settings['analytics_shape_img4']['url'] ) ) : ?>
            <div class="elements_item">
                <img src="<?php echo esc_url( $settings['analytics_shape_img4']['url'] ) ?>" alt="<?php echo esc_attr( $settings['title'] ) ?>">
            </div>
        <?php endif; ?>
        <?php if ( !empty( $settings['analytics_shape_img5']['url'] ) ) : ?>
            <div class="elements_item">
                <img src="<?php echo esc_url( $settings['analytics_shape_img5']['url'] ) ?>" alt="<?php echo esc_attr( $settings['title'] ) ?>">
            </div>
        <?php endif; ?>
        <?php if ( !empty( $settings['analytics_shape_img6']['url'] ) ) : ?>
            <div class="elements_item">
                <img src="<?php echo esc_url( $settings['analytics_shape_img6']['url'] ) ?>" alt="<?php echo esc_attr( $settings['title'] ) ?>">
            </div>
        <?php endif; ?>
    </div>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="h_analytics_content">
                    <?php if (!empty($settings['title'])) : ?>
                        <<?php echo $title_tag; ?> class="typewrite_title saasland_html_class_color">
                            <?php echo wp_kses_post(nl2br($settings['title'])) ?>
                        </<?php echo $title_tag; ?>>
                    <?php endif; ?>
                    <?php echo !empty( $settings['subtitle'] ) ? wpautop( $settings['subtitle'] ) : ''; ?>
                    <?php
                    if (!empty( $buttons )) {
                        foreach ( $buttons as $button ) {
                            ?>
                            <?php if (!empty($button['btn_title'])) : ?>
                                <a href="<?php echo esc_url($button['btn_url']['url']) ?>" class="er_btn er_btn_two elementor-repeater-item-<?php echo $button['_id'] ?>"
                                    <?php saasland_is_external($button['btn_url']) ?>>
                                    <?php echo esc_html($button['btn_title']) ?>
                                </a>
                            <?php endif; ?>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="h_analytices_img">
                    <?php echo wp_get_attachment_image( $settings['fimage1']['id'], 'full' ); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
saasland_typed_words_js( $settings['title'] );