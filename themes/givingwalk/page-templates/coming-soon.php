<?php
/**
 * Template Name: Coming soon
 * @package SpyroPress
 * @subpackage Giving Walk
 * @since 1.0.0
 * @author Red Team
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_head(); ?>
</head>
<body <?php body_class(); givingwalk_body_attributes(); ?>>
    <?php givingwalk_page_loading();?>
    <div <?php givingwalk_page_attributes(); ?>>
        <main id="red-main" class="<?php givingwalk_main_class(); ?>">
             
            <?php
            while ( have_posts() ) : the_post();
    
                // Include the page content template.
                get_template_part( 'single-templates/content', 'page' );
     
                // End the loop.
            endwhile;
            ?>
             
        </main>
    </div>
<?php wp_footer(); ?>
</body>
</html>
 