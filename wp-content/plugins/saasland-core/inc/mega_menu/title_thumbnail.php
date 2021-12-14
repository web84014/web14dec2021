<?php
add_shortcode( 'mega_menu_thumbnail', function($atts, $content) {
    ob_start();
    ?>

    <ul class="dropdown-menu scroll">
        <?php echo do_shortcode($content) ?>
    </ul>

    <?php
    $html = ob_get_clean();
    return $html;
});