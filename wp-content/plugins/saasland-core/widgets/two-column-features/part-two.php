<section class="pos_features_area sec_pad">
    <div class="container">

        <div class="row <?php echo esc_attr( $settings['is_row_reverse'] == 'yes' ) ? 'flex-row-reverse' : ''; ?> pos_item">

            <div class="col-lg-6">
                <div class="pos_features_img <?php echo esc_attr( $class_name ) ?>">
                    <div class="shape_img "></div>
                    <div class="shap_img">
                        <?php echo wp_get_attachment_image( $settings['fimage']['id'], 'full' ); ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="pos_features_content <?php echo esc_attr( $class2_name ) ?>">
                    <?php if ( !empty( $settings['title'] ) ) : ?>
                        <<?php echo $title_tag; ?> class="saasland_title_color"><?php echo wp_kses_post( nl2br( $settings['title'] ) ) ?></<?php echo $title_tag; ?>>
                    <?php endif; ?>
                    <?php
                    if ( !empty( $features2 ) ) {
                        foreach ( $features2 as $feature ) {
                            ?>
                            <div class="media h_features_item">
                                <?php if (!empty( $feature['f_icon'] ) ) : ?>
                                    <i class="<?php echo esc_attr( $feature['f_icon'] ) ?> elementor-repeater-item-<?php echo $feature['_id']; ?>"></i>
                                <?php endif; ?>
                                <div class="media-body">
                                    <?php if ( !empty( $feature['title'] ) ) : ?>
                                        <h3 class="h_head"><?php echo esc_html( $feature['title'] ) ?></h3>
                                    <?php endif; ?>
                                    <?php if ( !empty( $feature['Subtitle'] ) ) : ?>
                                        <?php echo wp_kses_post( wpautop( $feature['Subtitle'] ) ) ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php
                        }}
                    ?>
                </div>
            </div>

        </div>

    </div>
</section>