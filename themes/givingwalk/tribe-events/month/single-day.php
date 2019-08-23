<?php

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$day = tribe_events_get_current_month_day();
$events_label = ( 1 === $day['total_events'] ) ? tribe_get_event_label_singular() : tribe_get_event_label_plural();
$date_label = date_i18n( tribe_get_date_option( 'dateWithoutYearFormat', 'F j' ), strtotime( $day['date'] ) )
?>
<div class="day-wrap">
	<!-- Day Header -->
	<div id="tribe-events-daynum-<?php echo esc_attr($day['daynum-id']) ?>">

		<?php if ( $day['total_events'] > 0 && tribe_events_is_view_enabled( 'day' ) ) : ?>
			<?php $view_day_label = sprintf( __( 'View %s', 'givingwalk' ), $date_label ); ?>
			<a href="<?php echo esc_url( tribe_get_day_link( $day['date'] ) ); ?>" aria-label="<?php echo esc_attr( $view_day_label ); ?>">
				<?php echo esc_html($day['daynum']); ?>
			</a>
		<?php else : ?>
			<?php echo esc_html($day['daynum']); ?>
		<?php endif; ?>

	</div>

	<!-- Events List -->
	<?php while ( $day['events']->have_posts() ) : $day['events']->the_post(); ?>
		<?php tribe_get_template_part( 'month/single', 'event' ) ?>
	<?php endwhile; ?>

	<!-- View More -->
	<?php 
	$total_events = $day['total_events'];
	if ( $day['view_more'] ) : ?>
		<div class="tribe-events-viewmore">
			<?php

				$view_all_label = sprintf(
					_n(
						'View %1$s %2$s',
						'View All %1$s %2$s',
						$total_events,
						'givingwalk'
					),
					$total_events,
					$events_label
				);

				$view_all_aria_label = sprintf( __( '%s for %s', 'givingwalk' ), $view_all_label, $date_label );
			?>
			<a href="<?php echo esc_url( $day['view_more'] ); ?>" aria-label="<?php echo esc_attr( $view_all_aria_label ); ?>">
				<?php echo wp_kses_post($view_all_label); ?> &raquo;
			</a>
		</div>
	<?php
	endif;
	?>
</div>

