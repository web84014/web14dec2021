<?php
wp_enqueue_style( 'saasland-demo' );
wp_enqueue_style( 'slick' );
wp_enqueue_script( 'slick' );
?>
<div class="test_inner">
    <div class="demo_testimonial_slider">
        <?php
        if (!empty($settings['testimonials4'])) {
            foreach ($settings['testimonials4'] as $testimonial) {
                ?>
                <div class="item">
                    <div class="d-flex">
                        <div class="text">
                            <?php
                            echo !empty($testimonial['name']) ? '<h5>' . esc_html($testimonial['name']) . '</h5>' : '';
                            echo !empty($testimonial['designation']) ? '<span>' . esc_html($testimonial['designation']) . '</span>' : '';
                            ?>
                        </div>
                        <div class="ratting">
                            <?php
                            switch ( $testimonial['ratting'] ) {
                                case '1': ?>
                                    <i class="icon_star"></i>
                                    <i class="icon_star_alt"></i>
                                    <i class="icon_star_alt"></i>
                                    <i class="icon_star_alt"></i>
                                    <i class="icon_star_alt"></i>
                                <?php break;
                                case '2': ?>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star_alt"></i>
                                    <i class="icon_star_alt"></i>
                                    <i class="icon_star_alt"></i>
                                    <?php break;
                                case '3': ?>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star_alt"></i>
                                    <i class="icon_star_alt"></i>
                                <?php break;
                                case '4': ?>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star_alt"></i>
                                <?php break;
                                case '5': ?>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                <?php break;
                            }
                            ?>
                        </div>
                    </div>
                    <?php echo (!empty($testimonial['contents'])) ? wpautop($testimonial['contents']) : ''; ?>
                </div>
                <?php
            }
        }
        ?>
    </div>
    <div class="arrow">
        <i class="ti-arrow-left tprevs"></i>
        <i class="ti-arrow-right tnexts"></i>
    </div>
</div>

<script>
    ;(function($){
        "use strict";
        $(document).ready(function () {

            function testi_slider_demo() {
                $( '.demo_testimonial_slider' ).slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: false,
                    arrow: true,
                    centerMode: true,
                    centerPadding: '400px',
                    speed: 1000,
                    autoplay: true,
                    infinite:<?php echo esc_js($settings['loop']) ?>,
                    lazyLoad: 'ondemand',
                    pauseOnHover: true,
                    prevArrow: ( '.tprevs' ),
                    nextArrow: ( '.tnexts' ),
                    responsive: [
                        {
                            breakpoint: 1300,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1,
                                centerPadding: '400px',
                            }
                        },
                        {
                            breakpoint: 1000,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1,
                                centerPadding: '80px',
                            }
                        },
                        {
                            breakpoint: 700,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1,
                                centerPadding: '0px',
                            }
                        }
                    ]
                })
            }
            testi_slider_demo();
        })
    })(jQuery)
</script>