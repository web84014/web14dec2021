<?php 
/**
 * @package droitelementoraddonspro
 * @developer DroitLab Team
 *
 */
namespace DROIT_ELEMENTOR_PRO\Admin;
use DROIT_ELEMENTOR_PRO\Core\Utils as Pro_Utils;


if ( ! defined( 'ABSPATH' ) ) {exit;}


class Admin_Enqueue{
	/**
	 * The unique identifier of this plugin.
	 * @access   protected
	 * @since    0.1.0
	 * Feature added by : DroitLab Team
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 * @access   protected
	 * @since    0.1.0
	 * Feature added by : DroitLab Team
	 */
	protected $version;
	/**
     * Constructor
     * @since 1.0.0
     * @access public
     * Feature added by : DroitLab Team
     */
    public function __construct(){
    	$this->define_admin_hooks();
    }

    /**
     * Admin hooks
     * @since 1.0.0
     * @access private
     * Feature added by : DroitLab Team
     */
    private function define_admin_hooks() {
    	 if (is_admin() && !empty($_GET["page"]) && ($_GET["page"] == "droit-addons") || (isset($_GET['page']) && $_GET['page'] == 'droit-pro')) {
	    	add_action('admin_enqueue_scripts', [$this, 'droit_pro_enqueue_scripts']);
	    }
    }
    
	/**
     * Enqueue Style
     * @since 1.0.0
     * @access public
     * Feature added by : DroitLab Team
     */
	public static function droit_pro_enqueue_styles() {
		wp_enqueue_style( 'admin-pro', Pro_Utils::droit_pro_protocol('/assets/css/admin-pro.css'), [], DROIT_EL_PRO_VERSION, 'all' );
	}
    /**
     * Enqueue Script
     * @since 1.0.0
     * @access public
     * Feature added by : DroitLab Team
     */
	public static function droit_pro_enqueue_scripts() {
		wp_enqueue_script("admin-pro", Pro_Utils::droit_pro_protocol('/assets/js/admin-pro.js'), array('jquery'), DROIT_EL_PRO_VERSION, true);
	}
}