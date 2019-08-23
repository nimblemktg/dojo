<?php
vc_map(array(
    'name' => 'Red Single Video',
    'base' => 'red_single_video',
    'icon' => 'cs_icon_for_vc',
    'category'    => esc_html__('RedExp', 'givingwalk'),
    'description' => esc_html__('Show video as single', 'givingwalk'),
    'params' => array(
        array(
            'type' => 'attach_images',
            'heading' => esc_html__( 'Background Image', 'givingwalk' ),
            'param_name' => 'image',
            'value' => '',
            'description' => esc_html__( 'Select images from media library.', 'givingwalk' ),
        ), 
        array(
            "type"          => "textfield",
            "heading"       => esc_html__("Video Url",'givingwalk'),
            'description'   => esc_html__('Enter the video url as (https://vimeo.com/51589652)','givingwalk'),
            "param_name"    => "video_url",
            "value"         => '',
        ),
         
        array(
            'type' => 'css_editor',
            'heading' => esc_html__( 'CSS box', 'givingwalk' ),
            'param_name' => 'css',
            'group' => esc_html__( 'Design Options', 'givingwalk' ),
        ),
    )
));

class WPBakeryShortCode_red_single_video extends CmsShortCode
{
    protected function content($atts, $content = null){
        $atts_extra = shortcode_atts(array(
            'image'            => '',
            'video_url'      => '',
        ), $atts);
        $atts = array_merge($atts_extra,$atts);
        return parent::content($atts, $content);
    }
}
?>