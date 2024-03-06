jQuery(document).ready(function ($) {
    $('#comment-form').submit(function () {
        var formData = $(this).serialize();
        var postID = $(this).data('post-id');
        var nonce = $('#comment_nonce').val();

        $.ajax({
            type: 'POST',
            url: custom_ajax_obj.ajaxurl,
            data: formData + '&action=add_comment&post_id=' + postID + '&comment_nonce=' + nonce,
            success: function (response) {
                $('#comments-list').prepend(response);
                $('#comment-form')[0].reset();
            }
        });

        return false;
    });
});
