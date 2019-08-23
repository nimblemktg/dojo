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

<article <?php post_class('entry-archive entry-default'); ?>>
	<div class="entry-info">
		<?php givingwalk_archive_header('h2'); ?>
		<div class="entry-summary">
			<?php
				the_excerpt();

				wp_link_pages( array(
					'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'givingwalk' ),
					'after'       => '</div>',
					'link_before' => '<span class="page-number">',
					'link_after'  => '</span>',
				) );
			?>
		</div>
		<?php givingwalk_archive_footer(); ?>
	</div>
</article>
