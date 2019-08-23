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
					<div class="row">
					<?php if ( have_posts() ) : ?>

						<?php
						/* Start the Loop */
						if ( get_query_var('paged') ) {
						    $paged = get_query_var('paged');
						} elseif ( get_query_var('page') ) { // 'page' is used instead of 'paged' on Static Front Page
						    $paged = get_query_var('page');
						} else {
						    $paged = 1;
						}
						$args = array(
		                    'post_type' => 'ot_service',
		                    'posts_per_page' => 9,
		                    'paged' => $paged,
		                );
						$wp_query = new WP_Query($args);
            			while ($wp_query -> have_posts()) : $wp_query -> the_post();

							/*
							 * Include the Post-Type-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
							 */
							get_template_part( 'template-parts/content-service', get_post_type() );

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

