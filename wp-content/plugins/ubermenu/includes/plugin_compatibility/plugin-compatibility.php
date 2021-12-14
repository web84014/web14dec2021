<?php
require_once UBERMENU_DIR . 'includes/plugin_compatibility/menu-image.php';

function ubermenu_detect_plugin( $plugin_slug ){

  return false;
}

// Requires priority of 20, otherwise the standard General filter is going to override it
add_filter( 'ubermenu_general_settings_sections' , 'ubermenu_general_settings_sections_plugincompat' , 20 , 1 );
function ubermenu_general_settings_sections_plugincompat( $section ){

	$section['sub_sections']['plugin_compatibility'] = array(
		'title'	=> __( 'Plugin Compatibility', 'ubermenu' ),
	);

	return $section;
}


add_filter( 'ubermenu_settings_panel_fields' , 'ubermenu_settings_panel_fields_plugin_compatibility' , 30 , 1 );
function ubermenu_settings_panel_fields_plugin_compatibility( $all_fields = array() ){

	$fields = $all_fields[UBERMENU_PREFIX.'general'];

  $fields[800] = array(
		'name'	=> 'header_plugin_compatibiity',
		'label'	=> __( 'Plugin Compatibility' , 'ubermenu' ),
		'type'	=> 'header',
		'group'	=> 'plugin_compatibility',
	);

	$all_fields[UBERMENU_PREFIX.'general'] = $fields;

	return $all_fields;
}
