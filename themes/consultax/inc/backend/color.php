<?php 

//Custom Style Frontend
if(!function_exists('consultax_color_scheme')){
    function consultax_color_scheme(){
        $color_scheme = '';

        //Main Color
        if( consultax_get_option('main_color') != '#f26522' || consultax_get_option('second_color') != '#00387a' ){
            $color_scheme = 
            '
        /****Main Color****/

        	/*Background Color*/
            .bg-primary,
            .btn, #back-to-top,
            .btn-dark:hover, .btn-dark:focus,
            .btn.btn-border:hover, .btn.btn-border:focus,
            .btn-cta-header a,
            .main-navigation ul li li a:hover, .main-navigation ul > li > ul > li.current-menu-ancestor > a,.main-navigation ul li ul li.current-menu-item a,
            .content-area .page-pagination li span, .content-area .page-pagination li a:hover,
            .comments-area .comment-item .comment-reply a:hover,
            .widget-area .widget.widget_categories ul li a:hover, .widget-area .widget.widget_archive ul li a:hover, 
            .widget-area .widget.widget_recent_entries ul li a:hover, 
            .widget-area .widget.widget_meta ul li a:hover, .widget-area 
            .widget.widget_pages ul li a:hover, .widget-area .widget.widget_nav_menu ul li a:hover,
            .widget-area .widget.widget_categories ul li.current-menu-item > a, 
            .widget-area .widget.widget_archive ul li.current-menu-item > a, 
            .widget-area .widget.widget_recent_entries ul li.current-menu-item > a, 
            .widget-area .widget.widget_meta ul li.current-menu-item > a, 
            .widget-area .widget.widget_pages ul li.current-menu-item > a, 
            .widget-area .widget.widget_nav_menu ul li.current-menu-item > a,
            .tagcloud a:hover,
            .ot-socials a:hover,
            .image-carousel .slick-arrow:hover,
            .project-filter .cat-filter a.selected, .project-filter .cat-filter a:hover,
            .project-slider .slick-arrow:hover,
            .project-list-2 .slick-arrow:hover,
            .testi-item .line,
            .testi-slider .slick-arrow:hover,
            .team-slider .slick-arrow:hover,
            .team-item .team-info .ot-socials a:hover,
            .slick-dots li.slick-active button:before,
            .info-box .socials i:hover,
            .cv-download:before,
            .main-footer .ot-socials a:hover,
            .content-woocommerce .woocommerce-pagination .page-numbers li span.current, 
            .content-woocommerce .woocommerce-pagination .page-numbers li a:hover,
            ul.products li.product .add_to_cart_button, ul.products li.product .added_to_cart,
            .inner-content-wrap .woocommerce-tabs #reviews .form-submit #submit,
            .inner-content-wrap .entry-summary .button.alt,
            .woocommerce-message a.button,.woocommerce-cart-form button.button,
            .woocommerce-form-coupon button.button,.woocommerce-checkout-payment button.button.alt,.return-to-shop a.button,
            .woocommerce-cart .wc-proceed-to-checkout a.checkout-button,
            .product-sidebar .widget.widget_product_categories ul li a:hover,
            .product-sidebar .widget.widget_product_categories ul li.current-menu-item > a,
            .product-sidebar .widget_price_filter .price_slider_wrapper .ui-widget-content .ui-slider-range,
            .product-sidebar .widget_price_filter .price_slider_wrapper .ui-widget-content .ui-slider-handle,
            .product-sidebar .price_slider_amount button,
            .menu-service h4, .menu-service .call-action a:hover,
            .project-with-nav .project-images .slick-arrow:hover{background-color: '.consultax_get_option('main_color').'}

            /*Border Color*/ 
            .bg-second .btn:hover,.bg-second .btn:focus, 
            .bg-second-trans .btn:hover,.bg-second-trans .btn:focus, 
            .pagelink.gray:hover, 
            .pagelink.white:hover, 
            .btn.btn-border, 
            .main-navigation ul li li a:hover, .main-navigation ul > li > ul > li.current-menu-ancestor > a,.main-navigation ul li ul li.current-menu-item a, 
            .content-area .page-pagination li span, .content-area .page-pagination li a:hover, 
            .widget-area .widget.bg-second .btn:hover,.widget-area .widget.bg-second .btn:focus, 
            .tagcloud a:hover, 
            .ot-socials a:hover, 
            .service-box .link-box:hover, 
            .service-box.hover-box:hover .link-box, 
            .news-slider .news-item .inner-item:hover .post-link,
            .inner-post .entry-footer .post-link,
            .project-list-2 .slick-arrow:hover, 
            .testi-slider .slick-arrow:hover, 
            .team-slider .slick-arrow:hover, 
            .news-slider .news-item .post-link:hover, 
            .wpcf7 .wpcf7-form-control:not(.btn):not(select):focus, 
            .slick-dots li.slick-active button:before, 
            .info-box .socials i:hover, .pagelink,
            .main-footer .ot-socials a:hover,
            .content-woocommerce .woocommerce-pagination .page-numbers li span.current, 
            .content-woocommerce .woocommerce-pagination .page-numbers li a:hover,
            .project-with-nav .slick-current .nav-item .pagelink{border-color: '.consultax_get_option('main_color').'}			

            /*Border Top*/ 
            .main-navigation ul ul{border-top-color: '.consultax_get_option('main_color').'}
            blockquote, .fun-facts .icon-fact i, .fun-facts.s2 .icon-fact i{ background: #eee; }

		/*Color*/
            blockquote, 
            a.the-title:hover, 
            .text-primary, 
            .text-primary:visited, 
            .text-light .text-primary, 
            .pagelink, 
            .pagelink:visited, 
            .pagelink.gray:hover, 
            .pagelink.white:hover, 
            .btn.btn-border, 
            a:hover, a:focus, a:active, 
            ul.social-list li a:hover, 
            ul.info-list li i, 
            .h-cart-btn i:hover, .toggle_search i:hover, .toggle_search.active i, 
            .main-navigation ul > li:hover > a, .main-navigation ul > li > a:hover, 
            .main-navigation ul > li.current-menu-item > a,.main-navigation ul > li.current-menu-ancestor > a, 
            .header_mobile .mobile_nav .mobile_mainmenu li li a:hover,
            .header_mobile .mobile_nav .mobile_mainmenu ul > li > ul > li.current-menu-ancestor > a, 
            .header_mobile .mobile_nav .mobile_mainmenu > li > a:hover, 
            .header_mobile .mobile_nav .mobile_mainmenu > li.current-menu-item > a,
            .header_mobile .mobile_nav .mobile_mainmenu > li.current-menu-ancestor > a, 
            .breadc-box, 
            .breadc-box li a:hover, 
            .content-area .inner-post .entry-title a:hover, 
            .inner-post .entry-footer .post-link, 
            .comments-area .comment-reply-title small a, 
            .widget-area .widget ul li a:hover, 
            .widget-area .widget .textwidget ul li a, 
            .main-footer ul li a:hover, 
            .service-box i, .service-box img, 
            .service-box .link-box:hover, 
            .service-box.hover-box:hover .link-box, 
            .service-box.hover-box:hover .link-box:visited, 
            .image-box h4 a:hover, 
            .simple-box i, 
            .project-filter .project-item .p-info h4 a:hover, 
            .project-slider .project-item h4 a:hover, 
            .project-slider-2 .slick-slide .inner h4 a:hover, 
            .testi-item .testi-content > i, 
            .testi-item-2 .ion-md-quote, 
            .member-item .avatar .social-mem a:hover, 
            .member-item-3 .mem-info .social-mem a:hover, 
            .fun-facts .icon-fact i, 
            .news-slider .news-item .inner-item:hover .post-link, 
            .news-slider .news-item .post-link:hover, 
            .light-hover .btn:hover, 
            .contact-info a:hover, 
            .contact-info i:before, 
            .socials a:hover, 
            .contact-box h6,
            ul.products li.product .product-info h2.woocommerce-loop-product__title:hover, 
            .woocommerce-Price-amount, 
            .inner-content-wrap .entry-summary .product_meta > span a:hover,
            .project-with-nav .slick-current .nav-item .pagelink{color: '.consultax_get_option('main_color').'}
			

		/****Second Color****/

            /*Background Color*/ 
            .bg-second,
            .overlay,
            .btn:hover, .btn:focus,
            .header-style-4 .header-topbar,
            .header-blue,
            .header-transparent.sticked,
            #mmenu_toggle button,
            #mmenu_toggle button:before,
            #mmenu_toggle button:after,
            .widget-area .widget.bg-second,
            .service-box.hover-box:hover,
            .career-box > h5,
            .site-footer,
            .woocommerce table.cart th,
            ul.products li.product .add_to_cart_button:hover, 
            ul.products li.product .add_to_cart_button:focus, 
            ul.products li.product .added_to_cart:hover, 
            ul.products li.product .added_to_cart:focus,
            .inner-content-wrap .woocommerce-tabs #reviews .form-submit #submit:hover, 
            .inner-content-wrap .woocommerce-tabs #reviews .form-submit #submit:focus,
            .inner-content-wrap .entry-summary .button.alt:hover, 
            .inner-content-wrap .entry-summary .button.alt:focus,
            .woocommerce-message a.button:hover, .woocommerce-message a.button:focus,
            .woocommerce-cart-form button.button:hover,.woocommerce-cart-form button.button:focus,
            .woocommerce-form-coupon button.button:hover,.woocommerce-form-coupon button.button:focus,
            .woocommerce-checkout-payment button.button.alt:hover,.woocommerce-checkout-payment button.button.alt:focus,
            .return-to-shop a.button:hover,.return-to-shop a.button:focus,
            .woocommerce-cart .wc-proceed-to-checkout a.checkout-button:hover,
            .product-sidebar .price_slider_amount button:hover, 
            .product-sidebar .price_slider_amount button:focus,
            .menu-service .list-service{background-color: '.consultax_get_option('second_color').'}

            /*Border Color*/ 
            .bg-primary .btn, 
            .pagelink:hover, 
            .content-area .inner-post .post-link:hover,
            .woocommerce-message{border-color: '.consultax_get_option('second_color').'}

            /*Color*/
            a, 
            a:visited, 
            .text-second, 
            .pagelink:hover,
            .content-area .inner-post .post-link:hover, 
            .fun-facts.s2 .icon-fact i,
            .woocommerce-message::before{color: '.consultax_get_option('second_color').'}
		
			';
        }

        if(! empty($color_scheme)){
			echo '<style type="text/css">'.$color_scheme.'</style>';
		}
    }
}
add_action('wp_head', 'consultax_color_scheme');