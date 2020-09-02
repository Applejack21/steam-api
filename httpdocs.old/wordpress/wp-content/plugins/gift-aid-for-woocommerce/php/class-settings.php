<?php
/**
 * Settings Class.
 *
 * @since	1.3.0
 *
 * @package dtg\gift_aid_for_woocommerce
 */

namespace dtg\gift_aid_for_woocommerce;

/**
 * Class Settings
 *
 * @since	1.3.0
 *
 * @package dtg\gift_aid_for_woocommerce
 */
class Settings {

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
		add_filter( 'woocommerce_get_sections_products', array( $this, 'add_section' ), 10 );
		add_filter( 'woocommerce_get_settings_products', array( $this, 'add_settings' ), 10, 2 );
		add_action( 'plugin_action_links_' . plugin_basename( $this->plugin_root ) , array( $this, 'add_setings_link' ) );
	}

	/**
	 * Create a Gift Aid section in the tab
	 *
	 * @param	array $sections An array of sections.
	 * @since	1.3.0
	 */
	public function add_section( $sections ) {
		$sections['gift_aid'] = apply_filters( $this->plugin_prefix . '_section_name', __( 'Gift Aid', 'gift-aid-for-woocommerce' ) );

		return $sections;
	}

	/**
	 * Add settings to our section
	 *
	 * @param	array $settings An array of settings.
	 * @since	1.3.0
	 */
	public function add_settings( $settings ) {
		global $current_section;

		if ( ! empty( $current_section ) && 'gift_aid' === $current_section ) {

			$settings_gift_aid = array();

			$settings_gift_aid[] = array(
				'title'  => __( 'Gift Aid', 'gift-aid-for-woocommerce' ),
				'type'  => 'title',
				'desc'  => __( 'If you\'re a charitable organisation based in the UK using WooCommerce to accept donations, it is highly likely that you need to give your donors the option to reclaim Gift Aid so that you can claim an extra 25p for every £1 they give. Once configured, this plugin will empower your donors to reclaim Gift Aid on their donations. Visit the <a href="https://www.gov.uk/donating-to-charity/gift-aid">GOV.UK Gift Aid</a> page for more information.', 'gift-aid-for-woocommerce' ),
				'id'    => 'gift_aid_section_title',
			);

			$settings_gift_aid[] = array(
				'title'  => __( 'Enable Gift Aid', 'gift-aid-for-woocommerce' ),
				'type'  => 'checkbox',
				'desc'  => __( 'Whether or not to enable Gift Aid at the checkout.', 'gift-aid-for-woocommerce' ),
				'id'    => 'gift_aid_checkbox',
				'class' => 'gift-aid-checkbox',
			);

			$settings_gift_aid[] = array(
				'title'  => __( 'Section Heading', 'gift-aid-for-woocommerce' ),
				'type'  => 'text',
				'desc'  => __( 'Optional heading for the Gift Aid section at the checkout. Defaults to "Reclaim Gift Aid".', 'gift-aid-for-woocommerce' ),
				'desc_tip' => true,
				'id'    => 'gift_aid_heading',
				'class' => 'gift-aid-heading',
			);

			$settings_gift_aid[] = array(
				'title'  => __( 'Checkbox Label', 'gift-aid-for-woocommerce' ),
				'type'  => 'text',
				'desc'  => __( 'Label for the checkbox. Must be populated in order for the Gift Aid option to appear at the checkout.', 'gift-aid-for-woocommerce' ),
				'desc_tip' => true,
				'id'    => 'gift_aid_label',
				'class' => 'gift-aid-label',
			);

			$settings_gift_aid[] = array(
				'title'  => __( 'Description', 'gift-aid-for-woocommerce' ),
				'type'  => 'textarea',
				'desc'  => __( 'Text explaining Gift Aid to the donor. Must be populated in order for the Gift Aid option to appear at the checkout.', 'gift-aid-for-woocommerce' ),
				'desc_tip' => true,
				'id'    => 'gift_aid_info',
				'class' => 'gift-aid-info',
			);

			$settings_gift_aid[] = array(
				'type' => 'sectionend',
				'id'   => 'gift_aid_section_end',
			);

			return apply_filters( $this->plugin_prefix . '_settings', $settings_gift_aid );
		} else {
			return apply_filters( $this->plugin_prefix . '_settings', $settings );
		}
	}

	/**
	 * Add 'Settings' action on installed plugin list.
	 *
	 * @param array $links An array of plugin action links.
	 *
	 * @since	1.3.0
	 */
	public function add_setings_link( $links ) {
		array_unshift( $links, '<a href="' . admin_url() . 'admin.php?page=wc-settings&tab=products&section=gift_aid">' . esc_html__( 'Settings', 'gift-aid-for-woocommerce' ) . '</a>' );

		return $links;
	}
}
