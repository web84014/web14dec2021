<?php

// Color option
Redux::setSection( 'saasland_opt', array(
	'title'     => esc_html__( 'Colors', 'saasland' ),
	'id'        => 'color',
	'icon'      => 'dashicons dashicons-admin-appearance',
	'fields'    => array(
        array(
            'id'          => 'accent_solid_color',
            'type'        => 'color',
            'title'       => esc_html__( 'Accent Color', 'saasland' ),
            'output'      => array(
                'color' => '
                     a:hover, .job_listing .listing_tab .list_item .joblisting_text h4 a:hover, .shop_menu_right .shop_grid .active a,
                    .widget.widget_nav_menu ul li a:hover, .widget.widget_meta ul li a:hover, .widget.widget_pages ul li a:hover, 
                    .widget.widget_archive ul li:hover, .widget.widget_archive ul li a:hover, .widget.widget_categories ul li a:hover,
                    .error_page2 .header_area .menu > .nav-item:hover > .nav-link, .single_product_item .single_pr_details h3:hover,
                    .blog_related_post .blog_list_item .blog_content a:hover, .blog .menu > .nav-item > .nav-link:hover,
                    .blog_list_item .blog_content a:hover, .blog_grid_info .blog_list_item .blog_content a:hover .blog_title,
                    .blog_list_item_two .blog_content .post-info-bottom .post-info-comments:hover,
                    .slick-dots li.slick-active button:before, .blog_list_item_two .video_icon i,
                    .error_page2 .navbar .search_cart .shpping-cart i, .error_page2 .navbar .search_cart .search a.nav-link i, .blog .navbar .search_cart .shpping-cart i, 
                    .blog .navbar .search_cart .search a.nav-link i, .navbar_fixed .navbar .search_cart .search a.nav-link i, .navbar_fixed .navbar .search_cart .shpping-cart i,
                    .menu > .nav-item.submenu.mega_menu.mega_menu_two .mega_menu_inner .dropdown-menu .nav-item .item .text:hover,
                    .navbar .search_cart .shpping-cart .dropdown-menu .cart-single-item .cart-remove a:hover,
                    .menu > .nav-item.submenu .dropdown-menu .nav-item:hover > .nav-link span, .footer_bottom p a,
                    .blog-sidebar .widget.widget_archive ul li:hover, .blog-sidebar .widget.widget_archive ul li a:hover, .blog-sidebar .widget.widget_categories ul li a:hover,
                    .menu > .nav-item.submenu .dropdown-menu .nav-item:hover > .nav-link, .menu > .nav-item.submenu .dropdown-menu .nav-item:focus > .nav-link,
                    .pr_details .share-link .social-icon li a:hover, .car_get_quote_content .agency_banner_btn:hover,
                    .navbar .search_cart .shpping-cart .dropdown-menu .cart-single-item:hover .cart-title a,
                    .navbar .search_cart .shpping-cart .dropdown-menu .cart_f .cart-button .get_btn + .get_btn,
                    .navbar .search_cart .shpping-cart .dropdown-menu .cart_f .cart-button .get_btn:hover,
                    .comment_inner .comment_box .post_comment .post_author_two .comment_reply:hover,
                    .blog_single_info .blog_list_item_two .blog_content .post-info-bottom .social_icon ul li a:hover,
                    .blog_list_item_two .blog_content .post-info-bottom .post-info-comments:hover,
                    .blog_list_item_two .blog_content .post-info-bottom .post-info-comments i,
                    .blog_single_info .blog_list_item_two blockquote::before, blockquote::before,
                    header.header_area.navbar_fixed .navbar .navbar-nav .menu-item a.nav-link.active,
                    .blog_list_item_two .blog_content .post-info-bottom .post-info-comments i,
                    .blog_list_item_two .post_date, .qutoe_post .blog_content i,
                    .menu > .nav-item.submenu .dropdown-menu .nav-item.active > .nav-link,
                    .widget_recent_comments #recentcomments .recentcomments:before,
                    .new_footer_top .f_widget.about-widget ul li a:hover,
                    header.header_area.navbar_fixed .navbar .navbar-nav .menu-item a:hover,
                    .widget_recent_comments #recentcomments .recentcomments a:hover,
                    .widget.recent_post_widget_two .post_item .media-body h3:hover,
                    .comments_widget ul li .comments_items .media-body p:hover,
                    .widget.recent_post_widget_two .post_item .media-body h3:hover,
                    .f_widget .widget-wrap p a:hover, .pagination .nav-links .page-numbers:hover,
                    .widget.widget_recent_entries li a:hover, .widget_rss ul li a.rsswidget:hover,
                    .form-submit input#submit:hover, .job_details_area ul li:before,
                    .btn_three:hover, .checkout_button:hover, .btn_get_two:hover,
                    .pr_sidebar .widget_category ul li a:hover, .pr_sidebar .widget_tag ul li a:hover, .shopping_cart_area .cart_table .del-item a:hover,
                    .shopping_cart_area .cart_table .product-qty .ar_down:hover, .shopping_cart_area .cart_table .product-qty .ar_top:hover, 
                    .checkout_content .tab_content .login_btn:hover, .woocommerce-page #payment #place_order:hover,
                    .woocommerce-info::before, ul li.woocommerce-MyAccount-navigation-link.is-active a
                    ',

                'background-color' => '
                    .navbar .search_cart .shpping-cart .dropdown-menu .cart_f .cart-button .get_btn + .get_btn:hover,
                    .page-job-apply .btn_three:hover, .car_get_quote_content .agency_banner_btn, .arrow i:hover,
                    .product_info_details .pr_tab .nav-item.active a.nav-link,
                    .pr_details .cart_button .cart_btn:hover, .pr_details .cart_button .wish_list:hover,
                    .single_product_item .product_img .hover_content a:hover, #multiscroll-nav ul li a.active span,
                    .tagcloud a:hover, .blog_list_item .blog_content .single_post_tags.post-tags a:hover, .blog .navbar .search_cart .shpping-cart .num, 
                    .error_page2 .navbar .search_cart .shpping-cart .num, .navbar_fixed .navbar .search_cart .shpping-cart .num,
                    .job_listing .listing_tab .list_item .joblisting_text .jobsearch-job-userlist .apply_btn:hover,
                    .widget_recent_comments #recentcomments .recentcomments:hover:before, .feedback_area_three .feedback_slider_two .owl-nav i:hover,
                    .job_listing .job_list_tab .list_item_tab:before, .navbar .search_cart .shpping-cart .dropdown-menu .cart_f .cart-button .get_btn,
                    .woocommerce-account #customer_login .button, .blog_list_item .blog_content .single_post_tags.post-tags a:hover,
                    .blog_content .learn_btn_two:hover:before, .pagination .nav-links .page-numbers.current,
                    .tagcloud a:hover, p.sticky-label, .form-submit input#submit, .btn_three, .arrow i:hover, .checkout_button, .shopping_cart_area .cart_btn,
                    .btn_get_two, .new_footer_top .f_social_icon a:hover, .woocommerce #payment #place_order, .woocommerce-page #payment #place_order,
                    .woocommerce-account .woocommerce-MyAccount-content .button, .woocommerce-account #customer_login .button,
                    ul li.woocommerce-MyAccount-navigation-link.is-active a::before, .woocommerce-account .woocommerce-MyAccount-content .button:hover
                    ',
                'border-color' => '
                    .blog-sidebar .widget.widget_nav_menu ul li a:hover, .blog-sidebar .widget.widget_meta ul li a:hover, .blog-sidebar .widget.widget_pages ul li a:hover, 
                    .blog-sidebar .widget.widget_archive ul li:hover, .blog-sidebar .widget.widget_archive ul li a:hover, .blog-sidebar .widget.widget_categories ul li a:hover,
                    .job_listing .listing_tab .list_item .joblisting_text .jobsearch-job-userlist .apply_btn:hover,
                    .car_get_quote_content .agency_banner_btn, .pr_details .cart_button .cart_btn:hover, .pr_details .cart_button .wish_list:hover,
                    .navbar .search_cart .shpping-cart .dropdown-menu .cart_f .cart-button .get_btn,
                    .feedback_area_three .feedback_slider_two .owl-nav i:hover, .widget.search_widget_two .search-form .form-control:focus,
                    .blog_comment_box .get_quote_form .form-group .form-control:focus, .blog_list_item.format-audio .audio_player, .qutoe_post .blog_content,
                    .widget_recent_comments #recentcomments .recentcomments:before, .blog_single_info .blog_list_item_two blockquote, blockquote,
                    .pagination .nav-links .page-numbers:hover, .form-submit input#submit, .btn_three, .checkout_button, .shopping_cart_area .cart_btn,
                    .btn_get_two, .btn_get_two:hover, .new_footer_top .f_social_icon a:hover, .woocommerce #payment #place_order, .woocommerce-page #payment #place_order,
                    .woocommerce-info
                    ',
            ),
        ),

        array(
            'id'          => 'anchor_tag_color',
            'type'        => 'link_color',
            'title'       => esc_html__( 'Link Color', 'saasland' ),
            'output'      => array( 'a, .blog_list_item .blog_content a, .blog_list_item .blog_content p a, .footer_bottom a' )
        )
	)
));

