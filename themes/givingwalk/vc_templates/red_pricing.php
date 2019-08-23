<?php
    $el_price = $el_price_currency = $el_title = $layout_mode = $add_image = $image = $img_pos = $button_link = $values = $a_href = $a_title = $link_open = $link_close = $feature_text = '';
    $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
    extract( $atts );
    /* parse button_link */
    if(!empty($button_link)){
        $button_link = vc_build_link( $button_link);
        $button_link = ( $button_link == '||' ) ? '' : $button_link; 
        $btn = $btn_class = '';
        if ( strlen( $button_link['url'] ) > 0 ) {
            $a_href = $button_link['url'];
            $a_title = $button_link['title'] ? $button_link['title'] :  esc_html__('Get Started','givingwalk');
            $a_target = strlen( $button_link['target'] ) > 0 ? $button_link['target'] : '_self';

            $btn = '<a class="btn" href="'.esc_url($a_href).'" title="'.esc_html($a_title).'" target="'.esc_html($a_target).'">'.esc_html($a_title).'</a>';
        }
    }
    /* get social */
    $values = (array) vc_param_group_parse_atts( $values );
    /* RTL language */
    $dir = '';
    if(is_rtl()){
        $dir = ' rtl';
    }
    /* Image Size */
    if($image){
        if ($thumbnail_size === 'custom') $thumbnail_size = $thumbnail_size_custom;
        $img = wpb_getImageBySize( array(
            'attach_id'  => $image,
            'thumb_size' => $thumbnail_size,
            'class'      => 'red-pricing-img',
        ));
        $thumbnail = $img['thumbnail'];
        $image_url = wp_get_attachment_url($image);
    }
    /* featured list class */
    $featured_cls = $feature_space ? 'large' : '';
    /* get value for Design Tab */
    $css_classes = array(
        vc_shortcode_custom_css_class( $css ),
    );
    $css_class = array();
    $css_class[] = 'img-'.$img_pos;
    $css_class[] = $dir;
    $css_class[] = 'layout'.$layout_mode;
    $css_class[] = $content_align;
    $css_class[] = $layout_type;
    $css_class[] = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
?>
<div class="red-pricing <?php echo join(' ',$css_class); ?>">
    <?php if(!empty($image)) : ?>
        <div class="pricing-img <?php echo esc_attr('img-'.$img_pos); ?>">
            <?php 
                echo  wp_kses_post($thumbnail);
            ?>
        </div>
    <?php endif; 
        if(!empty($el_title) || !empty($el_price)) {
    ?>
    <div class="el-header pricing-header">
    <?php 
        /* EL Title */
        if(!empty($el_title)) echo '<h3 class="el-title pricing-title">'.esc_html($el_title).'</h3>';
        /* EL Price */
        if(!empty($el_price)) echo '<div class="pricing-price h1"><span class="currency">'.esc_html($el_price_currency).'</span><span class="price">'.esc_html($el_price).'</span><span class="plan">'.esc_html($el_price_plan).'</span></div>';
    ?>
    </div>
    <?php
       }
    if(!empty($values)) {
    ?>
    <div class="pricing-content">
        <div class="feature-list <?php echo esc_attr($featured_cls); ?>">
        <?php 
            foreach($values as $value){
                vc_icon_element_fonts_enqueue( $value['i_type'] );  /* Call icon font libs */
                $iconClass = isset($value['i_icon_'. $value['i_type']]) ? '<i class="'.$value['i_icon_'. $value['i_type']].'">&nbsp;&nbsp;</i>' : '';     
                /* get icon class */
                $has_icon = !empty($iconClass) ? 'has-icon' : 'no-icon';
                if (isset($value['feature_text'])){  
                  echo '<div class="'.esc_attr($has_icon).'">'.wp_kses_post($iconClass) . esc_html($value['feature_text']).'</div>';
                }
            }
        ?>
        </div>
    </div>
    <?php }
        if(!empty($btn))  echo '<footer class="pricing-footer">'.wp_kses_post($btn).'</footer>'; 
    ?>
</div>

    



