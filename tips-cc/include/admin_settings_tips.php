<?php 

/**
* Registers a new post type
* @uses $wp_post_types Inserts new post type object into the list
*
* @param string  Post type key, must not exceed 20 characters
* @param array|string  See optional args description above.
* @return object|WP_Error the registered post type object, or an error object
*/
function tips_golf() {

	$labels = array(
		'name'                => __( 'Tips', 'text-domain' ),
		'singular_name'       => __( 'Tip', 'text-domain' ),
		'add_new'             => _x( 'Add New Tip', 'text-domain', 'text-domain' ),
		'add_new_item'        => __( 'Add New Tip', 'text-domain' ),
		'edit_item'           => __( 'Edit Tip', 'text-domain' ),
		'new_item'            => __( 'New Tip', 'text-domain' ),
		'view_item'           => __( 'View Tip', 'text-domain' ),
		'search_items'        => __( 'Search Tips', 'text-domain' ),
		'not_found'           => __( 'No Tips found', 'text-domain' ),
		'not_found_in_trash'  => __( 'No Tips found in Trash', 'text-domain' ),
		'parent_item_colon'   => __( 'Parent Tip', 'text-domain' ),
		'menu_name'           => __( 'Tips', 'text-domain' ),
	);

	$args = array(
		'labels'                   => $labels,
		'hierarchical'        => false,
		'description'         => 'description',
		'taxonomies'          => array(),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => null,
		'menu_icon'           => null,
		'show_in_nav_menus'   => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => false,
		'has_archive'         => true,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite'             => true,
		'capability_type'     => 'post',
		'supports'            => array(
			'title', 'editor', 'author', 'thumbnail',
			 
			 'page-attributes', 'post-formats'
			)
	);

	register_post_type( 'tip', $args );
}

add_action( 'init', 'tips_golf' );






 ?>