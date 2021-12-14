<?php
add_shortcode( 'mega_menu_thumbnail_item', function($atts, $content) {
    ob_start();
    $atts = shortcode_atts(array(
        'image_url'   => '',
        'url'         => '',
    ),$atts);
    ?>

    <li class="nav-item">
        <a href="<?php echo esc_url($atts['url']) ?>" class="item">
            <span class="img">
                <?php if(!empty($atts['ribbon_label'])): ?>
                     <span class="rebon_tap"> <?php echo esc_html($atts['ribbon_label']) ?> </span>
                <?php endif; ?>
                <?php if(!empty($atts['image_url'])) : ?>
                    <img src="<?php echo esc_url($atts['image_url']) ?>" alt="<?php echo esc_attr($content) ?>">
                <?php endif; ?>
            </span>
            <?php if(!empty($content)) : ?>
                <span class="text"> <?php echo esc_html($content) ?> </span>
            <?php endif; ?>
        </a>
    </li>

    <?php
    $html = ob_get_clean();
    return $html;
});