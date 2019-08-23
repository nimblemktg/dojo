<?php
/**
 * Header Default
 * @package SpyroPress
 * @subpackage Giving Walk
 * @since 1.0.0
 */
?>

<div id="red-header" class="<?php givingwalk_header_class(); ?>">
	<div class="red-header-outer">
		<div class="<?php givingwalk_header_inner_class(); ?>">
			<div class="row align-items-center justify-content-between">
		    	<?php givingwalk_header_logo('col-auto'); ?>
			    <div class="header-menu-right col-auto">
			    	<div class="row align-items-center justify-content-between">
			    		<?php
				    		givingwalk_header_navigation('col-auto');
				        	givingwalk_header_extra('col-auto');
				    	?>
			    	</div>
			    </div>
		    </div>
		</div>
	</div>
</div>