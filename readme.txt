=== Performable Connect ===
Contributors: dcancel
Donate link: http://davidcancel.com
Tags: tracking, stats, statistics, analytics, performable, connect, crm, marketing
Requires at least: 2.5
Tested up to: 2.5
Stable tag: 1.4

Allows you to easily add the necessary JavaScript code to enable Performable Connect Analytics.

== Description ==

Performable Connect adds the necessary JavaScript code to enable Performable Connect logging on any WordPress blog. This eliminates the need to edit your template code to enable Performable Connect.

**Features**

Performable Connect Has the Following Features:

- Inserts tracking code on all pages WordPress manages.
- Easy install: only need to know your Performable Site ID.
- Option to disable tracking of WordPress administrators.
- Can include tracking code in the footer, speeding up load times.
- Complete control over options; disable any feature if needed.

**Usage**

In your WordPress administration page go to Options > Performable Connect. From there enter your Performable Site ID and enable Connect. Information on how to obtain your Performable Site ID can be found on the options page.

Once you save your settings the JavaScript code should now be appearing on all of your WordPress pages.



== Installation ==

1. Upload the folder `performable-connect` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Configure the plugin at Options > Performable Connect


== Frequently Asked Questions ==

=Where is the Performable Analytics code displayed?=

The Performable Analytics code is added to the <head> section of your theme by default. It should be somewhere near the bottom of that section.

=Why don't I see the Performable Analytics code on my website?=

If you have switched off admin logging, you will not see the code. You can try enabling it temporarily or log out of your WordPress account to see if the code is displaying.


== Screenshots ==

1. This is a screen shot of the settings page.


== Changelog == 
= 1.0 =
* Initial version
= 1.1 =
* Readme changes
= 1.2 =
* Fixed bug in identify javascript method.
= 1.3 =
* Add Screenshot of settings page
* Modified id parameter to Connect API
= 1.4 =
* No changes just updating readme stable tag