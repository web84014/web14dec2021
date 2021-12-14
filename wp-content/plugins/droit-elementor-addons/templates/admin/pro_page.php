<div id="wrapper">
	<div class="dl_elementor_addons_pack dl_sidebar_tab dlprobox_wrapper">
    	<div class="dl_elementor_addon_content dl_d_flex">
		    <div class="dl_addons_container">
		        <div class="dl_addons_row">
		            <div class="dl_col_lg_12">
		                <div class="dl_addons_dashboard_probox">
		                	<div class="dl_addons_dashboard_probox_wrapper">
		                		<img src="<?php echo drdt_core()->images . 'pro_icon.svg'; ?>" alt="pro" class="dl_box_icon">
			                     <h5 class="title"><?php echo esc_html_e('Pro is coming soon, subscribe for Pro', 'droit-addons'); ?></h5>
			                    <div class="dl_subscription_info_box dl_border_radius dl_subscribe_style_one dl_pt_50 dl_pb_60">
								     <?php include('form-data.php'); ?>
								</div>
		                	</div>
		                </div>
		            </div>
		        </div>
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
    </div>
</div>