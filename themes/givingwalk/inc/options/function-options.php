<?php
/**
 * ReduxFramework Sample Config File
 * For full documentation, please visit: http://docs.reduxframework.com/
 */
if (! class_exists('Redux')) {
    return;
}
// This line is only for altering the demo. Can be easily removed.
$opt_name = apply_filters('opt_name', 'opt_theme_options');

$theme = wp_get_theme(); // For use with some settings. Not necessary.

$args = array( 
    // TYPICAL -> Change these values as you need/desire
    'opt_name' => $opt_name,
    // This is where your data is stored in the database and also becomes your global variable name.
    'display_name' => $theme->get('Name'),
    // Name that appears at the top of your panel
    'display_version' => $theme->get('Version'),
    // Version that appears at the top of your panel
    'menu_type' => 'menu',
    // Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
    'allow_sub_menu' => true,
    // Show the sections below the admin menu item or not
    'menu_title' => $theme->get('Name'),
    'page_title' => $theme->get('Name'),
    // You will need to generate a Google API key to use this feature.
    // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
    'google_api_key' => '',
    // Set it you want google fonts to update weekly. A google_api_key value is required.
    'google_update_weekly' => false,
    // Must be defined to add google fonts to the typography module
    'async_typography' => false,
    // Use a asynchronous font on the front end or font string
    // 'disable_google_fonts_link' => true, // Disable this in case you want to create your own google fonts loader
    'admin_bar' => false,
    // Show the panel pages on the admin bar
    'admin_bar_icon' => 'dashicons-smiley',
    // Choose an icon for the admin bar menu
    'admin_bar_priority' => 50,
    // Choose an priority for the admin bar menu
    'global_variable' => '',
    // Set a different name for your global variable other than the opt_name
    'dev_mode' => false,
    // Show the time the page took to load, etc
    'update_notice' => true,
    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
    'customizer' => true,
    // Enable basic customizer support
    // 'open_expanded' => true, // Allow you to start the panel in an expanded way initially.
    'disable_save_warn' => true, // Disable the save warning when a user changes a field

    // OPTIONAL -> Give you extra features
    'page_priority' => null,
    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
    'page_parent' => 'themes.php',
    // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
    'page_permissions' => 'manage_options',
    // Permissions needed to access the options panel.
    'menu_icon' => 'dashicons-dashboard',
    // Specify a custom URL to an icon
    'last_tab' => '',
    // Force your panel to always open to a specific tab (by id)
    'page_icon' => 'dashicons-smiley',
    // Icon displayed in the admin panel next to your menu_title
    'page_slug' => '',
    // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
    'save_defaults' => true,
    // On load save the defaults to DB before user clicks save or not
    'default_show' => false,
    // If true, shows the default value next to each field that is not the default value.
    'default_mark' => '',
    // What to print by the field's title if the value shown is default. Suggested: *
    'show_import_export' => true,
    // Shows the Import/Export panel when not used as a field.

    // CAREFUL -> These options are for advanced use only
    'transient_time' => 60 * MINUTE_IN_SECONDS,
    'output' => true,
    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
    'output_tag' => true,
    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
    // 'footer_credit' => '', // Disable the footer credit of Redux. Please leave if you can help it.

    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
    'database' => '',
    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
    'use_cdn' => true,
    // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

    // HINTS
    'hints' => array(
        'icon' => 'el el-question-sign',
        'icon_position' => 'right',
        'icon_color' => 'lightgray',
        'icon_size' => 'normal',
        'tip_style' => array(
            'color' => 'red',
            'shadow' => true,
            'rounded' => false,
            'style' => ''
        ),
        'tip_position' => array(
            'my' => 'top left',
            'at' => 'bottom right'
        ),
        'tip_effect' => array(
            'show' => array(
                'effect' => 'slide',
                'duration' => '500',
                'event' => 'mouseover'
            ),
            'hide' => array(
                'effect' => 'slide',
                'duration' => '500',
                'event' => 'click mouseleave'
            )
        )
    )
);

Redux::setArgs($opt_name, $args);

$show_rev_slider = $show_rev_slider_list = $show_rev_slider_page = '';

if(class_exists('RevSlider')){
    $show_rev_slider = array(
        'title'     => esc_html__('Revolution Slider', 'givingwalk'),
        'subtitle'      => esc_html__('Show a Revolution Slider before Main Header', 'givingwalk'),
        'id'        => 'opt_show_header_slider',
        'type'      => 'switch',
        'default'   => false,
    ); 

    $show_rev_slider_list = array(
        'id'        => 'opt_header_slider',
        'title'     => esc_html__('Slider', 'givingwalk'),
        'placeholder'  => esc_html__('select a slider for header', 'givingwalk'),
        'default'   => 'home',
        'type'      => 'select',
        'options'   => givingwalk_get_list_rev_slider(),
        'required'  => array( 0 => 'opt_show_header_slider', 1 => '=', 2 => '1' )
    );
    $show_rev_slider_page = array(
        'id'        => 'opt_header_slider_page',
        'title'     => esc_html__('Show Slider on page ?', 'givingwalk'),
        'type'      => 'select',
        'data'      => 'pages',
        'multi'     => 'true',
        'placeholder'   => esc_html__('Select page you want to show slider','givingwalk'),
        'required'  => array( 0 => 'opt_header_slider', 1 => '!=', 2 => '' )
    );
}

/* Custom Post type option */
function givingwalk_portfolio_opt(){
    global $opt_name;
    $redportfolio_opt = '';
    if(post_type_exists('redportfolio')){
        $redportfolio_opt = Redux::setSection($opt_name, array(
        'title'         => esc_html__('Single Portfolio', 'givingwalk'),
        'icon'          => 'dashicons dashicons-align-left',
        'subsection'    => true,
        'fields'        => array(
            array(
                'title'     => esc_html__('Single Layout', 'givingwalk'),
                'subtitle'  => esc_html__('Choose default layout for single Portfolio page', 'givingwalk'),
                'id'        => 'opt_portfolio_layout',
                'type'      => 'button_set',
                'options'   => array(
                    ''     => esc_html__('Default','givingwalk'),
                ),
                'default'   => '',
            ),
        )));
    }
    return $redportfolio_opt;
}

/**
 * General
 * 
 * @author Red Team
 * @since 1.0.0
 */
Redux::setSection($opt_name, array(
    'title'     => esc_html__('General', 'givingwalk'),
    'heading'   => '',
    'icon'      => 'dashicons dashicons-admin-home',
    'fields'    => array(
        array(
            'title'    => esc_html__('Boxed Layout', 'givingwalk'),
            'subtitle' => esc_html__('make your site is boxed?', 'givingwalk'),
            'id'       => 'opt_body_layout',
            'type'     => 'button_set',
            'options'  => array(
                0      => esc_html__('Default', 'givingwalk'),
                1      => esc_html__('Boxed', 'givingwalk')
            ),
            'default'  => 0
        ),
        array(
            'title'     => esc_html__('Boxed Background', 'givingwalk'),
            'subtitle'  => esc_html__('Choose background style boxed area', 'givingwalk'),
            'id'        => 'opt_boxed_bg',
            'type'      => 'background',
            'default'   => array(),
            'output'    => array('.red-boxed'),
            'default'   => array(
                'background-color' => '#FFFFFF'
            ),
            'required'  => array(
                array('opt_body_layout', '!=','0')
            )
        ),
        array(
            'title'     => esc_html__('Boxed width', 'givingwalk'),
            'subtitle'  => esc_html__('This option just applied for screen larger than value you enter here!', 'givingwalk'),
            'id'        => 'opt_body_width',
            'type'      => 'dimensions',
            'units'     => array('px'),
            'height'    => false,
            'default'   => array(
                'width' => '1200px',
                'units' => 'px'
            ),
            'required'  => array( 
                array( 'opt_body_layout', '=', 1), 
            ),
        ),
        
        array(
            'title'     => esc_html__('Body Background', 'givingwalk'),
            'subtitle'  => esc_html__('Choose background style', 'givingwalk'),
            'id'        => 'opt_body_bg',
            'type'      => 'background',
            'default'   => array(),
            'output'    => array('body')
        ),
        
        array(
            'title'     => esc_html__('Body Padding', 'givingwalk'),
            'subtitle'  => esc_html__('Choose padding for BODY tag', 'givingwalk'),
            'id'        => 'opt_body_padding',
            'type'      => 'spacing',
            'mode'      => 'padding',
            'units'     => array('px'),     
            'default'   => array(),
            'output'    => array('body')
        ),
        array(
            'title'     => esc_html__('Body Margin', 'givingwalk'),
            'subtitle'  => esc_html__('Choose margin for BODY tag', 'givingwalk'),
            'id'        => 'opt_body_margin',
            'type'      => 'spacing',
            'mode'      => 'margin',
            'units'     => array('px'),     
            'default'   => array(),
            'output'    => array('body')
        ),
    )
));
/**
 * Extra
 * 
 * @author Red Team
 * @since 1.0.0
 */
Redux::setSection($opt_name, array(
    'title'     => esc_html__('Extra', 'givingwalk'),
    'heading'   => '',
    'icon'      => 'dashicons dashicons-plus-alt',
    'subsection'=> true,
    'fields'    => array(
        array(
            'title'     => esc_html__('Enable Page Loading', 'givingwalk'),
            'subtitle'  => '',
            'id'        => 'opt_page_loading',
            'type'      => 'switch',
            'default'   => false
        ),
        array(
            'title'     => esc_html__('Page Loadding Style','givingwalk'),
            'subtitle'  => esc_html__('Select Style Page Loadding.','givingwalk'),
            'id'        => 'opt_page_loading_style',
            'type'      => 'select',
            'options'   => array(
                '1' => esc_html__('Newtons cradle','givingwalk'),
                '2' => esc_html__('Wave','givingwalk'),
                '3' => esc_html__('Circus','givingwalk'),
                '4' => esc_html__('Atom','givingwalk'),
                '5' => esc_html__('Fussion','givingwalk'),
                '6' => esc_html__('Mitosis','givingwalk'),
                '7' => esc_html__('Flower','givingwalk'),
                '8' => esc_html__('Clock','givingwalk'),
                '9' => esc_html__('Washing machine','givingwalk'),
                '10' => esc_html__('Pulse','givingwalk'),
            ),
            
            'default'   => '5',
            'required'  => array( 0 => 'opt_page_loading', 1 => '=', 2 => 1 )
        ) ,
        array(
            'title'     => esc_html__('Enable Back To Top', 'givingwalk'),
            'subtitle'  => '',
            'id'        => 'opt_backtotop',
            'type'      => 'switch',
            'default'   => false
        ),
    )
));

/**
 * Styling
 * 
 * @author Red Team
 * @since 1.0.0
 */
Redux::setSection($opt_name, array(
    'title'     => esc_html__('Theme Color', 'givingwalk'),
    'icon'      => 'dashicons dashicons-art',
    'fields'    => array(
        array(
            'title'     => esc_html__('Primary Color', 'givingwalk'),
            'subtitle'  => esc_html__('Choose your primary color.', 'givingwalk'),
            'id'        => 'opt_primary_color',
            'type'      => 'link_color',
            'hover'     => false,
            'active'    => false,
            'default'   => array()
        ),
        array(
            'id'       => 'opt_link_color',
            'type'     => 'link_color',
            'title'    => esc_html__( 'Links Color', 'givingwalk' ),
            'subtitle' => esc_html__( 'Select links color option', 'givingwalk' ),
            'regular'   => true,
            'hover'     => true,
            'active'    => false,
            'visited'   => false,
        ),
        array(
            'title'    => esc_html__('Dark Version', 'givingwalk'),
            'subtitle' => esc_html__('make your site is boxed?', 'givingwalk'),
            'id'       => 'opt_dark_version',
            'type'     => 'button_set',
            'options'  => array(
                0      => esc_html__('Default', 'givingwalk'),
                1      => esc_html__('Dark', 'givingwalk')
            ),
            'default'  => 0
        ),
        array(
            'title'     => esc_html__('Heading Color', 'givingwalk'),
            'subtitle'  => esc_html__('Choose your heading color.', 'givingwalk'),
            'id'        => 'opt_heading_color',
            'type'      => 'color',
            'default'   => '#333333',
        ),
    )
));
/**
 * Typography
 * 
 * @author Red Team
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Typography', 'givingwalk'),
    'heading' => '',
    'icon' => 'el-icon-text-width',
    'fields' => array(
        array(
            'id'                =>  'opt_font_body',
            'type'              =>  'typography',
            'title'             =>  esc_html__('Body Font', 'givingwalk'),
            'text-transform'    =>  true,
            'letter-spacing'    =>  true,
            'text-align'        =>  false,
            'output'            =>  array('body'),
            'units'             =>  'px',
            'subtitle'          =>  esc_html__('Typography option with each property can be called individually.', 'givingwalk'),
        )
    )
));
/**
 * Heading Font
 * 
 * @author Red Team
 * @since 1.0.0
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Heading', 'givingwalk'),
    'heading' => esc_html__('Choose style for all heading style', 'givingwalk'),
    'icon' => 'el-icon-text-width',
    'subsection' => true,
    'fields' => array(
        array(
            'id'                => 'opt_heading_h1',
            'type'              => 'typography',
            'title'             => esc_html__('H1', 'givingwalk'),
            'subtitle'          => esc_html__('Typography option with each property can be called individually.', 'givingwalk'),
            'description'       => esc_html__('If not choose any option here, all style for h1 will applied by default theme style.', 'givingwalk'),
            'text-transform'    =>  true,
            'letter-spacing'    =>  true,
            'text-align'        =>  false,
            'output'            => array('h1, .h1, h1 a, .h1 a'),
            'units'             => 'px',
        ),
        array(
            'id'             =>  'opt_heading_h2',
            'type'           =>  'typography',
            'title'          =>   esc_html__('H2', 'givingwalk'),
            'subtitle'       =>  esc_html__('Typography option with each property can be called individually.', 'givingwalk'),
            'description'    =>  esc_html__('If not choose any option here, all style for h2 will applied by default theme style.', 'givingwalk'),
            'text-transform' =>  true,
            'letter-spacing' =>  true,
            'text-align'     =>  false,
            'output'         =>  array('h2, .h2, h2 a, .h2 a'),
            'units'          =>  'px',
        ),
        array(
            'id'             =>  'opt_heading_h3',
            'type'           =>  'typography',
            'title'          =>   esc_html__('H3', 'givingwalk'),
            'subtitle'       =>  esc_html__('Typography option with each property can be called individually.', 'givingwalk'),
            'description'    =>  esc_html__('If not choose any option here, all style for h3 will applied by default theme style.', 'givingwalk'),
            'text-transform' =>  true,
            'letter-spacing' =>  true,
            'text-align'     =>  false,
            'output'         =>  array('h3, .h3, h3 a, .h3 a'),
            'units'          =>  'px',
        ),
        array(
            'id'             =>  'opt_heading_h4',
            'type'           =>  'typography',
            'title'          =>   esc_html__('H4', 'givingwalk'),
            'subtitle'       =>  esc_html__('Typography option with each property can be called individually.', 'givingwalk'),
            'description'    =>  esc_html__('If not choose any option here, all style for h4 will applied by default theme style.', 'givingwalk'),
            'text-transform' =>  true,
            'letter-spacing' =>  true,
            'text-align'     =>  false,
            'output'         =>  array('h4, .h4, h4 a, .h4 a'),
            'units'          =>  'px',
        ),
        array(
            'id'             =>  'opt_heading_h5',
            'type'           =>  'typography',
            'title'          =>   esc_html__('H5', 'givingwalk'),
            'subtitle'       =>  esc_html__('Typography option with each property can be called individually.', 'givingwalk'),
            'description'    =>  esc_html__('If not choose any option here, all style for h5 will applied by default theme style.', 'givingwalk'),
            'text-transform' =>  true,
            'letter-spacing' =>  true,
            'text-align'     =>  false,
            'output'         =>  array('h5, .h5, h5 a, .h5 a'),
            'units'          =>  'px',
        ),
        array(
            'id'             =>  'opt_heading_h6',
            'type'           =>  'typography',
            'title'          =>  esc_html__('H6', 'givingwalk'),
            'subtitle'       =>  esc_html__('Typography option with each property can be called individually.', 'givingwalk'),
            'description'    =>  esc_html__('If not choose any option here, all style for h6 will applied by default theme style.', 'givingwalk'),
            'text-transform' =>  true,
            'letter-spacing' =>  true,
            'text-align'     =>  false,
            'output'         =>  array('h6, .h6, h6 a, .h6 a'),
            'units'          =>  'px',
        ),
    )
));
 
/* extra font. */
$custom_font_1 = Redux::getOption($opt_name, 'opt_extra_font_selector');
$custom_font_1 = !empty($custom_font_1) ? explode(',', $custom_font_1) : array();

$custom_font_2 = Redux::getOption($opt_name, 'opt_extra_font_selector2');
$custom_font_2 = !empty($custom_font_2) ? explode(',', $custom_font_2) : array();

Redux::setSection($opt_name, array(
    'title' => esc_html__('Extra Fonts', 'givingwalk'),
    'icon' => 'el el-fontsize',
    'subsection' => true,
    'fields' => array(
        array(
            'id'            => 'opt_extra_font',
            'type'          => 'typography',
            'title'         => esc_html__('Custom Font', 'givingwalk'),
            'google'        => true,
            'font-backup'   => true,
            'all_styles'    => true,
            'color'         => false,
            'font-style'    => false,
            'font-weight'   => false,
            'font-size'     => false,
            'line-height'   => false,
            'text-align'    => false,
            'output'        =>  $custom_font_1,
            'units'         => 'px',
            'subtitle'      => esc_html__('Choose a font for some special place.', 'givingwalk'),
            'default'       => array(
            )
        ),
        array(
            'id'        => 'opt_extra_font_selector',
            'type'      => 'textarea',
            'title'     => esc_html__('Selector', 'givingwalk'),
            'subtitle'  => esc_html__('add html tags ID or class (body,a,.class-name,#id-name)', 'givingwalk'),
            'validate'  => 'no_html',
            'default'   => '',
        ),
        array(
            'id'            => 'opt_extra_font2',
            'type'          => 'typography',
            'title'         => esc_html__('Custom Font 2', 'givingwalk'),
            'google'        => true,
            'font-backup'   => true,
            'all_styles'    => true,
            'color'         => false,
            'font-style'    => false,
            'font-weight'   => false,
            'font-size'     => false,
            'line-height'   => false,
            'text-align'    => false,
            'output'        =>  $custom_font_2,
            'units'         => 'px',
            'subtitle'      => esc_html__('Choose a font for some special place.', 'givingwalk'),
            'default'       => array(
            )
        ),
        array(
            'id'        => 'opt_extra_font_selector2',
            'type'      => 'textarea',
            'title'     => esc_html__('Selector', 'givingwalk'),
            'subtitle'  => esc_html__('add html tags ID or class (body,a,.class-name,#id-name)', 'givingwalk'),
            'validate'  => 'no_html',
            'default'   => '',
        )
    )
));
/**
 * Header 
 * @author Red Team
 * @since 1.0.0
*/
Redux::setSection($opt_name, array(
    'title' => esc_html__('Header', 'givingwalk'),
    'icon' => 'el-icon-credit-card',
    'fields' => array(
        array(
            'id'        => 'opt_header_layout',
            'title'     => esc_html__('Layouts', 'givingwalk'),
            'subtitle'  => esc_html__('select a layout for header', 'givingwalk'),
            'default'   => '1',
            'type'      => 'image_select',
            'options'   => array(
                '1'  => get_template_directory_uri().'/assets/images/header/h-1.jpg',
                '2'  => get_template_directory_uri().'/assets/images/header/h-2.jpg',
                '3'  => get_template_directory_uri().'/assets/images/header/h-3.jpg',
                '4'  => get_template_directory_uri().'/assets/images/header/h-4.jpg',
            )
        ),
        array(
            'title'     => esc_html__('Background Color', 'givingwalk'),
            'subtitle'  => esc_html__('choose Background color style.', 'givingwalk'),
            'id'        => 'opt_header_layout1_bg_color',
            'type'      => 'color_rgba',
            'default'   => array(),
            'required'  => array( 'opt_header_layout', '=', '1'),
            'output'    => array(
                'background-color' => '.red-header-layout-1 .red-header.header-default .red-header-outer'
            ),
        ),
        array(
            'title'     => esc_html__('Background Image', 'givingwalk'),
            'subtitle'  => esc_html__('choose Background image style.', 'givingwalk'),
            'id'        => 'opt_header_layout1_bg_img',
            'type'      => 'background',
            'background-color'  => false,
            'default'   => array(),
            'required'  => array( 'opt_header_layout', '=', '1'),
            'output'    => array('.red-header-layout-1 .red-header.header-default'),
        ),
  
        array(
            'title'     => esc_html__('Header Width', 'givingwalk'),
            'subtitle'  => esc_html__('Make header content full width?', 'givingwalk'),
            'id'        => 'opt_header_fullwidth',
            'type'      => 'switch',
            'default'   => false,
        ),
        $show_rev_slider,
        $show_rev_slider_list,
        $show_rev_slider_page,
        array(
            'title'    => esc_html__('Header Height', 'givingwalk'),
            'subtitle' => esc_html__('Add height for header.', 'givingwalk'),
            'id'       => 'opt_header_height',
            'type'     => 'dimensions',
            'units'    => array('px'),
            'width'    => false,
            'default'  => array(),
        ),
        array(
            'id'       => 'opt_header_menu',
            'type'     => 'select',
            'title'    => esc_html__('Header Menu', 'givingwalk'),
            'subtitle' => esc_html__('Choose the menu will show on header.', 'givingwalk'),
            'options'  => givingwalk_get_nav_menu(),
            'default'  => 'all-pages',
            'required' => array( 0 => 'opt_header_layout', 1 => '=', 2 => '1' )
        ),
         
        array(
            'title'    => esc_html__('Mega Menu', 'givingwalk'),
            'subtitle' => esc_html__('Enable mega menu', 'givingwalk'),
            'id'       => 'opt_enable_mega_menu',
            'type'     => 'switch',
            'default'  => false,
        ),
        array(
            'title'     => esc_html__('Widget for Mega menu', 'givingwalk'),
            'desc'      => esc_html__('You need manager widget in Widget Manager to get what you want to show in mega menu!', 'givingwalk'),
            'id'        => 'opt_mega_menu_wg',
            'type'      => 'slider',
            'min'       => 4,
            'max'       => 20,
            'default'   => 4,
            'display_value'     => 'label',
            'required'  => array('opt_enable_mega_menu', '=', 1)
        ),
        array(
            'title'    => esc_html__('Show Search', 'givingwalk'),
            'subtitle' => esc_html__('Show/Hide search icon', 'givingwalk'),
            'id'       => 'opt_show_header_search',
            'type'     => 'switch',
            'default'  => false,
        ),
        givingwalk_theme_options_show_cart(),
        givingwalk_theme_options_show_tool(),
        givingwalk_theme_options_show_tool_depend(),
        array(
            'title'     => esc_html__('Show Donate Button', 'givingwalk'),
            'subtitle'  => esc_html__('Show/Hide donate button', 'givingwalk'),
            'id'        => 'opt_show_header_donate',
            'type'      => 'button_set',
            'options'  => array(
                0      => esc_html__('Hide', 'givingwalk'),
                1      => esc_html__('Donate Archive Page', 'givingwalk'),
                2      => esc_html__('Internal Link', 'givingwalk'),
                3      => esc_html__('External Link', 'givingwalk'),
                4      => esc_html__('Popup modal', 'givingwalk')
            ),
            'default'   => 0,
        ),
        array(
            'title'     => esc_html__('Donate Button Link', 'givingwalk'),
            'subtitle'  => esc_html__('Choose an exiting page', 'givingwalk'),
            'id'        => 'opt_header_donate_url',
            'type'      => 'select',
            'options'   => givingwalk_list_page(),
            'required'  => array( 0 => 'opt_show_header_donate', 1 => '=', 2 => '2' )
        ),
        array(
            'title'     => esc_html__('Donate Button Link', 'givingwalk'),
            'subtitle'  => esc_html__('Enter your url', 'givingwalk'),
            'id'        => 'opt_header_donate_url2',
            'type'      => 'text',
            'placeholder'   => 'http://your-url.com',
            'required'  => array( 0 => 'opt_show_header_donate', 1 => '=', 2 => '3' )
        ),
    )
));

/* Header TOP section Option */
Redux::setSection($opt_name, array(
    'title'         => esc_html__('Header Top', 'givingwalk'),
    'heading'       => '',
    'icon'          => 'el-icon-credit-card',
    'subsection'    => true,
    'fields'        => array(
        array(
            'title'     => esc_html__('Show Header Top Section', 'givingwalk'),
            'subtitle'  => esc_html__('You need to manage widget in Widget Manager!', 'givingwalk'),
            'desc'      => esc_html__('When this option is ON, Header Top section will show on All Page!', 'givingwalk'),
            'id'        => 'opt_header_top',
            'type'      => 'switch',
            'default'   => false,
        ),
        array(
            'title'     => esc_html__('Header Width', 'givingwalk'),
            'subtitle'  => esc_html__('Make header content full width?', 'givingwalk'),
            'id'        => 'opt_header_top_fullwidth',
            'type'      => 'switch',
            'default'   => false,
            'required'  => array('opt_header_top', '=', 1)
        ),
        array(
            'title'          => esc_html__('Typography', 'givingwalk'),
            'subtitle'       => esc_html__('Choose typography style', 'givingwalk'),
            'id'             => 'opt_header_top_typo',
            'type'           => 'typography',
            'text-transform' =>  true,
            'letter-spacing' =>  true,
            'text-align'     =>  false,
            'default'        => array(),
            'output'         => '#red-header-top',
            'required'  => array('opt_header_top', '=', 1)
        ),
         
        array(
            'title'    => esc_html__('Link Color', 'givingwalk'),
            'subtitle' => esc_html__('Choose color style for \'a\' tag', 'givingwalk'),
            'id'       => 'opt_header_top_link',
            'type'     => 'link_color',
            'active'   => false,
            'default'  => array(),
            'output'   => '#red-header-top a',
            'required'  => array('opt_header_top', '=', 1)
        ),
        array(
            'title'    => esc_html__('Padding', 'givingwalk'),
            'desc'     => esc_html__('Choose space style: Top, Right, Bottom, Left', 'givingwalk'),
            'id'       => 'opt_header_top_padding',
            'type'     => 'spacing',
            'mode'     => 'padding',
            'units'    => array('px'),
            'default'  => array(),
            'output'   => '#red-header-top > div',
            'required'  => array('opt_header_top', '=', 1)
        ),
        array(
            'title'     => esc_html__('Background Color', 'givingwalk'),
            'desc'      => esc_html__('Choose background color style', 'givingwalk'),
            'id'        => 'opt_header_top_background',
            'type'      => 'color_rgba',
            'default'   => array(),
            'output'    => array(
                'background-color' => '#red-header-top'
            ),
            'required'  => array('opt_header_top', '=', 1)
        ),
    )
));
/* Logo Option */
Redux::setSection($opt_name, array(
    'title'         => esc_html__('Logo', 'givingwalk'),
    'heading'       => '',
    'icon'          => 'el-icon-picture',
    'subsection'    => true,
    'fields'        => array(
        
        array(
            'id'        => 'opt_logo_type',
            'title'     => esc_html__('Logo Type', 'givingwalk'),
            'subtitle'  => esc_html__('Choose your logo is Text or Image', 'givingwalk'),
            'default'   => '1',
            'type'      => 'select',
            'options'   => array(
                '1'     => esc_html__('Image','givingwalk'),
                '2'     => esc_html__('Text','givingwalk'),
            )
        ),
        array(
            'title'     => esc_html__('Logo Width', 'givingwalk'),
            'subtitle'  => esc_html__('Fixed width for logo!', 'givingwalk'),
            'id'        => 'opt_logo_size',
            'type'      => 'dimensions',
            'units'     => array('px'),
            'height'    => false,
            'default'   => array(),
            'output'    => '#red-header-logo',
        ),
        array(
            'title'     => esc_html__('Logo Image', 'givingwalk'),
            'subtitle'  => esc_html__('Select an image file for your logo.', 'givingwalk'),
            'id'        => 'opt_main_logo',
            'type'      => 'media',
            'url'       => true,
            'default'   => array(),
            'required'  => array( 'opt_logo_type', '=', 1), 
        ),
        
        array(
            'title'     => esc_html__('Logo Text', 'givingwalk'),
            'subtitle'  => esc_html__('Enter the text for your logo.', 'givingwalk'),
            'id'        => 'opt_main_logo_text',
            'type'      => 'text',
            'required'  => array( 'opt_logo_type', '=', 2), 
        ),
        array(
            'title'     => esc_html__('Slogan', 'givingwalk'),
            'subtitle'  => esc_html__('Enter the text for your slogan.', 'givingwalk'),
            'id'        => 'opt_main_logo_slogan',
            'type'      => 'text',
            'required'  => array( 'opt_logo_type', '=', 2), 
        ),
    )
));
/* Header Default */
Redux::setSection($opt_name, array(
    'title'         => esc_html__('Header Default', 'givingwalk'),
    'heading'       => '',
    'icon'          => 'el-icon-credit-card',
    'subsection'    => true,
    'fields'        => array(
        array(
            'title'     => esc_html__('Background Color', 'givingwalk'),
            'subtitle'  => esc_html__('choose Background color style.', 'givingwalk'),
            'id'        => 'opt_header_bg_color',
            'type'      => 'color_rgba',
            'default'   => array(),
            'output'    => array(
                'background-color' => '',
            ),
        ),
        array(
            'title'     => esc_html__('Background Image', 'givingwalk'),
            'subtitle'  => esc_html__('choose Background image style.', 'givingwalk'),
            'id'        => 'opt_header_bg',
            'type'      => 'background',
            'background-color'  => false,
            'default'   => array(),
            'output'    => array('.red-header-layout-1 .red-header.header-default .container,.red-header-layout-1 .red-header.header-default .container-fluid'),
            'required'  => array( 'opt_header_layout', '!=', '2')
        ),
        array(
            'title'     => esc_html__('Typography', 'givingwalk'),
            'subtitle'  => esc_html__('This option just applied for Menu first level', 'givingwalk'),
            'id'        => 'opt_header_typo',
            'type'      => 'typography',
            'text-transform'    => true,
            'letter-spacing'    => true,
            'line-height'       => false,
            'color'             => false,
            'text-align'        => false,
            'font-style'        => false,
            'default'           => array(),
            'output'    => array('.red-nav-extra','div.red-main-navigation.desktop-nav > ul > li > a','#red-header-logo .logo-text')
        ),
        array(
            'title'     => esc_html__('Link Color', 'givingwalk'),
            'subtitle'  => esc_html__('This option just applied for Menu first level', 'givingwalk'),
            'id'        => 'opt_header_fl_color',
            'type'      => 'link_color',
            'default'   => array(),
            'output'    => array()
        ),
        array(
            'title'             => esc_html__('Menu item space', 'givingwalk'),
            'subtitle'          => esc_html__('Number of px between menu item', 'givingwalk'),
            'id'                => 'opt_menu_item_space',
            'type'              => 'spacing',
            'mode'              => 'margin',
            'units'             => array( 'px'),
            'top'               => false,
            'right'             => true,
            'bottom'            => false,
            'left'              => true,
            'output'            => array( 'ul.main-nav > li' )
        ),
    )
));

/* Header on Top */
Redux::setSection($opt_name, array(
    'title'         => esc_html__('Header on Top', 'givingwalk'),
    'heading'       => '',
    'icon'          => 'el-icon-credit-card',
    'subsection'    => true,
    'fields'        => array(
        array(
            'title'     => esc_html__('Header on Top', 'givingwalk'),
            'subtitle'  => esc_html__('enable on top header.', 'givingwalk'),
            'id'        => 'opt_header_ontop',
            'type'      => 'switch',
            'default'   => false,
        ),
        array(
            'id'        => 'opt_header_ontop_page',
            'title'     => esc_html__('Page', 'givingwalk'),
            'type'      => 'select',
            'data'      => 'pages',
            'multi'     => 'true',
            'placeholder'   => esc_html__('Choose page you want applied Header On Top. If empty, Header On Top will applied for all page','givingwalk'),
            'required'  => array( 0 => 'opt_header_ontop', '=', 1 )
        ),
        array(
            'title'     => esc_html__('Logo Image', 'givingwalk'),
            'subtitle'  => esc_html__('Select an image file for your logo.', 'givingwalk'),
            'id'        => 'opt_header_ontop_logo',
            'type'      => 'media',
            'url'       => true,
            'default'   => array(),
            'required'  => array( 
                array( 'opt_header_ontop', '=', 1), 
                array( 'opt_logo_type', '=', 1), 
            ),
        ),
        array(
            'title'     => esc_html__('Background Color', 'givingwalk'),
            'subtitle'  => esc_html__('choose Background color style.', 'givingwalk'),
            'id'        => 'opt_header_ontop_bg_color',
            'type'      => 'color_rgba',
            'default'   => array(),
            'required'  => array( 
                array( 'opt_header_ontop', '=', 1), 
            ),
            'output'    => array(
                'background-color' => '.red-header-layout-1 .red-header.header-ontop .container > div,.red-header-layout-3 .red-header.header-ontop .red-header-outer'
            ),
        ),
        array(
            'title'     => esc_html__('Background Image', 'givingwalk'),
            'subtitle'  => esc_html__('choose Background image style.', 'givingwalk'),
            'id'        => 'opt_header_ontop_bg',
            'type'      => 'background',
            'background-color'  => false,
            'default'   => array(),
            'required'  => array( 
                array( 'opt_header_ontop', '=', 1), 
                array( 'opt_header_layout', '=', array('1','3')),
            ),
            'output'    => array('.red-header-layout-1 .red-header.header-ontop .container,.red-header-layout-3 .red-header.header-ontop'),
        ),
        array(
            'title'     => esc_html__('Typography', 'givingwalk'),
            'subtitle'  => esc_html__('This option just applied for Menu first level', 'givingwalk'),
            'id'        => 'opt_header_ontop_typo',
            'type'      => 'typography',
            'text-transform'    => true,
            'letter-spacing'    => true,
            'line-height'       => false,
            'color'             => false,
            'text-align'        => false,
            'font-style'        => false,
            'font-weight'       => false,
            'default'           => array(),
            'required'  => array( 
                array( 'opt_header_ontop', '=', 1), 
            ),
            'output'    => array('.header-ontop .red-nav-extra','.header-ontop  div.red-main-navigation.desktop-nav > ul > li > a','.header-ontop  #red-header-logo .logo-text')
        ),
        array(
            'title'     => esc_html__('Link Color', 'givingwalk'),
            'subtitle'  => esc_html__('This option just applied for Menu first level', 'givingwalk'),
            'id'        => 'opt_header_ontop_fl_color',
            'type'      => 'link_color',
            'default'   => array(),
            'required'  => array( 
                array( 'opt_header_ontop', '=', 1), 
            ),
            'output'    => array()
        ),
    )
));
/* Sticky Header */
Redux::setSection($opt_name, array(
    'title'      => esc_html__('Sticky Header', 'givingwalk'),
    'heading'    => '',
    'icon'       => 'el-icon-credit-card',
    'subsection' => true,
    'fields'     => array(
        array(
            'title'     => esc_html__('Sticky Header', 'givingwalk'),
            'subtitle'  => esc_html__('enable sticky header.', 'givingwalk'),
            'id'        => 'opt_header_sticky',
            'type'      => 'switch',
            'default'   => false,
        ),
        array(
            'title'     => esc_html__('Select Logo', 'givingwalk'),
            'subtitle'  => esc_html__('Select an image file for your logo.', 'givingwalk'),
            'id'        => 'opt_header_sticky_logo',
            'type'      => 'media',
            'url'       => true,
            'default'   => array(),
            'required'  => array( 
                array( 'opt_header_sticky', '=', true), 
                array( 'opt_logo_type', '=', 1), 
            ),
        ),
        array(
            'title'    => esc_html__('Sticky Header Height', 'givingwalk'),
            'subtitle' => esc_html__('Add height for sticky header.', 'givingwalk'),
            'id'       => 'opt_header_sticky_height',
            'type'     => 'dimensions',
            'units'    => array('px'),
            'width'    => false,
            'default'  => array(),
            'required'  => array( 
                array( 'opt_header_sticky', '=', true),
            ),
        ),
        array(
            'title'     => esc_html__('Background Color', 'givingwalk'),
            'subtitle'  => esc_html__('choose Background color style.', 'givingwalk'),
            'id'        => 'opt_header_sticky_bg_color',
            'type'      => 'color_rgba',
            'default'   => array(),
            'required'  => array( 
                array( 'opt_header_sticky', '=', true),
            ),
            'output'    => array(
                'background-color' => '#red-header.header-sticky .red-header-outer'
            ),
        ),
        array(
            'title'     => esc_html__('Background Image', 'givingwalk'),
            'subtitle'  => esc_html__('choose Background image style.', 'givingwalk'),
            'id'        => 'opt_header_sticky_bg',
            'type'      => 'background',
            'background-color'  => false,
            'default'   => array(),
            'required'  => array( 
                array( 'opt_header_sticky', '=', true),
            ),
            'output'    => array('#red-header.header-sticky'),
        ),
        array(
            'title'     => esc_html__('Typography', 'givingwalk'),
            'subtitle'  => esc_html__('This option just applied for Menu first level', 'givingwalk'),
            'id'        => 'opt_header_sticky_typo',
            'type'      => 'typography',
            'text-transform'    => true,
            'letter-spacing'    => true,
            'line-height'       => false,
            'color'             => false,
            'text-align'        => false,
            'font-style'        => false,
            'font-weight'       => false,
            'default'           => array(),
            'required'  => array( 
                array( 'opt_header_sticky', '=', 1), 
            ),
            'output'    => array('.header-sticky .red-nav-extra','.header-sticky  div.red-main-navigation:not(.mobile-nav) > ul > li > a','.header-sticky  #red-header-logo .logo-text')
        ),
        array(
            'title'     => esc_html__('Link Color', 'givingwalk'),
            'subtitle'  => esc_html__('This option just applied for Menu first level', 'givingwalk'),
            'id'        => 'opt_header_sticky_fl_color',
            'type'      => 'link_color',
            'default'   => array(),
            'required'  => array( 
                array( 'opt_header_sticky', '=', 1), 
            ),
            'output'    => array()
        ),
        array(
            'title'     => esc_html__('Mobile Sticky', 'givingwalk'),
            'subtitle'  => esc_html__('enable mobile sticky', 'givingwalk'),
            'id'        => 'opt_mobile_sticky',
            'type'      => 'switch',
            'default'   => false,
            'required'  => array( 
                array( 'opt_header_sticky', '=', 1), 
            ),
        ),
    )
));

/* Dropdown & Mobile Menu */
Redux::setSection($opt_name, array(
    'title'      => esc_html__('Dropdown & Mobile', 'givingwalk'),
    'heading'    => esc_html__('All style in this section will apply for Dropdown & Mobile Menu','givingwalk'),
    'icon'       => 'dashicons dashicons-networking',
    'subsection' => true,
    'fields'     => array(
        array(
            'title'     => esc_html__('Background', 'givingwalk'),
            'subtitle'  => esc_html__('Choose background style.', 'givingwalk'),
            'id'        => 'opt_header_dropdown_mobile_bg',
            'type'      => 'background',
            'default'   => array(),
            'output'    => array(
                '.red-main-navigation.mobile-nav',
                '.red-main-navigation .sub-menu'
            )
        ),
        array(
            'title'    => esc_html__('Mobile Header Height', 'givingwalk'),
            'subtitle' => esc_html__('Add height for mobile header.', 'givingwalk'),
            'id'       => 'opt_mobile_header_height',
            'type'     => 'dimensions',
            'units'    => array('px'),
            'width'    => false,
            'default'  => array(),
        ),
        array(
            'title'     => esc_html__('Typography', 'givingwalk'),
            'subtitle'  => esc_html__('Choose typography style.', 'givingwalk'),
            'id'        => 'opt_header_dropdown_mobile_typo',
            'type'      => 'typography',
            'text-transform'    => true,
            'letter-spacing'    => true,
            'color'             => false,
            'default'   => array(),
            'output'    => array(
                '.red-main-navigation .sub-menu',
                '.red-main-navigation.mobile-nav > ul > li > a'
            )
        ),
        array(
            'title'     => esc_html__('Link Color', 'givingwalk'),
            'subtitle'  => esc_html__('Choose color for menu in Dropdown & Mobile', 'givingwalk'),
            'id'        => 'opt_header_dropdown_mobile_color',
            'type'      => 'link_color',
            'default'   => array(),
            'output'    => array()
        ),
    )
));
/**
 * Page Title & BC
 *
 * @author Red Team
 * @since 1.0.0
 */
Redux::setSection($opt_name, array(
    'title'     => esc_html__('Page Title & BC', 'givingwalk'),
    'icon'      => 'el-icon-map-marker',
    'fields'    => array(
        array(
            'title'     => esc_html__('Enable Page title and Breadcrumb', 'givingwalk'),
            'subtitle'  => '',
            'id'        => 'opt_page_title',
            'type'      => 'switch',
            'default'   => true
        ),
        array(
            'id'        => 'opt_page_title_layout',
            'title'     => esc_html__('Layouts', 'givingwalk'),
            'subtitle'  => esc_html__('select a layout for page title', 'givingwalk'),
            'default'   => '3',
            'type'      => 'image_select',
            'options'   => array(
                '1' => get_template_directory_uri().'/assets/images/pagetitle/pt-s-1.png',
                '2' => get_template_directory_uri().'/assets/images/pagetitle/pt-s-2.png',
                '3' => get_template_directory_uri().'/assets/images/pagetitle/pt-s-3.png',
                '4' => get_template_directory_uri().'/assets/images/pagetitle/pt-s-4.png',
                '5' => get_template_directory_uri().'/assets/images/pagetitle/pt-s-5.png',
                '6' => get_template_directory_uri().'/assets/images/pagetitle/pt-s-6.png',
            ),
            'required'  => array( 
                array( 'opt_page_title', '=', 1), 
            ),
        ),
        array(
            'title'             => esc_html__('Sub title', 'givingwalk'),
            'subtitle'          => esc_html__('Enter the sub title', 'givingwalk'),
            'id'                => 'opt_sub_page_title',
            'type'              => 'text',
            'required'          => array('opt_page_title','=',1)
        ),
        array(
            'id'        => 'opt_page_title_align',
            'title'     => esc_html__('Content Align', 'givingwalk'),
            'subtitle'  => esc_html__('choose text align for page title', 'givingwalk'),
            'default'   => '',
            'type'      => 'select',
            'options'   => array(
                ''              => esc_html__('Default','givingwalk'),
                'text-left'     => esc_html__('Left','givingwalk'),
                'text-right'    => esc_html__('Right','givingwalk'),
                'text-center'   => esc_html__('Center','givingwalk'),
            ),
            'required'  => array( 
                array( 'opt_page_title', '=', 1),
            )
        ),
        array(
            'id'                => 'opt_page_title_bg',
            'type'              => 'color_rgba',
            'title'             => esc_html__( 'Background color', 'givingwalk' ),
            'output'   => array(
                'background' => '.red-page-title-wrapper:before',
            ),
            'required'          => array( 'opt_page_title', '=', 1 )
        ),
        
        array(
            'title'             => esc_html__('Background image', 'givingwalk'),
            'subtitle'          => esc_html__('Page title background image.', 'givingwalk'),
            'id'                => 'opt_page_title_background_image',
            'type'              => 'background',
            'preview'           => true,
            'background-color'  => false,
            'output'            => array( '.red-page-title-wrapper' ),
            'required'          => array( 'opt_page_title', '=', 1 )
        ),
         
        array(
            'id'        => 'opt_page_title_padding',
            'title'     => esc_html__('Padding', 'givingwalk'),
            'subtitle'  => esc_html__('Enter padding', 'givingwalk'),
            'type'      => 'spacing',
            'mode'      => 'padding',
            'units'     => array('px'),
            'default'   => array(),
            'output'    => array('#red-page-title-wrapper'),
            'required'  => array( 
                array( 'opt_page_title', '=', 1), 
            ),
        ),
        array(
            'id'        => 'opt_page_title_margin',
            'title'     => esc_html__('Margin', 'givingwalk'),
            'subtitle'  => esc_html__('Enter margin', 'givingwalk'),
            'type'      => 'spacing',
            'mode'      => 'margin',
            'units'     => array('px'),
            'default'   => array(),
            'output'    => array('#red-page-title-wrapper'),
            'required'  => array( 
                array( 'opt_page_title', '=', 1), 
            ),
        ),
    )
));

/* Page title  */
Redux::setSection($opt_name, array(
    'icon'          => 'el-icon-random',
    'title'         => esc_html__('Page title', 'givingwalk'),
    'heading'       => '',
    'subsection'    => true,
    'fields'        => array(
        array(
            'title'     => esc_html__('Typography for page title', 'givingwalk'),
            'id'        => 'opt_pagetitle_typo',
            'type'      => 'typography',
            'text-transform'    => true,
            'letter-spacing'    => true,
            'text-align'        => false,
            'default'   => array(),
            'output'    => array('.red-page-title-text,.red-page-title .red-page-title-text,.red-page-title .sub-title')
        )
    )
));

/* Breadcrumb */
Redux::setSection($opt_name, array(
    'icon'       => 'el-icon-random',
    'title'      => esc_html__('Breadcrumb', 'givingwalk'),
    'subsection' => true,
    'fields'     => array(
        array(
            'title'     => esc_html__('Typography for Breadcrumb', 'givingwalk'),
            'id'        => 'opt_breadcrumb_typo',
            'type'      => 'typography',
            'text-transform'    => true,
            'letter-spacing'    => true,
            'text-align'        => false,
            'default'   => array(),
            'output'    => array('#red-breadcrumb')
        ),
        array(
            'title'     => esc_html__('Link Color', 'givingwalk'),
            'id'        => 'opt_breadcrumb_link_color',
            'type'      => 'link_color',
            'active'    => false,
            'default'   => array(),
            'output'    => array('#red-breadcrumb a')
        ),
        array(
            'title'             => esc_html__('Events breadcrumb separator', 'givingwalk'),
            'subtitle'          => esc_html__('enter the event breadcrumb separator', 'givingwalk'),
            'id'                => 'opt_event_breadcrumb_sep',
            'type'              => 'text',
            'default'           => '&nbsp;-&nbsp;',
        ),
        
    )
));
/**
 * Main Content
 *
 * @author Red Team
 * @since 1.0.0
 */
Redux::setSection($opt_name, array(
    'title'  => esc_html__('Content', 'givingwalk'),
    'icon'   => 'el el-website',
    'fields' => array(
        array(
            'title'     => esc_html__('Background', 'givingwalk'),
            'subtitle'  => esc_html__('Choose background style', 'givingwalk'),
            'id'        => 'opt_main_bg',
            'type'      => 'background',
            'default'   => array(),
            'output'    => array('#red-main')
        ),
        array(
            'title'     => esc_html__('Padding', 'givingwalk'),
            'subtitle'  => esc_html__('Choose space for: Top, Right, Bottom, Left', 'givingwalk'),
            'id'        => 'opt_main_padding',
            'type'      => 'spacing',
            'mode'      => 'padding',
            'units'     => array('px'),
            'default'   => array(),
            'output'    => array('#red-main')
        ),
    )
));
/**
 * Content Area
 *
 * @author Red Team
 * @since 1.0.0
 */
Redux::setSection($opt_name, array(
    'title'      => esc_html__('Content Area', 'givingwalk'),
    'icon'       => 'el el-website',
    'subsection' => true,
    'fields'     => array(
        array(
            'title'     => esc_html__('Background', 'givingwalk'),
            'subtitle'  => esc_html__('Choose background style', 'givingwalk'),
            'id'        => 'opt_contentarea_bg',
            'type'      => 'background',
            'default'   => array(),
            'output'    => array('#content-area')
        ),
        array(
            'title'     => esc_html__('Padding', 'givingwalk'),
            'subtitle'  => esc_html__('Choose space for: Top, Right, Bottom, Left', 'givingwalk'),
            'id'        => 'opt_contentarea_padding',
            'type'      => 'spacing',
            'mode'      => 'padding',
            'units'     => array('px'),
            'default'   => array(),
            'output'    => array('#content-area')
        ),
    )
));
/**
 * Sidebar Area
 *
 * @author Red Team
 * @since 1.0.0
 */
Redux::setSection($opt_name, array(
    'title'      => esc_html__('Sidebar Area', 'givingwalk'),
    'icon'       => 'el el-website',
    'subsection' => true,
    'fields'     => array(
        array(
            'title'     => esc_html__('Background', 'givingwalk'),
            'subtitle'  => esc_html__('Choose background style', 'givingwalk'),
            'id'        => 'opt_sidebararea_bg',
            'type'      => 'background',
            'default'   => array(),
            'output'    => array('#sidebar-area')
        ),
        array(
            'title'     => esc_html__('Padding', 'givingwalk'),
            'subtitle'  => esc_html__('Choose space for: Top, Right, Bottom, Left', 'givingwalk'),
            'id'        => 'opt_sidebararea_padding',
            'type'      => 'spacing',
            'mode'      => 'padding',
            'units'     => array('px'),
            'default'   => array(),
            'output'    => array('#sidebar-area')
        ),
    )
));
 
/**
 * Blog Options
 *
 * @author Red Team
 * @since 1.0.0
 */
Redux::setSection($opt_name, array(
    'title'         => esc_html__('Archives Options', 'givingwalk'),
    'icon'          => 'dashicons dashicons-schedule',
    'subsection'    => true,
    'fields'        => array(
        array(
            'id'        => 'opt_archive_layout',
            'title'     => esc_html__('Archives page layout', 'givingwalk'),
            'description'  => esc_html__('This layout apply for archives page: Recent Post, Category, Tag, Author, Search result, Taxonomy, ...', 'givingwalk'),
            'type'      => 'button_set',
            'options' => array(
                'left'     => esc_html__('Left Sidebar','givingwalk'), 
                'full'     => esc_html__('No Sidebar','givingwalk'),
                'right'     => esc_html__('Right Sidebar','givingwalk'), 
            ), 
            'default'   => 'right',
        ),
        array(
            'id'        => 'opt_archive_sidebar',
            'title'     => esc_html__('Sidebar', 'givingwalk'),
            'placeholder'  => esc_html__('select a widget area for archive page', 'givingwalk'),
            'type'      => 'select',
            'data'      => 'sidebars',
            'default'   => 'sidebar-main',
            'required'  => array( 0 => 'opt_archive_layout', 1 => '!=', 2 => 'full' )
        ),
        array(
            'id'        => 'opt_archive_content_layout',
            'title'     => esc_html__('Content Layouts', 'givingwalk'),
            'subtitle'  => esc_html__('select a layout for content', 'givingwalk'),
            'type'      => 'button_set',
            'options'   => array(
                ''     =>  esc_html__('Default','givingwalk'), 
                'mask' =>  esc_html__('Mask','givingwalk'),
                'mask-masonry' =>  esc_html__('Mask Masonry','givingwalk'),
                'grid' =>  esc_html__('Grid','givingwalk'),
            ),
            'default'   => ''
        ),
        array(
            'subtitle'          => esc_html__('Post per page for mask masonry', 'givingwalk'),
            'id'                => 'mask_mansory_post_per_page',
            'type'              => 'text',
            'default'           => '',
            'title'             => esc_html__('Post per page', 'givingwalk'),
            'required'  => array( 'opt_archive_content_layout','=', 'mask-masonry' )
        ),
        array(
            'subtitle'          => esc_html__('Post per page for grid', 'givingwalk'),
            'id'                => 'grid_post_per_page',
            'type'              => 'text',
            'default'           => '',
            'title'             => esc_html__('Post per page', 'givingwalk'),
            'required'  => array( 'opt_archive_content_layout','=', 'grid' )
        ),
        array(
            'id'        => 'opt_archive_content_coloumn',
            'title'     => esc_html__('Archives Column', 'givingwalk'),
            'description'  => esc_html__('Choose columns you want to show on Archives Page', 'givingwalk'),
            'type'      => 'button_set',
            'options' => array(
                '1'     => esc_html__('One','givingwalk'), 
                '2'     => esc_html__('Two','givingwalk'),
                '3'     => esc_html__('Three','givingwalk'), 
                '4'     => esc_html__('Four','givingwalk'), 
            ), 
            'default'   => '3',
            'required'  => array( 'opt_archive_content_layout','=', 'grid' )
        ),
        array(
            'title'     => esc_html__('Show Author', 'givingwalk'),
            'subtitle'  => esc_html__('Show/Hide post author', 'givingwalk'),
            'id'        => 'opt_archive_post_author',
            'type'      => 'switch',
            'default'   => false,
        ),
        array(
            'title'     => esc_html__('Show Date', 'givingwalk'),
            'subtitle'  => esc_html__('Show/Hide post date', 'givingwalk'),
            'id'        => 'opt_archive_post_date',
            'type'      => 'switch',
            'default'   => true,
        ),
        array(
            'title'     => esc_html__('Show Category', 'givingwalk'),
            'subtitle'  => esc_html__('Show/Hide post categories', 'givingwalk'),
            'id'        => 'opt_archive_post_category',
            'type'      => 'switch',
            'default'   => false,
        ),
        
        array(
            'title'     => esc_html__('Show Comment', 'givingwalk'),
            'subtitle'  => esc_html__('Show/Hide post comment count', 'givingwalk'),
            'id'        => 'opt_archive_post_comment',
            'type'      => 'switch',
            'default'   => true,
        ),
        array(
            'title'     => esc_html__('Show Views', 'givingwalk'),
            'subtitle'  => esc_html__('Show/Hide post view count', 'givingwalk'),
            'id'        => 'opt_archive_post_view',
            'type'      => 'switch',
            'default'   => false,
        ),
        array(
            'title'     => esc_html__('Show Like', 'givingwalk'),
            'subtitle'  => esc_html__('Show/Hide post Like count', 'givingwalk'),
            'id'        => 'opt_archive_post_like',
            'type'      => 'switch',
            'default'   => false,
        ),
        array(
            'title'     => esc_html__('Show Share', 'givingwalk'),
            'subtitle'  => esc_html__('Show/Hide share to', 'givingwalk'),
            'id'        => 'opt_archive_post_share',
            'type'      => 'switch',
            'default'   => false,
        ),
        array(
            'title'     => esc_html__('Show tags', 'givingwalk'),
            'subtitle'  => esc_html__('Show/Hide post tags', 'givingwalk'),
            'id'        => 'opt_archive_archive_post_tags',
            'type'      => 'switch',
            'default'   => false,
        ),
        array(
            'title'     => esc_html__('Read More', 'givingwalk'),
            'subtitle'  => esc_html__('Show/Hide Read More button', 'givingwalk'),
            'id'        => 'opt_archive_post_readmore',
            'type'      => 'switch',
            'default'   => true,
        ),
        array(
            'subtitle'          => esc_html__('Excerpt length enter by ( number of word )', 'givingwalk'),
            'id'                => 'excerpt_length',
            'type'              => 'text',
            'default'           => 35,
            'title'             => esc_html__('Excerpt length', 'givingwalk'),
            'required'  => array( 'opt_archive_content_layout','=', '' )
        ),
    )
));


/**
 * Single Post
 *
 * @author Red Team
 * @since 1.0.0
 */
Redux::setSection($opt_name, array(
    'title'         => esc_html__('Single Post', 'givingwalk'),
    'icon'          => 'dashicons dashicons-align-left',
    'subsection'    => true,
    'fields'        => array(
        array(
            'title'     => esc_html__('Single Layout', 'givingwalk'),
            'subtitle'  => esc_html__('Choose a layout for single post page', 'givingwalk'),
            'id'        => 'opt_single_post_layout',
            'type'      => 'button_set',
            'options'   => array(
                'left'     => esc_html__('Left Sidebar','givingwalk'),
                'full'     => esc_html__('No Sidebar','givingwalk'),
                'right'     => esc_html__('Right Sidebar','givingwalk'),
            ),
            'default'   => 'right',
        ),
        array(
            'id'        => 'opt_single_post_sidebar',
            'title'     => esc_html__('Sidebar', 'givingwalk'),
            'placeholder'  => esc_html__('select a widget area for single post page', 'givingwalk'),
            'type'      => 'select',
            'data'      => 'sidebars',
            'default'   => 'sidebar-main',
            'required'  => array( 0 => 'opt_single_post_layout', 1 => '!=', 2 => 'full' )
        ),
        array(
            'title'     => esc_html__('Show Date', 'givingwalk'),
            'subtitle'  => esc_html__('Show/Hide post date', 'givingwalk'),
            'id'        => 'opt_single_post_date',
            'type'      => 'switch',
            'default'   => true,
        ),
        array(
            'title'     => esc_html__('Show Author', 'givingwalk'),
            'subtitle'  => esc_html__('Show/Hide post author', 'givingwalk'),
            'id'        => 'opt_single_post_author',
            'type'      => 'switch',
            'default'   => true,
        ),
        array(
            'title'     => esc_html__('Show Category', 'givingwalk'),
            'subtitle'  => esc_html__('Show/Hide post categories', 'givingwalk'),
            'id'        => 'opt_single_post_category',
            'type'      => 'switch',
            'default'   => true,
        ),
        array(
            'title'     => esc_html__('Show tags', 'givingwalk'),
            'subtitle'  => esc_html__('Show/Hide post tags', 'givingwalk'),
            'id'        => 'opt_single_post_tags',
            'type'      => 'switch',
            'default'   => false,
        ),
        array(
            'title'     => esc_html__('Show Comment', 'givingwalk'),
            'subtitle'  => esc_html__('Show/Hide post comment count', 'givingwalk'),
            'id'        => 'opt_single_post_comment',
            'type'      => 'switch',
            'default'   => true,
        ),
        array(
            'title'     => esc_html__('Show Views', 'givingwalk'),
            'subtitle'  => esc_html__('Show/Hide post view count', 'givingwalk'),
            'id'        => 'opt_single_post_view',
            'type'      => 'switch',
            'default'   => false,
        ),
        array(
            'title'     => esc_html__('Show Like', 'givingwalk'),
            'subtitle'  => esc_html__('Show/Hide post Like count', 'givingwalk'),
            'id'        => 'opt_single_post_like',
            'type'      => 'switch',
            'default'   => false,
        ),
        array(
            'title'     => esc_html__('Show share', 'givingwalk'),
            'subtitle'  => esc_html__('Show/Hide icon to social site, like: facebook, twitter, google plus and linkedin', 'givingwalk'),
            'id'        => 'opt_single_post_share',
            'type'      => 'switch',
            'default'   => false,
        ),

        array(
            'title'     => esc_html__('Show about author', 'givingwalk'),
            'subtitle'  => esc_html__('Show/Hide author information', 'givingwalk'),
            'id'        => 'opt_single_post_author_info',
            'type'      => 'switch',
            'default'   => false,
        ),
        
        array(
            'title'     => esc_html__('Show Next / Preview Post', 'givingwalk'),
            'subtitle'  => esc_html__('Show/Hide Next / Preview link to other post', 'givingwalk'),
            'id'        => 'opt_single_post_nav',
            'type'      => 'switch',
            'default'   => true,
        ),

        array(
            'title'     => esc_html__('Show Related Post', 'givingwalk'),
            'subtitle'  => esc_html__('Show/Hide related post. Related post using Post Tag', 'givingwalk'),
            'id'        => 'opt_single_post_related',
            'type'      => 'switch',
            'default'   => false,
        ),
        array(
            'title'     => esc_html__('Show Comment List & Form', 'givingwalk'),
            'subtitle'  => esc_html__('Show/Hide post commented list & Comment Form', 'givingwalk'),
            'id'        => 'opt_single_post_comment_list_form',
            'type'      => 'switch',
            'default'   => true,
        ),
    )
));

/**
 * Events option
 *
 * @author Red Team
 * @since 1.0.0
 */
Redux::setSection($opt_name, array(
    'title'         => esc_html__('Events Options', 'givingwalk'),
    'icon'          => 'dashicons dashicons-align-left',
    'subsection'    => true,
    'fields'        => array(
        array(
            'title'     => esc_html__('Layout', 'givingwalk'),
            'subtitle'  => esc_html__('Choose a layout for events', 'givingwalk'),
            'id'        => 'opt_events_layout',
            'type'      => 'button_set',
            'options'   => array(
                ''     => esc_html__('Default','givingwalk'),
                '1'     => esc_html__('layout 1','givingwalk'),
                '2'     => esc_html__('layout 2','givingwalk'),
            ),
            'default'   => '',
        ),
    )
));
/**
 * Single events
 *
 * @author Red Team
 * @since 1.0.0
 */
Redux::setSection($opt_name, array(
    'title'         => esc_html__('Single Events', 'givingwalk'),
    'icon'          => 'dashicons dashicons-align-left',
    'subsection'    => true,
    'fields'        => array(
        array(
            'title'     => esc_html__('Show share', 'givingwalk'),
            'subtitle'  => esc_html__('Show/Hide icon to social site, like: facebook, twitter, google plus and linkedin', 'givingwalk'),
            'id'        => 'opt_single_events_share',
            'type'      => 'switch',
            'default'   => false,
        ),
        array(
            'title'     => esc_html__('Get involved section', 'givingwalk'),
            'subtitle'  => esc_html__('Show/Hide get involved section', 'givingwalk'),
            'id'        => 'opt_single_events_get_involved',
            'type'      => 'switch',
            'default'   => true,
        ),
        array(
            'title'     => esc_html__('Icon Image', 'givingwalk'),
            'subtitle'  => esc_html__('Select an image file for get involved section icon.', 'givingwalk'),
            'id'        => 'opt_single_event_get_involved_icon_img',
            'type'      => 'media',
            'url'       => true,
            'default'   => array(),
            'required'  => array( 'opt_single_events_get_involved', '=', 1), 
        ),
        array(
            'subtitle' => esc_html__('Enter the title', 'givingwalk'),
            'id' => 'opt_single_event_get_involved_title',
            'type' => 'textarea',
            'title' => esc_html__('Title', 'givingwalk'),
            'default' => esc_html__('Nobody Can Do Everything, Everyone Can Do Something', 'givingwalk'),
            'required'  => array( 'opt_single_events_get_involved', '=', 1), 
        ),
    )
));
/**
 * Stories option
 *
 * @author Red Team
 * @since 1.0.0
 */
Redux::setSection($opt_name, array(
    'title'         => esc_html__('Stories option', 'givingwalk'),
    'icon'          => 'dashicons dashicons-align-left',
    'subsection'    => true,
    'fields'        => array(
        array(
            'id'        => 'opt_archive_stories_coloumn',
            'title'     => esc_html__('Column', 'givingwalk'),
            'description'  => esc_html__('Choose columns you want to show on Stories archives page', 'givingwalk'),
            'type'      => 'button_set',
            'options' => array(
                '1'     => esc_html__('One','givingwalk'), 
                '2'     => esc_html__('Two','givingwalk'),
                '3'     => esc_html__('Three','givingwalk'), 
            ), 
            'default'   => '2',
        ),
        array(
            'subtitle'          => esc_html__('Number of stories per page', 'givingwalk'),
            'id'                => 'stories_per_page',
            'type'              => 'text',
            'default'           => '',
            'title'             => esc_html__('Stories per page', 'givingwalk'),
        ),
        array(
            'title'     => esc_html__('Show share', 'givingwalk'),
            'subtitle'  => esc_html__('Show/Hide icon to social site, like: facebook, twitter, google plus and linkedin', 'givingwalk'),
            'id'        => 'opt_stories_share',
            'type'      => 'switch',
            'default'   => false,
        ),
    )
));
/**
 * Single stories
 *
 * @author Red Team
 * @since 1.0.0
 */
Redux::setSection($opt_name, array(
    'title'         => esc_html__('Single Stories', 'givingwalk'),
    'icon'          => 'dashicons dashicons-align-left',
    'subsection'    => true,
    'fields'        => array(
        array(
            'title'     => esc_html__('Single Layout', 'givingwalk'),
            'subtitle'  => esc_html__('Choose a layout for single post page', 'givingwalk'),
            'id'        => 'opt_single_stories_layout',
            'type'      => 'button_set',
            'options'   => array(
                'left'     => esc_html__('Left Sidebar','givingwalk'),
                'full'     => esc_html__('No Sidebar','givingwalk'),
                'right'     => esc_html__('Right Sidebar','givingwalk'),
            ),
            'default'   => 'full',
        ),
        array(
            'id'        => 'opt_single_stories_sidebar',
            'title'     => esc_html__('Sidebar', 'givingwalk'),
            'placeholder'  => esc_html__('select a widget area for single post page', 'givingwalk'),
            'type'      => 'select',
            'data'      => 'sidebars',
            'default'   => 'sidebar-main',
            'required'  => array( 0 => 'opt_single_stories_layout', 1 => '!=', 2 => 'full' )
        ),
        array(
            'title'     => esc_html__('Show share', 'givingwalk'),
            'subtitle'  => esc_html__('Show/Hide icon to social site, like: facebook, twitter, google plus and linkedin', 'givingwalk'),
            'id'        => 'opt_single_stories_share',
            'type'      => 'switch',
            'default'   => false,
        ),
    )
));

/**
 * Causes option
 *
 * @author Red Team
 * @since 1.0.0
 */
Redux::setSection($opt_name, array(
    'title'         => esc_html__('Causes option', 'givingwalk'),
    'icon'          => 'dashicons dashicons-align-left',
    'subsection'    => true,
    'fields'        => array(
        array(
            'title'     => esc_html__('Layout', 'givingwalk'),
            'subtitle'  => esc_html__('Choose a layout for Causes', 'givingwalk'),
            'id'        => 'opt_causes_layout',
            'type'      => 'button_set',
            'options'   => array(
                'causes-1'     => esc_html__('layout 1','givingwalk'),
                'causes-2'     => esc_html__('layout 2','givingwalk'),
            ),
            'default'   => 'causes-1',
        ),
        array(
            'id'        => 'opt_archive_causes_coloumn',
            'title'     => esc_html__('Column', 'givingwalk'),
            'description'  => esc_html__('Choose columns you want to show on Causes archives page', 'givingwalk'),
            'type'      => 'button_set',
            'options' => array(
                '1'     => esc_html__('One','givingwalk'), 
                '2'     => esc_html__('Two','givingwalk'),
                '3'     => esc_html__('Three','givingwalk'), 
            ), 
            'default'   => '3',
        ),
        array(
            'subtitle'          => esc_html__('Number of causes per page', 'givingwalk'),
            'id'                => 'causes_per_page',
            'type'              => 'text',
            'default'           => '',
            'title'             => esc_html__('Causes per page', 'givingwalk'),
        ),
        array(
            'id'        => 'opt_donate_causes_default',
            'title'     => esc_html__('Donate causes default', 'givingwalk'),
            'description'  => esc_html__('Choose one of causes for default donation', 'givingwalk'),
            'default'   => givingwalk_get_first_causes_default(),
            'type'      => 'select',
            'options'   => givingwalk_get_list_causes()
        ),

    )
));
/**
 * Single stories
 *
 * @author Red Team
 * @since 1.0.0
 */
Redux::setSection($opt_name, array(
    'title'         => esc_html__('Single Causes', 'givingwalk'),
    'icon'          => 'dashicons dashicons-align-left',
    'subsection'    => true,
    'fields'        => array(
        array(
            'title'     => esc_html__('Single Layout', 'givingwalk'),
            'subtitle'  => esc_html__('Choose a layout for single post page', 'givingwalk'),
            'id'        => 'opt_single_causes_layout',
            'type'      => 'button_set',
            'options'   => array(
                'left'     => esc_html__('Left Sidebar','givingwalk'),
                'full'     => esc_html__('No Sidebar','givingwalk'),
                'right'     => esc_html__('Right Sidebar','givingwalk'),
            ),
            'default'   => 'right',
        ),
        array(
            'id'        => 'opt_single_causes_sidebar',
            'title'     => esc_html__('Sidebar', 'givingwalk'),
            'placeholder'  => esc_html__('select a widget area for single post page', 'givingwalk'),
            'type'      => 'select',
            'data'      => 'sidebars',
            'default'   => 'sidebar-main',
            'required'  => array( 0 => 'opt_single_causes_layout', 1 => '!=', 2 => 'full' )
        ),
        array(
            'title'     => esc_html__('Show share', 'givingwalk'),
            'subtitle'  => esc_html__('Show/Hide icon to social site, like: facebook, twitter, google plus and linkedin', 'givingwalk'),
            'id'        => 'opt_single_causes_share',
            'type'      => 'switch',
            'default'   => false,
        ),
        array(
            'title'     => esc_html__('Show recent donars', 'givingwalk'),
            'subtitle'  => esc_html__('Show/Hide recent donars section', 'givingwalk'),
            'id'        => 'opt_single_causes_recent_donars',
            'type'      => 'switch',
            'default'   => true,
        ),
    )
));

/**
 * Shop option
 * 
 * extra css for customer.
 * @author Fox
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Woocommerces', 'givingwalk'),
    'icon' => 'el el-shopping-cart',
    'fields' => array(
        array(
            'id'        => 'opt_woo_loop_layout',
            'title'     => esc_html__('Shop catalog layout', 'givingwalk'),
            'description'  => esc_html__('Select a layout for catalog shop page.', 'givingwalk'),
            'type'      => 'button_set',
            'options' => array(
                'left'     => esc_html__('Left Sidebar','givingwalk'), 
                'full'     => esc_html__('No Sidebar','givingwalk'),
                'right'     => esc_html__('Right Sidebar','givingwalk'), 
            ), 
            'default'   => 'full',
        ),
        array(
            'id' => 'opt_shop_columns',
            'title' => esc_html__('Products Columns', 'givingwalk'),
            'subtitle' => esc_html__('Select catalog product column', 'givingwalk'),
            'type' => 'select',
            'options'=>array(
                '1'=> esc_html__('1 Columns','givingwalk'),
                '2'=> esc_html__('2 Columns','givingwalk'),
                '3'=> esc_html__('3 Columns','givingwalk'),
            ),
            'default' => '3',
            'required'          => array( 'opt_woo_loop_layout', '=', array('left','right') )
        ),
        array(
            'subtitle' => esc_html__('Select catalog product column', 'givingwalk'),
            'id' => 'opt_shop_columns_full',
            'type' => 'select',
            'title' => esc_html__('Products Columns', 'givingwalk'),
            'options'=>array(
                '1'=> esc_html__('1 Columns','givingwalk'),
                '2'=> esc_html__('2 Columns','givingwalk'),
                '3'=> esc_html__('3 Columns','givingwalk'),
                '4'=> esc_html__('4 Columns','givingwalk'),
            ),
            'default' => '4',
            'required'          => array( 'opt_woo_loop_layout', '=', 'full' )
        ),
        array(
            'subtitle' => esc_html__('Enter the number of products you want to show on catalog layout', 'givingwalk'),
            'id' => 'opt_shop_products',
            'type' => 'text',
            'title' => esc_html__('Number Product Per Page', 'givingwalk'),
            'default' => '8',
        ),
        array(
            'title'     => esc_html__('Disable result count and ordering', 'givingwalk'),
            'id'        => 'opt_disable_result_count_ordering',
            'type'      => 'switch',
            'default'   => true
        ),
        array(
            'id'        => 'opt_woo_single_layout',
            'title'     => esc_html__('Product single layout', 'givingwalk'),
            'description'  => esc_html__('Select a layout for single product page.', 'givingwalk'),
            'type'      => 'button_set',
            'options' => array(
                'left'     => esc_html__('Left Sidebar','givingwalk'), 
                'full'     => esc_html__('No Sidebar','givingwalk'),
                'right'     => esc_html__('Right Sidebar','givingwalk'), 
            ), 
            'default'   => 'full',
        ),
        array(
            'title'     => esc_html__('Disable Product related', 'givingwalk'),
            'id'        => 'opt_disable_product_related',
            'type'      => 'switch',
            'default'   => true
        ),
        array(
            'title'             => esc_html__('Product related number item display', 'givingwalk'),
            'subtitle'          => esc_html__('Enter the number of product related', 'givingwalk'),
            'id'                => 'opt_product_related_number',
            'type'              => 'text',
            'default'           => '4',
            'required'          => array( 'opt_disable_product_related', '!=', true )
        )
    )
));

/**
 * Single Portfolio
 *
 * @author Red Team
 * @since 1.0.0
 */
givingwalk_portfolio_opt();
/**
 * Extra Options
 *
 * Add some extra config for button, social media, ...
 * @author Red Team
 * @since 1.0.0
 */
Redux::setSection($opt_name, array(
    'title'         => esc_html__('Extra Options', 'givingwalk'),
    'heading'       => '',
    'icon'          => 'dashicons dashicons-plus-alt',
    'fields'        => array(
    )
));

/* Default */
Redux::setSection($opt_name, array(
    'title'         => esc_html__('Default Button', 'givingwalk'),
    'heading'       => esc_html__('Choose style for Default Button', 'givingwalk'),
    'icon'          => 'dashicons dashicons-editor-bold',
    'subsection'    => true,
    'fields'        => array(
        array(
            'title'     => esc_html__('Typography', 'givingwalk'),
            'subtitle'  => esc_html__('all style for: font-family, font-size, ...', 'givingwalk'),
            'id'        => 'opt_btn_default_typo',
            'type'      => 'typography',
            'text-transform'    => true,
            'letter-spacing'    => true,
            'color'             => false,
            'text-align'        => false,
            'line-height'       => false,
            'default'   => array(),
            'output'    => array('')
        ),
        array(
            'title'     => esc_html__('Text Color', 'givingwalk'),
            'subtitle'  => esc_html__('choose style for color text of button', 'givingwalk'),
            'id'        => 'opt_btn_default_color',
            'type'      => 'link_color',
            'active'    => false,
            'default'   => array(),
        ),
        array(
            'title'    => esc_html__('Border', 'givingwalk'),
            'subtitle' => esc_html__('Choose border style for default button', 'givingwalk'),
            'id'       => 'opt_btn_default_border',
            'type'     => 'border',
            'all'      => false,
            'default'  => array()
        ),
        array(
            'title'    => esc_html__('Border hover', 'givingwalk'),
            'subtitle' => esc_html__('Choose border hover style for default button', 'givingwalk'),
            'id'       => 'opt_btn_default_border_hover',
            'type'     => 'border',
            'all'      => false,
            'default'  => array()
        ),
        array(
            'title'    => esc_html__('Border Radius', 'givingwalk'),
            'subtitle'     => esc_html__('This option will apply for button radius', 'givingwalk'),
            'id'       => 'opt_btn_default_border_radius',
            'type'     => 'dimensions',
            'height'   => false,
            'units'    => array('px','%'),
            'default'  => array(),
        ),
        array(
            'title'     => esc_html__('Background', 'givingwalk'),
            'subtitle'  => esc_html__('background style default', 'givingwalk'),
            'id'        => 'opt_btn_default_bg',
            'type'      => 'background',
            'default'   => array(),
            'output'    => array()
        ),
        array(
            'title'     => '',
            'subtitle'  => esc_html__('background style on mouse over', 'givingwalk'),
            'id'        => 'opt_btn_default_bg_hover',
            'type'      => 'background',
            'default'   => array(),
            'output'    => array()
        ),
    )
));
/* Primary */
Redux::setSection($opt_name, array(
    'title'         => esc_html__('Primary Button', 'givingwalk'),
    'heading'       => esc_html__('Choose style for Primary Button', 'givingwalk'),
    'icon'          => 'dashicons dashicons-editor-bold',
    'subsection'    => true,
    'fields'        => array(
        array(
            'title'     => esc_html__('Typography', 'givingwalk'),
            'subtitle'  => esc_html__('all style for: font-family, font-size, ...', 'givingwalk'),
            'id'        => 'opt_btn_primary_typo',
            'type'      => 'typography',
            'text-transform'    => true,
            'letter-spacing'    => true,
            'color'             => false,
            'text-align'        => false,
            'default'   => array(),
            'output'    => array('')
        ),
        array(
            'title'     => esc_html__('Text Color', 'givingwalk'),
            'subtitle'  => esc_html__('choose style for color text of button', 'givingwalk'),
            'id'        => 'opt_btn_primary_color',
            'type'      => 'link_color',
            'active'    => false,
            'default'   => array(),
            'output'    => array()
        ),
        array(
            'title'    => esc_html__('Border', 'givingwalk'),
            'subtitle' => esc_html__('Choose border style for primary button', 'givingwalk'),
            'id'       => 'opt_btn_primary_border',
            'type'     => 'border',
            'all'      => false,
            'output'   => array(),
            'default'  => array()
        ),
        array(
            'title'    => esc_html__('Border Radius', 'givingwalk'),
            'subtitle'     => esc_html__('This option will apply for button radius: Top, Right, Bottom, Left', 'givingwalk'),
            'id'       => 'opt_btn_primary_border_radius',
            'type'     => 'dimensions',
            'height'   => false,
            'units'    => array('px'),
            'default'  => array(),
        ),
        array(
            'title'     => esc_html__('Background', 'givingwalk'),
            'subtitle'  => esc_html__('background style default', 'givingwalk'),
            'id'        => 'opt_btn_primary_bg',
            'type'      => 'background',
            'default'   => array(),
            'output'    => array('')
        ),
        array(
            'title'     => '',
            'subtitle'  => esc_html__('background style on mouse over', 'givingwalk'),
            'id'        => 'opt_btn_primary_bg_hover',
            'type'      => 'background',
            'default'   => array(),
            'output'    => array('')
        ),
    )
));

/* Form Field */
Redux::setSection($opt_name, array(
    'title'         => esc_html__('Form Field', 'givingwalk'),
    'heading'       => esc_html__('Choose style for form field', 'givingwalk'),
    'icon'          => 'dashicons dashicons-editor-bold',
    'subsection'    => true,
    'fields'        => array(
        
        array(
            'title'     => esc_html__('Color', 'givingwalk'),
            'subtitle'  => esc_html__('choose style for color text', 'givingwalk'),
            'id'        => 'opt_form_field_color',
            'type'      => 'color',
        ),
        array(
            'title'     => esc_html__('Background', 'givingwalk'),
            'subtitle'  => esc_html__('choose style for background', 'givingwalk'),
            'id'        => 'opt_form_field_bg',
            'type'      => 'color',
        ),
        array(
            'title'     => esc_html__('Border color', 'givingwalk'),
            'subtitle'  => esc_html__('choose style border color', 'givingwalk'),
            'id'        => 'opt_form_border_color',
            'type'      => 'color',
        ),
        array(
            'title'     => esc_html__('Placeholder', 'givingwalk'),
            'subtitle'  => esc_html__('choose style for placeholder', 'givingwalk'),
            'id'        => 'opt_placeholder_color',
            'type'      => 'color',
        ),
    )
));

/* Social Media  */
Redux::setSection($opt_name, array(
    'title'         => esc_html__('Social Link', 'givingwalk'),
    'heading'       => '',
    'icon'          => 'dashicons dashicons-share',
    'subsection'    => true,
    'fields'        => array(
        array(
            'title'     => esc_html__('Show in Header top', 'givingwalk'),
            'subtitle'  => esc_html__('Show all social link in Header Top section', 'givingwalk'),
            'id'        => 'opt_social_header_top',
            'type'      => 'switch',
            'default'   => false,
            'required'  => array( 
                array( 'opt_header_top', '=', 1),
            ),
        ),
        array(
            'title'     => esc_html__('Show in Header', 'givingwalk'),
            'subtitle'  => esc_html__('Show all social link in Header section (beside the Main Navigation) ', 'givingwalk'),
            'id'        => 'opt_social_in_header',
            'type'      => 'switch',
            'default'   => false,
        ),
        array(
            'id'         =>'opt_social_list',
            'type'       => 'multi_text',
            'show_empty' => false,
            'title'      => esc_html__('Add your social network', 'givingwalk'),
            'validate'   => 'url',
            'subtitle'   => esc_html__('If you enter an invalid url it will be removed. Try using the http://your-link.com or https://your-link.com)', 'givingwalk'),
            'desc'       => sprintf( '%s<br />%s', esc_html__('Click ADD MORE button to add more your social network site!','givingwalk'), esc_html__('IMPORTANT: if you want to add skype chat button, please use: htttp://skype.your-skype-name, ex: http://skype.chinhjm, replace \'chinhjm\' with your skype name', 'givingwalk'))
        ),
    )
));
/* 404 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('404', 'givingwalk'),
    'icon' => 'el el-icon-credit-card',
    'fields' => array(
        array(
            'title'             => esc_html__('Background image', 'givingwalk'),
            'subtitle'          => esc_html__('Footer wrap background image', 'givingwalk'),
            'id'                => 'opt_404_background_image',
            'type'              => 'background',
            'background-color'  => false,
            'default'  => array(
                'background-image' => get_template_directory_uri().'/assets/images/bg-404.jpg'
            ),
            'output'            => array( '.wrap-404' ),
        ),
    )
));
/* Client logo */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Client logo', 'givingwalk'),
    'icon' => 'el el-icon-credit-card',
    'fields' => array(
        array(
            'title'     => esc_html__('Enable', 'givingwalk'),
            'subtitle'  => esc_html__('Show / hide client logo', 'givingwalk'),
            'id'        => 'opt_client_logo_enable',
            'type'      => 'switch',
            'default'   => false
        ),
        array(
            'title' => esc_html__('Layout', 'givingwalk'),
            'subtitle' => esc_html__('Choose client logo layout', 'givingwalk'),
            'id' => 'opt_client_logo_layout',
            'type'      => 'image_select',
            'options'   => array(
                'layout1' => get_template_directory_uri() . '/assets/images/client-logo/client-logo-1.jpg',
                'layout2' => get_template_directory_uri() . '/assets/images/client-logo/client-logo-2.jpg',
                'layout3' => get_template_directory_uri() . '/assets/images/client-logo/client-logo-3.jpg',
            ),
            'default'   => 'layout1',
            'required'          => array('opt_client_logo_enable','=',1)
        ),
        array(
            'id' => 'opt_client_logo_white',
            'type' => 'gallery',
            'title' => esc_html__('Client logo', 'givingwalk'),
            'subtitle' => esc_html__('Upload client logo', 'givingwalk'),
            'required'          => array('opt_client_logo_layout','=',array('layout1','layout2'))
        ),
        array(
            'id' => 'opt_client_logo_dark',
            'type' => 'gallery',
            'title' => esc_html__('Client logo', 'givingwalk'),
            'subtitle' => esc_html__('Upload client logo', 'givingwalk'),
            'required'          => array('opt_client_logo_layout','=','layout3')
        ), 
        array(
            'subtitle'   => esc_html__('Enter sequentially according to the above image and and separated by commas', 'givingwalk'),
            'id'         => 'opt_client_logo_link',
            'type'       => 'textarea',
            'title'      => esc_html__('Client logo link', 'givingwalk'),
            'default'    => '',
            'required'          => array('opt_client_logo_enable','=',1)
        ),
        array(
            'id'                => 'opt_client_logo_background_color',
            'type'              => 'color_rgba',
            'title'             => esc_html__( 'Background color', 'givingwalk' ),
            'required'          => array('opt_client_logo_layout','=',array('layout1','layout2'))
        ),
        array(
            'id'                => 'opt_client_logo_dark_background_color',
            'type'              => 'color_rgba',
            'title'             => esc_html__( 'Background color', 'givingwalk' ),
            'output'   => array(
                'background-color' => '.red-client-logo.layout3'
            ),
            'required'          => array('opt_client_logo_layout','=','layout3')
        ),
        array(
            'title'     => esc_html__('Margin', 'givingwalk'),
            'subtitle'  => esc_html__('Enter outer spacing', 'givingwalk'),
            'id'        => 'opt_client_logo_margin',
            'type'      => 'spacing',
            'mode'      => 'margin',
            'units'      => array('px'),
            'top'               => true,
            'right'             => false,
            'bottom'            => true,
            'left'              => false,
            'default'   => array(
                'margin-top'  =>  ''
            ),
            'output'    => array('.red-client-logo,.red-client-logo.layout1') ,
            'required'          => array('opt_client_logo_enable','=',1)
        ),
    )
));
/**
 * Footer
 *
 * @author Red Team
 * @since 1.0.0
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Footer', 'givingwalk'),
    'icon' => 'el el-icon-credit-card',
    'fields' => array(
        array(
            'id'                => 'opt_footer_background_color',
            'type'              => 'color_rgba',
            'title'             => esc_html__( 'Background color', 'givingwalk' ),
            'output'   => array(
                'background-color' => '.red-footer .red-footer-wrap'
            ),
        ),
        array(
            'title'             => esc_html__('Background image', 'givingwalk'),
            'subtitle'          => esc_html__('Footer wrap background image', 'givingwalk'),
            'id'                => 'opt_footer_background_image',
            'type'              => 'background',
            'background-color'  => false,
            'output'            => array( '.red-footer' ),
        ),
        array(
            'title'     => esc_html__('Border', 'givingwalk'),
            'subtitle'  => esc_html__('Choose border style', 'givingwalk'),
            'id'        => 'opt_footer_border',
            'type'      => 'border',
            'all'       => 'false',
            'units'      => array('px'),
            'default'   => array(
                'border-style'  => 'none'
            ),
            'output'    => array('.red-footer') 
        ),
        array(
            'title'     => esc_html__('Margin', 'givingwalk'),
            'subtitle'  => esc_html__('Enter outer spacing', 'givingwalk'),
            'id'        => 'opt_footer_margin',
            'type'      => 'spacing',
            'mode'      => 'margin',
            'units'      => array('px'),
            'default'   => array(
                'margin-top'  =>  ''
            ),
            'output'    => array('.red-footer,.red-footer.has-client-top') 
        ),
        
    )
));

Redux::setSection($opt_name, array(
    'title' => esc_html__('Footer Top', 'givingwalk'),
    'icon' => 'el el-minus',
    'subsection' => true,
    'fields' => array(
        array(
            'title'     => esc_html__('Enable', 'givingwalk'),
            'subtitle'  => esc_html__('Enable footer top', 'givingwalk'),
            'id'        => 'opt_enable_footer_top',
            'type'      => 'switch',
            'default'   => true
        ), 
        array(
            'title' => esc_html__('Layout', 'givingwalk'),
            'subtitle' => esc_html__('Choose footer top layout', 'givingwalk'),
            'id' => 'opt_footer_top_layout',
            'type'      => 'image_select',
            'options'   => array(
                'layout1' => get_template_directory_uri() . '/assets/images/footer/t-1.jpg',
                'layout2' => get_template_directory_uri() . '/assets/images/footer/t-2.jpg',
                'layout3' => get_template_directory_uri() . '/assets/images/footer/t-3.jpg',
            ),
            'default'   => 'layout1',
            'required'          => array('opt_enable_footer_top','=',1)
        ),
        array(
            'title'     => esc_html__('Columns', 'givingwalk'),
            'desc'      => esc_html__('When you choose this option, you need manager widget in Widget Manager too!', 'givingwalk'),
            'id'        => 'opt_footer_top_column_2',
            'type'      => 'slider',
            'min'       => 0,
            'max'       => 4,
            'default'   => 4,
            'display_value'     => 'label',
            'required'  => array('opt_footer_top_layout','=',array('layout2','layout3'))
        ),
        array(
            'title'             => esc_html__('Select Logo', 'givingwalk'),
            'subtitle'          => esc_html__('Select an image file for footer logo.', 'givingwalk'),
            'id'                => 'opt_footer_logo',
            'type'              => 'media',
            'url'               => false,
            'default'           => array(
                'url'=>get_template_directory_uri().'/assets/images/footer-logo1.png'
            ),
            'required'          => array('opt_enable_footer_top','=',1)
        ),
        array(
            'title'             => esc_html__('Footer top logo url', 'givingwalk'),
            'subtitle'          => esc_html__('Enter the other url, if empty then use site home url', 'givingwalk'),
            'id'                => 'opt_footer_logo_url',
            'type'              => 'text',
            'required'          => array('opt_enable_footer_top','=',1)
        ),  
        array(
            'subtitle'          => esc_html__('Set max width for logo.', 'givingwalk'),
            'id'                => 'opt_footer_logo_max_width',
            'type'              => 'dimensions',
            'units'             => array('px'),
            'height'             => false,
            'title'             => esc_html__('Footer Logo Max Width', 'givingwalk'),
            'required'          => array('opt_enable_footer_top','=',1)
        ),
        array(
            'title'     => esc_html__('Typography', 'givingwalk'),
            'id'        => 'opt_footer_top_typo',
            'type'      => 'typography',
            'text-transform'    => true,
            'letter-spacing'    => true,
            'default'   => array(),
            'output'    => array('.red-footer-top.layout1,.red-footer-top.layout1 p,.red-footer-top.layout2,.red-footer-top.layout2 p,.red-footer-top.layout3,.red-footer-top.layout3 p,.red-footer-top .footer-contact-info li,.red-footer-top.layout3 .footer-contact-info li'),
            'required'          => array('opt_enable_footer_top','=',1)
        ),
        array(
            'title'     => esc_html__('Heading Typography', 'givingwalk'),
            'id'        => 'opt_footer_top_typo_heading',
            'type'      => 'typography',
            'text-transform'    => true,
            'letter-spacing'    => true,
            'line-height'       => false,
            'default'   => array(),
            'output'    => array(
                '.red-footer-top.layout1 .wg-title',
                '.red-footer-top.layout1 .widget-title',
                '.red-footer-top.layout1 h1',
                '.red-footer-top.layout1 h2',
                '.red-footer-top.layout1 h3',
                '.red-footer-top.layout1 h4',
                '.red-footer-top.layout1 h5',
                '.red-footer-top.layout1 h6',
                '.red-footer-top.layout2 .wg-title',
                '.red-footer-top.layout2 .widget-title',
                '.red-footer-top.layout2 h1',
                '.red-footer-top.layout2 h2',
                '.red-footer-top.layout2 h3',
                '.red-footer-top.layout2 h4',
                '.red-footer-top.layout2 h5',
                '.red-footer-top.layout2 h6',
                '.red-footer-top.layout3 .wg-title',
                '.red-footer-top.layout3 .widget-title',
                '.red-footer-top.layout3 h1',
                '.red-footer-top.layout3 h2',
                '.red-footer-top.layout3 h3',
                '.red-footer-top.layout3 h4',
                '.red-footer-top.layout3 h5',
                '.red-footer-top.layout3 h6',
            ),
            'required'          => array('opt_enable_footer_top','=',1)
        ),
        array(
            'title'     => esc_html__('Link Color', 'givingwalk'),
            'id'        => 'opt_footer_top_link_color',
            'type'      => 'link_color',
            'active'    => false,
            'default'   => array(),
            'output'    => array('.red-recent-post .entry-title a,.red-footer-top .widget_nav_menu ul li a,.red-footer-top .red-social a,.red-footer-top.layout3 .red-social a'),
            'required'          => array('opt_enable_footer_top','=',1)
        ),
        array(
            'id'                => 'opt_footer_top_background_color',
            'type'              => 'color_rgba',
            'title'             => esc_html__( 'Background color', 'givingwalk' ),
            'output'   => array(
                'background-color' => '.red-footer-top.layout1 .red-footer-top-wrap,.red-footer-top.layout2 .red-footer-top-wrap,.red-footer-top.layout3 .red-footer-top-wrap'
            ),
            'required'          => array('opt_enable_footer_top','=',1)
        ),
        array(
            'title'             => esc_html__('Background image', 'givingwalk'),
            'id'                => 'opt_footer_top_background_image',
            'type'              => 'background',
            'background-color'  => false,
            'output'            => array( '.red-footer-top' ),
            'required'          => array('opt_enable_footer_top','=',1)
        ),
        array(
            'title'     => esc_html__('Padding', 'givingwalk'),
            'subtitle'  => esc_html__('Enter spacing', 'givingwalk'),
            'id'        => 'opt_footer_top_padding',
            'type'      => 'spacing',
            'mode'      => 'padding',
            'units'      => array('px'),
            'default'   => array(),
            'output'    => array('.red-footer-top.layout1 .red-footer-top-wrap,.red-footer-top.layout2 .red-footer-top-wrap,.red-footer-top.layout3 .red-footer-top-wrap'),
            'required'          => array('opt_enable_footer_top','=',1)
        ),
        array(
            'title'     => esc_html__('Margin', 'givingwalk'),
            'subtitle'  => esc_html__('Enter spacing', 'givingwalk'),
            'id'        => 'opt_footer_top_margin',
            'type'      => 'spacing',
            'mode'      => 'margin',
            'units'     => array('px'),
            'default'   => array(),
            'output'    => array('.red-footer-top.layout1,.red-footer-top.layout2,.red-footer-top.layout3'),
            'required'          => array('opt_enable_footer_top','=',1)
        ),
    )
));
Redux::setSection($opt_name, array(
    'title'      => esc_html__('Footer Bottom', 'givingwalk'),
    'icon' => 'el el-minus',
    'subsection' => true,
    'fields'     => array(
        array(
            'title'    => esc_html__('Layout', 'givingwalk'),
            'subtitle' => esc_html__('Choose layout for footer bottom', 'givingwalk'),
            'id'       => 'opt_footer_bottom_layout',
            'type'     => 'image_select',
            'options'  => array(
                'layout1'        => get_template_directory_uri() . '/assets/images/footer/b-1.jpg',
                'layout2'        => get_template_directory_uri() . '/assets/images/footer/b-2.jpg',
                'layout3'        => get_template_directory_uri() . '/assets/images/footer/b-3.jpg',
            ),
            'default'   => 'layout1',
        ),
        array(
            'title'     => esc_html__('Container full width', 'givingwalk'),
            'id'        => 'opt_footer_bottom_container_fullwidth',
            'type'      => 'switch',
            'default'   => false
        ),
        array(
            'id'                => 'opt_footer_bottom_background_color',
            'type'              => 'color_rgba',
            'title'             => esc_html__( 'Background color', 'givingwalk' ),
            'output'   => array(
                'background-color' => '.red-footer-bottom.layout1 .red-footer-bottom-wrap,.red-footer-bottom.layout2 .red-footer-bottom-wrap,.red-footer-bottom.layout3 .red-footer-bottom-wrap'
            ),
        ),
        array(
            'title'             => esc_html__('Background image', 'givingwalk'),
            'id'                => 'opt_footer_bottom_background_image',
            'type'              => 'background',
            'background-color'  => false,
            'output'            => array( '.red-footer-bottom' ),
        ),
        array(
            'subtitle'   => esc_html__('Enter your copyright text, allow html tag as a,span', 'givingwalk'),
            'id'         => 'opt_footer_bottom_copyright',
            'type'       => 'textarea',
            'title'      => esc_html__('Copyright', 'givingwalk'),
            'validate'   => 'html',
            'allow_html' => array('span', 'a'),
            'default'    => '',
        ),

        array(
            'title'     => esc_html__('Margin', 'givingwalk'),
            'subtitle'  => esc_html__('Enter spacing', 'givingwalk'),
            'id'        => 'opt_footer_bottom_margin',
            'type'      => 'spacing',
            'mode'      => 'margin',
            'units'     => array('px'),
            'default'   => array(),
            'output'    => array('.red-footer-bottom'),
        ),

        array(
            'title'     => esc_html__('Padding', 'givingwalk'),
            'subtitle'  => esc_html__('Enter spacing', 'givingwalk'),
            'id'        => 'opt_footer_bottom_padding',
            'type'      => 'spacing',
            'mode'      => 'padding',
            'units'     => array('px'),
            'default'   => array(),
            'output'    => array('.red-footer-bottom.layout1 .red-footer-bottom-wrap,.red-footer-bottom.layout2 .red-footer-bottom-wrap,.red-footer-bottom.layout3 .red-footer-bottom-wrap'),
        ),
        
        array(
            'title'     => esc_html__('Link Color', 'givingwalk'),
            'id'        => 'opt_footer_bottom_link_color',
            'type'      => 'link_color',
            'regular'   => true,
            'hover'     => true,
            'active'    => false,
            'visited'   => false,
            'default'   => array(),
            'output'    => array('.red-footer-bottom a,.red-footer-bottom.layout3 a'),
        ),

        array(
            'title'     => esc_html__('Menu Link Color', 'givingwalk'),
            'id'        => 'opt_footer_bottom_menu_link_color',
            'type'      => 'link_color',
            'regular'   => true,
            'hover'     => true,
            'active'    => false,
            'visited'   => false,
            'default'   => array(),
            'output'    => array('.red-footer-bottom.layout2 ul li a,.red-footer-bottom.layout3 ul li a'),
        ),
        array(
            'title'          => esc_html__('Typography', 'givingwalk'),
            'id'             => 'opt_footer_bottom_typo',
            'type'           => 'typography',
            'text-transform' => true,
            'letter-spacing' => true,
            'text-align'     => false,
            'default'        => array(),
            'output'         => array('.red-footer-bottom,.red-footer-bottom.layout1,.red-footer-bottom.layout2,.red-footer-bottom.layout3,.red-footer-bottom ul li a'),
        ),
         
    )
));

/**
 * Optimal Core
 * 
 * Optimal options for theme. optimal speed
 * @author Red Team
 */
Redux::setSection($opt_name, array(
    'title'  => esc_html__('Optimal Core', 'givingwalk'),
    'icon'   => 'el-icon-idea',
    'fields' => array(
        array(
            'subtitle' => esc_html__('no minimize , generate css over time...', 'givingwalk'),
            'id'       => 'opt_dev_mode',
            'type'     => 'switch',
            'title'    => esc_html__('Dev Mode (not recommended)', 'givingwalk'),
            'default'  => true
        )
    )
));