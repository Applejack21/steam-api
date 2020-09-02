<?php
	function nav_menus() {
		register_nav_menu('main-menu',__('Main Menu'));
		register_nav_menu('footer-menu',__('Footer Menu'));
	}
	add_action('init', 'nav_menus');