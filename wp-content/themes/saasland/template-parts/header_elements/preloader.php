<?php
// Preloader
$opt = get_option( 'saasland_opt' );
$is_preloader = !empty($opt['is_preloader']) ? $opt['is_preloader'] : '';
$preloader_style = !empty($opt['preloader_style']) ? $opt['preloader_style'] : 'text';

if ( $is_preloader == '1' ) {
    if ( defined( 'ELEMENTOR_VERSION' ) ) {
        if ( \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
            echo '';
        } else {
            if ( $preloader_style == 'text' ) {
                get_template_part( 'template-parts/header_elements/preloader-spin' );
            } else {
                ?>
                <div id="preloader">
                    <div id="status"></div>
                </div>
                <?php
            }
        }
    }
    else {
        if ( $preloader_style == 'text' ) {
            get_template_part( 'template-parts/header_elements/preloader-spin' );
        } else {
            ?>
            <div id="preloader">
                <div id="status"></div>
            </div>
            <?php
        }
    }
}