<?php
function enqueue_scripts() {
	// Google Maps API
	// wp_enqueue_script( 'gmaps-api', '//maps.googleapis.com/maps/api/js?key=KEYHERE', null, null, true );

	// Custom JS
	wp_enqueue_script( 'custom-js', get_stylesheet_directory_uri() . '/assets/js/scripts.js', array('jquery'), 'v' . filemtime( get_stylesheet_directory() . '/assets/js/scripts.min.js'), true );

	// Default style
	wp_enqueue_style( 'theme-style', get_stylesheet_directory_uri() . '/assets/css/style.css', array(), 'v' . filemtime( get_stylesheet_directory() . '/assets/css/style.css'), 'all' );

	/* Telling the JS file where ajaxUrl is */
	wp_localize_script( 'custom-js', 'ajaxUrl', array( 
		'url' => admin_url() . 'admin-ajax.php',
	) );

}
add_action( 'wp_enqueue_scripts', 'enqueue_scripts');


function add_admin_style() {
	wp_enqueue_style( 'custom-admin-style', get_stylesheet_directory_uri() . '/style-admin.css', array(), 'v' . filemtime( get_stylesheet_directory() . '/style-admin.css'), 'all' );
}
add_action( 'admin_head', 'add_admin_style' );