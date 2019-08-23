<?php
/**
 * The Template for displaying single post
 *
 * @package SpyroPress
 * @subpackage Giving Walk
 * @since 1.0.0
 * @author Red Team
 */
/* get sidebar position. */
$sidebar = givingwalk_get_sidebar();

get_header(); 

?>
 
<div id="content-area" class="<?php givingwalk_main_content_class($sidebar); ?>">
    <?php
        /* Start the loop.*/
        while ( have_posts() ) : the_post();
            $meta = apply_filters('ef4_get_post_meta',[
                    'location'=>'',
                'donation_raised'=>0
            ],get_the_ID(),false);
            $raised = $meta['donation_raised'];
            $default_amount = '$'.$raised;
            $amount_value = apply_filters('ef4_payment_create_amount',$default_amount,$raised);
            ?>
            <article <?php post_class(); ?>> 
                <div class="top-wrap">
                    <?php 
                    givingwalk_post_thumbnail('large'); 
                    givingwalk_post_share_popup(false);
                    ?>
                    <div class="row entry-header">
                        <div class="col-left col-12 col-md-6">
                            <?php if(!empty($meta['location'])):?>
                                <span class="location"><?php echo esc_html($meta['location']);?></span>
                            <?php endif; ?>
                            <?php the_title( '<h2 class="single-title">', '</h2>' ); ?>
                        </div>
                        <div class="col-right col-12 col-md-6">
                            <div class="donation-action">
                                <?php givingwalk_show_donate_button() ?>
                            </div>
                            <div class="donation-value">
                                <span class="lbl"><?php echo esc_html__('Donation So Far:','givingwalk');?></span>
                                <span class="value"><?php echo esc_html($amount_value);?></span>
                            </div>
                        </div>    
                    </div>
                </div>
                <?php givingwalk_stories_meta();?>
                <div class="entry-content clearfix">
                    <?php the_content(); ?>
                    <?php givingwalk_single_stories_footer(); ?>
                </div><!-- .entry-content -->
            </article>

            <?php
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;
           
        endwhile;
    ?>
</div>
<?php
    get_sidebar();
?>

<?php get_footer(); ?>