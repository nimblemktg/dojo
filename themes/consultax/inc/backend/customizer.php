<?php
/**
 * Theme customizer
 *
 * @package Consultax
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Consultax_Customize {
	/**
	 * Customize settings
	 *
	 * @var array
	 */
	protected $config = array();

	/**
	 * The class constructor
	 *
	 * @param array $config
	 */
	public function __construct( $config ) {
		$this->config = $config;

		if ( ! class_exists( 'Kirki' ) ) {
			return;
		}

		$this->register();
	}

	/**
	 * Register settings
	 */
	public function register() {

		/**
		 * Add the theme configuration
		 */
		if ( ! empty( $this->config['theme'] ) ) {
			Kirki::add_config(
				$this->config['theme'], array(
					'capability'  => 'edit_theme_options',
					'option_type' => 'theme_mod',
				)
			);
		}

		/**
		 * Add panels
		 */
		if ( ! empty( $this->config['panels'] ) ) {
			foreach ( $this->config['panels'] as $panel => $settings ) {
				Kirki::add_panel( $panel, $settings );
			}
		}

		/**
		 * Add sections
		 */
		if ( ! empty( $this->config['sections'] ) ) {
			foreach ( $this->config['sections'] as $section => $settings ) {
				Kirki::add_section( $section, $settings );
			}
		}

		/**
		 * Add fields
		 */
		if ( ! empty( $this->config['theme'] ) && ! empty( $this->config['fields'] ) ) {
			foreach ( $this->config['fields'] as $name => $settings ) {
				if ( ! isset( $settings['settings'] ) ) {
					$settings['settings'] = $name;
				}

				Kirki::add_field( $this->config['theme'], $settings );
			}
		}
	}

	/**
	 * Get config ID
	 *
	 * @return string
	 */
	public function get_theme() {
		return $this->config['theme'];
	}

	/**
	 * Get customize setting value
	 *
	 * @param string $name
	 *
	 * @return bool|string
	 */
	public function get_option( $name ) {

		$default = $this->get_option_default( $name );

		return get_theme_mod( $name, $default );
	}

	/**
	 * Get default option values
	 *
	 * @param $name
	 *
	 * @return mixed
	 */
	public function get_option_default( $name ) {
		if ( ! isset( $this->config['fields'][ $name ] ) ) {
			return false;
		}

		return isset( $this->config['fields'][ $name ]['default'] ) ? $this->config['fields'][ $name ]['default'] : false;
	}
}

/**
 * This is a short hand function for getting setting value from customizer
 *
 * @param string $name
 *
 * @return bool|string
 */
function consultax_get_option( $name ) {
	global $consultax_customize;

	$value = false;

	if ( class_exists( 'Kirki' ) ) {
		$value = Kirki::get_option( 'consultax', $name );
	} elseif ( ! empty( $consultax_customize ) ) {
		$value = $consultax_customize->get_option( $name );
	}

	return apply_filters( 'consultax_get_option', $value, $name );
}

/**
 * Get default option values
 *
 * @param $name
 *
 * @return mixed
 */
function consultax_get_option_default( $name ) {
	global $consultax_customize;

	if ( empty( $consultax_customize ) ) {
		return false;
	}

	return $consultax_customize->get_option_default( $name );
}

/**
 * Move some default sections to `general` panel that registered by theme
 *
 * @param object $wp_customize
 */
function consultax_customize_modify( $wp_customize ) {
	$wp_customize->get_section( 'title_tagline' )->panel     = 'general';
	$wp_customize->get_section( 'static_front_page' )->panel = 'general';
}

add_action( 'customize_register', 'consultax_customize_modify' );


/**
 * Get customize settings
 *
 * Priority (Order) WordPress Live Customizer default: 
 * @link https://developer.wordpress.org/themes/customize-api/customizer-objects/
 *
 * @return array
 */
function consultax_customize_settings() {
	/**
	 * Customizer configuration
	 */

	$settings = array(
		'theme' => 'consultax',
	);

	$panels = array(
		'general'        => array(
			'priority'   => 5,
			'title'      => esc_html__( 'General', 'consultax' ),
		),
        'blog'           => array(
			'title'      => esc_html__( 'Blog', 'consultax' ),
			'priority'   => 10,
			'capability' => 'edit_theme_options',
		),
	);

	$sections = array(
		'blog_page'       => array(
			'title'       => esc_html__( 'Blog Page', 'consultax' ),
			'description' => '',
			'priority'    => 9,
			'capability'  => 'edit_theme_options',
			'panel'       => 'blog',
		),
        'single_post'     => array(
			'title'       => esc_html__( 'Single Post', 'consultax' ),
			'description' => '',
			'priority'    => 10,
			'capability'  => 'edit_theme_options',
			'panel'       => 'blog',
		),
		'styling'           => array(
            'title'       => esc_html__( 'Styling', 'industro' ),
            'description' => '',
            'priority'    => 25,
            'capability'  => 'edit_theme_options',
        ),
	);

	$fields = array(
		//Shop
		'per_page'     => array(
            'type'     => 'number',
            'label'    => esc_html__( 'Product Per Page', 'industro' ),
            'section'  => 'woocommerce_product_catalog',
            'default'  => 4,
            'priority' => 10,
            'description' => 'Enter number products display per page.',
        ),
        'loop_columns' => array(
            'type'     => 'select',
            'label'    => esc_html__( 'Product Loop Columns', 'industro' ),
            'section'  => 'woocommerce_product_catalog',
            'default'  => 2,
            'choices'  => array(
                '2'    => esc_html__( '2 Columns', 'consultax' ),
                '3'    => esc_html__( '3 Columns', 'consultax' ),
                '4'    => esc_html__( '4 Columns', 'consultax' ),
            ),
            'priority' => 10,
            'description' => 'Choose number columns display per row.',
        ),

		//Styling
        'bg_body'      => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Background Body', 'industro' ),
            'section'  => 'styling',
            'default'  => '',
            'priority' => 10,
            'output'   => array(
                array(
                    'element'  => 'body, .site-content',
                    'property' => 'background-color',
                ),
            ),
        ),
        'main_color'   => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Primary Color', 'industro' ),
            'section'  => 'styling',
            'default'  => '#f26522',
            'priority' => 10,
        ),
        'second_color' => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Second Color', 'industro' ),
            'section'  => 'styling',
            'default'  => '#00387a',
            'priority' => 10,
        ),
	);
	$settings['panels']   = apply_filters( 'consultax_customize_panels', $panels );
	$settings['sections'] = apply_filters( 'consultax_customize_sections', $sections );
	$settings['fields']   = apply_filters( 'consultax_customize_fields', $fields );

	return $settings;
}

$consultax_customize = new Consultax_Customize( consultax_customize_settings() );

require get_template_directory() . '/inc/backend/customizer-blog.php';
require get_template_directory() . '/inc/backend/customizer-header.php';
require get_template_directory() . '/inc/backend/customizer-page-header.php';
require get_template_directory() . '/inc/backend/customizer-footer.php';
require get_template_directory() . '/inc/backend/customizer-typography.php';