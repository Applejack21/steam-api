<?php
/**
 * Trait Render_View
 *
 * @since	1.3.0
 *
 * @package dtg\gift_aid_for_woocommerce
 */

namespace dtg\gift_aid_for_woocommerce;

/**
 * Helper_Render_View.
 *
 * @since	1.3.0
 *
 * @package dtg\gift_aid_for_woocommerce
 */
trait Helper_Render_View {

	/**
	 * Render View
	 *
	 * @param  string $file_name File to render.
	 * @return string            File to render.
	 */
	public static function render_view( $file_name ) {

		// Use the `_view_template_folder` filter to check for a custom location,
		// eg: `get_stylesheet_directory() . '/template-parts/ground-control/'`.
		$view_template_folder              = apply_filters( DTG_GIFT_AID_PREFIX . '_view_template_folder', '' );

		// You can also use the `_view_template_folder_check_exists` filter to
		// make sure that the file exists before loading.
		$view_template_folder_check_exists = apply_filters( DTG_GIFT_AID_PREFIX . '_view_template_folder_check_exists', false );

		// First set the template path to theh default location.
		$template_path = plugin_dir_path( __FILE__ ) . '../../views/' . $file_name . '.php';

		if ( ! empty( $view_template_folder ) && ! $view_template_folder_check_exists ) {

			// If the `$view_template_folder` is not empty, and we dont want to do a
			// fallback check, set the location (checking files exist can be expensive).
			$template_path = $view_template_folder . $file_name . '.php';

		} elseif ( ! empty( $view_template_folder ) && $view_template_folder_check_exists ) {

			// Otherwise check if the file exists first (useful if you only want to override
			// certain templates without copying the entire views folder to your given path).
			if ( ! file_exists( $view_template_folder . $file_name . '.php' ) ) {
				$template_path = $view_template_folder . $file_name . '.php';
			}
		}

		return $template_path;
	}
}
