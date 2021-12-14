<?php
/**
 * @package droitelementoraddons
 * @developer DroitLab Team
 */
/*
Plugin Name: Droit Elementor Addons Pro
Plugin URI: https://droitthemes.com/droit-elementor-addons/
Description: Droit Elementor Addons is a bundle of super useful widgets. This Elementor compatible plugin is easy to use and you can customize different features as you like. Just plug and play.
Version: 1.0.0
Author: DroitThemes
Author URI: https://droitthemes.com/
License: GPLv3
Text Domain: droit-elementor-addons-pro
Domain Path: /languages
 */

// If this file is called firectly, abort!!!
defined('ABSPATH') or die('Hey, what are you doing here? You silly human!');

/**
 * Constant
 * Feature added by : DroitLab Team
 * @since 1.0.0
 */

if (!defined("DROIT_EL_PRO")) {
    define("DROIT_EL_PRO", "PRO");
}

if (!defined("DROIT_EL_PRO_PLUGIN_NAME")) {
    define("DROIT_EL_PRO_PLUGIN_NAME", 'Droit Elementor Addons Pro');
}

if (!defined("DROIT_EL_PRO_VERSION")) {
    define("DROIT_EL_PRO_VERSION", '1.0.0');
}

if (!defined("DROIT_EL_PRO_WP_VERSION")) {
    define("DROIT_EL_PRO_WP_VERSION", '4.9');
}

if (!defined("DROIT_EL_PRO_PHP_VERSION")) {
    define("DROIT_EL_PRO_PHP_VERSION", '5.6');
}

if (!defined("DROIT_EL_PRO_FILE")) {
    define("DROIT_EL_PRO_FILE", __FILE__);
}

if (!defined("DROIT_EL_PRO_BASE")) {
    define("DROIT_EL_PRO_BASE", trailingslashit(plugin_basename(DROIT_EL_PRO_FILE)));
}

if (!defined("DROIT_EL_PRO_PATH")) {
    define("DROIT_EL_PRO_PATH", trailingslashit(plugin_dir_path(DROIT_EL_PRO_FILE)));
}

if (!defined("DROIT_EL_PRO_URL")) {
    define("DROIT_EL_PRO_URL", trailingslashit(plugin_dir_url(DROIT_EL_PRO_FILE)));
}
if (!defined("DROIT_EL_PRO_IMAGE")) {
    define("DROIT_EL_PRO_IMAGE", DROIT_EL_PRO_URL . '_images/');
}
require_once DROIT_EL_PRO_PATH . '/includes/plugin.php';