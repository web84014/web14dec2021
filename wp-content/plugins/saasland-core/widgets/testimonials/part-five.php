<?php
wp_enqueue_style( 'saasland-digital-agency' );
?>
<section class="testimonial_section has_shape_bg" data-background="img/digital-agency/team/bg_01.png">
    <div class="container">
        <div class="agency_testimonial_carousel owl-carousel owl-theme">
            <?php
            if( is_array( $testimonials ) ){
                $dot_number = 1;
                foreach ( $testimonials as $testimonial ) { ?>
                    <div class="testimonia_list_layout item d-flex align-items-center clearfix" data-dot="<button role='button' class='owl-dot'>0<?php echo esc_html( $dot_number++ )?>.</button>">
                        <div class="member_image">
                            <?php
                            if( !empty( $testimonial['testimonial_image']['url'] ) ){ ?>
                                <div class="man_image">
                                    <?php echo '<img class="layer" src="'. esc_url( $testimonial['testimonial_image']['url'] ) .'" alt="image_not_found">' ?>
                                </div>
                                <?php
                            }
                            if( !empty( $settings['shape_1']['url'] ) ){ ?>
                                <div class="flow_1">
                                    <img class="layer" src="<?php echo esc_url( $settings['shape_1']['url'] ) ?>" alt="shape_not_found">
                                </div>
                                <?php
                            }
                            if( !empty( $settings['shape_2']['url'] ) ){ ?>
                                <div class="flow_2">
                                    <img class="layer" src="<?php echo esc_url( $settings['shape_2']['url'] ) ?>" alt="shape_not_found">
                                </div>
                                <?php
                            }
                            ?>
                        </div>

                        <div class="member_content">
                            <?php
                            if( !empty( $settings['shape_3']['url'] ) ){
                                echo '<img class="quote_icon" src="'. esc_url( $settings['shape_3']['url'] ) .'" alt="">';
                            }

                            if( !empty( $testimonial['name'] ) ){
                                echo '<h3 class="member_name"><a href="#!">'. esc_html( $testimonial['name'] ) .'</a></h3>';
                            }
                            if( !empty( $testimonial['designation'] ) ){
                                echo '<span class="member_title">'. esc_html( $testimonial['designation'] ) .'</span>';
                            }

                            if( !empty( $settings['shape_4']['url'] ) ){ ?>
                                <div class="flow_shape">
                                    <?php echo '<img src="'. esc_url( $settings['shape_4']['url'] ) .'" alt="shape_not_found">' ?>
                                </div>
                                <?php
                            }

                            if( !empty( $testimonial['content'] ) ){
                                echo '<p class="mb-0">'. esc_html( $testimonial['content'] ) .'</p>';
                            }
                            ?>
                        </div>
                    </div>
                <?php
                }
            }
            ?>
        </div>
    </div>
</section>
<script>
    ;(function($) {
        "use strict";
        $(document).ready(function () {
            $('.agency_testimonial_carousel').owlCarousel({
                items:1,
                margin:30,
                nav:false,
                dots:true,
                loop:true,
                dotsData:true,
                autoplay:true,
                smartSpeed:1000,
                autoplayTimeout:5000,
                autoplayHoverPause:true
            });
        })
    })(jQuery)
</script>