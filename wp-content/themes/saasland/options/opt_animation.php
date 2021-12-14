<?php
Redux::setSection( 'saasland_opt', array(
    'title'      => esc_html__( 'Animation', 'saasland' ),
    'id'         => 'animation_settings',
    'icon'       => 'dashicons dashicons-controls-play',
    'fields'     => array(
        array(
            'title'     => esc_html__( 'Website Animation', 'saasland' ),
            'subtitle'  => esc_html__( 'This will totally turn off all animations of this website.', 'saasland' ),
            'id'        => 'is_anim',
            'type'      => 'switch',
            'default'   => '1',
        ),
        array(
            'title'     => esc_html__( 'Animation Library', 'saasland' ),
            'subtitle'  => esc_html__( 'Select the animation library that will apply on the full website.', 'saasland' ),
            'id'        => 'anim_lib',
            'type'      => 'button_set',
            'options'   => [
                'saasland' => esc_html__( 'Saasland Animation Library', 'saasland' ),
                'elementor' => esc_html__( 'Elementor Animation Library', 'saasland' ),
            ],
            'default'   => 'saasland',
            'required'  => array ( 'is_anim', '=', '1' )
        ),
    )
));