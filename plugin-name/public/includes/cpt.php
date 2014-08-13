<?php
class Plugin_Name_CPT {
	function __construct( $parent ) {
		add_action( 'init' , array( $this, 'register_CPT_SLUG_cpt' ) );
		// add_action( 'init' , array( $this, 'register_CPT_SLUG_taxonomies' ) );
	}

	function register_CPT_SLUG_cpt() {
		$result = register_post_type( 'CPT_SLUG', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		 	// let's now add all the options for this post type
			array('labels' => array(
				'name' => __('CPT_SINGULAR_NAMEs', 'CPT_SLUG general name'), /* This is the Title of the Group */
				'singular_name' => __('CPT_SINGULAR_NAME', 'CPT_SLUG singular name'), /* This is the individual type */
				'all_items' => __('All CPT_SINGULAR_NAMEs'), /* the all items menu item */
				'add_new' => __('Add New', 'custom CPT_SLUG item'), /* The add new menu item */
				'add_new_item' => __('Add New CPT_SINGULAR_NAME'), /* Add New Display Title */
				'edit' => __( 'Edit' ), /* Edit Dialog */
				'edit_item' => __('Edit CPT_SINGULAR_NAME'), /* Edit Display Title */
				'new_item' => __('New CPT_SINGULAR_NAME'), /* New Display Title */
				'view_item' => __('View CPT_SINGULAR_NAME'), /* View Display Title */
				'search_items' => __('Search CPT_SINGULAR_NAMEs'), /* Search CPT_SINGULAR_NAME Title */
				'not_found' =>  __('Nothing found in the Database.'), /* This displays if there are no entries yet */
				'not_found_in_trash' => __('Nothing found in Trash'), /* This displays if there is nothing in the trash */
				'parent_item_colon' => ''
				), /* end of arrays */
				'description' => __( 'Stores CPT_SLUGs in the database' ), /* CPT_SINGULAR_NAME Description */
				'public' => true,
				'publicly_queryable' => true,
				'exclude_from_search' => true,
				'show_ui' => true,
				'query_var' => true,
				'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */
				// 'menu_icon' => get_stylesheet_directory_uri() . '/library/images/custom-post-icon.png', /* the icon for the custom post type menu */
				'rewrite'	=> true,
				'has_archive' => 'CPT_SLUGs', /* you can rename the slug here */
				// 'capabilities' => array(
				// 	'edit_post' => 'subscriber',
				// 	'edit_posts' => 'subscriber',
				// 	'edit_others_posts' => 'subscriber',
				// 	'publish_posts' => 'subscriber',
				// 	'read_post' => 'subscriber',
				// 	'read_private_posts' => 'subscriber',
				// 	'delete_post' => 'subscriber'
				// ),

				'hierarchical' => false,
				/* the next one is important, it tells what's enabled in the post editor */
				// 'supports' => array( 'title' )
		 	) /* end of options */
		); /* end of register post type */
	}

	// function register_CPT_SLUG_taxonomies() {

	// 	$labels = array(
	// 		'name'					=> _x( 'Plural Name', 'Taxonomy plural name', 'text-domain' ),
	// 		'singular_name'			=> _x( 'Singular Name', 'Taxonomy singular name', 'text-domain' ),
	// 		'search_items'			=> __( 'Search Plural Name', 'text-domain' ),
	// 		'popular_items'			=> __( 'Popular Plural Name', 'text-domain' ),
	// 		'all_items'				=> __( 'All Plural Name', 'text-domain' ),
	// 		'parent_item'			=> __( 'Parent Singular Name', 'text-domain' ),
	// 		'parent_item_colon'		=> __( 'Parent Singular Name', 'text-domain' ),
	// 		'edit_item'				=> __( 'Edit Singular Name', 'text-domain' ),
	// 		'update_item'			=> __( 'Update Singular Name', 'text-domain' ),
	// 		'add_new_item'			=> __( 'Add New Singular Name', 'text-domain' ),
	// 		'new_item_name'			=> __( 'New Singular Name Name', 'text-domain' ),
	// 		'add_or_remove_items'	=> __( 'Add or remove Plural Name', 'text-domain' ),
	// 		'choose_from_most_used'	=> __( 'Choose from most used text-domain', 'text-domain' ),
	// 		'menu_name'				=> __( 'Singular Name', 'text-domain' ),
	// 	);

	// 	$args = array(
	// 		'labels'            => $labels,
	// 		'public'            => true,
	// 		'show_in_nav_menus' => true,
	// 		'show_admin_column' => false,
	// 		'hierarchical'      => false,
	// 		'show_tagcloud'     => true,
	// 		'show_ui'           => true,
	// 		'query_var'         => true,
	// 		'rewrite'           => true,
	// 		'query_var'         => true,
	// 		'capabilities'      => '',
	// 	);

	// 	register_taxonomy( 'Singular Name', array( 'post' ), $args );
	// }
}