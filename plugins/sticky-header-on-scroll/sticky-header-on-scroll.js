// BEGIN SHOW/HIDE MAIN MENU
jQuery('.shos-main-menu-button-wrapper').on('click', function(e) {
'use strict';
e.preventDefault();
    if(jQuery('.shos-main-menu-button-wrapper').hasClass('shos-main-menu-button-active'))
    {
        /* de-animate main menu button */
        jQuery('.shos-main-menu-button-wrapper').removeClass('shos-main-menu-button-active');
        /* hide main menu */
        jQuery('.shos-by-bonfire-wrapper').removeClass('shos-menu-active');

            /* close any open submenus */
        jQuery(".shos-by-bonfire .menu > li").find(".sub-menu").slideUp(300);
        jQuery(".shos-by-bonfire .menu > li > span, .shos-by-bonfire .sub-menu > li > span").removeClass("shos-submenu-active");
    } else {
        /* animate main menu button */
        jQuery('.shos-main-menu-button-wrapper').addClass('shos-main-menu-button-active');
        /* show main menu */
        jQuery('.shos-by-bonfire-wrapper').addClass('shos-menu-active');
    }
});
// END SHOW/HIDE MAIN MENU
    
// BEGIN MENU BUTTON FUNCTIONALITY
jQuery(function() {
'use strict';

    /* hide menu when clicked outside of it */
    jQuery(window).on('click touchend', function(e) {
        /* hide accordion menu */
        jQuery('.shos-main-menu-button-wrapper').removeClass('shos-main-menu-button-active');
        /* hide main menu */
        jQuery('.shos-by-bonfire-wrapper').removeClass('shos-menu-active');
        /* close any open submenus */
        jQuery(".shos-by-bonfire .menu > li").find(".sub-menu").slideUp(300);
        jQuery(".shos-by-bonfire .menu > li > span, .shos-by-bonfire .sub-menu > li > span").removeClass("shos-submenu-active");
    });  
    jQuery('.shos-main-menu-button-wrapper, .shos-by-bonfire-wrapper').on('click touchend', function(e) {
        e.stopPropagation();
    });
 
});
// END MENU BUTTON FUNCTIONALITY


// BEGIN SOCIAL BUTTON FUNCTIONALITY
jQuery(".shos-more-share-button-inner").on('click', function(e) {        
    jQuery('.shos-more-buttons-wrapper').toggleClass('shos-more-buttons-wrapper-active');
    jQuery('.shos-facebook-button, .shos-twitter-button').toggleClass('shos-hide-social');
});
// END SOCIAL BUTTON FUNCTIONALITY

// BEGIN CONVERTING DEFAULT WP MENU TO A SLIDE-DOWN ONE
jQuery(document).ready(function (jQuery) {
'use strict';
    /* add sub-menu arrow */
    jQuery('.shos-by-bonfire ul li ul').before(jQuery('<span class="shos-sub-arrow"><span class="shos-sub-arrow-inner"></span></span>'));

    /* accordion */
    jQuery(".shos-by-bonfire .menu > li > span, .shos-by-bonfire .sub-menu > li > span").on('click', function(e) {
    e.preventDefault();
        /* before opening/closing sub-menu, remove smooth scroll (iOS workaround) */
        jQuery(".shos-by-bonfire").removeClass("smooth-scroll");
        
            if (false == jQuery(this).next().is(':visible')) {
                jQuery(this).parent().siblings().find(".sub-menu").delay(10).slideUp(350);
                jQuery(this).siblings().find(".sub-menu").delay(10).slideUp(350);
                jQuery(this).parent().siblings().find("span").removeClass("shos-submenu-active");
                jQuery(this).siblings().find("span").removeClass("shos-submenu-active");
            }
            jQuery(this).next().delay(10).slideToggle(350);
            jQuery(this).toggleClass("shos-submenu-active");
        
        /* after opening/closing sub-menu, restore smooth scroll (iOS workaround) */
        setTimeout(function() {
            jQuery(".shos-by-bonfire").addClass("smooth-scroll");
        }, 400);
    })
    
    /* sub-menu arrow animation */
    jQuery(".shos-by-bonfire .menu > li > span").on('click', function(e) {
    e.preventDefault();
        if(jQuery(".shos-by-bonfire .sub-menu > li > span").hasClass('shos-submenu-active'))
            {
                jQuery(".shos-by-bonfire .sub-menu > li > span").removeClass("shos-submenu-active");
            }
    })

    /* close sub-menus when menu button, search button or overlay clicked */
    jQuery(".shos-menu-button, .shos-dropdown-close").on('click', function(e) {
        if(jQuery(".shos-by-bonfire .menu > li > span, .shos-by-bonfire .sub-menu > li > span").hasClass('shos-submenu-active'))
            {
                jQuery(".shos-by-bonfire .menu > li").find(".sub-menu").delay(10).slideUp(350);
                jQuery(".shos-by-bonfire .menu > li > span, .sub-menu > li > span").removeClass("shos-submenu-active");
            }
    })
    
});
// END CONVERTING DEFAULT WP MENU TO A SLIDE-DOWN ONE