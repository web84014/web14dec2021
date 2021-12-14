<?php
wp_enqueue_style( 'owl-carousel' );
wp_enqueue_script( 'owl-carousel' );
?>
<section class="erp_testimonial_area sec_pad">
    <div class="container">
        <?php if (!empty($settings['title'])) : ?>
            <div class="hosting_title erp_title text-center">
                <h2><?php echo wp_kses_post(nl2br($settings['title'])) ?></h2>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="erp_testimonial_info owl-carousel">

                <?php
                if ( !empty( $settings['testimonials3'] ) ) {
                    foreach ( $settings['testimonials3'] as $testimonial ) {
                        ?>
                        <div class="erp_testimonial_item">
                            <div class="content">
                                <?php echo ( !empty($testimonial['contents'] ) ) ? wpautop( $testimonial['contents'] ) : ''; ?>
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
                            <div class="media">
                                <?php if ( !empty( $testimonial['author_image']['url'] ) ) : ?>
                                    <img src="<?php echo esc_url( $testimonial['author_image']['url'] ) ?>" alt="<?php echo esc_attr( $testimonial['name'] ) ?>">
                                <?php endif; ?>
                                <div class="media-body">
                                    <?php if ( !empty( $testimonial['name'] ) ) : ?>
                                        <h5><?php echo wp_kses_post( $testimonial['name'] ) ?></h5>
                                    <?php endif; ?>
                                    <?php echo ( !empty( $testimonial['designation'] ) ) ? wpautop( $testimonial['designation'] ) : ''; ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>

            </div>
        </div>
        <?php if ( !empty( $settings['btn_label'] ) ) : ?>
            <div class="text-center">
                <a href="<?php echo esc_url( $settings['btn_url']['url'] ) ?>" class="er_btn"
                    <?php saasland_is_external( $settings['btn_url'] ) ?>>
                    <?php echo esc_html( $settings['btn_label'] ) ?>
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>

<script>
    ;(function($){
        "use strict";
        $(document).ready(function () {

            function erpTestimonial(){
                var erpT = $(".erp_testimonial_info");
                if ( erpT.length ){
                    erpT.owlCarousel({
                        loop:<?php echo esc_js($settings['loop']) ?>,
                        margin:0,
                        items: 2,
                        nav:true,
                        <?php echo ( is_rtl() ) ? "rtl: true," : ''; ?>
                        dots: false,
                        autoplay: false,
                        smartSpeed: <?php echo esc_js($settings['slide_speed']) ?>,
                        stagePadding: 0,
                        responsiveClass:true,
                        navText: ['<i class="arrow_left"></i>','<i class="arrow_right"></i>'],
                        responsive:{
                            0:{
                                items:1,
                            },
                            776:{
                                items:2,
                            },
                            1199:{
                                items:2,
                            }
                        },
                    })
                }
            }
            erpTestimonial();

        })
    })(jQuery)
</script>
