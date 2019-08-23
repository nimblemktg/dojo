<?php
vc_map(
	array(
		'name'     => esc_html__('Red Single Causes', 'givingwalk'),
		'base'     => 'red_single_causes_donation',
		'icon'     => 'icon-wpb-application-icon-large',
		'category' => esc_html__('RedExp', 'givingwalk'),
		'params'   => array(
            array(
                'type'       => 'img',
                'heading'    => esc_html__('Layout Mode','givingwalk'),
                'param_name' => 'layout_mode',
                'value'      =>  array(
                    '1'          => get_template_directory_uri().'/inc/elements/layouts/red-single-cause-layout-1.jpg',
                    '2'          => get_template_directory_uri().'/inc/elements/layouts/red-single-cause-layout-2.jpg',
                    '3'          => get_template_directory_uri().'/inc/elements/layouts/red-single-cause-layout-3.jpg',
                ),
                'std'        => '1',
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__('Custom Source','givingwalk'),
                'param_name'    => 'custom_source',
                'value'         => array(
                    esc_html__('Latest','givingwalk')       => '',
                    esc_html__('Input cause ID','givingwalk')     => 'id',
                ),
                'std'           => '',
            ),
	    	array(
                "type" => "textfield",
                "heading" => esc_html__("Cause ID",'givingwalk'),
                "param_name" => "cause_id",
                "value" => "",
                'description'       => esc_html__('Enter the cause ID','givingwalk'),
                'dependency'    => array(
                    'element'   => 'custom_source',
                    'value'     => 'id',
                ),
            ),
            array(
                'type'          => 'colorpicker',
                'heading'       => esc_html__('Content Color','givingwalk'),
                'param_name'    => 'content_color',
                'value'         => '',
                'description'   => esc_html__('Content Color','givingwalk'),
            ),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Custom title','givingwalk'),
                'param_name' => 'custom_title',
                'description'       => esc_html__('Show post title if this field is empty and otherwise','givingwalk'),
                'value'      =>  "",
                'dependency'    => array(
                    'element'   => 'layout_mode',
                    'value'     => array('2','3'),
                ),
            ),
            array(
                'type'          => 'colorpicker',
                'heading'       => esc_html__('Title Color','givingwalk'),
                'param_name'    => 'title_color',
                'value'         => '',
                'description'   => esc_html__('Custom Title Color','givingwalk'),
                'dependency'    => array(
                    'element'   => 'layout_mode',
                    'value'     => array('2','3'),
                ),
            ),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__('Extra text','givingwalk'),
				'param_name' => 'extra_text',
				'value'      =>  "",
                'dependency'    => array(
                    'element'   => 'layout_mode',
                    'value'     => array('1','3'),
                ),
		    ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__("Overlap bottom", 'givingwalk'),
                'param_name' => 'overlap_bottom',
                'value' => '',
                'dependency'    => array(
                    'element'   => 'layout_mode',
                    'value'     => array('2'),
                ),
            ),
            array(
                'type' => 'css_editor',
                'heading' => esc_html__( 'CSS box', 'givingwalk' ),
                'param_name' => 'css',
                'group' => esc_html__( 'Design Options', 'givingwalk' ),
            )  
        )
	)
);
class WPBakeryShortCode_red_single_causes_donation extends CmsShortCode{
	protected function content($atts, $content = null){
		return parent::content($atts, $content);
	}
	
}
