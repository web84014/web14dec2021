<?php
$opt = get_option('saasland_opt');
$titlebar_align = !empty($opt['titlebar_align']) ? $opt['titlebar_align'] : 'center';
$background_type = function_exists('get_field') ? get_field('banner_background_type') : '';
$background_image = '';
if ( $background_type == 'image' ) {
    $background_image = function_exists('get_field') ? get_field('banner_background_image') : '';
    $background_image = !empty($background_image) ? "style='background: url($background_image); background-size: cover; background-position: center center; background-repeat: no-repeat;'" : '';
    $banner_shape_image = '';
} elseif ( $background_type == 'color' ) {
    $banner_shape_image = function_exists('get_field') ? get_field('banner_shape_image') : '';
    $background_image = '';
}
$portfolio_page_subtitle = isset( $opt['is_portfolio_page_subtitle'] ) ? $opt['is_portfolio_page_subtitle'] : '1';
$services_page_subtitle = isset( $opt['is_service_page_subtitle'] ) ? $opt['is_service_page_subtitle'] : '1';
$casestudy_page_subtitle = isset( $opt['is_casestudy_page_subtitle'] ) ? $opt['is_casestudy_page_subtitle'] : '1';
$team_page_subtitle = isset( $opt['team_archive_subtitle'] ) ? $opt['team_archive_subtitle'] : '1';
?>
<section class="breadcrumb_area " <?php echo wp_kses_post($background_image); ?>>
    <?php
    if ( !empty($banner_shape_image) ) {
        echo wp_get_attachment_image( $banner_shape_image, 'full', false, array('class'=>'breadcrumb_shap') );
    }
    else {
        $default_shape_image = !empty($opt['banner_shape_image']['url']) ? $opt['banner_shape_image']['url'] : SAASLAND_DIR_IMG.'/banners/banner_bg.png';
        echo "<img src='".esc_url($default_shape_image)."' class='breadcrumb_shap' alt='".get_the_title()."'>";
    }
    ?>
    <div class="container">
        <div class="breadcrumb_content text-<?php echo esc_attr($titlebar_align) ?>">
            <h1 class="f_p f_700 f_size_50 w_color l_height50 mb_20">
                <?php saasland_banner_title(); ?>
            </h1>
            <?php
            if( is_singular( 'portfolio' ) ){
                if( $portfolio_page_subtitle == '1' ){
                    saasland_banner_subtitle();
                }
            }
            elseif ( is_singular( 'service' ) ){
                if( $services_page_subtitle == '1' ){
                    saasland_banner_subtitle();
                }
            }
            elseif ( is_singular( 'case_study' ) ){
                if( $casestudy_page_subtitle == '1' ){
                    saasland_banner_subtitle();
                }
            }
                elseif ( is_singular( 'team' ) ){
                if( $team_page_subtitle == '1' ){
                    saasland_banner_subtitle();
                }
            }
            else{
                saasland_banner_subtitle();
            } ?>
        </div>
    </div>
</section>