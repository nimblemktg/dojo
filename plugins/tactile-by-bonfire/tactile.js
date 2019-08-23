// BEGIN SHOW/HIDE MAIN MENU
jQuery('.tactile-menu-button, .tactile-dropdown-close').on('click', function(e) {
'use strict';
e.preventDefault();

    /* return menu button to default state */
    jQuery(".tactile-menu-button").toggleClass("tactile-menu-button-active");
    /* hide main menu */
    jQuery(".tactile-by-bonfire-wrapper").toggleClass("tactile-menu-active");
    e.stopPropagation();

    /* hide menu when clicked outside of it */
    jQuery(document).on('click', function(e) {
        /* deactivate menu button */
        jQuery(".tactile-menu-button").removeClass("tactile-menu-button-active");
        /* close menu */
        jQuery(".tactile-by-bonfire-wrapper").removeClass("tactile-menu-active");
        /* close any open submenus */
        jQuery(".tactile-by-bonfire .menu > li").find(".sub-menu").slideUp(300);
        jQuery(".tactile-by-bonfire .menu > li > span, .tactile-by-bonfire .sub-menu > li > span").removeClass("tactile-submenu-active");
    });  
    jQuery('.tactile-menu-button, .tactile-by-bonfire-wrapper').on('click', function(e) {
        e.stopPropagation();
    });

});
// END SHOW/HIDE MAIN MENU


// BEGIN CONVERTING DEFAULT WP MENU TO A SLIDE-DOWN ONE
jQuery(document).ready(function (jQuery) {
'use strict';
	/* add sub-menu arrow */
	jQuery('.tactile-by-bonfire ul li ul').before(jQuery('<span class="tactile-sub-arrow"><span class="tactile-sub-arrow-inner"></span></span>'));

	/* accordion */
	jQuery(".tactile-by-bonfire .menu > li > span, .tactile-by-bonfire .sub-menu > li > span").on('click', function(e) {
	e.preventDefault();
        /* before opening/closing sub-menu, remove smooth scroll (iOS workaround) */
        jQuery(".tactile-by-bonfire").removeClass("smooth-scroll");
        
            if (false == jQuery(this).next().is(':visible')) {
                jQuery(this).parent().siblings().find(".sub-menu").delay(10).slideUp(350);
                jQuery(this).siblings().find(".sub-menu").delay(10).slideUp(350);
                jQuery(this).parent().siblings().find("span").removeClass("tactile-submenu-active");
                jQuery(this).siblings().find("span").removeClass("tactile-submenu-active");
            }
            jQuery(this).next().delay(10).slideToggle(350);
            jQuery(this).toggleClass("tactile-submenu-active");
        
        /* after opening/closing sub-menu, restore smooth scroll (iOS workaround) */
        setTimeout(function() {
            jQuery(".tactile-by-bonfire").addClass("smooth-scroll");
        }, 400);
	})
	
	/* sub-menu arrow animation */
	jQuery(".tactile-by-bonfire .menu > li > span").on('click', function(e) {
	e.preventDefault();
		if(jQuery(".tactile-by-bonfire .sub-menu > li > span").hasClass('tactile-submenu-active'))
			{
				jQuery(".tactile-by-bonfire .sub-menu > li > span").removeClass("tactile-submenu-active");
			}
	})

	/* close sub-menus when menu button, search button or overlay clicked */
	jQuery(".tactile-menu-button, .tactile-dropdown-close").on('click', function(e) {
		if(jQuery(".tactile-by-bonfire .menu > li > span, .tactile-by-bonfire .sub-menu > li > span").hasClass('tactile-submenu-active'))
			{
				jQuery(".tactile-by-bonfire .menu > li").find(".sub-menu").delay(10).slideUp(350);
				jQuery(".tactile-by-bonfire .menu > li > span, .sub-menu > li > span").removeClass("tactile-submenu-active");
			}
	})
	
});
// END CONVERTING DEFAULT WP MENU TO A SLIDE-DOWN ONE

// BEGIN HORIZONTAL MENU SWIPE
var mySwiper = new Swiper('.swiper-container',{
	scrollContainer: true
});
// END HORIZONTAL MENU SWIPE