<?php 
$title1 = $title2 = $desc = $el_class = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = '';
$classes=array('red-volunteer-box');
if(!empty($atts['css'])){
    $classes[]=vc_shortcode_custom_css_class($atts['css']);
}

$classes[] = $el_class;

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $classes ) ), $this->settings['base'], $atts ) );

$values = (array) vc_param_group_parse_atts( $atts['values'] );

if (!empty($image)) {
    $attachment_image = wp_get_attachment_image_src($image, 'full');
    $image_url = $attachment_image[0];
}

 
if(!empty($image_url))
    $bg_style  = 'style="background-image:url('.esc_url($image_url).'); background-size: cover; background-position: center;"';

if(!empty($background_color))
    $bg_overlay='style="background-color:'.$background_color.';"';

$link = (isset($link)) ? $link : '';
$link = vc_build_link( $link );
$use_link = false;
if ( strlen( $link['url'] ) > 0 ) {
    $use_link = true;
    $a_href = $link['url'];
    $a_title = !empty($link['title'])?$link['title']: esc_html__('Join Now','givingwalk');
    $a_target = strlen( $link['target'] ) > 0 ? $link['target'] : '_self';
}
?>

<div class="<?php echo esc_attr($css_class);?>" <?php echo wp_kses_post($bg_style);?>> 
    <div class="bg-overlay" <?php echo wp_kses_post($bg_overlay);?>></div>
    <div class="box-inner">
        <?php
        echo !empty($title1) ? '<span class="title1">'.esc_html($title1).'</span>': '';
        echo !empty($title2) ? '<span class="title2">'.esc_html($title2).'</span>': ''; 
        echo !empty($desc) ? '<p class="desc">'.esc_html($desc).'</p>': '';   
        if( count($values)>0 ){ 
            echo '<ul class="feature-items">';
            foreach($values as $value){
                if(!empty($value['content_item'])){
                    echo '<li>'.$value['content_item'].'</li>';
                }
            }
            echo '</ul>';
        }
        if($use_link)
        echo '<a class="btn btn-white-alt" href="'.$a_href.'" target="'.$a_target.'">'.esc_html( $a_title ).'</a>';
        ?>
    </div>
</div>