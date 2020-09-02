<?php
/**
 * Add favicon to the back end
 */
function add_site_favicon() {
    echo '<link rel="shortcut icon" href="' . get_stylesheet_directory_uri() . '/assets/images/fc-icon-square-32.png" />';
}
add_action('login_head', 'add_site_favicon');
add_action('admin_head', 'add_site_favicon');


/**
 * Remove admin bar margin from the top of HTML
 */
function remove_admin_bar_bump() {
	remove_action('wp_head', '_admin_bar_bump_cb');
}
add_action('get_header', 'remove_admin_bar_bump');


/**
 * Remove some bits from the user profiles
 */
function update_contact_methods( $contactmethods) {
    unset($contactmethods['linkedin']);
    unset($contactmethods['twitter']);
    unset($contactmethods['pinterest']);
    unset($contactmethods['instagram']);
    unset($contactmethods['facebook']);
    unset($contactmethods['url']);


    return $contactmethods;
}
add_filter('user_contactmethods', 'update_contact_methods');

function remove_personal_options($subject) {
	$subject = preg_replace('#<h2>'.__("Personal Options").'</h2>#s', '', $subject, 1);
	$subject = preg_replace('#<tr class="user-language-wrap(.*?)</tr>#s', '', $subject, 1);
	$subject = preg_replace('#<tr class="user-rich-editing-wrap(.*?)</tr>#s', '', $subject, 1);
	$subject = preg_replace('#<tr class="user-syntax-highlighting-wrap(.*?)</tr>#s', '', $subject, 1);
	$subject = preg_replace('#<tr class="user-comment-shortcuts-wrap(.*?)</tr>#s', '', $subject, 1);
	// $subject = preg_replace('#<tr class="show-admin-bar(.*?)</tr>#s', '', $subject, 1);
	$subject = preg_replace('#<h2>'.__("Name").'</h2>#s', '', $subject, 1);
	// $subject = preg_replace('#<tr class="user-display-name-wrap(.*?)</tr>#s', '', $subject, 1);
	$subject = preg_replace('#<h2>'.__("Contact Info").'</h2>#s', '', $subject, 1);
	$subject = preg_replace('#<tr class="user-url-wrap(.*?)</tr>#s', '', $subject, 1);
	$subject = preg_replace('#<h2>'.__("About Yourself").'</h2>#s', '', $subject, 1);
	$subject = preg_replace('#<tr class="user-description-wrap(.*?)</tr>#s', '', $subject, 1);
	$subject = preg_replace('#<tr class="user-profile-picture(.*?)</tr>#s', '', $subject, 1);
	return $subject;
}
ob_start('remove_personal_options');

remove_action('admin_color_scheme_picker', 'admin_color_scheme_picker');


function custom_login_style() {
	wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/style-login.css' );
}
add_action( 'login_enqueue_scripts', 'custom_login_style' );