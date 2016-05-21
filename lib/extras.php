<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Config;

/**
 * Add <body> classes
 */
function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  // Add class if sidebar is active
  if (Config\display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');

/**
 * Clean up the_excerpt()
 */
function excerpt_more() {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');

//* BOF CUSTOM POST TYPE
// Our custom post type function
function create_posttype() {

	register_post_type( 'teasers',
	// CPT Options
		array(
			'labels' => array(
				'name' => __( 'teasers' ),
				'singular_name' => __( 'Teaser' )
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'teasers'),
			'menu_icon'   => 'dashicons-star-empty',
		)
	);
}
// Hooking up our function to theme setup
add_action( 'init',  __NAMESPACE__ . '\\create_posttype' );

/*
* Create Custom Post Type
*/

function custom_post_type() {

// Set UI labels for Custom Post Type
	$labels = array(
		'name'                => _x( 'teasers', 'Post Type General Name', 'sage' ),
		'singular_name'       => _x( 'Instrument', 'Post Type Singular Name', 'sage' ),
		'menu_name'           => __( 'teasers', 'sage' ),
		'parent_item_colon'   => __( 'Parent Instrument', 'sage' ),
		'all_items'           => __( 'All Instruments', 'sage' ),
		'view_item'           => __( 'View Instrument', 'sage' ),
		'add_new_item'        => __( 'Add New Instrument', 'sage' ),
		'add_new'             => __( 'Add New', 'sage' ),
		'edit_item'           => __( 'Edit Instrument', 'sage' ),
		'update_item'         => __( 'Update Instrument', 'sage' ),
		'search_items'        => __( 'Search Instrument', 'sage' ),
		'not_found'           => __( 'Not Found', 'sage' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'sage' ),
	);

// Set other options for Custom Post Type

	$args = array(
		'label'               => __( 'teasers', 'sage' ),
		'description'         => __( 'New instruments to showcase', 'sage' ),
		'labels'              => $labels,
		// Features this CPT supports in Post Editor
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
		// You can associate this CPT with a taxonomy or custom taxonomy.
		'taxonomies'          => array( 'genres' ),
		/* A hierarchical CPT is like Pages and can have
		* Parent and child items. A non-hierarchical CPT
		* is like Posts.
		*/
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);

	// Registering your Custom Post Type
	register_post_type( 'teasers', $args );

}

/* Hook into the 'init' action so that the function
* Containing our post type registration is not
* unnecessarily executed.
*/

add_action( 'init',  __NAMESPACE__ . '\\custom_post_type', 0 );

add_action( 'pre_get_posts', __NAMESPACE__ . '\\add_my_post_types_to_query' );

function add_my_post_types_to_query( $query ) {
	if ( is_home() && $query->is_main_query() )
		$query->set( 'post_type', array( 'post', 'teasers' ) );
	return $query;
}
//*EOF CUSTOM POST TYPE

//*FOOTER MENU
function register_mZoo_menu() {
 register_nav_menus(
	array(
	'footer-menu' => __( 'Footer Menu' )
	)
	);
}

add_action( 'init', __NAMESPACE__ . '\register_mZoo_menu' );
//*

/*
 * Custom posts pagination
 * call like: <?php Extras\pagination_nav(); ?>
*/
function pagination_nav() {
    global $wp_query;

    if ( $wp_query->max_num_pages > 1 ) { ?>
        <nav class="pagination" role="navigation">
            <div class="nav-previous"><?php next_posts_link( '&larr; Older posts' ); ?></div>
            <div class="nav-next"><?php previous_posts_link( 'Newer posts &rarr;' ); ?></div>
        </nav>
<?php }
}

/*
 * Pagination bar to call like:
  <nav class="pagination">
  <?php Extras\pagination_bar(); ?>
  </nav>
*/
function pagination_bar() {
    global $wp_query;

    $total_pages = $wp_query->max_num_pages;

    if ($total_pages > 1){
        $current_page = max(1, get_query_var('paged'));

        echo paginate_links(array(
            'base' => get_pagenum_link(1) . '%_%',
            'format' => '/page/%#%',
            'current' => $current_page,
            'total' => $total_pages,
        ));
    }
}
