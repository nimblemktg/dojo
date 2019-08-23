<?php
function footer_customize_settings() {
	/**
	 * Customizer configuration
	 */

	$settings = array(
		'theme' => 'consultax',
	);

	$panels = array(	
		// Footer Customize Panel
	    'footer'        => array(
			'title'      => esc_html__( 'Footer', 'consultax' ),
			'priority'   => 10,
			'capability' => 'edit_theme_options',
		),
	);

	$sections = array(			
		'main_footer'           => array(
            'title'       => esc_html__( 'Footer Content', 'consultax' ),
            'description' => '',
            'priority'    => 20,
            'capability'  => 'edit_theme_options',
            'panel'       => 'footer',
        ),
        'footer_styling'           => array(
            'title'       => esc_html__( 'Footer Styling', 'consultax' ),
            'description' => '',
            'priority'    => 21,
            'capability'  => 'edit_theme_options',
            'panel'       => 'footer',
        ),
	);

	$fields = array(
		//Footer Widgets
		'footer_widgets'     => array(
            'type'        => 'toggle',
            'label'       => esc_attr__( 'Footer Widgets On/Off?', 'consultax' ),
            'section'     => 'main_footer',
            'default'     => 1,
            'priority'    => 3,
        ),
		//Copyright	
		'footer_bottom'     => array(
            'type'        => 'toggle',
            'label'       => esc_attr__( 'Footer Bottom On/Off?', 'consultax' ),
            'section'     => 'main_footer',
            'default'     => 1,
            'priority'    => 3,
        ),
		'copyright'     => array(
            'type'        => 'textarea',
            'label'       => esc_attr__( 'Copyright', 'consultax' ),
            'section'     => 'main_footer',
            'priority'    => 6,
            'active_callback' => array(
                array(
                    'setting'  => 'footer_bottom',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),

        //Footer Styling
        'ptop_footer'  => array(
            'type'     => 'number',
            'label'    => esc_html__( 'Padding Top Footer Widgets', 'consultax' ),
            'section'  => 'footer_styling',
            'default'  => '120',
            'priority' => 1,
            'output'   => array(
                array(
                    'element'  => '.main-footer',
                    'property' => 'padding-top',
                    'units'	   => 'px'
                ),
            ),
        ),
        'pbot_footer'  => array(
            'type'     => 'number',
            'label'    => esc_html__( 'Padding Bottom Footer Widgets', 'consultax' ),
            'section'  => 'footer_styling',
            'default'  => '80',
            'priority' => 1,
            'output'   => array(
                array(
                    'element'  => '.main-footer',
                    'property' => 'padding-bottom',
                    'units'	   => 'px'
                ),
            ),
        ),
        'bg_footer'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Background Footer Widgets', 'consultax' ),
            'section'  => 'footer_styling',
            'priority' => 1,
            'output'    => array(
                array(
                    'element'  => '.site-footer',
                    'property' => 'background',
                ),
            ),
        ),
        'color_footer' => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Color Footer Widgets', 'consultax' ),
            'section'  => 'footer_styling',
            'priority' => 2,
            'output'    => array(
                array(
                    'element'  => '.main-footer, .main-footer a, .main-footer h4, .main-footer ul a, .main-footer a.gray, .main-footer a.gray:visited',
                    'property' => 'color',
                ),
                array(
                    'element'  => '.main-footer a.gray, .main-footer a.gray:visited',
                    'property' => 'border-color',
                ),
            ),
        ),
        'cta_separator'     => array(
            'type'        => 'custom',
            'label'       => '',
            'section'     => 'footer_styling',
            'default'     => '<hr>',
            'priority'    => 3,
        ),
        'bg_bfooter'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Background Bottom Footer', 'consultax' ),
            'section'  => 'footer_styling',
            'priority' => 4,
            'output'    => array(
                array(
                    'element'  => '.footer-bottom',
                    'property' => 'background',
                ),
            ),
        ),
        'color_bfooter' => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Color Top Footer', 'consultax' ),
            'section'  => 'footer_styling',
            'priority' => 5,
            'output'    => array(
                array(
                    'element'  => '.footer-bottom a, .footer-bottom',
                    'property' => 'color',
                )
            ),
        ),
	);

	$settings['panels']   = apply_filters( 'consultax_customize_panels', $panels );
	$settings['sections'] = apply_filters( 'consultax_customize_sections', $sections );
	$settings['fields']   = apply_filters( 'consultax_customize_fields', $fields );

	return $settings;
}

$consultax_customize = new Consultax_Customize( footer_customize_settings() );