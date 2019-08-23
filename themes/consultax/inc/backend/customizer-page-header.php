<?php
function page_header_customize_settings() {
    /**
     * Customizer configuration
     */

    $settings = array(
        'theme' => 'consultax',
    );

    $sections = array(
        'page_header'     => array(
            'title'       => esc_html__( 'Page Header', 'consultax' ),
            'description' => '',
            'priority'    => 9,
            'capability'  => 'edit_theme_options',
        ),
    );

    $fields = array(
        //Page Header
        'pheader_switch'  => array(
            'type'        => 'toggle',
            'label'       => esc_html__( 'Page Header On/Off?', 'consultax' ),
            'section'     => 'page_header',
            'default'     => 1,
            'priority'    => 10,
        ),
        'breadcrumbs'     => array(
            'type'        => 'toggle',
            'label'       => esc_html__( 'Breadcrumbs On/Off?', 'consultax' ),
            'section'     => 'page_header',
            'default'     => 1,
            'priority'    => 10,
            'active_callback' => array(
                array(
                    'setting'  => 'pheader_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'pheader_img'  => array(
            'type'     => 'image',
            'label'    => esc_html__( 'Background Image', 'consultax' ),
            'section'  => 'page_header',
            'default'  => get_template_directory_uri() . '/images/bg-pheader.jpg',
            'priority' => 10,
            'output'    => array(
                array(
                    'element'  => '.page-header',
                    'property' => 'background-image'
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'pheader_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'pheader_color'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Background Color', 'consultax' ),
            'section'  => 'page_header',
            'default'  => '',
            'priority' => 10,
            'output'    => array(
                array(
                    'element'  => '.page-header',
                    'property' => 'background-color'
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'pheader_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'ptitle_color'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Page Title Color', 'consultax' ),
            'section'  => 'page_header',
            'default'  => '',
            'priority' => 10,
            'output'    => array(
                array(
                    'element'  => '.page-title, .breadc-box li a, .breadc-box li:before',
                    'property' => 'color'
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'pheader_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'pheader_height'  => array(
            'type'     => 'number',
            'label'    => esc_html__( 'Page Header Height', 'consultax' ),
            'section'  => 'page_header',
            'default'  => '200',
            'priority' => 10,
            'output'   => array(
                array(
                    'element'  => '.breadc-box .row',
                    'property' => 'min-height',
                    'units'    => 'px'
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'pheader_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'head_size'  => array(
            'type'     => 'number',
            'label'    => esc_html__( 'Page Title Size', 'consultax' ),
            'section'  => 'page_header',
            'default'  => '30',
            'priority' => 10,
            'output'   => array(
                array(
                    'element'  => '.page-title',
                    'property' => 'font-size',
                    'units'    => 'px'
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'pheader_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
    );

    $settings['sections'] = apply_filters( 'consultax_customize_sections', $sections );
    $settings['fields']   = apply_filters( 'consultax_customize_fields', $fields );

    return $settings;
}

$consultax_customize = new Consultax_Customize( page_header_customize_settings() );