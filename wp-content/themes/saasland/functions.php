<?php
/**
 * saasland functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package saasland
 */


if ( ! function_exists( 'saasland_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function _remove_script_version( $src ){
    $parts = explode( '?ver', $src );
    return $parts[0];
}

add_filter( 'script_loader_src', '_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', '_remove_script_version', 15, 1 );

function saasland_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on gull, use a find and replace
	 * to change 'gull' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'saasland', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Enable excerpt support for page
    add_post_type_support( 'page', 'excerpt' );

    // Enable WooCommerce Support
    add_theme_support( 'woocommerce' );

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
    add_theme_support( 'post-formats', array( 'audio', 'video', 'quote', 'link' ) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'main_menu'   => esc_html__( 'Main menu', 'saasland' ),
		'overlay_menu'   => esc_html__( 'Overlay menu', 'saasland' ),
	));

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	));

    add_theme_support( 'align-wide' );
    add_theme_support( 'editor-styles' );
    add_editor_style( 'style-editor.css' );
    add_theme_support( 'responsive-embeds' );

    if (!defined("SAASLAND_LICENCE_STATUS")) {
        define("SAASLAND_LICENCE_STATUS", 'valid');
    }

}
endif;
add_action( 'after_setup_theme', 'saasland_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function saasland_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'saasland_content_width', 1170 );
}
add_action( 'after_setup_theme', 'saasland_content_width', 0 );


/**
 * Constants
 * Defining default asset paths
 */
define( 'SAASLAND_DIR_CSS', get_template_directory_uri().'/assets/css' );
define( 'SAASLAND_DIR_JS', get_template_directory_uri().'/assets/js' );
define( 'SAASLAND_DIR_VEND', get_template_directory_uri().'/assets/vendors' );
define( 'SAASLAND_DIR_IMG', get_template_directory_uri().'/assets/img' );
define( 'SAASLAND_DIR_FONT', get_template_directory_uri().'/assets/fonts' );


/**
 * Enqueue scripts and styles.
 */
require get_template_directory() . '/inc/enqueue.php';


/**
 * Theme's helper functions
 */
require get_template_directory() . '/inc/saasland_functions.php';

/**
 * Theme's filters and actions
 */
require get_template_directory() . '/inc/filter_actions.php';

/**
 * Classes
 */
require get_template_directory() . '/inc/classes/Saasland_helper.php';
require get_template_directory() . '/inc/classes/Saasland_base.php';
require get_template_directory() . '/inc/classes/Saasland_register_theme.php';
require get_template_directory() . '/inc/classes/Saasland_admin_page.php';
require get_template_directory() . '/inc/classes/Saasland_admin_settings.php';
require get_template_directory() . '/inc/admin/dashboard/Saasland_admin_dashboard.php';

/**
 * WooCommerce Configurations
 */
require get_template_directory() . '/inc/woo_config.php';

/**
 * Theme settings
 */
require get_template_directory() . '/options/opt-config.php';

/**
 * Configure one click demo
 */
require get_template_directory() . '/inc/demo_config.php';

/**
 * Required plugins activation
 */
require get_template_directory() . '/inc/plugin_activation.php';

/**
 * Require the classes
 * Bootstrap Nav Walker
 * Saasland_Overlay_Nav
 */
require get_template_directory() . '/inc/navwalker.php';
require get_template_directory() . '/inc/classes/Saasland_Overlay_Nav.php';
//Initialize the update checker.
require get_template_directory() . '/inc/classes/Saasland_update_checker.php';

/**
 * Comment Walker Class
 */
require get_template_directory() . '/inc/classes/Saasland_Walker_Comment.php';

/**
 * Register Sidebar Areas
 */
require get_template_directory() . '/inc/sidebars.php';
add_shortcode( 'post_title', function( $atts ) {
    $atts = shortcode_atts( array(
        'id' => get_the_ID(),
    ), $atts, 'post_title' );
    return get_the_title( absint( $atts['id'] ) );
});

function register_theme_shortcodes() {
    add_shortcode( 'category',
        /**
         * category shortcode function.
         *
         * @param array $atts
         *
         * @return string
         */
        function ( $atts ) {
            $atts = shortcode_atts(
                array(
                    'id' => '',
                ),
                $atts
            );

            /**
             * @var int $id Optional Post ID to get categories from.
             */
            extract( $atts );

            if ( $id ) {
                $post_id = $id;
            } else {
                global $post;

                if ( $post instanceof WP_Post ) {
                    $post_id = $post->ID;
                }
            }

            if ( empty( $post_id ) ) {
                $output = '';
            } else {
                $output = [];

                if ( $post_categories = get_the_category() ) {
                    /**
                     * @var WP_Term $category
                     */
                    foreach ( $post_categories as $category ) {
                        // Builds the category name with its link.
                        $output[] = "<a href='" . get_term_link( $category->term_id ) . "'>{$category->name}</a>";

                        // Build just the category name.
                        // $output[] = $category->name;
                    }
                }

                $output = implode( ', ', $output );
            }

            return $output;
        }
    );
}

add_action( 'init', 'register_theme_shortcodes' );

remove_action( 'wp_head', '_wp_render_title_tag', 1 );

add_filter( 'option_blogdescription', 'wpse368021_change_tagline' );
function wpse368021_change_tagline( $tagline ) {
    $pages = array( 'Home New');
    if ( is_page( $pages ) ) {
        $tagline = 'Top Web & Mobile App Development Company For Startups & Enterprise';
    }
    return $tagline;
}

add_filter( 'option_blogdescription', 'wpse368031_change_tagline' );
function wpse368031_change_tagline( $tagline ) {
    $pages = array( 'About US');
    if ( is_page( $pages ) ) {
        $tagline = 'About Us - Startup App Development Company | Whitelotus Corporation';
    }
    return $tagline;
}
add_filter( 'option_blogdescription', 'wpse368032_change_tagline' );
function wpse368032_change_tagline( $tagline ) {
    $pages = array( 'Blog');
    if ( is_page( $pages ) ) {
        $tagline = 'Blog About Technologies, Startups And Mobile Application Development | Whitelotus Corporation';
    }
    return $tagline;
}
add_filter( 'option_blogdescription', 'wpse368033_change_tagline' );
function wpse368033_change_tagline( $tagline ) {
    $pages = array( 'Solutions');
    if ( is_page( $pages ) ) {
        $tagline = 'Web & Mobile App Solutions For Startups, Enterprise, B2B & B2C | Whitelotus Corporation';
    }
    return $tagline;
}
add_filter( 'option_blogdescription', 'wpse368034_change_tagline' );
function wpse368034_change_tagline( $tagline ) {
    $pages = array( 'Portfolio');
    if ( is_page( $pages ) ) {
        $tagline = 'Startup Mobile Application Development Portfolio | Whitelotus Corporation';
    }
    return $tagline;
}
add_filter( 'option_blogdescription', 'wpse368035_change_tagline' );
function wpse368035_change_tagline( $tagline ) {
    $pages = array( 'Contact  Us');
    if ( is_page( $pages ) ) {
        $tagline = 'Contact Us For Your Startup Application Development | Whitelotus Corporation';
    }
    return $tagline;
}
add_filter( 'option_blogdescription', 'wpse368036_change_tagline' );
function wpse368036_change_tagline( $tagline ) {
    $pages = array( 'iOS App Development');
    if ( is_page( $pages ) ) {
        $tagline = 'iOS App Development Services | Objective C  And Swift Programming';
    }
    return $tagline;
}
add_filter( 'option_blogdescription', 'wpse368037_change_tagline' );
function wpse368037_change_tagline( $tagline ) {
    $pages = array( 'Android App Development');
    if ( is_page( $pages ) ) {
        $tagline = 'Android App Development Services | Java And Kotlin Programming';
    }
    return $tagline;
}
add_filter( 'option_blogdescription', 'wpse368038_change_tagline' );
function wpse368038_change_tagline( $tagline ) {
    $pages = array( 'Cross Platform App Development');
    if ( is_page( $pages ) ) {
        $tagline = 'Cross Platform Development Services | React Native, Flutter, Xamarin And Ionic';
    }
    return $tagline;
}
add_filter( 'option_blogdescription', 'wpse368039_change_tagline' );
function wpse368039_change_tagline( $tagline ) {
    $pages = array( 'Enterprise App Development');
    if ( is_page( $pages ) ) {
        $tagline = 'Enterprise Mobile App Development Company | Mobile Applications | Web Applications';
    }
    return $tagline;
}
add_filter( 'option_blogdescription', 'wpse3680310_change_tagline' );
function wpse3680310_change_tagline( $tagline ) {
    $pages = array( 'Web App Development');
    if ( is_page( $pages ) ) {
        $tagline = 'Web Application Development Company | Backend And API Development Services';
    }
    return $tagline;
}
add_filter( 'option_blogdescription', 'wpse3680311_change_tagline' );
function wpse3680311_change_tagline( $tagline ) {
    $pages = array( 'UI x UX Design Development');
    if ( is_page( $pages ) ) {
        $tagline = 'Product Design Agency | UI And UX Design Services | Startup MVP Development';
    }
    return $tagline;
}
add_filter( 'option_blogdescription', 'wpse3680312_change_tagline' );
function wpse3680312_change_tagline( $tagline ) {
    $pages = array( 'Food delivery app');
    if ( is_page( $pages ) ) {
        $tagline = 'Online Food Delivery App For Startups | On-Demand Food Ordering App';
    }
    return $tagline;
}
add_filter( 'option_blogdescription', 'wpse3680313_change_tagline' );
function wpse3680313_change_tagline( $tagline ) {
    $pages = array( 'On demand hiring app');
    if ( is_page( $pages ) ) {
        $tagline = 'On-Demand Mobile App Development For Startups| Handyman Services, Doctor On-Demand, Booking Services ';
    }
    return $tagline;
}
add_filter( 'option_blogdescription', 'wpse3680314_change_tagline' );
function wpse3680314_change_tagline( $tagline ) {
    $pages = array( 'Finance app');
    if ( is_page( $pages ) ) {
        $tagline = 'Fintech App Development For Startups | Digital Payments, Personal Finance, Investment Advisory,  Digital Banking';
    }
    return $tagline;
}
add_filter( 'option_blogdescription', 'wpse3680315_change_tagline' );
function wpse3680315_change_tagline( $tagline ) {
    $pages = array( 'Resturant reservation and listing');
    if ( is_page( $pages ) ) {
        $tagline = 'Restaurant App Development For Startups | Restaurant Reservation Platform, Restaurant Listing';
    }
    return $tagline;
}
add_filter( 'option_blogdescription', 'wpse3680316_change_tagline' );
function wpse3680316_change_tagline( $tagline ) {
    $pages = array( 'Grocery ordering application');
    if ( is_page( $pages ) ) {
        $tagline = 'Online Grocery Delivery App For Startups | On-Demand Grocery Ordering App';
    }
    return $tagline;
}
add_filter( 'option_blogdescription', 'wpse3680317_change_tagline' );
function wpse3680317_change_tagline( $tagline ) {
    $pages = array( 'iBeacon application Development');
    if ( is_page( $pages ) ) {
        $tagline = 'iBeacon App Development | Bluetooh Low Energy Beacon, Indoor Navigation';
    }
    return $tagline;
}
add_filter( 'option_blogdescription', 'wpse3680318_change_tagline' );
function wpse3680318_change_tagline( $tagline ) {
    $pages = array( 'Loyalty program and POS application');
    if ( is_page( $pages ) ) {
        $tagline = 'Loyalty Program App Development for Retail | Point of Sale ( POS ) Software Development';
    }
    return $tagline;
}
add_filter( 'option_blogdescription', 'wpse3680319_change_tagline' );
function wpse3680319_change_tagline( $tagline ) {
    $pages = array( 'Field Inspection app for mechanical, Oil & GAS industry');
    if ( is_page( $pages ) ) {
        $tagline = 'Audit and Inspection App Development | Checklist Audit App For Banking, Oil and Gas Industry, Real Estate, Field Inspection';
    }
    return $tagline;
}
add_filter( 'option_blogdescription', 'wpse3680320_change_tagline' );
function wpse3680320_change_tagline( $tagline ) {
    $pages = array( 'ecommerce mobile apps');
    if ( is_page( $pages ) ) {
        $tagline = 'eCommerce Mobile App Development For Startups | Web And Mobile eCommerce Solutions';
    }
    return $tagline;
}
add_filter( 'option_blogdescription', 'wpse3680321_change_tagline' );
function wpse3680321_change_tagline( $tagline ) {
    $pages = array( 'Fleet management solutions');
    if ( is_page( $pages ) ) {
        $tagline = 'Fleet Management App Development | Logistics Solutions Provider Company';
    }
    return $tagline;
}
add_filter( 'option_blogdescription', 'wpse3680322_change_tagline' );
function wpse3680322_change_tagline( $tagline ) {
    $pages = array( 'Smart city and Smart home IoT app');
    if ( is_page( $pages ) ) {
        $tagline = 'IoT App Development | Smart Home And Smart City Solutions';
    }
    return $tagline;
}
add_filter( 'option_blogdescription', 'wpse3680323_change_tagline' );
function wpse3680323_change_tagline( $tagline ) {
    $pages = array( 'Social media application');
    if ( is_page( $pages ) ) {
        $tagline = 'Social Media App Development for Startups | Messaging App, Dating App, Community Social App, Social Networking App';
    }
    return $tagline;
}
add_filter( 'option_blogdescription', 'wpse3680324_change_tagline' );
function wpse3680324_change_tagline( $tagline ) {
    $pages = array( 'Health, Fitness and Wearables');
    if ( is_page( $pages ) ) {
        $tagline = 'Health And Fitness App Development For Startups | Diet & Nutrition, Yoga &Meditation, Mental Wellness, Workout & Excerise App';
    }
    return $tagline;
}
add_filter( 'option_blogdescription', 'wpse3680325_change_tagline' );
function wpse3680325_change_tagline( $tagline ) {
    $pages = array( 'Online medicine delivery and pharmacy');
    if ( is_page( $pages ) ) {
        $tagline = 'On-Demand Medicine Delivery App Development | Online Pharmacy Services | Medicine Ordering App';
    }
    return $tagline;
}
add_filter( 'option_blogdescription', 'wpse3680326_change_tagline' );
function wpse3680326_change_tagline( $tagline ) {
    $pages = array( 'Food explore and recipe listing app');
    if ( is_page( $pages ) ) {
        $tagline = 'Food Recipe App for Food Tech Startups | Diet & Meal Planning App, Cooking Recipe App';
    }
    return $tagline;
}
add_filter( 'option_blogdescription', 'wpse3680327_change_tagline' );
function wpse3680327_change_tagline( $tagline ) {
    $pages = array( 'Multimedia app');
    if ( is_page( $pages ) ) {
        $tagline = 'On-Demand Video And Audio Streaming App | Multimedia App Development | Live Streaming And OTT Platform';
    }
    return $tagline;
}
add_filter( 'option_blogdescription', 'wpse3680328_change_tagline' );
function wpse3680328_change_tagline( $tagline ) {
    $pages = array( 'Taxi booking');
    if ( is_page( $pages ) ) {
        $tagline = 'On-Demand Taxi Booking App Development | Uber Style Taxi App | Transport Tech Startups';
    }
    return $tagline;
}
add_filter( 'option_blogdescription', 'wpse3680329_change_tagline' );
function wpse3680329_change_tagline( $tagline ) {
    $pages = array( 'React Native Developers');
    if ( is_page( $pages ) ) {
        $tagline = 'React Native App Development Company | Highly Experienced Cross Platfrom Developers';
    }
    return $tagline;
}
add_filter( 'option_blogdescription', 'wpse3680330_change_tagline' );
function wpse3680330_change_tagline( $tagline ) {
    $pages = array( 'Flutter Developers');
    if ( is_page( $pages ) ) {
        $tagline = 'Dedicated Flutter Developers For Hire | Hire Flutter Programmers';
    }
    return $tagline;
}
add_filter( 'option_blogdescription', 'wpse3680331_change_tagline' );
function wpse3680331_change_tagline( $tagline ) {
    $pages = array( 'Ionic Developers');
    if ( is_page( $pages ) ) {
        $tagline = 'Hire Ionic Developers | Hybrid Development Programmer to Hire';
    }
    return $tagline;
}
add_filter( 'option_blogdescription', 'wpse3680332_change_tagline' );
function wpse3680332_change_tagline( $tagline ) {
    $pages = array( 'Xamarin Developers');
    if ( is_page( $pages ) ) {
        $tagline = 'Hire Xamarin Developers | Best Xamarin Development Team';
    }
    return $tagline;
}
add_filter( 'option_blogdescription', 'wpse3680333_change_tagline' );
function wpse3680333_change_tagline( $tagline ) {
    $pages = array( 'Laravel Developers');
    if ( is_page( $pages ) ) {
        $tagline = ' Hire Dedicated Laravel Developers | Fullstack Web Developers';
    }
    return $tagline;
}
add_filter( 'option_blogdescription', 'wpse3680334_change_tagline' );
function wpse3680334_change_tagline( $tagline ) {
    $pages = array( 'Node.JS Developers');
    if ( is_page( $pages ) ) {
        $tagline = 'Hire NodeJS Developers | NodeJS Backend Development Company';
    }
    return $tagline;
}
add_filter( 'option_blogdescription', 'wpse3680335_change_tagline' );
function wpse3680335_change_tagline( $tagline ) {
    $pages = array( 'PHP Developers');
    if ( is_page( $pages ) ) {
        $tagline = 'Hire PHP Web Developers | Offshore Web Development Company';
    }
    return $tagline;
}
add_filter( 'option_blogdescription', 'wpse3680336_change_tagline' );
function wpse3680336_change_tagline( $tagline ) {
    $pages = array( 'CodeIgnitor Developers');
    if ( is_page( $pages ) ) {
        $tagline = 'Hire CodeIgniter Developers | Dedicated Web Development Team';
    }
    return $tagline;
}
add_filter( 'option_blogdescription', 'wpse3680337_change_tagline' );
function wpse3680337_change_tagline( $tagline ) {
    $pages = array( 'React Js Developers');
    if ( is_page( $pages ) ) {
        $tagline = 'Hire ReactJS Developers | Front-end Web Development Company';
    }
    return $tagline;
}
add_filter( 'option_blogdescription', 'wpse3680338_change_tagline' );
function wpse3680338_change_tagline( $tagline ) {
    $pages = array( 'Angular Js Developers');
    if ( is_page( $pages ) ) {
        $tagline = 'Hire  Dedicated Angular JS Developers | AngularJS Development Company';
    }
    return $tagline;
}
add_filter( 'option_blogdescription', 'wpse3680339_change_tagline' );
function wpse3680339_change_tagline( $tagline ) {
    $pages = array( 'Vue Js Developers');
    if ( is_page( $pages ) ) {
        $tagline = 'Hire VueJS Developers | Experienced Front-end Development Company';
    }
    return $tagline;
}
add_filter( 'option_blogdescription', 'wpse3680340_change_tagline' );
function wpse3680340_change_tagline( $tagline ) {
    $pages = array( 'HTML5 Developers');
    if ( is_page( $pages ) ) {
        $tagline = 'Hire HTML/CSS Developers | HTML5 Programmers';
    }
    return $tagline;
}
add_filter( 'option_blogdescription', 'wpse3680341_change_tagline' );
function wpse3680341_change_tagline( $tagline ) {
    $pages = array( 'Swift Developers');
    if ( is_page( $pages ) ) {
        $tagline = 'Hire Swift Developers | Swift App Developer | iOS App Development Company';
    }
    return $tagline;
}
add_filter( 'option_blogdescription', 'wpse3680342_change_tagline' );
function wpse3680342_change_tagline( $tagline ) {
    $pages = array( 'Objective C Developers');
    if ( is_page( $pages ) ) {
        $tagline = 'Hire Objective C Developers | Objective C App Developer | iOS App Development Company';
    }
    return $tagline;
}
add_filter( 'option_blogdescription', 'wpse3680343_change_tagline' );
function wpse3680343_change_tagline( $tagline ) {
    $pages = array( 'JAVA Developers');
    if ( is_page( $pages ) ) {
        $tagline = 'Hire Java Developers | Java App Developer | Android App Development Company';
    }
    return $tagline;
}
add_filter( 'option_blogdescription', 'wpse3680344_change_tagline' );
function wpse3680344_change_tagline( $tagline ) {
    $pages = array( 'Kotlin Developers');
    if ( is_page( $pages ) ) {
        $tagline = 'Hire Kotlin Developers | Kotlin App Developer | Android App Development Company';
    }
    return $tagline;
}
add_filter( 'option_blogdescription', 'wpse3680345_change_tagline' );
function wpse3680345_change_tagline( $tagline ) {
    $pages = array( 'WordPress Developers');
    if ( is_page( $pages ) ) {
        $tagline = 'Hire WordPress Developers | WordPress Programmers | CMS Web Development Company';
    }
    return $tagline;
}
add_filter( 'option_blogdescription', 'wpse3680346_change_tagline' );
function wpse3680346_change_tagline( $tagline ) {
    $pages = array( 'Shopify Developers');
    if ( is_page( $pages ) ) {
        $tagline = 'Hire Shopify Developers | Shopify eCommerce Development | Online Store';
    }
    return $tagline;
}
add_filter( 'option_blogdescription', 'wpse3680347_change_tagline' );
function wpse3680347_change_tagline( $tagline ) {
    $pages = array( 'WooCommerce Developers');
    if ( is_page( $pages ) ) {
        $tagline = 'Hire WooCommerce Developers | Dedicated WooCommerce Experts ';
    }
    return $tagline;
}
add_filter( 'option_blogdescription', 'wpse3680348_change_tagline' );
function wpse3680348_change_tagline( $tagline ) {
    $pages = array( 'Magento Developers');
    if ( is_page( $pages ) ) {
        $tagline = 'Hire Dedicated Magento Developers | Multi Vendor Magento Marketplace | Magento eCommerce Development';
    }
    return $tagline;
}
add_filter( 'option_blogdescription', 'wpse3680349_change_tagline' );
function wpse3680349_change_tagline( $tagline ) {
    $pages = array( 'Firebase Developers');
    if ( is_page( $pages ) ) {
        $tagline = 'Hire Firebase Developers | Google Firebase App Development ';
    }
    return $tagline;
}
add_filter( 'option_blogdescription', 'wpse3680350_change_tagline' );
function wpse3680350_change_tagline( $tagline ) {
    $pages = array( 'MongoDB Developers');
    if ( is_page( $pages ) ) {
        $tagline = 'Hire MongoDB Database Specialist | MongoDB Development Company';
    }
    return $tagline;
}
add_filter( 'option_blogdescription', 'wpse3680351_change_tagline' );
function wpse3680351_change_tagline( $tagline ) {
    $pages = array( 'MySQL Developers');
    if ( is_page( $pages ) ) {
        $tagline = 'Dedicated MySQL Developers | Hire MySQL Developers';
    }
    return $tagline;
}
add_filter( 'option_blogdescription', 'wpse3680352_change_tagline' );
function wpse3680352_change_tagline( $tagline ) {
    $pages = array( 'PostgreSQL Developers');
    if ( is_page( $pages ) ) {
        $tagline = 'Hire PostgreSQL Developers | PostgreSQL Development Team';
    }
    return $tagline;
}
add_filter( 'option_blogdescription', 'wpse3680353_change_tagline' );
function wpse3680353_change_tagline( $tagline ) {
    $pages = array( 'AWS Developers');
    if ( is_page( $pages ) ) {
        $tagline = 'Hire Professional AWS Developers | AWS Solutions Architect | AWS Cloud Services | Amazon Web Services';
    }
    return $tagline;
}
add_filter( 'option_blogdescription', 'wpse3680354_change_tagline' );
function wpse3680354_change_tagline( $tagline ) {
    $pages = array( 'Google Cloud Developers');
    if ( is_page( $pages ) ) {
        $tagline = 'Hire Google Cloud Experts | Best Google Cloud Development Services ';
    }
    return $tagline;
}
add_filter( 'option_blogdescription', 'wpse3680355_change_tagline' );
function wpse3680355_change_tagline( $tagline ) {
    $pages = array( 'Azure Developers');
    if ( is_page( $pages ) ) {
        $tagline = 'Hire Azure Developers | Microsoft Cloud Services ';
    }
    return $tagline;
}
add_filter( 'option_blogdescription', 'wpse3680356_change_tagline' );
function wpse3680356_change_tagline( $tagline ) {
    $pages = array( 'Jenkins Developers');
    if ( is_page( $pages ) ) {
        $tagline = 'Hire Experienced Jenkins Developer | DevOps Engineers';
    }
    return $tagline;
}
add_filter( 'option_blogdescription', 'wpse3680357_change_tagline' );
function wpse3680357_change_tagline( $tagline ) {
    $pages = array( 'Travel and Tourism');
    if ( is_page( $pages ) ) {
        $tagline = 'Travel And Tourism App Development | Hotel Booking, Flight Booking, City Guide App, Trip Planner App';
    }
    return $tagline;
}
