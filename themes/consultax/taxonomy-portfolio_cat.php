<?php
/**
 * The template for displaying archive portfolio pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Consultax
 */

get_header(); ?>

<div class="entry-content">
	<div class="container">
		<div class="row">
			<div id="primary" class="content-area col-md-12">
				<main id="main" class="site-main">
					<div class="project-filter row">
					<?php if ( have_posts() ) : ?>

						<?php
						/* Start the Loop */
						while ( have_posts() ) :
						the_post();

							/*
							 * Include the Post-Type-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
							 */
							get_template_part( 'template-parts/content-project', get_post_type() );

						endwhile;

							consultax_posts_navigation();

						else :

							get_template_part( 'template-parts/content', 'none' );

						endif;
						?>
					</div>
				</main><!-- #main -->
			</div><!-- #primary -->
		</div>
	</div>
</div>

<?php
get_footer();

