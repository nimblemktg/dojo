<?php
/**
 * Widget API: givingwalk_Widget_Search class
 *
 * @package SpyroPress
 * @subpackage GivingWalk
 * @since 1.0.0
 */
if (!class_exists('EF4Framework')) return;
add_action('widgets_init', 'givingwalk_Widget_Search');       

function givingwalk_Widget_Search() {
    register_ef4_widget('givingwalk_Widget_Search');
}

/**
 * Core class used to implement a Search widget.
 *
 * @since 2.8.0
 *
 * @see WP_Widget
 */
class givingwalk_Widget_Search extends WP_Widget {

	/**
	 * Sets up a new Search widget instance.
	 *
	 * @since 2.8.0
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'givingwalk_search',
			'description' => esc_html__( 'A search form for your site.','givingwalk' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 
			'givingwalk_Widget_Search', 
			esc_html__( 'Givingwalk Search', 'givingwalk' ), 
			$widget_ops 
		);
	}

	/**
	 * Outputs the content for the current Search widget instance.
	 *
	 * @since 2.8.0
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Search widget instance.
	 */
	public function widget( $args, $instance ) {
		extract($args);

		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$show_popup = (int) $instance['show_popup'];

		echo wp_kses_post($args['before_widget']);
		if ( $title ) {
			echo wp_kses_post($args['before_title']) . esc_html($title) . wp_kses_post($args['after_title']);
		}
		if(!$show_popup){
			/* Use current theme search form if it exists */
			get_search_form();
		} else {
		?>
			<a href="#mfp-<?php echo esc_attr($this->id);?>" class="mfp-inline"><i class="fa fa-search"></i></a>
			<div id="mfp-<?php echo esc_attr($this->id);?>" class="container white-popup mfp-hide">
				<div class="row">
					<div class="col-lg-6 offset-lg-3">
						<?php get_search_form(); ?>
					</div>
				</div>
			</div>			
		<?php 
		}

		echo wp_kses_post($args['after_widget']);
	}

	/**
	 * Outputs the settings form for the Search widget.
	 *
	 * @since 2.8.0
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '') );
		$title = $instance['title'];
		$show_popup   = isset($instance['show_popup']) ? esc_attr($instance['show_popup']) : '';
		?>
		<p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:','givingwalk'); ?> <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
		
		<p>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('show_popup') ); ?>" name="<?php echo esc_attr( $this->get_field_name('show_popup') ); ?>" <?php if($show_popup!='') echo 'checked="checked"'; ?> type="checkbox" value="1"  /><label for="<?php echo esc_attr($this->get_field_id('show_popup')); ?>"><?php esc_html_e( 'Show as Popup', 'givingwalk' ); ?></label>
        </p>

		<?php
	}

	/**
	 * Handles updating settings for the current Search widget instance.
	 *
	 * @since 2.8.0
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$new_instance = wp_parse_args((array) $new_instance, array( 'title' => ''));
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['show_popup']    = $new_instance['show_popup'];
		return $instance;
	}

}
