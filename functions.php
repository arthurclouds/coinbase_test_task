<?php
function add_comment_callback() {
    if (!isset($_POST['comment_nonce']) || !wp_verify_nonce($_POST['comment_nonce'], 'comment_nonce')) {
        die('Permission check failed');
    }

    $comment_author = sanitize_text_field($_POST['comment_author']);
    $comment_email = sanitize_email($_POST['comment_email']);
    $comment_content = sanitize_text_field($_POST['comment_content']);

    $commentdata = array(
        'comment_post_ID' => get_the_ID(),
        'comment_author' => $comment_author,
        'comment_author_email' => $comment_email,
        'comment_content' => $comment_content,
    );

    $comment_id = wp_insert_comment($commentdata);

    $comment = get_comment($comment_id);
    $comment_html = wp_list_comments('echo=0', array('comment' => $comment));

    echo $comment_html;

    die();
}

add_action('wp_ajax_add_comment', 'add_comment_callback');
add_action('wp_ajax_nopriv_add_comment', 'add_comment_callback');
