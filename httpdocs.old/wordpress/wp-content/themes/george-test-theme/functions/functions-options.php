<?php
	if(function_exists('acf_add_options_page')) {
		acf_add_options_page(array(
			'page_title' => 'Site Settings',
			'menu_title' => 'Site Settings',
			'menu_slug' => 'firecask-settings',
			'capability' => 'edit_posts',
			'position' => 2,
			'redirect' => false,
			'autoload' => true
		));


		// Options page example for CPT archives
		// acf_add_options_sub_page(array(
	 //        'page_title'     => 'Job archive settings',
	 //        'menu_title'    => 'Job archive settings',
	 //        'menu_slug'    => 'job-archive-settings',
	 //        'parent_slug'    => 'edit.php?post_type=job',
	 //    ));
	}