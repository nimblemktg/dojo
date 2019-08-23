<?php 

class recent_news extends WP_Widget {

function __construct() {

parent::__construct(

// Base ID of your widget

'recent_news', 

// Widget name will appear in UI

esc_html__('OT Recent Posts', 'consultax'), 

// Widget description

array( 'description' => esc_html__( 'OT Recent Posts', 'consultax' ), ) 

);

}

// This is where the action happens

public function widget( $args, $instance ) {

	// these are the widget options

	//$title = apply_filters( 'widget_title', $instance['title'] );

    $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? esc_html__( 'Latest News', 'consultax' ) : $instance['title'], $instance, $this->id_base );

	$date = ! empty( $instance['count'] ) ? '1' : '0';

// before and after widget arguments are defined by themes

echo htmlspecialchars_decode($args['before_widget']);

if ( ! empty( $title ) ){

	echo htmlspecialchars_decode($args['before_title']) . $title . htmlspecialchars_decode($args['after_title']); 

}?>
        <ul class="recent-news clearfix">
            <?php 

            $recent = new WP_Query( array(

            'post_type' => 'post', 

            'posts_per_page' => $instance['posts_per_page']

              ) );

            while ($recent->have_posts()) :$recent-> the_post();?>  
            <li class="clearfix <?php if( !has_post_thumbnail() ) echo "not-thumb"; ?>"> 
                <?php if(has_post_thumbnail()) { ?>
                <div class="thumb">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail( 'consultax-recent-post-thumbnail' ); ?>
                    </a>
                </div>
                <?php } ?>
                <div class="entry-header">
                    <h6>
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h6>
                    <?php if($date) { ?>
                    <span class="post-on">
                        <span class="entry-date"><?php the_time( get_option( 'date_format' ) ); ?></span>
                    </span>
                    <?php } ?>
                </div>
            </li>
            <?php endwhile; ?>
        </ul>

<?php 

echo htmlspecialchars_decode($args['after_widget']);

}

public function update( $new_instance, $old_instance ) {

    $instance = $old_instance;

    $instance['title'] = strip_tags($new_instance['title']);

    $instance['count'] = !empty($new_instance['count']) ? 1 : 0;

    $instance['posts_per_page'] = ( ! empty( $new_instance['posts_per_page'] ) ) ? strip_tags( $new_instance['posts_per_page'] ) : '';

    return $instance;

}

// Widget Backend 

public function form( $instance ) {

// Check values

	 $title = isset( $instance['title'] ) ? $instance['title'] : esc_html( 'Latest News', 'consultax' );

	 $count = isset($instance['count']) ? (bool) $instance['count'] :false;

     $posts_per_page = isset( $instance['posts_per_page'] ) ? $instance['posts_per_page'] : 3;

// Widget admin form

?>

<p>
    <label><?php esc_html_e( 'Title:', 'consultax' ); ?></label>

    <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
</p>
<p>

    <label><?php esc_html_e( 'Number of posts to show:', 'consultax' ); ?></label> 

    <input size="3" class="widefat" id="<?php echo esc_attr($this->get_field_id('posts_per_page')); ?>" name="<?php echo esc_attr($this->get_field_name('posts_per_page')); ?>" type="text" value="<?php echo esc_attr($posts_per_page); ?>" />
    <br />
</p>
<p>
    <label>
        <input type="checkbox" class="checkbox" id="<?php echo esc_attr($this->get_field_id('count')); ?>" name="<?php echo esc_attr($this->get_field_name('count')); ?>"<?php checked( $count ); ?> />

        <?php esc_html_e( 'Show date time', 'consultax' ); ?>
    </label>
</p>

<?php

}

} // Class wpb_widget ends here

// Register and load the widget

function wpb_recent_news() {

	register_widget( 'recent_news' );

}

add_action( 'widgets_init', 'wpb_recent_news' );