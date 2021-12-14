<?php

// Footer settings
Redux::setSection( 'saasland_opt', array(
	'title'     => esc_html__( 'Footer', 'saasland' ),
	'id'        => 'saasland_footer',
	'icon'      => 'el el-arrow-down',
    'fields'           => array(
        array(
            'title'     => esc_html__( 'Footer Style', 'saasland' ),
            'subtitle'  => esc_html__( 'Select a Footer template from here. Leave the field empty to use the default footer.', 'saasland' ),
            'id'        => 'footer_style',
            'type'      => 'select',
            'options'   => saasland_get_postTitleArray( 'footer' )
        ),
        array(
            'id'        => 'if_footer_template_selected',
            'type'      => 'info',
            'style'     => 'warning',
            'title'     => esc_html__( 'Warning', 'saasland' ),
            'desc'      => esc_html__( 'You have selected a Custom Footer template. Now, all the Footer Settings will not apply. Edit your Footer template with Footer Elementor.', 'saasland' ),
            'required'  => array( 'footer_style', '!=', '' ),
        ),
        array(
            'title'     => esc_html__( 'Footer Column', 'saasland' ),
            'id'        => 'footer_column',
            'type'      => 'select',
            'default'   => '3',
            'options'   => array(
                '6' => esc_html__( 'Two Column', 'saasland' ),
                '4' => esc_html__( 'Three Column', 'saasland' ),
                '3' => esc_html__( 'Four Column', 'saasland' ),
            )
        ),
        array(
            'id'             => 'saasland-footer-spacing',
            'type'           => 'spacing',
            'output'         => array('.new_footer_top'),
            'mode'           => 'padding',
            'units'          => array('em', 'px'),
            'units_extended' => 'false',
            'title'          => __('Padding Option', 'saasland'),
            'default'            => array(
                'padding-top'     => '120px',
                'padding-right'   => '0px',
                'padding-bottom'  => '270px',
                'padding-left'    => '0px',
                'units'          => 'px',
            )
        )
    )
));


// Footer settings
Redux::setSection( 'saasland_opt', array(
	'title'     => esc_html__( 'Font colors', 'saasland' ),
	'id'        => 'saasland_footer_font_colors',
	'icon'      => '',
	'subsection'=> true,
	'fields'    => array(
        array(
            'title'     => esc_html__( 'Font color', 'saasland' ),
            'id'        => 'footer_top_font_color',
            'type'      => 'color_rgba',
            'output'    => array( '.footer-widget p, .footer-widget ul li a' )
        ),
        array(
            'title'     => esc_html__( 'Widget Title Color', 'saasland' ),
            'id'        => 'widget_title_color',
            'type'      => 'color',
            'output'    => array( '.footer-widget .widget_title' )
        ),
        array(
            'title'     => esc_html__( 'Widget List Color', 'saasland' ),
            'id'        => 'widget_list_color',
            'type'      => 'color',
            'output'    => array( '.new_footer_top .f_widget.about-widget ul li a' )
        ),
        array(
            'title'     => esc_html__( 'Widget List Hover Color', 'saasland' ),
            'id'        => 'widget_list_hover_color',
            'type'      => 'color',
            'output'    => array( '.new_footer_top .f_widget.about-widget ul li a:hover' )
        ),
        array(
            'title'     => esc_html__( 'Footer Bottom Text Color', 'saasland' ),
            'id'        => 'footer_bottom_text_color',
            'type'      => 'color',
            'output'    => array( '.new_footer_area .footer_bottom p' )
        ),
	)
));

// Footer background
Redux::setSection( 'saasland_opt', array(
	'title'     => esc_html__( 'Background', 'saasland' ),
	'id'        => 'saasland_footer_background',
	'icon'      => '',
	'subsection'=> true,
	'fields'    => array(
        array(
            'title'     => esc_html__( 'Footer Background Image', 'saasland' ),
            'desc'      => esc_html__( 'The main footer background image', 'saasland' ),
            'id'        => 'footer_bg_image',
            'type'      => 'media',
            'default'   => array(
                'url' => SAASLAND_DIR_IMG.'/seo/footer_bg.png'
            )
        ),
        array(
            'title'     => esc_html__( 'Footer Top Background Color', 'saasland' ),
            'id'        => 'footer_top_bg_color',
            'type'      => 'color',
            'output'    => array( '.new_footer_area' ),
            'mode'      => 'background'
        ),
        array(
            'title'     => esc_html__( 'Footer Bottom Background Color', 'saasland' ),
            'id'        => 'footer_btm_bg_color',
            'type'      => 'color',
            'output'    => array( '.footer_bottom' ),
            'mode'      => 'background'
        ),
	)
));


// Footer Typography
Redux::setSection( 'saasland_opt', array(
    'title'     => esc_html__( 'Typography', 'saasland' ),
    'id'        => 'saasland_footer_typography',
    'icon'      => '',
    'subsection'=> true,
    'fields'    => array(
        array(
            'title'         => esc_html__( 'Widget Title', 'saasland' ),
            'id'            => 'footer_title_typo',
            'type'          => 'typography',
            'color'         => false,
            'output'        => array( '.footer-widget .widget_title' ),
        ),
        array(
            'title'         => esc_html__( 'Widget Contents', 'saasland' ),
            'id'            => 'widget_content_typo',
            'type'          => 'typography',
            'color'         => false,
            'output'        => array( '.new_footer_top p, .new_footer_top .f_widget.about-widget ul li a' ),
        ),
    )
));


// Footer settings
Redux::setSection( 'saasland_opt', array(
    'title'     => esc_html__( 'Footer Bottom', 'saasland' ),
    'id'        => 'saasland_footer_btm',
    'icon'      => '',
    'subsection'=> true,
    'fields'    => array(
        array(
            'title'     => esc_html__( 'Moving Object 01', 'saasland' ),
            'id'        => 'footer_obj_1',
            'type'      => 'media',
            'default'   => array(
                'url' => SAASLAND_DIR_IMG.'/seo/car.png'
            )
        ),
        array(
            'title'     => esc_html__( 'Moving Object 02', 'saasland' ),
            'id'        => 'footer_obj_2',
            'type'      => 'media',
            'default'   => array(
                'url' => SAASLAND_DIR_IMG.'/seo/bike.png'
            )
        ),
        array(
            'title'     => esc_html__( 'Left Content', 'saasland' ),
            'id'        => 'copyright_txt',
            'type'      => 'editor',
            'default'   => '© 2021 <a href="//droitthemes.com">DroitThemes</a>. All rights reserved',
            'args'    => array(
                'wpautop'       => true,
                'media_buttons' => false,
                'textarea_rows' => 10,
                'quicktags'     => false,
            )
        ),
        array(
            'title'     => esc_html__( 'Right Content', 'saasland' ),
            'id'        => 'right_content',
            'type'      => 'editor',
            'args'    => array(
                'wpautop'       => true,
                'media_buttons' => false,
                'textarea_rows' => 10,
                'quicktags'     => false,
            )
        ),
    )
));