<?php
// Shop page
Redux::setSection( 'saasland_opt', array(
    'title'            => esc_html__( 'Shop', 'saasland' ),
    'id'               => 'shop_opt',
    'icon'             => 'dashicons dashicons-cart',
    'fields'           => array(
        array(
            'title'     => esc_html__( 'Page title', 'saasland' ),
            'subtitle'  => esc_html__( 'Give here the shop page title', 'saasland' ),
            'desc'      => esc_html__( 'This text will show on the shop page banner', 'saasland' ),
            'id'        => 'shop_title',
            'type'      => 'text',
            'default'   => esc_html__( 'Shop', 'saasland' ),
        ),

        array(
            'title'     => esc_html__( 'Shop Page Subtitle', 'saasland' ),
            'id'        => 'shop_subtitle',
            'type'      => 'textarea',
        ),

        array(
            'title'     => esc_html__( 'Title bar background', 'saasland' ),
            'subtitle'  => esc_html__( 'Upload image file as Shop page title bar background', 'saasland' ),
            'id'        => 'shop_header_bg',
            'type'      => 'media',
        ),

        array(
            'title'     => esc_html__( 'Layout', 'saasland' ),
            'subtitle'  => esc_html__( 'Select the product view layout', 'saasland' ),
            'id'        => 'shop_layout',
            'type'      => 'image_select',
            'options'   => array(
                'shop_list' => array(
                    'alt' => esc_html__( 'List Layout', 'saasland' ),
                    'img' => SAASLAND_DIR_IMG.'/layouts/list.jpg'
                ),
                'shop_grid' => array(
                    'alt' => esc_html__( 'Grid Layout', 'saasland' ),
                    'img' => SAASLAND_DIR_IMG.'/layouts/grid.jpg'
                ),
            ),
            'default' => 'shop_grid'
        ),

        array(
            'title'     => esc_html__( 'Sidebar', 'saasland' ),
            'subtitle'  => esc_html__( 'Select the sidebar position of Shop page', 'saasland' ),
            'id'        => 'shop_sidebar',
            'type'      => 'image_select',
            'options'   => array(
                'left' => array(
                    'alt' => esc_html__( 'Left Sidebar', 'saasland' ),
                    'img' => SAASLAND_DIR_IMG.'/layouts/sidebar_left.jpg'
                ),
                'right' => array(
                    'alt' => esc_html__( 'Right Sidebar', 'saasland' ),
                    'img' => SAASLAND_DIR_IMG.'/layouts/sidebar_right.jpg',
                ),
                'full' => array(
                    'alt' => esc_html__( 'Full Width', 'saasland' ),
                    'img' => SAASLAND_DIR_IMG.'/layouts/fullwidth.png',
                ),
            ),
            'default' => 'left'
        ),

        array(
            'title'     => esc_html__( 'Add to Cart Icon', 'saasland' ),
            'id'        => 'is_add_to_cart',
            'type'      => 'switch',
            'on'        => esc_html__( 'Enabled', 'saasland' ),
            'off'       => esc_html__( 'Disabled', 'saasland' ),
            'default'   => '1'
        ),
        array(
            'title'     => esc_html__( 'Light-box Icon', 'saasland' ),
            'id'        => 'is_product_lightbox',
            'type'      => 'switch',
            'on'        => esc_html__( 'Enabled', 'saasland' ),
            'off'       => esc_html__( 'Disabled', 'saasland' ),
            'default'   => '1'
        ),
    ),
));


// Product Single Options
Redux::setSection( 'saasland_opt', array(
    'title'            => esc_html__( 'Product Archive', 'saasland' ),
    'id'               => 'product_archive_opt',
    'subsection'       => true,
    'icon'             => '',
    'fields'           => array(
        array(
            'title'     => esc_html__( 'Product Archive Title', 'saasland' ),
            'id'        => 'product_archive_title',
            'type'      => 'text',
            'default'   => esc_html__( 'Product Archive', 'saasland' ),
        ),


    )
));

// Product Single Options
Redux::setSection( 'saasland_opt', array(
    'title'            => esc_html__( 'Product Single', 'saasland' ),
    'id'               => 'product_single_opt',
    'subsection'       => true,
    'icon'             => '',
    'fields'           => array(
        array(
            'title'     => esc_html__( 'Related Products Title', 'saasland' ),
            'id'        => 'related_products_title',
            'type'      => 'text',
            'default'   => esc_html__( 'Related products', 'saasland' ),
        ),

        array(
            'title'     => esc_html__( 'Related Products Subtitle', 'saasland' ),
            'id'        => 'related_products_subtitle',
            'type'      => 'textarea',
        ),
        array(
            'title'     => esc_html__( 'Product Category', 'saasland' ),
            'id'        => 'is_product_category',
            'type'      => 'switch',
            'on'        => esc_html__( 'Enabled', 'saasland' ),
            'off'       => esc_html__( 'Disabled', 'saasland' ),
            'default'   => '1'
        ),
        array(
            'title'     => esc_html__( 'Product Tags', 'saasland' ),
            'id'        => 'is_product_tags',
            'type'      => 'switch',
            'on'        => esc_html__( 'Enabled', 'saasland' ),
            'off'       => esc_html__( 'Disabled', 'saasland' ),
            'default'   => '1'
        ),
        array(
            'title'     => esc_html__( 'Product Share', 'saasland' ),
            'id'        => 'is_product_share',
            'type'      => 'switch',
            'on'        => esc_html__( 'Enabled', 'saasland' ),
            'off'       => esc_html__( 'Disabled', 'saasland' ),
            'default'   => '1'
        ),
        array(
            'id'       => 'is_product_social_share_links',
            'type'     => 'checkbox',
            'title'    => __('Checked Share Links', 'saasland'),
            'options'  => array(
                'facebook' => __('Facebook', 'saasland'),
                'twitter'  => __('Twitter', 'saasland'),
                'pinterest'=> __('Pinterest', 'saasland'),
                'linkedin' => __('Linkedin', 'saasland')
            ),
            'default'  => '',
            'required' => ['is_product_share', '=', '1']
        ),

    )
));