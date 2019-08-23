<?php
    wp_enqueue_style('animate-css');
    $el_title = $values = $el_mode = $color_mode = $title = $desc = $img_id = $img_pos = $a_href = $a_title = $link_open = $link_close = $icon_title = $show_link = '';
    $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
    extract( $atts );
    $values = (array) vc_param_group_parse_atts( $values );
    $arrow = 'right';
    if(is_rtl()){
        $el_mode .= ' rtl';
        $arrow = 'left';
    }
    $default_avatar = get_template_directory_uri().'/assets/images/avatar.png';
    $wrap_class = array();
    $wrap_class[] = 'red-process-wrap red-owl-wrap';
    $wrap_class[] = $content_align;
    $wrap_class[] = $color_mode;
    $wrap_class[] = 'layout-'.$layout_mode;
    $wrap_class[] = $el_class;
    $wrap_class[] = 'red-process-'.$el_id;

    $html_id = 'red-process-'.$el_id;

    if($layout_mode === '1') $layout_mode .= ' row no-gutters';
    $btn_icon = is_rtl() ? '<i class="ion-android-arrow-back"></i>&nbsp;&nbsp;&nbsp;&nbsp;' : '&nbsp;&nbsp;&nbsp;&nbsp;<i class="ion-android-arrow-forward"></i>';
?>
<div class="<?php echo join(' ',$wrap_class);?>">
    <?php if($el_title) echo '<h3 class="title">'.esc_attr($el_title).'</h3>'; ?>
    <?php switch ($layout_type) {
        case 'carousel':
    ?>
        <?php if($dot_pos == '1') echo '<div class="dotContainerTop owl-dots row no-gutters align-items-center justify-content-center '.$dot_style.'"></div>'; ?>
        <div id="<?php echo esc_attr($html_id);?>" class="red-process red-carousel owl-carousel" >
            <?php 
                $count = 0;
                foreach($values as $value){
                    $count ++;
                    if($count < 10) $count = '0'.$count;
                    $title   = isset($value['p_title']) ? $value['p_title'] : '';
                    $desc    = isset($value['p_desc']) ? $value['p_desc'] : '';
                    $img_id  = isset($value['p_image']) ? $value['p_image'] : '';
                    $img_pos = isset($value['p_image_pos']) ? $value['p_image_pos'] : '';

                    $thumbnail = $image_url = '';
                    if(!empty($img_id)){
                        $img = wpb_getImageBySize( array(
                            'attach_id'  => $img_id,
                            'thumb_size' => '470x373',
                            'class'      => '',
                        ));
                        $thumbnail = $img['thumbnail'];
                        $image_url = wp_get_attachment_url($img_id);
                    }
                    if(!empty($img_id)) {
                        $dot_image = wp_get_attachment_image($img_id,array('100','100'),'',array('class'=>'avatar img-circle'));
                    } else {
                        $dot_image = '<img src="'.esc_url($default_avatar).'" class="avatar img-circle"/>';
                    }

                    vc_icon_element_fonts_enqueue( $value['i_type'] );  /* Call icon font libs */
                    $iconClass = isset($value['i_icon_'. $value['i_type']]) ? $value['i_icon_'. $value['i_type']] : '';     /* get icon class */           
                    if (isset($value['icon_link'])){  
                        $link = vc_build_link($value['icon_link']);
                        $link = ( $link == '||' ) ? '' : $link;
                        if ( strlen( $link['url'] ) > 0 ) {
                            $a_href = $link['url'];
                            $a_title = isset($link['title']) ? $link['title'] : '';
                            $a_target = strlen( $link['target'] ) > 0 ? str_replace(' ', '', $link['target']) : '_self';

                            $link_open = '<a class="overlay" href="'.esc_url($a_href).'" title="'.esc_attr($a_title).'" target="'.esc_attr($a_target).'"><span class="overlay-inner center-align">';
                            $link_close = '</span></a>';
                        }
                    }
                switch ($layout_mode) {
                        case '2':
                            $col_l = $col_r = 'col-md-12';
                            if(!empty($img_id)) $col_l = $col_r = 'col-md-6';
                            if($img_pos === 'top') 
                                $col_l .= ' order-md-0';
                            else 
                                $col_l .= ' order-md-1';
                    ?>
                        <div class="red-process-item overlay-wrap row layout-<?php echo esc_attr($layout_mode);?>">
                            <?php
                                if(!empty($img_id)) echo '<div class="red-process-img '.esc_attr($col_l).'">'.$thumbnail.$link_open.'<i class="'.esc_attr($iconClass).'"></i>'.$link_close.'</div>';
                                echo '<div class="red-process-content align-items-center row no-gutters '.esc_attr($col_r).'" data-count="'.esc_attr($count).'"><div class="inner">';
                                    if($title) echo '<h3 data-count="'.esc_attr($count).'">'.esc_html($title).'</h3>';
                                    if($desc) echo '<div class="desc">'.esc_html($desc).'</div>';
                                    if($show_link) echo '<footer class="p-footer"><a class="btn btn-alt" href="'.esc_url($a_href).'" title="'.esc_attr($a_title).'" target="'.esc_attr($a_target).'">'.$a_title.$btn_icon.'</a></footer>';
                                echo '</div></div>';
                            ?>
                        </div>
                    <?php
                        break;
                        default:
                    ?>
                        <div class="red-process-item overlay-wrap img-<?php echo esc_attr($img_pos);?>" data-dot='<?php echo wp_kses_post($dot_image); ?>'>
                            <?php
                                if(!empty($img_id) && $img_pos === 'top') echo wp_get_attachment_image($img_id, 'full', false, array('class'=>'img-top'));
                                if($title) echo '<h3>'.esc_html($title).'</h3>';
                                if($desc) echo '<div class="desc">'.esc_html($desc).'</div>';
                                if(!empty($img_id) && $img_pos === 'bottom') echo wp_get_attachment_image($img_id, 'full', false, array('class'=>'img-bottom'));

                                echo wp_kses_post($link_open); 
                                if($iconClass) echo '<i class="'.esc_attr($iconClass).'"></i>'.$a_title;
                                echo wp_kses_post($link_close); 
                            ?>
                        </div>
                    <?php 
                        break;
                    }
                } ?>
        </div>
        <?php if($nav_style === '1'): ?><div class="navContainer owl-nav"><div class="dotContainer owl-dots"></div></div><?php endif; ?>
    <?php
            break;
        default:
    ?>
        <div id="<?php echo esc_attr('red-process-'.$el_id);?>" class="red-process layout-<?php echo esc_attr($layout_mode);?>">
            <?php 
                $count = 0;
                foreach($values as $value){
                    $count ++;
                    if($count < 10) $count = '0'.$count;
                    $title   = isset($value['p_title']) ? $value['p_title'] : '';
                    $desc    = isset($value['p_desc']) ? $value['p_desc'] : '';
                    $img_id  = isset($value['p_image']) ? $value['p_image'] : '';
                    $img_pos = isset($value['p_image_pos']) ? $value['p_image_pos'] : '';

                    $thumbnail = $image_url = '';
                    if(!empty($img_id)){
                        $img = wpb_getImageBySize( array(
                            'attach_id'  => $img_id,
                            'thumb_size' => '470x373',
                            'class'      => '',
                        ));
                        $thumbnail = $img['thumbnail'];
                        $image_url = wp_get_attachment_url($img_id);
                    }

                    vc_icon_element_fonts_enqueue( $value['i_type'] );  /* Call icon font libs */
                    $iconClass = isset($value['i_icon_'. $value['i_type']]) ? $value['i_icon_'. $value['i_type']] : '';     /* get icon class */           
                    if (isset($value['icon_link'])){  
                        $link = vc_build_link($value['icon_link']);
                        $link = ( $link == '||' ) ? '' : $link;
                        if ( strlen( $link['url'] ) > 0 ) {
                            $show_link = true;
                            $a_href = $link['url'];
                            $a_title = isset($link['title']) ? $link['title'] : '';
                            $a_target = strlen( $link['target'] ) > 0 ? str_replace(' ', '', $link['target']) : '_self';

                            $link_open = '<a class="overlay" href="'.esc_url($a_href).'" title="'.esc_attr($a_title).'" target="'.esc_attr($a_target).'"><span class="overlay-inner center-align">';
                            $link_close = '</span></a>';
                        }
                    }
                    switch ($layout_mode) {
                        case '2':
                            $col_l = $col_r = 'col-md-12';
                            if(!empty($img_id)) $col_l = $col_r = 'col-md-6';
                            if($img_pos === 'top') 
                                $col_l .= ' order-md-0';
                            else 
                                $col_l .= ' order-md-1';
                    ?>
                        <div class="red-process-item overlay-wrap row no-gutters layout-<?php echo esc_attr($layout_mode);?>">
                            <?php
                                if(!empty($img_id)) echo '<div class="red-process-img '.esc_attr($col_l).'">'.$thumbnail.$link_open.'<i class="'.esc_attr($iconClass).'"></i>'.$link_close.'</div>';
                                echo '<div class="red-process-content align-items-center row no-gutters '.esc_attr($col_r).'" data-count="'.esc_attr($count).'"><div class="inner">';
                                    if($title) echo '<h3 data-count="'.esc_attr($count).'">'.esc_html($title).'</h3>';
                                    if($desc) echo '<div class="desc">'.esc_html($desc).'</div>';
                                    if($show_link) echo '<footer class="p-footer"><a class="btn btn-alt" href="'.esc_url($a_href).'" title="'.esc_attr($a_title).'" target="'.esc_attr($a_target).'">'.$a_title.$btn_icon.'</a></footer>';
                                echo '</div></div>';
                            ?>
                        </div>
                    <?php
                        break;
                        default:
                    ?>
                        <div class="red-process-item overlay-wrap img-<?php echo esc_attr($img_pos);?> col-sm-12 col-md-6 col-lg-3">
                            <?php
                                if(!empty($img_id) && $img_pos === 'top') echo wp_get_attachment_image($img_id, 'full', false, array('class'=>'img-top'));
                                if($title) echo '<h3>'.esc_html($title).'</h3>';
                                if($desc) echo '<div class="desc">'.esc_html($desc).'</div>';
                                if(!empty($img_id) && $img_pos === 'bottom') echo wp_get_attachment_image($img_id, 'full', false, array('class'=>'img-bottom'));

                                echo wp_kses_post($link_open); 
                                if($iconClass) echo '<i class="'.esc_attr($iconClass).'"></i>&nbsp;&nbsp;';
                                echo esc_html($a_title);
                                echo wp_kses_post($link_close); 
                            ?>
                        </div>
                    <?php
                        break;
                    }
                } ?>
        </div>
    <?php
            break;
    } ?>
    
</div>


