;(function($){
    "use strict";

    $(document).ready(function () {

        /*--------- Accordion js-----------*/
        function fAqactive(){
            $(".faq_accordian_two .card").on('click', function(){
                $(".faq_accordian_two .card").removeClass("active");
                $(this).addClass('active');
            });
        }
        fAqactive();

    }); // End Document.ready

})(jQuery);