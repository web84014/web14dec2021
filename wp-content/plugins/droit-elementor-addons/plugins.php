<?php
/**
 * @package droitelementoraddons
 * @developer DroitLab Team
 */
/*
Plugin Name: Droit Elementor Addons
Plugin URI: https://demos.droitthemes.com/droit-elementor-addons/
Description: Droit Elementor Addons is a bundle of super useful widgets. Build a beautiful website using this addon without any hassle. Just plug and play.
Version: 3.0.4
Author: DroitThemes
Author URI: https://droitthemes.com/
Elementor tested up to: 3.2.3
Elementor Pro tested up to: 3.2.2
License: GPLv3
Text Domain: droit-addons
*/

// define the main file 
define( 'DROIT_ADDONS_FILE_', __FILE__);

//define version
define( 'DROIT_ADDONS_VERSION_', '3.0.4');

// define render css
define( 'DROIT_ADDONS_CSS_RENDER_', false);

// define minify render css
define( 'DROIT_ADDONS_CSS_RENDER_MINIFY', false);

// render icon from css files
define( 'DROIT_ADDONS_ICON_RENDER', false);

// core page
include_once( __DIR__ . '/functions.php');
include_once(__DIR__ . '/core.php');

// load plugin
add_action( 'plugins_loaded', function(){
	// load text domain
	load_plugin_textdomain( 'droit-addons', false, basename( dirname( __FILE__ ) ) . '/languages'  );

    //load core
    DROIT_ELEMENTOR\Dtdr_Core::instance()->load();

}); 


