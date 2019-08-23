<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Consultax
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">

	<header id="site-header" class="site-header <?php consultax_header_class(); ?>">		
		<?php 
			if( consultax_get_option('header_layout') == "header2" ){
				get_template_part('inc/frontend/headers/header-2');
			}elseif( consultax_get_option('header_layout') == "header3" ) {
				get_template_part('inc/frontend/headers/header-3');
			}elseif( consultax_get_option('header_layout') == "header4" ) {
				get_template_part('inc/frontend/headers/header-4');
			}else{
	    ?>
			<!-- Main header start - Header Home-1, Default -->
			<?php if ( consultax_get_option('topbar_switch') != false ){ ?>
			<!-- Top bar start / class css: topbar-dark -->
			<div id="header_topbar" class="header-topbar md-hidden sm-hidden clearfix">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<?php if ( consultax_get_option('social_switch') != false ){ ?>
			                    <!-- social icons -->
			                    <ul class="social-list fleft">
			                        <?php $socials = consultax_get_option( 'header_socials', array() ); ?>
			                        <?php foreach ( $socials as $social ) { ?>
			                            <li><a href="<?php echo esc_url($social['social_link']); ?>" target="<?php echo esc_attr( consultax_get_option( 'social_target_link' ) ); ?>" ><i class="fa fa-<?php echo esc_attr($social['social_icon']); ?>"></i></a>
			                            </li>
			                        <?php } ?>
			                    </ul>
			                    <!-- social icons close -->
			                <?php } ?>
							<?php if ( consultax_get_option('topbar_text_header') != '' ){ echo '<div class="topbar-text fright">' . consultax_get_option('topbar_text_header') . '</div>'; } ?>				
						</div>
					</div>
				</div>
			</div>
			<!-- Top bar close -->
			<?php } ?>

			<!-- Main header start -->
			<div class="main-header md-hidden sm-hidden">
				<div class="main-header-top">
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
									<div class="col-media-body col-media-middle">
										<?php if ( consultax_get_option('info_switch') != false ){ ?>
								            <!-- contact info -->
								            <ul class="info-list info_on_right_side fright">
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
									</div>
								</div>							
							</div>					
						</div>				
					</div>
				</div>
				<div class="main-header-bottom">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<div class="header-mainnav">									
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
										
										<?php if ( function_exists( 'pll_the_languages' ) ) { ?>
											<div class="header_polylang_langswitcher fright">
												<?php echo do_shortcode('[polylang_langswitcher show_flags="1" show_names="1" echo="0" dropdown="1"]'); ?>
											</div>
										<?php } ?>
									</div>
									<?php } ?>
									<div id="site-navigation" class="main-navigation fleft">			
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
		<?php } ?>

		<?php get_template_part('inc/frontend/header-mobile');  ?>

	</header><!-- #site-header -->

	<div id="content" class="site-content">
    <?php consultax_page_header(); ?>