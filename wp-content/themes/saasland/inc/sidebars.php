<?php
// Register Widget areas
add_action( 'widgets_init', function() {

    $opt = get_option( 'saasland_opt' );

    $widget_title_btm = !empty($opt['widget_title_btm']) ? $opt['widget_title_btm'] : '';
    $widget_title_btm = ($widget_title_btm == '1' ) ? '<div class="border_bottom"></div>' : '';

    $title_btm_before = !empty($opt['widget_title_btm']) ? $opt['widget_title_btm'] : '';
    $title_btm_before = ($title_btm_before == '1' ) ? '<div class="widget_title">' : '';

    $title_btm_after = !empty($opt['widget_title_btm']) ? $opt['widget_title_btm'] : '';
    $title_btm_after = ($title_btm_after == '1' ) ? '</div>' : '';

    register_sidebar( array(
        'name'          => esc_html__( 'Primary Sidebar', 'saasland' ),
        'description'   => esc_html__( 'Place widgets in sidebar widgets area.', 'saasland' ),
        'id'            => 'sidebar_widgets',
        'before_widget' => '<div id="%1$s" class="widget sidebar_widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => $title_btm_before . '<h3 class="widget_title_two">',
        'after_title'   => '</h3> '.$widget_title_btm.$title_btm_after
    ));

    if (class_exists( 'WooCommerce')) {
        register_sidebar(array(
            'name' => esc_html__( 'Shop sidebar', 'saasland' ),
            'description' => esc_html__( 'Place widgets here for WooCommerce shop page.', 'saasland' ),
            'id' => 'shop_sidebar',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h5 class="sp_widget_title">',
            'after_title' => '</h5>'
        ));
    }

    $footer_column = !empty($opt['footer_column']) ? $opt['footer_column'] : '3';

    register_sidebar(array(
        'name'          => esc_html__( 'Footer widgets', 'saasland' ),
        'description'   => esc_html__( 'Add widgets here for Footer widgets area', 'saasland' ),
        'id'            => 'footer_widgets',
        'before_widget' => '<div id="%1$s" class="widget footer-widget col-lg-'.$footer_column.' col-md-6 %2$s">
                            <div class="f_widget about-widget pl_70">',
        'after_widget'  => '</div></div>',
        'before_title'  => '<h3 class="widget_title f-title f_600 t_color f_size_18 mb_40">',
        'after_title'   => '</h3>'
    ));

});
