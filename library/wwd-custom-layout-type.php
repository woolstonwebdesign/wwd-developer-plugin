<?php
/*
@package Woolston Web Design Developer Plugin
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

function wwd_add_custom_post($name, $label, $pluralisedName, $icon = 'dashicons-editor-table') 
{
    wwd_generic_custom_layout_type($name, $label, $pluralisedName, $icon);
}

function wwd_options_custom_post_type() {

    $options = get_option('wwd-plugin');
    $custom_post_types = $options['custom_posts'];

    if (empty($custom_post_types)){
        return;
    }
    
    for ($i = 0; $i < count($custom_post_types); $i++) {
        $name = $custom_post_types[$i]["name"];
        $label = $custom_post_types[$i]["label"];
        $plural = $custom_post_types[$i]["plural"];
        wwd_generic_custom_layout_type($name, $label, $plural);
    }
    
}
add_action( 'init', 'wwd_options_custom_post_type' );

function wwd_generic_custom_layout_type($name, $label, $plural, $icon = 'dashicons-editor-table') 
{
    $labels = array(
        'name' => _x( $label, $name ),
        'singular_name' => _x( $label, $name ),
        'add_new' => _x( 'Add New', $name ),
        'add_new_item' => _x( 'Add New ' . $label, $name ),
        'edit_item' => _x( 'Edit ' . $label, $name ),
        'new_item' => _x( 'New ' . $label, $name ),
        'view_item' => _x( 'View ' . $label, $name ),
        'search_items' => _x( 'Search ' . $label, $name ),
        'not_found' => _x( 'No Layout found', $name ),
        'not_found_in_trash' => _x( 'No Layout found in Trash', $name ),
        'menu_name' => _x( $plural, $name )
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => false,
        'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'page-attributes' ),
        'taxonomies' => array('category'),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_icon' => $icon,
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => array('slug' => $name),
        'capability_type' => 'post'
    );

    register_post_type( $name, $args );

}