<?php

$atts = vc_map_get_attributes($this->getShortcode(), $atts);
$atts = wp_parse_args($atts,[
    'search_type'=>'',
    'label'=>''
]);

$css_class = '';
$classes = array('red-advanced-search');
if (!empty($atts['css'])) {
    $classes[] = vc_shortcode_custom_css_class($atts['css']);
}

$css_class = preg_replace('/\s+/', ' ', apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode(' ', array_filter($classes)), $this->settings['base'], $atts));

$search_type = !empty($atts['search_type']) ? $atts['search_type'] : "";
$search_type_allow = givingwalk_advanced_search_allow_post_type();
?>
<div class="<?php echo esc_attr($css_class); ?>">
    <?php if (in_array($search_type, $search_type_allow)) {
        $categories = givingwalk_get_category_of($search_type);
        $current_cat = !empty($_GET['cat']) ? $_GET['cat'] : '';
        $search =  !empty($_GET['s']) ? $_GET['s'] : '';
        ?>
        <form method="get" id="advanced-searchform" role="search" action="<?php echo esc_attr(home_url('/')); ?>">
            <input type="hidden" name="search" value="advanced">
            <input type="hidden" name="target" value="<?php echo esc_attr($search_type) ?>">
            <div class="row align-items-center justify-content-between">
                <div class="col-sm col-xl-auto">
                    <input type="text" value="<?php echo esc_attr($search) ?>" placeholder="<?php echo esc_attr($atts['label']); ?>" name="s" />
                </div>
                <?php if (!empty($categories)){
                    ?>
                    <div class="col-sm col-xl-auto">
                        <select name="cat">
                            <option value=""><?php esc_html_e('Select Category', 'givingwalk'); ?></option>
                            <?php foreach ($categories as $value => $title) { ?>
                                <option value="<?php echo esc_attr($value); ?>" <?php selected($current_cat,$value) ?>><?php echo esc_html($title); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <?php
                }?>
                <div class="col-sm col-xl-auto">
                    <input type="submit" id="searchsubmit" value="<?php echo esc_attr__('Search Now','givingwalk');?>"/>
                </div>
            </div>
        </form>
        <?php
    } else {
        get_search_form();
    } ?>

</div>