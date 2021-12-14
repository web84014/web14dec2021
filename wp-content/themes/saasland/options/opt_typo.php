<?php

Redux::setSection( 'saasland_opt', array(
    'title'            => esc_html__( 'Typography', 'saasland' ),
    'id'               => 'saasland_typo_opt',
    'icon'             => 'dashicons dashicons-editor-textcolor',
    'fields'           => array(

        array(
            'id'        => 'typo_note',
            'type'      => 'info',
            'style'     => 'success',
            'title'     => esc_html__( 'Important Note', 'saasland' ),
            'icon'      => 'dashicons dashicons-info',
            'desc'      => esc_html__( 'This tab contains general typography options. Additional typography options for specific areas can be found within other tabs. Example: For menu typography options go to the Menu Settings tab.', 'saasland' )
        ),

        array(
            'id'        => 'body_typo',
            'type'      => 'typography',
            'title'     => esc_html__( 'Body Typography', 'saasland' ),
            'subtitle'  => esc_html__( 'These settings control the typography for the body text globally.', 'saasland' ),
            'description' => sprintf (
                '%1$s <a href="%2$s" target="_blank">%3$s</a> %4$s',
                esc_html__( 'You can add your own custom font', 'saasland' ),
                get_admin_url(null, 'edit-tags.php?taxonomy=dt_custom_fonts' ),
                esc_html__( 'here.', 'saasland' ),
                esc_html__( 'You will get the custom fonts in the Typography\'s Font Family list.', 'saasland' )
            ),
            'output'    => array(
                'body, .f_p, .p_service_item p, .blog_list_item_two .blog_content p'
            )
        ),
    )
));


/*** Headers Typography ***/
Redux::setSection( 'saasland_opt', array(
    'title'            => esc_html__( 'Headers Typography', 'saasland' ),
    'id'               => 'headers_typo_opt',
    'icon'             => '',
    'subsection'       => true,
    'fields'           => array(
        array(
            'id'        => 'typo_note_headers',
            'type'      => 'info',
            'style'     => 'success',
            'title'     => esc_html__( 'Important Note:', 'saasland' ),
            'icon'      => 'dashicons dashicons-info',
            'desc'      => esc_html__( 'This tab contains general typography options. Additional typography options for specific areas can be found within other tabs. Example: For menu typography options go to the Menu Settings tab.', 'saasland' )
        ),

        array(
            'id'        => 'h1_typo',
            'type'      => 'typography',
            'title'     => esc_html__( 'H1 Headers Typography', 'saasland' ),
            'subtitle'  => esc_html__( 'These settings control the typography for all H1 Headers.', 'saasland' ),
            'output'    => array( 'h1, h1.f_p, .breadcrumb_content h1' )
        ),

        array(
            'id'        => 'h2_typo',
            'type'      => 'typography',
            'title'     => esc_html__( 'H2 Headers Typography', 'saasland' ),
            'subtitle'  => esc_html__( 'These settings control the typography for all H2 Headers. The h2 title tag used in the most section title.', 'saasland' ),
            'output'    => array( 'h2, h2.f_p' )
        ),
        array(
            'id'        => 'h3_typo',
            'type'      => 'typography',
            'title'     => esc_html__( 'H3 Headers Typography', 'saasland' ),
            'subtitle'  => esc_html__( 'These settings control the typography for all H3 Headers.', 'saasland' ),
            'output'    => array( 'h3, h3.f_p, .job_details_area h3' )
        ),

        array(
            'id'        => 'h4_typo',
            'type'      => 'typography',
            'title'     => esc_html__( 'H4 Headers Typography', 'saasland' ),
            'subtitle'  => esc_html__( 'These settings control the typography for all H4 Headers.', 'saasland' ),
            'output'    => array( 'h4, h4.f_p' )
        ),

        array(
            'id'        => 'h5_typo',
            'type'      => 'typography',
            'title'     => esc_html__( 'H5 Headers Typography', 'saasland' ),
            'subtitle'  => esc_html__( 'These settings control the typography for all H5 Headers.', 'saasland' ),
            'output'    => array( 'h5, h5.f_p' )
        ),

        array(
            'id'        => 'h6_typo',
            'type'      => 'typography',
            'title'     => esc_html__( 'H6 Headers Typography', 'saasland' ),
            'subtitle'  => esc_html__( 'These settings control the typography for all H6 Headers.', 'saasland' ),
            'output'    => array( 'h6, h6.f_p, .job_info .info_item h6' )
        ),
    )
));