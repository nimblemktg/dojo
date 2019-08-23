<?php
    extract($atts);
?>
<div class="<?php echo trim(implode(' ',array($el_id, $el_class)));?>">
    <?php givingwalk_owl_dots_top($layout_type, $dot_pos, $dot_style); ?>
    <div id="<?php echo esc_attr($el_id);?>" class="red-carousel owl-carousel <?php echo esc_attr($el_class);?>">
        <?php
        if (is_array($content)):
            foreach ($content as $key => $shortcode) {
                ?>
                <div class="red-carousel-item">
                    <?php echo wpb_js_remove_wpautop($shortcode) ?>
                </div>
                <?php
            }
        endif;
        ?>
    </div>
    <?php 
        givingwalk_owl_preload($layout_type);
        givingwalk_owl_dots($layout_type, $dot_style, $dot_pos);
        givingwalk_owl_nav($layout_type, $nav_style, $nav_pos);
        givingwalk_owl_dots_in_nav($layout_type, $nav_style);
    ?>
</div>
