<?php
	add_theme_support('post-thumbnails');
	// add_image_size( 'anexsys-vertical-thumbnail', 296, 478, array('center', 'center') );

	/**
	 * Fix width and height attributes when displaying SVG images on the front end
	 */
	function fix_wp_get_attachment_image_svg($image, $attachment_id, $size, $icon) {
		$url = $image[0];
			$ch = curl_init();
			curl_setopt ($ch, CURLOPT_URL, $url);
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_HEADER, false);
			$xml = curl_exec($ch);

			$xml = simplexml_load_string($xml);

			if (is_array($image) && preg_match('/\.svg$/i', $image[0]) && $image[1] <= 1) {
				if(is_array($size)) {
					$image[1] = $size[0];
					$image[2] = $size[1];
				} elseif(($xml) !== false) {
					$attr = $xml->attributes();
					$viewbox = explode(' ', $attr->viewBox);
					$image[1] = isset($attr->width) && preg_match('/\d+/', $attr->width, $value) ? (int) $value[0] : (count($viewbox) == 4 ? (int) $viewbox[2] : null);
					$image[2] = isset($attr->height) && preg_match('/\d+/', $attr->height, $value) ? (int) $value[0] : (count($viewbox) == 4 ? (int) $viewbox[3] : null);
				} else {
					$image[1] = $image[2] = null;
				}
			}
			return $image;
	} 
	// add_filter( 'wp_get_attachment_image_src', 'fix_wp_get_attachment_image_svg', 10, 4 );