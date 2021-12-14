<section class="feedback_area dk_bg_one sec_pad">
    <div class="container custom_container">
        <div class="sec_title text-center mb_70 wow fadeInUp" data-wow-delay="0.4s">
            <?php if (!empty($settings['title'])) : ?>
            <<?php echo $title_tag; ?> class="f_p f_size_30 l_height50 f_600 w_color">
            <?php echo wp_kses_post(nl2br($settings['title'])) ?>
        </<?php echo $title_tag; ?>>
        <?php endif; ?>
        <?php if (!empty($settings['desc'])) : ?>
            <p class="f_300 f_size_16 mb-0 d_p_color">
                <?php echo wp_kses_post(nl2br($settings['desc'])) ?>
            </p>
        <?php endif; ?>
    </div>
    <div class="feedback_slider owl-carousel">
        <?php
        if (!empty($testimonials2)) {
            unset($testimonial);
            foreach ($testimonials2 as $testimonial) {
                ?>
                <div class="item">
                    <div class="feedback_item">
                        <div class="feed_back_author">
                            <div class="media">
                                <div class="img">
                                    <?php echo wp_get_attachment_image($testimonial['testimonial_image']['id'], 'saasland_85x90' ) ?>
                                </div>
                                <div class="media-body">
                                    <?php if (!empty($testimonial['name'])) : ?>
                                        <h5 class="w_color f_size_15 f_p f_500"> <?php echo esc_html($testimonial['name']); ?> </h5>
                                    <?php endif; ?>
                                    <?php echo !empty($testimonial['designation']) ? '<h6 class="f_p f_300">'.esc_html($testimonial['designation']).'</h6>' : ''; ?>
                                </div>
                            </div>
                        </div>
                        <?php if (!empty($testimonial['content'])) : ?>
                            <p class="d_p_color f_size_15">
                                <?php echo wp_kses_post($testimonial['content']) ?>
                            </p>
                        <?php endif; ?>
                        <a href="#" class="post_date"> <?php echo $testimonial['date'] ?> </a>
                        <div class="shap_one"></div>
                        <div class="shap_two"></div>
                    </div>
                </div>
                <?php
            }}
        ?>
    </div>
    </div>
</section>
<?php
if( \Elementor\Plugin::$instance->editor->is_edit_mode() === true  ) {
    ?>
    <script>
        ( function( $ ){
            function feedbackSlider(){
                var feedback_slider = $(".feedback_slider");
                if( feedback_slider.length ){
                    feedback_slider.owlCarousel({
                        loop:true,
                        margin:20,
                        items: 3,
                        nav:false,
                        center: true,
                        autoplay: false,
                        smartSpeed: 2000,
                        stagePadding: 0,
                        responsiveClass:true,
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
                    });
                }
            }
            feedbackSlider();

        })(jQuery);
    </script>
    <?php
}