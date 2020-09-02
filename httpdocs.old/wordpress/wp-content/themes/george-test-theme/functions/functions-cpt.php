<?php
	function remove_default_post_type() {
		remove_menu_page('edit.php');
	}
	add_action('admin_menu', 'remove_default_post_type');

	function remove_default_post_type_menu_bar($wp_admin_bar) {
		$wp_admin_bar->remove_node('new-post');
	}
	add_action('admin_bar_menu', 'remove_default_post_type_menu_bar', 999);

	function remove_draft_widget() {
		remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
	}
	add_action('wp_dashboard_setup', 'remove_draft_widget', 999);

	// Blog
	function blog_post_type() {
		$labels = array(
			'name'                  => _x( 'Blog', 'Post Type General Name', 'firecask' ),
			'singular_name'         => _x( 'Blog', 'Post Type Singular Name', 'firecask' ),
			'menu_name'             => __( 'Blog', 'firecask' ),
			'name_admin_bar'        => __( 'Blog', 'firecask' ),
			'archives'              => __( 'Blog Archives', 'firecask' ),
			'attributes'            => __( 'Item Attributes', 'firecask' ),
			'parent_item_colon'     => __( 'Parent Item:', 'firecask' ),
			'all_items'             => __( 'All Items', 'firecask' ),
			'add_new_item'          => __( 'Add New Item', 'firecask' ),
			'add_new'               => __( 'Add New', 'firecask' ),
			'new_item'              => __( 'New Item', 'firecask' ),
			'edit_item'             => __( 'Edit Item', 'firecask' ),
			'update_item'           => __( 'Update Item', 'firecask' ),
			'view_item'             => __( 'View Item', 'firecask' ),
			'view_items'            => __( 'View Items', 'firecask' ),
			'search_items'          => __( 'Search Item', 'firecask' ),
			'not_found'             => __( 'Not found', 'firecask' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'firecask' ),
			'featured_image'        => __( 'Featured Image', 'firecask' ),
			'set_featured_image'    => __( 'Set featured image', 'firecask' ),
			'remove_featured_image' => __( 'Remove featured image', 'firecask' ),
			'use_featured_image'    => __( 'Use as featured image', 'firecask' ),
			'insert_into_item'      => __( 'Insert into item', 'firecask' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'firecask' ),
			'items_list'            => __( 'Items list', 'firecask' ),
			'items_list_navigation' => __( 'Items list navigation', 'firecask' ),
			'filter_items_list'     => __( 'Filter items list', 'firecask' ),
		);
		$args = array(
			'label'                 => __( 'Blog', 'firecask' ),
			'description'           => __( 'Blog articles', 'firecask' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'thumbnail', 'comments', 'revisions', 'author' ),
			'taxonomies'            => array( 'category' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 6,
			'menu_icon'             => 'dashicons-admin-post',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
			'rewrite'					=> array('with_front' => false)
		);
		register_post_type('blog', $args);
	}
	add_action('init', 'blog_post_type', 0);


function wpsites_comments() {
	add_post_type_support('blog', 'comments' );
}
add_action('init', 'wpsites_comments');