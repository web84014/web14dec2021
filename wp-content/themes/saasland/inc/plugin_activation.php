<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

$purchase_code_status = trim( get_option( 'saasland_purchase_code_status' ) );

/**
 * Include the TGM_Plugin_Activation class.
 */
require get_template_directory() . '/inc/tgm/class-tgm-plugin-activation.php';
if ( $purchase_code_status == 'valid' ) {
    add_action('tgmpa_register', 'saasland_register_required_plugins');
}

/**
 * Register the required plugins for this theme.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function saasland_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(
        array(
            'name'              => esc_html__( 'Elementor', 'saasland' ),
            'slug'              => 'elementor',
            'required'          => true,
        ),

        array(
            'name'               => esc_html__( 'Saasland Core', 'saasland' ), // The plugin name.
            'slug'               => 'saasland-core', // The plugin slug (typically the folder name).
            'source'             => get_template_directory().'/inc/tgm/saasland-core.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'       => '', // If set, overrides default API URL and points to an external URL.
            'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
            'version'            => '3.3.3'
        ),

        array(
            'name'               => esc_html__( 'Advanced Custom Fields-pro', 'saasland' ), // The plugin name.
            'slug'               => 'advanced-custom-fields-pro', // The plugin slug (typically the folder name).
            'source'             => 'https://droitthemes.com/wpplugin/advanced-custom-fields-pro.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'       => '', // If set, overrides default API URL and points to an external URL.
            'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
        ),

        array(
            'name'               => esc_html__( 'DT Redux Framework', 'saasland' ),
            'slug'               => 'dt-redux-framework',
            'required'           => true,
            'source'             => 'https://droitthemes.com/wpplugin/dt-redux-framework.zip', // The plugin source.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'       => '', // If set, overrides default API URL and points to an external URL.
            'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
        ),

        array(
            'name'               => esc_html__( 'Slider Revolution', 'saasland' ), // The plugin name.
            'slug'               => 'slider-revolution', // The plugin slug (typically the folder name).
            'source'             => 'https://droitthemes.com/wpplugin/slider-revolution.zip', // The plugin source.
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'       => '', // If set, overrides default API URL and points to an external URL.
            'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
        ),

        array(
            'name'      => esc_html__( 'WooCommerce', 'saasland' ),
            'slug'      => 'woocommerce',
            'required'  => false,
        ),

        array(
            'name'      => esc_html__( 'WooCommerce Wishlist', 'saasland' ),
            'slug'      => 'ti-woocommerce-wishlist',
            'required'  => false,
        ),

        array(
            'name'      => esc_html__( 'Contact Form 7', 'saasland' ),
            'slug'      => 'contact-form-7',
            'required'  => false,
        ),

        array(
            'name'      => esc_html__( 'One Click Demo Import', 'saasland' ),
            'slug'      => 'one-click-demo-import',
            'required'  => false,
        ),

        array(
            'name'               => esc_html__( 'Support Board', 'saasland' ), // The plugin name.
            'slug'               => 'supportboard', // The plugin slug (typically the folder name).
            'source'             => 'https://droitthemes.com/wpplugin/supportboard.zip', // The plugin source.
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'       => '', // If set, overrides default API URL and points to an external URL.
            'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
        ),
	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}
