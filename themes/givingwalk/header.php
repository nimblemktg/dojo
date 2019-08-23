<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="red-page">
 *
 * @package SpyroPress
 * @subpackage Giving Walk
 * @since 1.0.0
 * @author Red Team
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_head(); ?>
</head>
<body <?php body_class(); givingwalk_body_attributes(); ?>>
	<?php givingwalk_page_loading();?>
	<div <?php givingwalk_page_attributes(); ?>>
		<?php 	
			givingwalk_header_top();
			givingwalk_header_rev_slider();
			givingwalk_header_layout();
			givingwalk_page_title();
		?>
		<main id="red-main" class="<?php givingwalk_main_class(); ?>">
			<div class="row">