<?php
    if (!defined('ABSPATH')) {
        die();
    }

    function umag_do_login_form()
    {
        check_ajax_referer('login_action', 'login_field');

        $email = sanitize_email($_POST['email']);
        $password = sanitize_text_field($_POST['password']);
        $remember = isset($_POST['remember']);

        $creds = array(
          'user_login' => $email,
            'user_password'=> $password,
            'remember' => $remember,
        );

        $user = wp_signon($creds,is_ssl());

        if (is_wp_error($user))
        {
            wp_send_json_error(array(
                'message' => $user->get_error_message(),
                ));
            echo 'Hatalı Giriş';
            exit();
        }

        wp_send_json_success(array('message'=>esc_html__('Login successfully! Please wait...', 'umag')));
    }

    add_action('wp_ajax_nopriv_umag_do_login_form', 'umag_do_login_form');

    function umag_do_post_submit()
    {
        check_ajax_referer('submit_action', 'security');

        $thumbnail_id = media_handle_upload('thumbnail', 0);

        $title = sanitize_text_field($_POST['title']);
        $content = wp_kses_post($_POST['content']);
        $tags = sanitize_text_field($_POST['tags']);
        $category = (int) $_POST['category'];

        $post_fields = array(
            'post_author' => get_current_user_id(),
            'post_content' => $content,
            'post_title' => $title,
            'post_category' => array($category),
            'tags_input' => explode(',' , $tags),
        );

        $post_id = wp_insert_post($post_fields);

        if (is_wp_error($post_id)){
            wp_send_json_error(array('message' => $post_id->get_error_message()));
        }

        if(!is_wp_error($thumbnail_id)){
            set_post_thumbnail($post_id,$thumbnail_id);
        }

        wp_send_json_success(array('message' => esc_html__('Your article has been sent! It will be published after approval.','umag')));

    }

    add_action('wp_ajax_umag_do_post_submit', 'umag_do_post_submit');
