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
 * @var $this WPBakeryShortCode_red_clients_carousel
 */

$values = $thumbnail_class = '';
/* get Shortcode custom value */
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$wrap_css_class = 'red-clients-wrap red-owl-wrap '.$el_id;

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

$clients = vc_map_get_attributes( $this->getShortcode(), $atts );
$values = (array) vc_param_group_parse_atts( $clients['values'] );
if(empty($values[0])) {
    echo '<p class="require required">'.esc_html__('Please add a client logo!','givingwalk').'</p>';
    return;
}

/* Image Size */
$custom_size = false;
if ($thumbnail_size === 'custom'){ 
    $custom_size = true;
    $thumbnail_size = $thumbnail_size_custom;
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
                $j++; 
                if($i > $number_row) $i=1;
                /* parse image_link */
                $link = false;
                if(isset($value['image_link'])){
                    $image_link = vc_build_link( $value['image_link']);
                    $image_link = ( $image_link == '||' ) ? '' : $image_link;
                    $link_open = '<span class="client-logo"><span>';
                    $link_close = '</span></span>';
                    if ( strlen( $image_link['url'] ) > 0 ) {
                        $link = true;
                        $a_href = $image_link['url'];
                        $a_title = $image_link['title'] ? $image_link['title'] : '';
                        $a_target = strlen( $image_link['target'] ) > 0 ? str_replace(' ','',$image_link['target']) : '_self';
                        $link_open = '<a class="client-logo" href="'.esc_url($a_href).'" title="'.esc_attr($a_title).'" target="'.esc_attr($a_target).'"><span>';
                        $link_close = '</span></a>';
                    }
                }else{
                    $link_open = '';
                    $link_close = '';
                }
                if(isset($value['image'])) {
                    $img = wpb_getImageBySize( array(
                        'attach_id' => $value['image'],
                        'thumb_size' => $thumbnail_size,
                        'class' => 'team-image'.$thumbnail_class,
                    ));
                    $thumbnail = $img['thumbnail'];
                    $dot_image = wp_get_attachment_image($value['image'],'thumbnail','',array('class'=>'img-circle'));
                    if($i==1) : ?>
                        <div class="<?php echo join(' ',$item_class);?>" data-dot='<?php echo wp_kses_post($dot_image); ?>'>
                    <?php  
                        endif;
                        echo '<div class="red-carousel-item client-item">';                
                        echo wp_kses_post($link_open);
                            echo wp_kses_post($thumbnail);
                        echo wp_kses_post($link_close);
                        echo '</div>';
                    if($i == $number_row || $j==$count) echo '</div>';
                    $i ++;
                }
            }
        ?>
    </div>
    <?php if($layout_style === 'carousel' && $nav_style === '1'): ?><div class="navContainer owl-nav"><div class="dotContainer owl-dots"></div></div><?php endif; ?>
</div>
