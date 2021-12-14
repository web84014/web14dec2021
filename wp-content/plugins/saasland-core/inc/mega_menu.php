<?php
if( !class_exists( 'Walker_Nav_Menu_Edit') ){
    require_once ABSPATH . 'wp-admin/includes/class-walker-nav-menu-edit.php';
}

class Saasland_Walker_Nav_Menu_Mega extends Walker_Nav_Menu_Edit  {

    public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $item_id = esc_attr( $item->ID );
        $walker = new Walker_Nav_Menu_Edit();
        $walker->start_el( $item_output, $item, $depth, $args, $id);
        $args = array(
            'post_type' => 'megamenu'
        );
        $temp = $active = '';
        $query = new WP_Query($args);
        if ( $query->have_posts() ) {
            while ($query->have_posts()) {
                $query->the_post();
                if ($item->mega_menu == get_the_ID()) $active = 'selected';
                else $active = '';
                $temp .= '<option ' . $active . ' value="' . get_the_ID() . '">' . get_the_title() . '</option>';
            }

            $custom_html = '';

            $custom_html = '<p class="field-activemega description description-wide">
                                <label>
                                    ' . esc_html__( 'Select Mega Menu', 'saasland-core') . '<br>
                                    <select id="edit-menu-item-devi-[' . $item_id . ']" name="edit-menu-item-devi-' . $item_id . '">
                                        <option value="0">' . esc_html__( 'None', 'saasland-core') . '</option>
                                        ' . $temp . '
                                    </select>
                                </label>
                            </p>';

            if( $depth == 0 ) {
                $output .= str_replace( '<div class="menu-item-actions description-wide submitbox">', $custom_html . '<div class="menu-item-actions description-wide submitbox">', $item_output);
            }
            if( $depth != 0 ) {
                $output .= $item_output;
            }
        }
    }
}



class Saasland_Mega_Menu{

    function __construct(){
        add_filter( 'wp_edit_nav_menu_walker', array($this, 'edit_nav_menu_walker'), 10, 2);

        add_filter( 'wp_setup_nav_menu_item', array($this, 'setup_nav_menu_item'));
        add_action( 'wp_update_nav_menu_item', array($this, 'update_nav_menu_item'), 10, 3);

        add_filter( 'walker_nav_menu_start_el', array($this, 'custom_walker_nav_menu_start_el'), 10, 4);
    }

    public function edit_nav_menu_walker($walker, $menu_id) {
        return 'Saasland_Walker_Nav_Menu_Mega';
    }

    public function custom_walker_nav_menu_start_el( $item_output, $item, $depth, $args ){
        $item_output = '';
        $url_hash = strpos($item->url, '#');
        $navigation = function_exists('get_field') ? get_field('navigation') : '';
        if ( $url_hash === 0 ) {
            if ( is_front_page() ) {
                $url = !empty($item->url) ? $item->url : '';
            } elseif ( is_page_template('elementor_canvas') || $navigation == 'onepage' ) {
                $url = !empty($item->url) ? $item->url : '';
            } else {
                $url = !empty($item->url) ? home_url('/') . $item->url : '';
            }
        } else {
            $url = !empty($item->url) ? $item->url : '';
        }
        $attr_title = !empty($item->attr_title) ? "title='{$item->attr_title}'" : '';
        $has_children = isset($args->has_children) ? $args->has_children : '';
        $target = !empty( $item->target )	? "target='{$item->target}'"	: '';
        if ( $item->mega_menu != 0 || (is_page_template( 'page-split.php') && $args->has_children) ) {
            $item_output .= sprintf( '<a href="%s" class="nav-link">%s<span class="arrow_carrot-right"></span></a>', $url, $item->title);
        } else {
            $is_carrot = ( $has_children && 1 === $depth || $has_children && 0 === $depth && !is_page_template( 'page-split.php' ) ) ? ' <span class="arrow_carrot-right"></span> ' : '';
            $item_output .= sprintf( '<a href="%s" %s %s class="nav-link">%s %s</a>', $url, $target, $attr_title, $item->title, $is_carrot);
        }

        if ( $item->mega_menu != 0 ) {
            $content = get_post( $item->mega_menu );
            if(is_a( $content, 'WP_Post' ) && has_shortcode( $content->post_content, 'mega_menu_thumbnail')) {
                $item_output .= sprintf( '<div class="mega_menu_inner"> <ul class="dropdown-menu"> <li class="nav-item">%s</li> </ul> </div>', do_shortcode($content->post_content));
            }
            else{
                $item_output .= sprintf( '<ul class="dropdown-menu mega_menu_three"><li class="nav-item">%s</li></ul>', do_shortcode($content->post_content));
            }
            wp_reset_postdata();
        }

        return $item_output;
    }


    public function setup_nav_menu_item($menu_item) {
        $menu_item->mega_menu = get_post_meta( $menu_item->ID, "megamenu_page_id", true );
        return $menu_item;
    }
    public function update_nav_menu_item($menu_id, $menu_item_db_id, $args ) {
        $custom_value = isset($_REQUEST["edit-menu-item-devi-".$menu_item_db_id]) ? $_REQUEST["edit-menu-item-devi-".$menu_item_db_id] : '';
        update_post_meta( $menu_item_db_id, "megamenu_page_id", $custom_value );
    }

}

if( class_exists( 'Walker_Nav_Menu') ){
    new Saasland_Mega_Menu();
}

/**
 * Mega menu shortcodes
 * @ Title with subtitle and icon
 * @ Title with thumbnail image
 */
// Title with subtitle and icon
require_once plugin_dir_path(__FILE__) . 'mega_menu/title_subtitle_icon.php';
require_once plugin_dir_path(__FILE__) . 'mega_menu/title_subtitle_icon_item.php';
require_once plugin_dir_path(__FILE__) . 'mega_menu/title_icon_item.php';

// Thumbnail with title
require_once plugin_dir_path(__FILE__) . 'mega_menu/title_thumbnail.php';
require_once plugin_dir_path(__FILE__) . 'mega_menu/title_thumbnail_item.php';