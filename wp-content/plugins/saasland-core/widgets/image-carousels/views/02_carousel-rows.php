<?php
wp_enqueue_style( 'slick' );
wp_enqueue_script( 'slick' );

?>
<section class="slider_demos_area">
    <div class="slick marquee">
        <?php
        foreach ( $settings['carousel_rows'] as $carousel_row ) {
            ?>
            <div class="slick-slide">
                <div class="inner">
                    <?php
                    foreach ( $carousel_row['images'] as $image ) {
                        echo wp_get_attachment_image($image['id'], 'full');
                    }
                    ?>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</section>

<script>
    ;(function($){
        "use strict";
        $(document).ready(function () {
            $( '.slick.marquee' ).slick({
                speed: <?php echo !empty($settings['slide_speed']) ? $settings['slide_speed'] : '800'; ?>,
                autoplay: <?php echo esc_js($is_auto_play) ?>,
                <?php echo $autoplay_speed; ?>
                infinite: <?php echo esc_js($is_loop) ?>,
                centerMode: true,
                cssEase: 'linear',
                slidesToShow: 1,
                slidesToScroll: 1,
                variableWidth: true,
                initialSlide: 1,
                arrows: false,
                pauseOnHover:true,
                buttons: false
            });
        }); // End Document.ready
    })(jQuery)
</script>