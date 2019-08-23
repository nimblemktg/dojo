<?php
    $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
    extract( $atts );
    /* get value for Design Tab */
    $css_classes = array(
        vc_shortcode_custom_css_class( $css ),
    );

    $css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );

    $a_title = $btn_text;
    $btn_style = $a_href = $a_target = $icon  = '';
    $btn_open = '<span class="'.esc_attr($btn_type.' '.$btn_size.' '.$css_class.' red-scroll').'" href="'.esc_url( $a_href ).'" title="'. esc_attr( $a_title ).'" target="'.trim( esc_attr( $a_target ) ).'" '.esc_attr($btn_style).'>';
    $btn_close = '</span>';
    /* parse button_link */
    if(!empty($button_link)){
        $button_link = vc_build_link( $button_link);
        $button_link = ( $button_link == '||' ) ? '' : $button_link;  
        if ( strlen( $button_link['url'] ) > 0 ) {
            $a_href = $button_link['url'];
            $a_title = !empty($button_link['title']) ? $button_link['title'] : $btn_text;
            $a_target = strlen( $button_link['target'] ) > 0 ? $button_link['target'] : '_self';

            $btn_open = '<a class="'.esc_attr($btn_type.' '.$btn_size.' '.$css_class.' red-scroll').'" href="'.esc_url( $a_href ).'" title="'. esc_attr( $a_title ).'" target="'.trim( esc_attr( $a_target ) ).'" '.esc_attr($btn_style).'>';
            $btn_close = '</a>';
        }
    }
    if($add_icon){
        vc_icon_element_fonts_enqueue( $i_type );
        $icon_name = 'i_icon_' . $i_type ; /* get icon class */
        $icon_default = is_rtl() ? 'ion-android-arrow-back' : 'ion-android-arrow-forward';
        $iconClass = (isset($atts[$icon_name]) && !empty($atts[$icon_name])) ? $atts[$icon_name] : $icon_default;
        if(!empty($iconClass)) {
            $btn_type .= ' icon-'.$icon_position;
            if($icon_position === 'left') $icon = '<i class="btn-icon '.$iconClass.' '.$btn_icon_style.'"></i>&nbsp;&nbsp;&nbsp;';
            if($icon_position === 'right') $icon = '&nbsp;&nbsp;&nbsp;<i class="btn-icon '.$iconClass.' '.$btn_icon_style.'"></i>';
        } else {
            $btn_type .= ' empty-icon';
        }
    }
    $wrapper_attributes[] = 'class="red-button-wrapper '.esc_attr($btn_align.' '.$btn_block).'"';
?>
<?php if(!empty($a_title)) { ?>
    <div <?php echo implode( ' ', $wrapper_attributes ); ?>>
        <?php 
            echo wp_kses_post($btn_open);
            switch ($icon_position) {
                case 'right':
            ?>
                <span><?php echo esc_attr( $a_title );?></span><?php echo wp_kses_post($icon); ?>
            <?php   
                break;
                default:
            ?>
                <?php echo wp_kses_post($icon); ?><span><?php echo esc_attr( $a_title );?></span>
            <?php
                break;
            }
            echo wp_kses_post($btn_close); 
        ?>
    </div>
<?php } ?>