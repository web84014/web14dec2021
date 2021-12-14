<?php
wp_enqueue_style( 'owl-carousel' );
wp_enqueue_script( 'owl-carousel' );
?>
<section class="feedback_area_two sec_pad">
    <div class="container custom_container">
        <div class="sec_title mb_70 wow fadeInUp" data-wow-delay="0.4s">
            <?php if (!empty($settings['title'])) : ?>
                <h2 class="f_p f_size_40 l_height50 f_500 w_color"> <?php echo wp_kses_post(nl2br($settings['title'])) ?> </h2>
            <?php endif; ?>
            <?php if (!empty($settings['subtitle'])) : ?>
                <p class="f_400 f_size_18 mb-0"> <?php echo wp_kses_post(nl2br($settings['subtitle'])) ?> </p>
            <?php endif; ?>
        </div>
        <div id="fslider_three" class="feedback_slider_two owl-carousel">
            <?php
            foreach ($testimonials as $testimonial) {
                ?>
                <div class="item">
                    <div class="feedback_item feedback_item_two">
                        <div class="feed_back_author">
                            <div class="media">
                                <div class="img">
                                    <?php echo wp_get_attachment_image($testimonial['author_image']['id'], 'saasland_83x88' ) ?>
                                </div>
                                <div class="media-body">
                                    <?php echo (!empty($testimonial['name'])) ? '<h5 class="t_color f_size_15 f_p f_500">'.$testimonial['name'].'</h5>' : ''; ?>
                                    <?php echo (!empty($testimonial['designation'])) ? '<h6 class="f_p f_400">'.$testimonial['designation'].'</h6>' : ''; ?>
                                </div>
                            </div>
                            <div class="ratting">
                                <?php saasland_star_ratting($testimonial['ratting']);  ?>
                            </div>
                        </div>
                        <p class="f_size_15"> <?php echo saasland_kses_post($testimonial['content']) ?> </p>
                        <div class="shap_one"></div>
                        <div class="shap_two"></div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</section>
<script>
    ;(function($){
        "use strict";
        $(document).ready(function () {
            var feedback_sliders_three = $("#fslider_three");
            if ( feedback_sliders_three.length ){
                feedback_sliders_three.owlCarousel({
                    loop:<?php echo esc_js($settings['loop']) ?>,
                    margin:0,
                    items: 2,
                    nav:true,
                    autoplay: false,
                    <?php echo ( is_rtl() ) ? "rtl: true," : ''; ?>
                    smartSpeed: <?php echo esc_js($settings['slide_speed']) ?>,
                    stagePadding: 0,
                    responsiveClass:true,
                    navText: ['<i class="ti-angle-left"></i>','<i class="ti-angle-right"></i>'],
                    responsive:{
                        0:{
                            items:1,
                        },
                        776:{
                            items:2,
                        },
                        1199:{
                            items:3,
                        }
                    },
                })
            }
        })
    })(jQuery)
</script>