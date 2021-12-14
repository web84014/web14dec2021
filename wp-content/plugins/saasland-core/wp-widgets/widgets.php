<?php
// Require widget files
require plugin_dir_path(__FILE__) . 'Widget_Recent_posts.php';
require plugin_dir_path(__FILE__) . 'Widget_Tag_Cloud.php';
require plugin_dir_path(__FILE__) . 'Widget_Recent_comments.php';
require plugin_dir_path(__FILE__) . 'Widget_Subscribe.php';
require plugin_dir_path(__FILE__) . 'Widget_Social.php';

// Register Widgets
add_action( 'widgets_init', function() {
    register_widget( 'Widget_Recent_posts');
    register_widget('Widget_Tag_Cloud');
    register_widget('Widget_Recent_comments');
    register_widget('Widget_Subscribe');
    register_widget('Widget_Social');
});