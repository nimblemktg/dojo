<?php
vc_map(array(
    "name" => 'Red Google Map',
    "base" => "red_googlemap",
    "icon" => "cs_icon_for_vc",
    "category" => esc_html__('RedExp', 'givingwalk'),
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => esc_html__('API Key', 'givingwalk'),
            "param_name" => "api",
            "value" => '',
            "description" => esc_html__('Enter you api key of map, get key from (https://console.developers.google.com)', 'givingwalk')
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__('Address', 'givingwalk'),
            "param_name" => "address",
            "value" => '',
            "description" => esc_html__('Enter address of Map', 'givingwalk')
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__('Coordinate', 'givingwalk'),
            "param_name" => "coordinate",
            "value" => '-33.893836, 151.153470',
            "description" => esc_html__('Enter coordinate of Map, format input (latitude, longitude)', 'givingwalk')
        ),
        array(
            "type" => "checkbox",
            "heading" => esc_html__('Click Show Info window', 'givingwalk'),
            "param_name" => "infoclick",
            "value" => array(
                esc_html__("Yes, please", 'givingwalk') => true
            ),
            "description" => esc_html__('Click a marker and show info window (Default Show).', 'givingwalk')
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__('Marker Coordinate', 'givingwalk'),
            "param_name" => "markercoordinate",
            "value" => '',
            "description" => esc_html__('Enter marker coordinate of Map, format input (latitude, longitude)', 'givingwalk')
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__('Marker Title', 'givingwalk'),
            "param_name" => "markertitle",
            "value" => '',
            "description" => esc_html__('Enter Title Info windows for marker', 'givingwalk')
        ),
        array(
            "type" => "textarea",
            "heading" => esc_html__('Marker Description', 'givingwalk'),
            "param_name" => "markerdesc",
            "value" => '',
            "description" => esc_html__('Enter Description Info windows for marker', 'givingwalk')
        ),
        array(
            "type" => "attach_image",
            "heading" => esc_html__('Marker Icon', 'givingwalk'),
            "param_name" => "markericon",
            "value" => '',
            "description" => esc_html__('Select image icon for marker', 'givingwalk')
        ),
        array(
            "type" => "textarea_raw_html",
            "heading" => esc_html__('Marker List', 'givingwalk'),
            "param_name" => "markerlist",
            "value" => '',
            "description" => esc_html__('[{"coordinate":"41.058846,-73.539423","icon":"","title":"title demo 1","desc":"desc demo 1"},{"coordinate":"40.975699,-73.717636","icon":"","title":"title demo 2","desc":"desc demo 2"},{"coordinate":"41.082606,-73.469718","icon":"","title":"title demo 3","desc":"desc demo 3"}]', 'givingwalk')
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__('Info Window Max Width', 'givingwalk'),
            "param_name" => "infowidth",
            "value" => '200',
            "description" => esc_html__('Set max width for info window', 'givingwalk')
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Map Type", 'givingwalk'),
            "param_name" => "type",
            "value" => array(
                "ROADMAP" => "ROADMAP",
                "HYBRID" => "HYBRID",
                "SATELLITE" => "SATELLITE",
                "TERRAIN" => "TERRAIN"
            ),
            "description" => esc_html__('Select the map type.', 'givingwalk')
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Style Template", 'givingwalk'),
            "param_name" => "style",
            "value" => array(
                "Default" => "",
                "Custom" => "custom",
                "Light Monochrome" => "light-monochrome",
                "Blue water" => "blue-water",
                "Midnight Commander" => "midnight-commander",
                "Paper" => "paper",
                "Red Hues" => "red-hues",
                "Hot Pink" => "hot-pink"
            ),
            "description" => 'Select your heading size for title.'
        ),
        array(
            "type" => "textarea_raw_html",
            "heading" => esc_html__('Custom Template', 'givingwalk'),
            "param_name" => "content",
            "value" => '',
            "description" => esc_html__('Get template from http://snazzymaps.com', 'givingwalk')
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__('Zoom', 'givingwalk'),
            "param_name" => "zoom",
            "value" => '13',
            "description" => esc_html__('zoom level of map, default is 13', 'givingwalk')
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__('Width', 'givingwalk'),
            "param_name" => "width",
            "value" => 'auto',
            "description" => esc_html__('Width of map without pixel, default is auto', 'givingwalk')
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__('Height', 'givingwalk'),
            "param_name" => "height",
            "value" => '350px',
            "description" => esc_html__('Height of map without pixel, default is 350px', 'givingwalk')
        ),
        array(
            "type" => "checkbox",
            "heading" => esc_html__('Scroll Wheel', 'givingwalk'),
            "param_name" => "scrollwheel",
            "value" => array(
                esc_html__("Yes, please", 'givingwalk') => true
            ),
            "description" => esc_html__('If false, disables scrollwheel zooming on the map. The scrollwheel is disable by default.', 'givingwalk')
        ),
        array(
            "type" => "checkbox",
            "heading" => esc_html__('Pan Control', 'givingwalk'),
            "param_name" => "pancontrol",
            "value" => array(
                esc_html__("Yes, please", 'givingwalk') => true
            ),
            "description" => esc_html__('Show or hide Pan control.', 'givingwalk')
        ),
        array(
            "type" => "checkbox",
            "heading" => esc_html__('Zoom Control', 'givingwalk'),
            "param_name" => "zoomcontrol",
            "value" => array(
                esc_html__("Yes, please", 'givingwalk') => true
            ),
            "description" => esc_html__('Show or hide Zoom Control.', 'givingwalk')
        ),
        array(
            "type" => "checkbox",
            "heading" => esc_html__('Scale Control', 'givingwalk'),
            "param_name" => "scalecontrol",
            "value" => array(
                esc_html__("Yes, please", 'givingwalk') => true
            ),
            "description" => esc_html__('Show or hide Scale Control.', 'givingwalk')
        ),
        array(
            "type" => "checkbox",
            "heading" => esc_html__('Map Type Control', 'givingwalk'),
            "param_name" => "maptypecontrol",
            "value" => array(
                esc_html__("Yes, please", 'givingwalk') => true
            ),
            "description" => esc_html__('Show or hide Map Type Control.', 'givingwalk')
        ),
        array(
            "type" => "checkbox",
            "heading" => esc_html__('Street View Control', 'givingwalk'),
            "param_name" => "streetviewcontrol",
            "value" => array(
                esc_html__("Yes, please", 'givingwalk') => true
            ),
            "description" => esc_html__('Show or hide Street View Control.', 'givingwalk')
        ),
        array(
            "type" => "checkbox",
            "heading" => esc_html__('Over View Map Control', 'givingwalk'),
            "param_name" => "overviewmapcontrol",
            "value" => array(
                esc_html__("Yes, please", 'givingwalk') => true
            ),
            "description" => esc_html__('Show or hide Over View Map Control.', 'givingwalk')
        )
    )
));

class WPBakeryShortCode_red_googlemap extends CmsShortCode
{

    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}
