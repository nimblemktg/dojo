<?php
/**
 * Auto create .css file from Theme Options
 * @author Red Team
 * @version 1.0.0
 */
class givingwalk_StaticCss
{
    public $scss;
    function __construct()
    {
        $scss = false;
        if (class_exists('scssc')) {
            $scss = new scssc();
            $this->scss_ver = 'old';
        }
        if (class_exists('\Leafo\ScssPhp\Compiler')) {
            $scss = new \Leafo\ScssPhp\Compiler();
            $this->scss_ver = 'new';
        }
        if ($scss === false)
            return;
        /* scss */
        $this->scss = $scss;
        /* set paths scss */
        $this->scss->setImportPaths(get_template_directory() . '/assets/scss/');
        /* generate css over time */
        add_action('wp', array($this, 'generate_over_time'));
        /* save option generate css */
        add_action("redux/options/opt_theme_options/saved", array($this, 'generate_file'));
    }
    public function generate_over_time(){
        global $opt_theme_options;
        if (!empty($opt_theme_options) && $opt_theme_options['opt_dev_mode']){
            $this->generate_file();
        }
    }
    
    protected function is_file_changed()
    {
        $theme = wp_get_theme();
        $files = $theme->get_files('scss', 5, true);
        $files_hash = get_option('red_scss_files', []);
        $changed = false;
        if (!is_array($files_hash))
            $files_hash = [];
        foreach ($files as $relative => $abs_path) {
            $hash = md5_file($abs_path);
            if (!array_key_exists($relative, $files_hash) || $files_hash[$relative] != $hash)
                $changed = true;
            $files_hash[$relative] = $hash;
        }
        if ($changed)
            update_option('red_scss_files', $files_hash);
        //check css build files
        $css_hash = get_option('red_compile_css_files','');
        if(!is_array($css_hash))
            $changed = true;
        else
        {
            foreach ($css_hash as $file => $hash)
            {
                if(file_exists($file) && md5_file($file) == $hash)
                    continue;
                $changed = true;
                break;
            }
        }
        return $changed;
         
    }
    
    /**
     * generate css file.
     *
     * @since 1.0.0
     */
    public function generate_file()
    { 
        global $opt_theme_options, $wp_filesystem;
        if (empty($wp_filesystem) || !isset($opt_theme_options))
            return;
        $options_scss = get_template_directory() . '/assets/scss/options.scss';
        /* rewrite file options.scss if change theme options*/
        $current_options_content = $this->css_render();
        if (md5_file($options_scss) !== md5($current_options_content)) {
            $wp_filesystem->delete($options_scss);
            /* write options to scss file */
            $wp_filesystem->put_contents($options_scss, $this->css_render(), FS_CHMOD_FILE); // Save it
        }
        
        if (!$this->is_file_changed())
            return;
          
        /* minimize CSS styles */
         if(class_exists('scssc') && !class_exists('\Leafo\ScssPhp\Compiler')){
            if ( !$opt_theme_options['opt_dev_mode'])
                $this->scss->setFormatter('scss_formatter_compressed');
            else
                $this->scss->setFormatter('scss_formatter_nested');
        } else {
            if ( !$opt_theme_options['opt_dev_mode'])
                $this->scss->setFormatter('Leafo\ScssPhp\Formatter\Compressed');
            else
                $this->scss->setFormatter('Leafo\ScssPhp\Formatter\Nested');
        } 
        /* compile scss to css */
        $css = $this->scss_render();
        $file = "static.css";
        $file = get_template_directory() . '/assets/css/' . $file;
        //save hash of files css rendered used
        $css_hash = [$file => md5($css)];
        update_option('red_compile_css_files',$css_hash);
        /* delete files static.css */
        $wp_filesystem->delete($file);
        /* write static.css file */
        $wp_filesystem->put_contents($file, $css, FS_CHMOD_FILE); // Save it
    }
    /**
     * scss compile
     * 
     * @since 1.0.0
     * @return string
     */
    public function scss_render()
    { 
        /* compile scss to css */
        if (file_exists($file = trailingslashit(get_template_directory()) . 'assets/scss/master.php')) {
            include $file;
            $query = "";
            if (isset($import) && is_array($import)) {
                foreach ($import as $name) {
                    switch ($this->scss_ver) {
                        case 'old':
                            $query .= '@import "' . $name . '.scss";' . PHP_EOL;
                            break;
                        case 'new':
                            $query .= '@import "' . $name . '";' . PHP_EOL;
                    }
                }
            }
            if (!empty($query)) {
                return $this->scss->compile($query);
            }
        }
    }
    /**
     * main css
     *
     * @since 1.0.0
     * @return string
     */
    public function css_render()
    {
        global $opt_theme_options, $opt_meta_options;
        /* Theme Color */
        $primary_color         = '#71b61b';
        $link_color             = '#333333';
        $link_color_hover       = $primary_color;
        $heading_color          = '#333333';
        /* Body Typo */
        $body_color            = '#666666'; 
        $body_font_family      = '\'Lato\', sans-serif';
        $extra_font            = '\'Montserrat\''; 
        $body_font_size        = '15px';
        $body_font_weight      = 'inherit';
        /* Header style */
        $header_height         = '100px';
        $header_width          = '300px';
        $header_top_bg         = 'transparent';
        $logo_w                = '223px';
        $dropdown_mobile_bg    = '#121212';
        $dropdown_mobile_color = '#fff';
        $dropdown_mobile_color_hover = $primary_color;
        $dropdown_mobile_color_active = $primary_color;

        /* Button */
        $btn_bg_color                = $primary_color;
        $btn_bg_color_hover          = 'transparent';
        $btn_color             = '#FFFFFF';
        $btn_color_hover       = $primary_color;
        $btn_border_style      = 'solid';
        $btn_border_width      = '1px';
        $btn_border_color      = $primary_color;
        $btn_border_color_hover      = $primary_color;
        $btn_radius            = '55px';

        $btn_primary_bg_color        = $primary_color;
        $btn_primary_bg_color_hover  = '#ffffff';
        $btn_primary_color             = '#FFFFFF';
        $btn_primary_color_hover       = $primary_color;
        $btn_primary_border_style      = 'solid';
        $btn_primary_border_width      = '1px';
        $btn_primary_border_color      = $btn_primary_bg_color;
        $btn_primary_radius            = '55px';
        
        $form_field_color       = '#333333';
        $form_field_bg          = '#fff';
        $form_border_color      = '#d8d8d8';
        $placeholder_color      = '#979797';
  
        $options_map = [
            'boxed_width'                     => ['opt_body_width.width', '1200px'],
            'primary_color'                   => ['opt_primary_color.regular', $primary_color],
            'link_color'                      => ['opt_link_color.regular', $link_color],
            'link_color_hover'                => ['opt_link_color.hover', $link_color_hover],
            'heading_color'                   => ['opt_heading_color.color', $heading_color],  
            'body_font_family'                => ['opt_font_body.font-family', 'Montserrat'],
            'body_font_color'                 => ['opt_font_body.color', '#888'],
            'body_font_size'                  => ['opt_font_body.font-size', '14px'],
            'body_font_weight'                => ['opt_font_body.font-weight', '400'],
            'extra_font'                      => ['opt_extra_font.font-family', 'Montserrat'],
            'extra_font2'                     => ['opt_extra_font2.font-family', 'Montserrat'],
            /* Header */
            'opt_header_height'               => ['opt_header_height.height', $header_height],
            'opt_header_sticky_height'        => ['opt_header_sticky_height.height', '80px'],
            'opt_mobile_header_height'        => ['opt_mobile_header_height.height', '80px'],
            'header_logo_w'                   => ['opt_logo_size.width', '223px'],
            /* Header Default */
            'menu_default_link_color'         => ['opt_header_fl_color.regular', '#333333'],
            'menu_default_link_color_hover'   => ['opt_header_fl_color.hover', $primary_color],
            'menu_default_link_color_active'  => ['opt_header_fl_color.active', $primary_color],
            'header_bg_color'                 => ['opt_header_bg_color.rgba', '#ffffff'],
            /* Header On Top */
            'menu_ontop_link_color'           => ['opt_header_ontop_fl_color.regular', '#ffffff'],
            'menu_ontop_link_color_hover'     => ['opt_header_ontop_fl_color.hover', $primary_color],
            'menu_ontop_link_color_active'    => ['opt_header_ontop_fl_color.active', $primary_color],
            'header_ontop_bg_color'           => ['opt_header_ontop_bg_color.rgba', '#ffffff'],
            'header_4_ontop_bg_color'         => ['opt_header_ontop_bg_color.rgba', 'rgba(0,0,0,0.5)'],
            /* Header Sticky  */
            'menu_sticky_link_color'          => ['opt_header_sticky_fl_color.regular', '#333'],
            'menu_sticky_link_color_hover'    => ['opt_header_sticky_fl_color.hover', $primary_color],
            'menu_sticky_link_color_active'   => ['opt_header_sticky_fl_color.active', $primary_color],
            /* Menu Mobile */
            'dropdown_bg_color'               => ['opt_header_dropdown_mobile_bg.background-color', $dropdown_mobile_bg],
            'dropdown_link_color'             => ['opt_header_dropdown_mobile_color.regular', $dropdown_mobile_color],
            'dropdown_link_color_hover'       => ['opt_header_dropdown_mobile_color.hover', $dropdown_mobile_color_hover],
            'dropdown_link_color_active'      => ['opt_header_dropdown_mobile_color.active', $dropdown_mobile_color_active],
             
            /* Button Default */
            'btn_font_family'                 => ['opt_btn_default_typo.font-family', $extra_font],
            'btn_font_weight'                 => ['opt_btn_default_typo.font-weight', '700'],
            'btn_font_transform'              => ['opt_btn_default_typo.text-transform', 'uppercase'],
            'btn_font_size'                   => ['opt_btn_default_typo.font-size', '13px'],
            'btn_font_spacing'                => ['opt_btn_default_typo.letter-spacing', '-0.02em'],
            'btn_default_color'               => ['opt_btn_default_color.regular', $btn_color],
            'btn_default_color_hover'         => ['opt_btn_default_color.hover', $btn_color_hover],
            'btn_default_border_width'        => [
                ['opt_btn_default_border.border-top', 'opt_btn_default_border.border-right', 'opt_btn_default_border.border-bottom', 'opt_btn_default_border.border-left',]
                , $btn_border_width
                , 'join: '],
            'btn_default_border_style'        => ['opt_btn_default_border.border-style', $btn_border_style],
            'btn_default_border_color'        => ['opt_btn_default_border.border-color', $btn_border_color],
            'btn_default_border_width_hover'        => [
                ['opt_btn_default_border_hover.border-top', 'opt_btn_default_border_hover.border-right', 'opt_btn_default_border_hover.border-bottom', 'opt_btn_default_border_hover.border-left',]
                , $btn_border_width
                , 'join: '],
            'btn_default_border_style_hover'        => ['opt_btn_default_border_hover.border-style', $btn_border_style],
            'btn_default_border_color_hover'        => ['opt_btn_default_border_hover.border-color', $btn_border_color_hover],
            'btn_default_border_radius'       => ['opt_btn_default_border_radius.width', $btn_radius],
            'btn_default_bg_color'            => ['opt_btn_default_bg.background-color', $btn_bg_color],
            'btn_default_bg_image'            => ['opt_btn_default_bg.background-image', 'none', 'replace:url({1})'],
            'btn_default_bg_size'             => ['opt_btn_default_bg.background-size', 'inherit'],
            'btn_default_bg_repeat'           => ['opt_btn_default_bg.background-repeat', 'inherit'],
            'btn_default_bg_position'         => ['opt_btn_default_bg.background-position', 'inherit'],
            'btn_default_bg_attachment'       => ['opt_btn_default_bg.background-attachment', 'inherit'],
            'btn_default_bg_hover'            => ['opt_btn_default_bg_hover.background-color', $btn_bg_color_hover],
            'btn_default_bg_hover_image'      => ['opt_btn_default_bg_hover.background-image', 'inherit', 'replace:url({1})'],
            'btn_default_bg_hover_size'       => ['opt_btn_default_bg_hover.background-size', 'inherit'],
            'btn_default_bg_hover_repeat'     => ['opt_btn_default_bg_hover.background-repeat', 'inherit'],
            'btn_default_bg_hover_position'   => ['opt_btn_default_bg_hover.background-position', 'inherit'],
            'btn_default_bg_hover_attachment' => ['opt_btn_default_bg_hover.background-attachment', 'inherit'],
            /* Button Primary */
            'btn_primary_font_family'         => ['opt_btn_primary_typo.font-family', $extra_font],
            'btn_primary_font_weight'         => ['opt_btn_primary_typo.font-weight', '700'],
            'btn_primary_font_transform'      => ['opt_btn_primary_typo.text-transform', 'uppercase'],
            'btn_primary_font_size'           => ['opt_btn_primary_typo.font-size', '13px'],
            'btn_primary_font_spacing'        => ['opt_btn_primary_typo.letter-spacing', '-0.02em'],
            'btn_primary_color'               => ['opt_btn_primary_color.regular', $btn_primary_color],
            'btn_primary_color_hover'         => ['opt_btn_primary_color.hover', $btn_primary_color_hover],
            'btn_primary_border_width'        => [
                ['opt_btn_primary_border.border-top', 'opt_btn_primary_border.border-right', 'opt_btn_primary_border.border-bottom', 'opt_btn_primary_border.border-left',]
                , $btn_primary_border_width
                , 'join: '],
            'btn_primary_border_style'        => ['opt_btn_primary_border.border-style', $btn_primary_border_style],
            'btn_primary_border_color'        => ['opt_btn_primary_border.border-color', $btn_primary_border_color],
            'btn_primary_border_radius'       => ['opt_btn_primary_border_radius.width', $btn_primary_radius],
            'btn_primary_bg_color'            => ['opt_btn_primary_bg.background-color', $btn_primary_bg_color],
            'btn_primary_bg_image'            => ['opt_btn_primary_bg.background-image', 'none', 'replace:url({1})'],
            'btn_primary_bg_size'             => ['opt_btn_primary_bg.background-size', 'inherit'],
            'btn_primary_bg_repeat'           => ['opt_btn_primary_bg.background-repeat', 'inherit'],
            'btn_primary_bg_position'         => ['opt_btn_primary_bg.background-position', 'inherit'],
            'btn_primary_bg_attachment'       => ['opt_btn_primary_bg.background-attachment', 'inherit'],
            'btn_primary_bg_hover'            => ['opt_btn_primary_bg_hover.background-color', $btn_primary_bg_color_hover],
            'btn_primary_bg_hover_image'      => ['opt_btn_primary_bg_hover.background-image', 'inherit', 'replace:url({1})'],
            'btn_primary_bg_hover_size'       => ['opt_btn_primary_bg_hover.background-size', 'inherit'],
            'btn_primary_bg_hover_repeat'     => ['opt_btn_primary_bg_hover.background-repeat', 'inherit'],
            'btn_primary_bg_hover_position'   => ['opt_btn_primary_bg_hover.background-position', 'inherit'],
            'btn_primary_bg_hover_attachment' => ['opt_btn_primary_bg_hover.background-attachment', 'inherit'],

            'form_field_color'                => ['opt_form_field_color.color', $form_field_color], 
            'form_field_bg'                   => ['opt_form_field_bg.color', $form_field_bg], 
            'form_border_color'               => ['opt_form_border_color.color', $form_border_color], 
            'placeholder_color'               => ['opt_placeholder_color.color', $placeholder_color], 
            
            /* Footer logo */
            'footer_logo_max_width'       => ['opt_footer_logo_max_width.width', '100%'],
            'client_logo_bg'       => ['opt_client_logo_background_color.rgba', $primary_color],
        ];
        $css_render = '';
        foreach ($options_map as $var => $value) {
            // if special modify just give it as string.
            if (is_string($value)) {
                $css_render .= '$' . "{$var}:{$value};";
                continue;
            }
            //default modify
            if (is_array($value)) {
                // 0 => param , 1 => default , 2=> special type
                $param_temp = $value[0];
                $default = $value[1];
                $special = (isset($value[2])) ? $value[2] : '';
                //get param from options
                if (is_string($param_temp)) {
                    $param_temp = $this->get_theme_option_field($param_temp, null);
                    if (empty($param_temp)) {
                        $css_render .= '$' . "{$var}:{$default};";
                        continue;
                    } else if (!empty($special)) {
                        $value = $this->do_special_action_modify($param_temp,$special);
                        $css_render .= '$'."{$var}:{$value};";
                    }else{
                        $css_render .= '$'."{$var}:{$param_temp};";
                    }
                }elseif(is_array($param_temp))
                {
                    $params = [];
                    foreach ($param_temp as $key => $param)
                    {
                        $param = $this->get_theme_option_field($param, null);
                        if(empty($param))
                        {
                            if(is_string($default))
                                $params[] = $default;
                            elseif(isset($default[$key]))
                                $params[] = $default[$key];
                            else
                                $params[] = end($default);
                        }
                        else
                            $params[] = $param;
                    }
                    $value = $this->do_special_action_modify($params,$special);
                    $css_render .= '$'."{$var}:{$value};";
                }
            }
        }
        return $css_render;
    }
    function do_special_action_modify($param, $action)
    {
        $result = '';
        if (is_string($param))
            $params = [$param];
        else
            $params = $param;
        if (!is_array($params))
            return $result;
        $special_actions = explode(':', $action);
        switch ($special_actions[0]) {
            case 'replace':
                $index = 1;
                if (!isset($special_actions[1]))
                    break;
                $result = $special_actions[1];
                foreach ($params as $var)
                    $result = str_replace('{' . $index++ . '}', $var, $result);
                break;
            case 'join':
                $join_str = (isset($special_actions[1])) ? $special_actions[1] : ' ';
                $result = join($join_str, $params);
                break;
        }
        return $result;
    }

    function get_theme_option_field($str_map, $default = '')
    {
        global $opt_theme_options;
        $keys = explode('.', $str_map);
        $value = $default;
        foreach ($keys as $key) {
            if (!isset($wrap)) {
                if (!array_key_exists($key, $opt_theme_options)) {
                    $wrap = $value;
                    break;
                }
                $wrap = $opt_theme_options[$key];
                continue;
            }
            if (!is_array($wrap))
                break;
            $wrap = (array_key_exists($key, $wrap)) ? $wrap[$key] : $value;
        }
        $value = $wrap;
        $except = ['px',''];
        if(in_array($value,$except))
            return $default;
        return $value;
    }
}
new givingwalk_StaticCss();