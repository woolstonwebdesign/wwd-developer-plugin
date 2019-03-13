<?php
/*
@package Woolston Web Design Developer Plugin
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

function wwd_add_admin_page() {
    add_menu_page( 'WWD Theme Options', 'WWD', 'manage_options', 'wwd_plugin', 'wwd_theme_create_settings_page', 'dashicons-admin-generic', 90 );
    add_submenu_page( 'wwd_plugin',  'WWD Theme Options',  'Settings',  'manage_options',  'wwd_plugin',  'wwd_theme_create_settings_page' );

    register_setting('wwd-plugin-options', 'wwd-plugin');
}
add_action('admin_menu', 'wwd_add_admin_page');

function wwd_theme_create_settings_page() {
    $options = get_option('wwd-plugin');
    require_once WWD_PLUGIN_PATH . "/templates/admin.php";
}
