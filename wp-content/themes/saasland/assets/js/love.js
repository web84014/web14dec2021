;(function($) {

    "use strict";

    $(document).on('click', '.love-button', function () {
        var post_id = $(this).data('id');
        $.ajax({
            url: local_strings.ajax_url,
            type: 'post',
            data: {
                action: 'saasland_add_post_love',
                post_id: post_id
            },
            success: function (response) {
                $('#love-count-'+post_id).html(response);
            }
        });

        return false;
    });

})(jQuery);