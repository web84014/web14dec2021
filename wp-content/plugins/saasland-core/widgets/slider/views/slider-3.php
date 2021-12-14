<?php
wp_enqueue_style( 'saasland-style-new' );
wp_enqueue_style( 'splitting' );
wp_enqueue_script( 'splitting' );
wp_enqueue_script( 'slick' );
?>
<section class="gadget_slider_area">
    <?php
    if( is_array( $settings['slider_2_items'] ) ){
        foreach ( $settings['slider_2_items'] as $slider_2_item ){
            $style = '';
            if( $slider_2_item['slider_2_item_bg'] == 'gradient' ){
                $style = !empty( $slider_2_item['slide_background_gradient'] ) ? 'style="background-image:linear-gradient('.$slider_2_item['gradient_angle']['size'].'deg, '.$slider_2_item['slide_bg_gradient_1st'].' 0%, '.$slider_2_item['slide_background_gradient'].' 100%)"' : '';
            }
            ?>
            <div class="slider_item elementor-repeater-item-<?php echo esc_attr(  $slider_2_item['_id'] ) ?>" <?php echo wp_kses_post( $style ) ?>>
                <div class="container">
                    <div class="row height">
                        <div class="col-md-6 d-flex align-items-center">
                            <div class="shop_slider_content">
                                <?php
                                if( !empty( $slider_2_item['slider_2_subtitle'] ) ){ ?>
                                    <h6><span class="line" data-animation="fadeInLeft" data-delay="0.2s"></span><span data-splitting><?php echo esc_html( $slider_2_item['slider_2_subtitle'] ) ?></span></h6>
                                    <?php
                                }
                                if( !empty( $slider_2_item['slider_2_title'] ) ){ ?>
                                    <h3 data-animation="fadeInUp" data-delay="0.5s"><?php echo esc_html( $slider_2_item['slider_2_title'] ) ?></h3>
                                    <?php
                                }
                                if( !empty( $slider_2_item['slider_2_btn_label'] ) ){
                                    echo '<a href="'. esc_url( $slider_2_item['slider_2_btn_url']['url'] ) .'" data-animation="fadeInUp" data-delay="0.7s" class="gadget_btn border_radius_none">'. esc_html( $slider_2_item['slider_2_btn_label'] ) .'</a>';
                                } ?>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex align-items-end">
                            <div class="gadget_slider_img shop_slider_img" data-animation="fadeInRight" data-delay="0.5s">
                                <div class="round" data-animation="zoomIn" data-delay="0.7s"></div>
                                <?php
                                if( !empty( $slider_2_item['slider_2_feature_img']['id'] ) ){
                                    echo wp_get_attachment_image( $slider_2_item['slider_2_feature_img']['id'], 'full' );
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
    }
    ?>
</section>

<script>
    ;(function($){
        "use strict";
        $(document).ready(function () {
            /*----------------------------------------------------------------------------
            Home Gadget Slider
            ---------------------------------------------------------------------------*/
            var gadget_slider_area = $(".gadget_slider_area");

            gadget_slider_area.on("init", function (e, slick) {
                var $firstAnimatingElements = $("div.slider_item:first-child").find(
                    "[data-animation]"
                );
                doAnimations($firstAnimatingElements);
            });
            gadget_slider_area.on("beforeChange", function (
                e,
                slick,
                currentSlide,
                nextSlide
            ) {
                var $animatingElements = $(
                    'div.slider_item[data-slick-index="' + nextSlide + '"]'
                ).find("[data-animation]");
                doAnimations($animatingElements);
            });

            if (gadget_slider_area.length > 0) {
                gadget_slider_area.slick({
                    autoplay: true,
                    autoplaySpeed: 5000,
                    dots: true,
                    fade: true,
                    rows: false,
                    arrows: false,
                    rtl: <?php echo !is_rtl() ? 'false' : 'true'; ?>,
                });
            }
            function doAnimations(elements) {
                var animationEndEvents =
                    "webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend";
                elements.each(function () {
                    var $this = $(this);
                    var $animationDelay = $this.data("delay");
                    var $animationType = "animated " + $this.data("animation");
                    $this.css({
                        "animation-delay": $animationDelay,
                        "-webkit-animation-delay": $animationDelay,
                    });
                    $this.addClass($animationType).one(animationEndEvents, function () {
                        $this.removeClass($animationType);
                    });
                });
            }


            /*---------  SPLITTING TEXT -----------*/
            if ($(".gadget_slider_area").length) {
                Splitting();
            }
        })
    })(jQuery)
</script>