<?php
    $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
    extract( $atts );
?>
<div class="<?php echo trim(implode(' ', array('red-newsletter',$layout_mode, $el_class)));?>">
    <?php switch ($layout_mode) {
        case 'minimal':
            the_widget(
                'NewsletterWidgetMinimal', 
                array(
                    'button' => $btn_text,
                    'el_class' => $el_class
                ),
                array(
                    'before_widget' => '', 
                    'after_widget'  => ''
                )
            );
            break;
        case 'minimal-with-title':
            ?>
            <div class="minimal-with-title-wrap">
                <div class="col-left">
                    <?php echo !empty($title) ? '<span class="silent-font">'. esc_html($title).'</span>': ''; ?>
                    <?php echo !empty($desc) ? '<p class="desc">'. esc_html($desc).'</p>' : ''; ?>
                </div>
                <div class="col-right">
                    <?php 
                    the_widget(
                        'NewsletterWidgetMinimal', 
                        array(
                            'button' => $btn_text,
                            'el_class' => $el_class
                        ),
                        array(
                            'before_widget' => '', 
                            'after_widget'  => ''
                        )
                    );
                    ?>
                </div>
            </div>
            <?php
            break;
        default:
            the_widget(
                'NewsletterWidget', 
                array(
                    'button' => $btn_text,
                    'lists_layout'      => $lists_layout, 
                    'lists_empty_label' => $lists_empty_label, 
                    'lists_field_label' => $lists_field_label,
                    'el_class' => $el_class
                ), 
                array(
                    'before_widget' => '', 
                    'after_widget'  => ''
                ) 
            );
            break;
    } ?>
</div>