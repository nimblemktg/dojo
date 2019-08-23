<?php
vc_map(array(
    'name' => 'Red Testimonial',
    'base' => 'red_testimonial',
    'icon'  => 'redel-icon-testimonial',
    'category' => esc_html__('RedExp', 'givingwalk'),
    'description' => esc_html__('Add clients testimonial', 'givingwalk'),
    'params' => array_merge(
        array(
            array(
                'type' => 'img',
                'heading' => esc_html__('Layout Mode','givingwalk'),
                'param_name' => 'layout_mode',
                'value' =>  array(
                    '1' => get_template_directory_uri().'/inc/elements/layouts/red-testimonial-layout-1.jpg',
                    '2' => get_template_directory_uri().'/inc/elements/layouts/red-testimonial-layout-2.jpg',
                ),
                'std' => '1',
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__('Color Mode','givingwalk'),
                'param_name'    => 'color_mode',
                'value'         => array(
                    'Light'       => '',
                    'Dark'     => 'dark',
                ),
                'std'           => '',
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__('Content Align','givingwalk'),
                'param_name'    => 'content_align',
                'value'         => array(
                    'Default'       => '',
                    'Text Left'     => 'text-left',
                    'Text Right'    => 'text-right',
                    'Text Center'   => 'text-center',
                ),
                'std'           => '',
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
            /* Testimonial Settings */
            array(
                'type'          => 'param_group',
                'heading'       => esc_html__( 'Add your testimonial', 'givingwalk' ),
                'param_name'    => 'values',
                'value'         => urlencode( json_encode( array(
                    array(
                        'author_name' => esc_html__( 'John Smith', 'givingwalk' ),
                    ),
                ) ) ),
                'params' => array(
                    array(
                        'type'          => 'textfield',
                        'heading'       => esc_html__( 'Title', 'givingwalk' ),
                        'param_name'    => 'title',
                        'value'         => '',
                    ),
                    array(
                        'type'          => 'textfield',
                        'heading'       => esc_html__( 'Author name', 'givingwalk' ),
                        'param_name'    => 'author_name',
                        'admin_label'   => true,
                        'value'         => esc_html__('John Smith','givingwalk')
                    ),
                    array(
                        'type'          => 'textfield',
                        'heading'       => esc_html__( 'Author Position', 'givingwalk' ),
                        'param_name'    => 'author_position',
                        'placeholder'   => esc_html__('Project Manager','givingwalk')
                    ),
                    array(
                        'type'          => 'textfield',
                        'heading'       => esc_html__( 'Author URL', 'givingwalk' ),
                        'param_name'    => 'author_url',
                    ),
                    array(
                        'type'          => 'attach_image',
                        'heading'       => esc_html__( 'Author Image', 'givingwalk' ),
                        'param_name'    => 'author_avatar',
                        'value'         => ''
                    ),
                    array(
                        'type'          => 'textarea',
                        'heading'       => esc_html__( 'Testimonial text', 'givingwalk' ),
                        'description'   => esc_html__('Press double ENTER to get line-break','givingwalk'),
                        'param_name'    => 'text',
                        'value'         => esc_html__('Donec euismod sem ac urna finibus, sit amet efficitur erat tem pus. Ut dapibus dictum turpis, vel faucibus erat posuere vitae icitur erat tem puna','givingwalk')
                    ),
                ),
                'group' => esc_html__('Testimonial Item','givingwalk')
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

class WPBakeryShortCode_red_testimonial extends CmsShortCode
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
