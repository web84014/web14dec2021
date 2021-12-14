<?php
/**
 * Dt Themes Theme Framework
 * The Saasland_register_theme initiate the theme engine
 */

if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
class Saasland_register_theme {

    /**
     * Variables required for the theme updater
     *
     * @since 1.0.0
     * @type string
     */
    protected $remote_api_url = null;
    protected $theme_slug = null;
    protected $version = null;
    protected $renew_url = null;
    protected $strings = null;

    /**
     * Initialize the class.
     *
     * @since 1.0.0
     */
    function __construct( $config = array(), $strings = array() ) {

        $config = wp_parse_args( $config, array(
            'remote_api_url' => 'http://droitthemes.com/verify',
            'theme_slug'     => 'saasland',
            'version'        => '',
            'author'         => 'Dt Themes',
            'renew_url'      => ''
        ));

        // Set config arguments
        $this->remote_api_url = $config['remote_api_url'];
        $this->theme_slug     = sanitize_key( $config['theme_slug'] );
        $this->version        = $config['version'];
        $this->author         = $config['author'];
        $this->renew_url      = $config['renew_url'];

        // Populate version fallback
        if ( '' == $config['version'] ) {
            $theme = wp_get_theme( $this->theme_slug );
            $this->version = $theme->get( 'Version' );
        }

        // Strings passed in from the updater config
        $this->strings = $strings;

        add_action( 'after_setup_theme', array( $this, 'init_hooks' ) );
        add_action( 'admin_init', array( $this, 'register_option' ) );
        add_filter( 'http_request_args', array( $this, 'disable_wporg_request' ), 5, 2 );
    }

    /**
     * [init_hooks description]
     * @method init_hooks
     * @return [type]     [description]
     */
    public function init_hooks() {

        if ( 'valid' != get_option( $this->theme_slug . '_purchase_code_status', false ) ) {

            if ( ( ! isset( $_GET['page'] ) || 'saasland' != $_GET['page'] ) ) {
                add_action( 'admin_notices', array( $this, 'admin_error' ) );
            } else {
                add_action( 'admin_notices', array( $this, 'admin_notice' ) );

            }
        }
    }

    function admin_error() {
        $out = '<div class="notice notice-error is-dismissible saasland-purchase-notice"><p>' . sprintf( wp_kses_post( __( 'The %s theme needs to be registered. %sRegister Now%s', 'saasland' ) ), 'Saasland', '<a href="' . admin_url( 'admin.php?page=saasland') . '">' , '</a>' ) . '</p></div>';
        if ( get_option('notice_dismissed') ) {
            return;
        }
        echo wp_kses_post($out);
    }

    function admin_notice() {
        $out = '<div class="notice is-dismissible saasland-purchase-notice"><p>' .
            sprintf( wp_kses_post( __( 'Purchase code is invalid. Need a license? %sPurchase Now%s', 'saasland' ) ), '<a target="_blank" href="https://themeforest.net/item/saasland-creative-wordpress-theme-for-saas-business/23362980">', '</a>' ) .
            '</p></div>';
        if ( get_option('notice_dismissed') ) {
            return;
        }
        echo wp_kses_post($out);
    }

    function messages() {
        $license = trim( get_option( $this->theme_slug . '_purchase_code' ) );
        $status = get_option( $this->theme_slug . '_purchase_code_status', false );
        if ( $status != '' ) {
            $license_icon = ($status == 'valid') ? '<i class="icon_check_alt2"></i>' : '<i class="icon_error-circle_alt"></i>';
            $title = ($status == 'valid') ? '<img src="'.get_template_directory_uri().'/assets/img/verify_success.png"/>' : '<h4>' .$license_icon . esc_html__( 'Purchase Code Invalid', 'saasland' ). '</h4>';
        } else {
            $license_icon = '';
            $title = '<h4>' .$license_icon . esc_html__( 'Verify by . . .', 'saasland' ). '</h4>';
        }
        // Checks license status to display under license key
        $message    =  $title ;

        echo wp_kses_post( $message );

    }

    /**
     * Outputs the markup used on the theme license page
     * since 1.0.0
     */
    function form() {
        $strings = $this->strings;
        $license = trim( get_option( $this->theme_slug . '_purchase_code' ) );
        $username = trim( get_option( $this->theme_slug . '_purchase_username' ) );
        $email = get_option( $this->theme_slug . '_register_email', false );
        $status = get_option( $this->theme_slug . '_purchase_code_status', false );
        require get_template_directory().'/inc/verify/class.verify-purchase.php';
        ?>
        <div id="show-result"></div>
        <?php if ($status != 'valid'): ?>

            <form action="" method="post" id="verify-envato-purchase" class="dt-theme-register-form">
                <?php settings_fields( $this->theme_slug . '-license' ); ?>
                <input id="saasland_purchase_username" name="saasland_purchase_username" type="text" value="<?php echo esc_attr( $username  ); ?>" placeholder="<?php esc_attr_e( 'Enter envato username, e.g. saasland', 'saasland' ); ?>" required>
                <input id="saasland_purchase_code" name="saasland_purchase_code" type="text" value="<?php echo esc_attr( $license ); ?>" placeholder="<?php esc_attr_e( 'Enter purchase code, e.g. cb0e057f-a05d-4758-b314-024db98eff85', 'saasland' ); ?>" required>

                <input type="submit" value="<?php esc_attr_e( 'Register your copy', 'saasland' ) ?>">
            </form>
        <?php endif; ?>
        <?php
        if ( isset($_POST['saasland_purchase_code'] ) && isset($_POST['saasland_purchase_username']) ) {
            if(empty($_POST['saasland_purchase_code'])){
                delete_option('saasland_settings');
            }elseif(empty($_POST['saasland_purchase_username'])){
                delete_option('saasland_settings');
            }else{
                update_option( $this->theme_slug . '_purchase_code', $_POST['saasland_purchase_code'] );
                $purchase_code = htmlspecialchars($_POST['saasland_purchase_code']);
                $username = htmlspecialchars($_POST['saasland_purchase_username']);
                $o = EnvatoApi2::verifyPurchase( $purchase_code, $username );
                if ( is_object($o) ) {
                    update_option('saasland_purchase_code_status', 'valid', 'yes');
                    update_option('saasland_settings', array());
                } else {
                    update_option( 'saasland_purchase_code_status', 'invalid', 'yes' );
                    delete_option('saasland_settings');
                }

                wp_redirect( get_admin_url( null, 'admin.php?page=saasland' ) );
                exit;
            }
        }
    }

    /**
     * Registers the option used to store the license key in the options table.
     *
     * since 1.0.0
     */
    function register_option() {
        register_setting(
            $this->theme_slug . '-license',
            $this->theme_slug . '_purchase_code',
            array( $this, 'sanitize_license' )
        );
        register_setting(
            $this->theme_slug . '-license',
            $this->theme_slug . '_register_email'
        );
    }


    /**
     * Disable requests to wp.org repository for this theme.
     *
     * @since 1.0.0
     */
    function disable_wporg_request( $r, $url ) {

        // If it's not a theme update request, bail.
        if ( 0 !== strpos( $url, 'https://api.wordpress.org/themes/update-check/1.1/' ) ) {
            return $r;
        }

        // Decode the JSON response
        $themes = json_decode( $r['body']['themes'] );

        // Remove the active parent and child themes from the check
        $parent = get_option( 'template' );
        $child = get_option( 'stylesheet' );
        unset( $themes->themes->$parent );
        unset( $themes->themes->$child );

        // Encode the updated JSON response
        $r['body']['themes'] = json_encode( $themes );

        return $r;
    }

}

new Saasland_register_theme;