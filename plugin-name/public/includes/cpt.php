<?php
class Plugin_Name_CPT {
	public $post_type = 'CPT_SLUG';
	public $singular_name = 'CPT_SINGULAR_NAME';

	function __construct( $parent ) {

		add_action( 'init' , array( $this, 'register_cpt' ) );
		// add_action( 'init' , array( $this, 'register_taxonomies' ) );

		// add_filter( 'manage_edit-' . $this->post_type . '_columns', array( $this, 'register_custom_column_headings' ), 10, 1 );
		// add_action( 'manage_' . $this->post_type .'_posts_custom_column', array( $this, 'register_custom_columns' ), 10, 2 );

		// add_action('restrict_manage_posts', 'restrict_recipes_by_tax');
		// add_filter('parse_query', 'convert_id_to_term_in_query');
	}

	function register_cpt() {
		$result = register_post_type( $this->post_type, /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		 	// let's now add all the options for this post type
			array('labels' => array(
				'name' => __($this->singular_name.'s', $this->post_type.' general name'), /* This is the Title of the Group */
				'singular_name' => __($this->singular_name, $this->post_type.' singular name'), /* This is the individual type */
				'all_items' => __('All '.$this->singular_name.'s'), /* the all items menu item */
				'add_new' => __('Add New', 'custom '.$this->post_type.' item'), /* The add new menu item */
				'add_new_item' => __('Add New '.$this->singular_name), /* Add New Display Title */
				'edit' => __( 'Edit' ), /* Edit Dialog */
				'edit_item' => __('Edit '.$this->singular_name), /* Edit Display Title */
				'new_item' => __('New '.$this->singular_name), /* New Display Title */
				'view_item' => __('View '.$this->singular_name), /* View Display Title */
				'search_items' => __('Search '.$this->singular_name.'s'), /* Search CPT_SINGULAR_NAME Title */
				'not_found' =>  __('Nothing found in the Database.'), /* This displays if there are no entries yet */
				'not_found_in_trash' => __('Nothing found in Trash'), /* This displays if there is nothing in the trash */
				'parent_item_colon' => ''
				), /* end of arrays */
				'description' => __( 'Stores '.$this->post_type.'s in the database' ), /* CPT_SINGULAR_NAME Description */
				'public' => true,
				'publicly_queryable' => true,
				'exclude_from_search' => true,
				'show_ui' => true,
				'query_var' => true,
				'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */
				// 'menu_icon' => get_stylesheet_directory_uri() . '/library/images/custom-post-icon.png', /* the icon for the custom post type menu */
				'rewrite'	=> true,
				'has_archive' => $this->post_type.'s', /* you can rename the slug here */
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
				// 'supports' => array( 'title', 'editor', 'thumbnail' ),
		 	) /* end of options */
		); /* end of register post type */
	}

	// function register_taxonomies() {

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
	// 		'capabilities'      => array(),
	// 	);

	// 	register_taxonomy( 'Singular Name', array( $this->post_type ), $args );
	// }

	function get_image ( $id, $size = 'projects-thumbnail' ) {
		$response = '';

		if ( has_post_thumbnail( $id ) ) {
			// If not a string or an array, and not an integer, default to 150x9999.
			if ( is_int( $size ) || ( 0 < intval( $size ) ) ) {
				$size = array( intval( $size ), intval( $size ) );
			} elseif ( ! is_string( $size ) && ! is_array( $size ) ) {
				$size = array( 150, 9999 );
			}
			$response = get_the_post_thumbnail( intval( $id ), $size );
		}

		return $response;
	} // End projects_get_image()

	/**
	 * Add custom columns for the "manage" screen of this post type.
	 *
	 * @access public
	 * @param string $column_name
	 * @param int $id
	 * @since  1.0.0
	 * @return void
	 */
	public function register_custom_columns ( $column_name, $id ) {
		global $wpdb, $post;

		$meta = get_post_custom( $id );

		switch ( $column_name ) {

			case 'image':
			$value = '';

			$value = $this->get_image( $id, 120 );

			echo $value;
			break;

			default:
			break;

		}
	} // End register_custom_columns()

	/**
	 * Add custom column headings for the "manage" screen of this post type.
	 *
	 * @access public
	 * @param array $defaults
	 * @since  1.0.0
	 * @return void
	 */
	public function register_custom_column_headings ( $defaults ) {

		$new_columns          = array();
		$new_columns['cb']    = $defaults['cb'];
		$new_columns['image'] = __( 'Image', 'quotables' );

		$last_item = '';

		if ( isset( $defaults['date'] ) ) { unset( $defaults['date'] ); }

		if ( count( $defaults ) > 2 ) {
			$last_item = array_slice( $defaults, -1 );

			array_pop( $defaults );
		}
		$defaults = array_merge( $new_columns, $defaults );

		if ( $last_item != '' ) {
			foreach ( $last_item as $k => $v ) {
				$defaults[$k] = $v;
				break;
			}
		}

		return $defaults;
	} // End register_custom_column_headings()

	function restrict_recipes_by_tax() {
		global $typenow;
		$post_type = $this->post_type;
		$taxonomy = 'tax_slug';
		if ($typenow == $post_type) {
			$selected = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
			$info_taxonomy = get_taxonomy($taxonomy);
			wp_dropdown_categories(array(
				'show_option_all' => __("Show All {$info_taxonomy->label}"),
				'taxonomy' => $taxonomy,
				'name' => $taxonomy,
				'orderby' => 'name',
				'selected' => $selected,
				'show_count' => true,
				'hide_empty' => true,
				));
		};
	}

	function convert_id_to_term_in_query($query) {
		global $pagenow;
		$post_type = $this->post_type;
		$taxonomy = 'tax_slug';
		$q_vars = &$query->query_vars;
		if ($pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0) {
			$term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
			$q_vars[$taxonomy] = $term->slug;
		}
	}

}