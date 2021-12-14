<?php 
/*
 * Plugin Name: Easy Twitter Feeds
 * Plugin URI:  https://twitter-feed.bplugins.com/
 * Description: You can Embed your Twitter timeline feed, Follow widget anywhere in WordPress using Shortcode.  
 * Version: 1.2
 * Author: bPlugins LLC
 * Author URI: http://abuhayatpolash.com
 * Text Domain:  easy-twitter
 * Domain Path:  /languages
 * License: GPLv3
 */


/*Some Set-up*/
define('ETF_PLUGIN_DIR', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' ); 
define('ETF_PLUGIN_VERSION', '1.2' ); 

add_action('plugin_loaded','etf_load_textdomain');
function etf_load_textdomain(){
    load_textdomain('easy-twitter', ETF_PLUGIN_DIR.'languages');
}

//Script and style
function etf_style_and_scripts() {
   // wp_enqueue_style( 'h5ap-style', plugin_dir_url( __FILE__ ) . 'public/style/plyr.css', array(), ETF_PLUGIN_VERSION , 'all' );
    wp_enqueue_script( 'widget-js', plugin_dir_url( __FILE__ ). 'public/js/widget.js' , array(), ETF_PLUGIN_VERSION , false );
}
add_action( 'wp_enqueue_scripts', 'etf_style_and_scripts' );


// Shortcode for Timeline
function etf_shortcode_func($atts){
	extract( shortcode_atts( array(
		'username' => null,
		'width' => null,
		'height' => null,
		'theme' => 'dark',
		'title' => 'Tweets by',
	), $atts ) );
?>
<?php ob_start();?>	
<?php if (!empty($username)){ ?>
<a class="twitter-timeline" data-width="<?php echo esc_attr($width); ?>" data-height="<?php echo esc_attr($height); ?>" data-theme="<?php echo esc_attr($theme); ?>" href="https://twitter.com/<?php echo esc_attr($username); ?>"><?php echo esc_html($title); ?> <?php echo esc_html($username); ?></a> 
<?php }else{ echo '<h2>You must enter your Twitter handle in the username attribute of the shortcode.  </h2>';}
$output = ob_get_clean();return $output;
}
add_shortcode('timeline','etf_shortcode_func');

// post[timeline username='" onmousemove="alert(/XSS/)" data-xss="']

// Shortcode for Follow button
function etf_shortcode_follow_func($atts){
	extract( shortcode_atts( array(
		'username' => null,
		'size' => null,
		'count' => null,
	), $atts ) );
?>	
<?php ob_start();?>	
<?php if (!empty($username)){ ?>

<a href="https://twitter.com/<?php echo esc_attr($username); ?>" class="twitter-follow-button" data-size="<?php echo esc_attr($size); ?>" data-show-count="<?php echo esc_attr($count); ?>">Follow @<?php echo esc_html($username); ?></a>

<?php }else{ echo '<h2>You must enter your Twitter handle in the username attribute of the shortcode.  </h2>';}
$output = ob_get_clean();return $output;
}
add_shortcode('follow_button','etf_shortcode_follow_func');