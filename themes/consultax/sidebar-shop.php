<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Consultax
 */

$sidebar = 'product';

if ( ! is_active_sidebar( $sidebar ) ) {
	return;
}
?>

<aside id="sidebar" class="widget-area product-sidebar">
    <?php dynamic_sidebar( $sidebar ); ?>
</aside><!-- #secondary -->
