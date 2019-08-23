<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
?>

<div id="tribe-events-content" class="tribe-events-list">

	<!-- Notices -->
	<?php tribe_the_notices() ?>
	
	<!-- Events Loop -->
	<?php if ( have_posts() ) : ?>
		
		<?php tribe_get_template_part( 'list/loop' ) ?>
	
	<?php endif; ?>
	<?php givingwalk_paging_nav(); ?>
	 

</div><!-- #tribe-events-content -->