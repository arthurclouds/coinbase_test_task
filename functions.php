<?php
function enqueue_custom_scripts() {
    wp_enqueue_script('jquery');
    wp_localize_script('jquery', 'custom_ajax_obj', array('ajaxurl' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

function add_comment_callback() {
	error_reporting(E_ALL);
	ini_set('display_errors', 1);

    if (!isset($_POST['comment_nonce']) || !wp_verify_nonce($_POST['comment_nonce'], 'comment_nonce')) {
        die('Permission check failed');
    }

    $comment_author = sanitize_text_field($_POST['comment_author']);
    $comment_email = sanitize_email($_POST['comment_email']);
    $comment_content = sanitize_text_field($_POST['comment_content']);
    $post_id = isset($_POST['post_id']) ? absint($_POST['post_id']) : 0; // Retrieve the post ID

    $commentdata = array(
        'comment_post_ID' => $post_id,
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

add_action( 'wp_enqueue_scripts', 'theme_scripts_styles' );

function theme_scripts_styles() {
  wp_enqueue_script( 'my-scripts', get_stylesheet_directory_uri() . '/assets/js/script.js', array(), '1.0', true );
}
