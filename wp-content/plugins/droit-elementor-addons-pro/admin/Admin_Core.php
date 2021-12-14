<?php 
/**
 * @package droitelementoraddonspro
 * @developer DroitLab Team
 *
 */
namespace DROIT_ELEMENTOR_PRO\Admin;

use DROIT_ELEMENTOR_PRO\Admin\Locale_i18n as Language;

if ( ! defined( 'ABSPATH' ) ) {exit;}


class Admin_Core{
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
     * @access private
     * Feature added by : DroitLab Team
     */
    public function __construct(){
    	if ( defined( 'DROIT_EL_PRO_VERSION' ) ) {
			$this->version = DROIT_EL_PRO_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = DROIT_EL_PRO_PLUGIN_NAME;
        $this->set_locale();
    }

    /**
     * Load Plugin Language
     * @access public
     * @since : 1.0.0
     * Feature added by : DroitLab Team
     */
    private function set_locale() {
		$plugin_i18n = Language::droit_load_plugin_textdomain();
		add_action('plugins_loaded', [$this, $plugin_i18n]);
	}
	
	/**
     * Plugin Name
     * @access public
     * @since : 1.0.0
     * Feature added by : DroitLab Team
     */
	public function droit_pro_get_plugin_name() {
		return $this->plugin_name;
	}

	/**
     * Plugin Version
     * @access public
     * @since : 1.0.0
     * Feature added by : DroitLab Team
     */
	public function droit_pro_get_version() {
		return $this->version;
	}

}