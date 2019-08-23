<?php
vc_map(array(
    'name'        => 'Red Socials',
    'base'        => 'red_social',
    'icon'        => 'redel-icon-social',
    'category'    => esc_html__('RedExp', 'givingwalk'),
    'description' => esc_html__('Add text with icon', 'givingwalk'),
    'params'      => array(
        array(
            'type'        => 'textfield',
            'heading'     => esc_html__( 'Title', 'givingwalk' ),
            'param_name'  => 'el_title',
            'value'       => '',
            'admin_label' => true,
        ),
        array(
            'type'       => 'dropdown',
            'param_name' => 'source',
            'heading'    => esc_html__( 'Source', 'givingwalk' ),
            'value'      => array(
                esc_html__( 'From Theme Options', 'givingwalk' ) => 'ThemeOption',
                esc_html__( 'Custom', 'givingwalk' )             => 'custom',
            ),
            'std' => 'ThemeOption',
            'description' => esc_html__( 'Choose what social source display. Default from Theme Option, or custom in this element!', 'givingwalk' ),
            'admin_label' => true,
        ),
        array(
            'type'       => 'dropdown',
            'param_name' => 'el_mode',
            'heading'    => esc_html__( 'Layout Mode', 'givingwalk' ),
            'value'      => array(
                esc_html__( 'Default', 'givingwalk' ) => '',
                esc_html__( 'Title left', 'givingwalk' ) => 'title-left',
            ),
            'std' => '',
        ),
        
        array(
            'type'       => 'dropdown',
            'param_name' => 'color_mode',
            'heading'    => esc_html__( 'Color Mode', 'givingwalk' ),
            'value'      => array(
                esc_html__( 'Default', 'givingwalk' )            => '',
                esc_html__( 'Text Colored', 'givingwalk' )       => 'text-colored',
                esc_html__( 'Background Colored', 'givingwalk' ) => 'bg-colored',
            ),
            'std' => '',
        ),
        array(
            'type'       => 'dropdown',
            'param_name' => 'shape_mode',
            'heading'    => esc_html__( 'Shape Mode', 'givingwalk' ),
            'value'      => array(
                esc_html__( 'Default', 'givingwalk' )         => '',
                esc_html__( 'Square', 'givingwalk' )          => 'square',
                esc_html__( 'Rounded', 'givingwalk' )         => 'rounded',
                esc_html__( 'Circle', 'givingwalk' )          => 'circle',
                esc_html__( 'Square Outline', 'givingwalk' )  => 'square outline',
                esc_html__( 'Rounded Outline', 'givingwalk' ) => 'rounded outline',
                esc_html__( 'Circle Outline', 'givingwalk' )  => 'circle outline',
            ),
            'std' => '',
        ),
        array(
            'type'       => 'dropdown',
            'param_name' => 'el_icon_size',
            'heading'    => esc_html__( 'Icon Size', 'givingwalk' ),
            'value'      => array(
                esc_html__( 'Default', 'givingwalk' ) => '',
                esc_html__( 'Small', 'givingwalk' )   => 'small',
                esc_html__( 'Medium', 'givingwalk' )  => 'medium',
                esc_html__( 'Large', 'givingwalk' )   => 'large',
            ),
            'std' => '',
            'admin_label' => true,
        ),
        array(
            'type'       => 'dropdown',
            'param_name' => 'el_content_align',
            'heading'    => esc_html__( 'Content Align', 'givingwalk' ),
            'value'      => array(
                esc_html__( 'Default', 'givingwalk' ) => '',
                esc_html__( 'Left', 'givingwalk' )    => 'text-left',
                esc_html__( 'Right', 'givingwalk' )   => 'text-right',
                esc_html__( 'Center', 'givingwalk' )  => 'text-center',
            ),
            'std' => '',
        ),
        array(
            'type'       => 'param_group',
            'heading'    => esc_html__( 'Add your icons', 'givingwalk' ),
            'param_name' => 'values',
            'value'      => urlencode( json_encode( array(
                array(
                    'social_name'        => esc_html__('Faceboook','givingwalk'),
                    'social_url'         => 'title:Facebook||url:https%3A//www.facebook.com/ZookaStudio-303678886710953||target:_blank',
                    'add_icon'           => 'true',
                    'i_type'             => 'fontawesome',
                    'i_icon_fontawesome' => 'fa fa-facebook'
                ),
                array(
                    'social_name'        => esc_html__('Twitter','givingwalk'),
                    'social_url'         => 'title:Twitter||url:https%3A//twitter.com/zookadotio||target:_blank',
                    'add_icon'           => 'true',
                    'i_type'             => 'fontawesome',
                    'i_icon_fontawesome' => 'fa fa-twitter'
                ),
                array(
                    'social_name'        => esc_html__('Linkedin','givingwalk'),
                    'social_url'         => 'title:Linkedin||url:https%3A//www.linkedin.com/company/zooka-studio||target:_blank',
                    'add_icon'           => 'true',
                    'i_type'             => 'fontawesome',
                    'i_icon_fontawesome' => 'fa fa-linkedin'
                ),
                array(
                    'social_name'        => esc_html__('Youtube','givingwalk'),
                    'social_url'         => 'title:Youtube||url:https%3A//www.youtube.com/playlist?list=PLStisDW1uGOBC_17qkU0N2AFZj96PVEf7||target:_blank',
                    'add_icon'           => 'true',
                    'i_type'             => 'fontawesome',
                    'i_icon_fontawesome' => 'fa fa-youtube-play'
                ),
                array(
                    'social_name'        => esc_html__('Skype Chat','givingwalk'),
                    'social_url'         => 'title:Skype Chat||url:https%3A//skype.chinhjm||target:_blank',
                    'add_icon'           => 'true',
                    'i_type'             => 'fontawesome',
                    'i_icon_fontawesome' => 'fa fa-skype'
                )
            ) ) ),
            'params'     => array_merge(
                givingwalk_icon_libs(),
                givingwalk_icon_libs_icon(),
                array(
                    array(
                        'type'       => 'vc_link',
                        'heading'    => esc_html__( 'Icon Link', 'givingwalk' ),
                        'param_name' => 'icon_link',
                    ),
                )
            ),
            'dependency' => array(
                'element' => 'source',
                'value'   => 'custom',
            ),
            'group'      => esc_html__('Items','givingwalk'),
        ),
    )
));

class WPBakeryShortCode_red_social extends CmsShortCode
{
    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}
