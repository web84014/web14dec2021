<?php
/**
 * @package droitelementoraddonspro
 * @developer DroitLab Team
 *
 */

namespace DROIT_ELEMENTOR_PRO;

if ( ! defined( 'ABSPATH' ) ) {exit;}

Final class Plugin {

     /**
     * Instance
     * @var core The single instance of the class.
     * @access private
     * @static
     * @since 1.0.0
     * Feature added by : DroitLab Team
     */
    public static $instance = null;

     /**
     * Instance
     * Ensures only one instance of the class is loaded or can be loaded.
     * @since 1.0.0
     * @access public
     * Feature added by : DroitLab Team
     */
    public static function instance(){
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Instance
     * Ensures only one instance of the class is loaded or can be loaded.
     * @since 1.0.0
     * @access private
     * Feature added by : DroitLab Team
     */
    private function droit_pro_register_autoloader(){
        require_once DROIT_EL_PRO_PATH . '/vendor/autoload.php';
    }

    /**
     * Init components.
     * Initialize Droit Pro components. Register actions, run setting manager,
     * @since 1.0.0
     * @access private
     * Feature added by : DroitLab Team
     */
    private function droit_pro_init_components(){

        /*=====Includes=====*/
        
        new Enqueue_Manager();
        new Elements\Load_Element();

        /*=====Admin=====*/

        new Admin\Admin_Core();
        new Admin\Admin_Enqueue();

        /*=====App=====*/

        new App\Pro();
    }

    /**
     * Check if a plugin is installed or Not
     * @access public
     * @since 1.0.0
     * Feature added by : DroitLab Team
     */
    private function droit_pro_admin_notice() {
        require_once DROIT_EL_PRO_PATH . '/includes/Notice.php';
        $notice_obj = new Notice();
        return $notice_obj;
    }
    /**
     * Check Droit Elementor Addons Installed and Activated or Not
     * Warning when the site doesn't have Droit Elementor Addons installed or activated.
     * @access public
     * @since 1.0.0
     * Feature added by : DroitLab Team
     */
    public function droit_pro_notice_missing_free_plugin(){
         return $this->droit_pro_admin_notice()->is_missing_droit_free_plugin(); 
    }
    /**
     * Check Droit Elementor Addons Required Version
     * @access public
     * @since 1.0.0
     * Feature added by : DroitLab Team
     */
    public function droit_pro_fail_load_out_required_free_version(){
         return $this->droit_pro_admin_notice()->is_missing_droit_free_valid_version(); 
    }
    /**
     * Check Droit Elementor Addons Upgrade Notice
     * @access public
     * @since 1.0.0
     * Feature added by : DroitLab Team
     */
    public function droit_pro_admin_notice_upgrade_recommendation(){
         return $this->droit_pro_admin_notice()->droit_pro_upgrade_recommendation(); 
    }
    /**
     * Plugin dependancy
     * @access public
     * Feature added by : DroitLab Team
     * @since : 1.0.0
     */
    public function droit_pro_dependancy_check(){
        // Check if Droit Elementor Addons installed and activated
        if (!did_action('droit_elementor_addons/loaded')) {
            add_action('admin_notices', [$this, 'droit_pro_notice_missing_free_plugin']);
            return;
        }
        $droit_version_required = '1.0.0';
        if ( ! version_compare( DROIT_EL_ADDONS_VERSION, $droit_version_required, '>=' ) ) {
            add_action('admin_notices', [$this, 'droit_pro_fail_load_out_required_free_version']);
            return;
        }
        $droit_version_recommendation = '1.0.1';
        if ( ! version_compare( DROIT_EL_ADDONS_VERSION, $droit_version_recommendation, '>=' ) ) {
            add_action('admin_notices', [$this, 'droit_pro_admin_notice_upgrade_recommendation']);
        }
        $this->droit_pro_register_autoloader();
        $this->droit_pro_init_components();
    }
    /**
     * Active Plugin
     * @access public
     * Feature added by : DroitLab Team
     * @since : 1.0.0
     */
    public function droit_pro_activation(){
        require_once DROIT_EL_PRO_PATH . '/includes/class-droit-activator.php';
        Droit_Pro_Activator::droit_pro_activate();
    }
    /**
     * Deactive Plugin
     * @access public
     * Feature added by : DroitLab Team
     * @since : 1.0.0
     */
    public function droit_pro_deactivation(){
        require_once DROIT_EL_PRO_PATH . '/includes/class-droit-deactivator.php';
        Droit_Pro_Deactivator::droit_pro_deactivate();
    }
    /**
     * Plugin Active Time
     * @access public
     * Feature added by : DroitLab Team
     * @since : 1.0.0
     */
    public function droit_pro_installed_time() {
        $installed_time = get_option( '_droit_pro_installed_time' );

        if ( ! $installed_time ) {
            $installed_time = time();

            update_option( '_droit_pro_installed_time', $installed_time );
        }

        return $installed_time;
    }
    /**
     * Plugin Loaded
     * @access private
     * Feature added by : DroitLab Team
     * @since : 1.0.0
     */
    private function droit_pro_loaded(){
        add_action('plugins_loaded', [$this, 'droit_pro_dependancy_check']);
    }

    private function droit_pro_hooks(){
        register_activation_hook(DROIT_EL_PRO_FILE, [$this, 'droit_pro_activation']);
        register_deactivation_hook(DROIT_EL_PRO_FILE, [$this, 'droit_pro_deactivation']);
        register_activation_hook(DROIT_EL_PRO_FILE, [$this, 'droit_pro_installed_time']);
        $this->droit_pro_loaded();
    }

    /**
     * Constructor
     * @since 1.0.0
     * @access private
     * Feature added by : DroitLab Team
     */
    private function __construct(){
        $this->droit_pro_hooks();
    }

}

if (defined("DROIT_EL_PRO")) {
    Plugin::instance();
}