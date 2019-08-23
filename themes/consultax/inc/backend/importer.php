<?php
/**
 * Hooks for importer
 *
 * @package Consultax
 */


/**
 * Importer the demo content
 *
 * @since  1.0
 *
 */
function consultax_importer() {
	return array(
		array(
			'name'       => 'Home 1',
			'preview'    => get_template_directory_uri().'/inc/backend/data/home1.jpg',
			'content'    => get_template_directory_uri().'/inc/backend/data/demo-content.xml',
			'customizer' => get_template_directory_uri().'/inc/backend/data/customizer.dat',
			'widgets'    => get_template_directory_uri().'/inc/backend/data/widgets.wie',
			'sliders'    => get_template_directory_uri().'/inc/backend/data/sliders.zip',
			'pages'      => array(
				'front_page' => 'Home 1',
				'blog'       => 'Blog',
				'shop'       => 'Shop',
				'cart'       => 'Cart',
				'checkout'   => 'Checkout',
				'my_account' => 'My Account',
			),
			'menus'      	 => array(
				'primary'    => 'main-menu',
				'footer'     => 'footer-menu',
			),
			'options' => array(
				'shop_catalog_image_size' => array(
					'width'  => 750,
					'height' => 1080,
					'crop' 	 => 1,
				)
			),
		),
		array(
			'name'       => 'Home 2',
			'preview'    => get_template_directory_uri().'/inc/backend/data/home2.jpg',
			'content'    => get_template_directory_uri().'/inc/backend/data/demo-content.xml',
			'customizer' => get_template_directory_uri().'/inc/backend/data/customizer.dat',
			'widgets'    => get_template_directory_uri().'/inc/backend/data/widgets.wie',
			'sliders'    => get_template_directory_uri().'/inc/backend/data/sliders.zip',
			'pages'      => array(
				'front_page' => 'Home 2',
				'blog'       => 'Blog',
				'shop'       => 'Shop',
				'cart'       => 'Cart',
				'checkout'   => 'Checkout',
				'my_account' => 'My Account',
			),
			'menus'      	 => array(
				'primary'    => 'main-menu',
				'footer'     => 'footer-menu',
			),
			'options' => array(
				'shop_catalog_image_size' => array(
					'width'  => 750,
					'height' => 1080,
					'crop' 	 => 1,
				)
			),
		),
		array(
			'name'       => 'Home 3',
			'preview'    => get_template_directory_uri().'/inc/backend/data/home3.jpg',
			'content'    => get_template_directory_uri().'/inc/backend/data/demo-content.xml',
			'customizer' => get_template_directory_uri().'/inc/backend/data/customizer.dat',
			'widgets'    => get_template_directory_uri().'/inc/backend/data/widgets.wie',
			'sliders'    => get_template_directory_uri().'/inc/backend/data/sliders.zip',
			'pages'      => array(
				'front_page' => 'Home 3',
				'blog'       => 'Blog',
				'shop'       => 'Shop',
				'cart'       => 'Cart',
				'checkout'   => 'Checkout',
				'my_account' => 'My Account',
			),
			'menus'      	 => array(
				'primary'    => 'main-menu',
				'footer'     => 'footer-menu',
			),
			'options' => array(
				'shop_catalog_image_size' => array(
					'width'  => 750,
					'height' => 1080,
					'crop' 	 => 1,
				)
			),
		),
		array(
			'name'       => 'Home 4',
			'preview'    => get_template_directory_uri().'/inc/backend/data/home4.jpg',
			'content'    => get_template_directory_uri().'/inc/backend/data/demo-content.xml',
			'customizer' => get_template_directory_uri().'/inc/backend/data/customizer.dat',
			'widgets'    => get_template_directory_uri().'/inc/backend/data/widgets.wie',
			'sliders'    => get_template_directory_uri().'/inc/backend/data/sliders.zip',
			'pages'      => array(
				'front_page' => 'Home 4',
				'blog'       => 'Blog',
				'shop'       => 'Shop',
				'cart'       => 'Cart',
				'checkout'   => 'Checkout',
				'my_account' => 'My Account',
			),
			'menus'      	 => array(
				'primary'    => 'main-menu',
				'footer'     => 'footer-menu',
			),
			'options' => array(
				'shop_catalog_image_size' => array(
					'width'  => 750,
					'height' => 1080,
					'crop' 	 => 1,
				)
			),
		),
	);
}

add_filter( 'soo_demo_packages', 'consultax_importer', 30 );