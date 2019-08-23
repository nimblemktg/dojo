<?php
/**
 * The default template for displaying content
 *
 * Used for single 
 *
 * @package SpyroPress
 * @subpackage Giving Walk
 * @since 1.0.0
 */
$template = givingwalk_single_post_template();
$class = 'no-thumbnail';
if( has_post_thumbnail() && !post_password_required() && !is_attachment() &&  wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'large')){
	$class = 'has-thumbnail';
}
$post_format = get_post_format();
?>

<article <?php post_class(); ?>> 
	<div class="single-top-wrap <?php echo esc_attr($class);?>">
		<?php 
			givingwalk_post_media('large');
			if(empty($post_format))
				givingwalk_single_header();
		?>
	</div>
	
	<div class="entry-content clearfix">
		<?php
		if(!empty($post_format))
			the_title( '<h2 class="single-title">', '</h2>' );

		givingwalk_single_author_cats();
		the_content();

		wp_link_pages( array(
			'before'      => '<div class="page-links clearfix"><span class="page-links-title">' . esc_html__( 'Pages:', 'givingwalk' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
		) );
		?>
	</div><!-- .entry-content -->
	<?php givingwalk_single_footer(); ?>
</article><!-- #post-## -->
