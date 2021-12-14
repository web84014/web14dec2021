<?php
$title = get_sub_field( 'title' );
$subtitle = get_sub_field( 'subtitle' );
?>
<div class="split_banner_content height">
    <div class="intro">
        <div class="app_featured_content split_app_content">
            <?php if ( !empty($title) ) : ?>
                <h2 class="split_title">
                    <?php echo wp_kses_post(nl2br($title)) ?>
                </h2>
            <?php endif; ?>
            <?php echo !empty($subtitle) ? wp_kses_post(wpautop($subtitle)) : ''; ?>
            <?php
            $btn_i = 1;
            while ( have_rows( 'buttons' ) ) : the_row();
                $btn = get_sub_field( 'button' );
                $btn_icon = get_sub_field( 'icon' );
                $button_color = get_sub_field( 'button_color' );
                $btn_type = get_sub_field( 'button_type' ) == 'outline' ? 'split_btn_outline' : '';
                if ( !empty($btn['title']) ) :
                    if ( !empty($button_color) ) {
                    if ( get_sub_field( 'button_type' ) == 'outline' ) {
                        ?>
                        <style>
                            .split_app_content .s_app_btn.split_btn_outline.split_tb_btn<?php echo esc_attr($btn_i) ?> {
                                background: transparent;
                                color: <?php the_sub_field( 'button_color' ); ?>;
                                border-color: <?php echo esc_attr($button_color) ?>;
                            }
                            .split_app_content .s_app_btn.split_btn_outline.split_tb_btn<?php echo esc_attr($btn_i) ?>:hover {
                                background: <?php echo esc_attr($button_color) ?>;
                                color: #fff;
                            }
                        </style>
                        <?php
                    } else {
                        ?>
                        <style>
                            .split_app_content .s_app_btn.split_tb_btn<?php echo esc_attr($btn_i) ?>:not(.split_btn_outline) {
                                background: <?php echo esc_attr($button_color) ?>;
                                border-color: <?php echo esc_attr($button_color) ?>;
                            }
                            .split_app_content .s_app_btn.split_tb_btn<?php echo esc_attr($btn_i) ?>:not(.split_btn_outline):hover {
                                background: transparent;
                                color: <?php echo esc_attr($button_color) ?>;
                            }
                        </style>
                        <?php
                    }}
                    ?>
                    <a href="<?php echo esc_url($btn['url']) ?>" class="btn btn_three split_tb_btn<?php echo esc_attr($btn_i) ?> s_app_btn <?php echo esc_attr($btn_type) ?>">
                        <?php if ( !empty($btn_icon) ) { ?>
                        <i class="<?php echo esc_attr($btn_icon) ?>"></i>
                        <?php } ?>
                        <?php echo esc_html($btn['title']) ?>
                    </a>
                    <?php
                endif;
                ++ $btn_i;
            endwhile;
            ?>
        </div>
    </div>
</div>