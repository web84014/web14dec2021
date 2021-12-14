<?php

// Navbar styling
Redux::setSection( 'saasland_opt', array(
    'title'            => esc_html__( 'Menu', 'saasland' ),
    'id'               => 'menu_opt',
    'icon'             => 'el el-lines',
));

/**
 * Main Menu styling
 */
Redux::setSection( 'saasland_opt', array(
    'title'            => esc_html__( 'Classic Menu', 'saasland' ),
    'id'               => 'main_menu_opt',
    'icon'             => '',
    'subsection'       => true,
    'fields'           => array(
        array(
            'id'            => 'menu_typo',
            'type'          => 'typography',
            'title'         => esc_html__( 'Menu Typography', 'saasland' ),
            'subtitle'      => esc_html__( 'Menu item typography options', 'saasland' ),
            'color'         => false,
            'output'        => array('.header_area .navbar .navbar-nav .menu-item a,
                                .menu > .nav-item.submenu .dropdown-menu .nav-item .nav-link' )
        ),

        array(
            'id'            => 'thumb_mega_menu_typo',
            'type'          => 'typography',
            'title'         => esc_html__( 'Thumbnail Mega Menu Typography', 'saasland' ),
            'subtitle'      => esc_html__( 'Typography options for Thumbnail mega menu.', 'saasland' ),
            'output'        => array( '.menu > .nav-item.submenu.mega_menu.mega_menu_two .mega_menu_inner .dropdown-menu .nav-item .item .text' )
        ),

        array(
            'title'         => esc_html__( 'Menu Item Color', 'saasland' ),
            'subtitle'      => esc_html__( 'This is the menu item font color. Also this color will apply on the mobile menu hamburger icon in order to keep the color consistency.', 'saasland' ),
            'id'            => 'menu_font_color',
            'type'          => 'color',
            'output'        => array (
                'color'      => '.header_area .navbar .navbar-nav .menu-item a',
                'background' => '.navbar .search_cart .search a.nav-link:before, .menu_toggle .hamburger span, .menu_toggle .hamburger-cross span',
            ),
        ),

        array(
            'title'     => esc_html__( 'Active/Hover Color', 'saasland' ),
            'subtitle'  => esc_html__( 'Menu item\'s font color on active and hover stats.', 'saasland' ),
            'id'        => 'menu_active_font_color',
            'output'    => array(
                'color' => '.header_area .navbar .navbar-nav .menu-item a:hover, .header_area .menu > .nav-item.active .nav-link',
            ),
            'type'      => 'color',
        ),

        array(
            'title'     => esc_html__( 'Active/Hover Border Color', 'saasland' ),
            'subtitle'  => esc_html__( 'Menu item\'s border bottom color on active and hover stats.', 'saasland' ),
            'id'        => 'menu_item_active_bb_color',
            'output'    => array(
                'background' => '.menu > .nav-item > .nav-link:before',
            ),
            'type'      => 'color',
        ),

        array(
            'title'     => esc_html__( 'Menu item padding', 'saasland' ),
            'subtitle'  => esc_html__( 'Padding around menu item. Default is 35px 0px 35px 0px. You can reduce the top and bottom padding to make the menu bar height smaller.', 'saasland' ),
            'id'        => 'menu_item_padding',
            'type'      => 'spacing',
            'output'    => array( '.menu > .nav-item' ),
            'mode'      => 'padding',
            'units'     => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
            'units_extended' => 'true',
        ),

        array(
            'title'     => esc_html__( 'Menu item margin', 'saasland' ),
            'subtitle'  => esc_html__( 'Margin around menu item.', 'saasland' ),
            'id'        => 'menu_item_margin',
            'type'      => 'spacing',
            'output'    => array( '.header_area .navbar .navbar-nav .menu-item' ),
            'mode'      => 'margin',
            'units'     => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
            'units_extended' => 'true',
        ),
        array(
            'title'         => esc_html__( 'Dropdown Menu Item Color', 'saasland' ),
            'id'            => 'dropdown_menu_font_color',
            'type'          => 'color',
            'output'        => array (
                'color'      => '.menu>.nav-item.submenu .dropdown-menu .nav-item .nav-link, .dropdown-menu span.arrow_carrot-right',
            ),
        ),
        array(
            'title'         => esc_html__( 'Dropdown Menu Active Color', 'saasland' ),
            'id'            => 'dropdown_menu_active_color',
            'type'          => 'color',
            'output'        => array (
                'color'      => '.menu>.nav-item.submenu .dropdown-menu .nav-item .nav-link:hover,.menu>.nav-item.submenu .dropdown-menu .nav-item:hover>.nav-link,
                 .menu>.nav-item.submenu .dropdown-menu .nav-item.active>.nav-link, .menu>.nav-item.submenu .dropdown-menu .nav-item:hover>.nav-link span',
            ),
        ),

        // Search cart icons settings
        array(
            'id' => 'menu_icons_start',
            'type' => 'section',
            'title' => esc_html__( 'Search & Cart Icons', 'saasland' ),
            'indent' => true
        ),
        array(
            'title'         => esc_html__( 'Icon Color', 'saasland' ),
            'subtitle'      => esc_html__( 'Search & Cart icon color. We provide a single option for changing both icons for keeping color consistency.', 'saasland' ),
            'id'            => 'menu_icons_color',
            'type'          => 'color',
            'output'        => array (
                'color'      => '.navbar .search_cart .search a.nav-link i, .navbar .search_cart .shpping-cart i',
                'background' => '.navbar .search_cart .shpping-cart .num',
            ),
        ),
        array(
            'title'         => esc_html__( 'Text Color', 'saasland' ),
            'subtitle'      => esc_html__( 'Shopping cart product count text color', 'saasland' ),
            'id'            => 'count_text_color',
            'type'          => 'color',
            'output'        => array (
                'color'      => '.navbar .search_cart .shpping-cart .num',
            ),
        ),
        array(
            'title'         => esc_html__( 'Sticky Header Icon Color', 'saasland' ),
            'subtitle'      => esc_html__( 'Search & Cart icon color. We provide a single option for changing both icons for keeping color consistency.', 'saasland' ),
            'id'            => 'sticky_menu_icons_color',
            'type'          => 'color',
            'output'        => array (
                'color'      => '.header_area.navbar_fixed .navbar .search_cart .search a.nav-link i, .header_area.navbar_fixed .navbar .search_cart .shpping-cart i',
                'background' => '.header_area.navbar_fixed .navbar .search_cart .shpping-cart .num',
            ),
        ),
        array(
            'title'         => esc_html__( 'Sticky Header Text Color', 'saasland' ),
            'subtitle'      => esc_html__( 'Shopping cart product count text color', 'saasland' ),
            'id'            => 'sticky_count_text_color',
            'type'          => 'color',
            'output'        => array (
                'color'      => '.header_area.navbar_fixed .navbar .search_cart .shpping-cart .num',
            ),
        ),
        array(
            'id'     => 'menu_icons_end',
            'type'   => 'section',
            'indent' => false,
        ),

        // Sticky menu settings section
        array(
            'id' => 'sticky_menu_start',
            'type' => 'section',
            'title' => esc_html__( 'Sticky menu settings', 'saasland' ),
            'subtitle' => esc_html__( 'The following settings will only apply on the sticky header mode..', 'saasland' ),
            'indent' => true
        ),

        array(
            'title'         => esc_html__( 'Menu Color', 'saasland' ),
            'subtitle'      => esc_html__( 'Menu item font color on sticky menu mode.  Also this color will apply on the mobile menu hamburger icon in order to keep the color consistency.', 'saasland' ),
            'id'            => 'sticky_menu_font_color',
            'output'        => array (
                'color'     => 'header.navbar_fixed .menu > .nav-item > .nav-link, header.header_area.navbar_fixed .navbar .navbar-nav .menu-item a, 
                               .header_area.navbar_fixed .menu_center .menu > .nav-item > .nav-link, header.navbar_fixed .navbar .search_cart .search a.nav-link i',
                'background' => 'header.navbar_fixed .navbar .search_cart .search a.nav-link:before',
            ),
            'type'      => 'color',
        ),

        array(
            'title'     => esc_html__( 'Menu Active Color', 'saasland' ),
            'subtitle'  => esc_html__( 'Menu item active font color on header sticky mode', 'saasland' ),
            'id'        => 'menu_sticky_active_font_color',
            'output'    => array(
                'color' => '
                    .header_area .navbar_fixed .navbar .navbar-nav .menu-item a:hover, 
                    header.header_area.navbar_fixed .navbar .navbar-nav .menu-item.active a,
                    .header_area .navbar_fixed .menu > .nav-item.active .nav-link,
                    .header_area.navbar_fixed .menu_center .menu > .nav-item:hover > .nav-link,
                    .menu_center .menu > .nav-item.submenu .dropdown-menu .nav-item:hover > .nav-link span.arrow_carrot-right,
                    .menu_center .menu > .nav-item.submenu .dropdown-menu .nav-item.active > .nav-link, 
                    .menu_center .menu > .nav-item.submenu .dropdown-menu .nav-item:hover > .nav-link,
                    .header_area.navbar_fixed .menu_center .menu > .nav-item.active > .nav-link
                ',
            ),
            'type'      => 'color',
        ),
        array(
            'title'     => esc_html__( 'Menu Active Border Color', 'saasland' ),
            'id'        => 'menu_sticky_active_border_color',
            'output'    => array(
                'background' => '.header_area.navbar_fixed .menu>.nav-item>.nav-link:before',
            ),
            'type'      => 'color',
        ),
        array(
            'id'     => 'sticky_menu_end',
            'type'   => 'section',
            'indent' => false,
        ),
    )
));

/**
 * Overlay Menu
 */
Redux::setSection( 'saasland_opt', array(
    'title'            => esc_html__( 'Overlay Menu', 'saasland' ),
    'id'               => 'overlaymenu_opt',
    'icon'             => '',
    'subsection'       => true,
    'fields'           => array(

        array (
            'id'            => 'overlaymenu_typo',
            'type'          => 'typography',
            'title'         => esc_html__( 'Menu Typography', 'saasland' ),
            'subtitle'      => esc_html__( 'Menu item typography options', 'saasland' ),
            'output'        => array( '.navbar .offcanfas_menu > .nav-item .nav-link, .navbar .offcanfas_menu > .nav-item.submenu .dropdown-menu > .nav-item > .nav-link' )
        ),

        array (
            'title'     => esc_html__( 'Menu Active Color', 'saasland' ),
            'subtitle'  => esc_html__( 'Menu item active and hover font color', 'saasland' ),
            'id'        => 'overlaymenu_active_font_color',
            'output'    => array(
                'color' => '.navbar .offcanfas_menu > .nav-item.submenu.active .nav-link',
                'background' => '.navbar .offcanfas_menu > .nav-item.submenu.active .nav-link:before',
            ),
            'type'      => 'color',
        ),

        array (
            'title'         => esc_html__( 'Space Between', 'saasland' ),
            'subtitle'      => esc_html__( 'Space between the menu items.', 'saasland' ),
            'id'            => 'overlaymenu_item_margin',
            'type'          => 'slider',
            'output'        => array (
                'margin-bottom' => '.navbar .offcanfas_menu > .nav-item:not(:last-child)'
            ),
            "min"           => 5,
            "step"          => 1,
            "max"           => 100,
            'display_value' => 'text'
        ),

        array (
            'title'     => esc_html__( 'Overlay Color', 'saasland' ),
            'subtitle'  => esc_html__( 'Overlay Menu background color', 'saasland' ),
            'id'        => 'overlaymenu_overlay_color',
            'output'    => array(
                'background-color' => '.hamburger-menu-wrepper',
            ),
            'type'      => 'color_rgba',
        ),

        // Sticky menu settings section
        array(
            'id' => 'omenu_btm_start',
            'type' => 'section',
            'title' => esc_html__( 'Menu Bottom Contents', 'saasland' ),
            'indent' => true
        ),

        array (
            'id'       => 'is_omenu_footer',
            'type'     => 'switch',
            'title'    => esc_html__( 'Menu Footer Area', 'saasland' ),
            'on'       => esc_html__( 'Show', 'saasland' ),
            'off'      => esc_html__( 'Hide', 'saasland' ),
            'default'  => true,
        ),

        array(
            'title'     => esc_html__( 'Title', 'saasland' ),
            'id'        => 'omenu_btm_title',
            'type'      => 'text',
            'default'   => esc_html__( 'Follow US', 'saasland' ),
            'required'  => array( 'is_omenu_footer', '=', '1' )
        ),

        array (
            'id'       => 'is_omenu_footer',
            'type'     => 'switch',
            'title'    => esc_html__( 'Social Links', 'saasland' ),
            'subtitle' => sprintf(
                '%1$s <a href="%2$s"> %3$s </a> %4$s',
                esc_html__( 'Social links are getting from', 'saasland' ),
                get_admin_url(null, '?page=Saasland&tab=30' ),
                esc_html__( 'Social Links', 'saasland' ),
                esc_html__( 'Settings', 'saasland' )
            ),
            'default'  => true,
            'on'       => esc_html__( 'Show', 'saasland' ),
            'off'      => esc_html__( 'Hide', 'saasland' ),
            'required' => array( 'is_omenu_footer', '=', '1' )
        ),

        array(
            'title'     => esc_html__( 'Content', 'saasland' ),
            'id'        => 'omenu_btm_content',
            'type'      => 'editor',
            'required'  => array( 'is_omenu_footer', '=', '1' )
        ),

        array(
            'id'     => 'omenu_btm_end',
            'type'   => 'section',
            'indent' => false,
        ),
    )
));

/**
 * Main Menu styling
 */
Redux::setSection( 'saasland_opt', array(
    'title'            => esc_html__( 'Mobile Menu', 'saasland' ),
    'id'               => 'mobile_menu_opt',
    'icon'             => '',
    'subsection'       => true,
    'fields'           => array(
        array(
            'id'            => 'mobile_menu_dropdown_bg',
            'type'          => 'color',
            'title'         => esc_html__( 'Background Color', 'saasland' ),
            'subtitle'      => esc_html__( 'Controls the background color of the mobile menu dropdown and classic mobile menu box.', 'saasland' ),
            'mode'          => 'background',
        ),
        array(
            'title'         => esc_html__( 'Menu Item Color', 'saasland' ),
            'id'            => 'mobile_menu_font_color',
            'type'          => 'color',
            'output'    => array(
                'color' => '.header_area.mobile_menu_enabled .navbar .navbar-nav .menu-item a',
            ),
        ),
        array(
            'title'         => esc_html__( 'Menu Item Hover Color', 'saasland' ),
            'id'            => 'mobile_menu_hover_color',
            'type'          => 'color',
            'output'    => array(
                'color' => '.header_area.mobile_menu_enabled .navbar .navbar-nav .menu-item a:hover',
            ),
        ),
        array(
            'title'         => esc_html__( 'Separator Color', 'saasland' ),
            'id'            => 'mobile_menu_separator_color',
            'type'          => 'color_rgba',
        ),

        array (
            'title'     => esc_html__( 'Hamburger Menu Icon Color', 'saasland' ),
            'id'        => 'hamburger_menu_icon_color',
            'output'    => array(
                'background' => '.menu_toggle .hamburger span, .menu_toggle .hamburger-cross span',
            ),
            'type'      => 'color',
        ),
        array (
            'title'     => esc_html__( 'Sticky Header Hamburger Menu Icon Color', 'saasland' ),
            'id'        => 'hamburger_sticky_menu_icon_color',
            'output'    => array(
                'background' => 'header.header_area.navbar_fixed .menu_toggle .hamburger span, header.header_area.navbar_fixed .menu_toggle .hamburger-cross span',
            ),
            'type'      => 'color',
        ),

    )
));