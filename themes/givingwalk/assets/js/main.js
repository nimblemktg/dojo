/**
 * @package SpyroPress
 * @subpackage Giving Walk
 * @since 1.0.0
*/
jQuery(document).ready(function($) {
    "use strict";
    /* window */
    var window_width, window_height, scroll_top;
    var red_responsiveRefreshRate = 200;
    /* admin bar */
    var adminbar = $('#wpadminbar'),
        adminbar_height = 0;
    /* Loading */
    var loading_page = $('#red-loading'),
        loading_page_h = 0;
    /* rev before header */
    var rev_before_header = $('.red-header-rev-slider'),
        rev_before_header_h = 0;
    /* header top */
    var  header_top = $('#red-header-top'),
         header_top_height = 0;
    /* header menu */
    var header = $('#red-header'),
        header_height;
    /* Header v2 */
    var header_inner = $('#red-header .red-header-inner'),
        red_logo = $('#red-header-logo'),
        red_navigation_left = $('#red-navigation-left'),
        red_navigation_right = $('#red-navigation-right'),
        red_navigation_attr = $('#red-header .red-nav-extra'),
        center_menu = $('#red-navigation.pull-center .red-main-navigation > ul'),
        header_inner_w,
        red_logo_w, 
        red_navigation_left_width, 
        red_navigation_right_width, 
        red_navigation_attr_width,
        center_menu_w;
    /* Boxed */
    var body = $('body'),
        body_padding_left,
        body_padding_right,
        boxed = $('#red-page.red-boxed'),
        boxed_w,
        boxed_row = boxed.find('.vc_row[data-vc-stretch-content]'),
        boxed_row_padding;
    /* scroll status */
    var scroll_status = '';

    /**
     * window load event.
     * 
     * Bind an event handler to the "load" JavaScript event.
     * @author Red Team
     */
    $(window).on('load', function() {
        /** current scroll */
        scroll_top = $(window).scrollTop();

        /** current window width */
        window_width = window.innerWidth;

        /** current window height */
        window_height = window.innerHeight;

        /* get admin bar height */
        adminbar_height = adminbar.length > 0 ? adminbar.outerHeight(true) : 0 ;
        /* get loading height */
        loading_page_h = loading_page.length > 0 ? loading_page.outerHeight(true) : 0 ;
        /* rev before header */
        rev_before_header_h = rev_before_header.length > 0 ? rev_before_header.outerHeight() : 0;
        /* Header Top */
        header_top_height = header_top.length   > 0 ?  header_top.outerHeight() : 0;
        /* Header */
        header_height = header.length   > 0 ?  header.outerHeight() : 0;
        /* Header V2 */
        header_inner_w = header_inner.length > 0 ? header_inner.innerWidth() : 0;
        red_logo_w = red_logo.length > 0 ? red_logo.outerWidth() : 0;
        red_navigation_left_width = red_navigation_left.length > 0 ? red_navigation_left.outerWidth() : 0;
        red_navigation_right_width = red_navigation_right.length > 0 ? red_navigation_right.outerWidth() : 0;
        red_navigation_attr_width = red_navigation_attr.length > 0 ? red_navigation_attr.outerWidth() : 0;
        center_menu_w = center_menu.length > 0 ? center_menu.innerWidth() : 0;
        /* Custom VC row */
        body_padding_left = parseInt(body.css('padding-left'));
        body_padding_right = parseInt(body.css('padding-right'));
        boxed_w = boxed.outerWidth();
        boxed_row_padding = parseInt(boxed_row.css('left')) * -1;
        red_custom_vc_row_stretch_content();
        /* Page Loading */
        red_page_loading();
 

        /* Header OnTop */
        red_header_ontop();
        red_header_ontop_next();
        /* Header Sticky */
        red_header_sticky();
        /* Mobile Menu */
        red_mobile_menu();
        red_join_mobile_menu();
        red_header_right_width();
        red_animation();
        red_overlay();
        red_link_color();
        /* Media embed */
        red_auto_video_width();
        /* WooCommerce */
        givingwalk_wc_archive_layout();

        red_blog_masonry();

        
 
    });

    /**
     * reload event.
     * 
     * Bind an event handler to the "navigate".
     */
    window.onbeforeunload = function(){
        red_page_loading(1);
    };
    
    /**
     * resize event.
     * 
     * Bind an event handler to the "resize" JavaScript event, or trigger that event on an element.
     * @author Red Team
     */
    var red_resize_menu_event ;
    $(window).on('resize', function(event, ui) {
        clearTimeout(red_resize_menu_event);
        red_resize_menu_event = setTimeout(function () {
            /** current window width */
            window_width = window.innerWidth;
            /** current window height */
            window_height = $(window).height();
            /* get admin bar height */
            adminbar_height = adminbar.length > 0 ? adminbar.outerHeight(true) : 0 ;
            /* get loading height */
            loading_page_h = loading_page.length > 0 ? loading_page.outerHeight(true) : 0 ;
            /* rev before header */
            rev_before_header_h = rev_before_header.length > 0 ? rev_before_header.outerHeight() : 0;
            /* Header Top */
            header_top_height = header_top.length   > 0 ?  header_top.outerHeight() : 0;

            /* Header */
            header_height = header.length   > 0 ?  header.outerHeight() : 0;
            /* Header V2 */
            header_inner_w = header_inner.length > 0 ? header_inner.innerWidth() : 0;
            red_logo_w = red_logo.length > 0 ? red_logo.outerWidth() : 0;
            red_navigation_left_width = red_navigation_left.length > 0 ? red_navigation_left.outerWidth() : 0;
            red_navigation_right_width = red_navigation_right.length > 0 ? red_navigation_right.outerWidth() : 0;
            red_navigation_attr_width = red_navigation_attr.length > 0 ? red_navigation_attr.outerWidth() : 0;
            center_menu_w = center_menu.length > 0 ? center_menu.innerWidth() : 0;
            /** current scroll */
            scroll_top = $(window).scrollTop();
            /* Custom VC row */
            body_padding_left = parseInt(body.css('padding-left'));
            body_padding_right = parseInt(body.css('padding-right'));
            boxed_w = boxed.outerWidth();
            boxed_row_padding = parseInt(boxed_row.css('left'));
            red_custom_vc_row_stretch_content();
            /* Header OnTop */
            red_header_ontop();
            /* Header Sticky */
            red_header_sticky();


            /* Mobile Menu */
            red_mobile_menu();
            red_join_mobile_menu();
            red_header_right_width();

            /* Media embed */
            red_auto_video_width();

        },red_responsiveRefreshRate);
    });
    
    /**
     * scroll event.
     * 
     * Bind an event handler to the "scroll" JavaScript event, or trigger that event on an element.
     * @author Red Team
     */
    $(window).on('scroll', function() {
        /** current scroll */
        scroll_top = $(window).scrollTop();

        /* check sticky menu. */
        red_header_sticky();

        /* Back to top */
        red_back_to_top();
    });
    /**
     * Page Loading.
     */
    function red_page_loading($load) {
        switch ($load) {
        case 1:
            $('#red-loading').css('{"height":"100vh"}');
            $('#red-page').css({"visibility":"hidden"});
            break;
        default:
            $('#red-loading').css({"height":"0","visibility":"hidden"});
            $('#red-page').css({"visibility":"visible"});
            break;
        }
    }
 
     
    $('#red-post-gallery').carousel({
        interval: 5000
    });
    
    /* Custom a tag regular/hover/active color
     * This function just applied for a tag
     * @author Red Team
     * @since 1.0.0
    */
    function red_link_color(){
        "use strict";
        $('body').find('a').each(function(){
            var $this = $(this),
                $filter = $('.red-filter-category');
            if($this.attr('data-color')){
                var regular_color   = $(this).data('color'),
                    hover_color     = $(this).data('color-hover'),
                    active_color    = hover_color;
                $(this).css('color',regular_color);
                $this.on('mouseenter',function(e){
                    e.preventDefault();
                    $(this).css('color',hover_color);
                });
                $this.on('mouseleave',function(e){
                    e.preventDefault();
                    $(this).not('.active').css('color',regular_color);
                });
                if($this.hasClass('active')){
                    $(this).css('color', active_color);
                };
                $this.on('click',function(){
                   $filter.find('a').css('color',regular_color);
                   $(this).css('color', active_color);
                });
            }
        });
    }

    /** Header On Top
     * add TOP position for header on top
     * @author Red Team
     * @since 1.0.0
    */
    
    function red_header_ontop(){
        var header_ontop = $('.header-ontop'),
            header_ontop_next = $('#red-page-title-wrapper'),
            header_ontop_next_padding_top = parseInt(header_ontop_next.css('padding-top'));
        header_ontop.css('top', adminbar_height + header_top_height); 
    }
    function red_header_ontop_next(){
        var header_ontop = $('.header-ontop'),
            header_ontop_next = header_ontop.next('#red-page-title-wrapper'),
            header_ontop_next_padding_top = parseInt(header_ontop_next.css('padding-top'));
        header_ontop_next.css('padding-top', adminbar_height + header_ontop_next_padding_top); /* Add padding for next section */
    }

    /** Sticky menu
     * Show or hide sticky menu.
     * @author Red Team
     * @since 1.0.0
     */
    function red_header_sticky() {
        var header_sticky = $('.header-sticky'),
            header_ontop  = $('.header-ontop'), 
            header_slider = $('.red-header-rev-slider').outerHeight();
        if (header.hasClass('sticky-on') && (header_height + header_slider  < scroll_top) && window_width >= 1200) {
            header.addClass('header-sticky').removeClass('header-default');
            header_sticky.css('top',adminbar_height);
        } else {
            header.removeClass('header-sticky').addClass('header-default');
            header_sticky.removeAttr('style');
        }

        /* Both Ontop & Sticky is ENABLE */
        if (header.hasClass('header-ontop-sticky') && (header_height + header_slider  < scroll_top) && window_width >= 1200) {
            header.removeClass('header-ontop');
        } else if(header.hasClass('header-ontop-sticky')){
            header.removeClass('header-sticky').addClass('header-ontop');
            header_sticky.css('top', adminbar_height + header_top_height);
        }   

        /* sticky mobile */
        if (header.hasClass('sticky-mobile-on') && (header_height + header_slider  < scroll_top) && window_width < 1200) {
            header.addClass('header-sticky').removeClass('header-default');
            header_sticky.css('top',adminbar_height);
            if(window_width <= 600){
                header_sticky.css('top',0);
            }
        } 
    }
    /* check mobile screen. */
    function red_mobile_menu() {
        if (window_width < 1200) {
            /* Default Header */
            $('div.red-main-navigation').addClass('mobile-nav').removeClass('desktop-nav');
        } else {
            /* Default Header */
            $('div.red-main-navigation').removeClass('mobile-nav').addClass('desktop-nav').removeAttr('style');
        }
    }
    /** Menu right
     * add width for menu area when Menu right has extra attribute (search, cart, ...)
     * @author Red Team
     * @since 1.0.0
     */
    function red_header_right_width() {
        if (window_width >= 1200){
            //red_navigation_right.css('width', header_inner_w - red_navigation_left_width - red_logo_w - red_navigation_attr_width);
            //$('#red-navigation').css('width', header_inner_w - red_logo_w - red_navigation_attr_width - 2);
        } else { 
            //red_navigation_right.css('width','');
            //$('#red-navigation').css('width','');
        }
    }
    /**
     * Header 2 menu
    */
    function red_join_mobile_menu() {
        var menu = $('#red-navigation');

        if (window_width <= 1200) {
            /* Add mobile menu for Header V2 */
            var $mainmenu_left = $('#red-navigation-left .red-menu-left');
            var $mainmenu_right = $('#red-navigation-right .red-menu-right');
            var $mobilemenu_1 = $mainmenu_left.clone();
            var $mobilemenu_2 = $mainmenu_right.clone();
            //if ($('#red-navigation .red-main-navigation').length == 0) {
                $mobilemenu_1.appendTo('#red-navigation .red-main-navigation');
                $mobilemenu_2.appendTo('#red-navigation .red-main-navigation');
            //}
            $('#red-navigation-left').addClass('d-none');
            $('#red-navigation-right').addClass('d-none');
            $('#red-navigation-left ul.red-menu-left').remove();
            $('#red-navigation-right ul.red-menu-right').remove();
        } else {
            /* Callback Menu Left */
            var $mainmenu_left = $('#red-navigation .red-menu-left');
            var $mobilemenu_1 = $mainmenu_left.clone();
            $mobilemenu_1.appendTo('#red-navigation-left div.red-main-navigation');
            $('#red-navigation-left').removeClass('d-none');
            /* Callback Menu Right */
            var $mainmenu_right = $('#red-navigation .red-menu-right');
            var $mobilemenu_2 = $mainmenu_right.clone();
            $('#red-navigation-right').removeClass('d-none');
            $mobilemenu_2.appendTo('#red-navigation-right div.red-main-navigation');
            /* Remove joined Left/Right Menu */
            $('.join-menu .red-main-navigation').empty();
        }
    }
    /**
     * Scroll page 
     * @author Red Team
    */
    $('body').on('click', '.red-scroll, .woocommerce-review-link, .is-one-page', function () {
        var target = $(this.hash),
            offset = $('.header-sticky').innerHeight();
        target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
        if (target.length) {
            $('html,body').animate({scrollTop: target.offset().top}, 750);
            return false;
        }
    });

    if($('.red-page-title-text')[0]){
        var page_title = $('.red-page-title-text').html();
        var sb_arr = page_title.split(' ');
        if(sb_arr.length > 1){
            var sb_arr0 = sb_arr.slice(0,1);
            var sb_arr1 = sb_arr.slice(1,sb_arr.length);
            $('.red-page-title-text').html(sb_arr0 + ' <span class="red-text-primary">' + sb_arr1.join(' ')+ '</span>');
        }
    }

    if($('.volunteer-form')[0]){
        $('.volunteer-form .volunteer-subject').val($('.single-title').html());
    }
    
    /* Show or hide Back to TOP  */
    function red_back_to_top(){
        if (scroll_top < window_height) {
            $('.red-backtotop').removeClass('on');;
        } else {
            $('.red-backtotop').addClass('on');
        }
    }

    /**
    * header icon popup
    * 
    * @author Red Team
    * @since 1.0.0
    */
    var display;
    var no_display; 
    $('body').on('click',function (e) {
        var target = $(e.target);
        if (target.parents('.red-tools').length == 0 && !target.hasClass('cms-search')) {
            $('.red-search,.red-cart,.red-tools').removeClass('open').slideUp();
            $('.red-sidebar-menu').removeClass('open');
            $('.red-body').removeClass('red-sidebar-menu-open');
            $('.header-icon').removeClass('active');
        }
    });
    
    $('.red-search,.red-cart,.red-tools, .mobile-nav').on('click', function (e) {
        e.stopPropagation();
    });

    $('.red-header-popup [data-display]').on('click', function (e) {
        var container = $(this).parents('#red-header');
        var sidebar_menu_container = $(this).parents('.red-body');
        $(this).parents().find('.mobile-nav').slideUp();
        $(this).toggleClass('active');
        e.stopPropagation();
        
        var _this = $(this);
        display = _this.attr('data-display');
        no_display = _this.attr('data-no-display');
        if ($(display, container).hasClass('open')) {
            $(display, container).removeClass('open').slideUp();
        } else {
            $(display, container).addClass('open').slideDown().css('display', 'block');
            $(no_display, container).removeClass('open').slideUp();
        }
    });
    $('.red-header-popup [data-display=".red-sidebar-menu"]').on('click', function (e) {
        var container = $(this).parents('#red-header');
        var sidebar_menu_container = $(this).parents('.red-body');
        $(this).parents().find('.mobile-nav').slideUp();
        e.stopPropagation();
        
        var _this = $(this);
        display = _this.attr('data-display');
        no_display = _this.attr('data-no-display');
        if ($(sidebar_menu_container).hasClass('red-sidebar-menu-open')) {
            sidebar_menu_container.removeClass('red-sidebar-menu-open');
            $(display, sidebar_menu_container).removeClass('open');
        } else {
            sidebar_menu_container.addClass('red-sidebar-menu-open');
            sidebar_menu_container.find('> .red-sidebar-menu').addClass('open');
            $(no_display, container).removeClass('open').slideUp();
        }
    });
    
    $('.red-header-popup .header-icon').on('click', function(){
        $('.red-popup .red-searchform .s').focus();
    });

    $(".tnp-email").attr("placeholder", CMSOptions.email_placeholder);
    $(".tnp-firstname").attr("placeholder", CMSOptions.name_placeholder); 
    /* Add Animation 
     * add class animated to use animate.css
    */
    function red_animation(){
        "use strict";
        $(".animated-wrap").each(function(){
            var $this = $(this);
            var animation_in = $this.find('.animated').data('item-animation-in'),
                animation_out = $this.find('.animated').data('item-animation-out');
            $this.on('mouseenter',function(e){
                e.preventDefault();
                $this.find('.animated').addClass(animation_in);
            });
            $this.on('mouseleave',function(e){
                e.preventDefault();
                $this.find('.animated').removeClass(animation_in);
            });
        });
    }
    /* Add overlay effect
     * add class animated to use animate.css
    */
    function red_overlay(){
        "use strict";
        $(".overlay-wrap").each(function(){
            var $this = $(this);
            var animation_in = $this.find('.overlay').data('item-animation-in'),
                animation_out = $this.find('.overlay').data('item-animation-out');
            $this.css({'position':'relative'});
            $this.on('mouseenter',function(e){
                e.preventDefault();
                $this.find('.overlay').addClass(animation_in).removeClass(animation_out);
            });
            $this.on('mouseleave',function(e){
                e.preventDefault();
                $this.find('.overlay').removeClass(animation_in).addClass(animation_out);
            });
        });
    }
    /**
     * Media Embed dimensions
     * 
     * Youtube, Vimeo, Iframe, Video, Audio.
     * @author Red Team
     */
    function red_auto_video_width() {
        $('.entry-media iframe , .entry-media  video,.entry-media .wp-video, .entry-media .wp-video-shortcode').each(function(){
            var v_width = $(this).parent().width();
            var v_height = Math.floor(v_width / (16/9));
            $(this).attr('width',v_width).css('width',v_width);
            $(this).attr('height',v_height).css('height',v_height);
        });
    }

    /**
     * Custom VC row stretch content 
     * Fix RTL language for VC row full width
     * @author Red Team
     * @since 1.0.0
     */
    function red_custom_vc_row_stretch_content() {
        var rtl = $('html[dir="rtl"]'),
            css_attr = parseInt(rtl.find('.vc_row[data-vc-full-width]').css('left'));
        /* Boxed Layout */
        boxed_row.css({'padding-left': boxed_row_padding, 'padding-right': boxed_row_padding});
        boxed_row.find('.rev_slider_wrapper.fullwidthbanner-container').css({'width': boxed_w});
        /* RTL Language */
        if (rtl) {
            rtl.find('.vc_row[data-vc-full-width]').css({'right': css_attr, 'left': ''});
        }
    }
    
    /* Ajax Complete */
    jQuery(document).ajaxComplete(function(event, xhr, settings){
        red_animation();
        red_overlay();
        red_custom_vc_row_stretch_content();
    });
});

function red_blog_masonry(){
    if(jQuery('.content-layout-mask-masonry')[0]){
        var container = document.querySelector('.content-layout-mask-masonry');
        var msnry = new Masonry( container, {
            itemSelector: '.col-lg-6',
            columnWidth: '.col-lg-6',                
        });  
    }
}
/**
 * WC Switch view 
 * add swith view grid/list layout 
*/
function givingwalk_wc_archive_layout(){
    jQuery('.wc-archive-switch-view #grid').on('click',function(){
        jQuery(this).addClass('active');
        jQuery('.wc-archive-switch-view #list').removeClass('active');
        jQuery.cookie('gridcookie','grid', { path: '/' });
        jQuery('ul.products').fadeOut(300, function() {
            jQuery(this).addClass('grid').removeClass('list').fadeIn(300);
            jQuery(this).find('.woocommerce-product-details__short-description').hide();
        });
        return false;
    });

    jQuery('.wc-archive-switch-view #list').on('click',function(){
        jQuery(this).addClass('active');
        jQuery('.wc-archive-switch-view #grid').removeClass('active');
        jQuery.cookie('gridcookie','list', { path: '/' });
        jQuery('ul.products').fadeOut(300, function() {
            jQuery(this).removeClass('grid').addClass('list').fadeIn(300);
            jQuery(this).find('.woocommerce-product-details__short-description').show();
        });
        return false;
    });

    if (jQuery.cookie('gridcookie')) {
        jQuery('ul.products, .wc-archive-switch-view').addClass(jQuery.cookie('gridcookie'));
    }

    if (jQuery.cookie('gridcookie') == 'grid') {
        jQuery('.wc-archive-switch-view  #grid').addClass('active');
        jQuery('.wc-archive-switch-view  #list').removeClass('active');
    }

    if (jQuery.cookie('gridcookie') == 'list') {
        jQuery('.wc-count-order-wrap').next().find('ul.products.grid').removeClass('grid');
        jQuery('.wc-archive-switch-view  #list').addClass('active');
        jQuery('.wc-archive-switch-view  #grid').removeClass('active');
    }

    jQuery('.wc-archive-switch-view a').on('click',function(event){
        event.preventDefault();
    });
}


/*jshint eqnull:true */
/*!
 * jQuery Cookie Plugin v1.2
 * https://github.com/carhartl/jquery-cookie
 *
 * Copyright 2011, Klaus Hartl
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.opensource.org/licenses/GPL-2.0
 */
!function (e, o, t) {
    function n(e) {
        return e
    }

    function i(e) {
        return decodeURIComponent(e.replace(r, " "))
    }

    var r = /\+/g;
    e.cookie = function (t, r, c) {
        if (void 0 !== r && !/Object/.test(Object.prototype.toString.call(r))) {
            if (c = e.extend({}, e.cookie.defaults, c), null === r && (c.expires = -1), "number" == typeof c.expires) {
                var u = c.expires, a = c.expires = new Date;
                a.setDate(a.getDate() + u)
            }
            return r = String(r), o.cookie = [encodeURIComponent(t), "=", c.raw ? r : encodeURIComponent(r), c.expires ? "; expires=" + c.expires.toUTCString() : "", c.path ? "; path=" + c.path : "", c.domain ? "; domain=" + c.domain : "", c.secure ? "; secure" : ""].join("")
        }
        for (var p, s = (c = r || e.cookie.defaults || {}).raw ? n : i, l = o.cookie.split("; "), f = 0; p = l[f] && l[f].split("="); f++)if (s(p.shift()) === t)return s(p.join("="));
        return null
    }, e.cookie.defaults = {}, e.removeCookie = function (o, t) {
        return null !== e.cookie(o, t) && (e.cookie(o, null, t), !0)
    }
}(jQuery, document);


/* Menu */
(function ($) {
    "use strict";
    $(document).ready(function(){
        $(window).on('load', function () {
            red_menu_touched_side();
        });
        $(window).on('resize', function (event, ui) {
            red_menu_touched_side();
        });
        function red_menu_touched_side(){
            var $menu = $('.main-nav');
            if($(window).width() > 1200 ){
                $menu.find('li').each(function(){
                    var $submenu = $(this).find('> .sub-menu');
                    if($submenu.length > 0){
                        if($submenu.offset().left + $submenu.outerWidth() > $(window).innerWidth()){
                            $submenu.addClass('back');
                        } else if($submenu.offset().left < 0){
                            $submenu.addClass('back');
                        }
                        /* remove style from mobile to desktop menu */
                        //$submenu.attr('style','');
                    }            
                });
            }
        }
        /* Menu drop down */
        $('.red-main-navigation li.menu-item-has-children > a').after('<span class="red-menu-toggle" onclick=""><i class="fa fa-angle-right"></i></span>');
        $('.red-menu-toggle').live('click', function(){
            menu_click($(this));
        });
        function menu_click(target) {
            var grand =  target.parents('.red-main-navigation');
            var ignore = [];
            ignore.push(target[0]);
            target.parents('.sub-menu').each(function () {
                if($(this).prev().hasClass('red-menu-toggle'))
                    ignore.push($(this).prev()[0]);
            });
            grand.find('.red-menu-toggle').each(function () {
                if(ignore.indexOf(this) !== -1)
                    return;
                deactive_menu($(this));
            });
            var icon = target.find('.fa');
            var is_downed = (icon.hasClass('fa-angle-down')) ? true : 0;
            if(!is_downed)
                active_menu(target);
            else
                deactive_menu(target);

        }
        function deactive_menu(target) {
            target.next('.sub-menu').slideUp();
            target.find('.fa').removeClass('fa-angle-right fa-angle-down').addClass('fa-angle-right');
        }
        function active_menu(target) {
            target.next('.sub-menu').slideDown();
            target.find('.fa').addClass('fa-angle-down').removeClass('fa-angle-right');
        }
    });

})(jQuery);