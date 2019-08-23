<?php
function typography_customize_settings() {
    /**
     * Customizer configuration
     */

    $settings = array(
        'theme' => 'consultax',
    );

    $panels = array(
        
    );

    $sections = array(
        'typography'           => array(
            'title'       => esc_html__( 'Typography', 'consultax' ),
            'description' => '',
            'priority'    => 15,
            'capability'  => 'edit_theme_options',
        ),
    );

    $fields = array(
        // Typography
        'body_typo'    => array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Body', 'consultax' ),
            'section'  => 'typography',
            'priority' => 10,
            'default'  => array(
                'font-family'    => 'Open Sans',
                'variant'        => 'regular',
                'font-size'      => '14px',
                'line-height'    => '1.6',
                'letter-spacing' => '0',
                'subsets'        => array( 'latin-ext' ),
                'color'          => '#252525',
                'text-transform' => 'none',
            ),
        ),
        'heading1_typo'                           => array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Heading 1', 'consultax' ),
            'section'  => 'typography',
            'priority' => 10,
            'default'  => array(
                'font-family'    => 'Montserrat',
                'variant'        => '800',
                'font-size'      => '50px',
                'line-height'    => '1.2',
                'letter-spacing' => '0',
                'subsets'        => array( 'latin-ext' ),
                'color'          => '#000',
                'text-transform' => 'none',
            ),
        ),
        'heading2_typo'                           => array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Heading 2', 'consultax' ),
            'section'  => 'typography',
            'priority' => 10,
            'default'  => array(
                'font-family'    => 'Montserrat',
                'variant'        => '800',
                'font-size'      => '40px',
                'line-height'    => '1.2',
                'letter-spacing' => '0',
                'subsets'        => array( 'latin-ext' ),
                'color'          => '#000',
                'text-transform' => 'none',
            ),
        ),
        'heading3_typo'                           => array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Heading 3', 'consultax' ),
            'section'  => 'typography',
            'priority' => 10,
            'default'  => array(
                'font-family'    => 'Montserrat',
                'variant'        => '800',
                'font-size'      => '30px',
                'line-height'    => '1.2',
                'letter-spacing' => '0',
                'subsets'        => array( 'latin-ext' ),
                'color'          => '#000',
                'text-transform' => 'none',
            ),
        ),
        'heading4_typo'                           => array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Heading 4', 'consultax' ),
            'section'  => 'typography',
            'priority' => 10,
            'default'  => array(
                'font-family'    => 'Montserrat',
                'variant'        => '800',
                'font-size'      => '20px',
                'line-height'    => '1.2',
                'letter-spacing' => '0',
                'subsets'        => array( 'latin-ext' ),
                'color'          => '#000',
                'text-transform' => 'none',
            ),
        ),
        'heading5_typo'                           => array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Heading 5', 'consultax' ),
            'section'  => 'typography',
            'priority' => 10,
            'default'  => array(
                'font-family'    => 'Montserrat',
                'variant'        => '800',
                'font-size'      => '16px',
                'line-height'    => '1.2',
                'letter-spacing' => '0',
                'subsets'        => array( 'latin-ext' ),
                'color'          => '#000',
                'text-transform' => 'none',
            ),
        ),
        'heading6_typo'                           => array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Heading 6', 'consultax' ),
            'section'  => 'typography',
            'priority' => 10,
            'default'  => array(
                'font-family'    => 'Montserrat',
                'variant'        => '800',
                'font-size'      => '14px',
                'line-height'    => '1.2',
                'letter-spacing' => '0',
                'subsets'        => array( 'latin-ext' ),
                'color'          => '#000',
                'text-transform' => 'none',
            ),
        ),
        'other_typo'                               => array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Other', 'consultax' ),
            'section'  => 'typography',
            'priority' => 10,
            'default'  => array(
                'font-family'    => 'Montserrat',
            ),
        ),
        'menu_typo'                               => array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Menu', 'consultax' ),
            'section'  => 'typography',
            'priority' => 10,
            'default'  => array(
                'font-family'    => 'Montserrat',
                'variant'        => '800',
                'subsets'        => array( 'latin-ext' ),
                'font-size'      => '12px',
                'text-transform' => 'uppercase',
            ),
        ),

    );

    $settings['panels']   = apply_filters( 'consultax_customize_panels', $panels );
    $settings['sections'] = apply_filters( 'consultax_customize_sections', $sections );
    $settings['fields']   = apply_filters( 'consultax_customize_fields', $fields );

    return $settings;
}

$consultax_customize = new Consultax_Customize( typography_customize_settings() );