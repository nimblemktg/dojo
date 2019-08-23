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
            ?>
            <article <?php post_class(); ?>> 
                <div class="top-wrap">
                    <?php givingwalk_post_thumbnail('large'); ?>
                </div>

                <div class="entry-content clearfix">
                    <div class="row entry-header">
                        <div class="col-left col-12 col-md-6">
                            <?php the_title( '<h2 class="single-title">', '</h2>' ); ?>
                        </div>
                        <div class="col-right col-12 col-md-6">
                            <div class="progress-amount-wrap">
                                <?php givingwalk_causes_time_progress(); ?>
                                <?php givingwalk_causes_donate_progress(); ?>
                                <?php givingwalk_causes_donate_amount(); ?>
                            </div>
                        </div>    
                    </div>
                    <div class="row meta-donate">
                        <div class="meta-left col-12 col-md-7 col-lg-7 col-xl-6">
                            <?php givingwalk_single_causes_meta(); ?>
                        </div>
                        <div class="donation-action col-12 col-md-5 col-lg-5 col-xl-6">
                            <?php givingwalk_show_donate_button() ?>
                        </div>
                    </div>
                    <?php givingwalk_single_cat_sharing(); ?>
                    <div class="entry-conent-inner">
                        <?php the_content(); ?>
                    </div>

                </div><!-- .entry-content -->
            </article>
            <?php givingwalk_single_causes_recent_donars(get_the_id()); ?>
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