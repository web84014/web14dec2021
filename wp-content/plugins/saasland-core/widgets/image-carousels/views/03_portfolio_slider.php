<?php
wp_enqueue_style( 'saasland-demo' );
wp_enqueue_style( 'slick' );
wp_enqueue_script( 'slick' );
?>
<section class="portfolio_area">
    <div class="p_slider_inner">
        <div class="portfolio_slider">
            <?php
            foreach ($images as $image ) {
                ?>
                <div class="p_item">
                    <?php echo wp_get_attachment_image( $image['id'], 'full' ); ?>
                </div>
                <?php
            }
            ?>
        </div>
        <div class="arrow">
            <i class="ti-arrow-left prevs"></i>
            <i class="ti-arrow-right nexts"></i>
        </div>
    </div>
</section>

<script>
    ;(function($){
        "use strict";
        $(document).ready(function () {
            function portfolioSlider() {
                $( '.portfolio_slider' ).slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: true,
                    arrow: true,
                    centerMode: true,
                    centerPadding: '450px',
                    speed: <?php echo !empty($settings['slide_speed']) ? $settings['slide_speed'] : '800'; ?>,
                    autoplay: <?php echo esc_js($is_auto_play) ?>,
                    infinite: <?php echo esc_js($is_loop) ?>,
                    prevArrow: ( '.prevs' ),
                    nextArrow: ( '.nexts' ),
                    responsive: [
                        {
                            breakpoint: 1400,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1,
                                centerPadding: '250px',
                            }
                        },
                        {
                            breakpoint: 1008,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1,
                                centerPadding: '150px',
                            }
                        },
                        {
                            breakpoint: 800,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1,
                                centerPadding: '50px',
                            }
                        }
                    ]
                })
            }
            portfolioSlider();
        }); // End Document.ready
    })(jQuery)
</script>