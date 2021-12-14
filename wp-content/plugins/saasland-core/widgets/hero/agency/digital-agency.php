<?php
wp_enqueue_style('saasland-digital-agency');
?>
<section class="banner_section home_one_banner deco_wrap d-flex align-items-center" id="apps_craft_animation">
    <div class="container">
        <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 order-last">
                <?php
                if( !empty( $settings['fimage1']['id'] ) ){ ?>
                    <div class="banner_image">
                        <?php echo wp_get_attachment_image( $settings['fimage1']['id'], 'full' ) ?>
                    </div>
                <?php
                }
                ?>
            </div>
            <div class="col-lg-6">
                <div class="banner_content">
                    <?php
                    if( !empty( $settings['title'] ) ){
                        echo '<h1 class="title_text wow fadeInUp">'.wp_kses_post( nl2br( $settings['title'] ) ).'</h1>';
                    }

                    if( !empty( $settings['subtitle'] ) ){
                        echo '<p class="wow fadeInUp" data-wow-delay="0.3s">'. wp_kses_post( nl2br( $settings['subtitle'] ) ) .'</p>';
                    }

                    if( is_array( $settings['buttons'] ) ){
                        foreach ( $settings['buttons'] as $button ){
                            echo '<a href="'. esc_url( $button['btn_url']['url'] ) .'" class="btn_hover btn_four elementor-repeater-item-'.esc_attr(  $button['_id'] ) .'">'. esc_html( $button['btn_title'] ) .'</a>';
                        }
                    }

                    if( $settings['is_play_btn'] == 'yes' && !empty( $settings['play_url'] ) ){ ?>
                        <a class="play_btn wow fadeInUp popup-youtube" data-wow-delay="0.6s" href="<?php echo esc_url( $settings['play_url'] )?>">
                            <span><i class="arrow_triangle-right"></i></span>
                        </a>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php
    if( !empty( $settings['mail_shape_img1']['url'] ) ){ ?>
        <div class="deco_image shape_01">
            <img class="layer" data-depth="0.2" src="<?php echo esc_url( $settings['mail_shape_img1']['url'] ) ?>" alt="">
        </div>
        <?php
    }
    if( !empty( $settings['mail_shape_img2']['url'] ) ){ ?>
        <div class="deco_image shape_02">
            <img class="layer" data-depth="-0.2"  src="<?php echo esc_url( $settings['mail_shape_img2']['url'] ) ?>" alt="shape_image_not_found">
        </div>
        <?php
    }
    if( !empty( $settings['mail_shape_img3']['url'] ) ){ ?>
        <div class="deco_image shape_03">
            <img class="layer" data-depth="0.2" src="<?php echo esc_url( $settings['mail_shape_img3']['url'] ) ?>" alt="shape_image_not_found">
        </div>
        <?php
    }
    if( !empty( $settings['mail_shape_img4']['url'] ) ){ ?>
        <div class="deco_image shape_04">
            <img class="layer" data-depth="0.3" src="<?php echo esc_url( $settings['mail_shape_img4']['url'] ) ?>" alt="shape_image_not_found">
        </div>
        <?php
    }
    ?>
</section>