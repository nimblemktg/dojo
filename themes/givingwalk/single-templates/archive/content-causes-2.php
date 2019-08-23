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
	$meta = apply_filters('ef4_get_post_meta',['donors'=>''],get_the_ID(),false);
	$donors = $meta['donors'];
?>
<article <?php post_class('entry-archive grid-item'); ?> onclick="">
	<?php 
	if( has_post_thumbnail()){
		$thumbnail = get_the_post_thumbnail(get_the_ID(),'medium');
		?>
        <div class="entry-media entry-thumbnail">
            <?php echo wp_kses_post( $thumbnail ); ?>
            <div class="donation-action">
                <?php givingwalk_show_donate_button(['class'=>'btn btn-alt']); ?>
            </div>
        </div>
        <?php
	}
	?>
	<div class="entry-info text-center">
		<?php if(!empty($donors)): ?>
			<div class="donors-people">
				<span class="lbl"><?php echo esc_html__('Donors:','givingwalk');?></span> <?php echo esc_html($donors); ?> <?php echo esc_html__('People','givingwalk');?>
			</div>
		<?php endif; ?>
		<?php the_title( '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h4>' ); ?>
		<?php givingwalk_causes_donate_amount_archive(); ?>
	</div>
</article>
