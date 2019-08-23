<?php
/**
 * Auto create css from Meta Options.
 * 
 * @author Red Team
 * @version 1.0.0
 */
class givingwalk_DynamicCss
{

    function __construct()
    {
        add_action('wp_enqueue_scripts', array($this, 'generate_css'));
    }

    /**
     * generate css inline.
     *
     * @since 1.0.0
     */
    public function generate_css()
    {
        $_dynamic_css = $this->css_render();

        wp_add_inline_style('givingwalk-static', $_dynamic_css);
    }

    /**
     * header css
     *
     * @since 1.0.0
     * @return string
     */
    public function css_render()
    {
        global $opt_theme_options, $opt_meta_options;

        ob_start();

        /* custom Page css. */
            /* Page Title */
            if(isset($opt_meta_options['opt_page_title_layout']) && ($opt_meta_options['opt_page_title_layout'] != '' || $opt_meta_options['opt_page_title_layout'] != 'none')){
                /* Overlay color */
                if(!empty($opt_meta_options['opt_page_title_bg_overlay']['rgba'])){ 
                    $page_title_style_overlay = '#red-page #red-page-title-wrapper:before{';
                    $page_title_style_overlay .= 'background-color:'.$opt_meta_options['opt_page_title_bg_overlay']['rgba'].';';
                    $page_title_style_overlay .= '}';
                    echo esc_html($page_title_style_overlay);
                }
                /* background */
                if(!empty($opt_meta_options['opt_page_title_bg'])){
                    $page_title_style = '#red-page #red-page-title-wrapper{';
                    $page_title_style .= !empty($opt_meta_options['opt_page_title_bg']['background-color']) ? 'background-color:'.$opt_meta_options['opt_page_title_bg']['background-color']. ';' : '' ;
                    $page_title_style .= !empty($opt_meta_options['opt_page_title_bg']['background-image']) ? 'background-image:url('.$opt_meta_options['opt_page_title_bg']['background-image'].');' : '';
                    $page_title_style .= !empty($opt_meta_options['opt_page_title_bg']['background-position']) ? 'background-position:'.$opt_meta_options['opt_page_title_bg']['background-position'].';' : '';
                    $page_title_style .= !empty($opt_meta_options['opt_page_title_bg']['background-size']) ? 'background-size:'.$opt_meta_options['opt_page_title_bg']['background-size'].';' : '';
                    $page_title_style .= !empty($opt_meta_options['opt_page_title_bg']['background-repeat']) ? 'background-repeat:'.$opt_meta_options['opt_page_title_bg']['background-repeat'].';' : '';
                    $page_title_style .= !empty($opt_meta_options['opt_page_title_bg']['background-attachment']) ? 'background-attachment:'.$opt_meta_options['opt_page_title_bg']['background-attachment'].';' : '';
                    $page_title_style .= '}';

                    echo esc_html($page_title_style);
                }
                /* Padding */
                if(!empty($opt_meta_options['opt_page_title_padding'])){
                    $page_title_style_padding = '#red-page #red-page-title-wrapper{';
                    if(!empty($opt_meta_options['opt_page_title_padding']['padding-top'])) $page_title_style_padding .= 'padding-top:'.$opt_meta_options['opt_page_title_padding']['padding-top'].';';
                    if(!empty($opt_meta_options['opt_page_title_padding']['padding-right'])) $page_title_style_padding .= 'padding-right:'.$opt_meta_options['opt_page_title_padding']['padding-right'].';';
                    if(!empty($opt_meta_options['opt_page_title_padding']['padding-bottom'])) $page_title_style_padding .= 'padding-bottom:'.$opt_meta_options['opt_page_title_padding']['padding-bottom'].';';
                    if(!empty($opt_meta_options['opt_page_title_padding']['padding-left'])) $page_title_style_padding .= 'padding-left:'.$opt_meta_options['opt_page_title_padding']['padding-left'].';';
                    $page_title_style_padding .= '}';
                    echo esc_html($page_title_style_padding);
                }
                /* Margin */
                if(!empty($opt_meta_options['opt_page_title_margin'])){
                    $page_title_style_margin = '#red-page #red-page-title-wrapper{';
                    if($opt_meta_options['opt_page_title_margin']['margin-top']!='') $page_title_style_margin .= 'margin-top:'.$opt_meta_options['opt_page_title_margin']['margin-top'].';';
                    if($opt_meta_options['opt_page_title_margin']['margin-right']!='') $page_title_style_margin .= 'margin-right:'.$opt_meta_options['opt_page_title_margin']['margin-right'].';';
                    if($opt_meta_options['opt_page_title_margin']['margin-bottom']!='') $page_title_style_margin .= 'margin-bottom:'.$opt_meta_options['opt_page_title_margin']['margin-bottom'].';';
                    if($opt_meta_options['opt_page_title_margin']['margin-left']!='') $page_title_style_margin .= 'margin-left:'.$opt_meta_options['opt_page_title_margin']['margin-left'].';';
                    $page_title_style_margin .= '}';
                    echo esc_html($page_title_style_margin);
                }
            }
            /* Client logo */
            if(!empty($opt_meta_options['opt_client_logo_margin'])){
                $page_client_logo_margin = '.red-client-logo{';
                if($opt_meta_options['opt_client_logo_margin']['margin-top']!='') $page_client_logo_margin .= 'margin-top:'.$opt_meta_options['opt_client_logo_margin']['margin-top'].';';
                if($opt_meta_options['opt_client_logo_margin']['margin-bottom']!='') $page_client_logo_margin .= 'margin-bottom:'.$opt_meta_options['opt_client_logo_margin']['margin-bottom'].';';
                $page_client_logo_margin .= '}';
                echo esc_html($page_client_logo_margin);
            }
            /* Footer */
            /* Margin */
            if(!empty($opt_meta_options['opt_page_footer_margin'])){
                $page_footer_margin = '#red-page #red-footer{';
                if($opt_meta_options['opt_page_footer_margin']['margin-top']!='') $page_footer_margin .= 'margin-top:'.$opt_meta_options['opt_page_footer_margin']['margin-top'].';';
                if($opt_meta_options['opt_page_footer_margin']['margin-right']!='') $page_footer_margin .= 'margin-right:'.$opt_meta_options['opt_page_footer_margin']['margin-right'].';';
                if($opt_meta_options['opt_page_footer_margin']['margin-bottom']!='') $page_footer_margin .= 'margin-bottom:'.$opt_meta_options['opt_page_footer_margin']['margin-bottom'].';';
                if($opt_meta_options['opt_page_footer_margin']['margin-left']!='') $page_footer_margin .= 'margin-left:'.$opt_meta_options['opt_page_footer_margin']['margin-left'].';';
                $page_footer_margin .= '}';
                echo esc_html($page_footer_margin);
            }
        ?>

        <?php
        
        return ob_get_clean();
    }
}

new givingwalk_DynamicCss();