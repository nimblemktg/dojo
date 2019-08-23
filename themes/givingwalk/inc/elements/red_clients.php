<?php
vc_map(array(
    'name'        => 'Red Clients',
    'base'        => 'red_clients',
    'category'    => esc_html__('RedExp', 'givingwalk'),
    'description' => esc_html__('Add clients image with custom link', 'givingwalk'),
    'icon'        => 'redel-icon-client',
    'params'      => array_merge(
        array(
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__('Content Align','givingwalk'),
                'param_name'    => 'content_align',
                'value'         => array(
                    esc_html__('Default','givingwalk')       => '',
                    esc_html__('Text Left','givingwalk')     => 'text-left',
                    esc_html__('Text Right','givingwalk')    => 'text-right',
                    esc_html__('Text Center','givingwalk')   => 'text-center',
                ),
                'std'           => '',
            ),
            array(
                'type'       => 'img',
                'heading'    => esc_html__('Layout Mode','givingwalk'),
                'param_name' => 'layout_mode',
                'value'      =>  array(
                    '1'          => get_template_directory_uri().'/assets/images/header/default.jpg',
                ),
                'std'        => '1',
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
                'type'       => 'textfield',
                'heading'    => esc_html__('Extra Class','givingwalk'),
                'param_name' => 'el_class',
                'value'      => '',
                'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'givingwalk'),
            ),
            /* Clients Settings */
            array(
                "type"          => "dropdown",
                "heading"       => esc_html__("Client image size",'givingwalk'),
                "param_name"    => "thumbnail_size",
                "value"         => givingwalk_thumbnail_sizes(),
                "std"           => "medium",
                "group"         => esc_html__('Clients','givingwalk'),
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__("Custom member image size",'givingwalk'),
                'description'   => esc_html__('Alternatively enter size in pixels (Example: 200x100 (Width x Height)).','givingwalk'),
                "param_name"    => "thumbnail_size_custom",
                "value"         => '',
                "group"         => esc_html__('Clients','givingwalk'),
                'dependency'    => array(
                    'element'   => 'thumbnail_size',
                    'value'     => 'custom',
                ),
            ),
            array(
                'type'       => 'param_group',
                'heading'    => esc_html__( 'Add Clients', 'givingwalk' ),
                'param_name' => 'values',
                'value'      =>  '',
                'params'     => array(
                    array(
                        'type'        => 'attach_image',
                        'heading'     => esc_html__( 'Client Image', 'givingwalk' ),
                        'param_name'  => 'image',
                        'admin_label' => true,
                    ),
                    array(
                        'type'        => 'vc_link',
                        'heading'     => esc_html__( 'Link', 'givingwalk' ),
                        'param_name'  => 'image_link',
                        'description' => esc_html__( 'Enter link for image.', 'givingwalk' ),
                    ),
                ),
                'group'     => 'Clients'
            ),
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Layout Style','givingwalk'),
                'param_name' => 'layout_style',
                'value'      =>  array(
                    esc_html__('Grid','givingwalk')     => 'grid',
                    esc_html__('Carousel','givingwalk') => 'carousel'
                ),
                'std'        => 'grid',
                'group'      => esc_html__('Layout Settings','givingwalk'),
            )
        ),
        /* Grid settings */
        givingwalk_grid_settings(array(
            'group'      => esc_html__('Layout Settings','givingwalk'), 
            'param_name' => 'layout_style', 
            'value'      => 'grid'
            )
        ),
        /* Carousel Settings */
        givingwalk_owl_settings(array(
            'group'      => esc_html__('Layout Settings','givingwalk'), 
            'param_name' => 'layout_style', 
            'value'      => 'carousel'
            )
        )
    )
));

class WPBakeryShortCode_red_clients extends CmsShortCode
{
    protected function content($atts, $content = null)
    {
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
