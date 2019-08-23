<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Consultax
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-box'); ?>>
    <div class="inner-post">
        <header class="entry-header">

            <?php if ( 'post' === get_post_type() ) : ?>
            <div class="entry-meta">
                <?php consultax_post_meta(); ?>
            </div><!-- .entry-meta -->
            <?php endif; ?>

            <?php the_title( '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' ); ?>

        </header><!-- .entry-header -->

        <div class="entry-summary">

            <?php the_excerpt(); ?>

        </div><!-- .entry-content -->
    </div>
</article>
