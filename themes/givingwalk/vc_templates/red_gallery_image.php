<?php 
    $images_arr = array();
    //$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
    extract( $atts );
    
    if(!empty($atts['images'])) 
        $images_arr = explode( ',', $atts['images'] );
   
    $classes=array('red-gal-image');
    $css_class = '';
    if(!empty($atts['css'])){
        $classes[]=vc_shortcode_custom_css_class($atts['css']);
    }
    $css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $classes ) ), $this->settings['base'], $atts ) );
    /* Image Size */
    $custom_size = false;
    if ($thumbnail_size === 'custom'){ 
        $custom_size = true;
        $thumbnail_size = $thumbnail_size_custom;
    }
?>
<div class="<?php echo esc_attr($css_class);?>" id="<?php echo esc_attr($html_id);?>">
     
    <div class="row red-gallery-popup">
         
        <?php
        foreach ( $images_arr as $i => $image ) {
            if ( $image > 0 ) {
                $img = wpb_getImageBySize( array(
                    'attach_id' => $image,
                    'thumb_size' => $thumbnail_size,
                    'class' => 'gal-image',
                ));

                $thumbnail = $img['thumbnail'];

				$large_img = wp_get_attachment_image_src($image, 'full'); 
                $image_large_src = $large_img[0]; 
                ?>
                <div class="<?php echo esc_attr($atts['item_class']);?>">
                    <a class="magic-popups" href="<?php echo esc_url($image_large_src); ?>" >
                        <?php echo wp_kses_post($thumbnail); ?>
                    </a> 
                </div>
                <?php 
			} 
        }
        ?>
    </div>
    
</div>