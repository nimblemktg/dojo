<div class="project-item col-md-4">
    <div class="inner">
        <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail(); ?>
        </a>
        <div class="p-info">
            <h6><?php the_terms( $post->ID, 'portfolio_cat', '', ' / ' ); ?></h6>
            <h4>
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h4>
        </div>
    </div>
</div>