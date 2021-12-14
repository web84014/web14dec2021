<?php
$opt = get_option( 'saasland_opt' );
/**
 * Menu Alignment
 */
$menu_alignment = !empty($opt['menu_alignment']) ? $opt['menu_alignment'] : 'menu_right';
if ( !empty($_GET['menu_align']) ) {
    $menu_alignment = $_GET['menu_align'];
}
switch ( $menu_alignment ) {
    case 'menu_right':
        $nav_alignment = 'navbar navbar-expand-lg menu_one menu_right';
        $ul_class = ' ml-auto';
        $menu_container = '';
        break;
    case 'menu_left':
        $nav_alignment = 'navbar navbar-expand-lg menu_one menu_four menu_left';
        $ul_class = ' pl_120';
        $menu_container = '';
        break;
    case 'menu_center':
        $nav_alignment = 'navbar navbar-expand-lg menu_center';
        $menu_container = 'justify-content-center';
        $ul_class = ' ml-auto mr-auto';
        break;
}

if ( has_nav_menu('main_menu') ) : ?>
    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle navigation', 'saasland') ?>">
        <span class="menu_toggle">
            <span class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </span>
            <span class="hamburger-cross">
                <span></span>
                <span></span>
            </span>
        </span>
    </button>
<?php endif; ?>


	<?php if(function_exists('ubermenu')): ?>
	<?php ubermenu( 'main' , array( 'theme_location' => 'main_menu' ) ); ?>
	<?php else: ?>
    <?php
    if ( has_nav_menu('main_menu') ) {
        wp_nav_menu(array(
            'menu' => 'main_menu',
            'theme_location' => 'main_menu',
            'container' => null,
            'menu_class' => 'navbar-nav menu ' . $ul_class,
            'walker' => new Saasland_Nav_Navwalker(),
            'depth' => 5
        ));
    }
    get_template_part('template-parts/header_elements/buttons');
    ?>
	<?php endif; ?>
