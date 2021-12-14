  (function ($) {
    "use strict";
  if($(".dl_testimonial_slider").length){
        $('.dl_testimonial_slider').owlCarousel({
            items: 1,
            loop: true,
            margin: 10,
            nav: true,
            navText: [
                '<i class="arrow_carrot-left"></i>',
                '<i class="arrow_carrot-right"></i>'
            ],
            navContainer: '.dl_slider_arrow',

        });
    }
    }(jQuery));