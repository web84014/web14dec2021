<div class="container">
    <div class="agency_testimonial_info support_testimonial_info">
        <div class="testimonial_slider owl-carousel">
            <?php
            if (!empty($testimonials)) {
                foreach ($testimonials as $index => $testimonial) {
                    switch ($index) {
                        case 0:
                            $align_class = 'left';
                            break;
                        case 1:
                            $align_class = 'center';
                            break;
                        case 2:
                            $align_class = 'right';
                            break;
                        default:
                            $align_class = 'left';
                    }
                    ?>
                    <div class="testimonial_item text-center <?php echo esc_attr($align_class) ?>">
                        <?php
                        if( !empty( $testimonial['testimonial_image']['id'] ) ){ ?>
                            <div class="author_img">
                                <?php echo wp_get_attachment_image($testimonial['testimonial_image']['id'], 'saasland_100x100' ) ?>
                            </div>
                            <?php
                        }
                        ?>
                        <div class="author_description">
                            <?php if (!empty($testimonial['name'])) : ?>
                                <h4 class="f_500 t_color3 f_size_18"><?php echo esc_html($testimonial['name']); ?></h4>
                            <?php endif; ?>
                            <?php if (!empty($testimonial['designation'])) : ?>
                                <h6><?php echo esc_html($testimonial['designation']); ?></h6>
                            <?php endif; ?>
                        </div>
                        <?php echo !empty($testimonial['content']) ? wpautop($testimonial['content']) : ''; ?>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</div>
<?php
$carouel_loop   = !empty( $settings['loop'] ) ? $settings['loop'] : 'true';
$autoplay       = !empty( $settings['autoplay'] ) ? $settings['autoplay'] : 'true';
$smartSpeed     = !empty( $settings['slide_speed'] ) ? $settings['slide_speed'] : '2000';
$slideDelay     = !empty( $settings['slide_delay'] ) ? $settings['slide_delay'] : '5000';
?>
<script>
    ;(function($) {
        "use strict";
        $(document).ready(function () {
            function testimonialSlider(){
                var testimonialSlider = $(".testimonial_slider");
                if( testimonialSlider.length ){
                    testimonialSlider.owlCarousel({
                        loop:<?php echo esc_js( $carouel_loop ) ?>,
                        margin:10,
                        items: 1,
                        autoplay: <?php echo esc_js( $autoplay ) ?>,
                        smartSpeed: <?php echo esc_js( $smartSpeed ) ?>,
                        responsiveClass: true,
                        autoplayTimeout: <?php echo esc_js( $slideDelay ) ?>,
                        nav: true,
                        dot: true,
                        <?php echo ( is_rtl() ) ? "rtl: true," : ''; ?>
                        stagePadding: 0,
                        navText: ['<i class="ti-arrow-left"></i>','<i class="ti-arrow-right"></i>'],
                        navContainer: '.agency_testimonial_info'
                    });
                }
            }
            testimonialSlider();
        })
    })(jQuery)
</script>