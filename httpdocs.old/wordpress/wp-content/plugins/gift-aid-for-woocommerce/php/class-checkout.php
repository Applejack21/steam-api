<?php
/**
 * Checkout Class.
 *
 * @since	1.3.0
 *
 * @package dtg\gift_aid_for_woocommerce
 */

namespace dtg\gift_aid_for_woocommerce;

/**
 * Class Checkout
 *
 * Checkout related functionality on the front-end.
 *
 * @since	1.3.0
 *
 * @package dtg\gift_aid_for_woocommerce
 */
class Checkout {

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
		// Add the fields to the checkout.
		add_action( 'woocommerce_after_order_notes', array( $this, 'insert_html' ), 10 );

		// AJAX hooks for front-end HTML generation.
		add_action( 'wp_ajax_add_to_checkout', array( $this, 'add_to_checkout' ), 10 );
		add_action( 'wp_ajax_nopriv_add_to_checkout', array( $this, 'add_to_checkout' ), 10 );

		// Add the meta data to the thank you page.
		add_action( 'woocommerce_thankyou', array( $this, 'add_to_thank_you' ), 10 );
	}

	/**
	 * Add a checkbox to choose Gift Aid at the checkout
	 * @since	1.3.0
	 */
	public function insert_html() {

		// Load the current checkout.
		$checkout = WC()->checkout();

		// Fetch our settings data.
		$gift_aid_checkbox    = get_option( 'gift_aid_checkbox' );
		$gift_aid_heading     = get_option( 'gift_aid_heading' );
		$gift_aid_description = get_option( 'gift_aid_info' );
		$gift_aid_label       = get_option( 'gift_aid_label' );

		// If the country code is 'GB' and all the settings have been configured.
		if ( ! empty( $gift_aid_checkbox ) && ! empty( $gift_aid_label ) && ! empty( $gift_aid_description ) ) {

			// If no heading has been set, we'll need a sensible default.
			if ( empty( $gift_aid_heading ) ) {
				$gift_aid_heading = __( 'Reclaim Gift Aid', 'gift-aid-for-woocommerce' );
			}

			// Create a new section.
			echo '<section id="woocommerce-gift-aid" class="gift-aid-section" aria-labelledby="gift-aid-heading" aria-describedby="gift-aid-description">';

			// Output the heading.
			echo '<h3 id="gift-aid-heading">' . esc_html( $gift_aid_heading ) . '</h3>';

			// Output the information.
			if ( ! empty( $gift_aid_description ) ) {
				echo '<div id="gift-aid-description">' . wp_kses_post( wpautop( $gift_aid_description ) ) . '</div>';
			}

			// Echo the checkbox field with label text.
			woocommerce_form_field( 'gift_aid_reclaimed', array(
				'type'      => 'checkbox',
				'class'     => array( 'input-checkbox' ),
				'label'     => esc_html( $gift_aid_label ),
				'required'  => false,
			), $checkout->get_value( 'gift_aid_reclaimed' ) );

			// Create a nonce that we can use in update_order_meta().
			wp_nonce_field( 'giftaidnonce_order', 'giftaid_order_security' );

			echo '</section>';
		}
	}

	/**
	 * Re-insert the checkbox when the country is changed back to UK.
	 *
	 * @since	1.3.0
	 */
	public function add_to_checkout() {

		// Load the current checkout.
		$checkout = WC()->checkout();

		// Fetch the selected country from the checkout object.
		$country = $checkout->get_value( 'billing_country' );

		// If the country code is 'GB'.
		if ( ! empty( $country ) && 'GB' === $country ) {

			// Add the HTML.
			$this->insert_html();

			// Check the nonce.
			check_ajax_referer( 'giftaid_ajax_security', 'security' );

			exit();
		}
	}

	/**
	 * Add confirmation of the donor's choice to reclaim Gift Aid to the thank you page.
	 *
	 * @param	integer $order_id Order ID.
	 * @since	1.3.0
	 */
	public function add_to_thank_you( $order_id ) {
		// Get the post meta containing the Gift Aid status.
		$status = get_post_meta( $order_id, 'gift_aid_reclaimed', true );

		// Set our confirmation message for the email.
		$message = apply_filters( $this->plugin_prefix . '_thankyou_page_message', __( 'You have chosen to reclaim Gift Aid.', 'gift-aid-for-woocommerce' ) );

		// If Gift Aid is to be reclaimed, confirm this at the top of the page.
		if ( ! empty( $status ) && 'Yes' === $status ) {
			echo '<p class="gift-aid-thank-you"><strong>' . esc_html( $message ) . '</strong></p>';
		}
	}
}
