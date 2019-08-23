<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package SpyroPress
 * @subpackage Giving Walk
 * @since 1.0.0
 * @author Red Team
 */
/* get side-bar position. */
$sidebar = givingwalk_get_sidebar();

get_header(); ?>
<div id="content-area" class="<?php givingwalk_main_content_class($sidebar); ?>">
	<div class="wrap-404">
		<div class="error-404 not-found text-center">
    		  <h1 class="error-code"><?php echo esc_html( '404', 'givingwalk' ); ?></h1>
              <h2 class="error-title"><?php echo esc_html__( 'Ooops, Page Not Found', 'givingwalk' ); ?></h2>
    		  <p class="error-message"><?php esc_html_e( "We Can't Seem to find the page  you're looking for.", 'givingwalk' ); ?></p>
    		  <a class="btn btn-default" href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Back to Home', 'givingwalk'); ?></a>
    		  <?php get_search_form(); ?>
		</div><!-- .error-404 -->
    </div>
</div>
<?php
    get_sidebar();
?>

<?php get_footer(); ?>
