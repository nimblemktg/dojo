<!-- Main header start - Header Home-7 -->
<?php if ( consultax_get_option('topbar_switch') != false ){ ?>
<!-- Top bar start / class css: topbar-dark -->
<div id="header_topbar" class="header-topbar md-hidden sm-hidden clearfix">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<?php if ( consultax_get_option('info_switch') != false ){ ?>
		            <!-- contact info -->
		            <ul class="info-list fleft">
		                <?php $contact_infos = consultax_get_option( 'header_contact_info', array() ); ?>
		                <?php foreach ( $contact_infos as $contact_info ) { ?>
		                    <li>
		                        <?php if($contact_info['info_icon'] != ''){ ?><i class="fa fa-<?php echo esc_attr($contact_info['info_icon']); ?>"></i><?php } ?>
		                        <?php echo wp_specialchars_decode($contact_info['info_content']); ?>
		                    </li>
		                <?php } ?>
		            </ul>
		            <!-- contact info close -->
		        <?php } ?>

				<?php if ( consultax_get_option('social_switch') != false ){ ?>
                    <!-- social icons -->
                    <ul class="social-list fright social_on_right_side">
                        <?php $socials = consultax_get_option( 'header_socials', array() ); ?>
                        <?php foreach ( $socials as $social ) { ?>
                            <li><a href="<?php echo esc_url($social['social_link']); ?>" target="<?php echo esc_attr( consultax_get_option( 'social_target_link' ) ); ?>" ><i class="fa fa-<?php echo esc_attr($social['social_icon']); ?>"></i></a>
                            </li>
                        <?php } ?>
                    </ul>
                    <!-- social icons close -->
                <?php } ?>
			</div>
		</div>
	</div>
</div>
<!-- Top bar close -->
<?php } ?>

<!-- Main header start -->
<div class="main-header md-hidden sm-hidden">
	<div class="container">
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