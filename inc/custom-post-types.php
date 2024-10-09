<?php

    /**
     * Security Code To Block Access On Browser
     */
    if (!defined('ABSPATH')) {
        die();
    }

// Register Custom Post Type Our Team
    function umag_create_ourteam_cpt()
    {

        $labels = array(
            'name' => _x('Our Teams', 'Post Type General Name', 'umag'),
            'singular_name' => _x('Our Team', 'Post Type Singular Name', 'umag'),
            'menu_name' => _x('Our Teams', 'Admin Menu text', 'umag'),
            'name_admin_bar' => _x('Our Team', 'Add New on Toolbar', 'umag'),
            'archives' => __('Our Team Archives', 'umag'),
            'attributes' => __('Our Team Attributes', 'umag'),
            'parent_item_colon' => __('Parent Our Team:', 'umag'),
            'all_items' => __('All Our Teams', 'umag'),
            'add_new_item' => __('Add New Our Team', 'umag'),
            'add_new' => __('Add New', 'umag'),
            'new_item' => __('New Our Team', 'umag'),
            'edit_item' => __('Edit Our Team', 'umag'),
            'update_item' => __('Update Our Team', 'umag'),
            'view_item' => __('View Our Team', 'umag'),
            'view_items' => __('View Our Teams', 'umag'),
            'search_items' => __('Search Our Team', 'umag'),
            'not_found' => __('Not found', 'umag'),
            'not_found_in_trash' => __('Not found in Trash', 'umag'),
            'featured_image' => __('Featured Image', 'umag'),
            'set_featured_image' => __('Set featured image', 'umag'),
            'remove_featured_image' => __('Remove featured image', 'umag'),
            'use_featured_image' => __('Use as featured image', 'umag'),
            'insert_into_item' => __('Insert into Our Team', 'umag'),
            'uploaded_to_this_item' => __('Uploaded to this Our Team', 'umag'),
            'items_list' => __('Our Teams list', 'umag'),
            'items_list_navigation' => __('Our Teams list navigation', 'umag'),
            'filter_items_list' => __('Filter Our Teams list', 'umag'),
        );
        $args = array(
            'label' => __('Our Team', 'umag'),
            'description' => __('', 'umag'),
            'labels' => $labels,
            'menu_icon' => 'dashicons-admin-post',
            'supports' => array('title', 'editor', 'thumbnail'),
            'taxonomies' => array(),
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_position' => 5,
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => false,
            'can_export' => true,
            'has_archive' => false,
            'hierarchical' => false,
            'exclude_from_search' => true,
            'show_in_rest' => true,
            'publicly_queryable' => false,
            'capability_type' => 'post',
        );
        register_post_type('ourteam', $args);

    }

    add_action('init', 'umag_create_ourteam_cpt', 0);