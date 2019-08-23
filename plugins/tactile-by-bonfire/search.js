// BEGIN SHOW SEARCH FORM
jQuery('.tactile-search-button, .tactile-search-close-button').on('touchstart click', function(e) {
'use strict';
    e.preventDefault();
        if(jQuery('.tactile-search-wrapper').hasClass('tactile-search-wrapper-active'))
        {
            /* hide search field */
            jQuery('.tactile-search-wrapper').removeClass('tactile-search-wrapper-active');
            jQuery('.tactile-search-wrapper #searchform input').removeClass('tactile-search-input-active');
            jQuery('.tactile-search-wrapper #searchform #s').blur();
            /* change back header color when search de-activated */
            jQuery('.tactile-header-background-color').removeClass('tactile-search-wrapper-active-bg');
            /* de-activate search border */
            jQuery('.tactile-search-border, .tactile-search-border-main-menu-hidden').removeClass('tactile-search-border-active');
            jQuery('.tactile-menu-button, .tactile-logo-wrapper, .tactile-search-button, .tactile-swipe-menu-wrapper').removeClass('tactile-opacity-zero');
            
        } else {
            /* show search field */
            jQuery('.tactile-search-wrapper').addClass('tactile-search-wrapper-active');
            jQuery('.tactile-search-wrapper #searchform input').addClass('tactile-search-input-active');
            /* focus search field */
            jQuery('.tactile-search-wrapper #searchform #s').focus();
            /* change header color when search activated */
            jQuery('.tactile-header-background-color').addClass('tactile-search-wrapper-active-bg');
            /* activate search border */
            jQuery('.tactile-search-border, .tactile-search-border-main-menu-hidden').addClass('tactile-search-border-active');
            jQuery('.tactile-menu-button, .tactile-logo-wrapper, .tactile-search-button, .tactile-swipe-menu-wrapper').addClass('tactile-opacity-zero');

            /* deactivate menu button */
            jQuery(".tactile-menu-button").removeClass("tactile-menu-button-active");
            /* close menu */
            jQuery(".tactile-by-bonfire-wrapper").removeClass("tactile-menu-active");
            /* close any open submenus */
            jQuery(".tactile-by-bonfire .menu > li").find(".sub-menu").slideUp(300);
            jQuery(".tactile-by-bonfire .menu > li > span, .tactile-by-bonfire .sub-menu > li > span").removeClass("tactile-submenu-active");
            }
});
// END SHOW SEARCH FORM