<?php 
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
if(empty($el_id)) $el_id = 'red-events-'.uniqid();
$css_class = '';

$classes=array('red-events-wrap');
if(!empty($layout_mode))
    $classes[] = 'layout-'.$layout_mode;
if(!empty($atts['css'])){
    $classes[]=vc_shortcode_custom_css_class($atts['css']);
}

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $classes ) ), $this->settings['base'], $atts ) );

if($layout_mode == '3' || $layout_mode == '4'){
    $css_class .= 'red-owl-wrap '.$el_id;
}
$css_class_attr = $item_class = array();
$css_class_attr[] = 'layout-'.$layout_mode;
$item_class[] = 'red-carousel-item-wrap';

if($layout_style === 'carousel'){
    $css_class_attr[] = 'red-carousel owl-carousel';
    if($nav)  $css_class_attr[] = 'has-nav'; 
    if($dots)  $css_class_attr[] = 'has-dots'; 
    $css_class_attr[] = $nav_pos;
    $css_class_attr[] = $dot_style;
} else {
    $css_class_attr[] = 'red-grid row';
    $item_class[] = 'col-sm-'.round(12/$col_sm).' col-md-'.round(12/$col_md).' col-lg-'.round(12/$col_lg).' col-xl-'.round(12/$col_xl);
}

$sort_type = !empty($event_type) ? $event_type : 'recent';

$tax_query = array();
if(!empty($taxonomies)) $tax_query = array(
        array(
            'taxonomy' => 'tribe_events_cat',
            'field'    => 'slug',
            'terms'    => explode(',', $taxonomies),
        ),
    );
$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
$args = array(
    'post_type'           => 'tribe_events',
    'tax_query'           => $tax_query,
    'ignore_sticky_posts' => 1,
    'paged'               => $paged,
);
if(!empty($posts_per_page))
    $args['posts_per_page'] = $posts_per_page;
if($sort_type == 'upcoming'){
    $args['meta_query'] = array(
        array(
            'key'     => '_EventStartDate',
            'value'   => date('Y-m-d H:i:s'),
            'compare' => '>',
        )
    );
}
if(!empty($order_by))
{
    $args['orderby']='meta_value_num';
    switch ($order_by)
    {
        case 'start_date':
            $args['meta_key']='_EventStartDate';
            break;
        case 'end_date':
            $args['meta_key']='_EventEndDate';
            break;
    }
    if(!empty($order))
    {
        $args['order']= (strtoupper($order) === 'ASC') ? 'ASC' : 'DESC';
    }
}
global $wp_query;
$posts = $wp_query = new WP_Query($args);
if ($posts -> have_posts() ) : 
?>
    <div class="<?php echo esc_attr($css_class);?>">
        <?php 
        switch ($layout_mode) {
            case '1':
            case '2':
                while ( have_posts() ) : the_post(); ?>
                    <div id="post-<?php the_ID() ?>" class="tribe-events-items">
                        <?php tribe_get_template_part( 'list/single', 'event' ); ?>
                    </div>
                <?php 
                endwhile; 
            break;
            case '3':
                if($layout_style === 'carousel' && $dot_pos == '1') echo '<div class="dotContainerTop owl-dots row no-gutters align-items-center justify-content-center '.$dot_style.'"></div>'; ?>
                <div id="<?php echo esc_attr($el_id);?>" class="<?php echo join(' ',$css_class_attr);?>"> 
                <?php
                while ( have_posts() ) : the_post(); ?>
                    <div id="post-<?php the_ID() ?>" class="tribe-events-items <?php echo join(' ',$item_class) ?>">
                        <?php tribe_get_template_part( 'list/single', 'event1' ); ?>
                    </div>
                <?php endwhile; ?>
                </div>
                <?php if($layout_style === 'carousel' && $nav_style === '1'): ?><div class="navContainer owl-nav"><div class="dotContainer owl-dots"></div></div><?php endif; 
            break;
            case '4':
                if($layout_style === 'carousel' && $dot_pos == '1') echo '<div class="dotContainerTop owl-dots row no-gutters align-items-center justify-content-center '.$dot_style.'"></div>'; ?>
                <div id="<?php echo esc_attr($el_id);?>" class="<?php echo join(' ',$css_class_attr);?>"> 
                <?php
                while ( have_posts() ) : the_post(); ?>
                    <div id="post-<?php the_ID() ?>" class="tribe-events-items <?php echo join(' ',$item_class) ?>">
                        <?php tribe_get_template_part( 'list/single', 'event2' ); ?>
                    </div>
                <?php endwhile; ?>
                </div>
                <?php if($layout_style === 'carousel' && $nav_style === '1'): ?><div class="navContainer owl-nav"><div class="dotContainer owl-dots"></div></div><?php endif; 
            break;
        }
        ?>
        
    </div>
    <?php
    wp_reset_postdata();
else :
    get_template_part( 'single-templates/content', 'none' );
endif;