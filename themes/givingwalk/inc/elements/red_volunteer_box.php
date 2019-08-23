<?php
vc_map(array(
    'name'        => esc_html__('Red Volunteer Box', 'givingwalk'),
    'base'        => 'red_volunteer_box',
    'category'    => esc_html__('RedExp', 'givingwalk'),
    'description' => esc_html__('Add volunteer information', 'givingwalk'),
    'icon'        => 'redel-icon-client',
    'params'      => array(
        array(
            "type"       => "colorpicker",
            "class"      => "",
            "heading"    => esc_html__("Background color", 'givingwalk'),
            "param_name" => "background_color",
            "value"      => "",
        ),
        array(
            "type" => "attach_image",
            "heading" => esc_html__("Image Item",'givingwalk'),
            "param_name" => "image",
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Title 1",'givingwalk'),
            "param_name" => "title1",
            "value" => "",
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Title 2",'givingwalk'),
            "param_name" => "title2",
            "value" => "",
            "admin_label" => true,
        ),
        array(
            'type'          => 'textarea',
            'heading'       => esc_html__('Description','givingwalk'),
            'param_name'    => 'desc',
            'value'         => '',
            'description'   => esc_html__('Description','givingwalk'),
        ),
        array(
            'type' => 'vc_link',
            'heading' => esc_html__( 'URL (Link)', 'givingwalk' ),
            'param_name' => 'link',
        ),
        array(
            'type'        => 'textfield',
            'heading'     => esc_html__('Extra Class', 'givingwalk'),
            'param_name'  => 'el_class',
            'value'       => '',
            'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'givingwalk'),
        ),
        array(
            'type' => 'param_group',
            'heading' => esc_html__( 'Add feature', 'givingwalk' ),
            'param_name' => 'values',
            'value' => urlencode( json_encode( array(
                array(
                    'values' => esc_html__( 'Feature', 'givingwalk' ),
                ),
            ) ) ),
            'params' => array(
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Content item",'givingwalk'),
                    "param_name" => "content_item",
                    "value" => "",
                    "admin_label" => true,
                ), 
            ),
            'group' => esc_html__('Feature','givingwalk')
        ), 
         
        array(
            'type' => 'css_editor',
            'heading' => esc_html__( 'CSS box', 'givingwalk' ),
            'param_name' => 'css',
            'group' => esc_html__( 'Design Options', 'givingwalk' ),
        )  
    )
));

class WPBakeryShortCode_red_volunteer_box extends CmsShortCode
{
    protected function content($atts, $content = null){
        return parent::content($atts, $content);
    }
}
