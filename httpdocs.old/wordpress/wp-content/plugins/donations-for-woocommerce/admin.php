<?php
echo('
	<div class="wrap">
		<h2>'.__('Donations for WooCommerce', 'donations-for-woocommerce').'</h2>
		<h3>'.__('Usage Instructions', 'donations-for-woocommerce').'</h3>
		<p>'.esc_html__('Simply create a new WooCommerce product for each type of donation you would like to accept. Under Product Data, set the product type to "Donation". Optionally, set the default donation amount in the General section. You\'ll probably also want to ensure that product reviews are disabled in the Advanced section. That\'s all!', 'donations-for-woocommerce').'</p>
		<h3 style="margin-bottom: 0;">'.__('Settings', 'donations-for-woocommerce').'</h3>
		<form action="" method="post">
			<input type="hidden" name="save" value="1" />
			<table class="form-table" style="margin-bottom: 30px;">
				<tr valign="top">
					<th scope="row">
						<label>'.__('Checkout', 'donations-for-woocommerce').':</label>
					</th>
					<td>
						<label>
							<input type="checkbox" name="disable_cart_amount_field"'.(hm_wcdon_get_option('disable_cart_amount_field') ? ' checked="checked"' : '').' />
							'.__('Disable donation amount field in cart', 'donations-for-woocommerce').'
						</label>
					</td>
				</tr>
				<tr valign="top">
					<th colspan="2">
						<button type="submit" class="button-primary">'.__('Save Settings', 'donations-for-woocommerce').'</button>
					</th>
				</tr>
			</table>
		</form>
');
$potent_slug = 'donations-for-woocommerce';
include(__DIR__.'/plugin-credit.php');
echo('
	</div>
');
?>