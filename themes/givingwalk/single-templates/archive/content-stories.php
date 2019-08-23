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
$meta = apply_filters('ef4_get_post_meta', [
    'location'        => '',
    'donation_raised' => ''
], get_the_ID(), false);
$raised = $meta['donation_raised'];
$default_amount = '$' . $raised;
$raised_value = apply_filters('ef4_payment_create_amount', $default_amount, $raised);
?>
<article <?php post_class('entry-archive grid-item'); ?>>
    <?php
    if (has_post_thumbnail()) {
        echo givingwalk_get_image_crop(get_post_thumbnail_id(get_the_ID()), '570x640');
    }
    ?>
    <div class="entry-info">
        <?php givingwalk_post_share_popup(false); ?>
        <div class="top-wrap align-self-start">
            <?php if (!empty($meta['location'])): ?>
                <span class="location"><?php echo esc_html($meta['location']); ?></span>
            <?php endif; ?>
            <?php the_title( '<h2 class="archive-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' ); ?>
        </div>
        <div class="bottom-wrap align-self-end">
            <div class="stories-desc">
                <?php the_excerpt(); ?>
            </div>
            <div class="row justify-content-between align-items-end donation-wrap">
                <div class="donation-value col-auto">
                    <span class="lbl"><?php echo esc_html__('Donation So Far:', 'givingwalk'); ?></span>
                    <span class="value"><?php echo esc_html($raised_value); ?></span>
                </div>
                <div class="donation-action col-auto">
                    <?php givingwalk_show_donate_button(['class' => 'btn btn-alt']) ?>
                </div>
            </div>
        </div>
    </div>
</article>
