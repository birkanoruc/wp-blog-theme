<?php
    /**
     * Security Code To Block Access On Browser
     */
    if (!defined('ABSPATH')) {
        die();
    }

// Adds widget: # Umag Social Media Followers Widget
    class Umag_Social_Media_Followers_Widget extends WP_Widget
    {

        function __construct()
        {
            parent::__construct(
                'umag_social_media_followers_widget',
                esc_html__('# Umag Social Media Followers Widget', 'umag'),
                array('description' => esc_html__('Show social media addresses.', 'umag'),) // Args
            );
        }

        public function fields()
        {
            return array(
                array(
                    'label' => esc_html__('Facebook URL', 'umag'),
                    'id' => 'facebook_url',
                    'default' => '#',
                    'type' => 'url',
                ),
                array(
                    'label' => esc_html__('Facebook Followers', 'umag'),
                    'id' => 'facebook_followers',
                    'default' => '100',
                    'type' => 'text',
                ),
                array(
                    'label' => esc_html__('Twitter URL', 'umag'),
                    'id' => 'twitter_url',
                    'default' => '#',
                    'type' => 'url',
                ),
                array(
                    'label' => esc_html__('Twitter Followers', 'umag'),
                    'id' => 'twitter_followers',
                    'default' => '100',
                    'type' => 'text',
                ),
                array(
                    'label' => esc_html__('YouTube URL', 'umag'),
                    'id' => 'youtube_url',
                    'default' => '#',
                    'type' => 'url',
                ),
                array(
                    'label' => esc_html__('YouTube Followers', 'umag'),
                    'id' => 'youtube_followers',
                    'default' => '100',
                    'type' => 'text',
                ),
            );
        }

        public function widget($args, $instance)
        {
            echo $args['before_widget'];

            if (!empty($instance['title'])) {
                echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
            }
            ?>
            <!-- Social Followers Info -->
            <div class="social-followers-info">
                <?php if (!empty($instance['facebook_followers'])): ?>
                    <a target="_blank" rel="nofollow" href="<?= esc_url($instance['facebook_url']) ?>" class="facebook-fans"><i class="fa fa-facebook"></i> <?= esc_html($instance['facebook_followers']) ?> <span><?= esc_html_x('Fans', 'social media followers widget', 'umag') ?></span></a>
                <?php endif; ?>
                <?php if (!empty($instance['twitter_followers'])): ?>
                    <a target="_blank" rel="nofollow" href="<?= esc_url($instance['twitter_url']) ?>" class="twitter-followers"><i class="fa fa-twitter"></i> <?= esc_html($instance['twitter_followers']) ?> <span><?= esc_html_x('Followers', 'social media followers widget', 'umag') ?></span></a>
                <?php endif; ?>
                <?php if (!empty($instance['youtube_followers'])): ?>
                    <a target="_blank" rel="nofollow" href="<?= esc_url($instance['youtube_url']) ?>" class="youtube-subscribers"><i class="fa fa-youtube"></i> <?= esc_html($instance['youtube_followers']) ?> <span><?= esc_html_x('Subscribers', 'social media followers widget', 'umag') ?></span></a>
                <?php endif; ?>
            </div>
            <?php
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

    function register_umag_social_media_followers_widget()
    {
        register_widget('Umag_Social_Media_Followers_Widget');
    }

    add_action('widgets_init', 'register_umag_social_media_followers_widget');