<?php 

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = '';
$classes=array('involved-donation-wrap');
if(!empty($atts['css'])){
    $classes[]=vc_shortcode_custom_css_class($atts['css']);
}

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $classes ) ), $this->settings['base'], $atts ) );

$col_cls = '';
$bool_row = false;
if( (!empty($involved_title1) || !empty($involved_title2) || !empty($involved_title3)) && ( !empty($donation_title1) || !empty($donation_title2) || !empty($donation_title3) )){
    $col_cls = 'col-md-6';
    $bool_row = true;
}

$i_use_link = false;
$d_use_link = false;
if(!empty($involved_button_link)){
    $i_button_link = vc_build_link( $involved_button_link );
    $i_button_link = ( $i_button_link == '||' ) ? '' : $i_button_link;
    if ( strlen( $i_button_link['url'] ) > 0 ) {
        $i_use_link = true; 
        $i_a_href = $i_button_link['url'];
        $i_a_title = strlen($i_button_link['title']) > 0 ? $i_button_link['title'] : esc_html__('Get Involved','givingwalk') ;
        $i_a_target = strlen( $i_button_link['target'] ) > 0 ? $i_button_link['target'] : '_self';
    }
}
if(!empty($donation_button_link)){
    $d_button_link = vc_build_link( $donation_button_link );
    $d_button_link = ( $d_button_link == '||' ) ? '' : $d_button_link;
    if ( strlen( $d_button_link['url'] ) > 0 ) {
        $d_use_link = true; 
        $d_a_href = $d_button_link['url'];
        $d_a_title = strlen($d_button_link['title']) > 0 ? $d_button_link['title'] : esc_html__('Get Involved','givingwalk') ;
        $d_a_target = strlen( $d_button_link['target'] ) > 0 ? $d_button_link['target'] : '_self';
    }
}

$i_title1_css = $i_title3_css = $d_title1_css = $d_title3_css = $b_right_css = array();
if(!empty($involved_title_1_color)){
    $i_title1_css[] ='color:'.$involved_title_1_color;
}
if(!empty($involved_title_3_color)){
    $i_title3_css[] ='color:'.$involved_title_3_color;
}
if(!empty($donation_title_1_color)){
    $d_title1_css[] ='color:'.$donation_title_1_color;
}
if(!empty($donation_title_3_color)){
    $d_title3_css[] ='color:'.$donation_title_3_color;
}

if(!empty($border_right_color)){
    $b_right_css[] ='border-color:'.$border_right_color;
}


?>

<div class="<?php echo esc_attr($css_class);?>">
    <?php if( $bool_row) echo '<div class="row">'; ?>
    <?php if(!empty($involved_title1) || !empty($involved_title2) || !empty($involved_title3)): ?>
        <div class="involved-block <?php echo esc_attr($col_cls);?>" style="<?php echo join(';',$b_right_css); ?>">
            <?php 

            if(!empty($involved_title1)){
                echo '<span class="title1" style="'. join(';',$i_title1_css) .'">'.esc_html($involved_title1).'</span>';
            }
            if(!empty($involved_title2)){
                echo '<span class="title2">'.esc_html($involved_title2).'</span>';
            }
            if(!empty($involved_title3)){
                echo '<span class="title3" style="'. join(';',$i_title3_css) .'">'.esc_html($involved_title3).'</span>';
            }
            if($i_use_link)
                echo '<a class="btn btn-default btn-alt" href="'.esc_url($i_a_href).'" title="'.esc_attr( $i_a_title ).'" target="'.esc_attr($i_a_target).'">'.esc_html($i_a_title).'</a>';
             
            ?>
        </div>
    <?php endif; ?>
    <?php if( !empty($donation_title1) || !empty($donation_title2) || !empty($donation_title3) ): ?>
        <div class="donation-block <?php echo esc_attr($col_cls);?>">
            <?php 
            if(!empty($donation_title1)){
                echo '<span class="title1" style="'. join(';',$d_title1_css) .'">'.esc_html($donation_title1).'</span>';
            }
            if(!empty($donation_title2)){
                echo '<span class="title2">'.esc_html($donation_title2).'</span>';
            }
            if(!empty($donation_title3)){
                echo '<span class="title3" style="'. join(';',$d_title3_css) .'">'.esc_html($donation_title3).'</span>';
            }
            if($d_use_link)
                echo '<a class="btn btn-default btn-alt" href="'.esc_url($d_a_href).'" title="'.esc_attr( $d_a_title ).'" target="'.esc_attr($d_a_target).'">'.esc_html($d_a_title).'</a>';
            ?>
        </div>
    <?php endif; ?>
    <?php if($bool_row) echo '</div>'; ?>
</div>