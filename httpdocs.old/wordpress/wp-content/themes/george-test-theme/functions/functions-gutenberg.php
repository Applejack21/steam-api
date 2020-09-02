<?php
	###==-----------------------------------------------------------------
	# FireCask Gutenberg functions file
	# Last updated 16/10/2019
	# V0.2
	###==-----------------------------------------------------------------

	/**
	 * Basic ACF block register custom blocks
	 * https://www.advancedcustomfields.com/resources/acf_register_block_type/
	 * Any number of blocks can be registered here, don't make repeated calls to acf/init as race conditions will happen
	 */
	function registerAcfBlockTypes() {
		acf_register_block_type(array(
			'name' => 'testimonial',
			'title' => __('Testimonial'),
			'description' => __('A custom testimonial block.'),
			'category' => 'firecask-theme-slug',										# common | formatting | layout | widgets | embed
			'icon' => 'admin-comments',													# https://developer.wordpress.org/resource/dashicons
			'keywords' => array('testimonial', 'quote'),								# search terms
			'post_types' => array('post', 'page'),										# CPTs etc must match the category if using custom (see registerAcfBlockCategories())
			'mode' => 'edit',															# edit | preview | auto
			'render_template' => 'template-parts/blocks/testimonial/testimonial.php',
			'supports' => array(
				'align' => false,														# disallow the alignment buttons
				'mode' => false, 														# disallow the mode switch
				'multiple' => false 													# only allow one of this block
			),
			'enqueue_assets' => function(){
				wp_enqueue_style('block-testimonial', get_template_directory_uri().'/template-parts/blocks/testimonial/css/output/testimonial.css');
				wp_enqueue_script('block-testimonial', get_template_directory_uri().'/template-parts/blocks/testimonial/js/output/testimonial.js', array('jquery'), '', true);
			}
		));
	}
	add_action('acf/init', 'registerAcfBlockTypes');

	/**
	 * Basic category register, this allows different blocks to only be applied on certain post/page types
	 * https://developer.wordpress.org/block-editor/developers/filters/block-filters/#managing-block-categories
	 * Any number of categories can be registered here, don't make repeated calls to block_categories as race conditions will happen
	 */
	function registerBlockCategories($categories, $post) {
		// Do a switch depending on CPTs/Options/Pages etc
		if($post->post_type !== 'page' ) {
			return $categories;
		}

		return array_merge(
			$categories, array(
			array(
				'slug' => 'firecask-theme-slug',
				'title' => __('Firecask', 'blah'),
				'icon'  => 'wordpress',
			)
		));
	}
	add_filter('block_categories', 'registerBlockCategories', 10, 2);


	/**
	 * Basic only allow certain blocks, this is the full list including woocommerce product blocks
	 * https://rudrastyh.com/gutenberg/remove-default-blocks.html
	 */
	function allowedBlocks($allowed_blocks) {
		return array(
			'core/audio',
			'core/button',
			'core/archives',
			'core/calendar',
			'core/categories',
			'core/code',
			'core/cover',
			'core/embed',
			'core/file',
			'core/freeform',
			'core/gallery',
			'core/heading',
			'core/html',
			'core/image',
			'core/latest-comments',
			'core/latest-posts',
			'core/list',
			'core/media-text',
			'core/more',
			'core/nextpage',
			'core/paragraph',
			'core/preformatted',
			'core/pullquote',
			'core/quote',
			'core/rss',
			'core/search',
			'core/separator',
			'core/shortcode',
			'core/spacer',
			'core/table',
			'core/tag-cloud',
			'core/text-columns',
			'core/verse',
			'core/video',
			'core-embed/animoto',
			'core-embed/cloudup',
			'core-embed/collegehumor',
			'core-embed/dailymotion',
			'core-embed/facebook',
			'core-embed/flickr',
			'core-embed/funnyordie',
			'core-embed/hulu',
			'core-embed/imgur',
			'core-embed/instagram',
			'core-embed/issuu',
			'core-embed/kickstarter',
			'core-embed/meetup-com',
			'core-embed/mixcloud',
			'core-embed/photobucket',
			'core-embed/polldaddy',
			'core-embed/reddit',
			'core-embed/reverbnation',
			'core-embed/screencast',
			'core-embed/scribd',
			'core-embed/slideshare',
			'core-embed/smugmug',
			'core-embed/soundcloud',
			'core-embed/speaker',
			'core-embed/spotify',
			'core-embed/ted',
			'core-embed/tumblr',
			'core-embed/twitter',
			'core-embed/videopress',
			'core-embed/vimeo',
			'core-embed/wordpress',
			'core-embed/wordpress-tv',
			'core-embed/youtube',

			'woocommerce',
			'woocommerce/all-reviews',
			'woocommerce/featured-category',
			'woocommerce/handpicked-products',
			'woocommerce/product-best-sellers',
			'woocommerce/product-categories',
			'woocommerce/product-category',
			'woocommerce/product-new',
			'woocommerce/product-on-sale',
			'woocommerce/product-search',
			'woocommerce/product-tag',
			'woocommerce/product-top-rated',
			'woocommerce/products-by-attribute',
			'woocommerce/reviews-by-category',
			'woocommerce/reviews-by-product'
		);
	}
	add_filter('allowed_block_types', 'allowedBlocks');


	/**
	 * Basic wrap all blocks in divs, taking the blockName and setting it as a class
	 * Core blocks all have the class default-*
	 * Core embed blocks all have the class default-embed-*
	 * Paragrahs have the class default-p
	 * Woo blocks all have the class woo-*
	 * Any other is based on the theme or plugin
	 */
	function wrapAllBlockInDiv($block_content, $block) {
		$block_name = $block['blockName'];
		$block_class = "";
		$block_exploded = explode("/", $block_name);

		if(strpos($block_name, 'core-embed') !== false) {
			$block_class = "default-embed-".$block_exploded[1];
		} else if(strpos($block_name, 'core') !== false) {
			$block_class = "default-".$block_exploded[1];
		} else if(strpos($block_name, 'woocommerce') !== false) {
			$block_class = "woo-".$block_exploded[1];
		} else {
			if(count($block_exploded) <= 0) {
				echo "nkdfsl";
				$block_class = "default-p";
			} else {
				return $block_content;
			}
		}
		$block_content = sprintf('<div class="%1$s">%2$s</div>', $block_class, $block_content);
		return $block_content;
	}
	add_filter('render_block', 'wrapAllBlockInDiv', 10, 2);
