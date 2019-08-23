<?php 
    extract( $atts );
    $tax_query = array();
    if(!empty($taxonomies)) $tax_query = array(
            array(
                'taxonomy' => 'crw_stories_cat',
                'field'    => 'slug',
                'terms'    => explode(',', $taxonomies),
            ),
        );
    $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
    $args = array(
        'post_type'           => 'crw_stories',
        'posts_per_page'      => $posts_per_page,
        'tax_query'           => $tax_query,
        'ignore_sticky_posts' => 1,
        'paged'               => $paged,
    );

    global $wp_query;
    $posts = $wp_query = new WP_Query($args);
    if ($posts -> have_posts() ) :
        echo '<div class="red-story-carousel-wrap">';   
        $clss[] = $el_id.' red-carousel owl-carousel';
        if($nav)  $clss[] = 'has-nav'; 
        if($dots)  $clss[] = 'has-dots'; 
        $clss[] = $nav_pos;
        $clss[] = $dot_style;
        if($dot_pos == '1') echo '<div class="dotContainerTop owl-dots row no-gutters '.$dot_style.'"></div>';
        echo '<div id="'.esc_attr($el_id).'" class="'. esc_attr(join(' ',$clss)) .'">'; 
            $image_sizes = ['330x640','330x640','560x640','330x640','330x640'];
            $i=0;
            $size_index = -1;
            while ( $posts -> have_posts() ) : $posts -> the_post();
                $meta = apply_filters('ef4_get_post_meta', ['location' => '','donation_raised' => ''], get_the_ID(), false);
                $raised = $meta['donation_raised'];
                $default_amount = '$' . $raised;
                $raised_value = apply_filters('ef4_payment_create_amount', $default_amount, $raised);
                $size_index++;
                if($size_index >= count($image_sizes))
                $size_index = $size_index - count($image_sizes);
                ?>
                <article <?php post_class('entry-archive grid-item'); ?>>
                    <?php
                    if (has_post_thumbnail()) {
                        //givingwalk_image_by_size(get_post_thumbnail_id(get_the_ID()),$image_sizes[$size_index]);
                        echo '<div class="small">';
                        echo givingwalk_get_image_crop(get_post_thumbnail_id(get_the_ID()), '330x640');
                        echo '</div>';
                        echo '<div class="large">';
                        echo givingwalk_get_image_crop(get_post_thumbnail_id(get_the_ID()), '560x640');
                        echo '</div>';
                    }
                    ?>
                    <div class="entry-info">
                        <?php givingwalk_post_share_popup(false); ?>
                        <div class="top-wrap align-self-start">
                            <?php if (!empty($meta['location'])): ?>
                                <span class="location"><?php echo esc_html($meta['location']); ?></span>
                            <?php endif; ?>
                            <?php the_title('<h2 class="archive-title">', '</h2>'); ?>
                        </div>
                        <div class="bottom-wrap align-self-end">
                            <div class="stories-desc">
                                <?php the_excerpt(); ?>
                            </div>
                            <div class="row justify-content-between align-items-end donation-wrap">
                                <div class="donation-value col-auto">
                                    <span class="lbl"><?php echo esc_html__('Donation So Far:', 'givingwalk'); ?></span>
                                    <span class="value"><?php echo esc_html($raised_value); ?></span>
                                </div>
                                <div class="donation-action col-auto">
                                    <?php givingwalk_show_donate_button(['class' => 'btn btn-alt']) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            <?php
            $i++;
            endwhile;  
        echo '</div>';
        if($nav_style === '1') echo '<div class="navContainer owl-nav"><div class="dotContainer owl-dots"></div></div>';
        echo '</div>'; 
         
        wp_reset_postdata();
    else :
        /* content none. */
        get_template_part( 'single-templates/content', 'none' );
    endif; 
