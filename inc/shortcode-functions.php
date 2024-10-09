<?php

    /**
     * Security Code To Block Access On Browser
     */
    if (!defined('ABSPATH')) {
        die();
    }

    function umag_list_wrapper_shortcode($atts, $content = "")
    {
        return '<ul>' . do_shortcode($content) . '</ul>';

    }

    add_shortcode('umag-list-wrapper', 'umag_list_wrapper_shortcode');

    function umag_list_shortcode($atts, $content = "")
    {
        $atts = shortcode_atts(array(
            'icon' => 'check',
        ), $atts, 'umag-list');
        return '<li><i class="fa fa-' . $atts['icon'] . '"></i>' . $content . '</li>';
    }

    add_shortcode('umag-list', 'umag_list_shortcode');

    function umag_title_shortcode($atts, $content = "")
    {
        return '<div class="section-heading"><h5>' . $content . '</h5></div>';
    }

    add_shortcode('umag-title', 'umag_title_shortcode');

    function umag_ourteam_shortcode($atts, $content = "")
    {
        $args = array(
            'order' => 'DESC',
            'post_type' => 'ourteam',
            'post_per_page' => -1,
        );

        $query = new WP_Query($args);

        ob_start();
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                get_template_part('template-parts/feed', 'ourteam');
            }
        }
        return ob_get_clean();
    }

    add_shortcode('umag-ourteam', 'umag_ourteam_shortcode');

    function umag_info_shortcode($atts, $content = "")
    {
        $atts = shortcode_atts(array(
            'title' => '',
            'icon' => '',
        ), $atts, 'umag-info');

        ob_start();
        ?>
        <!-- Single Contact Info -->
        <div class="single-contact-info d-flex align-items-center">
            <div class="icon mr-15">
                <i class="fa fa-<?= $atts['icon']; ?>" aria-hidden="true"></i>
            </div>
            <div class="text">
                <p><?= $atts['title'] ?></p>
                <h6><?= $content ?></h6>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

    add_shortcode('umag-info', 'umag_info_shortcode');


