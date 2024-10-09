<?php

/**
 * Security Code To Block Access On Browser
 */
if (!defined('ABSPATH')) {
    die();
}

function umag_demo_files()
{
    return array(
        array(
            'import_file_name' => 'Umag Demo Import 1',
            'import_file_url'            => get_template_directory_uri() . '/demo-import/contents.xml',
            'import_widget_file_url'     => get_template_directory_uri() . '/demo-import/widgets.wie',
            'import_customizer_file_url' => get_template_directory_uri() . '/demo-import/settings.dat',
            'import_preview_image_url'   => get_template_directory_uri() . '/demo-import/screenshot.png',
            'import_notice' => __('You must activate all recommended plugins before deploying the demo.', 'umag'),
        ),
    );
}

add_filter('ocdi/import_files', 'umag_demo_files');

function umag_after_demo_import()
{
    /**
     * Nav Menu Select Settings
     */
    $main_menu = get_term_by('name', 'Menu 1', 'nav_menu');
    $footer_menu = get_term_by('name', 'Footer Menü', 'nav_menu');

    set_theme_mod('nav_menu_locations', array(
        "primary" => $main_menu->term_id,
        "footer" => $footer_menu->term_id,
    ));

    /**
     * Front Page Select Settings
     */
    $front_page_object = new WP_Query([
        'post_type' => 'page',
        'post_title' => 'Ana Sayfa',
    ]);

    if ($front_page_object->have_posts()) {
        while ($front_page_object->have_posts()) {
            $front_page = $front_page_object->posts[0];
            update_option('show_on_front', 'page');
            update_option('page_on_front', $front_page->ID);
        }
    }

    /**
     * Blog Page Select Settings
     */
    $blog_page_object = new WP_Query([
        'post_type' => 'page',
        'post_title' => 'Blog'
    ]);

    if ($blog_page_object->have_posts()) {
        while ($blog_page_object->have_posts()) {
            $blog_page = $blog_page_object->posts[0];
            update_option('page_for_post', $blog_page->ID);
        }
    }

    /**
     * Mashshare Share Buttons Settings
     */
    $mashsb_settings = get_option('mashsb_settings');
    $mashsb_settings['visible_services'] = '1';
    $mashsb_settings['mashsharer_position'] = 'manuel';
    $mashsb_settings['sharecount_title'] = 'Paylaşım';
    $mashsb_settings['border_radius'] = '3';
    $mashsb_settings['networks'][0]['name'] = 'Paylaş';
    $mashsb_settings['networks'][1]['name'] = 'Tweetle';
    $mashsb_settings['networks'][2]['id'] = 'subscribe';
    $mashsb_settings['networks'][2]['name'] = 'Abone Ol';
    $mashsb_settings['networks'][2]['status'] = '1';
    update_option('mashsb_settings', $mashsb_settings);

    /**
     * WPUlike Settings
     */
    $wp_ulike_settings = get_option('wp_ulike_settings');
    $wp_ulike_settings['posts_group'] = array('template' => 'wpulike-heart', 'enable_auto_display' => 0);
    $wp_ulike_settings['comments_group'] = array('template' => 'wpulike-default', 'enable_auto_display' => 0);
    $wp_ulike_settings['like_notice'] = 'Beğendiğiniz için teşekkürler!';
    $wp_ulike_settings['unlike_notice'] = 'Beğei geri alındı!';
    update_option('wp_ulike_settings', $wp_ulike_settings);

    /**
     * WP-PostViews Settings
     */
    $views_options = get_option('views_options');
    $views_options['count'] = '0';
    $views_options['template'] = '%VIEW_COUNT%';
    update_option('views_options', $views_options);
}

add_action('ocdi/after_import', 'umag_after_demo_import');

function umag_before_widget_import()
{
    $widget_areas = array(
        'sidebar-1' => array(),
    );
    update_option('sidebars_widgets', $widget_areas);
}

add_action('ocdi/before_widgets_import', 'umag_before_widget_import');

function umag_before_content_import()
{
    $query = new WP_Query([
        'post_type' => 'post',
        'post_title' => 'Merhaba dünya!'
    ]);

    if ($query->have_posts()) {
        $hello_world = $query->posts[0];

        $hello_world->post_status = 'draft';
        wp_update_post($hello_world);
    }
}

add_action('ocdi/before_content_import', 'umag_before_content_import');
