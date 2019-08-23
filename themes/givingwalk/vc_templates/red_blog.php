<?php 
    extract( $atts );
    $tax_query = array();
    if(!empty($taxonomies)) $tax_query = array(
            array(
                'taxonomy' => 'category',
                'field'    => 'slug',
                'terms'    => explode(',', $taxonomies),
            ),
        );
    $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
    $args = array(
        'post_type'           => 'post',
        'posts_per_page'      => $posts_per_page,
        'tax_query'           => $tax_query,
        'ignore_sticky_posts' => 1,
        'paged'               => $paged,
    );

    global $wp_query;
    $posts = $wp_query = new WP_Query($args);
    if ($posts -> have_posts() ) :
        echo '<div class="red-blog-wrap '.esc_attr($layout_style).'">';
            if($layout_style == 'grid'){
                $cls = 'col-sm-'.round(12/$col_sm).' col-md-'.round(12/$col_md).' col-lg-'.round(12/$col_lg).' col-xl-'.round(12/$col_xl);
                echo '<div class="red-grid row acb">'; 
                    while ( $posts -> have_posts() ) : $posts -> the_post();
                        echo '<div class="'.esc_attr($cls).'">';
                        ?>
                            <article <?php post_class('entry-archive entry-grid'); ?>>
                                <?php 
                                    givingwalk_post_media('medium');  
                                ?>
                                <div class="entry-info">
                                    <header class="archive-header">
                                        <?php givingwalk_post_meta_list(false, true, false, false, false, false, false, false, 'archive-meta'); ?>
                                        <?php the_title( '<h3 class="archive-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h3>' ); ?>
                                    </header>
                                    <div class="detail-author clearfix">
                                        <span class="author-avatar">
                                            <?php 
                                                echo get_avatar(get_the_author_meta('ID'), 35, '', get_the_author(), array('class' => 'img-circle'));
                                            ?>
                                        </span>
                                        <span class="author-info">
                                            <?php echo esc_html__('Posted by ','givingwalk'); ?>
                                            <?php the_author_posts_link(); ?>
                                        </span>
                                    </div>
                                     
                                </div>
                            </article>
                        <?php
                        echo '</div>';
                    endwhile;  
                echo '</div>';
            }
            if($layout_style == 'mask-masonry'){
                wp_enqueue_script( 'masonry' );
                $idx =  1;
                echo '<div class="row content-layout-mask-masonry">';
                while ( $posts -> have_posts() ) : 
                    $posts -> the_post();
                    $post_format = get_post_format();
                    $img_size = ($idx % 2) != 0 ? '585x370' : '585x220';
                    ?>
                    <div class="col-lg-6">
                    <article <?php post_class('entry-archive entry-mask-masonry'); ?>>
                        <?php 
                            if(!$post_format){
                                givingwalk_post_media($img_size); 
                                echo '<div class="entry-info justify-content-between">';
                                    echo '<header class="archive-header">';
                                        givingwalk_post_meta_list(false, true, false, false, false, false,false, true, 'archive-meta');
                                        the_title( '<h2 class="archive-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' );
                                    echo '</header>';
                                    givingwalk_archive_footer();
                                    echo '<a class="arrow-more" href="'.esc_url(get_the_permalink()).'" title="'.esc_attr( get_the_title() ).'"><i class="fa fa-angle-right"></i></a>';
                                echo '</div>';
                            }else{
                                givingwalk_post_media($img_size); 
                            } 
                        ?>
                    </article>
                    </div>
                <?php
                $idx ++;
                endwhile;  
                echo '</div>';
            }
            if($layout_style == 'carousel'){
                $clss[] = $el_id.' red-carousel owl-carousel next-prev-image';
                if($nav)  $clss[] = 'has-nav'; 
                if($dots)  $clss[] = 'has-dots'; 
                $clss[] = $nav_pos;
                $clss[] = $dot_style;
                $clss[] = 'layout-'.$layout_mode;
                if($dot_pos == '1') echo '<div class="dotContainerTop owl-dots row no-gutters align-items-center justify-content-center '.$dot_style.'"></div>';
                echo '<div id="'.esc_attr($el_id).'" class="'. esc_attr(join(' ',$clss)) .'">'; 
                    while ( $posts -> have_posts() ) : $posts -> the_post();
                        $post_format = get_post_format();
                        ?>
                        <article <?php post_class('entry-archive entry-mask');?>>
                            <?php 
                            if(!$post_format){
                                givingwalk_post_media('770x370'); 
                                echo '<div class="entry-info">';
                                    givingwalk_archive_header('h2');
                                    givingwalk_archive_footer();
                                echo '</div>';
                            }else{
                                givingwalk_post_media(); 
                            }
                            ?>
                        </article>
                    <?php
                    endwhile;  
                echo '</div>';
                if($nav_style === '1') echo '<div class="navContainer owl-nav"><div class="dotContainer owl-dots"></div></div>';
            }
        echo '</div>'; 
        
        /* blog nav. */
        /*givingwalk_paging_nav();*/
        wp_reset_postdata();
    else :
        /* content none. */
        get_template_part( 'single-templates/content', 'none' );
    endif; 
