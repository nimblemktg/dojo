<?php
/**
 * Month View Nav Template
 * This file loads the month view navigation.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/month/nav.php
 *
 * @package TribeEventsCalendar
 * @version 4.6.19
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$current_time = isset($_GET['eventDate']) ? strtotime($_GET['eventDate']) : time();
?>

<?php do_action( 'tribe_events_before_nav' ) ?>

<nav class="events-nav-pagination" aria-label="<?php esc_html_e( 'Calendar Month Navigation', 'givingwalk' ) ?>">
	<div class="events-sub-nav row align-items-center justify-content-between">
		<div class="events-nav-previous col-auto">
			<?php givingwalk_events_the_previous_month_link(); ?>
		</div>
		<div class="current-month col-auto">
			<?php echo '<span>'.wp_kses_post(date('F Y',$current_time)).'</span>'; ?>
		</div>
		<div class="events-nav-next col-auto">
			<?php givingwalk_events_the_next_month_link(); ?>
		</div>
	</div>
</nav>
<?php
do_action( 'tribe_events_after_nav' );
