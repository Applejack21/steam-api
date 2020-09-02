<?php
/**
 * Main Controller Class.
 *
 * @since	1.3.0
 *
 * @package dtg\gift_aid_for_woocommerce
 */

namespace dtg\gift_aid_for_woocommerce;

/**
 * Class Main_Controller
 *
 * @since	1.3.0
 *
 * @package dtg\gift_aid_for_woocommerce
 */
class Main_Controller {

	/**
	 * Take action on plugin activation.
	 *
	 * @var 	object
	 * @access	private
	 * @since	1.3.0
	 */
	private $activator;

	/**
	 * Take action on plugin deactivation.
	 *
	 * @var 	object
	 * @access	private
	 * @since	1.3.0
	 */
	private $deactivator;

	/**
	 * Take action on plugin uninstall.
	 *
	 * @var 	object
	 * @access	private
	 * @since	1.3.0
	 */
	private $uninstaller;

	/**
	 * Enqueue the public and admin assets.
	 *
	 * @var 	object
	 * @access	private
	 * @since	1.3.0
	 */
	private $assets_controller;

	/**
	 * Define the settings page.
	 *
	 * @var 	object
	 * @access	private
	 * @since	1.3.0
	 */
	private $settings;

	/**
	 * Define the Customizer options.
	 *
	 * @var 	object
	 * @access	private
	 * @since	1.3.0
	 */
	private $customizer;

	/**
	 * Order related functionality.
	 *
	 * @var 	object
	 * @access	private
	 * @since	1.3.0
	 */
	private $orders;

	/**
	 * Checkout related functionality.
	 *
	 * @var 	object
	 * @access	private
	 * @since	1.3.0
	 */
	private $checkout;

	/**
	 * CSV Export functionality.
	 *
	 * @var 	object
	 * @access	private
	 * @since	1.3.0
	 */
	private $csv_export;

	/**
	 * Path to the root plugin file.
	 *
	 * @var 	string
	 * @access	private
	 * @since	1.3.0
	 */
	private $plugin_root;

	/**
	 * Plugin name.
	 *
	 * @var 	string
	 * @access	private
	 * @since	1.3.0
	 */
	private $plugin_name;

	/**
	 * Plugin prefix.
	 *
	 * @var 	string
	 * @access	private
	 * @since	1.3.0
	 */
	private $plugin_prefix;

	/**
	 * Constructor.
	 *
	 * @param 	Settings		  $settings          Define the settings page.
	 * @param 	Activator		  $activator		 Take action on plugin activation.
	 * @param 	Deactivator		  $deactivator		 Take action on plugin deactivation.
	 * @param 	Uninstaller		  $uninstaller		 Take action on plugin uninstall.
	 * @param 	Notices			  $notices           Display notices in various conditions.
	 * @param 	Assets_Controller $assets_controller Enqueue the public and admin assets.
	 * @param 	Customizer		  $customizer        Define the customizer options.
	 * @param 	Orders			  $orders        	 Order related functionality.
	 * @param 	Checkout		  $checkout        	 Checkout related functionality.
	 * @param 	CSV_Export		  $csv_export        CSV Export functionality.
	 *
	 * @since 1.3.0
	 */
	public function __construct(
		Settings $settings,
		Activator $activator,
		Deactivator $deactivator,
		Uninstaller $uninstaller,
		Notices $notices,
		Assets_Controller $assets_controller,
		Customizer $customizer,
		Orders $orders,
		Checkout $checkout,
		CSV_Export $csv_export
		) {

		$this->plugin_root 		 	= DTG_GIFT_AID_ROOT;
		$this->plugin_name		 	= DTG_GIFT_AID_NAME;
		$this->plugin_prefix     	= DTG_GIFT_AID_PREFIX;

		$this->settings				= $settings;
		$this->activator			= $activator;
		$this->deactivator			= $deactivator;
		$this->uninstaller			= $uninstaller;
		$this->notices				= $notices;
		$this->assets_controller	= $assets_controller;
		$this->customizer			= $customizer;
		$this->orders				= $orders;
		$this->checkout				= $checkout;
		$this->csv_export			= $csv_export;
	}

	/**
	 * Unleash Hell.
	 *
	 * @since	1.3.0
	 */
	public function run() {
		load_plugin_textdomain(
			'gift-aid-for-woocommerce',
			false,
			$this->plugin_root . '/../languages'
		);

		$this->settings->run();
		$this->activator->run();
		$this->deactivator->run();
		$this->uninstaller->run();
		$this->notices->run();
		$this->assets_controller->run();
		$this->customizer->run();
		$this->orders->run();
		$this->checkout->run();
		$this->csv_export->run();
	}
}
