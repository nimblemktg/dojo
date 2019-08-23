<?php
vc_map(array(
    'name'          => 'Red Button',
    'base'          => 'red_button',
    'category'      => esc_html__('RedExp', 'givingwalk'),
    'description'   => esc_html__('Theme button style', 'givingwalk'),
    'icon'         => 'icon-wpb-ui-button',
    'params'        => array_merge(
        array(
            array(
                'type'          => 'textfield',
                'param_name'    => 'btn_text',
                'heading'       => esc_html__( 'Button Text', 'givingwalk' ),
                'value'         => esc_html__('Text on the button','givingwalk'),
                'admin_label'   => true
            ),
            array(
                'type'          => 'dropdown',
                'param_name'    => 'btn_type',
                'heading'       => esc_html__( 'Button Type', 'givingwalk' ),
                'value'         => givingwalk_btn_types(),
                'std'           => 'btn',
                'admin_label'   => true
            ),
            array(
                "type"          => "vc_link",
                "heading"       => esc_html__("Button link",'givingwalk'),
                "param_name"    => "button_link",
                "value"         => "",
            ),
            array(
                'type'          => 'dropdown',
                'param_name'    => 'btn_size',
                'heading'       => esc_html__( 'Button Size', 'givingwalk' ),
                'value'         => givingwalk_btn_size(),
                'std'           => '',
            ),
            array(
                'type'          => 'dropdown',
                'param_name'    => 'btn_align',
                'heading'       => esc_html__( 'Button Align', 'givingwalk' ),
                'value'         => array(
                    esc_html__( 'Default', 'givingwalk' )  => '',
                    esc_html__( 'Left', 'givingwalk' )     => 'text-left', 
                    esc_html__( 'Right', 'givingwalk' )    => 'text-right',
                    esc_html__( 'Center', 'givingwalk' )   => 'text-center',
                ),
                'std'           => '',
            ),
            array(
                'type'          => 'dropdown',
                'param_name'    => 'btn_block',
                'heading'       => esc_html__( 'Button Style', 'givingwalk' ),
                'value'         => array(
                    esc_html__( 'Inline', 'givingwalk' )   => 'd-inline', 
                    esc_html__( 'Block', 'givingwalk' )    => 'd-block', 
                ),
                'std'           => 'd-block',
            ),
            array(
                'type'          => 'checkbox',
                'param_name'    => 'add_icon',
                'heading'       => esc_html__( 'Add Icon?', 'givingwalk' ),
                'std'           => false,
                'group'         => esc_html__('Icon','givingwalk')
            ),
            
        ),
        givingwalk_icon_libs(),
        givingwalk_icon_libs_icon(),
        array(
            array(
                'type'          => 'dropdown',
                'param_name'    => 'icon_position',
                'heading'       => esc_html__( 'Icon Position', 'givingwalk' ),
                'value'         => array(
                    esc_html__( 'Left', 'givingwalk' )     => 'left',
                    esc_html__( 'Right', 'givingwalk' )    => 'right',
                ),
                'std'           => 'right',
                'dependency'    => array(
                    'element'   => 'add_icon',
                    'value'     => 'true',
                ),
                'group'         => esc_html__('Icon','givingwalk')
            ),
            array(
                'type'          => 'dropdown',
                'param_name'    => 'btn_icon_style',
                'heading'       => esc_html__( 'Icon Style', 'givingwalk' ),
                'value'         => array(
                    esc_html__( 'Default', 'givingwalk' ) => 'default',
                ),
                'std'           => 'default',
                'dependency'    => array(
                    'element'   => 'add_icon',
                    'value'     => 'true',
                ),
                'group'         => esc_html__('Icon','givingwalk')
            ),
            array(
                'type'       => 'css_editor',
                'param_name' => 'css',
                'group'       => esc_html__('Designs', 'givingwalk')
            )
        )
    )
));

class WPBakeryShortCode_red_button extends CmsShortCode
{
    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}
