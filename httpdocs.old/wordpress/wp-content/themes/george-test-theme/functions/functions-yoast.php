<?php
	/**
	 * Hide the yoast comments
	 */
	if (defined('WPSEO_VERSION')) {
		add_action('wp_head',function() { ob_start(function($o) {
			return preg_replace('/^\n?<!--.*?[Y]oast.*?-->\n?$/mi','',$o);
		}); },~PHP_INT_MAX);
	}

	/**
	 * Get rid of that yoast crap
	 */
	function quit_spammy_yoast() {
		echo '<style>#sidebar-container #sidebar {display:none}</style>';
	}
	add_action('admin_head', 'quit_spammy_yoast');

	/**
	 * Move the yoast metabox to the bottom of pages as it's annoying
	 */
	function yoast_to_bottom() {
		return 'low';
	}
	add_filter('wpseo_metabox_prio', 'yoast_to_bottom');