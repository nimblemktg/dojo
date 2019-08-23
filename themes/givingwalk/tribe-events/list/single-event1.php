<?php

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$venue_id = tribe_get_venue_id();

$organizer_ids = tribe_get_organizer_ids();

$organic_name = array();

$phone = tribe_get_organizer_phone();

?>
<div class="event-content-wrap">
	<?php 
	if(has_post_thumbnail()){
		echo givingwalk_get_image_crop( get_post_thumbnail_id(get_the_ID()), '555x405'); 
	}
	?>
	<div class="event-info">
		<h3 class="list-event-title">
			<a class="tribe-event-url" href="<?php echo esc_url( tribe_get_event_link() ); ?>" title="<?php the_title_attribute() ?>" rel="bookmark">
				<?php the_title() ?>
			</a>
		</h3>
		<div class="events-schedule">
			<?php if($venue_id){ 
                $location_add = tribe_get_address( $venue_id );
                if(!empty($location_add))
                    echo '<p class="location"><i class="flaticon-signs"></i>'.esc_html($location_add).'</p>';
            }?>
            <p class="schedule-date"><i class="fa fa-calendar"></i><?php echo tribe_get_start_date(null,true,'M d, Y',null); ?> - <?php echo tribe_get_end_date(null,true,'M d, Y',null); ?></p>
            <?php if(!empty($phone)): ?>
            	<p class="phone"><i class="flaticon-phone-call"></i><?php echo esc_html( $phone ); ?></p>
            <?php endif; ?>
 
        </div>
        <?php 
        if(count($organizer_ids) > 0){
        	echo '<div class="org-wrap">';
        	foreach ( $organizer_ids as $organizer ) {
			    if ( ! $organizer ) {
			        continue;
			    }
			    $meta = apply_filters('ef4_get_post_meta',['avatar_image'=>''],$organizer,true);

			    $organizer_post = get_post($organizer);
			    echo '<div class="org-item">';
			    	echo '<div class="org-avatar">';
	                    echo '<img src="'.wp_get_attachment_url($meta['avatar_image']).'" alt="org-avatar" />';
	                echo '</div>';
	                echo '<div class="org-info">';
	                	echo '<h4>'.esc_html( $organizer_post->post_title).'</h4>';
	                	echo '<p>'. esc_html__('Organizer','givingwalk').'</p>';
	                echo '</div>';
			    echo '</div>';
			}
			echo '</div>';
		}
        ?>
	</div>
</div>
