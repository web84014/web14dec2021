(function($, elementor) {
    "use strict";

 var $window = $(elementor);
    var droitElementsPro = {

        onInit: function() {
            var E_FRONT = elementorFrontend,
                E_Modules = elementorModules;

            var widgetHandlersMap = {
                'droit-countdowns.default': droitElementsPro._dl_pro_count_down,
                'droit-testimonials.default': droitElementsPro._dl_pro_swiperSlider,
            };

            $.each(widgetHandlersMap, function(widgetName, callback) {
                E_FRONT.hooks.addAction('frontend/element_ready/' + widgetName, callback);
            });

        },
        //Adv Countdown
        _dl_pro_count_down: function($scope, t) {
            var $selector = $scope.find(".droit-countdown-wrapper-pro"),
                $countdown_id = void 0 !== $selector.data("countdown-id") ? $selector.data("countdown-id") : "",
                $end_type = void 0 !== $selector.data("end-type") ? $selector.data("end-type") : "",
                $end_title = void 0 !== $selector.data("end-title") ? $selector.data("end-title") : "",
                $end_text = void 0 !== $selector.data("end-text") ? $selector.data("end-text") : "",
                $redirect_url = void 0 !== $selector.data("redirect-url") ? $selector.data("redirect-url") : "",
                $item = $scope.find("#droit-countdown-pro-" + $countdown_id);
                $item.countdown({
                    end: function () {
                        if ("text" == $end_type) $item.html('<div class="droit-countdown-action-message"><h4 class="droit-countdown-end-title">' + $end_title + '</h4><div class="droit-countdown-end-text">' + $end_text + "</div></div>");
                        else if ("url" === $end_type) {
                            _dl_pro_count_down_redirect($redirect_url);
                        }
                    },
                });
        },
        //Swiper Carousel
        _dl_pro_swiperSlider: function($scope) {
            var $swiperContainer = $scope.find('.swiper-container'),
                controls = null,
                autoplay = true,
                slider_speed = 500,
                slider_loop = true,
                slider_space = 50,
                slider_item = 1,
                slider_drag = true,
                slider_next = '.image_slider_next_one',
                slider_prev = '.image_slider_prev_one',
                slider_paginationtype = 'bullets',
                slider_pagination = '.img_carousel_pagination',
                slider_effect = '',
                slider_center = false,
                slider_breakpoints = '';

            if ($swiperContainer.attr('data-controls')) {
                var controls = JSON.parse($swiperContainer.attr('data-controls'));
                autoplay = controls.slide_autoplay == "yes" ? true : false;
                slider_speed = controls.slider_speed;
                slider_loop = controls.slider_loop == "yes" ? true : false;
                slider_space = controls.slider_space;
                slider_item = controls.slider_item;
                slider_next = controls.slider_next;
                slider_prev = controls.slider_prev;
                slider_paginationtype = controls.slider_paginationtype,
                slider_pagination = controls.slider_pagination,
                slider_center = controls.slider_center == "yes" ? true : false;  
                slider_drag = controls.slider_drag == "yes" ? true : false;  
                slider_breakpoints = controls.slider_breakpoints;  
            };
           new Swiper($swiperContainer, {
                slidesPerView: slider_item,
                spaceBetween: slider_space,
                loop: slider_loop,
                speed: slider_speed,
                simulateTouch: slider_drag,
                effect: slider_effect,
                breakpoints: slider_breakpoints,
                centeredSlides: slider_center,
                autoplay: autoplay,
                disableOnInteraction: autoplay,
                pagination: {
                    el: slider_pagination,
                    type: slider_paginationtype,
                    clickable: !0
                },
                navigation: {
                    nextEl: slider_next,
                    prevEl: slider_prev
                }
            });
            $($swiperContainer).hover(function() {
                (this).swiper.autoplay.stop();
            }, 
            function() {
                if(autoplay == true){
                    (this).swiper.autoplay.start();
                }
            }

            );
        },

    };
 function _dl_pro_count_down_redirect(url){
        window.location.replace(url)
    }

$window.on('elementor/frontend/init', droitElementsPro.onInit);


} (jQuery, window));

