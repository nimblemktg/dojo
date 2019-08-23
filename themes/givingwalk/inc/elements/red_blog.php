<?php
vc_map(
	array(
		'name'     => esc_html__('Red Blog', 'givingwalk'),
		'base'     => 'red_blog',
		'icon'     => 'icon-wpb-application-icon-large',
		'category' => esc_html__('RedExp', 'givingwalk'),
		'params'   => array_merge(
			array(
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
						'values'   =>  givingwalk_get_post_categories_for_autocomplete(),
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
					'type'       => 'dropdown',
					'heading'    => esc_html__('Layout Style','givingwalk'),
					'param_name' => 'layout_style',
					'value'      =>  array(
			            esc_html__('Grid','givingwalk') => 'grid',
			            esc_html__('Mask Masonry','givingwalk') => 'mask-masonry',
			            esc_html__('Carousel','givingwalk') => 'carousel',
			        ),
					'std'   => 'grid',
					'group' => esc_html__('Template','givingwalk'),
			    ),
			    array(
	                'type' => 'img',
	                'heading' => esc_html__('Layout Mode','givingwalk'),
	                'param_name' => 'layout_mode',
	                'value' =>  array(
	                    'default' => get_template_directory_uri().'/inc/elements/layouts/default.jpg',
	                    '1' => get_template_directory_uri().'/inc/elements/layouts/red-blog-carousel-layout-1.jpg',
	                ),
	                'std' => 'default',
	                'dependency'       => array(
		                'element' => 'layout_style',
		                'value'   => 'carousel',
		            ),
		            'group'       => esc_html__('Layout Mode','givingwalk'),
	            ),
			),
			givingwalk_grid_settings(array(
				'group'      => esc_html__('Template','givingwalk'),
				'param_name' => 'layout_style',
				'value'      => 'grid'
				)
			),
			/* Carousel Settings */
	        givingwalk_owl_settings(array(
	            'group'      => esc_html__('Template','givingwalk'), 
	            'param_name' => 'layout_style', 
	            'value'      => 'carousel'
	            )
	        )

	    )
	)
);
class WPBakeryShortCode_red_blog extends CmsShortCode{
	protected function content($atts, $content = null){
		global $cms_carousel;
        if(!is_array($cms_carousel))
            $cms_carousel = [];

        $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
        extract( $atts );

		if($layout_style === 'carousel'){
            wp_enqueue_script('vc_pageable_owl-carousel');
            wp_enqueue_script('red-owlcarousel');
            wp_enqueue_style( 'vc_pageable_owl-carousel-css');
            wp_enqueue_style( 'animate-css');
            /* Carousel Setting */
            $icon_prev = is_rtl() ? 'right' : 'left';
            $icon_next = is_rtl() ? 'left' : 'right';

            $nav_icon = array('<i class="fa fa-angle-'.$icon_prev.'" data-title="'.esc_html__('Prev','givingwalk').'"></i>','<i class="fa fa-angle-'.$icon_next.'" data-title="'.esc_html__('Next','givingwalk').'"></i>');
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

            $el_id = cmsHtmlID('red-blog-carousel');

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
        }
		return parent::content($atts, $content);
	}
	
}
