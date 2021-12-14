<?php
wp_enqueue_style( 'slick' );
wp_enqueue_script( 'slick' );
?>
<section class="blog_area">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5">
                <div class="u_content">
                    <?php
                    echo !empty( $settings['upper_title'] ) ? '<h3>' . esc_html( $settings['upper_title'] ) . '</h3>' : '';
                    echo !empty( $settings['title_text'] ) ? '<h2>' . esc_html( $settings['title_text'] ) . '</h2>' : '';
                    echo !empty( $settings['subtitle_text'] ) ? wpautop( $settings['subtitle_text'] ) : '';
                    ?>
                    <div class="arrow">
                        <i class="ti-arrow-left prev"></i>
                        <i class="ti-arrow-right next"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="blog_slider">
                    <?php
                    if ( !empty( $settings['carousels6'] ) ) {
                        foreach ( $settings['carousels6'] as $carousel ) {
                            ?>
                            <div class="item">
                                <?php if ( !empty( $carousel['img_badge'] ) ) : ?>
                                    <div class="round">
                                        <div class="text"><?php echo wp_kses_post( $carousel['img_badge'] ) ?></div>
                                    </div>
                                    <?php
                                endif;
                                if ( !empty($carousel['image1']['id']) ) {
                                    echo '<div class="img">';
                                    echo wp_get_attachment_image($carousel['image1']['id'], 'full', '');
                                    echo '</div>';
                                }
                                if ( !empty($carousel['image2']['id']) ) {
                                    echo '<div class="img_two">';
                                    echo wp_get_attachment_image($carousel['image2']['id'], 'full', '');
                                    echo '</div>';
                                }
                                ?>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    ;(function($){
        "use strict";
        $(document).ready(function () {
            function BlogSlider(){
                $( '.blog_slider' ).slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: false,
                    arrow: false,
                    cssEase: 'linear',
                    fade: true,
                    speed: <?php echo !empty($settings['slide_speed']) ? $settings['slide_speed'] : '800'; ?>,
                    autoplay: <?php echo esc_js($is_auto_play) ?>,
                    <?php echo $autoplay_speed; ?>
                    infinite: <?php echo esc_js($is_loop) ?>,
                    prevArrow: ( '.prev' ),
                    nextArrow: ( '.next' ),
                })
            }
            BlogSlider();
        }); // End Document.ready
    })(jQuery)
</script>