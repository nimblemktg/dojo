<?php 
    $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
    extract( $atts );

    $layout_mode = !empty($layout_mode) ? $layout_mode : 'layout-1';
    
    $css_class = '';
    $classes = array();
    if(!empty($atts['css'])){
        $classes[]=vc_shortcode_custom_css_class($atts['css']);
    }
    $css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $classes ) ), $this->settings['base'], $atts ) );
    $col_cls = $layout_mode == 'layout-1' ? 'col-auto': 'col-sm-6 col-lg-auto';
?>
<div class="red-counter-wraper <?php echo esc_attr($content_align. ' '.$layout_mode.' '.$class.' '.$content_color); ?> <?php echo esc_attr($css_class);?>">
    <div class="row align-items-center justify-content-between">
        <?php
            $number_items = (int)$atts['number_items'];
            $item_class = 'counter-item '.$col_cls;
            for($i=1;$i<=$number_items;$i++) { ?>
                    <?php
                        $title      = isset($atts['title'.$i]) ? $atts['title'.$i] : '';
                        $desc       = isset($atts['desc'.$i]) ? $atts['desc'.$i] : '';
                        $i_type     = isset($atts['i'.$i.'_type']) ? $atts['i'.$i.'_type'] : '';
                        $add_icon   = isset($atts['add_icon'.$i]) ? $atts['add_icon'.$i] : '';
                        $icon       = isset($atts['i'.$i.'_icon_'.$i_type]) ? $atts['i'.$i.'_icon_'.$i_type] : '';
                        $icon_color = isset($atts['icon'.$i.'_color']) ? $atts['icon'.$i.'_color'] : '';
                        $suffix     = isset($atts['suffix'.$i]) ? $atts['suffix'.$i] : '';
                        $prefix     = isset($atts['prefix'.$i]) ? $atts['prefix'.$i] : '';
                        $digit      = isset($atts['digit'.$i]) ? $atts['digit'.$i] : '';
                        $image_url  = '';
                        if (!empty($atts['image'])) {
                            
                        }
                        if( !empty($atts['icon_image_'.$i])){
                            $attachment_image = wp_get_attachment_image_src($atts['icon_image_'.$i], 'full');
                            $image_url = $attachment_image[0];
                        }
                        
                    if(!empty($title) || !empty($desc) || !empty($add_icon) || !empty($suffix) || !empty($prefix) || !empty($digit)) {
                        /* call icon font css */
                        vc_icon_element_fonts_enqueue($i_type);
                        ?>
                        <div class="<?php echo esc_attr($item_class);?>">
                            <?php if( $icon ): ?>
            					<span class="counter-icon"><i class="<?php echo esc_attr($icon); ?>" style="color:<?php echo esc_attr($icon_color);?>"></i></span>
            				<?php endif; ?>
                            <?php if( !empty($image_url) ): ?>
                                <span class="counter-icon"><img src="<?php echo esc_url($image_url);?>"></span>
                            <?php endif; ?>
                            <?php if($layout_mode == 'layout-2') echo '<div class="content-right">'; ?>
            				<div class="counter-number" data-prefix="<?php echo esc_attr($prefix);?>" data-suffix="<?php echo esc_attr($suffix);?>" data-type="<?php echo esc_attr($counter_type);?>" data-digit="<?php echo esc_attr($digit);?>">
                                <?php if(!empty($prefix)) echo '<span class="prefix">'.esc_html($prefix).'</span>'; ?>
                                <?php echo '<span class="red-counter number">'.esc_html($digit).'</span>'; ?>
                                <?php if(!empty($suffix)) echo '<span class="suffix">'.esc_html($suffix).'</span>'; ?>
            				</div>
                            <?php if($title):?>
                                <span class="counter-title"><?php echo esc_html($title);?></span>
                            <?php endif;?>
                            <?php if($desc):?>
                                <div class="counter-desc"><?php echo esc_html($desc);?></div>
                            <?php endif;?>
                            <?php if($layout_mode == 'layout-2') echo '</div>'; ?>
            			</div>
                <?php }
            }
        ?>
    </div>
</div>