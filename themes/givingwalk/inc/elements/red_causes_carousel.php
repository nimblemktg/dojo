<?php
vc_map(
	array(
		'name'     => esc_html__('Red Causes Carousel', 'givingwalk'),
		'base'     => 'red_causes_carousel',
		'icon'     => 'icon-wpb-application-icon-large',
		'category' => esc_html__('RedExp', 'givingwalk'),
		'params'   => array(
	    	array(
				'type' => 'autocomplete',
				'heading' => esc_html__( 'Narrow data source', 'givingwalk' ),
				'param_name' => 'taxonomies',
				'settings' => array(
					'multiple' => true,
					'min_length' => 1,
					'groups' => true,
					// In UI show results grouped by groups, default false
					'unique_values' => true,
					// In UI show results except selected. NB! You should manually check values in backend, default false
					'display_inline' => true,
					// In UI show results inline view, default false (each value in own line)
					'delay' => 500,
					// delay for search. default 500
					'auto_focus' => true,
					// auto focus input, default true
					'values'   =>  givingwalk_get_causes_categories_for_autocomplete(),
				),
				'param_holder_class' => 'vc_not-for-custom',
				'description' => esc_html__( 'Enter categories.', 'givingwalk' ),
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__('Post Per Page','givingwalk'),
				'param_name' => 'posts_per_page',
				'value'      =>  get_option('posts_per_page'),
		    ),
    		array(
                'type'             => 'dropdown',
                'heading'          => esc_html__('Small Screen', 'givingwalk'),
                'param_name'       => 'owl_sm_items',
                'edit_field_class' => 'vc_col-sm-3 vc_carousel_item',
                'value'            => array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12),
                'std'              => 1,
                'group'       => esc_html__('Carousel Setting', 'givingwalk'),
            ),
            array(
                'type'             => 'dropdown',
                'heading'          => esc_html__('Medium Screen', 'givingwalk'),
                'param_name'       => 'owl_md_items',
                'edit_field_class' => 'vc_col-sm-3 vc_carousel_item',
                'value'            => array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12),
                'std'              => 2,
                'group'       => esc_html__('Carousel Setting', 'givingwalk'),
            ),
            array(
                'type'             => 'dropdown',
                'heading'          => esc_html__('Large Screen', 'givingwalk'),
                'param_name'       => 'owl_lg_items',
                'edit_field_class' => 'vc_col-sm-3 vc_carousel_item',
                'value'            => array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12),
                'std'              => 3,
                'group'       => esc_html__('Carousel Setting', 'givingwalk'),
            ),
            array(
                'type'             => 'dropdown',
                'heading'          => esc_html__('Extra Large Screen', 'givingwalk'),
                'param_name'       => 'owl_xl_items',
                'edit_field_class' => 'vc_col-sm-3 vc_carousel_item',
                'value'            => array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12),
                'std'              => 4,
                'group'       => esc_html__('Carousel Setting', 'givingwalk'),
            ),
            array(
                'type'        => 'dropdown',
                'heading'     => esc_html__('Number Row', 'givingwalk'),
                'description' => esc_html__('Choose number of row you want to show.', 'givingwalk'),
                'param_name'  => 'number_row',
                'value'       => array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10),
                'std'         => 1,
                'group'       => esc_html__('Carousel Setting', 'givingwalk'),
            ),

            array(
                'type'             => 'checkbox',
                'heading'          => esc_html__('Loop Items', 'givingwalk'),
                'param_name'       => 'loop',
                'std'              => 'false',
                'edit_field_class' => 'vc_col-sm-3 vc_carousel_item',
                'group'       => esc_html__('Carousel Setting', 'givingwalk'),
            ),
            array(
                'type'             => 'checkbox',
                'heading'          => esc_html__('Center', 'givingwalk'),
                'param_name'       => 'center',
                'std'              => 'false',
                'edit_field_class' => 'vc_col-sm-3 vc_carousel_item',
                'group'       => esc_html__('Carousel Setting', 'givingwalk'),
            ),
            array(
                'type'             => 'checkbox',
                'heading'          => esc_html__('Auto Width', 'givingwalk'),
                'param_name'       => 'autowidth',
                'std'              => 'false',
                'edit_field_class' => 'vc_col-sm-3 vc_carousel_item',
                'group'       => esc_html__('Carousel Setting', 'givingwalk'),
            ),
            array(
                'type'             => 'checkbox',
                'heading'          => esc_html__('Auto Height', 'givingwalk'),
                'param_name'       => 'autoheight',
                'std'              => 'true',
                'edit_field_class' => 'vc_col-sm-3 vc_carousel_item',
                'group'       => esc_html__('Carousel Setting', 'givingwalk'),
            ),

            array(
                'type'             => 'textfield',
                'heading'          => esc_html__('Items Space', 'givingwalk'),
                'param_name'       => 'margin',
                'value'            => 30,
                'edit_field_class' => 'vc_col-sm-4 vc_carousel_item',
                'group'       => esc_html__('Carousel Setting', 'givingwalk'),
            ),
            array(
                'type'             => 'textfield',
                'heading'          => esc_html__('Stage Padding', 'givingwalk'),
                'param_name'       => 'stagepadding',
                'value'            => '0',
                'edit_field_class' => 'vc_col-sm-4 vc_carousel_item',
                'group'       => esc_html__('Carousel Setting', 'givingwalk'),
            ),

            array(
                'type'             => 'textfield',
                'heading'          => esc_html__('Start Position', 'givingwalk'),
                'param_name'       => 'startposition',
                'value'            => '0',
                'edit_field_class' => 'vc_col-sm-4 vc_carousel_item',
                'group'       => esc_html__('Carousel Setting', 'givingwalk'),
            ),

            array(
                'type'       => 'checkbox',
                'param_name' => 'nav',
                'value'      => array(
                    esc_html__('Show Next/Preview button', 'givingwalk') => 'true'
                ),
                'std'        => 'false',
                'group'       => esc_html__('Carousel Setting', 'givingwalk'),
            ),
            array(
                'type'             => 'dropdown',
                'heading'          => esc_html__('Nav Style', 'givingwalk'),
                'param_name'       => 'nav_style',
                'value'            => givingwalk_carousel_nav_style(),
                'std'              => '',
                'dependency'       => array(
                    'element' => 'nav',
                    'value'   => 'true',
                ),
                'edit_field_class' => 'vc_col-sm-6 vc_carousel_item',
                'group'       => esc_html__('Carousel Setting', 'givingwalk'),
            ),
            array(
                'type'             => 'dropdown',
                'heading'          => esc_html__('Nav Position', 'givingwalk'),
                'param_name'       => 'nav_pos',
                'value'            => givingwalk_carousel_nav_pos(),
                'std'              => '',
                'dependency'       => array(
                    'element'            => 'nav_style',
                    'value_not_equal_to' => array('1'),
                ),
                'edit_field_class' => 'vc_col-sm-6 vc_carousel_item',
                'group'       => esc_html__('Carousel Setting', 'givingwalk'),
            ),
            array(
                'type'       => 'checkbox',
                'value'      => array(
                    esc_html__('Show Dots', 'givingwalk') => 'true'
                ),
                'param_name' => 'dots',
                'std'        => 'true',
                'group'       => esc_html__('Carousel Setting', 'givingwalk'),
            ),
            array(
                'type'             => 'dropdown',
                'heading'          => esc_html__('Dots Style', 'givingwalk'),
                'param_name'       => 'dot_style',
                'value'            => givingwalk_carousel_dots_style(),
                'std'              => '',
                'dependency'       => array(
                    'element' => 'dots',
                    'value'   => 'true',
                ),
                'edit_field_class' => 'vc_col-sm-6 vc_carousel_item',
                'group'       => esc_html__('Carousel Setting', 'givingwalk'),
            ),
            array(
                'type'             => 'dropdown',
                'heading'          => esc_html__('Dots Position', 'givingwalk'),
                'param_name'       => 'dot_pos',
                'value'            => givingwalk_carousel_dot_pos(),
                'std'              => '',
                'dependency'       => array(
                    'element' => 'dots',
                    'value'   => array('true'),
                ),
                'edit_field_class' => 'vc_col-sm-6 vc_carousel_item',
                'group'       => esc_html__('Carousel Setting', 'givingwalk'),
            ),

            array(
                'type'       => 'checkbox',
                'value'      => array(
                    esc_html__('Auto Play', 'givingwalk') => 'true'
                ),
                'param_name' => 'autoplay',
                'std'        => 'true',
                'group'       => esc_html__('Carousel Setting', 'givingwalk'),
            ),
            array(
                'type'             => 'textfield',
                'heading'          => esc_html__('Smart Speed', 'givingwalk'),
                'param_name'       => 'smartspeed',
                'value'            => '250',
                'description'      => esc_html__('Speed scroll of each item', 'givingwalk'),
                'edit_field_class' => 'vc_col-sm-4 vc_carousel_item',
                'dependency'       => array(
                    'element' => 'autoplay',
                    'value'   => 'true',
                ),
                'group'       => esc_html__('Carousel Setting', 'givingwalk'),
            ),
            array(
                'type'             => 'textfield',
                'heading'          => esc_html__('Auto Play TimeOut', 'givingwalk'),
                'param_name'       => 'autoplaytimeout',
                'value'            => '5000',
                'dependency'       => array(
                    'element' => 'autoplay',
                    'value'   => 'true',
                ),
                'edit_field_class' => 'vc_col-sm-4 vc_carousel_item',
                'group'       => esc_html__('Carousel Setting', 'givingwalk'),
            ),
            array(
                'type'             => 'checkbox',
                'heading'          => esc_html__('Pause on mouse hover', 'givingwalk'),
                'param_name'       => 'autoplayhoverpause',
                'std'              => 'true',
                'dependency'       => array(
                    'element' => 'autoplay',
                    'value'   => 'true',
                ),
                'edit_field_class' => 'vc_col-sm-4 vc_carousel_item',
                'group'       => esc_html__('Carousel Setting', 'givingwalk'),
            ),
            array(
                'type'             => 'animation_style',
                'class'            => '',
                'heading'          => esc_html__('Animation In', 'givingwalk'),
                'param_name'       => 'owlanimation_in',
                'std'              => '',
                'settings'         => array(
                    'type' => array(
                        'in'
                    ),
                ),
                'edit_field_class' => 'vc_col-sm-6 vc_carousel_item',
                'group'       => esc_html__('Carousel Setting', 'givingwalk'),
            ),
            array(
                'type'             => 'animation_style',
                'class'            => '',
                'heading'          => esc_html__('Animation Out', 'givingwalk'),
                'param_name'       => 'owlanimation_out',
                'std'              => '',
                'settings'         => array(
                    'type' => array(
                        'out'
                    ),
                ),
                'edit_field_class' => 'vc_col-sm-6 vc_carousel_item',
                'group'       => esc_html__('Carousel Setting', 'givingwalk'),
            ),
        )
	)
);
class WPBakeryShortCode_red_causes_carousel extends CmsShortCode{
	protected function content($atts, $content = null){
		global $cms_carousel;
        if(!is_array($cms_carousel))
            $cms_carousel = [];

        $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
        extract( $atts );

        wp_enqueue_script('vc_pageable_owl-carousel');
        wp_enqueue_script('red-owlcarousel');
        wp_enqueue_style( 'vc_pageable_owl-carousel-css');
        wp_enqueue_style( 'animate-css');
        /* Carousel Setting */
        $icon_prev = is_rtl() ? 'right' : 'left';
        $icon_next = is_rtl() ? 'left' : 'right';

        $nav_icon = array('<i class="fa fa-chevron-'.$icon_prev.'" data-title="'.esc_html__('Prev','givingwalk').'"></i>','<i class="fa fa-chevron-'.$icon_next.'" data-title="'.esc_html__('Next','givingwalk').'"></i>');
        $rtl = is_rtl() ? true : false;
        $carousel_wrap_class = $navContainer = $dotsContainer = $nav_small = $nav_large = $dot_small = $dot_large = $dotsData = '';
        if($nav_style === '1'){
           $navContainer = '#'.$el_id.' + .navContainer';
           if($dot_pos !== '1') $dotsContainer = '.dotContainer';
        }
        /* Nav Position */
        $navContainerClass = 'owl-nav '.$nav_pos;
        if($nav_pos === 'nav-vertical') {
            $nav_small = false;
            $nav_large = $nav;
            if(empty($dots)){
                $dot_small = true;
                $dot_large = $dots;
            } else {
                $dot_small = $dots;
                $dot_large = $dots;
            }
        } else {
            $nav_small = $nav;
            $nav_large = $nav;
            $dot_small = $dots;
            $dot_large = $dots;
        }
        /* Dots Style */
        $dotsClass = 'owl-dots row no-gutters align-items-center justify-content-center '.$dot_style;
        if($dot_pos === '1') $dotsContainer = '.'.$el_id.' .dotContainerTop';
        if($dot_style === 'dots-thumbnail'){
            $dotsData = true;
        }

        $el_id = cmsHtmlID('red-causes-carousel');

        $cms_carousel[$el_id] = array(
            'rtl'                => $rtl,
            'margin'             => (int)$margin,
            'loop'               => $loop,
            'center'             => $center,
            'stagePadding'       => (int)$stagepadding,
            'autoWidth'          => $autowidth,
            'startPosition'      => (int)$startposition,
            'nav'                => $nav,
            'navContainer'       => $navContainer,
            'navContainerClass'  => $navContainerClass,
            'navText'            => $nav_icon,
            'dots'               => $dots,
            'dotsClass'          => $dotsClass,
            'dotsContainer'      => $dotsContainer,
            'dotsData'           => $dotsData,
            'autoplay'           => $autoplay,
            'autoplayTimeout'    => (int)$autoplaytimeout,
            'autoplayHoverPause' => $autoplayhoverpause,
            'smartSpeed'         => (int)$smartspeed,           
            'autoHeight'         => $autoheight,
            'animateIn'          => $owlanimation_in,
            'animateOut'         => $owlanimation_out,
            'responsiveClass'    => true,
            'slideBy'            => 'page',
            'responsive'         => array(
                0 => array(
                    'items' => (int)$owl_sm_items,
                    'nav'   => $nav_small,
                    'dots'  => $dot_small,
                ),
                768 => array(
                    'items' => (int)$owl_md_items,
                    'nav'   => $nav_small,
                    'dots'  => $dot_small,
                ),
                992 => array(
                    'items' => (int)$owl_lg_items,
                    'nav'   => $nav_small,
                    'dots'  => $dot_small,
                ),
                1200 => array(
                    'items' => (int)$owl_xl_items,
                    'nav'   => $nav_small,
                    'dots'  => $dot_small,
                ),
                1400 => array(
                    'items' => (int)$owl_xl_items,
                    'nav'   => $nav_large,
                    'dots'  => $dot_large,
                )
            )
        );
        wp_localize_script('vc_pageable_owl-carousel', 'cmscarousel', $cms_carousel);
        $atts['el_id'] = $el_id;
		return parent::content($atts, $content);
	}
	
}
