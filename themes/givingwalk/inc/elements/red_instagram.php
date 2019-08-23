<?php
vc_map(array(
    'name'        => 'Red Instagram',
    'base'        => 'red_instagram',
    'category'    => esc_html__('RedExp', 'givingwalk'),
    'description' => esc_html__('Add your Instagram image', 'givingwalk'),
    'icon'        => 'redel-icon-instagram',
    'params'      => array_merge(
        array(
            array(
                'type'          => 'textfield',
                'heading'       => esc_html__('Title','givingwalk'),
                'param_name'    => 'el_title',
                'value'         => '',
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__('Layout','givingwalk'),
                'param_name'    => 'el_layout_mode',
                'value'         => array(
                    esc_html__('Default', 'givingwalk')       => '0',
                    esc_html__('Layout 1', 'givingwalk')      => '1',
                ),
                'std'           => '0'
            ),
            array(
                'type'          => 'textfield',
                'heading'       => esc_html__('User Name','givingwalk'),
                'param_name'    => 'el_username',
                'value'         => 'red.kidsplay',
                'description'   => sprintf(__('<a href="%s" target="_blank"> %s </a>. Get : red.kidsplay','givingwalk'),'https://www.instagram.com/red.kidsplay','https://www.instagram.com/red.kidsplay')
            ),
            array(
                'type'          => 'textfield',
                'heading'       => esc_html__('API','givingwalk'),
                'param_name'    => 'el_api',
                'value'         => '6500395100.1677ed0.96ebe958c36346fca373fd4ed7016e47',
                'description'   => sprintf(__('<a href="%s" target="_blank">Generate Instagram Access Token</a>','givingwalk'),'http://instagram.pixelunion.net')
            ),
            array(
                'type'          => 'textfield',
                'heading'       => esc_html__('User ID','givingwalk'),
                'param_name'    => 'el_id',
                'value'         => '6500395100',
                'description'   => esc_html__('Get numbers before FIRST dot from Access Token, Ex: your key is: 6500395100.1677ed0.96ebe958c36346fca373fd4ed7016e47, Just get : 6500395100','givingwalk'),
            ),
            array(
                'type'          => 'textfield',
                'heading'       => esc_html__('Number Image','givingwalk'),
                'param_name'    => 'el_number',
                'value'         => '6',
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__('Number Columns','givingwalk'),
                'param_name'    => 'el_columns',
                'value'         => array(1,2,3,4,6,12),
                'std'           => '6'
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__('Columns Space','givingwalk'),
                'param_name'    => 'el_columns_space',
                'value'         => array(0,10,20,30),
                'std'           => '10'
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__('Image Size','givingwalk'),
                'param_name'    => 'el_size',
                'value'         => array(
                    esc_html__('Thumbnail (150x150)', 'givingwalk')       => 'thumbnail',
                    esc_html__('Large (640x640)', 'givingwalk')           => 'large',
                ),
                'std'           => 'thumbnail',
                'description'   => esc_html__('Auto-detect means that the plugin automatically sets the image resolution based on the size of your feed.','givingwalk')
            ),
            array(
                'type'          => 'checkbox',
                'heading'       => esc_html__('Show Author','givingwalk'),
                'param_name'    => 'el_show_author',
                'std'           => 'true' 
            ),
            array(
                'type'          => 'textfield',
                'heading'       => esc_html__('Author Text','givingwalk'),
                'param_name'    => 'el_author_text',
                'value'         => esc_html__('Follow Us', 'givingwalk'),
                'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'givingwalk'),
                'dependency'    => array(
                    'element'   => 'el_show_author',
                    'value'     => 'true',
                ),
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__('Open Link in?','givingwalk'),
                'param_name'    => 'el_target',
                'value'         => array(
                    esc_html__('Current window', 'givingwalk')       => '_self',
                    esc_html__('New Window ', 'givingwalk')      => '_blank',
                ),
                'std'           => '_self',
                'dependency'    => array(
                    'element'   => 'el_show_author',
                    'value'     => 'true',
                ),
            ),
            array(
                'type'          => 'textfield',
                'heading'       => esc_html__('Extra Class','givingwalk'),
                'param_name'    => 'el_class',
                'value'         => '',
                'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'givingwalk'),
            )
        )
    )
));
class WPBakeryShortCode_red_instagram extends CmsShortCode{}
