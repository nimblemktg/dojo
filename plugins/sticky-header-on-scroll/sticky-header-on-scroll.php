<?php
/*
Plugin Name: Sticky Header on Scroll
Plugin URI: http://bonfirethemes.com/
Description: Customize under Appearance > Customize > Sticky Header on Scroll Plugin
Version: 1.3
Author: Bonfire Themes
Author URI: http://bonfirethemes.com/
License: GPL2
*/

    //
	// WORDPRESS LIVE CUSTOMIZER
	//
	function shos_theme_customizer( $wp_customize ) {
        
        //
        // ADD "Sticky Header on Scroll Plugin" PANEL TO LIVE CUSTOMIZER 
        //
        $wp_customize->add_panel('shos_panel', array('title' => __('Sticky Header on Scroll Plugin', 'shos'),'priority' => 10,));
        
        //
        // ADD "Header Bar" SECTION TO "Sticky Header on Scroll Plugin" PANEL 
        //
        $wp_customize->add_section('shos_header_section',array('title' => __( 'Header Bar', 'shos' ),'panel'  => 'shos_panel','priority' => 1));
        
        /* header height */
        $wp_customize->add_setting('shos_header_height',array('sanitize_callback' => 'sanitize_shos_header_height',));
        function sanitize_shos_header_height($input) {return wp_kses_post(force_balance_tags($input));}
        $wp_customize->add_control('shos_header_height',array(
            'type' => 'text',
            'label' => 'Header height (in pixels)',
            'description' => 'Example: 75. If empty, defaults to 66. Recommended only if you want to make header larger. Alternatively, use the slim design option below.',
            'section' => 'shos_header_section',
        ));
        
        /* slim design */
        $wp_customize->add_setting('shos_slim_design',array('sanitize_callback' => 'sanitize_shos_slim_design',));
        function sanitize_shos_slim_design( $input ) { if ( $input == 1 ) { return 1; } else { return ''; } }
        $wp_customize->add_control('shos_slim_design',array('type' => 'checkbox','label' => 'Slim design','description' => 'If enabled, the custom height setting above will be ignored.', 'section' => 'shos_header_section',));
        
        /* logo area background image */
        $wp_customize->add_setting('shos_header_bg_image');
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'shos_header_bg_image',
            array(
                'label' => 'Header background image',
                'settings' => 'shos_header_bg_image',
                'section' => 'shos_header_section',
        )
        ));
        
        /* logo area background image full size */
        $wp_customize->add_setting('shos_header_bg_image_cover',array('sanitize_callback' => 'sanitize_shos_header_bg_image_cover',));
        function sanitize_shos_header_bg_image_cover( $input ) { if ( $input == 1 ) { return 1; } else { return ''; } }
        $wp_customize->add_control('shos_header_bg_image_cover',array('type' => 'checkbox','label' => 'Full background','description' => 'By default, the background image will be shown as a pattern. If this option is selected, it will be displayed as a full background instead.','section' => 'shos_header_section',));
        
        /* logo area background image opacity */
        $wp_customize->add_setting('shos_header_bg_image_opacity',array('sanitize_callback' => 'sanitize_shos_header_bg_image_opacity',));
        function sanitize_shos_header_bg_image_opacity($input) {return wp_kses_post(force_balance_tags($input));}
        $wp_customize->add_control('shos_header_bg_image_opacity',array(
            'type' => 'text',
            'label' => 'Header background image opacity',
            'description' => 'Example: 0.5 or 0.75. If empty, defaults to 0.1',
            'section' => 'shos_header_section',
        ));
        
        /* header background color */
        $wp_customize->add_setting( 'shos_header_color', array( 'sanitize_callback' => 'sanitize_hex_color' ));
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'shos_header_color',array(
            'label' => 'Header background', 'settings' => 'shos_header_color', 'section' => 'shos_header_section' )
        ));
        
        /* header opacity */
        $wp_customize->add_setting('shos_header_opacity',array('sanitize_callback' => 'sanitize_shos_header_opacity',));
        function sanitize_shos_header_opacity($input) {return wp_kses_post(force_balance_tags($input));}
        $wp_customize->add_control('shos_header_opacity',array(
            'type' => 'text',
            'label' => 'Header opacity',
            'description' => 'From 0-1 (example: 0.95) If empty, defaults to 1',
            'section' => 'shos_header_section',
        ));
        
        //
        // ADD "Logo" SECTION TO "Sticky Header on Scroll Plugin" PANEL 
        //
        $wp_customize->add_section('shos_logo_section',array('title' => __( 'Logo', 'shos' ),'panel'  => 'shos_panel','priority' => 1));
        
        /* hide logo */
        $wp_customize->add_setting('shos_hide_logo',array('sanitize_callback' => 'sanitize_shos_hide_logo',));
        function sanitize_shos_hide_logo( $input ) { if ( $input == 1 ) { return 1; } else { return ''; } }
        $wp_customize->add_control('shos_hide_logo',array('type' => 'checkbox','label' => 'Hide logo','description' => 'If ticked, logo will not be displayed.', 'section' => 'shos_logo_section',));
        
        /* logo image */
        $wp_customize->add_setting('shos_logo_image');
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'shos_logo_image',
            array(
                'label' => 'Upload logo image',
                'settings' => 'shos_logo_image',
                'section' => 'shos_logo_section',
        )
        ));
        
        /* logo height */
        $wp_customize->add_setting('shos_logo_height',array('sanitize_callback' => 'sanitize_shos_logo_height',));
        function sanitize_shos_logo_height($input) {return wp_kses_post(force_balance_tags($input));}
        $wp_customize->add_control('shos_logo_height',array(
            'type' => 'text',
            'label' => 'Logo height (in pixels)',
            'description' => 'Example: 30. If empty, defaults to 45. Logo width will remain proportional to height.',
            'section' => 'shos_logo_section',
        ));
        
        /* logo text color */
        $wp_customize->add_setting( 'shos_logo_color', array( 'sanitize_callback' => 'sanitize_hex_color' ));
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'shos_logo_color',array(
            'label' => 'Logo', 'settings' => 'shos_logo_color', 'section' => 'shos_logo_section' )
        ));
        
        /* logo text hover color */
        $wp_customize->add_setting( 'shos_logo_hover_color', array( 'sanitize_callback' => 'sanitize_hex_color' ));
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'shos_logo_hover_color',array(
            'label' => 'Logo hover', 'settings' => 'shos_logo_hover_color', 'section' => 'shos_logo_section' )
        ));
        
        //
        // ADD "Menu Button" SECTION TO "Sticky Header on Scroll Plugin" PANEL 
        //
        $wp_customize->add_section('shos_menu_button_section',array('title' => __( 'Menu Button', 'shos' ),'panel'  => 'shos_panel','priority' => 1));
        
        /* menu button color */
        $wp_customize->add_setting( 'shos_main_menu_button_color', array( 'sanitize_callback' => 'sanitize_hex_color' ));
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'shos_main_menu_button_color',array(
            'label' => 'Menu button', 'settings' => 'shos_main_menu_button_color', 'section' => 'shos_menu_button_section' )
        ));
        
        /* menu button hover color */
        $wp_customize->add_setting( 'shos_main_menu_button_hover_color', array( 'sanitize_callback' => 'sanitize_hex_color' ));
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'shos_main_menu_button_hover_color',array(
            'label' => 'Menu button (hover, active)', 'settings' => 'shos_main_menu_button_hover_color', 'section' => 'shos_menu_button_section' )
        ));
        
        /* menu button background color */
        $wp_customize->add_setting( 'shos_main_menu_button_bg_color', array( 'sanitize_callback' => 'sanitize_hex_color' ));
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'shos_main_menu_button_bg_color',array(
            'label' => 'Menu button background', 'settings' => 'shos_main_menu_button_bg_color', 'description' => 'Applied only when slim design enabled (in the "Header Bar" section).', 'section' => 'shos_menu_button_section' )
        ));
        
        /* menu button background hover color */
        $wp_customize->add_setting( 'shos_main_menu_button_bg_hover_color', array( 'sanitize_callback' => 'sanitize_hex_color' ));
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'shos_main_menu_button_bg_hover_color',array(
            'label' => 'Menu button background (hover, active)', 'settings' => 'shos_main_menu_button_bg_hover_color', 'description' => 'Applied only when slim design enabled (in the "Header Bar" section).', 'section' => 'shos_menu_button_section' )
        ));
        
        /* menu button label text */
        $wp_customize->add_setting('shos_menu_button_label',array('sanitize_callback' => 'sanitize_shos_menu_button_label',));
        function sanitize_shos_menu_button_label($input) {return wp_kses_post(force_balance_tags($input));}
        $wp_customize->add_control('shos_menu_button_label',array(
            'type' => 'text',
            'label' => 'Menu button label',
            'description' => 'An optional text label to be shown below menu button (for example: MENU).',
            'section' => 'shos_menu_button_section',
        ));
        
        /* menu button label color */
        $wp_customize->add_setting( 'shos_main_menu_button_label_color', array( 'sanitize_callback' => 'sanitize_hex_color' ));
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'shos_main_menu_button_label_color',array(
            'label' => 'Menu button label', 'settings' => 'shos_main_menu_button_label_color', 'section' => 'shos_menu_button_section' )
        ));
        
        /* menu button label hover color */
        $wp_customize->add_setting( 'shos_main_menu_button_label_hover_color', array( 'sanitize_callback' => 'sanitize_hex_color' ));
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'shos_main_menu_button_label_hover_color',array(
            'label' => 'Menu button label (hover, active)', 'settings' => 'shos_main_menu_button_label_hover_color', 'section' => 'shos_menu_button_section' )
        ));

        //
        // ADD "Dropdown Menu" SECTION TO "Sticky Header on Scroll Plugin" PANEL 
        //
        $wp_customize->add_section('shos_dropdown_section',array('title' => __( 'Dropdown Menu', 'shos' ),'panel'  => 'shos_panel','priority' => 1));

        /* main menu max width */
        $wp_customize->add_setting('shos_menu_max_width',array('sanitize_callback' => 'sanitize_shos_menu_max_width',));
        function sanitize_shos_menu_max_width($input) {return wp_kses_post(force_balance_tags($input));}
        $wp_customize->add_control('shos_menu_max_width',array(
            'type' => 'text',
            'label' => 'Dropdown menu max width (in pixels)',
            'description' => 'Set maximum width for dropdown menu. If left empty, defaults to 300.',
            'section' => 'shos_dropdown_section',
        ));

        /* main menu max height */
        $wp_customize->add_setting('shos_menu_max_height',array('sanitize_callback' => 'sanitize_shos_menu_max_height',));
        function sanitize_shos_menu_max_height($input) {return wp_kses_post(force_balance_tags($input));}
        $wp_customize->add_control('shos_menu_max_height',array(
            'type' => 'text',
            'label' => 'Dropdown menu max height (in pixels)',
            'description' => 'Set maximum height for dropdown menu. If left empty, defaults to full size.',
            'section' => 'shos_dropdown_section',
        ));

        /* main menu item color */
        $wp_customize->add_setting( 'shos_main_menu_color', array( 'sanitize_callback' => 'sanitize_hex_color' ));
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'shos_main_menu_color',array(
            'label' => 'Menu item', 'settings' => 'shos_main_menu_color', 'section' => 'shos_dropdown_section' )
        ));
        
        /* main menu item hover color */
        $wp_customize->add_setting( 'shos_main_menu_hover_color', array( 'sanitize_callback' => 'sanitize_hex_color' ));
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'shos_main_menu_hover_color',array(
            'label' => 'Menu item (hover)', 'settings' => 'shos_main_menu_hover_color', 'section' => 'shos_dropdown_section' )
        ));

        /* expand icon separator color */
        $wp_customize->add_setting('shos_expand_icon_separator_color',array('sanitize_callback' => 'sanitize_hex_color'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'shos_expand_icon_separator_color',array(
            'label' => 'Expand icon separator','settings' => 'shos_expand_icon_separator_color','section' => 'shos_dropdown_section')
		));

		/* expand icon color */
        $wp_customize->add_setting('shos_expand_icon_color',array('sanitize_callback' => 'sanitize_hex_color'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'shos_expand_icon_color',array(
            'label' => 'Expand icon','settings' => 'shos_expand_icon_color','section' => 'shos_dropdown_section')
		));

		/* expand icon hover color */
        $wp_customize->add_setting('shos_expand_icon_hover_color',array('sanitize_callback' => 'sanitize_hex_color'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'shos_expand_icon_hover_color',array(
            'label' => 'Expand icon (hover)','settings' => 'shos_expand_icon_hover_color','section' => 'shos_dropdown_section')
		));
        
        /* main menu item divider color */
        $wp_customize->add_setting( 'shos_main_menu_divider_color', array( 'sanitize_callback' => 'sanitize_hex_color' ));
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'shos_main_menu_divider_color',array(
            'label' => 'Menu item dividers', 'settings' => 'shos_main_menu_divider_color', 'section' => 'shos_dropdown_section' )
        ));
        
        /* submenu item color */
        $wp_customize->add_setting( 'shos_submenu_color', array( 'sanitize_callback' => 'sanitize_hex_color' ));
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'shos_submenu_color',array(
            'label' => 'Submenu item', 'settings' => 'shos_submenu_color', 'section' => 'shos_dropdown_section' )
        ));

        /* submenu item hover color */
        $wp_customize->add_setting( 'shos_submenu_hover_color', array( 'sanitize_callback' => 'sanitize_hex_color' ));
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'shos_submenu_hover_color',array(
            'label' => 'Submenu item (hover)', 'settings' => 'shos_submenu_hover_color', 'section' => 'shos_dropdown_section' )
        ));

        /* expand icon separator color (sub-menu) */
        $wp_customize->add_setting('shos_submenu_expand_icon_separator_color',array('sanitize_callback' => 'sanitize_hex_color'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'shos_submenu_expand_icon_separator_color',array(
            'label' => 'Expand icon separator (sub-menu)','settings' => 'shos_submenu_expand_icon_separator_color','section' => 'shos_dropdown_section')
		));

		/* expand icon color (sub-menu) */
        $wp_customize->add_setting('shos_submenu_expand_icon_color',array('sanitize_callback' => 'sanitize_hex_color'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'shos_submenu_expand_icon_color',array(
            'label' => 'Expand icon (sub-menu)','settings' => 'shos_submenu_expand_icon_color','section' => 'shos_dropdown_section')
		));

		/* expand icon hover color (sub-menu) */
        $wp_customize->add_setting('shos_submenu_expand_icon_hover_color',array('sanitize_callback' => 'sanitize_hex_color'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'shos_submenu_expand_icon_hover_color',array(
            'label' => 'Expand icon (hover, sub-menu)','settings' => 'shos_submenu_expand_icon_hover_color','section' => 'shos_dropdown_section')
		));

        /* submenu item divider color */
        $wp_customize->add_setting( 'shos_submenu_divider_color', array( 'sanitize_callback' => 'sanitize_hex_color' ));
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'shos_submenu_divider_color',array(
            'label' => 'Submenu item dividers', 'settings' => 'shos_submenu_divider_color', 'section' => 'shos_dropdown_section' )
        ));

        /* main menu background color */
        $wp_customize->add_setting( 'shos_main_menu_background_color', array( 'sanitize_callback' => 'sanitize_hex_color' ));
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'shos_main_menu_background_color',array(
            'label' => 'Menu background', 'settings' => 'shos_main_menu_background_color', 'section' => 'shos_dropdown_section' )
        ));

        /* submenu background color */
        $wp_customize->add_setting( 'shos_submenu_background_color', array( 'sanitize_callback' => 'sanitize_hex_color' ));
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'shos_submenu_background_color',array(
            'label' => 'Submenu background', 'settings' => 'shos_submenu_background_color', 'section' => 'shos_dropdown_section' )
        ));
        
        //
        // ADD "Post title" SECTION TO "Sticky Header on Scroll Plugin" PANEL 
        //
        $wp_customize->add_section('shos_post_title_section',array('title' => __( 'Post Title', 'shos' ),'panel'  => 'shos_panel','priority' => 1));
        
        /* hide post title */
        $wp_customize->add_setting('shos_hide_post_title',array('sanitize_callback' => 'sanitize_shos_hide_post_title',));
        function sanitize_shos_hide_post_title( $input ) { if ( $input == 1 ) { return 1; } else { return ''; } }
        $wp_customize->add_control('shos_hide_post_title',array('type' => 'checkbox','label' => 'Hide post title','description' => 'By default, when viewing a post, the post title is displayed in the header. If you wish it to be hidden, enable this option.', 'section' => 'shos_post_title_section',));
        
        /* post title prefix */
        $wp_customize->add_setting('shos_post_title_prefix',array('sanitize_callback' => 'sanitize_shos_post_title_prefix',));
        function sanitize_shos_post_title_prefix($input) {return wp_kses_post(force_balance_tags($input));}
        $wp_customize->add_control('shos_post_title_prefix',array(
            'type' => 'text',
            'label' => 'Post title prefix',
            'description' => 'If left empty, no prefix is shown.',
            'section' => 'shos_post_title_section',
        ));
        
        /* post title prefix color */
        $wp_customize->add_setting( 'shos_post_title_prefix_color', array( 'sanitize_callback' => 'sanitize_hex_color' ));
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'shos_post_title_prefix_color',array(
            'label' => 'Post title prefix', 'settings' => 'shos_post_title_prefix_color', 'section' => 'shos_post_title_section' )
        ));
        
        /* post title color */
        $wp_customize->add_setting( 'shos_post_title_color', array( 'sanitize_callback' => 'sanitize_hex_color' ));
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'shos_post_title_color',array(
            'label' => 'Post title', 'settings' => 'shos_post_title_color', 'section' => 'shos_post_title_section' )
        ));
        
        //
        // ADD "Share Buttons" SECTION TO "Sticky Header on Scroll Plugin" PANEL 
        //
        $wp_customize->add_section('shos_share_buttons_section',array('title' => __( 'Share Buttons', 'shos' ),'panel'  => 'shos_panel','priority' => 1));
        
        /* hide share buttons */
        $wp_customize->add_setting('shos_hide_share_buttons',array('sanitize_callback' => 'sanitize_shos_hide_share_buttons',));
        function sanitize_shos_hide_share_buttons( $input ) { if ( $input == 1 ) { return 1; } else { return ''; } }
        $wp_customize->add_control('shos_hide_share_buttons',array('type' => 'checkbox','label' => 'Hide share buttons','description' => 'By default, when viewing a post, the share buttons are displayed in the header. If you wish them to be hidden, enable this option.', 'section' => 'shos_share_buttons_section',));
        
        /* 'more buttons' button color */
        $wp_customize->add_setting('shos_more_share_buttons_color', array( 'sanitize_callback' => 'sanitize_hex_color'));
        $wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize, 'shos_more_share_buttons_color',array(
            'label' => '’More buttons’ button color', 'settings' => 'shos_more_share_buttons_color', 'section' => 'shos_share_buttons_section' )
        ));

        //
        // ADD "STYLED SCROLLBAR" SECTION TO "Sticky Header on Scroll Plugin" PANEL 
        //
        $wp_customize->add_section('shos_scrollbar_section',array('title' => __( 'Styled Scrollbar', 'minimenu' ), 'description' => 'Note: Styled scrollbar is not displayed on touch devices.','panel'  => 'shos_panel','priority' => 1));
        
        /* enable styled scrollbar */
        $wp_customize->add_setting('shos_styled_scrollbar',array('sanitize_callback' => 'sanitize_shos_styled_scrollbar',));
        function sanitize_shos_styled_scrollbar( $input ) { if ( $input == 1 ) { return 1; } else { return ''; } }
        $wp_customize->add_control('shos_styled_scrollbar',array('type' => 'checkbox','label' => 'Enable styled scrollbar','description' => 'If unticked, the default scrollbar of a browser is used.', 'section' => 'shos_scrollbar_section',));
        
        /* scrollbar color */
        $wp_customize->add_setting( 'shos_scrollbar_color', array( 'sanitize_callback' => 'sanitize_hex_color' ));
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'shos_scrollbar_color',array(
            'label' => 'Scrollbar', 'settings' => 'shos_scrollbar_color', 'section' => 'shos_scrollbar_section' )
        ));
        
        /* scrollbar background color */
        $wp_customize->add_setting( 'shos_scrollbar_background_color', array( 'sanitize_callback' => 'sanitize_hex_color' ));
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'shos_scrollbar_background_color',array(
            'label' => 'Scrollbar background', 'settings' => 'shos_scrollbar_background_color', 'section' => 'shos_scrollbar_section' )
        ));

        //
        // ADD "Misc" SECTION TO "Sticky Header on Scroll Plugin" PANEL 
        //
        $wp_customize->add_section('shos_misc_section',array('title' => __( 'Misc', 'shos' ),'panel'  => 'shos_panel','priority' => 1));
        
        /* dividers color */
        $wp_customize->add_setting( 'shos_divider_color', array( 'sanitize_callback' => 'sanitize_hex_color' ));
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'shos_divider_color',array(
            'label' => 'Dividers', 'settings' => 'shos_divider_color', 'section' => 'shos_misc_section' )
        ));
        
        /* hide dividers */
        $wp_customize->add_setting('shos_hide_dividers',array('sanitize_callback' => 'sanitize_shos_hide_dividers',));
        function sanitize_shos_hide_dividers( $input ) { if ( $input == 1 ) { return 1; } else { return ''; } }
        $wp_customize->add_control('shos_hide_dividers',array('type' => 'checkbox','label' => 'Hide menu button and logo dividers', 'section' => 'shos_misc_section',));
        
        /* next button color */
        $wp_customize->add_setting( 'shos_next_button_color', array( 'sanitize_callback' => 'sanitize_hex_color' ));
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'shos_next_button_color',array(
            'label' => '"Next"button', 'settings' => 'shos_next_button_color', 'section' => 'shos_misc_section' )
        ));
        
        /* next button background color */
        $wp_customize->add_setting( 'shos_next_button_background_color', array( 'sanitize_callback' => 'sanitize_hex_color' ));
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'shos_next_button_background_color',array(
            'label' => '"Next" button background', 'settings' => 'shos_next_button_background_color', 'section' => 'shos_misc_section' )
        ));
        
        /* hide next post button */
        $wp_customize->add_setting('shos_hide_next_post_button',array('sanitize_callback' => 'sanitize_shos_hide_next_post_button',));
        function sanitize_shos_hide_next_post_button( $input ) { if ( $input == 1 ) { return 1; } else { return ''; } }
        $wp_customize->add_control('shos_hide_next_post_button',array('type' => 'checkbox','label' => 'Hide "Next" button','description' => 'By default, when viewing a post, the "Next" button is displayed in the header. If you wish it to be hidden, enable this option.', 'section' => 'shos_misc_section',));
        
        /* display after scrolling X pixels */
        $wp_customize->add_setting('shos_display_after',array('sanitize_callback' => 'sanitize_shos_display_after',));
        function sanitize_shos_display_after($input) {return wp_kses_post(force_balance_tags($input));}
        $wp_customize->add_control('shos_display_after',array(
            'type' => 'text',
            'label' => 'Display after scrolling X amount (in pixels)',
            'description' => 'The amount of distance the user has to scroll before the sticky header appears. Example: 50 or 250. By default, header will appear after scrolling 100 pixels.',
            'section' => 'shos_misc_section',
        ));
        
        /* smaller than */
        $wp_customize->add_setting('shos_smaller_than',array('sanitize_callback' => 'sanitize_shos_smaller_than',));
        function sanitize_shos_smaller_than($input) {return wp_kses_post(force_balance_tags($input));}
        $wp_customize->add_control('shos_smaller_than',array(
            'type' => 'text',
            'label' => 'Hide at certain width/resolution',
            'description' => '<strong>Example #1:</strong> If you want to show Sticky Header on Scroll on desktop only, enter the values as 0 and 500. <br><br> <strong>Example #2:</strong> If you want to show Sticky Header on Scroll on mobile only, enter the values as 500 and 5000. <br><br> Feel free to experiment with your own values to get the result that is right for you. If fields are empty, Sticky Header on Scroll will be visible at all browser widths and resolutions. <br><br> Hide Sticky Header on Scroll if browser width or screen resolution (in pixels) is between...',
            'section' => 'shos_misc_section',
        ));
        
        /* larger than */
        $wp_customize->add_setting('shos_larger_than',array('sanitize_callback' => 'sanitize_shos_larger_than',));
        function sanitize_shos_larger_than($input) {return wp_kses_post(force_balance_tags($input));}
        $wp_customize->add_control('shos_larger_than',array(
            'type' => 'text',
            'description' => '..and:',
            'section' => 'shos_misc_section',
        ));
        
        /* hide theme header */
        $wp_customize->add_setting('shos_hide_theme_header',array('sanitize_callback' => 'sanitize_shos_hide_theme_header',));
        function sanitize_shos_hide_theme_header($input) {return wp_kses_post(force_balance_tags($input));}
        $wp_customize->add_control('shos_hide_theme_header',array(
            'type' => 'text',
            'label' => 'Advanced: Hide theme header',
            'description' => 'If you know the class/ID of your theme header and would like to hide it (or any other element for that matter), enter the class/ID into this field (example: "#my-theme-header"). Multiple classes/IDs can be entered (separate with comma as you would in a stylesheet).',
            'section' => 'shos_misc_section',
        ));
        
    }
	add_action('customize_register', 'shos_theme_customizer');

	?>
<?php

	//
	// Add to theme
	//
	
	function shos_footer() {
	?>

        <div class="shos-contents-wrapper<?php if ( is_admin_bar_showing() ) { ?> wp-toolbar-active<?php } ?>">
            
            <!-- BEGIN MAIN MENU BUTTON -->
            <?php if ( has_nav_menu('shos-by-bonfire') ) { ?>
            <div class="shos-main-menu-button-wrapper">
                <div class="shos-main-menu-button-inner">
                    <div class="shos-main-menu-button">
                        <div class="shos-main-menu-button-middle"></div>
                    </div>
                </div>
            </div>
            <?php } ?>
            <!-- END MAIN MENU BUTTON -->
            
            <!-- BEGIN LOGO -->
            <?php if( get_theme_mod('shos_hide_logo') == '') { ?>
                <div class="shos-logo-wrapper">
                    <div class="shos-logo-inner">
                        <?php if ( get_theme_mod( 'shos_logo_image' ) ) : ?>
                            <!-- BEGIN LOGO IMAGE -->
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo get_theme_mod( 'shos_logo_image' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"></a>
                            <!-- END LOGO IMAGE -->
                        <?php else : ?>
                            <!-- BEGIN LOGO AS TEXT -->
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                                <?php bloginfo('name'); ?>
                            </a>
                            <!-- END LOGO AS TEXT-->
                        <?php endif; ?>
                    </div>
                </div>
            <?php } ?>
            <!-- END LOGO -->

            <!-- BEGIN POST TITLE -->
            <?php if( get_theme_mod('shos_hide_post_title') == '') { ?>
                <?php if (is_single()) { ?>
                    <div class="shos-post-title-wrapper">
                        <div class="shos-post-title-inner">
                            <?php if( get_theme_mod('shos_post_title_prefix') != '') { ?>
                                <span><?php echo get_theme_mod('shos_post_title_prefix'); ?></span>
                            <?php } ?>
                            <h2><?php the_title(); ?></h2>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
            <!-- END POST TITLE -->

            <!-- BEGIN NEXT POST BUTTON -->
            <?php if( get_theme_mod('shos_hide_next_post_button') == '') { ?>
                <?php if (is_single()) { ?>
                    <div class="shos-next-post-wrapper">
                        <div class="shos-next-post-inner">
                           <?php previous_post_link( '%link', 'NEXT <span class="shos-icon-arrow-right-thick"></span>' ); ?>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
            <!-- END NEXT POST BUTTON -->

            <!-- BEGIN SHARE -->
            <?php if( get_theme_mod('shos_hide_share_buttons') == '') { ?>
                <?php if (is_single()) { ?>
                <div class="shos-share-wrapper">
                    <div class="shos-share-inner">
                        <!-- BEGIN FACEBOOK BUTTON -->
                        <a href="http://www.facebook.com/sharer.php?u=<?php echo esc_url( get_permalink() ); ?>" target="_blank" class="shos-facebook-button">
                            <span class="shos-icon-facebook"></span><span class="shos-share-label"><?php esc_html_e('SHARE','shos'); ?></span>
                        </a>
                        <!-- END FACEBOOK BUTTON -->

                        <!-- BEGIN TWITTER BUTTON -->
                        <a href="http://twitter.com/share?url=<?php echo esc_url( get_permalink() ); ?>&text=<?php the_title(); ?>" target="_blank" class="shos-twitter-button">
                            <span class="shos-icon-twitter"></span><span class="shos-share-label"><?php esc_html_e('TWEET','shos'); ?></span>
                        </a>
                        <!-- END TWITTER BUTTON -->

                        <!-- BEGIN MORE SHARE BUTTONS -->
                        <div class="shos-more-share-button">
                            <div class="shos-more-share-button-inner"></div>
                            
                            <!-- BEGIN MORE SHARE BUTTONS DROPDOWN -->
                            <div class="shos-more-buttons-wrapper">

                                <!-- BEGIN GOOGLE+ BUTTON -->
                                <a href="https://plus.google.com/share?url=<?php echo esc_url( get_permalink() ); ?>" target="_blank" class="shos-google-plus-button">
                                    <span class="shos-icon-google-plus"></span>
                                </a>
                                <!-- END GOOGLE+ BUTTON -->

                                <!-- BEGIN LINKEDIN BUTTON -->
                                <a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url( get_permalink() ); ?>" target="_blank" class="shos-linkedin-button">
                                    <span class="shos-icon-linkedin"></span>
                                </a>
                                <!-- END LINKEDIN BUTTON -->

                                <!-- BEGIN STUMBLEUPON BUTTON -->
                                <a href="http://www.stumbleupon.com/submit?url=<?php echo esc_url( get_permalink() ); ?>&title=<?php the_title(); ?>" target="_blank" class="shos-stumbleupon-button">
                                    <span class="shos-icon-stumbleupon"></span>
                                </a>
                                <!-- END STUMBLEUPON BUTTON -->

                                <!-- BEGIN EMAIL BUTTON -->
                                <a href="mailto:?subject=<?php the_title(); ?>&body=<?php echo esc_url( get_permalink() ); ?>" class="shos-email-button">
                                    <span class="shos-icon-envelope"></span>
                                </a>
                                <!-- END EMAIL BUTTON -->

                            </div>
                            <!-- END MORE SHARE BUTTONS DROPDOWN -->
                            
                        </div>
                        <!-- END MORE SHARE BUTTONS -->
                        
                    </div>
                </div>
                <?php } ?>
            <?php } ?>
            <!-- END SHARE -->
            
        </div>
        
        <!-- BEGIN MAIN MENU -->
        <?php if ( has_nav_menu('shos-by-bonfire') ) { ?>
        <div class="shos-by-bonfire-wrapper">
            <div class="shos-by-bonfire smooth-scroll<?php if ( is_admin_bar_showing() ) { ?> wp-toolbar-active<?php } ?>">
                <?php wp_nav_menu( array( 'theme_location' => 'shos-by-bonfire', 'fallback_cb' => '' ) ); ?>
            </div>
        </div>
        <?php } ?>
        <!-- END MAIN MENU -->
        
        <!-- BEGIN HEADER BACKGROUND IMAGE -->
        <div class="shos-header-bg<?php if ( is_admin_bar_showing() ) { ?> wp-toolbar-active<?php } ?>"></div>
        <!-- END HEADER BACKGROUND IMAGE -->
        
        <!-- BEGIN HEADER BAR -->
        <div class="shos-header-bar<?php if ( is_admin_bar_showing() ) { ?> wp-toolbar-active<?php } ?>"></div>
        <!-- END HEADER BAR -->
        
        <!-- END SLIDE ANIMATION -->
        <script>
        jQuery(document).on('scroll', function(){
        'use strict';
            if( jQuery(this).scrollTop() > <?php if( get_theme_mod('shos_display_after') != '') { ?><?php echo get_theme_mod('shos_display_after'); ?><?php } else { ?>100<?php } ?>){
                jQuery('.shos-header-bar, .shos-header-bg, .shos-contents-wrapper').addClass('shos-active');
                jQuery('.shos-header-bar').addClass('shos-header-shadow');
            } else {
                jQuery('.shos-header-bar, .shos-header-bg, .shos-contents-wrapper').removeClass('shos-active');
                jQuery('.shos-header-bar').removeClass('shos-header-shadow');
                /* main menu button animation */
                jQuery('.shos-main-menu-button-wrapper').removeClass('shos-main-menu-button-active');
                /* hide main menu */
                jQuery('.shos-by-bonfire-wrapper').removeClass('shos-menu-active');
                /* close any open submenus */
                jQuery(".shos-by-bonfire .menu > li").find(".sub-menu").slideUp(300);
                jQuery(".shos-by-bonfire .menu > li > span, .shos-by-bonfire .sub-menu > li > span").removeClass("shos-submenu-active");
            }
        });
        </script>
        <!-- END SLIDE ANIMATION -->

	<?php
	}
	add_action('wp_footer','shos_footer');

	//
	// Register Custom Menu Function
	//
	if (function_exists('register_nav_menus')) {
		register_nav_menus( array(
            'shos-by-bonfire' => __('Sticky Header on Scroll', 'shos'),
		) );
	}
    
    //
	// ENQUEUE sticky-header-on-scroll.css
	//
	function shos_css() {
		wp_register_style( 'shos-css', plugins_url( '/sticky-header-on-scroll.css', __FILE__ ) . '', array(), '1', 'all' );
		wp_enqueue_style( 'shos-css' );
	}
	add_action( 'wp_enqueue_scripts', 'shos_css' );

	//
	// ENQUEUE sticky-header-on-scroll.js
	//
	function shos_js() {
		wp_register_script( 'shos-js', plugins_url( '/sticky-header-on-scroll.js', __FILE__ ) . '', array( 'jquery' ), '1', true );  
		wp_enqueue_script( 'shos-js' );
	}
	add_action( 'wp_enqueue_scripts', 'shos_js' );

    //
	// ENQUEUE jquery.scrollbar.min.js (except on touch devices)
	//
    if(get_theme_mod('shos_styled_scrollbar') != '') {
        function shos_scrollbar_js() {
            if ( wp_is_mobile() ) { } else {
                wp_register_script( 'shos-scrollbar-js', plugins_url( '/jquery.scrollbar.min.js', __FILE__ ) . '', array( 'jquery' ), '1' );  
                wp_enqueue_script( 'shos-scrollbar-js' );
            }
        }
        add_action( 'wp_enqueue_scripts', 'shos_scrollbar_js' );
    }
    
    //
	// ENQUEUE Google WebFonts
	//
    function shos_fonts_url() {
		$font_url = '';

		if ( 'off' !== _x( 'on', 'Google font: on or off', 'shos' ) ) {
			$font_url = add_query_arg( 'family', urlencode( 'Roboto:400,500,700' ), "//fonts.googleapis.com/css" );
		}
		return $font_url;
	}
	function shos_scripts() {
		wp_enqueue_style( 'shos-fonts', shos_fonts_url(), array(), '1.0.0' );
	}
	add_action( 'wp_enqueue_scripts', 'shos_scripts' );

	//
	// Insert theme customizer options into the footer
	//
	function shos_header_customize() {
	?>

		<style>
		/**************************************************************
		*** CUSTOM COLORS
		**************************************************************/
        /* header */
        <?php if( get_theme_mod('shos_header_height') != '') { ?>
        .shos-header-bar,
        .shos-header-bg,
        .shos-contents-wrapper {
            height:<?php echo get_theme_mod('shos_header_height'); ?>px;

            -webkit-transform:translateY(-<?php echo get_theme_mod('shos_header_height'); ?>px);
            -moz-transform:translateY(-<?php echo get_theme_mod('shos_header_height'); ?>px);
            transform:translateY(-<?php echo get_theme_mod('shos_header_height'); ?>px);
        }
        .shos-by-bonfire-wrapper {
            top:calc(<?php echo get_theme_mod('shos_header_height'); ?>px - 2px);
        }
        <?php } ?>
        .shos-header-bg {
            background-image:url('<?php echo get_theme_mod('shos_header_bg_image'); ?>');
            opacity:<?php echo get_theme_mod('shos_header_bg_image_opacity'); ?> !important;
            <?php if( get_theme_mod('shos_header_bg_image_cover') != '') { ?>
            background-size:cover;
            background-repeat:no-repeat;
            background-position:top left;
            <?php } ?>
        }
        .shos-header-bar {
            background-color:<?php echo get_theme_mod('shos_header_color'); ?>;
            opacity:<?php echo get_theme_mod('shos_header_opacity'); ?>;
        }
        /* shadow */
        .shos-header-shadow {
            -webkit-box-shadow:0px 0px 5px 0px rgba(0,0,0,0.5);
            -moz-box-shadow:0px 0px 5px 0px rgba(0,0,0,0.5);
            box-shadow:0px 0px 5px 0px rgba(0,0,0,0.5);
        }
        
        /* logo size */
        .shos-logo-wrapper .shos-logo-inner img { height:<?php echo get_theme_mod('shos_logo_height'); ?>px; }
        /* logo colors */
        .shos-logo-wrapper a { color:<?php echo get_theme_mod('shos_logo_color'); ?>; }
        .shos-logo-wrapper a:hover { color:<?php echo get_theme_mod('shos_logo_hover_color'); ?>; }
        
        /* dividers color */
        .shos-main-menu-button-inner,
        .shos-post-title-inner { border-color:<?php echo get_theme_mod('shos_divider_color'); ?>; }
        .shos-next-post-inner a::before { background-color:<?php echo get_theme_mod('shos_divider_color'); ?>; }
        /* hide dividers */
        <?php if( get_theme_mod('shos_hide_dividers') != '') { ?>
        .shos-main-menu-button-inner,
        .shos-post-title-inner { border-color:transparent; }
        <?php } ?>
        
        /* main menu button */
        .shos-main-menu-button:before,
        .shos-main-menu-button div.shos-main-menu-button-middle:before,
        .shos-main-menu-button:after {
            background-color:<?php echo get_theme_mod('shos_main_menu_button_color'); ?>;
        }
        .shos-main-menu-button-wrapper:hover .shos-main-menu-button:before,
        .shos-main-menu-button-wrapper:hover .shos-main-menu-button div.shos-main-menu-button-middle:before,
        .shos-main-menu-button-wrapper:hover .shos-main-menu-button:after,
        .shos-main-menu-button-active .shos-main-menu-button:before,
        .shos-main-menu-button-active .shos-main-menu-button div.shos-main-menu-button-middle:before,
        .shos-main-menu-button-active .shos-main-menu-button:after {
            background-color:<?php echo get_theme_mod('shos_main_menu_button_hover_color'); ?>;
        }
        
        /* main menu button label */
        .shos-main-menu-button-inner::before {
            content:'<?php echo get_theme_mod('shos_menu_button_label'); ?>';
            color:<?php echo get_theme_mod('shos_main_menu_button_label_color'); ?>;
        }
        .shos-main-menu-button-wrapper:hover .shos-main-menu-button-inner::before,
        .shos-main-menu-button-active .shos-main-menu-button-inner::before {
            color:<?php echo get_theme_mod('shos_main_menu_button_label_hover_color'); ?>;
        }
        /* if menu button label entered, move menu button up a little bit to make room for label */
        <?php if( get_theme_mod('shos_menu_button_label') != '') { ?>
        .shos-main-menu-button:before,
        .shos-main-menu-button div.shos-main-menu-button-middle:before,
        .shos-main-menu-button:after { top:-5px; }
        <?php } ?>
        
        /* main menu */
        .shos-by-bonfire-wrapper {
            max-width:<?php echo get_theme_mod('shos_menu_max_width'); ?>px;
            max-height:<?php echo get_theme_mod('shos_menu_max_height'); ?>px;
        }
        .shos-by-bonfire { background-color:<?php echo get_theme_mod('shos_main_menu_background_color'); ?>; }
        .shos-by-bonfire::before { border-bottom-color:<?php echo get_theme_mod('shos_main_menu_background_color'); ?>; }
        .shos-by-bonfire ul.sub-menu { background-color:<?php echo get_theme_mod('shos_submenu_background_color'); ?>; }
        .shos-by-bonfire ul li a { color:<?php echo get_theme_mod('shos_main_menu_color'); ?>; }
        .shos-by-bonfire ul li a:hover { color:<?php echo get_theme_mod('shos_main_menu_hover_color'); ?>; }
        .shos-by-bonfire .sub-menu a { color:<?php echo get_theme_mod('shos_submenu_color'); ?>; }
        .shos-by-bonfire .sub-menu a:hover { color:<?php echo get_theme_mod('shos_submenu_hover_color'); ?>; }
        .shos-by-bonfire .menu > li,
        .shos-by-bonfire ul.sub-menu > li:first-child { border-color:<?php echo get_theme_mod('shos_main_menu_divider_color'); ?>; }
        .shos-by-bonfire ul li ul li:after { background-color:<?php echo get_theme_mod('shos_submenu_divider_color'); ?>; }
        
        /* dropdown expand separator */
		.shos-by-bonfire .menu li span { border-left-color:<?php echo get_theme_mod('shos_expand_icon_separator_color'); ?>; }
		/* dropdown expand icon */
		.shos-by-bonfire .shos-sub-arrow-inner:before,
        .shos-by-bonfire .shos-sub-arrow-inner:after { background-color:<?php echo get_theme_mod('shos_expand_icon_color'); ?>; }
		/* dropdown expand icon hover (on non-touch devices only) */
		<?php if ( !wp_is_mobile() ) { ?>
        .shos-by-bonfire .shos-sub-arrow:hover .shos-sub-arrow-inner::before,
        .shos-by-bonfire .shos-sub-arrow:hover .shos-sub-arrow-inner::after { background-color:<?php if( get_theme_mod('shos_expand_icon_hover_color') != '') { ?><?php echo get_theme_mod('shos_expand_icon_hover_color'); ?><?php } else { ?>#777<?php } ?>; }
        <?php } ?>

        /* dropdown expand separator (sub-menu) */
		.shos-by-bonfire .sub-menu li span { border-left-color:<?php echo get_theme_mod('shos_submenu_expand_icon_separator_color'); ?>; }
		/* dropdown expand icon (sub-menu) */
        .shos-by-bonfire .sub-menu li .shos-sub-arrow-inner:before,
        .shos-by-bonfire .sub-menu li .shos-sub-arrow-inner:after { background-color:<?php echo get_theme_mod('shos_submenu_expand_icon_color'); ?>; }
		/* dropdown expand icon hover (sub-menu, on non-touch devices only) */
		<?php if ( !wp_is_mobile() ) { ?>
        .shos-by-bonfire .sub-menu li .shos-sub-arrow:hover .shos-sub-arrow-inner:before,
        .shos-by-bonfire .sub-menu li .shos-sub-arrow:hover .shos-sub-arrow-inner:after { background-color:<?php echo get_theme_mod('shos_submenu_expand_icon_hover_color'); ?>; }
        <?php } ?>

        /* scrollbar styling */
        .shos-by-bonfire > .scroll-element .scroll-bar { background-color:<?php echo get_theme_mod('shos_scrollbar_color'); ?>; }
        .shos-by-bonfire > .scroll-element .scroll-element_track { background-color:<?php echo get_theme_mod('shos_scrollbar_background_color'); ?>; }

        /* post title + prefix */
        .shos-post-title-inner span { color:<?php echo get_theme_mod('shos_post_title_prefix_color'); ?>; }
        .shos-post-title-inner h2 { color:<?php echo get_theme_mod('shos_post_title_color'); ?>; }
        
        /* share buttons */
        .shos-share-inner .shos-more-share-button { background-color:<?php echo get_theme_mod('shos_more_share_buttons_color'); ?>; }
        /* if share buttons hidden, hide 'next post' button divider */
        <?php if( get_theme_mod('shos_hide_share_buttons') != '') { ?>
        .shos-next-post-inner a::before { display:none; }
        <?php } ?>
        
        /* next button */
        .shos-next-post-inner a {
            color:<?php echo get_theme_mod('shos_next_button_color'); ?>;
            background-color:<?php echo get_theme_mod('shos_next_button_background_color'); ?>;
        }
        .shos-next-post-inner a:hover {
            color:<?php echo get_theme_mod('shos_next_button_color'); ?>;
        }
        
        /* hide post title at lower resolutions */
		@media ( max-width:950px ) {
            .shos-post-title-wrapper { display:none; }
		}
        
        /* hide 'next' button at lower resolutions */
		@media ( max-width:650px ) {
            .shos-next-post-wrapper { display:none; }
            /* make share buttons smaller */
            .shos-share-wrapper .shos-share-label { display:none; }
            .shos-share-inner .shos-facebook-button {
                padding-left:17px;
                padding-right:12px;
            }
            .shos-share-inner .shos-twitter-button { padding-right:14px; }
            .shos-share-inner .shos-icon-twitter { margin-right:2px; }
		}
        
        /* if slim design enabled */
        <?php if( get_theme_mod('shos_slim_design') != '') { ?>
        /* height */
        .shos-header-bar,
        .shos-header-bg,
        .shos-contents-wrapper { height:50px; }
        /* no padding for dividers */
        .shos-post-title-wrapper,
        .shos-main-menu-button-wrapper { padding:0; }
        /* menu button */
        .shos-main-menu-button-wrapper { width:53px; }
        /* logo */
        .shos-logo-wrapper .shos-logo-inner { padding:0 10px; }
        /* dropdown menu distance */
        .shos-by-bonfire-wrapper { top:48px; }
        /* menu button background */
        .shos-main-menu-button-inner {
            background-color:<?php echo get_theme_mod('shos_main_menu_button_bg_color'); ?>;
            border-right-color:<?php echo get_theme_mod('shos_main_menu_button_bg_color'); ?>;
        }
        .shos-main-menu-button-wrapper:hover .shos-main-menu-button-inner,
        .shos-main-menu-button-active .shos-main-menu-button-inner {
            background-color:<?php echo get_theme_mod('shos_main_menu_button_bg_hover_color'); ?>;
            border-right-color:<?php echo get_theme_mod('shos_main_menu_button_bg_hover_color'); ?>;
        }
        /* social and next buttons padding */
        <?php if( get_theme_mod('shos_hide_next_post_button') != '') { ?>.shos-share-wrapper { margin-right:-6px; }<?php } ?>
        .shos-next-post-inner a { margin-right:7px; }
        <?php } ?>
        
		/* hide Sticky Header on Scroll between resolutions */
		@media ( min-width:<?php echo get_theme_mod('shos_smaller_than'); ?>px) and (max-width:<?php echo get_theme_mod('shos_larger_than'); ?>px) {
			.shos-contents-wrapper,
            .shos-header-bar,
            .shos-by-bonfire-wrapper { display:none; }
		}
        
        /* hide theme header */
		<?php if( get_theme_mod('shos_hide_theme_header') != '') { ?>
            <?php echo get_theme_mod('shos_hide_theme_header'); ?> { display:none !important; }
		<?php } ?>
		</style>
		<!-- END CUSTOM COLORS (WP THEME CUSTOMIZER) -->
	
	<?php
	}
	add_action('wp_footer','shos_header_customize');

?>