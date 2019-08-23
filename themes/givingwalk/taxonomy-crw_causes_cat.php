<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package SpyroPress
 * @subpackage Giving Walk
 * @since 1.0.0
 * @author Red Team
 */
/* get side-bar position. */

$sidebar = givingwalk_get_sidebar();
$layout= givingwalk_get_causes_layout();
get_header(); ?>
<div id="content-area" class="<?php givingwalk_main_content_class($sidebar); ?>">
    <?php
        if ( have_posts() ) :
            do_action('givingwalk_causes_archive_start');
            while ( have_posts() ) : the_post(); 
                do_action('givingwalk_causes_start_loop_item');
                    get_template_part( 'single-templates/archive/content', $layout );
                do_action('givingwalk_causes_end_loop_item');
            endwhile; // end of the loop.
            do_action('givingwalk_causes_archive_end');
            givingwalk_paging_nav();
        else :
            /* content none. */
            get_template_part( 'single-templates/content', 'none' );
        endif; 
    ?>
</div>
<?php
    get_sidebar();
?>

<?php get_footer(); ?>