<div class="dl_addons_element">
    <div class="dl_addons_container">
        <div class="dl_addons_row">
            <div class="dl_col_lg_12">
                <div class="dl_element_addons_dashboard_intro pro_banner">
                    <h2 class="title"><?php echo esc_html_e('Get Droit Elementor Addons Pro', 'droit-addons'); ?></h2>
                    <p class="description">Purchase the premium version of Droit Elementor Addons to get <br> additional and exclusive features.</p>
                    <a href="<?php echo esc_url('https://droitthemes.com/droit-elementor-addons/');?>" target="_blank"> Click here to get Droit Elementor Addons PRO!</a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="dl_addons_container">
        <div class="dl_addons_row">
            <div class="dl_col_lg_12">
                <div class="dl_kit_section_title dl_mb_15">
                    <h5 class="title"><?php echo esc_html_e('Premium Elements ', 'droit-addons'); ?></h5>
                    <p class="description"><?php echo esc_html_e('Have a look at the premium elements you will get to level up your website. ', 'droit-addons'); ?></p>
                </div>
            </div>
        </div>
        <div class="dl_addons_row">
        	<?php
				
				$elements_map = drdt_manager()->widgets->pro_widgets_maping([]);

                if( !empty($elements_map) ){
                    foreach($elements_map as $k=>$v){
                        $title            = isset($v['_title']) ? $v['_title'] : '';
                        $icon             = isset($v['_icon']) ? $v['_icon'] : '';
                        $demo_url             = isset($v['_demo_url']) ? $v['_demo_url'] : '';
                        $_droit_pro             = isset($v['_droit_pro']) ? $v['_droit_pro'] : false;
                        if($_droit_pro){
                        ?>
                            <div class="dl_col_lg_4 dl_col_sm_6">
                                <a href="<?php echo esc_url($demo_url); ?>" class="dl_pro_widget_list" target="_blank">
                                    <i class="droit_icon <?php echo esc_attr($icon); ?>"></i>
                                    <h4 class="title"><?php esc_html_e($title, 'droit-addons');?></h4>
                                </a>
                            </div>
                        <?php
                        }
                    }
                }
            ?>

        </div>
    </div>
</div>
