<?php
// Shop page
Redux::setSection( 'saasland_opt', array(
    'title'            => esc_html__( 'Widgets', 'saasland' ),
    'id'               => 'widgets_opt',
    'icon'             => 'dashicons dashicons-welcome-widgets-menus',
    'fields'           => array(
        array(
            'title'     => esc_html__( 'Footer Widget Padding', 'saasland' ),
            'subtitle'  => esc_html__( 'Apply padding left 70px on the footer widgets (except the first widget)', 'saasland' ),
            'id'        => 'is_footer_widget_padding',
            'type'      => 'switch',
            'on'        => esc_html__( 'Yes', 'saasland' ),
            'off'       => esc_html__( 'No', 'saasland' ),
        ),
        array(
            'title'     => esc_html__( 'Search Widget Style', 'saasland' ),
            'id'        => 'search_widget_style',
            'type'      => 'image_select',
            'options'   => array(
                '1' => array(
                    'alt' => esc_html__( 'Search Widget 1', 'saasland' ),
                    'img' => SAASLAND_DIR_IMG.'/widgets/search1.jpg'
                ),
                '2' => array(
                    'alt' => esc_html__( 'Search Widget 2', 'saasland' ),
                    'img' => SAASLAND_DIR_IMG.'/widgets/search2.jpg'
                ),
            ),
            'default' => '1'
        ),
        array(
            'title'     => esc_html__( 'Tag Widget Style', 'saasland' ),
            'id'        => 'tag_widget_style',
            'type'      => 'image_select',
            'options'   => array(
                '1' => array(
                    'alt' => esc_html__( 'Tag Widget 1', 'saasland' ),
                    'img' => SAASLAND_DIR_IMG.'/widgets/tag1.jpg'
                ),
                '2' => array(
                    'alt' => esc_html__( 'Tag Widget 2', 'saasland' ),
                    'img' => SAASLAND_DIR_IMG.'/widgets/tag2.jpg'
                ),
            ),
            'default' => '1'
        ),
        array(
            'title'     => esc_html__( 'Title Border Bottom', 'saasland' ),
            'subtitle'  => esc_html__( 'Enable border at the bottom of the widget title', 'saasland' ),
            'id'        => 'widget_title_btm',
            'type'      => 'switch',
            'on'        => esc_html__( 'Yes', 'saasland' ),
            'off'       => esc_html__( 'No', 'saasland' ),
            'default'   => '',
        ),
    ),
));
