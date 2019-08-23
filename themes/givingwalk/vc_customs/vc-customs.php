<?php
if (!class_exists('VC_Manager') || !class_exists('EF4Framework')) return;
/**
 * support shortcodes
 * @return array
 * ef4_cms_grid
 */
add_filter('cms-shorcode-list', 'givingwalk_shortcodes');
function givingwalk_shortcodes()
{
    return array();
}

/* Call some default params */
if (!function_exists('array_filter_add_element')) {
    function givingwalk_array_filter_add_element(array $array)
    {
        $result = array();
        foreach ($array as $key => $value) {
            if (strpos($key, "array_filter_add_element") === 0) {
                foreach ($value as $seg)
                    $result[] = $seg;
            } else {
                $result[] = $value;
            }
        }
        return $result;
    }
}

/**
 * Custom CPT UI
 * Need to do this to add custom post type registered with CPT UI
 * show in list DATA SOURCE of VC POST GRID Element
 * referent link : https://wordpress.org/support/topic/custom-post-type-and-visual-composer-grid-block/#post-6182678
 * and : https://wordpress.org/support/topic/custom-post-type-and-visual-composer-grid-block/page/2#post-6182761
 *
 * @author Red Team
 * @since 1.0.0
 */
if (function_exists('cptui_create_custom_post_types')) {
    remove_action('init', 'cptui_create_custom_post_types', 10);
    add_action('init', 'cptui_create_custom_post_types', 2);
}



/**
 * Remove VC frontend Editor Post Link
 * add_action( 'vc_after_init', 'givingwalk_vc_remove_wp_edit_post_link' );
 *
 * @author Red Team
 * @since 1.0.0
 */
function givingwalk_vc_remove_wp_edit_post_link()
{
    remove_ef4_filter('edit_post_link', array(vc_frontend_editor(), 'renderEditButton'));
}

add_action('vc_after_init', 'givingwalk_vc_remove_wp_edit_post_link');

if (!function_exists('givingwalk_get_post_types_for_vc')) {
    function givingwalk_get_post_types_for_vc()
    {
        $post_types = get_post_types(['public' => true], 'object');
        $excludedPostTypes = array(
            'revision',
            'nav_menu_item',
            'vc_grid_item',
            'page',
            'attachment',
            'custom_css',
            'customize_changeset',
            'oembed_cache',
        );
        $result = [];
        if (!is_array($post_types))
            return $result;
        foreach ($post_types as $post_type) {
            if (!$post_type instanceof WP_Post_Type)
                continue;
            if (in_array($post_type->name, $excludedPostTypes))
                continue;
            $result["{$post_type->label} ({$post_type->name})"] = $post_type->name;
        }
        return $result;
    }
}

/**
 * Custom VC shortcode output
 */
add_filter('vc_shortcode_output', 'givingwalk_vc_shortcode_output', 10, 3);
function givingwalk_vc_shortcode_output($html = '', $sc_obj = '', $atts = [])
{
    extract($atts);
    //modify shortcode use div as container
    $shortcode_modify = array(
        'vc_row',
        'vc_row_inner',
        'vc_column',
        'vc_column_inner'
    );
    $shortcode_name = $sc_obj->getShortcode();
    if (!in_array($shortcode_name, $shortcode_modify))
        return $html;
    //
    $modify = [
        'attrs'       => [], // for add attrs can use string or array
        'before'      => '',
        'after'       => '',
        'first-child' => '',
        'last-child'  => ''
    ];
    switch ($shortcode_name) {
        //case for $shortcode_modify element
        case 'vc_row':
            //ex: $modify['attrs']['data-hello_row']       = 'hello';//modify by string
            if (isset($text_color)) $modify['attrs']['style'] = 'color:' . $text_color . ';'; //ex: 'data-hello_row="hello"';//modify by string
            /* parallax overlay color */
            if (isset($parallax_overlay) && !empty($parallax_overlay)) $modify['first-child'] = '<div class="parallax_overlay" style="background-color:' . esc_attr($parallax_overlay) . '"></div>'; //ex: '<div class="d-none">Row first child</div>';
            if (isset($row_bg_overlay) && !empty($row_bg_overlay)) $modify['first-child'] = '<div class="bg_overlay" style="background-color:' . esc_attr($row_bg_overlay) . '"></div>';
            $modify['last-child'] = ''; //ex: '<div class="d-none">Row last child</div>';
            $modify['before'] = ''; //ex: '<div class="d-none">Row Before</div>';
            $modify['after'] = ''; //ex: '<div class="d-none">Row after</div>';
            break;
        case 'vc_row_inner':
            /* parallax overlay color */
            if (isset($parallax_overlay) && !empty($parallax_overlay))
                $modify['first-child'] = '<div class="parallax_overlay" style="background-color:' . esc_attr($parallax_overlay) . '"></div>';
            break;
        case 'vc_column':
            if (isset($text_color)) $modify['attrs']['style'] = 'color:' . $text_color . ';';
            /* parallax overlay color */
            if (isset($parallax_overlay) && !empty($parallax_overlay)) $modify['first-child'] = '<div class="parallax_overlay" style="background-color:' . esc_attr($parallax_overlay) . '"></div>';
            $modify['last-child'] = ''; //ex: '<div class="d-none">col last child</div>';
            $modify['before'] = ''; //ex: '<div class="d-none">col Before</div>';
            $modify['after'] = ''; //ex: '<div class="d-none">col after</div>';
            break;
        default:
            return $html;
            break;
    }
    //begin modify
    if (!empty($modify['attrs'])) {
        if (is_array($modify['attrs'])) {
            $custom_attr_str = [];
            foreach ($modify['attrs'] as $key => $value) {
                $value = esc_attr($value);
                $custom_attr_str[] = "{$key}=\"{$value}\"";
            }
            $custom_attr_str = join(' ', $custom_attr_str);
        } else
            $custom_attr_str = $modify['attrs'];
        $html = '<div ' . $custom_attr_str . substr($html, 4);
    }
    if (!empty($modify['first-child'])) {
        $html_exp = explode('>', $html);
        $html_exp[1] = $modify['first-child'] . $html_exp[1];
        $html = join('>', $html_exp);
    }
    if (!empty($modify['last-child'])) {
        $html_exp = explode('</div>', $html);
        if (count($html_exp) > 2) {
            for ($index = count($html_exp) - 1; $index > 0; $index--) {
                if (empty(trim($html_exp[$index - 1])))
                    break;
            }
            $html_exp[$index - 1] .= $modify['last-child'];
            $html = join('</div>', $html_exp);
        } else
            $html = substr($html, 0, -6) . $modify['last-child'] . '</div>';
    }
    if (!empty($modify['before']))
        $html = $modify['before'] . $html;
    if (!empty($modify['after']))
        $html = $html . $modify['after'];
    return $html;
}

/**
 * Add custom class from custom param to VC Element
 * https://kb.wpbakery.com/docs/filters/vc_shortcodes_css_class/
 *
 */
add_filter('vc_shortcodes_css_class', 'change_element_class_name', 10, 3);
function change_element_class_name($class_string, $tag, $atts = '')
{
    $custom_class = array();
    extract($atts);
    if ($tag == 'vc_row' || $tag == 'vc_row_inner') {
        if (isset($row_priority)) {
            $custom_class[] = $row_priority;
        }
        if (isset($row_col_width)) {
            $custom_class[] = $row_col_width;
        }
        if (isset($row_col_space)) {
            $custom_class[] = $row_col_space;
        }
        if (isset($parallax_position)) {
            $custom_class[] = $parallax_position;
        }
        if (isset($row_bg_fixed) && $row_bg_fixed) {
            $custom_class[] = 'row-bg-fixed';
        }
    }
    if ($tag == 'vc_column' || $tag == 'vc_column_inner') {
        if (isset($col_priority)) {
            $custom_class[] = $col_priority;
        }
        if (isset($col_space)) {
            $custom_class[] = $col_space;
        }
    }
    /* add custom loading delay time for VC Grid */
    if ($tag = 'vc_basic_grid' || $tag = 'vc_masonry_grid' || $tag = 'vc_media_grid' || $tag = 'vc_masonry_media_grid') {
        if (isset($element_width) && $element_width) {
            $custom_class[] = 'zk-iw-' . $element_width;
        }
        if (isset($item) && $item) {
            $custom_class[] = $item;
        }

        if (isset($vcbg_hover) && $vcbg_hover) {
            $custom_class[] = $vcbg_hover;
        }

        if (isset($vcbg_space) && $vcbg_space) {
            $custom_class[] = 'vc_gitem-row-' . $vcbg_space;
        }

        if (isset($delay_time) && $delay_time) {
            $custom_class[] = 'zk-loading-delay-' . $delay_time;
        }

        if (isset($pagination_top_space) && $pagination_top_space) {
            $custom_class[] = 'pagination-top-' . $pagination_top_space;
        }
    }

    $class_string .= ' ' . join(' ', $custom_class);
    return $class_string;
}

/**
 * Add new param text-align to VC param_type font_container
 * Added text-align INHERIT for get default text-align when
 * switch LTR to RTL language
 * @author Red Team
 * @since 1.0.0
 */
add_filter('vc_font_container_output_data', 'givingwalk_vc_font_container_render_filter', 11, 4);
function givingwalk_vc_font_container_render_filter($data, $fields, $values, $settings)
{
    if (isset($fields['text_align'])) {
        $data['text_align'] = '
        <div class="vc_row-fluid vc_column">
            <div class="wpb_element_label">' . esc_html__('Text align', 'givingwalk') . '</div>
            <div class="vc_font_container_form_field-text_align-container">
                <select class="vc_font_container_form_field-text_align-select">
                    <option value="inherit" class="inherit" ' . ('inherit' === $values['text_align'] ? 'selected="selected"' : '') . '>' . esc_html__('Default', 'givingwalk') . '</option>
                    <option value="left" class="left" ' . ('left' === $values['text_align'] ? 'selected="selected"' : '') . '>' . esc_html__('Left', 'givingwalk') . '</option>
                    <option value="right" class="right" ' . ('right' === $values['text_align'] ? 'selected="selected"' : '') . '>' . esc_html__('Right', 'givingwalk') . '</option>
                    <option value="center" class="center" ' . ('center' === $values['text_align'] ? 'selected="selected"' : '') . '>' . esc_html__('center', 'givingwalk') . '</option>
                    <option value="justify" class="justify" ' . ('justify' === $values['text_align'] ? 'selected="selected"' : '') . '>' . esc_html__('Justify', 'givingwalk') . '</option>
                </select>
            </div>';
        if (isset($fields['text_align_description']) && strlen($fields['text_align_description']) > 0) {
            $data['text_align'] .= '
            <span class="vc_description clear">' . $fields['text_align_description'] . '</span>
            ';
        }
        $data['text_align'] .= '</div>';
    }
    return $data;
}

/**
 *
 * Custom  VC Row
 *
 */
vc_add_params('vc_row', array(
    array(
        'type'        => 'dropdown',
        'heading'     => esc_html__('Row Priority', 'givingwalk'),
        'param_name'  => 'row_priority',
        'value'       => array(
            esc_html__('Default', 'givingwalk')      => '',
            esc_html__('Visible Overflow', 'givingwalk')       => 'visible',
            esc_html__('Dark Mode Color', 'givingwalk') => 'dark-mode-color'
        ),
        'description' => esc_html__('Choose priority for this row', 'givingwalk'),
        'group'       => esc_html__('Givingwalk Custom', 'givingwalk')
    ),
    array(
        'type'        => 'colorpicker',
        'heading'     => esc_html__('Text Color', 'givingwalk'),
        'param_name'  => 'text_color',
        'description' => esc_html__('Choose color for this row', 'givingwalk'),
        'group'       => esc_html__('Givingwalk Custom', 'givingwalk')
    ),
    array(
        'type'             => 'dropdown',
        'heading'          => esc_html__('Column Width', 'givingwalk'),
        'param_name'       => 'row_col_width',
        'value'            => array(
            esc_html__('Default', 'givingwalk') => '',
        ),
        'description'      => esc_html__('Choose column Width for this row', 'givingwalk'),
        'edit_field_class' => 'vc_col-sm-6',
        'group'            => esc_html__('Givingwalk Custom', 'givingwalk')
    ),
    array(
        'type'             => 'dropdown',
        'heading'          => esc_html__('Column Space', 'givingwalk'),
        'param_name'       => 'row_col_space',
        'value'            => array(
            esc_html__('Default', 'givingwalk') => '',
            esc_html__('Space 45px', 'givingwalk') => 'space-45',
        ),
        'description'      => esc_html__('Choose column space for this row', 'givingwalk'),
        'edit_field_class' => 'vc_col-sm-6',
        'group'            => esc_html__('Givingwalk Custom', 'givingwalk')
    ),
    array(
        'type'             => 'colorpicker',
        'heading'          => esc_html__('Overlay Color', 'givingwalk'),
        'param_name'       => 'parallax_overlay',
        'value'            => '',
        'description'      => esc_html__('Choose overlay color.', 'givingwalk'),
        'edit_field_class' => 'vc_col-sm-4',
        'group'            => esc_html__('Parallax', 'givingwalk')
    ),
    array(
        'type'        => 'dropdown',
        'heading'     => esc_html__('Parallax Position', 'givingwalk'),
        'param_name'  => 'parallax_position',
        'value'       => array(
            esc_html__('Default', 'givingwalk') => '',
            esc_html__('Center', 'givingwalk')  => 'parallax-center',
        ),
        'description' => esc_html__('Parallax image position', 'givingwalk'),
        'dependency'  => array(
            'element' => 'parallax',
            'value'   => array(
                'content-moving',
                'content-moving-fade'
            )
        ),
        'group'       => esc_html__('Parallax', 'givingwalk')
    ),
    array(
        'type' => 'checkbox',
        'heading' => esc_html__("Background image fixed", 'givingwalk'),
        'param_name' => 'row_bg_fixed',
        'value' => '',
        'group' => esc_html__("Design Options",'givingwalk'),
    ),
    array(
        'type'             => 'colorpicker',
        'heading'          => esc_html__('Overlay Color', 'givingwalk'),
        'param_name'       => 'row_bg_overlay',
        'value'            => '',
        'description'      => esc_html__('Choose overlay color.', 'givingwalk'),
        'group'            => esc_html__('Design Options', 'givingwalk')
    ),
));
/**
 *
 * Custom  VC Row Inner
 *
 */
vc_add_params('vc_row_inner', array(
    array(
        'type'             => 'colorpicker',
        'heading'          => esc_html__('Overlay Color', 'givingwalk'),
        'param_name'       => 'parallax_overlay',
        'value'            => '',
        'description'      => esc_html__('Choose overlay color.', 'givingwalk'),
        'edit_field_class' => 'vc_col-sm-12',
        'group'            => esc_html__('Design Options', 'givingwalk')
    ),
));
/**
 *
 * Custom  VC Column
 *
 */
vc_add_params('vc_column', array(
    array(
        'type'        => 'dropdown',
        'heading'     => esc_html__('Column Priority', 'givingwalk'),
        'param_name'  => 'col_priority',
        'value'       => array(
            esc_html__('Default', 'givingwalk') => '',
            esc_html__('On Top', 'givingwalk')  => 'ontop'
        ),
        'description' => esc_html__('Choose priority for this column', 'givingwalk'),
        'group'       => esc_html__('Givingwalk Custom', 'givingwalk')
    ),
    array(
        'type'        => 'colorpicker',
        'heading'     => esc_html__('Text Color', 'givingwalk'),
        'param_name'  => 'text_color',
        'description' => esc_html__('Choose color for this colum', 'givingwalk'),
        'group'       => esc_html__('Givingwalk Custom', 'givingwalk')
    ),

    array(
        'type'             => 'dropdown',
        'heading'          => esc_html__('Column Space', 'givingwalk'),
        'param_name'       => 'col_space',
        'value'            => array(
            esc_html__('Default', 'givingwalk') => '',
        ),
        'description'      => esc_html__('Choose column space for this row', 'givingwalk'),
        'edit_field_class' => 'vc_col-sm-6',
        'group'            => esc_html__('Givingwalk Custom', 'givingwalk')
    ),
    array(
        'type'             => 'colorpicker',
        'heading'          => esc_html__('Overlay Color', 'givingwalk'),
        'param_name'       => 'parallax_overlay',
        'value'            => '',
        'description'      => esc_html__('Choose overlay color.', 'givingwalk'),
        'edit_field_class' => 'vc_col-sm-4',
        'group'            => esc_html__('Parallax', 'givingwalk')
    ),
));

/**
 *
 * Custom  VC Column Text
 *
 */
vc_add_params('vc_column_text', array(
    array(
        "type" => "dropdown",
        "heading" => esc_html__("List Style",'givingwalk'),
        "admin_label" => true,
        "param_name" => "list_style",
        "value" => array(
            esc_html__('None','givingwalk') => '',
            esc_html__('Primary list','givingwalk') => 'primary-list',
            esc_html__('Checked list','givingwalk') => 'checked-list',
        ),
        "std" => '',
        'group'       => esc_html__('Givingwalk Custom', 'givingwalk')
    ),
    array(
        "type" => "textfield",
        "heading" => esc_html__("Font size",'givingwalk'),
        "param_name" => "font_size",
        "value" => "",
        'group'       => esc_html__('Givingwalk Custom', 'givingwalk')
    ),

    array(
        "type" => "textfield",
        "heading" => esc_html__("Line height",'givingwalk'),
        "param_name" => "line_height",
        "value" => "",
        'group'            => esc_html__('Givingwalk Custom', 'givingwalk')
    ),
    array(
        "type" => "textfield",
        "heading" => esc_html__("Letter spacing (0.3px, 0.03em)",'givingwalk'),
        "param_name" => "letter_spacing",
        "value" => "",
        'group'       => esc_html__('Givingwalk Custom', 'givingwalk')
    ),
    array(
        "type" => "colorpicker",
        "class" => "",
        "heading" => esc_html__("Color", 'givingwalk'),
        "param_name" => "color",
        "value" => "",
        'group'       => esc_html__('Givingwalk Custom', 'givingwalk')
    ),
));

/* VC Icon 
 * New icon font
*/

if (0) vc_add_params('vc_icon', array(
    array(
        'type'        => 'iconpicker',
        'heading'     => esc_html__('Icon', 'givingwalk'),
        'param_name'  => 'icon_themify',
        'value'       => 'ti-arrow-up',
        'settings'    => array(
            'emptyIcon' => false,
            'type'      => 'themify',
        ),
        'dependency'  => array(
            'element' => 'type',
            'value'   => 'themify',
        ),
        'description' => esc_html__('Select icon from library.', 'givingwalk'),
        'group'       => esc_html__('Givingwalk Icons', 'givingwalk')
    ),
));




/**
 * Custom VC Basic Grid
 * add delay time on loading
 */
vc_add_params('vc_basic_grid', array(
    array(
        'type'        => 'textfield',
        'param_name'  => 'delay_time',
        'value'       => '3000',
        'save_always' => true,
        'heading'     => esc_html__('Loading Delay', 'givingwalk'),
        'description' => esc_html__('Enter delay time in milisecond', 'givingwalk'),
        'group'       => esc_html__('Theme Custom', 'givingwalk')
    )
));

/**
 * Custom VC Media Grid
 * add delay time on loading
 */
vc_add_params('vc_media_grid', array(
    array(
        'type'        => 'textfield',
        'param_name'  => 'delay_time',
        'value'       => '3000',
        'save_always' => true,
        'heading'     => esc_html__('Loading Delay', 'givingwalk'),
        'description' => esc_html__('Enter delay time in milisecond', 'givingwalk'),
        'group'       => esc_html__('Theme Custom', 'givingwalk')
    )
));

/**
 * Custom VC Masonry Grid
 * add delay time on loading
 */
vc_add_params('vc_masonry_grid', array(
    array(
        'type'        => 'textfield',
        'param_name'  => 'delay_time',
        'value'       => '3000',
        'save_always' => true,
        'heading'     => esc_html__('Loading Delay', 'givingwalk'),
        'description' => esc_html__('Enter delay time in milisecond', 'givingwalk'),
        'group'       => esc_html__('Theme Custom', 'givingwalk')
    )
));

/**
 * Custom VC Masonry Media Grid
 * add delay time on loading
 */
vc_add_params('vc_masonry_media_grid', array(
    array(
        'type'        => 'textfield',
        'param_name'  => 'delay_time',
        'value'       => '3000',
        'save_always' => true,
        'heading'     => esc_html__('Loading Delay', 'givingwalk'),
        'description' => esc_html__('Enter delay time in milisecond', 'givingwalk'),
        'group'       => esc_html__('Theme Custom', 'givingwalk')
    )
));

/* VC WP Custom Menu 
 * change menu id to slug
*/
$custom_menus = array();
if ('vc_edit_form' === vc_post_param('action') && vc_verify_admin_nonce()) {
    $menus = get_terms('nav_menu', array('hide_empty' => false));
    if (is_array($menus) && !empty($menus)) {
        foreach ($menus as $single_menu) {
            if (is_object($single_menu) && isset($single_menu->name, $single_menu->slug)) {
                $custom_menus[$single_menu->name] = $single_menu->slug;
            }
        }
    }
}
vc_add_params('vc_wp_custommenu', array(
    array(
        'type'        => 'dropdown',
        'heading'     => esc_html__('Menu', 'givingwalk'),
        'param_name'  => 'nav_menu',
        'value'       => $custom_menus,
        'description' => empty($custom_menus) ? esc_html__('Custom menus not found. Please visit <b>Appearance > Menus</b> page to create new menu.', 'givingwalk') : esc_html__('Select menu to display.', 'givingwalk'),
        'admin_label' => true,
        'save_always' => true,
    )
));

/**
 * Custom VC Grid Item Template Predefined
 *
 * Copy and mofidy VC Grid Builder template
 * Default template : plugins/js_composer/include/params/vc_grid_item/templates.php
 * Filter: js_composer/include/params/vc_grid_item/class-vc-grid-item.php line: 148
 *
 */
add_filter('vc_grid_item_predefined_templates', 'givingwalk_vc_grid_item_predefined_templates');
if (!function_exists('givingwalk_vc_grid_item_predefined_templates')) {
    function givingwalk_vc_grid_item_predefined_templates($template)
    {
        $local_file = get_template_directory() . '/vc_customs/vc_grid_item/templates.php';
        if (file_exists($local_file)) {
            $local_template = include get_template_directory() . '/vc_customs/vc_grid_item/templates.php';
            foreach ($template as $key => $args) {
                if (array_key_exists($key, $local_template))
                    continue;
                $local_template[$key] = $args;
            };
            return $local_template;
        }
        return $template;
    }
}

/**
 * CUSTOM VC PARAMS and Style
 * New style, shape, color, ...
 * @source : https://kb.wpbakery.com/docs/developers-how-tos/update-single-param-values/
 * @author Red Team
 * @since 1.0.0
 */
add_action('vc_after_init', 'givingwalk_vc_custom_params');
function givingwalk_vc_custom_params()
{
    /**
     * Add new value to single param
     * Use
     * $param = WPBMap::getParam('SHORTCODE_NAME', 'PARAM_NAME');
     * $param['value'][esc_html__('Value Title', 'givingwalk')] = 'value';
     * vc_update_shortcode_param('SHORTCODE_NAME', $param);
     **/

    /*
     * VC ROW 
     * Move parallax option to new group
    */
    $param = WPBMap::getParam('vc_row', 'parallax');
    $param['value'][esc_html__('Fixed', 'givingwalk')] = 'fixed';
    $param['value'][esc_html__('Scroll Left', 'givingwalk')] = 'scroll-left';
    $param['value'][esc_html__('Scroll Bottom Right', 'givingwalk')] = 'scroll-br';
    $param['group'] = esc_html__('Parallax', 'givingwalk');
    vc_update_shortcode_param('vc_row', $param);

    $param = WPBMap::getParam('vc_row', 'parallax_image');
    $param['group'] = esc_html__('Parallax', 'givingwalk');
    $param['edit_field_class'] = 'vc_col-sm-4';
    vc_update_shortcode_param('vc_row', $param);

    $param = WPBMap::getParam('vc_row', 'parallax_speed_bg');
    $param['group'] = esc_html__('Parallax', 'givingwalk');
    $param['edit_field_class'] = 'vc_col-sm-4';
    vc_update_shortcode_param('vc_row', $param);

    /*
     * VC Column 
     * Move parallax option to new group
    */
    $param = WPBMap::getParam('vc_column', 'parallax');
    $param['value'][esc_html__('Fixed', 'givingwalk')] = 'fixed';
    $param['value'][esc_html__('Scroll Left', 'givingwalk')] = 'scroll-left';
    $param['group'] = esc_html__('Parallax', 'givingwalk');
    vc_update_shortcode_param('vc_column', $param);

    $param = WPBMap::getParam('vc_column', 'parallax_image');
    $param['group'] = esc_html__('Parallax', 'givingwalk');
    $param['edit_field_class'] = 'vc_col-sm-4';
    vc_update_shortcode_param('vc_column', $param);

    $param = WPBMap::getParam('vc_column', 'parallax_speed_bg');
    $param['group'] = esc_html__('Parallax', 'givingwalk');
    $param['edit_field_class'] = 'vc_col-sm-4';
    vc_update_shortcode_param('vc_column', $param);
    
    /**
     * VC Icon
     * add custom icon font
     */
    $param = WPBMap::getParam('vc_icon', 'type');
    $param['value'][esc_html__('Themify Icons', 'givingwalk')] = 'themify';
    vc_update_shortcode_param('vc_icon', $param);

    /**
     * VC Custom Heading
     * Change text-align to inherit
     * Change font style to theme default
     **/
    $param = WPBMap::getParam('vc_custom_heading', 'font_container');
    $param['value'] = 'tag:h2|text_align:inherit';
    vc_update_shortcode_param('vc_custom_heading', $param);

    $param = WPBMap::getParam('vc_custom_heading', 'use_theme_fonts');
    $param['std'] = 'yes';
    vc_update_shortcode_param('vc_custom_heading', $param);

    /**
     * VC Masonry Media Grid
     */
    /* General: Grid elements per row */
    $param = WPBMap::getParam('vc_masonry_media_grid', 'element_width');
    $param['value']['masonry'] = 'masonry';
    vc_update_shortcode_param('vc_masonry_media_grid', $param);
    /* Load more button: Style  */
    $param = WPBMap::getParam('vc_masonry_media_grid', 'btn_style');
    $param['value'][esc_html__('[givingwalk] Default', 'givingwalk')] = 'Givingwalk btn';
    $param['value'][esc_html__('[givingwalk] Default Alt', 'givingwalk')] = 'Givingwalk btn btn-alt';
    $param['std'] = 'Givingwalk btn';
    $param['save_always'] = true;
    vc_update_shortcode_param('vc_masonry_media_grid', $param);
    /* Load more button: Shape  */
    $param = WPBMap::getParam('vc_masonry_media_grid', 'btn_shape');
    $param['dependency'] = array(
        'element'            => 'btn_style',
        'value_not_equal_to' => array(
            'Givingwalk btn',
            'Givingwalk btn btn-alt'
        )
    );
    vc_update_shortcode_param('vc_masonry_media_grid', $param);
    /* Load more button: Color  */
    $param = WPBMap::getParam('vc_masonry_media_grid', 'btn_color');
    $param['dependency'] = array(
        'element'            => 'btn_style',
        'value_not_equal_to' => array(
            'Givingwalk btn',
            'Givingwalk btn btn-alt'
        )
    );
    vc_update_shortcode_param('vc_masonry_media_grid', $param);

    /** Taxonomies
     * show new taxonomy to VC Grid option
     */
    if (WPBMap::exists('ef4_basic_tax')) {
        $taxonomiesForFilter = array();
        $vcTaxonomiesTypes = vc_taxonomies_types();
        if (is_array($vcTaxonomiesTypes) && !empty($vcTaxonomiesTypes)) {
            foreach ($vcTaxonomiesTypes as $t => $data) {
                if ('post_format' !== $t && is_object($data)) {
                    $taxonomiesForFilter[$data->labels->name . '(' . $t . ')'] = $t;
                }
            }
        }
        $param = WPBMap::getParam('ef4_basic_tax', 'taxonomy');
        $param['value'] = $taxonomiesForFilter;
        vc_update_shortcode_param('ef4_basic_tax', $param);
    }
    /**
     * Custom Default VC Element Params
     *
     */
}

/** VC **/
if (!function_exists('givingwalk_get_post_categories_for_autocomplete')) {
    function givingwalk_get_post_categories_for_autocomplete()
    {
        $post_categories = get_categories('post_categories');
        $result = array();
        foreach ($post_categories as $category) {
            $result[] = array(
                'label' => $category->name,
                'value' => $category->slug,
                'group' => 'Categories'
            );
        }
        return $result;
    }
}

if (!function_exists('givingwalk_default_image_thumbnail_url')) {
    function givingwalk_default_image_thumbnail_url($args = array())
    {
        $args = wp_parse_args($args, array(
            'size'  => 'large',
            'class' => ''
        ));
        extract($args);
        /* use wpb_resize( $attach_id = null, $img_url = null, $width, $height, $crop = false ) */
        global $_wp_additional_image_sizes;
        $image_sizes = givingwalk_get_image_sizes();
        $size = explode('x', $size);
        $size_use = $size[0];
        if (!is_numeric($size_use)) {
            if (!empty($image_sizes[$size_use]) && is_array($image_sizes[$size_use])) {
                $width = $image_sizes[$size_use]['width'];
                $height = $image_sizes[$size_use]['height'];

            } else {
                $width = '1170';
                $height = '770';
            }
        } else {
            $width = $size[0];
            $height = isset($size[1]) ? $size[1] : $size[0];
        }

        $default_img = wpb_resize('', '/wp-content/themes/' . get_template() . '/assets/images/no-image.jpg', $width, $height, true);

        return $default_img['url'];
    }
}
/* Default Image thumbnail */
if (!function_exists('givingwalk_default_image_thumbnail')) {
    function givingwalk_default_image_thumbnail($args = array())
    {
        $args = wp_parse_args($args, array(
            'size'  => 'large',
            'class' => ''
        ));
        extract($args);
        /* use wpb_resize( $attach_id = null, $img_url = null, $width, $height, $crop = false ) */
        global $_wp_additional_image_sizes;
        $image_sizes = givingwalk_get_image_sizes();
        $size = explode('x', $size);
        $size_use = $size[0];
        if (!is_numeric($size_use)) {
            if (!empty($image_sizes[$size_use]) && is_array($image_sizes[$size_use])) {
                $width = $image_sizes[$size_use]['width'];
                $height = $image_sizes[$size_use]['height'];

            } else {
                $width = '1170';
                $height = '770';
            }
        } else {
            $width = $size[0];
            $height = isset($size[1]) ? $size[1] : $size[0];
        }

        $default_img = wpb_resize('', '/wp-content/themes/' . get_template() . '/assets/images/no-image.jpg', $width, $height, true);
        $thumbnail = '<img class="' . trim(implode(' ', array('default-thumb', $class))) . '" src="' . site_url() . $default_img['url'] . '" width="' . $default_img['width'] . '" height="' . $default_img['height'] . '" alt="' . get_option('blogname') . '" />';

        return $thumbnail;
    }
}

/*
 * Grid Settings 
*/
function givingwalk_grid_settings(array $args = array())
{
    extract($arr = array_merge(array(
        'group'      => '',
        'param_name' => '',
        'value'      => ''
    ), $args));
    $raw_params = array(
        array(
            'type'             => 'dropdown',
            'heading'          => esc_html__('Small Screen', 'givingwalk'),
            'param_name'       => 'col_sm',
            'edit_field_class' => 'vc_col-sm-3 vc_carousel_item',
            'value'            => array(1, 2, 3, 4, 6, 12),
            'std'              => 1,
            'dependency'       => array(
                'element' => $param_name,
                'value'   => $value,
            ),
            'group'            => $group
        ),
        array(
            'type'             => 'dropdown',
            'heading'          => esc_html__('Medium Screen', 'givingwalk'),
            'param_name'       => 'col_md',
            'edit_field_class' => 'vc_col-sm-3 vc_carousel_item',
            'value'            => array(1, 2, 3, 4, 6, 12),
            'std'              => 2,
            'dependency'       => array(
                'element' => $param_name,
                'value'   => $value,
            ),
            'group'            => $group
        ),
        array(
            'type'             => 'dropdown',
            'heading'          => esc_html__('Large Screen', 'givingwalk'),
            'param_name'       => 'col_lg',
            'edit_field_class' => 'vc_col-sm-3 vc_carousel_item',
            'value'            => array(1, 2, 3, 4, 6, 12),
            'std'              => 3,
            'dependency'       => array(
                'element' => $param_name,
                'value'   => $value,
            ),
            'group'            => $group
        ),
        array(
            'type'             => 'dropdown',
            'heading'          => esc_html__('Extra Large Screen', 'givingwalk'),
            'param_name'       => 'col_xl',
            'edit_field_class' => 'vc_col-sm-3 vc_carousel_item',
            'value'            => array(1, 2, 3, 4, 6, 12),
            'std'              => 4,
            'dependency'       => array(
                'element' => $param_name,
                'value'   => $value,
            ),
            'group'            => $group
        )
    );
    $params = [];
    foreach ($raw_params as $param) {
        if (!empty($param['dependency']) && empty($param['dependency']['element']))
            unset($param['dependency']);
        $params[] = $param;
    }
    return $params;
}

/* OWL Carousel Setting
 * All option will use in element use OWL Carousel Libs
*/
function givingwalk_owl_settings(array $args = array())
{
    extract($arr = array_merge(array(
        'group'      => '',
        'param_name' => '',
        'value'      => ''
    ), $args));
    $raw_params = array(
        array(
            'type'             => 'dropdown',
            'heading'          => esc_html__('Small Screen', 'givingwalk'),
            'param_name'       => 'owl_sm_items',
            'edit_field_class' => 'vc_col-sm-3 vc_carousel_item',
            'value'            => array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12),
            'std'              => 1,
            'dependency'       => array(
                'element' => $param_name,
                'value'   => $value,
            ),
            'group'            => $group
        ),
        array(
            'type'             => 'dropdown',
            'heading'          => esc_html__('Medium Screen', 'givingwalk'),
            'param_name'       => 'owl_md_items',
            'edit_field_class' => 'vc_col-sm-3 vc_carousel_item',
            'value'            => array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12),
            'std'              => 2,
            'dependency'       => array(
                'element' => $param_name,
                'value'   => $value,
            ),
            'group'            => $group
        ),
        array(
            'type'             => 'dropdown',
            'heading'          => esc_html__('Large Screen', 'givingwalk'),
            'param_name'       => 'owl_lg_items',
            'edit_field_class' => 'vc_col-sm-3 vc_carousel_item',
            'value'            => array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12),
            'std'              => 3,
            'dependency'       => array(
                'element' => $param_name,
                'value'   => $value,
            ),
            'group'            => $group
        ),
        array(
            'type'             => 'dropdown',
            'heading'          => esc_html__('Extra Large Screen', 'givingwalk'),
            'param_name'       => 'owl_xl_items',
            'edit_field_class' => 'vc_col-sm-3 vc_carousel_item',
            'value'            => array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12),
            'std'              => 4,
            'dependency'       => array(
                'element' => $param_name,
                'value'   => $value,
            ),
            'group'            => $group
        ),
        array(
            'type'        => 'dropdown',
            'heading'     => esc_html__('Number Row', 'givingwalk'),
            'description' => esc_html__('Choose number of row you want to show.', 'givingwalk'),
            'param_name'  => 'number_row',
            'value'       => array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10),
            'std'         => 1,
            'dependency'  => array(
                'element' => $param_name,
                'value'   => $value,
            ),
            'group'       => $group,
        ),

        array(
            'type'             => 'checkbox',
            'heading'          => esc_html__('Loop Items', 'givingwalk'),
            'param_name'       => 'loop',
            'std'              => 'false',
            'edit_field_class' => 'vc_col-sm-3 vc_carousel_item',
            'dependency'       => array(
                'element' => $param_name,
                'value'   => $value,
            ),
            'group'            => $group
        ),
        array(
            'type'             => 'checkbox',
            'heading'          => esc_html__('Center', 'givingwalk'),
            'param_name'       => 'center',
            'std'              => 'false',
            'edit_field_class' => 'vc_col-sm-3 vc_carousel_item',
            'dependency'       => array(
                'element' => $param_name,
                'value'   => $value,
            ),
            'group'            => $group
        ),
        array(
            'type'             => 'checkbox',
            'heading'          => esc_html__('Auto Width', 'givingwalk'),
            'param_name'       => 'autowidth',
            'std'              => 'false',
            'edit_field_class' => 'vc_col-sm-3 vc_carousel_item',
            'dependency'       => array(
                'element' => $param_name,
                'value'   => $value,
            ),
            'group'            => $group
        ),
        array(
            'type'             => 'checkbox',
            'heading'          => esc_html__('Auto Height', 'givingwalk'),
            'param_name'       => 'autoheight',
            'std'              => 'true',
            'edit_field_class' => 'vc_col-sm-3 vc_carousel_item',
            'dependency'       => array(
                'element' => $param_name,
                'value'   => $value,
            ),
            'group'            => $group
        ),

        array(
            'type'             => 'textfield',
            'heading'          => esc_html__('Items Space', 'givingwalk'),
            'param_name'       => 'margin',
            'value'            => 30,
            'edit_field_class' => 'vc_col-sm-4 vc_carousel_item',
            'dependency'       => array(
                'element' => $param_name,
                'value'   => $value,
            ),
            'group'            => $group
        ),
        array(
            'type'             => 'textfield',
            'heading'          => esc_html__('Stage Padding', 'givingwalk'),
            'param_name'       => 'stagepadding',
            'value'            => '0',
            'edit_field_class' => 'vc_col-sm-4 vc_carousel_item',
            'dependency'       => array(
                'element' => $param_name,
                'value'   => $value,
            ),
            'group'            => $group
        ),

        array(
            'type'             => 'textfield',
            'heading'          => esc_html__('Start Position', 'givingwalk'),
            'param_name'       => 'startposition',
            'value'            => '0',
            'edit_field_class' => 'vc_col-sm-4 vc_carousel_item',
            'dependency'       => array(
                'element' => $param_name,
                'value'   => $value,
            ),
            'group'            => $group
        ),

        array(
            'type'       => 'checkbox',
            'param_name' => 'nav',
            'value'      => array(
                esc_html__('Show Next/Preview button', 'givingwalk') => 'true'
            ),
            'std'        => 'false',
            'dependency' => array(
                'element' => $param_name,
                'value'   => $value,
            ),
            'group'      => $group
        ),
        array(
            'type'             => 'dropdown',
            'heading'          => esc_html__('Nav Style', 'givingwalk'),
            'param_name'       => 'nav_style',
            'value'            => givingwalk_carousel_nav_style(),
            'std'              => '',
            'dependency'       => array(
                'element' => 'nav',
                'value'   => 'true',
            ),
            'edit_field_class' => 'vc_col-sm-6 vc_carousel_item',
            'group'            => $group
        ),
        array(
            'type'             => 'dropdown',
            'heading'          => esc_html__('Nav Position', 'givingwalk'),
            'param_name'       => 'nav_pos',
            'value'            => givingwalk_carousel_nav_pos(),
            'std'              => '',
            'dependency'       => array(
                'element'            => 'nav_style',
                'value_not_equal_to' => array('1'),
            ),
            'edit_field_class' => 'vc_col-sm-6 vc_carousel_item',
            'group'            => $group
        ),
        array(
            'type'       => 'checkbox',
            'value'      => array(
                esc_html__('Show Dots', 'givingwalk') => 'true'
            ),
            'param_name' => 'dots',
            'std'        => 'true',
            'dependency' => array(
                'element' => $param_name,
                'value'   => $value,
            ),
            'group'      => $group
        ),
        array(
            'type'             => 'dropdown',
            'heading'          => esc_html__('Dots Style', 'givingwalk'),
            'param_name'       => 'dot_style',
            'value'            => givingwalk_carousel_dots_style(),
            'std'              => '',
            'dependency'       => array(
                'element' => 'dots',
                'value'   => 'true',
            ),
            'edit_field_class' => 'vc_col-sm-6 vc_carousel_item',
            'dependency'       => array(
                'element' => $param_name,
                'value'   => $value,
            ),
            'group'            => $group
        ),
        array(
            'type'             => 'dropdown',
            'heading'          => esc_html__('Dots Position', 'givingwalk'),
            'param_name'       => 'dot_pos',
            'value'            => givingwalk_carousel_dot_pos(),
            'std'              => '',
            'dependency'       => array(
                'element' => 'dots',
                'value'   => array('true'),
            ),
            'edit_field_class' => 'vc_col-sm-6 vc_carousel_item',
            'group'            => $group
        ),

        array(
            'type'       => 'checkbox',
            'value'      => array(
                esc_html__('Auto Play', 'givingwalk') => 'true'
            ),
            'param_name' => 'autoplay',
            'std'        => 'true',
            'dependency' => array(
                'element' => $param_name,
                'value'   => $value,
            ),
            'group'      => $group
        ),
        array(
            'type'             => 'textfield',
            'heading'          => esc_html__('Smart Speed', 'givingwalk'),
            'param_name'       => 'smartspeed',
            'value'            => '250',
            'description'      => esc_html__('Speed scroll of each item', 'givingwalk'),
            'edit_field_class' => 'vc_col-sm-4 vc_carousel_item',
            'dependency'       => array(
                'element' => 'autoplay',
                'value'   => 'true',
            ),
            'group'            => $group
        ),
        array(
            'type'             => 'textfield',
            'heading'          => esc_html__('Auto Play TimeOut', 'givingwalk'),
            'param_name'       => 'autoplaytimeout',
            'value'            => '5000',
            'dependency'       => array(
                'element' => 'autoplay',
                'value'   => 'true',
            ),
            'edit_field_class' => 'vc_col-sm-4 vc_carousel_item',
            'group'            => $group
        ),
        array(
            'type'             => 'checkbox',
            'heading'          => esc_html__('Pause on mouse hover', 'givingwalk'),
            'param_name'       => 'autoplayhoverpause',
            'std'              => 'true',
            'dependency'       => array(
                'element' => 'autoplay',
                'value'   => 'true',
            ),
            'edit_field_class' => 'vc_col-sm-4 vc_carousel_item',
            'group'            => $group
        ),
        array(
            'type'             => 'animation_style',
            'class'            => '',
            'heading'          => esc_html__('Animation In', 'givingwalk'),
            'param_name'       => 'owlanimation_in',
            'std'              => '',
            'settings'         => array(
                'type' => array(
                    'in'
                ),
            ),
            'edit_field_class' => 'vc_col-sm-6 vc_carousel_item',
            'dependency'       => array(
                'element' => $param_name,
                'value'   => $value,
            ),
            'group'            => $group
        ),
        array(
            'type'             => 'animation_style',
            'class'            => '',
            'heading'          => esc_html__('Animation Out', 'givingwalk'),
            'param_name'       => 'owlanimation_out',
            'std'              => '',
            'settings'         => array(
                'type' => array(
                    'out'
                ),
            ),
            'edit_field_class' => 'vc_col-sm-6 vc_carousel_item',
            'dependency'       => array(
                'element' => $param_name,
                'value'   => $value,
            ),
            'group'            => $group
        ),
    );
    $params = [];
    foreach ($raw_params as $param) {
        if (!empty($param['dependency']) && empty($param['dependency']['element']))
            unset($param['dependency']);
        $params[] = $param;
    }
    return $params;
}

/**
 * OWL Nav & Dots
 * Nav Position givingwalk_carousel_nav_pos(),
 * Nav Style givingwalk_carousel_nav_style(),
 * Dot style givingwalk_carousel_dots_style()
 */
function givingwalk_carousel_nav_pos()
{
    $carousel_nav_pos = array(
        esc_html__('Default', 'givingwalk')          => '',
        esc_html__('Vertical Inside', 'givingwalk')  => 'nav-vertical inside',
        esc_html__('Vertical Outside', 'givingwalk') => 'nav-vertical outside',
    );
    return $carousel_nav_pos;
}

function givingwalk_carousel_nav_style()
{
    $carousel_nav_style = array(
        esc_html__('Default', 'givingwalk')     => '',
        esc_html__('Dots In Nav', 'givingwalk') => '1',
    );
    return $carousel_nav_style;
}

function givingwalk_carousel_dots_style()
{
    $carousel_dots_style = array(
        esc_html__('Default', 'givingwalk')   => '',
        esc_html__('Thumbnail', 'givingwalk') => 'dots-thumbnail',
        esc_html__('Progress', 'givingwalk')  => 'dots-progress',
    );
    return $carousel_dots_style;
}

function givingwalk_carousel_dot_pos()
{
    return array(
        esc_html__('Default', 'givingwalk') => '',
        esc_html__('Top', 'givingwalk')     => '1',
    );
}

function givingwalk_owl_preload($layout_type)
{
    if ($layout_type === 'carousel') echo '<div class="owl-preload"></div>';
}

function givingwalk_owl_nav($layout_type, $nav_style, $nav_pos)
{
    if ($layout_type === 'carousel') :
        if ($nav_style !== '1'): ?>
            <div class="<?php echo trim(implode(' ', array('owl-nav', $nav_pos))); ?>"></div>
        <?php endif;
    endif;
}

function givingwalk_owl_dots($layout_type, $dot_style, $dot_pos)
{
    if ($layout_type === 'carousel') :
        if ($dot_pos !== '1'): ?>
            <div class="<?php echo trim(implode(' ', array('owl-dots', $dot_style))); ?>"></div>
        <?php endif;
    endif;
}

function givingwalk_owl_dots_in_nav($layout_type, $nav_style)
{
    if ($layout_type === 'carousel' && $nav_style === '1') :
        ?>
        <div class="owl-nav-wrap">
            <div class="owl-dots-wrap"></div>
        </div>
    <?php endif;
}

function givingwalk_owl_dots_top($layout_type, $dot_pos, $dot_style)
{
    if ($layout_type === 'carousel' && $dot_pos === '1') echo '<div class="owl-dots ' . $dot_style . '"></div>';
}

/* Call OWL Settings */
function givingwalk_owl_call_settings($atts)
{
    extract($atts);
    if ($layout_type !== 'carousel') return;
    wp_enqueue_script('vc_pageable_owl-carousel');
    wp_enqueue_script('red-owlcarousel');
    wp_enqueue_style( 'vc_pageable_owl-carousel-css');
    wp_enqueue_style( 'animate-css');

    /* Carousel Settings */
    $icon_prev = is_rtl() ? 'right' : 'left';
    $icon_next = is_rtl() ? 'left' : 'right';

    $navContainer = '.' . $el_id . ' .owl-nav';
    $dotsContainer = '.' . $el_id . ' .owl-dots';

    $nav_icon = array('<i class="fa fa-angle-' . $icon_prev . '" data-title="' . esc_html__('Prev', 'givingwalk') . '"></i>', '<i class="fa fa-angle-' . $icon_next . '" data-title="' . esc_html__('Next', 'givingwalk') . '"></i>');
    $rtl = is_rtl() ? true : false;
    $dotsData = false;

    /* Dots Style */
    if ($dot_style === 'dots-thumbnail') {
        $dotsData = true;
    }
    global $cms_carousel;
    $cms_carousel[$el_id] = array(
        'rtl'                => $rtl,
        'margin'             => (int)$margin,
        'loop'               => $loop,
        'center'             => $center,
        'stagePadding'       => (int)$stagepadding,
        'autoWidth'          => $autowidth,
        'startPosition'      => (int)$startposition,
        'nav'                => $nav,
        'navContainer'       => $navContainer,
        'navText'            => $nav_icon,
        'dots'               => $dots,
        'dotsContainer'      => $dotsContainer,
        'dotsData'           => $dotsData,
        'autoplay'           => $autoplay,
        'autoplayTimeout'    => (int)$autoplaytimeout,
        'autoplayHoverPause' => $autoplayhoverpause,
        'smartSpeed'         => (int)$smartspeed,
        'autoHeight'         => $autoheight,
        'animateIn'          => $owlanimation_in,
        'animateOut'         => $owlanimation_out,
        'responsiveClass'    => true,
        'slideBy'            => 'page',
        'responsive'         => array(
            0    => array(
                'items' => (int)$owl_sm_items,
            ),
            768  => array(
                'items' => (int)$owl_md_items,
            ),
            992  => array(
                'items' => (int)$owl_lg_items,
            ),
            1200 => array(
                'items' => (int)$owl_xl_items,
            )
        )
    );

    wp_localize_script('vc_pageable_owl-carousel', 'cmscarousel', $cms_carousel);
}

/* Call Masonry Settings */
function givingwalk_masonry_call_settings($atts)
{
    extract($atts);
    if ($layout_type !== 'masonry') return;
    wp_enqueue_script('vc_masonry');
}

/**
 * Icon font libs
 *
 * Add default VC Icon
 * add new icon from theme
 *
 * Themify Icon
 *
 * @author Red Team
 * @since 1.0.0
 */
function givingwalk_icon_libs($args = array())
{
    $args = wp_parse_args($args, array(
        'group'        => esc_html__('Icon', 'givingwalk'),
        'field_prefix' => 'i_',
        'dependency'   => 'add_icon'
    ));
    extract($args);
    require_once vc_path_dir('CONFIG_DIR', 'content/vc-icon-element.php');
    /**
     * @source
     * vc_map_integrate_shortcode( $shortcode, $field_prefix = '', $group_prefix = '', $change_fields = null, $dependency = null )
     **/
    $icons_params = vc_map_integrate_shortcode(vc_icon_element_params(), $field_prefix, $group, array(
        'include_only_regex' => '/^(type|icon_\w*)/',
        // we need only type, icon_fontawesome, icon_blabla..., NOT color and etc
    ), array(
        'element' => $dependency,
        'value'   => 'true',
    ));

    // populate integrated vc_icons params.
    if (is_array($icons_params) && !empty($icons_params)) {
        foreach ($icons_params as $key => $param) {
            if (is_array($param) && !empty($param)) {
                if ($field_prefix . 'type' === $param['param_name']) {
                    /* append givingwalk icon to dropdown 
                     * use: 
                     * $icons_params[ $key ]['value'][ esc_html__( 'Themify Icon', 'givingwalk' ) ] = 'themify';
                     * 
                    */
                    $icons_params[ $key ]['value'][ esc_html__( 'Flaticon Icon', 'givingwalk' ) ] = 'flaticon';
                    /* Change default font icon
                     * $icons_params[ $key ]['std'] = 'fontawesome';
                    */

                }
                if (isset($param['admin_label'])) {
                    /*remove admin label*/
                    unset($icons_params[$key]['admin_label']);
                }
            }
        }
    }
    return $icons_params;
}

function givingwalk_icon_libs_icon($args = array())
{
    $args = wp_parse_args($args, array(
        'group'        => esc_html__('Icon', 'givingwalk'),
        'field_prefix' => 'i_',
    ));
    extract($args);
    return array(
        /* Theme Icons */
        array(
            'type'       => 'iconpicker',
            'heading'    => esc_html__( 'Icon', 'givingwalk' ),
            'param_name' => $field_prefix.'icon_flaticon',
            'value'      => '',
            'settings'   => array(
              'emptyIcon'    => false,
              'type'         => 'flaticon',
              'iconsPerPage' => 100,
            ),
            'dependency'  => array(
              'element' => $field_prefix.'type',
              'value'   => 'flaticon',
            ),
            'description' => esc_html__( 'Select icon from library.', 'givingwalk' ),
            'group'       => $group
        ),
    );
}

/**
 * Register icons for Visual Composer
 */
function givingwalk_vc_icon_fonts_register()
{
    wp_register_style('font-flaticon', get_template_directory_uri() . '/assets/css/flaticon.css', array(), wp_get_theme()->get('Version'));
}

add_action('wp_enqueue_scripts', 'givingwalk_vc_icon_fonts_register');
add_action('admin_enqueue_scripts', 'givingwalk_vc_icon_fonts_register');

/**
 * Enqueues icons for Visual Composer
 */
function givingwalk_vc_icon_fonts_enqueue()
{
    wp_enqueue_style('font-flaticon');
}

add_action('vc_backend_editor_enqueue_js_css', 'givingwalk_vc_icon_fonts_enqueue');
add_action('vc_frontend_editor_enqueue_js_css', 'givingwalk_vc_icon_fonts_enqueue');

/**
 * Call icons for Visual Composer
 */
add_action('vc_enqueue_font_icon_element', 'givingwalk_vc_icon_font');
function givingwalk_vc_icon_font($font)
{
    switch ($font) {
        case 'flaticon':
            wp_enqueue_style('font-flaticon');
            break;
    }
}

function givingwalk_btn_types(){
    return array(
        esc_html__( 'Default', 'givingwalk' )        => 'btn',
        esc_html__( 'Primary', 'givingwalk' )        => 'btn-primary',
        esc_html__( 'Default Alt', 'givingwalk' )    => 'btn btn-alt',
        esc_html__( 'Primary Alt', 'givingwalk' )    => 'btn-primary btn-alt',
        esc_html__( 'Alt White', 'givingwalk' )      => 'btn btn-white btn-alt',
        esc_html__( 'Simple Link', 'givingwalk' )    => 'simple',
    );
}
function givingwalk_btn_size(){
    return array(
        esc_html__( 'Default', 'givingwalk' )  => '',
        esc_html__( 'Small', 'givingwalk' )    => 'btn-small', 
        esc_html__( 'Medium', 'givingwalk' )   => 'btn-medium',
        esc_html__( 'Large', 'givingwalk' )    => 'btn-large',
    );
}

/**
 * List of thumbnails size
 * @since 1.0.0
 * @author Red Team
 */
function givingwalk_thumbnail_sizes()
{
    return array(
        esc_html__('Thumbnail', 'givingwalk')      => 'thumbnail',
        esc_html__('Medium', 'givingwalk')         => 'medium',
        esc_html__('Large', 'givingwalk')          => 'large',
        esc_html__('Post Thumbnail', 'givingwalk') => 'post-thumbnail',
        esc_html__('Full', 'givingwalk')           => 'full',
        esc_html__('Custom', 'givingwalk')         => 'custom',

    );
}


//add_filter('EF4_Vc_Grid_Item_template', 'givingwalk_vc_grid_filter',10,3); 
function givingwalk_vc_grid_filter($html,$atts=[],$filter_terms=''){
    global $opt_theme_options; var_dump($atts['vc_template']); 
    switch ($atts['vc_template']) {

        case 'Causes Style 1':
            $col = $atts['element_width'];
            $class = ' col-xs-12 col-sm-12 col-md-'.$col.' col-lg-'.$col.'';
             
            ob_start(); 
            ?>
            <div class="template-causes-style-1 vc_grid-item vc_clearfix {{ filter_terms_css_classes }} <?php echo esc_attr($class); ?>">
                {{post_data:casues_image}}
                <div class="entry-info">
                    {{post_data:casues_cats}}
                    <h4><a href="{{ post_link_url }}" title="{{ post_title }}">{{ post_data:post_title }}</a></h4>
                    <div class="stories-desc">
                        {{ post_data:post_excerpt }}
                    </div>
                    <div class="donation-value">
                        <span class="lbl"><?php echo esc_html__('Raised:','givingwalk');?></span>
                        <span class="value">{{ post_data:casues_raised }}</span>
                    </div>
                    <?php givingwalk_show_donate_button(['class'=>'give-btn','title'=>'<i class="fa fa-heart"></i>']) ?>
                </div>
            </div>
            
            <?php 
            $html = ob_get_clean();
            return $html;
            break;
        default:
            return $html;
            break;
    }
}
/**
 * New Element For VC Grid Builder
 *
 * User for VC Post Grid / VC Post Masonry Grid
 *
 * @since 1.0.0
 */

/* Add filter data */

add_filter('vc_gitem_template_attribute_post_data', 'givingwalk_gitem_template_attribute_post_data', 11, 2);
function givingwalk_gitem_template_attribute_post_data($html, $data)
{
    $date = $data['post']->post_date;
    $post_type = $data['post']->post_type;
    $post_ID = $data['post']->ID;
    $post_excerpt = !empty($data['post']->post_excerpt) ? $data['post']->post_excerpt : $data['post']->post_content;

    $keys_avaliable = ['givingwalk_gitem_excerpt'];
    $shortcode_meta = []; // data send fill to this
    foreach ($keys_avaliable as $key) {
        $key_check = $key . '_';
        if (strpos($data['data'], $key_check) === 0) {
            $meta_send = substr($data['data'], strlen($key_check));
            $meta_send = str_replace(['[', ']'], ['{', '}'], $meta_send);
            $shortcode_meta = json_decode($meta_send, true);
            $data['data'] = $key;
            break;
        }
    }
    ob_start();
    switch ($data['data']) {
        case 'givingwalk_gitem_excerpt':
            $excerpt_lenght = $shortcode_meta['excerpt_lenght'];
            $html = givingwalk_excerpt($excerpt_lenght,$data['post'],'<div class="post-excerpt">','</div>');
            break;
        case 'givingwalk_gitem_readmore':
            $html = '<footer class="clearfix"><a class="archive-readmore btn" href="' . get_the_permalink() . '">' . esc_html__('Read more', 'givingwalk') . '</a></footer>';
            break;
    }
    $echo_html = ob_get_clean();
    return (empty($echo_html)) ? $html : $echo_html;
}


/* VC Grid: givingwalk Excerpt */
ef4_vc_grid_map(
    array(
        'name'        => esc_html__('Givingwalk Post Excerpt', 'givingwalk'),
        'base'        => 'givingwalk_gitem_excerpt',
        'icon'        => 'vc_icon-vc-gitem-post-meta',
        'category'    => esc_html__('givingwalk', 'givingwalk'),
        'description' => esc_html__('Excerpt or manual excerpt', 'givingwalk'),
        'params'      => array(
            array(
                'type'        => 'textfield',
                'param_name'  => 'excerpt_lenght',
                'value'       => '61',
                'heading'     => esc_html__('Excerpt Lenght', 'givingwalk'),
                'description' => esc_html__('Enter the number of word you want to show!', 'givingwalk')
            ),
            array(
                'type'       => 'checkbox',
                'param_name' => 'show_readmore',
                'value'      => array(
                    esc_html__('Show Read More button', 'givingwalk') => 'yes'
                ),
                'std'        => 'no',
            )
        )
    )
);

class EF4VCGridBuilder_givingwalk_gitem_excerpt extends EF4VCGridBuilder
{
    public function content($atts, $content = null)
    {
        $atts_extra = shortcode_atts(array(
            'excerpt_lenght' => '61',
            'show_readmore'  => 'no'
        ), $atts);
        extract($atts_extra);

        $el_options = array(
            'excerpt_lenght' => $excerpt_lenght,
        );
        $meta_options = str_replace(['{', '}'], ['[', ']'], json_encode($el_options));
        echo "{{post_data:givingwalk_gitem_excerpt_{$meta_options}}}";

        if ('yes' === $show_readmore) echo '{{post_data:givingwalk_gitem_readmore}}';
    }
}


/**
 * VC Grid Builder
 * Adding New Element For VC Grid Builder
 *
 * User for VC Post Grid / VC Post Masonry Grid
 *
 * @since 1.0.0
 * @source https://kb.wpbakery.com/docs/developers-how-tos/adding-custom-shortcode-to-grid-builder/
 *
*/

/* VC Grid: givingwalk Meta */
add_filter( 'vc_grid_item_shortcodes', 'givingwalk_add_grid_shortcodes' );
function givingwalk_add_grid_shortcodes( $shortcodes ) {

    $taxonomiesForFilter = array();
    if ( 'vc_edit_form' === vc_post_param( 'action' ) ) {
        $vcTaxonomiesTypes = vc_taxonomies_types();
        if ( is_array( $vcTaxonomiesTypes ) && ! empty( $vcTaxonomiesTypes ) ) {
            foreach ( $vcTaxonomiesTypes as $t => $data ) {
                if ( 'post_format' !== $t && is_object( $data ) ) {
                    $taxonomiesForFilter[ $data->labels->name . '(' . $t . ')' ] = $t;
                }
            }
        }
    }

    $shortcodes['givingwalk_gitem_taxo'] = array(
        'name'      => esc_html__('Givingwalk Taxonomies', 'givingwalk'),
        'base'      => 'givingwalk_gitem_taxo',
        'icon'      => 'vc_icon-vc-gitem-post-meta',
        'category'  => esc_html__('givingwalk', 'givingwalk'),
        'post_type' => Vc_Grid_Item_Editor::postType(),
        'params'    => array(
            array(
                'type'        => 'dropdown',
                'heading'     => esc_html__( 'Taxonomies', 'givingwalk' ),
                'param_name'  => 'taxo_source',
                'value'       => $taxonomiesForFilter,
                'save_always' => true,
                'description' => esc_html__( 'Select taxonomy to show.', 'givingwalk' ),
                'admin_label' => true
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__( 'Seperator', 'givingwalk' ),
                'param_name'  => 'taxo_separator',
                'value'       => ', ',
                'save_always' => true,
                'description' => esc_html__( 'Enter Separator you want to show', 'givingwalk' ),
                'admin_label' => true
            ),
        )
    );
    $shortcodes['givingwalk_gitem_causes_raised'] = array(
        'name'      => esc_html__('Givingwalk Causes Raised', 'givingwalk'),
        'base'      => 'givingwalk_gitem_causes_raised',
        'icon'      => 'vc_icon-vc-gitem-post-meta',
        'category'  => esc_html__('givingwalk', 'givingwalk'),
        'post_type' => Vc_Grid_Item_Editor::postType(),
        'params'    => array(
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__( 'Title', 'givingwalk' ),
                'param_name'  => 'causes_raised_title',
                'value'       => '',
                'save_always' => true,
                'description' => esc_html__( 'Enter title you want to show', 'givingwalk' ),
                'admin_label' => true
            ),
        )
    );
    $shortcodes['givingwalk_gitem_causes_donation_btn'] = array(
        'name'      => esc_html__('Givingwalk Causes Donation Button', 'givingwalk'),
        'base'      => 'givingwalk_gitem_causes_donation_btn',
        'icon'      => 'vc_icon-vc-gitem-post-meta',
        'category'  => esc_html__('givingwalk', 'givingwalk'),
        'post_type' => Vc_Grid_Item_Editor::postType(),
        'params'    => array(
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__( 'Icon class', 'givingwalk' ),
                'param_name'  => 'causes_donation_btn_icon',
                'value'       => 'fa fa-heart',
                'save_always' => true,
                'description' => esc_html__( 'Enter icon class use icon font', 'givingwalk' ),
                'admin_label' => true
            ),
        )
    );
    $shortcodes['givingwalk_gitem_events_schedule'] = array(
        'name'      => esc_html__('Givingwalk Events Schedule', 'givingwalk'),
        'base'      => 'givingwalk_gitem_events_schedule',
        'icon'      => 'vc_icon-vc-gitem-post-meta',
        'category'  => esc_html__('givingwalk', 'givingwalk'),
        'post_type' => Vc_Grid_Item_Editor::postType(),
        'params'    => array(
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__( 'class', 'givingwalk' ),
                'param_name'  => 'events_schedule_class',
                'value'       => '',
                'save_always' => true,
                'description' => esc_html__( 'Enter class use for event schedule', 'givingwalk' ),
                'admin_label' => true
            ),
        )
    );
    $shortcodes['givingwalk_gitem_events_organizer'] = array(
        'name'      => esc_html__('Givingwalk Events Organizer', 'givingwalk'),
        'base'      => 'givingwalk_gitem_events_organizer',
        'icon'      => 'vc_icon-vc-gitem-post-meta',
        'category'  => esc_html__('givingwalk', 'givingwalk'),
        'post_type' => Vc_Grid_Item_Editor::postType(),
        'params'    => array(
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__( 'class', 'givingwalk' ),
                'param_name'  => 'events_org_class',
                'value'       => '',
                'save_always' => true,
                'description' => esc_html__( 'Enter class use for event organizer', 'givingwalk' ),
                'admin_label' => true
            ),
        )
    );
    $shortcodes['givingwalk_gitem_events_layout2'] = array(
        'name'      => esc_html__('Givingwalk Events Layout 2', 'givingwalk'),
        'base'      => 'givingwalk_gitem_events_layout2',
        'icon'      => 'vc_icon-vc-gitem-post-meta',
        'category'  => esc_html__('givingwalk', 'givingwalk'),
        'post_type' => Vc_Grid_Item_Editor::postType(),
        'params'    => array(
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__( 'class', 'givingwalk' ),
                'param_name'  => 'events_layout2_class',
                'value'       => '',
                'save_always' => true,
                'description' => esc_html__( 'Enter class use for event layout 2', 'givingwalk' ),
                'admin_label' => true
            ),
        )
    );
    return $shortcodes;
}

/* VC Grid: givingwalk Taxonomies */

add_ef4_shortcode( 'givingwalk_gitem_taxo', 'givingwalk_gitem_taxo_render' );

function givingwalk_gitem_taxo_render($atts, $content, $tag) {
    $atts_query = http_build_query( array(
        'atts' => $atts,
    ) );
    $html = "{{ givingwalk_gitem_taxo:{$atts_query}}}";
   return $html;
}

add_filter( 'vc_gitem_template_attribute_givingwalk_gitem_taxo', 'vc_gitem_template_attribute_givingwalk_gitem_taxo', 10, 2 );
function vc_gitem_template_attribute_givingwalk_gitem_taxo( $value, $data ) {
   /**
    * @var Wp_Post $post
    * @var string $data
    */
    $post = $data['post'];
    $atts = [];
    parse_str(  $data['data'], $atts );
    if(!empty($atts['atts']))
        $atts = $atts['atts'];
    extract($atts);
    ob_start();
    if(has_term('',$taxo_source)) the_terms( $post->ID, $taxo_source, '<div class="gitem-entry-meta">',$taxo_separator.' ','</div>' );
    $output = ob_get_clean();
    
    if($output) return $output;
}

/* VC Grid: givingwalk causes raised */
add_ef4_shortcode( 'givingwalk_gitem_causes_raised', 'givingwalk_gitem_causes_raised_render' );
function givingwalk_gitem_causes_raised_render($atts, $content, $tag) {
    $atts_query = http_build_query( array(
        'atts' => $atts,
    ) );

    $html = "{{ givingwalk_gitem_causes_raised:{$atts_query}}}";
   return $html;
}

add_filter( 'vc_gitem_template_attribute_givingwalk_gitem_causes_raised', 'vc_gitem_template_attribute_givingwalk_gitem_causes_raised_display', 10, 2 );
function vc_gitem_template_attribute_givingwalk_gitem_causes_raised_display( $value, $data ) {
   /**
    * @var Wp_Post $post
    * @var string $data
    */
    $post = $data['post'];
    $atts = [];
    parse_str(  $data['data'], $atts );
    if(!empty($atts['atts']))
        $atts = $atts['atts'];
    extract($atts);
    ob_start();
    $meta = apply_filters('ef4_get_post_meta',['donation_raised'=>''], $post->ID,false);
    $raised = $meta['donation_raised'];
    $default_amount = '$'.$raised;
    $amount_value = apply_filters('ef4_payment_create_amount',$default_amount,$raised);
    echo '<div class="donation-value">';
        if(!empty($atts['causes_raised_title']))
        echo '<span class="lbl">'.esc_html($atts['causes_raised_title']).'</span>';
        echo '<span class="value">'. esc_html($amount_value).'</span>';
    echo '</div>';
    $output = ob_get_clean();
    
    if($output) return $output;
}

/* VC Grid: givingwalk causes donation button */
add_ef4_shortcode( 'givingwalk_gitem_causes_donation_btn', 'givingwalk_gitem_causes_donation_btn_render' );
function givingwalk_gitem_causes_donation_btn_render($atts, $content, $tag) {
    $atts_query = http_build_query( array(
        'atts' => $atts,
    ) );

    $html = "{{ givingwalk_gitem_causes_donation_btn:{$atts_query}}}";
   return $html;
}

add_filter( 'vc_gitem_template_attribute_givingwalk_gitem_causes_donation_btn', 'vc_gitem_template_attribute_givingwalk_gitem_causes_donation_btn_display', 10, 2 );
function vc_gitem_template_attribute_givingwalk_gitem_causes_donation_btn_display( $value, $data ) {
   /**
    * @var Wp_Post $post
    * @var string $data
    */
    $post = $data['post'];
    $atts = [];
    parse_str(  $data['data'], $atts );
    if(!empty($atts['atts']))
        $atts = $atts['atts'];
    extract($atts);
    ob_start();
        $btn_cls = !empty($atts['causes_donation_btn_icon']) ? $atts['causes_donation_btn_icon'] : 'fa fa-heart';
        givingwalk_show_donate_button(['class'=>'give-btn','title'=>'<i class="'. esc_attr($btn_cls) .'"></i>']) ;
    $output = ob_get_clean();
    
    if($output) return $output;
}

/* VC Grid: givingwalk events schedule */
add_ef4_shortcode( 'givingwalk_gitem_events_schedule', 'givingwalk_gitem_events_schedule_render' );
function givingwalk_gitem_events_schedule_render($atts, $content, $tag) {
    $atts_query = http_build_query( array(
        'atts' => $atts,
    ) );

    $html = "{{ givingwalk_gitem_events_schedule:{$atts_query}}}";
   return $html;
}

add_filter( 'vc_gitem_template_attribute_givingwalk_gitem_events_schedule', 'vc_gitem_template_attribute_givingwalk_gitem_events_schedule_display', 10, 2 );
function vc_gitem_template_attribute_givingwalk_gitem_events_schedule_display( $value, $data ) {
   /**
    * @var Wp_Post $post
    * @var string $data
    */
    $post = $data['post'];
    $atts = [];
    parse_str(  $data['data'], $atts );
    if(!empty($atts['atts']))
        $atts = $atts['atts'];
    extract($atts);
    ob_start();
        $cls = !empty($atts['events_schedule_class']) ? $atts['events_schedule_class'] : '';
        echo '<div class="events-schedule '.esc_attr($cls).'">';
            echo '<div class="event-date-start">';
                echo '<span>'.esc_html__('Started:','givingwalk').'</span>'. tribe_get_start_date(null,true,'d F Y',null).' '. esc_html__('at','givingwalk').' '. tribe_get_start_time(null,'g:i a',null);
            echo '</div>';
            echo '<div class="event-date-end">';
                echo '<span>'.esc_html__('Ending:','givingwalk').'</span>'. tribe_get_end_date(null,true,'d F Y',null).' '. esc_html__('at','givingwalk').' '. tribe_get_end_time(null,'g:i a',null);
            echo '</div>';
        echo '</div>';

    $output = ob_get_clean();
    
    if($output) return $output;
}

/* VC Grid: givingwalk events organizer */
add_ef4_shortcode( 'givingwalk_gitem_events_organizer', 'givingwalk_gitem_events_organizer_render' );
function givingwalk_gitem_events_organizer_render($atts, $content, $tag) {
    $atts_query = http_build_query( array(
        'atts' => $atts,
    ) );

    $html = "{{ givingwalk_gitem_events_organizer:{$atts_query}}}";
   return $html;
}

add_filter( 'vc_gitem_template_attribute_givingwalk_gitem_events_organizer', 'vc_gitem_template_attribute_givingwalk_gitem_events_organizer_display', 10, 2 );
function vc_gitem_template_attribute_givingwalk_gitem_events_organizer_display( $value, $data ) {
   /**
    * @var Wp_Post $post
    * @var string $data
    */
    $post = $data['post'];
    $atts = [];
    parse_str(  $data['data'], $atts );
    if(!empty($atts['atts']))
        $atts = $atts['atts'];
    extract($atts);
    ob_start();
        $organizer_ids = tribe_get_organizer_ids();
        $cls = !empty($atts['events_org_class']) ? $atts['events_org_class'] : '';
        if(count($organizer_ids) > 0){
            echo '<div class="org-wrap '.esc_attr($cls).'">';
            foreach ( $organizer_ids as $organizer ) {
                if ( ! $organizer ) {
                    continue;
                }
                $meta = apply_filters('ef4_get_post_meta',['avatar_image'=>''],$organizer,true);

                $organizer_post = get_post($organizer);
                echo '<div class="org-item">';
                    echo '<div class="org-avatar">';
                        echo '<img src="'.wp_get_attachment_url($meta['avatar_image']).'" alt="org-avatar" />';
                    echo '</div>';
                    echo '<div class="org-info">';
                        echo '<h4>'.esc_html( $organizer_post->post_title).'</h4>';
                        echo '<p>'. esc_html__('Organizer','givingwalk').'</p>';
                    echo '</div>';
                echo '</div>';
            }
            echo '</div>';
        }

    $output = ob_get_clean();
    
    if($output) return $output;
}

/* VC Grid: givingwalk events layout 2 */
add_ef4_shortcode( 'givingwalk_gitem_events_layout2', 'givingwalk_gitem_events_layout2_render' );
function givingwalk_gitem_events_layout2_render($atts, $content, $tag) {
    $atts_query = http_build_query( array(
        'atts' => $atts,
    ) );

    $html = "{{ givingwalk_gitem_events_layout2:{$atts_query}}}";
   return $html;
}

add_filter( 'vc_gitem_template_attribute_givingwalk_gitem_events_layout2', 'vc_gitem_template_attribute_givingwalk_gitem_events_layout2_display', 10, 2 );
function vc_gitem_template_attribute_givingwalk_gitem_events_layout2_display( $value, $data ) {
   /**
    * @var Wp_Post $post
    * @var string $data
    */
    $post = $data['post'];
    $atts = [];
    parse_str(  $data['data'], $atts );
    if(!empty($atts['atts']))
        $atts = $atts['atts'];
    extract($atts);
    ob_start();
        $cls = !empty($atts['events_layout2_class']) ? $atts['events_layout2_class'] : '';
        $organizer_ids = tribe_get_organizer_ids();
        $venue_id = tribe_get_venue_id();
        $organic_name = array();
        if(count($organizer_ids) > 0){
            foreach ( $organizer_ids as $organizer ) {
                if ( ! $organizer ) {
                    continue;
                }
                $organizer_post = get_post($organizer);
                $organic_name[] = $organizer_post->post_title;
            }
        }
        echo '<div class="event-content-wrap '.esc_attr($cls).'">';
            if(count($organic_name) > 0){
                echo '<div class="event-date">';
                    echo '<span class="event-day">'. get_the_date('d').'</span>';
                    echo '<span class="event-month">'. get_the_date('M').'</span>';
                echo '</div>';
            }
            echo '<div class="org-name"><span>'. esc_html__('Organized By: ','givingwalk').'</span>'. join(', ',$organic_name).'</div>';
            echo '<h4 class="list-event-title">';
            ?>
                <a class="tribe-event-url" href="<?php echo esc_url( tribe_get_event_link() ); ?>" title="<?php the_title_attribute() ?>" rel="bookmark"><?php the_title() ?></a>
            <?php
            echo '</h4>';
            echo '<div class="list-event-action">';
                if($venue_id){ 
                    $location_add = tribe_get_address( $venue_id );
                    if(!empty($location_add))
                        echo '<p class="location"><i class="flaticon-signs"></i>'.esc_html($location_add).'</p>';
                }
                givingwalk_show_buy_ticket_button();
            echo '</div>';
            
        echo '</div>';
        

    $output = ob_get_clean();
    
    if($output) return $output;
}

