<?php
if (!class_exists('EF4Framework')) return;
add_action('widgets_init', 'GivingwalkRecentPost');       

function GivingWalkRecentPost() {
    register_ef4_widget('GivingwalkRecentPost');
}

class GivingWalkRecentPost extends WP_Widget {

    function __construct() {
        parent::__construct(
            'GivingwalkRecentPost', 
            esc_html__('Givingwalk Recent Posts','givingwalk'), 
            array('description' => esc_html__('Recent Posts Widget.', 'givingwalk'),)
        );
    }

    function widget($args, $instance) {
        global $post;
        extract($args);
        $title         = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
        $layout        = $instance['layout_wg'];
        $categories    = $instance['categories'];
        $post_type     = $instance['post_type'];
        $sort_by       = $instance['sort_by'];
        $show_image    = (int) $instance['show_image'];
        $show_cat      = (int) $instance['show_cat'];
        $show_author   = (int) $instance['show_author'];
        $show_date     = (int) $instance['show_date'];
        $show_comment  = (int) $instance['show_comment'];
        $show_view     = (int) $instance['show_view'];
        $show_view_all = (int) $instance['show_view_all'];
        $show_desc     = (int) $instance['show_desc'];
        $number        = (int) $instance['number'];

        /* direction */
        $dir_icon = is_rtl() ? 'left' : 'right';

        /* get post from special category */
        $cat_name = array();

        $sticky = get_option('sticky_posts');
        
        $extra_class = !empty($instance['extra_class']) ? $instance['extra_class'] : "";

        // no 'class' attribute - add one with the value of width
        if( strpos($before_widget, 'class') === false ) {
            $before_widget = str_replace('>', 'class="'. $extra_class . '"', $before_widget);
        }
        // there is 'class' attribute - append width value to it
        else {
            $before_widget = str_replace('class="', 'class="'. $extra_class . ' ', $before_widget);
        }
        echo wp_kses_post($before_widget);
         
        $style = ' style'.$layout;

        if(is_singular()){
            $post__not_in = array($post->ID);
        } else {
            $post__not_in = $sticky;
        }
        switch ($sort_by) {
            case 'most_viewed':
                $args = array(
                    'posts_per_page' => $number,
                    'post_type'      => $post_type,
                    'post_status'    => 'publish',
                    'post__not_in'   => $post__not_in,
                    'meta_key'       => 'givingwalk_post_views_count',
                    'orderby'        => 'meta_value_num',
                    'order'          => 'DESC',
                    'paged'          => 1,
                    'category_name'  => $cat_name
                );
                break;
            case 'sticky_posts':
                $args = array(
                    'posts_per_page' => $number,
                    'post_type'      => $post_type,
                    'post_status'    => 'publish',
                    'post__in'       => $sticky,
                    'post__not_in'   => $post__not_in,
                    'order'          => 'DESC',
                    'paged'          => 1,
                    'category_name'  => $cat_name
                );
                break;
            default:
                $args = array(
                    'posts_per_page' => $number,
                    'post_type'      => $post_type,
                    'post_status'    => 'publish',
                    'post__not_in'   => $post__not_in,
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                    'paged'          => 1,
                    'category_name'  => $cat_name
                );
        }
        switch ($post_type) {
            default:
                $archive_url = get_post_type_archive_link($post_type);
                break;
        }
        $recent_post = new WP_Query($args);
        ?>
        <?php
            switch ($layout) {
                case 1:
                    if ($recent_post->have_posts()){ ?>
                    <div class="red-recent-post<?php echo esc_attr($style);?>">
                        <?php if($title) echo wp_kses_post($before_title.$title.$after_title); ?>
                        <?php 
                        while ($recent_post->have_posts()): $recent_post->the_post(); ?>
                            <div class="red-recent-item <?php if(has_post_thumbnail() == '') {echo 'no-image';} ?> clearfix"> 
                                <?php if($show_image && has_post_thumbnail()){ ?>
                                <div class="entry-media space-<?php echo givingwalk_align2();?>">
                                    <?php
                                    if (function_exists('wpb_getImageBySize')){
                                        $img_id = get_post_thumbnail_id();
                                        $img = wpb_getImageBySize( array(
                                            'attach_id'  => $img_id,
                                            'thumb_size' => '540x252',
                                            'class'      => '',
                                        ));
                                        echo wp_kses_post($img['thumbnail']);
                                    }else{
                                        the_post_thumbnail('thumbnail'); 
                                    }
                                    ?>
                                </div>
                                <?php } ?>
                                <div class="item-content">
                                    <div class="align-self-end"><?php givingwalk_post_meta_list($show_author, $show_date, $show_cat , $show_comment , $show_view, '', '', ''); ?></div>
                                    <h6 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo get_the_title();?>"><?php get_the_title() ? the_title() : the_ID(); ?></a></h6>
                                    <?php if ($show_desc) echo givingwalk_post_excerpt(); ?>
                                </div>
                            </div>
                        <?php endwhile; wp_reset_postdata();?>
                    </div>
                    <?php 
                    if($show_view_all) echo '<div class="view-all clearfix text-'.givingwalk_align2().'"><a class="btn-primary" href="'.esc_url($archive_url).'"><span>'.esc_html__('View More','givingwalk').'</span></a></div>';
                    } else { ?>
                        <div class="red-recent-post<?php echo esc_attr($style);?>">
                            <?php if($title) echo wp_kses_post($before_title.$title.$after_title); ?>
                            <span class="notfound error-msg"><?php esc_html_e('No post found!','givingwalk') ?></span>
                        </div>
                    <?php
                    }
                break;
                default:
                    if ($recent_post->have_posts()){ ?>
                    <div class="red-recent-post<?php echo esc_attr($style);?>">
                        <?php if($title) echo wp_kses_post($before_title.$title.$after_title); ?>
                        <?php 
                        while ($recent_post->have_posts()): $recent_post->the_post(); ?>
                            <div class="red-recent-item <?php if(has_post_thumbnail() == '') {echo 'no-image';} ?> clearfix"> 
                                <?php if($show_image && has_post_thumbnail()){ ?>
                                <div class="entry-media space-<?php echo givingwalk_align2();?>">
                                    <?php the_post_thumbnail('thumbnail'); ?>
                                </div>
                                <?php } ?>
                                <div class="item-content">
                                    <h6 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo get_the_title();?>"><?php get_the_title() ? the_title() : the_ID(); ?></a></h6>
                                    <?php if ($show_desc) echo givingwalk_post_excerpt(); ?>
                                    <div class="align-self-end"><?php givingwalk_post_meta_list($show_author, $show_date, $show_cat , $show_comment , $show_view, '', '', ''); ?></div>
                                </div>
                            </div>
                        <?php endwhile; wp_reset_postdata();?>
                    </div>
                    <?php 
                    if($show_view_all) echo '<div class="view-all clearfix text-'.givingwalk_align2().'"><a class="btn-primary" href="'.esc_url($archive_url).'"><span>'.esc_html__('View More','givingwalk').'</span></a></div>';
                    } else { ?>
                        <div class="red-recent-post<?php echo esc_attr($style);?>">
                            <?php if($title) echo wp_kses_post($before_title.$title.$after_title); ?>
                            <span class="notfound error-msg"><?php esc_html_e('No post found!','givingwalk') ?></span>
                        </div>
                    <?php
                    }
                break;
            }
                
         ?>
        <?php 
        echo wp_kses_post($after_widget);
    }

    function update($new_instance, $old_instance) {
        $instance                  = $old_instance;
        $instance['layout_wg']     = $new_instance['layout_wg'];
        $instance['categories']    = $new_instance['categories'];
        $instance['title']         = $new_instance['title'];
        $instance['post_type']     = $new_instance['post_type'];
        $instance['sort_by']       = $new_instance['sort_by'];
        $instance['show_image']    = $new_instance['show_image'];
        $instance['show_cat']      = $new_instance['show_cat'];
        $instance['show_author']   = $new_instance['show_author'];
        $instance['show_date']     = $new_instance['show_date'];
        $instance['show_comment']  = $new_instance['show_comment'];
        $instance['show_view']     = $new_instance['show_view'];
        $instance['show_desc']     = $new_instance['show_desc'];
        $instance['show_view_all'] = $new_instance['show_view_all'];
        $instance['number']        = (int) $new_instance['number'];
        $instance['extra_class']   = $new_instance['extra_class'];

        return $instance;
    }

    function form($instance) {
        $layout        = isset($instance['layout_wg']) ? $instance['layout_wg'] : '0';
        $categories    = isset($instance['categories']) ? $instance['categories'] : array();
        $title         = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $post_type     = isset($instance['post_type']) ? esc_attr($instance['post_type']) : 'post';
        $sort_by       = isset($instance['sort_by']) ? esc_attr($instance['sort_by']) : '';
        $show_image    = isset($instance['show_image']) ? esc_attr($instance['show_image']) : '';
        $show_cat      = isset($instance['show_cat']) ? esc_attr($instance['show_cat']) : '';
        $show_author   = isset($instance['show_author']) ? esc_attr($instance['show_author']) : '';
        $show_date     = isset($instance['show_date']) ? esc_attr($instance['show_date']) : '';
        $show_comment  = isset($instance['show_comment']) ? esc_attr($instance['show_comment']) : '';
        $show_view     = isset($instance['show_view']) ? esc_attr($instance['show_view']) : '';
        $show_view_all = isset($instance['show_view_all']) ? esc_attr($instance['show_view_all']) : '';
        $show_desc     = isset($instance['show_desc']) ? esc_attr($instance['show_desc']) : '';
        if ( !isset($instance['number']) || !$number = (int) $instance['number'] ) $number = 5;

        $post_types = get_post_types(array('_builtin' => false), 'objects');
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e( 'Title:', 'givingwalk' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p><label for="<?php echo esc_attr($this->get_field_id('layout_wg')); ?>"><?php esc_html_e( 'Layout:', 'givingwalk' ); ?></label>
         <select class="widefat" id="<?php echo esc_attr( $this->get_field_id('layout_wg') ); ?>" name="<?php echo esc_attr( $this->get_field_name('layout_wg') ); ?>">
            <option value="0"<?php if( $layout == '0' ){ echo 'selected="selected"';} ?>><?php esc_html_e('Default', 'givingwalk'); ?></option>
            <option value="1"<?php if( $layout == '1' ){ echo 'selected="selected"';} ?>><?php esc_html_e('Thumbnail background', 'givingwalk'); ?></option>
         </select>
         </p>
        <p><label for="<?php echo esc_attr($this->get_field_id('post_type')); ?>"><?php esc_html_e( 'Post Type:', 'givingwalk' ); ?></label>
         <select class="widefat" id="<?php echo esc_attr( $this->get_field_id('post_type') ); ?>" name="<?php echo esc_attr( $this->get_field_name('post_type') ); ?>">
            <option value="post"<?php if( $post_type == 'post' ){ echo 'selected="selected"';} ?>><?php esc_html_e('Post', 'givingwalk'); ?></option>
            <?php
            foreach($post_types as $_post_type): ?>
                <option value="<?php echo esc_attr($_post_type->name); ?>" <?php if( $post_type == $_post_type->name ){ echo 'selected="selected"';} ?>><?php echo esc_html($_post_type->labels->name); ?></option>
            <?php endforeach; ?>
         </select>
         </p>
         <p><label for="<?php echo esc_attr($this->get_field_id('sort_by')); ?>"><?php esc_html_e( 'Sort by:', 'givingwalk' ); ?></label>
         <select class="widefat" id="<?php echo esc_attr( $this->get_field_id('sort_by') ); ?>" name="<?php echo esc_attr( $this->get_field_name('sort_by') ); ?>">
            <option value=""<?php if( $sort_by == '' ){ echo 'selected="selected"';} ?>><?php esc_html_e('Recent', 'givingwalk'); ?></option>
            <option value="most_viewed"<?php if( $sort_by == 'most_viewed' ){ echo 'selected="selected"';} ?>><?php esc_html_e('Most Viewed', 'givingwalk'); ?></option>
            <option value="sticky_posts"<?php if( $sort_by == 'sticky_posts' ){ echo 'selected="selected"';} ?>><?php esc_html_e('Sticky post', 'givingwalk'); ?></option>
         </select>
         </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('show_image')); ?>"><?php esc_html_e( 'Show Image:', 'givingwalk' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('show_image') ); ?>" name="<?php echo esc_attr( $this->get_field_name('show_image') ); ?>" <?php if($show_image!='') echo 'checked="checked"'; ?> type="checkbox" value="1"  />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('show_author')); ?>"><?php esc_html_e( 'Show Author:', 'givingwalk' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('show_author') ); ?>" name="<?php echo esc_attr( $this->get_field_name('show_author') ); ?>" <?php if($show_author!='') echo 'checked="checked"'; ?> type="checkbox" value="1"  />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('show_date')); ?>"><?php esc_html_e( 'Show date:', 'givingwalk' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('show_date') ); ?>" name="<?php echo esc_attr( $this->get_field_name('show_date') ); ?>" <?php if($show_date!='') echo 'checked="checked";' ?> type="checkbox" value="1"  />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('show_cat')); ?>"><?php esc_html_e( 'Show Category:', 'givingwalk' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('show_cat') ); ?>" name="<?php echo esc_attr( $this->get_field_name('show_cat') ); ?>" <?php if($show_cat!='') echo 'checked="checked"'; ?> type="checkbox" value="1"  />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('show_comment')); ?>"><?php esc_html_e( 'Show Comment:', 'givingwalk' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('show_comment') ); ?>" name="<?php echo esc_attr( $this->get_field_name('show_comment') ); ?>" <?php if($show_comment!='') echo 'checked="checked";' ?> type="checkbox" value="1"  />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('show_view')); ?>"><?php esc_html_e( 'Show View:', 'givingwalk' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('show_view') ); ?>" name="<?php echo esc_attr( $this->get_field_name('show_view') ); ?>" <?php if($show_view!='') echo 'checked="checked";' ?> type="checkbox" value="1"  />
        </p>
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('show_desc')); ?>"><?php esc_html_e( 'Show Description:', 'givingwalk' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('show_desc') ); ?>" name="<?php echo esc_attr( $this->get_field_name('show_desc') ); ?>" <?php if($show_desc!='') echo 'checked="checked";' ?> type="checkbox" value="1" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('show_view_all')); ?>"><?php esc_html_e( 'Show View All Link:', 'givingwalk' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('show_view_all') ); ?>" name="<?php echo esc_attr( $this->get_field_name('show_view_all') ); ?>" <?php if($show_view_all!='') echo 'checked="checked";' ?> type="checkbox" value="1"  />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php esc_html_e( 'Number of items to show:', 'givingwalk' ); ?></label>
            <input id="<?php echo esc_attr( $this->get_field_id('number') ); ?>" name="<?php echo esc_attr( $this->get_field_name('number') ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" size="3" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('extra_class')); ?>"><?php esc_html_e( 'Extra Class:', 'givingwalk' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('extra_class')); ?>" name="<?php echo esc_attr($this->get_field_name('extra_class')); ?>" value="<?php if(isset($instance['extra_class'])){echo esc_attr($instance['extra_class']);} ?>" />
        </p>
        <?php
    }
}
?>