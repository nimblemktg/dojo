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

	$meta = apply_filters('ef4_get_post_meta',['donation_raised'=>''],get_the_ID(),false);
	$raised = $meta['donation_raised'];
	$default_amount = '$'.$raised;
    $amount_value = apply_filters('ef4_payment_create_amount',$default_amount,$raised);
?>
<article <?php post_class('entry-archive grid-item'); ?>>
	<?php 
	givingwalk_post_thumbnail('medium');
	?>
	<div class="entry-info">
		<?php the_terms( get_the_ID(), 'crw_causes_cat', '<div class="causes-cats">', ', ', '</div>'); ?>
		<?php the_title( '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h4>' ); ?>
		<div class="stories-desc">
			<?php the_excerpt(); ?>
		</div>
		<div class="donation-value">
            <span class="lbl"><?php echo esc_html__('Raised:','givingwalk');?></span>
            <span class="value"><?php echo esc_html($amount_value);?></span>
        </div>
        <?php givingwalk_show_donate_button(['title'=>'<i class="fa fa-heart"></i>','class'=>'give-btn']) ?>
	</div>
</article>
