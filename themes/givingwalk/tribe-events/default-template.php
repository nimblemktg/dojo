<?php
/**
 * Default Events Template
 * This file is the basic wrapper template for all the views if 'Default Events Template'
 * is selected in Events -> Settings -> Template -> Events Template.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/default-template.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

get_header();
$events_layout = givingwalk_opt_events_layout();
if(empty($events_layout) || is_singular( 'tribe_events' ))
	$class = 'col-12 col-xl-10 offset-xl-1';
else 
	$class = 'col-12';

if(tribe_is_month() || tribe_is_day() || tribe_is_venue())
	$class = 'col-12';	
?>

<div id="content-area" class="content-area <?php echo esc_attr($class);?>">
    <div id="tribe-events-pg-template" class="tribe-events-pg-template">
    	<?php tribe_events_before_html(); ?>
    	<?php tribe_get_view(); ?>
    	<?php tribe_events_after_html(); ?>
    </div>  
</div>
<?php
get_footer();

