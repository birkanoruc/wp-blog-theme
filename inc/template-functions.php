<?php
    /**
     * Functions which enhance the theme by hooking into WordPress
     *
     * @package umag
     */

    /**
     * Adds custom classes to the array of body classes.
     *
     * @param array $classes Classes for the body element.
     * @return array
     */
    function umag_body_classes($classes)
    {
        // Adds a class of hfeed to non-singular pages.
        if (!is_singular()) {
            $classes[] = 'hfeed';
        }

        // Adds a class of no-sidebar when there is no sidebar present.
        if (!is_active_sidebar('sidebar-1')) {
            $classes[] = 'no-sidebar';
        }

        /**
         * Custom Body Class
         */

        if (is_page_template('page-home.php')) {
            $i = 0;

            if (is_active_sidebar('home-left-sidebar')) {
                $i++;
            }

            if (is_active_sidebar('home-right-sidebar')) {
                $i++;
            }

            $home_sidebar_class = 'test';
            switch ($i) {
                case 0:
                    $home_sidebar_class = 'home-no-sidebar';
                    break;
                case 1:
                    $home_sidebar_class = 'home-one-sidebar';
                    break;
                case 2:
                    $home_sidebar_class = 'home-two-sidebar';
                    break;
            }
            $classes[] = $home_sidebar_class;
        }

        return $classes;
    }

    add_filter('body_class', 'umag_body_classes');

    /**
     * Add a pingback url auto-discovery header for single posts, pages, or attachments.
     */
    function umag_pingback_header()
    {
        if (is_singular() && pings_open()) {
            printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
        }
    }

    add_action('wp_head', 'umag_pingback_header');

    /**
     * Custom Dropdown Class
     * @param $classes
     * @return mixed
     */
    function umag_dropdown_class($classes)
    {
        $classes[] = 'dropdown';
        return $classes;
    }

    add_filter('nav_menu_submenu_css_class', 'umag_dropdown_class');

    /**
     * TGM Plugin Activation - Required Plugins
     */
    function umag_register_required_plugins()
    {
        $plugins = array(
            array(
                'name' => 'Contact Form 7',
                'slug' => 'contact-form-7',
                'required' => false,
            ),
            array(
                'name' => 'Kirki Customizer Framework',
                'slug' => 'kirki',
                'required' => false,
            ),
            array(
                'name' => 'WP-PostViews',
                'slug' => 'wp-postviews',
                'required' => false,
            ),
            array(
                'name' => 'WP Ulike',
                'slug' => 'wp-ulike',
                'required' => false,
            ),
            array(
                'name' => 'Advanced Custom Fields (ACF)',
                'slug' => 'advanced-custom-fields',
                'required' => false,
            ),
            array(
                'name' => 'MC4WP: Mailchimp for WordPress',
                'slug' => 'mailchimp-for-wp',
                'required' => false,
            ),
            array(
                'name' => 'Social Media Share Buttons | MashShare',
                'slug' => 'mashsharer',
                'required' => false,
            ),
            array(
                'name' => 'One Click Demo Import',
                'slug' => 'one-click-demo-import',
                'required' => false,
            ),
        );

        $config = array(
            'id' => 'umag',                             // Unique ID for hashing notices for multiple instances of TGMPA.
            'default_path' => '',                       // Default absolute path to bundled plugins.
            'menu' => 'umag-install-plugins',           // Menu slug.
            'parent_slug' => 'themes.php',              // Parent menu slug.
            'capability' => 'edit_theme_options',       // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
            'has_notices' => true,                      // Show admin notices or not.
            'dismissable' => true,                      // If false, a user cannot dismiss the nag message.
            'dismiss_msg' => '',                        // If 'dismissable' is false, this message will be output at top of nag.
            'is_automatic' => false,                    // Automatically activate plugins after installation or not.
            'message' => '',                            // Message to output right before the plugins table.
        );

        tgmpa($plugins, $config);
    }

    add_action('tgmpa_register', 'umag_register_required_plugins');

    /**
     * WP Remove Header Textcolor
     */

    function umag_default_customizer($wp_customize)
    {
        $wp_customize->remove_control('header_textcolor');
    }

    add_action('customize_register', 'umag_default_customizer');

    /**
     * Custom Style Code
     */
    function umag_custom_style()
    {
        $umag_primary_color = get_theme_mod('umag_primary_color', '#ed3974');

        ob_start();

        ?>
        <style>
            :root {
                --primary: <?= sanitize_hex_color($umag_primary_color); ?> !important;
            }
        </style>
        <?php

        return str_replace(array('<style>', '</style>'), array('', ''), ob_get_clean());
    }

    function umag_comment_form_fields($fields)
    {
        $comment_field = $fields['comment'];
        $cookies_field = $fields['cookies'];
        unset($fields['comment']);
        unset($fields['cookies']);
        $fields['comment'] = $comment_field;
        $fields['cookies'] = $cookies_field;
        return $fields;
    }

    add_filter('comment_form_fields', 'umag_comment_form_fields');
