<?php
// public function core
if( !function_exists('drdt_core') ){
    function drdt_core(){
        $obj = new \stdClass();
        $obj->self = \DROIT_ELEMENTOR\Dtdr_Core::instance();
        $obj->version = \DROIT_ELEMENTOR\Dtdr_Core::version();
        $obj->url = \DROIT_ELEMENTOR\Dtdr_Core::dtdr_url();
        $obj->dir = \DROIT_ELEMENTOR\Dtdr_Core::dtdr_dir();
        $obj->assets = \DROIT_ELEMENTOR\Dtdr_Core::dtdr_url() . 'assets/';
        $obj->js = \DROIT_ELEMENTOR\Dtdr_Core::dtdr_url() . 'assets/js/';
        $obj->css = \DROIT_ELEMENTOR\Dtdr_Core::dtdr_url() . 'assets/css/';
        $obj->vendor = \DROIT_ELEMENTOR\Dtdr_Core::dtdr_url() . 'assets/vendor/';
        $obj->images = \DROIT_ELEMENTOR\Dtdr_Core::dtdr_url() . 'assets/images/';
        $obj->includes = \DROIT_ELEMENTOR\Dtdr_Core::dtdr_url() . 'includes/';
        $obj->includes_dir = \DROIT_ELEMENTOR\Dtdr_Core::dtdr_dir() . 'includes/';
        $obj->modules = \DROIT_ELEMENTOR\Dtdr_Core::dtdr_url() . 'modules/';
        $obj->modules_dir = \DROIT_ELEMENTOR\Dtdr_Core::dtdr_dir() . 'modules/';
        $obj->widgets = \DROIT_ELEMENTOR\Dtdr_Core::dtdr_url() . 'modules/widgets/';
        $obj->widgets_dir = \DROIT_ELEMENTOR\Dtdr_Core::dtdr_dir() . 'modules/widgets/';
        $obj->templates = \DROIT_ELEMENTOR\Dtdr_Core::dtdr_url() . 'templates/';
        $obj->templates_dir = \DROIT_ELEMENTOR\Dtdr_Core::dtdr_dir() . 'templates/';
        $obj->core = \DROIT_ELEMENTOR\Dtdr_Core::dtdr_url() . 'core/';
        $obj->core_dir = \DROIT_ELEMENTOR\Dtdr_Core::dtdr_dir() . 'core/';
    
        if( did_action('droitPro/loaded') ){
            $obj->widgets_pro = drdt_core_pro()->widgets;
            $obj->widgets_pro_dir = drdt_core_pro()->widgets_dir;
            $obj->modules_pro = drdt_core_pro()->modules;
            $obj->modules_pro_dir = drdt_core_pro()->modules_dir;
        } else {
            $obj->widgets_pro = '';
            $obj->widgets_pro_dir = '';
            $obj->modules_pro = '';
            $obj->modules_pro_dir = '';
        }
    
        $obj->suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
        $obj->minify = '.min';
        
        return $obj;
    }
}

if( !function_exists('drdt_manager') ){
    function drdt_manager(){
        $obj          = new \stdClass();
        $obj->self    = \DROIT_ELEMENTOR\Manager::instance();
        $obj->admin   = \DROIT_ELEMENTOR\Manager\Admin::instance();
        $obj->ajax    = \DROIT_ELEMENTOR\Manager\Ajax::instance();
        $obj->enqueue = \DROIT_ELEMENTOR\Manager\Enqueue::instance();
        $obj->widgets = \DROIT_ELEMENTOR\Manager\Widgets::instance();
        $obj->modules = \DROIT_ELEMENTOR\Manager\Modules::instance();
        $obj->control = \DROIT_ELEMENTOR\Manager\Control::instance();
        $obj->api     = \DROIT_ELEMENTOR\Manager\Api::instance();
        
        return $obj;
    }
}

if( !function_exists('dl_get_icon') ) {
    function dl_get_icon(){
        return '<img src="' . drdt_core()->images . 'section_icon.svg" alt="DL" class="dl-section-icon">';
    }
}

if( !function_exists('dl_place_img') ){
    function dl_place_img(){
        return apply_filters('elementor/utils/get_placeholder_image_src', drdt_core()->images . 'placeholder.png');
    }
}

if( !function_exists('dl_generate_link') ){
    function dl_generate_link( $k, $is_echo = true ) {
        if ( $is_echo == true ) {
            echo !empty($k['url']) ? "href='{$k['url']}'" : '';
            echo $k['is_external'] == true ? 'target="_blank"' : '';
            echo $k['nofollow'] == true ? 'rel="nofollow"' : '';
        } else {
            $output = !empty($k['url']) ? "href='{$k['url']}'" : '';
            $output .= $k['is_external'] == true ? 'target="_blank"' : '';
            $output .= $k['nofollow'] == true ? 'rel="nofollow"' : '';
            return $output;
        }
    }
}

if( !function_exists('dl_allowed_tags') ){
    function dl_allowed_tags( $level = 'basic' ) {
        $allowed_html = [
            'b' => [],
            'i' => [],
            'u' => [],
            'em' => [],
            'br' => [],
            'img' => [
                'src' => [],
                'alt' => [],
                'height' => [],
                'width' => [],
            ],
            'abbr' => [
                'title' => [],
            ],
            'span' => [
                'class' => [],
            ],
            'strong' => [],
        ];

        if ( $level === 'advanced' ) {
            $advanced = [
                'acronym' => [
                    'title' => [],
                ],
                'q' => [
                    'cite' => [],
                ],
                'img' => [
                    'src' => [],
                    'alt' => [],
                    'height' => [],
                    'width' => [],
                ],
                
                'time' => [
                    'datetime' => [],
                ],
                'cite' => [
                    'title' => [],
                ],
                'a' => [
                    'href' => [],
                    'title' => [],
                    'class' => [],
                    'id' => [],
                ],
            ];

            $allowed_html = array_merge( $allowed_html, $tags );
        }
        return $allowed_html;
    }
}

if( !function_exists('dl_kses') ){
    function dl_kses( $string = '', $level = 'basic' ) {
        return wp_kses( $string, dl_allowed_tags( $level ) );
    }
}

if( !function_exists('dl_title_tag') ){
    function dl_title_tag( $title_tag ){
        $title_tag_array = array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6','div', 'span', 'p' );
        if( in_array( $title_tag, $title_tag_array ) ) {
            return $title_tag;
        } else {
            return 'h4';
        }
    }
}

if( !function_exists('dl_shorten_txt') ){
    function dl_shorten_txt($text , $chars_limit){
        $chars_text = strlen($text);
        $text = $text . " ";
        $text = substr($text, 0, $chars_limit);
        $text = substr($text, 0, strrpos($text, ' ') );
        if ( $chars_text > $chars_limit ){
            $text = $text . "...";
        }
        return $text;
    }
}

if( !function_exists('dl_excerpt_more') ){
    function dl_excerpt_more($more) {
        return '...';
    }
}
add_filter('excerpt_more', 'dl_excerpt_more');

if( !function_exists('dl_pro_message') ){
    function dl_pro_message(){
        $output = '';
        $output .= '<div class="dl_element_pro_singup_from">';
            $output .= '<div class="dl_element_pro_popup">';
                $output .= '<img src="' . drdt_core()->images . 'pro_icon.svg" alt="#" class="dl_box_img">';
                $output .= '<h4 class="dl_popup_title">'.esc_html__("Go Premium with Droit Pro", "droit-elementor-addons").'</h4>';
                $output .= '<p class="dl_popup_desc">'.esc_html__("Enjoy additional and exclusive features to create a stunning website with premium
                    Droit Pro", "droit-elementor-addons").'</p>';
                $output .= '<a href="'.dl_pro_demo_url().'" target="_blank" class="cu_btn dl_gradient_btn">'.esc_html__("Get Premium Version", "droit-elementor-addons").'</a>';
            $output .= '</div>';
        $output .= '</div>';
        echo $output;
    }
}

if( !function_exists('dl_parse_txt') ){
    function dl_parse_txt( $content ) {  
        $content = shortcode_unautop( $content );
        $content = do_shortcode( $content );
        $content = wptexturize( $content );
        if ( $GLOBALS['wp_embed'] instanceof \WP_Embed ) {
            $content = $GLOBALS['wp_embed']->autoembed( $content );
        }
        return $content;
    }
}

if( !function_exists('dl_pro_demo_url') ){
    function dl_pro_demo_url()
    {
        return esc_url('https://droitthemes.com/droit-elementor-addons/');
    }
}

function _droit_get_icon(){
    return '<img src="' . drdt_core()->images . 'section_icon.svg" alt="DL" class="dl-section-icon">';
}