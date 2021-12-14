<?php
$opt = get_option( 'saasland_opt' );
$is_header_top_social = !empty($opt['is_header_top_social']) ? $opt['is_header_top_social'] : '';
?>
<div class="header_top">
    <div class="container">
        <div class="row">
            <?php if (!empty($opt['header_top_left_content'])) : ?>
                <div class="col-lg-6 header_top_column left_content">
                    <?php echo saasland_kses_post(wpautop($opt['header_top_left_content'])) ?>
                </div>
            <?php endif; ?>
            <div class="col-lg-6 header_top_column right_content">
                <?php
                if ($is_header_top_social == '1' ) {
                    ?>
                    <ul class="header_social_icon list-unstyled">
                        <?php saasland_social_links() ?>
                    </ul>
                    <?php
                } else {
                    echo !empty($opt['header_top_right_content']) ? saasland_kses_post(wpautop($opt['header_top_right_content'])) : '';
                }
                ?>
            </div>
        </div>
    </div>
</div>