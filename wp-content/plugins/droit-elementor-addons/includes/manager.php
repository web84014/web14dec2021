<?php
namespace DROIT_ELEMENTOR;
defined( 'ABSPATH' ) || exit;

class Manager{

    private static $instance;

    public function load(){

        do_action('dlAddons/manager/before');

        //load admin 
        Manager\Admin::instance()->init();

        // load enqueue manager
        Manager\Enqueue::instance()->register();

        //Ajax calling
        Manager\Ajax::instance()->call();

        // widgets manager
        Manager\Widgets::instance()->init();

        // control manager
        Manager\Control::instance()->init();

        // Modules manager
        Manager\Modules::instance()->init();

        // Api manager
        Manager\Api::instance()->init();

        do_action('dlAddons/manager/after');
    }

    public static function instance(){
        if ( is_null( self::$instance ) ){
            self::$instance = new self();
        }
        return self::$instance;
    }
}

