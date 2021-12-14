<?php
/**
 * The template for displaying 404 pages (not found)
 *
 */
get_header();
$opt = get_option( 'saasland_opt' );
$error_img_select  =!empty($opt['error_img_select']) ?  $opt['error_img_select'] : '1';
$error_heading  =!empty($opt['error_heading']) ?  $opt['error_heading'] : '';
$error_title = !empty($opt['error_title']) ? $opt['error_title'] : esc_html__( 'Page not found', 'saasland' );
$error_title_two = !empty($opt['error2_title']) ? $opt['error2_title'] : esc_html__( 'Error. We can’t ftind the page you’re looking for.', 'saasland' );
$error_subtitle = !empty($opt['error_subtitle']) ? $opt['error_subtitle'] : esc_html__("We can't seem to find the page you're looking for", "saasland");
$error_subtitle_two = !empty($opt['error2_subtitle']) ? $opt['error2_subtitle'] : esc_html__("Sorry for the inconvenience. Go to our homepage or check out our latest collections for Fashion, Chair, Decoration...", "saasland");
$error_home_btn_label  =!empty($opt['error_home_btn_label']) ?  $opt['error_home_btn_label'] : esc_html__( 'Go Back to home Page', 'saasland' );
$error_home_btn_label_two  =!empty($opt['error2_home_btn_label']) ?  $opt['error2_home_btn_label'] : esc_html__( 'Go Back to home Page', 'saasland' );
$error_bg_shape = !empty( $opt['bg_shape']) ? $opt['bg_shape'] : SAASLAND_DIR_IMG.'/banners/banner_bg.png';
$error2_image = !empty( $opt['error2_image']['url']) ? $opt['error2_image']['url'] : SAASLAND_DIR_IMG.'/new/error.png';

if ( $error_img_select == '1' ) : ?>
    <section class="error_area">
        <img class="error_shap" src="<?php echo esc_url($error_bg_shape) ?>" alt="<?php esc_attr_e( '404', 'saasland' ) ?>">
        <div class="container flex">
            <div class="error_contain text-center">
                <div class="b_text">
                    <h1 class="f_p w_color f_700"><?php echo esc_html($error_heading) ?></h1>
                </div>
                <h2 class="f_p f_400 w_color f_size_40"><?php echo esc_html($error_title) ?></h2>
                <p class="w_color f_400"><?php echo esc_html($error_subtitle) ?></p>
                <a href="<?php echo esc_url(home_url( '/')) ?>" class="about_btn btn_hover mt_40">
                    <?php echo esc_html($error_home_btn_label) ?>
                </a>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php if ( $error_img_select == '2' ) : ?>
    <section class="error_two_area">
        <div class="container flex">
            <div class="error_content_two text-center">
                <img src="<?php echo esc_url($error2_image) ?>" alt="<?php esc_attr_e( '404', 'saasland' ) ?>">
                <h2><?php echo esc_html($error_title_two) ?></h2>
                <p><?php echo esc_html($error_subtitle_two) ?></p>
                <form action="<?php echo esc_url(home_url( '/')); ?>" class="search">
                    <input type="text" name="s" class="form-control" placeholder="<?php esc_attr_e( 'Search', 'saasland' ) ?>">
                </form>
                <a href="<?php echo esc_url(home_url( '/')) ?>" class="about_btn btn_hover">
                    <?php echo esc_html($error_home_btn_label_two) ?><i class="arrow_right"></i>
                </a>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php
get_footer();