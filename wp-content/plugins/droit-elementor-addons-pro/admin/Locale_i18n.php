<?php 
/**
 * @package droitelementoraddonspro
 * @developer DroitLab Team
 *
 */
namespace DROIT_ELEMENTOR_PRO\Admin;

if ( ! defined( 'ABSPATH' ) ) {exit;}


class Locale_i18n{

	/**
     * Plugin Language
     * @access public
     * Feature added by : DroitLab Team
     * @since : 1.0.0
     */
	public static function droit_load_plugin_textdomain() {
		load_plugin_textdomain(
			'droit-elementor-addons-pro',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}
}