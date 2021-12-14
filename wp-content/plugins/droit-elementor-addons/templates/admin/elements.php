<div class="dl_tab_menu_title dl_d_flex dl_align_center dl_flex_justify">
  <div class="dl_tab_content">
    <div class="tab_content_inner">
      <div class="dl_widget_icon sidebar_icon_bg_color_2">
        <img src="<?php echo drdt_core()->images . 'sidebar_elements.svg'; ?>" alt="">
      </div>
      <h4><?php esc_html_e('Elements', 'droit-addons');?></h4>
    </div>
  </div>
  <button type="submit" class="cu_btn btn_1 _is_disabled of_save_widget save_dl_data" data-layout='_dl_elements'>
    <?php esc_html_e('Save Settings', 'droit-addons');?></button>
</div>
<div class="filter_nav_item dl_align_center">
  <div class="filter_menu">
    <span class="fiter-data active" data-filter="*"><?php esc_html_e('all', 'droit-addons');?></span>
    <span class="fiter-data bg_2" data-filter=".free"><?php esc_html_e('free', 'droit-addons');?></span>
    <span class="fiter-data bg_3" data-filter=".pro"><?php esc_html_e('pro', 'droit-addons');?></span>
  </div>
  <div class="check_value">
    <span class="bg_4 _remove_disabled"
      id="checkAll"><?php esc_html_e('Enable All', 'droit-addons');?></span>
    <span class="bg_5 _remove_disabled"
      id="disableAll"><?php esc_html_e('Disable All', 'droit-addons');?></span>
  </div>
</div>

<div class="dl_tab_content_wrapper">
    <div class="content_wrapper_flex">
    <?php
    $widgetsOption = drdt_manager()->widgets->widgets_data();
    $elements_map = drdt_manager()->widgets::widgets_map();
    if( !empty($elements_map) ){
        foreach($elements_map as $k=>$v){
            $title            = isset($v['_title']) ? $v['_title'] : '';
            $icon             = isset($v['_icon']) ? $v['_icon'] : '';
            $icon_class       = isset($v['_icon_class']) ? $v['_icon_class'] : '';
            $is_pro           = isset($v['_droit_pro']) && $v['_droit_pro'] ? true : false;
            $pro_class        = isset($v['_droit_pro']) && $v['_droit_pro'] ? ' pro' : 'free';
            $is_pro_disabled  = isset($v['_droit_pro']) && $v['_droit_pro'] && !did_action('droitPro/loaded') ? ' disabled' : '';
            $is_pro_data_type = isset($v['_droit_pro']) && $v['_droit_pro'] ? 'is_pro' : 'free';
            $is_pro_popup     = isset($v['_droit_pro']) && $v['_droit_pro'] && !did_action('droitPro/loaded') ? ' pro_popup' : '';
            $checked = '';
            if (in_array($k, $widgetsOption)) {
                $checked = 'checked';
            }

            ?>
            <div class="colum_space <?php echo esc_attr($pro_class); ?> <?php echo esc_attr($is_pro_popup); ?>">
              <div class="dl_tab_content dt_element_switch">
                  <?php if ($is_pro): ?>
                  <span class="tricker "><?php esc_html_e('Pro', 'droit-addons');?></span>
                  <?php endif;?>
                <div class="tab_content_inner">
                    <div class="dl_widget_icon <?php echo esc_attr($icon_class); ?>">
                      <i class="<?php echo $icon; ?>"></i>
                    </div>
                    <label for="droit-elementor-<?php echo esc_attr($k); ?>" class="<?php echo esc_attr($pro_class); ?>"><?php esc_html_e($title, 'droit-addons');?></label>
                </div>
                <label class="switch <?php echo esc_attr($is_pro_popup); ?>">
                    <input type="checkbox" class="widget_checkbox _remove_disabled <?php echo esc_attr($is_pro_popup); ?>" <?php echo esc_attr($is_pro_disabled); ?> data-type="<?php echo esc_attr($is_pro_data_type); ?>" id="droit-elementor-<?php echo esc_attr($k); ?>" <?php echo $checked; ?> name="dlsave[widgets][]" data-value="<?php echo esc_attr($k); ?>" value="<?php echo esc_attr($k); ?>">
                    <span class="slider"></span>
                </label>
              </div>
            </div> 
            <?php
        }

    } else {
        esc_html_e('Oops! no widget found!', 'droit-addons');
    }

    ?>
  </div>
</div>

<div class="bottom-save-btn dl_d_flex dl_align_center dl_flex_justify dl_flex_column">
    <label><input type="checkbox" name="dlsave[enable_minify]" checked value="yes"> <?php esc_html_e('Click to minify generate css!', 'droit-addons');?></label>
    <button type="submit" class="cu_btn btn_1 _is_disabled of_save_widget save_dl_data" data-layout='_dl_elements'><?php esc_html_e('Save Settings', 'droit-addons');?></button>
</div>
