<?php
wp_enqueue_script('circle-progress');
$color = get_sub_field( 'colors' );

$bar_bg_color = !empty($color['bar_bg_color']) ? "style='background-color: {$color['bar_bg_color']};'" : '';
$text_color = !empty($color['text_color']) ? "style='color: {$color['text_color']};'" : '';
?>
<div class="split_banner_content height">
    <div class="intro">
        <div class="web_skill_content">
            <h2 class="split_title" <?php echo wp_kses_post($text_color) ?>>
                <?php echo wp_kses_post(nl2br(get_sub_field('title'))) ?>
            </h2>
            <ul class="skillbar-box">
                <?php
                while ( have_rows( 'progress_bars' ) ) : the_row();
                    $color = get_sub_field( 'color' );
                    $color_bg = !empty($color) ? "style='background: $color;'" : '';
                    $color_percent = !empty($color) ? "style='color: $color;'" : '';
                    ?>
                    <li>
                        <div class="custom-skillbar-title">
                            <span <?php echo wp_kses_post($text_color) ?>> <?php the_sub_field( 'title' ); ?> </span>
                            <div class="skill-bar-percent" <?php echo wp_kses_post($color_percent) ?>><?php the_sub_field( 'progress_percentage' ); ?>%</div>
                        </div>
                        <div class="skillbar-bg" data-percent="<?php the_sub_field( 'progress_percentage' ); ?>%" <?php echo wp_kses_post($bar_bg_color) ?>>
                            <div class="custom-skillbar" <?php echo wp_kses_post($color_bg) ?>></div>
                        </div>
                    </li>
                    <?php
                endwhile;
                ?>
            </ul>
            <?php
            $button = get_sub_field( 'button' );
            if ( !empty($button['title']) ) : ?>
                <a href="<?php echo esc_url($button['url']) ?>" class="btn btn_three btn_hover"> <?php echo esc_html($button['title']) ?> </a>
            <?php endif; ?>
        </div>
    </div>
</div>