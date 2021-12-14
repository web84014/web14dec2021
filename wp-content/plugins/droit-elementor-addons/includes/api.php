<?php
namespace DROIT_ELEMENTOR\Manager;
defined( 'ABSPATH' ) || exit;

class Api{

    private static $instance;

    public function init(){
        // load modules control
        $data = drdt_manager()->api->api_data();
        
    }

    public function api_data(){
        $save_options = get_option( drdt_manager()->ajax::$option_keys, true);
        return isset($save_options['api']) ? $save_options['api'] : [];
    }

    public static function api_map(){
        return apply_filters('dlAddons/api/mapping', [
            'mailchimp' => [
                'title' => __('Mailchimp', 'droit-addons'),
                'is_pro' => false,
                'field' => [
                   'key' => [
                       'title' => 'API Key',
                       'type' => 'text'
                   ]
                ]
            ],
            'google_map' => [
                'title' => __('Google Map', 'droit-addons'),
                'is_pro' => false,
                'url' => 'https://console.cloud.google.com/google/maps-apis/',
                'btn_text' => 'Get API',
                'field' => [
                    'access_token' => [
                        'title' => 'API KEY',
                        'type' => 'text'
                    ]
                ]
            ],
            'response' => [
                'title' => __('Get Response', 'droit-addons'),
                'is_pro' => true,
                'field' => [
                    'key' => [
                        'title' => 'API Key',
                        'type' => 'text'
                    ]
                ]
            ],
            'facebook' => [
                'title' => __('Facebook', 'droit-addons'),
                'is_pro' => true,
                'url' => 'https://api.droitthemes.com/token/?provider=facebook',
                'field' => [
                    'account_name' => [
                        'title' => 'FB Page Name',
                        'type' => 'text'
                    ],
                    'access_token_genarate' => [
                        'title' => 'Access Token',
                        'type' => 'text'
                    ]
                 ]
            ],
            'twitter' => [
                'title' => __('Twitter', 'droit-addons'),
                'is_pro' => true,
                'url' => 'https://api.droitthemes.com/token/?provider=twitter',
                'field' => [
                   
                    'account_name' => [
                        'title' => 'Twitter Username',
                        'type' => 'text'
                    ],
                    'access_token_genarate' => [
                        'title' => 'Access Token',
                        'type' => 'text'
                    ]
                 ]
            ],
            'dribbble' => [
                'title' => __('Dribbble', 'droit-addons'),
                'is_pro' => true,
                'url' => 'https://api.droitthemes.com/token/?provider=dribbble',
                'field' => [
                    'access_token' => [
                        'title' => 'Access Token',
                        'type' => 'text'
                    ]
                ]
            ],

            
            
        ]);
    }

    public static function instance(){
        if ( is_null( self::$instance ) ){
            self::$instance = new self();
        }
        return self::$instance;
    }

}