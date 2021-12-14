<?php
$opt = get_option('saasland_opt');
wp_enqueue_style( 'saasland-overlay-menu' );

/**
 * Header Nav-bar Layout
 */
$page_header_layout = function_exists( 'get_field' ) ? get_field( 'header_layout' ) : '';

if ( !empty($page_header_layout) && $page_header_layout != 'default' ) {
    $nav_layout = $page_header_layout;
} elseif ( !empty($_GET['menu']) ) {
    $nav_layout = $_GET['menu'];
} else {
    $nav_layout = !empty($opt['nav_layout']) ? $opt['nav_layout'] : '';
}
$nav_layout_header = '';
$nav_layout_start = '<div class="container">';
$nav_layout_end = '</div>';
switch ( $nav_layout ) {
    case 'boxed':
        $nav_layout_start = '<div class="container">';
        $nav_layout_end = '</div>';
        $nav_layout_header = '';
        break;
    case 'wide':
        $nav_layout_start = '<div class="container custom_container split_page_header">';
        $nav_layout_end = '</div>';
        $nav_layout_header = '';
        break;
    case 'full_width':
        $nav_layout_start = '';
        $nav_layout_header = 'header_area_five nav_full_width';
        $nav_layout_end = '';
        break;
}

if ( isset($opt['is_header_sticky']) ) {
    $is_header_sticky = $opt['is_header_sticky'] == '1' ? ' header_stick' : '';
} else {
    $is_header_sticky = ' header_stick';
}
if ( is_page_template( 'page-agency-colorful.php' ) ) {
    $is_header_sticky = '';
}
?>
<header class="full_header header_area <?php echo esc_attr($nav_layout_header.$is_header_sticky); ?>">
    <?php echo wp_kses_post($nav_layout_start); ?>
        <div class="float-left">
           <?php saasland_helper()->logo(); ?>
        </div>
        <?php
        if ( has_nav_menu( 'overlay_menu' ) ) :
            ?>
            <div class="float-right">
                <div class="bar_menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <?php
        endif;
        ?>
    <?php echo wp_kses_post($nav_layout_end); ?>
</header>

<?php
if ( has_nav_menu( 'overlay_menu' ) ) :
    ?>
    <div class="hamburger-menu-wrepper" id="menu">
        <div class="animation-box">
            <i class="icon_close close_icon"></i>
            <div class="menu-box d-table navbar">
                <?php
                wp_nav_menu ( array (
                    'menu' => 'overlay_menu',
                    'theme_location' => 'overlay_menu',
                    'container' => null,
                    'menu_class' => 'navbar-nav justify-content-end menu offcanfas_menu',
                    'walker' => new Saasland_Overlay_Nav(),
                    'depth' => 3
                ));
                if ( $opt['is_omenu_footer'] == '1' ) : ?>
                    <div class="header_footer">
                        <?php if ( !empty($opt['omenu_btm_title']) ) : ?>
                            <h5> <?php echo wp_kses_post($opt['omenu_btm_title']) ?> </h5>
                        <?php endif; ?>
                        <ul class="list-unstyled">
                            <?php saasland_social_links() ?>
                        </ul>
                        <?php echo !empty($opt['omenu_btm_content']) ? wp_kses_post(wpautop($opt['omenu_btm_content'])) : ''; ?>
                    </div>
                <?php
                endif;
                ?>
            </div>
        </div>
    </div>
    <?php
endif;