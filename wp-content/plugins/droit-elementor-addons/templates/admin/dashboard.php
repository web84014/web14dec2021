<div id="wrapper">
  <div class="dl_elementor_addons_pack dl_sidebar_tab">
    <div class="dl-notice-show">
      <?php do_action('dladdons_notice'); ?>
    </div>
    <div class="dl_elementor_addon_content dl_d_flex">
      <div class="dl_tab_menu_content">
        <div class="sticky_sldebar">
          <h4 class="droit-logo-text"><?php esc_html_e( 'Droit Elementor Addons', 'droit-addons' );?></h4>
          <div class="tab-menu tab_left_content">

          <?php do_action('dladdons/dashboard/tab/button/before'); ?>

            <a href="#dashboard" class="tab-menu-link active" data-content="droit_dashboard">
              <div class="dl_tab_content">
                <div class="tab_content_inner">
                  <div class="dl_widget_icon sidebar_icon_bg_color_1">
                    <img src="<?php echo esc_url(drdt_core()->images . 'sidebar_dashboard.svg'); ?>" alt="">
                  </div>
                  <div class="tab_content">
                    <h4><?php esc_html_e( 'Dashboard', 'droit-addons' );?></h4>
                    <span><?php esc_html_e( 'Find all information', 'droit-addons' );?></span>
                  </div>
                </div>
              </div>
            </a>
            <a href="#elements" class="tab-menu-link" data-content="droit_elements">
              <div class="dl_tab_content">
                <div class="tab_content_inner">
                  <div class="dl_widget_icon sidebar_icon_bg_color_2">
                    <img src="<?php echo esc_url(drdt_core()->images . 'sidebar_elements.svg'); ?>" alt="">
                  </div>
                  <div class="tab_content">
                    <h4><?php esc_html_e( 'Elements', 'droit-addons' );?></h4>
                    <span><?php esc_html_e( 'Control all the widgets', 'droit-addons' );?></span>
                  </div>
                </div>
              </div>
            </a>
            <a href="#extention" class="tab-menu-link" data-content="droit_extention">
              <div class="dl_tab_content">
                <div class="tab_content_inner">
                  <div class="dl_widget_icon sidebar_icon_bg_color_2">
                    <img src="<?php echo esc_url(drdt_core()->images . 'module.svg'); ?>" alt="">
                  </div>
                  <div class="tab_content">
                    <h4><?php esc_html_e( 'Modules', 'droit-addons' );?></h4>
                    <span><?php esc_html_e( 'Control all the modules', 'droit-addons' );?></span>
                  </div>
                </div>
              </div>
            </a>
            <a href="#api" class="tab-menu-link" data-content="droit_api">
              <div class="dl_tab_content">
                <div class="tab_content_inner">
                  <div class="dl_widget_icon sidebar_icon_bg_color_6">
                    <img src="<?php echo esc_url(drdt_core()->images . 'sidebar_api.svg'); ?>" alt="">
                  </div>
                  <div class="tab_content">
                    <h4><?php esc_html_e( 'Api', 'droit-addons' );?></h4>
                    <span><?php esc_html_e( 'Added Api here', 'droit-addons' );?></span>
                  </div>
                </div>
              </div>
            </a>
            <a href="#tools" class="tab-menu-link" data-content="droit_tools">
              <div class="dl_tab_content">
                <div class="tab_content_inner">
                  <div class="dl_widget_icon sidebar_icon_bg_color_3">
                    <img src="<?php echo esc_url(drdt_core()->images . 'sidebar_tools.svg'); ?>" alt="">
                  </div>
                  <div class="tab_content">
                    <h4><?php esc_html_e( 'Tools', 'droit-addons' );?></h4>
                    <span><?php esc_html_e( 'Regenerate assets', 'droit-addons' );?></span>
                  </div>
                </div>
              </div>
            </a>

            <?php 
            if( !did_action('droitPro/loaded') ){
            ?>
            <a href="#pro" class="tab-menu-link" data-content="droit_pro">
              <div class="dl_tab_content">
                <div class="tab_content_inner">
                  <div class="dl_widget_icon sidebar_icon_bg_color_3">
                    <img src="<?php echo esc_url(drdt_core()->images . 'pro_icon2.svg'); ?>" alt="">
                  </div>
                  <div class="tab_content">
                    <h4><?php esc_html_e( 'Go PRO', 'droit-addons' );?></h4>
                    <span><?php esc_html_e( 'Get premium features', 'droit-addons' );?></span>
                  </div>
                </div>
              </div>
            </a>
          <?php }?>
            
           <?php do_action('dladdons/dashboard/tab/button/after'); ?>
          </div>
        </div>
      </div>
      <div class="tab-bar">

        <form id="droit-save-widget" class="posiasdtion_relative droit-save-widget" method="post" action="">
         <?php do_action('dladdons/dashboard/tab/content/before'); ?>

          <div class="tab-bar-content active" id="droit_dashboard">
              <?php include_once drdt_core()->dir . 'templates/admin/main.php';?>
          </div>
          <div class="tab-bar-content" id="droit_elements">
              <?php include_once drdt_core()->dir . 'templates/admin/elements.php';?>
          </div>
          <div class="tab-bar-content" id="droit_extention">
              <?php include_once drdt_core()->dir . 'templates/admin/extentions.php';?>
          </div>
          <div class="tab-bar-content" id="droit_api">
              <?php include_once drdt_core()->dir . 'templates/admin/api.php';?>
          </div>
          <div class="tab-bar-content" id="droit_tools">
              <?php include_once drdt_core()->dir . 'templates/admin/reset_tool.php';?>
          </div>

          <?php 
          if( !did_action('droitPro/loaded') ){
          ?>
          <div class="tab-bar-content" id="droit_pro">
              <?php include_once drdt_core()->dir . 'templates/admin/pro.php';?>
          </div>
          <?php }?>
          
          <?php do_action('dladdons/dashboard/tab/content/after'); ?>

        </form>
      </div>
    </div>
  </div>
</div>