;(function ($) {
    "use strict";

    $(document).ready(function () {

        // Add job apply form class
        $('.page-job-apply .wpcf7-form').addClass('row');

        // Apply pull quote color
        let pullquote_color = $('.wp-block-pullquote').attr('style');
        $('.wp-block-pullquote blockquote').attr('style', pullquote_color);

        $('.tinv-wraper.tinv-wishlist a.tinvwl_add_to_wishlist_button').append('<i class="ti-heart"></i>');

        // Manage dropdown active classes
        function active_dropdown() {

                $('.menu li.submenu > a > span').on('click', function (event) {
                    event.preventDefault()
                    $(this).parent().parent().find('ul').first().toggle(700);
                    $(this).parent().parent().siblings().find('ul').hide(700);
                });

        }

        active_dropdown();

        $('.navbar-nav .mega_menu>.dropdown-menu').wrap('<div class="mega_menu_inner"></div>');

        if ($('.comment_box .children').length > 0) {
            $('.comment_box .children').addClass('list-unstyled reply_comment').removeClass('children');
            $('.reply_comment .post_comment').removeClass('post_comment');
        }

        $('.widget_products').addClass('widget_product');
        $('.widget_top_rated_products').addClass('widget_product');
        $('.widget_recently_viewed_products').addClass('widget_product');
        $('.widget_products ul.product_list_widget').addClass('list-unstyled');
        $('.widget_product_search').addClass('search_widget_two');
        $('.widget_product_categories ').addClass('widget_category');

        $('.footer-widget:first-child .f_widget').removeClass('pl_70 ');

        /*------------- preloader js --------------*/
        function loader() {
            $(window).on('load', function () {
                $('#ctn-preloader').addClass('loaded');
                // Una vez haya terminado el preloader aparezca el scroll

                if ($('#ctn-preloader').hasClass('loaded')) {
                    // Es para que una vez que se haya ido el preloader se elimine toda la seccion preloader
                    $('#preloader').delay(900).queue(function () {
                        $(this).remove();
                    });
                }
            });
        }

        loader();

        //* Navbar Fixed
        function navbarFixed() {
            if ($('.header_stick').length) {
                $(window).scroll(function () {
                    var scroll = $(window).scrollTop();
                    if (scroll) {
                        $(".header_stick").addClass("navbar_fixed");
                    } else {
                        $(".header_stick").removeClass("navbar_fixed");
                    }
                });
            }
        }

        navbarFixed();

        if ($('.search-btn').length) {
            $('.search-btn').on('click', function () {
                $('body').addClass('open');
                setTimeout(function () {
                    $('.search-input').focus();
                }, 500);
                return false;
            });
            $('.close_icon').on('click', function () {
                $('body').removeClass('open');
                return false;
            });
        }

        // hamburger_menu
        function offcanvasActivator() {
            if ($('.bar_menu').length) {
                $('.bar_menu').on('click', function () {
                    $('#menu').toggleClass('show-menu');
                });
                $('.close_icon').on('click', function () {
                    $('#menu').removeClass('show-menu');
                });
            }
        }

        offcanvasActivator();

        $('.offcanfas_menu .dropdown').on('show.bs.dropdown', function (e) {
            $(this).find('.dropdown-menu').first().stop(true, true).slideDown(400);
        });
        $('.offcanfas_menu .dropdown').on('hide.bs.dropdown', function (e) {
            $(this).find('.dropdown-menu').first().stop(true, true).slideUp(500);
        });

        $(window).on("load", function () {
            if ($('.mega_menu_two .scroll').length) {
                $(".mega_menu_two .scroll").mCustomScrollbar({
                    mouseWheelPixels: 50,
                    scrollInertia: 0,
                });
            }
        });

        // Update cart button
        $('.ar_top').on('click', function () {
            var getID = $(this).next().attr('id');
            var result = document.getElementById(getID);
            var qty = result.value;
            $('.shopping_cart_area .cart_btn.cart_btn_two').removeAttr('disabled');
            if (!isNaN(qty)) {
                result.value++;
                $('.cart_btn.ajax_add_to_cart').attr('data-quantity', result.value )
            } else {
                return false;
            }
        });

        $('.ar_down').on('click', function () {
            var getID = $(this).prev().attr('id');
            var result = document.getElementById(getID);
            var qty = result.value;
            $('.shopping_cart_area .cart_btn.cart_btn_two').removeAttr('disabled');
            if (!isNaN(qty) && qty > 0) {
                result.value--;
                $('.cart_btn.ajax_add_to_cart').attr('data-quantity', result.value )
            } else {
                return false;
            }
        });
    });

    var wincow_width = $( window ).width();
    if( 992 > wincow_width ){
        $('.header_area').addClass('mobile_menu_enabled');
    }

})(jQuery);