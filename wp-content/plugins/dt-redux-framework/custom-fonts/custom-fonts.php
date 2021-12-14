<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

/**
 * Set constants.
 */
define( 'BSF_CUSTOM_FONTS_FILE', __FILE__ );
define( 'BSF_CUSTOM_FONTS_BASE', plugin_basename( BSF_CUSTOM_FONTS_FILE ) );
define( 'BSF_CUSTOM_FONTS_DIR', plugin_dir_path( BSF_CUSTOM_FONTS_FILE ) );
define( 'BSF_CUSTOM_FONTS_URI', plugins_url( '/', BSF_CUSTOM_FONTS_FILE ) );
define( 'BSF_CUSTOM_FONTS_VER', '1.2.0' );

/**
 * BSF Custom Fonts
 */
require_once BSF_CUSTOM_FONTS_DIR . 'classes/class-bsf-custom-fonts.php';
