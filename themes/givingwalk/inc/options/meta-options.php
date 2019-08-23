<?php
/**
 * Meta box config file
 */
if (! class_exists('MetaFramework')) {
    return;
}

$args = array(
    // TYPICAL -> Change these values as you need/desire
    'opt_name' => apply_filters('opt_meta', 'opt_meta_options'),
    // Set a different name for your global variable other than the opt_name
    'dev_mode' => false,
    // Allow you to start the panel in an expanded way initially.
    'open_expanded' => false,
    // Disable the save warning when a user changes a field
    'disable_save_warn' => true,
    // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
    'save_defaults' => false,

    'output' => false,
    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
    'output_tag' => false,
    // Show the time the page took to load, etc
    'update_notice' => false,
    // 'disable_google_fonts_link' => true, // Disable this in case you want to create your own google fonts loader
    'admin_bar' => false,
    // Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
    'allow_sub_menu' => false,
    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
    'customizer' => false,
    // What to print by the field's title if the value shown is default. Suggested: *
    'show_import_export' => false,
    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
    'use_cdn' => false,
    // save meta to multiple keys.
    'meta_mode' => 'multiple'
);

// -> Set Option To Panel.
MetaFramework::setArgs($args);

add_action('admin_init', 'givingwalk_meta_boxs');

MetaFramework::init();

function givingwalk_meta_boxs()
{

    /** page options */
    MetaFramework::setMetabox(array(
        'id'            => '_page_main_options',
        'label'         => esc_html__('Page Setting', 'givingwalk'),
        'post_type'     => 'page',
        'context'       => 'advanced',
        'priority'      => 'high',
        'open_expanded' => false,
        'sections'      => array(
            array(
                'title'  => esc_html__('Page Options', 'givingwalk'),
                'id'     => 'tab-page-header',
                'icon'   => 'el el-credit-card',
                'fields' => array(
                    array(
                        'id'          => 'opt_page_layout',
                        'title'       => esc_html__('Page layout', 'givingwalk'),
                        'description' => esc_html__('This layout apply for page template layout', 'givingwalk'),
                        'type'        => 'button_set',
                        'options'     => array(
                            ''          => esc_html__('Default','givingwalk'), 
                            'left'      => esc_html__('Left Sidebar','givingwalk'), 
                            'full'      => esc_html__('No Sidebar','givingwalk'),
                            'right'     => esc_html__('Right Sidebar','givingwalk'), 
                        ), 
                        'default'   => '',
                    ),
                    array(
                        'id'          => 'opt_page_sidebar',
                        'title'       => esc_html__('Sidebar', 'givingwalk'),
                        'placeholder' => esc_html__('select a widget area for page', 'givingwalk'),
                        'description' => esc_html__('Leave blank  to load default sidebar from theme option', 'givingwalk'),
                        'type'        => 'select',
                        'data'        => 'sidebars',
                        'default'     => '',
                        'required'    => array( 0 => 'opt_page_layout', 1 => '=', 2 => array('left','right') )
                    ),
                    
                    array(
                        'title'    => esc_html__('Boxed Layout', 'givingwalk'),
                        'subtitle' => esc_html__('make your site is boxed?', 'givingwalk'),
                        'id'       => 'opt_body_layout',
                        'type'     => 'button_set',
                        'options'  => array(
                            -1     => esc_html__('Default', 'givingwalk'),
                            1      => esc_html__('Yes', 'givingwalk'),
                            0      => esc_html__('No', 'givingwalk')
                        ),
                        'default'  => -1
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
                        'title'     => esc_html__('Boxed Background', 'givingwalk'),
                        'subtitle'  => esc_html__('Choose background style for boxed area', 'givingwalk'),
                        'id'        => 'opt_boxed_bg',
                        'type'      => 'background',
                        'default'   => array(
                            'background-color' => '#FFFFFF'
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
                        'default'   => array(
                            'background-color' => '#F2F2F2'
                        ),
                        'required'  => array( 
                            array( 'opt_body_layout', '=', 1), 
                        ),
                    ),
                    
                    array(
                        'title'     => esc_html__('Body Padding', 'givingwalk'),
                        'subtitle'  => esc_html__('Choose padding for BODY tag', 'givingwalk'),
                        'id'        => 'opt_body_padding',
                        'type'      => 'spacing',
                        'mode'      => 'padding',
                        'units'     => array('px'),     
                        'default'   => array(),
                        'required'  => array( 
                            array( 'opt_body_layout', '=', 1), 
                        ),
                    ),
                )
            ),
            array(
                'title'  => esc_html__('Header', 'givingwalk'),
                'id'     => 'tab-page-header',
                'icon'   => 'el el-credit-card',
                'fields' => array(
                    array(
                        'id'       => 'opt_header_layout',
                        'title'    => esc_html__('Layouts', 'givingwalk'),
                        'subtitle' => esc_html__('select a layout for header', 'givingwalk'),
                        'default'  => '',
                        'type'     => 'image_select',
                        'options'  => array(
                            '' => get_template_directory_uri() . '/assets/images/header/h-default.jpg',
                            '1'  => get_template_directory_uri().'/assets/images/header/h-1.jpg',
                            '2'  => get_template_directory_uri().'/assets/images/header/h-2.jpg',
                            '3'  => get_template_directory_uri().'/assets/images/header/h-3.jpg',
                            '4'  => get_template_directory_uri().'/assets/images/header/h-4.jpg',
                        ),
                    ),
                    array(
                        'title'     => esc_html__('Header Width', 'givingwalk'),
                        'subtitle'  => esc_html__('Make header content full width?', 'givingwalk'),
                        'id'        => 'opt_header_fullwidth',
                        'type'      => 'button_set',
                        'options'   => array(
                            '-1'     => esc_html__('Default','givingwalk'),
                            '1'      => esc_html__('Yes','givingwalk'),
                            '0'      => esc_html__('No','givingwalk'),
                        ),
                        'default'   => '-1',
                    ),
                    array(
                        'title'     => esc_html__('Logo Image', 'givingwalk'),
                        'subtitle'  => esc_html__('Select an image file for logo on this page only.', 'givingwalk'),
                        'id'        => 'opt_page_logo',
                        'type'      => 'media',
                        'url'       => true,
                        'default'   => array(),
                    ),
                    array(
                        'id'       => 'opt_header_menu',
                        'type'     => 'select',
                        'title'    => esc_html__('Select Menu', 'givingwalk'),
                        'subtitle' => esc_html__('custom menu for current page', 'givingwalk'),
                        'options'  => givingwalk_get_nav_menu(),
                        'default'  => '',
                        'required' => array( 0 => 'opt_header_layout', 1 => '!=', 2 => '2' )
                    ),
                )
            ),
            array(
                'title'      => esc_html__('Header Top', 'givingwalk'),
                'id'         => 'tab-page-header-top',
                'icon'       => 'el el-minus',
                'subsection' => true,
                'fields'     => array(
                    array(
                        'id'          => 'opt_header_top',
                        'title'       => esc_html__('Header Top', 'givingwalk'),
                        'description' => esc_html__('You need to manage widget in Widget Manager!', 'givingwalk'),
                        'type'        => 'button_set',
                        'options'     => array(
                            '-1'     => esc_html__('Default','givingwalk'), 
                            '1'      => esc_html__('Show','givingwalk'), 
                            '0'      => esc_html__('Hide','givingwalk'),
                        ), 
                        'default'   => '-1',
                    ),
                )
            ),
            array(
                'title'      => esc_html__('Header Attribute', 'givingwalk'),
                'id'         => 'tab-page-header-attr',
                'icon'       => 'el el-minus',
                'subsection' => true,
                'fields'     => array(
                    givingwalk_page_options_show_search(),
                    givingwalk_page_options_show_cart(),
                    givingwalk_page_options_show_tool(),
                    givingwalk_theme_options_show_tool_depend(),
                    array(
                        'title'       => esc_html__('Show Donate Button', 'givingwalk'),
                        'subtitle'    => esc_html__('Show/Hide donate button on this page?', 'givingwalk'),
                        'id'          => 'opt_show_header_donate',
                        'type'        => 'button_set',
                        'options'   => array(
                            -1    => esc_html__('Default','givingwalk'),
                            0     => esc_html__('Hide','givingwalk'),
                            1     => esc_html__('Donate Archive Page', 'givingwalk'),
                            2     => esc_html__('Internal Link','givingwalk'),
                            3     => esc_html__('External Link','givingwalk'),
                            4      => esc_html__('Popup modal', 'givingwalk')
                        ),
                        'default'   => '-1',
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
                    givingwalk_page_options_show_social(),
                )
            ),
            array(
                'title'  => esc_html__('Page Title & BC', 'givingwalk'),
                'id'     => 'tab-page-title-bc',
                'icon'   => 'el el-credit-card',
                'fields' => array(
                    array(
                        'id'       => 'opt_page_title_layout',
                        'title'    => esc_html__('Layouts', 'givingwalk'),
                        'subtitle' => esc_html__('select a layout for page title', 'givingwalk'),
                        'default'  => '',
                        'type'     => 'image_select',
                        'options'  => array(
                            ''     => get_template_directory_uri() . '/assets/images/pagetitle/pt-s-default.png',
                            'none' => get_template_directory_uri() . '/assets/images/pagetitle/pt-s-0.png',
                            '1'    => get_template_directory_uri() . '/assets/images/pagetitle/pt-s-1.png',
                            '2'    => get_template_directory_uri() . '/assets/images/pagetitle/pt-s-2.png',
                            '3'    => get_template_directory_uri() . '/assets/images/pagetitle/pt-s-3.png',
                            '4'    => get_template_directory_uri() . '/assets/images/pagetitle/pt-s-4.png',
                            '5'    => get_template_directory_uri() . '/assets/images/pagetitle/pt-s-5.png',
                            '6'    => get_template_directory_uri() . '/assets/images/pagetitle/pt-s-6.png',
                        ), 
                    ),
                    array(
                        'id' => 'opt_page_title_text',
                        'type' => 'text',
                        'title' => esc_html__('Custom Title', 'givingwalk'),
                        'subtitle' => esc_html__('Custom current page title.', 'givingwalk'),
                        'required'  => array( 
                            array('opt_page_title_layout', '!=', 'none' ),
                        )
                    ),
                    array(
                        'id' => 'opt_page_title_subtext',
                        'type' => 'text',
                        'title' => esc_html__('Custom SubTitle', 'givingwalk'),
                        'subtitle' => esc_html__('Custom current page subtitle.', 'givingwalk'),
                        'required'  => array( 
                            array('opt_page_title_layout', '!=', 'none' ),
                        )
                    ),
                    array(
                        'id'        => 'opt_page_title_bg',
                        'type'      => 'background',
                        'title'     => esc_html__('Custom Background', 'givingwalk'),
                        'subtitle'  => esc_html__('Custom current page title background.', 'givingwalk'),
                        'default'   => '',
                        'required'  => array( 
                            array('opt_page_title_layout', '!=', '' ),
                            array('opt_page_title_layout', '!=', 'none' ),
                        )
                    ),
                    array(
                        'id'        => 'opt_page_title_bg_overlay',
                        'title'     => esc_html__('Overlay Background', 'givingwalk'),
                        'subtitle'  => esc_html__('Choose overlay background color', 'givingwalk'),
                        'type'      => 'color_rgba',
                        'default'   => array(),
                        'required'  => array( 
                            array('opt_page_title_layout', '!=', '' ),
                            array('opt_page_title_layout', '!=', 'none' ), 
                        ),
                    ),
                    array(
                        'id'        => 'opt_page_title_padding',
                        'title'     => esc_html__('Padding', 'givingwalk'),
                        'subtitle'  => esc_html__('Choose a space', 'givingwalk'),
                        'type'      => 'spacing',
                        'mode'      => 'padding',
                        'units'     => array('px'),
                        'required'  => array( 
                            array('opt_page_title_layout', '!=', '' ),
                            array('opt_page_title_layout', '!=', 'none' ),  
                        ),
                        'default'   => array(),
                    ),
                    array(
                        'id'        => 'opt_page_title_margin',
                        'title'     => esc_html__('Margin', 'givingwalk'),
                        'subtitle'  => esc_html__('Choose a space', 'givingwalk'),
                        'type'      => 'spacing',
                        'mode'      => 'margin',
                        'units'     => array('px'),
                        'required'  => array( 
                            array('opt_page_title_layout', '!=', '' ),
                            array('opt_page_title_layout', '!=', 'none' ), 
                        ),
                        'default'   => array(),
                    ),
                )
            ),
            array(
                'title'      => esc_html__('Client logo', 'givingwalk'),
                'id'         => 'tab-page-client-logo',
                'icon'      => 'el el-credit-card',
                'fields'     => array(
                    array(
                        'title'    => esc_html__('Custom', 'givingwalk'),
                        'subtitle' => esc_html__('Set default to make it as theme option', 'givingwalk'),
                        'id'       => 'opt_client_logo_custom',
                        'type'     => 'button_set',
                        'options'  => array(
                            -1     => esc_html__('Default', 'givingwalk'),
                            1      => esc_html__('Custom (enable)', 'givingwalk'),
                            0      => esc_html__('Disable', 'givingwalk')
                        ),
                        'default'  => -1
                    ),
                    array(
                        'title' => esc_html__('Layout', 'givingwalk'),
                        'subtitle' => esc_html__('Choose client logo layout', 'givingwalk'),
                        'id' => 'opt_client_logo_layout',
                        'type'      => 'image_select',
                        'options'   => array(
                            '' => get_template_directory_uri() . '/assets/images/client-logo/client-logo-default.jpg',
                            'layout1' => get_template_directory_uri() . '/assets/images/client-logo/client-logo-1.jpg',
                            'layout2' => get_template_directory_uri() . '/assets/images/client-logo/client-logo-2.jpg',
                            'layout3' => get_template_directory_uri() . '/assets/images/client-logo/client-logo-3.jpg',
                        ),
                        'default'   => '',
                        'required'          => array('opt_client_logo_custom','=',1)
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
                        'required'          => array('opt_client_logo_custom','=',1)
                    ),
                )
            ),
            array(
                'title'     => esc_html__('Footer', 'givingwalk'),
                'heading'   => '',
                'id'        => 'tab-footer',
                'icon'      => 'el el-credit-card',
                'fields'    => array(
                    array(
                        'id'                => 'opt_footer_background_color',
                        'type'              => 'color_rgba',
                        'title'             => esc_html__( 'Background color', 'givingwalk' ),
                        'output'   => array(
                            'background-color' => '.red-footer:before'
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
                        'title'             => esc_html__('Margin', 'givingwalk'),
                        'subtitle'          => esc_html__('Custom footer outer space', 'givingwalk'),
                        'id'                => 'opt_page_footer_margin',
                        'type'              => 'spacing',
                        'mode'              => 'margin',
                        'units'             => array('px'),
                        'default'           => array(),
                    ),

                )
            ),
            
            array(
                'title'      => esc_html__('Footer Top', 'givingwalk'),
                'id'         => 'tab-page-footer-top',
                'icon'       => 'el el-minus',
                'subsection' => true,
                'fields'     => array(
                    array(
                        'title'    => esc_html__('Custom', 'givingwalk'),
                        'subtitle' => esc_html__('Set default to make it as theme option', 'givingwalk'),
                        'id'       => 'opt_footer_top_custom',
                        'type'     => 'button_set',
                        'options'  => array(
                            -1     => esc_html__('Default', 'givingwalk'),
                            1      => esc_html__('Custom (enable)', 'givingwalk'),
                            0      => esc_html__('Disable', 'givingwalk')
                        ),
                        'default'  => -1
                    ),
                    array(
                        'title' => esc_html__('Layout', 'givingwalk'),
                        'subtitle' => esc_html__('Choose footer top layout', 'givingwalk'),
                        'id' => 'opt_footer_top_layout',
                        'type'      => 'image_select',
                        'options'   => array(
                            '' => get_template_directory_uri() . '/assets/images/footer/t-default.jpg',
                            'layout1' => get_template_directory_uri() . '/assets/images/footer/t-1.jpg',
                            'layout2' => get_template_directory_uri() . '/assets/images/footer/t-2.jpg',
                            'layout3' => get_template_directory_uri() . '/assets/images/footer/t-3.jpg',
                        ),
                        'default'   => '',
                        'required'          => array('opt_footer_top_custom','=',1)
                    ),
                    array(
                        'title'             => esc_html__('Logo Image', 'givingwalk'),
                        'subtitle'          => esc_html__('Select an image file for footer logo.', 'givingwalk'),
                        'id'                => 'opt_footer_logo',
                        'type'              => 'media',
                        'url'               => true,
                        'default'           => array(
                            'url'=>''
                        ),
                        'required'          => array('opt_footer_top_custom','=',1)
                    ),
                     
                    array(
                        'title'             => esc_html__('Footer top logo url', 'givingwalk'),
                        'subtitle'          => esc_html__('Enter the other url, if empty then use site home url', 'givingwalk'),
                        'id'                => 'opt_footer_logo_url',
                        'type'              => 'text',
                        'required'          => array('opt_footer_top_custom','=',1)
                    ),
                )
            ),
            array(
                'title'      => esc_html__('Footer Bottom', 'givingwalk'),
                'id'         => 'tab-page-footer-bottom',
                'icon'       => 'el el-minus',
                'subsection' => true,
                'fields'     => array(
                    array(
                        'title'     => esc_html__('Enable', 'givingwalk'),
                        'subtitle'  => esc_html__('Enable footer bottom', 'givingwalk'),
                        'id'        => 'opt_enable_footer_bottom',
                        'type'      => 'switch',
                        'default'   => true
                    ), 
                    array(
                        'title'    => esc_html__('Layout', 'givingwalk'),
                        'subtitle' => esc_html__('Choose layout for where you want to show copyright text and Social link', 'givingwalk'),
                        'id'       => 'opt_footer_bottom_layout',
                        'type'     => 'image_select',
                        'options'  => array(
                            ''         => get_template_directory_uri() . '/assets/images/footer/b-default.jpg',
                            'layout1'        => get_template_directory_uri() . '/assets/images/footer/b-1.jpg',
                            'layout2'        => get_template_directory_uri() . '/assets/images/footer/b-2.jpg',
                            'layout3'        => get_template_directory_uri() . '/assets/images/footer/b-3.jpg',
                        ),
                        'default'   => '',
                        'required'          => array('opt_enable_footer_bottom','=',1)
                    ),
                )
            ),
        )
    ));

    /** post options */
    MetaFramework::setMetabox(array(
        'id'            => '_page_post_format_options',
        'label'         => esc_html__('Post Format', 'givingwalk'),
        'post_type'     => 'post',
        'context'       => 'advanced',
        'priority'      => 'default',
        'open_expanded' => true,
        'sections'      => array(
            array(
                'title'  => '',
                'id'     => 'opt_post_format', 
                'icon'   => 'el el-laptop',
                'fields' => array(
                    array(
                        'id'       => 'opt_format_video_type',
                        'type'     => 'select',
                        'title'    => esc_html__('Select Video Type', 'givingwalk'),
                        'subtitle' => esc_html__('Local video or video-sharing website like: Youtube, Video, Daily Motion, ...', 'givingwalk'),
                        'options'  => array(
                            'local'    => esc_html__('Upload', 'givingwalk'),
                            'embed'    => esc_html__('Embed Video', 'givingwalk'),
                        ),
                        'default'      => 'embed'
                    ),
                    array(
                        'id'             => 'opt_format_video_local',
                        'type'           => 'media',
                        'library_filter' =>array('mp4','m4v','mov','wmv','avi','mpg','ogv','3gp','3g2'),
                        'title'          => esc_html__('Local Video', 'givingwalk'),
                        'subtitle'       => esc_html__('Upload video media using the WordPress native uploader', 'givingwalk'),
                        'required'       => array('opt_format_video_type', '=', 'local')
                    ),
                    array(
                        'id'             => 'opt_format_video_local_thumb',
                        'type'           => 'media',
                        'library_filter' =>array('jpeg', 'jpg', 'png','gif','ico'),
                        'title'          => esc_html__('Video Thumb', 'givingwalk'),
                        'subtitle'       => esc_html__('Upload thumb media using the WordPress native uploader', 'givingwalk'),
                        'required'       => array('opt_format_video_type', '=', 'local')
                    ),
                    array(
                        'id'          => 'opt_format_embed_video',
                        'type'        => 'text',
                        'title'       => esc_html__('Embed Video', 'givingwalk'),
                        'subtitle'    => esc_html__('Load video from video-sharing website like: Youtube, Vimeo, Daily Motion,... Ex: https://www.youtube.com/watch?v=lMJXxhRFO1k&t=2s', 'givingwalk'),
                        'description' => sprintf('%s <a href="%s" target="_blank">%s</a>', esc_html__('What Sites Can You Embed From? please look at:', 'givingwalk'), esc_url('https://codex.wordpress.org/Embeds'), esc_html__('WordPress Embeds','givingwalk')),
                        'placeholder' => esc_html__('ex: https://www.youtube.com/watch?v=lMJXxhRFO1k&t=2s', 'givingwalk'),
                        'required'    => array('opt_format_video_type', '=', 'embed')
                    ),
                    array(
                        'id'       => 'opt_format_audio_type',
                        'type'     => 'select',
                        'title'    => esc_html__('Select Audio Type', 'givingwalk'),
                        'subtitle' => esc_html__('Local audio or audio-sharing website like: SoundCloud,...', 'givingwalk'),
                        'options'  => array(
                            'local'    => esc_html__('Upload', 'givingwalk'),
                            'embed'    => esc_html__('Embed Audio', 'givingwalk'),
                        ),
                        'default'      => 'embed'
                    ),
                    array(
                        'id'             => 'opt_format_audio',
                        'type'           => 'media',
                        'library_filter' =>array('mp3','m4a','ogg','wav'),
                        'title'          => esc_html__('Audio Media', 'givingwalk'),
                        'subtitle'       => esc_html__('Upload audio media using the WordPress native uploader', 'givingwalk'),
                        'required'       => array('opt_format_audio_type', '=', 'local')
                    ),
                    array(
                        'id'          => 'opt_format_embed_audio',
                        'type'        => 'text',
                        'title'       => esc_html__('Embed Audio', 'givingwalk'),
                        'subtitle'    => esc_html__('Load audio from audio-sharing website like: SoundCloud,... Ex: https://soundcloud.com/wavey-hefner/lil-pump-gucci-gang-prod-bighead-gnealz', 'givingwalk'),
                        'description' => sprintf('%s <a href="%s" target="_blank">%s</a>', esc_html__('What Sites Can You Embed From? please look at:', 'givingwalk'), esc_url('https://codex.wordpress.org/Embeds'), esc_html__('WordPress Embeds','givingwalk')),
                        'placeholder' => esc_html__('ex: https://soundcloud.com/wavey-hefner/lil-pump-gucci-gang-prod-bighead-gnealz', 'givingwalk'),
                        'required'    => array('opt_format_audio_type', '=', 'embed')
                    ),
                    array(
                        'id'             => 'opt_format_gallery',
                        'type'           => 'gallery',
                        'library_filter' =>array('jpeg', 'jpg', 'png','gif','ico'),
                        'title'          => esc_html__('Add/Edit Gallery', 'givingwalk'),
                        'subtitle'       => esc_html__('Create a new Gallery by selecting existing or uploading new images using the WordPress native uploader', 'givingwalk'),
                    ),
                    array(
                        'id'       => 'opt_format_quote_title',
                        'type'     => 'text',
                        'title'    => esc_html__('Quote Title', 'givingwalk'),
                    ),
                    array(
                        'id'    => 'opt_format_quote_content',
                        'type'  => 'textarea',
                        'title' => esc_html__('Quote Content', 'givingwalk'),
                    ),
                    array(
                        'id'       => 'opt_format_link_text',
                        'type'     => 'text',
                        'placeholder' => 'Google',
                        'title'    => esc_html__('Your Text', 'givingwalk'),
                    ),
                    array(
                        'id'          => 'opt_format_link_url',
                        'type'        => 'text',
                        'placeholder' => 'http://google.com',
                        'title'       => esc_html__('Your Link', 'givingwalk'),
                    ),
                )
            ),
        )
    ));
    /** PORTFOLIO options */
    MetaFramework::setMetabox(array(
        'id'            => '_page_portfolio_options',
        'label'         => esc_html__('Portfolio Details', 'givingwalk'),
        'post_type'     => 'redportfolio',
        'context'       => 'advanced',
        'priority'      => 'default',
        'open_expanded' => false,
        'sections'      => array(
                array(
                    'title'   => esc_html__('General', 'givingwalk'),
                    'heading' => '',
                    'id'      => 'portfolio_subtitle',
                    'icon'    => 'el el-font',
                    'fields'  => array(
                        array(
                            'id'       => 'opt_portfolio_subtitle',
                            'type'     => 'text',
                            'title'    => esc_html__( 'Add subtitle', 'givingwalk' ),
                            'subtitle'    => esc_html__( 'Add your subtitle', 'givingwalk' ),
                        ),
                        array(
                            'title'     => esc_html__('Single Layout', 'givingwalk'),
                            'subtitle'  => esc_html__('Choose default layout for single Portfolio page', 'givingwalk'),
                            'id'        => 'opt_portfolio_layout',
                            'type'      => 'button_set',
                            'options'   => array(
                                ''      => esc_html__('Default','givingwalk'),
                            ),
                            'default'   => '',
                        ),
                    )
                ),
                array(
                    'title'   => esc_html__('Gallery', 'givingwalk'),
                    'heading' => '',
                    'id'      => 'portfolio_gallery',
                    'icon'    => 'el el-picture',
                    'fields'  => array(
                        array(
                            'id'       => 'opt_portfolio_gallery',
                            'type'     => 'gallery',
                            'title'    => esc_html__( 'Add/Edit Gallery', 'givingwalk' ),
                            'subtitle' => esc_html__( 'Create a new Gallery by selecting existing or uploading new images using the WordPress native uploader', 'givingwalk' ),
                        ),
                        array(
                            'title'     => esc_html__('Gallery Layout', 'givingwalk'),
                            'subtitle'  => esc_html__('Choose a gallery layout for single Portfolio page', 'givingwalk'),
                            'id'        => 'opt_portfolio_gallery_layout',
                            'type'      => 'button_set',
                            'options'   => array(
                                ''     => esc_html__('Default','givingwalk'),
                            ),
                            'default'   => '',
                            'required'    => array( 0 => 'opt_portfolio_gallery', 1 => '!=', 2 => '')
                        ),
                    )
                ),
                array(
                    'title'   => esc_html__('Additional Infomations', 'givingwalk'),
                    'heading' => '',
                    'id'      => 'portfolio_additional',
                    'icon'    => 'el el-info-circle',
                    'fields'  => array(
                        array(
                            'id'       => 'opt_portfolio_client',
                            'type'     => 'text',
                            'placeholder'   => esc_html__('A&J Co.','givingwalk'),
                            'title'    => esc_html__( 'Clients', 'givingwalk' ),
                            'subtitle' => esc_html__( 'Enter client name', 'givingwalk' ),
                        ),
                        array(
                            'id'       => 'opt_portfolio_date',
                            'type'     => 'date',
                            'placeholder'   => esc_html__('Click to enter a date','givingwalk'),
                            'title'    => esc_html__( 'Date', 'givingwalk' ),
                            'subtitle' => esc_html__( 'Enter Date', 'givingwalk' ),
                        ),
                        array(
                            'id'       => 'opt_portfolio_url',
                            'type'     => 'text',
                            'placeholder'   => 'http://your-client-site.com',
                            'title'    => esc_html__( 'Client Site', 'givingwalk' ),
                            'subtitle' => esc_html__( 'Enter client site', 'givingwalk' ),
                        ),
                        array(
                            'id'       => 'opt_portfolio_recent',
                            'title'    => esc_html__( 'Recent Project', 'givingwalk' ),
                            'subtitle' => esc_html__( 'Show/Hide recent project', 'givingwalk' ),
                            'type'      => 'button_set',
                            'options'   => array(
                                'none'      => esc_html__('Default','givingwalk'),
                                '1'     => esc_html__('Yes','givingwalk'),
                                '0'     => esc_html__('No','givingwalk'),
                            ),
                            'default'   => 'none',
                        ),
                    )
                ),
            ),
        )
    );
}