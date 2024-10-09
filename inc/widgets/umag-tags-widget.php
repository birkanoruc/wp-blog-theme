<?php
    /**
     * Security Code To Block Access On Browser
     */
    if (!defined('ABSPATH')) {
        die();
    }

    class Umag_Tags_Widget extends WP_Widget {

        function __construct() {
            parent::__construct(
                'umag_tags_widget',
                esc_html__( '# Umag Tags Widget', 'umag' ),
                array( 'description' => esc_html__( 'Add to Tags', 'umag' ), ) // Args
            );
        }

        public function fields(){
            return array(
                array(
                    'label' => esc_html__('Tag Count', 'umag'),
                    'id' => 'count',
                    'default' => '10',
                    'type' => 'number',
                ),
            );
        }

        public function widget( $args, $instance ) {
            echo $args['before_widget'];

            if ( ! empty( $instance['title'] ) ) {
                echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
            }

            $count = !empty($instance['count']) ? $instance['count'] : 10 ;

            $terms_args=array(
                'taxonomy' => 'post_tag',
                'orderby' => 'count',
                'hide_empty' => false,
                'number' => $count,
            );
            $tags = get_terms($terms_args);

            if(is_wp_error($tags)){
                echo $tags->get_error_message();
            }else{
                echo '<ul class="footer-tags">';
                foreach ($tags as $tag){
                    echo '<li><a href="'.get_term_link($tag->term_id).'">'.$tag->name.'</a></li>';
                }
                echo '</ul>';
            }

            echo $args['after_widget'];
        }

        public function field_generator( $instance ) {
            $output = '';
            foreach ( $this->fields() as $widget_field ) {
                $default = '';
                if ( isset($widget_field['default']) ) {
                    $default = $widget_field['default'];
                }
                $widget_value = ! empty( $instance[$widget_field['id']] ) ? $instance[$widget_field['id']] : esc_html__( $default, 'umag' );
                switch ( $widget_field['type'] ) {
                    default:
                        $output .= '<p>';
                        $output .= '<label for="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'">'.esc_attr( $widget_field['label'], 'umag' ).':</label> ';
                        $output .= '<input class="widefat" id="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'" name="'.esc_attr( $this->get_field_name( $widget_field['id'] ) ).'" type="'.$widget_field['type'].'" value="'.esc_attr( $widget_value ).'">';
                        $output .= '</p>';
                }
            }
            echo $output;
        }

        public function form( $instance ) {
            $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( '', 'umag' );
            ?>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:',  ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
            </p>
            <?php
            $this->field_generator( $instance );
        }

        public function update( $new_instance, $old_instance ) {
            $instance = array();
            $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
            foreach ( $this->fields() as $widget_field ) {
                switch ( $widget_field['type'] ) {
                    default:
                        $instance[$widget_field['id']] = ( ! empty( $new_instance[$widget_field['id']] ) ) ? strip_tags( $new_instance[$widget_field['id']] ) : '';
                }
            }
            return $instance;
        }
    }

    function register_umag_tags_widget() {
        register_widget( 'Umag_Tags_Widget' );
    }
    add_action( 'widgets_init', 'register_umag_tags_widget' );