<?php
vc_map(array(
    'name'        => esc_html__('Red Events', 'givingwalk'),
    'base'        => 'red_events',
    'category'    => esc_html__('RedExp', 'givingwalk'),
    'description' => esc_html__('Show events as list style', 'givingwalk'),
    'icon'        => 'redel-icon-client',
    'params'      => array_merge(
        array(
            array(
                'type'       => 'img',
                'heading'    => esc_html__('Layout Mode','givingwalk'),
                'param_name' => 'layout_mode',
                'value'      =>  array(
                    '1'          => get_template_directory_uri().'/inc/elements/layouts/red-events-layout-1.jpg',
                    '2'          => get_template_directory_uri().'/inc/elements/layouts/red-events-layout-2.jpg',
                    '3'          => get_template_directory_uri().'/inc/elements/layouts/red-events-layout-3.jpg',
                    '4'          => get_template_directory_uri().'/inc/elements/layouts/red-events-layout-4.jpg',
                ),
                'std'        => '1',
            ),
            
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Post Per Page','givingwalk'),
                'param_name' => 'posts_per_page',
                'value'      =>  get_option('posts_per_page'),
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__('Event type','givingwalk'),
                'param_name'    => 'event_type',
                'value'         => array(
                    esc_html__( 'Recent', 'givingwalk' )   => 'recent',
                    esc_html__( 'Upcoming', 'givingwalk' ) => 'upcoming',
                ),
                'std'           => 'recent',
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__('Order by','givingwalk'),
                'param_name'    => 'order_by',
                'value'         => array(
                    esc_html__( 'Default', 'givingwalk' )   => '',
                    esc_html__( 'Start date', 'givingwalk' ) => 'start_date',
                    esc_html__( 'End date', 'givingwalk' ) => 'end_date',
                ),
                'std'           => '',
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__('Order','givingwalk'),
                'param_name'    => 'order',
                'value'         => array(
                    'DESC' => 'desc',
                    'ASC' => 'asc'
                ),
                'dependency'    => array(
                    'element' => 'order_by',
                    'value' => array('start_date','end_date'),
                ),
                'std'           => 'desc',
            ),
            array(
                'type'        => 'el_id',
                'settings' => array(
                    'auto_generate' => true,
                ),
                'heading'     => esc_html__( 'Element ID', 'givingwalk' ),
                'param_name'  => 'el_id',
                'description' => sprintf( __( 'Enter element ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'givingwalk' ), 'http://www.w3schools.com/tags/att_global_id.asp' ),
            ),
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Layout Style','givingwalk'),
                'param_name' => 'layout_style',
                'value'      =>  array(
                    esc_html__('Grid','givingwalk')     => 'grid',
                    esc_html__('Carousel','givingwalk') => 'carousel'
                ),
                'dependency'    => array(
                    'element' => 'layout_mode',
                    'value' => array('3','4'),
                ),
                'std'        => 'grid',
                'group'      => esc_html__('Layout Settings','givingwalk'),
            ),
            array(
                'type' => 'css_editor',
                'heading' => esc_html__( 'CSS box', 'givingwalk' ),
                'param_name' => 'css',
                'group' => esc_html__( 'Design Options', 'givingwalk' ),
            )  
        ),
        givingwalk_grid_settings(array(
            'group'      => esc_html__('Layout Settings','givingwalk'), 
            'param_name' => 'layout_style', 
            'value'      => 'grid'
            )
        ),
        givingwalk_owl_settings(array(
            'group'      => esc_html__('Layout Settings','givingwalk'), 
            'param_name' => 'layout_style', 
            'value'      => 'carousel'
            )
        )
    )
));

class WPBakeryShortCode_red_events extends CmsShortCode
{
    protected function content($atts, $content = null){
        global $cms_carousel;
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
        }
        return parent::content($atts, $content);
    }
}
