<section class="event_banner_area">
    <?php
    if ( !empty( $settings['bg_image_stl2']['url'] ) ) { ?>
        <div class="parallax-effect" style="background: url( <?php echo esc_url( $settings['bg_image_stl2']['url'] ) ?> ); background-repeat: no-repeat; background-size: cover;"></div>
        <?php
    }
    ?>
    <div class="container">
        <div class="event_banner_content">
            <div class="round wow zoomIn" data-wow-delay="0.2s"></div>
            <?php
            if ( !empty($settings['upper_title']) ) {
                echo '<h6 class="wow fadeInUp" data-wow-delay="0.6s">' . esc_html( $settings['upper_title'] ) . '</h6>';
            }

            if ( !empty( $settings['title'] ) ) {
                echo '<'.$title_tag.' class="typewrite_title saasland_html_class_color wow fadeInUp" data-wow-delay="0.8s">' . saasland_hero_title($settings['title']) . '</'.$title_tag.'>';
            }

            if ( !empty( $settings['buttons'] ) ) {
                foreach ( $settings['buttons'] as $button ) {
                    if ( $button['btn_title'] ) {
                        echo '<a class="event_btn btn_hover wow fadeInLeft elementor-repeater-item-' . $button['_id'] . '" 
                                data-wow-delay="0.9s" href="' . esc_url( $button['btn_url']['url'] ). '"
                                '. saasland_is_external( $button['btn_url'] ) . '>'
                                 . esc_html( $button['btn_title'] ) .
                             '</a>';
                    }
                }
            }

            if ( !empty( $settings['is_play_btn'] == 'yes' ) ) {
                echo '<a class="event_btn event_btn_two btn_hover wow fadeInRight" data-wow-delay="0.9s" href="'. esc_url( $settings['play_url'] ) .'">
                        <i class="arrow_triangle-right_alt2"></i>' . esc_html( $settings['play_btn_title'] ) .
                     '</a>';
            }
            ?>
        </div>
    </div>
</section>

<?php saasland_typed_words_js( $settings['title'] ); ?>