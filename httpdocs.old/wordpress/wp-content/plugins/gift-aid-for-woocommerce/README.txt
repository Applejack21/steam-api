=== Gift Aid for WooCommerce ===
Contributors: davetgreen, mkdo
Tags: woocommerce, gift aid, charity, donations, donate
Requires at least: 4.3
Tested up to: 4.7.5
Stable tag: 1.3.5
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A plugin for WooCommerce that empowers donors to elect to reclaim Gift Aid at the checkout.

== Description ==

*Note:* Your web server needs to be running PHP version 5.4 in order to use this plugin.

If you're a charitable organisation based in the UK using WooCommerce to accept donations, it is highly likely that you need to give your donors the option to reclaim [Gift Aid](https://www.gov.uk/donating-to-charity/gift-aid) so that you can claim an extra 25p for every £1 they give.

Gift Aid for WooCommerce removes the need for any bespoke development to add this feature. Once installed, the plugin offers the following functionality:

- A new section is added to the checkout with a customisable Gift Aid explanation and accompanying checkbox empowering the donor to reclaim Gift Aid on their donation.
- Gift Aid markup is inserted via AJAX if the user switches from a non-UK country to the UK.
- If the donor elects to reclaim Gift Aid, confirmation of this will be added to both the order confirmation/thank you page and to the order confirmation email.
- Configurable settings added to the *Products* tab in the WooCommerce settings:
    - Checkbox to enable/disable the feature
    - Label for the checkbox e.g. 'Click here to reclaim Gift Aid'
    - Heading field for the Gift Aid section at the checkout (optional, defaults to 'Reclaim Gift Aid')
    - Description field to explain Gift Aid to the donor so that they can make a choice.
- Gift Aid column added to the *Orders* screen with a simple Yes/No to reflect the donor's choice.
- The donor's Gift Aid choice will be added to the order details section of the *Edit Order* screen.
- A Gift Aid column containing a simple Yes/No will be added automatically to CSV files exported using the WooCommerce [Order/Customer CSV Export](http://www.woothemes.com/products/ordercustomer-csv-export/) plugin.

Gift Aid for WooCommerce is also fully translatable in both the admin area and on the front-end.

== Requirements ==

Gift Aid for WooCommerce requires at least WooCommerce 2.2.3 to function correctly. Tested up to 3.0.8. PHP version 5.4 is also required, recommend version 5.6 or higher.

== Installation ==

1. Upload `gift-aid-for-woocommerce` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Configure the plugin in the 'Products' tab of the WooCommerce settings

== Changelog ==

= 1.3.5 =
* Bug fix: corrected logic issue affecting admin order email Gift Aid text.

= 1.3.4 =
* Bug fix: incorrect use of static keyword in checkout class causing fatal errors.

= 1.3.3 =
* Added minimum PHP version notice to README.

= 1.3.2 =
* Fixed settings issue that was causing a fatal error for some users.

= 1.3.1 =
* Bug fixes.

= 1.3.0 =
* Completed a full refactor of the underlying plugin structure, including some minor fixes/updates and the addition of several more developer filters.

= 1.2.4 =
* Refactored repository to work with Git to SVN deploy script.

= 1.2.3 =
* Fixed issue where checkbox and text were being removed at the checkout on document ready. Changed JS event listener to fire on window load. Resolves https://wordpress.org/support/topic/stopped-working-209/#post-8617364 and other similar tickets.

= 1.2.2 =
* Fixed 404s with admin area assets as highlighted in https://wordpress.org/support/topic/css-and-js-not-found?replies=3.

= 1.2.1 =
* Fixed bugs raised in https://wordpress.org/support/topic/css-and-js-not-found?replies=3. Fixed 404s with front-end assets and removed zero added to the AJAX response when the country is changed back to UK at the checkout.

= 1.2.0 =
* Refactored to comply with WordPress.org repo rules.

= 1.1.0 =
* Gift Aid markup inserted via AJAX if switching to the UK from another country.

= 1.0.0 =
* First stable release.

== Known Issues ==

Due to the fact that WooCommerce core is missing the ability to use the `woocommerce_get_settings_` filter to add settings to either the *checkout* or *tax* tabs we're having to put them in the *Products* tab for now.

Adding a dedicated tab just for this plugin's settings is overkill, so it's unlikely that this particular workaround will be implemented in the meantime.

Any future update to the plugin that changes the tab in which the settings can be found will have no impact on your saved settings or any of the advertised functionality.

== Roadmap ==

=1.4.0= *~June 2017*=
* Add a new section in WooCommerce->Reports with data providing a summary of total Gift Aid reclaimed over the specified time period.
* Add the total amount of Gift Aid that can be reclaimed to the checkout, thank you page and order emails.
* Move the settings panel into the Checkout tab.
* Convert the Gift Aid textarea in the plugin settings into a WYSIWYG.

=1.5.0= *~July 2017*=
* Add a dashboard widget to show the data made available in 1.4.0.
