<section class="app_testimonial_area">
    <div class="text_shadow" <?php  echo (!empty($settings['bg_title'])) ? 'data-line="'.esc_attr($settings['bg_title']).'"></div>' : ''; ?>
    <div class="container nav_container">
        <div class="shap one"></div>
        <div class="shap two"></div>
        <div class="app_testimonial_slider owl-carousel">
            <?php
            if (!empty($testimonials)) {
                unset($testimonial);
                foreach ($testimonials as $testimonial) {
                    ?>
                    <div class="app_testimonial_item text-center">
                        <div class="author-img">
                            <?php echo wp_get_attachment_image($testimonial['testimonial_image']['id'], 'saasland_100x100' ) ?>
                        </div>
                        <div class="author_info">
                            <?php if (!empty($testimonial['name'])) : ?>
                                <h6 class="f_p f_500 f_size_18 t_color3 mb-0"> <?php echo esc_html($testimonial['name']); ?> </h6>
                            <?php endif; ?>
                            <?php echo !empty($testimonial['designation']) ? wpautop($testimonial['designation']) : ''; ?>
                        </div>
                        <p class="f_300"> <?php echo wp_kses_post($testimonial['content']) ?> </p>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</section>
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
            function app_testimonialSlider() {
                var app_testimonialSlider = $(".app_testimonial_slider");
                if (app_testimonialSlider.length) {
                    app_testimonialSlider.owlCarousel({
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
                        navContainer: '.nav_container'
                    });
                }
            }
            app_testimonialSlider();

        })
    })(jQuery)
</script>