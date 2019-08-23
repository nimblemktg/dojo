<?php
/**
 * Please see single-event.php in this directory for detailed instructions on how to use and modify these templates.
 *
 * Override this template in your own theme by creating a file at:
 *
 *     [your-theme]/tribe-events/month/mobile.php
 *
 * @version  4.3.5
 */
?>

<script type="text/html" id="tribe_tmpl_month_mobile_day_header">
	<div class="tribe-mobile-day" data-day="[[=date]]">[[ if(has_events) { ]]
		<h3 class="tribe-mobile-day-heading">[[=i18n.for_date]] <span>[[=raw date_name]]</span></h3>[[ } ]]
	</div>
</script>

<script type="text/html" id="tribe_tmpl_month_mobile">
	<div class="tribe-events-mobile tribe-clearfix tribe-events-mobile-event-[[=eventId]][[ if(categoryClasses.length) { ]] [[= categoryClasses]][[ } ]]">
		[[ if(imageSrc.length) { ]]
		<div class="mobile-event-image">
			<a href="[[=permalink]]" title="[[=title]]">
				<img src="[[=imageSrc]]" alt="[[=title]]" title="[[=title]]">
			</a>
		</div>
		[[ } ]]
		<h4 class="mobile-event-title">
			<a class="url" href="[[=permalink]]" title="[[=title]]" rel="bookmark">[[=raw title]]</a>
		</h4>
		<div class="mobile-event-schedule-details">
			<span class="tribe-event-date-start">[[=dateDisplay]] </span>
		</div>
		[[ if(excerpt.length) { ]]
		<div class="mobile-event-description"> [[=raw excerpt]] </div>
		[[ } ]]
		<a href="[[=permalink]]" class="btn tribe-events-read-more" rel="bookmark">[[=i18n.find_out_more]]</a>
	</div>
</script>
