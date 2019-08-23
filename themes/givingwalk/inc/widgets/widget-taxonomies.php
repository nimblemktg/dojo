<?php
/**
 * Widget API: givingwalk_Widget_Taxonomies class
 *
 * @package WordPress
 * @subpackage Widgets
 * @since 4.4.0
 */

/**
 * Core class used to implement a Categories widget.
 *
 * @since 2.8.0
 *
 * @see WP_Widget
 */
if (!class_exists('EF4Framework')) return;
function givingwalk_Widget_Taxonomies() {
    register_ef4_widget('givingwalk_Widget_Taxonomies');
}
add_action('widgets_init', 'givingwalk_Widget_Taxonomies');

class givingwalk_Widget_Taxonomies extends WP_Widget {

	/**
	 * Sets up a new Categories widget instance.
	 *
	 * @since 2.8.0
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'widget_taxonomies widget_categories',
			'description' => esc_html__( 'A list of taxonomies.','givingwalk' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'taxonomies', esc_html__( 'Givingwalk Taxonomies','givingwalk' ), $widget_ops );
	}

	/**
	 * Outputs the content for the current Categories widget instance.
	 *
	 * @since 2.8.0
	 *
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Categories widget instance.
	 */
	public function widget( $args, $instance ) {
		$current_taxonomy = $this->_get_current_taxonomy( $instance );

		if ( ! empty( $instance['title'] ) ) {
			$title = $instance['title'];
		} else {
			if ( 'category' === $current_taxonomy ) {
				$title = esc_html__( 'Categories','givingwalk' );
			} else {
				$tax = get_taxonomy( $current_taxonomy );
				$title = $tax->labels->name;
			}
		}

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$c = ! empty( $instance['count'] ) ? '1' : '0';
		$h = ! empty( $instance['hierarchical'] ) ? '1' : '0';

		echo wp_kses_post($args['before_widget']);

		if ( $title ) {
			echo wp_kses_post($args['before_title'] . $title . $args['after_title']);
		}

		$cat_args = array(
			'orderby'      => 'name',
			'show_count'   => $c,
			'hierarchical' => $h,
			'taxonomy'	   => $current_taxonomy
		);
?>
		<ul>
<?php
		$cat_args['title_li'] = '';

		/**
		 * Filters the arguments for the Categories widget.
		 *
		 * @since 2.8.0
		 * @since 4.9.0 Added the `$instance` parameter.
		 *
		 * @param array $cat_args An array of Categories widget options.
		 * @param array $instance Array of settings for the current widget.
		 */
		wp_list_categories( apply_filters( 'widget_categories_args', $cat_args, $instance ) );
?>
		</ul>
<?php

		echo wp_kses_post($args['after_widget']);
	}

	/**
	 * Handles updating settings for the current Categories widget instance.
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
		$instance['count'] = !empty($new_instance['count']) ? 1 : 0;
		$instance['hierarchical'] = !empty($new_instance['hierarchical']) ? 1 : 0;
		$instance['taxonomy'] = stripslashes($new_instance['taxonomy']);

		return $instance;
	}

	/**
	 * Outputs the settings form for the Categories widget.
	 *
	 * @since 2.8.0
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		//Defaults
		$instance = wp_parse_args( (array) $instance, array( 'title' => '') );
		$title = sanitize_text_field( $instance['title'] );
		$count = isset($instance['count']) ? (bool) $instance['count'] :false;
		$hierarchical = isset( $instance['hierarchical'] ) ? (bool) $instance['hierarchical'] : false;

		$taxonomies = get_taxonomies( array( 'show_tagcloud' => true ), 'object' );
		$current_taxonomy = $this->_get_current_taxonomy($instance);
		$id = $this->get_field_id( 'taxonomy' );
		$name = $this->get_field_name( 'taxonomy' );
		?>
		<p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e( 'Title:','givingwalk' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

		<?php 
			printf(
				'<p><label for="%1$s">%2$s</label>' .
				'<select class="widefat" id="%1$s" name="%3$s">',
				$id,
				esc_html__( 'Taxonomy:', 'givingwalk' ),
				$name
			);

			foreach ( $taxonomies as $taxonomy => $tax ) {
				printf(
					'<option value="%s"%s>%s</option>',
					esc_attr( $taxonomy ),
					selected( $taxonomy, $current_taxonomy, false ),
					$tax->labels->name
				);
			}

			echo '</select></p>';
		?>

		<input type="checkbox" class="checkbox" id="<?php echo esc_attr($this->get_field_id('count')); ?>" name="<?php echo esc_attr($this->get_field_name('count')); ?>"<?php checked( $count ); ?> />
		<label for="<?php echo esc_attr($this->get_field_id('count')); ?>"><?php esc_html_e( 'Show post counts','givingwalk' ); ?></label><br />

		<input type="checkbox" class="checkbox" id="<?php echo esc_attr($this->get_field_id('hierarchical')); ?>" name="<?php echo esc_attr($this->get_field_name('hierarchical')); ?>"<?php checked( $hierarchical ); ?> />
		<label for="<?php echo esc_attr($this->get_field_id('hierarchical')); ?>"><?php esc_html_e( 'Show hierarchy','givingwalk' ); ?></label></p>
		<?php
	}
	/**
	 * Retrieves the taxonomy for the current Tag cloud widget instance.
	 *
	 * @since 4.4.0
	 *
	 * @param array $instance Current settings.
	 * @return string Name of the current taxonomy if set, otherwise 'post_tag'.
	 */
	public function _get_current_taxonomy($instance) {
		if ( !empty($instance['taxonomy']) && taxonomy_exists($instance['taxonomy']) )
			return $instance['taxonomy'];

		return 'category';
	}

}
