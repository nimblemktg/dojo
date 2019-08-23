<?php
/**
 * Template part for displaying single post content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Consultax
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('blog-post'); ?>>
    <?php if ( has_post_thumbnail() ) { ?>
        <div class="entry-media">
            <?php the_post_thumbnail(); ?>
        </div>
    <?php } ?>
    <div class="inner-post">
        <header class="entry-header">

            <?php if ( 'post' === get_post_type() ) : ?>
            <div class="entry-meta">
                <?php consultax_post_meta(); ?>
            </div><!-- .entry-meta -->
            <?php endif; ?>

        </header><!-- .entry-header -->

        <div class="entry-summary">

            <?php

                the_content(sprintf(
                    wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                        __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'consultax'),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    get_the_title()
                ));

                wp_link_pages(array(
                    'before' => '<div class="page-links">' . esc_html__('Pages:', 'consultax'),
                    'after' => '</div>',
                ));
            ?>

        </div><!-- .entry-content -->
        <div class="tagcloud">
            <?php consultax_entry_footer(); ?>
        </div>
    </div>
</article>
