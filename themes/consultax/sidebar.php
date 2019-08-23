<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Consultax
 */

if ( consultax_get_layout() === 'full-content' ) {
	return;
}

$sidebar = 'primary';

if ( ! is_active_sidebar( $sidebar ) ) {
	return;
}
?>

<aside id="sidebar" class="widget-area primary-sidebar col-lg-4 col-md-4 col-sm-12 col-xs-12">
    <?php dynamic_sidebar( $sidebar ); ?>
</aside><!-- #secondary -->
