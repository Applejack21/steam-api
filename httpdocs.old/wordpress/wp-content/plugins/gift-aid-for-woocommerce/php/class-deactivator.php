<?php
/**
 * Deactivator Class.
 *
 * @since	1.3.0
 *
 * @package dtg\gift_aid_for_woocommerce
 */

namespace dtg\gift_aid_for_woocommerce;

/**
 * Class Deactivator
 *
 * Carry out actions when the plugin is activated.
 *
 * @since	1.3.0
 *
 * @package dtg\gift_aid_for_woocommerce
 */
class Deactivator {

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
	 * @since	1.3.0
	 */
	public function __construct() {
		$this->plugin_root 		 = DTG_GIFT_AID_ROOT;
		$this->plugin_name		 = DTG_GIFT_AID_NAME;
		$this->plugin_prefix     = DTG_GIFT_AID_PREFIX;
	}

	/**
	 * Unleash Hell.
	 *
	 * @since	1.3.0
	 */
	public function run() {
		// Register the deactivation callback.
		register_deactivation_hook( $this->plugin_root, array( $this, 'deactivate' ) );
	}

	/**
	 * Deactivate the plugin.
	 *
	 * @since	1.3.0
	 */
	public function deactivate() {
		// Set a transient to confirm activation.
		set_transient( $this->plugin_prefix . '_deactivated', true, 10 );
	}
}
