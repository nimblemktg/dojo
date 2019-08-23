<?php
vc_map(array(
    'name' => 'Red Empty Space',
    'base' => 'red_emptyspace',
    'icon' => 'icon-wpb-ui-empty_space',
    'category' => esc_html__('RedExp', 'givingwalk'),
    'description' => esc_html__('Blank space with custom height for each screen size', 'givingwalk'),
    'params' => array(
        array(
            'type' => 'param_group',
            'heading' => esc_html__( 'Add Custom Screen Size', 'givingwalk' ),
            'param_name' => 'values',
            'value'         => urlencode( json_encode( array(
                array(
                    'screen_size' => '',
                ),
            ) ) ),
            'params' => array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__( 'Add your screen size', 'givingwalk' ),
                    'param_name' => 'screen_size',
                    'description'       => esc_html__('Enter your screen size, ex: 1920px (Note: CSS measurement units allowed).','givingwalk'),
                    'admin_label' => true,
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__( 'Empty space height', 'givingwalk' ),
                    'param_name' => 'height',
                    'description'       => esc_html__('Enter empty space height (Note: CSS measurement units allowed).','givingwalk'),
                ),
            ),
        ),
    ),
));

class WPBakeryShortCode_red_emptyspace extends CmsShortCode
{
    protected function content($atts, $content = null)
    {
        
        return parent::content($atts, $content);
    }
}
