<?php
vc_map(
	array(
		'name' 			=> esc_html__('Red Fancy Box', 'givingwalk'),
	    'base' 			=> 'red_fancybox',
	    'icon'			=> 'vc_icon-vc-hoverbox',
	    'category' 		=> esc_html__('RedExp', 'givingwalk'),
	    'params' 		=> array_merge(
	    	array(
		    	array(
		            'type' 			=> 'textfield',
		            'heading' 		=> esc_html__('Title','givingwalk'),
		            'param_name' 	=> 'title',
		            'value' 		=> '',
		            'description' 	=> esc_html__('Title Of Fancy Icon Box','givingwalk'),
		            'group' 		=> esc_html__('General', 'givingwalk'),
		            'holder'		=> 'div'
		        ),
		        array(
		            'type' 			=> 'colorpicker',
		            'heading' 		=> esc_html__('Title Color','givingwalk'),
		            'param_name' 	=> 'title_color',
		            'value' 		=> '',
		            'description' 	=> esc_html__('Custom Title Color','givingwalk'),
		            'group' 		=> esc_html__('General', 'givingwalk'),
		            'dependency'  => array(
					  'element'   	=> 'title',
					  'not_empty'   => true,
					),
		        ),
		        array(
		            'type' 			=> 'textarea',
		            'heading' 		=> esc_html__('Description','givingwalk'),
		            'param_name' 	=> 'description',
		            'value' 		=> '',
		            'description' 	=> esc_html__('Description Of Fancy Icon Box','givingwalk'),
		            'group' 		=> esc_html__('General', 'givingwalk')
		        ),
		        array(
		            'type' 			=> 'colorpicker',
		            'heading' 		=> esc_html__('Description Color','givingwalk'),
		            'param_name' 	=> 'desc_color',
		            'value' 		=> '',
		            'description' 	=> esc_html__('Custom Description Color','givingwalk'),
		            'group' 		=> esc_html__('General', 'givingwalk'),
		            'dependency'  => array(
					  'element'   	=> 'description',
					  'not_empty'   => true,
					),
		        ),
		        array(
		            'type' 			=> 'dropdown',
		            'heading' 		=> esc_html__('Content Align','givingwalk'),
		            'param_name' 	=> 'content_align',
		            'value' 		=> array(
		            	'Default' 	=> '',
		            	'Left' 		=> 'text-left',
		            	'Right' 	=> 'text-right',
		            	'Center' 	=> 'text-center'
		            ),
		            'std'			=> '',
		            'group' 		=> esc_html__('General', 'givingwalk')
		        ),
		        array(
		            'type' => 'vc_link',
		            'heading' => esc_html__('Choose your link','givingwalk'),
		            'param_name' => 'button_link',
		            'value' => '',
		            'group' => esc_html__('General','givingwalk'),
			    ),
			),
	        /* Start Items */
	        /* Start Icon */
	        array(
	        	array(
	                'type'          => 'checkbox',
	                'param_name'    => 'add_icon',
	                'heading'       => esc_html__( 'Add Icon?', 'givingwalk' ),
	                'std'           => 'false',
	                'group'         => esc_html__('Icon Settings','givingwalk')
	            )
	        ),
	        givingwalk_icon_libs('Icon Settings'),
        	givingwalk_icon_libs_icon('Icon Settings'),
	        array(
	        	array(
		            'type'          => 'textfield',
		            'param_name'    => 'i_size',
		            'heading'       => esc_html__( 'Icon Size', 'givingwalk' ),
		            'value'         => '',
		            'description'   => esc_html__( 'Enter your icon size. Alternatively enter size in pixels (Example: 200x100 (Width x Height)).', 'givingwalk' ),
		            'group' 		=> esc_html__('Icon Settings','givingwalk'),
		            'dependency'	=> array(
				        'element' => 'add_icon',
				        'value' => 'true',
				    )
		        ),
		        array(
		            'type'          => 'dropdown',
		            'param_name'    => 'i_shape',
		            'heading'       => esc_html__( 'Icon Shape', 'givingwalk' ),
		            'value'         => array(
		            		esc_html__('Default','givingwalk')	=> '',
		            		esc_html__('Square','givingwalk')	=> 'square',
		            		esc_html__('Rounded','givingwalk')	=> 'rounded',
		            		esc_html__('Circle','givingwalk')	=> 'circle',
		            	),
		            'std'           => '',
		            'description'   => esc_html__( 'Choose a shape for icon', 'givingwalk' ),
		            'group' 		=> esc_html__('Icon Settings','givingwalk'),
		            'dependency'	=> array(
				        'element' => 'add_icon',
				        'value' => 'true',
				    )
		        ),
		        array(
		            'type'          => 'textfield',
		            'param_name'    => 'i_font_size',
		            'heading'       => esc_html__( 'Icon Font Size', 'givingwalk' ),
		            'value'         => '',
		            'description'   => esc_html__( 'Enter your icon font size, in PX. Ex: 40px', 'givingwalk' ),
		            'group' 		=> esc_html__('Icon Settings','givingwalk'),
		            'dependency'	=> array(
				        'element' => 'add_icon',
				        'value' => 'true',
				    )	
		        ),
		        array(
		            'type'          => 'colorpicker',
		            'param_name'    => 'i_color',
		            'heading'       => esc_html__( 'Icon Text Color', 'givingwalk' ),
		            'value'         => '',
		            'description'   => esc_html__( 'Choose icon text color.', 'givingwalk' ),
		            'group' 		=> esc_html__('Icon Settings','givingwalk'),
		            'dependency'	=> array(
				        'element' => 'add_icon',
				        'value' => 'true',
				    )
		        ),
		        array(
		            'type'          => 'colorpicker',
		            'param_name'    => 'i_bg',
		            'heading'       => esc_html__( 'Icon Background Color', 'givingwalk' ),
		            'std'           => '',
		            'description'   => esc_html__( 'Choose background color. Default is Primary Color added in theme', 'givingwalk' ),
		            'group' 		=> esc_html__('Icon Settings','givingwalk'),
		            'dependency'	=> array(
				        'element' => 'add_icon',
				        'value' => 'true',
				    )
		        ),
		        array(
		            'type'          => 'animation_style',
		            'class'         => '',
		            'heading'       => esc_html__('Animation In','givingwalk'),
		            'param_name'    => 'animation_in',
		            'settings' => array(
						'type' => array(
							/*'in',
							  'out',
							*/
							'other',
						),
					),
		            'std'           => 'wobble',
		            'edit_field_class' => 'vc_col-sm-6 vc_carousel_item',
		            'group' 		=> esc_html__('Icon Settings','givingwalk'),
		            'dependency'	=> array(
				        'element' => 'add_icon',
				        'value' => 'true',
				    )
		        ),
				/* End Icon */
				array(
					'type'       => 'attach_image',
					'heading'    => esc_html__('Image Item','givingwalk'),
					'param_name' => 'image',
					'group'      => esc_html__('Image Settings', 'givingwalk')
		        ),
		        array(
					'type'        => 'checkbox',
					'heading'     => esc_html__('Make image as icon','givingwalk'),
					'description' => esc_html__('If YES, the icon will removed and use image as icon!','givingwalk'),
					'param_name'  => 'image_icon',
					'default'     => false,
					'group'       => esc_html__('Image Settings', 'givingwalk'),
					'dependency'  => array(
					  'element'   	=> 'image',
					  'not_empty'   => true,
					),
		        ),
		        array(
					'type'          => 'dropdown',
					'class'         => '',
					'heading'       => esc_html__('Thumbnail Size','givingwalk'),
					'param_name'    => 'thumbnail_size',
					'value'         => givingwalk_thumbnail_sizes(),
					'std'           => 'medium',
					'group'         => esc_html__('Image Settings', 'givingwalk'),
					'dependency'    => array(
					  'element'   => 'image',
					  'not_empty'     => true,
					),
			    ),
				array(
					'type'          => 'textfield',
					'class'         => '',
					'heading'       => esc_html__('Custom Thumbnail Size','givingwalk'),
					'description'   => esc_html__('Alternatively enter size in pixels (Example: 200x100 (Width x Height)).','givingwalk'),
					'param_name'    => 'thumbnail_size_custom',
					'value'         => '',
					'group'         => esc_html__('Image Settings', 'givingwalk'),
					'dependency'    => array(
					  'element'   => 'thumbnail_size',
					  'value'     => 'custom',
					),
				),
		       
		        /* End Items */
		        array(
					'type'       => 'el_id',
					'heading'    => esc_html__('Element ID','givingwalk'),
					'param_name' => 'el_id',
					'settings' => array(
						'auto_generate' => true,
					),
					'description'	=> sprintf( __( 'Enter element ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'givingwalk' ), 'http://www.w3schools.com/tags/att_global_id.asp' ),
					'group'      => esc_html__('Template', 'givingwalk')
				),

		        array(
					'type'       => 'textfield',
					'heading'    => esc_html__('Element Class','givingwalk'),
					'param_name' => 'class',
					'value'      => '',
					'group'      => esc_html__('Template', 'givingwalk')
				),
		        array(
		            'type' 			=> 'dropdown',
		            'heading' 		=> esc_html__('Color Mode','givingwalk'),
		            'param_name' 	=> 'color_mode',
		            'value' 		=> array(
		            	esc_html__('Default','givingwalk') 	=> '',
		            ),
		            'std'			=> '',
		            'group' 		=> esc_html__('Template', 'givingwalk')
		        ),
			    array(
					'type'       => 'img',
					'heading'    => esc_html__('Layout Mode','givingwalk'),
					'param_name' => 'layout_mode',
					'value'      =>  array(
						'1'          => get_template_directory_uri().'/inc/elements/layouts/red-fancybox-layout-1.jpg',
						'2'          => get_template_directory_uri().'/inc/elements/layouts/red-fancybox-layout-2.jpg',
						'3'          => get_template_directory_uri().'/inc/elements/layouts/red-fancybox-layout-3.jpg',
						'4'          => get_template_directory_uri().'/inc/elements/layouts/red-fancybox-layout-4.jpg',
						'5'          => get_template_directory_uri().'/inc/elements/layouts/red-fancybox-layout-5.jpg',
						'6'          => get_template_directory_uri().'/inc/elements/layouts/red-fancybox-layout-6.jpg',
						'7'          => get_template_directory_uri().'/inc/elements/layouts/red-fancybox-layout-7.jpg',
						
					),
					'std'        => '1',
					'group'      => esc_html__('Template','givingwalk'),
			    ),
			    array(
		            'type'          => 'colorpicker',
		            'param_name'    => 'bg_color',
		            'heading'       => esc_html__( 'Background Color', 'givingwalk' ),
		            'value'         => '',
		            'group'      => esc_html__('Template','givingwalk'),
		            'dependency'  => array(
					  'element'   	=> 'layout_mode',
					  'value' => array(
				            '1',
				        ),
					),
		        ),
			    array(
		            'type' 			=> 'dropdown',
		            'heading' 		=> esc_html__('Link Button type','givingwalk'),
		            'param_name' 	=> 'button_type',
		            'value' 		=> array(
		            	esc_html__( 'Default', 'givingwalk' )        => 'btn',
	                    esc_html__( 'Primary', 'givingwalk' )        => 'btn-primary',
	                    esc_html__( 'Default Alt', 'givingwalk' )    => 'btn btn-alt',
	                    esc_html__( 'Primary Alt', 'givingwalk' )    => 'btn-primary btn-alt',
	                    esc_html__( 'Alt White', 'givingwalk' )      => 'btn btn-white btn-alt',
	                    esc_html__( 'Simple Link', 'givingwalk' )    => 'readmore simple', 
	                    esc_html__( 'Simple Link dark', 'givingwalk' )    => 'readmore simple dark', 
		            ),
		            'std'			=> 'btn',
		            'dependency'  => array(
					  'element'   	=> 'layout_mode',
					  'value' => array(
				            '1',
				            '2',
				            '4',
				            '5',
				        ),
					),
		            'group' 		=> esc_html__('Template', 'givingwalk')
		        ),

		        array(
		            'type' 			=> 'dropdown',
		            'heading' 		=> esc_html__('Dark/Light','givingwalk'),
		            'param_name' 	=> 'dark_light',
		            'value' 		=> array(
		            	esc_html__( 'Dark', 'givingwalk' )        => 'dark',
	                    esc_html__( 'Light', 'givingwalk' )        => 'light',
		            ),
		            'std'			=> 'dark',
		            'dependency'  => array(
					  'element'   	=> 'layout_mode',
					  'value' => array(
				            '3',
				        ),
					),
		            'group' 		=> esc_html__('Template', 'givingwalk')
		        ),


		        array(
					"type"       => "css_editor",
					"heading"    => '',
					"param_name" => "css",
					"value"      => "",
					"group"      => esc_html__("Design Options",'givingwalk'),
				) 
			)
		)
	)
);
class WPBakeryShortCode_red_fancybox extends CmsShortCode{
	protected function content($atts, $content = null){
		$atts_extra = shortcode_atts(array(
			'title'            => '',
			'description'      => '',
			'content_align'    => '',
			'button_link'      => '',
			'icon_type'        => 'ionicons',
			'icon_fontawesome' => '',
			'icon_openiconic'  => '',
			'icon_typicons'    => '',
			'icon_entypo'      => '',
			'icon_linecons'    => '',
			'icon_monosocial'  => '',
			'layout_mode'      => '1',
			'button_type'		=> 'btn btn-default',
			'class'            => '',
		), $atts);
		$atts = array_merge($atts_extra,$atts);
		$atts['icon_type'] = isset($atts['icon_type'])?$atts['icon_type']:'ionicons';
		$atts['description_item'] = isset($atts['description_item'])?$atts['description_item']:'';
		$atts['title_item'] = isset($atts['title_item'])?$atts['title_item']:'';
		switch ($atts['icon_type']) {
			default:
				vc_icon_element_fonts_enqueue( $atts['icon_type'] );
				break;
		}
		return parent::content($atts, $content);
	}
}
