<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}
extract(shortcode_atts(array(
    'text_align'          => '',
    'layout_mode'         => 'default',
    'letter_spacing'      => '',
    'st_letter_spacing'   => '',
    'desc_letter_spacing' => '',
    'css_heading'         => '',  
    'css_subheading'      => '',
    'css_desc'            => '',  
    'btn_type'            => 'btn',
    'button_link'         => ''

), $atts));

/**
 * Shortcode attributes
 * @var $atts
 * @var $source
 * @var $text
 * @var $link
 * @var $google_fonts
 * @var $font_container
 * @var $el_class
 * @var $css
 * @var $css_animation
 * @var $font_container_data - returned from $this->getAttributes
 * @var $google_fonts_data - returned from $this->getAttributes
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Custom_heading
 */

$text = vc_map_get_attributes( $this->getShortcode(), $atts );
/* Heading */
$text_part = (array) vc_param_group_parse_atts( $text['text'] );
$st_text_part = (array) vc_param_group_parse_atts( $text['st_text'] );

if(empty($text_part) && empty($st_text_part) && empty($desc_text) ){
    echo '<p class="require required">'.esc_html__('Please add a text!','givingwalk').'</p>';
    return;
}
$text_content = '';
foreach($text_part as $value){
    if(isset($value['text_part']) && !empty($value['text_part'])){
        $_text_part_color = isset($value['text_part_color']) ? $value['text_part_color'] : '';
        $text_part_color = isset($value['text_part_color_custom']) && !empty($value['text_part_color_custom']) ? 'style="color:'.$value['text_part_color_custom'].'"' : '';
        $item_style ='';
        if(!empty($value['item_font_size'])){
            if(strpos($value['item_font_size'],'px') == false) $value['item_font_size'].='px';
            $item_style = 'style="font-size:'.$value['item_font_size'].';"';
        } 
        $text_content .=  '<span class="'.esc_attr($value['text_part_style'].' '.$_text_part_color).'" '.$text_part_color.' '.wp_kses_post($item_style).'>'.esc_html($value['text_part']).'</span> ';
    }
}
/* Subheading */
$st_text_content = '';
foreach($st_text_part as $value){
    if(isset($value['sttext_part']) && !empty($value['sttext_part'])){
        $_st_text_part_color = isset($value['sttext_part_color']) ? $value['sttext_part_color'] : '';
        $st_text_part_color = isset($value['sttext_part_color_custom']) && !empty($value['sttext_part_color_custom']) ? 'style="color:'.$value['sttext_part_color_custom'].'"' : '';
        $st_text_content .=  '<span class="'.esc_html($value['sttext_part_style'].' '.$_st_text_part_color).'" '. $st_text_part_color.'>'.esc_html($value['sttext_part']).'</span> ';
    }
}

/* CSS */
$css_heading_cls =  trim(preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'heading ' . vc_shortcode_custom_css_class( $css_heading, ' ' ), $this->settings['base'], $atts ) ) ) ;

$css_subheading_cls =  trim(preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'sub-heading ' . vc_shortcode_custom_css_class( $css_subheading, ' ' ), $this->settings['base'], $atts ) ) ) ;

$css_desc_cls =  trim(preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'desccription ' . vc_shortcode_custom_css_class( $css_desc, ' ' ), $this->settings['base'], $atts ) ) ) ;

$source = $text = $link = $google_fonts = $font_container = $st_google_fonts = $st_font_container = $desc_font_container = $el_class = $css = $css_animation = $font_container_data = $google_fonts_data = $st_font_container_data = $st_google_fonts_data = $add_image = $image = $_image = $heading_wrap_open = $heading_wrap_close = $add_icon = $icon = $icon_font_container_data = '';
// This is needed to extract $font_container_data and $google_fonts_data
extract( $this->getAttributes( $atts ) );

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
// Enqueue needed icon font.
vc_icon_element_fonts_enqueue( $i_type );
/* Icon */
$icon_name = "icon_" . $i_type;
$iconClass = isset($atts[$icon_name]) ? $atts[$icon_name]: '';

/**
 * @var $css_class
 */
extract( $this->getStyles( $el_class . $this->getCSSAnimation( $css_animation ), $css, $google_fonts_data, $font_container_data, $st_google_fonts_data, $st_font_container_data, $desc_font_container_data, $atts, $icon_font_container_data ) );

$settings = get_option( 'wpb_js_google_fonts_subsets' );
if ( is_array( $settings ) && ! empty( $settings ) ) {
    $subsets = '&subset=' . implode( ',', $settings );
} else {
    $subsets = '';
}

if ( ( ! isset( $atts['use_theme_fonts'] ) || 'yes' !== $atts['use_theme_fonts'] ) && isset( $google_fonts_data['values']['font_family'] ) ) {
    wp_enqueue_style( 'vc_google_fonts_' . vc_build_safe_css_class( $google_fonts_data['values']['font_family'] ), '//fonts.googleapis.com/css?family=' . $google_fonts_data['values']['font_family'] . $subsets );
}


/* sub heading */
if ( ( ! isset( $atts['st_use_theme_fonts'] ) || 'yes' !== $atts['st_use_theme_fonts'] ) && isset( $st_google_fonts_data['values']['font_family'] ) ) {
    wp_enqueue_style( 'vc_google_fonts_' . vc_build_safe_css_class( $st_google_fonts_data['values']['font_family'] ), '//fonts.googleapis.com/css?family=' . $st_google_fonts_data['values']['font_family'] . $subsets );
}

$css_class .= ' layout-'.$layout_mode;

if(!empty($text_align)) $css_class .= ' text-'.$text_align;
if(!empty($letter_spacing)){
    $styles[] = 'letter-spacing:'.$letter_spacing;
}
if ( ! empty( $styles ) ) {
    $style = 'style="' . esc_attr( implode( ';', $styles ) ) . '"';
} else {
    $style = '';
}
/* Image */
if($add_image && !empty($image)){
    $css_class .= ' has-image row';
    $_image = '<div class="image-wrap col-sm-12 col-md-auto text-sm-center">'.wp_get_attachment_image($image, 'thumbnail').'</div>';
    $heading_wrap_open = '<div class="heading-wrap col">';
    $heading_wrap_close = '</div>';
}
/* Icon */
if($add_icon && !empty($iconClass)){
    if ( ! empty( $icon_styles ) ) {
        $icon_style = 'style="' . esc_attr( implode( ';', $icon_styles ) ) . '"';
    } else {
        $icon_style = '';
    }
    $icon = '<span class="heading-icon '.$iconClass.'" '.$icon_style.'>&nbsp;</span>';
}
/* Sub Title */
if(!empty($st_letter_spacing)){
    //$st_letter_spacing = $st_letter_spacing/1000;
    $st_styles[] = 'letter-spacing:'.$st_letter_spacing;
}
if ( ! empty( $st_styles ) ) {
    $st_style = 'style="' . esc_attr( implode( ';', $st_styles ) ) . '"';
} else {
    $st_style = '';
}
/* Description */
if(!empty($desc_letter_spacing)){
    //$desc_letter_spacing = $desc_letter_spacing/1000;
    $desc_styles[] = 'letter-spacing:'.$desc_letter_spacing;
}
if ( ! empty( $desc_styles ) ) {
    $desc_style = 'style="' . esc_attr( implode( ';', $desc_styles ) ) . '"';
} else {
    $desc_style = '';
}

/* Source */
if ( 'post_title' === $source ) {
    $text = get_the_title( get_the_ID());
}
$text_content = $icon. $text_content;

if ( ! empty( $link ) ) {
    $link = vc_build_link( $link );
    if(!empty($link['url']))
        $text_content = '<a href="' . esc_attr( $link['url'] ) . '"' . ( $link['target'] ? ' target="' . esc_attr( $link['target'] ) . '"' : '' ) . ( $link['rel'] ? ' rel="' . esc_attr( $link['rel'] ) . '"' : '' ) . ( $link['title'] ? ' title="' . esc_attr( $link['title'] ) . '"' : '' ) . $style . '>' . $text_content . '</a>';
}

/* Button */
$a_href = $a_title = $icon  = '';
/* parse button_link */
if(!empty($button_link)){
    $button_link = vc_build_link( $button_link);
    $button_link = ( $button_link == '||' ) ? '' : $button_link;  
    if ( strlen( $button_link['url'] ) > 0 ) {
        $a_href = $button_link['url'];
        $a_title = $button_link['title'];
        $a_target = strlen( $button_link['target'] ) > 0 ? $button_link['target'] : '_self';
    }
}

$output = $heading = $sub_heading = $desccription = $btn_html = '';
if(!empty($text_content)) $heading = '<' . $font_container_data['values']['tag'] . ' class="'.esc_attr($css_heading_cls).'" ' . $style . ' >'.$text_content.'</' . $font_container_data['values']['tag'] . '>';
if(!empty($st_text_content)) $sub_heading = '<' . $st_font_container_data['values']['tag'] . ' class="'.esc_attr($css_subheading_cls).'" ' . $st_style . ' >'.$st_text_content.'</' . $st_font_container_data['values']['tag'] . '>';

if(!empty($desc_text)) $desccription = '<' . $desc_font_container_data['values']['tag'] . ' class="'.esc_attr($css_desc_cls).'" ' . $desc_style . ' >'.$desc_text.'</' . $desc_font_container_data['values']['tag'] . '>';

if(!empty($button_link) && !empty($a_title)) { 
    $btn_html .= '<div class="heading-btn">
        <a class="'.esc_attr($btn_type).' cms-scroll" href="'.esc_url( $a_href ).'" title="'.esc_attr( $a_title ).'" target="'.trim( esc_attr( $a_target ) ).'">'.esc_attr( $a_title ).'</a></div>';
}

switch ($layout_mode) {
    case '1':
        $output .= '<div class="' . esc_attr( $css_class ) . '" >';
        $output .= $_image;
        $output .= $heading_wrap_open;
        $output .= $sub_heading;
        $output .= $heading;
        $output .= $desccription;
        $output .= $btn_html;
        $output .= $heading_wrap_close;
        $output .= '<span class="ver-icon"><span></span><span></span><span class="y2"></span><span></span><span></span></span>';
        $output .= '</div>';
    break;
    default:
        $output .= '<div class="' . esc_attr( $css_class ) . '" >';
        $output .= $_image;
        $output .= $heading_wrap_open;
        $output .= $heading;
        $output .= $sub_heading;
        $output .= $desccription;
        $output .= $btn_html;
        $output .= $heading_wrap_close;
        $output .= '</div>';
    break;
}
    
       
echo wp_kses_post($output);
