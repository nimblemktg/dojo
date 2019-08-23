<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Consultax
 */

wp_head();
?>

<div class="container">
    <div class="error-404 not-found">
		<div class="row">
	    	<div class="col-md-6">
		        <h1><?php wp_kses( _e( '404 Error <br> Page not found', 'consultax' ), wp_kses_allowed_html('post')  ); ?></h1>
		        <div class="page-content">
		            <p><?php wp_kses( _e( 'We’re sorry, the page you have looked for does not exist in our database! Maybe go to our', 'consultax' ), wp_kses_allowed_html('post')  ); ?></p>
		            <?php //get_search_form(); ?>
		            <a class="btn" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'BACK TO HOME', 'consultax' ); ?></a>
		        </div>
	        </div>
		</div>
		<img class="error-image" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/404-error.png" alt="404">
    </div>
</div>