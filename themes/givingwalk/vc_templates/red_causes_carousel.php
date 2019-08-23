<?php 
    extract( $atts );
    $tax_query = array();
    if(!empty($taxonomies)) $tax_query = array(
            array(
                'taxonomy' => 'crw_causes_cat',
                'field'    => 'slug',
                'terms'    => explode(',', $taxonomies),
            ),
        );
    $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
    $args = array(
        'post_type'           => 'crw_causes',
        'posts_per_page'      => $posts_per_page,
        'tax_query'           => $tax_query,
        'ignore_sticky_posts' => 1,
        'paged'               => $paged,
    );

    global $wp_query;
    $posts = $wp_query = new WP_Query($args);
    if ($posts -> have_posts() ) :
        echo '<div class="red-causes-carousel-wrap">';   
        $clss[] = $el_id.' red-carousel owl-carousel';
        if($nav)  $clss[] = 'has-nav'; 
        if($dots)  $clss[] = 'has-dots'; 
        $clss[] = $nav_pos;
        $clss[] = $dot_style;
        if($dot_pos == '1') echo '<div class="dotContainerTop owl-dots row no-gutters '.$dot_style.'"></div>';
        echo '<div id="'.esc_attr($el_id).'" class="'. esc_attr(join(' ',$clss)) .'">'; 
            while ( $posts -> have_posts() ) : $posts -> the_post();
                $meta = apply_filters('ef4_get_post_meta',['donors'=>''],get_the_ID(),false);
                $donors = $meta['donors'];
                ?>
                <article <?php post_class('entry-archive grid-item'); ?> onclick="">
                    <?php 
                    if( has_post_thumbnail()){
                        $thumbnail = get_the_post_thumbnail(get_the_ID(),'medium');
                        ?>
                        <div class="entry-media entry-thumbnail">
                            <?php echo wp_kses_post( $thumbnail ); ?>
                            <div class="donation-action">
                                <?php givingwalk_show_donate_button(['class'=>'btn btn-alt']); ?>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="entry-info text-center">
                        <?php if(!empty($donors)): ?>
                            <div class="donors-people">
                                <span class="lbl"><?php echo esc_html__('Donors:','givingwalk');?></span> <?php echo esc_html($donors); ?> <?php echo esc_html__('People','givingwalk');?>
                            </div>
                        <?php endif; ?>
                        <?php the_title( '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h4>' ); ?>
                        <?php givingwalk_causes_donate_amount_archive(); ?>
                    </div>
                </article>
            <?php
            endwhile;  
        echo '</div>';
        if($nav_style === '1') echo '<div class="navContainer owl-nav"><div class="dotContainer owl-dots"></div></div>';
        echo '</div>'; 
         
        wp_reset_postdata();
    else :
        /* content none. */
        get_template_part( 'single-templates/content', 'none' );
    endif; 
