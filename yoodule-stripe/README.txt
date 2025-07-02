=== Yoodule Stripe ===
Contributors: yourname
Tags: stripe, payments, datatables, admin, shortcode
Requires at least: 5.0
Tested up to: 6.5
Stable tag: 1.0
License: GPLv2 or later

== Description ==
Yoodule Stripe allows you to manage Stripe API credentials from the WordPress admin and display Stripe prices in a paginated, searchable DataTable using a shortcode. Easily switch between Stripe accounts by updating credentials in the admin menu.

== Features ==
* Admin menu for saving Stripe API credentials
* Shortcode [yoodule_stripe] to display Stripe prices in a DataTable
* Uses jQuery DataTables with server-side processing and AJAX
* Easily switch Stripe accounts by updating credentials

== Installation ==
1. Upload the plugin files to the `/wp-content/plugins/yoodule-stripe` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Use the 'Yoodule Stripe' menu in the admin to set your Stripe API credentials
4. Add the `[yoodule_stripe]` shortcode to any page or post

== Frequently Asked Questions ==
= How do I change Stripe accounts? =
Go to the Yoodule Stripe admin menu and update your API credentials.

= What data is shown in the table? =
All Stripe prices (ID, product, currency, amount, recurring status) are fetched and displayed.

== Changelog ==
= 1.0 =
* Initial release 