<?php 
$background_color = $title = $top_overlap_cls = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = '';
$classes=array('contact-box-info');
if(!empty($atts['css'])){
    $classes[]=vc_shortcode_custom_css_class($atts['css']);
}
$classes[] = $el_class;
$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $classes ) ), $this->settings['base'], $atts ) );

$values = (array) vc_param_group_parse_atts( $atts['values'] );
$socials = (array) vc_param_group_parse_atts( $atts['socials'] );

$bg_style='#111111';
if(!empty($background_color))
    $bg_style='style="background-color:'.$background_color.';"';

$top_overlap_cls = (isset($top_overlap) && $top_overlap == '1') ? 'top-overlap' : ''; 

?>

<div class="<?php echo esc_attr($css_class);?> <?php echo esc_attr($top_overlap_cls);?>">
    <div class="box-inner clearfix" <?php echo wp_kses_post($bg_style);?>>
        <?php
        echo !empty($title) ? '<span class="silent-heading">'.esc_html($title).'</span>': '';
          
        if( count($values)>0 ){ 
            echo '<ul class="contact-info">';
            foreach($values as $value){
                if(!empty($value['content_item'])){
                    if(!empty($value['icon_class']))
                        echo '<li><i class="'.$value['icon_class'].'"></i>'.$value['content_item'].'</li>';
                    else    
                        echo '<li>'.$value['content_item'].'</li>';
                }
            }
            echo '</ul>';
        }
        if( count($socials)>0 ){ 
            echo '<div class="red-social circle small clearfix">';
            foreach($socials as $social){
                if(!empty($social['social_icon_class']) && !empty($social['social_link'])){
                    echo '<a href="'.$social['social_link'].'" target="_blank" ><i class="'.$social['social_icon_class'].'"></i></a>';
                }
            }
            echo '</div>';
        }
        ?>
    </div>
</div>