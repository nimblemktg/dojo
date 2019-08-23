<?php
vc_map(array(
    'name'        => 'Red Processes',
    'base'        => 'red_process',
    'icon'        => 'redel-icon-processes',
    'category'    => esc_html__('RedExp', 'givingwalk'),
    'description' => esc_html__('Add your processes', 'givingwalk'),
    'params'      => array_merge(
        array(
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__( 'Title', 'givingwalk' ),
                'param_name'  => 'el_title',
                'admin_label' => true,
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__('Content Align','givingwalk'),
                'param_name'    => 'content_align',
                'value'         => array(
                    'Default'       => 'text-default',
                    'Text Left'     => 'text-left',
                    'Text Right'    => 'text-right',
                    'Text Center'   => 'text-center',
                ),
                'std'           => 'text-center',
            ),
            array(
                'type'       => 'dropdown',
                'param_name' => 'color_mode',
                'heading'    => esc_html__( 'Color Mode', 'givingwalk' ),
                'value'      => array(
                    esc_html__( 'Default', 'givingwalk' )     => '',
                ),
                'std' => '',
            ),
            array(
                'type'       => 'dropdown',
                'param_name' => 'layout_type',
                'heading'    => esc_html__( 'Layout Type', 'givingwalk' ),
                'value'      => array(
                    esc_html__( 'Default', 'givingwalk' )  => 'default',
                    esc_html__( 'Carousel', 'givingwalk' ) => 'carousel',
                ),
                'std' => 'default',
                'admin_label' => true
            ),
            array(
                'type' => 'img',
                'heading' => esc_html__('Layout Mode','givingwalk'),
                'param_name' => 'layout_mode',
                'value' =>  array(
                    '1' => get_template_directory_uri().'/assets/images/header/default.jpg',
                    '2' => get_template_directory_uri().'/assets/images/header/default.jpg',
                ),
                'std' => '1',
            ),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Element Class','givingwalk'),
                'param_name' => 'el_class',
                'description'=> esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.','givingwalk' ),
            ),
            array(
                'type'       => 'el_id',
                'heading'    => esc_html__('Element ID','givingwalk'),
                'param_name' => 'el_id',
                'settings'   => array(
                    'auto_generate' => true,
                ),
                'description'   => sprintf( __( 'Enter element ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'givingwalk' ), 'http://www.w3schools.com/tags/att_global_id.asp' ),
            ),
            array(
                'type'       => 'param_group',
                'heading'    => esc_html__( 'Add your process', 'givingwalk' ),
                'param_name' => 'values',
                'value'      =>  '',
                'group'      => esc_html__('Your Process','givingwalk'),
                'params'     => array_merge(
                    array(
                        array(
                            'type'        => 'textfield',
                            'heading'     => esc_html__( 'Title', 'givingwalk' ),
                            'param_name'  => 'p_title',
                            'admin_label' => true,
                        ),
                        array(
                            'type'        => 'textarea',
                            'heading'     => esc_html__( 'Description', 'givingwalk' ),
                            'param_name'  => 'p_desc',
                        ),
                        array(
                            'type'       => 'attach_image',
                            'heading'    => esc_html__('Image','givingwalk'),
                            'param_name' => 'p_image',
                        ),
                        array(
                            'type'       => 'dropdown',
                            'heading'    => esc_html__('Image Position','givingwalk'),
                            'param_name' => 'p_image_pos',
                            'value'      => array(
                                esc_html__( 'Top / Left', 'givingwalk' )    => 'top',
                                esc_html__( 'Bottom / Right', 'givingwalk' ) => 'bottom',
                                ),
                            'std'        => 'top',
                            'dependency'    => array(
                              'element'         => 'p_image',
                              'not_empty'       => true,
                            ),
                        ),
                        array(
                            'type'          => 'checkbox',
                            'param_name'    => 'add_icon',
                            'heading'       => esc_html__( 'Add Icon?', 'givingwalk' ),
                            'std'           => 'false',
                        ),
                    ),
                    givingwalk_icon_libs(),
                    givingwalk_icon_libs_icon(),
                    array(
                        array(
                            'type'       => 'vc_link',
                            'heading'    => esc_html__( 'Icon Link', 'givingwalk' ),
                            'param_name' => 'icon_link',
                            'dependency'    => array(
                              'element'     => 'add_icon',
                              'value'       => 'true',
                            ),
                        )
                    )
                )
            )
        ),
        /* Carousel Settings */
        givingwalk_owl_settings(array('group'=>esc_html__('Carousel Settings','givingwalk'), 'param_name' => 'layout_type', 'value' => 'carousel'))
    )
));
class WPBakeryShortCode_red_process extends CmsShortCode
{
    protected function content($atts, $content = null)
    {
        global $cms_carousel;
        extract(shortcode_atts(array(
            'el_id'              => '',
            'layout_type'        => 'default',
            /* Carousel */
            'number_row'         => '1',
            'xsmall_items'       => '1',
            'small_items'        => '2',
            'medium_items'       => '3',
            'large_items'        => '4',
            'margin'             => 30,
            'loop'               => false,
            'center'             => false,
            'stagepadding'       => 0,
            'autowidth'          => false,
            'startposition'      => 0,
            'nav'                => false,
            'nav_pos'            => '',
            'nav_style'          => '',
            'dots'               => true,
            'dot_style'          => '',
            'dot_pos'            => '',
            'autoplay'           => true,
            'autoplaytimeout'    => '5000',
            'autoplayhoverpause' => true,
            'smartspeed'         => '250',          
            'autoheight'         => true,
            'owlanimation_in'    => '',
            'owlanimation_out'   => '',
        ), $atts));
        /* Carousel Setting */
        $html_id = 'red-process-'.$el_id;
        $icon_prev = is_rtl() ? 'left' : 'right';
        $icon_next = is_rtl() ? 'right' : 'left';

        $nav_icon = array('<i class="fa fa-angle-'.$icon_prev.'" data-title="'.esc_html__('Prev','givingwalk').'"></i>','<i class="fa fa-angle-'.$icon_next.'" data-title="'.esc_html__('Next','givingwalk').'"></i>');
        $rtl = is_rtl() ? true : false;
        $carousel_wrap_class = $navContainer = $dotsContainer = $nav_small = $nav_large = $dot_small = $dot_large = $dotsData = '';
        if($nav_style === '1'){
            $navContainer = '#'.$html_id.' + .navContainer';            
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
        if($dot_pos === '1') $dotsContainer = '.'.$html_id.' .dotContainerTop';
        if($dot_style === 'dots-thumbnail'){
            $dotsData = true;
        }
        $cms_carousel[$html_id] = array(
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
            'slideBy'            => 'page',
            'responsiveClass'    => true,
            'responsive'         => array(
                0 => array(
                    'items' => (int)$xsmall_items,
                    'nav'   => $nav_small,
                    'dots'  => true,
                ),
                768 => array(
                    'items' => (int)$small_items,
                    'nav'   => $nav_small,
                    'dots'  => true,
                ),
                992 => array(
                    'items' => (int)$medium_items,
                    'nav'   => $nav_small,
                    'dots'  => $dot_small,
                ),
                1200 => array(
                    'items' => (int)$large_items,
                    'nav'   => $nav_small,
                    'dots'  => $dot_small,
                ),
                1400 => array(
                    'items' => (int)$large_items,
                    'nav'   => $nav_large,
                    'dots'  => $dot_large,
                )
            )
        );
        if($layout_type === 'carousel'){
            wp_enqueue_script('vc_pageable_owl-carousel');
            wp_enqueue_script('red-owlcarousel');
            wp_enqueue_style( 'vc_pageable_owl-carousel-css');
            wp_enqueue_style( 'animate-css');
            wp_localize_script('vc_pageable_owl-carousel', 'cmscarousel', $cms_carousel);
        }
        return parent::content($atts, $content);
    }
}
