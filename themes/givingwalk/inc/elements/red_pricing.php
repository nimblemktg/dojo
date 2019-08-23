<?php
vc_map(array(
    'name'        => 'Red Pricing',
    'base'        => 'red_pricing',
    'icon'        => 'redel-icon-pricing',
    'category'    => esc_html__('RedExp', 'givingwalk'),
    'description' => esc_html__('Add your pricing', 'givingwalk'),
    'params'      => array(
        array(
            'type'        => 'textfield',
            'heading'     => esc_html__( 'Currency code', 'givingwalk' ),
            'heading'     => esc_html__( 'Enter your currency code', 'givingwalk' ),
            'param_name'  => 'el_price_currency',
            'value'       => '$',
            'group'       => esc_html__('Settings','givingwalk'),
        ),
        array(
            'type'        => 'textfield',
            'heading'     => esc_html__( 'Price', 'givingwalk' ),
            'heading'     => esc_html__( 'Enter your price', 'givingwalk' ),
            'param_name'  => 'el_price',
            'value'       => '',
            'group'       => esc_html__('Settings','givingwalk'),
        ),
        array(
            'type'        => 'textfield',
            'heading'     => esc_html__( 'Price Plan', 'givingwalk' ),
            'heading'     => esc_html__( 'Enter your plan. Per week / month / year', 'givingwalk' ),
            'param_name'  => 'el_price_plan',
            'value'       => '',
            'group'       => esc_html__('Settings','givingwalk'),
        ),
        array(
            'type'        => 'textfield',
            'heading'     => esc_html__( 'Element Title', 'givingwalk' ),
            'param_name'  => 'el_title',
            'value'       => '',
            'admin_label' => true,
            'group'       => esc_html__('Settings','givingwalk'),
        ),
        array(
            'type'        => 'checkbox',
            'heading'     => esc_html__( 'Add Image ?', 'givingwalk' ),
            'param_name'  => 'add_image',
            'std'         => false,
            'description' => esc_html__( 'Add an image', 'givingwalk' ),
            'group'       => esc_html__( 'Settings', 'givingwalk' ),
        ),
        array(
            'type'          => 'attach_image',
            'param_name'    => 'image',
            'heading'       => esc_html__( 'Choose your image', 'givingwalk' ),
            'value'         => '',
            'description'   => esc_html__( 'Choose an image.', 'givingwalk' ),
            'group'         => esc_html__('Image','givingwalk'),
            'dependency'    => array(
                'element' => 'add_image', 
                'value'   => 'true',
            ),
        ),
        array(
            'type'          => 'dropdown',
            'class'         => '',
            'heading'       => esc_html__('Thumbnail Size','givingwalk'),
            'param_name'    => 'thumbnail_size',
            'value'         => givingwalk_thumbnail_sizes(),
            'std'           => 'medium',
            'group'         => esc_html__('Image', 'givingwalk'),
            'dependency'    => array(
              'element'   => 'image',
              'not_empty' => true,
            ),
        ),
        array(
            'type'          => 'textfield',
            'class'         => '',
            'heading'       => esc_html__('Custom Thumbnail Size','givingwalk'),
            'description'   => esc_html__('Alternatively enter size in pixels (Example: 200x100 (Width x Height)).','givingwalk'),
            'param_name'    => 'thumbnail_size_custom',
            'value'         => '',
            'group'         => esc_html__('Image', 'givingwalk'),
            'dependency'    => array(
              'element'   => 'thumbnail_size',
              'value'     => 'custom',
            ),
        ),
        array(
            'type'       => 'dropdown',
            'heading'    => esc_html__( 'Image position', 'givingwalk' ),
            'param_name' => 'img_pos',
            'value'      => array(
                esc_html__( 'Top', 'givingwalk' )      => 'top',
            ),
            'std'         => '',
            'description' => esc_html__( 'Select image position.', 'givingwalk' ),
            'dependency'  => array(
                'element'   => 'image', 
                'not_empty' => true,
            ),
            'group'         => esc_html__('Image','givingwalk'),
        ),
        array(
            'type'       => 'dropdown',
            'heading'    => esc_html__( 'Layout Type', 'givingwalk' ),
            'param_name' => 'layout_type',
            'value'      => array(
                esc_html__( 'Default', 'givingwalk' )      => '',
                esc_html__( 'Featured', 'givingwalk' )     => 'featured',
            ),
            'std'         => '',
            'description' => esc_html__( 'Choose layout type.', 'givingwalk' ),
            'group'         => esc_html__('Settings','givingwalk'),
        ),
        array(
            'type'       => 'img',
            'heading'    => esc_html__('Layout Mode','givingwalk'),
            'param_name' => 'layout_mode',
            'value'      =>  array(
                '1' => get_template_directory_uri().'/assets/images/header/default.jpg',
            ),
            'std'   => '1',
            'group' => esc_html__('Settings','givingwalk'),
        ),
        array(
            'type'          => 'dropdown',
            'heading'       => esc_html__('Content Align','givingwalk'),
            'param_name'    => 'content_align',
            'value'         => array(
                'Default'   => '',
                'Left'      => 'text-left',
                'Right'     => 'text-right',
                'Center'    => 'text-center'
            ),
            'std'           => 'text-center',
            'group'         => esc_html__('Settings', 'givingwalk')
        ),
        array(
            'type'        => 'checkbox',
            'heading'     => esc_html__( 'Featured Space', 'givingwalk' ),
            'param_name'  => 'feature_space',
            'value'       => array(
                esc_html__('Add Large space to bottom?','givingwalk') => true
            ),
            'std'         => false,
            'group'       => esc_html__( 'Feature List', 'givingwalk' ),
        ),
        array(
            'type'       => 'param_group',
            'heading'    => esc_html__( 'Add your feature', 'givingwalk' ),
            'param_name' => 'values',
            'value'      =>  '',
            'group'      => esc_html__('Feature List','givingwalk'),
            'params'     => array_merge(
                array(
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Feature Text', 'givingwalk' ),
                        'param_name' => 'feature_text',
                        'admin_label' => true,
                    ),
                    array(
                        'type'          => 'checkbox',
                        'param_name'    => 'add_icon',
                        'heading'       => esc_html__( 'Add Icon?', 'givingwalk' ),
                        'std'           => 'false',
                        'group'         => esc_html__('Icon','givingwalk')
                    )
                ),
                givingwalk_icon_libs(),
                givingwalk_icon_libs_icon()
            ),
        ),
        array(
            'type'          => 'vc_link',
            'heading'       => esc_html__('Choose Link','givingwalk'),
            'param_name'    => 'button_link',
            'value'         => '',
            'group'         => esc_html__('Button','givingwalk'),
        ),
        array(
            "type"       => "css_editor",
            "heading"    => '',
            "param_name" => "css",
            "value"      => "",
            "group"      => esc_html__("Design Options",'givingwalk'),
        ) 
    )
));

class WPBakeryShortCode_red_pricing extends CmsShortCode
{
    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}
