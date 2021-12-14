<section class="gadget_about_area sec_pad">
    <?php
    if( !empty( $settings['about_background_text'] ) ){
         echo '<div class="text_shadow wow" data-splitting>'. esc_html( $settings['about_background_text'] ) .'</div>';
    } ?>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="gadget_about_img">
                    <?php
                    if( !empty( $settings['about_feature_img1']['id'] ) ){
                        echo wp_get_attachment_image( $settings['about_feature_img1']['id'], 'full', '', array( 'class'=>'one_img' ) );
                    }
                    if( !empty( $settings['about_feature_img2']['id'] ) ){
                        echo wp_get_attachment_image( $settings['about_feature_img2']['id'], 'full', '', array( 'class'=>'two_img wow fadeInRight' ) );
                    }
                    ?>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="gadget_details pl_70">
                    <?php
                    if( !empty( $settings['about_title'] ) ){
                        echo '<h2 class="wow" data-splitting>'. wp_kses_post( $settings['about_title'] ) .'</h2>';
                    }
                    if( !empty( $settings['about_description'] ) ){
                        echo '<p data-splitting class="wow">'. wp_kses_post( $settings['about_description'] ) .'</p>';
                    }
                    if( !empty( $settings['about_btn_label'] ) ){
                        echo '<a href="'. esc_url( $settings['about_btn_url']['url'] ) .'" '. saasland_is_external_return( $settings['about_btn_url'] ) .' class="gadget_btn wow fadeInUp" data-wow-delay="0.7s">'. esc_html( $settings['about_btn_label'] ) .'</a>';

                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>