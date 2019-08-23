<?php
vc_map(
	array(
		'name'     => esc_html__('Red Counter', 'givingwalk'),
		'base'     => 'red_counter',
		'icon'     => 'redel-icon-counter',
		'category' => esc_html__('RedExp', 'givingwalk'),
		'params'   => array_merge(
			array(
				array(
	                'type'       => 'img',
	                'heading'    => esc_html__('Layout Mode','givingwalk'),
	                'param_name' => 'layout_mode',
	                'value'      =>  array(
	                    'layout-1'          => get_template_directory_uri().'/inc/elements/layouts/red-counter-layout-1.jpg',
	                    'layout-2'          => get_template_directory_uri().'/inc/elements/layouts/red-counter-layout-2.jpg',
	                ),
	                'std'        => 'layout-1',
	                'group' 	 => esc_html__('Settings', 'givingwalk')
	            ),
		        array(
					'type'       => 'dropdown',
					'heading'    => esc_html__('Content Align','givingwalk'),
					'param_name' => 'content_align',
					'value'      => array(
						esc_html__('Default','givingwalk')  => '',
						esc_html__('Left'  ,'givingwalk')   => 'text-left',
						esc_html__('Right' ,'givingwalk')   => 'text-right',
						esc_html__('Center' ,'givingwalk')  => 'text-center'
		            ),
		            'std'		 => 'text-center',
		            'group' 	 => esc_html__('Settings', 'givingwalk')
		        ),
		        array(
					'type'       => 'dropdown',
					'heading'    => esc_html__('Counter Type','givingwalk'),
					'param_name' => 'counter_type',
					'value'      => array(
						esc_html__('Zero','givingwalk')   => 'zero',
		            ),
		            'std'		 => 'zero',
		            'group' 	 => esc_html__('Settings', 'givingwalk')
		        ),
		        array(
					'type'       => 'dropdown',
					'heading'    => esc_html__('Select Number Items','givingwalk'),
					'param_name' => 'number_items',
					'value'      => array('1','2','3','4','5','6'),
		            'std'		 => 1,
		            'admin_label' => true,
		            'group' 	 => esc_html__('Settings', 'givingwalk')
		        ),
		        array(
					'type'       => 'dropdown',
					'heading'    => esc_html__('Content Color','givingwalk'),
					'param_name' => 'content_color',
					'value'      => array(
						esc_html__('Default','givingwalk')  => '',
						esc_html__('White'  ,'givingwalk')   => 'text-white',
		            ),
		            'std'		 => '',
		            'dependency' => array(
		            	'element'=>'layout_mode',
		            	'value'	 =>array('layout-2')
		            ),
		            'group' 	 => esc_html__('Settings', 'givingwalk')
		        ),
		        array(
					'type'        => 'textfield',
					'heading'     => esc_html__('Extra Class','givingwalk'),
					'param_name'  => 'class',
					'value'       => '',
					'group' 	 => esc_html__('Settings', 'givingwalk')
		        ),
		        array(
		            'type' => 'css_editor',
		            'heading' => esc_html__( 'CSS box', 'givingwalk' ),
		            'param_name' => 'css',
		            'group' => esc_html__( 'Design Options', 'givingwalk' ),
		        )
		    ),
		    /* Counter 1 */
		    array(
		        array(
					'type'       => 'textfield',
					'heading'    => esc_html__('Title','givingwalk'),
					'param_name' => 'title1',
					'dependency' => array(
		            	'element'=>'number_items',
		            	'value'	 =>array('1','2','3','4','5','6')
		            ),
					'value'       => '',
					'group'       => esc_html__('Counter 1', 'givingwalk')
		        ),
		        array(
					'type'       => 'textarea',
					'heading'    => esc_html__('Description','givingwalk'),
					'param_name' => 'desc1',
					'dependency' => array(
		            	'element'=>'number_items',
		            	'value'	 =>array('1','2','3','4','5','6')
		            ),
					'value'       => '',
					'group'       => esc_html__('Counter 1', 'givingwalk')
		        ),
		        array(
					'type'       => 'textfield',
					'heading'    => esc_html__('Digit','givingwalk'),
					'param_name' => 'digit1',
					'value'      => '',
					'edit_field_class' => 'vc_col-sm-4',
		            'dependency' => array(
						'element' => 'number_items',
						'value'	  =>array('1','2','3','4','5','6')
		            ),
					'group'      => esc_html__('Counter 1', 'givingwalk')
		        ),
		        array(
					'type'       => 'textfield',
					'heading'    => esc_html__('Prefix','givingwalk'),
					'param_name' => 'prefix1',
					'edit_field_class' => 'vc_col-sm-4',
					'dependency' => array(
						'element' =>'number_items',
						'value'	  =>array('1','2','3','4','5','6')
		            ),
					'value'       => '',
					'group'       => esc_html__('Counter 1', 'givingwalk')
		        ),
		        array(
					'type'       => 'textfield',
					'heading'    => esc_html__('Suffix','givingwalk'),
					'param_name' => 'suffix1',
					'edit_field_class' => 'vc_col-sm-4',
					'value'      => '',
					'dependency' => array(
						'element' =>'number_items',
						'value'	  =>array('1','2','3','4','5','6')
		            ),
					'group'      => esc_html__('Counter 1', 'givingwalk')
		        ),
		        array(
	                'type'          => 'checkbox',
	                'param_name'    => 'add_icon1',
	                'heading'       => esc_html__( 'Add Icon?', 'givingwalk' ),
	                'std'           => 'false',
	                'group'         => esc_html__('Counter 1','givingwalk')
	            ),
		        array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__('Icon Color','givingwalk'),
					'param_name' => 'icon1_color',
					'value'      => '',
		            'dependency' => array(
						'element' => 'add_icon1',
						'value'	  => 'true'
		            ),
					'group'      => esc_html__('Counter 1', 'givingwalk')
		        ), 
		        array(
					'type'       => 'attach_image',
					'heading'    => esc_html__('Icon Image','givingwalk'),
					'param_name' => 'icon_image_1',
					'dependency' => array(
						'element' =>'number_items',
						'value'	  =>array('1','2','3','4','5','6')
		            ),
					'group'      => esc_html__('Counter 1', 'givingwalk')
		        ),
		    ),
		    givingwalk_icon_libs('Counter 1','i1_', 'add_icon1'),
			givingwalk_icon_libs_icon('Counter 1','i1_'),
			/* Counter 2 */
		    array(
		        array(
					'type'       => 'textfield',
					'heading'    => esc_html__('Title','givingwalk'),
					'param_name' => 'title2',
					'dependency' => array(
		            	'element'=>'number_items',
		            	'value'	 =>array('2','3','4','5','6')
		            ),
					'value'       => '',
					'group'       => esc_html__('Counter 2', 'givingwalk')
		        ),
		        array(
					'type'       => 'textarea',
					'heading'    => esc_html__('Description','givingwalk'),
					'param_name' => 'desc2',
					'dependency' => array(
		            	'element'=>'number_items',
		            	'value'	 =>array('2','3','4','5','6')
		            ),
					'value'       => '',
					'group'       => esc_html__('Counter 2', 'givingwalk')
		        ),
		        array(
					'type'       => 'textfield',
					'heading'    => esc_html__('Digit','givingwalk'),
					'param_name' => 'digit2',
					'value'      => '',
					'edit_field_class' => 'vc_col-sm-4',
		            'dependency' => array(
						'element' => 'number_items',
						'value'	  =>array('2','3','4','5','6')
		            ),
					'group'      => esc_html__('Counter 2', 'givingwalk')
		        ),
		        array(
					'type'       => 'textfield',
					'heading'    => esc_html__('Prefix','givingwalk'),
					'param_name' => 'prefix2',
					'edit_field_class' => 'vc_col-sm-4',
					'dependency' => array(
						'element' =>'number_items',
						'value'	  =>array('2','3','4','5','6')
		            ),
					'value'       => '',
					'group'       => esc_html__('Counter 2', 'givingwalk')
		        ),
		        array(
					'type'       => 'textfield',
					'heading'    => esc_html__('Suffix','givingwalk'),
					'param_name' => 'suffix2',
					'edit_field_class' => 'vc_col-sm-4',
					'value'      => '',
					'dependency' => array(
						'element' =>'number_items',
						'value'	  =>array('2','3','4','5','6')
		            ),
					'group'      => esc_html__('Counter 2', 'givingwalk')
		        ),
		        array(
	                'type'          => 'checkbox',
	                'param_name'    => 'add_icon2',
	                'heading'       => esc_html__( 'Add Icon?', 'givingwalk' ),
	                'std'           => 'false',
	                'dependency' => array(
						'element' => 'number_items',
						'value'	  =>array('2','3','4','5','6')
		            ),
	                'group'         => esc_html__('Counter 2','givingwalk')
	            ),
		        array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__('Icon Color','givingwalk'),
					'param_name' => 'icon2_color',
					'value'      => '',
		            'dependency' => array(
						'element' => 'add_icon2',
						'value'	  => 'true'
		            ),
					'group'      => esc_html__('Counter 2', 'givingwalk')
		        ), 
		        array(
					'type'       => 'attach_image',
					'heading'    => esc_html__('Icon Image','givingwalk'),
					'param_name' => 'icon_image_2',
					'dependency' => array(
						'element' =>'number_items',
						'value'	  =>array('2','3','4','5','6')
			        ),
					'group'      => esc_html__('Counter 2', 'givingwalk')
		        ),
		    ),
		    givingwalk_icon_libs('Counter 2','i2_', 'add_icon2'),
			givingwalk_icon_libs_icon('Counter 2','i2_'),
			/* Counter 3 */
		    array(
		        array(
					'type'       => 'textfield',
					'heading'    => esc_html__('Title','givingwalk'),
					'param_name' => 'title3',
					'dependency' => array(
		            	'element'=>'number_items',
		            	'value'	 =>array('3','4','5','6')
		            ),
					'value'       => '',
					'group'       => esc_html__('Counter 3', 'givingwalk')
		        ),
		        array(
					'type'       => 'textarea',
					'heading'    => esc_html__('Description','givingwalk'),
					'param_name' => 'desc3',
					'dependency' => array(
		            	'element'=>'number_items',
		            	'value'	 =>array('3','4','5','6')
		            ),
					'value'       => '',
					'group'       => esc_html__('Counter 3', 'givingwalk')
		        ),
		        array(
					'type'       => 'textfield',
					'heading'    => esc_html__('Digit','givingwalk'),
					'param_name' => 'digit3',
					'value'      => '',
					'edit_field_class' => 'vc_col-sm-4',
		            'dependency' => array(
						'element' => 'number_items',
						'value'	  =>array('3','4','5','6')
		            ),
					'group'      => esc_html__('Counter 3', 'givingwalk')
		        ),
		        array(
					'type'       => 'textfield',
					'heading'    => esc_html__('Prefix','givingwalk'),
					'param_name' => 'prefix3',
					'edit_field_class' => 'vc_col-sm-4',
					'dependency' => array(
						'element' =>'number_items',
						'value'	  =>array('3','4','5','6')
		            ),
					'value'       => '',
					'group'       => esc_html__('Counter 3', 'givingwalk')
		        ),
		        array(
					'type'       => 'textfield',
					'heading'    => esc_html__('Suffix','givingwalk'),
					'param_name' => 'suffix3',
					'edit_field_class' => 'vc_col-sm-4',
					'value'      => '',
					'dependency' => array(
						'element' =>'number_items',
						'value'	  =>array('3','4','5','6')
		            ),
					'group'      => esc_html__('Counter 3', 'givingwalk')
		        ),
		        array(
	                'type'          => 'checkbox',
	                'param_name'    => 'add_icon3',
	                'heading'       => esc_html__( 'Add Icon?', 'givingwalk' ),
	                'std'           => 'false',
	                'dependency' => array(
						'element' =>'number_items',
						'value'	  =>array('3','4','5','6')
		            ),
	                'group'         => esc_html__('Counter 3','givingwalk')
	            ),
		        array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__('Icon Color','givingwalk'),
					'param_name' => 'icon3_color',
					'value'      => '',
		            'dependency' => array(
						'element' => 'add_icon3',
						'value'	  => 'true'
		            ),
					'group'      => esc_html__('Counter 3', 'givingwalk')
		        ), 
		        array(
					'type'       => 'attach_image',
					'heading'    => esc_html__('Icon Image','givingwalk'),
					'param_name' => 'icon_image_3',
					'dependency' => array(
						'element' =>'number_items',
						'value'	  =>array('3','4','5','6')
		            ),
					'group'      => esc_html__('Counter 3', 'givingwalk')
		        ),
		    ),
		    givingwalk_icon_libs('Counter 3','i3_', 'add_icon3'),
			givingwalk_icon_libs_icon('Counter 3','i3_'),
			/* Counter 4 */
		    array(
		        array(
					'type'       => 'textfield',
					'heading'    => esc_html__('Title','givingwalk'),
					'param_name' => 'title4',
					'dependency' => array(
		            	'element'=>'number_items',
		            	'value'	 =>array('4','5','6')
		            ),
					'value'       => '',
					'group'       => esc_html__('Counter 4', 'givingwalk')
		        ),
		        array(
					'type'       => 'textarea',
					'heading'    => esc_html__('Description','givingwalk'),
					'param_name' => 'desc4',
					'dependency' => array(
		            	'element'=>'number_items',
		            	'value'	 =>array('4','5','6')
		            ),
					'value'       => '',
					'group'       => esc_html__('Counter 4', 'givingwalk')
		        ),
		        array(
					'type'       => 'textfield',
					'heading'    => esc_html__('Digit','givingwalk'),
					'param_name' => 'digit4',
					'value'      => '',
					'edit_field_class' => 'vc_col-sm-4',
		            'dependency' => array(
						'element' => 'number_items',
						'value'	  =>array('4','5','6')
		            ),
					'group'      => esc_html__('Counter 4', 'givingwalk')
		        ),
		        array(
					'type'       => 'textfield',
					'heading'    => esc_html__('Prefix','givingwalk'),
					'param_name' => 'prefix4',
					'edit_field_class' => 'vc_col-sm-4',
					'dependency' => array(
						'element' =>'number_items',
						'value'	  =>array('4','5','6')
		            ),
					'value'       => '',
					'group'       => esc_html__('Counter 4', 'givingwalk')
		        ),
		        array(
					'type'       => 'textfield',
					'heading'    => esc_html__('Suffix','givingwalk'),
					'param_name' => 'suffix4',
					'edit_field_class' => 'vc_col-sm-4',
					'value'      => '',
					'dependency' => array(
						'element' =>'number_items',
						'value'	  =>array('4','5','6')
		            ),
					'group'      => esc_html__('Counter 4', 'givingwalk')
		        ),
		        array(
	                'type'          => 'checkbox',
	                'param_name'    => 'add_icon4',
	                'heading'       => esc_html__( 'Add Icon?', 'givingwalk' ),
	                'std'           => 'false',
	                'dependency' => array(
						'element' =>'number_items',
						'value'	  =>array('4','5','6')
		            ),
	                'group'         => esc_html__('Counter 4','givingwalk')
	            ),
		        array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__('Icon Color','givingwalk'),
					'param_name' => 'icon4_color',
					'value'      => '',
		            'dependency' => array(
						'element' => 'add_icon4',
						'value'	  => 'true'
		            ),
					'group'      => esc_html__('Counter 4', 'givingwalk')
		        ), 
		        array(
					'type'       => 'attach_image',
					'heading'    => esc_html__('Icon Image','givingwalk'),
					'param_name' => 'icon_image_4',
					'dependency' => array(
						'element' => 'number_items',
						'value'	  =>array('4','5','6')
		            ),
					'group'      => esc_html__('Counter 4', 'givingwalk')
		        ),
		    ),
		    givingwalk_icon_libs('Counter 4','i4_', 'add_icon4'),
			givingwalk_icon_libs_icon('Counter 4','i4_'),
			/* Counter 5 */
		    array(
		        array(
					'type'       => 'textfield',
					'heading'    => esc_html__('Title','givingwalk'),
					'param_name' => 'title5',
					'dependency' => array(
		            	'element'=>'number_items',
		            	'value'	 =>array('5','6')
		            ),
					'value'       => '',
					'group'       => esc_html__('Counter 5', 'givingwalk')
		        ),
		        array(
					'type'       => 'textarea',
					'heading'    => esc_html__('Description','givingwalk'),
					'param_name' => 'desc5',
					'dependency' => array(
		            	'element'=>'number_items',
		            	'value'	 =>array('5','6')
		            ),
					'value'       => '',
					'group'       => esc_html__('Counter 5', 'givingwalk')
		        ),
		        array(
					'type'       => 'textfield',
					'heading'    => esc_html__('Digit','givingwalk'),
					'param_name' => 'digit5',
					'value'      => '',
					'edit_field_class' => 'vc_col-sm-4',
		            'dependency' => array(
						'element' => 'number_items',
						'value'	  =>array('5','6')
		            ),
					'group'      => esc_html__('Counter 5', 'givingwalk')
		        ),
		        array(
					'type'       => 'textfield',
					'heading'    => esc_html__('Prefix','givingwalk'),
					'param_name' => 'prefix5',
					'edit_field_class' => 'vc_col-sm-4',
					'dependency' => array(
						'element' =>'number_items',
						'value'	  =>array('5','6')
		            ),
					'value'       => '',
					'group'       => esc_html__('Counter 5', 'givingwalk')
		        ),
		        array(
					'type'       => 'textfield',
					'heading'    => esc_html__('Suffix','givingwalk'),
					'param_name' => 'suffix5',
					'edit_field_class' => 'vc_col-sm-4',
					'value'      => '',
					'dependency' => array(
						'element' =>'number_items',
						'value'	  =>array('5','6')
		            ),
					'group'      => esc_html__('Counter 5', 'givingwalk')
		        ),
		        array(
	                'type'          => 'checkbox',
	                'param_name'    => 'add_icon5',
	                'heading'       => esc_html__( 'Add Icon?', 'givingwalk' ),
	                'std'           => 'false',
	                'dependency' => array(
						'element' =>'number_items',
						'value'	  =>array('5','6')
		            ),
	                'group'         => esc_html__('Counter 5','givingwalk')
	            ),
		        array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__('Icon Color','givingwalk'),
					'param_name' => 'icon5_color',
					'value'      => '',
		            'dependency' => array(
						'element' => 'add_icon5',
						'value'	  => 'true'
		            ),
					'group'      => esc_html__('Counter 5', 'givingwalk')
		        ), 
		        array(
					'type'       => 'attach_image',
					'heading'    => esc_html__('Icon Image','givingwalk'),
					'param_name' => 'icon_image_5',
					'dependency' => array(
		            	'element'=>'number_items',
		            	'value'	 =>array('5','6')
		            ),
					'group'      => esc_html__('Counter 5', 'givingwalk')
		        ),
		    ),
		    givingwalk_icon_libs('Counter 5','i5_', 'add_icon5'),
			givingwalk_icon_libs_icon('Counter 5','i5_'),
			/* Counter 6 */
		    array(
		        array(
					'type'       => 'textfield',
					'heading'    => esc_html__('Title','givingwalk'),
					'param_name' => 'title6',
					'dependency' => array(
		            	'element'=>'number_items',
		            	'value'	 =>array('6')
		            ),
					'value'       => '',
					'group'       => esc_html__('Counter 6', 'givingwalk')
		        ),
		        array(
					'type'       => 'textarea',
					'heading'    => esc_html__('Description','givingwalk'),
					'param_name' => 'desc6',
					'dependency' => array(
		            	'element'=>'number_items',
		            	'value'	 =>array('6')
		            ),
					'value'       => '',
					'group'       => esc_html__('Counter 6', 'givingwalk')
		        ),
		        array(
					'type'       => 'textfield',
					'heading'    => esc_html__('Digit','givingwalk'),
					'param_name' => 'digit6',
					'value'      => '',
					'edit_field_class' => 'vc_col-sm-4',
		            'dependency' => array(
						'element' => 'number_items',
						'value'	  =>array('6')
		            ),
					'group'      => esc_html__('Counter 6', 'givingwalk')
		        ),
		        array(
					'type'       => 'textfield',
					'heading'    => esc_html__('Prefix','givingwalk'),
					'param_name' => 'prefix6',
					'edit_field_class' => 'vc_col-sm-4',
					'dependency' => array(
						'element' =>'number_items',
						'value'	  =>array('6')
		            ),
					'value'       => '',
					'group'       => esc_html__('Counter 6', 'givingwalk')
		        ),
		        array(
					'type'       => 'textfield',
					'heading'    => esc_html__('Suffix','givingwalk'),
					'param_name' => 'suffix6',
					'edit_field_class' => 'vc_col-sm-4',
					'value'      => '',
					'dependency' => array(
						'element' =>'number_items',
						'value'	  =>array('6')
		            ),
					'group'      => esc_html__('Counter 6', 'givingwalk')
		        ),
		        array(
	                'type'          => 'checkbox',
	                'param_name'    => 'add_icon6',
	                'heading'       => esc_html__( 'Add Icon?', 'givingwalk' ),
	                'std'           => 'false',
	                'dependency' => array(
						'element' => 'number_items',
						'value'	  =>array('6')
		            ),
	                'group'         => esc_html__('Counter 6','givingwalk')
	            ),
		        array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__('Icon Color','givingwalk'),
					'param_name' => 'icon6_color',
					'value'      => '',
		            'dependency' => array(
						'element' => 'add_icon6',
						'value'	  => 'true'
		            ),
					'group'      => esc_html__('Counter 6', 'givingwalk')
		        ), 
		        array(
					'type'       => 'attach_image',
					'heading'    => esc_html__('Icon Image','givingwalk'),
					'param_name' => 'icon_image_6',
					'dependency' => array(
						'element' => 'number_items',
						'value'	  =>array('6')
		            ),
					'group'      => esc_html__('Counter 6', 'givingwalk')
		        ),
		    ),
		    givingwalk_icon_libs('Counter 6','i6_', 'add_icon6'),
			givingwalk_icon_libs_icon('Counter 6','i6_')
	    )
	)
);
class WPBakeryShortCode_red_counter extends CmsShortCode{
	protected function content($atts, $content = null){
		$atts_extra = shortcode_atts(array(
			'content_align'  => 'text-center',
			'color_mode'	 => '',
			'number_items' => '1',
			'class'          => '',
		), $atts);
		$atts = array_merge($atts_extra,$atts);
        $html_id = cmsHtmlID('cms-counter');
        $class = ($atts['class'])?$atts['class']:'';

        $atts['html_id'] = $html_id;

        wp_enqueue_script( 'waypoints' );
        wp_enqueue_script('red-counter', get_template_directory_uri() . '/inc/elements/js/red_counter.js', array('waypoints'), '1.0.0', true);

		return parent::content($atts, $content);
	}
}
