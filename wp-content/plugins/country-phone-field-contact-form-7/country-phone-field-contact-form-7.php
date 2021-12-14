<?php
/*
Plugin Name: Country & Phone Field Contact Form 7
Description: Add country drop down with flags and phone number with country phone extensions field in contact form 7.
Version: 2.2.7
Author: Narinder Singh Bisht
Author URI: http://narindersingh.in
License: GPL3
License URI: http://www.gnu.org/licenses/gpl.html
Text Domain: nb-cpf
*/

// Block direct access to the main plugin file.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

class NB_CPF_Plugin{
	
	public function __construct(){
		add_action( 'plugins_loaded', array( $this, 'nb_load_plugin_textdomain' ) );
		if(class_exists('WPCF7')){
			
			$this->nb_plugin_constants();
			require_once NB_CPF_PATH . 'includes/autoload.php';
		}else{
			add_action( 'admin_notices', array( $this, 'nb_admin_error_notice' ) );
		}
		
	}
	
	public function nb_load_plugin_textdomain() {
		load_plugin_textdomain( 'nb-cpf', false, basename( dirname( __FILE__ ) ) . '/languages/' );
	}
	
	/*
		register admin notice if contact form 7 is not active.
	*/
	public function nb_admin_error_notice(){
		$message = sprintf( esc_html__( 'The %1$sCountry & Phone Field Contact Form 7%2$s plugin requires %1$sContact form 7%2$s plugin active to run properly. Please install %1$scontact form 7%2$s and activate', 'nb-cpf' ),'<strong>', '</strong>');

		printf( '<div class="notice notice-error"><p>%1$s</p></div>', wp_kses_post( $message ) );
	}
	
	/*
		set plugin constants
	*/
	public function nb_plugin_constants(){
		
		if ( ! defined( 'NB_CPF_PATH' ) ) {
			define( 'NB_CPF_PATH', plugin_dir_path( __FILE__ ) );
		}
		if ( ! defined( 'NB_CPF_URL' ) ) {
			define( 'NB_CPF_URL', plugin_dir_url( __FILE__ ) );
		}
		
	}
}

// Instantiate the plugin class.
$nb_cpf_plugin = new NB_CPF_Plugin();