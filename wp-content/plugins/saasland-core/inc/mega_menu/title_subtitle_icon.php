<?php
add_shortcode( 'mega_menu_with_title_icon', function($atts, $content) {
    ob_start();
    ?>

    <ul class="dropdown-menu">
        <?php echo do_shortcode($content) ?>
    </ul>

    <?php
    $html = ob_get_clean();
    return $html;
});