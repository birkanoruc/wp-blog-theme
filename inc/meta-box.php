<?php
    if (!defined('ABSPATH')) {
        die();
    }


    function umag_video_format_meta_boxes()
    {
        acf_add_local_field_group(array(
            'key' => 'umag_video_format_meta_boxes',
            'title' => esc_html__('Video Settings', 'umag'),
            'fields' => array(
                array(
                    'key' => 'video_duration',
                    'label' => esc_html__('Video Duration', 'umag'),
                    'name' => 'video_duration',
                    'type' => 'text',
                ),
                array(
                    'key' => 'video_iframe',
                    'label' => esc_html__('Video Iframe', 'umag'),
                    'name' => 'video_iframe',
                    'type' => 'textarea',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'post',
                    ),
                    array(
                        'param' => 'post_format',
                        'operator' => '==',
                        'value' => 'video',
                    ),
                ),
            ),

        ));
    }

    add_action('acf/init', 'umag_video_format_meta_boxes');


    function umag_category_meta_boxes()
    {
        acf_add_local_field_group(array(
            'key' => 'umag_category_meta_boxes',
            'title' => esc_html__('Category Extra Settings', 'umag'),
            'fields' => array(
                array(
                    'key' => 'cat_image',
                    'label' => esc_html__('Category Image', 'umag'),
                    'name' => 'cat_image',
                    'type' => 'image',
                    'return_format' => 'id',
                    'previev_size' => 'medium',
                    'library' => 'all',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'taxonomy',
                        'operator' => '==',
                        'value' => 'category',
                    ),
                ),
            ),
        ));
    }

    add_action('acf/init', 'umag_category_meta_boxes');

    function umag_our_team_meta_boxes()
    {
        acf_add_local_field_group(array(
            'key' => 'umag_our_team_meta_boxes',
            'title' => esc_html__('Team Settings', 'umag'),
            'fields' => array(
                array(
                    'key' => 'job',
                    'label' => esc_html__('Job', 'umag'),
                    'name' => 'job',
                    'type' => 'text',
                ),
                array(
                    'key' => 'facebook',
                    'label' => esc_html__('facebook', 'umag'),
                    'name' => 'facebook',
                    'type' => 'text',
                ),
                array(
                    'key' => 'twitter',
                    'label' => esc_html__('twitter', 'umag'),
                    'name' => 'twitter',
                    'type' => 'text',
                ),
                array(
                    'key' => 'linkedin',
                    'label' => esc_html__('linkedin', 'umag'),
                    'name' => 'linkedin',
                    'type' => 'text',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'ourteam',
                    ),
                ),
            ),

        ));
    }
    add_action('acf/init', 'umag_our_team_meta_boxes');
