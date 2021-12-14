<?php
/**
 * @package droitelementoraddonspro
 * @developer DroitLab Team
 *
 */

namespace DROIT_ELEMENTOR_PRO\App;

if ( ! defined( 'ABSPATH' ) ) {exit;}

class Pro{
    /**
     * Constructor
     * @since 1.0.0
     * @access private
     * Feature added by : DroitLab Team
     */
    public function __construct(){
        $this->init_hooks();
    }
    
    public function init_hooks(){
        do_action( 'droit_elementor_addons/pro' );
    }
    
}