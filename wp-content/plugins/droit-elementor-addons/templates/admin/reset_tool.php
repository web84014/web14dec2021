<div class="droit-tools">
    <div class="dl_tab_menu_title dl_d_flex dl_align_center dl_flex_justify dl_mb_0">
        <div class="dl_tab_content">
            <div class="tab_content_inner">
                <div class="dl_widget_icon sidebar_icon_bg_color_3">
                    <img src="<?php echo drdt_core()->images . 'sidebar_tools.svg'; ?>" alt="">
                </div>
                <h4><?php esc_html_e('Manage Tools', 'droit-addons');?></h4>
            </div>
        </div>
    </div>
    <div class="dl_addons_element">
    <div class="dl_addons_container dl_p_0">
        <div class="dl_addons_row">
            <div class="dl_col_lg_6">
                <div class="dl_single_library_box">
                    <img src="<?php echo drdt_core()->images . 'cache_regenerate_all.svg'; ?>" alt="Regenerate Assets" class="dl_box_icon">
                    <h5 class="title"><?php esc_html_e('Regenerate All', 'droit-addons'); ?></h5>
                    <p class="description"><?php esc_html_e('Having issues? Regenerate all and start from the scratch and create new elements.', 'droit-addons'); ?></p>
                    <button class="cu_btn dl_gradient_btn btn_1 dl-btn-small re-generate-css" type="button" data-type="all" ><?php esc_html_e('Regenerate All', 'droit-addons'); ?></button>
                </div>
            </div>
            <div class="dl_col_lg_6">
                <div class="dl_single_library_box">
                    <img src="<?php echo drdt_core()->images . 'cache_regenerate_page.svg'; ?>" alt="Regenerate Assets" class="dl_box_icon">
                    <h5 class="title"><?php esc_html_e('Regenerate Icons', 'droit-addons'); ?></h5>
                    <p class="description"><?php esc_html_e('Refresh Elementor Icon? Regenerate Icon from CSS File and start over the process.', 'droit-addons'); ?></p>
                    <button class="cu_btn dl_gradient_btn btn_1 dl-btn-small re-generate-icons" type="button" data-type="icons" ><?php esc_html_e('Regenerate Icons', 'droit-addons'); ?></button>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>