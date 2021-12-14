<?php
$title = get_sub_field( 'title' );
?>

<div class="split_banner_content height">
    <div class="intro">
        <div class="split_content">
            <?php if ( !empty($title) ) : ?>
                <h2 class="split_title">
                    <?php echo wp_kses_post(nl2br($title)) ?>
                </h2>
            <?php endif; ?>
            <?php echo do_shortcode(get_sub_field( 'shortcode')) ?>
        </div>
    </div>
</div>
