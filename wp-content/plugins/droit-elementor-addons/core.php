<?php
namespace DROIT_ELEMENTOR;
defined( 'ABSPATH' ) || exit;

final class Dtdr_Core{

    private static $instance;

    public function __construct(){
        self::_run(); 
    }
    
    public static function version(){
        return DROIT_ADDONS_VERSION_;
    }
 
    public static function php_version(){
        return '5.6';
    }

	public static function dtdr_file(){
		return  DROIT_ADDONS_FILE_;
	}
  
	public static function dtdr_url(){
		return trailingslashit(plugin_dir_url( self::dtdr_file() ));
	}

	public static function dtdr_dir(){
		return trailingslashit(plugin_dir_path( self::dtdr_file() ));
    }

    public function load(){  
        if(current_user_can('manage_options')){
           add_action( 'admin_enqueue_scripts', [ $this , 'admin_enqueue'] );
        }
        if ( version_compare( PHP_VERSION, self::php_version(), '<' ) ) {
			add_action( 'admin_notices', function(){
                $class = 'notice notice-error';
                $message = sprintf( __( '<b>Droit Addons</b> requires PHP version %1$s+, which is currently NOT RUNNING on this server.', 'droit-addons' ), '5.6' );
                printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), $message); 
            } );
			return;
		}   

        // check elementor
        if (!did_action('elementor/loaded')) {
            add_action('admin_notices', [$this, 'check_elementor']);
            return;
        }
         
        // load manager
        Manager::instance()->load();
        
        // added setting link
        add_filter("plugin_action_links_" . plugin_basename(DROIT_ADDONS_FILE_), [$this, 'add_settings_link']);
        // add row 
        add_filter( 'plugin_row_meta', [ $this, 'plugin_row_meta' ], 10, 2 );

    }

    public static function _run() {
		spl_autoload_register( [ __CLASS__, 'autoloading' ] );
    }

    private static function autoloading( $ld ) {
        if ( 0 !== strpos( $ld, __NAMESPACE__ ) ) {
            return;
        }
        
        // get map setup data
        $map = self::class_map();
        $relative_class_name = preg_replace( '/^' . __NAMESPACE__ . '\\\/', '', $ld );
        if( isset( $map[ $relative_class_name ] ) ){
            $name = $map[ $relative_class_name ];
        } else {
            $name = strtolower(preg_replace([ '/\b'.__NAMESPACE__.'\\\/', '/([a-z])([A-Z])/', '/_/', '/\\\/' ], [ '', '$1-$2', '-', DIRECTORY_SEPARATOR], $ld) );
            $name = str_replace('dtdr-', '', $name). '.php';    
        }
        $filename = self::dtdr_dir() . $name;
        if ( is_readable( $filename ) ) {
           require_once( $filename );
        }
    }

    public function admin_enqueue(){
        wp_register_style( 'droit-notices', drdt_core()->css . 'notices' . drdt_core()->minify . '.css', false, drdt_core()->version );
        // notices
        wp_enqueue_style('droit-notices');
    }

    public function check_elementor(){
        $screen = get_current_screen();
        if ( isset( $screen->parent_file ) && 'plugins.php' === $screen->parent_file && 'update' === $screen->id ) {
            return;
        }
        $plugin = 'elementor/elementor.php';
        $droit_plugins_name = 'Droit Elementor Addons';
        $installed_plugins = get_plugins();
        $is_elementor_installed = isset( $installed_plugins[ $plugin ] );
        if ( $is_elementor_installed ) {
            if ( ! current_user_can( 'activate_plugins' ) ) {
                return;
            }
            $button_text = __( 'Activate Elementor', 'droit-addons' );
            $button_link = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $plugin );
            $message     = __('<strong>'.$droit_plugins_name.'</strong> requires <strong>Elementor</strong> plugin to be active. Please activate Elementor to continue.', 'droit-addons');
        } else {
            if ( ! current_user_can( 'install_plugins' ) ) {
                return;
            }
            $button_text = __( 'Install Elementor', 'droit-addons' );
            $button_link = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' );
            $message     = sprintf(__('<strong>'.$droit_plugins_name.' requires Elementor</strong> plugin to be installed and activated. Please install Elementor to continue.', 'droit-addons'), '<strong>', '</strong>');
        }

        if( is_readable( drdt_core()->templates_dir . 'notices.php' ) ){
            include_once drdt_core()->templates_dir . 'notices.php';
        }
    }
    // class map
    public static function class_map(){
        return [
            'Manager'         => 'includes/manager.php',
            'Manager\Enqueue' => 'includes/enqueue.php',
            'Manager\Ajax'    => 'includes/ajax.php',
            'Manager\Admin'   => 'includes/admin.php',
            'Manager\Widgets' => 'includes/widgets.php',
            'Manager\Control' => 'includes/control.php',
            'Manager\Modules' => 'includes/modules.php',
            'Manager\Api'     => 'includes/api.php',
            'DL_Sticky'       => 'modules/sticky/sticky.php',

            'Module\Controls\Droit_Control'     => 'modules/controls/droit-control.php',
            'Module\Controls\Icons\Droit_Icons' => 'modules/controls/icons/icons.php',
            'Module\Extention\Common_Section'   => 'modules/extention/common-section.php',
            'Module\Extention\Custom_Column'    => 'modules/extention/custom-column.php',
            'Module\Back_Parallax'    => 'modules/background/background-parallax.php',

            'DL_Helper' => 'core/helper.php',
            'DL_Images' => 'core/droit-images.php',

            // templates
            'Templates\DL_Templates' => 'modules/templates/init.php',
            'Templates\DL_Import'    => 'modules/templates/import.php',
            'Templates\Dl_Api'       => 'modules/templates/api.php',
            'Templates\Dl_Load'      => 'modules/templates/load.php',

        ];
    } 


    public function add_settings_link( $link ){
        $settings[] = '<a href="' . admin_url( 'admin.php?page=droit-addons' ) . '" class="drdt-settings-plugin"> '.esc_html__('Settings', 'droit-addons').'</a>';
        $settings[] = '<a href="https://droitthemes.com/droit-elementor-addons/" class="drdt-settings-plugin" style="color: #93003c;text-shadow: 1px 1px 1px #eee;font-weight: 700;"> '.esc_html__('Go PRO', 'droit-addons').'</a>';
      
        $link = array_merge( $link, $settings );
        return $link;
    }

    public function plugin_row_meta( $plugin_meta, $plugin_file ) {
		if ( plugin_basename(DROIT_ADDONS_FILE_) === $plugin_file ) {
			$row_meta = [
				'docs'    => '<a href="https://demos.droitthemes.com/droit-elementor-addons/" aria-label="' . esc_attr( __( 'View Demo', 'droit-addons' ) ) . '" target="_blank">' . __( 'View Demo', 'droit-addons' ) . '</a>',
				'support' => '<a href="https://droitthemes2.ticksy.com/submit/" aria-label="' . esc_attr( __( 'Support', 'droit-addons' ) ) . '" target="_blank">' . __( 'Get Support', 'droit-addons' ) . '</a>',
				'getpro'  => '<a href="https://droitthemes.com/droit-elementor-addons/" aria-label="' . esc_attr( __( 'Get PRO', 'droit-addons' ) ) . '" target="_blank">' . __( 'Get Pro', 'droit-addons' ) . '</a>',
			];

			$plugin_meta = array_merge( $plugin_meta, $row_meta );
		}

		return $plugin_meta;
	}

    public static function instance(){
        if ( is_null( self::$instance ) ){
            self::$instance = new self();
            do_action( 'droitAddons/loaded' );
            do_action( 'droit_elementor_addons/loaded');
        }
        return self::$instance;
    }

}
