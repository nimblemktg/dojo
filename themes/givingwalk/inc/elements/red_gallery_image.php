<?php
vc_map(array(
    'name' => 'Red Gallery Image',
    'base' => 'red_gallery_image',
    'icon' => 'cs_icon_for_vc',
    'category'    => esc_html__('RedExp', 'givingwalk'),
    'description' => esc_html__('Show gallery images', 'givingwalk'),
    'params' => array(
        array(
            'type' => 'attach_images',
            'heading' => esc_html__( 'Images', 'givingwalk' ),
            'param_name' => 'images',
            'value' => '',
            'description' => esc_html__( 'Select images from media library.', 'givingwalk' ),
        ), 
        array(
            "type"          => "dropdown",
            "heading"       => esc_html__("Image size",'givingwalk'),
            "param_name"    => "thumbnail_size",
            "value"         => givingwalk_thumbnail_sizes(),
            "std"           => "full",
        ),
        array(
            "type"          => "textfield",
            "heading"       => esc_html__("Custom image size",'givingwalk'),
            'description'   => esc_html__('Alternatively enter size in pixels (Example: 200x100 (Width x Height)).','givingwalk'),
            "param_name"    => "thumbnail_size_custom",
            "value"         => '',
            'dependency'    => array(
                'element'   => 'thumbnail_size',
                'value'     => 'custom',
            ),
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Columns XS Devices",'givingwalk'),
            "param_name" => "col_xs",
            "edit_field_class" => "vc_col-sm-3 vc_column",
            "value" => array(1,2,3,4),
            "std" => 1,
            "group" => esc_html__("Responsive Options", 'givingwalk')
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Columns SM Devices",'givingwalk'),
            "param_name" => "col_sm",
            "edit_field_class" => "vc_col-sm-3 vc_column",
            "value" => array(1,2,3,4,5,6),
            "std" => 2,
            "group" => esc_html__("Responsive Options", 'givingwalk')
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Columns MD Devices",'givingwalk'),
            "param_name" => "col_md",
            "edit_field_class" => "vc_col-sm-3 vc_column",
            "value" => array(1,2,3,4,5,6,12),
            "std" => 3,
            "group" => esc_html__("Responsive Options", 'givingwalk')
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Columns LG Devices",'givingwalk'),
            "param_name" => "col_lg",
            "edit_field_class" => "vc_col-sm-3 vc_column",
            "value" => array(1,2,3,4,5,6,12),
            "std" => 4,
            "group" => esc_html__("Responsive Options", 'givingwalk')
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Columns XL Devices",'givingwalk'),
            "param_name" => "col_xl",
            "edit_field_class" => "vc_col-sm-3 vc_column",
            "value" => array(1,2,3,4,5,6,12),
            "std" => 4,
            "group" => esc_html__("Responsive Options", 'givingwalk')
        ),
        array(
            'type' => 'css_editor',
            'heading' => esc_html__( 'CSS box', 'givingwalk' ),
            'param_name' => 'css',
            'group' => esc_html__( 'Design Options', 'givingwalk' ),
        ),
    )
));

class WPBakeryShortCode_red_gallery_image extends CmsShortCode
{
    protected function content($atts, $content = null){
        $atts_extra = shortcode_atts(array(
            'images' => '',
            'thumbnail_size' => 'full',
            'thumbnail_size_custom' => '',
            'col_xs' => 1,
            'col_sm' => 2,
            'col_md' => 3,
            'col_lg' => 4,
            'col_xl' => 4,
        ), $atts);
        
		$atts = array_merge($atts_extra, $atts);
          
        $html_id = cmsHtmlID('red-gal-image');
     	$col_xs = 12 / $atts['col_xs'];
     	$col_sm = 12 / $atts['col_sm'];
     	$col_md = 12 / $atts['col_md'];
        $col_lg = 12 / $atts['col_lg'];
        $col_xl = 12 / $atts['col_xl'];
        if($col_sm == 2.4) $col_sm = 24;
        if($col_md == 2.4) $col_md = 24;
        if($col_lg == 2.4) $col_lg = 24;
        if($col_xl == 2.4) $col_xl = 24;
        
        $atts['item_class'] = "red-gal-item col-{$col_xs} col-sm-{$col_sm} col-md-{$col_md} col-lg-{$col_lg} col-xl-{$col_xl}";
      
        $atts['html_id'] = $html_id;
        return parent::content($atts, $content);
    }
}
?>