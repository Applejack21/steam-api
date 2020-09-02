<?php
/**
* Plugin Name: Plugin Name
* Plugin URI: https://www.something.com/
* Description: Custom plugin to something
* Tags: something, something
* Version: 0.0.1
* Requires at least: 5.0
* Tested up to: 5.2.3
* Author: R.Jones, FireCask
* Author URI: https://firecask.com
* Contributors: J Olczak, G Goodall
*/


if (!defined('ABSPATH'))  {
	die();
}

define('_PLUGIN_BASENAME_', plugin_basename(__FILE__));
define('_PLUGIN_PATH_', plugin_dir_path(__FILE__));
define('_PLUGIN_BASEFOLDER_', plugin_basename(dirname(__FILE__)));
$base = 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['HTTP_HOST'].'/';

if( ! class_exists( 'WP_List_Table' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
}

class Plug {
	##############################################
	# Init
	##############################################
	public function __construct() {
		$this->devMode();

		$this->activateSetup();
		$this->adminSetup();
		$this->deactivateSetup();
		$this->frontEndSetup();
		$this->acfSetup();
		$this->permalinkSetup();
		$this->ajaxSetup();
	}

	##############################################
	# DevMode
	##############################################
	public function devMode() {
		add_filter('http_request_args', array($this,'allow_unsafe_urls'));
	}

	public function allow_unsafe_urls ($args) {
		$args['reject_unsafe_urls'] = false;
		return $args;
	}

	##############################################
	# Activate Setup
	##############################################
	public function activateSetup() {
		register_activation_hook( __FILE__, array($this, 'activate'));
	}

	public function activate() {
	}

	##############################################
	# Admin Setup
	##############################################
	public function adminSetup() {
		add_filter("plugin_action_links_"._PLUGIN_BASENAME_, array($this, 'setupPluginMenus'));
		add_action('admin_menu', array($this, 'setupPluginOptions'));
		add_action('admin_enqueue_scripts', array($this,'enqueueAdminScripts'));
		add_action('admin_init', array($this,'registerSettings'));
	}

	public function enqueueAdminScripts() {
		wp_enqueue_script('plugin-admin-js', plugins_url('plugin-admin.js', __FILE__), array('jquery','jquery-form'), '0.1', true);
		wp_enqueue_style('plugin-admin-css', plugins_url('plugin-admin.css', __FILE__), null, '0.2');
	}

	public function setupPluginMenus($links) {
		$settings_link = '<a href="options-general.php?page=plugin-admin">'.__('Settings').'</a>';
		array_push($links,$settings_link);
		return $links;
	}

	public function setupPluginOptions() {
		$hook = add_menu_page('Plugin Settings', 'Plugin Settings', 'manage_options', 'plugin-admin', array($this, 'setupPluginSettingsPage'), 'dashicons-admin-generic', 3);
	}

	public function setupPluginSettingsPage() {
		require_once(ABSPATH.'wp-admin/includes/class-wp-list-table.php');
		include('plugin-settings.php');
	}

	public function registerSettings() {
	}

	##############################################
	# Deactivate
	##############################################
	public function deactivateSetup() {
		register_deactivation_hook(__FILE__,  array($this, 'deactivate'));
	}

	public function deactivate() {
	}

	##############################################
	# Front End
	##############################################
	public function frontEndSetup() {
        add_action('wp_enqueue_scripts', array($this,'enqueuePublicScripts'));
	}

	public function enqueuePublicScripts() {
	}

	##############################################
	# ACF
	##############################################
	public function acfSetup() {
	}

	##############################################
	# CPT
	##############################################
	public function createPostTypes() {
	}

	##############################################
	# Permalink Setup
	##############################################
	public function permalinkSetup() {
	}

	##############################################
	# AJAX Setup
	##############################################
	public function ajaxSetup() {
	}
}

####################################################
# Instantiate!
####################################################
$plug = new Plug();
