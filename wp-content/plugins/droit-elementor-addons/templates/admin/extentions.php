<div class="dl_tab_menu_title dl_d_flex dl_align_center dl_flex_justify">
    <div class="dl_tab_content">
      <div class="tab_content_inner">
        <div class="dl_widget_icon sidebar_icon_bg_color_6">
          <img src="<?php echo drdt_core()->images . 'module.svg'; ?>" alt="">
        </div>
        <h4><?php esc_html_e('Modules', 'droit-addons');?></h4>
      </div>
    </div>
    <button id="of_save_widget" type="submit" class="cu_btn btn_1 _is_disabled of_save_widget save_dl_ext" data-layout='_dl_modules'><?php esc_html_e('Save Settings', 'droit-addons');?></button>
  </div>
    <div class="dl_tab_content_wrapper">
        <?php  
          $widgetsOption = drdt_manager()->modules->modules_data();
          $elements_map = drdt_manager()->modules::modules_map();
        ?>
        <div class="content_wrapper_flex">
          <?php
          if( !empty($elements_map) ){
              foreach( $elements_map as $k=>$v){

                  $checked = in_array($k, $widgetsOption) ? 'checked' : '';

                  $name = isset($v['title']) ? $v['title'] : '';
                  $icon = isset($v['icon']) ? $v['icon'] : 'dlicons-accordian';
                  $is_pro = isset($v['is_pro']) ? $v['is_pro'] : false;
                  $pro_class   = isset($v['is_pro']) && $v['is_pro'] ? 'ext-pro' : 'ext-free';
                  $is_pro_popup     = isset($v['is_pro']) && $v['is_pro'] && !did_action('droitPro/loaded') ? ' pro_popup' : '';
            
                  $is_pro_active = '';
                  if( $is_pro && !did_action('droitPro/loaded')){
                      $is_pro_active = 'disabled';
                  }
                  ?>
                  <div class="colum_space <?php echo esc_attr($pro_class);?> <?php echo esc_attr($is_pro_popup); ?>">
                      <div class="dl_tab_content dt_element_switch">
                        <?php if ($is_pro): ?>
                          <span class="tricker "><?php esc_html_e('Pro', 'droit-addons');?></span>
                        <?php endif;?>
                          <div class="tab_content_inner">
                            <div class="dl_widget_icon icon_bg_color">
                              <i class="<?php echo esc_attr($icon);?>"></i>
                            </div>
                            <label for="ext_<?php echo esc_attr($k);?>"><?php esc_html_e($name, 'droit-addons');?></label>
                          </div>
                          <label class="switch <?php echo esc_attr($is_pro_popup); ?>">
                            <input type="checkbox" id="ext_<?php echo esc_attr($k);?>" class="widget_checkbox" <?php echo $checked; ?> name="dlsave[modules][]" value="<?php echo esc_attr($k);?>" <?php echo esc_attr($is_pro_active); ?>>
                            <span class="slider"></span>
                          </label>
                    </div>
                  </div>
                  <?php
              }
          }
          ?>
      </div>
  </div>
<div class="bottom-save-btn dl_d_flex dl_align_center dl_flex_justify">
  <button id="of_save_widget" type="submit" class="cu_btn btn_1 _is_disabled of_save_widget save_dl_ext" data-layout='_dl_modules'> <?php esc_html_e('Save Settings', 'droit-addons');?></button>
</div>