<?php

Redux::setSection( 'saasland_opt', array(
    'title'     => esc_html__( '404 Error Page', 'saasland' ),
    'id'        => '404_0pt',
    'icon'      => 'dashicons dashicons-info',
    'fields'    => array(
        array(
            'title'    => esc_html__( '404 Page Style', 'saasland' ),
            'id'       => 'error_img_select',
            'type'     => 'image_select',
            'default'   => '1',
            'options'  => array(
                '1' => array(
                    'alt' => esc_html__( 'Style 01', 'saasland' ),
                    'img' => SAASLAND_DIR_IMG.'/404_screenshots/404_style_1.png'
                ),
                '2' => array(
                    'alt' => esc_html__( 'Style 02', 'saasland' ),
                    'img' => SAASLAND_DIR_IMG.'/404_screenshots/404_style_2.png'
                ),
            ),
        ),

        array(
            'title'     => esc_html__( 'Heading Text', 'saasland' ),
            'id'        => 'error_heading',
            'type'      => 'text',
            'default'   => esc_html__("404", 'saasland' ),
            'required'  => array( 'error_img_select', '=', '1' )
        ),

        array(
            'title'     => esc_html__( 'Title', 'saasland' ),
            'id'        => 'error_title',
            'type'      => 'text',
            'default'   => esc_html__( 'Page not found', 'saasland' ),
            'required'  => array( 'error_img_select', '=', '1' )

        ),

        array(
            'title'     => esc_html__( 'Title', 'saasland' ),
            'id'        => 'error2_title',
            'type'      => 'text',
            'default'   => esc_html__( 'Error. We can’t find the page you’re looking for.', 'saasland' ),
            'required'  => array( 'error_img_select', '=', '2' )
        ),

        array(
            'title'     => esc_html__( 'Subtitle', 'saasland' ),
            'id'        => 'error_subtitle',
            'type'      => 'textarea',
            'default'   => esc_html__( 'We’re sorry, the page you have looked for does not exist in our database! Maybe  go to our home page   or try to use a search?', 'saasland' ),
            'required'  => array( 'error_img_select', '=', '1' )
        ),

        array(
            'title'     => esc_html__( 'Subtitle', 'saasland' ),
            'id'        => 'error2_subtitle',
            'type'      => 'textarea',
            'default'   => esc_html__( 'Sorry for the inconvenience. Go to our homepage or check out our latest collections for Fashion, Chair, Decoration...', 'saasland' ),
            'required'  => array( 'error_img_select', '=', '2' )
        ),

        array(
            'title'     => esc_html__( 'Home button label', 'saasland' ),
            'id'        => 'error_home_btn_label',
            'type'      => 'text',
            'default'   => esc_html__( 'Go Back to home Page', 'saasland' ),
            'required'  => array( 'error_img_select', '=', '1' )
        ),

        array(
            'id'          => 'btn_font_color',
            'type'        => 'color',
            'title'       => esc_html__( 'Button Text Color', 'saasland' ),
            'required'  => array( 'error_img_select', '=', '1' ),
            'output'      => array(
                'color' => '.about_btn',
            ),
        ),

        array(
            'id'          => 'btn_font_color_hover',
            'type'        => 'color',
            'title'       => esc_html__( 'Button Text Hover Color', 'saasland' ),
            'required'  => array( 'error_img_select', '=', '1' ),
            'output'      => array(
                'color' => '.about_btn:hover',
            ),
        ),

        array(
            'id'          => 'btn_bg_color',
            'type'        => 'color',
            'title'       => esc_html__( 'Button Background Color', 'saasland' ),
            'required'  => array( 'error_img_select', '=', '1' ),
            'output'      => array(
                'background' => '.about_btn',
            ),
        ),

        array(
            'id'          => 'btn_bg_color_hover',
            'type'        => 'color',
            'title'       => esc_html__( 'Button Background Hover Color', 'saasland' ),
            'required'  => array( 'error_img_select', '=', '1' ),
            'output'      => array(
                'background' => '.about_btn:hover',
            ),
        ),

        array(
            'title'     => esc_html__( 'Background shape', 'saasland' ),
            'subtitle'  => esc_html__( 'Upload here the default background shape image', 'saasland' ),
            'id'        => 'error_bg_shape_image',
            'type'      => 'media',
            'compiler'  => true,
            'required'  => array( 'error_img_select', '=', '1' )
        ),

        array(
            'title'     => esc_html__( 'Gradient Color', 'saasland' ),
            'id'        => 'bg_gradient_color',
            'type'      => 'color_gradient',
            'required'  => array( 'error_img_select', '=', '1' ),
            'default'   => array(
                'from' => '',
                'to' => '',
            )
        ),

        // Error Page Style 02
        array(
            'title'     => esc_html__( 'Home button label', 'saasland' ),
            'id'        => 'error2_home_btn_label',
            'type'      => 'text',
            'default'   => esc_html__( 'Go Back to home Page', 'saasland' ),
            'required'  => array( 'error_img_select', '=', '2' )
        ),


        array(
            'id'          => 'btn2_font_color',
            'type'        => 'color',
            'title'       => esc_html__( 'Button Text Color', 'saasland' ),
            'required'  => array( 'error_img_select', '=', '2' ),
            'output'      => array(
                'color' => '.error_content_two .about_btn',
            ),
        ),

        array(
            'id'          => 'btn2_font_color_hover',
            'type'        => 'color',
            'title'       => esc_html__( 'Button Background Color', 'saasland' ),
            'required'  => array( 'error_img_select', '=', '2' ),
            'output'      => array(
                'background' => '.error_content_two .about_btn',
            ),
        ),

        array(
            'title'     => esc_html__( 'Error Image', 'saasland' ),
            'id'        => 'error2_image',
            'type'      => 'media',
            'compiler'  => true,
            'required'  => array( 'error_img_select', '=', '2' ),
            'default'   => array(
                'url' => SAASLAND_DIR_IMG.'/new/error.png'
            )
        ),
    )
));
