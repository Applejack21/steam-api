<?php
	/**
	 * Remove various head bits
	 */
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');
  	remove_action('wp_head', 'feed_links', 2);
  	remove_action('wp_head', 'feed_links_extra', 3);
  	remove_action('wp_head', 'wp_generator');
	remove_action('wp_head', 'wp_shortlink_wp_head');
	remove_action('wp_head', 'rest_output_link_wp_head', 10);
	remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
  	remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
	remove_action('template_redirect', 'rest_output_link_header', 11, 0);
	

	/**
	 * Remove jQuery
	 */
	if(!is_admin()) {
	    add_action( 'wp_enqueue_scripts', function(){
	        wp_deregister_script( 'jquery' );
	        wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js', array(), null, false );
	        wp_enqueue_script('jquery');
	    });
	}

	/**
	 * Remove widgets
	 */
	add_action('widgets_init', function() {
		unregister_widget('WP_Widget_Calendar');
		unregister_widget('WP_Widget_Recent_Comments');
	});

	/**
	 * Remove some dashboard bits
	 */
	add_action('admin_init', function() {
		remove_action('welcome_panel', 'wp_welcome_panel');
		remove_meta_box('dashboard_primary', 'dashboard', 'side');
		remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
	});

	/**
	 * 	Hide the WP version
	 */
	function remove_wp_version() {
		return '';
	}
	add_filter('the_generator', 'remove_wp_version');

	/**
	 * Strip the emojis
	 */
	add_action('init', function () {
		remove_action('wp_head', 'print_emoji_detection_script', 7);
		remove_action('wp_print_styles', 'print_emoji_styles');
		add_filter('emoji_svg_url', '__return_false');
		remove_action('admin_print_scripts', 'print_emoji_detection_script');
		remove_action('admin_print_styles', 'print_emoji_styles');
		add_filter('tiny_mce_plugins', function ($plugins) {
			if(is_array($plugins)) {
				return array_diff($plugins, array('wpemoji'));
			}
			return array();
		});
		remove_filter('the_content_feed', 'wp_staticize_emoji');
		remove_filter('comment_text_rss', 'wp_staticize_emoji');
		remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
	});

	/**
	 * Update the footer
	 */
	function remove_footer_admin () {
 		echo "Made with love by <a href='https://firecask.com/' target='_blank'>FireCask</a>";
	}
	add_filter('admin_footer_text', 'remove_footer_admin');

	/**
	 * Remove the Customise menu
	 */
	function remove_customise() {
		$request = urlencode($_SERVER['REQUEST_URI']);
		remove_submenu_page('themes.php', 'customize.php?return='. $request);
	}
	add_action('admin_menu', 'remove_customise');

	/**
	 * Block subscribers from accessing the admin
	 */
	function subscriber_no_admin_access() {
		$redirect = isset( $_SERVER['HTTP_REFERER'] ) ? $_SERVER['HTTP_REFERER'] : home_url( '/' );
		global $current_user;
		$user_roles = $current_user->roles;
		$user_role = array_shift($user_roles);
		if($user_role === 'subscriber'){
			exit( wp_redirect( $redirect ) );
		}
	}
	add_action('admin_init', 'subscriber_no_admin_access', 100);

	/**
	 * Disable the W3 cache comment
	 */
	add_filter('w3tc_can_print_comment', '__return_false', 10, 1);

	/** 
	* Add an browser and OS body classes
	**/
	function wt_browser_body_class($classes) {
		global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_edge, $is_chrome, $is_iphone;

		// Browser and os
		if($is_lynx) $classes[] = 'lynx';
		elseif($is_gecko) $classes[] = 'gecko';
		elseif($is_opera) $classes[] = 'opera';
		elseif($is_NS4) $classes[] = 'ns4';
		elseif($is_safari) $classes[] = 'safari';
		elseif($is_chrome) $classes[] = 'chrome';
		elseif($is_edge) $classes[] = 'edge';
		elseif($is_IE) {
			$classes[] = 'ie';
			if(preg_match('/MSIE ([0-9]+)([a-zA-Z0-9.]+)/', $_SERVER['HTTP_USER_AGENT'], $browser_version))
				$classes[] = 'ie'.$browser_version[1];
		} else $classes[] = 'unknown';

		if($is_iphone) $classes[] = 'iphone';

		if(stristr($_SERVER['HTTP_USER_AGENT'],"mac")) {
			$classes[] = 'osx';
		} elseif(stristr($_SERVER['HTTP_USER_AGENT'],"linux")) {
			$classes[] = 'linux';
		} elseif(stristr($_SERVER['HTTP_USER_AGENT'],"windows")) {
			$classes[] = 'windows';
		}

		// Now the site speific
		if(is_archive()) {
			if(is_post_type_archive('tests')) {
				$classes[] = 'archive';
			} else if(is_post_type_archive('news')) {
				$classes[] = 'archive';
			} else {
				$classes[] = 'single-brand';
			}
		} elseif(is_single()) {
			$pt = get_post_type();
			if($pt == "news") {
				$classes[] = 'single-post';
			} else if($pt == "products") {
				$classes[] = 'single-tyre';
			} else if($pt == "tests") {
			} else {
			}
		} elseif(is_tax()) {
			$classes[] = 'single-brand';
		} elseif(is_page('search-results')) {
			$classes[] = 'site-search-results';
		} elseif(is_page('search-tyres')) {
			$classes[] = 'tyre-search-results';
		} else {
		}

		return $classes;
	}
	add_filter('body_class','wt_browser_body_class');

	/** 
	* In case the server doesn't have allow_url_fopen enabled, use this instead of file_get_contents()
	**/
	function file_get_contents_curl($url, $retries=2) {
		$ua = 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.82 Safari/537.36';
		if (extension_loaded('curl') === true) {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url); // The URL to fetch. This can also be set when initializing a session with curl_init().
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); // TRUE to return the transfer as a string of the return value of curl_exec() instead of outputting it out directly.
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10); // The number of seconds to wait while trying to connect.
			curl_setopt($ch, CURLOPT_USERAGENT, $ua); // The contents of the "User-Agent: " header to be used in a HTTP request.
			curl_setopt($ch, CURLOPT_FAILONERROR, TRUE); // To fail silently if the HTTP code returned is greater than or equal to 400.
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE); // To follow any "Location: " header that the server sends as part of the HTTP header.
			curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE); // To automatically set the Referer: field in requests where it follows a Location: redirect.
			curl_setopt($ch, CURLOPT_TIMEOUT, 10); // The maximum number of seconds to allow cURL functions to execute.
			curl_setopt($ch, CURLOPT_MAXREDIRS, 5); // The maximum number of redirects
			$result = curl_exec($ch);
			curl_close($ch);
		} else {
			$result = file_get_contents($url);
		}        
		
		if (empty($result) === true) {
			$result = false;
			if ($retries >= 1) {
				sleep(1);
				return file_get_contents_curl($url, --$retries);
			}
		}    
		return $result;
	}

	/**
	 * Disable theme/plugin editors
	 */
	function disable_theme_editor() {
		define('DISALLOW_FILE_EDIT', TRUE);
	}
	add_action('init','disable_theme_editor');

	/**
	 * Extracts the src of an iframe element
	 */
	function get_iframe_src( $url ) {
		if ( !empty($url) ) {
			$doc = new DOMDocument();
			$doc->loadHTML( wp_oembed_get( $url ) );
			$imageTags = $doc->getElementsByTagName('iframe');

			$matches = [];

			foreach($imageTags as $tag) {
				$matches[] = $tag->getAttribute('src');
			}

			return $matches;
		}
	}

	/**
	 * Extracts the sizes of an iframe element
	 */
	function get_iframe_size( $url ) {
		if ( !empty($url) ) {
			$doc = new DOMDocument();
			$doc->loadHTML( wp_oembed_get( $url ) );
			$imageTags = $doc->getElementsByTagName('iframe');

			$matches = [];

			foreach($imageTags as $tag) {
				$matches['height'] = $tag->getAttribute('height');
				$matches['width'] = $tag->getAttribute('width');
			}

			return $matches;
		}
	}