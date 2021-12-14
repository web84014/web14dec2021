<section class="chat_banner_area">
    <?php
    if ( !empty( $settings['chat_shape1']['url'] )) { ?>
        <img class="p_absoulte cloud" data-parallax='{"x": 0, "y": 150}' src="<?php echo esc_url( $settings['chat_shape1']['url'] ) ?>" alt="<?php echo esc_attr( strip_tags($settings['title'] ) ) ?>">
        <?php
    }
    if ( !empty( $settings['chat_shape2']['url'] )) { ?>
        <img class="p_absoulte left wow fadeInLeft" data-wow-delay="0.2s" src="<?php echo esc_url( $settings['chat_shape2']['url'] ) ?>" alt="<?php echo esc_attr( strip_tags($settings['title'] ) ) ?>">
        <?php
    }
    if ( !empty( $settings['chat_shape3']['url'] )) { ?>
        <img class="p_absoulte right wow fadeInRight" data-wow-delay="0.3s" src="<?php echo esc_url( $settings['chat_shape3']['url'] ) ?>" alt="<?php echo esc_attr( strip_tags($settings['title'] ) ) ?>">
        <?php
    }
    ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 <?php echo is_rtl() ? 'offset-lg-2' : ''; ?>">
                <div class="chat_banner_content">
                    <?php
                    if ( !empty( $settings['upper_title'] ) ) {
                        echo '<div class="c_tag wow fadeInUp">' . wp_get_attachment_image( $settings['upper_title_img']['id'], 'full' ) . esc_html( $settings['upper_title'] ) . '</div>';
                    }
                    if ( !empty( $settings['title'] ) ) {
                        echo '<'.$title_tag.' class="typewrite_title saasland_html_class_color wow fadeInUp" data-wow-delay="0.2s">' . saasland_hero_title( $settings['title'] ) . '</' .$title_tag. '>';
                    }
                    ?>
                    <div class="text-center pr_100 wow fadeInUp" data-wow-delay="0.4s">
                        <?php
                        if ( !empty( $settings['buttons'] ) ) {
                            foreach ( $settings['buttons'] as $button ) {
                                if ( $button['btn_title'] ) {
                                    echo '<a href="' . esc_url( $button['btn_url']['url'] ). '" class="chat_btn btn_hover elementor-repeater-item-' . $button['_id'] . '"
                                            ' . saasland_is_external_return( $button['btn_url'] ) . '>'
                                              . esc_html( $button['btn_title'] ) .
                                         '</a>';
                                }
                            }
                        }

                        if ( $settings['is_bottom_text_btn'] == 'yes' ) {
                            echo '<span>' . esc_html( $settings['bottom_text_btn'] ) . '</span>';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 <?php echo is_rtl() ? '' : 'offset-lg-2'; ?>">
                <div class="chat_img">
                    <?php
                    if ( !empty( $settings['chat_fimage1']['id'] ) ) {
                        echo wp_get_attachment_image( $settings['chat_fimage1']['id'], 'full', false, array( 'class' => 'p_absoulte p_one' ) );
                    }
                    if ( !empty( $settings['chat_fimage2']['id'] ) ) {
                        echo wp_get_attachment_image( $settings['chat_fimage2']['id'], 'full', false, array( 'class' => 'p_absoulte p_two' ) );
                    }
                    if ( !empty( $settings['chat_fimage3']['id'] ) ) {
                        echo wp_get_attachment_image( $settings['chat_fimage3']['id'], 'full', false, array( 'class' => 'p_absoulte p_three' ) );
                    }
                    ?>
                    <div class="round one"></div>
                    <div class="round two"></div>
                    <div class="round three"></div>
                    <?php
                    if ( !empty( $settings['fimage3']['id'] ) ) { ?>
                        <img class="wow fadeInUp" data-wow-delay="0.2s" src="<?php echo esc_url( $settings['fimage3']['url'] ) ?>" alt="<?php echo esc_attr( strip_tags($settings['title'] ) ) ?>">
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
saasland_typed_words_js( $settings['title'] );