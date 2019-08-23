<?php
/*
Plugin Name: Tactile, by Bonfire 
Plugin URI: http://bonfirethemes.com/
Description: Mobile menu & header for WordPress. Customize under Appearance > Customize > Tactile Plugin.
Version: 2.1
Author: Bonfire Themes
Author URI: http://bonfirethemes.com/
License: GPL2
*/


	//
	// WORDPRESS LIVE CUSTOMIZER
	//
	function tactile_theme_customizer( $wp_customize ) {
	
        //
        // ADD "TACTILE" PANEL TO LIVE CUSTOMIZER 
        //
        $wp_customize->add_panel('tactile_panel', array('title' => __('Tactile Plugin', 'tactile-menu'),'priority' => 10,));

		//
        // ADD "Header" SECTION TO "TACTILE" PANEL 
        //
		$wp_customize->add_section('tactile_header_section',array('title' => __('Header','tactile-menu'),'panel' => 'tactile_panel'));
		
		/* absolute positioning */
        $wp_customize->add_setting('tactile_absolute',array('sanitize_callback' => 'sanitize_tactile_absolute',));
        function sanitize_tactile_absolute( $input ) { if ( $input == 1 ) { return 1; } else { return ''; } }
		$wp_customize->add_control('tactile_absolute',array('type' => 'checkbox','label' => __('Absolute position','tactile-menu'),'description' => 'When checked, the header will scroll with the page. If left unchecked, the header will remain visible when scrolled.','section' => 'tactile_header_section',));

		/* background color */
        $wp_customize->add_setting('tactile_header_color',array('sanitize_callback' => 'sanitize_hex_color'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'tactile_header_color',array(
            'label' => 'Header background','settings' => 'tactile_header_color','section' => 'tactile_header_section')
		));
		
		/* background color opacity */
        $wp_customize->add_setting('tactile_header_color_opacity',array('sanitize_callback' => 'sanitize_tactile_header_color_opacity',));
        function sanitize_tactile_header_color_opacity($input) {return wp_kses_post(force_balance_tags($input));}
        $wp_customize->add_control('tactile_header_color_opacity',array(
            'type' => 'text',
            'label' => __('Background color opacity','tactile-menu'),
            'description' => __('Example: 0.5. If left empty, defaults to 1.','tactile-menu'),
            'section' => 'tactile_header_section',
		));

		/* background image */
        $wp_customize->add_setting('tactile_header_image');
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'tactile_header_image',
            array(
				'label' => __('Header background image','tactile-menu'),
				'description' => __('Background image appears below the background color; please change background color opacity above to make image visible.','tactile-menu'),
                'settings' => 'tactile_header_image',
                'section' => 'tactile_header_section',
        )
		));

		/* background image as pattern */
        $wp_customize->add_setting('tactile_header_pattern',array('sanitize_callback' => 'sanitize_tactile_header_pattern',));
        function sanitize_tactile_header_pattern( $input ) { if ( $input == 1 ) { return 1; } else { return ''; } }
		$wp_customize->add_control('tactile_header_pattern',array('type' => 'checkbox','label' => __('Background as pattern','tactile-menu'),'section' => 'tactile_header_section',));

		/* background image opacity */
        $wp_customize->add_setting('tactile_header_image_opacity',array('sanitize_callback' => 'sanitize_tactile_header_image_opacity',));
        function sanitize_tactile_header_image_opacity($input) {return wp_kses_post(force_balance_tags($input));}
        $wp_customize->add_control('tactile_header_image_opacity',array(
            'type' => 'text',
            'label' => __('Background image opacity','tactile-menu'),
            'description' => __('Example: 0.5. If left empty, defaults to 1.','tactile-menu'),
            'section' => 'tactile_header_section',
		));

		//
        // ADD "Logo" SECTION TO "TACTILE" PANEL 
        //
		$wp_customize->add_section('tactile_logo_section',array('title' => __('Logo','tactile-menu'),'panel' => 'tactile_panel'));
		
		/* logo image */
        $wp_customize->add_setting('tactile_logo_image');
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'tactile_logo_image',
            array(
                'label' => __('Logo image','tactile-menu'),
                'settings' => 'tactile_logo_image',
                'section' => 'tactile_logo_section',
        )
		));

		/* logo text size */
        $wp_customize->add_setting('tactile_logo_text_size',array('sanitize_callback' => 'sanitize_tactile_logo_text_size',));
        function sanitize_tactile_logo_text_size($input) {return wp_kses_post(force_balance_tags($input));}
        $wp_customize->add_control('tactile_logo_text_size',array(
            'type' => 'text',
            'label' => __('Logo text size (in pixels)','tactile-menu'),
            'description' => __('Example: 20. If left empty, defaults to 16.','tactile-menu'),
            'section' => 'tactile_logo_section',
		));

		/* logo text color */
        $wp_customize->add_setting('tactile_logo_color',array('sanitize_callback' => 'sanitize_hex_color'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'tactile_logo_color',array(
            'label' => 'Logo text','settings' => 'tactile_logo_color','section' => 'tactile_logo_section')
		));

		/* logo text hover color */
        $wp_customize->add_setting('tactile_logo_hover_color',array('sanitize_callback' => 'sanitize_hex_color'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'tactile_logo_hover_color',array(
            'label' => 'Logo text (hover)','settings' => 'tactile_logo_hover_color','section' => 'tactile_logo_section')
		));

		//
        // ADD "Menu Button" SECTION TO "TACTILE" PANEL 
        //
        $wp_customize->add_section('tactile_menu_button_section',array('title' => __('Menu Button','tactile-menu'),'panel' => 'tactile_panel'));
        
        /* hide main menu button */
        $wp_customize->add_setting('tactile_hide_menu_button',array('sanitize_callback' => 'sanitize_tactile_hide_menu_button',));
        function sanitize_tactile_hide_menu_button( $input ) { if ( $input == 1 ) { return 1; } else { return ''; } }
		$wp_customize->add_control('tactile_hide_menu_button',array('type' => 'checkbox','label' => __('Hide menu button','tactile-menu'),'description' => 'When selected, the main menu button (and the drop-down menu) will be hidden.','section' => 'tactile_menu_button_section',));

		/* menu button animation */
        $wp_customize->add_setting('tactile_menu_button_animation',array(
            'default' => 'down',
        ));
        $wp_customize->add_control('tactile_menu_button_animation',array(
            'type' => 'select',
            'label' => __('Menu button animation','tactile-menu'),
            'section' => 'tactile_menu_button_section',
            'choices' => array(
				'none' => __('No animation','tactile-menu'),
                'minus' => __('Minus sign','tactile-menu'),
                'x' => __('X sign','tactile-menu'),
        ),
		));
		
		/* menu button color */
        $wp_customize->add_setting('tactile_menu_button_color',array('sanitize_callback' => 'sanitize_hex_color'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'tactile_menu_button_color',array(
            'label' => 'Menu button','settings' => 'tactile_menu_button_color','section' => 'tactile_menu_button_section')
		));

		/* menu button hover color */
        $wp_customize->add_setting('tactile_menu_button_hover_color',array('sanitize_callback' => 'sanitize_hex_color'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'tactile_menu_button_hover_color',array(
            'label' => 'Menu button (hover)','settings' => 'tactile_menu_button_hover_color','section' => 'tactile_menu_button_section')
		));
		
		//
        // ADD "Drop-Down Menu" SECTION TO "TACTILE" PANEL 
        //
        $wp_customize->add_section('tactile_dropdown_menu_section',array('title' => __('Drop-Down Menu','tactile-menu'),'panel' => 'tactile_panel'));
    
		/* dropdown menu width */
        $wp_customize->add_setting('tactile_dropdown_width',array('sanitize_callback' => 'sanitize_tactile_dropdown_width',));
        function sanitize_tactile_dropdown_width($input) {return wp_kses_post(force_balance_tags($input));}
        $wp_customize->add_control('tactile_dropdown_width',array(
            'type' => 'text',
            'label' => __('Dropdown menu width (in pixels)','tactile-menu'),
            'description' => __('Example: 500. If left empty, defaults to 300.','tactile-menu'),
            'section' => 'tactile_dropdown_menu_section',
		));

		/* dropdown menu item font size */
        $wp_customize->add_setting('tactile_dropdown_menu_item_size',array('sanitize_callback' => 'sanitize_tactile_dropdown_menu_item_size',));
        function sanitize_tactile_dropdown_menu_item_size($input) {return wp_kses_post(force_balance_tags($input));}
        $wp_customize->add_control('tactile_dropdown_menu_item_size',array(
            'type' => 'text',
            'label' => __('Dropdown menu item size (in pixels)','tactile-menu'),
            'description' => __('Example: 12. If left empty, defaults to 16.','tactile-menu'),
            'section' => 'tactile_dropdown_menu_section',
		));

		/* dropdown submenu item font size */
        $wp_customize->add_setting('tactile_dropdown_submenu_item_size',array('sanitize_callback' => 'sanitize_tactile_dropdown_submenu_item_size',));
        function sanitize_tactile_dropdown_submenu_item_size($input) {return wp_kses_post(force_balance_tags($input));}
        $wp_customize->add_control('tactile_dropdown_submenu_item_size',array(
            'type' => 'text',
            'label' => __('Dropdown submenu item size (in pixels)','tactile-menu'),
            'description' => __('Example: 12. If left empty, defaults to 16.','tactile-menu'),
            'section' => 'tactile_dropdown_menu_section',
		));

		/* menu background color */
        $wp_customize->add_setting('tactile_dropdown_background_color',array('sanitize_callback' => 'sanitize_hex_color'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'tactile_dropdown_background_color',array(
            'label' => 'Menu background','settings' => 'tactile_dropdown_background_color','section' => 'tactile_dropdown_menu_section')
		));

		/* menu item divider color */
        $wp_customize->add_setting('tactile_dropdown_menu_divider_color',array('sanitize_callback' => 'sanitize_hex_color'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'tactile_dropdown_menu_divider_color',array(
            'label' => 'Horizontal menu item divider','settings' => 'tactile_dropdown_menu_divider_color','section' => 'tactile_dropdown_menu_section')
		));

		/* menu item color */
        $wp_customize->add_setting('tactile_dropdown_menu_item_color',array('sanitize_callback' => 'sanitize_hex_color'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'tactile_dropdown_menu_item_color',array(
            'label' => 'Menu item','settings' => 'tactile_dropdown_menu_item_color','section' => 'tactile_dropdown_menu_section')
		));

		/* menu item hover color */
        $wp_customize->add_setting('tactile_dropdown_menu_item_hover_color',array('sanitize_callback' => 'sanitize_hex_color'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'tactile_dropdown_menu_item_hover_color',array(
            'label' => 'Menu item (hover)','settings' => 'tactile_dropdown_menu_item_hover_color','section' => 'tactile_dropdown_menu_section')
		));

		/* expand icon separator color */
        $wp_customize->add_setting('tactile_expand_icon_separator_color',array('sanitize_callback' => 'sanitize_hex_color'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'tactile_expand_icon_separator_color',array(
            'label' => 'Expand icon separator','settings' => 'tactile_expand_icon_separator_color','section' => 'tactile_dropdown_menu_section')
		));

		/* expand icon color */
        $wp_customize->add_setting('tactile_expand_icon_color',array('sanitize_callback' => 'sanitize_hex_color'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'tactile_expand_icon_color',array(
            'label' => 'Expand icon','settings' => 'tactile_expand_icon_color','section' => 'tactile_dropdown_menu_section')
		));

		/* expand icon hover color */
        $wp_customize->add_setting('tactile_expand_icon_hover_color',array('sanitize_callback' => 'sanitize_hex_color'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'tactile_expand_icon_hover_color',array(
            'label' => 'Expand icon (hover)','settings' => 'tactile_expand_icon_hover_color','section' => 'tactile_dropdown_menu_section')
		));

		/* sub-menu background color */
        $wp_customize->add_setting('tactile_dropdown_sub_background_color',array('sanitize_callback' => 'sanitize_hex_color'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'tactile_dropdown_sub_background_color',array(
            'label' => 'Background (sub-menu)','settings' => 'tactile_dropdown_sub_background_color','section' => 'tactile_dropdown_menu_section')
		));

		/* sub-menu item color */
        $wp_customize->add_setting('tactile_dropdown_submenu_item_color',array('sanitize_callback' => 'sanitize_hex_color'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'tactile_dropdown_submenu_item_color',array(
            'label' => 'Menu item (sub-menu)','settings' => 'tactile_dropdown_submenu_item_color','section' => 'tactile_dropdown_menu_section')
		));

		/* sub-menu item hover color */
        $wp_customize->add_setting('tactile_dropdown_submenu_item_hover_color',array('sanitize_callback' => 'sanitize_hex_color'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'tactile_dropdown_submenu_item_hover_color',array(
            'label' => 'Menu item (hover, sub-menu)','settings' => 'tactile_dropdown_submenu_item_hover_color','section' => 'tactile_dropdown_menu_section')
		));

		/* sub-menu item divider color */
        $wp_customize->add_setting('tactile_dropdown_submenu_divider_color',array('sanitize_callback' => 'sanitize_hex_color'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'tactile_dropdown_submenu_divider_color',array(
            'label' => 'Horizontal menu item divider (sub-menu)','settings' => 'tactile_dropdown_submenu_divider_color','section' => 'tactile_dropdown_menu_section')
		));

		/* expand icon separator color (sub-menu) */
        $wp_customize->add_setting('tactile_submenu_expand_icon_separator_color',array('sanitize_callback' => 'sanitize_hex_color'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'tactile_submenu_expand_icon_separator_color',array(
            'label' => 'Expand icon separator (sub-menu)','settings' => 'tactile_submenu_expand_icon_separator_color','section' => 'tactile_dropdown_menu_section')
		));

		/* expand icon color (sub-menu) */
        $wp_customize->add_setting('tactile_submenu_expand_icon_color',array('sanitize_callback' => 'sanitize_hex_color'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'tactile_submenu_expand_icon_color',array(
            'label' => 'Expand icon (sub-menu)','settings' => 'tactile_submenu_expand_icon_color','section' => 'tactile_dropdown_menu_section')
		));

		/* expand icon hover color (sub-menu) */
        $wp_customize->add_setting('tactile_submenu_expand_icon_hover_color',array('sanitize_callback' => 'sanitize_hex_color'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'tactile_submenu_expand_icon_hover_color',array(
            'label' => 'Expand icon (hover, sub-menu)','settings' => 'tactile_submenu_expand_icon_hover_color','section' => 'tactile_dropdown_menu_section')
		));

		//
        // ADD "Search" SECTION TO "TACTILE" PANEL 
        //
        $wp_customize->add_section('tactile_search_section',array('title' => __('Search','tactile-menu'),'panel' => 'tactile_panel'));
        
        /* hide search */
        $wp_customize->add_setting('tactile_hide_search',array('sanitize_callback' => 'sanitize_tactile_hide_search',));
        function sanitize_tactile_hide_search( $input ) { if ( $input == 1 ) { return 1; } else { return ''; } }
		$wp_customize->add_control('tactile_hide_search',array('type' => 'checkbox','label' => __('Hide search','tactile-menu'),'description' => 'When selected, the search function in its entirety will be hidden.','section' => 'tactile_search_section',));

		/* search placeholder text */
        $wp_customize->add_setting('tactile_search_placeholder',array('sanitize_callback' => 'sanitize_tactile_search_placeholder',));
        function sanitize_tactile_search_placeholder($input) {return wp_kses_post(force_balance_tags($input));}
        $wp_customize->add_control('tactile_search_placeholder',array(
            'type' => 'text',
            'label' => __('Search field placeholder text','tactile-menu'),
            'description' => __('If left empty, defaults to "Find something...".','tactile-menu'),
            'section' => 'tactile_search_section',
		));

		/* search button color */
        $wp_customize->add_setting('tactile_search_button_color',array('sanitize_callback' => 'sanitize_hex_color'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'tactile_search_button_color',array(
            'label' => 'Search button','settings' => 'tactile_search_button_color','section' => 'tactile_search_section')
		));

		/* search button hover color */
        $wp_customize->add_setting('tactile_search_button_hover_color',array('sanitize_callback' => 'sanitize_hex_color'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'tactile_search_button_hover_color',array(
            'label' => 'Search button (hover)','settings' => 'tactile_search_button_hover_color','section' => 'tactile_search_section')
		));

		/* search close button color */
        $wp_customize->add_setting('tactile_search_close_button_color',array('sanitize_callback' => 'sanitize_hex_color'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'tactile_search_close_button_color',array(
            'label' => 'Search close button','settings' => 'tactile_search_close_button_color','section' => 'tactile_search_section')
		));

		/* search close button hover color */
        $wp_customize->add_setting('tactile_search_close_button_hover_color',array('sanitize_callback' => 'sanitize_hex_color'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'tactile_search_close_button_hover_color',array(
            'label' => 'Search close button (hover)','settings' => 'tactile_search_close_button_hover_color','section' => 'tactile_search_section')
		));

		/* search placholder text color */
        $wp_customize->add_setting('tactile_search_placeholder_color',array('sanitize_callback' => 'sanitize_hex_color'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'tactile_search_placeholder_color',array(
            'label' => 'Search placeholder text','settings' => 'tactile_search_placeholder_color','section' => 'tactile_search_section')
		));

		/* search field text color */
        $wp_customize->add_setting('tactile_search_field_color',array('sanitize_callback' => 'sanitize_hex_color'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'tactile_search_field_color',array(
            'label' => 'Search field text','settings' => 'tactile_search_field_color','section' => 'tactile_search_section')
		));

		/* search bottom border color */
        $wp_customize->add_setting('tactile_search_bottom_border_color',array('sanitize_callback' => 'sanitize_hex_color'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'tactile_search_bottom_border_color',array(
            'label' => 'Search bottom border','settings' => 'tactile_search_bottom_border_color','section' => 'tactile_search_section')
		));

		/* active search background color */
        $wp_customize->add_setting('tactile_search_active_background_color',array('sanitize_callback' => 'sanitize_hex_color'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'tactile_search_active_background_color',array(
            'label' => 'Background color when search active','settings' => 'tactile_search_active_background_color','description' => 'Changes header background color when search activated','section' => 'tactile_search_section')
		));

		/* background color opacity when search active */
        $wp_customize->add_setting('tactile_search_header_color_opacity',array('sanitize_callback' => 'sanitize_tactile_search_header_color_opacity',));
        function sanitize_tactile_search_header_color_opacity($input) {return wp_kses_post(force_balance_tags($input));}
        $wp_customize->add_control('tactile_search_header_color_opacity',array(
            'type' => 'text',
            'label' => __('Background color opacity when search active','tactile-menu'),
            'description' => __('Example: 0.5. If left empty, defaults to opacity setting in "Header" section.','tactile-menu'),
            'section' => 'tactile_search_section',
		));

		//
        // ADD "Swipe Menu" SECTION TO "TACTILE" PANEL 
        //
        $wp_customize->add_section('tactile_swipe_menu_section',array('title' => __('Swipe Menu','tactile-menu'),'panel' => 'tactile_panel'));
        
        /* hide swipe menu */
        $wp_customize->add_setting('tactile_hide_swipe_menu',array('sanitize_callback' => 'sanitize_tactile_hide_swipe_menu',));
        function sanitize_tactile_hide_swipe_menu( $input ) { if ( $input == 1 ) { return 1; } else { return ''; } }
		$wp_customize->add_control('tactile_hide_swipe_menu',array('type' => 'checkbox','label' => __('Hide swipe menu','tactile-menu'),'description' => 'When selected, the horizontal swipe menu will be hidden.','section' => 'tactile_swipe_menu_section',));

		/* swipe menu item font size */
        $wp_customize->add_setting('tactile_swipe_menu_item_size',array('sanitize_callback' => 'sanitize_tactile_swipe_menu_item_size',));
        function sanitize_tactile_swipe_menu_item_size($input) {return wp_kses_post(force_balance_tags($input));}
        $wp_customize->add_control('tactile_swipe_menu_item_size',array(
            'type' => 'text',
            'label' => __('Swipe menu item size (in pixels)','tactile-menu'),
            'description' => __('Example: 15. If left empty, defaults to 13.','tactile-menu'),
            'section' => 'tactile_swipe_menu_section',
		));

		/* menu item color */
        $wp_customize->add_setting('tactile_swipe_menu_item_color',array('sanitize_callback' => 'sanitize_hex_color'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'tactile_swipe_menu_item_color',array(
            'label' => 'Menu item','settings' => 'tactile_swipe_menu_item_color','section' => 'tactile_swipe_menu_section')
		));

		/* menu item hover color */
        $wp_customize->add_setting('tactile_swipe_menu_item_hover_color',array('sanitize_callback' => 'sanitize_hex_color'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'tactile_swipe_menu_item_hover_color',array(
            'label' => 'Menu item (hover, current)','settings' => 'tactile_swipe_menu_item_hover_color','section' => 'tactile_swipe_menu_section')
		));

		/* current menu item marker color */
        $wp_customize->add_setting('tactile_swipe_current_menu_item_marker_color',array('sanitize_callback' => 'sanitize_hex_color'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'tactile_swipe_current_menu_item_marker_color',array(
            'label' => 'Current menu item indicator','settings' => 'tactile_swipe_current_menu_item_marker_color','section' => 'tactile_swipe_menu_section')
		));

		/* menu background color */
        $wp_customize->add_setting('tactile_swipe_menu_background_color',array('sanitize_callback' => 'sanitize_hex_color'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'tactile_swipe_menu_background_color',array(
            'label' => 'Menu background','settings' => 'tactile_swipe_menu_background_color','section' => 'tactile_swipe_menu_section')
		));

		//
        // ADD "Misc" SECTION TO "TACTILE" PANEL 
        //
        $wp_customize->add_section('tactile_misc_section',array('title' => __('Misc','tactile-menu'),'panel' => 'tactile_panel'));
    
		/* don't push down site */
        $wp_customize->add_setting('tactile_site_top',array('sanitize_callback' => 'sanitize_tactile_site_top',));
        function sanitize_tactile_site_top( $input ) { if ( $input == 1 ) { return 1; } else { return ''; } }
		$wp_customize->add_control('tactile_site_top',array('type' => 'checkbox','label' => __('Do not push down site','tactile-menu'),'description' => 'When unchecked, the header will push down your theme by the amount of its height.','section' => 'tactile_misc_section',));

		/* smaller than */
        $wp_customize->add_setting('tactile_smaller_than',array('sanitize_callback' => 'sanitize_tactile_smaller_than',));
        function sanitize_tactile_smaller_than($input) {return wp_kses_post(force_balance_tags($input));}
        $wp_customize->add_control('tactile_smaller_than',array(
            'type' => 'text',
            'label' => __('Hide at certain width/resolution','tactile-menu'),
            'description' => __('<strong>Example #1:</strong> If you want to show Tactile on desktop only, enter the values as 0 and 500. <br><br> <strong>Example #2:</strong> If you want to show Tactile on mobile only, enter the values as 500 and 5000. <br><br> Feel free to experiment with your own values to get the result that is right for you. If fields are empty, Tactile will be visible at all browser widths and resolutions. <br><br> Hide Tactile menu if browser width or screen resolution (in pixels) is between...','tactile-menu'),
            'section' => 'tactile_misc_section',
        ));
        
        /* larger than */
        $wp_customize->add_setting('tactile_larger_than',array('sanitize_callback' => 'sanitize_tactile_larger_than',));
        function sanitize_tactile_larger_than($input) {return wp_kses_post(force_balance_tags($input));}
        $wp_customize->add_control('tactile_larger_than',array(
            'type' => 'text',
            'description' => __('..and:','tactile-menu'),
            'section' => 'tactile_misc_section',
        ));
        
        /* hide theme menu */
        $wp_customize->add_setting('tactile_hide_theme_menu',array('sanitize_callback' => 'sanitize_tactile_hide_theme_menu',));
        function sanitize_tactile_hide_theme_menu($input) {return wp_kses_post(force_balance_tags($input));}
        $wp_customize->add_control('tactile_hide_theme_menu',array(
            'type' => 'text',
            'label' => __('Advanced: Hide theme menu','tactile-menu'),
            'description' => __('If you have set Tactile to show only at a certain resolution, know the class/ID of your theme menu and would like to hide it when Tactile is visible, enter the class/ID into this field (example: "#my-theme-menu"). Multiple classes/IDs can be entered (separate with comma as you would in a stylesheet).','tactile-menu'),
            'section' => 'tactile_misc_section',
        ));
		
	}
	add_action('customize_register', 'tactile_theme_customizer');

	//
	// Add menu to theme
	//
	
	function bonfire_tactile_footer() {
	?>

		<?php include( plugin_dir_path( __FILE__ ) . 'include.php'); ?>

	<?php
	}
	add_action('wp_footer','bonfire_tactile_footer');

	
	//
	// ENQUEUE tactile.css
	//
	function tactile_css() {
		wp_register_style( 'bonfire-tactile-css', plugins_url( '/tactile.css', __FILE__ ) . '', array(), '1', 'all' );
		wp_enqueue_style( 'bonfire-tactile-css' );
	}
	add_action( 'wp_enqueue_scripts', 'tactile_css' );
	
	//
	// ENQUEUE swiper.css (only if swipe menu not disabled)
	//
	if( get_theme_mod('tactile_hide_swipe_menu') == '') {
		function tactile_swiper_css() {
			wp_register_style( 'bonfire-tactile-swiper-css', plugins_url( '/swiper/swiper.css', __FILE__ ) . '', array(), '1', 'all' );
			wp_enqueue_style( 'bonfire-tactile-swiper-css' );
		}
		add_action( 'wp_enqueue_scripts', 'tactile_swiper_css' );
	}

	//
	// ENQUEUE swiper.min.js (only if swipe menu not disabled)
	//
	if( get_theme_mod('tactile_hide_swipe_menu') == '') {
		function tactile_swiper_js() {
			wp_register_script( 'bonfire-tactile-swiper-js', plugins_url( '/swiper/swiper.min.js', __FILE__ ) . '', array( 'jquery' ), '1', true );  
			wp_enqueue_script( 'bonfire-tactile-swiper-js' );
		}
		add_action( 'wp_enqueue_scripts', 'tactile_swiper_js' );
	}

	//
	// ENQUEUE tactile.js
	//
	function tactile_js() {
		wp_register_script( 'bonfire-tactile-js', plugins_url( '/tactile.js', __FILE__ ) . '', array( 'jquery' ), '1', true );  
		wp_enqueue_script( 'bonfire-tactile-js' );
	}
	add_action( 'wp_enqueue_scripts', 'tactile_js' );
	
	//
	// ENQUEUE search.js
	//
	if( get_theme_mod('tactile_hide_search') == '') {
		function tactile_search_js() {
			wp_register_script( 'bonfire-tactile-search-js', plugins_url( '/search.js', __FILE__ ) . '', array( 'jquery' ), '1', true );
			wp_enqueue_script( 'bonfire-tactile-search-js' );
		}
		add_action( 'wp_enqueue_scripts', 'tactile_search_js' );
	}

	//
	// Enqueue Google WebFonts
	//
	function tactile_font() {
	$protocol = is_ssl() ? 'https' : 'http';
		wp_enqueue_style( 'bonfire-tactile-font', "$protocol://fonts.googleapis.com/css?family=Roboto:400|Rubik:400,500' rel='stylesheet' type='text/css" );
	}
	add_action( 'wp_enqueue_scripts', 'tactile_font' );

	//
	// Register Custom Menu Function
	//
	if (function_exists('register_nav_menus')) {
		register_nav_menus( array(
			'tactile-by-bonfire' => ( 'Tactile, by Bonfire (dropdown)' ),
			'tactile-by-bonfire-swipe' => ( 'Tactile, by Bonfire (swipe)' )
		) );
	}

	//
	// Add 'Settings' link to plugin page
	//
    add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'tactile_add_action_links' );
    function tactile_add_action_links ( $links ) {
        $mylinks = array(
        '<a href="' . admin_url( 'customize.php?autofocus[panel]=tactile_panel' ) . '">Settings</a>',
        );
    return array_merge( $links, $mylinks );
    }

	//
	// Insert theme customizer options into the footer
	//
	function bonfire_tactile_header_customize() {
	?>

		
		<style>
		/**************************************************************
		*** CUSTOMIZATION
		**************************************************************/
		/* header */
		.tactile-header-background-color { background-color:<?php echo get_theme_mod('tactile_header_color'); ?>; }
		.tactile-header-background-image {
			background-image:url("<?php echo get_theme_mod('tactile_header_image'); ?>");
			<?php if( get_theme_mod('tactile_header_pattern') != '') { ?>
				background-size:auto;
				background-repeat:repeat;
			<?php } else { ?>
				background-size:cover;
				background-repeat:no-repeat;
			<?php } ?>
		}
		<?php if( get_theme_mod('tactile_absolute') != '') { ?>
		.tactile-header-wrapper,
		.tactile-by-bonfire-wrapper {
			position:absolute !important;
		}
		<?php } ?>
		/* logo */
		.tactile-logo a {
			font-size:<?php echo get_theme_mod('tactile_logo_text_size'); ?>px;
			color:<?php echo get_theme_mod('tactile_logo_color'); ?>;
		}
		<?php if ( !wp_is_mobile() ) { ?>
		.tactile-logo a:hover { color:<?php echo get_theme_mod('tactile_logo_hover_color'); ?>; }
		<?php } ?>
		/* menu button */
		.tactile-menu-button::before,
		.tactile-menu-button::after,
		.tactile-menu-button div.tactile-menu-button-middle { background-color:<?php echo get_theme_mod('tactile_menu_button_color'); ?>; }
		/* main menu button hover */
		<?php if ( !wp_is_mobile() ) { ?>
		.tactile-menu-button:hover::before,
		.tactile-menu-button:hover::after,
		.tactile-menu-button:hover div.tactile-menu-button-middle,
		.tactile-menu-button-active::before,
		.tactile-menu-button-active::after,
		.tactile-menu-button-active div.tactile-menu-button-middle { background-color:<?php echo get_theme_mod('tactile_menu_button_hover_color'); ?> !important; }
		<?php } ?>
		/* dropdown menu */
		.tactile-by-bonfire { background-color:<?php echo get_theme_mod('tactile_dropdown_background_color'); ?>; }
		.tactile-by-bonfire .menu > li { border-bottom-color:<?php echo get_theme_mod('tactile_dropdown_menu_divider_color'); ?>; }
		.tactile-by-bonfire ul li a {
			font-size:<?php echo get_theme_mod('tactile_dropdown_menu_item_size'); ?>px;
			color:<?php echo get_theme_mod('tactile_dropdown_menu_item_color'); ?>;
		}
		<?php if ( !wp_is_mobile() ) { ?>
		.tactile-by-bonfire ul li a:hover { color:<?php if( get_theme_mod('tactile_dropdown_menu_item_hover_color') != '') { ?><?php echo get_theme_mod('tactile_dropdown_menu_item_hover_color'); ?><?php } else { ?>#111<?php } ?>; }
		<?php } ?>
		/* dropdown expand separator */
		.tactile-by-bonfire .menu li span { border-left-color:<?php echo get_theme_mod('tactile_expand_icon_separator_color'); ?>; }
		/* dropdown expand icon */
		.tactile-by-bonfire .tactile-sub-arrow-inner:before,
        .tactile-by-bonfire .tactile-sub-arrow-inner:after { background-color:<?php echo get_theme_mod('tactile_expand_icon_color'); ?>; }
		/* dropdown expand icon hover (on non-touch devices only) */
		<?php if ( !wp_is_mobile() ) { ?>
        .tactile-by-bonfire .tactile-sub-arrow:hover .tactile-sub-arrow-inner::before,
        .tactile-by-bonfire .tactile-sub-arrow:hover .tactile-sub-arrow-inner::after { background-color:<?php if( get_theme_mod('tactile_expand_icon_hover_color') != '') { ?><?php echo get_theme_mod('tactile_expand_icon_hover_color'); ?><?php } else { ?>#777<?php } ?>; }
		<?php } ?>
		/* dropdown menu (sub-menu) */
		.tactile-by-bonfire ul.sub-menu { background-color:<?php echo get_theme_mod('tactile_dropdown_sub_background_color'); ?>; }
		/* dropdown item (sub-menu) */
		.tactile-by-bonfire .sub-menu a {
			font-size:<?php echo get_theme_mod('tactile_dropdown_submenu_item_size'); ?>px;
			color:<?php echo get_theme_mod('tactile_dropdown_submenu_item_color'); ?>;
		}
		<?php if ( !wp_is_mobile() ) { ?>
		.tactile-by-bonfire .sub-menu a:hover { color:<?php if( get_theme_mod('tactile_dropdown_submenu_item_hover_color') != '') { ?><?php echo get_theme_mod('tactile_dropdown_submenu_item_hover_color'); ?><?php } else { ?>#111<?php } ?>; }
		<?php } ?>
		.tactile-by-bonfire .sub-menu a:active { color:<?php echo get_theme_mod('tactile_dropdown_submenu_item_hover_color'); ?>; }
		.tactile-by-bonfire ul li ul li:after { background-color:<?php echo get_theme_mod('tactile_dropdown_submenu_divider_color'); ?>; }
		.tactile-by-bonfire ul.sub-menu > li:first-child { border-top-color:<?php echo get_theme_mod('tactile_dropdown_submenu_divider_color'); ?>; }
		/* dropdown expand separator sub-menu */
		.tactile-by-bonfire .sub-menu li span { border-left-color:<?php echo get_theme_mod('tactile_submenu_expand_icon_separator_color'); ?>; }
		/* dropdown expand icon (sub-menu) */
        .tactile-by-bonfire .sub-menu li .tactile-sub-arrow-inner:before,
        .tactile-by-bonfire .sub-menu li .tactile-sub-arrow-inner:after { background-color:<?php echo get_theme_mod('tactile_submenu_expand_icon_color'); ?>; }
		/* dropdown expand icon hover (sub-menu, on non-touch devices only) */
		<?php if ( !wp_is_mobile() ) { ?>
        .tactile-by-bonfire .sub-menu li .tactile-sub-arrow:hover .tactile-sub-arrow-inner:before,
        .tactile-by-bonfire .sub-menu li .tactile-sub-arrow:hover .tactile-sub-arrow-inner:after { background-color:<?php echo get_theme_mod('tactile_submenu_expand_icon_hover_color'); ?>; }
        <?php } ?>
		/* search button */
		.tactile-icon-search::before { color:<?php echo get_theme_mod('tactile_search_button_color'); ?>; }
		/* search button hover */
		<?php if ( !wp_is_mobile() ) { ?>
		.tactile-search-button:hover .tactile-icon-search::before { color:<?php echo get_theme_mod('tactile_search_button_hover_color'); ?>; }
		<?php } ?>
		/* search close button */
		.tactile-search-close-button::before,
		.tactile-search-close-button::after { background-color:<?php echo get_theme_mod('tactile_search_close_button_color'); ?>; }
		/* search close button hover */
		<?php if ( !wp_is_mobile() ) { ?>
		.tactile-search-close-button:hover::before,
		.tactile-search-close-button:hover::after { background-color:<?php echo get_theme_mod('tactile_search_close_button_hover_color'); ?>; }
		<?php } ?>
		/* search placeholder color */
		#searchform input::-webkit-input-placeholder { color:<?php echo get_theme_mod('tactile_search_placeholder_color'); ?> !important; }
		#searchform input:-moz-placeholder { color:<?php echo get_theme_mod('tactile_search_placeholder_color'); ?> !important; }
		#searchform input::-moz-placeholder { color:<?php echo get_theme_mod('tactile_search_placeholder_color'); ?> !important; }
		/* search field color */
		.tactile-search-wrapper #searchform input { color:<?php echo get_theme_mod('tactile_search_field_color'); ?>; }
		/* active search background color */
		.tactile-search-border { border-bottom-color:<?php echo get_theme_mod('tactile_search_bottom_border_color'); ?>; }
		.tactile-search-wrapper-active-bg {
			background-color:<?php echo get_theme_mod('tactile_search_active_background_color'); ?>;
			opacity:<?php echo get_theme_mod('tactile_search_header_color_opacity'); ?> !important;
		}
		/* search input */
		.tactile-search-wrapper #searchform input { color:<?php echo get_theme_mod('tactile_search_input_color'); ?>; }

		/* swipe menu item */
		.tactile-by-bonfire-swipe ul li a {
			font-size:<?php echo get_theme_mod('tactile_swipe_menu_item_size'); ?>px;
			color:<?php echo get_theme_mod('tactile_swipe_menu_item_color'); ?>;
		}
		/* swipe menu item hover + current */
		<?php if ( !wp_is_mobile() ) { ?>
		.tactile-by-bonfire-swipe ul li a:hover { color:<?php if( get_theme_mod('tactile_swipe_menu_item_hover_color') != '') { ?><?php echo get_theme_mod('tactile_swipe_menu_item_hover_color'); ?><?php } else { ?>#fff<?php } ?>; }
		<?php } ?>
		.tactile-by-bonfire-swipe ul li.current-menu-item a { color:<?php echo get_theme_mod('tactile_swipe_menu_item_hover_color'); ?>; }
		/* swipe menu item current border */
		.tactile-by-bonfire-swipe ul li.current-menu-item::after { background-color:<?php echo get_theme_mod('tactile_swipe_current_menu_item_marker_color'); ?>; }
		/* swipe menu background */
		.tactile-swipe-menu-wrapper { background-color:<?php echo get_theme_mod('tactile_swipe_menu_background_color'); ?>; }

		/* custom menu width */
		.tactile-by-bonfire-wrapper,
		.tactile-by-bonfire ul li { max-width:<?php echo get_theme_mod('tactile_dropdown_width'); ?>px; }

		/* don't push down site by height of menu */
		<?php if( get_theme_mod('tactile_site_top') != '') { ?>
			body { margin-top:0px; }
		<?php } else { ?>
			<?php if( get_theme_mod('tactile_hide_swipe_menu') != '') { ?>
				body { margin-top:60px; }
			<?php } else { ?>
				body { margin-top:105px; }
			<?php } ?>
		<?php } ?>
		
		/* header background opacity */
		.tactile-header-background-color { opacity:<?php echo get_theme_mod('tactile_header_color_opacity'); ?>; }
		/* header background image opacity */
		.tactile-header-background-image { opacity:<?php echo get_theme_mod('tactile_header_image_opacity'); ?>; }

		/* menu button animations (-/X) */
		<?php $tactile_menu_button_animation = get_theme_mod( 'tactile_menu_button_animation' ); if( $tactile_menu_button_animation == '' ) { ?>
        <?php } else if( $tactile_menu_button_animation != '' ) { switch ( $tactile_menu_button_animation ) {
        case 'minus': ?>
			.tactile-menu-button-active::before {
				-webkit-transform:translateY(6px);
				-moz-transform:translateY(6px);
				transform:translateY(6px);
			}
			.tactile-menu-button-active::after {
				-webkit-transform:translateY(-6px);
				-moz-transform:translateY(-6px);
				transform:translateY(-6px);
			}
        <?php break; case 'x': ?>
			.tactile-menu-button-active::before {
				-webkit-transform:translateY(6px) rotate(135deg);
				-moz-transform:translateY(6px) rotate(135deg);
				transform:translateY(6px) rotate(135deg);
			}
			.tactile-menu-button-active::after {
				-webkit-transform:translateY(-6px) rotate(45deg);
				-moz-transform:translateY(-6px) rotate(45deg);
				transform:translateY(-6px) rotate(45deg);
			}
			.tactile-menu-button-active div.tactile-menu-button-middle {
				opacity:0;
				
				-webkit-transform:scaleX(0);
				-moz-transform:scaleX(0);
				transform:scaleX(0);
			}
		<?php break; }} ?>
		
		/* hide tactile between resolutions */
		@media ( min-width:<?php echo get_theme_mod('tactile_smaller_than'); ?>px) and (max-width:<?php echo get_theme_mod('tactile_larger_than'); ?>px) {
			.tactile-header-wrapper,
			.tactile-by-bonfire-wrapper,
			.tactile-header-background-color,
			.tactile-header-background-image { display:none; }
			body { margin-top:0; }
		}
		/* hide theme menu */
		<?php if( get_theme_mod('tactile_hide_theme_menu') != '') { ?>
		@media screen and (max-width:<?php echo get_theme_mod('tactile_smaller_than'); ?>px) {
			<?php echo get_theme_mod('tactile_hide_theme_menu'); ?> { display:none !important; }
		}
		@media screen and (min-width:<?php echo get_theme_mod('tactile_larger_than'); ?>px) {
			<?php echo get_theme_mod('tactile_hide_theme_menu'); ?> { display:none !important; }
		}
		<?php } ?>
		</style>
		<!-- END CUSTOM COLORS (WP THEME CUSTOMIZER) -->
	
	<?php
	}
	add_action('wp_footer','bonfire_tactile_header_customize');

?>