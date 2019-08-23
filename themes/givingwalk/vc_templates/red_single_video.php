<?php 
$image = $video_url = $bg_style = '';

if (!empty($atts['image'])) {
    $attachment_image = wp_get_attachment_image_src($atts['image'], 'full');
    $image_url = $attachment_image[0];
    $bg_style = 'style="background-image:url('.esc_url( $image_url ).'); background-size:cover;"';
}

$video_url = !empty($atts['video_url']) ? $atts['video_url'] : '';

$css_classes=array('red-single-video');
if(!empty($atts['css'])){
    $css_classes[]=vc_shortcode_custom_css_class($atts['css']);
}

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );

if(!empty($video_url)){
    echo '<div class="'.esc_attr($css_class).'" '. wp_kses_post($bg_style).'>';
        echo '<a href="'.esc_url( $video_url ).'" class="red_video red-video-popup play text-center"><i class="flaticon-play-button-1"></i></a>';       
    echo '</div>';
}