<?php
add_shortcode( 'mega_menu_title_item', function($atts, $content) {
    ob_start();
    $atts = shortcode_atts(array(
        'image_url'     => '',
        'title'         => '',
        'subtitle'      => '',
        'url'           => '',
    ),$atts);
    ?>

    <li class="nav-item">
        <a href="<?php echo esc_url($atts['url']) ?>" class="nav-link">
            <span class="navdropdown_link">
                <?php if(!empty($atts['image_url'])) : ?>
                    <span class="navdropdown_icon">
                        <img src="<?php echo esc_url($atts['image_url']) ?>" alt="<?php echo esc_attr($content) ?>">
                    </span>
                <?php endif; ?>
                <span class="navdropdown_content">
                    <?php if(!empty($content)) : ?>
                        <h5> <?php echo esc_html($content) ?> </h5>
                    <?php endif; ?>
                    <?php if(!empty($atts['subtitle'])) : ?>
                        <p> <?php echo esc_html($atts['subtitle']) ?> </p>
                    <?php endif; ?>
                </span>
            </span>
        </a>
    </li>

    <?php
    $html = ob_get_clean();
    return $html;
});