<?php
$opt = get_option( 'saasland_opt' );
$preloader_text = !empty($opt['preloader_text']) ? strtoupper($opt['preloader_text']) : strtoupper(get_bloginfo( 'name'));
$preloader_text_arr = str_split($preloader_text);
?>

<div id="preloader">
    <div id="ctn-preloader" class="ctn-preloader">
        <div class="animation-preloader">
            <div class="spinner"></div>
            <div class="txt-loading">
                <?php
                if (is_array($preloader_text_arr)) {
                    foreach ($preloader_text_arr as $pt_ti) {
                        ?>
                        <span data-text-preloader="<?php echo esc_attr($pt_ti) ?>" class="letters-loading">
                            <?php echo esc_html($pt_ti) ?>
                        </span>
                        <?php
                    }
                }
                ?>
            </div>
            <?php if (!empty($opt['loading_text'])) : ?>
                <p class="text-center"> <?php echo esc_html($opt['loading_text']) ?> </p>
            <?php endif; ?>
        </div>
        <div class="loader">
            <div class="row">
                <div class="col-lg-3 loader-section section-left"><div class="bg"></div></div>
                <div class="col-lg-3 loader-section section-left"><div class="bg"></div></div>
                <div class="col-lg-3 loader-section section-right"><div class="bg"></div></div>
                <div class="col-lg-3 loader-section section-right"><div class="bg"></div></div>
            </div>
        </div>
    </div>
</div>