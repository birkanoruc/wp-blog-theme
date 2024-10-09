<?php

    define('UMAG_THEME_VERSION', wp_get_theme()->get('Version'));

    if (!defined('_S_VERSION')) {
        // Replace the version number of the theme on each release.
        define('_S_VERSION', '1.0.0');
    }

    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function umag_setup()
    {
        /*
            * Make theme available for translation.
            * Translations can be filed in the /languages/ directory.
            * If you're building a theme based on umag, use a find and replace
            * to change 'umag' to the name of your theme in all the template files.
            */
        load_theme_textdomain('umag', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        //New Image Size
        add_image_size('umag_home_widget_1', 354, 243, true);
        add_image_size('umag_home_widget_2', 530, 375, true);
        add_image_size('umag_home_widget_2_2', 120, 120, true);
        add_image_size('umag_home_widget_3', 290, 199, true);
        add_image_size('umag_home_widget_4', 450, 318, true);
        add_image_size('umag_posts_widget', 70, 70, true);
        add_image_size('umag_ourteam', 160, 160, true);


        /*
            * Let WordPress manage the document title.
            * By adding theme support, we declare that this theme does not use a
            * hard-coded <title> tag in the document head, and expect WordPress to
            * provide it for us.
            */
        add_theme_support('title-tag');

        /*
            * Enable support for Post Thumbnails on posts and pages.
            *
            * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
            */
        add_theme_support('post-thumbnails');

        /**
         * Enable support for Post Format = Video
         */
        add_theme_support('post-formats', array('video'));


        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(
            array(
                'primary' => esc_html__('Primary Menu', 'umag'),
                'footer' => esc_html__('Footer Menu', 'umag'),
            )
        );

        /*
            * Switch default core markup for search form, comment form, and comments
            * to output valid HTML5.
            */
        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'style',
                'script',
            )
        );

        // Set up the WordPress core custom background feature.
        add_theme_support(
            'custom-background',
            apply_filters(
                'umag_custom_background_args',
                array(
                    'default-color' => 'ffffff',
                    'default-image' => '',
                )
            )
        );

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support(
            'custom-logo',
            array(
                'height' => 250,
                'width' => 250,
                'flex-width' => true,
                'flex-height' => true,
            )
        );
    }

    add_action('after_setup_theme', 'umag_setup');

    /**
     * Set the content width in pixels, based on the theme's design and stylesheet.
     *
     * Priority 0 to make it available to lower priority callbacks.
     *
     * @global int $content_width
     */
    function umag_content_width()
    {
        $GLOBALS['content_width'] = apply_filters('umag_content_width', 670);
    }

    add_action('after_setup_theme', 'umag_content_width', 0);

    /**
     * Register widget area.
     *
     * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
     */
    function umag_widgets_init()
    {
        register_sidebar(
            array(
                'name' => esc_html__('Sidebar', 'umag'),
                'id' => 'sidebar-1',
                'description' => esc_html__('Add widgets here.', 'umag'),
                'before_widget' => '<section id="%1$s" class="single-sidebar-widget p-30 widget %2$s">',
                'after_widget' => '</section>',
                'before_title' => '<div class="section-heading"><h5 class="widget-title">',
                'after_title' => '</h5></div>',
            )
        );

        register_sidebar(
            array(
                'name' => esc_html__('Home Left Sidebar', 'umag'),
                'id' => 'home-left-sidebar',
                'description' => esc_html__('Add widgets here.', 'umag'),
                'before_widget' => '<section id="%1$s" class="single-sidebar-widget p-30 widget %2$s">',
                'after_widget' => '</section>',
                'before_title' => '<div class="section-heading"><h5 class="widget-title">',
                'after_title' => '</h5></div>',
            )
        );

        register_sidebar(
            array(
                'name' => esc_html__('Home Right Sidebar', 'umag'),
                'id' => 'home-right-sidebar',
                'description' => esc_html__('Add widgets here.', 'umag'),
                'before_widget' => '<section id="%1$s" class="single-sidebar-widget p-30 widget %2$s">',
                'after_widget' => '</section>',
                'before_title' => '<div class="section-heading"><h5 class="widget-title">',
                'after_title' => '</h5></div>',
            )
        );

        register_sidebar(
            array(
                'name' => esc_html__('Footer 1', 'umag'),
                'id' => 'footer-1',
                'description' => esc_html__('Add widgets here.', 'umag'),
                'before_widget' => '<section id="%1$s" class="footer-widget widget %2$s">',
                'after_widget' => '</section>',
                'before_title' => '<h6 class="widget-title">',
                'after_title' => '</h6>',
            )
        );

        register_sidebar(
            array(
                'name' => esc_html__('Footer 2', 'umag'),
                'id' => 'footer-2',
                'description' => esc_html__('Add widgets here.', 'umag'),
                'before_widget' => '<section id="%1$s" class="footer-widget widget %2$s">',
                'after_widget' => '</section>',
                'before_title' => '<h6 class="widget-title">',
                'after_title' => '</h6>',
            )
        );

        register_sidebar(
            array(
                'name' => esc_html__('Footer 3', 'umag'),
                'id' => 'footer-3',
                'description' => esc_html__('Add widgets here.', 'umag'),
                'before_widget' => '<section id="%1$s" class="footer-widget widget %2$s">',
                'after_widget' => '</section>',
                'before_title' => '<h6 class="widget-title">',
                'after_title' => '</h6>',
            )
        );

        register_sidebar(
            array(
                'name' => esc_html__('Footer 4', 'umag'),
                'id' => 'footer-4',
                'description' => esc_html__('Add widgets here.', 'umag'),
                'before_widget' => '<section id="%1$s" class="footer-widget widget %2$s">',
                'after_widget' => '</section>',
                'before_title' => '<h6 class="widget-title">',
                'after_title' => '</h6>',
            )
        );
    }

    add_action('widgets_init', 'umag_widgets_init');

    /**
     * Enqueue scripts and styles.
     */
    function umag_scripts()
    {
        /**
         * CSS include
         */
        wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), UMAG_THEME_VERSION);

        wp_enqueue_style('umag-classy-nav', get_template_directory_uri() . '/assets/css/classy-nav.css', array(), UMAG_THEME_VERSION);

        wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), UMAG_THEME_VERSION);

        wp_enqueue_style('themify-icons', get_template_directory_uri() . '/assets/css/themify-icons.css', array(), UMAG_THEME_VERSION);

        wp_enqueue_style('owl-carousel', get_template_directory_uri() . '/assets/css/owl.carousel.min.css', array(), UMAG_THEME_VERSION);

        /**
         * Custom CSS include
         */
        wp_enqueue_style('umag-style', get_stylesheet_uri(), array(), _S_VERSION);

        wp_add_inline_style('umag-style', umag_custom_style());

        wp_style_add_data('umag-style', 'rtl', 'replace');

        /**
         * JS include
         */
        wp_enqueue_script('popper', get_template_directory_uri() . '/assets/js/bootstrap/popper.min.js', array('jquery'), UMAG_THEME_VERSION, true);

        wp_enqueue_script('bootsrap', get_template_directory_uri() . '/assets/js/bootstrap/bootstrap.min.js', array('jquery'), UMAG_THEME_VERSION, true);

        wp_enqueue_script('umag-plugins', get_template_directory_uri() . '/assets/js/plugins/plugins.js', array('jquery'), UMAG_THEME_VERSION, true);

        wp_enqueue_script('umag-active', get_template_directory_uri() . '/assets/js/active.js', array('jquery'), UMAG_THEME_VERSION, true);

        wp_enqueue_script('sharer', get_template_directory_uri() . '/assets/js/sharer.min.js', array(), _S_VERSION, true);

        wp_enqueue_script('umag-script', get_template_directory_uri() . '/assets/js/theme.js', array('jquery'), UMAG_THEME_VERSION, true );

        wp_localize_script('umag-script', 'umag_object', array(
           'ajax_url' => admin_url('admin-ajax.php'),
            'home_url'  => home_url('/'),
        ));

        /**
         * Comment Reply JS include
         */
        if (is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }
    }

    add_action('wp_enqueue_scripts', 'umag_scripts');

    /**
     * Custom template tags for this theme.
     */
    require get_template_directory() . '/inc/template-tags.php';

    /**
     * Functions which enhance the theme by hooking into WordPress.
     */
    require get_template_directory() . '/inc/template-functions.php';

    /**
     * TGM Plugin Activation
     */
    require get_template_directory() . '/inc/classes/class-tgm-plugin-activation.php';

    /**
     * Theme Options
     */
    require get_template_directory() . '/inc/theme-options.php';

    /**
     * Meta Box
     */
    require get_template_directory() . '/inc/meta-box.php';

    /**
     * Ajax Functions
     */
    require get_template_directory() . '/inc/ajax-functions.php';

    /**
     * Shortcode Functions
     */
    require get_template_directory() . '/inc/shortcode-functions.php';

    /**
     * Demo Import Functions
     */
    require get_template_directory() . '/inc/demo-import.php';

    /**
     * Custom Post Types
     */
    require get_template_directory() . '/inc/custom-post-types.php';

    /**
     * Widgets
     */
    require get_template_directory() . '/inc/widgets/umag-posts-widget.php';
    require get_template_directory() . '/inc/widgets/umag-social-media-followers-widget.php';
    require get_template_directory() . '/inc/widgets/umag-categories-widget.php';
    require get_template_directory() . '/inc/widgets/umag-video-posts-widget.php';
    require get_template_directory() . '/inc/widgets/umag-social-media-widget.php';
    require get_template_directory() . '/inc/widgets/umag-footer-categories-widget.php';
    require get_template_directory() . '/inc/widgets/umag-tags-widget.php';

    /**
     * Comment Template
     */
    require get_template_directory().'/inc/umag-comment-template.php';

    /**
     * Load Jetpack compatibility file.
     */
    if (defined('JETPACK__VERSION')) {
        require get_template_directory() . '/inc/jetpack.php';
    }

    /**
     * WP Emoji Remove
     */
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');

//add_filter('tiny_mce_plugins', 'disable_emojicons_tinymce');

    /**
     * REMOVE WP Block Library CSS
     */
    function remove_wp_block_library_css()
    {
        wp_dequeue_style('wp-block-library'); // REMOVE wp-block-library-css
        wp_dequeue_style('classic-theme-styles'); // REMOVE classic-theme-styles-inline-css
        wp_dequeue_style('global-styles'); // REMOVE global-styles-inline-css
    }

    add_action('wp_enqueue_scripts', 'remove_wp_block_library_css', 100);