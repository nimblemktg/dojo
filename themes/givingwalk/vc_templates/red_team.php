<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $thumbnail_size
 * @var $thumbnail_size_custom
 * @var $values
 * Shortcode class
 * @var $this WPBakeryShortCode_cms_team_carousel
 */
$values = $thumbnail_class = $link_open = $link_close = $item_overlay_bg = $social_icon = '';
$default_avatar = get_template_directory_uri().'/assets/images/avatar.png';

$social_align = is_rtl()?'text-left':'text-right';
/* get Shortcode custom value */
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$wrap_css_class = 'red-team-wrap red-owl-wrap '.$el_id;

$css_class_attr = $item_class = array();
$css_class_attr[] = 'layout-'.$layout_mode;
$item_class[] = 'red-carousel-item-wrap';

if($layout_style === 'carousel'){
    $css_class_attr[] = 'red-carousel owl-carousel';
    if($nav)  $css_class_attr[] = 'has-nav'; 
    if($dots)  $css_class_attr[] = 'has-dots'; 
    $css_class_attr[] = $nav_pos;
    $css_class_attr[] = $dot_style;
} else {
    $css_class_attr[] = 'red-grid row';
    $item_class[] = 'col-sm-'.round(12/$col_sm).' col-md-'.round(12/$col_md).' col-lg-'.round(12/$col_lg).' col-xl-'.round(12/$col_xl);
}
$css_class_attr[] = $content_align;
$css_class_attr[] = $el_class;


$item_overlay_bg = 'style="background-color: transparent;"';
/* Image Size */
$custom_size = false;
if ($thumbnail_size === 'custom'){
    $custom_size = true;
    $thumbnail_size = $thumbnail_size_custom;
}
if($thumbnail_bw) $thumbnail_class .= ' bw';

$member = vc_map_get_attributes( $this->getShortcode(), $atts );
$values = (array) vc_param_group_parse_atts( $member['values'] );
if(empty($values[0])) {
    echo '<p class="require required">'.esc_html__('Please add a member!','givingwalk').'</p>';
    return;
}
$count = count($values);
$i=1;
$j=0;

?>
<div class="<?php echo esc_attr($wrap_css_class);?>">
    <?php if($layout_style === 'carousel' && $dot_pos == '1') echo '<div class="dotContainerTop owl-dots row no-gutters align-items-center justify-content-center '.$dot_style.'"></div>'; ?>
    <div id="<?php echo esc_attr($el_id);?>" class="<?php echo join(' ',$css_class_attr);?>"> 
        <?php
            foreach($values as $value){
                /* Team Image */
                if(isset($value['image'])) {  
                    $img = wpb_getImageBySize( array(
                        'attach_id' => $value['image'],
                        'thumb_size' => $thumbnail_size,
                        'class' => 'team-image'.$thumbnail_class,
                    ));
                    $thumbnail = $img['thumbnail'];
                    $dot_image = wp_get_attachment_image($value['image'],array(100,100),'',array('class'=>'avatar img-circle'));
                } else {
                    $thumbnail = '';
                    $dot_image = '<img src="'.esc_url($default_avatar).'" class="avatar img-circle" />';
                }

                $j++;
                if($i > $number_row) $i=1;
                if($i==1): 
                ?>
                <div class="<?php echo join(' ',$item_class) ?>" data-dot='<?php echo wp_kses_post($dot_image);?>'>
                <?php endif ; ?>
                <div class="red-carousel-item red-team-item overlay-wrap">
                <?php
                    /* parse image_link */
                    $link = false;
                    if(isset($value['image_link'])){
                        $image_link = vc_build_link( $value['image_link']);
                        $image_link = ( $image_link == '||' ) ? '' : $image_link;
                        if ( strlen( $image_link['url'] ) > 0 ) {
                            $link = true;
                            $a_href = $image_link['url'];
                            $a_title = $image_link['title'] ? $image_link['title'] : esc_html__('View more','givingwalk');
                            $a_target = strlen( $image_link['target'] ) > 0 ? str_replace(' ','',$image_link['target']) : '_self';
                        }
                    }
                    if($link){
                        $link_open = '<a class="btn btn-primary" href="'.esc_url($a_href).'" title="'.esc_attr($a_title).'" target="'.esc_attr($a_target).'">';
                        $link_close = '</a>';
                    }

                    /* Get social */
                    if(isset($value['social_values'])){
                        $socials_list = '';
                        $socials = (array) vc_param_group_parse_atts( $value['social_values']);

                        foreach($socials as $social){
                            if(isset($social['social_icon'])) $social_icon = '<i class="'.$social['social_icon'].'"></i>';
                            /* parse social link */
                            $social_link = false;
                            if(isset($social['social_link'])){
                                $social_icon_link = vc_build_link( $social['social_link'] );
                                $social_icon_link = ( $social_icon_link == '||' ) ? '' : $social_icon_link;
                                if ( strlen( $social_icon_link['url'] ) > 0 ) {
                                    $social_link = true;
                                    $social_href = $social_icon_link['url'];
                                    $social_title = $social_icon_link['title'] ? $social_icon_link['title'] : '';
                                    $social_target = strlen( $social_icon_link['target'] ) > 0 ? str_replace(' ','',$social_icon_link['target']) : '_self';

                                    /* get domain as class */
                                    $domail_name = givingwalk_parse_url_all($social_href);
                                    $colored = $domail_name['domain_name'];
                                    if ($domail_name['domain_name'] == 'skype') {
                                        $social_href = 'skype:'.$domail_name['domain_ext'].'?chat';
                                    } 
                                    //echo '<a class="'.esc_attr($icon).'" target="_blank" href="' .  $value  . '"><span class="ion-social-'.esc_attr($icon).'"></span></a>';
                                        
                                }
                            }
                            if($social_link){
                                $social_link_open = '<a class="'.esc_attr($colored).'" href="'.esc_url($social_href).'" title="'.esc_attr($social_title).'" target="'.esc_attr($social_target).'">';
                                $social_link_close = '</a>';
                                $socials_list .= $social_link_open.$social_icon.$social_link_close;
                            }     
                        }
                    }
                    echo '<div class="red-team-media">';
                        if(isset($value['image'])) {  
                            echo wp_kses_post($thumbnail);

                            /* Overlay Content */
                            if($link){
                                echo '<div class="overlay animated '.esc_attr($thumbnail_class.' '.$animation_out).'" data-item-animation-in="'.esc_attr($animation_in).'" data-item-animation-out="'.esc_attr($animation_out).'" '.wp_kses_post($item_overlay_bg).'>
                                    <div class="overlay-inner vertical-align text-center"><div class="red-team-info-content">';
                                       if($link) echo wp_kses_post($link_open).esc_html($a_title).wp_kses_post($link_close);
                                echo '</div></div></div>';
                            }
                        }
                        
                    echo '</div>';
                    echo '<div class="red-team-info">';
                        echo '<div class="red-team-info-header">';
                            if(isset($value['name']))  echo '<h5>'.esc_html($value['name']).'</h5>';
                            if(isset($value['position']))   echo '<div class="position">'.esc_html($value['position']).'</div>';
                            if(isset($value['slogan']) && !empty($value['slogan'])) echo '<div class="description">'.esc_html($value['slogan']).'</div>';
                        echo '</div>';
                        if(isset($value['social_values']) && $value['social_values']!=='%5B%5D')  echo wp_kses_post('<div class="red-social colored-text">'.$socials_list.'</div>');
                    echo '</div>';
                ?>
                </div>
                <?php if( ($i == $number_row || $j == $count) ) : ?>
                </div>
                <?php endif; 
                $i ++; 
            }
        ?>
    </div>
    <?php if($layout_style === 'carousel' && $nav_style === '1'): ?><div class="navContainer owl-nav"><div class="dotContainer owl-dots"></div></div><?php endif; ?>
</div>
