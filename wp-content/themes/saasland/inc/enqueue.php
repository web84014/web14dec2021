<?php
/**
 * Register Google fonts.
 *
 * @return string Google fonts URL for the theme.
 */
function saasland_fonts_url() {
    $fonts_url = '';
    $fonts     = array();
    $subsets   = '';

    /* Body font */
    if ( 'off' !== 'on' ) {
        $fonts[] = "Poppins:300,400,500,600,700,900";
    }

    $is_ssl = is_ssl() ? 'https' : 'http';

    if ( $fonts ) {
        $fonts_url = add_query_arg( array(
            'family' => urlencode( implode( '|', $fonts  ) ),
            'subset' => urlencode( $subsets ),
        ), "$is_ssl://fonts.googleapis.com/css" );
    }

    return $fonts_url;
}

function saasland_scripts() {
    $opt = get_option( 'saasland_opt' );
    $dynamic_css = '';
    $is_preloader = !empty($opt['is_preloader']) ? $opt['is_preloader'] : '';
    $footer_visibility = function_exists( 'get_field' ) ? get_field( 'footer_visibility' ) : '1';
    $footer_visibility = isset($footer_visibility) ? $footer_visibility : '1';

    /**
     * Register Stylesheets
     */
    wp_register_style( 'saasland-fonts', saasland_fonts_url(), array(), null );
    wp_register_style( 'saasland-elements', SAASLAND_DIR_CSS.'/elements.min.css', array('bootstrap') );
    wp_register_style( 'saasland-comments', SAASLAND_DIR_CSS.'/comments.min.css' );
    wp_register_style( 'saasland-blog', SAASLAND_DIR_CSS.'/blog.min.css' );
    wp_register_style( 'eleganticons',  SAASLAND_DIR_VEND.'/elagent/style.min.css' );
    wp_register_style( 'saasland-preloader', SAASLAND_DIR_CSS.'/pre-loader.min.css' );
    wp_register_style( 'saasland-footer', SAASLAND_DIR_CSS.'/footer.min.css' );
    wp_register_style( 'saasland-404', SAASLAND_DIR_CSS.'/404.min.css' );
    wp_register_style( 'saasland-owl.carousel', SAASLAND_DIR_CSS.'/saasland-owl.carousel.min.css' );
    wp_register_style( 'saasland-animate', SAASLAND_DIR_VEND . '/animation/animate.css' );
    wp_register_style( 'saasland-custom-animations',  SAASLAND_DIR_CSS.'/saasland-animations.min.css' );
    wp_register_style( 'saasland-elementor',  SAASLAND_DIR_CSS.'/elementor-override.min.css', array('elementor-frontend') );
    wp_register_style( 'saasland-portfolio',  SAASLAND_DIR_CSS.'/single-portfolio.min.css' );
    wp_register_style( 'saasland-job',  SAASLAND_DIR_CSS.'/single-job.min.css' );
    wp_register_style( 'nice-select',  SAASLAND_DIR_VEND.'/nice-select/nice-select.min.css' );
    wp_register_style( 'saasland-overlay-menu',  SAASLAND_DIR_CSS.'/overlay-menu.min.css', array( 'saasland-root' ) );
    wp_register_style( 'saasland-team',  SAASLAND_DIR_CSS.'/single-team.css' );
    wp_register_style( 'saasland-style-new',  SAASLAND_DIR_CSS.'/style-new.min.css' );
    wp_register_style( 'saasland-digital-agency', SAASLAND_DIR_CSS.'/digital-agency.min.css' );

    /**
     * Register Scripts
     */
    wp_register_script( 'nice-select', SAASLAND_DIR_VEND.'/nice-select/jquery.nice-select.min.js', array( 'jquery' ), '1.0', true );

    /**
     * Enqueueing Stylesheets
     */
    wp_enqueue_style( 'saasland-fonts' );
    wp_enqueue_style( 'bootstrap',  SAASLAND_DIR_CSS.'/bootstrap.min.css' );
    wp_enqueue_style( 'font-awesome-5-free',  SAASLAND_DIR_VEND.'/font-awesome/css/all.css' );
    wp_enqueue_style( 'themify-icon',  SAASLAND_DIR_VEND.'/themify-icon/themify-icons.min.css' );
    wp_enqueue_style( 'saasland-elementor' );

    /**
     * Animation Library
     */
    $is_anim = isset($opt['is_anim']) ? $opt['is_anim'] : '';
    $anim_lib = !empty($opt['anim_lib']) ? $opt['anim_lib'] : '';

    if ( $anim_lib == 'saasland' ) {
        wp_deregister_style( 'elementor-animations' );
        wp_enqueue_style( 'saasland-animate' );
        wp_enqueue_style( 'saasland-custom-animations' );
    }

    if ( $is_anim != '1' ) {
        wp_deregister_style( 'elementor-animations' );
        wp_deregister_style( 'saasland-animate' );
        wp_deregister_style( 'saasland-custom-animations' );
    }

    /**
     * Single Portfolio CSS
     */
    if ( is_singular( 'portfolio' ) ) {
        wp_enqueue_style( 'saasland-portfolio' );
    }

    /**
     * Single Team CSS
     */
    if ( is_singular( 'team' ) ) {
        wp_enqueue_style( 'saasland-team' );
    }

    /**
     * Single Job / Service Page CSS
     */
    if ( is_singular( 'job' ) || is_singular( 'service' ) || is_page_template('page-job-apply-form.php') ) {
        wp_enqueue_style( 'saasland-job' );
    }

    wp_enqueue_style( 'magnific-popup',  SAASLAND_DIR_VEND.'/magnify-pop/magnific-popup.min.css' );

    wp_enqueue_style( 'eleganticons' );

    wp_enqueue_style( 'saasland-wpd',  SAASLAND_DIR_CSS.'/wpd-style.min.css' );

    wp_enqueue_style( 'saasland-main',  SAASLAND_DIR_CSS.'/style.min.css', array('bootstrap') );
    wp_enqueue_style( 'saasland-elements' );

    if ( is_page() ) {
        wp_deregister_style( 'saasland-blog' );
    }

    if ( is_home() || is_singular( 'post' ) || is_search() || is_archive() || is_singular('faq') ) {
        wp_enqueue_style( 'saasland-blog' );
    }
    wp_enqueue_style( 'saasland-comments' );

    if ( $is_preloader == '1' ) {
        wp_enqueue_style( 'saasland-preloader' );
    }

    if ( $footer_visibility == '1' ) {
        wp_enqueue_style( 'saasland-footer' );
    }

    if ( is_404() ) {
        wp_enqueue_style( 'saasland-404' );
        wp_deregister_style( 'saasland-custom-animations' );
        wp_deregister_style( 'saasland-animate' );
        wp_deregister_style( 'saasland-wpd' );
    }

    // Split Screen Page 
    if ( is_page_template( 'page-split.php' ) ) {
        wp_enqueue_style( 'multiscroll',  SAASLAND_DIR_VEND.'/multiscroll/jquery.multiscroll.css' );
        wp_enqueue_style( 'saasland-split-page',  SAASLAND_DIR_CSS.'/split-page.min.css', array( 'saasland-root' ) );
    }

    // Agency Colorful
    if ( is_page_template( 'page-agency-colorful.php' ) ) {
        wp_enqueue_style( 'saasland-pagepiling',  SAASLAND_DIR_VEND.'/pagepiling/jquery.pagepiling.css' );
        wp_enqueue_style( 'saasland-slick',  SAASLAND_DIR_VEND.'/slick/slick.css' );
        wp_enqueue_style( 'slick-theme',  SAASLAND_DIR_VEND.'/slick/slick-theme.min.css' );
        wp_enqueue_style( 'saasland-agency-colorful',  SAASLAND_DIR_CSS.'/agency-colorful.min.css', array( 'saasland-root' ) );
    }

    // Case Study page
    if ( is_singular( 'case_study' ) || is_post_type_archive( 'case_study' ) ) {
        wp_enqueue_style( 'saasland-cstudy', SAASLAND_DIR_CSS.'/cstudy.min.css' );
    }

    wp_enqueue_style( 'saasland-gutenberg',  SAASLAND_DIR_CSS.'/gutenberg.min.css' );

    if ( is_rtl() ) {
        wp_enqueue_style( 'saasland-rtl', SAASLAND_DIR_CSS . '/theme-rtl.min.css');
    }

    wp_enqueue_style( 'saasland-root', get_stylesheet_uri() );

    wp_enqueue_style( 'saasland-responsive', SAASLAND_DIR_CSS.'/responsive.min.css' );

    wp_enqueue_style( 'saasland-responsive2', SAASLAND_DIR_CSS.'/responsive-2.css' );

    /**
     * Options from Theme Settings
     */
    if ( class_exists('ReduxFrameworkPlugin') ) {
        /**
         * Post banner height
         */
        if ( !empty($opt['post_banner_height']) ) {
            $dynamic_css .= ".blog_breadcrumb_area{height: {$opt['post_banner_height']}px;}";
        }


        /**
         * Mobile Menu Settings
         */
        if ( !empty($opt['mobile_menu_dropdown_bg']) ) {
            $dynamic_css .= "
            @media (max-width: 991px) {
                ul#menu-main-menu, .menu>.nav-item.submenu .dropdown-menu .nav-item {
                    background: {$opt['mobile_menu_dropdown_bg']} !important;
                }
            }";
        }
        if ( !empty($opt['mobile_menu_font_color']) ) {
            $dynamic_css .= "
            @media (max-width: 991px) {
                header.header_area .menu > .nav-item > .nav-link, .header_area .navbar .navbar-nav .menu-item a, .menu>.nav-item.submenu .dropdown-menu .nav-item .nav-link, .dropdown-menu span.arrow_carrot-right {
                    color: {$opt['mobile_menu_font_color']} !important;
                }
            }";
        }
        if ( !empty($opt['mobile_menu_separator_color']) ) {
            $dynamic_css .= "
            @media (max-width: 991px) {
                .menu>.nav-item {
                    border-bottom-color: {$opt['mobile_menu_separator_color']['rgba']} !important;
                }
            }";
        }

        //404 Gradient Color
        if ( !empty($opt['bg_gradient_color']['from']) ) {
            $dynamic_css .= "
            .error_area {
                background:-webkit-linear-gradient(180deg, ".esc_attr($opt['bg_gradient_color']['from'])." 0%, {$opt['bg_gradient_color']['to']} 100%);
            }";
        }

        // 404 background shape
        if ( !empty($opt['error_bg_shape_image']['url']) ) {
            $dynamic_css .= "
                .error_area {
                    background: url({$opt['error_bg_shape_image']['url']} ) no-repeat scroll center 100%;
                }";
        }

        /**
         * Preloader
         */
        $is_preloader = !empty($opt['is_preloader'] ) ? $opt['is_preloader'] : '';
        $preloader_image = isset($opt['preloader_image']['url'] ) ? $opt['preloader_image']['url'] : SAASLAND_DIR_IMG.'/status.gif';
        $preloader_style = !empty($opt['preloader_style'] ) ? $opt['preloader_style'] : 'text';
        if ( $preloader_style == 'image' && $is_preloader == '1' ) {
            $dynamic_css .= "
            #status {
                background-image: url(" . esc_url($preloader_image ) . ");
                background-repeat: no-repeat;
                background-position: center;
            }";
        }

        /**
         * Banner Title-bar
         */
        if ( !empty($opt['banner_overlay_color']['from']) ) {
            $dynamic_css .= "
            .breadcrumb_area {
                background-image: -moz-linear-gradient(180deg, " . esc_attr($opt['banner_overlay_color']['from'] ) . " 0%, {$opt['banner_overlay_color']['to']} 100%);
                background-image: -webkit-linear-gradient(180deg, " . esc_attr($opt['banner_overlay_color']['from'] ) . " 0%, {$opt['banner_overlay_color']['to']} 100%);
                background-image: -ms-linear-gradient(180deg, " . esc_attr($opt['banner_overlay_color']['from'] ) . " 0%, {$opt['banner_overlay_color']['to']} 100%);
            }";
        }
        if ( is_singular('post') && !empty($opt['post_banner_overlay_color']['from'] && !empty($opt['post_banner_overlay_color']['to']) ) ) {
            $pb_opacity = !empty($opt['post_banner_overlay_opacity']) ? "opacity:{$opt['post_banner_overlay_opacity']};" : '';
            $dynamic_css .= "
            .blog_breadcrumb_area .background_overlay {
                background-image: -moz-linear-gradient(-140deg, {$opt['post_banner_overlay_color']['to']} 0%, {$opt['post_banner_overlay_color']['from']} 100%);
                background-image: -webkit-linear-gradient(-140deg, {$opt['post_banner_overlay_color']['to']} 0%, {$opt['post_banner_overlay_color']['from']} 100%);
                background-image: -ms-linear-gradient(-140deg, {$opt['post_banner_overlay_color']['to']} 0%, {$opt['post_banner_overlay_color']['from']} 100%);
                $pb_opacity
            }";
        }
        if ( !empty($opt['post_banner_bg']['url']) ) {
            $dynamic_css .= " .blog_breadcrumb_area{ background: url({$opt['post_banner_bg']['url']}) no-repeat scroll center 0 / cover; }";
        }

        if ( class_exists('WooCommerce') ) {
            if ( is_shop() ) {
                $shop_header_bg = !empty($opt['shop_header_bg']['url']) ? $opt['shop_header_bg']['url'] : '';
                if ( !empty($shop_header_bg) ) {
                    $dynamic_css .= ".shop .breadcrumb_area::after { content: ''; position: absolute; background-color: $shop_header_bg; width: 100%; height: 100%; top: 0; left: 0; z-index: -1; }";
                }
            }
        }

        /**
         * Footer Images
         */
        if ( !empty($opt['footer_bg_image']['url']) ) {
            $dynamic_css .= "
                .new_footer_top .footer_bg {
                    background: url({$opt['footer_bg_image']['url']} ) no-repeat scroll center 0 !important;
                }";
        }
        if ( !empty($opt['footer_obj_1']['url']) ) {
            $dynamic_css .= "
                .new_footer_top .footer_bg .footer_bg_one {
                    background: url({$opt['footer_obj_1']['url']} ) no-repeat center center !important;
                }";
        }
        if ( !empty($opt['footer_obj_2']['url']) ) {
            $dynamic_css .= "
                .new_footer_top .footer_bg .footer_bg_two {
                    background: url({$opt['footer_obj_2']['url']} ) no-repeat center center !important;
                }";
        }

        if( is_singular( 'portfolio' ) ){
            $color_1 = !empty( $opt['portfolio_bg_1']['rgba'] ) ? $opt['portfolio_bg_1']['rgba'] : '#00000005';
            $color_2 = !empty( $opt['portfolio_bg_2']['rgba'] ) ? $opt['portfolio_bg_2']['rgba'] : $color_1;
            $bg_image= !empty( $opt['portfolio_titlebar_bg']['url'] ) ? ' background : url( '.$opt['portfolio_titlebar_bg']['url'].' )' : '';
            $dynamic_css .= "
                .single-portfolio section.breadcrumb_area{
                    $bg_image;
                }
                .single-portfolio section.breadcrumb_area:before {
                    background-image: -webkit-linear-gradient(180deg,{$color_1} 0,{$color_2} 100%);
                }";
        }
        if( is_singular( 'service' ) ){
            $color_1 = !empty( $opt['service_bg_1']['rgba'] ) ? $opt['service_bg_1']['rgba'] : '#00000005';
            $color_2 = !empty( $opt['service_bg_2']['rgba'] ) ? $opt['service_bg_2']['rgba'] : $color_1;
            $bg_image= !empty( $opt['service_titlebar_bg']['url'] ) ? ' background : url( '.$opt['service_titlebar_bg']['url'].' )' : '';
            $dynamic_css .= "
                .single-service section.breadcrumb_area{
                    $bg_image;
                }
                .single-service section.breadcrumb_area:before {
                    background-image: -webkit-linear-gradient(180deg,{$color_1} 0,{$color_2} 100%);
                }";
        }
        if( is_singular( 'case_study' ) ){
            $color_1 = !empty( $opt['service_bg_1']['rgba'] ) ? $opt['service_bg_1']['rgba'] : '#00000005';
            $color_2 = !empty( $opt['service_bg_2']['rgba'] ) ? $opt['service_bg_2']['rgba'] : $color_1;
            $bg_image= !empty( $opt['service_titlebar_bg']['url'] ) ? ' background : url( '.$opt['service_titlebar_bg']['url'].' )' : '';
            $dynamic_css .= "
                .single-service section.breadcrumb_area{
                    $bg_image;
                }
                .single-service section.breadcrumb_area:before {
                    background-image: -webkit-linear-gradient(180deg,{$color_1} 0,{$color_2} 100%);
                }";
        }
    }

    /**
     * Dynamic CSS render for Page
     */
    if ( function_exists('get_field') ) {
        /**
         * Banner Styling
         */
        $banner_text_color = get_field('banner_text_color');
        if ( !empty($banner_text_color) ) {
            $dynamic_css .= ".breadcrumb_content h1, .breadcrumb_content p { color: $banner_text_color; }";
        }


        // Banner Overlay Color
        $banner_bg_type = function_exists('get_field') ? get_field('banner_background_type') : '';
        $banner_overlay_color = get_field('banner_overlay_color');
        if ( !empty($banner_overlay_color) && $banner_bg_type == 'image' ) {
            $dynamic_css .= ".breadcrumb_area::after {content: ''; position: absolute; background-color: $banner_overlay_color; width: 100%; height: 100%; top: 0; left: 0; z-index: -1;}";
        }

        // Title-bar Banner Background Gradient Colors
        $banner_bg_color_right = function_exists( 'get_field' ) ? get_field( 'background_color_right' ) : '';
        if ( !empty($banner_bg_color_right) && $banner_bg_type == 'color' ) {
            $dynamic_css .= "
            .breadcrumb_area {
                background-image: -moz-linear-gradient(180deg, " . esc_attr(get_field( 'background_color_right' ) ) . " 0%, " . get_field( 'background_color_left' ) . " 100% ) !important;
                background-image: -webkit-linear-gradient(180deg, " . esc_attr(get_field( 'background_color_right' ) ) . " 0%, " . get_field( 'background_color_left' ) . " 100% ) !important;
                background-image: -ms-linear-gradient(180deg, " . esc_attr(get_field( 'background_color_right' ) ) . " 0%, " . get_field( 'background_color_left' ) . " 100% ) !important;
            }";
        }

        // Single post banner colors
        if ( is_singular( 'post' ) ) {
            $post_banner_text_color = get_field('post_banner_text_color');
            $banner_color_opacity = get_field('banner_color_opacity');
            $banner_background_color_right = get_field('background_color_right');
            $banner_background_color_left = get_field('background_color_left');
            if ( !empty($post_banner_text_color) ) {
                $dynamic_css .= ".blog_breadcrumb_area .breadcrumb_content_two h1, .blog_breadcrumb_area .breadcrumb_content_two, .blog_breadcrumb_area .breadcrumb_content_two h5 a, .blog_breadcrumb_area .breadcrumb_content_two ol li a { color: $post_banner_text_color; }";
            }
            if ( !empty($banner_color_opacity) ) {
                $dynamic_css .= ".blog_breadcrumb_area .background_overlay{opacity: 0.$banner_color_opacity;}";
            }
            if ( !empty($banner_background_color_left) && !empty($banner_background_color_right) ) {
                $dynamic_css .= "
                .blog_breadcrumb_area .background_overlay {
                    background-image: -moz-linear-gradient(-140deg, $banner_background_color_right 0%, $banner_background_color_left 100%);
                    background-image: -webkit-linear-gradient(-140deg, $banner_background_color_right 0%, $banner_background_color_left 100%);
                    background-image: -ms-linear-gradient(-140deg, $banner_background_color_right 0%, $banner_background_color_left 100%);
                }";
            }
        }

        /**
         * Customize the Action Button
         */
        $customize_button = get_field( 'customize_the_button' );
        if ( $customize_button == '1' ) {
            $btn_font_size = get_field( 'font_size' );
            $btn_border_width = get_field( 'border_width' );
            $btn_shadow = get_field( 'shadow' );
            $btn_border_radius = get_field( 'border_radious' );
            $btn_normal = get_field( 'normal' );
            $sticky_btn_normal = get_field( 'sticky_normal' );
            $btn_hover = get_field( 'hover' );
            $sticky_btn_hover = get_field( 'sticky_hover' );

            $btn_hover_background_color = !empty($btn_hover['background_color'] ) ? "background: {$btn_hover['background_color']};" : '';
            $btn_hover_font_color = !empty($btn_hover['font_color'] ) ? "color: {$btn_hover['font_color']};" : '';
            $btn_hover_border_color = !empty($btn_hover['border_color'] ) ? "border-color: {$btn_hover['border_color']};" : '';
            $btn_hover_shadow = (isset($btn_hover['box_shadow'] ) && $btn_hover['box_shadow'] == '1' ) ? "-webkit-box-shadow: 0px 10px 20px 0px rgba(0, 11, 40, 0.1); box-shadow: 0px 10px 20px 0px rgba(0, 11, 40, 0.1);" : 'box-shadow: none;';

            $btn_normal_background_color = !empty($btn_normal['background_color'] ) ? "background: {$btn_normal['background_color']};" : '';
            $btn_normal_font_color = !empty($btn_normal['font_color'] ) ? "color: {$btn_normal['font_color']};" : '';
            $btn_normal_border_color = !empty($btn_normal['border_color'] ) ? "border-color: {$btn_normal['border_color']};" : '';
            $btn_normal_shadow = (isset($btn_normal['box_shadow'] ) && $btn_normal['box_shadow'] == '1' ) ? "-webkit-box-shadow: 0px 10px 20px 0px rgba(0, 11, 40, 0.1); box-shadow: 0px 10px 20px 0px rgba(0, 11, 40, 0.1);" : 'box-shadow: none;';

            $btn_border_radius_top_left = !empty($btn_border_radius['top_left'] ) || $btn_border_radius['top_left'] == '0' ? "border-top-left-radius: {$btn_border_radius['top_left']}px;" : '';
            $btn_border_radius_top_right = !empty($btn_border_radius['top_right'] ) || $btn_border_radius['top_right'] == '0' ? "border-top-right-radius: {$btn_border_radius['top_right']}px;" : '';
            $btn_border_radius_bottom_right = !empty($btn_border_radius['bottom-right'] ) || $btn_border_radius['bottom-right'] == '0' ? "border-bottom-right-radius: {$btn_border_radius['bottom-right']}px;" : '';
            $btn_border_radius_bottom_left = !empty($btn_border_radius['bottom-left'] ) || $btn_border_radius['bottom-left'] == '0' ? "border-bottom-left-radius: {$btn_border_radius['bottom-left']}px;" : '';

            $btn_shadow = ($btn_shadow == '1' ) ? "-webkit-box-shadow: 0px 20px 24px 0px rgba(0, 11, 40, 0.1); box-shadow: 0px 20px 24px 0px rgba(0, 11, 40, 0.1);" : '';
            $btn_shadow = ($btn_shadow == '' ) ? "box-shadow: none;" : '';
            $btn_border_width = !empty($btn_border_width ) ? "border-width: {$btn_border_width}px;" : '';
            $btn_font_size = !empty($btn_font_size ) ? "font-size: {$btn_font_size}px;" : '';

            // Sticky button style
            $sticky_btn_hover_background_color = !empty($sticky_btn_hover['background_color'] ) ? "background: {$sticky_btn_hover['background_color']};" : '';
            $sticky_btn_hover_font_color = !empty($sticky_btn_hover['font_color'] ) ? "color: {$sticky_btn_hover['font_color']};" : '';
            $sticky_btn_hover_border_color = !empty($sticky_btn_hover['border_color'] ) ? "border-color: {$sticky_btn_hover['border_color']};" : '';

            $sticky_btn_normal_background_color = !empty($sticky_btn_normal['background_color'] ) ? "background: {$sticky_btn_normal['background_color']};" : '';
            $sticky_btn_normal_font_color = !empty($sticky_btn_normal['font_color'] ) ? "color: {$sticky_btn_normal['font_color']};" : '';
            $sticky_btn_normal_border_color = !empty($sticky_btn_normal['border_color'] ) ? "border-color: {$sticky_btn_normal['border_color']};" : '';
            $dynamic_css .= "
            .header_area .navbar .btn_get.btn-meta {
                $btn_font_size
                $btn_border_width
                $btn_shadow
                $btn_border_radius_top_left 
                $btn_border_radius_top_right
                $btn_border_radius_bottom_right
                $btn_border_radius_bottom_left 
                $btn_normal_background_color
                $btn_normal_font_color
                $btn_normal_border_color
                $btn_normal_shadow
            }
            .header_area .navbar .btn_get.btn-meta:hover {
                $btn_hover_background_color
                $btn_hover_font_color
                $btn_hover_border_color
                $btn_hover_shadow
            }
            .header_area.navbar_fixed .navbar .btn_get.btn-meta {
                $sticky_btn_normal_background_color
                $sticky_btn_normal_font_color
                $sticky_btn_normal_border_color
            }
            .header_area.navbar_fixed .navbar .btn_get.btn-meta:hover {
                $sticky_btn_hover_background_color
                $sticky_btn_hover_font_color
                $sticky_btn_hover_border_color
            }
        ";
        }

        /**
         * Menu Item Active Color
         */
        $menu_item_active_color = function_exists( 'get_field' ) ? get_field( 'menu_item_active_color' ) : '';
        $menu_color  = !empty( $menu_item_active_color ) ? 'color: '.$menu_item_active_color.' !important;' : '';
        $menu_border = !empty( $menu_item_active_color ) ? 'background-color: '.$menu_item_active_color : '';
        if ( !empty($menu_item_active_color) ) {
            $dynamic_css .= "
            header.header_area.navbar_fixed .navbar .navbar-nav .menu-item a.nav-link.active,
            .header_area .menu > .nav-item .nav-link:hover,
            .header_area .menu > .nav-item.active>.nav-link,
            .header_area .menu > .nav-item.submenu .dropdown-menu .nav-item.active > .nav-link,
            .header_area.navbar_fixed .menu_six .menu > .nav-item:hover > .nav-link,
            .nav-item.submenu .dropdown-menu .nav-item:hover > .nav-link span.arrow_carrot-right,
            .header_area .menu > .nav-item.active .nav-link+.dropdown-menu .nav-item .nav-link:hover, 
            .header_area .menu > .nav-item.submenu .dropdown-menu .nav-item:hover > .nav-link,
            .header_area .menu > .nav-item.active .nav-link+.dropdown-menu .active .nav-link {
                {$menu_color}
            }
            .menu>.nav-item>.nav-link:before{
                {$menu_border}
            }
        ";
        }

        /**
         * Page Padding controls
         */
        $page_padding = function_exists( 'get_field' ) ? get_field( 'page_content_padding' ) : '';
        // Padding top
        if ( isset($page_padding['padding_top']) ) {
            $dynamic_css .= "
                .single-product .product_details_area,
                .single section.blog_area_two,
                .elementor-template-full-width .elementor.elementor-".get_the_ID().",
                .sec_pad.page_wrapper {
                    padding-top: {$page_padding['padding_top']}px;
                }";
        }

        // Padding bottom
        if ( isset($page_padding['padding_bottom']) ) {
            $dynamic_css .= "
            .single-post section.blog_area_two,
            .elementor-template-full-width .elementor.elementor-" . get_the_ID() . ",
            .sec_pad.page_wrapper {
                padding-bottom: {$page_padding['padding_bottom']}px;
            } ";
        }

        /**
         * Page background color
         */
        $page_bg_color = function_exists( 'get_field' ) ? get_field( 'background_color' ) : '';
        if ( !empty($page_bg_color) ) {
            $dynamic_css .= "
            .elementor-template-full-width .elementor.elementor-" . get_the_ID() . ",
            .sec_pad.page_wrapper {
                background:" . $page_bg_color . ";
            }";
        }

        /**
         * Menu Item Color
         */
        $menu_item_color = get_field( 'menu_item_color' );
        if ( !empty($menu_item_color) ) {
            $dynamic_css .= ".menu > .nav-item > .nav-link {color: $menu_item_color !important;}";
            $dynamic_css .= ".menu_toggle .hamburger span, .menu_toggle .hamburger-cross span {background-color: $menu_item_color !important;}";
        }

        $sticky_menu_color = get_field( 'sticky_menu_color' );
        if ( $sticky_menu_color ) {
            $dynamic_css .= "header.header_area.navbar_fixed .navbar .navbar-nav .menu-item a {color: $sticky_menu_color;}";
        }

        $mini_cart = get_field( 'mini_cart' );
        $cart_color =  !empty($mini_cart['cart_color'] ) ? $mini_cart['cart_color'] : '';
        $count_text_color =  !empty($mini_cart['count_text_color'] ) ? $mini_cart['count_text_color'] : '';
        if ( $cart_color ) {
            $dynamic_css .= "
                .navbar .search_cart .search a.nav-link i,
                .navbar .search_cart .shpping-cart i {
                    color: $cart_color !important;
                }
                .navbar .search_cart .shpping-cart .num {
                    background: $cart_color !important;
                }";
        }

        if ( $count_text_color ) {
            $dynamic_css .= "
                .navbar .search_cart .shpping-cart .num {
                    color: $count_text_color !important;
                }";
        }
    }

    wp_add_inline_style( 'saasland-responsive', $dynamic_css);

    /**
     * Enqueueing JavaScript Files
     */
    wp_enqueue_script( 'propper', SAASLAND_DIR_JS.'/propper.js', array( 'jquery' ), '1.0', true );

    wp_enqueue_script( 'bootstrap', SAASLAND_DIR_JS.'/bootstrap.min.js', array( 'jquery' ), '4.1.2', true );

    wp_enqueue_script( 'parallax-scroll', SAASLAND_DIR_VEND.'/sckroller/jquery.parallax-scroll.js', array( 'jquery' ), '1.0', true );

    wp_enqueue_script( 'magnific-popup', SAASLAND_DIR_VEND.'/magnify-pop/jquery.magnific-popup.min.js', array( 'jquery' ), '1.1.0', true );

    if ( is_page_template( 'page-job-apply-form.php' ) ) {
        wp_enqueue_style( 'nice-select' );
        wp_enqueue_script( 'nice-select' );
    }

    if ( is_page_template( 'page-split.php' ) ) {
        wp_enqueue_script( 'jquery-easings', SAASLAND_DIR_VEND.'/multiscroll/jquery.easings.min.js', array( 'jquery' ), '1.9.2', true);
        wp_enqueue_script( 'multiscroll', SAASLAND_DIR_VEND.'/multiscroll/multiscroll.responsiveExpand.min.js', array( 'jquery' ), '0.0.4', true);
        wp_enqueue_script( 'multiscroll-extensions', SAASLAND_DIR_VEND.'/multiscroll/jquery.multiscroll.extensions.min.js', array( 'jquery' ), '0.1.5', true);
        wp_enqueue_script( 'saasland-multi', SAASLAND_DIR_VEND.'/multiscroll/multi.js', array( 'jquery' ), '1.0', true);
    }

    // Agency Colorful
    if ( is_page_template( 'page-agency-colorful.php' ) ) {
        wp_enqueue_script( 'jquery-pagepiling', SAASLAND_DIR_VEND.'/pagepiling/jquery.pagepiling.js', array( 'jquery' ), '1.5.4', true);
        wp_enqueue_script( 'slick', SAASLAND_DIR_VEND.'/slick/slick.js', array( 'jquery' ), '1.0', true);
        wp_enqueue_script( 'agency-colorful', SAASLAND_DIR_JS.'/agency-colorful.js', array( 'jquery' ), '1.0', true);
    }

    // Love js
    if ( is_singular( 'case_study' ) ) {
        wp_enqueue_script( 'saasland-love', get_template_directory_uri() . '/assets/js/love.js', array( 'jquery' ), '1.0', true);
    }

    if ( class_exists( 'WooCommerce' ) ) {
        wp_register_style( 'saasland-shop', SAASLAND_DIR_CSS.'/shop.min.css' );
        wp_register_style( 'saasland-checkout', SAASLAND_DIR_CSS.'/checkout.min.css' );
        wp_register_style( 'saasland-shop-my-account', SAASLAND_DIR_CSS.'/shop-my_account.min.css' );

        wp_register_script( 'saasland-quick-view', SAASLAND_DIR_JS.'/saasland-quick-view.js', '', '1.0', true );

        if ( is_shop() || is_tax( 'product_cat' ) || is_singular( 'product' ) || is_tax( 'product_tag' ) || is_cart() ) {
            wp_enqueue_style( 'saasland-shop' );
        }

        if ( is_checkout() ) {
            wp_enqueue_style( 'saasland-checkout' );
        }

        if ( is_account_page() ) {
            wp_enqueue_style( 'saasland-shop-my-account' );
        }

        if ( function_exists( 'is_wishlist' ) ) {
            if ( is_wishlist() ) {
                wp_enqueue_style( 'saasland-shop' );
            }
        }

        if ( is_shop() || is_tax( 'product_cat' ) || is_tax( 'product_tag' ) ) {
            wp_enqueue_style( 'nice-select' );
            wp_enqueue_script( 'nice-select' );
            wp_enqueue_script( 'saasland-quick-view' );
        }
    }

    $mega_menus = new WP_Query(array(
        'post_type' => 'megamenu',
        'posts_per_page' => -1,
    ));

    $mega_menu_count = $mega_menus->post_count;
    if ( $mega_menu_count > 0  ) {
        wp_enqueue_style( 'mCustomScrollbar', SAASLAND_DIR_VEND.'/scroll/jquery.mCustomScrollbar.min.css' );
        wp_enqueue_script( 'mCustomScrollbar', SAASLAND_DIR_VEND.'/scroll/jquery.mCustomScrollbar.concat.min.js', array( 'jquery' ), '3.1.13', true);
    }

    wp_enqueue_script( 'saasland-custom-wp', SAASLAND_DIR_JS.'/custom-wp.js', array( 'jquery' ), '1.0', true );

    $dynamic_js = '';

    if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
        $is_footer_widget_padding = !empty($opt['is_footer_widget_padding']) ? $opt['is_footer_widget_padding'] : '';
        if ($is_footer_widget_padding != '1') {
            $dynamic_js .= "
            ;(function($){
                $(document).ready(function () {
                    $( '.footer-widget .f_widget' ).removeClass( 'pl_70' ); \n
                });
            })(jQuery);";
        }

        $is_preloader = !empty($opt['is_preloader']) ? $opt['is_preloader'] : '';
        if ($is_preloader == '1') {
            $dynamic_js .= "
            //<![CDATA[
                jQuery(window).on( 'load', function() { // makes sure the whole site is loaded 
                    jQuery( '#status' ).fadeOut(); // will first fade out the loading animation 
                    jQuery( '#preloader' ).delay(350).fadeOut( 'slow' ); // will fade out the white DIV that covers the website. 
                    jQuery( 'body' ).delay(350).css({'overflow':'visible'});
                })
            //]]>"."\n";
        }

        $search_widget_style = !empty($opt['search_widget_style']) ? $opt['search_widget_style'] : '';
        if ($search_widget_style == '1') {
            $dynamic_js .= "
            ;(function($){
                $(document).ready(function () {
                    $( '.widget_search' ).removeClass( 'widget_search' ).addClass( 'search_widget_two' );
                });
            })(jQuery);";
        }
    }

    if ( function_exists('get_field') ) {
        $navigation = get_field('navigation');
        if ( $navigation == 'onepage' ) {
            $dynamic_js .= "
            ;(function($){
                jQuery('.navbar-nav .nav-link').on('click', function() {
                    jQuery('.navbar-collapse').collapse('hide');
                });
            })(jQuery);";
        }
    }

    wp_localize_script( 'saasland-custom-wp', 'local_strings', array(
        'ajax_url' => admin_url( 'admin-ajax.php' )
    ));

    wp_add_inline_script( 'saasland-custom-wp', $dynamic_js);

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'saasland_scripts' );

/**
 * Admin dashboard style and scripts
 */
add_action( 'admin_enqueue_scripts', function() {
    global $pagenow;
    wp_enqueue_style( 'saasland-admin', SAASLAND_DIR_CSS.'/admin.min.css' );
    wp_enqueue_script( 'saasland-admin', SAASLAND_DIR_JS.'/saasland-admin.js', array('jquery'), '1.0.0', true );
    wp_register_style( 'eleganticons',  SAASLAND_DIR_VEND.'/elagent/style.min.css' );
    wp_register_style( 'saasland-fonts', saasland_fonts_url(), array(), null);
    if ( $pagenow == 'admin.php' ) {
        wp_enqueue_style( 'saasland-fonts' );
        wp_enqueue_style( 'eleganticons' );
        wp_enqueue_style( 'saasland-admin-dashboard', SAASLAND_DIR_CSS.'/admin-dashboard.min.css' );
    }
});

/**
 * Gutenberg editor assets
 */
add_action( 'enqueue_block_assets', function() {
    wp_enqueue_style( 'saasland-editor-fonts', saasland_fonts_url(), array(), null );
    wp_enqueue_style( 'font-awesome-5-free',  SAASLAND_DIR_VEND.'/font-awesome/css/all.css' );
});