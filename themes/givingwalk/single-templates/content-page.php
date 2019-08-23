<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package SpyroPress
 * @subpackage Giving Walk
 * @since 1.0.0
 */
?>
<article <?php post_class(); ?>>

	<?php 
		givingwalk_post_media();
	?>
	<div class="entry-content clearfix">
		<?php
		the_content();
		wp_link_pages( array(
			'before'      => '<div class="page-links clearfix"><span class="page-links-title">' . esc_html__( 'Pages:', 'givingwalk' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
		) );
		?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
