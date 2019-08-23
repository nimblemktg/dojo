<?php
/**
 * The default template for displaying content
 *
 * Used for index/archive/author/search.
 *
 * @package SpyroPress
 * @subpackage Giving Walk
 * @since 1.0.0
 */
?>
<?php
$post_format = get_post_format();
?>
<article <?php post_class('entry-archive entry-mask'); ?>>
	<?php 
		if(!$post_format){
			givingwalk_post_media(); 
			echo '<div class="entry-info">';
				givingwalk_archive_header('h2');
				givingwalk_archive_footer();
			echo '</div>';
		}else{
			givingwalk_post_media(); 
		}
		
	?>
</article>
 
