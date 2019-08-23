<?php
if(!class_exists('Newsletter')) return;
vc_map(array(
	'name'        => 'Red Newsletter',
	'base'        => 'red_newsletter',
	'icon'        => 'redel-icon-newsletter',
	'category'    => esc_html__('RedExp', 'givingwalk'),
	'description' => esc_html__('Add Newsletter Form.', 'givingwalk'),
	'params'      => array(
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Layout Mode', 'givingwalk' ),
			'description' => esc_html__( 'Choose Layout mode you want to show', 'givingwalk' ),
			'param_name'  => 'layout_mode',
			'value'       => array(
				esc_html__('Newsletter','givingwalk')      	=> 'default',
				esc_html__('Newsletter Minimal','givingwalk') 	=> 'minimal',
				esc_html__('Newsletter Minimal With Title','givingwalk') 	=> 'minimal-with-title',
			),
			'std'		  => 'minimal',
			'admin_label' => true,
    	),
    	array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Title', 'givingwalk' ),
			'param_name'  => 'title',
			'value'		  => '',
			'dependency'    => array(
				'element'   => 'layout_mode',
				'value'     => 'minimal-with-title',
			),
    	),
    	array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Description', 'givingwalk' ),
			'param_name'  => 'desc',
			'value'		  => '',
			'dependency'    => array(
				'element'   => 'layout_mode',
				'value'     => 'minimal-with-title',
			),
    	),
    	array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Show lists as', 'givingwalk' ),
			'param_name'  => 'lists_layout',
			'value'       => array(
				esc_html__('Checkbox','givingwalk') => '',
				esc_html__('Dropdown','givingwalk') => 'dropdown'
			),
			'std'		  	=> '',
			'dependency'    => array(
				'element'   => 'layout_mode',
				'value'     => 'default',
			),
    	),
    	array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'First dropdown entry label', 'givingwalk' ),
			'param_name'  => 'lists_empty_label',
			'value'		  => '',
			'dependency'    => array(
				'element'   => 'lists_layout',
				'value'     => 'dropdown',
			),
    	),
    	array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Lists field label', 'givingwalk' ),
			'description' => esc_html__( 'Seperate by comma (,)', 'givingwalk' ),
			'value'		  => '',		
			'param_name'  => 'lists_field_label',
			'dependency'    => array(
				'element'   => 'layout_mode',
				'value'     => 'default',
			),
    	),
    	array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Button Text', 'givingwalk' ),
			'description' => esc_html__( 'Enter button text', 'givingwalk' ),
			'param_name'  => 'btn_text',
			'value'       => '',
			'std'		  => 'Subscribe',
			'dependency'    => array(
				'element'   => 'layout_mode',
				'value'     => 'minimal',
			),
    	),
    	array(
            'type'       => 'textfield',
            'heading'    => esc_html__('Extra Class','givingwalk'),
            'param_name' => 'el_class',
            'value'      => '',
            'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'givingwalk'),
        ),
    )
));

class WPBakeryShortCode_red_newsletter extends CmsShortCode{
}
