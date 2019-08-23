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

get_header(); ?>

<div id="content-area" class="<?php givingwalk_main_content_class($sidebar); ?>">
    <?php
        /* Start the loop.*/
        while ( have_posts() ) : the_post();

            /*Include the single content template.*/
            get_template_part( 'single-templates/single/content', get_post_format() );
            /* About Author */
            givingwalk_author_info();
            /* Related Post */
            givingwalk_post_related();
            /*If comments are open or we have at least one comment, load up the comment template.*/
            if ( givingwalk_single_post_comment_list_form() && ( comments_open() || get_comments_number() )) :
                comments_template();
            endif;
            /* Get single post nav. */
            givingwalk_post_nav();
            /*End the loop.*/
        endwhile;
    ?>
</div>
<?php
    get_sidebar();
?>

<?php get_footer(); ?>