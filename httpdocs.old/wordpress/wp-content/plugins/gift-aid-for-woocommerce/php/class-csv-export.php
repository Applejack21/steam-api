<?php
/**
 * CSV Export Class.
 *
 * @since	1.3.0
 *
 * @package dtg\gift_aid_for_woocommerce
 */

namespace dtg\gift_aid_for_woocommerce;

/**
 * Class CSV_Export
 *
 * Provide functionality related to the
 * WooCommerce Customer/Order CSV Export plugin.
 *
 * @since	1.3.0
 *
 * @package dtg\gift_aid_for_woocommerce
 */
class CSV_Export {

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
		// Add a Gift Aid column to the output of the WooCommerce CSV Export plugin if it is active.
		if ( in_array( 'woocommerce-customer-order-csv-export/woocommerce-customer-order-csv-export.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
			add_filter( 'wc_customer_order_csv_export_order_headers', array( $this, 'wc_csv_export_modify_column_headers' ), 10 );
			add_filter( 'wc_customer_order_csv_export_order_row', array( $this, 'wc_csv_export_modify_row_data' ), 10, 3 );
		}
	}

	/**
	 * Create a WooCommerce Customer/Order CSV Export column for the Gift Aid status
	 *
	 * @param	array $column_headers Array of column headers.
	 * @since	1.3.0
	 */
	public function wc_csv_export_modify_column_headers( $column_headers ) {
		// Add the new Gift Aid column.
		$new_headers = array(
			'reclaim_gift_aid' => 'reclaim_gift_aid',
		);

		return array_merge( $column_headers, $new_headers );
	}

	/**
	 * Populate the WooCommerce Customer/Order CSV Export column with the Gift Aid status
	 *
	 * @param	array  $order_data Array of column headers.
	 * @param	array  $order Array of column headers.
	 * @param	object $csv_generator Array of column headers.
	 * @since	1.3.0
	 */
	public function wc_csv_export_modify_row_data( $order_data, $order, $csv_generator ) {
		// Get the post meta containing the Gift Aid status.
		$status = get_post_meta( $order->id, 'gift_aid_reclaimed', true );

		// Add a fallback of "No" if no source is available.
		$status = ( ! empty( $status ) ? $status : __( 'No', 'gift-aid-for-woocommerce' ) );

		// Prepare our data to be added to the column.
		$custom_data = array(
			'reclaim_gift_aid' => $status,
		);

		// Merge our data with the existing row data.
		$new_order_data = array();

		if ( isset( $csv_generator->order_format ) && ( 'default_one_row_per_item' == $csv_generator->order_format || 'legacy_one_row_per_item' == $csv_generator->order_format ) ) {

			foreach ( $order_data as $data ) {
				$new_order_data[] = array_merge( (array) $data, $custom_data );
			}
		} else {
			$new_order_data = array_merge( $order_data, $custom_data );
		}

		return $new_order_data;
	}
}
