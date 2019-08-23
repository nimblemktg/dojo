<?php
/**
 * Language direction 
 * @since 1.0.0
 * @author Red Team
*/

function givingwalk_direction(){
    $givingwalk_direction = is_rtl() ? 'dir-right' : 'dir-left';
    return $givingwalk_direction;
}
/* get text-align left / right for RTL language */
function givingwalk_align(){
    $givingwalk_align = is_rtl() ? 'right' : 'left';
    return $givingwalk_align;
}
function givingwalk_align2(){
    $givingwalk_align = is_rtl() ? 'left' : 'right';
    return $givingwalk_align;
}
 
/**
 * Add browser name to body class
 * Add Theme Class 
 * @since 1.0.0
 * @author Red Team
*/
add_filter('body_class', function ($classes) {
    global $is_gecko, $is_IE, $is_opera, $is_safari, $is_chrome, $is_iphone,
           $opt_theme_options, $opt_meta_options;
    
    /* Theme Class */
    $classes[] = 'red-body';
    $classes[] = is_rtl() ? 'rtl' : 'ltr';
    if(is_front_page()) $classes[] = 'home';

    if( isset($opt_theme_options['opt_dark_version']) && $opt_theme_options['opt_dark_version'] == '1')
        $classes[] = 'is-dark';

    /* Header Layout */
    $header_layout = isset($opt_theme_options['opt_header_layout']) ? $opt_theme_options['opt_header_layout'] : '1';
    if(isset($opt_theme_options)){
        if(is_singular() && isset($opt_meta_options['opt_header_layout']) && $opt_meta_options['opt_header_layout'] != '') $header_layout = $opt_meta_options['opt_header_layout'];
    }
    /* add header layout class. */
    if( empty($header_layout)) {
        $classes[] = 'red-header-layout-1';
    } else {
        $classes[] = 'red-header-layout-'.$header_layout;
    }
    /* add header type class. */
    if(isset($opt_theme_options['opt_header_ontop']) && $opt_theme_options['opt_header_ontop'] && !empty($opt_theme_options['opt_header_ontop_page']) && in_array(get_the_ID(), $opt_theme_options['opt_header_ontop_page'])){
        $classes[] = ' header-ontop-next-no-padding';
    } elseif (isset($opt_theme_options['opt_header_ontop']) && $opt_theme_options['opt_header_ontop'] && empty($opt_theme_options['opt_header_ontop_page'])) {
        $classes[] = '';
    } else {
        $classes[] = '';
    }
    /* Side bar menu */
    switch ($header_layout) {
        case '3':
            $classes[] = 'red-sidebarmenu-on-left';
            break;
        
        default:
            $classes[] = 'red-sidebarmenu-on-right';
            break;
    }
    return $classes; 
});
/* add theme attribute to body tag */
if(!function_exists('givingwalk_body_attributes')){
    function givingwalk_body_attributes(){
        global $opt_theme_options, $opt_meta_options;
        if(!isset($opt_theme_options)) return;
        $body_attr = $styles = array();

        $boxed = isset($opt_theme_options['opt_body_layout']) ? $opt_theme_options['opt_body_layout'] : '';
        if( givingwalk_is_page() && isset($opt_meta_options['opt_body_layout']) && $opt_meta_options['opt_body_layout'] !== '-1')  
            $boxed = $opt_meta_options['opt_body_layout'];

        if($boxed && isset($opt_meta_options['opt_body_layout']) && $opt_meta_options['opt_body_layout'] !== '-1'){
            if(isset($opt_meta_options['opt_body_bg']['background-color']) && !empty($opt_meta_options['opt_body_bg']['background-color'])) 
                $styles[] = 'background-color:'.$opt_meta_options['opt_body_bg']['background-color'];

            if(isset($opt_meta_options['opt_body_bg']['background-image']) && !empty($opt_meta_options['opt_body_bg']['background-image'])) 
                $styles[] = 'background-image:url('.$opt_meta_options['opt_body_bg']['background-image'].')';

            if(isset($opt_meta_options['opt_body_bg']['background-repeat']) && !empty($opt_meta_options['opt_body_bg']['background-repeat'])) 
                $styles[] = 'background-repeat:'.$opt_meta_options['opt_body_bg']['background-repeat'];

            if(isset($opt_meta_options['opt_body_bg']['background-size']) && !empty($opt_meta_options['opt_body_bg']['background-size'])) 
                $styles[] = 'background-size:'.$opt_meta_options['opt_body_bg']['background-size'];

            if(isset($opt_meta_options['opt_body_bg']['background-attachment']) && !empty($opt_meta_options['opt_body_bg']['background-attachment'])) 
                $styles[] = 'background-attachment:'.$opt_meta_options['opt_body_bg']['background-attachment'];

            if(isset($opt_meta_options['opt_body_bg']['background-position']) && !empty($opt_meta_options['opt_body_bg']['background-position'])) 
                $styles[] = 'background-position:'.$opt_meta_options['opt_body_bg']['background-position'];

        }
        if($boxed && isset($opt_meta_options['opt_body_layout']) && $opt_meta_options['opt_body_layout'] !== '-1' ){
            if(isset($opt_meta_options['opt_body_padding']['padding-top'])  && !empty($opt_meta_options['opt_body_padding']['padding-top']))
                $styles[] = 'padding-top:'.$opt_meta_options['opt_body_padding']['padding-top'];

            if(isset($opt_meta_options['opt_body_padding']['padding-right'])  && !empty($opt_meta_options['opt_body_padding']['padding-right']))
                $styles[] = 'padding-right:'.$opt_meta_options['opt_body_padding']['padding-right'];

            if(isset($opt_meta_options['opt_body_padding']['padding-bottom'])  && !empty($opt_meta_options['opt_body_padding']['padding-bottom']))
                $styles[] = 'padding-bottom:'.$opt_meta_options['opt_body_padding']['padding-bottom'];

            if(isset($opt_meta_options['opt_body_padding']['padding-left'])  && !empty($opt_meta_options['opt_body_padding']['padding-left']))
                $styles[] = 'padding-left:'.$opt_meta_options['opt_body_padding']['padding-left'];
        }
       if(!empty($styles)) $body_attr[] = 'style="' . join('; ',$styles) . '"';
        echo join(' ',$body_attr);
    }
}
/**
 * Page Loading .
 * @since 1.0.0
 * @author Red Team
 */
function givingwalk_page_loading() {
    global $opt_theme_options;
    if(!isset($opt_theme_options)) return;
    $loading = isset($opt_theme_options['opt_page_loading']) ? $opt_theme_options['opt_page_loading'] : false;
    if($loading){
        echo '<div id="red-loading" style="height:100vh;">';
        switch ($opt_theme_options['opt_page_loading_style']){
            case '2':
                echo '<div class="spinner wave">
                  <div class="ball ball-1"></div>
                  <div class="ball ball-2"></div>
                  <div class="ball ball-3"></div>
                  <div class="ball ball-4"></div>
                </div>';
                break;
            case '3':
                echo '<div class="spinner circus">
                  <div class="ball ball-1"></div>
                  <div class="ball ball-2"></div>
                  <div class="ball ball-3"></div>
                  <div class="ball ball-4"></div>
                </div>';
                break;
            case '4':
                echo '<div class="spinner atom">
                  <div class="ball ball-1"></div>
                  <div class="ball ball-2"></div>
                  <div class="ball ball-3"></div>
                  <div class="ball ball-4"></div>
                </div>';
                break;
            case '5':
                echo '<div class="spinner fussion">
                  <div class="ball ball-1"></div>
                  <div class="ball ball-2"></div>
                  <div class="ball ball-3"></div>
                  <div class="ball ball-4"></div>
                </div>';
                break;
            case '6':
                echo '<div class="spinner mitosis">
                  <div class="ball ball-1"></div>
                  <div class="ball ball-2"></div>
                  <div class="ball ball-3"></div>
                  <div class="ball ball-4"></div>
                </div>';
                break;
            case '7':
                echo '<div class="spinner flower">
                  <div class="ball ball-1"></div>
                  <div class="ball ball-2"></div>
                  <div class="ball ball-3"></div>
                  <div class="ball ball-4"></div>
                </div>';
                break;
            case '8':
                echo '<div class="spinner clock">
                  <div class="ball ball-1"></div>
                  <div class="ball ball-2"></div>
                  <div class="ball ball-3"></div>
                  <div class="ball ball-4"></div>
                </div>';
                break;
            case '9':
                echo '<div class="spinner washing-machine">
                  <div class="ball ball-1"></div>
                  <div class="ball ball-2"></div>
                  <div class="ball ball-3"></div>
                  <div class="ball ball-4"></div>
                </div>';
                break;
            case '10':
                echo '<div class="spinner pulse">
                  <div class="ball ball-1"></div>
                  <div class="ball ball-2"></div>
                  <div class="ball ball-3"></div>
                  <div class="ball ball-4"></div>
                </div>';
                break;
            default:
                echo '<div class="spinner newton">
                  <div class="ball ball-1"></div>
                  <div class="ball ball-2"></div>
                  <div class="ball ball-3"></div>
                  <div class="ball ball-4"></div>
                </div>';
                break;
        }
        echo '</div>';
    }
}

/**
 * Page Class
 * add html class to page
 * @since 1.0.0
 * @author Red Team
 */
function givingwalk_page_attributes($class = ''){
    global $opt_theme_options, $opt_meta_options;
    $wrapper_attributes = $classes = $styles = array();
    $classes[] = 'red-page';
    /* add boxed class */
    $boxed = isset($opt_theme_options['opt_body_layout']) ? $opt_theme_options['opt_body_layout'] : '';
    if( givingwalk_is_page() && isset($opt_meta_options['opt_body_layout']) && $opt_meta_options['opt_body_layout'] != -1)  
        $boxed = $opt_meta_options['opt_body_layout'];

    if($boxed){
        $classes[] = 'red-boxed';
        if(isset($opt_meta_options['opt_body_layout']) && $opt_meta_options['opt_body_layout'] !== '-1'){
            if(isset($opt_meta_options['opt_body_width']) && !empty($opt_meta_options['opt_body_width']['width']) ) {
                $styles[] = 'max-width:'.$opt_meta_options['opt_body_width']['width'];
            }
            if(isset($opt_meta_options['opt_boxed_bg']) && !empty($opt_meta_options['opt_boxed_bg']) ){
                if(isset($opt_meta_options['opt_boxed_bg']['background-color']) && !empty($opt_meta_options['opt_boxed_bg']['background-color']))
                    $styles[] = 'background-color:'.$opt_meta_options['opt_boxed_bg']['background-color'];

                if(isset($opt_meta_options['opt_boxed_bg']['background-image']) && !empty($opt_meta_options['opt_boxed_bg']['background-image']))
                    $styles[] = 'background-image:url('.$opt_meta_options['opt_boxed_bg']['background-image'].')';

                if(isset($opt_meta_options['opt_boxed_bg']['background-repeat']) && !empty($opt_meta_options['opt_boxed_bg']['background-repeat']))
                    $styles[] = 'background-repeat:'.$opt_meta_options['opt_boxed_bg']['background-repeat'];

                if(isset($opt_meta_options['opt_boxed_bg']['background-size']) && !empty($opt_meta_options['opt_boxed_bg']['background-size']))
                    $styles[] = 'background-size:'.$opt_meta_options['opt_boxed_bg']['background-size'];

                if(isset($opt_meta_options['opt_boxed_bg']['background-attachment']) && !empty($opt_meta_options['opt_boxed_bg']['background-attachment']))
                    $styles[] = 'background-attachment:'.$opt_meta_options['opt_boxed_bg']['background-attachment'];

                if(isset($opt_meta_options['opt_boxed_bg']['background-position']) && !empty($opt_meta_options['opt_boxed_bg']['background-position']))
                    $styles[] = 'background-position:'.$opt_meta_options['opt_boxed_bg']['background-position'];
            }
        }
    }
    $wrapper_attributes[] = 'id="red-page"';
    $wrapper_attributes[] = 'class="' . join(' ',$classes) . '"';
    $wrapper_attributes[] = 'style="' . join('; ',$styles) . '"';

    echo implode( ' ', $wrapper_attributes );
}

/**====== HEADER ========*/
/**
 * get header layout.
 * @since 1.0.0
 * @author Red Team
 */
function givingwalk_header_layout(){
    global $opt_theme_options, $opt_meta_options;

    if(empty($opt_theme_options)){
        get_template_part('inc/header/header', '1');
        return;
    }

    if(is_page() && !empty($opt_meta_options['opt_header_layout']))
        $opt_theme_options['opt_header_layout'] = $opt_meta_options['opt_header_layout'];

    /* load custom header template. */
    get_template_part('inc/header/header', $opt_theme_options['opt_header_layout']);
}
/**
 * get header class.
 * @since 1.0.0
 * @author Red Team
 */
function givingwalk_header_class($class = ''){
    global $opt_theme_options, $opt_meta_options;
    $classes = array();
    $classes[] = 'red-header';
    $header_ontop_cls = 'header-default';
    /* Header Layout */
    $header_layout = isset($opt_theme_options['opt_header_layout']) ? $opt_theme_options['opt_header_layout'] : '1';
    /* Ontop Page */
    $ontop_page = array();
    if(isset($opt_theme_options['opt_header_ontop']) && $opt_theme_options['opt_header_ontop'] ) {
        if(isset($opt_theme_options['opt_header_ontop_page'])) $ontop_page = $opt_theme_options['opt_header_ontop_page'];
        if(empty($ontop_page)){
            $header_ontop_cls = 'header-ontop';
            if($opt_theme_options['opt_header_sticky']) $classes[] = 'header-ontop-sticky';
        } else {
            if(in_array(get_the_ID(), $ontop_page)) {
                $header_ontop_cls = 'header-ontop';
                if($opt_theme_options['opt_header_sticky']) $classes[] = 'header-ontop-sticky';
            } elseif (!in_array(get_the_ID(), $ontop_page)) {
                $header_ontop_cls = 'header-default';
            }
        }
    }
    $classes[] = $header_ontop_cls;
    $classes[] = 'red-header-'.$header_layout;
    if(isset($opt_theme_options['opt_header_sticky']) && $opt_theme_options['opt_header_sticky'] ){
        $classes[] = 'sticky-on';
        if(isset($opt_theme_options['opt_mobile_sticky']) && $opt_theme_options['opt_mobile_sticky'] ){
            $classes[] = 'sticky-mobile-on';
        }
    } 

    $classes[] = $class;
    
    echo join(' ',$classes);
}

if(!function_exists('givingwalk_header_inner_class')){
    function givingwalk_header_inner_class($class = ''){
        global $opt_theme_options, $opt_meta_options;
        $classes = array();
        $classes[] = 'red-header-inner';
        $header_inner_width = isset($opt_theme_options['opt_header_fullwidth']) ? $opt_theme_options['opt_header_fullwidth'] : '';
        if(is_singular() && isset($opt_meta_options['opt_header_fullwidth']) && $opt_meta_options['opt_header_fullwidth'] !=='-1')
            $header_inner_width = $opt_meta_options['opt_header_fullwidth'];
        if($header_inner_width){
            $classes[] = 'container-fluid';
        } else {
            $classes[] = 'container';
        }
        $classes[] = $class;
        $classes[] = 'clearfix';
        echo join(' ',$classes);
    }
}

/**
 * get Header Slider .
 */
function givingwalk_header_rev_slider() {
    global $opt_theme_options;
    if (!class_exists('RevSlider') || !$opt_theme_options['opt_show_header_slider'] || empty($opt_theme_options['opt_header_slider'])) return;
    if(empty($opt_theme_options['opt_header_slider_page'])){
    ?>
        <div class="red-header-rev-slider">
            <?php echo do_shortcode('[rev_slider alias="'.$opt_theme_options['opt_header_slider'].'"]'); ?>
        </div>
    <?php
    } elseif(in_array(get_the_ID(), $opt_theme_options['opt_header_slider_page'])) {
    ?>
        <div class="red-header-rev-slider">
            <?php echo do_shortcode('[rev_slider alias="'.$opt_theme_options['opt_header_slider'].'"]'); ?>
        </div>
    <?php
    }
}
/* Header top */
function givingwalk_header_top(){
    global $opt_theme_options, $opt_meta_options;
    $opt_header_top = isset($opt_theme_options['opt_header_top']) ? $opt_theme_options['opt_header_top'] : false;
    if (isset($opt_meta_options['opt_header_top']) && $opt_meta_options['opt_header_top'] !== '-1') 
        $opt_header_top = $opt_meta_options['opt_header_top'];

    $header_top_inner_width = isset($opt_theme_options['opt_header_top_fullwidth']) ? $opt_theme_options['opt_header_top_fullwidth'] : '';
    if($header_top_inner_width){
        $container_class = 'container-fluid';
    } else {
        $container_class = 'container';
    }

    if (is_singular() && isset($opt_meta_options['opt_social_header_top']) && !empty($opt_meta_options['opt_social_header_top'])) 
        $opt_theme_options['opt_social_header_top'] = $opt_meta_options['opt_social_header_top'];
    
    if( !$opt_header_top || (!is_active_sidebar('sidebar-header-top-1') && !is_active_sidebar('sidebar-header-top-2') && !$opt_header_top )) return;
?>
    <div id="red-header-top" class="red-header-top clearfix">
        <div class="<?php echo esc_attr($container_class);?>">
            <div class="row">
            <?php 
                $cls = 'col-md-12';
                if(is_active_sidebar( 'sidebar-header-top-1') && (is_active_sidebar( 'sidebar-header-top-2') || $opt_theme_options['opt_social_header_top'] ) ) $cls = 'col-md-6';  
                if(is_active_sidebar( 'sidebar-header-top-1')) {
                    echo '<div class="'.esc_attr($cls).' text-center text-md-'.givingwalk_align().'">';
                        dynamic_sidebar( 'sidebar-header-top-1');
                    echo '</div>';
                }
                if(is_active_sidebar( 'sidebar-header-top-2') || $opt_theme_options['opt_social_header_top']) {
                    echo '<div class="'.esc_attr($cls).' text-center text-md-'.givingwalk_align2().' d-none d-md-block d-lg-block d-xl-block">';
                        if($opt_theme_options['opt_social_header_top']) givingwalk_social_list('<aside class="widget">','</aside>');
                        dynamic_sidebar( 'sidebar-header-top-2');
                    echo '</div>';
                }
            ?>
            </div>
        </div>
    </div>
<?php 
}

/**
 * get theme logo.
 */
function givingwalk_header_logo($class = '', $show_ontop_logo = true, $show_sticky_logo =  true){  
    $classes = array();
    $classes[] = 'red-header-logo';
    $classes[] = $class; 
    global $opt_theme_options, $opt_meta_options;
    $opt_logo_type  = isset($opt_theme_options['opt_logo_type']) ? $opt_theme_options['opt_logo_type'] : '1';
    if($opt_logo_type == '2') $classes[] = 'logo-type-text';

    $opt_header_layout = isset($opt_theme_options['opt_header_layout']) ? $opt_theme_options['opt_header_layout'] : '';

    echo '<div id="red-header-logo" class="'.join(' ',$classes).'">';
        if(isset($opt_theme_options)) {
            $logo_text = isset($opt_theme_options['opt_main_logo_text']) && !empty($opt_theme_options['opt_main_logo_text']) ? $opt_theme_options['opt_main_logo_text'] : get_bloginfo('name');
            $slogan = isset($opt_theme_options['opt_main_logo_slogan']) && !empty($opt_theme_options['opt_main_logo_slogan']) ? $opt_theme_options['opt_main_logo_slogan'] : get_bloginfo('description');
            $title = esc_html($logo_text).' - '.esc_html($slogan);

            if(is_singular() && !empty($opt_meta_options['opt_header_layout'])) $opt_theme_options['opt_header_layout'] = $opt_meta_options['opt_header_layout']; 

            if(file_exists(get_template_directory().'/assets/images/logo'.$opt_header_layout.'.png')){
                $_default_logo = get_template_directory_uri() . '/assets/images/logo'.$opt_header_layout.'.png';
            } else {
                $_default_logo = get_template_directory_uri() . '/assets/images/logo.png';
            }

            $default_logo = !empty($opt_theme_options['opt_main_logo']['url']) ? $opt_theme_options['opt_main_logo']['url'] : $_default_logo;
            $ontop_logo = !empty($opt_theme_options['opt_header_ontop_logo']['url']) ? $opt_theme_options['opt_header_ontop_logo']['url'] : get_template_directory_uri() . '/assets/images/logo-ontop.png';
            $sticky_logo = !empty($opt_theme_options['opt_header_sticky_logo']['url']) ? $opt_theme_options['opt_header_sticky_logo']['url'] : $ontop_logo ;

            /* Custom logo on page */
            if(is_page() && isset($opt_meta_options['opt_page_logo']) && !empty($opt_meta_options['opt_page_logo']['url'])) {
                $default_logo = $ontop_logo = $sticky_logo = $opt_meta_options['opt_page_logo']['url'];
            }

            echo '<a href="' . esc_url(home_url('/')) . '" title="'.esc_html($title).'" class="header-'.esc_attr($opt_header_layout).'">';
                $opt_logo_type = isset($opt_theme_options['opt_logo_type']) ? $opt_theme_options['opt_logo_type'] : '1';
                switch ($opt_logo_type) {
                    case '2':
                        /* Logo Text */
                        echo '<div class="logo-text">'.esc_html($logo_text).'</div>'; 
                        echo '<div class="logo-slogan">'.esc_html($slogan).'</div>';
   
                    break;
                    
                    default:
                        /* Main Logo */
                        if(!empty($default_logo)) echo '<img class="main-logo" alt="' . esc_attr($title). '" src="' . esc_url($default_logo) . '"/>'; 
                        /* On Top Logo */
                        if(!empty($ontop_logo) && $show_ontop_logo) {
                            echo '<img class="ontop-logo" alt="' . esc_attr($title). '" src="' . esc_url($ontop_logo) . '"/>';
                        }
                        /* Sticky Logo */
                        if(!empty($sticky_logo) && $show_sticky_logo) echo '<img class="sticky-logo" alt="' . esc_attr($title). '" src="' . esc_url($sticky_logo) . '"/>';

                    break;
                }

            echo '</a>';
        } else {
            echo '<a class="default" href="' . esc_url(home_url('/')) . '" title="'.get_bloginfo('name').'"><img alt="' . get_bloginfo('name'). ' - '.get_bloginfo('description').'" src="' . get_template_directory_uri() . '/assets/images/logo.png"></a>';
        }
    echo '</div>';
}

/**
 * main navigation.
 */

function givingwalk_header_navigation($class=''){
    global $opt_theme_options, $opt_meta_options;
    if(is_page_template('page-templates/coming-soon.php')) return;
    $dir = is_rtl() ? 'dir-right' : 'dir-left';
    $attr = array(
        'menu_class'        => 'main-nav '.$dir, /* add class when have not existed menu, load page list only */
        'container_class'   => 'container_class red-main-navigation clearfix', /* add class when have existed menu */
        'theme_location'    => 'primary',
        'link_before'       => '<span class="menu-title">',
        'link_after'        => '</span>',
        'fallback_cb'       => false /* Empty menu if doesn't exists */
    );
    /* get menu for each page */
    if(is_page() && isset($opt_meta_options['opt_header_menu']) && !empty($opt_meta_options['opt_header_menu'])){
        $opt_theme_options['opt_header_menu'] = $opt_meta_options['opt_header_menu'];
    }
    /* Empty menu for each page */
    if(isset($opt_theme_options['opt_header_menu']) && $opt_theme_options['opt_header_menu'] === 'none') return;
    /* Get menu */
    if(isset($opt_theme_options['opt_header_menu']) && !empty($opt_theme_options['opt_header_menu'])){
        $attr['menu'] = $opt_theme_options['opt_header_menu'];
    } else {
        $attr['menu'] = 'all-pages';
    }
    $attr['menu_class'] .= ' menu-'.$attr['menu'];

    /* enable mega menu. */
    if(class_exists('HeroMenuWalker')){ $attr['walker'] = new HeroMenuWalker(); }

    /* main nav. */
    echo '<nav id="red-navigation" class="red-navigation '.esc_attr($class).'">';
        wp_nav_menu( $attr );
    echo '</nav>';
}

  

/**
 * Header extra attributes search, tool menu, cart, ... icon
 * @since 1.0.0
 * @author Red Team
*/
function givingwalk_header_extra($class = ''){
    $classes = array();
    global $opt_theme_options, $opt_meta_options;
    /* Show Search */
    $show_search = isset($opt_theme_options['opt_show_header_search']) ? $opt_theme_options['opt_show_header_search'] : '';
    if(is_singular() && isset($opt_meta_options['opt_show_header_search']) && $opt_meta_options['opt_show_header_search'] !='-1'){
        $show_search = $opt_meta_options['opt_show_header_search'];
    }
    /* Show Cart */
    $show_cart = isset($opt_theme_options['opt_show_header_search']) ? $opt_theme_options['opt_show_header_search'] : '';
    if(is_singular() && isset($opt_meta_options['opt_show_header_wc_cart']) && $opt_meta_options['opt_show_header_wc_cart'] !='-1'){
        $show_cart = $opt_meta_options['opt_show_header_search'];
    }
    /* Show Tools */
    $show_tool = isset($opt_theme_options['opt_show_header_tool']) ? $opt_theme_options['opt_show_header_tool'] : '';
    if(is_singular() && !$opt_theme_options['opt_show_header_tool'] && isset($opt_meta_options['opt_show_header_tool']) && $opt_meta_options['opt_show_header_tool'] !='-1'){
        $show_tool = $opt_meta_options['opt_show_header_tool'];
    }
     
    /* css Class */
    $opt_social_in_header = isset($opt_theme_options['opt_social_in_header']) ? $opt_theme_options['opt_social_in_header'] : '';

    $show_donate = (isset($opt_theme_options['opt_show_header_donate']) && $opt_theme_options['opt_show_header_donate'] > 0) ? $opt_theme_options['opt_show_header_donate'] : false;
    
    if ($opt_social_in_header || $show_search || $show_cart || $show_tool || $show_donate) { 
        $classes[] = 'has-extra';
    } else {
        $classes[] = 'd-xl-none';
    }
    $classes[] = $class;

    echo '<div class="red-nav-extra '.join(' ',$classes).'">';   
        echo '<div class="red-header-popup clearfix">';
            givingwalk_header_extra_attr_icon();
            givingwalk_header_search();
            givingwalk_header_wc_cart();
            givingwalk_header_tools();
        echo '</div>';
    echo '</div>';
}

function givingwalk_header_extra_attr_icon(){
    global $opt_theme_options, $opt_meta_options, $woocommerce;
    if(is_page_template('page-templates/coming-soon.php') ) return;
    $header_layout = $show_search = $show_cart = $show_tool = '';
    $show_menu = true;
    if(isset($opt_theme_options)){
        /* Header Layout */
        $header_layout = $opt_theme_options['opt_header_layout'];
        if(is_singular() && !empty($opt_meta_options['opt_header_layout'])){
            $header_layout = $opt_meta_options['opt_header_layout'];
        }
         
        /* Show Search */
        $show_search = $opt_theme_options['opt_show_header_search'];
        if(is_singular() && isset($opt_meta_options['opt_show_header_search']) && $opt_meta_options['opt_show_header_search'] !='-1'){
            $show_search = $opt_meta_options['opt_show_header_search'];
        }
        /* Show Cart */
        $show_cart = isset($opt_theme_options['opt_show_header_wc_cart']) ? $opt_theme_options['opt_show_header_wc_cart'] : '';
        if(is_singular() && isset($opt_meta_options['opt_show_header_wc_cart']) && $opt_meta_options['opt_show_header_wc_cart'] != '-1'){
            $show_cart = $opt_meta_options['opt_show_header_wc_cart'];
        }
        /* Show Tool */
        $show_tool = isset($opt_theme_options['opt_show_header_tool']) ? $opt_theme_options['opt_show_header_tool'] : '';
        $display = $opt_theme_options['opt_show_header_tool_screen'];
        if(is_singular() && !$opt_theme_options['opt_show_header_tool'] && isset($opt_meta_options['opt_show_header_tool']) && $opt_meta_options['opt_show_header_tool'] != '-1'){
            $show_tool = $opt_meta_options['opt_show_header_tool'];
            $display   = $opt_meta_options['opt_show_header_tool_screen'];
        }
         
    }

    echo '<div class="red-nav-extra-icon clearfix">';
    /* Social icon list */
    
    switch ($header_layout) {
        default:
            if ($show_search){
            ?>
                <a href="javascript:void(0)" class="header-icon red-header-height search d-none d-md-block d-xl-block d-lg-block" data-display=".red-search" data-no-display=".red-tools, .red-cart, .mobile-nav"><span class="fa fa-search"></span></a>
            <?php }
            if ( $show_cart && in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) )) {
            ?>
                <a href="javascript:void(0)" class="header-icon red-header-height cart d-none d-md-block d-xl-block d-lg-block" data-display=".red-cart" data-no-display=".red-search, .red-tools, .mobile-nav"><span class="flaticon-tool"><span class="cart_total"></span></span></a>
            <?php }
            if ($show_tool && is_active_sidebar('header-tool')){
                $class = '';
                if(!empty($display)){
                    if(!in_array(1, $display)) $class .=' d-xs-none'; else $class .=' d-xs-block';
                    if(!in_array(2, $display)) $class .=' d-sm-none'; else $class .=' d-sm-block';
                    if(!in_array(3, $display)) $class .=' d-md-none'; else $class .=' d-md-block';
                    if(!in_array(4, $display)) $class .=' d-lg-none'; else $class .=' d-lg-block';
                    if(!in_array(5, $display)) $class .=' d-xl-none'; else $class .=' d-xl-block';
                } else {
                    $class = 'd-none';
                } 
            ?>
                <a href="javascript:void(0)" class="header-icon red-header-height tool <?php echo esc_attr($class); ?>" data-display=".red-tools" data-no-display=".red-search, .red-cart, .mobile-nav"><span class="tool-icon fa fa-cogs"></span></a>
            <?php }  
            givingwalk_header_donation();
            givingwalk_header_social();

            /* Mobile Menu Icon */  
            if($show_menu){
                echo '<a id="red-menu-mobile" class="header-icon red-header-height mobile-toogle-menu d-xl-none" data-display=".mobile-nav" data-no-display=".red-search, .red-cart, .red-tools" ><span class="fa fa-bars" title="'.esc_html__('Open Menu','givingwalk').'"></span></a>';
            }
            break;
    }
    echo '</div>';
}

/**
 * Add header Search icon
 * @since 1.0.0
 * @author Red Team
 */
function givingwalk_header_search() {
    if(is_page_template('page-templates/coming-soon.php') ) return;
    global $opt_theme_options, $opt_meta_options;
    if(!isset($opt_theme_options)) return;
    $show_search = $opt_theme_options['opt_show_header_search'];
    if(is_singular() && isset($opt_meta_options['opt_show_header_search']) && $opt_meta_options['opt_show_header_search'] !='-1'){
        $show_search = $opt_meta_options['opt_show_header_search'];
    }
    if ($show_search){
    ?>
        <div class="red-popup red-search">
            <?php get_search_form(); ?>
        </div>
    <?php
    } 
}
/**
 * Add Header WooCommerce Cart 
 * @since 1.0.0
 * @author Red Team
 */
function givingwalk_header_wc_cart() { 
    if(is_page_template('page-templates/coming-soon.php') ) return;
    global $opt_theme_options, $opt_meta_options, $woocommerce;
    if(!isset($opt_theme_options) || !class_exists('WooCommerce')) return;
    /* Page option */
    $show_cart = $opt_theme_options['opt_show_header_wc_cart'];
    if(is_singular() && isset($opt_meta_options['opt_show_header_wc_cart']) && $opt_meta_options['opt_show_header_wc_cart'] != '-1'){
        $show_cart = $opt_meta_options['opt_show_header_wc_cart'];
    }
    if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) && $show_cart ) {
    ?>
        <div class="red-popup woocommerce red-cart red-mousewheel">
            <div class="red-mousewheel-inner widget_shopping_cart">
                <div class="widget_shopping_cart_content">
                    <?php woocommerce_mini_cart(); ?>
                </div>
            </div>
        </div>
    
    <?php
    }
}
add_filter('add_to_cart_fragments', 'givingwalk_add_to_cart_fragment', 10, 1 );
if(!function_exists('givingwalk_add_to_cart_fragment')){
    function givingwalk_add_to_cart_fragment( $fragments ) {
        global $woocommerce;
        ob_start();
        ?>
        <span class="cart_total"><?php echo (WC()->cart->cart_contents_count != '0') ? WC()->cart->cart_contents_count : '0'; ?></span>
        <?php
        $fragments['.cart_total'] = ob_get_clean();
        return $fragments;
    }
}

/**
 * Add Header Tools icon
 * @since 1.0.0
 * @author Red Team
 */
function givingwalk_header_tools() {
    if(is_page_template('page-templates/coming-soon.php') ) return;
    global $opt_theme_options, $opt_meta_options;
    /* Show Tools */
    $show_tool = isset($opt_theme_options['opt_show_header_tool']) ? $opt_theme_options['opt_show_header_tool'] : '';
    if(is_singular() && !$opt_theme_options['opt_show_header_tool'] && isset($opt_meta_options['opt_show_header_tool']) && $opt_meta_options['opt_show_header_tool'] !='-1'){
        $show_tool = $opt_meta_options['opt_show_header_tool'];
    }
    if ($show_tool && is_active_sidebar('header-tool')){
    ?>
        <div class="red-popup red-tools">
            <?php dynamic_sidebar('header-tool'); ?>
        </div>
    <?php
    }
}

/**
 * Add Header Donate Button 
 * @since 1.0.0
 * @author Red Team
 */

function givingwalk_header_donation(){
    global $opt_theme_options, $opt_meta_options, $post;

    if( is_page_template('page-templates/coming-soon.php') || !$opt_theme_options) return;
    $header_layout = isset($opt_theme_options['opt_header_layout']) ? $opt_theme_options['opt_header_layout'] : '';
    $show_donate = (isset($opt_theme_options['opt_show_header_donate']) && $opt_theme_options['opt_show_header_donate'] >0) ? $opt_theme_options['opt_show_header_donate'] : false;
    $url1 = isset($opt_theme_options['opt_header_donate_url']) ? $opt_theme_options['opt_header_donate_url'] : '';
    $url2 = isset($opt_theme_options['opt_header_donate_url2']) ? $opt_theme_options['opt_header_donate_url2'] : '';
    if(givingwalk_is_page()){
        if( isset($opt_meta_options['opt_header_layout']) && $opt_meta_options['opt_header_layout'] !== '-1' )
            $header_layout = $opt_meta_options['opt_header_layout'];

        if(isset($opt_meta_options['opt_show_header_donate']) && $opt_meta_options['opt_show_header_donate'] !== '-1'){

            $show_donate = $opt_meta_options['opt_show_header_donate'];

            if(isset($opt_meta_options['opt_header_donate_url']) && !empty($opt_meta_options['opt_header_donate_url']) ) $url1 = $opt_meta_options['opt_header_donate_url'];

            if(isset($opt_meta_options['opt_header_donate_url2']) && !empty($opt_meta_options['opt_header_donate_url2'])) 
                $url2 = $opt_meta_options['opt_header_donate_url2'];
        }
    }
    $page_id = givingwalk_get_page_by_slug($url1);
    $target = '_self';
    $cls = '';

    switch ($show_donate) {
        case '1':
            $url = get_post_type_archive_link( 'crw_causes' );
            break;
        case '2':
            $url = get_permalink($page_id);
            break;
        case '3':
            $url = $url2;
            $target = '_blank';
            break;
        case '4':
            $url = '#';
            break;
        default:
            $url = '#';
            break;
    }
    $icon = '';

    if ($show_donate && !empty($url)){
    ?>
        <span class="header-icon red-header-height donate-btn-wrap d-none d-sm-block d-md-block d-xl-block d-lg-block">
            <?php switch ($header_layout) {
                default:
                    givingwalk_show_donate_button([
                            'id'=>givingwalk_get_first_causes_default(),
                            'class'=>'btn btn-medium',
                            'url'=>$url,
                            'target'=>$target,
                            'title'=>$icon.esc_html__('Donate Now','givingwalk')
                    ]);
                    break; } ?>
        </span>
    <?php }
}

/**====== PAGE TITLE ========*/
/**
 * Page Title 
 * @since 1.0.0
 * @author Red Team
 */
function givingwalk_page_title(){
    global $opt_theme_options, $opt_meta_options;
    $show_page_title = $layout = '1';
    /* default. */
    $content_align = '';
    $option = 'no-option';
    $page_title_containter_class = 'container';
    /* get theme options */
    if(isset($opt_theme_options)){
        $option = '';
        $content_align = isset($opt_theme_options['opt_page_title_align']) ? $opt_theme_options['opt_page_title_align'] : '';
        $show_page_title = isset($opt_theme_options['opt_page_title']) ? $opt_theme_options['opt_page_title'] : true;

        if(isset($opt_theme_options['opt_page_title_layout'])){
            $layout = $opt_theme_options['opt_page_title_layout'];
        }

        /* custom layout from page. */
        if(givingwalk_is_page() && !empty($opt_meta_options['opt_page_title_layout'])){
            $layout = $opt_meta_options['opt_page_title_layout'];
        } 
    } 


    $page_title_class = 'layout'.$layout.' '.$content_align.' '.$option;

    if(!$show_page_title || $layout == 'none' ) return;
    ?>
        <div id="red-page-title-wrapper" class="<?php echo esc_attr('red-page-title-wrapper '.$page_title_class);?>">
            <div class="<?php echo esc_attr('red-page-title-inner '.$page_title_containter_class); ?>">
            <div class="row align-items-center">
            <?php switch ($layout){
                case 'none':
                    break;
                case '1':
                    ?>
                    <div id="red-page-title" class="red-page-title col-md-12"><?php givingwalk_get_page_title(); ?></div>
                    <div class="space col-sm-12"></div>
                    <?php if( function_exists('bcn_display') && !is_front_page()) { ?>
                        <div id="red-breadcrumb" class="red-breadcrumb col-md-12"><?php givingwalk_get_bread_crumb(); ?></div>
                    <?php
                        }
                    break;
                case '2':
                    ?>
                    <?php if(function_exists('bcn_display') && !is_front_page()) { ?>
                    <div id="red-breadcrumb" class="red-breadcrumb col-md-12"><?php givingwalk_get_bread_crumb(); ?></div>
                    <?php } ?>
                    <div class="space col-sm-12"></div>
                    <div id="red-page-title" class="red-page-title col-md-12"><?php givingwalk_get_page_title();  ?></div>
                    <?php
                    break;
                case '3':
                    ?>
                    <div id="red-page-title" class="red-page-title col-lg-6"><?php givingwalk_get_page_title(); ?></div>
                    <?php if(function_exists('bcn_display') && !is_front_page()) { ?>
                    <div id="red-breadcrumb" class="red-breadcrumb col-lg-6 text-lg-right"><?php givingwalk_get_bread_crumb(); ?></div>
                    <?php
                        }
                    break;
                case '4':
                    ?>
                    <?php if(function_exists('bcn_display') && !is_front_page()) { ?>
                    <div id="red-breadcrumb" class="red-breadcrumb col-lg-6"><?php givingwalk_get_bread_crumb(); ?></div>
                    <?php } ?>
                    <div id="red-page-title" class="red-page-title col-lg-6 text-lg-right"><?php givingwalk_get_page_title(); ?></div>
                    <?php
                    break;
                case '5':
                    ?>
                    <div id="red-page-title" class="red-page-title col-md-12"><?php givingwalk_get_page_title(); ?></div>
                    <?php
                    break;
                case '6':
                    ?>
                    <div id="red-breadcrumb" class="red-breadcrumb col-md-12"><?php givingwalk_get_bread_crumb(); ?></div>
                    <?php
                    break;
            } ?>
            </div>
            </div>
        </div><!-- #page-title -->
    <?php   
}
add_action('wp_head','givingwalk_maybe_fix_opt_meta_options',1);
function givingwalk_maybe_fix_opt_meta_options()
{
    global $opt_meta_options,$opt_meta_options_bak;
    if(!is_array($opt_meta_options))
        $opt_meta_options = [];
    if(function_exists('wc_get_page_id') && is_archive() && is_post_type_archive('product') && is_numeric($id = wc_get_page_id('shop')))
        $real_page = get_post($id);
    else
        $real_page =  get_queried_object();
    if($real_page instanceof WP_Post)
    {
        $id = $real_page->ID;
        if($id == get_the_ID())
            return;
        $post_metas = get_post_meta($id);
        $opt_meta_options = [];
        $prefix_option = 'ef3-';
        foreach ($post_metas  as $key => $value) {
            if(strpos($key,$prefix_option) === 0)
            {
                $opt_meta_options[substr($key,strlen($prefix_option))] = maybe_unserialize( $value[0] );
            }
        }
    }
    $opt_meta_options_bak = $opt_meta_options;
}
function givingwalk_recover_opt_meta_options(){
     global $opt_meta_options,$opt_meta_options_bak;
     if(!empty($opt_meta_options_bak))
        $opt_meta_options = $opt_meta_options_bak;
}
function givingwalk_is_page()
{
    global $givingwalk_page_post;
    //check if is woo shop page
    if(function_exists('wc_get_page_id') && is_archive() && is_post_type_archive('product') && is_numeric($id = wc_get_page_id('shop')))
        return true;
    if(!$givingwalk_page_post instanceof WP_Post)
    {
        $givingwalk_page_post = get_queried_object();
    }
    if($givingwalk_page_post instanceof WP_Post)
    {
        return $givingwalk_page_post->post_type == 'page';
    }
    return is_page();
}
/**
 * page title text
 */
function givingwalk_get_page_title(){
    global $opt_theme_options, $opt_meta_options;
    $options = '';
    if(!$opt_theme_options)  $options = 'no-option';
    $subtitle = !empty($opt_theme_options['opt_sub_page_title']) ? $opt_theme_options['opt_sub_page_title'] : '';
    $custom_sub_title = ( givingwalk_is_page() && !empty($opt_meta_options['opt_page_title_subtext']) ) ? $opt_meta_options['opt_page_title_subtext'] : $subtitle;
    echo '<h1 class="red-page-title-text page-title-text '.esc_attr($options).'">';
    if (!is_archive() || givingwalk_is_page()){
        /* page. */
        if(givingwalk_is_page()) :
            /* custom title. */
            $title_text = (isset($opt_meta_options['opt_page_title_text'])) ?  $opt_meta_options['opt_page_title_text'] : '';
            if(!empty($title_text )):
                echo esc_html( $title_text);
            else :
                the_title(); 
            endif;
        elseif (is_front_page()):
            esc_html_e('Our Blog', 'givingwalk');
        /* search */
        elseif (is_search()):
            printf( esc_html__( 'Search Results for: %s', 'givingwalk' ), '<span>' . get_search_query() . '</span>' );
        /* 404 */
        elseif (is_404()):
            esc_html_e( '404', 'givingwalk');
        /* Single Post */
        elseif(is_singular('post') ):
            if(class_exists('EF4Framework'))
                esc_html_e( 'Blog Details', 'givingwalk' );
            else
                the_title();
        /* Single Events */
        elseif ( is_singular( 'tribe_events' ) ):
            esc_html_e( 'Event Details', 'givingwalk' );
        /* Single Stories */
        elseif ( is_singular( 'crw_stories' ) ):
            esc_html_e( 'Stories Details', 'givingwalk' );
        /* Single Causes */
        elseif ( is_singular( 'crw_causes' ) ):
            esc_html_e( 'Causes Details', 'givingwalk' );

        /* other */
        else :
            the_title();
        endif;
    } else {
        /* category. */
        if ( is_category() ) :
            single_cat_title();
        /* tag. */     
        elseif ( is_tag() ) : 
            single_tag_title();
        /* author. */
        elseif ( is_author() ) :
            printf( esc_html__( 'Author: %s', 'givingwalk' ), '<span>' . get_the_author() . '</span>' );
        /* date */
        elseif ( is_day() ) :
            printf( esc_html__( 'Day: %s', 'givingwalk' ), '<span>' . get_the_date() . '</span>' );
        elseif ( is_month() ) :
            printf( esc_html__( 'Month: %s', 'givingwalk' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'givingwalk' ) ) . '</span>' );
        elseif ( is_year() ) :
            printf( esc_html__( 'Year: %s', 'givingwalk' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'givingwalk' ) ) . '</span>' );
        /* post format */
        elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
            esc_html_e( 'Asides', 'givingwalk' );
        elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
            esc_html_e( 'Galleries', 'givingwalk');
        elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
            esc_html_e( 'Images', 'givingwalk');
        elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
            esc_html_e( 'Videos', 'givingwalk' );
        elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
            esc_html_e( 'Quotes', 'givingwalk' );
        elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
            esc_html_e( 'Links', 'givingwalk' );
        elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
            esc_html_e( 'Statuses', 'givingwalk' );
        elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
            esc_html_e( 'Audios', 'givingwalk' );
        elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
            esc_html_e( 'Chats', 'givingwalk' );
        /* woocommerce */
        elseif (function_exists('is_woocommerce') && is_woocommerce()):
            woocommerce_page_title();
        /* Custom taxonomy */
        elseif(is_tax() ):
            $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
            echo esc_html($term->name);
        /* Custom Post type */
        elseif(is_post_type_archive() ):
            post_type_archive_title(esc_html__( 'Our ', 'givingwalk' ));
        else :
            /* other */
            the_title();
        endif;
    }
    echo '</h1>';
    /* custom sub title. */
    if(!empty($custom_sub_title)):
        echo '<span class="sub-title">'.esc_html($custom_sub_title).'</span>';
    endif;
}

/**
 * Breadcrumb NavXT
 *
 * @since 1.0.0
 */
function givingwalk_get_bread_crumb() {
    if(!function_exists('bcn_display')) return;
    echo '<div class="red-breadcrumb-inner">';
    if( is_post_type_archive('tribe_events') || tribe_is_month() || tribe_is_day() || tribe_is_venue() || is_singular('tribe_events') || !empty($_GET['tribe_events_cat']))
        traritywalk_tribe_breadcrumbs();
    else
        bcn_display();
    echo '</div>';
}

function givingwalk_event_bcr_is_child($page_id) {
    global $post;
    if( is_page() && ($post->post_parent != '') ) {
       return true;
    } else {
       return false;
    }
}
 
function traritywalk_tribe_breadcrumbs() {
 
    global $opt_theme_options,$post;
 
    $seperator = !empty($opt_theme_options['opt_event_breadcrumb_sep']) ? '<span class="esep">'.$opt_theme_options['opt_event_breadcrumb_sep'].'</span>' : '<span class="esep">&nbsp;-&nbsp;</span>';

    echo '<a href="'.esc_url(home_url('/')).'">'. esc_html__( 'Home','givingwalk' ).'</a>';
     
    if( tribe_is_month() && !is_tax() ) { // The Main Calendar Page
 
        echo wp_kses_post($seperator);
        echo esc_html__( 'The Events Calendar','givingwalk' );
 
    } elseif( tribe_is_month() && is_tax() ) { // Calendar Category Pages
 
        global $wp_query;
        $term_slug = $wp_query->query_vars['tribe_events_cat'];
        $term = get_term_by('slug', $term_slug, 'tribe_events_cat');
        get_term( $term_id, 'tribe_events_cat' );
        $name = $term->name;
        echo wp_kses_post($seperator);
        echo '<a href="'.tribe_get_events_link().'">'.esc_html__( 'Events','givingwalk' ).'</a>';
        echo wp_kses_post($seperator);
        echo esc_html($name);

    } elseif( !tribe_is_day() && !is_single() ) { // The Main Events List

        echo wp_kses_post($seperator);
        echo esc_html__( 'Events List','givingwalk' );

    } elseif( is_singular('tribe_events') ) { // Single Events
        echo wp_kses_post($seperator);
        echo '<a href="'.tribe_get_events_link().'">'.esc_html__( 'Events','givingwalk' ).'</a>';
        echo wp_kses_post($seperator);
        echo esc_html__( 'Event Details','givingwalk' );

    } elseif( tribe_is_day() ) { // Single Event Days

        global $wp_query;
        echo wp_kses_post($seperator);
        echo '<a href="'.tribe_get_events_link().'">'.esc_html__( 'Events','givingwalk' ).'</a>';
        echo wp_kses_post($seperator);
        echo esc_html__( 'Events on: ','givingwalk' ) . date('F j, Y', strtotime($wp_query->query_vars['eventDate']));

    } elseif( tribe_is_venue() ) { // Single Venues

        echo wp_kses_post($seperator);
        echo '<a href="'.tribe_get_events_link().'">'.esc_html__( 'Events','givingwalk' ).'</a>';
        echo wp_kses_post($seperator);
        the_title();

    } elseif (is_category() || is_single()) {

        echo wp_kses_post($seperator);
        the_category(' &bull; ');
        if (is_single()) {
            echo ' '.$seperator.' ';
            the_title();
        }

    } elseif (is_page()) {
 
        if(givingwalk_event_bcr_is_child(get_the_ID())) {
            echo wp_kses_post($seperator);
            echo '<a href="' . get_permalink($post->post_parent) . '">' . get_the_title($post->post_parent) . '</a>';
            echo wp_kses_post($seperator);
            echo the_title();
        } else {
            echo wp_kses_post($seperator);
            echo the_title();
        }
 
    } elseif (is_search()) {
 
      echo wp_kses_post($seperator).esc_html__( 'Search Results for... ','givingwalk' );
            echo '"<em>';
            echo the_search_query();
            echo '</em>"';
 
    }
 
}

/**====== MAIN CONTENT ========*/
/**
 * Main Class
 * add main content HTML class
 * @since 1.0.0
 * @author Red Team
 */
function givingwalk_main_class($class = ''){
    $classes = array();
    $classes[] = 'red-main';
    $classes[] = 'container';
    $classes[] = $class;
    echo join(' ', $classes);
}

function givingwalk_main_content_class($sidebar = 'sidebar-main', $class = ''){
    global $opt_theme_options, $opt_meta_options; 
    $classes = array();
    $classes[] = 'content-area';
    $classes[] = $class;
     
    $post_attr = get_post_custom();
    $post_template = isset($post_attr['_wp_page_template']) ? $post_attr['_wp_page_template']['0'] : '';

    if(is_active_sidebar($sidebar)){
        if(isset($opt_theme_options)){
            $_sidebar = 'full';
            // Error
            if ( is_404() ) {
                $_sidebar = 'full';
            }
            // Archive
            if ( is_archive() ) {
                if (function_exists('is_woocommerce') && is_woocommerce()){ 
                    $_sidebar =  $opt_theme_options['opt_woo_loop_layout'];
                }else{
                    $_sidebar = $opt_theme_options['opt_archive_layout'];
                }
            }
             
            // Search
            if ( is_search() ) {
                $_sidebar = $opt_theme_options['opt_archive_layout'];
            }
            // Singular
            if ( is_singular('post') ) {
                if($post_template === 'default'){
                   $_sidebar = $opt_theme_options['opt_single_post_layout']; 
                } elseif ($post_template === 'single-left-sidebar.php'){
                    $_sidebar = 'left';
                } elseif ($post_template === 'single-right-sidebar.php'){
                    $_sidebar = 'right';
                } elseif ($post_template === 'single-no-sidebar.php'){
                    $_sidebar = 'full';
                } else {
                    $_sidebar = $opt_theme_options['opt_single_post_layout']; 
                }
            }
            if ( is_singular('crw_stories') ) {
                $_sidebar = $opt_theme_options['opt_single_stories_layout']; 
            }
            if ( is_singular('crw_causes') ) {
                $_sidebar = $opt_theme_options['opt_single_causes_layout']; 
            }
            // Singular
            if ( is_singular('product') ) {
                $_sidebar = $opt_theme_options['opt_woo_single_layout'];
            }
             
            // Page
            if( givingwalk_is_page() ){
                if(!empty($opt_meta_options['opt_page_layout'])){
                    $_sidebar = $opt_meta_options['opt_page_layout'];
                }else{
                    if (function_exists('is_woocommerce') && is_woocommerce()){ 
                        $_sidebar =  $opt_theme_options['opt_woo_loop_layout'];
                    }else{
                        $_sidebar = 'full';
                    }
                }
            } 
            // Front page
            if ( is_front_page() ) {
                if(!empty($opt_meta_options['opt_page_layout'])){
                    $_sidebar = $opt_meta_options['opt_page_layout'];
                }else{
                    $_sidebar = 'full';
                }
            }
            // Home - the blog page
            if ( is_home() ) {  
                if(!empty($opt_meta_options['opt_page_layout'])){
                    $_sidebar = $opt_meta_options['opt_page_layout'];
                }else{
                    $_sidebar = $opt_theme_options['opt_archive_layout'];
                }
            }
        } else {
            $_sidebar = 'right';
        }
    } else {
        $_sidebar = 'full';
    }

    if(isset($_GET['sidebar_layout']) && !empty($_GET['sidebar_layout']))
        $_sidebar = $_GET['sidebar_layout'];
    switch ($_sidebar) {
        case 'left':
            $classes[] = 'col-lg-8 col-xl-9 has-sidebar left-sidebar';
            break;
        case 'right':
            $classes[] = 'col-lg-8 col-xl-9 has-sidebar right-sidebar'; 
            break;
        default:
            if ( is_singular('product') || is_singular('crw_stories') || is_singular('crw_causes'))
                $classes[] = 'col-12 col-xl-10 offset-xl-1';
            else
                $classes[] = 'col-12';
            break;
    }
    echo join(' ',$classes);
}
function givingwalk_main_sidebar($sidebar = 'sidebar-main'){
    global $opt_theme_options, $opt_meta_options;
    $classes = array();
    $classes[] = 'sidebar-area col-lg-4 col-xl-3';
     
    $post_attr = get_post_custom();
    $post_template = isset($post_attr['_wp_page_template']) ? $post_attr['_wp_page_template']['0'] : '';
    
    $woo_sidebar = '';
    if(isset($opt_theme_options)){ 
        givingwalk_recover_opt_meta_options();
        $_sidebar = 'full';
        if ( is_404() ) {
            $_sidebar = 'full';
        }
        // Archive
        if ( is_archive() ) {
            if (function_exists('is_woocommerce') && is_woocommerce()){ 
                $_sidebar =  $opt_theme_options['opt_woo_loop_layout'];
                $woo_sidebar = 'woo-sidebar';
            }else{
                $_sidebar = $opt_theme_options['opt_archive_layout'];
            }
        }
        // Search
        if ( is_search() ) {
            $_sidebar =  $opt_theme_options['opt_archive_layout'];
        }
        // Singular
        if ( is_singular('post') ) {
            if($post_template === 'default'){
               $_sidebar = $opt_theme_options['opt_single_post_layout']; 
            } elseif ($post_template === 'single-left-sidebar.php'){
                $_sidebar = 'left';
            } elseif ($post_template === 'single-right-sidebar.php'){
                $_sidebar = 'right';
            } elseif ($post_template === 'single-no-sidebar.php'){
                $_sidebar = 'full';
            } else {
                $_sidebar = $opt_theme_options['opt_single_post_layout']; 
            }
        }
        // Singular
        if ( is_singular('product') ) {
            $_sidebar = $opt_theme_options['opt_woo_single_layout'];
            $woo_sidebar = 'woo-sidebar';
        }
        // Singular
        if ( is_singular('crw_stories') ) {
            $_sidebar = $opt_theme_options['opt_single_stories_layout']; 
        }
        // Singular
        if ( is_singular('crw_causes') ) {
            $_sidebar = $opt_theme_options['opt_single_causes_layout']; 
        }
        // Page
        if( givingwalk_is_page() ){
            if(!empty($opt_meta_options['opt_page_layout'])){
                $_sidebar = $opt_meta_options['opt_page_layout'];
            }else{
                if (function_exists('is_woocommerce') && is_woocommerce()){ 
                    $_sidebar =  $opt_theme_options['opt_woo_loop_layout'];
                    $woo_sidebar = 'woo-sidebar';
                }else{
                    $_sidebar = 'full';
                }
            }
        }
        // Front page
        if ( is_front_page() ) {
            if(!empty($opt_meta_options['opt_page_layout'])){
                $_sidebar = $opt_meta_options['opt_page_layout'];
            }else{
                $_sidebar = 'full';
            }
        } 
        // Home - the blog page
        if ( is_home() ) {
            if(!empty($opt_meta_options['opt_page_layout'])){
                $_sidebar = $opt_meta_options['opt_page_layout'];
            }else{
                $_sidebar = $opt_theme_options['opt_archive_layout'];
            }
        }
    } else {
        $_sidebar = 'right';
    }

    if(isset($_GET['sidebar_layout']) && !empty($_GET['sidebar_layout']))
        $_sidebar = $_GET['sidebar_layout'];

     
    if($_sidebar == 'full' || !is_active_sidebar($sidebar)) return;
    ?>
    <div id="sidebar-area" class="<?php echo join(' ', $classes); ?>">
        <div class="sidebar-inner sidebar-<?php echo esc_attr($_sidebar);?> <?php echo esc_attr($woo_sidebar);?>">
            <?php dynamic_sidebar( $sidebar ); ?>
        </div>
    </div>
<?php 
}

function givingwalk_get_sidebar(){
    global $opt_theme_options, $opt_meta_options;  
    if(isset($_REQUEST['sidebar']) && $_REQUEST['sidebar'] === 'false') return;
    if(!$opt_theme_options){
        $sidebar = 'sidebar-main';
    } else {
        givingwalk_recover_opt_meta_options();
        $sidebar = 'sidebar-main';
        if(is_archive()){
            if (function_exists('is_woocommerce') && is_woocommerce()){
                $sidebar = 'sidebar-shop';
            } else {
                $sidebar = $opt_theme_options['opt_archive_sidebar'];
            }  
        }
        if(is_search()){
            $sidebar = $opt_theme_options['opt_archive_sidebar'];
        }
        if (is_singular('post')) {
            if(isset($opt_theme_options['opt_single_post_sidebar'])) $sidebar = $opt_theme_options['opt_single_post_sidebar'];
        }
        if (is_singular('crw_stories')) {
            if(isset($opt_theme_options['opt_single_stories_sidebar'])) $sidebar = $opt_theme_options['opt_single_stories_sidebar'];
        }
        if (is_singular('crw_causes')) {
            if(isset($opt_theme_options['opt_single_causes_sidebar'])) $sidebar = $opt_theme_options['opt_single_causes_sidebar'];
        }
        if (is_singular('product')) {
            $sidebar = 'sidebar-shop';
        }

        if (function_exists('is_woocommerce') && is_woocommerce()){ 
            $sidebar = 'sidebar-shop';
        }
        if( givingwalk_is_page() ){  
            if(isset($opt_meta_options['opt_page_sidebar']) && !empty($opt_meta_options['opt_page_sidebar'])) {
                $sidebar = $opt_meta_options['opt_page_sidebar'];
            }else{
                if (function_exists('is_woocommerce') && is_woocommerce()){
                    $sidebar = 'sidebar-shop';
                }else{
                    $sidebar = 'sidebar-main';
                }
            }
        }
        if ( is_front_page() ) {  
            if(isset($opt_meta_options['opt_page_sidebar']) && !empty($opt_meta_options['opt_page_sidebar'])) {
                $sidebar = $opt_meta_options['opt_page_sidebar'];
            }else{
                $sidebar = 'sidebar-main';
            }
            
        }
        if ( is_home() ) {  
            if(isset($opt_meta_options['opt_page_sidebar']) && !empty($opt_meta_options['opt_page_sidebar'])) {
                $sidebar = $opt_meta_options['opt_page_sidebar'];
            }else{
                $sidebar = $opt_theme_options['opt_archive_sidebar'];
            }
        }       
    }
 
    return $sidebar;
}

/**====== ARCHIVES ======**/
function givingwalk_archive_layout(){
    global $opt_theme_options;
    $layout = isset($opt_theme_options['opt_archive_content_layout']) ? $opt_theme_options['opt_archive_content_layout'] : '';
    if(isset($_GET['content_layout']) && !empty($_GET['content_layout']))
        $layout = $_GET['content_layout'];
    return $layout;
}

add_action('givingwalk_blog_start','givingwalk_blog_start', 10, 2);
function givingwalk_blog_start(){
    global $opt_theme_options;
    $archive_content_layout = !empty($opt_theme_options['opt_archive_content_layout']) ? $opt_theme_options['opt_archive_content_layout'] : 'default';
    if(isset($_GET['content_layout']) && !empty($_GET['content_layout']))
        $archive_content_layout = $_GET['content_layout'];
    echo '<div class="row content-layout-'.esc_attr($archive_content_layout).'">';
}
add_action('givingwalk_blog_end','givingwalk_blog_end', 10,2);
function givingwalk_blog_end(){
    echo '</div>';
}

add_action('givingwalk_blog_start_loop_item','givingwalk_blog_start_loop_item', 10, 2);
function givingwalk_blog_start_loop_item(){
    global $opt_theme_options, $opt_meta_options;
    $archive_content_layout = !empty($opt_theme_options['opt_archive_content_layout']) ? $opt_theme_options['opt_archive_content_layout'] : '';
    if(isset($_GET['content_layout']) && !empty($_GET['content_layout']))
        $archive_content_layout = $_GET['content_layout'];
    
    $col_md = '';
    switch ($archive_content_layout) {
        case 'mask':
            $col = 1;
            break;
        case 'mask-masonry':
            $col = 2;
            break;
        case 'grid':
            $col = isset($opt_theme_options['opt_archive_content_coloumn']) ? $opt_theme_options['opt_archive_content_coloumn'] : '4';
            if($col>=3) $col_md = ' col-md-6';
            break;
        default:
            $col = 1;
            break;
    }
       
    $grid = round(12 / $col);
        echo '<div class="col-lg-'.esc_attr($grid).esc_attr($col_md).' ">';
}
add_action('givingwalk_blog_end_loop_item','givingwalk_blog_end_loop_item', 10, 2);
function givingwalk_blog_end_loop_item(){
    echo '</div>';
}

add_action('givingwalk_blog_end','givingwalk_disable_fixed_post_per_page');
function givingwalk_disable_fixed_post_per_page(){
    global $givingwalk_disable_fixed_post_per_page;
    $givingwalk_disable_fixed_post_per_page=true;
}//givingwalk_blog_end


add_action( 'pre_get_posts', 'givingwalk_blog_content_layout_per_page' );
function givingwalk_blog_content_layout_per_page( $query ) {
    global $opt_theme_options,$givingwalk_disable_fixed_post_per_page;

    if($givingwalk_disable_fixed_post_per_page === true)
        return;
    $archive_content_layout = !empty($opt_theme_options['opt_archive_content_layout']) ? $opt_theme_options['opt_archive_content_layout'] : '';
    if(isset($_GET['content_layout']) && !empty($_GET['content_layout']))
        $archive_content_layout = $_GET['content_layout'];
    if(!is_admin()){
        if( $query->is_post_type_archive('crw_stories') && !givingwalk_is_page() ) { 
            if(!empty($opt_theme_options['stories_per_page']))
                $query->set( 'posts_per_page', (int)$opt_theme_options['stories_per_page'] );
        }elseif( $query->is_post_type_archive('crw_causes') && !givingwalk_is_page() ){
            if(!empty($opt_theme_options['causes_per_page']))
            $query->set( 'posts_per_page', (int)$opt_theme_options['causes_per_page'] );
        }else{
            switch ($archive_content_layout) {
                case 'mask-masonry':
                    if(!empty($opt_theme_options['mask_mansory_post_per_page']))
                        $query->set( 'posts_per_page', (int)$opt_theme_options['mask_mansory_post_per_page'] );
                break;
                case 'grid':
                    if(!empty($opt_theme_options['grid_post_per_page']))
                        $query->set( 'posts_per_page', (int)$opt_theme_options['grid_post_per_page'] );
                break;
            }
        }
    }
    return $query;
}

/**===== ARCHIVE EXCERPT ===== **/
/** 
 * Max character lenght 
 *
 * @author Red Team
 * @since 1.0.0
*/
function givingwalk_max_charlength($text = '', $charlength = '210', $show_tip = false) {
    $charlength++;
    if ( mb_strlen( $text ) > $charlength ) {
        $subex = mb_substr( $text, 0, $charlength ); 
        $exwords = explode( ' ', $subex );
        $excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
        if ( $excut < 0 ) {
            echo mb_substr( $subex, 0, $excut );
        } else {
            echo esc_html($subex);
        }
        if($show_tip);
    } else {
        echo esc_html($text);
    }
}
/**
 * Change default character lenght of the_excerpt().
 * the_excerpt
 */
function givingwalk_excerpt_max_charlength($charlength) {
    $excerpt = strip_shortcodes(get_the_excerpt());
    $charlength++;
    if ( mb_strlen( $excerpt ) > $charlength ) {
        $subex = mb_substr( $excerpt, 0, $charlength ); 
        $exwords = explode( ' ', $subex );
        $excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
        if ( $excut < 0 ) {
            echo mb_substr( $subex, 0, $excut );
        } else {
            echo esc_html($subex);
        }
    } else {
        echo esc_html($excerpt);
    }
}

function givingwalk_excerpt($length = '', $post = null, $before = '', $after = ''){
    global $opt_theme_options;
    $post = get_post($post);
    if(empty($length)) 
        if(!empty($opt_theme_options['excerpt_length']))
            $length = $opt_theme_options['excerpt_length'];

    if (empty($post)) {
        return '';
    }
    
    if (post_password_required($post)) {
        return esc_html__('Post password required.', 'givingwalk');
    }
    
    if(!empty(get_the_excerpt()))
        $content = get_the_excerpt();
    else 
        $content = apply_filters('the_content', strip_shortcodes($post->post_content));


    $content = str_replace(']]>', ']]&gt;', $content);

    $content = remove_shortcodes_in_excerpt($content);

    $excerpt_more = apply_filters('givingwalk_excerpt_more', '&nbsp;&hellip;');

    $excerpt = wp_trim_words($content, $length, $excerpt_more);
    
    echo wp_kses_post($before) . esc_html($excerpt) . wp_kses_post( $after );
}
/**
 * Display an optional post excerpt.
 * the_excerpt
 */
function givingwalk_post_excerpt($charlength = 210, $show_tip = false, $class = ''){
    $post_format = get_post_format();
    ?>
    <div class="archive-summary <?php echo esc_attr($class);?>"><?php givingwalk_excerpt_max_charlength($charlength, $show_tip); ?></div>
    <?php
}
/**
 * Display an optional post excerpt.
 * Limited excerpt lenght
 * the_excerpt
 * 
 */
add_filter( 'excerpt_length', 'givingwalk_excerpt_length', 1 );
function givingwalk_excerpt_length() {
    global $opt_theme_options;
    if(isset($opt_theme_options['excerpt_length']) && !empty($opt_theme_options['excerpt_length']) && (int) $opt_theme_options['excerpt_length'] > 0){
        return $opt_theme_options['excerpt_length'];
    }else{
        return 35;    
    }
    
}
/**
 * Change excerpt more text
**/
add_filter('excerpt_more', 'givingwalk_excerpt_more');
function givingwalk_excerpt_more( $more ) {
    return '';
}

/**
 * Remove shortcode from post excerpt.
 * if shortcode is not registered with wordpress function add_shortcode
 * ex: remove wpvideo from jetpack
 * the_excerpt
 */
add_filter( 'the_excerpt', 'remove_shortcodes_in_excerpt', 20 );
function remove_shortcodes_in_excerpt( $content){
    $content = strip_shortcodes($content);
    $tagnames = array('wpvideo');  /* add shortcode tag name [box]content[/box] tagname = box */
    $content = do_shortcodes_in_html_tags( $content, true, $tagnames );

    $pattern = get_shortcode_regex( $tagnames );
    $content = preg_replace_callback( "/$pattern/", 'strip_shortcode_tag', $content );
    return $content;
}

/**===== ARCHIVES CONTENT =====**/
/**
 * Extract and return the first image from passed content.
 *
 * @since 1.0.0
 * @link https://core.trac.wordpress.org/browser/trunk/wp-includes/media.php?rev=24240#L2223
 *
 * @param string  $content A string which might contain a URL.
 * @return string The found URL.
 */
function givingwalk_get_image_in_content($content)
{
    $image = '';
    if (!empty($content) && preg_match('#' . get_tag_regex('img') . '#i', $content, $matches) && !empty($matches)) {
        // @todo Sanitize this.
        $image = $matches[0];
    }
    return $image;
}
/**
 * Get shortcode from content.
 * @since 1.0.0
 * @author Red Team
 */
function givingwalk_getShortcodeFromContent($shortcode = '', $content = ''){
    $shortcode = get_shortcode_regex();
    preg_match('/'. $shortcode .'/s', $content , $matches);
    return !empty($matches[0]) ? $matches[0] : null ;
}
/**
 * Get HTML tag from content.
 * @since 1.0.0
 * @author Red Team
 */
function givingwalk_getHTMLTagFromContent($tag = '', $content = ''){
    preg_match('~<'.$tag.'>([\s\S]+?)</'.$tag.'>~', $content, $matches);
    return !empty($matches[0]) ? $matches[0] : null ;
}

/**
 * Display an optional post video.
 * Port Format : Video 
 * @since 1.0.0
 * @author Red Team
 */
function givingwalk_post_video($size = 'large', $default_thumb = false, $before = '<div class="entry-media entry-video">', $after = '</div>', $echo = true) {
    global $opt_theme_options, $opt_meta_options, $wp_embed;
    $content = apply_filters( 'the_content', get_the_content() );
    $media = $video = $video_in_content = $opt_video_type = '';
    /* Get video playlist in content */
    $playlists = has_shortcode(get_the_content(), 'playlist');
    if($playlists){
        $playlist = givingwalk_getShortcodeFromContent('playlist',get_the_content());
        $video_in_content = apply_filters( 'the_content', $playlist );
    } else {
        /* Only get video from the content if a playlist isn't present. */
        if ( false === strpos( $content, 'wp-playlist-script' ) ) {
            $media = get_media_embedded_in_content( $content, array( 'video','audio', 'object', 'embed', 'iframe') );
        }
        if(!empty($media)) $video_in_content = $media[0];
    }
    
    /* get video from post option */
    if(isset($opt_meta_options)) {
        $opt_video_type = isset($opt_meta_options['opt_format_video_type']) ? $opt_meta_options['opt_format_video_type'] : '';
        /* Local video */
        if($opt_video_type === 'local' && !empty($opt_meta_options['opt_format_video_local']['id'])){
            /* get video meta */
            $opt_video_local = wp_get_attachment_metadata($opt_meta_options['opt_format_video_local']['id']);
            /* Get default video poster */
            $video_thumb = !empty(get_the_post_thumbnail_url($opt_meta_options['opt_format_video_local']['id'])) ? get_the_post_thumbnail_url($opt_meta_options['opt_format_video_local']['id'],'full') : get_the_post_thumbnail_url(get_the_ID(),'full');
            /* change poster */
            $poster = !empty($opt_meta_options['opt_format_video_local_thumb']['url']) ? $opt_meta_options['opt_format_video_local_thumb']['url'] : $video_thumb;
            /* Build video */            
            $atts = array(
                'src'    => esc_url($opt_meta_options['opt_format_video_local']['url']),
                'poster' => esc_url($poster),
                'width'  => esc_attr($opt_meta_options['opt_format_video_local']['width']),
                'height' => esc_attr($opt_meta_options['opt_format_video_local']['height'])
            );
            $video = wp_video_shortcode($atts);
        }
        /* Embed Video */
        elseif ($opt_video_type === 'embed' && !empty($opt_meta_options['opt_format_embed_video'])){
            $video = do_shortcode($wp_embed->run_shortcode('[embed]'.esc_url($opt_meta_options['opt_format_embed_video']).'[/embed]'));
        } 
        /* No option filled -> get video from content */
        elseif(!empty($video_in_content) && !is_singular()){
            $video = $video_in_content;
        }
    } 
    /* No option, get video from content */
    elseif( !empty($video_in_content) && !is_singular()) {
        $video = $video_in_content;
    }
    /* Show video */
    if($echo){
        if(!empty($video)){
            echo wp_kses_post($before).$video.wp_kses_post($after);
        } else {
            givingwalk_post_thumbnail($size, $default_thumb, $before, $after, $echo);
        }
    } else {
        if(!empty($video)){
            return true;
        } else {
            return givingwalk_post_thumbnail($size, $default_thumb, $before, $after, $echo);
        }
    }
    
}
/**
 * Display an optional post audio.
 * @since 1.0.0
 * @author Red Team
 */
function givingwalk_post_audio($size = 'large', $default_thumb = false, $before = '<div class="entry-media entry-audio">', $after = '</div>', $echo = true) {
    global $opt_theme_options, $opt_meta_options, $wp_embed;
    $content = apply_filters( 'the_content', get_the_content() );
    $media = $audio = $audio_in_content = $opt_audio_type = '';
    /* Get video playlist in content */
    $playlists = has_shortcode(get_the_content(), 'playlist');
    /* Get soundcloud shortcode in content */
    $soundclouds = has_shortcode(get_the_content(), 'soundcloud');

    $thumbnail_url = get_the_post_thumbnail_url( '', $size );
    $styles = array();
    $styles[] = 'background-position: center center';
    $styles[] = 'background-size: cover';
    //$styles[] = 'background-attachment: fixed';
    if($thumbnail_url) {
        $styles[] = 'background-image:url('.esc_url($thumbnail_url).')';
    } else {
        $styles[] = '';
    }
    if ( ! empty( $styles ) ) {
        $style = 'style="' . esc_attr( implode( ';', $styles ) ) . '"';
    } else {
        $style = '';
    }

    if($playlists){
        $playlist = givingwalk_getShortcodeFromContent('playlist',get_the_content());
        $audio_in_content = apply_filters( 'the_content', $playlist );
    } elseif($soundclouds) {
        $soundcloud = givingwalk_getShortcodeFromContent('soundcloud', get_the_content());
        $audio_in_content = apply_filters( 'the_content', $soundcloud );
    } else {
        /* Only get video from the content if a playlist isn't present. */
        if ( false === strpos( $content, 'wp-playlist-script' ) ) {
            $media = get_media_embedded_in_content( $content, array( 'video', 'audio', 'object', 'embed', 'iframe') );
        }
        if(!empty($media)) $audio_in_content = $media[0];
    }
    /* get audio from post option */
    if(isset($opt_meta_options)) {
        $opt_audio_type = isset($opt_meta_options['opt_format_audio_type']) ? $opt_meta_options['opt_format_audio_type'] : '';
        if($opt_audio_type === 'local' && !empty($opt_meta_options['opt_format_audio']['id'])){
            $audio_thumb = !empty(get_the_post_thumbnail_url($opt_meta_options['opt_format_audio']['id'])) ? get_the_post_thumbnail_url($opt_meta_options['opt_format_audio']['id'],'full') : get_the_post_thumbnail_url(get_the_ID(),'full');
            $atts = array(
                'src'    => esc_url($opt_meta_options['opt_format_audio']['url']),
            );
            $audio =  wp_audio_shortcode($atts);
        } 
        /* Embed Audio */
        elseif ($opt_audio_type === 'embed' && !empty($opt_meta_options['opt_format_embed_audio'])){
            $audio = do_shortcode($wp_embed->run_shortcode('[embed]'.esc_url($opt_meta_options['opt_format_embed_audio']).'[/embed]'));
        } 
        /* No option filled -> get audio from content */
        elseif(!empty($audio_in_content) && !is_singular()) {
            $audio = $audio_in_content;
        }
    } elseif(!empty($audio_in_content) && !is_singular()) {
        $audio = $audio_in_content;
    }
    /* Show Audio */
    if($echo) {
        if(!empty($audio)){
            echo wp_kses_post($before);
            echo '<div class="audio-wr-inner" '.wp_kses_post($style).'>';
            echo wp_kses_post($audio);
            echo '</div>';
            echo wp_kses_post($after);
        } else {
            givingwalk_post_thumbnail($size, $default_thumb, $before, $after);
        }
    } else {
        if(!empty($audio)){
            return true;
        } else {
            return givingwalk_post_thumbnail($size, $default_thumb, $before, $after);
        }
    }
}

function givingwalk_post_gallery($size = 'large', $default_thumb = false, $before = '<div class="entry-media entry-gallery">', $after = '</div>', $echo = true){
    global $opt_theme_options, $opt_meta_options;
    /* Get the gallery in content */
    $gallery_default = get_post_gallery();  
    $post_type = get_post_type();
    switch ($post_type) {
        default:
            $gallery_opt = isset($opt_meta_options['opt_format_gallery']) ? $opt_meta_options['opt_format_gallery'] : array();
            break;
    }
    /* no gallery. */
    if(empty($gallery_opt)) {
        if($echo){
            givingwalk_post_thumbnail($size, $default_thumb, $before, $after, $echo);
            return;
        } else {
            return givingwalk_post_thumbnail($size, $default_thumb, $before, $after, $echo);
        }
    }
    /* gallery option */
    if(!empty($gallery_opt)){
        if($echo) {
            $array_id = explode(",", $gallery_opt);
              
            echo wp_kses_post($before);
            ?>

            <div id="red-post-gallery" class="carousel slide post-gallery" data-ride="carousel">
                <div class="carousel-inner">
                    <?php $i = 0; ?>
                    <?php foreach ($array_id as $image_id): ?>
                        <?php
                        $attachment_image = wp_get_attachment_image_src($image_id, $size, false);
                        if($attachment_image[0] != ''):?>
                            <div class="item carousel-item <?php if( $i == 0 ){ echo 'active'; } ?>" data-slide-number="<?php echo esc_attr($i);?>">
                                <img style="width:100%;" data-src="holder.js" src="<?php echo esc_url($attachment_image[0]);?>" alt="<?php echo esc_attr__('holder','givingwalk');?>" />
                            </div>
                        <?php $i++; endif; ?>
                    <?php endforeach; ?>
                </div>
                <a class="left prev carousel-control" href="#red-post-gallery" role="button" data-slide="prev">
                    <span class="fa fa-angle-left"></span>
                </a>
                <a class="right next carousel-control" href="#red-post-gallery" role="button" data-slide="next">
                    <span class="fa fa-angle-right"></span>
                </a>
            </div>
              
            <?php
            echo wp_kses_post($after);
        } else {
            return true;
        }
    }
}

/**
 * Display an optional post quote.
 * @since 1.0.0
 * @author Red Team
 */
function givingwalk_post_quote($size = 'large', $default_thumb = true, $before = '<div class="entry-media entry-quote">', $after = '</div>', $echo = true) {
    global $opt_theme_options, $opt_meta_options;
    $quote_in_content = $opt_quote = '';
    /* get quote in content */
    $quote_in_content = givingwalk_getHTMLTagFromContent('blockquote', get_the_content());
    /* get quote from meta */
    if(isset($opt_meta_options['opt_format_quote_content']) && !empty($opt_meta_options['opt_format_quote_content'])) $opt_quote = $opt_meta_options['opt_format_quote_content'];

    $thumbnail_url = get_the_post_thumbnail_url( '', $size );
    $styles = array();
    $styles[] = 'background-position: center center';
    $styles[] = 'background-size: cover';
    //$styles[] = 'background-attachment: fixed';
    if($thumbnail_url) {
        $styles[] = 'background-image:url('.esc_url($thumbnail_url).')';
    } else {
        /*$styles[] = 'background-image:url('.esc_url(get_template_directory_uri().'/assets/images/no-image.jpg').')';*/
        $styles[] = '';
    }
    if ( ! empty( $styles ) ) {
        $style = 'style="' . esc_attr( implode( ';', $styles ) ) . '"';
    } else {
        $style = '';
    }
    /* has quote */
    $quote_title = !empty($opt_meta_options['opt_format_quote_title']) ? ' <cite>'.esc_html($opt_meta_options['opt_format_quote_title']).'</cite>' : '';
    if(!empty($opt_quote)){
        $quote_text = '<blockquote>'.wpautop($opt_quote).$quote_title.'</blockquote>';
    } elseif(!empty($quote_in_content) && !is_singular()) {
        $quote_text = $quote_in_content;
    }
    /* start show quote */
    if($echo){
        if(!empty($quote_text)){
            echo wp_kses_post($before);
                echo '<div class="entry-quote-inner" ' . $style . '>';
                    echo wp_kses_post($quote_text);
                echo '</div>';
            echo wp_kses_post($after);
        } else {
            givingwalk_post_thumbnail($size, $default_thumb, $before, $after, $echo);
        }
    } else {
        if(!empty($quote_text)){
            return true;
        } else {
            return givingwalk_post_thumbnail($size, $default_thumb, $before, $after, $echo);
        }
    }
}
/**
 * Display an optional post Link.
 * @since 1.0.0
 * @author Red Team
 */
function givingwalk_post_link($size = 'large', $default_thumb = true, $before = '<div class="entry-media entry-link">', $after = '</div>', $echo = true) {
    global $opt_theme_options, $opt_meta_options;
    $opt_link = $link_title = $helltip = $inner_class = '';
    /* get quote from meta */
    if(isset($opt_meta_options['opt_format_link_url']) && !empty($opt_meta_options['opt_format_link_url'])) $opt_link = $opt_meta_options['opt_format_link_url'];

    $thumbnail_url = get_the_post_thumbnail_url( '', $size );
    $styles = array();
    $styles[] = 'background-position: center center';
    $styles[] = 'background-size: cover';
    //$styles[] = 'background-attachment: fixed';
    if($thumbnail_url) {
        $styles[] = 'background-image:url('.esc_url($thumbnail_url).')';
        $inner_class = 'has-thumbnail';
    } else {
        $styles[] = '';
    }
    if ( ! empty( $styles ) ) {
        $style = 'style="' . esc_attr( implode( ';', $styles ) ) . '"';
    } else {
        $style = '';
    }
    /* has link */
    $link_title = !empty($opt_meta_options['opt_format_link_text']) ? $opt_meta_options['opt_format_link_text'] : $opt_link;
    if(strlen($link_title) > 34){
        $helltip = '...';
    }
    /* start show link */
    if($echo){
        if(!empty($opt_link)){
            echo wp_kses_post($before);
                echo '<div class="entry-link-inner '.esc_attr($inner_class).'" '. $style . ' >';
                echo '<div class="link-inner-inside"><i class="fa fa-link"></i><a href="'.esc_url($opt_link).'">'.esc_html(substr($link_title, 0, 34).$helltip).'</a></div>';
                echo '</div>';
            echo wp_kses_post($after);
        } else {
            givingwalk_post_thumbnail($size, $default_thumb, $before, $after, $echo);
        }
    } else {
        if(!empty($opt_link)){
            return true;
        } else {
            return givingwalk_post_thumbnail($size, $default_thumb, $before, $after, $echo);
        }
    }
}
/**
 * Display an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index
 * views, or a div element when on single views.
 * @since 1.0.0
 * @author Red Team
 */

function givingwalk_post_thumbnail($size = 'large', $default_thumb = false, $before = '<div class="entry-media entry-thumbnail">', $after = '</div>', $echo = true) {
    global $opt_theme_options, $opt_meta_options, $_wp_additional_image_sizes;
    $class = $thumbnail = $content_img = $img_caption = $content_caption = $content_img_caption = $return = '';
    /* get an image in content */
    $content_img = givingwalk_get_image_in_content(get_the_content());
    /* get an image caption shortcode in content */
    $img_caption = has_shortcode(get_the_content(), 'caption');
    if($img_caption){
        $content_caption = givingwalk_getShortcodeFromContent('caption',get_the_content());
        $content_img_caption = apply_filters( 'the_content', $content_caption );
    }
    /* Gallery from Meta */
    switch (get_post_type()) {
        default:
            $gallery = '';
            break;
    }
    /* Check post has thumbnail*/
    if( has_post_thumbnail() && !post_password_required() && !is_attachment() &&  wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), $size)){
        $class = ' has-thumbnail';
        if (function_exists('wpb_getImageBySize')){
            $img_id = get_post_thumbnail_id();
            $img = wpb_getImageBySize( array(
                'attach_id'  => $img_id,
                'thumb_size' => $size,
                'class'      => '',
            ));
            $thumbnail = $img['thumbnail'];
            $full_src = wp_get_attachment_image_src($img_id, 'full' );
            $thumbnail_src = $full_src[0];
        } else {
            $thumbnail = get_the_post_thumbnail(get_the_ID(),$size);
            $full_src = wp_get_attachment_image_src(get_the_ID(), 'full' );
            $thumbnail_src = $full_src[0];
        }
        $return = true;
    } elseif (!empty($gallery)){
        $class = ' has-gallery';
        $gallery_ids = explode(',', $gallery);
        $img_id =  $gallery_ids[0];
        if (function_exists('wpb_getImageBySize')){
            $img = wpb_getImageBySize( array(
                'attach_id'  => $img_id,
                'thumb_size' => $size,
                'class'      => '',
            ));
            $thumbnail = $img['thumbnail'];
            $full_src = wp_get_attachment_image_src($img_id, 'full' );
            $thumbnail_src = $full_src[0];
        } else {
            $thumbnail = get_the_post_thumbnail(get_the_ID(),$size);
            $full_src = wp_get_attachment_image_src(get_the_ID(), 'full' );
            $thumbnail_src = $full_src[0];
        }
        $return = true;
    } elseif(!empty($content_caption) && !is_singular()){
        $thumbnail = $content_img_caption;
        $thumbnail_src = '';
        $return = true;
    } elseif(!empty($content_img) && !is_singular()){
        $thumbnail = $content_img;
        preg_match('/<img(.*)src(.*)=(.*)"(.*)"/U', $thumbnail, $result);
        $thumbnail_src = array_pop($result);
        $return = true;
    } elseif ($default_thumb){
        $class = ' no-image';
        $thumbnail = '<img src="'.esc_url(get_template_directory_uri().'/assets/images/no-image.jpg').'" alt="'.esc_attr__('No Image','givingwalk').'"  title="'.esc_attr__('No Image','givingwalk').'" />';
        $thumbnail_src = get_template_directory_uri().'/assets/images/no-image.jpg';
        $return = true;
    }
    if($echo){
        if (!empty($thumbnail) || $default_thumb ) {
            echo wp_kses_post($before.$thumbnail.$after);
        }
    } else {
        return $return;
    }
}
/**
 * Display an optional post Media.
 * @since 1.0.0
 * @author Red Team
 */
function givingwalk_post_media($size = 'givingwalk-1170-498', $default_thumb = false, $before = '<div class="entry-media entry-thumbnail">', $after = '</div>', $echo = true) {
    switch (get_post_format()) {
        case 'gallery':
            if($echo)
                givingwalk_post_gallery($size, $default_thumb, $before, $after, $echo);
            else
                return givingwalk_post_gallery($size, $default_thumb, $before, $after, $echo);
            break;
        case 'quote':
            if ($echo)
                givingwalk_post_quote($size, $default_thumb, $before, $after, $echo);
            else 
                return givingwalk_post_quote($size, $default_thumb, $before, $after, $echo);
            break;
        case 'video':
            if($echo)
                givingwalk_post_video($size, $default_thumb, $before, $after, $echo);
            else 
                return givingwalk_post_video($size, $default_thumb, $before, $after, $echo);
            break;
        case 'audio':
            if($echo)
                givingwalk_post_audio($size, $default_thumb, $before, $after, $echo);
            else
                return givingwalk_post_audio($size, $default_thumb, $before, $after, $echo);
            break;
        case 'link':
            if($echo)
                givingwalk_post_link($size, $default_thumb, $before, $after, $echo);
            else 
                return givingwalk_post_link($size, $default_thumb, $before, $after, $echo);
            break;
        default:
            if($echo)
                givingwalk_post_thumbnail($size, $default_thumb, $before, $after, $echo);
            else
                return givingwalk_post_thumbnail($size, $default_thumb, $before, $after, $echo);
            break;
    }
}

/**===== POST META ======**/

function givingwalk_post_meta_date_url($echo = true, $link = true){   
    $post_type = get_post_type();
    $date = ''; 
    $archive_date_url = home_url('/').'?post_type='.$post_type.'&m='.get_the_time('Y').get_the_time('m').get_the_time('d');
    if($echo){
        if($link) echo '<a href="'.esc_url($archive_date_url).'">';
        echo get_the_date(get_option('date_format'));
        if($link) echo '</a>';
    } else {
        if($link) $date .= '<a href="'.esc_url($archive_date_url).'">';
        $date  .= get_the_date(get_option('date_format'));
        if($link) $date .= '</a>';
        return $date;
    }
}
function givingwalk_post_meta_list($show_author = '', $show_date = '',  $show_category = '', $show_comment = '', $show_view = '', $show_like = '', $show_share = '', $show_icon = '',  $class = ''){
    global $opt_theme_options, $opt_meta_options, $post;
    $comment_open    = comments_open();
    $givingwalk_tags = get_the_tags(); /* Just add it for fix Theme Check */
    $taxo    = givingwalk_get_custom_post_taxonomy('cat');
?>
    <?php if($show_author || $show_date || $show_category || $show_comment || $show_view || $show_like || $show_share) : ?>
    <ul class="entry-meta <?php echo esc_attr($class.' '.givingwalk_direction());?>">
        <?php if($show_date) : ?>
        <li class="detail-date"><i class="flaticon-school"></i>&nbsp;<?php givingwalk_post_meta_date_url();?></li>
        <?php endif; ?>
        <?php if($show_author) : ?>
            <li class="detail-author"><i class="flaticon-black-male-user-symbol"></i>&nbsp;<?php the_author_posts_link(); ?></li>
        <?php endif; ?>
        <?php if(has_term('',$taxo) && $show_category) the_terms( get_the_ID(), $taxo , '<li class="detail-categories"><i class="fa fa-folder-open"></i>&nbsp;', ' ','</li>' ); ?>
    
        <?php if($show_comment && $comment_open) : 
            $comments_number = get_comments_number();
            if ( '1' === $comments_number ) { ?>
                <li class="detail-comment"><i class="flaticon-interface"></i>&nbsp;<a class="red-scroll" href="<?php the_permalink(); ?>#comments"><?php printf( _x( '1 Comment', 'comments title', 'givingwalk' ), get_the_title() ); ?> </a></li>
            <?php
            }else{ ?>
                <li class="detail-comment"><i class="flaticon-interface"></i>&nbsp;<a class="red-scroll" href="<?php the_permalink(); ?>#comments"><?php printf( _nx( '0 Comments', '%1$s Comments', $comments_number, 'comments title', 'givingwalk' ), number_format_i18n( $comments_number ), get_the_title());?></a></li>
            <?php } ?>
        <?php endif; ?>
        <?php if($show_view && function_exists('givingwalk_get_post_views')) : ?><li class="entry-view"><i class="fa fa-eye"></i>&nbsp;<?php echo givingwalk_get_post_views(); ?></li><?php endif; ?>
        <?php if($show_like && function_exists('post_favorite')) : ?><li class="entry-like"><?php post_favorite();?></li><?php endif; ?>
        <?php if($show_share && function_exists('givingwalk_post_share_popup')) : ?><li class="entry-share"><?php givingwalk_post_share_popup(); ?></li><?php endif; ?>
    </ul>
    <?php endif; ?>
<?php
}
function givingwalk_post_meta_list_author_cats($show_author = '',$show_category = ''){
    $taxo    = givingwalk_get_custom_post_taxonomy('cat');
    if($show_author){
        echo '<div class="detail-author col-lg-4">';
            echo get_avatar(get_the_author_meta('ID'), 35);
            echo '<h6>';
                echo esc_html__('Posted by ','givingwalk');
                the_author_posts_link();
            echo '</h6>';
        echo '</div>';
    }
    if(has_term('',$taxo) && $show_category){
        echo '<div class="detail-cats col-lg-8 text-lg-right">';
        the_terms( get_the_ID(), $taxo , '<span class="cat-lbl text-primary">'.esc_html__('Category','givingwalk').':</span>&nbsp;', ', ','' );
        echo '</div>';
    }
    
}
/** ===== CUSTOM POST META =====**/
/**
 * Add Post view count
 *
 * @author Red Team
 * @since 1.0.0
 */
function givingwalk_set_post_views($postID)
{
    $count_key = 'givingwalk_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    } else {
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

function givingwalk_track_post_views($post_id)
{
    if (!is_single()) return;
    if (empty ($post_id)) {
        global $post;
        $post_id = $post->ID;
    }
    givingwalk_set_post_views($post_id);
}

add_action('wp_head', 'givingwalk_track_post_views');

function givingwalk_get_post_views($show_text = true)
{
    global $post;
    $postID = $post->ID;
    $count_key = 'givingwalk_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        $text = esc_html__('view', 'givingwalk');
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        if ($show_text) {
            return '0' . ' ' . esc_html($text);
        } else {
            return '<i class="icon-eye"></i> 0';
        }

    }
    if ($count > '1' || $count == 0) {
        $text = esc_html__('views', 'givingwalk');
        $count = convert_unit_number($count);
        if ($show_text) {
            return '' . esc_attr($count) . ' ' . esc_html($text);
        } else {
            return '<i class="icon-eye"></i> ' . esc_attr($count);
        }
        
    } else {
        $text = esc_html__('view', 'givingwalk');
        if ($show_text) {
            return '1' . ' ' . esc_html($text);
        } else {
            return '<i class="icon-eye"></i> 1';
        }
    }
}

function convert_unit_number($number)
{
    if (!is_numeric($number))
        return '0';
    $units = array(
        '1000'    => array(
            'add'      => 'K',
            'decimals' => 1,
        ),
        '1000000' => array(
            'add'      => 'M',
            'decimals' => 2
        )
    );
    $result = $number;
    foreach ($units as $unit => $option) {
        if ($number < $unit)
            break;
        $decimals_val = pow(10, $option['decimals']);
        $number_use = intval(($number / $unit) * $decimals_val);
        $result = $number_use / $decimals_val;
        $result .= $option['add'];
    }
    return $result;
}

/**
 * Add Social Share network 
 * Use Share this
 * source : https://www.sharethis.com/support/customization/how-to-set-custom-buttons/
*/
function givingwalk_post_share_popup($show_title = true){
    global $post;
    $url = get_the_permalink();
    $image = get_the_post_thumbnail_url($post->ID);
    $title = get_the_title();
    wp_enqueue_script('sharethis');
?>
    
        <a class="share-popup-link facebook st-custom-button" title="<?php esc_html_e('Share this post to','givingwalk'); ?>" data-toggle="tooltip" href="javascript:void(0);" data-network="sharethis" data-url="<?php echo esc_url($url);?>" data-short-url="<?php echo esc_url($url);?>" data-title="<?php echo esc_html($title);?>" data-image="<?php echo esc_url($image); ?>" data-description="<?php the_excerpt(); ?>" data-username="" data-message="<?php echo bloginfo(); ?>">
            <i class="flaticon-share"></i><?php if($show_title) echo '&nbsp;&nbsp;'.esc_html__('Share this','givingwalk'); ?>
        </a>
<?php
}

function givingwalk_post_share_list($class='', $show_all = false, $show_title = false, $show_follow = true){
    global $redclever_theme_options, $post;
    $url = get_the_permalink();
    $image = get_the_post_thumbnail_url($post->ID);
    $title = get_the_title();
    wp_enqueue_script('sharethis');
    if($show_follow){
        givingwalk_social_list('');
    }
    if($show_all){
    ?>

    <a title="<?php esc_html_e('Share this post Facebook','givingwalk'); ?>" data-toggle="tooltip" href="javascript:void(0);" data-network="facebook" data-url="<?php echo esc_url($url);?>" data-short-url="<?php echo esc_url($url);?>" data-title="<?php echo esc_html($title);?>" data-image="<?php echo esc_url($image); ?>" data-description="<?php the_excerpt(); ?>" data-username="" data-message="<?php echo bloginfo(); ?>" class="facebook st-custom-button"><i class="fa fa-facebook"></i>
            <?php if($show_title) echo '&nbsp;&nbsp;'.esc_html__('Facebook','givingwalk'); ?>
        </a>
    <a title="<?php esc_html_e('Share this post Twitter','givingwalk'); ?>" data-toggle="tooltip" href="javascript:void(0);" data-network="twitter" data-url="<?php echo esc_url($url);?>" data-short-url="<?php echo esc_url($url);?>" data-title="<?php echo esc_html($title);?>" data-image="<?php echo esc_url($image); ?>" data-description="<?php the_excerpt(); ?>" data-username="" data-message="<?php echo bloginfo(); ?>" class="twitter st-custom-button"><i class="fa fa-twitter"></i>
            <?php if($show_title) echo '&nbsp;&nbsp;'.esc_html__('Twitter','givingwalk'); ?>
        </a>
    <?php } ?>
    <a title="<?php esc_html_e('Share this post to','givingwalk'); ?>" data-toggle="tooltip" href="javascript:void(0);" data-network="sharethis" data-url="<?php echo esc_url($url);?>" data-short-url="<?php echo esc_url($url);?>" data-title="<?php echo esc_html($title);?>" data-image="<?php echo esc_url($image); ?>" data-description="<?php the_excerpt(); ?>" data-username="" data-message="<?php echo bloginfo(); ?>" class="all st-custom-button"><i class="fa fa-share-alt"></i>
            <?php if($show_title) echo '&nbsp;&nbsp;'.esc_html__('Share this','givingwalk'); ?>
        </a>
<?php
}


/**
 * Display an optional archive post header.
 */
function givingwalk_archive_header($heading_tag = 'h3'){
    global $paged;
    $icon_sticky = '';
    if(is_sticky() && $paged == '0'){
        $icon_sticky = '<i class="fa fa-thumb-tack"></i>&nbsp;';
    } 
    ?>
    <header class="archive-header">
        <?php givingwalk_archive_meta(); ?>
        <?php the_title( '<'.$heading_tag.' class="archive-title"><a href="' . esc_url( get_permalink() ) . '">'.$icon_sticky, '</a></'.$heading_tag.'>' ); ?>
    </header>
<?php 
}

/**
 * Display an optional archice post detail.
 */
function givingwalk_archive_meta(){
    global $opt_theme_options;
    $comment_open = comments_open();
    $show_author = isset($opt_theme_options['opt_archive_post_author']) ? $opt_theme_options['opt_archive_post_author'] : true;
    $show_date = isset($opt_theme_options['opt_archive_post_date']) ? $opt_theme_options['opt_archive_post_date'] : true;
    $show_category = isset($opt_theme_options['opt_archive_post_category']) ? $opt_theme_options['opt_archive_post_category'] : true;
    $show_comment = isset($opt_theme_options['opt_archive_post_comment']) ? $opt_theme_options['opt_archive_post_comment'] : '';
    $show_view = isset($opt_theme_options['opt_archive_post_view']) ? $opt_theme_options['opt_archive_post_view'] : '';
    $show_like = isset($opt_theme_options['opt_archive_post_like']) ? $opt_theme_options['opt_archive_post_like'] : '';
    $show_share = isset($opt_theme_options['opt_archive_post_share']) ? $opt_theme_options['opt_archive_post_share'] : '';
    $show_icon = true;
    givingwalk_post_meta_list($show_author, $show_date, $show_category, $show_comment, $show_view, $show_like, $show_share, $show_icon, 'archive-meta');
    ?>
    <?php
}

/**
 * Display an optional archive post footer.
 * @since 1.0.0
 * @author Red Team
 */
function givingwalk_archive_footer(){
    global $opt_theme_options, $opt_meta_options, $post;
    $taxo = givingwalk_get_custom_post_tag_taxonomy();
    $show_tag = isset($opt_theme_options['opt_archive_archive_post_tags']) ? $opt_theme_options['opt_archive_archive_post_tags'] : false;
    $readmore = isset($opt_theme_options['opt_archive_post_readmore']) ? $opt_theme_options['opt_archive_post_readmore'] : true;
    if((has_term('',$taxo) && $show_tag) || $readmore){
?>
    <footer class="archive-footer">
        <?php if( has_term('', $taxo) && $show_tag): ?>
            <?php the_terms( get_the_ID(), $taxo , '<div class="archive-tag entry-tags tagcloud '.givingwalk_direction().'">', ' ','</div>' ); ?>
        <?php endif; ?>
        <?php if($readmore) { ?>
            <a class="archive-readmore btn btn-medium" href="<?php the_permalink(); ?>"><?php esc_html_e('Read more', 'givingwalk'); ?></a>
        <?php } ?>
    </footer>
<?php
    }
}

/**===== ARCHIVE NAGINATION / POST PAGINATION =====**/
/**
 * Display navigation on archive page.
 *
 * @author Red Team
 * @since 1.0.0
 */
function givingwalk_paging_nav($layout = 1)
{
    $arrow = is_rtl() ? 'right' : 'left';
    $arrow2 = is_rtl() ? 'left' : 'right';
    switch ($layout) {
        case '2':
            echo '<nav class="pagination row justify-content-between"><div class="col-auto">';
                previous_posts_link( '<i class="fa fa-angle-double-'.$arrow.'"></i>&nbsp;'.esc_html__('Newer posts','givingwalk'));
            echo '</div><div class="col-auto">';
                next_posts_link( esc_html__('Older posts','givingwalk').'&nbsp;<i class="fa fa-angle-double-'.$arrow2.'"></i>');
            echo '</div></nav>';
            break;
        default:
            the_posts_pagination(array(
                'prev_text' => '<i class="fa fa-angle-double-'.$arrow.'"></i>',
                'next_text' => '<i class="fa fa-angle-double-'.$arrow2.'"></i>',
            ));
            break;
    }    
}

/* add zero number to post page link*/
function givingwalk_zeroize_page_numbers( $link, $i ) {
    $zeroised = zeroise( $i, 2 );
    $link = preg_replace( '/>(\D*)(\d*)(\D*)</', '>${1}' . $zeroised . '${3}<', $link );
    return $link;
}
add_filter( 'wp_link_pages_link', 'givingwalk_zeroize_page_numbers', 10, 2 );

/**===== SINGLE POST =====**/
/**
 * Display an optional Single post.
 * @since 1.0.0
 * @author Red Team
 */

/**
 * Display Single Post Template
 *
*/
function givingwalk_single_post_template(){
    global $opt_theme_options, $opt_meta_options;
    $post_attr = get_post_custom();
    $post_template = isset($post_attr['_wp_page_template']) ? $post_attr['_wp_page_template']['0'] : '';
    
    if(isset($opt_theme_options)){
        if($post_template === 'default'){
           $template = $opt_theme_options['opt_single_post_layout']; 
        } elseif ($post_template === 'single-left-sidebar.php'){
            $template = 'left';
        } elseif ($post_template === 'single-right-sidebar.php'){
            $template = 'right';
        } elseif ($post_template === 'single-no-sidebar.php'){
            $template = 'full';
        } else {
            $template = $opt_theme_options['opt_single_post_layout'];
        }
    } else {
        $template = 'right';
    }
    return $template;
}

/**
 * Display an optional single post header.
 */
function givingwalk_single_header($class=''){
    $classes = array();
    $classes[] = $class;
    global $opt_theme_options;
    $show_author   = isset($opt_theme_options['opt_single_post_author']) ? $opt_theme_options['opt_single_post_author'] : true;
    $show_date     = isset($opt_theme_options['opt_single_post_date']) ? $opt_theme_options['opt_single_post_date'] : true;
    $show_category = isset($opt_theme_options['opt_single_post_category']) ? $opt_theme_options['opt_single_post_category'] : true;
    $show_comment  = isset($opt_theme_options['opt_single_post_comment']) ? $opt_theme_options['opt_single_post_comment'] : '';
    $show_view     = isset($opt_theme_options['opt_single_post_view']) ? $opt_theme_options['opt_single_post_view'] : '';
    $show_like     = isset($opt_theme_options['opt_single_post_like']) ? $opt_theme_options['opt_single_post_like'] : '';
    $show_share    = isset($opt_theme_options['opt_single_post_share']) ? $opt_theme_options['opt_single_post_share'] : '';
    $show_icon     = true;
    ?>
    <header class="single-header <?php echo join(' ', $classes); ?>">
        <?php givingwalk_post_meta_list(false, $show_date, false, $show_comment, $show_view, $show_like, $show_share, $show_icon, 'single-meta'); ?>
        <?php 
        if(class_exists('EF4Framework'))
            the_title( '<h2 class="single-title">', '</h2>' ); 
        ?>
    </header>
<?php 
}
/**
 * Display an author category single post header.
 */
function givingwalk_single_author_cats($class=''){
    $classes = array();
    $classes[] = $class;
    global $opt_theme_options;
    $show_author   = isset($opt_theme_options['opt_single_post_author']) ? $opt_theme_options['opt_single_post_author'] : true;
    $show_category = isset($opt_theme_options['opt_single_post_category']) ? $opt_theme_options['opt_single_post_category'] : true;
    ?>
    <div class="row single-author-cats justify-content-between <?php echo join(' ', $classes); ?>">
        <?php givingwalk_post_meta_list_author_cats($show_author, $show_category); ?>
    </div>
<?php 
}

/**
 * Display an optional single post footer.
 * @since 1.0.0
 * @author Red Team
 */
function givingwalk_single_footer(){
    global $opt_theme_options, $opt_meta_options, $post;
    $show_share    = isset($opt_theme_options['opt_single_post_share']) ? $opt_theme_options['opt_single_post_share'] : false;
    $show_tag      = isset($opt_theme_options['opt_single_post_tags']) ? $opt_theme_options['opt_single_post_tags'] : true;
    $taxo = givingwalk_get_custom_post_tag_taxonomy();
    $has_tag       = has_term('',$taxo);
    if($has_tag && $show_tag){
        $class = 'col-md-12 col-lg-6';
    } else {
        $class = 'col-md-12 col-lg-12';
    }
    if( ($show_tag && $has_tag) || $show_share ): ?>
        <footer class="single-footer row justify-content-between clearfix">
            <?php  
                if ($show_tag && $has_tag)
                    the_terms( get_the_ID(), $taxo , '<div class="single-tag entry-tags tagcloud '.$class.' '.givingwalk_direction().'">', ' ','</div>' );
                if($show_share) {
                    echo '<div class="red-social circle bt-colored '.esc_attr($class).' text-'.givingwalk_align2().'">';
                        givingwalk_post_share_list();
                    echo '</div>';
                }
            ?>
        </footer>
    <?php endif; ?>    
<?php
}

/**
* Display navigation to next/previous on single post/page
*
* @since 1.0.0
*/
function givingwalk_post_nav() {
    global $opt_theme_options;
    if(!$opt_theme_options || !empty($opt_theme_options['opt_single_post_nav'])) givingwalk_custom_post_nav();
}
/* Custom post navigation */
function givingwalk_custom_post_nav(){
    $prevPost = get_previous_post(true);
    $nextPost = get_next_post(true);
    if(!$prevPost && !$nextPost) return;
?>
    <nav class="navigation post-navigation">
        <div class="nav-links clearfix">
            <?php  
            if($prevPost): ?>
                <a class="post-prev left" href="<?php echo get_permalink( $prevPost->ID ); ?>"><i class="fa fa-angle-left"></i> <?php echo esc_html__('Previous','givingwalk'); ?></a>
            <?php endif; ?>

            <?php
            if($nextPost): ?>
                <a class="post-next pull-right" href="<?php echo get_permalink( $nextPost->ID ); ?>"><?php echo esc_html__('Next','givingwalk'); ?> <i class="fa fa-angle-right"></i></a>
            <?php endif; ?>
        </div> 
    </nav>
<?php
}
/**
 * Display single post Author.
 * @since 1.0.0
 * @author Red Team
 */
function givingwalk_author_info(){
    global $opt_theme_options;
    if(!$opt_theme_options || empty(get_the_author_meta('description'))) return;
    if($opt_theme_options['opt_single_post_author_info']){
        $user_info = get_userdata(get_the_author_meta('ID'));
?>    
    <div class="entry-author text-xs-center clearfix">
        <div class="author-avatar">
            <?php 
                $default_avatar = get_template_directory_uri().'/assets/images/avatar.png';
                echo get_avatar(get_the_author_meta('ID'), 185, '', get_the_author(), array('class' => 'img-circle'));
                givingwalk_user_social();
            ?>
        </div>
        <div class="author-info">
            <h4 class="author-name"><?php echo esc_html__('About','givingwalk'); ?>&nbsp;<?php the_author(); ?></h4>
            <div class="author-bio"><?php the_author_meta('description'); ?></div>
        </div>
    </div>
<?php   
    }
}

/**
 * Display single post related
 * 
 * @author Red Team
 * @since 1.0.0
 */
function givingwalk_post_related($posts_per_page = '2'){
    global $post, $opt_theme_options;
    if(!$opt_theme_options) return;
    //for use in the loop, list 2 posts related to first tag on current post
    $show_post_related = $opt_theme_options['opt_single_post_related'];
    $tag_tax_name = givingwalk_get_custom_post_tag_taxonomy();
    $tags = get_the_terms($post->ID,$tag_tax_name);
    $rtl = is_rtl() ? true : false;
    if ($tags && $show_post_related) {
        $_tag = array();
        foreach ($tags as $tag) {
            $_tag[] = $tag->slug;
        }        
        $args=array(
            'post_type' => get_post_type(),
            'tax_query' => array(
                array(
                    'taxonomy' => $tag_tax_name,
                    'field'    => 'slug',
                    'terms'    => $_tag,
                ),
            ),
            'post__not_in'          => array($post->ID),
            'posts_per_page'        => $posts_per_page,
            'ignore_sticky_posts'   => 1
        );

        $related_query = new WP_Query($args);
        if( $related_query->have_posts() ) {
            echo '<div class="entry-related">';
            echo '<h3 class="related-title">'.esc_html__('Related Posts','givingwalk').'</h3>';
            echo '<div class="row" id="red-single-post-related">';
            while ($related_query->have_posts()) : $related_query->the_post(); 
                echo '<div class="col-md-6">';
                get_template_part( 'single-templates/archive/content', 'grid' );
                echo '</div>';
            endwhile;
            echo '</div></div>';
        }
        wp_reset_postdata();
    }
}
function givingwalk_single_post_comment_list_form(){
    global $opt_theme_options;
    $show_comment = isset($opt_theme_options['opt_single_post_comment_list_form']) ? $opt_theme_options['opt_single_post_comment_list_form'] : true;
    return $show_comment;
}

/* Custom Post Type 
 * All function used for custom post type used in this theme
*/
/**
 * Get custom post type taxonomy Category
 *
*/
function givingwalk_get_custom_post_taxonomy($key=array())
{
    $post = get_post();
    $tax_names = get_object_taxonomies($post);
    $result = 'category';
    if(is_array($tax_names))
    {
        foreach ($tax_names as $name)
            if(strpos($name,$key) !== false)
            {
                $result = $name;
                break;
            }
    }
    return $result;
}
/**
 * Get custom post type taxonomy TAGS
 *
*/
function givingwalk_get_custom_post_tag_taxonomy()
{
    $post = get_post();
    $tax_names = get_object_taxonomies($post);
    $result = 'post_tag';
    if(is_array($tax_names))
    {
        foreach ($tax_names as $name)
            if(strpos($name,'tag') !== false)
            {
                $result = $name;
                break;
            }
    }
    return $result;
}

/* event section */
function givingwalk_opt_events_layout(){
    global $opt_theme_options;

    $event_layout = '';
    if(isset( $opt_theme_options['opt_events_layout']) && !empty($opt_theme_options['opt_events_layout']))
        $event_layout = $opt_theme_options['opt_events_layout'];
    if( isset($_GET['event_layout']) && !empty($_GET['event_layout']))
        $event_layout = $_GET['event_layout'];

    return $event_layout;
}

function charity_is_event_ticket_can_buy( $ticket_id ) {
    if(!is_numeric($ticket_id))
        return false;
    $meta = apply_filters('ef4_get_post_meta',[
            'end_date_time'=>'',
            'start_date_time'=>'',
            'ticket_max_stock'=>'',
            'ticket_sold'=>'',
    ],$ticket_id,false);
    $max_time = $meta['end_date_time'];
    $min_time = $meta['start_date_time'];
    $max_stock = intval($meta['ticket_max_stock']);
    $now = time();
    if(!empty($max_time))
    {
        $max_time = (is_numeric($max_time)) ? $max_time : strtotime($max_time);
        if($now > $max_time)
            return false;
    }
    if(!empty($min_time))
    {
        $min_time = (is_numeric($min_time)) ? $min_time : strtotime($min_time);
        if($now < $min_time)
            return false;
    }
    if($max_stock >= 0)
    {
        $cr_sold = intval($meta['ticket_sold']);
        $remaining = $max_stock - $cr_sold ;
        if($remaining < 1)
            return false;
    }
    return true;
}
function givingwalk_show_buy_ticket_button(){
    $meta = apply_filters('ef4_get_post_meta',['']);
    
    $has_ticket_stock = false;
    if(!empty($meta['event_tickets'])){
        $tickets = explode(',', $meta['event_tickets']) ;
        foreach ($tickets as $ticket) {
            if(charity_is_event_ticket_can_buy($ticket))
            {
                $has_ticket_stock = true;
                break;
            }
        }
    }
    if(!empty($meta['close_ticket']) && $meta['close_ticket']=='1')
        $has_ticket_stock = false;
    
    if($has_ticket_stock)
    {
        $data = apply_filters('ef4_get_payment_form_data',[
            'class'=>'',
            'data-options'=>'',
            'data-target'=>''
        ],$tickets);
        echo "<a class=\"btn btn-medium {$data['class']}\" data-options='{$data['data-options']}' data-target='{$data['data-target']}' href=\"#\">".esc_html__('Buy Ticket','givingwalk').'</a>';
    }
    else
        echo '<div class="btn btn-medium close-ticket">'.esc_html__('Closed','givingwalk').'</div>';
 
}
function givingwalk_show_donate_button($args = [])
{
    $params = wp_parse_args($args,[
        'id'=>'',
        'title'=>esc_html__('Donate Now','givingwalk'),
        'class'=>'btn',
        'url'=>'#',
        'target'=>'_self',
    ]);
    $post_id = !empty($params['id']) ? $params['id'] : get_the_ID();
    $data = apply_filters('ef4_get_payment_form_data',[
        'class'=>'',
        'data-options'=>'',
        'data-target'=>''
    ],$post_id);
    $class = $params['class'].' '.$data['class'] ;
    $url = !empty($params['url']) ? $params['url'] : '#';
    $target = !empty($params['target']) ? $params['target'] : '_self';
    ?>
    <a class="<?php echo esc_attr($class) ?>"
       data-options="<?php echo esc_attr($data['data-options']) ?>"
       data-target="<?php echo esc_attr($data['data-target']) ?>"
       href="<?php echo esc_attr($url) ?>" target="<?php echo esc_attr($target) ?>" ><?php echo wp_kses_post($params['title']) ?></a>
    <?php

}
function givingwalk_single_events_facilities(){
    $meta = apply_filters('ef4_get_post_meta',['event_facilities'=>''],get_the_ID(),false);
    if(!empty($meta['event_facilities'])):
        ?>
        <div class="single-event-facilities">
            <?php 
            echo '<h4>'.esc_html__('Event Facilities','givingwalk').'</h4>';
            echo wp_kses_post( $meta['event_facilities'] )
            ?>
        </div>
        <?php 
    endif;
}

function givingwalk_single_events_get_involved(){
    global $opt_theme_options;

    if(isset($opt_theme_options['opt_single_events_get_involved']) && !$opt_theme_options['opt_single_events_get_involved'])
        return;
    $meta = apply_filters('ef4_get_post_meta',['disable_get_involved'=>''],get_the_ID(),false);

    if(isset($meta['disable_get_involved']) && $meta['disable_get_involved'] == '1')
        return;
    ?>
    <div class="single_events_involved_section">
        <div class="row align-items-center">
            <div class="col-left col-12 col-lg-8 col-xl-8">
                <?php if(!empty($opt_theme_options['opt_single_event_get_involved_icon_img']['url'])): ?>
                    <img src="<?php echo esc_url($opt_theme_options['opt_single_event_get_involved_icon_img']['url']); ?>">
                <?php endif; ?>      
                <?php if(!empty($opt_theme_options['opt_single_event_get_involved_title'])): ?>                                     
                    <h3><?php echo esc_html($opt_theme_options['opt_single_event_get_involved_title']);?></h3>
                <?php endif; ?>      
            </div>
            <div class="col-right col-12 col-lg-4 col-xl-4 text-lg-right">
                <a href="#" title="<?php echo esc_attr__('Get Involved','givingwalk');?>" class="btn btn-default"><?php echo esc_html__('Get Involved','givingwalk');?></a>
            </div>
        </div>
    </div>
    <?php 
}

function givingwalk_single_events_gallery(){
    $meta = apply_filters('ef4_get_post_meta',['event_gallery'=>''],get_the_ID(),false); 
    $event_gallery = $meta['event_gallery'];
    $images_arr = array();
    if(!empty($event_gallery)): 
        $images_arr = explode( ',', $event_gallery );
    ?>
        <div class="single-event-gallery red-gal-image">
            <div class="row red-gallery-popup">
                <?php 
                    foreach ( $images_arr as $i => $image ) {
                        if ( $image > 0 ) {
                            $img = wpb_getImageBySize( array(
                                'attach_id' => $image,
                                'thumb_size' => '500x400',
                                'class' => 'gal-image',
                            ));

                            $thumbnail = $img['thumbnail'];

                            $large_img = wp_get_attachment_image_src($image, 'full'); 
                            $image_large_src = $large_img[0]; 
                            ?>
                            <div class="red-gal-item col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                <a class="magic-popups" href="<?php echo esc_url($image_large_src); ?>" >
                                    <?php echo wp_kses_post($thumbnail); ?>
                                </a> 
                            </div>
                            <?php 
                        } 
                    }
                ?>
            </div>
        </div>
        <?php 
    endif;
}

function givingwalk_single_events_quote(){
    $meta = apply_filters('ef4_get_post_meta',['event_quote'=>''],get_the_ID(),false); 
    $event_quote = $meta['event_quote'];
     
    if(!empty($event_quote))
        echo '<blockquote><p>'. esc_html( $event_quote ).'</p></blockquote>';
}

function givingwalk_single_events_footer(){
    global $opt_theme_options, $post;
    $show_share    = isset($opt_theme_options['opt_single_events_share']) ? $opt_theme_options['opt_single_events_share'] : false;
    $taxo = tribe_get_event_categories(get_the_id());
     
    if(!empty($taxo) && $show_share){
        $class = 'col-12 col-sm-auto col-md-auto col-lg-auto col-xl-auto';
    } else {
        $class = 'col-12';
    }
    ?> 
    <div class="single-event-footer row justify-content-between align-items-center">
        <?php  
            if(!empty($taxo)){
                echo tribe_get_event_categories(
                    get_the_id(), array(
                        'before'       => '<span class="lbl">'.esc_html__( 'Category: ','givingwalk' ).'</span>',
                        'sep'          => ', ',
                        'after'        => '',
                        'label'        => null, 
                        'label_before' => '<label class="d-none">',
                        'label_after'  => '</label>',
                        'wrap_before'  => '<div class="detail-categories '.esc_attr($class).'">',
                        'wrap_after'   => '</div>',
                    )
                );
            }
            if($show_share) {
                echo '<div class="red-social circle bt-colored '.esc_attr($class).'">';
                    givingwalk_post_share_list('', true, false, false);
                echo '</div>';
            }
        ?>
    </div>
<?php
}

function givingwalk_single_events_organizer(){
    $organizer_ids = tribe_get_organizer_ids();
    ?>
    <div class="organizer-info-wrap">
        <?php 
        foreach ( $organizer_ids as $organizer ) {
            if ( ! $organizer ) {
                continue;
            }
            $organizer_post = get_post($organizer);
            $name = tribe_get_organizer( $organizer );
            $meta = apply_filters('ef4_get_post_meta',['avatar_image'=>''],$organizer_post,true);
            ?>
            <div class="entry-author text-xs-center clearfix">
                <div class="author-avatar">
                    <?php echo '<img src="'.wp_get_attachment_url($meta['avatar_image']).'" />' ?>
                        
                </div>        
                <div class="author-info">
                    <h3 class="author-name"><?php echo esc_html( $organizer_post->post_title ); ?><span class="org-text"><?php echo esc_html__('Organizer','givingwalk');?></span></h3>
                    <div class="author-bio"><?php echo apply_filters( 'the_content', $organizer_post->post_content ); ?></div>
                </div>
            </div>  
            <?php
        }
        ?>
    </div>
    <?php 
}

add_filter( 'tribe_events_embedded_map_style', 'givingwalk_single_events_modify_embedded_map' );
function givingwalk_single_events_modify_embedded_map() {
    return 'width: 100%; height: 310px';
}

function givingwalk_events_the_previous_month_link() {
    $html = '';
    $url  = tribe_get_previous_month_link();
    $date = Tribe__Events__Main::instance()->previousMonth( tribe_get_month_view_date() );
    $text = tribe_get_previous_month_text();
    $html = '<a class="btn btn-medium-large btn-white-alt" data-month="' . $date . '" href="' . esc_url( $url ) . '" rel="prev"><i class="fa fa-angle-left"></i> ' . $text . ' </a>';

    echo apply_filters( 'tribe_events_the_previous_month_link', $html );
}

function givingwalk_events_the_next_month_link() {
    $html = '';
    $url  = tribe_get_next_month_link();
    $text = tribe_get_next_month_text();
    if ( ! empty( $url ) ) {
        $date = Tribe__Events__Main::instance()->nextMonth( tribe_get_month_view_date() );
        $html = '<a class="btn btn-medium-large btn-white-alt" data-month="' . $date . '" href="' . esc_url( $url ) . '" rel="next">' . $text . ' <i class="fa fa-angle-right"></i></a>';
    }

    echo apply_filters( 'tribe_events_the_next_month_link', $html );
}

/* Stories section */
add_action('givingwalk_stories_archive_start','givingwalk_stories_archive_start', 10, 2);
function givingwalk_stories_archive_start(){
    echo '<div class="row stories-archive-grid">';
}
add_action('givingwalk_stories_archive_end','givingwalk_stories_archive_end', 10,2);
function givingwalk_stories_archive_end(){
    echo '</div>';
}

add_action('givingwalk_stories_start_loop_item','givingwalk_stories_start_loop_item', 10, 2);
function givingwalk_stories_start_loop_item(){
    global $opt_theme_options;
    $col = isset($opt_theme_options['opt_archive_stories_coloumn']) ? $opt_theme_options['opt_archive_stories_coloumn'] : '2';
    $col_md = '';
    if($col>=3) $col_md = ' col-md-6';
  
    $grid = round(12 / $col);

    echo '<div class="col-lg-'.esc_attr($grid).esc_attr($col_md).' ">';
}

add_action('givingwalk_stories_end_loop_item','givingwalk_stories_end_loop_item', 10, 2);
function givingwalk_stories_end_loop_item(){
    echo '</div>';
}


function givingwalk_stories_meta(){
    $meta = apply_filters('ef4_get_post_meta',[
            'subject'=>'',
            'needed_help'=>'',
            'volunteer_help'=>'',
            'donors'=>'',
    ],get_the_ID(),false);
    $subject = $meta['subject'];
    $needed_help = $meta['needed_help'];
    $volunteer_help = $meta['volunteer_help'];
    $donors = $meta['donors'];
    echo '<div class="meta-wrap">';
        if(!empty($subject)){
            echo '<div class="meta-item">';
                echo wp_kses_post($subject);
            echo '</div>';
        }
        if(!empty($needed_help)){
            echo '<div class="meta-item">';
                echo wp_kses_post($needed_help);
            echo '</div>';
        }
        if(!empty($volunteer_help)){
            echo '<div class="meta-item">';
                echo wp_kses_post($volunteer_help);
            echo '</div>';
        }
        if(!empty($donors)){
            echo '<div class="meta-item">';
                echo '<i class="flaticon-money-2"></i>';
                echo esc_html($donors).'&nbsp;'.esc_html__('Donors','givingwalk');
            echo '</div>';
        }
            
    echo '</div>';
}
function givingwalk_single_stories_footer(){
    global $opt_theme_options;
    $show_share    = isset($opt_theme_options['opt_single_stories_share']) ? $opt_theme_options['opt_single_stories_share'] : false;
     
    ?> 
    <div class="single-stories-footer row justify-content-between align-items-center">
        <?php  
            echo '<div class="detail-categories col-12 col-sm-auto col-md-auto col-lg-auto col-xl-auto">';
                the_terms( get_the_ID(), 'crw_stories_cat', '<span class="lbl">'.esc_html__( 'Category: ','givingwalk' ).'</span>', ', ', ''); 
            echo '</div>';
            if($show_share) {
                echo '<div class="red-social circle bt-colored col-12 col-sm-auto col-md-auto col-lg-auto col-xl-auto">';
                    givingwalk_post_share_list('', true, false, false);
                echo '</div>';
            }
            
        ?>
    </div>
<?php
}

/* Causes section */
function givingwalk_get_causes_layout(){
    global $opt_theme_options;
    $layout = 'causes-1';
    if(!empty($opt_theme_options['opt_causes_layout']))
        $layout = $opt_theme_options['opt_causes_layout'];
    if(isset($_GET['layout']) && !empty($_GET['layout']))
        $layout = 'causes-'.$_GET['layout'];
    return $layout;
}

add_action('givingwalk_causes_archive_start','givingwalk_causes_archive_start', 10, 2);
function givingwalk_causes_archive_start(){
    global $opt_theme_options;
    $layout = 'causes-1';
    if(!empty($opt_theme_options['opt_causes_layout']))
        $layout = $opt_theme_options['opt_causes_layout'];
    if(isset($_GET['layout']) && !empty($_GET['layout']))
        $layout = 'causes-'.$_GET['layout'];
    echo '<div class="row causes-archive-grid layout-'.esc_attr($layout).'">';
}
add_action('givingwalk_causes_archive_end','givingwalk_causes_archive_end', 10,2);
function givingwalk_causes_archive_end(){
    echo '</div>';
}

add_action('givingwalk_causes_start_loop_item','givingwalk_causes_start_loop_item', 10, 2);
function givingwalk_causes_start_loop_item(){
    global $opt_theme_options;
    $col = isset($opt_theme_options['opt_archive_causes_coloumn']) ? $opt_theme_options['opt_archive_causes_coloumn'] : '2';
    $col_md = '';
    if($col>=3) $col_md = ' col-md-6';
  
    $grid = round(12 / $col);

    echo '<div class="col-lg-'.esc_attr($grid).esc_attr($col_md).' ">';
}

add_action('givingwalk_causes_end_loop_item','givingwalk_causes_end_loop_item', 10, 2);
function givingwalk_causes_end_loop_item(){
    echo '</div>';
}

function givingwalk_causes_donate_amount_archive(){
    $meta = apply_filters('ef4_get_post_meta',[
            'donation_goal'=>'',
            'donation_raised'=>'',
    ],get_the_ID(),false);

    $raised = $meta['donation_raised'];
    $default_amount = '$'.$raised;
    $amount_value = apply_filters('ef4_payment_create_amount',$default_amount,$raised);
    $goal = $meta['donation_goal'];
    $goal_value =  apply_filters('ef4_payment_create_amount','$'.$goal,$goal);
    $pecent_val = ($raised / $goal)*100;
    $pecent_round = number_format($pecent_val,2);
    $pecent_round_org = $pecent_round;
    if($pecent_round > 100) $pecent_round = 100;
    if( !empty($raised) || !empty($goal) ){
        echo '<div class="donation-amount-wrap">';
            echo '<div class="donation-amount">';
                if( !empty($raised) ){
                    echo '<div class="raised">';
                        echo esc_html__('Raised:','givingwalk').' <span class="value">'.esc_html( $amount_value ).'</span>';
                    echo '</div>';
                }
                if( !empty($goal) ){
                    echo '<div class="goal">';
                        echo esc_html__('Goal:','givingwalk').' <span class="value">'.esc_html( $goal_value ).'</span>';
                    echo '</div>';
                }
            echo '</div>';
            echo '<div class="donate-progress">';
                echo '<div class="give-progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="'.esc_attr($pecent_round).'">';
                    echo '<span style="width: '.esc_attr($pecent_round).'%;">'.esc_html($pecent_round_org).'%</span>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
    }
}

function givingwalk_single_causes_meta(){
    $meta = apply_filters('ef4_get_post_meta',[
            'subject'=>'',
            'needed_help'=>'',
            'volunteer_help'=>'',
            'donors'=>'',
    ],get_the_ID(),false);

    $subject = $meta['subject'];
    $needed_help = $meta['needed_help'];
    $volunteer_help = $meta['volunteer_help'];
    $donors = $meta['donors'];
    echo '<div class="meta-wrap">';
        if(!empty($subject)){
            echo '<p class="meta-item">';
                echo wp_kses_post($subject);
            echo '</p>';
        }
        if(!empty($needed_help)){
            echo '<p class="meta-item">';
                echo wp_kses_post($needed_help);
            echo '</p>';
        }
        if(!empty($volunteer_help)){
            echo '<p class="meta-item">';
                echo wp_kses_post($volunteer_help);
            echo '</p>';
        }
        if(!empty($donors)){
            echo '<p class="meta-item">';
                echo '<i class="flaticon-money-2"></i>';
                echo esc_html($donors).'&nbsp;'.esc_html__('Donors','givingwalk');
            echo '</p>';
        }
            
    echo '</div>';
}

function givingwalk_causes_time_progress(){
    $meta = apply_filters('ef4_get_post_meta',[
            'start_date_time'=>'',
            'end_date_time'=>'',
    ],get_the_ID(),false);
    $max_time = $meta['end_date_time'];
    $min_time = $meta['start_date_time'];
    $now = time();
     
    if(!empty($min_time) && !empty($max_time))
    {
        $min_time = (is_numeric($min_time)) ? $min_time : strtotime($min_time);
        $max_time = (is_numeric($max_time)) ? $max_time : strtotime($max_time);
        if($now > $min_time && $now < $max_time){
            $max_time_left = $max_time - $min_time;
            $current_time_left = $now - $min_time;
            $pecent_val = ($current_time_left / $max_time_left)*100;
            $pecent_round = number_format($pecent_val,2);
            $pecent_round_org = $pecent_round;
            if($pecent_round > 100) $pecent_round = 100;
            echo '<div class="datetime-progress">';
                echo '<div class="give-progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="'.esc_attr($pecent_round).'">';
                    echo '<span style="width: '.esc_attr($pecent_round).'%;">'.esc_html($pecent_round_org).'%</span>';
                echo '</div>';
            echo '</div>';
        }
    }
}

function givingwalk_causes_donate_progress(){
    $meta = apply_filters('ef4_get_post_meta',[
            'donation_goal'=>'',
            'donation_raised'=>'',
    ],get_the_ID(),false);
    $raised = (int)$meta['donation_raised'];
    $goal = (int)$meta['donation_goal'];
     
    if(!empty($raised) && !empty($goal) && $goal > 0)
    {
        $pecent_val = ($raised / $goal)*100;
        $pecent_round = number_format($pecent_val,2);
        $pecent_round_org = $pecent_round;
        if($pecent_round > 100) $pecent_round = 100;
        echo '<div class="donate-progress">';
            echo '<div class="give-progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="'.esc_attr($pecent_round).'">';
                echo '<span style="width: '.esc_attr($pecent_round).'%;">'.esc_html($pecent_round_org).'%</span>';
            echo '</div>';
        echo '</div>';
    }
}

function givingwalk_causes_donate_amount(){
    $meta = apply_filters('ef4_get_post_meta',[
            'donation_goal'=>'',
            'donation_raised'=>'',
    ],get_the_ID(),false);
    $raised = $meta['donation_raised'];
    $goal = $meta['donation_goal'];

    if( !empty($raised) || !empty($goal) ){
        $raised_value = apply_filters('ef4_payment_create_amount','$'.$raised,$raised);
        $goal_value = apply_filters('ef4_payment_create_amount','$'.$goal,$goal);
        echo '<div class="donation-amount">';
            if( !empty($raised) ){
                echo '<div class="raised">';
                    echo '<span class="lbl">'.esc_html__('Donation Raised','givingwalk').'</span>';
                    echo '<span class="value">'.esc_html( $raised_value ).'</span>';
                echo '</div>';
            }
            if( !empty($goal) ){
                echo '<div class="goal">';
                    echo '<span class="lbl">'. esc_html__('Donation Goal','givingwalk').'</span>';
                    echo '<span class="value">'.esc_html( $goal_value ).'</span>';
                echo '</div>';
            }
        echo '</div>';
    }
}


function givingwalk_single_cat_sharing(){
    global $opt_theme_options;
    $show_share    = isset($opt_theme_options['opt_single_causes_share']) ? $opt_theme_options['opt_single_causes_share'] : false;
    ?> 
    <div class="cat-sharing row justify-content-between align-items-center">
        <?php  
            echo '<div class="detail-categories col-12 col-sm-auto col-md-auto col-lg-auto col-xl-auto">';
                the_terms( get_the_ID(), 'crw_causes_cat', '<span class="lbl">'.esc_html__( 'Category: ','givingwalk' ).'</span>', ', ', ''); 
            echo '</div>';
            if($show_share) {
                echo '<div class="red-social circle bt-colored col-12 col-sm-auto col-md-auto col-lg-auto col-xl-auto">';
                    givingwalk_post_share_list('', true, false, false);
                echo '</div>';
            }
        ?>
    </div>
    <?php
}

function givingwalk_single_causes_recent_donars($causes_id = 0){
    global $opt_theme_options,$cms_carousel;
    if(isset($opt_theme_options['opt_single_causes_recent_donars']) && !$opt_theme_options['opt_single_causes_recent_donars'])
        return;
   
    if(!is_array($cms_carousel))
        $cms_carousel = [];
    if($causes_id != 0){
        $recent_donars = apply_filters('ef4_get_related_payment', [], $causes_id);
        if(count($recent_donars) > 0){
            ?> 
            <div class="recent-donars">
                <h4 class="rd-title"><?php echo esc_html__('Recent Donars','givingwalk');?></h4>
                <div id="causes-recent-donars" class="recent-donar red-carousel owl-carousel">
                    <?php foreach ($recent_donars as $recent_donar) {
                        echo '<div class="rd-item">';
                        echo '<div class="rd-img">';
                        echo get_avatar( $recent_donar['customer_email'], 138 );  
                        echo '</div>';
                        echo '<div class="rd-item-content">';
                        echo '<h6 class="rd-name">'.$recent_donar['customer_name'].'</h6>';
                        echo '<span class="rd-amount">'.$recent_donar['amount_preview'].'</span>';
                        echo '</div>';
                        echo '</div>';
                    } ?>
                </div>
            </div>
            <?php
            wp_enqueue_script('vc_pageable_owl-carousel');
            wp_enqueue_script('red-owlcarousel');
            wp_enqueue_style( 'vc_pageable_owl-carousel-css');
            wp_enqueue_style( 'animate-css');
            $rtl = is_rtl() ? true : false;
            $cms_carousel['causes-recent-donars'] = array(
                'loop' => true,
                'mouseDrag' => true,
                'nav' => false,
                'dots' => false,
                'margin' => 10,
                'autoplay' => false,
                'autoplayTimeout' => 2000,
                'smartSpeed' => 1500,
                'autoplayHoverPause' => true,
                'animateIn'          => '',
                'animateOut'         => '',
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
                        'items' => 4,
                    ),
                    1200 => array(
                        'items' => 5,
                    ) 
                )
            );
            wp_localize_script('vc_pageable_owl-carousel', 'cmscarousel', $cms_carousel);
        }
    }
}
/**
 * Extra Option
 * @since 1.0.0
 * @author Red Team
*/
/**
 * Theme social list
*/
function givingwalk_social_list($class = '', $before = '', $after = '', $icon_prefix = 'fa fa-', $link_class=''){
    global $opt_theme_options, $opt_meta_options;
    if(!$opt_theme_options) return;
    if(isset($opt_theme_options['opt_social_list']) && !empty($opt_theme_options['opt_social_list'])){
        echo wp_kses_post($before);
        $social_list = $opt_theme_options['opt_social_list'];
        foreach ( $social_list as $key => $value ) {
            if ( ! empty( $value ) ) {
                $info = givingwalk_parse_url_all($value);
                $icon = $info['domain_name'];
                if($info['domain_name'] == 'google') {
                    $icon = 'google-plus';
                } elseif ($info['domain_name'] == 'skype') {
                    $value = 'skype:'.$info['domain_ext'].'?chat';
                } 
                echo '<a title="'.esc_html('Follow us','givingwalk').'" data-toggle="tooltip" class="'.esc_attr($icon).'" target="_blank" href="' .  $value  . '"><span class="'.esc_attr($icon_prefix.$icon).'"></span></a>';
            }
        }
        echo wp_kses_post($after);
    }
}
 
function givingwalk_header_social($class = '', $before = '<div class="red-social red-header-height header-icon circle size-35 d-none d-md-block">' , $after = '</div>', $icon_class = 'header-icon social-icon red-header-height'){
    global $opt_theme_options, $opt_meta_options;
    if(!$opt_theme_options) return;
    $show_in_header = $opt_theme_options['opt_social_in_header'];
    if(is_singular() && isset($opt_meta_options['opt_social_in_header']) && $opt_meta_options['opt_social_in_header'] != '-1'){
       $show_in_header =  $opt_meta_options['opt_social_in_header'];
    }
    if(!$show_in_header)
        return;
?>
    <?php  
        givingwalk_social_list($class, $before, $after , 'fa fa-', $icon_class.' '.$class);
    ?>
<?php 
}

/* add footer back to top. */
add_action('wp_footer', 'givingwalk_back_to_top');
function givingwalk_back_to_top(){
    global $opt_theme_options;

    $_back_to_top = false;

    if(isset($opt_theme_options['opt_backtotop']))
        $_back_to_top = $opt_theme_options['opt_backtotop'];

    if($_back_to_top)
        echo '<a class="red-backtotop red-scroll d-xs-none" href="#red-page"><i class="fa fa-angle-up"></i></a>';
}

/**
 * Get all url attibute
 * @return: url, host, domain, real domain (for url have subdomain)
 * @souce https://stackoverflow.com/questions/569137/how-to-get-domain-name-from-url#answer-45044051
 * https://stackoverflow.com/questions/17487559/getting-domain-extension-from-url#answer-17487719
*/
function givingwalk_parse_url_all($url){
    $url = substr($url,0,4)=='http'? $url: 'http://'.$url;
    $d = parse_url($url);
    $tmp = explode('.',$d['host']);
    $n = count($tmp);
    preg_match('/(.*?)((\.co)?[a-z]{2,100})$/i', $d['host'], $m);
    if ($n>=2){
        if ($n==4 || ($n==3 && strlen($tmp[($n-2)])<=3)){
            $d['domain'] = $tmp[($n-3)].".".$tmp[($n-2)].".".$tmp[($n-1)];
            $d['domain_name'] = $tmp[($n-3)];
        } else {
            $d['domain'] = $tmp[($n-2)].".".$tmp[($n-1)];
            $d['domain_name'] = $tmp[($n-2)];
        }
        $d['domain_ext'] = isset($m[2]) ? $m[2]: '';
    }
    return $d;
}


/**
 * Get Page List 
 * @author Red Team
 * @since 1.0.0
*/
function givingwalk_list_page(){
    $page_list = array();
    $pages = get_pages(array('hierarchical' => 0));
    foreach($pages as $page){
        $page_list[$page->post_name] = $page->post_title;
    }
    return $page_list;
}

/** 
 * Get Page ID from page Slug
 * givingwalk_get_page_by_slug('any-page-slug');
*/
function givingwalk_get_page_by_slug($page_slug, $post_type = 'page'){
    $query = new WP_Query( array( 'name' => $page_slug ,'post_type'=> $post_type) );
    $page_id = 0;
    if($query->have_posts())
        $page_id = $query->posts[0]->ID;
    return $page_id;
}


/**
 * get terms
 *
 * @param string $taxonomy
 * @param bool $slug
 * @param array $options
 * @return array
 */
function givingwalk_get_terms($taxonomy = 'category', $slug = true, $options = array()){
    $_terms = get_terms($taxonomy, $options);

    $terms = array();
    if(empty( $_terms ) || is_wp_error( $_terms ))
        return $terms;
    foreach ($_terms as $_term){
        if($slug){
            $terms[$_term->slug] = $_term->name;
        } else {
            $terms[$_term->term_id] = $_term->name;
        }
    }

    return $terms;
}

/**
 * get list menu.
 * @return array
 */
function givingwalk_get_nav_menu(){
    $menus = array();
    $obj_menus = wp_get_nav_menus();
    $menus['none'] = esc_html__('None','givingwalk');
    foreach ($obj_menus as $obj_menu){
        $menus[$obj_menu->slug] = $obj_menu->name;
    }
    return $menus;
}

/**
 * Get RevSlider List 
 * @author Red Team
 * @since 1.0.0
*/
function givingwalk_get_list_rev_slider() {
    if (class_exists('RevSlider')) {
        $slider = new RevSlider();
        $arrSliders = $slider->getArrSliders();
        $revsliders = array();
        if ($arrSliders) {
            foreach ($arrSliders as $slider) {
                /* @var $slider RevSlider */
                $revsliders[$slider->getAlias()] = $slider->getTitle();
            }
        } else {
            $revsliders[0] = esc_html__('No sliders found', 'givingwalk');
        }
        return $revsliders;
    }
}

/**
 * Get Causes List 
 * @author Red Team
 * @since 1.0.0
*/
function givingwalk_get_first_causes_default() {
    global $opt_theme_options;
    $result = 0;
    if(!is_array($opt_theme_options)) $result;

    if(!empty($opt_theme_options['opt_donate_causes_default']))
        $result = $opt_theme_options['opt_donate_causes_default'];
    else
    {
        $query_args = [
            'post_type'=>'crw_causes',
            'post_status'=>'publish',
            'posts_per_page'=>1,
        ];
        $wp_query = new WP_Query($query_args);
        if(count($wp_query->posts)>0){
            $post = $wp_query->posts[0];
            $result = $post->ID;
        }
    }
    return intval($result);

}
function givingwalk_maybe_update_list_causes($post_ID, $post_after, $post_before){
    if(!($post_after instanceof WP_Post && $post_before instanceof WP_Post))
        return;
    if($post_after->post_type !== 'crw_causes')
        return;
    if($post_after->post_title != $post_before->post_title)
    {
        update_option('givingwalk_cache_list_causes','');
    }
}
add_action( 'post_updated', 'check_values', 10, 3 );
function givingwalk_get_list_causes() {
    $list_causes = get_option('givingwalk_cache_list_causes','');
    if(is_array($list_causes))
        return $list_causes;
    $args = array(
        'posts_per_page' => -1,
        'post_type'   => 'crw_causes',
        'post_status'=>'publish',
    );
    $causes = get_posts( $args ); 
    $list_causes = array();
    if ($causes) {
        foreach ($causes as $cause) {
            $list_causes[$cause->ID] = "{$cause->post_title} (ID: {$cause->ID})" ;
        }
    } else {
        $list_causes[0] = esc_html__('No cause found', 'givingwalk');
    }
    update_option('givingwalk_cache_list_causes',$list_causes);
    return $list_causes;
}

/**
 * Get Story List 
 * @author Red Team
 * @since 1.0.0
*/
function givingwalk_get_first_story_default() {
    global $opt_theme_options;
    $result = 0;
    if(!$opt_theme_options) return $result;
    if(!empty($opt_theme_options['opt_donate_story_default']))
        $result = $opt_theme_options['opt_donate_story_default'];
    $query_args = [
        'post_type'=>'crw_stories',
        'post_status'=>'publish',
        'posts_per_page'=>1,
    ];
    $wp_query = new WP_Query($query_args);
    if(count($wp_query->posts)>0){
        $post = $wp_query->posts[0];
        $result = $post->ID;
    }
    return intval($result);
}
function givingwalk_get_list_story() {
    global $givingwalk_list_stories;
    if(!empty($givingwalk_list_stories))
        return $givingwalk_list_stories;
    $args = array(
        'posts_per_page' => -1,
        'post_type'   => 'crw_stories',
        'post_status'=>'publish',
    );
     
    $stories = get_posts( $args ); 
    $list_story = array();
    if ($stories) {
        foreach ($stories as $story) {
            $list_story[$story->ID] = "{$story->post_title} (ID: {$story->ID})" ;
        }
    } else {
        $list_story[0] = esc_html__('No Story found', 'givingwalk');
    }
    return $givingwalk_list_stories = $list_story;
}
/**
 * Get Contact Form 7 List 
 * @author Red Team
 * @since 1.0.0
*/
function givingwalk_get_list_cf7() {
    if (class_exists('WPCF7')) {
        $cf7 = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );

        $contact_forms = array();
        if ( $cf7 ) {
            foreach ( $cf7 as $cform ) {
                $contact_forms[ $cform->post_title ] = $cform->ID;
            }
        } else {
            $contact_forms[ esc_html__( 'No contact forms found', 'givingwalk' ) ] = 0;
        }
        return $contact_forms;
    }
}

/* Page option: show search */
function givingwalk_page_options_show_search(){
    global $opt_theme_options;
    return array(
        'title'    => esc_html__('Show Search', 'givingwalk'),
        'subtitle' => esc_html__('Show/Hide search icon', 'givingwalk'),
        'id'       => 'opt_show_header_search',
        'type'      => 'button_set',
        'options'   => array(
            '-1'     => esc_html__('Default','givingwalk'),
            '1'     => esc_html__('Yes','givingwalk'),
            '0'     => esc_html__('No','givingwalk'),
        ),
        'default'   => '-1',
    );
}

/* Theme Options: show WC Cart */
function givingwalk_theme_options_show_cart(){
    if(class_exists('WooCommerce')){
        return array(
            'title'     => esc_html__('Show Cart', 'givingwalk'),
            'subtitle'      => esc_html__('Show/Hide cart icon', 'givingwalk'),
            'id'        => 'opt_show_header_wc_cart',
            'type'      => 'switch',
            'default'   => false,
        );
    }
}
function givingwalk_page_options_show_cart(){
    if(class_exists('WooCommerce')){
        return array(
            'title'     => esc_html__('Show Cart', 'givingwalk'),
            'subtitle'  => esc_html__('Show/Hide cart icon', 'givingwalk'),
            'id'        => 'opt_show_header_wc_cart',
            'type'      => 'button_set',
            'options'   => array(
                '-1'    => esc_html__('Default','givingwalk'),
                '1'     => esc_html__('Yes','givingwalk'),
                '0'     => esc_html__('No','givingwalk'),
            ),
            'default'   => '-1',
        );
    }
}
/* Theme option show Tools */
function givingwalk_theme_options_show_tool(){
    return array(
        'title'       => esc_html__('Show Tools', 'givingwalk'),
        'subtitle'    => esc_html__('Show/Hide tool icon', 'givingwalk'),
        'description' => esc_html__('When this options is ON, you need to add a widget to Header Tools area via Widget Manager', 'givingwalk'),
        'id'          => 'opt_show_header_tool',
        'type'        => 'switch',
        'default'     => false,
    );
}
function givingwalk_theme_options_show_tool_depend(){
    return array(
        'title'       => esc_html__('Show Tools on screen', 'givingwalk'),
        'description' => esc_html__('Tools icon show on what screen display', 'givingwalk'),
        'id'          => 'opt_show_header_tool_screen',
        'type'        => 'button_set',
        'multi'       => true,
        'options' => array(
            '1' => esc_html__('Extra Small','givingwalk'), 
            '2' => esc_html__('Small','givingwalk'), 
            '3' => esc_html__('Medium','givingwalk'), 
            '4' => esc_html__('Large','givingwalk'), 
            '5' => esc_html__('Extra Large','givingwalk'), 
         ), 
        'default' => array('1', '2', '3','4','5'),
        'required'  => array('opt_show_header_tool', '=', 1)
    );
}
function givingwalk_page_options_show_tool(){
    return array(
        'title'       => esc_html__('Show Tools', 'givingwalk'),
        'subtitle'    => esc_html__('Show/Hide tool icon', 'givingwalk'),
        'description' => esc_html__('When this options is YES, you need to add a widget to Header Tools area via Widget Manager', 'givingwalk'),
        'id'          => 'opt_show_header_tool',
        'type'        => 'button_set',
        'options'   => array(
            '-1'     => esc_html__('Default','givingwalk'),
            '1'     => esc_html__('Yes','givingwalk'),
            '0'     => esc_html__('No','givingwalk'),
        ),
        'default'   => '-1',
    );
}

/* Page option: Social */
function givingwalk_page_options_show_social(){
    global $opt_theme_options;
    if(isset($opt_theme_options['opt_social_list']) && !empty($opt_theme_options['opt_social_list'])) {
        return array(
            'title'       => esc_html__('Show Social', 'givingwalk'),
            'subtitle'    => esc_html__('Show/Hide social icon in Header area', 'givingwalk'),
            'description' => esc_html__('When this option is ON, you need to manage social icon then Theme Option > Extra Options > Social Link', 'givingwalk'),
            'id'          => 'opt_social_in_header',
            'type'        => 'button_set',
            'options'     => array(
                '-1'    => esc_html__('Default','givingwalk'),
                '1'     => esc_html__('Yes','givingwalk'),
                '0'     => esc_html__('No','givingwalk'),
            ),
            'default'   => '-1',
        );
    }
}


/** 
 * Custom Widget Categories 
 * This code filters the Categories archive widget to include the post count inside the link 
 * @since 1.0.0
*/
add_filter('wp_list_categories', 'givingwalk_cat_count_span');
function givingwalk_cat_count_span($output) {
    $dir = is_rtl() ? 'left' : 'right';
    $output = str_replace("\t", '', $output); /* remove indent */
    $output = str_replace(")\n</li>", ')</li>', $output); /* remove line break */
    $output = str_replace('</a> (', ' <span class="count '.$dir.'">(', $output); /* add open span tag */
    $output = str_replace(")</li>", ") </span></a></li>", $output); /* add close span tag for single category  */
    $output = str_replace(")\n<ul", ") </span></a>\n<ul", $output); /* add close spab tag for category has children */
    return $output;
}
/** 
 * Custom Widget Archive 
 * This code filters the Archive widget to include the post count inside the link 
 * @since 1.0.0
*/
add_filter('get_archives_link', 'givingwalk_archive_count_span');
function givingwalk_archive_count_span($links) {
    $dir = is_rtl() ? 'left' : 'right';
    $links = str_replace('</a>&nbsp;(', ' <span class="count '.$dir.'">(', $links);
    $links = str_replace(')', ')</span></a>', $links);
    return $links;
}

/** 
 * Custom Widget Product Categories 
 * This code filters the Product Categories widget to include the post count inside the link 
 * @since 1.0.0
*/
add_filter('wp_list_categories', 'givingwalk_wc_cat_count_span');
function givingwalk_wc_cat_count_span($links) {
    $dir = is_rtl() ? 'left' : 'right';
    $links = str_replace('</a> <span class="count">(', ' <span class="count '.$dir.'">(', $links);
    $links = str_replace(')</span>', ')</span></a>', $links);
    return $links;
}

/** 
 * Custom Widget Product Layered Nav List  
 * This code filters the Product Layered Nav List widget to include the post count inside the link 
 * @since 1.0.0
*/
add_filter('woocommerce_layered_nav_term_html', 'givingwalk_wc_attr_count_span');
function givingwalk_wc_attr_count_span($term_html) {
    $dir = is_rtl() ? 'left' : 'right';
    $term_html = str_replace('</a> <span class="count">(', ' <span class="count '.$dir.'">(', $term_html);
    $term_html = str_replace(')</span>', ')</span></a>', $term_html);
    return $term_html;
}
/**
 * Custom Widget tag clound
 * @since 1.0.0
*/
/*add_filter('widget_tag_cloud_args', 'givingwalk_tag_widget_limit');*/
/* Limit number of tags inside widget */
function givingwalk_tag_widget_limit($args){
 //Check if taxonomy option inside widget is set to tags
 if(isset($args['taxonomy']) && $args['taxonomy'] == 'post_tag'){
  $args['number'] = 5; //Limit number of tags
 }
 return $args;
}

/**
 * Get Custom User Meta 
 * user meta added from EF4 Framework
*/
/* get custom user social */
function givingwalk_user_social($author_id = '', $return = false, $class = 'red-user-social'){
    global $post;
    if(empty($author_id)) $author_id = $post->post_author;
    if(!function_exists('ef4_user_info')) return;
    $extend_social = ef4_user_info($author_id, 'extend_social');

    $social_icon = '<div class="'.esc_attr($class).'">';
        foreach ($extend_social as $social) {
            if(!empty($social)){
                $remove = array('fa fa-','ion-', 'icon-', 'social-', 'ti-', 'slip-');
                $class3 = str_replace($remove, '', $social['icon']);
                $social_icon .= '<a title="'.str_replace('-', ' ', $class3).'" target="_blank" href="' . esc_url( $social['url'] ) . '" class="'.str_replace('-', ' ', $class3).'"><i class="'.esc_attr($social['icon']).'"></i></a>';
            }
        }
    $social_icon .='</div>';
    if($return)
       return $social_icon;
    else 
        echo wp_kses_post($social_icon);
}

/** VC **/
function givingwalk_get_post_categories_for_autocomplete(){
    $post_categories = get_categories('post_categories');
    $result = array();
    foreach($post_categories as $category)
    {
        $result[] = array(
            'label'=>$category->name,
            'value'=>$category->slug,
            'group'=>'Categories'
        );
    }
    return $result;
}

function givingwalk_get_causes_categories_for_autocomplete(){
    $cause_categories = givingwalk_get_terms('crw_causes_cat');
    $result = array();
    if(count($cause_categories) > 0 ){
        foreach($cause_categories as $key => $value)
        {
            $result[] = array(
                'label'=>$value,
                'value'=>$key,
                'group'=>'Categories'
            );
        }
    }
    return $result;
}

function givingwalk_get_story_categories_for_autocomplete(){
    $stories_categories = givingwalk_get_terms('crw_stories_cat');
    $result = array();
    if(count($stories_categories) > 0 ){
        foreach($stories_categories as $key => $value)
        {
            $result[] = array(
                'label'=>$value,
                'value'=>$key,
                'group'=>'Categories'
            );
        }
    }
    return $result;
}
 
function givingwalk_generate_uiqueid( $length = 6 ){
    return substr( md5( microtime() ), rand( 0, 26 ), $length );
}

/**
 * crop image
 *
 * @since 1.0.0
 */
/**
 * Return the thumbnail be cropped
 */
function givingwalk_get_image_crop($img_id,$size){ 
    if(!empty($img_id)){
        if (function_exists('wpb_getImageBySize')){
            $img = wpb_getImageBySize( array(
                'attach_id'  => $img_id,
                'thumb_size' => $size,
                'class'      => '',
            ));
            $thumbnail = $img['thumbnail'];
        }else{
            $attachment_image = wp_get_attachment_image_src($img_id, $size);
            $thumbnail = '<img src="'.esc_url($attachment_image[0]).'"/>';
        } 
        return $thumbnail;
    }
    return;
}
function givingwalk_get_image_crop_has_default($img_id,$size){ 
    $default_image = get_template_directory_uri().'/assets/images/no-image.jpg';
    if(!empty($img_id)){
        if (function_exists('wpb_getImageBySize')){
            $img = wpb_getImageBySize( array(
                'attach_id'  => $img_id,
                'thumb_size' => $size,
                'class'      => '',
            ));
            $thumbnail = $img['thumbnail'];
        }else{
            $attachment_image = wp_get_attachment_image_src($img_id, $size);
            $thumbnail = '<img src="'.esc_url($attachment_image[0]).'"/>';
        } 
    }else {
        $thumbnail = '<img src="'.esc_url($default_image).'" class="v-img"/>';
    }
    return $thumbnail;
}

/*
* Resize images dynamically using wp built in functions
* Chinh Duong Manh
*
* php 5.2+
*
* Exempl to use:
*
* <?php
* $thumb = get_post_thumbnail_id();
* $image = givingwalk_resize( $thumb, '', 140, 110, true );
* ?>
*
*/
if ( ! function_exists( 'givingwalk_resize' ) ) {
    /**
     * @param int $attach_id
     * @param string $img_url
     * @param int $width
     * @param int $height
     * @param bool $crop
     *
     * @since 1.0
     * @return array
     */
    function givingwalk_resize( $attach_id = null, $img_url = null, $width, $height, $crop = false ) {
        // this is an attachment, so we have the ID
        if(empty($img_url) || $img_url === null) $img_url = '/wp-content/themes/'.get_template().'/assets/images/no-image.jpg';
        $image_src = array();
        if ( $attach_id ) {
            $image_src = wp_get_attachment_image_src( $attach_id, 'full' );
            $actual_file_path = get_attached_file( $attach_id );
            // this is not an attachment, let's use the image url
        } elseif ( $img_url ) {
            $file_path = parse_url( $img_url );
            $actual_file_path = rtrim( ABSPATH, '/' ) . $file_path['path'];
            $orig_size = getimagesize( $actual_file_path );
            $image_src[0] = site_url().$img_url;
            $image_src[1] = $orig_size[0];
            $image_src[2] = $orig_size[1];
        }
        if ( ! empty( $actual_file_path ) ) {
            $file_info = pathinfo( $actual_file_path );
            $extension = '.' . $file_info['extension'];

            // the image path without the extension
            $no_ext_path = $file_info['dirname'] . '/' . $file_info['filename'];

            $cropped_img_path = $no_ext_path . '-' . $width . 'x' . $height . $extension;

            // checking if the file size is larger than the target size
            // if it is smaller or the same size, stop right here and return
            if ( $image_src[1] > $width || $image_src[2] > $height ) {

                // the file is larger, check if the resized version already exists (for $crop = true but will also work for $crop = false if the sizes match)
                if ( file_exists( $cropped_img_path ) ) {
                    $cropped_img_url = str_replace( basename( $image_src[0] ), basename( $cropped_img_path ), $image_src[0] );
                    $givingwalk_image = array(
                        'url'    => $cropped_img_url,
                        'width'  => $width,
                        'height' => $height,
                        'alt'    => get_bloginfo('name')   
                    );

                    return $givingwalk_image;
                }

                if ( false == $crop ) {
                    // calculate the size proportionaly
                    $proportional_size = wp_constrain_dimensions( $image_src[1], $image_src[2], $width, $height );
                    $resized_img_path = $no_ext_path . '-' . $proportional_size[0] . 'x' . $proportional_size[1] . $extension;

                    // checking if the file already exists
                    if ( file_exists( $resized_img_path ) ) {
                        $resized_img_url = str_replace( basename( $image_src[0] ), basename( $resized_img_path ), $image_src[0] );

                        $givingwalk_image = array(
                            'url'    => $resized_img_url,
                            'width'  => $proportional_size[0],
                            'height' => $proportional_size[1],
                            'alt'    => get_bloginfo('name')   
                        );

                        return $givingwalk_image;
                    }
                }

                // no cache files - let's finally resize it
                $img_editor = wp_get_image_editor( $actual_file_path );

                if ( is_wp_error( $img_editor ) || is_wp_error( $img_editor->resize( $width, $height, $crop ) ) ) {
                    return array(
                        'url'    => '',
                        'width'  => '',
                        'height' => '',
                        'alt'    => get_bloginfo('name')   
                    );
                }

                $new_img_path = $img_editor->generate_filename();

                if ( is_wp_error( $img_editor->save( $new_img_path ) ) ) {
                    return array(
                        'url'    => '',
                        'width'  => '',
                        'height' => '',
                        'alt'    => get_bloginfo('name')   
                    );
                }
                if ( ! is_string( $new_img_path ) ) {
                    return array(
                        'url'    => '',
                        'width'  => '',
                        'height' => '',
                        'alt'    => get_bloginfo('name')   
                    );
                }

                $new_img_size = getimagesize( $new_img_path );
                $new_img = str_replace( basename( $image_src[0] ), basename( $new_img_path ), $image_src[0] );

                // resized output
                $givingwalk_image = array(
                    'url'    => $new_img,
                    'width'  => $new_img_size[0],
                    'height' => $new_img_size[1],
                    'alt'    => get_bloginfo('name')   
                );

                return $givingwalk_image;
            }

            // default output - without resizing
            $givingwalk_image = array(
                'url'    => $image_src[0],
                'width'  => $image_src[1],
                'height' => $image_src[2],
                'alt'    => get_bloginfo('name')   
            );

            return $givingwalk_image;
        }
        return false;
    }
}
if(!function_exists('givingwalk_get_image_url_by_size')){
    function givingwalk_get_image_url_by_size( $id, $size ) {
        global $_wp_additional_image_sizes;

        if ( is_string( $size ) && ( ( ! empty( $_wp_additional_image_sizes[ $size ] ) && is_array( $_wp_additional_image_sizes[ $size ] ) ) || in_array( $size, array(
                    'thumbnail',
                    'thumb',
                    'medium',
                    'medium_large',
                    'large',
                    'full',
                ) ) )
        ) {
            return wp_get_attachment_image_src( $id, $size );
        } else {
            if ( is_string( $size ) ) {
                preg_match_all( '/\d+/', $size, $thumb_matches );
                if ( isset( $thumb_matches[0] ) ) {
                    $size = array();
                    $count = count( $thumb_matches[0] );
                    if ( $count > 1 ) {
                        $size[] = $thumb_matches[0][0]; // width
                        $size[] = $thumb_matches[0][1]; // height
                    } elseif ( 1 === $count ) {
                        $size[] = $thumb_matches[0][0]; // width
                        $size[] = $thumb_matches[0][0]; // height
                    } else {
                        $size = false;
                    }
                }
            }
            if ( is_array( $size ) ) {
                // Resize image to custom size
                $p_img = givingwalk_resize( $id, null, $size[0], $size[1], true );

                return $p_img['url'];
            }
        }
        return '';
    }
}

if(!function_exists('givingwalk_image_by_size')){
    function givingwalk_image_by_size( $id = null , $size = 'medium', $class = '' ) {
        global $_wp_additional_image_sizes;
        if ( is_string( $size ) && ( ( ! empty( $_wp_additional_image_sizes[ $size ] ) && is_array( $_wp_additional_image_sizes[ $size ] ) ) || in_array( $size, array(
                    'thumbnail',
                    'thumb',
                    'medium',
                    'medium_large',
                    'large',
                    'full',
                ) ) )
        ) {
            echo wp_get_attachment_image( $id, $size, '', array('class' => $class) );
        } else {
            if ( is_string( $size ) ) {
                preg_match_all( '/\d+/', $size, $thumb_matches );
                if ( isset( $thumb_matches[0] ) ) {
                    $size = array();
                    $count = count( $thumb_matches[0] );
                    if ( $count > 1 ) {
                        $size[] = $thumb_matches[0][0]; // width
                        $size[] = $thumb_matches[0][1]; // height
                    } elseif ( 1 === $count ) {
                        $size[] = $thumb_matches[0][0]; // width
                        $size[] = $thumb_matches[0][0]; // height
                    } else {
                        $size = false;
                    }
                }
            }
            if ( is_array( $size ) ) {
                // Resize image to custom size
                $p_img = givingwalk_resize( $id, null, $size[0], $size[1], true );
                $alt = trim( strip_tags( get_post_meta( $id, '_wp_attachment_image_alt', true ) ) );
                $attachment = get_post( $id );
                if ( ! empty( $attachment ) ) {
                    $title = trim( strip_tags( $attachment->post_title ) );

                    if ( empty( $alt ) ) {
                        $alt = trim( strip_tags( $attachment->post_excerpt ) ); // If not, Use the Caption
                    }
                    if ( empty( $alt ) ) {
                        $alt = $title;
                    } // Finally, use the title
                } else {
                    $title = $alt = get_bloginfo('name');
                }
                $attributes = givingwalk_stringify_attributes( array(
                    'class'  => $class,
                    'src'    => $p_img['url'],
                    'width'  => $p_img['width'],
                    'height' => $p_img['height'],
                    'alt'    => $alt,
                    'title'  => $title,
                ) );
                $thumbnail = '<img ' . $attributes . ' />';
                echo wp_kses_post($thumbnail);
            }
        }
    }
}

/**
 * Convert array of named params to string version
 * All values will be escaped
 *
 * E.g. f(array('name' => 'foo', 'id' => 'bar')) -> 'name="foo" id="bar"'
 *
 * @param $attributes
 *
 * @return string
 */
function givingwalk_stringify_attributes( $attributes ) {
    $atts = array();
    foreach ( $attributes as $name => $value ) {
        $atts[] = $name . '="' . esc_attr( $value ) . '"';
    }

    return implode( ' ', $atts );
}

/* Include the TGM_Plugin_Activation class.*/
require_once ( get_template_directory() . '/inc/libs/class-tgm-plugin-activation.php' );

/* load list plugins */
require_once( get_template_directory() . '/inc/options/require-plugins.php' );

/* load demo data setting */
require_once( get_template_directory() . '/inc/demo-data.php' );

/* lip font-awesome */
require_once get_template_directory() . '/inc/libs/font-awesome.php';

/* lip font-flaticon */
require_once get_template_directory() . '/inc/libs/font-flaticon.php';

/* load mega menu. */
require_once( get_template_directory() . '/inc/mega-menu/functions.php' );

/* load theme options. */
require_once( get_template_directory() . '/inc/options/function-options.php' );

/* load mata options */
require_once(get_template_directory() . '/inc/options/meta-options.php');

/* load template functions */
require_once( get_template_directory() . '/inc/template-functions.php' );

/* load template functions : Post Favorite */
require_once( get_template_directory() . '/inc/post-favorite.php' );

/* load static css. */
require_once( get_template_directory() . '/inc/dynamic/static-css.php' );

/* load dynamic css*/
require_once( get_template_directory() . '/inc/dynamic/dynamic-css.php' );

if (class_exists('WooCommerce')) {
    require get_template_directory() . '/inc/woocommerce/wc-template-hook.php';
}