<?php

function ubermenu_is_plugin_active_menu_image(){
  return class_exists( 'Menu_Image_Plugin' );
}

/** ADMIN **/
add_filter( 'ubermenu_settings_panel_fields' , 'ubermenu_settings_panel_fields_plugin_compatibility_menu_image' , 40 , 1 );
function ubermenu_settings_panel_fields_plugin_compatibility_menu_image( $all_fields = array() ){

	$fields = $all_fields[UBERMENU_PREFIX.'general'];

  $header_desc = __( 'The <strong>Menu Image</strong> plugin completely changes the markup of your menu, including UberMenu, therefore breaking the entire menu.  This plugin is not compatible with UberMenu and must be disabled. <br/>Plugin Status:', 'ubermenu' );
  $plugin_status = '<span class="ubermenu-plugin-compatibility-inactive ubermenu-plugin-compatibility-success">'.__( 'Not active' , 'ubermenu' ).'</span>';
  if( ubermenu_is_plugin_active_menu_image() ){
    $plugin_status = '<span class="ubermenu-plugin-compatibility-active ubermenu-plugin-compatibility-fail">'.__( 'Active', 'ubermenu' ).'</span>';
  }
  $header_desc.= ' '.$plugin_status;

  $fields[810] = array(
		'name'	=> 'header_plugin_compatibiity_menu_image',
		'label'	=> __( 'Menu Image' , 'ubermenu' ),
		'type'	=> 'header',
    'desc'  => $header_desc,
		'group'	=> 'plugin_compatibility',
	);
  $fields[811] = array(
		'name'	=> 'plugin_compatibility_menu_image_autodisable',
		'label' => __( 'Automatically disable Menu Image plugin filter' , 'ubermenu' ),
		'desc'	=> __( 'UberMenu will automatically attempt to disable the filter in the Menu Image plugin that destroys the UberMenu markup.  You should still be sure to disable the Menu Image plugin.  UberMenu has its own image functionality built in.', 'ubermenu' ),
		'type'	=> 'checkbox',
		'default' => 'on',
		'group'	=> 'plugin_compatibility',
	);

	$all_fields[UBERMENU_PREFIX.'general'] = $fields;

	return $all_fields;
}


/** FUNCTIONALITY **/
add_action( 'wp' , 'ubermenu_kill_menu_image_plugin' );
function ubermenu_kill_menu_image_plugin(){
  global $menu_image;
  if( ubermenu_is_plugin_active_menu_image() && isset( $menu_image ) && ( 'off' != ubermenu_op( 'plugin_compatibility_menu_image_autodisable' , 'general' ) ) ){
    remove_action( 'walker_nav_menu_start_el', array( $menu_image, 'menu_image_nav_menu_item_filter' ), 10, 4 );
  }
}
