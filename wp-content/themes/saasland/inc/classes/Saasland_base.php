<?php
/**
 * SaaslandThemes Theme Framework
 * The Saasland_Base
 */

if ( !defined( 'ABSPATH' ) )
    exit; // Exit if accessed directly

if ( !class_exists( 'Saasland_base' ) ) :
    /**
     * Saasland Base
     */
    class Saasland_base {

        /**
         * [add_action description]
         * @method add_action
         * @param  [type]     $hook            [description]
         * @param  [type]     $function_to_add [description]
         * @param  integer    $priority        [description]
         * @param  integer    $accepted_args   [description]
         */
        public function add_action( $hook, $function_to_add, $priority = 10, $accepted_args = 1 ) {
            add_action( $hook, array( &$this, $function_to_add ), $priority, $accepted_args );
        }

        /**
         * [add_filter description]
         * @method add_filter
         * @param  [type]     $tag             [description]
         * @param  [type]     $function_to_add [description]
         * @param  integer    $priority        [description]
         * @param  integer    $accepted_args   [description]
         */
        public function add_filter( $tag, $function_to_add, $priority = 10, $accepted_args = 1 ) {
            add_filter( $tag, array( &$this, $function_to_add ), $priority, $accepted_args );
        }

    }

endif;

// Helper Function ---------------------------------------

if ( ! function_exists( 'saasland_action' ) ) :
    function saasland_action() {

        $args   = func_get_args();

        if ( !isset( $args[0] ) || empty( $args[0] ) ) {
            return;
        }

        $action = 'saasland_' . $args[0];
        unset( $args[0] );

        do_action_ref_array( $action, $args );
    }
endif;
