<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $values
 * Shortcode class
 * @var $this WPBakeryShortCode_cms_images_carousel
 */
/* get Shortcode custom value */
/* get Shortcode custom value */
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$wrap_css_class = 'red-testimonial-wrap red-owl-wrap '.$el_id;

$css_class_attr = $item_class = array();
$css_class_attr[] = 'layout-'.$layout_mode;
$css_class_attr[] = $color_mode;
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

$testimonial = vc_map_get_attributes( $this->getShortcode(), $atts );
$values = (array) vc_param_group_parse_atts( $testimonial['values'] );
if(!isset($values[0]['text'])){
    echo '<p class="require required">'.esc_html__('Please add a testimonial text!','givingwalk').'</p>';
    return;
}

$lquote = is_rtl() ? 'fa fa-quote-left' : 'fa fa-quote-right';
$rquote = is_rtl() ? 'fa fa-quote-right' : 'fa fa-quote-left';
$dot_image = $avatar = '';
$default_avatar = get_template_directory_uri().'/assets/images/avatar.png';


$count = count($values);
?>
<div class="<?php echo esc_attr($wrap_css_class);?>">
    <?php if($layout_style === 'carousel' && $dot_pos == '1') echo '<div class="dotContainerTop owl-dots row no-gutters align-items-center justify-content-center '.$dot_style.'"></div>'; ?>
    <div id="<?php echo esc_attr($el_id);?>" class="<?php echo join(' ',$css_class_attr);?>">
        <?php            
            switch ($layout_mode) {
                case '1':
                    foreach($values as $value){
                        if(isset($value['text']) && !empty($value['text'])){
                            if(isset($value['author_avatar']) && !empty($value['author_avatar'])) {
                                $img = wpb_getImageBySize( array(
                                    'attach_id' => $value['author_avatar'],
                                    'thumb_size' => '100',
                                    'class' => 'img-circle avatar',
                                ));
                                $avatar = wp_get_attachment_image($value['author_avatar'],'thumbnail','',array('class'=>'avatar'));
                            } else {
                                $avatar = '<img src="'.esc_url($default_avatar).'" class="avatar" alt="'.esc_attr($value['author_name']).'" />';
                            }
                            echo '<div class="red-carousel-item red-testimonial-item'. join(' ',$item_class).'">';
                                echo '<span class="quote-icon"></span>';
                                if(!empty($value['title']))
                                    echo '<h2 class="testi-title">'.esc_html( $value['title'] ).'</h2>';
                                 
                                if(isset($value['text'])) echo '<div class="description">'.esc_html($value['text']).'</div>';
                                
                                echo '<div class="author-info clearfix">';
                                    if(isset($value['author_avatar'])) {

                                        echo wp_kses_post('<span class="author-avatar">'.$avatar.'</span>');
                                    }
                                    $author = '<div class="author-name-pos">';
                                    if(isset($value['author_name']) && !empty($value['author_name'])):
                                        $author .= '<h4>';
                                        if(isset($value['author_url']) && !empty($value['author_url']))
                                            $author .= '<a href="'.esc_url($value['author_url']).'">';
                                            $author .= esc_html($value['author_name']);
                                        if(isset($value['author_url']) && !empty($value['author_url']))
                                            $author .= '</a>';
                                        $author .= '</h4>';
                                    endif;
                                    if(isset($value['author_position']) && !empty($value['author_position'])) 
                                        $author .= '<span class="author-position">'.esc_html($value['author_position']).'</span>';
                                    $author .= '</div>';

                                    echo wp_kses_post($author);
                                echo '</div>';
                            echo '</div>';
                        }
                    }
                break;
                case '2':
                    foreach($values as $value){
                        if(isset($value['text']) && !empty($value['text'])){
                            if(isset($value['author_avatar']) && !empty($value['author_avatar'])) {
                                $img = wpb_getImageBySize( array(
                                    'attach_id' => $value['author_avatar'],
                                    'thumb_size' => '100',
                                    'class' => 'img-circle avatar',
                                ));
                                $avatar = wp_get_attachment_image($value['author_avatar'],'thumbnail','',array('class'=>'avatar'));
                            } else {
                                $avatar = '<img src="'.esc_url($default_avatar).'" class="avatar" alt="'.esc_attr($value['author_name']).'" />';
                            }
                            echo '<div class="red-carousel-item red-testimonial-item'. join(' ',$item_class).'">';

                                if(!empty($value['title']))
                                    echo '<h2 class="testi-title">'.esc_html( $value['title'] ).'</h2>';
                                 
                                if(isset($value['text'])) echo '<div class="description">'.esc_html($value['text']).'</div>';
                                
                                echo '<div class="author-info clearfix">';
                                    if(isset($value['author_avatar'])) {

                                        echo wp_kses_post('<span class="author-avatar">'.$avatar.'</span>');
                                    }
                                    $author = '<div class="author-name-pos">';
                                    if(isset($value['author_name']) && !empty($value['author_name'])):
                                        $author .= '<h4>';
                                        if(isset($value['author_url']) && !empty($value['author_url']))
                                            $author .= '<a href="'.esc_url($value['author_url']).'">';
                                            $author .= esc_html($value['author_name']);
                                        if(isset($value['author_url']) && !empty($value['author_url']))
                                            $author .= '</a>';
                                        $author .= '</h4>';
                                    endif;
                                    if(isset($value['author_position']) && !empty($value['author_position'])) 
                                        $author .= '<span class="author-position">'.esc_html($value['author_position']).'</span>';
                                    $author .= '</div>';

                                    echo wp_kses_post($author);
                                echo '</div>';
                            echo '</div>';
                        }
                    }
                break;
            }
        ?>
    </div>
    <?php if($layout_style === 'carousel' && $nav_style === '1'): ?><div class="navContainer owl-nav"><div class="dotContainer owl-dots"></div></div><?php endif; ?>
</div>
