<?php

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$venue_id = tribe_get_venue_id();

$organizer_ids = tribe_get_organizer_ids();

$organic_name = array();
foreach ( $organizer_ids as $organizer ) {
    if ( ! $organizer ) {
        continue;
    }
    $organizer_post = get_post($organizer);
    $organic_name[] = $organizer_post->post_title;
}

?>
<div class="event-content-wrap">
	<div class="event-date">
        <span class="event-day"><?php echo get_the_date('d');?></span>
        <span class="event-month"><?php echo get_the_date('M');?></span>
    </div>
    <div class="org-name"><span><?php echo esc_html__('Organized By:','givingwalk');?></span> <?php echo join(', ',$organic_name); ?></div>
    <h4 class="list-event-title">
		<a class="tribe-event-url" href="<?php echo esc_url( tribe_get_event_link() ); ?>" title="<?php the_title_attribute() ?>" rel="bookmark">
			<?php the_title() ?>
		</a>
	</h4>
	<div class="list-event-action">
		<?php if($venue_id){ 
            $location_add = tribe_get_address( $venue_id );
            if(!empty($location_add))
                echo '<p class="location"><i class="flaticon-signs"></i>'.esc_html($location_add).'</p>';
        }?>
        <?php givingwalk_show_buy_ticket_button();?>
	</div>
</div>
