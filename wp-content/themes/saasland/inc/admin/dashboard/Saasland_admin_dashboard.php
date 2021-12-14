<?php
/**
* Saasland Themes Theme Framework
* The Saasland_Admin_Dashboard base class
*/

if ( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

class Saasland_admin_dashboard extends Saasland_admin_page {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		$this->id = 'saasland';
		$this->page_title = esc_html__( 'Saasland Dashboard', 'saasland' );
		$this->menu_title = esc_html__( 'Register/Verify', 'saasland' );
		$this->position = '50';

		parent::__construct();
	}

	/**
	 * [display description]
	 * @method display
	 * @return [type]  [description]
	 */
	public function display() {
		include_once( get_template_directory() . '/inc/admin/dashboard/dashboard.php' );
	}

	/**
	 * [save description]
	 * @method save
	 * @return [type] [description]
	 */
	public function save() {

	}
}
new Saasland_admin_dashboard;
