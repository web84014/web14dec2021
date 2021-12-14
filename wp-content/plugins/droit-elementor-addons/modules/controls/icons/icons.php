<?php
namespace DROIT_ELEMENTOR\Module\Controls\Icons;
defined( 'ABSPATH' ) || exit;

class Droit_Icons{

    private static $instance;

    public function load(){
        add_filter( 'elementor/icons_manager/additional_tabs', [ $this, 'icons']);

        // generate icons
        add_action('dlAddons/admin/ajax/generate/icons', [$this, 'generate_font']);

    }

    public function icons( $icons ){
        $icons['dlicons'] = apply_filters('dlAddons/controls/icons/settings', [
			'name' => 'dlicons',
			'label' => __( 'Droit - Icons', 'droit-addons' ),
			'url' => drdt_core()->modules . 'controls/icons/assets/dlicons.css',
			'prefix' => 'dlicon-',
			'displayPrefix' => 'dlicon',
			'labelIcon' => 'dlicon dlicon-DL',
			'ver' => drdt_core()->version,
			'fetchJson' =>  drdt_core()->modules . 'controls/icons/assets/dlicons.js',
			'native' => true,
		]);
        return $icons;
    }

    public function generate_font(){
    	$css_source = '';
        global $wp_filesystem;
        require_once ( ABSPATH . '/wp-admin/includes/file.php' );
        WP_Filesystem();
        $css_file =   drdt_core()->modules_dir . 'controls/icons/assets/dlicons.css';
        if ( $wp_filesystem->exists( $css_file ) ) {
            $css_source = $wp_filesystem->get_contents( $css_file );
        } 
        
        preg_match_all( "/\.(dlicon-.*?):\w*?\s*?{/", $css_source, $matches, PREG_SET_ORDER, 0 );
        $iconList = [];
        foreach ( $matches as $match ) {
            $icon = str_replace('dlicon-', '', $match[1]);
            $icons = explode(' ', $icon);
            $iconList[] = current($icons);
        }
        $icons = new \stdClass();
        $icons->icons = $iconList;
        $icon_data = json_encode($icons);
        $file = drdt_core()->modules_dir . 'controls/icons/assets/dlicons.js';
        global $wp_filesystem;
        require_once ( ABSPATH . '/wp-admin/includes/file.php' );
        WP_Filesystem();
        if ( $wp_filesystem->exists( $file ) ) {
            $content =  $wp_filesystem->put_contents( $file, $icon_data) ;
        } 
        
    }


    public static function instance(){
        if ( is_null( self::$instance ) ){
            self::$instance = new self();
        }
        return self::$instance;
    }

}