<!-- BEGIN HEADER BACKGROUND -->
<div class="tactile-header-wrapper<?php if ( is_admin_bar_showing() ) { ?> wp-toolbar-active<?php } ?>">

    <div class="tactile-header-menu-logo-search-wrapper">
        
        <!-- BEGIN MENU BUTTON -->
        <?php if( get_theme_mod('tactile_hide_menu_button') == '') { ?>
            <div class="tactile-menu-button">
                <div class="tactile-menu-button-middle"></div>
                <div class="tactile-menu-button-label"></div>
            </div>
        <?php } ?>
        <!-- END MENU BUTTON -->

        <!-- BEGIN LOGO -->
        <div class="tactile-logo-wrapper">
            <?php if ( get_theme_mod( 'tactile_logo_image' ) ) : ?>

                <!-- BEGIN LOGO IMAGE -->
                <div class="tactile-logo-image">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo get_theme_mod('tactile_logo_image'); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"></a>
                </div>
                <!-- END LOGO IMAGE -->

            <?php else : ?>

                <!-- BEGIN LOGO -->
                <div class="tactile-logo">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <?php bloginfo('name'); ?>
                    </a>
                </div>
                <!-- END LOGO -->

            <?php endif; ?>
        </div>
        <!-- END LOGO -->

        <!-- BEGIN SEARCH BUTTON -->
        <?php if( get_theme_mod('tactile_hide_search') == '') { ?>
            <div class="tactile-search-button">
                <div class="tactile-icon-search"></div>
            </div>
        <?php } ?>
        <!-- END SEARCH BUTTON -->

    </div>

    <!-- BEGIN SWIPE MENU WRAPPER -->
    <?php if( get_theme_mod('tactile_hide_swipe_menu') == '') { ?>
        <?php if ( has_nav_menu('tactile-by-bonfire-swipe') ) { ?>
            <div class="tactile-swipe-menu-wrapper">
                <!-- BEGIN HORIZONTAL MENU -->
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <?php wp_nav_menu( array( 'container_class' => 'tactile-by-bonfire-swipe', 'theme_location' => 'tactile-by-bonfire-swipe', 'fallback_cb' => '', 'depth' => '1' ) ); ?>
                        </div>
                    </div>
                </div>
                <!-- END HORIZONTAL MENU -->
            </div>
        <?php } ?>
    <?php } ?>
    <!-- END SWIPE MENU WRAPPER -->

    <!-- BEGIN SEARCH BORDER -->
    <div class="tactile-search-border"></div>
    <!-- END SEARCH BORDER -->

    <!-- BEGIN SEARCH FORM -->
    <div class="tactile-search-wrapper">
        <!-- BEGIN SEARCH FORM CLOSE ICON -->
        <div class="tactile-search-close-button">
        </div>
        <!-- END SEARCH FORM CLOSE ICON -->
        <form method="get" id="searchform" action="<?php echo esc_url( home_url('') ); ?>/">
            <input type="text" name="s" id="s" placeholder="<?php if( get_theme_mod('tactile_search_placeholder') != '') { ?><?php echo get_theme_mod('tactile_search_placeholder'); ?><?php } else { ?>Find something...<?php } ?>">
        </form>
    </div>
    <!-- END SEARCH FORM -->

    <!-- BEGIN HEADER BACKGROUND -->
    <div class="tactile-header-background-color">	
    </div>
    <!-- END HEADER BACKGROUND -->

    <!-- BEGIN HEADER BACKGROUND IMAGE -->
    <?php if( get_theme_mod('tactile_header_image') != '') { ?>
        <div class="tactile-header-background-image">
        </div>
    <?php } ?>
    <!-- END HEADER BACKGROUND IMAGE -->

</div>

<!-- BEGIN ACCORDION MENU -->
<?php if( get_theme_mod('tactile_hide_menu_button') == '') { ?>
    <?php if ( has_nav_menu('tactile-by-bonfire') ) { ?>
        <div class="tactile-by-bonfire-wrapper">
            <div class="tactile-by-bonfire smooth-scroll">
                <?php wp_nav_menu( array( 'theme_location' => 'tactile-by-bonfire', 'fallback_cb' => '' ) ); ?>
            </div>
            <div class="tactile-dropdown-close"></div>
        </div>
    <?php } ?>
<?php } ?>
<!-- END ACCORDION MENU -->