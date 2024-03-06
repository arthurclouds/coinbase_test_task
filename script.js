jQuery(document).ready(function ($) {
    $('#comment-form').submit(function () {
        var formData = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: ajaxurl,
            data: formData + '&action=add_comment', 
            success: function (response) {
                $('#comments-list').prepend(response);
                $('#comment-form')[0].reset(); 
            }
        });
        return false;
    });
});
