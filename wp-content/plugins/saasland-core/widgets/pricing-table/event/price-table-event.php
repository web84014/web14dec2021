<div class="row align-items-center">
    <?php
    if ( !empty( $table3 ) ) {
        $i = 0;
        foreach ( $table3 as $item ) {
            $is_active = !empty( $item['is_active'] == 'yes' ) ? 'active' : '';
            ?>
            <div class="col-lg-<?php echo esc_attr( $settings['column'] ) ?> col-sm-6">
                <div class="analytices_price_item event_price_item <?php echo esc_attr( $is_active ) ?> wow fadeInUp" data-wow-delay="<?php echo esc_attr( $i ) ?>s">
                    <style>
                        .event_price_item:before {
                            background: url( <?php echo esc_url( plugins_url( '/img/price_shap.png', __FILE__ ) ) ?> )
                            no-repeat scroll center bottom;
                        }
                    </style>
                    <div class="p_head">
                        <?php
                        if ( !empty( $item['title'] ) ) {
                            echo '<h5>' . esc_html( $item['title'] ) . '</h5>';
                        }

                        if ( !empty( $item['ribbon'] ) ) {
                            echo '<h6 class="tag"><i class="'. esc_attr( $item['ribbon_icon'] ) .'"></i>' . esc_html( $item['ribbon'] ) . '</h6>';
                        }

                        if ( !empty( $item['price'] ) ) {
                            echo '<div class="rate">' . esc_html( $item['price'] ) . '</div>';
                        } ?>
                    </div>
                    <ul class="list-unstyled p_body">
                        <?php
                        if ( !empty( $item['content_list'] ) ) {
                            echo wp_kses_post( $item['content_list'] );
                        } ?>
                    </ul>
                    <?php
                    if ( $item['btn_label'] ) {
                        $is_active_btn_class = ( $item['is_active'] == 'yes' ) ? 'event_btn btn_hover' : 'event_btn event_btn_two btn_hover';
                        echo '<div class="text-center">
                                <a href="' . esc_url( $item['btn_url']['url'] ). '" class="' .esc_attr( $is_active_btn_class ). ' elementor-repeater-item-' . $item['_id'] . '" 
                                '.saasland_is_external( $item['btn_url'] ).'>'
                                . esc_html( $item['btn_label'] ) .'</a>
                             </div>';
                    }
                    ?>
                </div>
            </div>
            <?php
            $i = $i + 0.2;
        }
    } ?>
</div>