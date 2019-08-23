<?php

    $el_title = $values = $el_mode = $color_mode = $shape_mode = $a_href = $a_title = $link_open = $link_close = $icon_title = '';
    $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
    extract( $atts );
    $values = (array) vc_param_group_parse_atts( $values );
    if(is_rtl()){
        $el_mode .= ' rtl';
    }
    $wrap_classes = array();
    $wrap_classes[] = 'red-social red-el-social';
    $wrap_classes[] = $el_mode;
    $wrap_classes[] = $el_content_align;
    $wrap_classes[] = $el_icon_size;
    $wrap_classes[] = $color_mode;
    $wrap_classes[] = $shape_mode;
    
?>
<div class="<?php echo join(' ', $wrap_classes); ?>">
    <?php if($el_title) echo '<div class="title">'.esc_attr($el_title).'</div>'; ?>

    <?php
        switch ($source) {
            case 'custom':
                foreach($values as $value){
                    vc_icon_element_fonts_enqueue( $value['i_type'] );  /* Call icon font libs */
                    $iconClass = isset($value['i_icon_'. $value['i_type']]) ? $value['i_icon_'. $value['i_type']] : '';     /* get icon class */           
                    if (isset($value['icon_link'])){  
                        $link = vc_build_link($value['icon_link']);
                        $link = ( $link == '||' ) ? '' : $link;
                        if ( strlen( $link['url'] ) > 0 ) {
                            $a_href = $link['url'];
                            $a_title = isset($link['title']) ? $link['title'] : esc_html__('Follow Us','givingwalk');
                            $a_target = strlen( $link['target'] ) > 0 ? str_replace(' ', '', $link['target']) : '_self';
                            /* get link class */
                            $info = givingwalk_parse_url_all($link['url']);
                            $icon_class = $info['domain_name'];
                            if($info['domain_name'] == 'google') {
                                $icon_class = 'googleplus';
                            } elseif ($info['domain_name'] == 'skype') {
                                $a_href = 'skype:'.$info['domain_ext'].'?chat';
                            }
                            $link_open = '<a title="'.esc_attr($a_title).'" data-toggle="tooltip" class="swatch-'.esc_attr($icon_class.' '.$icon_class).'" href="'.$a_href.'" target="'.esc_attr($a_target).'">';
                            $link_close = '</a>';
                        }
                    }
                    
                    if($iconClass) {
                        echo ''.$link_open; 
                        echo '<i class="'.esc_attr($iconClass).'"></i>'.$icon_title;
                        echo wp_kses_post($link_close); 
                    }
                }
                break;
             
            default:
                givingwalk_social_list();
                break;
         } 
        
    ?>
</div>


