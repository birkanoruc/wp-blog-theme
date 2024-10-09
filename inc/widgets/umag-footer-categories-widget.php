<?php
    /**
     * Security Code To Block Access On Browser
     */
    if (!defined('ABSPATH')) {
        die();
    }

    // Adds widget: # Umag Categories Widget
    class Umag_Footer_Categories_Widget extends WP_Widget
    {

        function __construct()
        {
            parent::__construct(
                'umag_footer_categories_widget',
                esc_html__('# Umag Footer Categories Widget', 'umag'),
                array('description' => esc_html__('Show categories.', 'umag'),) // Args
            );
        }

        public function fields()
        {
            return array(
                array(
                    'label' => esc_html__('Category Count', 'umag'),
                    'id' => 'count',
                    'default' => '5',
                    'type' => 'number',
                ),
                array(
                    'label' => esc_html__('Order', 'umag'),
                    'id' => 'order',
                    'default' => 'name',
                    'type' => 'select',
                    'options' => array(
                        'name' => esc_html__('Sort by Name', 'umag'),
                        'count' => esc_html__('Sort by Popularity', 'umag'),
                    ),
                ),
                array(
                    'label' => esc_html__('Hide Empty Categories', 'umag'),
                    'id' => 'hide_empty',
                    'default' => 'yes',
                    'type' => 'checkbox',
                ),
                array(
                    'label' => esc_html__('Show Number of Articles', 'umag'),
                    'id' => 'show_articles_number',
                    'default' => 'yes',
                    'type' => 'checkbox',
                ),
            );
        }

        public function widget($args, $instance)
        {
            echo $args['before_widget'];

            if (!empty($instance['title'])) {
                echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
            }

            $count = !empty($instance['count']) ? $instance['count'] : 5;
            $hide_empty = !empty($instance['hide_empty']) ? $instance['hide_empty'] : false;

            $category_args = array(
                'taxonomy' => 'category',
                'number' => $count,
                'hide_empty' => $hide_empty,
            );

            if ('count' === $instance['count']) {
                $category_args['orderby'] = 'count';
            }

            $categories = get_terms($category_args);

            echo '<nav class="footer-widget-nav">';
            echo '<ul>';
            foreach ($categories as $category) {
                $count = !empty($instance['show_articles_number'])? ' <span>'.$category->count.'</span>' : '';
                echo '<li><a href="'. get_term_link($category->term_id) .'"><span><i class="fa fa-angle-double-right" aria-hidden="true"></i> '. $category->name.'</span>'.$count.'</a></li>';
            }
            echo '</ul>';
            echo '</nav>';

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
                    case 'checkbox':
                        $output .= '<p>';
                        $output .= '<input class="checkbox" type="checkbox" ' . checked($widget_value, true, false) . ' id="' . esc_attr($this->get_field_id($widget_field['id'])) . '" name="' . esc_attr($this->get_field_name($widget_field['id'])) . '" value="1">';
                        $output .= '<label for="' . esc_attr($this->get_field_id($widget_field['id'])) . '">' . esc_attr($widget_field['label'], 'umag') . '</label>';
                        $output .= '</p>';
                        break;
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

    function register_umag_footer_categories_widget()
    {
        register_widget('Umag_Footer_Categories_Widget');
    }

    add_action('widgets_init', 'register_umag_footer_categories_widget');