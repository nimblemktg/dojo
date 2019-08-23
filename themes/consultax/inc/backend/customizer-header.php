<?php
function header_customize_settings() {
	/**
	 * Customizer configuration
	 */

	$settings = array(
		'theme' => 'consultax',
	);

	$panels = array(	
	    'header'        => array(
			'title'      => esc_html__( 'Header', 'consultax' ),
			'priority'   => 9,
			'capability' => 'edit_theme_options',
		),
	);

	$sections = array(
        'main_header'           => array(
            'title'       => esc_html__( 'General', 'consultax' ),
            'description' => '',
            'priority'    =>15,
            'capability'  => 'edit_theme_options',
            'panel'       => 'header',
        ),
		'topbar_header'           => array(
			'title'       => esc_html__( 'Top Bar', 'consultax' ),
			'description' => '',
			'priority'    => 16,
			'capability'  => 'edit_theme_options',
			'panel'       => 'header',
		),
        'logo_header'           => array(
            'title'       => esc_html__( 'Logo', 'consultax' ),
            'description' => '',
            'priority'    =>17,
            'capability'  => 'edit_theme_options',
            'panel'       => 'header',
        ),
        'menu_header'           => array(
            'title'       => esc_html__( 'Menu', 'consultax' ),
            'description' => '',
            'priority'    =>18,
            'capability'  => 'edit_theme_options',
            'panel'       => 'header',
        ),
	    'header_styling'           => array(
			'title'       => esc_html__( 'Styling', 'consultax' ),
			'description' => '',
			'priority'    =>19,
			'capability'  => 'edit_theme_options',
			'panel'       => 'header',
		),
		'header_mobile_styling'  => array(
			'title'       => esc_html__( 'Mobile Styling', 'consultax' ),
			'description' => '',
			'priority'    =>20,
			'capability'  => 'edit_theme_options',
			'panel'       => 'header',
		),
		'preload_section'     => array(
			'title'       => esc_attr__( 'Preloader', 'consultax' ),
			'description' => '',
			'priority'    => 15,
			'capability'  => 'edit_theme_options',
		),
	);

	$fields = array(		

		// Topbar Header
		'topbar_switch'     => array(
			'type'        => 'toggle',
			'label'       => esc_attr__( 'Top Bar On/Off?', 'consultax' ),
			'section'     => 'topbar_header',
			'default'     => 1,
			'priority'    => 1,
		),

		// Header Contact Info
		'topbar_switch'     => array(
			'type'        => 'toggle',
			'label'       => esc_attr__( 'Top Bar On/Off?', 'consultax' ),
			'section'     => 'topbar_header',
			'default'     => 1,
			'priority'    => 1,
		),
		'info_separator'     => array(
			'type'        => 'custom',
			'label'       => '',
			'section'     => 'topbar_header',
			'default'     => '<hr>',
			'priority'    => 2,
		),
		'info_switch'     => array(
			'type'        => 'toggle',
			'label'       => esc_attr__( 'Contact Info On/Off?', 'consultax' ),
			'section'     => 'topbar_header',
			'default'     => 1,
			'priority'    => 3,
		),
		'header_contact_info'     => array(
			'type'     => 'repeater',
			'label'    => esc_html__( 'Contact Info', 'consultax' ),
			'section'  => 'topbar_header',
			'priority' => 4,
			'active_callback' => array(
				array(
					'setting'  => 'info_switch',
					'operator' => '==',
					'value'    => 1,
				),
			),
			'row_label' => array(
				'type' => 'field',
				'value' => esc_attr__('Contact Info', 'consultax' ),
				'field' => 'info_name',
			),
			'default'  => array(),
			'fields'   => array(
				'info_name' => array(
					'type'        => 'text',
					'label'       => esc_html__( 'Contact info name', 'consultax' ),
					'description' => esc_html__( 'This will be the contact info name', 'consultax' ),
					'default'     => '',
				),
				'info_icon' => array(
					'type'        => 'text',
					'label'       => esc_html__( 'Icon class name', 'consultax' ),
					'description' => esc_html__( 'This will be the contact info icon: https://fontawesome.com/v4.7.0/icons/#brand , ex: phone', 'consultax' ),
					'default'     => '',
				),
				'info_content' => array(
					'type'        => 'textarea',
					'label'       => esc_html__( 'Contact info content', 'consultax' ),
					'description' => esc_html__( 'This will be the contact info content', 'consultax' ),
					'default'     => '',
				),				
			),
		),

		// Header Social
		'social_separator'     => array(
			'type'        => 'custom',
			'label'       => '',
			'section'     => 'topbar_header',
			'default'     => '<hr>',
			'priority'    => 5,
		),
		'social_switch'     => array(
			'type'        => 'toggle',
			'label'       => esc_attr__( 'Social Network On/Off?', 'consultax' ),
			'section'     => 'topbar_header',
			'default'     => 1,
			'priority'    => 6,
		),
		'header_socials'     => array(
			'type'     => 'repeater',
			'label'    => esc_html__( 'Socials Network', 'consultax' ),
			'section'  => 'topbar_header',
			'priority' => 7,
			'active_callback' => array(
				array(
					'setting'  => 'social_switch',
					'operator' => '==',
					'value'    => 1,
				),
			),
			'row_label' => array(
				'type' => 'field',
				'value' => esc_attr__('social', 'consultax' ),
				'field' => 'social_name',
			),
			'default'  => array(),
			'fields'   => array(
				'social_name' => array(
					'type'        => 'text',
					'label'       => esc_html__( 'Social network name', 'consultax' ),
					'description' => esc_html__( 'This will be the social network name', 'consultax' ),
					'default'     => '',
				),
				'social_icon' => array(
					'type'        => 'text',
					'label'       => esc_html__( 'Icon class name', 'consultax' ),
					'description' => esc_html__( 'This will be the social icon: https://fontawesome.com/v4.7.0/icons/#brand , ex: facebook', 'consultax' ),
					'default'     => '',
				),
				'social_link' => array(
					'type'        => 'text',
					'label'       => esc_html__( 'Link url', 'consultax' ),
					'description' => esc_html__( 'This will be the social link', 'consultax' ),
					'default'     => '',
				),
			),
		),
		'social_target_link'    => array(
			'type'        => 'select',
			'label'       => esc_attr__( 'HTML a target Attribute for Socials.', 'consultax' ),
			'section'     => 'topbar_header',
			'default'     => '_self',
			'priority'    => 8,
			'multiple'    => 1,
			'active_callback' => array(
				array(
					'setting'  => 'social_switch',
					'operator' => '==',
					'value'    => 1,
				),
			),
			'choices'     => array(
				'_self' => esc_attr__( 'Same Frame', 'consultax' ),
				'_blank' => esc_attr__( 'New Window', 'consultax' ),
			),
		),

		// Main Header
        'header_layout'    => array(
            'type'        => 'radio-image',
            'label'       => esc_attr__( 'Header Layout', 'consultax' ),
            'section'     => 'main_header',
            'default'     => 'header1',
            'priority'    => 1,
            'multiple'    => 1,
            'choices'     => array(
                'header1' => get_template_directory_uri() . '/inc/backend/images/header1.png',
                'header2' => get_template_directory_uri() . '/inc/backend/images/header2.png',
				'header3' => get_template_directory_uri() . '/inc/backend/images/header3.png',
                'header4' => get_template_directory_uri() . '/inc/backend/images/header4.png',
            ),
        ),
        'home_header_transperant_switch'     => array(
			'type'        => 'toggle',
			'label'       => esc_attr__( 'Home Header Transparent On/Off?', 'consultax' ),
			'section'     => 'main_header',
			'default'     => 0,
			'priority'    => 2,
		),
        'header_desktop_sticky'        => array(
            'type'     => 'toggle',
            'label'    => esc_html__( 'Sticky Header On Desktop', 'consultax' ),
            'section'  => 'main_header',
            'default'  => '1',
            'priority' => 3,
        ),
        'header_mobile_sticky' => array(
            'type'     => 'toggle',
            'label'    => esc_html__( 'Sticky Header On Mobile', 'consultax' ),
            'section'  => 'main_header',
            'default'  => '0',
            'priority' => 4,
        ),        
        'search_switch'     => array(
            'type'        => 'toggle',
            'label'       => esc_attr__( 'Search Button On/Off?', 'consultax' ),
            'section'     => 'main_header',
            'default'     => 1,
            'priority'    => 5,
        ),      
        'separator_ctahead'     => array(
            'type'        => 'custom',
            'label'       => '',
            'section'     => 'main_header',
            'default'     => '<hr>',
            'priority'    => 6,
        ),  
        'topbar_text_header'    => array(
            'type'     => 'textarea',
            'label'    => esc_html__( 'Topbar text on right side.', 'consultax' ),
            'section'  => 'main_header',
            'default'  => '',
            'priority' => 7,            
            'active_callback' => array(
				array(
					'setting'  => 'header_layout',
					'operator' => '==',
					'value'    => 'header1'
				),
			),
        ),
        'header_cta_switch'     => array(
            'type'        => 'toggle',
            'label'       => esc_attr__( 'Call To Action Button On/Off?', 'consultax' ),
            'section'     => 'main_header',
            'default'     => 1,
            'priority'    => 8,
            'active_callback' => array(
				array(
					'setting'  => 'header_layout',
					'operator' => '!==',
					'value'    => 'header1',
				),
				array(
					'setting'  => 'header_layout',
					'operator' => '!==',
					'value'    => 'header3',
				),
			),
        ),  
        'cta_text_header'    => array(
            'type'     => 'textarea',
            'label'    => esc_html__( 'CTA Button Text', 'consultax' ),
            'section'  => 'main_header',
            'default'  => '',
            'priority' => 9,            
            'active_callback' => array(
				array(
					'setting'  => 'header_cta_switch',
					'operator' => '==',
					'value'    => 1,
				),
				array(
					'setting'  => 'header_layout',
					'operator' => '!==',
					'value'    => 'header1',
				),
				array(
					'setting'  => 'header_layout',
					'operator' => '!==',
					'value'    => 'header3',
				),
			),
        ),
        'cta_link_header'    => array(
            'type'     => 'text',
            'label'    => esc_html__( 'CTA Button Link', 'consultax' ),
            'section'  => 'main_header',
            'default'  => '',
            'priority' => 10,            
            'active_callback' => array(
				array(
					'setting'  => 'header_cta_switch',
					'operator' => '==',
					'value'    => 1,
				),
				array(
					'setting'  => 'header_layout',
					'operator' => '!==',
					'value'    => 'header1',
				),
				array(
					'setting'  => 'header_layout',
					'operator' => '!==',
					'value'    => 'header3',
				),
			),
        ),
        'cta_bgcolor_header'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'CTA Button Background Color', 'consultax' ),
            'section'  => 'main_header',
            'default'  => '',
            'priority' => 11,
            'output'    => array(
                array(
                    'element'  => '.btn-cta-header a, .btn-cta-header a:visited',
                    'property' => 'background'
                ),
            ),
            'active_callback' => array(
				array(
					'setting'  => 'header_cta_switch',
					'operator' => '==',
					'value'    => 1,
				),
				array(
					'setting'  => 'header_layout',
					'operator' => '!==',
					'value'    => 'header1',
				),
				array(
					'setting'  => 'header_layout',
					'operator' => '!==',
					'value'    => 'header3',
				),
			),
        ),
        'cta_textcolor_header'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'CTA Button Text Color', 'consultax' ),
            'section'  => 'main_header',
            'default'  => '',
            'priority' => 12,
            'output'    => array(
                array(
                    'element'  => '.btn-cta-header a',
                    'property' => 'color'
                ),
            ),
            'active_callback' => array(
				array(
					'setting'  => 'header_cta_switch',
					'operator' => '==',
					'value'    => 1,
				),
				array(
					'setting'  => 'header_layout',
					'operator' => '!==',
					'value'    => 'header1',
				),
				array(
					'setting'  => 'header_layout',
					'operator' => '!==',
					'value'    => 'header3',
				),
			),
        ),

		//Logo Setting
		'logo'         => array(
			'type'     => 'image',
			'label'    => esc_attr__( 'Upload Your Static Logo Image on Header Static (.jpg, .png, .svg)', 'consultax' ),
			'section'  => 'logo_header',
			'default'  => trailingslashit( get_template_directory_uri() ) . 'images/logo-blue.png',
			'priority' => 3,
		),
		'logo_scroll'         => array(
			'type'     => 'image',
			'label'    => esc_attr__( 'Upload Your Logo Image on Header Scroll (.jpg, .png, .svg)', 'consultax' ),
			'section'  => 'logo_header',
			'default'  => trailingslashit( get_template_directory_uri() ) . 'images/logo-blue.png',
			'priority' => 3,
		),
        'logo_width'     => array(
            'type'     => 'number',
            'label'    => esc_html__( 'Logo Width(px)', 'consultax' ),
            'section'  => 'logo_header',
            'priority' => 4,
            'default'  => '',
            'output'    => array(
                array(
                    'element'  => '#site-logo a img',
                    'property' => 'width',
                    'units'	   => 'px'
                ),
            ),
        ),
        'logo_height'    => array(
            'type'     => 'number',
            'label'    => esc_html__( 'Logo Height(px)', 'consultax' ),
            'section'  => 'logo_header',
            'priority' => 5,
            'default'  => '',
            'output'    => array(
                array(
                    'element'  => '#site-logo a img',
                    'property' => 'height',
                    'units'	   => 'px'
                ),
            ),
        ),
        'logo_spacing'  => array(
            'type'     => 'dimensions',
            'label'    => esc_html__( 'Logo Margin (ex: 10px)', 'consultax' ),
            'section'  => 'logo_header',
            'priority' => 6,
            'default'  => array(
                'top'    => '0',
                'bottom' => '0',
                'left'   => '0',
                'right'  => '0',
            ),
            'output'    => array(
                array(
                    'element'  => '#site-logo',
                    'property' => 'padding',
                    'units'	   => 'px'
                ),
            ),
        ),

        //Header Styling        
        'separator_tophead'     => array(
            'type'        => 'custom',
            'label'       => '',
            'section'     => 'header_styling',
            'default'     => '<hr>',
            'priority'    => 8,
        ),
        'bg_topbar'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Top Bar Background Color', 'consultax' ),
            'section'  => 'header_styling',
            'default'  => '',
            'priority' => 9,
            'output'    => array(
                array(
                    'element'  => '.header-style-1 .header-topbar, .header-style-4 .header-topbar',
                    'property' => 'background'
                ),
            ),
        ),
        'border_topbar'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Top Bar Border Color', 'consultax' ),
            'section'  => 'header_styling',
            'default'  => '',
            'priority' => 10,
            'output'    => array(
                array(
                    'element'  => '.header-topbar',
                    'property' => 'border-color'
                ),
            ),
        ),
        'color_topbar'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Top Bar Text Color', 'consultax' ),
            'section'  => 'header_styling',
            'default'  => '',
            'priority' => 11,
            'output'    => array(
                array(
                    'element'  => '.header-topbar, .header-topbar .social-list li a, .header-topbar .info-list li a',
                    'property' => 'color'
                ),
            ),
        ),

        'separator_1'     => array(
            'type'        => 'custom',
            'label'       => '',
            'section'     => 'header_styling',
            'default'     => '<hr>',
            'priority'    => 12,
        ),
        'bg_menu'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Main Navigation Background Color', 'consultax' ),
            'section'  => 'header_styling',
            'default'  => '',
            'priority' => 13,
            'output'    => array(
                array(
                    'element'  => '.main-header',
                    'property' => 'background'
                ),
            ),
        ),
        'color_menu'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Menu Item Color', 'consultax' ),
            'section'  => 'header_styling',
            'default'  => '',
            'priority' => 14,
            'output'    => array(
                array(
                    'element'  => '.site-header .main-navigation > ul > li > a, .site-header .h-cart-btn i, .site-header .toggle_search i',
                    'property' => 'color'
                ),
            ),
        ),
        'separator_2'     => array(
            'type'        => 'custom',
            'label'       => '',
            'section'     => 'header_styling',
            'default'     => '<hr>',
            'priority'    => 15,
        ),
        'bg_smenu'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Background Color for Dropdown Menu', 'consultax' ),
            'section'  => 'header_styling',
            'default'  => '',
            'priority' => 16,
            'output'    => array(
                array(
                    'element'  => '.main-navigation ul ul',
                    'property' => 'background'
                ),                
            ),
        ),
        'border_smenu'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Border Color for Dropdown Menu Item', 'consultax' ),
            'section'  => 'header_styling',
            'default'  => '',
            'priority' => 17,
            'output'    => array(
                array(
                    'element'  => '.main-navigation ul li li a',
                    'property' => 'border-color'
                ),
            ),
        ),
        'color_smenu'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Color for Dropdown Menu Item', 'consultax' ),
            'section'  => 'header_styling',
            'default'  => '',
            'priority' => 18,
            'output'    => array(
                array(
                    'element'  => '.main-navigation ul li li a',
                    'property' => 'color'
                ),
            ),
        ),

        'hmobile_style'    => array(
            'type'        => 'select',
            'label'       => esc_attr__( 'Header Style', 'consultax' ),
            'section'     => 'header_mobile_styling',
            'default'     => 'stylelight',
            'priority'    => 1,
            'multiple'    => 1,
            'choices'     => array(
                'stylelight' => 'Light Style',
                'styledark' => 'Dark Style',
				'styleblue' => 'Blue Style',                
            ),
        ),

        // Preloader Setting
        'preload'     => array(
            'type'        => 'toggle',
            'label'       => esc_attr__( 'Preloader', 'consultax' ),
            'section'     => 'preload_section',
            'default'     => '1',
            'priority'    => 10,
        ),
        'preload_logo'    => array(
            'type'     => 'image',
            'label'    => esc_html__( 'Logo Preload', 'consultax' ),
            'section'  => 'preload_section',
            'default'  => trailingslashit( get_template_directory_uri() ) . 'images/logo-blue.png',
            'priority' => 11,
            'active_callback' => array(
                array(
                    'setting'  => 'preload',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'preload_logo_width'     => array(
            'type'     => 'number',
            'label'    => esc_html__( 'Logo Width', 'consultax' ),
            'section'  => 'preload_section',
            'default'  => 231,
            'priority' => 12,
            'active_callback' => array(
                array(
                    'setting'  => 'preload',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'preload_logo_height'    => array(
            'type'     => 'number',
            'label'    => esc_html__( 'Logo Height', 'consultax' ),
            'section'  => 'preload_section',
            'default'  => 47,
            'priority' => 13,
            'active_callback' => array(
                array(
                    'setting'  => 'preload',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'preload_text_color'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Text Color', 'consultax' ),
            'section'  => 'preload_section',
            'default'  => '#0a0f2b',
            'priority' => 14,
            'active_callback' => array(
                array(
                    'setting'  => 'preload',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'preload_bgcolor'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Background Color', 'consultax' ),
            'section'  => 'preload_section',
            'default'  => '#fff',
            'priority' => 15,
            'active_callback' => array(
                array(
                    'setting'  => 'preload',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'preload_typo' => array(
            'type'        => 'typography',
            'label'       => esc_attr__( 'Preload Font', 'consultax' ),
            'section'     => 'preload_section',
            'default'     => array(
                'font-family'    => 'Roboto',
                'variant'        => 'regular',
                'font-size'      => '13px',
                'line-height'    => '40px',
                'letter-spacing' => '2px',
                'subsets'        => array( 'latin-ext' ),                
                'text-transform' => 'none',
                'text-align'     => 'center'
            ),
            'priority'    => 16,
            'output'      => array(
                array(
                    'element' => '#royal_preloader.royal_preloader_logo .royal_preloader_percentage',
                ),
            ),
        ),
	);

	$settings['panels']   = apply_filters( 'consultax_customize_panels', $panels );
	$settings['sections'] = apply_filters( 'consultax_customize_sections', $sections );
	$settings['fields']   = apply_filters( 'consultax_customize_fields', $fields );

	return $settings;
}

$consultax_customize = new Consultax_Customize( header_customize_settings() );