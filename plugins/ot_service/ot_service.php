<?php
/*
	Plugin Name: OT Services
	Plugin URI: http://oceanthemes.net/
	Description: Declares a plugin that will create a custom post type displaying services.
	Version: 1.0
	Author: OceanThemes
	Author URI: http://oceanthemes.net/
	Text Domain: ot-service
	Domain Path: /lang
	License: GPLv2 or later
*/

/* 
	UPDATE 
	register_activation_hook is not called when a plugin is updated
	so we need to use the following function 
*/
function ot_service_update() {
	load_plugin_textdomain('ot-service', FALSE, dirname(plugin_basename(__FILE__)) . '/lang/');
}
add_action('plugins_loaded', 'ot_service_update');

function ot_service_type() {
	/* In Permalink Settings page */	
	$slug = get_option( 'wpse30021_service_base' );
    if( ! $slug ) $slug = __( 'service', 'ot-service' );
	
	$servicelabels = array (	
		'name' => __('Services','ot-service'),
		'singular_name' => $slug, /* In Permalink Settings page */	
		'menu_name' => 'Services',
		'add_new' => __('Add New','ot-service'),
		'add_new_item' => __('Add New Service','ot-service'),
		'new_item' => __('New Service','ot-service'),
		'edit_item' => __('Edit Service','ot-service'),				
		'view_item' => __('View Service','ot-service'),
		'all_items' => __('All Services','ot-service'),
		'search_item' => __('Search Services','ot-service'),
		'not_found' => __('No Services found.','ot-service'),
		'not_found_in_trash' => __('No services found in Trash.','ot-service'),		
	);

	$args = array(
		'labels' => $servicelabels,
		'hierarchical' => false,
		'description' => __( 'Manages Services' , 'ot-service' ),
		'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => null,
		'menu_icon' => 'dashicons-admin-generic',		
		'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true, /* Choose "false" if do not want using the archive-services.php template and you can using any page instead. */
        'query_var' => true,
        'can_export' => true,
		'rewrite' => array( 'slug' => $slug ), //In Permalink Settings page        
        'capability_type' => 'post',
		'supports' => array( 'title','editor','thumbnail','excerpt','comments','custom-fields'),
	);
		register_post_type ('ot_service',$args);
	}
add_action ('init','ot_service_type');

function ot_service_taxonomy () {
	$taxonomylabels = array(
		'name' => __('Categories','ot-service'),
		'singular_name' => __('Categories','ot-service'),
		'search_items' => __('Search Categories','ot-service'),
		'all_items' => __('All Categories','ot-service'),
		'edit_item' => __('Edit Categories','ot-service'),
		'add_new_item' => __('Add new Categories','ot-service'),
		'menu_name' => __('Categories','ot-service'),
	);

	$args = array(
		'labels' => $taxonomylabels,
		'hierarchical' => true,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => __( 'service_cat', 'ot-service' ) ),
	);
	
	register_taxonomy('service_cat','ot_service',$args);
}
add_action ('init','ot_service_taxonomy',0);

// Add to admin_init function
add_filter('manage_edit-service_columns', 'add_new_service_columns');
function add_new_service_columns($service_columns) { 
	$new_columns['cb'] = '<input type="checkbox" />'; 
    $new_columns['title'] = _x('Title', 'ot-service');
    $new_columns['author'] = _x('Author', 'ot-service');
    $new_columns['service_cat'] = _x('Category', 'ot-service');
    $new_columns['date'] = _x('Date', 'ot-service');

    return $new_columns;
}

// Add to admin_init function
add_action('manage_service_posts_custom_column', 'manage_service_columns', 10, 2);
function manage_service_columns($column, $post_id) {
    global $post;
    switch ($column) {
        case 'service_cat':
            $terms = get_the_terms($post_id, 'service_cat');
            if (!empty($terms)) {
                $out = array();
                foreach ($terms as $term) {
                    $out[] = sprintf('<a href="%s&post_type=ot_service">%s</a>', esc_url(add_query_arg(array(
                        'post_type' => $post->post_type,
                        'service_cat' => $term->slug
                    ), 'edit.php')), esc_html(sanitize_term_field('name', $term->name, $term->term_id, 'service_cat', 'display')));
                }
                echo join(', ', $out);
            } else {
                _e('No Service Category', 'ot-service');
            }
            break;   
        default:
            break;
    } // end switch
}

/**
 * Easy change slug cutom post type name in url to the permalink settings page.
 */
add_action( 'load-options-permalink.php', 'wpse30021_service_load_permalinks' );
function wpse30021_service_load_permalinks()
{
	if( isset( $_POST['wpse30021_service_base'] ) )
	{
		update_option( 'wpse30021_service_base', sanitize_title_with_dashes( $_POST['wpse30021_service_base'] ) );
	}
	
	// Add a settings field to the permalink page
	add_settings_field( 'wpse30021_service_base', __( 'OT Service attribute base', 'ot-service' ), 'wpse30021_service_field_callback', 'permalink', 'optional' );	
}
function wpse30021_service_field_callback()
{
	$value = get_option( 'wpse30021_service_base' );	
	echo '<input type="text" value="' . esc_attr( $value ) . '" name="wpse30021_service_base" id="wpse30021_service_base" class="regular-text" />';
}

?>