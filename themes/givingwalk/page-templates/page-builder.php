<?php
/**
 * Template Name: Page Builder
 *
 * This is the template that displays page layout with Visual Composer page builder
 *
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use
 * default template.
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
        // Start the loop.
        while ( have_posts() ) : the_post();
            the_content();
        endwhile;
    ?>
</div>
<?php
    get_sidebar();
?>

<?php get_footer(); ?>