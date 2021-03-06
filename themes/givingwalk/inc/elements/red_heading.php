<?php
/**
 * All code here copied from VC_Custom_Heading Element
 * if need update just copy from VC version then overrite this file.
 * IMPORTANT: Katana theme just added new option for add icon before title 
 * and Subtitle
 * @author Red Team
 * @since 1.0.0
*/

vc_map(array(
    'name'        => 'Red Heading',
    'base'        => 'red_heading',
    'icon'        => 'icon-wpb-ui-custom_heading',
    'category'    => esc_html__('RedExp', 'givingwalk'),
    'description' => esc_html__('Add Custom Heading', 'givingwalk'),
    'params'      => array_merge(
        array(
            array(
                'type'       => 'img',
                'heading'    => esc_html__('Layout Mode','givingwalk'),
                'param_name' => 'layout_mode',
                'value'      =>  array(
                    'default'          => get_template_directory_uri().'/inc/elements/layouts/default.jpg',
                    '1'          => get_template_directory_uri().'/inc/elements/layouts/red-heading-layout-1.jpg',
                ),
                'std'        => 'default',
            ),
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__( 'Text source', 'givingwalk' ),
                'param_name' => 'source',
                'value'      => array(
                    esc_html__( 'Custom text', 'givingwalk' )        => '',
                ),
                'std'         => '',
                'description' => esc_html__( 'Select text source.', 'givingwalk' ),
            ),
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__( 'Text Align', 'givingwalk' ),
                'param_name' => 'text_align',
                'value'      => array(
                    esc_html__( 'Default', 'givingwalk' )      => '',
                    esc_html__( 'Text Left', 'givingwalk' )    => 'left',
                    esc_html__( 'Text Right', 'givingwalk' )   => 'right',
                    esc_html__( 'Text Center', 'givingwalk' )  => 'center',
                    esc_html__( 'Text Justify', 'givingwalk' ) => 'justify',
                ),
                'std'         => '',
                'description' => esc_html__( 'Select text alignment.', 'givingwalk' ),
            ),
            vc_map_add_css_animation(),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__( 'Extra class name', 'givingwalk' ),
                'param_name'  => 'el_class',
                'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'givingwalk' ),
            ),
            array(
                'type'        => 'param_group',
                'heading'     => esc_html__( 'Text', 'givingwalk' ),
                'param_name'  => 'text',
                'value'       =>  '',
                'description' => esc_html__( 'Note: If you are using non-latin characters be sure to activate them under Settings/Visual Composer/General Settings.', 'givingwalk' ),
                'group'       => esc_html__('Title','givingwalk'),
                'dependency'  => array(
                    'element'  => 'source',
                    'is_empty' => true,
                ),
                'params' => array(
                    array(
                        'type'          => 'textarea',
                        'heading'       => esc_html__( 'A part of text', 'givingwalk' ),
                        'param_name'    => 'text_part',
                        'value'         => '',
                        'admin_label'   => true,
                    ),
                    array(
                        'type'          => 'dropdown',
                        'heading'       => esc_html__( 'Font Style', 'givingwalk' ),
                        'param_name'    => 'text_part_style',
                        'value'         => array(
                            esc_html__('Light','givingwalk')        => 'style0',
                            esc_html__('Default','givingwalk')        => 'style1',
                            esc_html__('Default Italic','givingwalk') => 'style2',
                            esc_html__('Bold','givingwalk')           => 'style3',
                            esc_html__('Bold Italic','givingwalk')    => 'style4',
                            esc_html__('Extra Bold','givingwalk')           => 'style5',
                            esc_html__('Extra Bold Italic','givingwalk')    => 'style6',
                        ),
                        'std'           => 'style1',
                        'admin_label' => true,
                    ),
                    array(
                        'type'          => 'dropdown',
                        'heading'       => esc_html__( 'Text Color', 'givingwalk' ),
                        'param_name'    => 'text_part_color',
                        'value'         => array(
                            esc_html__('Default','givingwalk')       => '',
                            esc_html__('Primary Color','givingwalk') => 'primary-color',
                            esc_html__('Custom','givingwalk')        => 'custom',
                        ),
                    ),
                    array(
                        'type'          => 'colorpicker',
                        'heading'       => esc_html__( 'Choose color of text', 'givingwalk' ),
                        'param_name'    => 'text_part_color_custom',
                        'value'         => '',
                        'dependency' => array(
                            'element' => 'text_part_color',
                            'value'   => 'custom',
                        ),
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__( 'Font size', 'givingwalk' ),
                        'param_name'  => 'item_font_size',
                        'value'       => '',
                    ),
                ),
            ),
            array(
                'type'        => 'vc_link',
                'heading'     => esc_html__( 'URL (Link)', 'givingwalk' ),
                'param_name'  => 'link',
                'description' => esc_html__( 'Add link to custom heading.', 'givingwalk' ),
                'group'         => esc_html__('Title','givingwalk')
            ),
            array(
                'type'       => 'font_container',
                'param_name' => 'font_container',
                'value'      => 'tag:h2',
                'settings'   => array(
                    'fields'    => array(
                        'tag'=>'h2',
                        'font_size',
                        'line_height',
                        'color',
                    ),
                ),
                'group'         => esc_html__('Title','givingwalk')
            ),
           
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__( 'Letter Spacing', 'givingwalk' ),
                'param_name'  => 'letter_spacing',
                'value'       => '',
                'description' => esc_html__( 'Enter letter spacing. NOTE: Just enter the number, ex: 30 or -30', 'givingwalk' ),
                'group'       => esc_html__('Title','givingwalk')
            ),
            array(
                'type'        => 'checkbox',
                'heading'     => esc_html__( 'Use theme default font family?', 'givingwalk' ),
                'param_name'  => 'use_theme_fonts',
                'value'       => array( esc_html__( 'Yes', 'givingwalk' ) => 'yes' ),
                'std'         => 'yes',
                'description' => esc_html__( 'Use font family from the theme.', 'givingwalk' ),
                'group'       => esc_html__('Title','givingwalk')
            ),
            array(
                'type'       => 'google_fonts',
                'param_name' => 'google_fonts',
                'value'      => '',
                'settings'   => array(),
                'dependency' => array(
                    'element'            => 'use_theme_fonts',
                    'value_not_equal_to' => 'yes',
                ),
                'group'         => esc_html__('Title','givingwalk')
            ),
            array(
                'type'        => 'checkbox',
                'heading'     => esc_html__( 'Add Image ?', 'givingwalk' ),
                'param_name'  => 'add_image',
                'std'         => false,
                'description' => esc_html__( 'Add an image before the text', 'givingwalk' ),
                'group'       => esc_html__( 'Title', 'givingwalk' ),
            ),
            array(
                'type'          => 'attach_image',
                'param_name'    => 'image',
                'heading'       => esc_html__( 'Choose your image', 'givingwalk' ),
                'value'         => '',
                'description'   => esc_html__( 'Choose an image.', 'givingwalk' ),
                'group'         => esc_html__('Image','givingwalk'),
                'dependency' => array(
                    'element' => 'add_image', 
                    'value'   => 'true',
                ),
            ),
            array(
                'type'        => 'checkbox',
                'heading'     => esc_html__( 'Add icon ?', 'givingwalk' ),
                'param_name'  => 'add_icon',
                'std'         => false,
                'description' => esc_html__( 'Add a icon before the text', 'givingwalk' ),
                'group'       => esc_html__( 'Title', 'givingwalk' ),
            )
        ),
        givingwalk_icon_libs('Title Icon'),
        givingwalk_icon_libs_icon('Title Icon'),
        array(
            array(
                'type'       => 'font_container',
                'param_name' => 'icon_font_container',
                'value'      => '',
                'settings'   => array(
                    'fields'    => array(
                        'font_size',
                        'color',
                        'font_size_description'   => esc_html__( 'Enter icon font size.', 'givingwalk' ),
                        'color_description'       => esc_html__( 'Select icon color.', 'givingwalk' ),
                    ),
                ),
                'dependency' => array(
                    'element' => 'add_icon',
                    'value'   => 'true',
                ),
                'group'       => esc_html__('Title Icon', 'givingwalk')
            ),
            /* Sub title */
            array(
                'type'        => 'param_group',
                'heading'     => esc_html__( 'Sub Title', 'givingwalk' ),
                'param_name'  => 'st_text',
                'value'       => '',
                'params' => array(
                    array(
                        'type'          => 'textarea',
                        'heading'       => esc_html__( 'A part of text', 'givingwalk' ),
                        'param_name'    => 'sttext_part',
                        'value'         => '',
                        'admin_label' => true,
                    ),
                    array(
                        'type'          => 'dropdown',
                        'heading'       => esc_html__( 'Font Style', 'givingwalk' ),
                        'param_name'    => 'sttext_part_style',
                        'value'         => array(
                            esc_html__('Light','givingwalk')        => 'style0',
                            esc_html__('Default','givingwalk')        => 'style1',
                            esc_html__('Default Italic','givingwalk') => 'style2',
                            esc_html__('Bold','givingwalk')           => 'style3',
                            esc_html__('Bold Italic','givingwalk')    => 'style4',
                        ),
                        'std'           => 'style1',
                        'admin_label' => true,
                    ),
                    array(
                        'type'          => 'dropdown',
                        'heading'       => esc_html__( 'Text Color', 'givingwalk' ),
                        'param_name'    => 'sttext_part_color',
                        'value'         => array(
                            esc_html__('Default','givingwalk')       => '',
                            esc_html__('Primary Color','givingwalk') => 'primary-color',
                            esc_html__('Custom','givingwalk')        => 'custom',
                        ),
                    ),
                    array(
                        'type'          => 'colorpicker',
                        'heading'       => esc_html__( 'Choose color of text', 'givingwalk' ),
                        'param_name'    => 'sttext_part_color_custom',
                        'value'         => '',
                        'dependency' => array(
                            'element' => 'sttext_part_color',
                            'value'   => 'custom',
                        ),
                    ),
                ),
                'description' => esc_html__( 'Note: If you are using non-latin characters be sure to activate them under Settings/Visual Composer/General Settings.', 'givingwalk' ),
                'group'       => esc_html__('Sub Title','givingwalk')
            ),
            array(
                'type'       => 'font_container',
                'param_name' => 'st_font_container',
                'value'      => 'tag:h2',
                'settings'   => array(
                    'fields'    => array(
                        'tag'         => 'h2',
                        'font_size'   => '',
                        'line_height' => '',
                        'color'       => '',
                    ),
                ),
                'group'         => esc_html__('Sub Title','givingwalk')
            ),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__( 'Letter Spacing', 'givingwalk' ),
                'param_name' => 'st_letter_spacing',
                'value'      => '',
                'description' => esc_html__( 'Enter letter spacing. NOTE: Just enter the number, ex: 30 or -30', 'givingwalk' ),
                'group'         => esc_html__('Sub Title','givingwalk')
            ),
            array(
                'type'        => 'checkbox',
                'heading'     => esc_html__( 'Use theme default font family?', 'givingwalk' ),
                'param_name'  => 'st_use_theme_fonts',
                'value'       => array( esc_html__( 'Yes', 'givingwalk' ) => 'yes' ),
                'std'         => 'yes',
                'description' => esc_html__( 'Use font family from the theme.', 'givingwalk' ),
                'group'         => esc_html__('Sub Title','givingwalk')
            ),
            array(
                'type'       => 'google_fonts',
                'param_name' => 'st_google_fonts',
                'value'      => '',
                'settings'   => array(),
                'dependency' => array(
                    'element'            => 'st_use_theme_fonts',
                    'value_not_equal_to' => 'yes',
                ),
                'group'         => esc_html__('Sub Title','givingwalk')
            ),
            /* Description */
            array(
                'type'        => 'textarea',
                'heading'     => esc_html__( 'Description text', 'givingwalk' ),
                'param_name'  => 'desc_text',
                'value'       => '',
                'description' => esc_html__( 'Note: If you are using non-latin characters be sure to activate them under Settings/Visual Composer/General Settings.', 'givingwalk' ),
                'group'         => esc_html__('Description','givingwalk')
            ),
            array(
                'type'       => 'font_container',
                'param_name' => 'desc_font_container',
                'value'      => 'tag:div',
                'settings'   => array(
                    'fields'    => array(
                        'tag'         => 'div',
                        'font_size'   => '',
                        'line_height' => '',
                        'color',
                    ),
                ),
                'group'         => esc_html__('Description','givingwalk')
            ),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__( 'Letter Spacing', 'givingwalk' ),
                'param_name' => 'desc_letter_spacing',
                'value'      => '',
                'description' => esc_html__( 'Enter letter spacing. NOTE: Just enter the number, ex: 30 or -30', 'givingwalk' ),
                'group'         => esc_html__('Description','givingwalk')
            ),
            /* Button */
            array(
                'type'          => 'dropdown',
                'param_name'    => 'btn_type',
                'heading'       => esc_html__( 'Button Type', 'givingwalk' ),
                'value'         => array(
                    esc_html__( 'Default', 'givingwalk' )        => 'btn',
                    esc_html__( 'Primary', 'givingwalk' )        => 'btn-primary',
                    esc_html__( 'Default Alt', 'givingwalk' )    => 'btn btn-alt',
                    esc_html__( 'Primary Alt', 'givingwalk' )    => 'btn-primary btn-alt',
                    esc_html__( 'Alt White', 'givingwalk' )      => 'btn btn-white btn-alt',
                    esc_html__( 'Simple Link', 'givingwalk' )    => 'archive-readmore simple', 
                ),
                'std'           => 'btn',
                'description'   => '',
                'group'       => esc_html__('Button', 'givingwalk')
            ),
            array(
                "type"          => "vc_link",
                "heading"       => esc_html__("Choose your link",'givingwalk'),
                "param_name"    => "button_link",
                "value"         => "",
                'group'       => esc_html__('Button', 'givingwalk')
            ),
            /* Other */
            array(
                'type'       => 'css_editor',
                'heading'    => esc_html__( 'CSS box', 'givingwalk' ),
                'param_name' => 'css',
                'group'      => esc_html__( 'Design Options', 'givingwalk' ),
            )
        )      
    )
));

class WPBakeryShortCode_red_heading extends CmsShortCode{
    
    /**
     * Defines fields names for google_fonts, font_container and etc
     * @since 4.4
     * @var array
     */
    protected $fields = array(
        'google_fonts'        => 'google_fonts',
        'font_container'      => 'font_container',
        'st_google_fonts'     => 'st_google_fonts',
        'st_font_container'   => 'st_font_container',
        'desc_font_container' => 'desc_font_container',
        'el_class'            => 'el_class',
        'css'                 => 'css',
        'text'                => 'text',
        'add_image'           => false,
        'add_icon'            => false,
        'i_type'           => 'fontawesome',
        'icon_font_container' => 'icon_font_container',
    );

    /**
     * Used to get field name in vc_map function for google_fonts, font_container and etc..
     *
     * @param $key
     *
     * @since 4.4
     * @return bool
     */
    protected function getField( $key ) {
        return isset( $this->fields[ $key ] ) ? $this->fields[ $key ] : false;
    }

    /**
     * Get param value by providing key
     *
     * @param $key
     *
     * @since 4.4
     * @return array|bool
     */
    protected function getParamData( $key ) {
        return WPBMap::getParam( $this->shortcode, $this->getField( $key ) );
    }

    /**
     * Parses shortcode attributes and set defaults based on vc_map function relative to shortcode and fields names
     *
     * @param $atts
     *
     * @since 4.3
     * @return array
     */
    public function getAttributes( $atts ) {
        /**
         * Shortcode attributes
         * @var $text
         * @var $google_fonts
         * @var $font_container
         * @var $st_google_fonts
         * @var $st_font_container
         * @var $el_class
         * @var $link
         * @var $css
         * @var $icon_font_container
         */
        $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
        extract( $atts );

        /**
         * Get default values from VC_MAP.
         **/
        $google_fonts_field = $this->getParamData( 'google_fonts' );
        $font_container_field = $this->getParamData( 'font_container' );

        $font_container_obj = new Vc_Font_Container();
        $google_fonts_obj = new Vc_Google_Fonts();
        $font_container_field_settings = isset( $font_container_field['settings'], $font_container_field['settings']['fields'] ) ? $font_container_field['settings']['fields'] : array();
        $google_fonts_field_settings = isset( $google_fonts_field['settings'], $google_fonts_field['settings']['fields'] ) ? $google_fonts_field['settings']['fields'] : array();
        $font_container_data = $font_container_obj->_vc_font_container_parse_attributes( $font_container_field_settings, $font_container );
        $google_fonts_data = strlen( $google_fonts ) > 0 ? $google_fonts_obj->_vc_google_fonts_parse_attributes( $google_fonts_field_settings, $google_fonts ) : '';
        
        /* Title Icon */
        $icon_font_container_field = $this->getParamData( 'icon_font_container' );
        $icon_font_container_field_settings = isset( $icon_font_container_field['settings'], $icon_font_container_field['settings']['fields'] ) ? $icon_font_container_field['settings']['fields'] : array();
        $icon_font_container_data = $font_container_obj->_vc_font_container_parse_attributes( $icon_font_container_field_settings, $icon_font_container );

        /* Sub Title */
        $st_google_fonts_field = $this->getParamData( 'st_google_fonts' );
        $st_font_container_field = $this->getParamData( 'st_font_container' );
        $st_font_container_obj = new Vc_Font_Container();
        $st_google_fonts_obj = new Vc_Google_Fonts();
        $st_font_container_field_settings = isset( $st_font_container_field['settings'], $st_font_container_field['settings']['fields'] ) ? $st_font_container_field['settings']['fields'] : array();
        $st_google_fonts_field_settings = isset( $st_google_fonts_field['settings'], $st_google_fonts_field['settings']['fields'] ) ? $st_google_fonts_field['settings']['fields'] : array();
        $st_font_container_data = $st_font_container_obj->_vc_font_container_parse_attributes( $st_font_container_field_settings, $st_font_container );
        $st_google_fonts_data = strlen( $st_google_fonts ) > 0 ? $st_google_fonts_obj->_vc_google_fonts_parse_attributes( $st_google_fonts_field_settings, $st_google_fonts ) : '';

        /* Description  */
        $desc_font_container_field = $this->getParamData( 'desc_font_container' );
        $desc_font_container_obj = new Vc_Font_Container();
        $desc_font_container_field_settings = isset( $desc_font_container_field['settings'], $desc_font_container_field['settings']['fields'] ) ? $desc_font_container_field['settings']['fields'] : array();
        $desc_font_container_data = $desc_font_container_obj->_vc_font_container_parse_attributes( $desc_font_container_field_settings, $desc_font_container );
        
        $el_class = $this->getExtraClass( $el_class );

        return array(
            'text'                     => isset( $text ) ? $text : '',
            'google_fonts'             => $google_fonts,
            'font_container'           => $font_container,
            'font_container_data'      => $font_container_data,
            'google_fonts_data'        => $google_fonts_data,

            'st_text'                     => isset( $st_text ) ? $st_text : '',
            'st_google_fonts'             => $st_google_fonts,
            'st_font_container'           => $st_font_container,
            'st_font_container_data'      => $st_font_container_data,
            'st_google_fonts_data'        => $st_google_fonts_data,

            'desc_text'                     => isset( $desc_text ) ? $desc_text : '',
            'desc_font_container'           => $desc_font_container,
            'desc_font_container_data'      => $desc_font_container_data,

            'el_class'                 => $el_class,
            'css'                      => $css,
            'link'                     => ( 0 === strpos( $link, '|' ) ) ? false : $link,
            'add_image'                => $add_image,
            'add_icon'                 => $add_icon,
            'i_type'                   => $i_type,
            'icon_font_container_data' => $icon_font_container_data,
        );
    }

    /**
     * Parses google_fonts_data and font_container_data to get needed css styles to markup
     *
     * @param $el_class
     * @param $css
     * @param $google_fonts_data
     * @param $font_container_data
     * @param $icon_font_container_data
     * @param $atts
     *
     * @since 4.3
     * @return array
     */
    public function getStyles( $el_class, $css, $google_fonts_data, $font_container_data, $st_google_fonts_data, $st_font_container_data,  $desc_font_container_data, $atts, $icon_font_container_data ) {
        $styles = array();
        if ( ! empty( $font_container_data ) && isset( $font_container_data['values'] ) ) {
            foreach ( $font_container_data['values'] as $key => $value ) {
                if ( 'tag' !== $key && 'text_align' !== $key && strlen( $value ) ) {
                    if ( preg_match( '/description/', $key ) ) {
                        continue;
                    }
                    if ( 'font_size' === $key || 'line_height' === $key ) {
                        $value = preg_replace( '/\s+/', '', $value );
                    }
                    if ( 'font_size' === $key ) {
                        $pattern = '/^(\d*(?:\.\d+)?)\s*(px|\%|in|cm|mm|em|rem|ex|pt|pc|vw|vh|vmin|vmax)?$/';
                        // allowed metrics: http://www.w3schools.com/cssref/css_units.asp
                        $regexr = preg_match( $pattern, $value, $matches );
                        $value = isset( $matches[1] ) ? (float) $matches[1] : (float) $value;
                        $unit = isset( $matches[2] ) ? $matches[2] : 'px';
                        $value = $value . $unit;
                    }
                    if ( strlen( $value ) > 0 ) {
                        $styles[] = str_replace( '_', '-', $key ) . ': ' . $value;
                    }
                }
            }
        }
        if ( ( ! isset( $atts['use_theme_fonts'] ) || 'yes' !== $atts['use_theme_fonts'] ) && ! empty( $google_fonts_data ) && isset( $google_fonts_data['values'], $google_fonts_data['values']['font_family'], $google_fonts_data['values']['font_style'] ) ) {
            $google_fonts_family = explode( ':', $google_fonts_data['values']['font_family'] );
            $styles[] = 'font-family:' . $google_fonts_family[0];
            $google_fonts_styles = explode( ':', $google_fonts_data['values']['font_style'] );
            $styles[] = 'font-weight:' . $google_fonts_styles[1];
            $styles[] = 'font-style:' . $google_fonts_styles[2];
        }
        /* Sub Heading */
        $st_styles = array();
        if ( ! empty( $st_font_container_data ) && isset( $st_font_container_data['values'] ) ) {
            foreach ( $st_font_container_data['values'] as $key => $value ) {
                if ( 'tag' !== $key && 'text_align' !== $key && strlen( $value ) ) {
                    if ( preg_match( '/description/', $key ) ) {
                        continue;
                    }
                    if ( 'font_size' === $key || 'line_height' === $key ) {
                        $value = preg_replace( '/\s+/', '', $value );
                    }
                    if ( 'font_size' === $key ) {
                        $pattern = '/^(\d*(?:\.\d+)?)\s*(px|\%|in|cm|mm|em|rem|ex|pt|pc|vw|vh|vmin|vmax)?$/';
                        // allowed metrics: http://www.w3schools.com/cssref/css_units.asp
                        $regexr = preg_match( $pattern, $value, $matches );
                        $value = isset( $matches[1] ) ? (float) $matches[1] : (float) $value;
                        $unit = isset( $matches[2] ) ? $matches[2] : 'px';
                        $value = $value . $unit;
                    }
                    if ( strlen( $value ) > 0 ) {
                        $st_styles[] = str_replace( '_', '-', $key ) . ': ' . $value;
                    }
                }
            }
        }
        if ( ( ! isset( $atts['st_use_theme_fonts'] ) || 'yes' !== $atts['st_use_theme_fonts'] ) && ! empty( $st_google_fonts_data ) && isset( $st_google_fonts_data['values'], $st_google_fonts_data['values']['font_family'], $st_google_fonts_data['values']['font_style'] ) ) {
            $st_google_fonts_family = explode( ':', $st_google_fonts_data['values']['font_family'] );
            $st_styles[] = 'font-family:' . $st_google_fonts_family[0];
            $st_google_fonts_styles = explode( ':', $st_google_fonts_data['values']['font_style'] );
            $st_styles[] = 'font-weight:' . $st_google_fonts_styles[1];
            $st_styles[] = 'font-style:' . $st_google_fonts_styles[2];
        }
        /* Description */
        $desc_styles = array();
        if ( ! empty( $desc_font_container_data ) && isset( $desc_font_container_data['values'] ) ) {
            foreach ( $desc_font_container_data['values'] as $key => $value ) {
                if ( 'tag' !== $key && 'text_align' !== $key && strlen( $value ) ) {
                    if ( preg_match( '/description/', $key ) ) {
                        continue;
                    }
                    if ( 'font_size' === $key || 'line_height' === $key ) {
                        $value = preg_replace( '/\s+/', '', $value );
                    }
                    if ( 'font_size' === $key ) {
                        $pattern = '/^(\d*(?:\.\d+)?)\s*(px|\%|in|cm|mm|em|rem|ex|pt|pc|vw|vh|vmin|vmax)?$/';
                        // allowed metrics: http://www.w3schools.com/cssref/css_units.asp
                        $regexr = preg_match( $pattern, $value, $matches );
                        $value = isset( $matches[1] ) ? (float) $matches[1] : (float) $value;
                        $unit = isset( $matches[2] ) ? $matches[2] : 'px';
                        $value = $value . $unit;
                    }
                    if ( strlen( $value ) > 0 ) {
                        $desc_styles[] = str_replace( '_', '-', $key ) . ': ' . $value;
                    }
                }
            }
        }
        /* Icon */
        $icon_styles = array();
        if ( ! empty( $icon_font_container_data ) && isset( $icon_font_container_data['values'] ) ) {
            foreach ( $icon_font_container_data['values'] as $key => $value ) {
                if ( 'tag' !== $key && 'text_align' !== $key  && strlen( $value ) ) {
                    if ( preg_match( '/description/', $key ) ) {
                        continue;
                    }
                    if ( 'font_size' === $key  ) {
                        $value = preg_replace( '/\s+/', '', $value );
                    }
                    if ( 'font_size' === $key ) {
                        $pattern = '/^(\d*(?:\.\d+)?)\s*(px|\%|in|cm|mm|em|rem|ex|pt|pc|vw|vh|vmin|vmax)?$/';
                        // allowed metrics: http://www.w3schools.com/cssref/css_units.asp
                        $regexr = preg_match( $pattern, $value, $matches );
                        $value = isset( $matches[1] ) ? (float) $matches[1] : (float) $value;
                        $unit = isset( $matches[2] ) ? $matches[2] : 'px';
                        $value = $value . $unit;
                    }
                    if ( strlen( $value ) > 0 ) {
                        $icon_styles[] = str_replace( '_', '-', $key ) . ': ' . $value;
                    }
                }
            }
        }

        /**
         * Filter 'VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG' to change vc_custom_heading class
         *
         * @param string - filter_name
         * @param string - element_class
         * @param string - shortcode_name
         * @param array - shortcode_attributes
         *
         * @since 4.3
         */
        $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'red-heading ' . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

        return array(
            'css_class'   => trim( preg_replace( '/\s+/', ' ', $css_class ) ),
            'styles'      => $styles,
            'st_styles'   => $st_styles,
            'desc_styles' => $desc_styles,
            'icon_styles' => $icon_styles,
        );
    }
}
