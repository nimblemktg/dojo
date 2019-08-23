<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Consultax
 */

?>

	</div><!-- #content -->

	<footer id="site-footer" class="site-footer bg-second">
		<?php if( consultax_get_option('footer_widgets') ) { if ( is_active_sidebar( 'footer-area-1' ) || is_active_sidebar( 'footer-area-2' ) || is_active_sidebar( 'footer-area-3' ) || is_active_sidebar( 'footer-area-4' ) ){ ?>
		    <div class="main-footer">
		    	<div class="container">
			    	<div class="row">
			    		<?php get_sidebar('footer');?>
			    	</div>
			    </div>
		    </div><!-- .main-footer -->
	    <?php } } if( consultax_get_option('footer_bottom') ) { ?>
		<div class="footer-bottom">
			<div class="container">
	            <div class="row">
	                <div class="col-md-6">
		                <div class="footer-copyright">
		                	<?php echo wp_kses( consultax_get_option('copyright'), wp_kses_allowed_html('post') ); ?>
		                </div>
	                </div>
	                <div class="col-md-6">
	                	<div class="footer-nav text-right mobile-center">
	                		<?php
								wp_nav_menu( array(
									'theme_location' => 'footer',
									'menu_id'        => 'footer-menu',
									'menu_class'     => 'none-style',
									'container'      => '',
								) );
							?>
	                	</div>
	                </div>
	            </div>
	        </div>
		</div><!-- .copyright-footer -->
		<?php } ?>
		<a id="back-to-top" href="#" class="show"></a>
	</footer><!-- #site-footer -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
