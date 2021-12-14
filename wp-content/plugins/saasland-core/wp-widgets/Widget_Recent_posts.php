<?php
/**
 * Widget API: WP_Widget_Recent_Posts class
 *
 * @package WordPress
 * @subpackage Widgets
 * @since 4.4.0
 */

/**
 * Core class used to implement a Recent Posts widget.
 *
 * @since 2.8.0
 *
 * @see WP_Widget
 */
class Widget_Recent_posts extends WP_Widget {

	/**
	 * Sets up a new Recent Posts widget instance.
	 *
	 * @since 2.8.0
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'recent_post_widget_two',
			'description' => esc_html__( 'Your site&#8217;s most recent Posts.', 'saasland-core' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'recent-posts', esc_html__( 'Recent Posts', 'saasland-core' ), $widget_ops );
		$this->alt_option_name = 'widget_recent_entries';
	}

	/**
	 * Outputs the content for the current Recent Posts widget instance.
	 *
	 * @since 2.8.0
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Recent Posts widget instance.
	 */
	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Recent Posts', 'saasland-core' );

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number ) {
			$number = 5;
		}

		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : true;

		/**
		 * Filters the arguments for the Recent Posts widget.
		 *
		 * @since 3.4.0
		 * @since 4.9.0 Added the `$instance` parameter.
		 *
		 * @see WP_Query::get_posts()
		 *
		 * @param array $args     An array of arguments used to retrieve the recent posts.
		 * @param array $instance Array of settings for the current widget.
		 */
		$r = new WP_Query( apply_filters( 'widget_posts_args', array(
			'posts_per_page'      => $number,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
		), $instance ) );

		if ( ! $r->have_posts() ) {
			return;
		}
		$allowed_tags = array(
            'div' => array(
                'class' =>array(),
                'id' => array()
            ),
            'h4' => array(
                'class' =>array(),
                'id' => array()
            ),
            'h2' => array(
                'class' =>array(),
                'id' => array()
            ),
            'h3' => array(
                'class' =>array(),
                'id' => array()
            ),
        );

		echo wp_kses($args['before_widget'], $allowed_tags);

		if ( $title ) {
			echo wp_kses($args['before_title'] . $title . $args['after_title'], $allowed_tags);
		}

		foreach ( $r->posts as $recent_post ) :
            $post_title = get_the_title( $recent_post->ID );
            $title      = ( ! empty( $post_title ) ) ? $post_title : esc_html__( '(no title)', 'saasland-core' );
            $title_length = function_exists('get_field') ? get_field( 'title_length',  'widget_'.$args['widget_id']) : 24;
            if ( !isset($title_length) ) {
                $title_length = 24;
            }
            ?>
            <div <?php post_class( 'media post_item') ?>>
                <a href="<?php the_permalink( $recent_post->ID ); ?>">
                    <?php
                    if ( has_post_thumbnail($recent_post->ID) ) {
                        echo get_the_post_thumbnail( $recent_post->ID, 'saasland_85x70', array( 'class' => 'media-object' ) );
                    }
                    ?>
                </a>
                <div class="media-body">
                    <a href="<?php the_permalink( $recent_post->ID ); ?>" title="<?php echo esc_attr($title); ?>">
                        <h3> <?php saaslandCore_limit_latter($title, $title_length, ''); ?> </h3>
                    </a>
                    <?php
                    if ( $show_date ) : ?>
<!--                        
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>

		<?php
		echo wp_kses($args['after_widget'], $allowed_tags);
	}

	/**
	 * Outputs the settings form for the Recent Posts widget.
	 *
	 * @since 2.8.0
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$title          = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number         = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$length   = isset( $instance['length'] ) ? absint( $instance['length'] ) : 24;
		$show_date      = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : true;
        ?>
		<p><label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:', 'saasland-core' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<p><label for="<?php echo esc_attr($this->get_field_id( 'number' )); ?>"><?php esc_html_e( 'Number of Posts to Show:', 'saasland-core' ); ?></label>
		<input class="tiny-text" id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" type="number" step="1" min="1" value="<?php echo esc_attr($number); ?>" size="4" /></p>

        <p><input class="checkbox" type="checkbox"<?php esc_attr(checked( $show_date )); ?> id="<?php echo esc_attr($this->get_field_id( 'show_date' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show_date' )); ?>" />
            <label for="<?php echo esc_attr($this->get_field_id( 'show_date' )); ?>"><?php esc_html_e( 'Display Post Date?', 'saasland-core' ); ?></label></p>
        <?php
	}

    /**
     * Handles updating the settings for the current Recent Posts widget instance.
     *
     * @since 2.8.0
     *
     * @param array $new_instance New settings for this instance as input by the user via
     *                            WP_Widget::form().
     * @param array $old_instance Old settings for this instance.
     * @return array Updated settings to save.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = sanitize_text_field( $new_instance['title'] );
        $instance['number'] = (int) $new_instance['number'];
        $instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
        return $instance;
    }
}



