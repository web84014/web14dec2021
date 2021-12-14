<?php

/**
 * WP_Meteor
 *
 * @package   WP_Meteor
 * @author    Aleksandr Guidrevitch <alex@excitingstartup.com>
 * @copyright 2020 wp-meteor.com
 * @license   GPL 2.0+
 * @link      https://wp-meteor.com
 */

namespace WP_Meteor\Backend;

use WP_Meteor\Engine\Base;

/**
 * This class contain the Enqueue stuff for the backend
 */
class Enqueue extends Base
{

	/**
	 * Initialize the class.
	 *
	 * @return void
	 */
	public function initialize()
	{
		// Load admin style sheet and JavaScript.
		if (defined('NITROPACK_VERSION')) {
			wpdesk_init_wp_notice_ajax_handler(\plugins_url('vendor/wpdesk/wp-notice/assets', WPMETEOR_PLUGIN_ABSOLUTE));
			wpdesk_wp_notice_error('WP Meteor is disabled because of incompatibility with Nitropack Plugin.');
		}
		if (defined('WP_ROCKET_VERSION')) {
			$wp_rocket_settings = get_option('wp_rocket_settings');
			if (@$wp_rocket_settings['delay_js']) {
				wpdesk_init_wp_notice_ajax_handler(\plugins_url('vendor/wpdesk/wp-notice/assets', WPMETEOR_PLUGIN_ABSOLUTE));
				wpdesk_wp_notice_error('<strong>WP Meteor</strong> is currently disabled, because <strong>\'Delay Javascript Execution\'</strong> is currently activated in <strong>WP Rocket</strong>. If you still want to use <strong>WP Meteor</strong>, please deactivate <strong>\'Delay Javascript Execution\'</strong> in <strong>WP Rocket</strong>');
			}
		}
		if (defined('PHASTPRESS_VERSION')) {
			$phastpress_settings = @json_decode(get_option('phastpress2-settings'), true);
			if (@$phastpress_settings['scripts-defer']) {
				wpdesk_init_wp_notice_ajax_handler(\plugins_url('vendor/wpdesk/wp-notice/assets', WPMETEOR_PLUGIN_ABSOLUTE));
				wpdesk_wp_notice_error('<strong>WP Meteor</strong> is currently disabled, because <strong>\'Load scripts asynchronously\'</strong> is currently activated in <strong>PhastPress</strong>. If you still want to use <strong>WP Meteor</strong>, please deactivate <strong>\'Load scripts asynchronously\'</strong> in <strong>PhastPress plugin</strong>');
			}
		}
		\add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_styles'));
		\add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'));
	}


	/**
	 * Register and enqueue admin-specific style sheet.
	 *
	 * @since 1.0.0
	 */
	public function enqueue_admin_styles()
	{
		$admin_page = \get_current_screen();
		// if ( !\is_null( $admin_page ) && 'toplevel_page_simple-script-blocker' === $admin_page->id ) {
		if (!\is_null($admin_page) && 'settings_page_wp-meteor' === $admin_page->id) {
			\wp_enqueue_style(WPMETEOR_TEXTDOMAIN . '-settings-styles', \plugins_url('assets/css/admin/settings.css', WPMETEOR_PLUGIN_ABSOLUTE), array('dashicons'), WPMETEOR_VERSION);
		}
		\remove_action('admin_print_scripts', 'print_emoji_detection_script');
	}

	/**
	 * Register and enqueue admin-specific JavaScript.
	 *
	 * @since 1.0.0
	 */
	public function enqueue_admin_scripts()
	{
		$admin_page = \get_current_screen();

		// if ( !\is_null( $admin_page ) && 'toplevel_page_simple-script-blocker' === $admin_page->id ) {
		if (!\is_null($admin_page) && 'settings_page_wp-meteor' === $admin_page->id) {
			$_wpmeteor = array_merge([
				'ajax_url' => \admin_url('admin-ajax.php'),
			], apply_filters(WPMETEOR_TEXTDOMAIN . '-backend-adjust-wpmeteor', [], \wpmeteor_get_settings()));
			\wp_enqueue_script(WPMETEOR_TEXTDOMAIN . '-settings-script', \plugins_url('assets/js/admin/settings.js', WPMETEOR_PLUGIN_ABSOLUTE), array('jquery', 'jquery-ui-tabs'), WPMETEOR_VERSION, false);
			\wp_localize_script(WPMETEOR_TEXTDOMAIN . '-settings-script', '_wpmeteor', $_wpmeteor);
		}
	}
}
