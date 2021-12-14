<?php 
namespace DROIT_ELEMENTOR_PRO;
/**
 * summary
 */
class Notice
{
    /**
     * Constructor
     * @since 1.0.0
     * @access private
     * Feature added by : DroitLab Team
     */
    public function __construct(){
        
    }

    public function droit_elementor_addons_notice_minimum_php_version(){

        if (isset($_GET['activate'])) {
            unset($_GET['activate']);
        }

        $message = sprintf(__("Your current PHP version is <strong> " . PHP_VERSION . " </strong>. You need to upgrade your PHP version to <strong> " . DROIT_EL_PRO_PHP_VERSION . " or later</strong> to run droit elementor addons plugin.", "droit-elementor-addons"));

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    /**
     * Check if a plugin is installed or Not
     * @access public
     * @since 1.0.0
     * Feature added by : DroitLab Team
     */
    private function is_droit_free_plugin_installed_or_not($basename) {
        if (!function_exists('get_plugins')) {
            include_once ABSPATH . '/wp-admin/includes/plugin.php';
        }

        $is_installed_plugins = get_plugins();

        return isset($is_installed_plugins[$basename]);
    }
    /**
     * Check Droit Elementor Addons Installed and Activated or Not
     * Warning when the site doesn't have Droit Elementor Addons installed or activated.
     * @access public
     * @since 1.0.0
     * Feature added by : DroitLab Team
     */
    public function is_missing_droit_free_plugin(){
        
        if (!current_user_can('activate_plugins')) {
            return;
        }

        $droit_free = 'droit-elementor-addons/plugins.php';

        $droit_plugins_name = 'Droit Elementor Addons Pro for Elementor';

        if ($this->is_droit_free_plugin_installed_or_not($droit_free)) {
            $activation_url = wp_nonce_url('plugins.php?action=activate&amp;plugin=' . $droit_free . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $droit_free);

            $message = __('<strong>'.$droit_plugins_name.'</strong> requires <strong>Droit Elementor Addons Free Version</strong> plugin to be active. Please activate Droit Elementor Addons Free Version to continue.', 'droit-elementor-addons-pro');
            
            $_button_text = __('Activate Free', 'droit-elementor-addons-pro');
        } else {
            $activation_url = wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin=droit-elementor-addons'), 'install-plugin_droit-elementor-addons');

            $message = sprintf(__('<strong>'.$droit_plugins_name.'</strong> requires <strong>Droit Elementor Addons Free Version</strong> plugin to be installed and activated. Please install Droit Elementor Addons Free Version to continue.', 'droit-elementor-addons-pro'), '<strong>', '</strong>');
            $_button_text = __('Install Droit Elementor Addons', 'droit-elementor-addons-pro');
        }

        $_button = '<p><a href="' . $activation_url . '" class="button-primary">' . $_button_text . '</a></p>';

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p>%2$s</div>', __($message), $_button); 
    }
    /**
     * Check Droit Elementor Addons Required Version
     * @access public
     * @since 1.0.0
     * Feature added by : DroitLab Team
     */
    public function is_missing_droit_free_valid_version(){

        if ( ! current_user_can( 'update_plugins' ) ) {
            return;
        }

        $file_path = 'droit-elementor-addons/plugins.php';

        $upgrade_link = wp_nonce_url( self_admin_url( 'update.php?action=upgrade-plugin&plugin=' ) . $file_path, 'upgrade-plugin_' . $file_path );
        $message = '<p>' . __( 'Droit Elementor Addons Pro is not working because you are using an old version of Droit Elementor Addons.', 'droit-elementor-addons-pro' ) . '</p>';
        $message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $upgrade_link, __( 'Update Now', 'droit-elementor-addons-pro' ) ) . '</p>';
         printf('<div class="notice notice-warning is-dismissible">%1$s</div>', __($message)); 
    }
    /**
     * Check Droit Elementor Addons Upgrade Notice
     * @access public
     * @since 1.0.0
     * Feature added by : DroitLab Team
     */
    public function droit_pro_upgrade_recommendation(){

        if ( ! current_user_can( 'update_plugins' ) ) {
            return;
        }

        $file_path = 'droit-elementor-addons/plugins.php';

        $upgrade_link = wp_nonce_url( self_admin_url( 'update.php?action=upgrade-plugin&plugin=' ) . $file_path, 'upgrade-plugin_' . $file_path );
        $message = '<p>' . __( 'A new version of Droit Addons is available. For better performance and compatibility of Droit Elementor Addons Pro, we recommend updating to the latest version.', 'droit-elementor-addons-pro' ) . '</p>';
        $message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $upgrade_link, __( 'Update Now', 'droit-elementor-addons-pro' ) ) . '</p>';
         printf('<div class="notice notice-warning is-dismissible">%1$s</div>', __($message)); 
    }
}