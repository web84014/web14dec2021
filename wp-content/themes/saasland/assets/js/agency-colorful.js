;(function($){
    "use strict";

    /*-------------------------------------------------------------------------------
	  Full screen sections
	-------------------------------------------------------------------------------*/
    if ($('.pagepiling').length > 0) {
        $('.pagepiling').pagepiling({
            scrollingSpeed: 280,
            loopBottom: true,
            navigation: {
                'position': 'right_position',
            },
        });
    }

    function ppTestislider(){
        var PSlider = $(".pp_testimonial_slider");
        if( PSlider.length ){
            PSlider.slick({
                autoplay: true,
                slidesToShow: 2,
                slidesToScroll: 1,
                autoplaySpeed: 3000,
                speed: 1000,
                vertical: true,
                dots: false,
                arrows: true,
                prevArrow:'.prev',
                nextArrow:'.next',
            });
        }
    }
    ppTestislider();

})(jQuery);