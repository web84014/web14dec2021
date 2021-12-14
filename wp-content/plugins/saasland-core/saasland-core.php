<?php
/**
 * Plugin Name: Saasland Core
 * Plugin URI: https://themeforest.net/user/droitthemes/portfolio
 * Description: This plugin adds the core features to the Saasland WordPress theme. You must have to install this plugin to get all the features included with the Saasland theme.
 * Version: 3.3.3
 * Author: DroitThemes
 * Author URI: https://themeforest.net/user/droitthemes/portfolio
 * Text domain: saasland-core
 */

if ( !defined( 'ABSPATH') )
    die( '-1');

// Saasland Core Directories
define( 'SC_IMAGES', plugins_url( 'widgets/images/', __FILE__));

// Make sure the same class is not loaded twice in free/premium versions.
if ( !class_exists( 'Saasland_core' ) ) {
	/**
	 * Main Saasland Core Class
	 *
	 * The main class that initiates and runs the Saasland Core plugin.
	 *
	 */
	class Saasland_core {
		/**
		 * Saasland Core Version
		 *
		 * Holds the version of the plugin.
		 *
		 * @var string The plugin version.
		 */
		const VERSION = '3.1.5' ;

		/**
		 * Minimum Elementor Version
		 *
		 * Holds the minimum Elementor version required to run the plugin.
		 *
		 * @var string Minimum Elementor version required to run the plugin.
		 */
		const MINIMUM_ELEMENTOR_VERSION = '2.6.0';

		/**
		 * Minimum PHP Version
		 *
		 * Holds the minimum PHP version required to run the plugin.
		 *
		 * @var string Minimum PHP version required to run the plugin.
		 */
		const  MINIMUM_PHP_VERSION = '5.4' ;

        /**
         * Plugin's directory paths
         * @since 1.0
         */
        const CSS = null;
        const JS = null;
        const IMG = null;
        const VEND = null;

		/**
		 * Instance
		 *
		 * Holds a single instance of the `Saasland_Core` class.
		 *
		 * @access private
		 * @static
		 *
		 * @var Saasland_Core A single instance of the class.
		 */
		private static  $_instance = null ;

		/**
		 * Instance
		 *
		 * Ensures only one instance of the class is loaded or can be loaded.\
		 *
		 * @access public
		 * @static
		 *
		 * @return Saasland_Core An instance of the class.
		 */
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}

		/**
		 * Clone
		 *
		 * Disable class cloning.
		 *
		 * @access protected
		 *
		 * @return void
		 */
		public function __clone() {
			// Cloning instances of the class is forbidden
			_doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'saasland-core' ), '1.7.0' );
		}

		/**
		 * Wakeup
		 *
		 * Disable unserializing the class.
		 *
		 * @access protected
		 *
		 * @return void
		 */
		public function __wakeup() {
			// Unserializing instances of the class is forbidden.
			_doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'saasland-core' ), '1.7.0' );
		}

		/**
		 * Constructor
		 *
		 * Initialize the Saasland Core plugins.
		 *
		 * @access public
		 */
		public function __construct() {
            $opt = get_option('saasland_opt');
            $is_mega_menu_cpt = isset($opt['is_mega_menu_cpt']) ? $opt['is_mega_menu_cpt'] : '1';
            if ( $is_mega_menu_cpt == '1' ) {
                add_action( 'init', [$this, 'mega_menu_include'] );
            }

            $this->init_hooks();
			$this->core_includes();
			do_action( 'saasland_core_loaded' );
		}

		/**
		 * Include Files
		 *
		 * Load core files required to run the plugin.
		 *
		 * @access public
		 */
		public function core_includes() {
		    $opt = get_option('saasland_opt');
            $is_mega_menu_cpt = isset($opt['is_mega_menu_cpt']) ? $opt['is_mega_menu_cpt'] : '1';
		    $is_service_cpt = isset($opt['is_service_cpt']) ? $opt['is_service_cpt'] : '1';
		    $is_portfolio_cpt = isset($opt['is_portfolio_cpt']) ? $opt['is_portfolio_cpt'] : '1';
		    $is_team_cpt    = isset($opt['is_team_cpt']) ? $opt['is_team_cpt'] : '1';
		    $is_case_study_cpt = isset($opt['is_case_study_cpt']) ? $opt['is_case_study_cpt'] : '1';
		    $is_faq_cpt     = isset($opt['is_faq_cpt']) ? $opt['is_faq_cpt'] : '1';
		    $is_job_cpt     = isset($opt['is_job_cpt']) ? $opt['is_job_cpt'] : '1';

		    $is_header_cpt  = isset($opt['is_header_cpt']) ? $opt['is_header_cpt'] : '1';
		    $is_footer_cpt  = isset($opt['is_footer_cpt']) ? $opt['is_footer_cpt'] : '1';

		    // Extra functions
			require_once __DIR__ . '/inc/extra.php';

			// Custom post types
            if ( $is_service_cpt == '1' ) {
                require_once __DIR__ . '/post-type/service.pt.php';
            }
            if ( $is_portfolio_cpt == '1' ) {
                require_once __DIR__ . '/post-type/portfolio.pt.php';
            }
            if ( $is_team_cpt == '1' ) {
                require_once __DIR__ . '/post-type/team.pt.php';
            }
            if ( $is_case_study_cpt == '1' ) {
                require_once __DIR__ . '/post-type/case_study.pt.php';
            }
            if ( $is_faq_cpt == '1' ) {
                require_once __DIR__ . '/post-type/faq.pt.php';
            }
            if ( $is_job_cpt == '1' ) {
                require_once __DIR__ . '/post-type/job.pt.php';
            }
            if ( $is_mega_menu_cpt == '1' ) {
                require_once __DIR__ . '/post-type/Saasland_mega_menu.pt.php';
            }
			if ( $is_header_cpt == '1' ) {
                require_once __DIR__ . '/post-type/header.pt.php';
            }
			if ( $is_footer_cpt == '1' ) {
                require_once __DIR__ . '/post-type/footer.pt.php';
            }
            require_once __DIR__ . '/post-type/none.pt.php';

            /**
             * Register widget area.
             *
             * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
             */
			require_once __DIR__ . '/wp-widgets/widgets.php';

			// Elementor custom field icons
			require_once __DIR__ . '/fields/icons.php';

            // RGBA color picker field for ACF
            require plugin_dir_path(__FILE__) . '/inc/acf-rgba-color-picker/acf-rgba-color-picker.php';


		}

		function mega_menu_include() {
            // Mega Menu
            $mega_menus = new WP_Query(array(
                'post_type' => 'megamenu',
                'posts_per_page' => -1,
            ));
            $mega_menu_count = $mega_menus->post_count;
            if ( $mega_menu_count > 0 && has_nav_menu('main_menu') ) {
                require plugin_dir_path(__FILE__) . '/inc/mega_menu.php';
            }
        }

		/**
		 * Init Hooks
		 *
		 * Hook into actions and filters.
		 *
		 * @access private
		 */
		private function init_hooks() {
			add_action( 'init', [ $this, 'i18n' ] );
			add_action( 'plugins_loaded', [ $this, 'init' ] );
		}

		/**
		 * Load Textdomain
		 *
		 * Load plugin localization files.
		 *
		 * @access public
		 */
		public function i18n() {
			load_plugin_textdomain( 'saasland-core', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
		}


		/**
		 * Init Saasland Core
		 *
		 * Load the plugin after Elementor (and other plugins) are loaded.
		 *
		 * @access public
		 */
		public function init() {
			if ( !did_action( 'elementor/loaded' ) ) {
				add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
				return;
			}

			// Check for required Elementor version

			if ( !version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
				add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
				return;
			}

			// Check for required PHP version

			if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
				add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
				return;
			}

			// Add new Elementor Categories
			add_action( 'elementor/init', [ $this, 'add_elementor_category' ] );

			// Register Widget Scripts
			add_action( 'elementor/frontend/after_register_scripts', [ $this, 'register_widget_scripts' ] );
			add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'register_widget_scripts' ] );
            add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );

			// Register Widget Scripts
            add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'enqueue_elementor_editor_styles' ] );
			add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'enqueue_widget_styles' ] );

			// Register New Widgets
			add_action( 'elementor/widgets/widgets_registered', [ $this, 'on_widgets_registered' ] );

            add_filter( 'wpml_elementor_widgets_to_translate', [ $this, 'wpml_widgets_to_translate_filter' ] );
		}

        /**
         * Integrate WPML
         */
        public function wpml_widgets_to_translate_filter( $widgets ) {
            require_once __DIR__ . '/wpml/WPML_Fields.php';
            return $widgets;
        }

		/**
		 * Admin notice
		 *
		 * Warning when the site doesn't have Elementor installed or activated.
		 *
		 * @access public
		 */
		public function admin_notice_missing_main_plugin() {
			$message = sprintf(
			/* translators: 1: Saasland Core 2: Elementor */
				esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'saasland-core' ),
				'<strong>' . esc_html__( 'Saasland core', 'saasland-core' ) . '</strong>',
				'<strong>' . esc_html__( 'Elementor', 'saasland-core' ) . '</strong>'
			);
			printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
		}

		/**
		 * Admin notice
		 *
		 * Warning when the site doesn't have a minimum required Elementor version.
		 *
		 * @access public
		 */
		public function admin_notice_minimum_elementor_version() {
			$message = sprintf(
			/* translators: 1: Saasland Core 2: Elementor 3: Required Elementor version */
				esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'saasland-core' ),
				'<strong>' . esc_html__( 'Saasland Core', 'saasland-core' ) . '</strong>',
				'<strong>' . esc_html__( 'Elementor', 'saasland-core' ) . '</strong>',
				self::MINIMUM_ELEMENTOR_VERSION
			);
			printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
		}

		/**
		 * Admin notice
		 *
		 * Warning when the site doesn't have a minimum required PHP version.
		 *
		 * @access public
		 */
		public function admin_notice_minimum_php_version() {
			$message = sprintf(
			/* translators: 1: Saasland Core 2: PHP 3: Required PHP version */
				esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'saasland-core' ),
				'<strong>' . esc_html__( 'Saasland Core', 'saasland-core' ) . '</strong>',
				'<strong>' . esc_html__( 'PHP', 'saasland-core' ) . '</strong>',
				self::MINIMUM_PHP_VERSION
			);
			printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
		}

		/**
		 * Add new Elementor Categories
		 *
		 * Register new widget categories for Saasland Core widgets.
		 *
		 * @access public
		 */
		public function add_elementor_category() {
			\Elementor\Plugin::instance()->elements_manager->add_category( 'saasland-elements', [
				'title' => __( 'Saasland Elements', 'saasland-core' ),
			], 1 );
		}

		/**
		 * Register Widget Scripts
		 *
		 * Register custom scripts required to run Saasland Core.
		 *
		 * @access public
		 */
		public function register_widget_scripts() {

            if ( !is_admin() ) {
                wp_deregister_script( 'jquery' );
                wp_register_script( 'jquery', plugins_url( 'assets/js/jquery-3.2.1.min.js', __FILE__ ), false, '3.4.1' );
                wp_enqueue_script( 'jquery' );
            }

            wp_register_script( 'slick', plugins_url( 'assets/vendors/slick/slick.min.js', __FILE__ ), 'jquery', '1.9.0', true );

            wp_register_script( 'typed', plugins_url( 'assets/js/typed.min.js', __FILE__ ), 'jquery', '1.0.0', true );

			wp_register_script( 'ajax-chimp', plugins_url( 'assets/js/ajax-chimp.js', __FILE__ ), 'jquery', '1.0', true );

			wp_register_script( 'owl-carousel', plugins_url( 'assets/vendors/owl-carousel/owl.carousel.min.js', __FILE__ ), 'jquery', '2.3.4', true );

			wp_register_script( 'waypoints', plugins_url( 'assets/vendors/counterup/jquery.waypoints.min.js', __FILE__ ), 'jquery', '4.0.1', true );

			wp_register_script( 'counterup', plugins_url( 'assets/vendors/counterup/jquery.counterup.min.js', __FILE__ ), 'jquery', '1.0', true );

			wp_register_script( 'appear', plugins_url( 'assets/vendors/counterup/appear.js', __FILE__ ), 'jquery', '1.0', true );

			wp_register_script( 'parallax-scroll', plugins_url( 'assets/vendors/sckroller/jquery.parallax-scroll.js', __FILE__ ), 'jquery', '1.0', true );

			wp_register_script( 'parallax', plugins_url( 'assets/js/appart-parallax.js', __FILE__ ), 'jquery', '1.0', true );

			wp_register_script( 'stellar', plugins_url( 'assets/vendors/stellar/jquery.stellar.js', __FILE__ ), 'jquery', '1.0', true );

			wp_register_script( 'circle-progress', plugins_url( 'assets/vendors/circle-progress/circle-progress.js', __FILE__ ), 'jquery', '1.1.3', true );

			wp_register_script( 'isotope', plugins_url( 'assets/vendors/isotope/isotope-min.js', __FILE__ ), 'jquery', '3.0.1', true );

			wp_register_script( 'splitting', plugins_url( 'assets/vendors/splitting/splitting.min.js', __FILE__ ), 'jquery', '3.0.1', true );

			// Event Date Count Down Js
            wp_register_script( 'knob', plugins_url( 'assets/vendors/red-countdown/knob.js', __FILE__), array( 'jquery'), '1.2.11', true );
            wp_register_script( 'throttle', plugins_url( 'assets/vendors/red-countdown/throttle.js', __FILE__), array( 'jquery'), '1.1', true );
            wp_register_script( 'moment', plugins_url( 'assets/vendors/red-countdown/moment.js', __FILE__), array( 'jquery'), '2.9.0', true );
            wp_register_script( 'redcountdown', plugins_url( 'assets/vendors/red-countdown/redcountdown.js', __FILE__), array( 'jquery'), '1.0', true );
            wp_register_script( 'red-countdown-settings', plugins_url( 'assets/vendors/red-countdown/red-countdown-settings.js', __FILE__), array( 'jquery'), '1.0', true );

            wp_register_script( 'comming-soon', plugins_url( 'assets/js/comming-soon.js', __FILE__), array( 'jquery'), '1.0', true );

            wp_enqueue_script( 'wow', plugins_url( 'assets/vendors/wow/wow.min.js', __FILE__), array( 'jquery'), '1.1.3', true );

            wp_enqueue_script( 'appart-custom', plugins_url( 'assets/js/appart-custom.js', __FILE__), array( 'jquery'), '1.0.0', true );

            if ( is_rtl() ) {
                wp_enqueue_script( 'saasland-main-rtl', plugins_url( 'assets/js/main-rtl.js', __FILE__), 'jquery', '1.0', true);
            } else {
                wp_enqueue_script( 'saasland-main', plugins_url( 'assets/js/main.js', __FILE__), 'jquery', '1.0', true);
            }
		}

		/**
		 * Register Widget Styles
		 *
		 * Register custom styles required to run Saasland Core.
		 *
		 * @access public
		 */
		
		public function enqueue_widget_styles() {

            wp_enqueue_style( 'simple-line-icon', plugins_url( 'assets/vendors/simple-line-icon/simple-line-icons.min.css', __FILE__ ) );

            wp_register_style( 'slick', plugins_url( 'assets/vendors/slick/slick.min.css', __FILE__ ) );

            wp_enqueue_style( 'slick-theme', plugins_url( 'assets/vendors/slick/slick-theme.css', __FILE__ ) );

            wp_register_style( 'appart-style', plugins_url( 'assets/css/appart-style.css', __FILE__ ) );

            wp_register_style( 'appart-responsive', plugins_url( 'assets/css/appart-responsive.min.css', __FILE__ ) );

            if ( is_rtl() ) {
                wp_enqueue_style( 'appart-rtl', plugins_url( 'assets/css/appart-rtl.min.css', __FILE__ ), array('appart-style') );
            }

            wp_register_style( 'owl-carousel', plugins_url( 'assets/vendors/owl-carousel/assets/owl.carousel.min.css', __FILE__) );

            // Section Dependency CSS
            wp_register_style( 'hero-chat', plugins_url( 'widgets/hero/chat/hero-chat.css', __FILE__ ) );

            wp_register_style( 'price-table-event', plugins_url( 'widgets/pricing-table/event/price-table-event.css', __FILE__ ) );

            wp_register_style( 'hero-event', plugins_url( 'widgets/hero/event/hero-event.css', __FILE__ ) );

            wp_register_style( 'parallax-image', plugins_url( 'assets/css/widgets/parallax-image.css', __FILE__ ) );

            wp_register_style( 'curve-counter-event', plugins_url( 'assets/css/widgets/curve-counter-event.css', __FILE__ ) );

            wp_register_style( 'date-countdown', plugins_url( 'assets/css/widgets/date-countdown.min.css', __FILE__ ) );

            wp_register_style( 'event-schedule', plugins_url( 'assets/css/widgets/event-schedule.css', __FILE__ ) );

            wp_register_style( 'team', plugins_url( 'assets/css/widgets/team.css', __FILE__ ) );

            wp_register_style( 'tilt-image2', plugins_url( 'assets/css/widgets/tilt-images2.min.css', __FILE__ ) );

            wp_register_style( 'chat-features', plugins_url( 'assets/css/widgets/chat-features.css', __FILE__ ) );

            wp_register_style( 'splitting', plugins_url( 'assets/vendors/splitting/splitting.css', __FILE__ ) );

            //Saasland Demo
            wp_register_style( 'saasland-demo', plugins_url( 'assets/css/saasland-demo.min.css', __FILE__) );

            if ( defined( 'ELEMENTOR_VERSION') ) {
                if ( \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
                    wp_enqueue_style( 'owl-carousel' );
                    wp_enqueue_style( 'appart-style' );
                    wp_enqueue_style( 'appart-responsive' );
                    wp_enqueue_style( 'saasland-digital-agency' );
                }
            }
            wp_register_style( 'themify-icons', plugins_url( 'assets/vendors/themify-icon/themify-icons.css', __FILE__ ) );

            if ( is_page_template( 'page-split.php') ) {
                wp_enqueue_style( 'multiscroll', plugins_url( 'assets/vendors/multiscroll/jquery.multiscroll.css', __FILE__));
            }

            wp_enqueue_style( 'themify-icons' );

            wp_enqueue_style( 'saasland-flaticons', plugins_url( 'assets/vendors/flaticon/flaticon.css', __FILE__ ) );
		}

		public function enqueue_elementor_editor_styles() {

            wp_enqueue_style( 'simple-line-icon', plugins_url( 'assets/vendors/simple-line-icon/simple-line-icons.min.css', __FILE__ ) );

            wp_enqueue_style( 'saasland-elementor-editor', plugins_url( 'assets/css/saasland-elementor-editor.css', __FILE__ ) );

            wp_register_style( 'themify-icons', plugins_url( 'assets/vendors/themify-icon/themify-icons.css', __FILE__ ) );

            wp_enqueue_style( 'themify-icons' );

            wp_enqueue_style( 'saasland-flaticons', plugins_url( 'assets/vendors/flaticon/flaticon.css', __FILE__ ) );
		}

        public function enqueue_scripts() {
            wp_register_script( 'knob', plugins_url( 'assets/vendors/red-countdown/knob.js', __FILE__), array( 'jquery'), '1.2.11', true );
            wp_register_script( 'throttle', plugins_url( 'assets/vendors/red-countdown/throttle.js', __FILE__), array( 'jquery'), '1.1', true );
            wp_register_script( 'moment', plugins_url( 'assets/vendors/red-countdown/moment.js', __FILE__), array( 'jquery'), '2.9.0', true );
            wp_register_script( 'redcountdown', plugins_url( 'assets/vendors/red-countdown/redcountdown.js', __FILE__), array( 'jquery'), '1.0', true );
            wp_register_script( 'red-countdown-settings', plugins_url( 'assets/vendors/red-countdown/red-countdown-settings.js', __FILE__), array( 'jquery'), '1.0', true );
        }

		/**
		 * Register New Widgets
		 *
		 * Include Saasland Core widgets files and register them in Elementor.
		 *
		 * @access public
		 */
		public function on_widgets_registered() {
			$this->include_widgets();
			$this->register_widgets();
		}

		/**
		 * Include Widgets Files
		 *
		 * Load Saasland Core widgets files.
		 *
		 * @access private
		 */
		private function include_widgets() {
            require_once __DIR__ . '/vendor/autoload.php';
        }


		/**
		 * Register Widgets
		 *
		 * Register Saasland Core widgets.
		 *
		 * @access private
		 */
		private function register_widgets() {
            // Site Elements
            $widgets = array(
                'Subscribe_Form', 'Services_shapes', 'Solar_Integration', 'Integrations', 'Integrations_row', 'Pricing_table', 'Pricing_table_tabs',
                'Pricing_table_tabs_carousel','Navbar', 'Hero_Section', 'Hero_crm', 'Two_column_features', 'Services', 'Call_to_Action', 'Footer',
                'Client_logos', 'Features', 'Bubble_features', 'Features_vertical', 'Prototype_features', 'Features_vertical', 'Prototype_features',
                'Tabs', 'Tabs_with_icon', 'Blog', 'Testimonial', 'Testimonial_bubble', 'Testimonial_ratting', 'Testimonial_single', 'Paired_images',
                'Tabs_horizontal', 'Features_with_shapes', 'Features_with_image', 'Features_with_image_white', 'Counter', 'Curve_counter', 'Circle_counter',
                'Hero_app', 'Hero_seo', 'Hero_integration', 'Hero_videos', 'Hero_with_bg_img', 'Image_carousels', 'Downloads', 'Team', 'Map', 'Map2',
                'Processes', 'Hotspot', 'Portfolio', 'Portfolio_masonry', 'Login_form', 'Signup_form', 'Jobs', 'Icon_boxes', 'Single_video',
                'Single_feature', 'Single_feature', 'Icons', 'Icon_dual', 'Seo_check_form', 'Posts_carousel', 'Featured_image_with_shape', 'Slider',
                'Serialized_features', 'Alerts_box', 'Faq', 'Pricing_table_comparison', 'Appart_hero', 'Appart_c2a', 'Appart_screen_feature',
                'Appart_pricing_table', 'Appart_app_info', 'Appart_testimonials', 'Appart_features', 'Appart_single_video', 'Appart_parallax_hero',
                'Appart_parallax_hero', 'Appart_single_info_with_icon', 'Appart_shop_categories','Appart_products', 'Ticket_plan', 'Hero_erp',
                'Icon_with_featured_img', 'Domain_form', 'Locations', 'Table_tabs', 'Button_icons', 'Parallax_img_effect', 'Countdown', 'Event_schedule',
                'Progress_bar', 'About_section', 'Saasland_product', 'Saasland_heading'
            );
            foreach ( $widgets as $widget ) {
                $classname = "\\SaaslandCore\\Widgets\\$widget";
                \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new $classname() );
            }
        }
	}
}
// Make sure the same function is not loaded twice in free/premium versions.

if (!function_exists( 'saasland_core_load' ) ) {
	/**
	 * Load Saasland Core
	 *
	 * Main instance of Saasland_Core.
	 */
	function saasland_core_load() {
		return Saasland_core::instance();
	}

	// Run Saasland Core
    saasland_core_load();
}


function saasland_admin_cpt_script( $hook ) {
    global $post;

    if ( $hook == 'post-new.php' || $hook == 'post.php' ) {
        if ( 'service' === $post->post_type ) {
            wp_enqueue_style( 'themify-icons', plugins_url( 'assets/vendors/themify-icon/themify-icons.css', __FILE__ ));
        }
    }
}
add_action( 'admin_enqueue_scripts', 'saasland_admin_cpt_script', 10, 1 );