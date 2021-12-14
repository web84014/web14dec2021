<?php 
/**
 * @package droitelementoraddonspro
 * @developer DroitLab Team
 *
 */
namespace DROIT_ELEMENTOR_PRO;

if ( ! defined( 'ABSPATH' ) ) {exit;}

class Droit_Pro_Activator{
    
    public static function droit_pro_activate() {
		flush_rewrite_rules();
        if (!get_option('droit_addons_pro')) {
            update_option('droit_addons_pro', 'addons_pro');
        }
	}
}