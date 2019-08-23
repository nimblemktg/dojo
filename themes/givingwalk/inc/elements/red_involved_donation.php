<?php
vc_map(array(
    'name'        => esc_html__('Red Involved Donation Block', 'givingwalk'),
    'base'        => 'red_involved_donation',
    'category'    => esc_html__('RedExp', 'givingwalk'),
    'description' => esc_html__('Add involved donation information', 'givingwalk'),
    'icon'        => 'redel-icon-client',
    'params'      => array(
        array(
            "type" => "textfield",
            "heading" => esc_html__("Title 1",'givingwalk'),
            "param_name" => "involved_title1",
            "value" => "",
            'group'         => esc_html__('Involved', 'givingwalk'),
        ),
        array(
            'type'          => 'colorpicker',
            'heading'       => esc_html__('Title 1 Color','givingwalk'),
            'param_name'    => 'involved_title_1_color',
            'value'         => '',
            'group'         => esc_html__('Involved', 'givingwalk'),
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Title 2",'givingwalk'),
            "param_name" => "involved_title2",
            "value" => "",
            "admin_label" => true,
            'group'         => esc_html__('Involved', 'givingwalk'),
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Title 3",'givingwalk'),
            "param_name" => "involved_title3",
            "value" => "",
            'group'         => esc_html__('Involved', 'givingwalk'),
        ),
        array(
            'type'          => 'colorpicker',
            'heading'       => esc_html__('Title 3 Color','givingwalk'),
            'param_name'    => 'involved_title_3_color',
            'value'         => '',
            'group'         => esc_html__('Involved', 'givingwalk'),
        ),
        array(
            'type' => 'vc_link',
            'heading' => esc_html__('Choose your link','givingwalk'),
            'param_name' => 'involved_button_link',
            'value' => '',
            'group'         => esc_html__('Involved', 'givingwalk'),
        ),
        array(
            'type'          => 'colorpicker',
            'heading'       => esc_html__('Border right color','givingwalk'),
            'param_name'    => 'border_right_color',
            'value'         => '',
            'group'         => esc_html__('Involved', 'givingwalk'),
        ),

        array(
            "type" => "textfield",
            "heading" => esc_html__("Title 1",'givingwalk'),
            "param_name" => "donation_title1",
            "value" => "",
            'group'         => esc_html__('Donation', 'givingwalk'),
        ),
        array(
            'type'          => 'colorpicker',
            'heading'       => esc_html__('Title 1 Color','givingwalk'),
            'param_name'    => 'donation_title_1_color',
            'value'         => '',
            'group'         => esc_html__('Donation', 'givingwalk'),
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Title 2",'givingwalk'),
            "param_name" => "donation_title2",
            "value" => "",
            "admin_label" => true,
            'group'         => esc_html__('Donation', 'givingwalk'),
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Title 3",'givingwalk'),
            "param_name" => "donation_title3",
            "value" => "",
            'group'         => esc_html__('Donation', 'givingwalk'),
        ),
        array(
            'type'          => 'colorpicker',
            'heading'       => esc_html__('Title 3 Color','givingwalk'),
            'param_name'    => 'donation_title_3_color',
            'value'         => '',
            'group'         => esc_html__('Donation', 'givingwalk'),
        ),
        array(
            'type' => 'vc_link',
            'heading' => esc_html__('Choose your link','givingwalk'),
            'param_name' => 'donation_button_link',
            'value' => '',
            'group'         => esc_html__('Donation', 'givingwalk'),
        ),
        
        array(
            'type' => 'css_editor',
            'heading' => esc_html__( 'CSS box', 'givingwalk' ),
            'param_name' => 'css',
            'group' => esc_html__( 'Design Options', 'givingwalk' ),
        )  
    )
));

class WPBakeryShortCode_red_involved_donation extends CmsShortCode
{
    protected function content($atts, $content = null){
        return parent::content($atts, $content);
    }
}
