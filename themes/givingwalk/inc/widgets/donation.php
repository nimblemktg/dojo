<?php
/**
 * Widget API: givingwalk_Widget_Donation class
 *
 * @package SpyroPress
 * @subpackage GivingWalk
 * @since 1.0.0
 */
if (!class_exists('EF4Framework')) return;
add_action('widgets_init', 'givingwalk_Widget_Donation');       

function givingwalk_Widget_Donation() {
    register_ef4_widget('givingwalk_Widget_Donation');
}

/**
 * Core class used to implement a Search widget.
 *
 * @since 2.8.0
 *
 * @see WP_Widget
 */
class givingwalk_Widget_Donation extends WP_Widget {

	/**
	 * Sets up a new Search widget instance.
	 *
	 * @since 2.8.0
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'givingwalk-donation-wg',
			'description' => esc_html__( 'A donation form for your site.','givingwalk' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 
			'givingwalk_Widget_Donation', 
			esc_html__( 'Givingwalk Donation', 'givingwalk' ), 
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
		$args = wp_parse_args($args,[
		        'before_widget'=>'',
		        'before_title'=>'',
		        'after_title'=>'',
		        'after_widget'=>'',
        ]);
        $instance = wp_parse_args( (array) $instance, [
            'title' => '',
            'desc_chose' => '',
            'desc' => '',
            'post_chose' => '',
            'post_ids' => '',
        ] );
//        'random_causes'=>__('Random in Causes','givingwalk'),
//            'random_stories'=>__('Random in Stories','givingwalk'),
//            'random_all'=>__('Random in Causes ang Stories','givingwalk'),
        $post = '';
        $post_type_allow = ['crw_causes','crw_stories'];
        switch ($instance['post_chose'])
        {
            case 'random_causes':
                $query_args = [
                    'post_type'=>'crw_causes',
                    'posts_per_page'=>1,
                    'orderby'=>'rand'
                ];
                $wp_query = new WP_Query($query_args);
                if(count($wp_query->posts)>0)
                    $post = $wp_query->posts[0];
                break;
            case 'random_stories':
                $query_args = [
                    'post_type'=>'crw_stories',
                    'posts_per_page'=>1,
                    'orderby'=>'rand'
                ];
                $wp_query = new WP_Query($query_args);
                if(count($wp_query->posts)>0)
                    $post = $wp_query->posts[0];
                break;
            case 'random_all':
                $query_args = [
                    'post_type'=>$post_type_allow,
                    'posts_per_page'=>1,
                    'orderby'=>'rand'
                ];
                $wp_query = new WP_Query($query_args);
                if(count($wp_query->posts)>0)
                    $post = $wp_query->posts[0];
                break;
            case 'new_all':
                $query_args = [
                    'post_type'=>$post_type_allow,
                    'posts_per_page'=>1,
                    'orderby'=>'date',
                    'order'=>'DESC'
                ];
                $wp_query = new WP_Query($query_args);
                if(count($wp_query->posts)>0)
                    $post = $wp_query->posts[0];
                break;
            case 'new_causes':
                $query_args = [
                    'post_type'=>'crw_causes',
                    'posts_per_page'=>1,
                    'orderby'=>'date',
                    'order'=>'DESC'
                ];
                $wp_query = new WP_Query($query_args);
                if(count($wp_query->posts)>0)
                    $post = $wp_query->posts[0];
                break;
            case 'new_stories':
                $query_args = [
                    'post_type'=>'crw_stories',
                    'posts_per_page'=>1,
                    'orderby'=>'date',
                    'order'=>'DESC'
                ];
                $wp_query = new WP_Query($query_args);
                if(count($wp_query->posts)>0)
                    $post = $wp_query->posts[0];
                break;

            case 'id':
                $ids = explode(',',$instance['post_ids']);
                $id = $ids[rand(0,count($ids)-1)];
                if(is_numeric($id))
                    $post = get_post($id);
                break;

        }
		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		 
		echo wp_kses_post($args['before_widget']);
		if ( $title ) {
			echo wp_kses_post($args['before_title']) . esc_html($title) . wp_kses_post($args['after_title']);
		}
		echo '<div class="donation-wg-wrap">';

		    if($post instanceof WP_Post && in_array($post->post_type,$post_type_allow))
            {
                $desc = '';
                switch ($instance['desc_chose'])
                {
                    case '':
                        $desc = $instance['desc'];
                        break;
                    case 'post_excerpt':
                        $desc = $post->post_excerpt;
                        break;

                }
                echo '<h2 class="post-title">'.esc_html( $post->post_title ).'</h2>';
                if(!empty($desc)) echo '<p class="desc">'.esc_html($desc).'</p>';
                $meta = apply_filters('ef4_get_post_meta',[
                    'donation_raised'=>0
                ],$post,false);
                $raised = $meta['donation_raised'];
                $default_amount = '$'.$raised;
                $raised_value = apply_filters('ef4_payment_create_amount',$default_amount,$raised);
                if(!empty($raised_value)){
                    echo '<span class="amount-lbl">'.esc_html__('Raised:','givingwalk').'</span>';
                    echo '<h2 class="amount">'.esc_html($raised_value).'</h2>';
                }
                givingwalk_show_donate_button(['id'=>$post->ID,'class' => 'btn btn-white-alt']);
            }
            else
            {
                esc_html_e('Invalid source config','givingwalk');
            }

		echo '</div>';
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
		$instance = wp_parse_args( (array) $instance, [
		        'title' => '',
		        'desc_chose' => '',
		        'desc' => '',
		        'post_chose' => '',
		        'post_ids' => '',
        ] );
		$title = $instance['title'];
		$desc  = $instance['desc'];
		$desc_chose = $instance['desc_chose'];
		$show_popup   = isset($instance['show_popup']) ? esc_attr($instance['show_popup']) : '';
		$desc_allow = [
		        ''=>__('Custom description','givingwalk'),
		        'post_excerpt'=>__('Post Excerpt','givingwalk'),
        ];
		$post_chose =  $instance['post_chose'];
		$post_source_allow = [
            'id'=>__('Use Post id input','givingwalk'),
            'new_causes'=>__('Latest Causes','givingwalk'),
            'new_stories'=>__('Latest in Stories','givingwalk'),
            'new_all'=>__('Latest in  Causes or Stories','givingwalk'),
            'random_causes'=>__('Random in Causes','givingwalk'),
            'random_stories'=>__('Random in Stories','givingwalk'),
            'random_all'=>__('Random in Causes or Stories','givingwalk'),
        ];
		$post_ids = $instance['post_ids'];
		?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:','givingwalk'); ?> </label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('desc_chose')); ?>"><?php esc_html_e('Description Source:','givingwalk'); ?> </label>
            <select class="widefat" id="<?php echo esc_attr($this->get_field_id('desc_chose')); ?>" name="<?php echo esc_attr($this->get_field_name('desc_chose')); ?>">
                <?php foreach ($desc_allow as $value => $title){
                    ?><option value="<?php echo esc_attr($value) ?>" <?php selected($value,$desc_chose) ?>><?php echo esc_html($title) ?></option><?php
                } ?>
            </select>
        </p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('desc')); ?>"><?php esc_html_e('Custom description:','givingwalk'); ?> </label>
			<textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('desc')); ?>" name="<?php echo esc_attr($this->get_field_name('desc')); ?>"><?php echo esc_html($desc); ?></textarea>
		</p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('post_chose')); ?>"><?php esc_html_e('Data Source:','givingwalk'); ?> </label>
            <select class="widefat" id="<?php echo esc_attr($this->get_field_id('post_chose')); ?>" name="<?php echo esc_attr($this->get_field_name('post_chose')); ?>">
                <?php foreach ($post_source_allow as $value => $title){
                    ?><option value="<?php echo esc_attr($value) ?>" <?php selected($value,$post_chose) ?>><?php echo esc_html($title) ?></option><?php
                } ?>
            </select>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('post_ids')); ?>"><?php esc_html_e('Post Id:','givingwalk'); ?> </label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('post_ids')); ?>" name="<?php echo esc_attr($this->get_field_name('post_ids')); ?>" type="text" value="<?php echo esc_attr($post_ids); ?>" />
            <i><?php esc_html_e('Can input multiple id with comma as separator and will random in this value.','givingwalk') ?></i>
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
		$instance['desc'] = sanitize_text_field( $new_instance['desc'] ); 
		$instance['desc_chose'] = sanitize_text_field( $new_instance['desc_chose'] );
		$instance['post_chose'] = sanitize_text_field( $new_instance['post_chose'] );
		$instance['post_ids'] = sanitize_text_field( $new_instance['post_ids'] );
		return $instance;
	}

}
