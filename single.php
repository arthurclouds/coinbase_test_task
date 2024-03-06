<div id="comments-list">
    <!-- Comments will be displayed here -->
</div>

<form id="comment-form" data-post-id="1">
	<?php wp_nonce_field('comment_nonce', 'comment_nonce'); ?>
    <?php comment_id_fields(); ?>
    <?php do_action('comment_form', 1); ?> <!-- ONLY FOR THE POST ID 1 -->
    <input type="text" name="comment_author" placeholder="Your Name">
    <input type="email" name="comment_email" placeholder="Your Email">
    <textarea name="comment_content" rows="4" placeholder="Your Comment"></textarea>
    <input type="submit" value="Submit Comment">
</form>
