<?php
$opt = get_option( 'saasland_opt' );
if ( isset($opt['is_header_sticky']) ) {
    $is_header_sticky = $opt['is_header_sticky'] == '1' ? ' header_stick' : '';
} else {
    $is_header_sticky = ' header_stick';
}
if ( is_page_template( 'page-agency-colorful.php' ) ) {
    $is_header_sticky = '';
}
$header_bg = ' no_bg';
if( isset( $opt['is_header_bg'] ) ){
    $header_bg = $opt['is_header_bg'] == '1' ? ' has_header_bg' : ' no_bg';
}
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
        $nav_layout_start = '<div class="container custom_container">';
        $nav_layout_end = '</div>';
        $nav_layout_header = '';
        break;
    case 'full_width':
        $nav_layout_start = '';
        $nav_layout_header = 'header_area_five nav_full_width';
        $nav_layout_end = '';
        break;
}

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
?>
<header class="header_area  header_stick has_header_bg">
        <nav class="navbar navbar-expand-lg menu_one menu_right">
        <div class="container">        <a class="navbar-brand sticky_logo " href="https://www.whitelotuscorporation.com/">
                            <img class="main_logo_img" src="https://www.whitelotuscorporation.com/wp-content/uploads/2021/02/Whitelotus_Corp_Logo.png" srcset="https://www.whitelotuscorporation.com/wp-content/uploads/2021/02/Whitelotus_Corp_Logo.png 2x" alt="wlcglobal">
                <img class="sticky_logo_img" src="https://www.whitelotuscorporation.com/wp-content/uploads/2021/02/Whitelotus_Corp_Logo.png" srcset="https://www.whitelotuscorporation.com/wp-content/uploads/2021/02/Whitelotus_Corp_Logo.png 2x" alt="wlcglobal">
                        </a>

                    <a class="ubermenu-responsive-toggle ubermenu-responsive-toggle-main ubermenu-skin-black-white-2 ubermenu-loc-main_menu ubermenu-responsive-toggle-content-align-left ubermenu-responsive-toggle-align-full " tabindex="0" data-ubermenu-target="ubermenu-main-2-main_menu-2"><i></i>Menu</a>
<nav id="ubermenu-main-2-main_menu-2" class="ubermenu ubermenu-main ubermenu-menu-2 ubermenu-loc-main_menu ubermenu-responsive ubermenu-responsive-default ubermenu-responsive-collapse ubermenu-horizontal ubermenu-transition-shift ubermenu-trigger-hover ubermenu-skin-black-white-2 ubermenu-has-border ubermenu-bar-align-full ubermenu-items-align-flex ubermenu-bound ubermenu-disable-submenu-scroll ubermenu-sub-indicators ubermenu-retractors-responsive ubermenu-submenu-indicator-closes ubermenu-notouch"><ul id="ubermenu-nav-main-2-main_menu" class="ubermenu-nav" data-title="Main Menu"><li id="menu-item-170" class="ubermenu-item ubermenu-item-type-custom ubermenu-item-object-custom ubermenu-item-has-children ubermenu-item-170 ubermenu-item-level-0 ubermenu-column ubermenu-column-auto ubermenu-has-submenu-drop ubermenu-has-submenu-mega ubermenu-in-transition"><a class="ubermenu-target ubermenu-item-layout-default ubermenu-item-layout-text_only" href="#" tabindex="0"><span class="ubermenu-target-title ubermenu-target-text">Services</span><i class="ubermenu-sub-indicator fas fa-angle-down"></i><span class="ubermenu-sub-indicator-close"><i class="fas fa-times"></i></span></a><ul class="ubermenu-submenu ubermenu-submenu-id-170 ubermenu-submenu-type-auto ubermenu-submenu-type-mega ubermenu-submenu-drop ubermenu-submenu-align-center ubermenu-autoclear" style="left: -442.258px; right: 0px;"><li id="menu-item-171" class="ubermenu-item ubermenu-item-type-custom ubermenu-item-object-custom ubermenu-item-has-children ubermenu-item-171 ubermenu-item-auto ubermenu-item-header ubermenu-item-level-1 ubermenu-column ubermenu-column-1-3 ubermenu-has-submenu-stack"><a class="ubermenu-target ubermenu-item-layout-default ubermenu-item-layout-text_only" href="#"><span class="ubermenu-target-title ubermenu-target-text">A1</span></a><ul class="ubermenu-submenu ubermenu-submenu-id-171 ubermenu-submenu-type-auto ubermenu-submenu-type-stack"><li id="menu-item-145" class="ubermenu-item ubermenu-item-type-custom ubermenu-item-object-custom ubermenu-item-145 ubermenu-item-auto ubermenu-item-normal ubermenu-item-level-2 ubermenu-column ubermenu-column-auto"><a class="ubermenu-target ubermenu-target-with-image ubermenu-item-layout-image_left" href="https://www.whitelotuscorporation.com/ios-app-development/"><img class="ubermenu-image ubermenu-image-size-full" src="https://www.whitelotuscorporation.com/wp-content/uploads/2021/06/iOS-Application-Development.svg" alt="iOS Application Development"><span class="ubermenu-target-title ubermenu-target-text">iOS Application Development</span><span class="ubermenu-target-divider"> – </span><span class="ubermenu-target-description ubermenu-target-text">Build your native iOS Apps with Swift and Obj C</span></a></li><li id="menu-item-144" class="ubermenu-item ubermenu-item-type-custom ubermenu-item-object-custom ubermenu-item-144 ubermenu-item-auto ubermenu-item-normal ubermenu-item-level-2 ubermenu-column ubermenu-column-auto"><a class="ubermenu-target ubermenu-target-with-image ubermenu-item-layout-image_left" href="https://www.whitelotuscorporation.com/android-app-development/"><img class="ubermenu-image ubermenu-image-size-full" src="https://www.whitelotuscorporation.com/wp-content/uploads/2021/06/Android-Application-Development.svg" width="512" height="512" alt="Android Application Development"><span class="ubermenu-target-title ubermenu-target-text">Android App Development</span><span class="ubermenu-target-divider"> – </span><span class="ubermenu-target-description ubermenu-target-text">Native Android development with Java and Kotlin</span></a></li><li id="menu-item-146" class="ubermenu-item ubermenu-item-type-custom ubermenu-item-object-custom ubermenu-item-146 ubermenu-item-auto ubermenu-item-normal ubermenu-item-level-2 ubermenu-column ubermenu-column-auto"><a class="ubermenu-target ubermenu-target-with-image ubermenu-item-layout-image_left" href="https://www.whitelotuscorporation.com/cross-platform-app-development/"><img class="ubermenu-image ubermenu-image-size-full" src="https://www.whitelotuscorporation.com/wp-content/uploads/2021/06/Cross-platform-Application-Development.svg" width="512" height="512" alt="Cross platform Application Development"><span class="ubermenu-target-title ubermenu-target-text">Hybrid App Development</span><span class="ubermenu-target-divider"> – </span><span class="ubermenu-target-description ubermenu-target-text">Cross platform apps using Javascript, HTML5 and Dart</span></a></li></ul></li><li id="menu-item-138" class="ubermenu-item ubermenu-item-type-custom ubermenu-item-object-custom ubermenu-item-has-children ubermenu-item-138 ubermenu-item-auto ubermenu-item-header ubermenu-item-level-1 ubermenu-column ubermenu-column-1-3 ubermenu-has-submenu-stack"><a class="ubermenu-target ubermenu-item-layout-default ubermenu-item-layout-text_only" href="#"><span class="ubermenu-target-title ubermenu-target-text">A2</span></a><ul class="ubermenu-submenu ubermenu-submenu-id-138 ubermenu-submenu-type-auto ubermenu-submenu-type-stack"><li id="menu-item-149" class="ubermenu-item ubermenu-item-type-custom ubermenu-item-object-custom ubermenu-item-149 ubermenu-item-auto ubermenu-item-normal ubermenu-item-level-2 ubermenu-column ubermenu-column-auto"><a class="ubermenu-target ubermenu-target-with-image ubermenu-item-layout-image_left" href="https://www.whitelotuscorporation.com/enterprise-app-development/"><img class="ubermenu-image ubermenu-image-size-full" src="https://www.whitelotuscorporation.com/wp-content/uploads/2021/06/Enterprise-Application-Development.svg" alt="Enterprise Application Development"><span class="ubermenu-target-title ubermenu-target-text">Enterprise App Development</span><span class="ubermenu-target-divider"> – </span><span class="ubermenu-target-description ubermenu-target-text">Transforming your business process digitally</span></a></li><li id="menu-item-148" class="ubermenu-item ubermenu-item-type-custom ubermenu-item-object-custom ubermenu-item-148 ubermenu-item-auto ubermenu-item-normal ubermenu-item-level-2 ubermenu-column ubermenu-column-auto"><a class="ubermenu-target ubermenu-target-with-image ubermenu-item-layout-image_left" href="https://www.whitelotuscorporation.com/web-app-development/"><img class="ubermenu-image ubermenu-image-size-full" src="https://www.whitelotuscorporation.com/wp-content/uploads/2021/06/Web-Application-Development.svg" width="512" height="512" alt="Web Application Development"><span class="ubermenu-target-title ubermenu-target-text">Web App Development</span><span class="ubermenu-target-divider"> – </span><span class="ubermenu-target-description ubermenu-target-text">Offering smooth and secure Web Applications Development</span></a></li><li id="menu-item-147" class="ubermenu-item ubermenu-item-type-custom ubermenu-item-object-custom ubermenu-item-147 ubermenu-item-auto ubermenu-item-normal ubermenu-item-level-2 ubermenu-column ubermenu-column-auto"><a class="ubermenu-target ubermenu-target-with-image ubermenu-item-layout-image_left" href="https://www.whitelotuscorporation.com/ui-ux-product-design/"><img class="ubermenu-image ubermenu-image-size-full" src="https://www.whitelotuscorporation.com/wp-content/uploads/2021/06/UI-X-UX-Design.svg" width="512" height="512" alt="UI X UX Design"><span class="ubermenu-target-title ubermenu-target-text">UI x UX Design</span><span class="ubermenu-target-divider"> – </span><span class="ubermenu-target-description ubermenu-target-text">Great way to kickstart your digital journey with seamless user experience</span></a></li></ul></li><li id="menu-item-139" class="ubermenu-item ubermenu-item-type-custom ubermenu-item-object-custom ubermenu-item-has-children ubermenu-item-139 ubermenu-item-auto ubermenu-item-header ubermenu-item-level-1 ubermenu-column ubermenu-column-1-3 ubermenu-has-submenu-stack"><a class="ubermenu-target ubermenu-item-layout-default ubermenu-item-layout-text_only" href="#"><span class="ubermenu-target-title ubermenu-target-text">A3</span></a><ul class="ubermenu-submenu ubermenu-submenu-id-139 ubermenu-submenu-type-auto ubermenu-submenu-type-stack"><li id="menu-item-172" class="ubermenu-item ubermenu-item-type-custom ubermenu-item-object-ubermenu-custom ubermenu-item-172 ubermenu-item-auto ubermenu-item-normal ubermenu-item-level-2 ubermenu-column ubermenu-column-auto"><div class="ubermenu-content-block ubermenu-custom-content ubermenu-custom-content-padded">

                                <div class="mega-menu-left-img">
                                    <div class="drop-item-tx">
                                        <h5 class="nav-ico-tx">Making IT Extraordinary</h5>
                                        <p class="tx_sm">
                                           At Whitelotus, we mix knowledge and experience to work as a value added product engineering team to design and build your disruptive digital products in an absolutely efficient way. 
                                        </p>
                                        <a href="#" class="btn-white" tabindex="0">#BuildYourNextWithUS</a>
                                    </div>
                                </div>
                            
                            <style type="text/css">
                                                                .mega-menu-left-img {
    background-color: #f7fdfc;
    width: 100%;
    height: 420px;
    
}
.mega-menu-left-img .drop-item-tx {
    text-align: center;
    padding: 50px;
}
.six-menu .drop-item-tx .nav-ico-tx {
    margin-bottom: 0px !important;
}
.mega-menu-left-img .drop-item-tx .nav-ico-tx {
    color: #2C2C51 !important;
    font-size: 25px !important;
    margin-bottom: 0px;
}
.drop-item-tx .nav-ico-tx {
    
    font-weight: 500 !important;
}
.mega-menu-left-img .drop-item-tx {
    text-align: center;
}
h5{
   font-family: inherit !important;
}
.mega-menu-left-img .drop-item-tx .tx_sm {
    color: #606060 !important;
    margin-top: 14px;
    line-height: 24px;
}
 .drop-item-tx .tx_sm {
    font-size: 14px !important;
font-weight: 400;
}
.mega-menu-left-img .drop-item-tx {
    text-align: center;
}
    .mega-menu-left-img .btn-white {
    border: solid 1px #533DB6;
    padding: 10px 30px;
    color: #533DB6;
    margin-top: 25px;
border-radius: 5px;
    display: inline-block;
    font-size: 17px;
    position: relative;
font-weight: 500;
}
.globalNav a {
    text-decoration: none;
    -webkit-tap-highlight-color: transparent;
   
}
.globalNav a {
    transition: color .0s !important;
}
                            </style></div></li></ul></li></ul></li><li id="menu-item-9" class="ubermenu-item ubermenu-item-type-custom ubermenu-item-object-custom ubermenu-item-9 ubermenu-item-level-0 ubermenu-column ubermenu-column-auto"><a class="ubermenu-target ubermenu-item-layout-default ubermenu-item-layout-text_only" href="https://www.whitelotuscorporation.com/partners/" tabindex="0"><span class="ubermenu-target-title ubermenu-target-text">Become a Partner</span></a></li><li id="menu-item-110" class="ubermenu-item ubermenu-item-type-custom ubermenu-item-object-custom ubermenu-item-110 ubermenu-item-level-0 ubermenu-column ubermenu-column-auto"><a class="ubermenu-target ubermenu-item-layout-default ubermenu-item-layout-text_only" href="https://www.whitelotuscorporation.com/solutions/" tabindex="0"><span class="ubermenu-target-title ubermenu-target-text">Solutions</span></a></li></ul></nav>
<!-- End UberMenu -->
        <div class="alter_nav search_exist">
        <ul class="navbar-nav search_cart menu">

                            <li class="nav-item search"><a class="nav-link search-btn" href="javascript:void(0);"><span> ☰</span></a></li>
            
                    </ul>
    </div></div>    </nav>
</header>