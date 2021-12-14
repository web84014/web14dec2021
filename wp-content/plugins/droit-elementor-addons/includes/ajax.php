<?php
namespace DROIT_ELEMENTOR\Manager;
defined( 'ABSPATH' ) || exit;

class Ajax{

    private static $instance;

    public static $option_keys = 'dl_addons_settings_option';

    public function call(){
        
        if(current_user_can('manage_options')){
            // save setting data 
            add_action( 'wp_ajax_dtaddsave_settings', [ $this, 'save_settings'] );
            add_action( 'wp_ajax_dtaddsave_generateicons', [ $this, 'dtaddsave_generateicons'] );
            add_action( 'wp_ajax_dtaddsave_generatecss', [ $this, 'dtaddsave_generatecss'] );
        }

    }

    /**
    * Name: save_settings
    * Desc: Save admin settings data
    * Params: no params
    * Return: @void
    * version: 1.0.0
    * Package: @droitedd
    * Author: DroitThemes
    * Developer: Hazi
    */

    public function save_settings(){
        $post = wp_slash($_POST);
        if( !isset( $post['form_data'] )){
            wp_send_json_error( ['error' => true, 'message' => 'Couldn\'t found any data']);
        }
        wp_parse_str( $post['form_data'], $formdata);

        do_action('dlAddons/admin/ajax/before', $formdata);

        $settings = isset($formdata['dlsave']) ? $formdata['dlsave'] : [];
        update_option(self::$option_keys, $settings);

        do_action('dlAddons/admin/ajax/after', $formdata);
        
        wp_send_json_success($settings);
    }
    

    public function dtaddsave_generateicons(){
        $post = wp_slash($_POST);

        do_action('dlAddons/admin/ajax/generate/icons', $post);

        wp_send_json_success( ['success' => true, 'message' => 'Successfully generate icons']);
    }
    
    public function dtaddsave_generatecss(){
        $post = wp_slash($_POST);

        do_action('dlAddons/admin/ajax/before', $post);

        wp_send_json_success( ['success' => true, 'message' => 'Successfully generate css']);
    }

    public static function instance(){
        if ( is_null( self::$instance ) ){
            self::$instance = new self();
        }
        return self::$instance;
    }
}

