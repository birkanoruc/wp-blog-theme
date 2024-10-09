<?php

    /**
     * Security Code To Block Access On Browser
     */
    if (!defined('ABSPATH')) {
        die();
    }

    /**
     * Check for Kirki Class
     */
    if (!class_exists('Kirki')) {
        return;
    }

    /**
     * Kirki Adjuster Set Description
     */
    Kirki::add_config('umag', array(
        'capability' => 'edit_theme_options',
        'option_type' => 'theme_mod',
    ));

    /**
     * Color Settings
     */
    Kirki::add_field('umag', array(
        'type' => 'color',
        'settings' => 'umag_primary_color',
        'label' => esc_html__('Primary Color', 'umag'),
        'section' => 'colors',
        'default' => '#ed3974',
        'priority' => 1,
    ));

    /**
     * Header Settings
     */

    Kirki::add_panel('umag_header_settings', array(
        'priority' => 1,
        'title' => esc_html__('Header Settings', 'umag'),
        //'icon' => 'dashicons-editor-aligncenter',
    ));

    /**
     * Header Settings -> Icon Settings
     */

    Kirki::add_section('umag_header_icon_settings', array(
        'priority' => 1,
        'panel' => 'umag_header_settings',
        'title' => esc_html__('Icon Settings', 'umag'),
        //'icon' => 'dashicons-editor-aligncenter',
    ));

    Kirki::add_field('umag', array(
        'type' => 'text',
        'settings' => 'umag_header_icon',
        'label' => esc_html__('Icon', 'umag'),
        'section' => 'umag_header_icon_settings',
        'default' => 'fa-user',
        'priority' => 1,
    ));

    Kirki::add_field('umag', array(
        'type' => 'text',
        'settings' => 'umag_header_icon_link',
        'label' => esc_html__('Icon Link', 'umag'),
        'section' => 'umag_header_icon_settings',
        'default' => '#',
        'priority' => 2,
    ));

    /**
     * Header Settings -> Search Settings
     */

    Kirki::add_section('umag_header_search_settings', array(
        'priority' => 2,
        'panel' => 'umag_header_settings',
        'title' => esc_html__('Search Settings', 'umag'),
    ));

    Kirki::add_field('umag', array(
        'type' => 'text',
        'settings' => 'umag_header_search_placeholder',
        'label' => esc_html__('Search Placeholder Text', 'umag'),
        'section' => 'umag_header_search_settings',
        'default' => 'Search and hit enter...',
        'priority' => 1,
    ));

    /**
     * Header Settings -> Button Settings
     */

    Kirki::add_section('umag_header_button_settings', array(
        'priority' => 3,
        'panel' => 'umag_header_settings',
        'title' => esc_html__('Button Settings', 'umag'),
        //'icon' => 'dashicons-editor-aligncenter',
    ));

    Kirki::add_field('umag', array(
        'type' => 'text',
        'settings' => 'umag_header_button_text',
        'label' => esc_html__('Button Text', 'umag'),
        'section' => 'umag_header_button_settings',
        'default' => 'Submit Video',
        'priority' => 1,
    ));

    Kirki::add_field('umag', array(
        'type' => 'text',
        'settings' => 'umag_header_button_link',
        'label' => esc_html__('Button Link', 'umag'),
        'section' => 'umag_header_button_settings',
        'default' => '#',
        'priority' => 2,
    ));

    Kirki::add_field('umag', array(
        'type' => 'text',
        'settings' => 'umag_header_button_icon',
        'label' => esc_html__('Button Icon', 'umag'),
        'section' => 'umag_header_button_settings',
        'default' => 'fa-cloud-upload',
        'priority' => 3,
    ));

    /**
     * Header Settings -> Menu Settings
     */

    Kirki::add_section('umag_header_menu_settings', array(
        'priority' => 4,
        'panel' => 'umag_header_settings',
        'title' => esc_html__('Menu Settings', 'umag'),
    ));


    /**
     * Home Settings
     */

    Kirki::add_panel('umag_home_settings', array(
        'priority' => 2,
        'title' => esc_html__('Home Settings', 'umag'),
    ));

    /**
     * Home Settings -> PreLoader Settings
     */

    Kirki::add_section('umag_preloader_settings', array(
        'priority' => 1,
        'panel' => 'umag_home_settings',
        'title' => esc_html__('Preloader Settings', 'umag'),
    ));

    Kirki::add_field('umag', array(
        'type' => 'switch',
        'settings' => 'umag_preloader_toggle',
        'label' => esc_html__('Preloader Toggle', 'umag'),
        'section' => 'umag_preloader_settings',
        'default' => true,
        'priority' => 1,
    ));

    /**
     * Home Settings -> Slider Settings
     */

    Kirki::add_section('umag_home_slider_settings', array(
        'priority' => 2,
        'panel' => 'umag_home_settings',
        'title' => esc_html__('Slider Settings', 'umag'),
    ));

    Kirki::add_field('umag', array(
        'priority' => 1,
        'type' => 'switch',
        'settings' => 'umag_home_slider_toggle',
        'label' => esc_html__('Home Slider Toggle', 'umag'),
        'section' => 'umag_home_slider_settings',
        'default' => true,
    ));

    Kirki::add_field('umag', array(
        'priority' => 2,
        'type' => 'number',
        'settings' => 'umag_home_slider_count',
        'label' => esc_html__('Slider Count', 'umag'),
        'section' => 'umag_home_slider_settings',
        'default' => 3,
        'choices' => [
            'min' => 1,
            'max' => 20,
            'step' => 1,
        ],
    ));

    Kirki::add_field('umag', array(
        'priority' => 3,
        'type' => 'select',
        'settings' => 'umag_home_slider_select_categories',
        'section' => 'umag_home_slider_settings',
        'label' => esc_html__('Select Categories', 'umag'),
        'description' => esc_html__('If you leave it blank, all categories will appear.', 'umag'),
        'placeholder' => esc_html__('Choose an option', 'umag'),
        'multiple' => true,
        'choices' => Kirki_Helper::get_terms(array(
            'taxonomy' => 'category',
            'hide_empty' => false,
            'count' => -1,
        )),
    ));

    Kirki::add_field('umag', array(
        'priority' => 4,
        'type' => 'select',
        'settings' => 'umag_home_slider_select_order',
        'section' => 'umag_home_slider_settings',
        'label' => esc_html__('Select Order', 'umag'),
        'placeholder' => esc_html__('Choose an option', 'umag'),
        'multiple' => false,
        'choices' => array(
            'date' => esc_html__('Sort by date', 'umag'),
            'rand' => esc_html__('Sort by random', 'umag'),
            'comment_count' => esc_html__('Sort by comment count', 'umag'),
        ),
    ));

    /**
     * Home Settings -> Widget 1
     */

    Kirki::add_section('umag_home_widget_1', array(
        'priority' => 3,
        'panel' => 'umag_home_settings',
        'title' => esc_html__('Widget 1 Settings', 'umag'),
    ));

    Kirki::add_field('umag', array(
        'priority' => 1,
        'type' => 'switch',
        'settings' => 'umag_home_widget_1_toggle',
        'label' => esc_html__('Home Widget 1 Toggle', 'umag'),
        'section' => 'umag_home_widget_1',
        'default' => true,
    ));

    Kirki::add_field('umag', array(
        'priority' => 2,
        'type' => 'text',
        'settings' => 'umag_home_widget_1_title',
        'label' => esc_html__('Widget 1 Title', 'umag'),
        'section' => 'umag_home_widget_1',
        'default' => 'Trending Now',
    ));

    Kirki::add_field('umag', array(
        'priority' => 3,
        'type' => 'number',
        'settings' => 'umag_home_widget_1_count',
        'label' => esc_html__('Widget 1 Count', 'umag'),
        'section' => 'umag_home_widget_1',
        'default' => 3,
        'choices' => [
            'min' => 3,
            'max' => 20,
            'step' => 1,
        ],
    ));

    Kirki::add_field('umag', array(
        'priority' => 4,
        'type' => 'select',
        'settings' => 'umag_home_widget_1_select_categories',
        'section' => 'umag_home_widget_1',
        'label' => esc_html__('Select Categories', 'umag'),
        'description' => esc_html__('If you leave it blank, all categories will appear.', 'umag'),
        'placeholder' => esc_html__('Choose an option', 'umag'),
        'multiple' => true,
        'choices' => Kirki_Helper::get_terms(array(
            'taxonomy' => 'category',
            'hide_empty' => false,
            'count' => -1,
        )),
    ));

    Kirki::add_field('umag', array(
        'priority' => 5,
        'type' => 'select',
        'settings' => 'umag_home_widget_1_select_order',
        'section' => 'umag_home_widget_1',
        'label' => esc_html__('Select Order', 'umag'),
        'placeholder' => esc_html__('Choose an option', 'umag'),
        'multiple' => false,
        'choices' => array(
            'date' => esc_html__('Sort by date', 'umag'),
            'rand' => esc_html__('Sort by random', 'umag'),
            'comment_count' => esc_html__('Sort by comment count', 'umag'),
        ),
    ));

    /**
     * Home Settings -> Widget 2
     */

    Kirki::add_section('umag_home_widget_2', array(
        'priority' => 3,
        'panel' => 'umag_home_settings',
        'title' => esc_html__('Widget 2 Settings', 'umag'),
    ));

    Kirki::add_field('umag', array(
        'priority' => 1,
        'type' => 'switch',
        'settings' => 'umag_home_widget_2_toggle',
        'label' => esc_html__('Home Widget 2 Toggle', 'umag'),
        'section' => 'umag_home_widget_2',
        'default' => true,
    ));

    Kirki::add_field('umag', array(
        'priority' => 2,
        'type' => 'text',
        'settings' => 'umag_home_widget_2_title',
        'label' => esc_html__('Widget 2 Title', 'umag'),
        'section' => 'umag_home_widget_2',
        'default' => 'Featured Videos',
    ));

    Kirki::add_field('umag', array(
        'priority' => 3,
        'type' => 'number',
        'settings' => 'umag_home_widget_2_count',
        'label' => esc_html__('Widget 2 Count', 'umag'),
        'section' => 'umag_home_widget_2',
        'default' => 3,
        'choices' => [
            'min' => 3,
            'max' => 20,
            'step' => 1,
        ],
    ));

    Kirki::add_field('umag', array(
        'priority' => 4,
        'type' => 'select',
        'settings' => 'umag_home_widget_2_select_categories',
        'section' => 'umag_home_widget_2',
        'label' => esc_html__('Select Categories', 'umag'),
        'description' => esc_html__('If you leave it blank, all categories will appear.', 'umag'),
        'placeholder' => esc_html__('Choose an option', 'umag'),
        'multiple' => true,
        'choices' => Kirki_Helper::get_terms(array(
            'taxonomy' => 'category',
            'hide_empty' => false,
            'count' => -1,
        )),
    ));

    Kirki::add_field('umag', array(
        'priority' => 5,
        'type' => 'select',
        'settings' => 'umag_home_widget_2_select_order',
        'section' => 'umag_home_widget_2',
        'label' => esc_html__('Select Order', 'umag'),
        'placeholder' => esc_html__('Choose an option', 'umag'),
        'multiple' => false,
        'choices' => array(
            'date' => esc_html__('Sort by date', 'umag'),
            'rand' => esc_html__('Sort by random', 'umag'),
            'comment_count' => esc_html__('Sort by comment count', 'umag'),
        ),
    ));

    /**
     * Home Settings -> Widget 3
     */

    Kirki::add_section('umag_home_widget_3', array(
        'priority' => 4,
        'panel' => 'umag_home_settings',
        'title' => esc_html__('Widget 3 Settings', 'umag'),
    ));

    Kirki::add_field('umag', array(
        'priority' => 1,
        'type' => 'switch',
        'settings' => 'umag_home_widget_3_toggle',
        'label' => esc_html__('Home Widget 3 Toggle', 'umag'),
        'section' => 'umag_home_widget_3',
        'default' => true,
    ));

    Kirki::add_field('umag', array(
        'priority' => 2,
        'type' => 'text',
        'settings' => 'umag_home_widget_3_title',
        'label' => esc_html__('Widget 3 Title', 'umag'),
        'section' => 'umag_home_widget_3',
        'default' => 'Most Viewed Videos',
    ));

    Kirki::add_field('umag', array(
        'priority' => 3,
        'type' => 'number',
        'settings' => 'umag_home_widget_3_count',
        'label' => esc_html__('Widget 3 Count', 'umag'),
        'section' => 'umag_home_widget_3',
        'default' => 3,
        'choices' => [
            'min' => 3,
            'max' => 20,
            'step' => 1,
        ],
    ));

    Kirki::add_field('umag', array(
        'priority' => 4,
        'type' => 'select',
        'settings' => 'umag_home_widget_3_select_categories',
        'section' => 'umag_home_widget_3',
        'label' => esc_html__('Select Categories', 'umag'),
        'description' => esc_html__('If you leave it blank, all categories will appear.', 'umag'),
        'placeholder' => esc_html__('Choose an option', 'umag'),
        'multiple' => true,
        'choices' => Kirki_Helper::get_terms(array(
            'taxonomy' => 'category',
            'hide_empty' => false,
            'count' => -1,
        )),
    ));

    Kirki::add_field('umag', array(
        'priority' => 5,
        'type' => 'select',
        'settings' => 'umag_home_widget_3_select_order',
        'section' => 'umag_home_widget_3',
        'label' => esc_html__('Select Order', 'umag'),
        'placeholder' => esc_html__('Choose an option', 'umag'),
        'multiple' => false,
        'choices' => array(
            'date' => esc_html__('Sort by date', 'umag'),
            'rand' => esc_html__('Sort by random', 'umag'),
            'comment_count' => esc_html__('Sort by comment count', 'umag'),
        ),
    ));

    /**
     * Home Settings -> Widget 4
     */

    Kirki::add_section('umag_home_widget_4', array(
        'priority' => 5,
        'panel' => 'umag_home_settings',
        'title' => esc_html__('Widget 4 Settings', 'umag'),
    ));

    Kirki::add_field('umag', array(
        'priority' => 1,
        'type' => 'switch',
        'settings' => 'umag_home_widget_4_toggle',
        'label' => esc_html__('Home Widget 4 Toggle', 'umag'),
        'section' => 'umag_home_widget_4',
        'default' => true,
    ));

    Kirki::add_field('umag', array(
        'priority' => 2,
        'type' => 'text',
        'settings' => 'umag_home_widget_4_title',
        'label' => esc_html__('Widget 4 Title', 'umag'),
        'section' => 'umag_home_widget_4',
        'default' => 'Sports Videos',
    ));

    Kirki::add_field('umag', array(
        'priority' => 3,
        'type' => 'number',
        'settings' => 'umag_home_widget_4_count',
        'label' => esc_html__('Widget 4 Count', 'umag'),
        'section' => 'umag_home_widget_4',
        'default' => 3,
        'choices' => [
            'min' => 3,
            'max' => 20,
            'step' => 1,
        ],
    ));

    Kirki::add_field('umag', array(
        'priority' => 4,
        'type' => 'select',
        'settings' => 'umag_home_widget_4_select_categories',
        'section' => 'umag_home_widget_4',
        'label' => esc_html__('Select Categories', 'umag'),
        'description' => esc_html__('If you leave it blank, all categories will appear.', 'umag'),
        'placeholder' => esc_html__('Choose an option', 'umag'),
        'multiple' => true,
        'choices' => Kirki_Helper::get_terms(array(
            'taxonomy' => 'category',
            'hide_empty' => false,
            'count' => -1,
        )),
    ));

    Kirki::add_field('umag', array(
        'priority' => 5,
        'type' => 'select',
        'settings' => 'umag_home_widget_4_select_order',
        'section' => 'umag_home_widget_4',
        'label' => esc_html__('Select Order', 'umag'),
        'placeholder' => esc_html__('Choose an option', 'umag'),
        'multiple' => false,
        'choices' => array(
            'date' => esc_html__('Sort by date', 'umag'),
            'rand' => esc_html__('Sort by random', 'umag'),
            'comment_count' => esc_html__('Sort by comment count', 'umag'),
        ),
    ));

    /**
     * Blog Settings
     */

    Kirki::add_section('umag_blog_settings', array(
        'priority' => 3,
        'title' => esc_html__('Blog Settings', 'umag'),
        //'icon' => 'dashicons-editor-aligncenter',
    ));

    /**
     * Social Share Shortcode
     */
    Kirki::add_field('umag', array(
        'type' => 'text',
        'settings' => 'umag_social_share_shortcode',
        'label' => esc_html__('Social Share Shortcode', 'umag'),
        'section' => 'umag_blog_settings',
        'priority' => 1,
    ));

    /**
     * Author Toggle
     */
    Kirki::add_field('umag', array(
        'type' => 'switch',
        'settings' => 'umag_author_toggle',
        'label' => esc_html__('Author Toggle', 'umag'),
        'section' => 'umag_blog_settings',
        'default' => true,
        'priority' => 2,
    ));

    /**
     * Related Post Toggle
     */
    Kirki::add_field('umag', array(
        'type' => 'switch',
        'settings' => 'umag_related_post_toggle',
        'label' => esc_html__('Related Post Toggle', 'umag'),
        'section' => 'umag_blog_settings',
        'default' => true,
        'priority' => 3,
    ));

    /**
     * Page Settings
     */

    Kirki::add_section('umag_page_settings', array(
        'priority' => 6,
        'title' => esc_html__('Page Settings', 'umag'),
    ));

    /**
     * Login Page
     */
    Kirki::add_field('umag', array(
        'type' => 'select',
        'settings' => 'umag_login_page',
        'label' => esc_html__('Login Page', 'umag'),
        'section' => 'umag_page_settings',
        'multiple' => 1,
        'choices' => Kirki_Helper::get_posts(
            array(
                'post_per_page' => -1,
                'post_type' => 'page',
            ),
        ),
        'default' => true,
        'priority' => 1,
    ));

    /**
     * Footer Settings
     */

    Kirki::add_section('umag_footer_settings', array(
        'priority' => 7,
        'title' => esc_html__('Footer Settings', 'umag'),
    ));

    /**
     * Login Page
     */
    Kirki::add_field('umag', array(
        'type' => 'text',
        'settings' => 'umag_footer_text',
        'label' => esc_html__('Footer Text', 'umag'),
        'section' => 'umag_footer_settings',
        'default' => 'Copyright © 2023. All rights reserved | Birkanoruc.com.tr',
        'priority' => '1',
    ));