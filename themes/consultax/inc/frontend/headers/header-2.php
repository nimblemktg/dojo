<!-- Main header start - Header Home-6 -->
<div class="main-header md-hidden sm-hidden">
	<div class="container-consultax">
		<div class="row">
			<div class="col-md-12">
				<div class="col-wrap-table">
					<div id="site-logo" class="site-logo col-media-left col-media-middle">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<img <?php if ( consultax_get_option('logo_scroll') != '' ) { ?>class="logo-static"<?php } ?> src="<?php echo consultax_get_option('logo') ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
							<?php if ( consultax_get_option('logo_scroll') != '' ) { ?>
								<img class="logo-scroll" src="<?php echo consultax_get_option('logo_scroll') ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
							<?php } ?>
						</a>
					</div>
					<div class="header-mainnav col-media-body col-media-middle">
						<?php if ( consultax_get_option('header_cta_switch') != false ) { ?>
							<div class="btn-cta-header fright">
								<a href="<?php echo consultax_get_option('cta_link_header'); ?>"><i class="icon ion-md-call"></i> <span><?php echo consultax_get_option('cta_text_header'); ?></span></a>
							</div>
						<?php } ?>

						<?php if ( class_exists( 'woocommerce' ) || consultax_get_option('search_switch') != false ) { ?>		
						<div class="search-cart-box fright">	
							<?php if ( class_exists( 'woocommerce' ) ) {?>
								<div class="h-cart-btn fright"><a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span class="cart-count">0</span></a></div>
							<?php } ?>

							<?php if ( consultax_get_option('search_switch') != false ){ ?>
								<div class="toggle_search fright"><i class="fa fa-search" aria-hidden="true"></i></div>
								<div class="h-search-form-field">
									<?php get_search_form(); ?>
								</div>	
							<?php } ?>
						</div>
						<?php } ?>
						<div id="site-navigation" class="main-navigation fright">			
							<?php
								wp_nav_menu( array(
									'theme_location' => 'primary',
									'menu_id'        => 'primary-menu',
									'container'      => '',
								) );
							?>
						</div><!-- #site-navigation -->
					</div>
				</div>
			</div>					
		</div>				
	</div>
</div>		
<!-- Main header close -->	