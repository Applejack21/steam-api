<?php
/**
 * Customizer Class.
 *
 * @since	1.3.0
 *
 * @package dtg\gift_aid_for_woocommerce
 */

namespace dtg\gift_aid_for_woocommerce;

/**
 * Class Customizer
 *
 * Register Customizer settings, panels, section and controls.
 *
 * @since		1.3
 *
 * @package dtg\gift_aid_for_woocommerce
 */
class Customizer {

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
		// Handle Settings, Panels, Sections and Controls.
		add_action( 'customize_register', array( $this, 'customizer_settings' ), 10 );
		add_action( 'customize_register', array( $this, 'customizer_panels' ), 15 );
		add_action( 'customize_register', array( $this, 'customizer_sections' ), 20 );
		add_action( 'customize_register', array( $this, 'customizer_controls' ), 25 );
	}

	/**
	 * Register Customizer settings.
	 *
	 * @param	WP_Customize $wp_customize WordPress Customizer object.
	 *
	 * @since	1.3.0
	 */
	public function customizer_settings( $wp_customize ) {

	}

	/**
	 * Register Customizer panels.
	 *
	 * @param	WP_Customize $wp_customize WordPress Customizer object.
	 *
	 * @since	1.3.0
	 */
	public function customizer_panels( $wp_customize ) {

	}

	/**
	 * Register Customizer sections.
	 *
	 * @param	WP_Customize $wp_customize WordPress Customizer object.
	 *
	 * @since	1.3.0
	 */
	public function customizer_sections( $wp_customize ) {

	}

	/**
	 * Register Customizer controls.
	 *
	 * @param	WP_Customize $wp_customize WordPress Customizer object.
	 *
	 * @since	1.3.0
	 */
	public function customizer_controls( $wp_customize ) {

	}
}
