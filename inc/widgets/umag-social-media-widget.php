<?php

    /**
     * Security Code To Block Access On Browser
     */
    if (!defined('ABSPATH')) {
        die();
    }

    // Adds widget: # Umag Social Media Widget
    class Umag_Social_Media_Widget extends WP_Widget
    {

        function __construct()
        {
            parent::__construct(
                'umag_social_media_widget',
                esc_html__('# Umag Social Media Widget', 'umag'),
                array('description' => esc_html__('Add to Social Media Link', 'umag'),) // Args
            );
        }

        public  function fields(){
            return array(
                array(
                    'label' => esc_html__('Facebook Url','umag'),
                    'id' => 'facebook_url',
                    'default' => '#',
                    'type' => 'url',
                ),
                array(
                    'label' => esc_html__('Twitter Url','umag'),
                    'id' => 'twitter_url',
                    'default' => '#',
                    'type' => 'url',
                ),
                array(
                    'label' => esc_html__('Instagram Url','umag'),
                    'id' => 'instagram_url',
                    'default' => '#',
                    'type' => 'url',
                ),
                array(
                    'label' => esc_html__('LinkedIn Url','umag'),
                    'id' => 'linkedin_url',
                    'default' => '#',
                    'type' => 'url',
                ),
            );
        }

        public function widget($args, $instance)
        {
            echo $args['before_widget'];

            if (!empty($instance['title'])) {
                echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
            }

            echo '<div class="footer-social-info">';
            if(!empty($instance['facebook_url'])):
                echo '<a target="_blank" rel="nofollow" href="'. esc_url($instance['facebook_url']) .'" class="facebook"><i class="fa fa-facebook"></i></a>';
            endif;
            if(!empty($instance['instagram_url'])):
                echo '<a target="_blank" rel="nofollow" href="'. esc_url($instance['instagram_url']) .'" class="instagram"><i class="fa fa-instagram"></i></a>';
            endif;
            if(!empty($instance['twitter_url'])):
                echo '<a target="_blank" rel="nofollow" href="'. esc_url($instance['twitter_url']) .'" class="twitter"><i class="fa fa-twitter"></i></a>';
            endif;
            if(!empty($instance['linkedin_url'])):
                echo '<a target="_blank" rel="nofollow" href="'. esc_url($instance['linkedin_url']) .'" class="linkedin"><i class="fa fa-linkedin"></i></a>';
            endif;
            echo '</div>';

            echo $args['after_widget'];
        }

        public function field_generator($instance)
        {
            $output = '';
            foreach ($this->fields() as $widget_field) {
                $default = '';
                if (isset($widget_field['default'])) {
                    $default = $widget_field['default'];
                }
                $widget_value = !empty($instance[$widget_field['id']]) ? $instance[$widget_field['id']] : esc_html__($default, 'umag');
                switch ($widget_field['type']) {
                    default:
                        $output .= '<p>';
                        $output .= '<label for="' . esc_attr($this->get_field_id($widget_field['id'])) . '">' . esc_attr($widget_field['label'], 'umag') . ':</label> ';
                        $output .= '<input class="widefat" id="' . esc_attr($this->get_field_id($widget_field['id'])) . '" name="' . esc_attr($this->get_field_name($widget_field['id'])) . '" type="' . $widget_field['type'] . '" value="' . esc_attr($widget_value) . '">';
                        $output .= '</p>';
                }
            }
            echo $output;
        }

        public function form($instance)
        {
            $title = !empty($instance['title']) ? $instance['title'] : esc_html__('', 'umag');
            ?>
            <p>
                <label
                    for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_attr_e('Title:'); ?></label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>"
                       name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text"
                       value="<?php echo esc_attr($title); ?>">
            </p>
            <?php
            $this->field_generator($instance);
        }

        public function update($new_instance, $old_instance)
        {
            $instance = array();
            $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
            foreach ($this->fields() as $widget_field) {
                switch ($widget_field['type']) {
                    default:
                        $instance[$widget_field['id']] = (!empty($new_instance[$widget_field['id']])) ? strip_tags($new_instance[$widget_field['id']]) : '';
                }
            }
            return $instance;
        }
    }

    function register_umag_social_media_widget()
    {
        register_widget('Umag_Social_Media_Widget');
    }

    add_action('widgets_init', 'register_umag_social_media_widget');