<?php
wp_enqueue_script('slick');
?>

<section class="gadget_features_area">
    <div class="row gadget_features_slider">
        <?php
        if( is_array( $settings['selected_products'] ) ){
            foreach ( $settings['selected_products'] as $cat_item ){
                $term = get_term_by( 'slug', $cat_item['selected_id'], 'product_cat' );
                $bg_style = !empty( $cat_item['product_carousel_bg_color2'] ) ? 'style="background-image: linear-gradient(95deg, '.$cat_item['product_carousel_bg_color1'].' 0%, '.$cat_item['product_carousel_bg_color2'].' 100%)"' : '';
                ?>
                <div class="item col-lg-12 elementor-repeater-item-<?php echo esc_attr(  $cat_item['_id'] ) ?>">
                    <div class="gadget_features_item" <?php echo wp_kses_post( $bg_style ) ?>>
                        <div class="content">
                            <?php
                            if( !empty( $cat_item['product_item_subtitle'] ) ){
                                echo '<h6>'. esc_html( $cat_item['product_item_subtitle'] ) .'</h6>';
                            }
                            if( !empty( $cat_item['product_item_title'] ) ){
                                echo '<h3>'. esc_html( $cat_item['product_item_title'] ) .'</h3>';
                            }
                            if( !empty( $term ) ){ ?>
                                <div class="text"><?php echo esc_html($term->name)?></div>
                                <a href="<?php echo esc_url( esc_url( get_term_link( $term->term_id ) ) ) ?>" class="see_btn"><?php echo esc_html( $cat_item['see_more_label'] )?></a>
                                <?php
                            }
                            ?>

                        </div>
                        <?php
                        if( !empty( $cat_item['product_featured_img']['id'] ) ){
                            echo wp_get_attachment_image( $cat_item['product_featured_img']['id'], 'full', '', array( 'class'=>'img' ) );
                        }
                        ?>
                    </div>
                </div>
            <?php
            }
        }
        ?>
    </div>
</section>
<script>
    ;(function($){
        "use strict";
        $(document).ready(function () {
            if ($(".gadget_features_slider").length > 0) {
                $(".gadget_features_slider").slick({
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 2000,
                    dots: false,
                    rtl: <?php echo !is_rtl() ? 'false' : 'true'; ?>,
                    centerMode:true,
                    centerPadding: "300px",
                    rows: false,
                    arrows: false,
                    responsive: [
                        {
                            breakpoint: 1200,
                            settings: {
                                centerPadding: "60px",
                            },
                        },
                        {
                            breakpoint: 991,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1,
                                centerPadding: "170px",
                            },
                        },
                        {
                            breakpoint: 767,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1,
                                centerPadding: "70px",
                            },
                        },
                        {
                            breakpoint: 576,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1,
                                centerMode:false,
                                centerPadding: "15px",
                            },
                        },
                    ],
                });
            }
        })
    })(jQuery)
</script>
