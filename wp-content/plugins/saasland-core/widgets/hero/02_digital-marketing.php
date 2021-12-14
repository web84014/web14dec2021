<section class="agency_banner_area">
    <img class="banner_shap" src="<?php echo esc_url($settings['bg_image_stl2']['url']) ?>" alt="<?php echo esc_attr($settings['title']) ?>">
    <div class="container custom_container">
        <div class="row">
            <div class="col-lg-5 d-flex align-items-center">
                <div class="agency_content">
                    <?php if (!empty($settings['title'])) : ?>
                        <<?php echo $title_tag; ?> class="typewrite_title f_700 t_color3 mb_40 wow fadeInLeft" data-wow-delay="0.3s"><?php echo saasland_hero_title($settings['title']); ?></<?php echo $title_tag; ?>>
                    <?php endif; ?>
                    <?php if (!empty($settings['subtitle'])) : ?>
                        <p class="f_300 l_height28 wow fadeInLeft" data-wow-delay="0.4s">
                            <?php echo wp_kses_post(nl2br($settings['subtitle'])) ?>
                        </p>
                    <?php endif; ?>
                <div class="action_btn d-flex align-items-center mt_60">
                    <?php
                    $i = 0;
                    foreach ($buttons as $button) {
                        ++$i;
                        $strip_class = ($i % 2 == 1) ? 'btn_hover agency_banner_btn' : 'agency_banner_btn_two';
                        $strip_anim = ($i % 2 == 1) ? '0.5' : '0.7';
                        echo "<a " .
                            "href='{$button['btn_url']['url']}' " .
                            "data-wow-delay='".$strip_anim."s'" .
                            "class='$strip_class wow fadeInLeft elementor-repeater-item-{$button['_id']}'> " .
                            "{$button['btn_title']} " .
                            "</a>";
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-lg-7 text-right">
            <?php
            if ( !empty($settings['fimage1']['id'] ) ) {
                echo wp_get_attachment_image($settings['fimage1']['id'], 'full', array( 'class' => 'protype_img wow fadeInRight', 'data-wow-delay' => '0.3s'));
            }
            ?>
        </div>
    </div>
    <div class="partner_logo">
        <?php
        if (!empty($settings['logos'])) :
            $i = 0.2;
            foreach ($settings['logos'] as $icon) {
                ?> <div class="p_logo_item wow fadeInLeft" data-wow-delay="<?php echo esc_attr($i) ?>s"> <?php
                    echo '<a href="#"> '.wp_get_attachment_image($icon['id'], 'full' ).' </a>';
                    ?> </div> <?php
                $i = $i + 0.1;
            }
        endif;
        ?>
    </div>
</section>

<?php
saasland_typed_words_js( $settings['title'] );