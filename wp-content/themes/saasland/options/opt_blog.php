<?php
/**
 * Blog Pages
 */
Redux::setSection( 'saasland_opt', array(
	'title'     => esc_html__( 'Blog Pages', 'saasland' ),
	'id'        => 'blog_page',
	'icon'      => 'dashicons dashicons-admin-post',
));

/**
 * Blog Archive
 */
Redux::setSection( 'saasland_opt', array(
	'title'     => esc_html__( 'Blog Archive', 'saasland' ),
	'id'        => 'blog_meta_opt',
	'icon'      => '',
	'subsection' => true,
	'fields'    => array(
        /**
         * Blog archive Title-bar banner section
         */
        array(
            'id' => 'blog_archive_header_start',
            'type' => 'section',
            'title' => esc_html__( 'Header', 'saasland' ),
            'indent' => true,
        ),
        array(
            'title'     => esc_html__( 'Menu Item Color', 'saasland' ),
            'subtitle'  => esc_html__( 'Menu item font color', 'saasland' ),
            'id'        => 'blog_menu_font_color',
            'output'    => array( '.blog .header_area .navbar .navbar-nav .menu-item a' ),
            'type'      => 'color',
        ),
        array(
            'title'     => esc_html__( 'Menu Item Hover/Active Color', 'saasland' ),
            'id'        => 'blog_menu_font_hover_color',
            'output'    => array( '.blog .header_area .navbar .navbar-nav .menu-item a:hover', '.blog .header_area .navbar .navbar-nav .menu-item.active a' ),
            'type'      => 'color',
        ),
        array(
            'title'     => esc_html__( 'Menu Item Border Color', 'saasland' ),
            'id'        => 'blog_menu_border_color',
            'output'    => array( '.blog .header_area .navbar .navbar-nav .menu-item a:before' ),
            'type'      => 'color',
            'mode'      => 'background'
        ),
        array(
            'title'     => esc_html__( 'Sticky Header Menu Item Color', 'saasland' ),

            'id'        => 'blog_menu_sticky_font_color',
            'output'    => array( '.blog .header_area.navbar_fixed .navbar .navbar-nav .menu-item a' ),
            'type'      => 'color',
        ),
        array(
            'title'     => esc_html__( 'Sticky Header Menu Item Hover/Active Color', 'saasland' ),
            'subtitle'  => esc_html__( 'Menu item font color', 'saasland' ),
            'id'        => 'blog_menu_sticky_hover_color',
            'output'    => array( '.blog .header_area.navbar_fixed .navbar .navbar-nav .menu-item a:hover', '.blog .header_area.navbar_fixed .navbar .navbar-nav .menu-item.active a' ),
            'type'      => 'color',
        ),
        /*DropDown menu color*/
        array(
            'title'     => esc_html__( 'Dropdown Menu Item Color', 'saasland' ),
            'id'        => 'blog_dropdown_menu_font_color',
            'output'    => array( '.blog .header_area .navbar .navbar-nav .menu-item .dropdown-menu > li > a' ),
            'type'      => 'color',
        ),
        array(
            'title'     => esc_html__( 'Dropdown Menu Item Hover Color', 'saasland' ),
            'id'        => 'blog_dropdown_menu_hover_color',
            'output'    => array( '.blog .header_area .navbar .navbar-nav .menu-item .dropdown-menu > li:hover > a', '.blog .header_area .navbar .navbar-nav .menu-item > .dropdown-menu > li.active > a' ),
            'type'      => 'color',
        ),
        array(
            'title'     => esc_html__( 'Use Sticky Logo Only', 'saasland' ),
            'subtitle'  => esc_html__( 'Use only the sticky logo on normal and sticky mode instead of the two different logos in the blog page.', 'saasland' ),
            'id'        => 'is_blog_sticky_logo',
            'type'      => 'switch',
            'on'        => esc_html__( 'Yes', 'saasland' ),
            'off'       => esc_html__( 'No', 'saasland' ),
            'default'   => '1',
        ),
        array(
            'id'     => 'blog_archive_header_end',
            'type'   => 'section',
            'indent' => false,
        ),

        /**
         * Blog archive Title-bar banner section
         */
        array(
            'id' => 'blog_archive_banner_start',
            'type' => 'section',
            'title' => esc_html__( 'Title-bar Banner', 'saasland' ),
            'indent' => true,
        ),
        array(
            'title'     => esc_html__( 'Background Shape', 'saasland' ),
            'subtitle'  => esc_html__( 'Upload here the background shape image for Blog page', 'saasland' ),
            'id'        => 'blog_banner_bg2',
            'type'      => 'media',
            'compiler'  => true,
            'default'   => array(
                'url'   => SAASLAND_DIR_IMG.'/banners/banner_bg2.png'
            ),
        ),
        array(
            'title'     => esc_html__( 'Background Color', 'saasland' ),
            'id'        => 'blog_banner_bg_color',
            'output'    => array( '.breadcrumb_area_two' ),
            'type'      => 'color',
            'mode'      => 'background'
        ),
        array(
            'title'     => esc_html__( 'Bubbles', 'saasland' ),
            'id'        => 'is_bubbles',
            'type'      => 'switch',
            'on'        => esc_html__( 'Show', 'saasland' ),
            'off'       => esc_html__( 'Hide', 'saasland' ),
            'default'   => '1',
        ),
        array(
            'title'     => esc_html__( 'Bubbles Color', 'saasland' ),
            'id'        => 'bubbles_color',
            'output'    => array( '.breadcrumb_area_two .bubble li' ),
            'type'      => 'color',
            'mode'      => 'background',
            'required'  => array ( 'is_bubbles', '=', '1' )
        ),
        array(
            'title'     => esc_html__( 'Blog page title', 'saasland' ),
            'subtitle'  => esc_html__( 'Controls the title text that displays in the page title bar only if your front page displays your latest post in "Settings > Reading".', 'saasland' ),
            'id'        => 'blog_title',
            'type'      => 'text',
            'default'   => esc_html__( 'Blog List', 'saasland' )
        ),
        array(
            'title'     => esc_html__( 'Blog Archive page title', 'saasland' ),
            'subtitle'  => esc_html__( 'Controls the title text that displays in the blog archive page title bar only if your front page displays your latest post in "Settings > Reading".', 'saasland' ),
            'id'        => 'blog_archive_title',
            'type'      => 'text',
            'default'   => esc_html__( 'Blog Archive', 'saasland' )
        ),
        array(
            'title'         => esc_html__( 'Title font properties', 'saasland' ),
            'id'            => 'blog_titlebar_title_typo',
            'type'          => 'typography',
            'google'        => true,
            'text-align'    => true,
            'output'        => array( '.blog .breadcrumb_content_two h1' ),
            'preview'       => array(
                'always_display' => false
            )
        ),
        array(
            'id'     => 'blog_archive_banner_end',
            'type'   => 'section',
            'indent' => false,
        ),

        array(
            'title'     => esc_html__( 'Blog Layout', 'saasland' ),
            'subtitle'  => esc_html__( 'The Blog layout will also apply on the blog category and tag pages.', 'saasland' ),
            'id'        => 'blog_layout',
            'type'      => 'image_select',
            'options'   => array(
                'list' => array(
                    'alt' => esc_html__( 'List Layout', 'saasland' ),
                    'img' => SAASLAND_DIR_IMG.'/layouts/list.jpg'
                ),
                'grid' => array(
                    'alt' => esc_html__( 'Grid Layout', 'saasland' ),
                    'img' => SAASLAND_DIR_IMG.'/layouts/grid.jpg'
                ),
                'masonry' => array(
                    'alt' => esc_html__( 'Masonry Layout', 'saasland' ),
                    'img' => SAASLAND_DIR_IMG.'/layouts/masonry.jpg'
                ),
            ),
            'default' => 'list'
        ),
        array(
            'title'     => esc_html__( 'Column', 'saasland' ),
            'id'        => 'blog_column',
            'type'      => 'select',
            'options'   => [
                '6' => esc_html__( 'Two', 'saasland' ),
                '4' => esc_html__( 'Three', 'saasland' ),
                '3' => esc_html__( 'Four', 'saasland' ),
            ],
            'default'   => '6',
            'required' => array (
                array ( 'blog_layout', '=', array( 'grid', 'masonry' ) ),
            )
        ),
        array(
            'title'     => esc_html__( 'Post title length', 'saasland' ),
            'subtitle'  => esc_html__( 'Blog post title length in character', 'saasland' ),
            'id'        => 'post_title_length',
            'type'      => 'slider',
            'default'   => 50,
            "min"       => 1,
            "step"      => 1,
            "max"       => 500,
            'display_value' => 'text',
            'required' => array (
                array ( 'blog_layout', '=', array( 'grid', 'masonry' ) ),
            )
        ),
        array(
            'title'     => esc_html__( 'Post word excerpt', 'saasland' ),
            'subtitle'  => esc_html__( 'If post excerpt is empty, the excerpt content will take from the post content. Define here how much word you want to show along with the each posts in the blog page.', 'saasland' ),
            'id'        => 'blog_excerpt',
            'type'      => 'slider',
            'default'   => 40,
            "min"       => 1,
            "step"      => 1,
            "max"       => 500,
            'display_value' => 'text'
        ),
        array(
            'title'     => esc_html__( 'Read More', 'saasland' ),
            'subtitle'  => esc_html__( 'Change the Read More link text', 'saasland' ),
            'id'        => 'read_more',
            'type'      => 'text',
            'default'   => esc_html__( 'Read More', 'saasland' )
        ),
		array(
			'title'     => esc_html__( 'Post meta', 'saasland' ),
			'subtitle'  => esc_html__( 'Show/hide post meta on blog archive page', 'saasland' ),
			'id'        => 'is_post_meta',
			'type'      => 'switch',
            'on'        => esc_html__( 'Show', 'saasland' ),
            'off'       => esc_html__( 'Hide', 'saasland' ),
            'default'   => '1',
		),
		array(
			'title'     => esc_html__( 'Post date', 'saasland' ),
			'id'        => 'is_post_date',
			'type'      => 'switch',
            'on'        => esc_html__( 'Show', 'saasland' ),
            'off'       => esc_html__( 'Hide', 'saasland' ),
            'default'   => '1',
            'required' => array( 'is_post_meta', '=', 1 )
		),
		array(
			'title'     => esc_html__( 'Post category', 'saasland' ),
			'id'        => 'is_post_cat',
			'type'      => 'switch',
            'on'        => esc_html__( 'Show', 'saasland' ),
            'off'       => esc_html__( 'Hide', 'saasland' ),
            'default'   => '1',
            'required' => array( 'is_post_meta', '=', 1 )
		),
	)
));

/**
 * Blog Single
 */
Redux::setSection( 'saasland_opt', array(
	'title'     => esc_html__( 'Blog Single', 'saasland' ),
	'id'        => 'blog_single_opt',
	'icon'      => '',
	'subsection' => true,
	'fields'    => array(
        /**
         * Title-bar Banner Section
         */
        array(
            'id' => 'blog_single_banner_start',
            'type' => 'section',
            'title' => esc_html__( 'Title-bar Banner', 'saasland' ),
            'indent' => true,
        ),
        array(
            'title'     => esc_html__( 'Overlay Color', 'saasland' ),
            'id'        => 'post_banner_overlay_color',
            'type'      => 'color_gradient',
            'default'   => array(
                'from'  => '',
                'to'    => '',
            )
        ),
        array(
            'title'     => esc_html__( 'Overlay Color Opacity', 'saasland' ),
            'id'        => 'post_banner_overlay_opacity',
            'type'      => 'slider',
            'default'   => 80,
            "min"       => 1,
            "step"      => 1,
            "max"       => 99,
            'display_value' => 'text'
        ),
        array(
            'title'     => esc_html__( 'Height', 'saasland' ),
            'id'        => 'post_banner_height',
            'type'      => 'slider',
            "min"       => 300,
            "default"   => 600,
            "step"      => 1,
            "max"       => 1000,
            'display_value' => 'text'
        ),
        array(
            'title'     => esc_html__( 'Background Image', 'saasland' ),
            'subtitle'  => esc_html__( 'Upload here the default background image for blog single page banner', 'saasland' ),
            'id'        => 'post_banner_bg',
            'type'      => 'media',
        ),
        array(
            'title'         => esc_html__( 'Category font properties', 'saasland' ),
            'id'            => 'blog_single_titlebar_cats_typo',
            'type'          => 'typography',
            'google'        => true,
            'text-align'    => true,
            'output'        => array( '.blog_breadcrumb_area .breadcrumb_content_two h5, .blog_breadcrumb_area .breadcrumb_content_two h5 a' ),
            'preview'       => array(
                'always_display' => false
            )
        ),
        array(
            'title'         => esc_html__( 'Title font properties', 'saasland' ),
            'id'            => 'blog_single_titlebar_title_typo',
            'type'          => 'typography',
            'google'        => true,
            'text-align'    => true,
            'output'        => array( '.blog_breadcrumb_area .breadcrumb_content_two h1' ),
            'preview'       => array(
                'always_display' => false
            )
        ),
        array(
            'title'         => esc_html__( 'Breadcrumb font properties', 'saasland' ),
            'id'            => 'blog_single_titlebar_bread_typo',
            'type'          => 'typography',
            'google'        => true,
            'text-align'    => true,
            'output'        => array( '.blog_breadcrumb_area .breadcrumb_content_two ol li, .blog_breadcrumb_area .breadcrumb_content_two ol li a' ),
            'preview'       => array(
                'always_display' => false
            )
        ),
        array(
            'id'     => 'blog_single_banner_end',
            'type'   => 'section',
            'indent' => false,
        ),

		array(
			'title'     => esc_html__( 'Social Share', 'saasland' ),
			'id'        => 'is_social_share',
			'type'      => 'switch',
            'on'        => esc_html__( 'Enabled', 'saasland' ),
            'off'       => esc_html__( 'Disabled', 'saasland' ),
            'default'   => '1'
		),
        array(
            'id'       => 'is_social_share_links',
            'type'     => 'checkbox',
            'title'    => __('Checked Share Links', 'saasland'),
            'options'  => array(
                'facebook' => __('Facebook', 'saasland'),
                'twitter'  => __('Twitter', 'saasland'),
                'pinterest'=> __('Pinterest', 'saasland'),
                'linkedin' => __('Linkedin', 'saasland')
            ),
            'default'  => '',
            'required' => array( 'is_social_share', '=', 1 )
        ),
		array(
			'title'     => esc_html__( 'Post Tag', 'saasland' ),
			'id'        => 'is_post_tag',
			'type'      => 'switch',
            'on'        => esc_html__( 'Show', 'saasland' ),
            'off'       => esc_html__( 'Hide', 'saasland' ),
            'default'   => '1'
		),
        array(
            'title'     => esc_html__( 'Post meta', 'saasland' ),
            'subtitle'  => esc_html__( 'Show/hide post meta on blog single page', 'saasland' ),
            'id'        => 'is_single_post_meta',
            'type'      => 'switch',
            'on'        => esc_html__( 'Show', 'saasland' ),
            'off'       => esc_html__( 'Hide', 'saasland' ),
            'default'   => '1',
        ),
        array(
            'title'     => esc_html__( 'Categories', 'saasland' ),
            'id'        => 'is_single_cats',
            'type'      => 'switch',
            'on'        => esc_html__( 'Show', 'saasland' ),
            'off'       => esc_html__( 'Hide', 'saasland' ),
            'default'   => '1',
            'required' => array( 'is_single_post_meta', '=', 1 )
        ),
        array(
            'title'     => esc_html__( 'Post Author Name', 'saasland' ),
            'id'        => 'is_single_post_author',
            'type'      => 'switch',
            'on'        => esc_html__( 'Show', 'saasland' ),
            'off'       => esc_html__( 'Hide', 'saasland' ),
            'default'   => '1',
            'required' => array( 'is_single_post_meta', '=', 1 )
        ),
        array(
            'title'     => esc_html__( 'Comment Count Text', 'saasland' ),
            'id'        => 'is_single_comment_meta',
            'type'      => 'switch',
            'on'        => esc_html__( 'Show', 'saasland' ),
            'off'       => esc_html__( 'Hide', 'saasland' ),
            'default'   => '1',
            'required' => array( 'is_single_post_meta', '=', 1 )
        ),
        array(
            'title'     => esc_html__( 'Comment List', 'saasland' ),
            'id'        => 'is_single_comment_list',
            'type'      => 'switch',
            'on'        => esc_html__( 'Show', 'saasland' ),
            'off'       => esc_html__( 'Hide', 'saasland' ),
            'default'   => '1',
            'required' => array( 'is_single_post_meta', '=', 1 )
        ),
        array(
            'title'     => esc_html__( 'Post Date', 'saasland' ),
            'id'        => 'is_single_post_date',
            'type'      => 'switch',
            'on'        => esc_html__( 'Show', 'saasland' ),
            'off'       => esc_html__( 'Hide', 'saasland' ),
            'default'   => '1',
            'required' => array( 'is_single_post_meta', '=', 1 )
        ),
        array(
            'title'     => esc_html__( 'Related posts ', 'saasland' ),
            'id'        => 'is_related_posts',
            'type'      => 'switch',
            'on'        => esc_html__( 'Show', 'saasland' ),
            'off'       => esc_html__( 'Hide', 'saasland' ),
        ),
        array(
            'title'     => esc_html__( 'Posts section title', 'saasland' ),
            'id'        => 'related_posts_title',
            'type'      => 'text',
            'default'   => esc_html__( 'Related Post', 'saasland' ),
            'required'  => array( 'is_related_posts', '=', '1' )
        ),
        array(
            'title'     => esc_html__( 'Title Character Limit', 'saasland' ),
            'id'        => 'rp_title_char_limit',
            'type'      => 'slider',
            'default'   => 50,
            "min"       => 1,
            "step"      => 1,
            "max"       => 1000,
            'display_value' => 'text',
            'required' => array( 'is_related_posts', '=', '1' )
        ),
        array(
            'title'     => esc_html__( 'Related posts count', 'saasland' ),
            'id'        => 'related_posts_count',
            'type'      => 'slider',
            'default'       => 3,
            'min'           => 3,
            'step'          => 1,
            'max'           => 50,
            'display_value' => 'label',
            'required'  => array( 'is_related_posts', '=', '1' )
        ),
	)
));
