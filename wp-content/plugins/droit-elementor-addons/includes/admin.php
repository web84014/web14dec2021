<?php
namespace DROIT_ELEMENTOR\Manager;
defined( 'ABSPATH' ) || exit;

class Admin{

    private static $instance;

    public function init(){
        if(current_user_can('manage_options')){
            add_action( 'admin_menu', [ $this, 'init_menu' ] );

            //add_action('admin_bar_menu', [ $this, 'top_menu'], 500);
            //add_action('admin_bar_menu', [ $this, 'top_follow'], 999);

            // remove all notices 
            add_action( 'in_admin_header', [ $this, 'remove_admin_notices' ] );

            // admin footer content
            add_action('admin_footer', [ $this, 'footer_content']);

            if ( version_compare( '3.0.0', DROIT_ADDONS_VERSION_, '==' ) ) {
                //add_action('in_plugin_update_message-' . plugin_basename(DROIT_ADDONS_FILE_), [ $this, 'update_notices'], 10, 2);
            }

        }

    }

    /**
    * Name: init_menu
    * Desc: Add admin menu
    * Params: no params
    * Return: @void
    * version: 1.0.0
    * Package: @droitedd
    * Author: DroitThemes
    * Developer: Hazi
    */
    public function init_menu(){
        add_menu_page(
            __('Droit Elementor Addons', 'droit-addons'),
            __('Droit Addons', 'droit-addons'),
            'manage_options',
            'droit-addons',
            [$this, 'admin_settings'],
            drdt_core()->images . 'd_e_a.png',
            50
        );

        do_action('dlAddons/menus/before');
        // sub pages

        if( !did_action('droitPro/loaded') ){
            
            add_submenu_page(
                'droit-addons',
                __('Get PRO', 'droit-addons'),
                __('Get PRO', 'droit-addons'),
                'manage_options',
                'https://droitthemes.com/droit-elementor-addons/',
                ''
            );
        }

        if( did_action('droitPro/loaded') ){
            add_submenu_page(
                'droit-addons',
                __('Active Droit Elementor Addons PRO', 'droit-addons'),
                __('Active License', 'droit-addons'),
                'manage_options',
                admin_url( 'admin.php?page=droit-addons#droit_license' ),
                ''
            );
        }

        // end sub page

        do_action('dlAddons/menus/after');
    }
    /**
    * Name: top_menu
    * Desc: Add menu into topbar
    * Params: @bar
    * Return: @void
    * version: 1.0.0
    * Package: @droitedd
    * Author: DroitThemes
    * Developer: Hazi
    */
    public function top_menu( $bar ){
        $bar->add_node(
            [
                'id'    => 'droit_el_addons',
                'title' => 'Droit Addons',
                'meta'  => [
                    'class' => 'droit-menu-parent-toolbar',
                ],
            ]
        );
        $bar->add_node(
            [
                'id'     => 'droit-widget',
                'title'  => __('Widgets', 'droit-addons'),
                'href'   => admin_url('admin.php?page=droit-addons#droit_elements'),
                'parent' => 'droit_el_addons',
            ]
        );

        if( !did_action('droitPro/loaded') ){
            $bar->add_node(
                [
                    'id'     => 'droit-pro',
                    'title'  => __('Get PRO', 'droit-addons'),
                    'href'   => 'https://droitthemes.com/droit-elementor-addons/',
                    'parent' => 'droit_el_addons',
                    'meta'   => [
                        'class' => 'droit-menu-toolbar',
                    ],
                ]
            );

        }

        if( did_action('droitPro/loaded') ){
            $bar->add_node(
                [
                    'id'     => 'droit-addons-upgrade',
                    'title'  => __('Active PRO', 'droit-addons'),
                    'href'   => admin_url('admin.php?page=droit-addons#droit_license'),
                    'parent' => 'droit_el_addons',
                    'meta'   => [
                        'class' => 'droit-menu-toolbar',
                    ],
                ]
            );

        }

    }

    /**
    * Name: top_follow
    * Desc: Add menu into topbar - follow list
    * Params: @bar
    * Return: @void
    * version: 1.0.0
    * Package: @droitedd
    * Author: DroitThemes
    * Developer: Hazi
    */
    public function top_follow( $bar ){
        $bar->add_node(
            [
                'id'    => 'droit_el_addons_follow',
                'title' => 'Follow Droit Addons',
                'meta'  => [
                    'class' => 'droit-social-media',
                ],
            ]
        );
        $bar->add_node(
            [
                'id'     => 'droit-twitter',
                'title'  => __('Twitter', 'droit-addons'),
                'href'   => 'https://twitter.com/droitthemes',
                'parent' => 'droit_el_addons_follow',
                'meta'   => [
                    'class' => 'droit-social-toolbar',
                    'target' => '_blank'
                ],
            ]
        );
        $bar->add_node(
            [
                'id'     => 'droit-youtube',
                'title'  => __('YouTube', 'droit-addons'),
                'href'   => 'https://www.youtube.com/c/DroitThemes/?sub_confirmation=1',
                'parent' => 'droit_el_addons_follow',
                'meta'   => [
                    'class' => 'droit-social-toolbar',
                    'target' => '_blank'
                ],
            ]
        );
        $bar->add_node(
            [
                'id'     => 'droit-fb',
                'title'  => __('Facebook', 'droit-addons'),
                'href'   => 'https://www.facebook.com/DroitThemes/',
                'parent' => 'droit_el_addons_follow',
                'meta'   => [
                    'class' => 'droit-social-toolbar',
                    'target' => '_blank'
                ],
            ]
        );
        $bar->add_node(
            [
                'id'     => 'droit-insta',
                'title'  => __('Instagram', 'droit-addons'),
                'href'   => 'https://www.instagram.com/droitthemes/',
                'parent' => 'droit_el_addons_follow',
                'meta'   => [
                    'class' => 'droit-social-toolbar',
                    'target' => '_blank'
                ],
            ]
        );
    }

    public function update_notices( $plugin_data, $new_data ){
        
        if ( isset( $plugin_data['update'] ) && $plugin_data['update'] && !isset($new_data->upgrade_notice) ) {
            $new_data->new_version = DROIT_ADDONS_VERSION_;
            $new_data->upgrade_notice = 'We have brought major changes and upgrades on this update! There might be some CSS issues (i.e. some layouts may/may not break a little here and there). We strongly suggest you keep a backup of your existing database before you update. If you face major issues please feel free to reach <a href="https://droitthemes2.ticksy.com/submit/" target="_blank">our support</a>.';
            printf(
                '<span style="clear: both;display: block;margin-top: 10px; font-size: 15px;"><strong>IMPORTANT - V%s update notices:</strong> %s</span>',
                $new_data->new_version,
                $new_data->upgrade_notice 
            );
        }
    }
    public function admin_settings(){
        
        if( is_readable( drdt_core()->templates_dir . 'admin/dashboard.php' ) ){
            $save_options = get_option( drdt_manager()->ajax::$option_keys, true);
            
            require_once drdt_core()->templates_dir . 'admin/dashboard.php';
        }
    }
    
    public function subscribe_pro(){
        if( is_readable( drdt_core()->templates_dir . 'admin/pro_page.php' ) ){
            require_once drdt_core()->templates_dir . 'admin/pro_page.php';
        }
    }

    public function upgrade_pro(){
        if( is_readable( drdt_core()->templates_dir . 'admin/upgrade.php' ) ){
            require_once drdt_core()->templates_dir . 'admin/upgrade.php';
        }
    }

    public function youtube_demo(){
        return apply_filters('dlAddons/youtube/mapping', [
            'demo-info'     => [
                '_thumbnail'      => drdt_core()->images . 'video_popup_1.png',
                '_play_icon'      => drdt_core()->images . 'play_icon.png',
                '_embed_url'      => 'https://www.youtube.com/embed/-w4LA-P0lfk',
            ],
            'demo-logo'     => [
                '_thumbnail'      => drdt_core()->images . 'video_popup_2.png',
                '_play_icon'      => drdt_core()->images . 'play_icon.png',
                '_embed_url'      => 'https://www.youtube.com/embed/VcmguivPO4Y',
            ],
            'demo-post'     => [
                '_thumbnail'      => drdt_core()->images . 'video_popup_3.png',
                '_play_icon'      => drdt_core()->images . 'play_icon.png',
                '_embed_url'      => 'https://www.youtube.com/embed/TiAV-wy7OL4',
            ],
        ]);  
    }

    public function remove_admin_notices() {
        $screen = get_current_screen();
        if( in_array($screen->id, [ 'toplevel_page_droit-addons', 'droit-addons_page_droit-pro', 'droit-addons_page_droit-addons-upgrade']) ){
            remove_all_actions( 'network_admin_notices' );
            remove_all_actions( 'user_admin_notices' );
            remove_all_actions( 'admin_notices' );
            remove_all_actions( 'all_admin_notices' );
        }
    }

    public function footer_content(){
        $screen = get_current_screen();
        if( in_array($screen->id, [ 'toplevel_page_droit-addons', 'droit-addons_page_droit-pro', 'droit-addons_page_droit-addons-upgrade']) ){
            if( is_readable( drdt_core()->templates_dir . 'admin/modal.php' ) ){
                require_once drdt_core()->templates_dir . 'admin/modal.php';
            }
        }
    }

    public static function instance(){
        if ( is_null( self::$instance ) ){
            self::$instance = new self();
        }
        return self::$instance;
    }
}

