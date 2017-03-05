=== Page Listing Categories ===
Contributors: infolabdevelopment
Donate link: https://www.paypal.me/infolabdevelopment
Tags: Page Listing Categories,PLC,wp_plc,wp,List,Categories,Woocommerce,Page,Category,Pages,Wordpress,Plugin
Requires at least: 2.7
Tested up to: 4.6.1
Stable tag: 0.1.3
License: Apache 2.0
License URI: http://www.apache.org/licenses/LICENSE-2.0.html

Lets you list the categories of your wordpress website on any page, entry sidebar or footer.

== Description ==

Page Listing Categories is a free WordPress plugin that gives you the ability to easily, efficiently and selectively display the product categories of your WooCommerce.

Page Listing categories also allows you to display your categories in any post or page using a simple shortcode, but that's not all; it also provides you with a widget so you can display them as a menu in any footer or sidebar.
When displaying the categories Page Listing Categories offers you different options of filtering so that you can list the data that you want how you want and where you want.

Either in the shortcode or in the widget, you can set the order of categories (ascending or descending) based on an ID, Name, Slug, Count, or a term group.

You can also hide empty categories, choose whether to show subcategories or not and even exclude one or more.

Author page: <a href="http://www.infolab.es">www.infolab.es</a>

== Installation ==

1. Upload the plugin files to the '/wp-content/plugins/page-listing-categories' directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Use the shortcode or the widget everywhere you want.

Shortcode usage:

Just place the shortcode [categories] in any page or post.

You can add the following filters:

- orderby (id, name, slug, count, term group)
- order (asc, desc)
- hide_empty (0, 1)
- show_subcategories (0,1) 
- exclude (ID1, ID2, ...)

Note: 0 means "No", 1 means "Yes".

Example: [categories orderby="slug" order = “asc” hide_empty=1 show_subcategories=1 exclude=”3324”]

Tip: You can get the category ID by entering the wordpress admin area, once there go to Products > Categories and click on the category you want to see the ID.
Once the page loads find the ID as a parameter in the URL.

== Frequently Asked Questions ==

= Where can I find Page Listing Categories documentation and user guides? =

For help setting up and configuring Page Listing Categories please refer to our [user guide](https://www.infolab.es/documentation/plugins/page-listing-categories/getting-started/)

= Can I use Page Listing Categories as a widget? =

Yes; It Works as a Widget too. 

= Will Page Listing Categories work with my theme? =

Yes; Page Listing Categories will work with any theme, but may require some styling to make it match nicely.

= Where can I report bugs or contribute to the project? =

Bugs can be reported on our plugin's wordpress page support tab (https://wordpress.org/support/plugin/page-listing-categories).

= Page Listing Categories is awesome! Can I contribute? =

Yes you can! This is a free plugin so we can not spend much time making improvements. Donations will allow us to continue developing it :)

== Screenshots ==

1. How the plugin looks on a Post or Page.
2. The widget front-end.
3. The widget settings.
4. The shortcode.


== Changelog ==
= 0.1.3 =
* Font-awesome included 
* Current categories bug fixed 
= 0.1.2 =
* Subcategories Image Bug Fixed
= 0.1.1 =
* Widget functionality added
= 0.1.0 =
* First Release

== Upgrade Notice ==

= 0.1.3 =
Currently, the plugin can only work with two levels of categories, we will improve it as soon as possible.