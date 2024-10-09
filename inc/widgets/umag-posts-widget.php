<?php

    /**
     * Security Code To Block Access On Browser
     */
    if (!defined('ABSPATH')) {
        die();
    }

// Adds widget: # Umag Posts Widget
    class Umag_Posts_Widget extends WP_Widget
    {

        function __construct()
        {
            parent::__construct(
                'umag_posts_widget',
                esc_html__('# Umag Posts Widget', 'umag'),
                array('description' => esc_html__('Display the articles according to the specified criteria.', 'umag'),) // Args
            );
        }

        public function fields()
        {
            return array(
                array(
                    'label' => esc_html__('Post Count', 'umag'),
                    'id' => 'post-count',
                    'default' => '5',
                    'type' => 'number',
                ),
                array(
                    'label' => esc_html__('Select Order', 'umag'),
                    'id' => 'orderby',
                    'default' => 'date',
                    'type' => 'select',
                    'options' => array(
                        'date' => esc_html__('Sort by date', 'umag'),
                        'rand' => esc_html__('Sort by random', 'umag'),
                        'comment_count' => esc_html__('Sort by comment count', 'umag'),
                    ),
                ),
                array(
                    'label' => esc_html__('Select Categories', 'umag'),
                    'id' => 'cat',
                    'type' => 'text',
                ),
                array(
                    'label' => esc_html__('Extra Class', 'umag'),
                    'id' => 'class',
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

            $count = !empty($instance['post-count']) ? $instance['post-count'] : 5;
            $orderby = !empty($instance['orderby']) ? $instance['orderby'] : 'date';
            $cat = !empty($instance['cat']) ? explode(',', $instance['cat']) : array();

            $class = !empty($instance['class']) ? ' '.$instance['class'] : '';

            $widget_query_args = array(
                'order' => 'DESC',
                'posts_per_page' => $count,
                'category__in' => $cat,
            );

            if ('date' === $orderby) {
                $widget_query_args['orderby'] = 'date';
            } else if ('rand' === $orderby) {
                $widget_query_args['orderby'] = 'rand';
            } else if ('comment_count' === $orderby) {
                $widget_query_args['orderby'] = 'comment_count';
            }

            $widget_query = new WP_Query($widget_query_args);

            if ($widget_query->have_posts()) {
                while ($widget_query->have_posts()) {
                    $widget_query->the_post();
                    ?>
                    <!-- Single Blog Post -->
                    <article <?php post_class('single-blog-post d-flex '.$class); ?> id="posts_widget-<?php the_ID(); ?>" >
                        <div class="post-thumbnail">
                            <?php the_post_thumbnail('umag_posts_widget'); ?>
                        </div>
                        <div class="post-content">
                            <a href="<?= get_the_permalink() ?>" class="post-title"><?php the_title() ?></a>
                            <div class="post-meta d-flex justify-content-between">
                                <?= umag_post_meta() ?>
                            </div>
                        </div>
                    </article>
                    <?php
                }
            } else {
                /* En basit derecede giriş yapmış kullanıcı kontrolü */
                if (current_user_can('manage_options')) {
                    printf( /* translators: %s: Yeni Yazı Ekle Linki */
                        __('<div class="alert alert-danger" role="alert">Post is null. <a href="%s">Create Post </a></div>', 'umag'), admin_url() . 'post-new.php');
                }
            }
            wp_reset_postdata();
            echo $args['after_widget'];
        }


        public
        function field_generator($instance)
        {
            $output = '';
            foreach ($this->fields() as $widget_field) {
                $default = '';
                if (isset($widget_field['default'])) {
                    $default = $widget_field['default'];
                }
                $widget_value = !empty($instance[$widget_field['id']]) ? $instance[$widget_field['id']] : esc_html__($default, 'umag');
                switch ($widget_field['type']) {
                    case 'select':
                        $output .= '<p>';
                        $output .= '<label for="' . esc_attr($this->get_field_id($widget_field['id'])) . '">' . esc_attr($widget_field['label'], 'textdomain') . ':</label> ';
                        $output .= '<select id="' . esc_attr($this->get_field_id($widget_field['id'])) . '" name="' . esc_attr($this->get_field_name($widget_field['id'])) . '">';
                        foreach ($widget_field['options'] as $key => $value) {
                            if ($widget_value == $key) {
                                $output .= '<option value="' . $key . '" selected>' . $value . '</option>';
                            } else {
                                $output .= '<option value="' . $key . '">' . $value . '</option>';
                            }
                        }
                        $output .= '</select>';
                        $output .= '</p>';
                        break;
                    default:
                        $output .= '<p>';
                        $output .= '<label for="' . esc_attr($this->get_field_id($widget_field['id'])) . '">' . esc_attr($widget_field['label'], 'umag') . ':</label> ';
                        $output .= '<input class="widefat" id="' . esc_attr($this->get_field_id($widget_field['id'])) . '" name="' . esc_attr($this->get_field_name($widget_field['id'])) . '" type="' . $widget_field['type'] . '" value="' . esc_attr($widget_value) . '">';
                        $output .= '</p>';
                }
            }
            echo $output;
        }

        public
        function form($instance)
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

        public
        function update($new_instance, $old_instance)
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

    function umag_register_posts_widget()
    {
        register_widget('Umag_Posts_Widget');
    }

    add_action('widgets_init', 'umag_register_posts_widget');