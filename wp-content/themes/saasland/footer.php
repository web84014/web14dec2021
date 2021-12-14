<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package saasland
 */

$opt = get_option( 'saasland_opt' );
$copyright_text = isset($opt['copyright_txt']) ? $opt['copyright_txt'] : esc_html__( '© 2021 DroitThemes. All rights reserved', 'saasland' );
$right_content = !empty($opt['right_content']) ? $opt['right_content'] : esc_html__( 'Made with in DroitThemes', 'saasland' );
$footer_visibility = function_exists( 'get_field' ) ? get_field( 'footer_visibility' ) : '1';
$footer_visibility = isset($footer_visibility) ? $footer_visibility : '1';

if( class_exists( 'WooCommerce' ) ){ ?>
    <div id="products_quick_view_wrap" class="modal fade product_compair_modal_wrapper product_compair_modal" tabindex="-1" aria-labelledby="product_compair_modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal_close_header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="ti-close"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="quick_view_product_content" class="popup_details_area">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}

$footer_style = '';
if ( !empty($opt['footer_style']) ) {
    $footer_style = new WP_Query ( array (
        'post_type'       => 'footer',
        'posts_per_page'  => -1,
        'p'               => $opt['footer_style'],
    ));
}

if ( is_404() ) {
    ?>
    <footer>
        <div class="footer_bottom error_footer">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-md-5 col-sm-6">
                        <p class="mb-0 f_400"> <?php echo saasland_kses_post(wpautop($copyright_text)); ?> </p>
                    </div>
                    <div class="col-lg-4 col-md-3 col-sm-6">
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <?php echo saasland_kses_post(wpautop($right_content)) ?>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <?php
}
else {
    if ( $footer_visibility == '1' ) {

        if ( !empty($footer_style) && !\Elementor\Plugin::$instance->preview->is_preview_mode() ) {
            if ( $footer_style->have_posts() ) {
                while ( $footer_style->have_posts() ) : $footer_style->the_post();
                    the_content();
                endwhile;
                wp_reset_postdata();
            }
        } else {
            if ( is_active_sidebar( 'footer_widgets') ) { ?>
                <footer class="new_footer_area bg_color">
                    <div class="new_footer_top">
                        <div class="container">
                            <div class="row">
                                <?php dynamic_sidebar( 'footer_widgets' ) ?>
                            </div>
                        </div>
                        <div class="footer_bg">
                            <?php if (!empty($opt['footer_obj_1']['url'])) : ?>
                                <div class="footer_bg_one"></div>
                            <?php endif; ?>
                            <?php if (!empty($opt['footer_obj_2']['url'])) : ?>
                                <div class="footer_bg_two"></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="footer_bottom">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-lg-6 col-sm-7">
                                    <?php echo saasland_kses_post(wpautop($copyright_text)); ?>
                                </div>
                                <div class="col-lg-6 col-sm-5 text-right">
                                    <?php echo saasland_kses_post(wpautop($right_content)) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
                <?php
            }
        }
    }
    else{
        $specific_footer_id = function_exists( 'get_field' ) ? get_field( 'select_footer_style' ) : '';
        if( !empty( $specific_footer_id ) ) {
            $specific_footer = new WP_Query (array(
                'post_type' => 'footer',
                'posts_per_page' => -1,
                'p' => $specific_footer_id,
            ));

            if ( $specific_footer->have_posts() ) {
                while ( $specific_footer->have_posts() ) : $specific_footer->the_post();
                    the_content();
                endwhile;
                wp_reset_postdata();
            }
        }
    }
}

$is_search = !empty($opt['is_search']) ? $opt['is_search'] : '';
if ( $is_search == '1' ) :
    ?>
<div class="local">
    <form action="<?php echo esc_url(home_url( '/')) ?>" class="search_boxs" role="search">
<!--         <div class="search_box_inner"> -->
            <div class="close_icon">
                <i class="icon_close"></i>
            </div>
            <div class="input-group">
                <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 ab_1">
                <div class="mainMenuItems">
                    <div class="mainMenuItems__content vb vb-visible" style="position: relative; overflow: hidden;">
                        <div class="mainMenu__wrapper mainMenu__wrapper--align-center">
                            <div class="animate fadeInUp one" id="p">
                                <a href="https://www.whitelotuscorporation.com/about-us/" data-cy="works" class="mainMenuItems__item">
                                    <div class="mainMenuItems__title">
                                        <span style="color: #00fa92">About Us</span>
                                    </div>
                                    <div class="mainMenuItems__subtitle">How we are nurtured.</div>
                                </a>
                                <a href="https://www.whitelotuscorporation.com/portfolio/" data-cy="philosophy" class="mainMenuItems__item">
                                    <div class="mainMenuItems__title">
                                        <span style="color: #ff9e14">Portfolio</span>
                                    </div>
                                    <div class="mainMenuItems__subtitle">Have a look at what we've created.</div>
                                </a>
                                <a href="https://www.whitelotuscorporation.com/blog/" data-cy="contacts" class="mainMenuItems__item">
                                    <div class="mainMenuItems__title">
                                        <span style="color: #ff5747">Blog</span>
                                    </div>
                                    <div class="mainMenuItems__subtitle">Read about latest technology and trends.</div>
                                </a>
                                <a href="https://www.whitelotuscorporation.com/contact-us/" data-cy="contacts" class="mainMenuItems__item">
                                    <div class="mainMenuItems__title">
                                        <span style="color: #3f68ff">Contact</span>
                                    </div>
                                    <div class="mainMenuItems__subtitle">Start your project.</div>
                                </a>
                                <div class="mainMenuContacts__title" > Follow Us</div>
                                <div class="row" style="padding-left:10px;">
                                <div class="col-xs-2 col-sm-2 col-md-2"> 
                                    <svg href="https://www.facebook.com/whitelotuscorporation" class="svg-inline--fa fa-facebook-f fa-w-10" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="facebook-f" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg="">
                                        <a href="https://www.facebook.com/whitelotuscorporation" class="ti-facebook" target="_blank"><path fill="currentColor" d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"></path></a>
                                    </svg>
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-2"> 
                                    <svg href="https://twitter.com/whitelotuscorp" class="svg-inline--fa fa-twitter fa-w-16" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="twitter" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                        <a href="https://twitter.com/whitelotuscorp" class="ti-twitter-alt" target="_blank"><path fill="currentColor" d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z">
                                        </path></a>
                                    </svg>
                                </div>
                                
                                <div class="col-xs-2 col-sm-2 col-md-2">
                                    <svg href="https://www.linkedin.com/company/whitelotus-corporation" class="svg-inline--fa fa-linkedin-in fa-w-14" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="linkedin-in" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                                        <a href="https://www.linkedin.com/company/whitelotus-corporation" class="ti-linkedin" target="_blank"><path fill="currentColor" d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8a53.79 53.79 0 0 1 107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9 448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69 76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.3 87.88-48.3 94 0 111.28 61.9 111.28 142.3V448z">
                                        </path></a>
                                    </svg>
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-2">
                                    <svg href="https://www.youtube.com/whitelotuscorp" class="svg-inline--fa fa-youtube fa-w-18" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="youtube" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg="">
                                        <a href="https://www.youtube.com/whitelotuscorp" class="ti-youtube" target="_blank"><path fill="currentColor" d="M549.655 124.083c-6.281-23.65-24.787-42.276-48.284-48.597C458.781 64 288 64 288 64S117.22 64 74.629 75.486c-23.497 6.322-42.003 24.947-48.284 48.597-11.412 42.867-11.412 132.305-11.412 132.305s0 89.438 11.412 132.305c6.281 23.65 24.787 41.5 48.284 47.821C117.22 448 288 448 288 448s170.78 0 213.371-11.486c23.497-6.321 42.003-24.171 48.284-47.821 11.412-42.867 11.412-132.305 11.412-132.305s0-89.438-11.412-132.305zm-317.51 213.508V175.185l142.739 81.205-142.739 81.201z">
                                        </path></a>
                                    </svg>
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-2">
                                    <svg href="https://www.instagram.com/whitelotuscorp/" class="svg-inline--fa fa-instagram fa-w-18" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="instagram" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg="">
                                        <a href="https://www.instagram.com/whitelotuscorp/" class="ti-instagram" target="_blank"><path fill="currentColor" d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"></path></a>
                                    </svg>
                                </div>
                               </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-col-xs-12 col-sm-12 col-md-5 col-lg-5 ab_2">
                <div class="animate fadeInUp one" id="p1">
                <div class="mainMenu__title" style="color:#ffd025">MAKING&nbsp;&nbsp; IT&nbsp;&nbsp; EXTRAORDINARY</div>
                    <div class="mainMenu__subtitle">Since 2012</div>
                        <div class="mainMenu__text"><p>From B2B or B2E apps for enterprises, small businesses, and startups, Whitelotus have worked on all sort of apps for segments like Smart Retail, Financial services, Logistics &amp; Transportation, Smart homes, Healthcare, mCommerce, E-governance, Education, Lifestyle, Utility and much more with a proven track record of creating 150+ result driven and engaging mobile apps on all popular platforms with Native, Cross-Platform, and Web Technologies.</p>
                        </div>
                    <div class="mainMenu__footer">
                        <div class="mainMenu__wrapper">
                            <div class="mainMenuContacts">
                                <div class="mainMenuContacts__item">
                                    <div class="mainMenuContacts__title">Call us</div>
                                    <a href="tel:+17864608841" data-cy="contanctLinkPhone" class="mainMenuContacts__link" style="padding-left:0px;">
                                        <span>+91 - 886-687-8983</span>
                                    </a>
                                </div>
                                <div class="mainMenuContacts__item">
                                    <div class="mainMenuContacts__title">Write us</div>
                                    <a href="mailto:hello@mst.agency" data-cy="contanctLinkEmail" class="mainMenuContacts__link mainMenuContacts__link--underline" style="padding-left: 0px;">
                                        <span>contact@whitelotuscorporation.com</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            </div>
<!--         </div> -->
    </form>
	</div>
    <?php
endif;
?>

</div> <!-- Body Wrapper -->
<?php wp_footer(); ?>
<script type="text/javascript">
    WebFontConfig = {
        google: { families: [ 'Noto+Serif:400,400italic,700,700italic' ] }
    };

    (function() {
        var wf = document.createElement('script');
        wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
        wf.type = 'text/javascript';
        wf.async = 'true';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(wf, s);
    })();
</script>
<!--Add the following script at the bottom of the web page (before </body></html>)-->
<script type="text/javascript">function add_chatinline(){var hccid=93489284;var nt=document.createElement("script");nt.async=true;nt.src="https://www.mylivechat.com/chatinline.aspx?hccid="+hccid;var ct=document.getElementsByTagName("script")[0];ct.parentNode.insertBefore(nt,ct);}
add_chatinline();</script> 
</body>
</html>