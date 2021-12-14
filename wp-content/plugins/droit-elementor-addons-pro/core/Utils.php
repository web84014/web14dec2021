<?php 
/**
 * @package droitelementoraddonspro
 * @developer DroitLab Team
 *
 */
namespace DROIT_ELEMENTOR_PRO\Core;

if ( ! defined( 'ABSPATH' ) ) {exit;}

class Utils{

    /**
     * Protocol
     * @since 1.0.0
     * @access public
     * Feature added by : DroitLab Team
     */
    public static function droit_pro_protocol( $path = '' ) {
        $url = plugins_url( $path, DROIT_EL_PRO_FILE );

        if ( is_ssl()
        and 'http:' == substr( $url, 0, 5 ) ) {
          $url = 'https:' . substr( $url, 5 );
        }
        return $url;
    }
    /**
     * Droit Pro Version
     * @return string
     * Feature added by : DroitLab Team
     * @since : 1.0.0
     */
    public static function droit_el_pro_version(){
        return DROIT_EL_PRO_VERSION;
    }
	 /**
     * Droit Elementor Get Widgets
     * Feature added by : DroitLab Team
     * @since : 1.0.0
     */
    public static function droit_addons_get_widgets_pro(){
        $widgets     = '';
        $get_widgets = get_option('droit_el_settings') ?: [];
        if (isset($get_widgets) && !empty($get_widgets)) {
            $widgets = isset($get_widgets['widgets_pro']) ? $get_widgets['widgets_pro'] : '';
        }
        return $widgets;
    }
    /**
	 * Droit Elementor Get Widget Classname
	 * Feature added by : DroitLab Team
	 * @since : 1.0.0
	 */
	public static function droit_pro_widget_classname($_key){
	    $class_name = '\DROIT_ELEMENTOR_PRO\Elements\\' . str_replace('-', '_', 'Droit_Addons_' . $_key);
	    return $class_name;
	}
    /**
     * Droit Elementor Get Widget Font Weight
     * Feature added by : DroitLab Team
     * @since : 1.0.0
     */
    public static function droit_addons_font_weight(){
        $font_weight = [
            '' => __( 'Default', 'droit-elementor-addons-pro' ),
        ];

        foreach ( array_merge( [ 'normal', 'bold' ], range( 100, 900, 100 ) ) as $weight ) {
            $font_weight[ $weight ] = ucfirst( $weight );
        }
        return $font_weight;
    }
    /**
     * Droit Elementor Get Widget Text Transform
     * Feature added by : DroitLab Team
     * @since : 1.0.0
     */
    public static function droit_addons_text_transform(){
       
        $text_transform = [
            '' => __( 'Default', 'droit-elementor-addons-pro' ),
            'uppercase' => _x( 'Uppercase', 'Typography Control', 'droit-elementor-addons-pro' ),
            'lowercase' => _x( 'Lowercase', 'Typography Control', 'droit-elementor-addons-pro' ),
            'capitalize' => _x( 'Capitalize', 'Typography Control', 'droit-elementor-addons-pro' ),
            'none' => _x( 'Normal', 'Typography Control', 'droit-elementor-addons-pro' ),
        ];
        return $text_transform;
    }
    /**
     * Droit Elementor Get Widget Font Style
     * Feature added by : DroitLab Team
     * @since : 1.0.0
     */
    public static function droit_addons_font_style(){
       
        $font_style = [
            '' => __( 'Default', 'droit-elementor-addons-pro' ),
            'normal' => _x( 'Normal', 'Typography Control', 'droit-elementor-addons-pro' ),
            'italic' => _x( 'Italic', 'Typography Control', 'droit-elementor-addons-pro' ),
            'oblique' => _x( 'Oblique', 'Typography Control', 'droit-elementor-addons-pro' ),
        ];
        return $font_style;
    }
    /**
     * Droit Elementor Get Widget Font Style
     * Feature added by : DroitLab Team
     * @since : 1.0.0
     */
    public static function droit_addons_text_decoration(){
       
        $text_decoration = [
            '' => __( 'Default', 'droit-elementor-addons-pro' ),
            'underline' => _x( 'Underline', 'Typography Control', 'droit-elementor-addons-pro' ),
            'overline' => _x( 'Overline', 'Typography Control', 'droit-elementor-addons-pro' ),
            'line-through' => _x( 'Line Through', 'Typography Control', 'droit-elementor-addons-pro' ),
            'none' => _x( 'None', 'Typography Control', 'droit-elementor-addons-pro' ),
        ];
        return $text_decoration;
    }

    /**
     * Get placeholder image for countdown.
     * Retrieve the source of the placeholder image.
     * Feature added by : DroitLab Team
     * @since : 1.0.0
     * @access public
     * @static
     *
     * @return string The source of the default placeholder image used by Elementor.
     */
    public static function droit_pro_countdown_placeholder_image_src(){
        $placeholder_image = DROIT_EL_PRO_IMAGE . 'countdown_four.png';

        $placeholder_image = apply_filters('elementor/utils/get_placeholder_image_src', $placeholder_image);

        return $placeholder_image;
    }
    /**
     * Get placeholder image for countdown.
     * Retrieve the source of the placeholder image.
     * Feature added by : DroitLab Team
     * @since : 1.0.0
     * @access public
     * @static
     *
     * @return string The source of the default placeholder image used by Elementor.
     */
    public static function droit_pro_countdown_placeholder_image_six_src(){
        $placeholder_image = DROIT_EL_PRO_IMAGE . 'countdown_six.png';

        $placeholder_image = apply_filters('elementor/utils/get_placeholder_image_src', $placeholder_image);

        return $placeholder_image;
    }
}