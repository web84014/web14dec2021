<?php
Redux::setSection( 'saasland_opt', array(
    'title'     => esc_html__( 'Social links', 'saasland' ),
    'id'        => 'opt_social_links',
    'icon'      => 'dashicons dashicons-share',
    'fields'    => array(

        array(
            'id'    => 'facebook',
            'type'  => 'text',
            'title' => esc_html__( 'Facebook', 'saasland' ),
            'default'	 => '#'
        ),

        array(
            'id'    => 'twitter',
            'type'  => 'text',
            'title' => esc_html__( 'Twitter', 'saasland' ),
            'default'	  => '#'
        ),

        array(
            'id'    => 'instagram',
            'type'  => 'text',
            'title' => esc_html__( 'Instagram', 'saasland' ),
        ),

        array(
            'id'    => 'linkedin',
            'type'  => 'text',
            'title' => esc_html__( 'LinkedIn', 'saasland' ),
            'default'	  => '#'
        ),

        array(
            'id'    => 'youtube',
            'type'  => 'text',
            'title' => esc_html__( 'Youtube', 'saasland' ),
        ),

        array(
            'id'    => 'dribbble',
            'type'  => 'text',
            'title' => esc_html__( 'Dribbble', 'saasland' ),
        ),

        array(
            'id'    => 'github',
            'type'  => 'text',
            'title' => esc_html__( 'GitHub', 'saasland' ),
        ),

    ),
));