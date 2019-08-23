<?php
vc_map(array(
    'name'        => esc_html__('Red Contact Information', 'givingwalk'),
    'base'        => 'red_contact_info',
    'category'    => esc_html__('RedExp', 'givingwalk'),
    'description' => esc_html__('Add contact information', 'givingwalk'),
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
            "type" => "textfield",
            "heading" => esc_html__("Title",'givingwalk'),
            "param_name" => "title",
            "value" => "",
            "admin_label" => true,
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__("Top overlap", 'givingwalk'),
            'param_name' => 'top_overlap',
            'value' => array(
                'Yes' => true
            ),
            'std' => true
        ),
         array(
            'type'       => 'textfield',
            'heading'    => esc_html__('Extra Class','givingwalk'),
            'param_name' => 'el_class',
            'value'      => '',
            'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'givingwalk'),
        ),
        array(
            'type' => 'param_group',
            'heading' => esc_html__( 'Add content', 'givingwalk' ),
            'param_name' => 'values',
            'value' => urlencode( json_encode( array(
                array(
                    'values' => esc_html__( 'Content', 'givingwalk' ),
                ),
            ) ) ),
            'params' => array(
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Icon class item",'givingwalk'),
                    "param_name" => "icon_class",
                    "value" => "",
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Content item",'givingwalk'),
                    "param_name" => "content_item",
                    "value" => "",
                    "admin_label" => true,
                ), 
            ),
            'group' => esc_html__('Content','givingwalk')
        ), 
        array(
            'type' => 'param_group',
            'heading' => esc_html__( 'Add Social', 'givingwalk' ),
            'param_name' => 'socials',
            'value' => urlencode( json_encode( array(
                array(),
            ) ) ),
            'params' => array(
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Social Icon class",'givingwalk'),
                    "param_name" => "social_icon_class",
                    "value" => "",
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Social Link",'givingwalk'),
                    "param_name" => "social_link",
                    "value" => "",
                    "admin_label" => true,
                ), 
            ),
            'group' => esc_html__('Social','givingwalk')
        ), 
         
        array(
            'type' => 'css_editor',
            'heading' => esc_html__( 'CSS box', 'givingwalk' ),
            'param_name' => 'css',
            'group' => esc_html__( 'Design Options', 'givingwalk' ),
        )  
    )
));

class WPBakeryShortCode_red_contact_info extends CmsShortCode
{
    protected function content($atts, $content = null){
        return parent::content($atts, $content);
    }
}
