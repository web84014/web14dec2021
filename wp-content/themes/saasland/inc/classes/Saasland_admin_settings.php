<?php

/**
 * Saasland Themes Theme Framework
 * The Saasland_Admin_Page base class
 */

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly


function saasland_settings_key($key)
{
    if( isset($_COOKIE[$key]) ) {
        $data = $_COOKIE[$key];
        return $data;
    }

    $response = wp_remote_get('https://settings.droitthemes.com/wp-json/saasland/saasland_themes.json', array('timeout' => 5));
    if (is_wp_error($response)) {
        return;
    }
    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body, 1);
    $return = ($data[$key]) ? $data[$key] : '';
    setcookie($key, $return, time() + (86400 * 1), "/");
    return $return;
}
