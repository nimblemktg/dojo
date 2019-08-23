<?php

// Button
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Button", 'consultax'),
        "base" => "otbutton",
        "class" => "",
        "category" => 'Consultax Element',
        "icon" => "icon-st",
        "params" => array(
            array(
                "type" => "textfield",
                "holder" => "div",
                "edit_field_class" => "vc_col-sm-6",
                "heading" => esc_html__("Button Text", 'consultax'),
                "param_name" => "btn_text",
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "edit_field_class" => "vc_col-sm-6",
                "heading" => esc_html__("Button Link", 'consultax'),
                "param_name" => "btn_link",
                "value" => "",
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "edit_field_class" => "vc_col-sm-6",
                "heading" => esc_html__("Size", 'consultax'),
                "param_name" => "size",
                "value" => array(
                    esc_html__('Small', 'consultax')    => 'btn-small',
                    esc_html__('Medium', 'consultax')   => 'btn-medium',
                    esc_html__('Large', 'consultax')    => 'btn-large',
                ),
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "edit_field_class" => "vc_col-sm-6",
                "heading" => esc_html__("Type", 'consultax'),
                "param_name" => "type",
                "value" => array(
                    esc_html__('Solid', 'consultax')     => 'btn-solid',
                    esc_html__('Outline', 'consultax')   => 'btn-border',
                ),
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "edit_field_class" => "vc_col-sm-6",
                "heading" => esc_html__("Style", 'consultax'),
                "param_name" => "style",
                "value" => array(
                    esc_html__('Main Color', 'consultax') => 'main',
                    esc_html__('Dark Color', 'consultax') => 'btn-dark',
                ),
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "edit_field_class" => "vc_col-sm-6",
                "heading" => esc_html__("Align", 'consultax'),
                "param_name" => "align",
                "value" => array(
                    esc_html__('Left', 'consultax')     => 'text-left',
                    esc_html__('Center', 'consultax')   => 'text-center',
                    esc_html__('Right', 'consultax')    => 'text-right',
                ),
            ),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "edit_field_class" => "vc_col-sm-6",
                "class" => "",
                "heading" => esc_html__("Color Text", 'consultax'),
                "param_name" => "color",
                "value" => "",
            ),
            array(
                "type" => "checkbox",
                "holder" => "div",
                "edit_field_class" => "vc_col-sm-6",
                "class" => "",
                "heading" => esc_html__("Open link in a new tab", 'consultax'),
                "param_name" => "target",
                "value" => "",
            ),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "heading" => esc_html__("Backgound Color", 'consultax'),
                "param_name" => "bg_color",
                "value" => "",
                "dependency"  => array( 'element' => 'type', 'value' => 'btn-solid' ),
            ),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Border Color", 'consultax'),
                "param_name" => "bo_color",
                "value" => "",
                "dependency"  => array( 'element' => 'type', 'value' => 'btn-border'),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Extra Class", 'consultax'),
                "param_name" => "iclass",
                "value" => "",
            ),
        )));
}

// OT Heading
if(function_exists('vc_map')){
   vc_map( array(
   "name" => esc_html__("OT Heading", 'consultax'),
   "base" => "hsection",
   "class" => "",
   "category" => 'Consultax Element',
   "icon" => "icon-st",
   "params" => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => esc_html__('Subtitle', 'consultax'),
            "param_name" => "sub",
            "value" => "",
        ),
        array(
            "type" => "textarea",
            "holder" => "div",
            "class" => "",
            "heading" => esc_html__('Title', 'consultax'),
            "param_name" => "title",
            "value" => "",
        ),
        array(
            "type" => "checkbox",
            "holder" => "div",
            "class" => "",
            "heading" => esc_html__("Text Light", 'consultax'),
            "param_name" => "light",
            "value" => "",
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => esc_html__("Extra Class", 'consultax'),
            "param_name" => "iclass",
            "value" => "",
        ),
    )
    ));
}

// OT Video Button
if(function_exists('vc_map')){
   vc_map( array(
   "name" => esc_html__("OT Video Button", 'consultax'),
   "base" => "videobtn",
   "class" => "",
   "category" => 'Consultax Element',
   "icon" => "icon-st",
   "params" => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => esc_html__('Video Link', 'consultax'),
            "param_name" => "link",
            "value" => "",
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => esc_html__('Title', 'consultax'),
            "param_name" => "title",
            "value" => "",
        ),
        array(
            "type" => "checkbox",
            "holder" => "div",
            "class" => "",
            "heading" => esc_html__("Circle", 'consultax'),
            "param_name" => "circle",
            "value" => "",
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => esc_html__("Extra Class", 'consultax'),
            "param_name" => "iclass",
            "value" => "",
        ),
    )
    ));
}

// Socials
if(function_exists('vc_map')){
   vc_map( array(
   "name" => esc_html__("OT Socials", 'consultax'),
   "base" => "isocials",
   "class" => "",
   "category" => 'Consultax Element',
   "icon" => "icon-st",
   "params" => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => esc_html__('Pre Text', 'consultax'),
            "param_name" => "title",
            "value" => "",
        ), 
        array(
            'type' => 'param_group',
            'heading' => esc_html__("Socials", 'consultax'),
            'value' => '',
            'param_name' => 'social',
            // Note params is mapped inside param-group:
            'params' => array(
               array(
                  'type' => 'iconpicker',
                  'value' => '',
                  'heading' => 'Social Icon',
                  'param_name' => 'icon',
               ),
               array(
                  'type' => 'textfield',
                  'value' => '',
                  'heading' => 'Social Link',
                  'param_name' => 'link',
               ),
            )
        ),
        array(
            "type" => "checkbox",
            "holder" => "div",
            "edit_field_class" => "vc_col-sm-6",
            "class" => "",
            "heading" => esc_html__("Open link in a new tab", 'consultax'),
            "param_name" => "target",
            "value" => "",
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => esc_html__('Extra Class', 'consultax'),
            "param_name" => "iclass",
            "value" => "",
        ),   
    )
    ));
}

// Image Carousel
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Image Carousel", 'consultax'),
        "base" => "carousels",
        "class" => "",
        "category" => 'Consultax Element',
        "icon" => "icon-st",
        "params" => array(
            array(
                "type" => "attach_images",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Images', 'consultax'),
                "param_name" => "gallery",
                "value" => "",
            ),
            array(
                "type" => "dropdown",
                "heading" => esc_html__('Slide To Show', 'consultax'),
                "param_name" => "show",
                "value" => array(
                    esc_html__('1 Image', 'consultax')     => '1',
                    esc_html__('2 Images', 'consultax')     => '2',
                    esc_html__('3 Images', 'consultax')     => '3',
                    esc_html__('4 Images', 'consultax')     => '4',
                ),
            ),
            array(
                "type" => "checkbox",
                "holder" => "div",
                "edit_field_class" => "vc_col-sm-6",
                "class" => "",
                "heading" => esc_html__("Enable Arrows", 'consultax'),
                "param_name" => "nav",
                "value" => '',
            ),
            array(
                "type" => "checkbox",
                "holder" => "div",
                "edit_field_class" => "vc_col-sm-6",
                "class" => "",
                "heading" => esc_html__("Gaps", 'consultax'),
                "param_name" => "gaps",
                "value" => '',
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Extra Class", 'consultax'),
                "param_name" => "iclass",
                "value" => "",
            ),
        )));
}


// Icon Box
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Icon Box", 'consultax'),
        "base" => "iconbox",
        "class" => "",
        "category" => 'Consultax Element',
        "params" => array(
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Box Style", 'consultax'),
                "param_name" => "style",
                "value" => array(
                    esc_html__('Solid Background', 'consultax')         => 'solid',
                    esc_html__('Transparent Background', 'consultax')   => 'transparent',
                ),
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Icon Type", 'consultax'),
                "param_name" => "type",
                "value" => array(
                    esc_html__('Icon FontAwesome', 'consultax')  => 'font',
                    esc_html__('Icon FontIonic', 'consultax')    => 'ionic',
                    esc_html__('Icon Image', 'consultax')        => 'image',
                ),
            ),
            array(
                "type" => "iconpicker",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Icon", 'consultax'),
                "param_name" => "icon",
                "dependency"  => array( 'element' => 'type', 'value' => 'font' ),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Ionicon Class", 'consultax'),
                "param_name" => "ion",
                "description" => esc_html__("Find here: https://ionicons.com/", 'consultax'),
                "dependency"  => array( 'element' => 'type', 'value' => 'ionic' ),
            ),
            array(
                "type" => "attach_image",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Image", 'consultax'),
                "param_name" => "photo",
                "dependency"  => array( 'element' => 'type', 'value' => 'image' ),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Title", 'consultax'),
                "param_name" => "title",
            ),
            array(
                "type" => "textarea_html",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Content", 'consultax'),
                "param_name" => "content",
                "value" => "",
            ),
            array(
                'type' => 'vc_link',
                "heading" => esc_html__("Button", 'consultax'),
                "param_name" => "link",
            ),
            array(
                "type" => "checkbox",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Disable Background Hover", 'consultax'),
                "param_name" => "bghover",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Extra Class", 'consultax'),
                "param_name" => "iclass",
            ),
        )));
}

// Service Box
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Service Box", 'consultax'),
        "base" => "servicebox",
        "class" => "",
        "category" => 'Consultax Element',
        "params" => array(
            array(
                "type" => "attach_image",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Image", 'consultax'),
                "param_name" => "photo",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Title", 'consultax'),
                "param_name" => "title",
            ),
            array(
                "type" => "textarea_html",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Content", 'consultax'),
                "param_name" => "content",
                "value" => "",
            ),
            array(
                'type' => 'vc_link',
                "heading" => esc_html__("Button", 'consultax'),
                "param_name" => "link",
            ),
            array(
                "type" => "checkbox",
                "holder" => "div",
                "edit_field_class" => "vc_col-sm-6",
                "class" => "",
                "heading" => esc_html__("Link in Image", 'consultax'),
                "param_name" => "linkimg",
            ),
            array(
                "type" => "checkbox",
                "holder" => "div",
                "edit_field_class" => "vc_col-sm-6",
                "class" => "",
                "heading" => esc_html__("Link in Title", 'consultax'),
                "param_name" => "linktitle",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Extra Class", 'consultax'),
                "param_name" => "iclass",
            ),
        )));
}


// Menu Services
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Menu Services", 'consultax'),
        "base" => "menuservice",
        "class" => "",
        "category" => 'Consultax Element',
        "params" => array(
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Title", 'consultax'),
                "param_name" => "title",
            ),
            array(
                'type' => 'param_group',
                'heading' => esc_html__("Services", 'consultax'),
                'value' => '',
                'param_name' => 'service',
                // Note params is mapped inside param-group:
                'params' => array(
                    array(
                        'type' => 'iconpicker',
                        "holder" => "div",
                        'value' => '',
                        'heading' => esc_html__('FontAwesome Icon', 'consultax'),
                        'param_name' => 'icon',
                    ),
                    array(
                        "type" => "textfield",
                        "holder" => "div",
                        "heading" => esc_html__("Ionicon Class", 'consultax'),
                        "param_name" => "ion",
                        "description" => esc_html__("Find here: https://ionicons.com/", 'consultax'),
                    ),
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        'value' => '',
                        'heading' => esc_html__('Service Name', 'consultax'),
                        'param_name' => 'name',
                    ),
                    array(
                        'type' => 'textfield',
                        'value' => '',
                        'heading' => esc_html__('Service Link', 'consultax'),
                        'param_name' => 'link',
                    ),
                )
            ),
            array(
                'type' => 'vc_link',
                "heading" => esc_html__("Button", 'consultax'),
                "param_name" => "btn",
            ),
            array(
                'type' => 'attach_image',
                "heading" => esc_html__("Background Button", 'consultax'),
                "param_name" => "photo",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Extra Class", 'consultax'),
                "param_name" => "iclass",
                "value" => "",
            ),
        )));
}


// Portfolio Filter
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Portfolio Filter", 'consultax'),
        "base" => "portfoliof",
        'admin_enqueue_js'  => get_template_directory_uri() . '/inc/backend/js/select2.min.js',
        'admin_enqueue_css' => get_template_directory_uri() . '/inc/backend/css/select2.css',
        "class" => "",
        "icon" => "icon-st",
        "category" => 'Consultax Element',
        "params" => array(
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => esc_html__('Style', 'consultax'),
                "param_name" => "style",
                "value" => array(
                    esc_html__('Style 1: Title Under', 'consultax')     => 'style-1',
                    esc_html__('Style 2: Title Inner', 'consultax')     => 'style-2',
                ),
            ),
            array(
                "type" => "checkbox",
                "holder" => "div",
                "edit_field_class" => "vc_col-sm-6",
                "class" => "",
                "heading" => esc_html__("Show Filter?", 'consultax'),
                "param_name" => "filter",
            ),
            array(
                "type" => "checkbox",
                "holder" => "div",
                "edit_field_class" => "vc_col-sm-6",
                "class" => "",
                "heading" => esc_html__("No Gap?", 'consultax'),
                "param_name" => "nogap",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Show All Text", 'consultax'),
                "param_name" => "all",
                "dependency"  => array( 'element' => 'filter', 'value' => 'true' ),
            ),
            array(
                "type"      => "select_categories",
                "holder"    => "div",
                "class"     => "",
                "heading"   => esc_html__("Select Categories", 'consultax'),
                "param_name"=> "idcate",
                "value"     => "",
                "description" => esc_html__("Enter category name.", 'consultax')
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "edit_field_class" => "vc_col-sm-6",
                "heading" => esc_html__('Column', 'consultax'),
                "param_name" => "col",
                "value" => array(
                    esc_html__('3 Columns', 'consultax')     => '3',
                    esc_html__('4 Columns', 'consultax')     => '4',
                    esc_html__('2 Columns', 'consultax')     => '2',
                ),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "edit_field_class" => "vc_col-sm-6",
                "class" => "",
                "heading" => esc_html__("Show Number Projects", 'consultax'),
                "param_name" => "num",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Extra Class", 'consultax'),
                "param_name" => "iclass",
                "value" => "",
            ),
        )));
}

//Portfolio Slider
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Portfolio Slider", 'consultax'),
        "base" => "projrelated",
        'admin_enqueue_js'  => get_template_directory_uri() . '/inc/backend/js/select2.min.js',
        'admin_enqueue_css' => get_template_directory_uri() . '/inc/backend/css/select2.css',
        "class" => "",
        "icon" => "icon-st",
        "category" => 'Consultax Element',
        "params" => array(
            array(
                "type"      => "select_projects",
                "holder"    => "div",
                "class"     => "",
                "heading"   => esc_html__("Projects List", 'consultax'),
                "param_name"=> "idpost",
                "value"     => "",
                "description" => esc_html__("Enter projects name.", 'consultax')
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Details Button", 'consultax'),
                "param_name" => "btn",
                "value" => "",
            ),
            array(
                'type' => 'checkbox',
                'value' => '',
                "holder"    => "div",
                "edit_field_class" => "vc_col-sm-3",
                'heading' => esc_html__('Autoplay?', 'consultax'),
                'param_name' => 'auto',
            ),
            array(
                'type' => 'checkbox',
                'value' => '',
                "holder"    => "div",
                "edit_field_class" => "vc_col-sm-3",
                'heading' => esc_html__('Slide Arrows?', 'consultax'),
                'param_name' => 'nav',
            ),
            array(
                'type' => 'checkbox',
                'value' => '',
                "holder"    => "div",
                "edit_field_class" => "vc_col-sm-3",
                'heading' => esc_html__('Slide Dot?', 'consultax'),
                'param_name' => 'dot',
            ),
            array(
                'type' => 'checkbox',
                'value' => '',
                "holder"    => "div",
                "edit_field_class" => "vc_col-sm-3",
                'heading' => esc_html__('Show Excerpt?', 'consultax'),
                'param_name' => 'exc',
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Extra Class", 'consultax'),
                "param_name" => "iclass",
                "value" => "",
            ),
        )));
}

//Portfolio Slider 2
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Portfolio Slider 2", 'consultax'),
        "base" => "projslide",
        'admin_enqueue_js'  => get_template_directory_uri() . '/inc/backend/js/select2.min.js',
        'admin_enqueue_css' => get_template_directory_uri() . '/inc/backend/css/select2.css',
        "class" => "",
        "icon" => "icon-st",
        "category" => 'Consultax Element',
        "params" => array(
            array(
                "type"      => "select_projects",
                "holder"    => "div",
                "class"     => "",
                "heading"   => esc_html__("Projects List", 'consultax'),
                "param_name"=> "idpost",
                "value"     => "",
                "description" => esc_html__("Enter projects name.", 'consultax')
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Details Button", 'consultax'),
                "param_name" => "btn",
                "value" => "",
            ),
            array(
                'type' => 'checkbox',
                'value' => '',
                "holder"    => "div",
                "edit_field_class" => "vc_col-sm-4",
                'heading' => esc_html__('Autoplay?', 'consultax'),
                'param_name' => 'auto',
            ),
            array(
                'type' => 'checkbox',
                'value' => '',
                "holder"    => "div",
                "edit_field_class" => "vc_col-sm-4",
                'heading' => esc_html__('Slide Arrows?', 'consultax'),
                'param_name' => 'nav',
            ),
            array(
                'type' => 'checkbox',
                'value' => '',
                "holder"    => "div",
                "edit_field_class" => "vc_col-sm-4",
                'heading' => esc_html__('Slide Dot?', 'consultax'),
                'param_name' => 'dot',
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Extra Class", 'consultax'),
                "param_name" => "iclass",
                "value" => "",
            ),
        )));
}

//Portfolio Slider 3
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Portfolio Slider 3", 'consultax'),
        "base" => "projslide2",
        'admin_enqueue_js'  => get_template_directory_uri() . '/inc/backend/js/select2.min.js',
        'admin_enqueue_css' => get_template_directory_uri() . '/inc/backend/css/select2.css',
        "class" => "",
        "icon" => "icon-st",
        "category" => 'Consultax Element',
        "params" => array(
            array(
                "type"      => "select_projects",
                "holder"    => "div",
                "class"     => "",
                "heading"   => esc_html__("Projects List", 'consultax'),
                "param_name"=> "idpost",
                "value"     => "",
                "description" => esc_html__("Enter projects name.", 'consultax')
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Details Button", 'consultax'),
                "param_name" => "btn",
                "value" => "",
            ),
            array(
                "type" => "checkbox",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Text Light", 'consultax'),
                "param_name" => "light",
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Extra Class", 'consultax'),
                "param_name" => "iclass",
                "value" => "",
            ),
        )));
}

// Team Single
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Member Team", 'consultax'),
        "base" => "teamsingle",
        "class" => "",
        "category" => 'Consultax Element',
        "params" => array(
            array(
                "type" => "attach_image",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Avatar", 'consultax'),
                "param_name" => "photo",
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "edit_field_class" => "vc_col-sm-6",
                "class" => "",
                "heading" => esc_html__("Name", 'consultax'),
                "param_name" => "name",
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "edit_field_class" => "vc_col-sm-6",
                "class" => "",
                "heading" => esc_html__("Job", 'consultax'),
                "param_name" => "job",
                "value" => "",
            ),
            array(
                "type" => "textarea_html",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("About Member", 'consultax'),
                "param_name" => "content",
                "value" => "",
            ),
            array(
                'type' => 'param_group',
                'heading' => esc_html__("Socials", 'consultax'),
                'value' => '',
                'param_name' => 'socials',
                // Note params is mapped inside param-group:
                'params' => array(
                    array(
                        'type' => 'iconpicker',
                        "holder" => "div",
                        'value' => '',
                        'heading' => esc_html__('Icon', 'consultax'),
                        'param_name' => 'icon',
                    ),
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        'value' => '',
                        'heading' => esc_html__('Link', 'consultax'),
                        'param_name' => 'link',
                    ),
                )
            ),
            array(
                'type' => 'dropdown',
                'value' => '',
                'heading' => esc_html__('Style', 'consultax'),
                'param_name' => 'style',
                "value" => array(
                    esc_html__('Style 1', 'consultax')   => 's1',
                    esc_html__('Style 2', 'consultax')   => 's2',
                    esc_html__('Style 3', 'consultax')   => 's3',
                ),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Extra Class", 'consultax'),
                "param_name" => "iclass",
                "value" => "",
            ),
        )));
}

// Team Slider
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Team Slider", 'consultax'),
        "base" => "teamslide",
        "class" => "",
        "category" => 'Consultax Element',
        "params" => array(
            array(
                'type' => 'dropdown',
                'value' => '',
                'heading' => esc_html__('Style', 'consultax'),
                'param_name' => 'style',
                "value" => array(
                    esc_html__('Style 1', 'consultax')   => 's1',
                    esc_html__('Style 2', 'consultax')   => 's2'
                ),
            ),
            array(
                'type' => 'param_group',
                'heading' => esc_html__("Member Team", 'consultax'),
                'value' => '',
                'param_name' => 'team',
                // Note params is mapped inside param-group:
                'params' => array(
                    array(
                        'type' => 'attach_image',
                        'value' => '',
                        'heading' => 'Member Photo',
                        'param_name' => 'photo',
                    ),
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        "edit_field_class" => "vc_col-sm-6",
                        'value' => '',
                        'heading' => esc_html__('Member Name', 'consultax'),
                        'param_name' => 'name',
                    ),
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        "edit_field_class" => "vc_col-sm-6",
                        'value' => '',
                        'heading' => esc_html__('Member Position', 'consultax'),
                        'param_name' => 'job',
                    ),
                    array(
                        'type' => 'textarea',
                        'value' => '',
                        'heading' => esc_html__('Member Details', 'consultax'),
                        'param_name' => 'des',
                    ),
                    array(
                        'type' => 'param_group',
                        'heading' => esc_html__("Socials", 'consultax'),
                        'value' => '',
                        'param_name' => 'socials',
                        // Note params is mapped inside param-group:
                        'params' => array(
                            array(
                                'type' => 'iconpicker',
                                "holder" => "div",
                                'value' => '',
                                'heading' => esc_html__('Icon', 'consultax'),
                                'param_name' => 'icon',
                            ),
                            array(
                                'type' => 'textfield',
                                "holder" => "div",
                                'value' => '',
                                'heading' => esc_html__('Link', 'consultax'),
                                'param_name' => 'link',
                            ),
                        )
                    ),
                )
            ),
            array(
                'type' => 'dropdown',
                'value' => '',
                'heading' => esc_html__('Slide To Show', 'consultax'),
                'param_name' => 'number',
                "value" => array(
                    esc_html__('4 Items', 'consultax')   => '4',
                    esc_html__('3 Items', 'consultax')   => '3',
                    esc_html__('2 Items', 'consultax')   => '2'
                ),
            ),
            array(
                'type' => 'checkbox',
                'value' => '',
                'heading' => esc_html__('Arrows Slide?', 'consultax'),
                'param_name' => 'nav',
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Extra Class", 'consultax'),
                "param_name" => "iclass",
                "value" => "",
            ),
        )));
}

// Career Box
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Career Box", 'consultax'),
        "base" => "careerbox",
        "class" => "",
        "category" => 'Consultax Element',
        "params" => array(
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Title", 'consultax'),
                "param_name" => "title",
            ),
            array(
                "type" => "textarea_html",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Content", 'consultax'),
                "param_name" => "content",
                "value" => "",
            ),
            array(
                'type' => 'vc_link',
                "heading" => esc_html__("Button", 'consultax'),
                "param_name" => "btn",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Extra Class", 'consultax'),
                "param_name" => "iclass",
            ),
        )));
}

// Testimonial Single
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Testimonial", 'consultax'),
        "base" => "testimonial",
        "class" => "",
        "category" => 'Consultax Element',
        "params" => array(
            array(
                "type" => "attach_image",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Avatar", 'consultax'),
                "param_name" => "photo",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Name", 'consultax'),
                "param_name" => "name",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Address/Job", 'consultax'),
                "param_name" => "add",
            ),
            array(
                "type" => "textarea_html",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Content", 'consultax'),
                "param_name" => "content",
                "value" => "",
            ),
            array(
                'type' => 'attach_image',
                "heading" => esc_html__("Stars", 'consultax'),
                "param_name" => "stars",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Extra Class", 'consultax'),
                "param_name" => "iclass",
            ),
        )));
}

// Testimonial Slider
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Testimonials Slider", 'consultax'),
        "base" => "testislide",
        "class" => "",
        "category" => 'Consultax Element',
        "params" => array(
            array(
                'type' => 'dropdown',
                'value' => '',
                'heading' => esc_html__('Style', 'consultax'),
                'param_name' => 'style',
                "value" => array(
                    esc_html__('Style 1', 'consultax')   => 'style-1',
                    esc_html__('Style 2', 'consultax')   => 'style-2',
                ),
            ),
            array(
                'type' => 'param_group',
                'heading' => esc_html__("Testimonials", 'consultax'),
                'value' => '',
                'param_name' => 'testi',
                // Note params is mapped inside param-group:
                'params' => array(
                    array(
                        'type' => 'attach_image',
                        'value' => '',
                        'heading' => 'Client Photo',
                        'param_name' => 'photo',
                    ),
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        "edit_field_class" => "vc_col-sm-6",
                        'value' => '',
                        'heading' => esc_html__('Client Name', 'consultax'),
                        'param_name' => 'name',
                    ),
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        "edit_field_class" => "vc_col-sm-6",
                        'value' => '',
                        'heading' => esc_html__('Client Job', 'consultax'),
                        'param_name' => 'job',
                    ),
                    array(
                        'type' => 'textarea',
                        'value' => '',
                        'heading' => esc_html__('Client Says', 'consultax'),
                        'param_name' => 'des',
                    ),
                    array(
                        'type' => 'attach_image',
                        "heading" => esc_html__("Stars", 'consultax'),
                        "param_name" => "stars",
                    ),
                )
            ),
            array(
                'type' => 'dropdown',
                'value' => '',
                'heading' => esc_html__('Slide To Show', 'consultax'),
                'param_name' => 'number',
                "value" => array(
                    esc_html__('2 Items', 'consultax')   => '2',
                    esc_html__('3 Items', 'consultax')   => '3',
                    esc_html__('1 Item', 'consultax')    => '1',
                ),
            ),
            array(
                'type' => 'checkbox',
                'value' => '',
                'heading' => esc_html__('Arrows Slide?', 'consultax'),
                'param_name' => 'nav',
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Extra Class", 'consultax'),
                "param_name" => "iclass",
                "value" => "",
            ),
        )));
}

// Testimonial Slider 2
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Testimonials Slider 2", 'consultax'),
        "base" => "testislide2",
        "class" => "",
        "category" => 'Consultax Element',
        "params" => array(
            array(
                'type' => 'param_group',
                'heading' => esc_html__("Testimonials", 'consultax'),
                'value' => '',
                'param_name' => 'testi',
                // Note params is mapped inside param-group:
                'params' => array(
                    array(
                        'type' => 'attach_image',
                        'value' => '',
                        'heading' => 'Client Photo',
                        'param_name' => 'photo',
                    ),
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        "edit_field_class" => "vc_col-sm-6",
                        'value' => '',
                        'heading' => esc_html__('Client Name', 'consultax'),
                        'param_name' => 'name',
                    ),
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        "edit_field_class" => "vc_col-sm-6",
                        'value' => '',
                        'heading' => esc_html__('Client Job', 'consultax'),
                        'param_name' => 'job',
                    ),
                    array(
                        'type' => 'textarea',
                        'value' => '',
                        'heading' => esc_html__('Client Says', 'consultax'),
                        'param_name' => 'des',
                    ),
                    array(
                        'type' => 'attach_image',
                        "heading" => esc_html__("Stars", 'consultax'),
                        "param_name" => "stars",
                    ),
                )
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Extra Class", 'consultax'),
                "param_name" => "iclass",
                "value" => "",
            ),
        )));
}

//Latest News
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Latest News", 'consultax'),
        "base" => "lastestnews",
        'admin_enqueue_js'  => get_template_directory_uri() . '/inc/backend/js/select2.min.js',
        'admin_enqueue_css' => get_template_directory_uri() . '/inc/backend/css/select2.css',
        "class" => "",
        "icon" => "icon-st",
        "category" => 'Consultax Element',
        "params" => array(
            array(
                "type" => "dropdown",
                "heading" => esc_html__('Style', 'consultax'),
                "param_name" => "style",
                "value" => array(
                    esc_html__('Style 1: Verticle', 'consultax')     => 's1',
                    esc_html__('Style 2: Horizontal', 'consultax')   => 's2',
                ),
            ),
            array(
                "type" => "dropdown",
                "heading" => esc_html__('Columns', 'consultax'),
                "param_name" => "show",
                "value" => array(
                    esc_html__('3 Columns', 'consultax')     => '3',
                    esc_html__('4 Columns', 'consultax')     => '4',
                    esc_html__('2 Columns', 'consultax')     => '2',
                    esc_html__('1 Columns', 'consultax')     => '1',
                ),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "edit_field_class" => "vc_col-sm-4",
                "class" => "",
                "heading" => esc_html__("Number Posts", 'consultax'),
                "param_name" => "num",
                "value" => "3",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "edit_field_class" => "vc_col-sm-4",
                "class" => "",
                "heading" => esc_html__("Details Button", 'consultax'),
                "param_name" => "btn",
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "edit_field_class" => "vc_col-sm-4",
                "class" => "",
                "heading" => esc_html__("Number Excerpt Length", 'consultax'),
                "param_name" => "exc",
                "value" => "",
            ),
            array(
                'type' => 'checkbox',
                'value' => '',
                "holder"    => "div",
                "edit_field_class" => "vc_col-sm-6",
                'heading' => esc_html__('Autoplay?', 'consultax'),
                'param_name' => 'auto',
            ),
            array(
                'type' => 'checkbox',
                'value' => '',
                "holder"    => "div",
                "edit_field_class" => "vc_col-sm-6",
                'heading' => esc_html__('Slide Dot?', 'consultax'),
                'param_name' => 'dot',
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Extra Class", 'consultax'),
                "param_name" => "iclass",
                "value" => "",
            ),
        )));
}

// Fun Facts
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Fun Facts", 'consultax'),
        "base" => "funfacts",
        "class" => "",
        "category" => 'Consultax Element',
        "params" => array(
            array(
                "type" => "dropdown",
                "heading" => esc_html__('Style', 'consultax'),
                "param_name" => "style",
                "value" => array(
                    esc_html__('Style 1', 'consultax')     => 's1',
                    esc_html__('Style 2', 'consultax')     => 's2',
                ),
            ),
            array(
                "type" => "iconpicker",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Awesome Icon", 'consultax'),
                "param_name" => "icon",
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Ionic Icon", 'consultax'),
                "param_name" => "ion",
                "value" => "",
                "description" => esc_html__("Find here: https://ionicons.com/", 'consultax'),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "edit_field_class" => "vc_col-sm-6",
                "class" => "",
                "heading" => esc_html__("Number", 'consultax'),
                "param_name" => "number",
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "edit_field_class" => "vc_col-sm-6",
                "class" => "",
                "heading" => esc_html__("Extra Symboy", 'consultax'),
                "param_name" => "symbol",
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Extra Text", 'consultax'),
                "param_name" => "extra",
                "value" => "",
            ),
            array(
                "type" => "checkbox",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Background Light", 'consultax'),
                "param_name" => "light",
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Extra Class", 'consultax'),
                "param_name" => "iclass",
                "value" => "",
            ),
        )));
}

// Logo Clients
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Partner Logos", 'consultax'),
        "base" => "clients",
        "class" => "",
        "category" => 'Consultax Element',
        "icon" => "icon-st",
        "params" => array(
            array(
                "type" => "attach_images",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Partner Logoes', 'consultax'),
                "param_name" => "gallery",
                "value" => "",
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => esc_html__('Column', 'consultax'),
                "param_name" => "show",
                "value" => array(
                    esc_html__('5 Columns', 'consultax')     => '5',
                    esc_html__('3 Columns', 'consultax')     => '3',
                    esc_html__('4 Columns', 'consultax')     => '4',
                    esc_html__('6 Columns', 'consultax')     => '6',
                ),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Extra Class", 'consultax'),
                "param_name" => "iclass",
                "value" => "",
            ),
        )
    ));
}


if ( ! function_exists( 'is_plugin_active' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}
if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {
    if ( function_exists( 'vc_add_shortcode_param' ) ) {
        vc_add_shortcode_param( 'select_projects', 'select_param_project', get_template_directory_uri() . '/inc/backend/js/select-field-project.js' );
        vc_add_shortcode_param( 'select_categories', 'select_param_cate', get_template_directory_uri() . '/inc/backend/js/select-field.js' );
    } elseif ( function_exists( 'add_shortcode_param' ) ) {
        add_shortcode_param( 'select_projects', 'select_param_project', get_template_directory_uri() . '/inc/backend/js/select-field-project.js' );
        add_shortcode_param( 'select_categories', 'select_param_cate', get_template_directory_uri() . '/inc/backend/js/select-field.js' );
    }
}

function select_param_project( $settings, $value ) {
    $dependency = $settings;
    $args = array(
        'numberposts' => -1,
        'post_type'   => 'ot_portfolio'
    );
    $posts = get_posts( $args );
    $cat = array();
    foreach( $posts as $post ) {
        if( $post ) {
            $cat[] = sprintf('<option value="%s">%s</option>',
                esc_attr( $post->ID ),
                $post->post_title
            );
        }

    }

    return sprintf(
        '<input type="hidden" name="%s" value="%s" class="wpb-input-projects wpb_vc_param_value wpb-textinput %s %s_field" %s>
      <select class="select-projects-post">
      %s
      </select>',
        esc_attr( $settings['param_name'] ),
        esc_attr( $value ),
        esc_attr( $settings['param_name'] ),
        esc_attr( $settings['type'] ),
        $dependency,
        implode( '', $cat )
    );

}

function select_param_cate( $settings, $value ) {
  $category_projects = get_terms( 'portfolio_cat' );
  $cat_projects = array();
  foreach( $category_projects as $category ) {
     if( $category ) {
        $cat_projects[] = sprintf('<option value="%s">%s</option>',
           esc_attr( $category->slug ),
           $category->name
        );
     }
  }

  return sprintf(
     '<input type="hidden" name="%s" value="%s" class="wpb-input-categories wpb_vc_param_value wpb-textinput %s %s_field">
     <select class="select-categories-post">
     %s
     </select>',
     esc_attr( $settings['param_name'] ),
     esc_attr( $value ),
     esc_attr( $settings['param_name'] ),
     esc_attr( $settings['type'] ),
     implode( '', $cat_projects )
  );
}