<section class="get_started_section">
    <div class="container deco_wrap">
        <div class="getstart_content text-center">
            <?php
            $title_tag = !empty( $settings['title_html_tag'] ) ? $settings['title_html_tag'] : 'h2';
            if( !empty( $settings['title'] ) ){
                echo '<'.$title_tag.' class="title_text">'. wp_kses_post( nl2br( $settings['title'] ) ) .'</'.$title_tag.'>';
            }
            if( !empty( $settings['btn_label'] ) ){
                echo '<a href="'. esc_url( $settings['btn_url']['url'] ) .'" class="btn_hover btn_four">'. esc_html( $settings['btn_label'] ) .'</a>';
            }
            ?>
        </div>

        <?php
        if( !empty( $settings['cta_shape_1']['url'] ) ){ ?>
            <div class="deco_image flow_shape_1">
                <img class="layer" src="<?php echo esc_url( $settings['cta_shape_1']['url'] ) ?>" alt="flow_image_not_found" data-depth="0.15">
            </div>
            <?php
        }
        if( !empty( $settings['cta_shape_2']['url'] ) ){ ?>
            <div class="deco_image flow_shape_2">
                <img class="layer" src="<?php echo esc_url( $settings['cta_shape_2']['url'] ) ?>" alt="flow_image_not_found" data-depth="0.2">
            </div>
        <?php
        }

        if( !empty( $settings['cta_shape_3']['url'] ) ){ ?>
            <div class="deco_image shape_1">
                <img data-parallax='{"x": 150, "y": 160, "rotateZ":500}' src="<?php echo esc_url( $settings['cta_shape_3']['url'] ) ?>" alt="shape_image_not_found" data-depth="0.15">
            </div>
        <?php
        }
        if( !empty( $settings['cta_shape_4']['url'] ) ){ ?>
            <div class="deco_image shape_2">
                <img class="layer" data-parallax='{"x": 250, "y": 160, "rotateZ":500}' src="<?php echo esc_url( $settings['cta_shape_4']['url'] ) ?>" alt="shape_image_not_found">
            </div>
        <?php
        }
        if( !empty( $settings['cta_shape_5']['url'] ) ){ ?>
            <div class="deco_image shape_3">
                <img data-parallax='{"x": 250, "y": 160}' src="<?php echo esc_url( $settings['cta_shape_5']['url'] ) ?>" alt="shape_image_not_found" data-depth="0.15">
            </div>
        <?php
        }
        if( !empty( $settings['cta_shape_6']['url'] ) ){ ?>
            <div class="deco_image shape_4">
                <img class="layer" src="<?php echo esc_url( $settings['cta_shape_6']['url'] ) ?>" alt="shape_image_not_found" data-depth="0.2">
            </div>
        <?php
        } ?>
    </div>
</section>
