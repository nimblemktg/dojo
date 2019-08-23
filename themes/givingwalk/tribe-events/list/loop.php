<?php

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
} ?>

<?php
global $post;
$events_layout = givingwalk_opt_events_layout();
$layout_cls = !empty($events_layout) ? 'layout-'.$events_layout : 'layout-default';
$wrp_cls= '';
if($events_layout == '1' || $events_layout == '2')
	$wrp_cls= 'row';

$itms_cls = '';
if($events_layout == '1'){
	$itms_cls = 'col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4';
}
if($events_layout == '2')
	$itms_cls = 'col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3';
?>

<div class="tribe-events-list-wrap <?php echo esc_attr($layout_cls);?> <?php echo esc_attr($wrp_cls);?>">

	<?php 
	$idx = 1;
	while ( have_posts() ) : the_post(); ?>
		
		<div id="post-<?php the_ID() ?>" class="tribe-events-items <?php echo esc_attr($itms_cls);?>" data-idx="<?php echo esc_attr($idx);?>">
			<?php tribe_get_template_part( 'list/single', 'event'.$events_layout ); ?>
		</div>

	<?php 
	$idx++;
	endwhile; ?>

</div><!-- .tribe-events-loop -->
