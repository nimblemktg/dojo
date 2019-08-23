<?php
function blog_customize_settings() {
	/**
	 * Customizer configuration
	 */

	$settings = array(
		'theme' => 'consultax',
	);

	$panels = array(	
	    
	);

	$sections = array(
		
	);

	$fields = array(
		// Blog Page
		'blog_layout'           => array(
			'type'        => 'radio-image',
			'label'       => esc_html__( 'Blog Layout', 'consultax' ),
			'section'     => 'blog_page',
			'default'     => 'content-sidebar',
			'priority'    => 9,
			'description' => esc_html__( 'Select default sidebar for the blog page.', 'consultax' ),
			'choices'     => array(
				'content-sidebar' 	=> get_template_directory_uri() . '/inc/backend/images/right.png',
				'sidebar-content' 	=> get_template_directory_uri() . '/inc/backend/images/left.png',
				'full-content' 		=> get_template_directory_uri() . '/inc/backend/images/full.png',
			)
		),
		'post_entry_meta'              => array(
            'type'     => 'multicheck',
            'label'    => esc_html__( 'Entry Meta', 'consultax' ),
            'section'  => 'blog_page',
            'default'  => array( 'date', 'author', 'cat' ),
            'choices'  => array(
                'date'    => esc_html__( 'Date', 'consultax' ),
                'cat'     => esc_html__( 'Categories', 'consultax' ),
                'date'    => esc_html__( 'Date', 'consultax' ),
                'author'  => esc_html__( 'Author', 'consultax' ),
            ),
            'priority' => 10,
        ),
		'blog_read_more'               => array(
			'type'            => 'text',
			'label'           => esc_html__( 'Read More Button', 'consultax' ),
			'section'         => 'blog_page',
			'default'         => esc_html__( 'Read more', 'consultax' ),
			'priority'        => 11,
		),

        // Single Post
        'single_post_layout'           => array(
            'type'        => 'radio-image',
            'label'       => esc_html__( 'Single Post Layout', 'consultax' ),
            'section'     => 'single_post',
            'default'     => 'content-sidebar',
            'priority'    => 10,
            'description' => esc_html__( 'Select default sidebar for the single post page.', 'helendo' ),
            'choices'     => array(
				'content-sidebar' 	=> get_template_directory_uri() . '/inc/backend/images/right.png',
				'sidebar-content' 	=> get_template_directory_uri() . '/inc/backend/images/left.png',
				'full-content' 		=> get_template_directory_uri() . '/inc/backend/images/full.png',
			)
        ),
        'post_custom_field_1'          => array(
            'type'    => 'custom',
            'section' => 'single_post',
            'default' => '<hr/>',
        ),

	);

	$settings['panels']   = apply_filters( 'consultax_customize_panels', $panels );
	$settings['sections'] = apply_filters( 'consultax_customize_sections', $sections );
	$settings['fields']   = apply_filters( 'consultax_customize_fields', $fields );

	return $settings;
}

$consultax_customize = new Consultax_Customize( blog_customize_settings() );