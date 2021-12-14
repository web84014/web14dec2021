<?php
namespace DROIT_ELEMENTOR;
defined( 'ABSPATH' ) || exit;

class DL_Helper{
    private static $instance;

    public static function grid_size() {
        return [
            '1:1'   => esc_html__( 'Width 1 - Height 1', 'droit-addons' ),
            '1:2'   => esc_html__( 'Width 1 - Height 2', 'droit-addons' ),
            '1:0.7' => esc_html__( 'Width 1 - Height 70%', 'droit-addons' ),
            '1:1.3' => esc_html__( 'Width 1 - Height 130%', 'droit-addons' ),
            '2:1'   => esc_html__( 'Width 2 - Height 1', 'droit-addons' ),
            '2:2'   => esc_html__( 'Width 2 - Height 2', 'droit-addons' ),
        ];
    }

    public static function css_minify($css) {
        $css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css);
        return str_replace(array("\r\n","\r","\n","\t",'  ','    ','    '), '', $css);
    }

    public static function contact7_activated() {
        return class_exists('\WPCF7');
    }

    public static function ninja_form_activated() {
        return class_exists( '\Ninja_Forms' );
    }
    
    public static function weform_activated() {
        return class_exists( '\WeForms' );
    }
    
    public static function wpform_activated() {
        return class_exists( '\WPForms' );
    }

    public static function caldera_form_activated() {
        return class_exists( '\Caldera_Forms' );
    }

    public static function gravity_form_activated() {
        return class_exists( '\GFForms' );
    }
        
    public static function get_post_types($args = [], $array_diff_key = []){
        $post_type_args = [
            'public' => true,
            'show_in_nav_menus' => true
        ];

        if (!empty($args['post_type'])) {
            $post_type_args['name'] = $args['post_type'];
            unset($args['post_type']);
        }

        $post_type_args = wp_parse_args($post_type_args, $args);
        $_post_types = get_post_types($post_type_args, 'objects');

        $post_types = array(
            'by_id'    => __('Manual Selection', 'droit-addons'),
            'category' => __('Category', 'droit-addons'),
        );

        foreach ($_post_types as $post_type => $object) {
            $post_types[$post_type] = $object->label;
        }
        if( !empty( $array_diff_key ) ){
            $post_types = array_diff_key( $post_types, $array_diff_key );
        }
        return $post_types;
    }

    public static function cf7_list(){
        $list = [
            '' => esc_html__('Select a Contact Form', 'droit-addons')
        ];
        if (self::contact7_activated()) {
            $forms = get_posts(array(
                'post_type' => 'wpcf7_contact_form',
                'showposts' => 999,
                'post_status'    => 'publish',
                'posts_per_page' => -1,
                'orderby'        => 'title',
                'order'          => 'ASC',
            ));
        
            if (!empty($forms) && !is_wp_error($forms)) {
                foreach ($forms as $v) {
                    $list[$v->ID] = $v->post_title;
                }
            } else {
                $list[0] = esc_html__('Create a Form First', 'droit-addons');
            }
        }
        return $list;
    }

    public static function ninja_form_list(){
        $list = [
            '' => esc_html__('Select a Contact Form', 'droit-addons')
        ];
        if (self::ninja_form_activated()) {

            $forms = \Ninja_Forms()->form()->get_forms();

            if (!empty($forms) && !is_wp_error($forms)) {
                foreach ( $forms as $form ) {
                    $list[ $form->get_id( )] = $form->get_setting('title');
                }
            } else {
                $list[0] = esc_html__('Create a Form First', 'droit-addons');
            }
        }

        return $list;
    }

    public static function weform_list(){
        $list = [
            '' => esc_html__('Select a Contact Form', 'droit-addons')
            ];
            
        if (self::weform_activated()) {
            $forms = get_posts(array(
                'post_type'      => 'wpuf_contact_form',
                'showposts'      => 999,
                'post_status'    => 'publish',
                'posts_per_page' => -1,
                'orderby'        => 'title',
                'order'          => 'ASC',
            ));
        
            if (!empty($forms) && !is_wp_error($forms)) {
                foreach ($forms as $v) {
                    $list[$v->ID] = $v->post_title;
                }
            } else {
                $list[0] = esc_html__('Create a Form First', 'droit-addons');
            }
        }
        return $list;
    }

    public static function caldera_form_list(){
        $list = [
            '' => esc_html__('Select a Contact Form', 'droit-addons')
        ];

        if (self::caldera_form_activated()) {
            $forms = \Caldera_Forms_Forms::get_forms(true, true);
        
            if (!empty($forms) && !is_wp_error($forms)) {
                foreach ($forms as $v) {
                    $list[$v['ID']] = $v['name'];
                }
            } else {
                $list[0] = esc_html__('Create a Form First', 'droit-addons');
            }
        }
        return $list;
    }

    public static function wpform_list(){
        $list = [
            '' => esc_html__('Select a Contact Form', 'droit-addons')
            ];
            
        if (self::wpform_activated()) {
            $forms = get_posts(array(
                'post_type'      => 'wpforms',
                'showposts'      => 999,
                'post_status'    => 'publish',
                'posts_per_page' => -1,
                'orderby'        => 'title',
                'order'          => 'ASC',
            ));
        
            if (!empty($forms) && !is_wp_error($forms)) {

                foreach ($forms as $v) {
                    $list[$v->ID] = $v->post_title;
                }
            } else {
                $list[0] = esc_html__('Create a Form First', 'droit-addons');
            }
        }
        
        return $list;
    }

    public static function gravity_form_list(){
        $forms = [
            '' => esc_html__('Select a Contact Form', 'droit-addons')
        ];

        if ( self::wpform_activated() ) {
            $gforms = \RGFormsModel::get_forms( null, 'title' );

            if ( ! empty( $gforms ) && ! is_wp_error( $gforms ) ) {
                foreach ( $gforms as $form ) {
                    $forms[ $form->id ] = $form->title;
                }
            }
        }
	    return $forms;
    }

    public static function render_elementor_css($id){
		if ( class_exists( '\Elementor\Core\Files\CSS\Post' ) ) {
			$css_file = new \Elementor\Core\Files\CSS\Post( $id );
			$css_file->enqueue();
		}
	}

	public static function render_elementor_content($id){
		$elementor_ins = \Elementor\Plugin::instance();
		$has_css = false;
		if (('internal' === get_option( 'elementor_css_print_method' )) || \Elementor\Plugin::$instance->preview->is_preview_mode()) {
			$has_css = true;
		}
		return $elementor_ins->frontend->get_builder_content_for_display( $id , $has_css );
	}

    public static function instance(){
        if ( is_null( self::$instance ) ){
            self::$instance = new self();
        }
        return self::$instance;
    }
}