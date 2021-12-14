=== Easy Twitter Feed ===
Contributors: abuhayat
Tags: Twitter Feed, Embed Twitter , Twitter Widget, follow button, tweet feed
Requires at least: 3.0
Tested up to: 5.8
Stable tag: 1.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Embed Twitter Timeline / Feed , Follow Button in Post, Page, Widget Area using shortCode. This plugin is liteweight but super powerful.


= shortCode =
== Twitter Timeline ==

Use following shortCode To Embed Twitter Timeline 

<pre>
[timeline username="YOUR_USERNAME"]
</pre> 
Only the username attribute is Required to Embed a Timeline. 
You can Customize the aperance of the timeline by following the ShortCode Below.
<pre>
[timeline username="YOUR_USERNAME" theme="light" width="300" height="400" title="My Timeline"]
</pre> 
* The theme attribute accept light and dark as a value.
* In height and width attribute, don't add PX

 
== Twitter Follow Button ==
Use following shortCode to Embed a follow button. 

<pre>
[follow_button username="YOUR_USERNAME"]
</pre>

You can customize the Follow button according the the shortCode below...

<pre>
[follow_button username="YOUR_USERNAME" size="large" count="false"]
</pre>

Size attribute accept large and small as a value, 
Set count="true" to Display total Followers Count in the Button



= Feedback = 
Liked that plugin? Hate it? Want a new feature?  [Send me some feedback](mailto: support@bplugins.com "Send feedback")  

= ⭐ Checkout our other WordPress Plugins- = 

🔥 **[Html5 Audio Player](https://audioplayerwp.com/)** – Best audio player plugin for WordPress.

🔥 **[Html5 Video Player](https://wpvideoplayer.com/)** – Best video player plugin for WordPress.

🔥 **[PDF Poster](http://pdfposter.com/)** – A fully-featured PDF Viewer Plugin for WordPresss.

🔥 **[StreamCast](https://wordpress.org/plugins/streamcast)** – A fully-featured Radio Player Plugin for WordPresss.

🔥 **[3D Viewer](https://3d-viewer.bplugins.com/)** – Display interactive 3D models on the webs.

== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Upload `plugin-directory` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Use shortcode in page, post or in widgets.
4. If you want player in your theme php, Place `<?php echo do_shortcode('YOUR_SHORTCODE'); ?>` in your templates




== Screenshots ==

1. Sidebar menu
2. UI
3. Player configuration 
4. Shortcode Generator 



== Changelog ==

= 1.0 =
* Initial Release
= 1.1 =
* Fixed Json error in Block Editor