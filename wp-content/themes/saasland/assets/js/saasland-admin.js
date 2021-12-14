;(function($){
    "use strict";
    // Hook into the "notice-my-class" class we added to the notice, so
    // Only listen to YOUR notices being dismissed
    $(document).ready( function() {
        $('.saasland-purchase-notice .notice-dismiss').on('click', function() {
            let url = new URL(location.href);
            url.searchParams.append('dismissed', 1);
            location.href = url;
        })
    });

})(jQuery);