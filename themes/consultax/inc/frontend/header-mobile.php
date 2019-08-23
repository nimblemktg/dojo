<div class="header_mobile">
	<div class="mlogo_wrapper clearfix">
        <div class="mobile_logo">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo consultax_get_option('logo') ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"></a>
    	</div>
        <div id="mmenu_toggle">
	        <button></button>
	    </div>
    </div>
    <div class="mmenu_wrapper">		
		<div class="mobile_nav collapse">
			<?php
				wp_nav_menu( array(
					'theme_location' => 'primary',
					'menu_class'        => 'mobile_mainmenu',
					'container'      => '',
				) );
			?>
		</div>   	
    </div>
</div>
