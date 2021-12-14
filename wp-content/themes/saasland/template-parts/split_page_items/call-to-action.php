<?php
$c2a_colors = get_sub_field( 'colors' );
$title_color = !empty($c2a_colors['title_color']) ? "style='color: {$c2a_colors['title_color']};'" : '';
$subtitle_color = !empty($c2a_colors['subtitle_color']) ? "style='color: {$c2a_colors['subtitle_color']};'" : '';
$box_border_color = !empty($c2a_colors['box_border_color']) ? "style='border-color: {$c2a_colors['box_border_color']};'" : '';
?>
<div class="split_banner_content height">
    <div class="square one"></div>
    <div class="square two"></div>
    <div class="intro">
        <div class="split_slider_content">
            <div class="square three"></div>
            <div class="br_shap" <?php echo wp_kses_post($box_border_color) ?>></div>
            <div class="content">
                <h2 <?php echo wp_kses_post($title_color) ?>> <?php the_sub_field( 'title' ) ?> </h2>
                <p <?php echo wp_kses_post($subtitle_color) ?>> <?php the_sub_field( 'subtitle' ) ?> </p>
                <?php
                $button = get_sub_field( 'button' );
                if ( !empty($button['title']) ) : ?>
                    <a href="<?php echo esc_url($button['url']) ?>" class="btn_get btn_hover">
                        <?php echo esc_html($button['title']) ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>