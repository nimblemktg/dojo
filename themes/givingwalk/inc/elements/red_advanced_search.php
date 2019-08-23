<?php

vc_map(array(
    'name'        => esc_html__('Red Advanced Search', 'givingwalk'),
    'base'        => 'red_advanced_search',
    'category'    => esc_html__('RedExp', 'givingwalk'),
    'description' => esc_html__('Add key search information', 'givingwalk'),
    'icon'        => 'redel-icon-client',
    'params'      => array(
        array(
            'type'          => 'dropdown',
            'heading'       => esc_html__('Search Type','givingwalk'),
            'param_name'    => 'search_type',
            'value'         =>  array_merge([__('Default', 'givingwalk')   => ''],givingwalk_advanced_search_allow_post_type()),
            'std'           => '',
        ),
        array(
            'type'          => 'textfield',
            'heading'       => esc_html__('Search Label/Placeholder)','givingwalk'),
            'param_name'    => 'label',
            'std'           => __('Enter your keyword','givingwalk'),
        ),
        array(
            'type' => 'css_editor',
            'heading' => esc_html__( 'CSS box', 'givingwalk' ),
            'param_name' => 'css',
            'group' => esc_html__( 'Design Options', 'givingwalk' ),
        )  
    )
));

class WPBakeryShortCode_red_advanced_search extends CmsShortCode
{
    protected function content($atts, $content = null){
        return parent::content($atts, $content);
    }
}
