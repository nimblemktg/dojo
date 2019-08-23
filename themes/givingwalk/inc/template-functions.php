<?php

/* Comment List */
function givingwalk_comment($comment, $args, $depth) {
    $add_below = 'comment';  
?>
    <div <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID(); ?>">
        <div class="comment-inner">
            <div class="comment-avatar">
                <?php echo get_avatar( $comment, $args['avatar_size'] ); ?>
                <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>    
            </div>
            <div class="comment-content">
                <div class="comment-header">
                    <span class="author-name"><?php comment_author_link(); ?></span>
                    <?php if ( $comment->comment_approved == '0' ) : ?>
                     <div class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.','givingwalk' ); ?></div>
                    <?php endif; ?>
                    <span class="comment-time small"><?php printf( esc_html__('%1$s at %2$s','givingwalk'), get_comment_date('F d, Y'),  get_comment_time() ); ?></span>
                </div>
                <div class="comment-text">
                <?php comment_text(); ?>
                </div>
            </div>
        </div>
<?php
}

/**
 * Move comment form field to bottom
 */
add_filter( 'comment_form_fields', 'givingwalk_comment_field_to_bottom' ); 
function givingwalk_comment_field_to_bottom( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
}

add_action('comment_form_top', 'givingwalk_comment_form_top_action');
function givingwalk_comment_form_top_action(){
    if ( !is_user_logged_in() ) {
        echo '<div class="comment-form-left">';
    }
}

add_action('comment_form_after_fields', 'givingwalk_comment_form_after_fields_action');
function givingwalk_comment_form_after_fields_action(){
    if ( !is_user_logged_in() ) {
        echo '</div><div class="comment-form-right">';
    }
}

add_filter('comment_form_submit_field', 'givingwalk_comment_form_submit_field_filter');
function givingwalk_comment_form_submit_field_filter($submit_field = '', $args = array()){
    if ( !is_user_logged_in() ) {
        $submit_field .= '</div>';
    }
    return $submit_field;
}

/**
 * Client logo area
 * @since 1.0.0
 * @author Red Team
 */
function givingwalk_client_logo($class = ''){
    global $opt_theme_options, $opt_meta_options;
    global $cms_carousel;
    if(!is_array($cms_carousel))
        $cms_carousel = [];
    if(!isset($opt_theme_options))
        return;

    if( is_page() && isset($opt_meta_options['opt_client_logo_custom']) && $opt_meta_options['opt_client_logo_custom'] == '0') 
        return;

    if( is_page() && isset($opt_meta_options['opt_client_logo_custom']) && $opt_meta_options['opt_client_logo_custom'] =='1'){
        $opt_theme_options['opt_client_logo_enable'] = '1' ;
        if( !empty($opt_meta_options['opt_client_logo_layout']) )
            $opt_theme_options['opt_client_logo_layout'] = $opt_meta_options['opt_client_logo_layout'];
         
    }
    if( $opt_theme_options['opt_client_logo_enable'] == '0' ) return ;  

    $layout = !empty($opt_theme_options['opt_client_logo_layout']) ? $opt_theme_options['opt_client_logo_layout'] : 'layout1';
     
    $classes = join(' ',array('red-client-logo',$class,$layout));

    
    echo '<div id="red-client-logo" class="'. esc_attr($classes) .'">';
        echo '<div class="container">';
            switch ($layout) {
                case 'layout1':
                    $logo_clients = isset($opt_theme_options['opt_client_logo_white']) ? $opt_theme_options['opt_client_logo_white'] : array();
                    if(!empty($logo_clients)){
                        $array_id = explode(",", $logo_clients);
                        echo '<div class="client-logo-outer">';
                        echo '<div id="footer-client-logo" class="red-carousel owl-carousel">';
                            foreach($array_id as $i => $image_id):
                                $attachment_image = wp_get_attachment_image_src($image_id, 'full', false);
                                if($attachment_image){
                                    $opt_client_logo_link = !empty($opt_theme_options['opt_client_logo_link']) ? $opt_theme_options['opt_client_logo_link'] : '';
                                    echo '<div class="red-carousel-item red-client-logo-item">';
                                        if(!empty($opt_client_logo_link)){
                                            $link_arrs = explode(',',$opt_client_logo_link );
                                        }else{
                                            $link_arrs = array();
                                        }
                                        if(count($link_arrs) > 0){
                                            foreach($link_arrs as $key => $link_url) {
                                                if($key == $i){
                                                    echo '<a href="'.esc_url($link_url).'">';
                                                        echo '<img src="'.esc_url( $attachment_image[0]).'"/>';        
                                                    echo '</a>';
                                                }
                                            }
                                        }else{
                                            echo '<img src="'.esc_url( $attachment_image[0]).'"/>';
                                        }
                                         
                                    echo '</div>';
                                }
                            endforeach;
                        echo '</div>';
                        echo '</div>';
                    }
                break; 
                case 'layout2':
                    $logo_clients = isset($opt_theme_options['opt_client_logo_white']) ? $opt_theme_options['opt_client_logo_white'] : array();
                    if(!empty($logo_clients)){
                        $array_id = explode(",", $logo_clients);
                        echo '<div class="client-logo-outer">';
                        echo '<div id="footer-client-logo" class="red-carousel owl-carousel">';
                            foreach($array_id as $i => $image_id):
                                $attachment_image = wp_get_attachment_image_src($image_id, 'full', false);
                                if($attachment_image){
                                    $opt_client_logo_link = !empty($opt_theme_options['opt_client_logo_link']) ? $opt_theme_options['opt_client_logo_link'] : '';
                                    echo '<div class="red-carousel-item red-client-logo-item">';
                                        if(!empty($opt_client_logo_link)){
                                            $link_arrs = explode(',',$opt_client_logo_link );
                                        }else{
                                            $link_arrs = array();
                                        }
                                        if(count($link_arrs) > 0){
                                            foreach($link_arrs as $key => $link_url) {
                                                if($key == $i){
                                                    echo '<a href="'.esc_url($link_url).'">';
                                                        echo '<img src="'.esc_url( $attachment_image[0]).'" alt=""/>';        
                                                    echo '</a>';
                                                }
                                            }
                                        }else{
                                            echo '<img src="'.esc_url( $attachment_image[0]).'" alt=""/>';
                                        }
                                    echo '</div>';
                                }
                            endforeach;
                        echo '</div>';
                        echo '</div>';
                    }
                break;
                case 'layout3':
                    $logo_clients = isset($opt_theme_options['opt_client_logo_dark']) ? $opt_theme_options['opt_client_logo_dark'] : array();
                    if(!empty($logo_clients)){
                        $array_id = explode(",", $logo_clients);
                        echo '<div class="client-logo-outer">';
                        echo '<div id="footer-client-logo" class="red-carousel owl-carousel">';
                            foreach($array_id as $i => $image_id):
                                $attachment_image = wp_get_attachment_image_src($image_id, 'full', false);
                                if($attachment_image){
                                    $opt_client_logo_link = !empty($opt_theme_options['opt_client_logo_link']) ? $opt_theme_options['opt_client_logo_link'] : '';
                                    echo '<div class="red-carousel-item red-client-logo-item">';
                                        if(!empty($opt_client_logo_link)){
                                            $link_arrs = explode(',',$opt_client_logo_link );
                                        }else{
                                            $link_arrs = array();
                                        }
                                        if(count($link_arrs) > 0){
                                            foreach($link_arrs as $key => $link_url) {
                                                if($key == $i){
                                                    echo '<a href="'.esc_url($link_url).'">';
                                                        echo '<img src="'.esc_url( $attachment_image[0]).'" alt=""/>';        
                                                    echo '</a>';
                                                }
                                            }
                                        }else{
                                            echo '<img src="'.esc_url( $attachment_image[0]).'" alt=""/>';
                                        }
                                    echo '</div>';
                                }
                            endforeach;
                        echo '</div>';
                        echo '</div>';
                    }
                break;
            }
        echo '</div>';
    echo '</div>';
   
    wp_enqueue_script('vc_pageable_owl-carousel');
    wp_enqueue_script('red-owlcarousel');
    wp_enqueue_style( 'vc_pageable_owl-carousel-css');
    wp_enqueue_style( 'animate-css');
    $rtl = is_rtl() ? true : false;
    $cms_carousel['footer-client-logo'] = array(
        'loop' => true,
        'mouseDrag' => true,
        'nav' => false,
        'dots' => false,
        'margin' => 45,
        'autoplay' => false,
        'autoplayTimeout' => 2000,
        'smartSpeed' => 1500,
        'autoplayHoverPause' => true,
        'navText' => array('<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'),
        'responsive'         => array(
            0 => array(
                'items' => 1,
            ),
            480 => array(
                "items" => 3,
            ),
            768 => array(
                'items' => 4,
            ),
            992 => array(
                'items' => 5,
            ),
            1200 => array(
                'items' => 5,
            ) 
        )
    );
    wp_localize_script('vc_pageable_owl-carousel', 'cmscarousel', $cms_carousel);
     
}

/**
 * Footer area
 * @since 1.0.0
 * @author Red Team
 */
function givingwalk_footer(){
    global $opt_theme_options, $opt_meta_options;
    if(isset($opt_theme_options) && ( $opt_theme_options['opt_client_logo_enable'] == '1' || (is_page() && isset($opt_meta_options['opt_client_logo_custom']) && $opt_meta_options['opt_client_logo_custom'] =='1')))
        echo '<footer id="red-footer" class="red-footer has-client-top" >';
    else
        echo '<footer id="red-footer" class="red-footer" >';
            echo '<div class="red-footer-wrap">';
                givingwalk_footer_top();
                givingwalk_footer_bottom(); 
            echo '</div>';
        echo '</footer>';
}
/* Footer top */
function givingwalk_footer_top($class = ''){
    global $opt_theme_options, $opt_meta_options;
     
    if( !isset($opt_theme_options) )
        return;

    if( is_page() && isset($opt_meta_options['opt_footer_top_custom']) && $opt_meta_options['opt_footer_top_custom'] =='0')
        return;

    if( is_page() && isset($opt_meta_options['opt_footer_top_custom']) && $opt_meta_options['opt_footer_top_custom'] =='1'){
        $opt_theme_options['opt_enable_footer_top'] = '1' ;
        if( !empty($opt_meta_options['opt_footer_top_layout']) )
            $opt_theme_options['opt_footer_top_layout'] = $opt_meta_options['opt_footer_top_layout'];
        if( !empty($opt_meta_options['opt_footer_logo']['url']) )
            $opt_theme_options['opt_footer_logo']['url'] = $opt_meta_options['opt_footer_logo']['url'];
        if( !empty($opt_meta_options['opt_footer_logo_url']) )
            $opt_theme_options['opt_footer_logo_url'] = $opt_meta_options['opt_footer_logo_url'];
    }

    if( $opt_theme_options['opt_enable_footer_top'] == '0' ) return ;

    $layout = !empty($opt_theme_options['opt_footer_top_layout']) ? $opt_theme_options['opt_footer_top_layout'] : 'layout1';
     
    $classes = join(' ',array('red-footer-top',$class,$layout));

    $_class = "";
    $grid = round(12 / $opt_theme_options['opt_footer_top_column_2']);
    $_class = 'col-md-6 col-lg-'.$grid;
      
    echo '<div id="red-footer-top" class="'. esc_attr($classes) .'">';
        echo '<div class="red-footer-top-wrap">';
            echo '<div class="container">';
                switch ($layout) {
                    case 'layout1':
                        echo '<div class="row">';
                            echo '<div class="col text-center">';
                                if(!empty($opt_theme_options['opt_footer_logo']['url'])) {
                                    $footer_logo_url = !empty($opt_theme_options['opt_footer_logo_url']) ? $opt_theme_options['opt_footer_logo_url'] : home_url('/') ;
                                    echo '<a class="footer-logo" href="' . esc_url($footer_logo_url) . '"><img alt="' .  get_bloginfo( "name" ) . '" src="' . esc_url($opt_theme_options['opt_footer_logo']['url']) . '"></a>';
                                }
                            echo '</div>';
                        echo '</div>';
                        if ( is_active_sidebar( 'sidebar-footer-top-layout1-col1' ) || is_active_sidebar( 'sidebar-footer-top-layout1-col2' ) ){
                            echo '<div class="row justify-content-center">';
                                if ( is_active_sidebar( 'sidebar-footer-top-layout1-col1' ) ){
                                    echo '<div class="col-12 col-md-6 col-lg-6 col-xl-4 footer-top-wg column-1">';
                                        dynamic_sidebar( 'sidebar-footer-top-layout1-col1' );
                                    echo '</div>';
                                }
                                if ( is_active_sidebar( 'sidebar-footer-top-layout1-col2' ) ){
                                    echo '<div class="col-12 col-md-6 col-lg-6 col-xl-4 footer-top-wg column-2">';
                                        dynamic_sidebar( 'sidebar-footer-top-layout1-col2' );  
                                    echo '</div>';
                                }
                            echo '</div>';
                        }
                    break; 
                    case 'layout2':
                    case 'layout3':
                        echo '<div class="row">';
                        if ( is_active_sidebar( 'sidebar-footer-top-layout23-col1' ) || !empty($opt_theme_options['opt_footer_logo']['url'])){
                            echo '<div class="' . esc_html($_class) . ' footer-top-wg column-1">';
                                if(!empty($opt_theme_options['opt_footer_logo']['url'])) {
                                    $footer_logo_url = !empty($opt_theme_options['opt_footer_logo_url']) ? $opt_theme_options['opt_footer_logo_url'] : home_url('/') ;
                                    echo '<a class="footer-logo" href="' . esc_url($footer_logo_url) . '"><img alt="' .  get_bloginfo( "name" ) . '" src="' . esc_url($opt_theme_options['opt_footer_logo']['url']) . '"></a>';
                                } 
                                dynamic_sidebar( 'sidebar-footer-top-layout23-col1' );
                            echo "</div>";
                        } 
                        for($i = 2 ; $i <= $opt_theme_options['opt_footer_top_column_2'] ; $i++){
                            if ( is_active_sidebar( 'sidebar-footer-top-layout23-col' . $i ) ){
                                echo '<div class="' . esc_html($_class) . ' footer-top-wg column-'.$i.'">';
                                    dynamic_sidebar( 'sidebar-footer-top-layout23-col' . $i );
                                echo "</div>";
                            }
                        }
                        echo '</div>';
                    break;
                }
            echo '</div>';
        echo '</div>';
    echo '</div>';
 
}


/** Footer Bottom 
*/
function givingwalk_footer_bottom( $class = ''){
    global $opt_theme_options, $opt_meta_options;

    if(!isset($opt_theme_options))
        return;

    if( is_page() && isset($opt_meta_options['opt_enable_footer_bottom']) && $opt_meta_options['opt_enable_footer_bottom'] == '0') 
        return;

    if( is_page() && !empty($opt_meta_options['opt_footer_bottom_layout']) )
        $opt_theme_options['opt_footer_bottom_layout'] = $opt_meta_options['opt_footer_bottom_layout'];

    $layout = isset($opt_theme_options['opt_footer_bottom_layout']) ? $opt_theme_options['opt_footer_bottom_layout'] : 'layout1';

    $classes = join(' ',array('red-footer-bottom',$class,$layout));

    $container_cls = (isset($opt_theme_options['opt_footer_bottom_container_fullwidth']) && $opt_theme_options['opt_footer_bottom_container_fullwidth'] == '1') ? 'container-fullwidth': 'container';
    echo '<div id="red-footer-bottom" class="'. esc_attr($classes) .'">';
        echo '<div class="red-footer-bottom-wrap">';
            echo '<div class="'.esc_attr($container_cls).' text-center">';
            switch ($layout) {
                case 'layout1' :  
                    echo '<aside class="copyright">';
                        if(!empty($opt_theme_options['opt_footer_bottom_copyright'])) {
                            echo wp_kses_post($opt_theme_options['opt_footer_bottom_copyright']);
                        } else {
                            printf( '&copy; %s %s by %s. %s', date('Y') , get_bloginfo('name'), '<a href="'.esc_url('https://themeforest.net/user/redexp').'"> '.esc_html__('Red Exp','givingwalk').'</a>',esc_html__('All Rights Reserved.','givingwalk'));
                        }
                    echo '</aside>';
                break;
                case 'layout2' : 
                    if( is_active_sidebar( 'sidebar-footer-bottom' ) ){
                        echo '<div class="row justify-content-between">';
                            echo '<div class="col-12 col-lg-auto">';
                                echo '<aside class="copyright">';
                                    if(!empty($opt_theme_options['opt_footer_bottom_copyright'])) {
                                        echo wp_kses_post($opt_theme_options['opt_footer_bottom_copyright']);
                                    } else {
                                        printf( '&copy; %s %s by %s. %s', date('Y') , get_bloginfo('name'), '<a href="'.esc_url('https://themeforest.net/user/redexp').'"> '.esc_html__('Red Exp','givingwalk').'</a>',esc_html__('All Rights Reserved.','givingwalk'));
                                    }
                                echo '</aside>';
                            echo '</div>';
                            echo '<div class="col-12 col-lg-auto">';
                                dynamic_sidebar( 'sidebar-footer-bottom');
                            echo '</div>';
                        echo '</div>';
                    }else{
                        echo '<aside class="copyright">';
                            if(!empty($opt_theme_options['opt_footer_bottom_copyright'])) {
                                echo wp_kses_post($opt_theme_options['opt_footer_bottom_copyright']);
                            } else {
                                printf( '&copy; %s %s by %s. %s', date('Y') , get_bloginfo('name'), '<a href="'.esc_url('https://themeforest.net/user/redexp').'"> '.esc_html__('Red Exp','givingwalk').'</a>',esc_html__('All Rights Reserved.','givingwalk'));
                            }
                        echo '</aside>';
                    }
                break;
                case 'layout3' :
                    if( is_active_sidebar( 'sidebar-footer-bottom' ) ){
                        echo '<div class="row justify-content-between">';
                            echo '<div class="col-12 col-lg-auto">';
                                echo '<aside class="copyright">';
                                    if(!empty($opt_theme_options['opt_footer_bottom_copyright'])) {
                                        echo wp_kses_post($opt_theme_options['opt_footer_bottom_copyright']);
                                    } else {
                                        printf( '&copy; %s %s by %s. %s', date('Y') , get_bloginfo('name'), '<a href="'.esc_url('https://themeforest.net/user/redexp').'"> '.esc_html__('Red Exp','givingwalk').'</a>',esc_html__('All Rights Reserved.','givingwalk'));
                                    }
                                echo '</aside>';
                            echo '</div>';
                            echo '<div class="col-12 col-lg-auto">';
                                dynamic_sidebar( 'sidebar-footer-bottom');
                            echo '</div>';
                        echo '</div>';
                    }else{
                        echo '<aside class="copyright">';
                            if(!empty($opt_theme_options['opt_footer_bottom_copyright'])) {
                                echo wp_kses_post($opt_theme_options['opt_footer_bottom_copyright']);
                            } else {
                                printf( '&copy; %s %s by %s. %s', date('Y') , get_bloginfo('name'), '<a href="'.esc_url('https://themeforest.net/user/redexp').'"> '.esc_html__('Red Exp','givingwalk').'</a>',esc_html__('All Rights Reserved.','givingwalk'));
                            }
                        echo '</aside>';
                    }
                break;
            } 
            echo '</div>';
        echo '</div>';
    echo '</div>';
}


/**
 * Get size information for all currently-registered image sizes.
 *
 * @global $_wp_additional_image_sizes
 * @uses   get_intermediate_image_sizes()
 * @return array $sizes Data for all currently-registered image sizes.
 */
function givingwalk_get_image_sizes() {
    global $_wp_additional_image_sizes;
    $sizes = array();
    foreach ( get_intermediate_image_sizes() as $_size ) {
        if ( in_array( $_size, array('thumbnail', 'medium', 'medium_large', 'large') ) ) {
            $sizes[ $_size ]['width']  = get_option( "{$_size}_size_w" );
            $sizes[ $_size ]['height'] = get_option( "{$_size}_size_h" );
            $sizes[ $_size ]['crop']   = (bool) get_option( "{$_size}_crop" );
        } elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
            $sizes[ $_size ] = array(
                'width'  => $_wp_additional_image_sizes[ $_size ]['width'],
                'height' => $_wp_additional_image_sizes[ $_size ]['height'],
                'crop'   => $_wp_additional_image_sizes[ $_size ]['crop'],
            );
        }
    }
    return $sizes;
}

/**
 * Get size information for a specific image size.
 *
 * @uses   givingwalk_get_image_sizes()
 * @param  string $size The image size for which to retrieve data.
 * @return bool|array $size Size data about an image size or false if the size doesn't exist.
 */
function givingwalk_get_image_size( $size ) {
    $sizes = givingwalk_get_image_sizes();

    if ( isset( $sizes[ $size ] ) ) {
        return $sizes[ $size ];
    }
    return false;
}

/**
 * Get the width of a specific image size.
 *
 * @uses   givingwalk_get_image_size()
 * @param  string $size The image size for which to retrieve data.
 * @return bool|string $size Width of an image size or false if the size doesn't exist.
 */
function givingwalk_get_image_width( $size ) {
    if ( ! $size = givingwalk_get_image_size( $size ) ) {
        return false;
    }
    if ( isset( $size['width'] ) ) {
        return $size['width'];
    }
    return false;
}

/**
 * Get the height of a specific image size.
 *
 * @uses   givingwalk_get_image_size()
 * @param  string $size The image size for which to retrieve data.
 * @return bool|string $size Height of an image size or false if the size doesn't exist.
 */
function givingwalk_get_image_height( $size ) {
    if ( ! $size = givingwalk_get_image_size( $size ) ) {
        return false;
    }
    if ( isset( $size['height'] ) ) {
        return $size['height'];
    }
    return false;
}

/**
 * Change search form
 **/
function givingwalk_my_search_form( $form ) {
    $post_type = get_post_type();
    switch ($post_type) {
        case 'product':
            $search_query = '<input type="hidden" name="post_type" value="product" />';
            break;
        default:
            $search_query = '';
            break;
    }
    $form = '<form method="get" action="'. esc_url( home_url( '/'  ) ).'" class="red-searchform">
        <input type="text" value="' . get_search_query() . '" name="s" class="form-control" placeholder="'.esc_attr__("Enter your keyword",'givingwalk').'" id="modal-search-input">';
    $form .= wp_kses_post($search_query);
    $form .='<button type="submit" value="Search" class="searchsubmit"><i class="fa fa-search"></i></button>';
    $form .='</form>';
    return $form;
}
add_filter( 'get_search_form', 'givingwalk_my_search_form' );

function givingwalk_advanced_search_allow_post_type($key_is_title = true)
{
    $result = [
         'crw_causes'=>esc_html__('Causes', 'givingwalk'),
         'crw_stories'=>esc_html__('Stories', 'givingwalk'),
         'tribe_events'=>esc_html__('Events', 'givingwalk'),

    ];
    if($key_is_title)
        $result = array_flip($result);
    return $result;
}
function givingwalk_get_category_name_of($post_type = '')
{
    $map = [
        'crw_causes'=>'crw_causes_cat',
        'crw_stories'=>'crw_stories_cat',
        'tribe_events'=>'tribe_events_cat',
    ];
    $cat = '';
    if(array_key_exists($post_type,$map))
        $cat = $map[$post_type];
    return $cat;
}
function givingwalk_get_category_of($post_type = '')
{
    $cat = givingwalk_get_category_name_of($post_type);
    if(empty($cat))
        $cat = 'category';
    return givingwalk_get_terms($cat);
}
add_action('init','givingwalk_maybe_is_advanced_search_query');
function givingwalk_maybe_is_advanced_search_query()
{
    $allow_target = givingwalk_advanced_search_allow_post_type();
    if(isset($_GET['search']) && $_GET['search']== 'advanced' && isset($_GET['target']) && in_array($_GET['target'],$allow_target))
        add_action( 'pre_get_posts', 'givingwalk_advanced_search_query' );
}

function givingwalk_advanced_search_query( $query ) {

    if(!$query instanceof WP_Query)
            return;
    if ( ! is_admin() && $query->is_main_query()) {
        $post_type = $_GET['target'];
        $query->set( 'post_type',$post_type);
        $cat = (isset($_GET['cat'])) ? $_GET['cat'] : '';
        if(!empty($cat))
        {
            $tax_query = $query->get('tax_query');
            if(!is_array($tax_query))
                $tax_query = [];
            $tax_query[] = [
                'taxonomy' => givingwalk_get_category_name_of($post_type),
                'field'    => 'slug',
                'terms'    => $cat,
            ];
            $query->set('tax_query',$tax_query);
        }
    }
}

//add_filter('template_include', 'givingwalk_advanced_search_template', 99);
function givingwalk_advanced_search_template( $template ) {
    if ( isset( $_REQUEST['search'] ) && $_REQUEST['search'] == 'advanced' && is_search() ) {
        $t = locate_template('advanced-search-template.php');
        if ( ! empty($t) ) {
        $template = $t;
        }
    }
    return $template;
}