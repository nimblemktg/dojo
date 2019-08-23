<?php

// Add default custom post type using WPBakery Page Builder
if( class_exists( 'Vc_Manager' ) ) {
    $list = array(
        'post',
        'page',
        'portfolio',        
        'service',        
    );
    vc_set_default_editor_post_types( $list );
    vc_disable_frontend();
}

//Admin Style
if ( ! function_exists( 'consultax_custom_wp_admin_style' ) ) :
    function consultax_custom_wp_admin_style() {
        wp_register_style( 'consultax_custom_wp_admin_css', get_template_directory_uri() . '/inc/backend/css/admin-style.css', false, '1.0.0' );
        wp_enqueue_style( 'consultax_custom_wp_admin_css' );
    }
    add_action( 'admin_enqueue_scripts', 'consultax_custom_wp_admin_style' );
endif;

//Upload SVG file
function consultax_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  $mimes['svgz'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'consultax_mime_types', 10, 1);

//Typography Settings
if ( ! function_exists( 'consultax_typography_css' ) ) :
    /**
     * Get typography CSS base on settings
     *
     * @since 1.1.6
     */
    function consultax_typography_css() {
        $css        = '';
        $properties = array(
            'font-family'    => 'font-family',
            'font-size'      => 'font-size',
            'variant'        => 'font-weight',
            'line-height'    => 'line-height',
            'letter-spacing' => 'letter-spacing',
            'color'          => 'color',
            'text-transform' => 'text-transform',
        );

        $settings = array(
            'body_typo'          => 'body, p, button, input, select, optgroup, textarea',
            'heading1_typo'      => 'h1',
            'heading2_typo'      => 'h2',
            'heading3_typo'      => 'h3',
            'heading4_typo'      => 'h4',
            'heading5_typo'      => 'h5',
            'heading6_typo'      => 'h6',
            'other_typo'         => '.pagelink, .header-topbar, .btn, .content-area .inner-post .post-link, .contact-info i, .lead, .font-second, .breadcrumbs, .content-area .inner-post .entry-meta, .comments-area .comment-item .comment-reply a, .recent-news time, .ot-socials span, .testi-item .testi-content,
                .testi-slider .testi-item-2',
            'menu_typo'          => '.main-navigation ul > li > a, .main-navigation ul li li a',
        );

        foreach ( $settings as $setting => $selector ) {
            $typography = consultax_get_option( $setting );
            $default    = (array) consultax_get_option_default( $setting );
            $style      = '';

            foreach ( $properties as $key => $property ) {
                if ( isset( $typography[ $key ] ) && ! empty( $typography[ $key ] ) ) {
                    if ( isset( $default[ $key ] ) && strtoupper( $default[ $key ] ) == strtoupper( $typography[ $key ] ) ) {
                        continue;
                    }
                    $value = 'font-family' == $key ? '"' . rtrim( trim( $typography[ $key ] ), ',' ) . '"' : $typography[ $key ];
                    $value = 'variant' == $key ? str_replace( 'regular', '400', $value ) : $value;

                    if ( $value ) {
                        $style .= $property . ': ' . $value . ';';
                    }
                }
            }

            if ( ! empty( $style ) ) {
                $css .= $selector . '{' . $style . '}';
            }
        }

        $css .= consultax_get_heading_typography_css();

        return $css;
    }
endif;

/**
 * Returns CSS for the typography.
 *
 *
 * @param array $body_typo Color scheme body typography.
 *
 * @return string typography CSS.
 */
function consultax_get_heading_typography_css() {

    $headings   = array(
        'h1' => 'heading1_typo',
        'h2' => 'heading2_typo',
        'h3' => 'heading3_typo',
        'h4' => 'heading4_typo',
        'h5' => 'heading5_typo',
        'h6' => 'heading6_typo',
    );
    $inline_css = '';
    foreach ( $headings as $heading ) {
        $keys = array_keys( $headings, $heading );
        if ( $keys ) {
            $inline_css .= consultax_get_heading_font( $keys[0], $heading );
        }
    }

    return $inline_css;

}

/**
 * Returns CSS for the typography.
 *
 *
 * @param array $body_typo Color scheme body typography.
 *
 * @return string typography CSS.
 */
function consultax_get_heading_font( $key, $heading ) {

    $inline_css   = '';
    $heading_typo = consultax_get_option( $heading );

    if ( $heading_typo ) {
        if ( isset( $heading_typo['font-family'] ) && strtolower( $heading_typo['font-family'] ) !== 'poppins' ) {
            $typo       = rtrim( trim( $heading_typo['font-family'] ), ',' );
            $inline_css .= $key . '{font-family:' . $typo . ', Arial, sans-serif}';

            if ( isset( $heading_typo['variant'] ) ) {
                $inline_css .= $key . '.vc_custom_heading{font-weight:' . $heading_typo['variant'] . '}';
            }
        }
    }

    if ( empty( $inline_css ) ) {
        return;
    }

    return <<<CSS
    {$inline_css}
CSS;
}

//Custom Style Frontend
if(!function_exists('consultax_custom_frontend_style')){

    function consultax_custom_frontend_style(){
        $style_css 	= '';
        $style_css .= consultax_typography_css();

        if(! empty($style_css)){
            echo '<style type="text/css">'.$style_css.'</style>';
        }
    }
}
add_action('wp_head', 'consultax_custom_frontend_style');