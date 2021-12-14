<?php
Redux::setSection( 'saasland_opt', array(
    'title'            => esc_html__( 'Preloader', 'saasland' ),
    'id'               => 'preloader_opt',
    'icon'             => 'dashicons dashicons-controls-repeat',
    'fields'           => array(

        array(
            'id'      => 'is_preloader',
            'type'    => 'switch',
            'title'   => esc_html__( 'Pre-loader', 'saasland' ),
            'on'      => esc_html__( 'Enable', 'saasland' ),
            'off'     => esc_html__( 'Disable', 'saasland' ),
            'default' => true,
        ),

        array(
            'required' => array( 'is_preloader', '=', '1' ),
            'id'       => 'preloader_style',
            'type'     => 'select',
            'title'    => esc_html__( 'Pre-loader Style', 'saasland' ),
            'default'   => 'text',
            'options'  => array(
                'text'  => esc_html__( 'Text Preloader', 'saasland' ),
                'image' => esc_html__( 'Image Preloader', 'saasland' )
            )
        ),

        /**
         * Text Preloader
         */
        array(
            'required' => array( 'preloader_style', '=', 'text' ),
            'id'       => 'preloader_text',
            'type'     => 'text',
            'title'    => esc_html__( 'Pre-loader Text', 'saasland' ),
            'default'  => get_bloginfo( 'name' )
        ),

        array(
            'title'     => esc_html__( 'Color', 'saasland' ),
            'id'        => 'preloader_color',
            'type'      => 'color',
            'output'    => array( '.ctn-preloader .animation-preloader .txt-loading .letters-loading:before' ),
            'required'  => array( 'preloader_style', '=', 'text' ),
        ),

        array(
            'title'     => esc_html__( 'Shadow Color', 'saasland' ),
            'id'        => 'preloader_shadow_color',
            'type'      => 'color_rgba',
            'output'    => array( '.ctn-preloader .animation-preloader .txt-loading .letters-loading' ),
            'required'  => array( 'preloader_style', '=', 'text' ),
        ),
        array(
            'title'         => esc_html__( 'Typography', 'saasland' ),
            'id'            => 'preloader_typo',
            'type'          => 'typography',
            'text-align'    => false,
            'color'         => false,
            'output'        => array( '.ctn-preloader .animation-preloader .txt-loading, .ctn-preloader .animation-preloader .txt-loading .letters-loading:before' ),
            'required'      => array( 'preloader_style', '=', 'text' ),
        ),

        array(
            'id'       => 'loading_text',
            'type'     => 'text',
            'title'    => esc_html__( 'Loading Text', 'saasland' ),
            'default'  => esc_html__( 'Loading', 'saasland' ),
            'required' => array( 'preloader_style', '=', 'text' ),
        ),

        array(
            'title'         => esc_html__( 'Loading Text Typography', 'saasland' ),
            'id'            => 'preloader_small_typo',
            'type'          => 'typography',
            'text-align'    => false,
            'output'        => array( '.ctn-preloader p' ),
            'required' => array( 'preloader_style', '=', 'text' ),
        ),

        /**
         * Image Preloader
         */
        array(
            'required' => array( 'preloader_style', '=', 'image' ),
            'id'       => 'preloader_image',
            'type'     => 'media',
            'title'    => esc_html__( 'Pre-loader image', 'saasland' ),
            'compiler' => true,
            'default'  => array(
                'url' => SAASLAND_DIR_IMG . '/status.gif'
            )
        ),
    )
));