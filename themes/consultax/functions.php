<?php
/**
 * Consultax functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Consultax
 */

if ( ! function_exists( 'consultax_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function consultax_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on _s, use a find and replace
		 * to change 'consultax' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'consultax', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary Menu', 'consultax' ),
			'footer'  => esc_html__( 'Footer Menu', 'consultax' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Add image sizes
        add_image_size( 'consultax-recent-post-thumbnail', 68, 70, array( 'center', 'center' ) );
        add_image_size( 'consultax-latest-news-thumbnail', 650, 351, array( 'center', 'center' ) );
        add_image_size( 'consultax-latest-news-thumbnail-second', 200, 251, array( 'center', 'center' ) );

		/*
		 * This theme styles the visual editor to resemble the theme style,
		 * specifically font, colors, and column width.
	 	 */
		add_editor_style( array( 'css/editor-style.css', consultax_fonts_url() ) );

	}
endif;
add_action( 'after_setup_theme', 'consultax_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function consultax_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'consultax_content_width', 640 );
}
add_action( 'after_setup_theme', 'consultax_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function consultax_widgets_init() {
	/* Register the 'primary' sidebar. */
	register_sidebar( array(
		'name'          => esc_html__( 'Primary Sidebar', 'consultax' ),
		'id'            => 'primary',
		'description'   => esc_html__( 'Add widgets here.', 'consultax' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	/* Register the 'service' sidebar. */
	register_sidebar( array(
		'name'          => esc_html__( 'Service Sidebar', 'consultax' ),
		'id'            => 'service',
		'description'   => esc_html__( 'Add widgets here.', 'consultax' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	/* Register the 'shop' sidebar. */
	register_sidebar( array(
		'name'          => esc_html__( 'Product Sidebar', 'consultax' ),
		'id'            => 'product',
		'description'   => esc_html__( 'Add widgets here.', 'consultax' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	/* Repeat register_sidebar() code for additional sidebars. */

	register_sidebar( array(
		'name'          => __( 'Footer First Widget Area', 'consultax' ),
		'id'            => 'footer-area-1',
		'description'   => __( 'Add widgets here to appear in your footer.', 'consultax' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Second Widget Area', 'consultax' ),
		'id'            => 'footer-area-2',
		'description'   => __( 'Add widgets here to appear in your footer.', 'consultax' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Third Widget Area', 'consultax' ),
		'id'            => 'footer-area-3',
		'description'   => __( 'Add widgets here to appear in your footer.', 'consultax' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Fourth Widget Area', 'consultax' ),
		'id'            => 'footer-area-4',
		'description'   => __( 'Add widgets here to appear in your footer.', 'consultax' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'consultax_widgets_init' );

/**
 * Register custom fonts.
 */
if ( ! function_exists( 'consultax_fonts_url' ) ) :
/**
 * Register Google fonts for Blessing.
 *
 * Create your own consultax_fonts_url() function to override in a child theme.
 *
 * @since Blessing 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function consultax_fonts_url() {

    $protocol = is_ssl() ? 'https' : 'http';
	$fonts_url = '';
	$font_families     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Roboto Slab, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'consultax' ) ) {
		$font_families[] = 'Montserrat:100,100i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i';
	}
	if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'consultax' ) ) {
		$font_families[] = 'Open Sans:400,400i,600,600i,700,700i';
	}

	if ( $font_families ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( $subsets ),
		), $protocol.'://fonts.googleapis.com/css' );
	}
	return esc_url_raw( $fonts_url );
}
endif;

/**
 * Enqueue scripts and styles.
 */
function consultax_scripts() {

	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'consultax-fonts', consultax_fonts_url(), array(), null );

	/** All frontend css files **/
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.css', array(), '4.0', 'all');

	/** load fonts icons **/
    wp_enqueue_style( 'awesome-font', get_template_directory_uri().'/css/font-awesome.css');
    wp_enqueue_style( 'ionicon-font', get_template_directory_uri().'/css/ionicon.css');

    /** Slick slider **/
    wp_enqueue_style( 'slick-slider', get_template_directory_uri().'/css/slick.css');
    wp_enqueue_style( 'slick-theme', get_template_directory_uri().'/css/slick-theme.css');

    /** Magnific Popup **/
    wp_enqueue_style( 'magnific-popup', get_template_directory_uri().'/css/magnific-popup.css');

    if( consultax_get_option('preload') != false ){
		wp_enqueue_style( 'consultax-preload', get_template_directory_uri().'/css/royal-preload.css');
	}

	/** Theme stylesheet. **/
	wp_enqueue_style( 'consultax-style', get_stylesheet_uri() );

	if( consultax_get_option('preload') != false ){
		wp_enqueue_script("consultax-royal-preloader", get_template_directory_uri()."/js/royal_preloader.min.js",array('jquery'), '1.0', false);
	}

    wp_enqueue_script( 'countto', get_template_directory_uri() . '/js/countto.min.js', array( 'jquery' ), '20180910', true );
    wp_enqueue_script( 'isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array( 'jquery' ), '20180910', true );
    wp_enqueue_script( 'magnific', get_template_directory_uri() . '/js/jquery.magnific-popup.min.js', array( 'jquery' ), '20180910', true );
    wp_enqueue_script( 'slick-slider', get_template_directory_uri() . '/js/slick.min.js', array( 'jquery' ), '20190221', true );
	wp_enqueue_script( 'consultax-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '20190221', true );

	// Move scripts to scripts.js file.
	wp_enqueue_script( 'custom-header-scripts', get_template_directory_uri() . '/js/header-footer.js', array('jquery'), '20190221', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'consultax_scripts' );


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/frontend/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/frontend/template-functions.php';

/**
 * Custom Page Header for this theme.
 */
require get_template_directory() . '/inc/frontend/breadcrumbs.php';
require get_template_directory() . '/inc/frontend/page-header.php';

/**
 * Functions which add more to backend.
 */
require get_template_directory() . '/inc/backend/admin-functions.php';

/**
 * Custom metabox for this theme.
 */
require get_template_directory() . '/inc/backend/meta-boxes.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/backend/customizer.php';
require get_template_directory() . '/inc/backend/color.php';

/**
 * Register the required plugins for this theme.
 */
require get_template_directory() . '/inc/backend/plugin-requires.php';

/**
 * Import Demo Content
 */
require_once get_template_directory() . '/inc/backend/importer.php';

/**
 * Custom shortcode plugin visual composer.
 */
require_once get_template_directory() . '/vc-shortcodes/shortcodes.php';
require_once get_template_directory() . '/vc-shortcodes/vc_shortcode.php';

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce/woocommerce.php';
}

add_filter( 'woocommerce_gforms_strip_meta_html', 'configure_woocommerce_gforms_strip_meta_html' );
function configure_woocommerce_gforms_strip_meta_html( $strip_html ) {
    $strip_html = false;
    return $strip_html;
}

add_filter("gform_confirmation", "custom_confirmation", 10, 4);
function custom_confirmation($confirmation, $form, $lead, $ajax){
    //only change redirect for form (Sponsor Registration) id 2
    if($form["id"] == "2"){
    	//my drop down with values to check is field 1; use field one out of the lead object
    	switch ($lead[44])
    	{
			case "Red-Belt" :
				$redirect_url = "/checkout/?add-to-cart=2217";
				break;
			case "Black-Belt" :
				$redirect_url = "/checkout/?add-to-cart=2219";
				break;
			case "Purple-Belt-IV-Stripe" :
				$redirect_url = "/checkout/?add-to-cart=3071";
				break;
			case "Purple-Belt-III-Stripe" :
				$redirect_url = "/checkout/?add-to-cart=3070";
				break;
			case "Purple-Belt-II-Stripe" :
				$redirect_url = "/checkout/?add-to-cart=3069";
				break;
			case "Purple-Belt-I-Stripe" :
				$redirect_url = "/checkout/?add-to-cart=3068";
				break;
			case "Purple-Belt" :
				$redirect_url = "/checkout/?add-to-cart=2222";
				break;
			case "Blue-Belt-IV-Stripe" :
				$redirect_url = "/checkout/?add-to-cart=3076";
				break;
			case "Blue-Belt-III-Stripe" :
				$redirect_url = "/checkout/?add-to-cart=3074";
				break;
			case "Blue-Belt-II-Stripe" :
				$redirect_url = "/checkout/?add-to-cart=3073";
				break;
			case "Blue-Belt-I-Stripe" :
				$redirect_url = "/checkout/?add-to-cart=3072";
				break;
			case "Blue-Belt" :
				$redirect_url = "/checkout/?add-to-cart=2223";
				break;
			case "White-Belt-IV-Stripe" :
				$redirect_url = "/checkout/?add-to-cart=3080";
				break;
			case "White-Belt-III-Stripe" :
				$redirect_url = "/checkout/?add-to-cart=3079";
				break;
			case "White-Belt-II-Stripe" :
				$redirect_url = "/checkout/?add-to-cart=3078";
				break;
			case "White-Belt-I-Stripe" :
				$redirect_url = "/checkout/?add-to-cart=3077";
				break;
			case "White-Belt" :
				$redirect_url = "/checkout/?add-to-cart=2224";
				break;
			default :
				//set default redirect url
				$redirect_url = "https://www.thedojotradeshow.com";
				break;
    	}
        $confirmation = array("redirect" => $redirect_url);
    }
    return $confirmation;
}

add_filter("gform_confirmation", "custom_confirmation_vendor", 10, 5);
function custom_confirmation_vendor($confirmation, $form, $lead, $ajax){
    //only change redirect for form (Sponsor Registration) id 2
    if($form["id"] == "3"){
    	//my drop down with values to check is field 1; use field one out of the lead object
    	switch ($lead[44])
    	{
			case "10x10" :
				$redirect_url = "/checkout/?add-to-cart=3129";
				break;
			case "10x20" :
				$redirect_url = "/checkout/?add-to-cart=3130";
				break;
			case "10x30" :
				$redirect_url = "/checkout/?add-to-cart=3131";
				break;
			case "20x20" :
				$redirect_url = "/checkout/?add-to-cart=3132";
				break;
			default :
				//set default redirect url
				$redirect_url = "https://www.thedojotradeshow.com";
				break;
    	}
        $confirmation_vendor = array("redirect" => $redirect_url);
    }
    return $confirmation_vendor;
}


add_filter("gform_confirmation", "custom_confirmation_download", 10, 6);
function custom_confirmation_download($confirmation, $form, $lead, $ajax){
    //only change redirect for form (Sponsor Registration) id 2
    if($form["id"] == "9"){
    	//my drop down with values to check is field 1; use field one out of the lead object
    	switch ($lead[8])
    	{
			case "Dojo-Portland" :
				$redirect_url = "https://www.thedojotradeshow.com/wp-content/uploads/2019/08/Prospectus.pdf";
				break;
			case "Dojo-Dallas" :
				$redirect_url = "https://www.thedojotradeshow.com/wp-content/uploads/2019/08/Prospectus.pdf";
				break;
			default :
				//set default redirect url
				$redirect_url = "https://www.thedojotradeshow.com/wp-content/uploads/2019/08/Prospectus.pdf";
				break;
    	}
        $confirmation_download = array("redirect" => $redirect_url);
    }
    return $confirmation_download;
}


/**
* Limit How Many Checkboxes Can Be Checked
* https://gravitywiz.com/2012/06/11/limiting-how-many-checkboxes-can-be-checked/
*/
class GFLimitCheckboxes {
 private $form_id;
 private $field_limits;
 private $output_script;
 function __construct($form_id, $field_limits) {
 $this->form_id = $form_id;
 $this->field_limits = $this->set_field_limits($field_limits);
 add_filter("gform_pre_render_$form_id", array(&$this, 'pre_render'));
 add_filter("gform_validation_$form_id", array(&$this, 'validate'));
 }
 function pre_render($form) {
 $script = '';
 $output_script = false;
 foreach($form['fields'] as $field) {
 $field_id = $field['id'];
 $field_limits = $this->get_field_limits($field['id']);
 if( !$field_limits // if field limits not provided for this field
 || RGFormsModel::get_input_type($field) != 'checkbox' // or if this field is not a checkbox
 || !isset($field_limits['max']) // or if 'max' is not set for this field
 )
 continue;
 $output_script = true;
 $max = $field_limits['max'];
 $selectors = array();
 foreach($field_limits['field'] as $checkbox_field) {
 $selectors[] = "#field_{$form['id']}_{$checkbox_field} .gfield_checkbox input:checkbox";
 }
 $script .= "jQuery(\"" . implode(', ', $selectors) . "\").checkboxLimit({$max});";
 }
 GFFormDisplay::add_init_script($form['id'], 'limit_checkboxes', GFFormDisplay::ON_PAGE_RENDER, $script);
 if($output_script):
 ?>
 <script type="text/javascript">
 jQuery(document).ready(function($) {
 $.fn.checkboxLimit = function(n) {
 var checkboxes = this;
 this.toggleDisable = function() {
 // if we have reached or exceeded the limit, disable all other checkboxes
 if(this.filter(':checked').length >= n) {
 var unchecked = this.not(':checked');
 unchecked.prop('disabled', true);
 }
 // if we are below the limit, make sure all checkboxes are available
 else {
 this.prop('disabled', false);
 }
 }
 // when form is rendered, toggle disable
 checkboxes.bind('gform_post_render', checkboxes.toggleDisable());
 // when checkbox is clicked, toggle disable
 checkboxes.click(function(event) {
 checkboxes.toggleDisable();
 // if we are equal to or below the limit, the field should be checked
 return checkboxes.filter(':checked').length <= n;
 });
 }
 });
 </script>
 <?php
 endif;
 return $form;
 }
 function validate($validation_result) {
 $form = $validation_result['form'];
 $checkbox_counts = array();
 // loop through and get counts on all checkbox fields (just to keep things simple)
 foreach($form['fields'] as $field) {
 if( RGFormsModel::get_input_type($field) != 'checkbox' )
 continue;
 $field_id = $field['id'];
 $count = 0;
 foreach($_POST as $key => $value) {
 if(strpos($key, "input_{$field['id']}_") !== false)
 $count++;
 }
 $checkbox_counts[$field_id] = $count;
 }
 // loop through again and actually validate
 foreach($form['fields'] as &$field) {
 if(!$this->should_field_be_validated($form, $field))
 continue;
 $field_id = $field['id'];
 $field_limits = $this->get_field_limits($field_id);
 $min = isset($field_limits['min']) ? $field_limits['min'] : false;
 $max = isset($field_limits['max']) ? $field_limits['max'] : false;
 $count = 0;
 foreach($field_limits['field'] as $checkbox_field) {
 $count += rgar($checkbox_counts, $checkbox_field);
 }
 if($count < $min) {
 $field['failed_validation'] = true;
 $field['validation_message'] = sprintf( _n('You must select at least %s item.', 'You must select at least %s items.', $min), $min );
 $validation_result['is_valid'] = false;
 }
 else if($count > $max) {
 $field['failed_validation'] = true;
 $field['validation_message'] = sprintf( _n('You may only select %s item.', 'You may only select %s items.', $max), $max );
 $validation_result['is_valid'] = false;
 }
 }
 $validation_result['form'] = $form;
 return $validation_result;
 }
 function should_field_be_validated($form, $field) {
 if( $field['pageNumber'] != GFFormDisplay::get_source_page( $form['id'] ) )
 return false;
 // if no limits provided for this field
 if( !$this->get_field_limits($field['id']) )
 return false;
 // or if this field is not a checkbox
 if( RGFormsModel::get_input_type($field) != 'checkbox' )
 return false;
 // or if this field is hidden
 if( RGFormsModel::is_field_hidden($form, $field, array()) )
 return false;
 return true;
 }
 function get_field_limits($field_id) {
 foreach($this->field_limits as $key => $options) {
 if(in_array($field_id, $options['field']))
 return $options;
 }
 return false;
 }
 function set_field_limits($field_limits) {
 foreach($field_limits as $key => &$options) {
 if(isset($options['field'])) {
 $ids = is_array($options['field']) ? $options['field'] : array($options['field']);
 } else {
 $ids = array($key);
 }
 $options['field'] = $ids;
 }
 return $field_limits;
 }
}
new GFLimitCheckboxes(3, array(
 26 => array(
 'max' => 3
 )
 ));