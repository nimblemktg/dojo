<?php  
/**
 * Charity Walk functions and definitions
 *
 * Sets up the theme and provides some helper functions, which are used
 * in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, @link http://codex.wordpress.org/Plugin_API
 *
 * @package SpyroPress
 * @subpackage Giving Walk
 * @since 1.0.0
 * @author Red Team
 */

// Set up the content width value based on the theme's design and stylesheet.
if (!isset($content_width))
    $content_width = 1170;

/**
 * Charity Walk setup.
 *
 * Sets up theme defaults and registers the various WordPress features that
 * SP ChariyPlus supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add a Visual Editor stylesheet.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links,
 *    custom background, and post formats.
 * @uses register_nav_menu() To add support for navigation menus.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since 1.0.0
 */

function givingwalk_setup()
{
    // load language.
    load_theme_textdomain('givingwalk', get_template_directory() . '/languages');
    // Adds title tag
    add_theme_support("title-tag");

    // Adds custom header
    add_theme_support('custom-header');

    // Adds RSS feed links to <head> for posts and comments.
    add_theme_support('automatic-feed-links');

    // This theme supports a variety of post formats.
    add_theme_support('post-formats', array('video', 'audio', 'gallery', 'quote', 'link'));

    // This theme uses wp_nav_menu() in one location.
    register_nav_menu('primary', esc_html__('Primary Menu', 'givingwalk'));
    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    /* 
     * This theme supports custom background color and image,
     * and here we also set up the default background color.
     */
    add_theme_support('custom-background', array('default-color' => 'ffffff',));

    // Add woocommerce
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider'); 

    // This theme uses a custom image size for featured images, displayed on "standard" posts.
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(1170, 500, true); // Limited height, hard crop
    $theme_options = [
        'large_size_w'        => 1170,
        'large_size_h'        => 525,
        'large_crop'          => 1, 
        'medium_size_w'       => 555,
        'medium_size_h'       => 345,
        'medium_crop'         => 1,
        'thumbnail_size_w'    => 370,
        'thumbnail_size_h'    => 370,
        'thumbnail_crop'      => 1,
    ];
    foreach ($theme_options as $option => $value) {
        if (get_option($option, '') != $value)
            update_option($option, $value);
    }

    add_image_size('givingwalk-1170-498', 1170,498, true);

    /* NavXT */
    $bcn_options = get_option('bcn_options', array());
    if(empty($bcn_options['opt_bcn_installed']))
    {
        $bcn_options['hseparator'] = '&nbsp;/&nbsp;';
        $bcn_options['home_title'] = esc_html__('Home','givingwalk');
        $bcn_options['opt_bcn_installed'] = 'true';
        update_option('bcn_options',$bcn_options);
    }
    /*
     * This theme styles the visual editor to resemble the theme style,
     * specifically font, colors, icons, and column width.
     */
    add_editor_style(array('assets/css/editor-style.css'));

    //ef4 frame use
    $option = get_option('ef4_frames_use',[]);
    if(!is_array($option))
        $option = [];
    $option['scss'] = 'new';// = false/0 to turn off

    update_option('ef4_frames_use',$option);
}

add_action('after_setup_theme', 'givingwalk_setup');
function givingwalk_switch_theme(){
    $bcn_options = get_option('bcn_options', array());
    if(!empty($bcn_options['opt_bcn_installed']))
    {
        unset($bcn_options['opt_bcn_installed']);
        update_option('bcn_options',$bcn_options);
    }
}
add_action('switch_theme', 'givingwalk_switch_theme');

/**
 * Register Google Fonts
 *
 * https://gist.github.com/kailoon/e2dc2a04a8bd5034682c
 * https://themeshaper.com/2014/08/13/how-to-add-google-fonts-to-wordpress-themes/
 *
 */
 
function givingwalk_fonts_url()
{
    $font_url = '';
    if ( 'off' !== _x( 'on', 'Google font: on or off', 'givingwalk' ) ) {
        $font_url = add_query_arg('family', urlencode('Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|Lato:100,100i,300,300i,400,400i,700,700i,900,900i&subset=latin,latin-ext'), "//fonts.googleapis.com/css");
    }
    return $font_url;
}

function givingwalk_font_scripts()
{
    wp_enqueue_style('givingwalk-fonts', givingwalk_fonts_url(), array(), '1.0.0');
}

add_action('wp_enqueue_scripts', 'givingwalk_font_scripts');

/**
 * Enqueue scripts and styles for front-end.
 * @author Red Team
 * @since 1.0.0
 */
function givingwalk_front_end_scripts()
{
    global $wp_styles;
    
    $script_options = array(
        'email_placeholder'=> esc_html__( 'Enter Your Email', 'givingwalk' ),
        'name_placeholder' => esc_html__( 'Complete Name', 'givingwalk' ),
    );

    /* Adds JavaScript Bootstrap. */
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '5.1.1');

    wp_register_script('givingwalk-mainjs', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), wp_get_theme()->get('Version'), true);
     
    wp_localize_script('givingwalk-mainjs', 'CMSOptions', $script_options);
    wp_enqueue_script('givingwalk-mainjs');

    /* OWL Carousel */
    if (class_exists('VC_Manager')) {
        wp_register_script( 'vc_pageable_owl-carousel', vc_asset_url( 'lib/owl-carousel2-dist/owl.carousel.min.js' ), array(
            'jquery',
        ), WPB_VC_VERSION, true );
        wp_register_style( 'vc_pageable_owl-carousel-css', vc_asset_url( 'lib/owl-carousel2-dist/assets/owl.min.css' ), array(), WPB_VC_VERSION );
        wp_register_script('red-owlcarousel', get_template_directory_uri() . '/assets/js/red-owlcarousel.js', array('jquery'), '1.0.0', true);
        wp_register_style( 'animate-css', vc_asset_url( 'lib/bower/animate-css/animate.min.css' ), array(), WPB_VC_VERSION );
    }
    /* Magnific Popup */
    wp_enqueue_script( 'magnific-popup', get_template_directory_uri() . '/assets/libs/magnific-popup/magnific-popup.min.js', array('jquery'),'1.1.0', true );
    wp_enqueue_style('magnific-popup', get_template_directory_uri() . '/assets/libs/magnific-popup/magnific-popup.css', '', wp_get_theme()->get('Version'));

    if(class_exists('Woocommerce')) {
        wp_enqueue_script('givingwalk-woo-custom', get_template_directory_uri() . '/inc/woocommerce/js/woo-custom.js', array( 'jquery' ), '1.0.0', true); 
    }

    /* Comment */
    if (is_singular() && comments_open() && get_option('thread_comments'))
        wp_enqueue_script('comment-reply');
    /* Share this */
    wp_register_script('sharethis', get_template_directory_uri() . '/assets/js/sharethis.js', '', wp_get_theme()->get('Version'));
    wp_enqueue_script('sharethis');
     
    /* Loads Font stylesheet. */
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', '', '4.7.0');

    wp_enqueue_style('givingwalk-flaticon', get_template_directory_uri() . '/assets/css/flaticon.css', array(), '1.0.0'); 

    /* Load static css */
    wp_enqueue_style('givingwalk-static', get_template_directory_uri() . '/assets/css/static.css', '', wp_get_theme()->get('Version'));
}

add_action('wp_enqueue_scripts', 'givingwalk_front_end_scripts');

/**
 * load admin scripts.
 *
 * @author Red Team
 * @since 1.0.0
 */
function givingwalk_admin_scripts()
{
    /* Adds style for admin */
    wp_enqueue_style('givingwalk-admin', get_template_directory_uri() . '/assets/css/red-admin.css', array(), wp_get_theme()->get('Version'));
    wp_enqueue_style('givingwalk-flaticon', get_template_directory_uri() . '/assets/css/flaticon.css', array(), '1.0.0'); 

    $screen = get_current_screen();

    /* load js for edit post. */
    if ($screen->post_type == 'post') {
        /* post format select. */
        wp_enqueue_script('givingwalk-post-format', get_template_directory_uri() . '/assets/js/post-format.js', array(), wp_get_theme()->get('Version'), true);
    }

    wp_enqueue_script( 'givingwalk-admin', get_template_directory_uri() . '/assets/js/admin.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-sortable', 'media-upload' ) );
    wp_localize_script( 'givingwalk-admin', 'RedExpMediaLocalize', array(
        'add_video' => esc_html__( 'Add Video', 'givingwalk' ),
        'add_audio' => esc_html__( 'Add Audio', 'givingwalk' ),
        'add_images' => esc_html__( 'Add Image(s)', 'givingwalk' ),
        'add_image' => esc_html__( 'Add Image', 'givingwalk' )
    ) );
}

add_action('admin_enqueue_scripts', 'givingwalk_admin_scripts');

/**
 * Register sidebars.
 *
 * Registers our main widget area and the front page widget areas.
 *
 * @author Red Team
 * @since 1.0.0
 */
function givingwalk_widgets_init()
{

    global $opt_theme_options;

    register_sidebar(array(
        'name'          => esc_html__('Main Sidebar', 'givingwalk'),
        'id'            => 'sidebar-main',
        'description'   => esc_html__('Appears on posts and pages except the optional Front Page template, which has its own widgets', 'givingwalk'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="wg-title">',
        'after_title'   => '</h3>',
    ));
    /* Shop Sidebar */
    if (class_exists('WooCommerce')) {
        register_sidebar(array(
            'name'          => esc_html__('WooCommerce Sidebar', 'givingwalk'),
            'id'            => 'sidebar-shop',
            'description'   => esc_html__('Appears in WooCommerce Archive page', 'givingwalk'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h4 class="wg-title"><span>',
            'after_title'   => '</span></h4>',
        ));
    }
    
    /* Header Top */
    register_sidebar(array(
        'name'          => esc_html__('Header Top 1', 'givingwalk'),
        'id'            => 'sidebar-header-top-1',
        'description'   => esc_html__('Appears in Top Left of the site', 'givingwalk'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h4 class="wg-title">',
        'after_title'   => '</h4>',
    ));
    register_sidebar(array(
        'name'          => esc_html__('Header Top 2', 'givingwalk'),
        'id'            => 'sidebar-header-top-2',
        'description'   => esc_html__('Appears in Top Right of the site', 'givingwalk'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h4 class="wg-title">',
        'after_title'   => '</h4>',
    ));
    
    /* Header Tools */
    register_sidebar(array(
        'name'          => esc_html__('Header Tools', 'givingwalk'),
        'id'            => 'header-tool',
        'description'   => esc_html__('Appears in right side of the site when you click on Header TooLs icon', 'givingwalk'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h4 class="wg-title">',
        'after_title'   => '</h4>',
    ));
    /* footer-top */
     
    register_sidebar(array(
        'name'          => esc_html__('Footer Top Layout 1 - col 1', 'givingwalk'),
        'id'            => 'sidebar-footer-top-layout1-col1',
        'description'   => esc_html__('Appears at footer top area', 'givingwalk'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="wg-title">',
        'after_title'   => '</h3>',
    ));
    register_sidebar(array(
        'name'          => esc_html__('Footer Top Layout 1 - col 2', 'givingwalk'),
        'id'            => 'sidebar-footer-top-layout1-col2',
        'description'   => esc_html__('Appears at footer top area', 'givingwalk'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="wg-title">',
        'after_title'   => '</h3>',
    ));
    if( isset($opt_theme_options['opt_footer_top_column_2']) && (int)$opt_theme_options['opt_footer_top_column_2'] != 0){
        for($i = 1 ; $i <= (int)$opt_theme_options['opt_footer_top_column_2'] ; $i++){
            register_sidebar(array(
                'name' => sprintf(esc_html__('Footer Top Layout 2,3 - col %s', 'givingwalk'), $i),
                'id' => 'sidebar-footer-top-layout23-col' . $i,
                'description' => esc_html__('Appears on footer top area', 'givingwalk'),
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget' => '</aside>',
                'before_title' => '<h3 class="wg-title">',
                'after_title' => '</h3>',
            ));
        }
    }
     
    /* Footer Bottom */
    register_sidebar(array(
        'name'          => esc_html__('Footer Bottom', 'givingwalk'),
        'id'            => 'sidebar-footer-bottom',
        'description'   => esc_html__('Appears at bottom of page', 'givingwalk'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="wg-title">',
        'after_title'   => '</h3>',
    ));
    /* Widget for Mega Menu */
    if (isset($opt_theme_options) && !empty($opt_theme_options['opt_enable_mega_menu']) && !empty($opt_theme_options['opt_mega_menu_wg'])) {
        for ($i = 1; $i <= $opt_theme_options['opt_mega_menu_wg']; $i++) {
            register_sidebar(array(
                'name'          => sprintf(esc_html__('Mega Menu Widget %s', 'givingwalk'), $i),
                'id'            => 'megamenu-' . $i,
                'description'   => esc_html__('Add widget here then go to Menu manager and choose the widget you want to show!', 'givingwalk'),
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget'  => '</aside>',
                'before_title'  => '<h3 class="wg-title">',
                'after_title'   => '</h3>',
            ));
        }
    }
}

add_action('widgets_init', 'givingwalk_widgets_init');
/**
 * Add widgets
 * givingwalk Instagram
 * givingwalk Recent Post
 * givingwalk Social
 * @author Red Team
 * @since 1.0.0
 */

require(get_template_directory() . '/inc/widgets/widget-instagram.php');
require(get_template_directory() . '/inc/widgets/widget-recentpost.php');
require(get_template_directory() . '/inc/widgets/widget-social.php');
require(get_template_directory() . '/inc/widgets/donation.php');
require(get_template_directory() . '/inc/widgets/video_carousel.php');
require(get_template_directory() . '/inc/widgets/class-widget-extends.php');
require(get_template_directory() . '/inc/widgets/widget-search.php');
require(get_template_directory() . '/inc/widgets/flickrphotos.php');


/* core functions. */
require_once(get_template_directory() . '/inc/functions.php');

/**
 * Custom VC
 *
 * @author Red Team
 * @since 1.0.0
 */
if (class_exists('VC_Manager')) {
    /* Custom VC element params */
    require(get_template_directory() . '/vc_customs/vc-customs.php');

    /* Add new Elemnts to VC */
    add_action('vc_before_init', 'givingwalk_vc_before');
    function givingwalk_vc_before()
    {
        if (!class_exists('CmsShortCode')) return;
        require(get_template_directory() . '/inc/elements/red_blog.php');
        require(get_template_directory() . '/inc/elements/red_button.php');
        require(get_template_directory() . '/inc/elements/red_clients.php');
        require(get_template_directory() . '/inc/elements/red_countdown.php');
        require(get_template_directory() . '/inc/elements/red_counter.php');
        require(get_template_directory() . '/inc/elements/red_emptyspace.php');
        require(get_template_directory() . '/inc/elements/red_heading.php');
        require(get_template_directory() . '/inc/elements/red_instagram.php');
        require(get_template_directory() . '/inc/elements/red_pricing.php');
        require(get_template_directory() . '/inc/elements/red_process.php');
        require(get_template_directory() . '/inc/elements/red_fancybox.php');
        require(get_template_directory() . '/inc/elements/red_social.php');
        require(get_template_directory() . '/inc/elements/red_team.php');
        require(get_template_directory() . '/inc/elements/red_testimonial.php');
        require(get_template_directory() . '/inc/elements/red_googlemap.php');
        require(get_template_directory() . '/inc/elements/red_contact_info.php');
        require(get_template_directory() . '/inc/elements/red_newsletter.php'); 
        require(get_template_directory() . '/inc/elements/red_gallery_image.php'); 
        require(get_template_directory() . '/inc/elements/red_single_video.php'); 
        require(get_template_directory() . '/inc/elements/red_involved_donation.php'); 
        require(get_template_directory() . '/inc/elements/red_carousel.php'); 
        require(get_template_directory() . '/inc/elements/red_advanced_search.php'); 
        require(get_template_directory() . '/inc/elements/red_causes_carousel.php'); 
        require(get_template_directory() . '/inc/elements/red_story_carousel.php'); 
        require(get_template_directory() . '/inc/elements/red_events.php'); 
        require(get_template_directory() . '/inc/elements/red_volunteer_box.php'); 
        require(get_template_directory() . '/inc/elements/red_single_causes_donation.php'); 
    }

}
 



