<?php

define( 'UM_MINIMUM_ELEMENTOR_VERSION' , '2.5.0' );
define( 'UM_MINIMUM_ELEMENTOR_PHP_VERSION' , '7.0' );



add_action( 'plugins_loaded', 'ubermenu_elementor_init' );

function ubermenu_elementor_init(){

  // Check if Elementor installed and activated
	if ( ! did_action( 'elementor/loaded' ) ) {
		//add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
		return;
	}

  // Check for required Elementor version
	if ( ! version_compare( ELEMENTOR_VERSION, UM_MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
		//add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
		return;
	}

  // Check for required PHP version
	if ( version_compare( PHP_VERSION, UM_MINIMUM_ELEMENTOR_PHP_VERSION, '<' ) ) {
		//add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
		return;
	}


  add_action( 'elementor/widgets/widgets_registered', 'ubermenu_elementor_init_widgets' );
	//add_action( 'elementor/controls/controls_registered', 'init_controls' );


}

function ubermenu_elementor_init_widgets() {
  // Include Widget files
	require_once( __DIR__ . '/widgets/nav-widget.php' );

	// Register widget
	\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_UberMenu_Nav_Widget() );
}








//https://developers.elementor.com/creating-an-extension-for-elementor/
