=== WP Meteor Page Speed Optimization Topping ===
Contributors: aguidrevitch
Donate link: 
Tags: pagespeed, optimization, performance, page, speed
Requires at least: 4.5
Tested up to: 5.8
Stable tag: trunk
Requires PHP: 5.6
License: GPLv3 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.html

2x-5x improvement in your Page Speed score. A completely new way of optimizing your page speed.

== Description ==

[![WP compatibility](https://plugintests.com/plugins/wporg/wp-meteor/wp-badge.svg)](https://plugintests.com/plugins/wporg/wp-meteor/latest) [![PHP compatibility](https://plugintests.com/plugins/wporg/wp-meteor/php-badge.svg)](https://plugintests.com/plugins/wporg/wp-meteor/latest)

WP Meteor is a completely new way of optimizing your page speed. It works even on top of your existing optimizations, including:

* Autoptimize
* WP Rocket
* WP Total Cache
* WP Super Cache
* LiteSpeed Cache

WP Meteor is not compatible with:

* Nitropack

WP Meteor is known to have delay issues with:

* Elementor Offcanvas addon

= WARNING =

The plugin might not work for someone, that's expected - delaying scripts has its downsides. Also, the plugin logics is quite complicated, so bugs happen.

If your site is business-critical or e-commerce, please test carefully all your business-critical pages, forms and/or your checkout process. Feel free to [create an Issue](https://wordpress.org/support/plugin/wp-meteor/#new-topic-0) if something doesn't work.

The plugin is made to leave no trace on the disk or in the database upon deactivation and removal, so don't hesitate to install and test, may be your site suits well for that kind of optimization.

Don't forget to test the site carefully after plugin installation. If you are not happy with the result - you can either uninstall the plugin, or [create an Issue](https://wordpress.org/support/plugin/wp-meteor/#new-topic-0), I will either fix the problem, or list a compatibility issue here.

= ONE MORE WARNING =

Infinite delay will delay your GA and GTM until user interaction. I would not recommed to use it, but it is still there because multiple users requested it. Use it with caution and at your own risk. 

= HOW IT WORKS =

If user doesn't start interacting with page immediately, WP Meteor postpones loading and firing scripts until after page gets rendered, giving you **2x-5x** boost in your Pagespeed metric.

This postponement in script loading greatly improves perceived load times for your visitors. It also significantly improves the following **important SEO metrics**:

* [Page Speed](https://developers.google.com/speed/pagespeed/insights/)
* [Largest Contentful Paint (LCP)](https://web.dev/lcp/)
* [Time To Interactive (TTI)](https://web.dev/tti/)
* [Total Blocking Time (TBT)](https://web.dev/tbt/)

In May 2021, Google will incorporate [multiple page speed metrics](https://developers.google.com/search/blog/2020/11/timing-for-page-experience) as a search signal in the ranking algorythm

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/wp-meteor` directory, or install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the 'Plugins' screen in WordPress
1. Use the Settings -> WP Meteor screen to configure the plugin


== Frequently Asked Questions ==

= Is it good for SEO? =

Yes, because all that matters is visitor experience, and WP Meteor improves that experience with a lot faster load times

= How can I easily compare speed with/without WP Meteor ? =

Once WP Meteor is enabled, you can add **?wpmeteordisable** query string parameter to a page URL in order to load the page without optimizations

= How to exclude a page from optimization =

Use `wpmeteor_enabled` filter and return false to completely disable WP Meteor, example:

    add_filter('wpmeteor_enabled', function ($value) {
        global $post;
        if ($post && $post->ID == 1) {
            return false;
        }
        return $value;
    });

= How to exclude a script from optimization =

1. Use 'Exclude' tab to exclude scripts by matching src or inline content using regexp
1. Use `wpmeteor_exclude` filter, which accepts 2 arguments: $exclude and $content. $content variable contains either src attribute, or text content of the script tag. Return true if you want to exclude the script. Example:


`    add_filter('wpmeteor_exclude', function ($exclude, $content) {
        if (preg_match('/yourscript\.js/', $content)) {
            return true;
        }
        return $exclude;
    }, null, 2);`


Alternatively, you can use data-wpmeteor-nooptimize="true" script attribute to exclude it from optimization. 


= How to adjust delay outside of 1s, 2s and Infinity =

Use `wpmeteor-frontend-adjust-wpmeteor` filter in the following way:


    add_filter('wp-meteor-frontend-adjust-wpmeteor', function ($wpmeteor, $settings) {
        $wpmeteor['rdelay'] = 4000; // number of milliseconds to delay 
        return $wpmeteor;
    }, 100, 2);

== Changelog ==

2.3.10 - WP Fastest Cache compatibility
2.3.9 - Regexp exlusions fixed
2.3.8 - event queue should not be processed if script loading is in progress [Issue](https://wordpress.org/support/topic/meteor-blocks-contact-form-email/)
2.3.7 - defer converted to data-defer for standards compliance
2.3.6 - Support for missing <head> tag
2.3.5 - Better readyState management
2.3.4 - Lazy Images by Jetpack support added
2.3.3 - Compatibility with PhastPress if 'Load scripts asynchronously' is disabled
2.3.2 - Support for unquoted src and type script attributes
2.3.1 - Images lazyloading fixed for [Swift Performance](https://wordpress.org/plugins/swift-performance-lite/) 
2.3.0 - window messaging support added, multiple improvements into event handling
2.2.21 - [Swift Performance](https://wordpress.org/plugins/swift-performance-lite/) support added
2.2.20 - [Breeze](https://wordpress.org/plugins/breeze/) support added
2.2.19 - jQueryMock returned, to fire jQuery.ready early
2.2.18 - minor fixes
2.2.17 - document.write now properly processes inserted scripts
2.2.16 - better AJAX calls detection
2.2.15 - better readyState tracking, getting rid of jQueryMock
2.2.14 - Support for onreadystatechange property of document
2.2.13 - Bugfix in event queue management introduced in 2.2.12
2.2.12 - Important bugfix in event queue management
2.2.11 - [Meta Slider support](https://wordpress.org/support/topic/meta-slider-support/) and general compatibility improvements
2.2.10 - Bugfix
2.2.9 - Bugfix
2.2.8 - Memory usage optimization
2.2.7 - [Elementor error fixed](https://wordpress.org/support/topic/critical-error-with-elementor-2/)
2.2.6 - [Newrelic forced exclusion](https://wordpress.org/support/topic/gravity-forms-cannot-be-submitted/)
2.2.5 - [Avada Theme compatibility](https://wordpress.org/support/topic/wp-meteor-conflict-with-avada-builder/)
2.2.4 - [Swift Performance](https://wordpress.org/plugins/swift-performance-lite/) compatibility
2.2.3 - Readme updated
2.2.2 - CloudFlare RocketLoader compatibility [Issue](https://wordpress.org/support/topic/not-clickable-menu-links-and-products/) fixed
2.2.1 - [Issue](https://plugintests.com/plugins/wporg/wp-meteor/2.2.0) fixed
2.2.0 - UI to exclude scripts
2.1.4 - Tracking for natively lazyloaded images improved
2.1.3 - Getting rid of built-in lazyload handling in favor of native one. Refactoring
2.1.2 - Cloudflare Rocket Loader compatibility fixes
2.1.1 - Backend support for wpmeteor_exclude filter, also fixes Fast Velocity css preload in a different way [Issue](https://wordpress.org/support/topic/rendering-delay-with-google-fonts-and-autoptimize/)
2.1.0 - Event redispatching improved, compatibility fixes, refactoring
2.0.5 - Better Fast Velocity Minify compatibility
2.0.4 - Minor CSS rewriting fix
2.0.3 - Support for onload properties of window, document and body [Issue](https://wordpress.org/support/topic/issue-with-woodmart-theme/)
2.0.2 - Support for onload events in <link rel="stylesheet"> [Issue](https://wordpress.org/support/topic/issues-with-fast-velocity-minify-plugin-merge-fonts-and-icons-separately/)
2.0.1 - Rewrite inside script tags fixed [Issue](https://wordpress.org/support/topic/wp-meteor-affecting-script-tag-inside-script-tag-in-a-woocommerce-site/)
2.0.0 - Major script loading logics update
1.5.7 - Missing files added
1.5.6 - Moving <meta charset> before code to conform to Web Vitals best practices [Issue](https://wordpress.org/support/topic/position-of-var-_wpmeteor-in-the-code/)
1.5.5 - Skip rewrite of content, other than text/html
1.5.4 - Improved detection of CloudFlare, better/safer script rewrites, dropping support for rocket_buffer
1.5.3 - SEOPress sitemaps.xml fix [Issue](https://wordpress.org/support/topic/sitemap-seopress-error-after-wp-meteor/)
1.5.2 - Prevent clicks during touchmove, RTL support added
1.5.1 - Emulate Elementor Powerpack Pro menu
1.5.0 - wpmeteor_enabled filter added, to allow to disable optimizations ocasionally
1.4.9 - document.write override allowed for those who know how to do it better (egDivi editor)
1.4.8 - Divi theme builder compatibility fixed
1.4.7 - SiteGround Optimizer + WP Rocket issue fixed
1.4.6 - Elementor Offcanvas double animation fix [Issue](https://wordpress.org/support/topic/menu-submenu-not-showing-in-elementor/)
1.4.5 - Elementor Offcanvas animations suppressed [Issue](https://wordpress.org/support/topic/menu-submenu-not-showing-in-elementor/)
1.4.4 - Elementor Entrance Animations issues fixed
1.4.3 - Elementor Entrance Animations support added
1.4.2 - Removed override for currentTarget for replayed events, fixes some navigation menus
1.4.1 - For WP Rocket compatibility, using rocket_buffer filter to inject javascript
1.4.0 - Getting rid of { passive: true } for replayed pointer events
1.3.9 - DOMContentLoaded propagation to window object, proper event handler bindings
1.3.8 - Better fronted detection to avoid rewriting AJAX and REST requests
1.3.7 - Proper contexts for domcontentloaded and window.onload event handlers
1.3.6 - Better jQuery.ready handling
1.3.5 - CookieBot compatibility [Issue](https://wordpress.org/support/topic/error-with-my-website-2/) fixed 
1.3.4 - Stopping click propagation when capturing events [Issue](https://wordpress.org/support/topic/great-plugin-but-causes-double-tap-issue-with-safari/)
1.3.3 - Better script loading in Firefox, scripts with both src and inline loading fixed [Issue](https://wordpress.org/support/topic/checkout-page-error-12/)
1.3.2 - Better delayed events for mobile [Issue](https://wordpress.org/support/topic/great-plugin-but-causes-double-tap-issue-with-safari/)
1.3.1 - Click handling in mobile safari improved [Issue](https://wordpress.org/support/topic/great-plugin-but-causes-double-tap-issue-with-safari/)
1.3.0 - Gutenberg save failure fixed
1.2.9 - jQuery mockup fixed to support window.load inside ready() function
1.2.8 - Bug breaking header tags fixed
1.2.7 - Phastpress compatibility dropped
1.2.6 - Minor improvement to fire domcontentloaded and window.onload for non-optimized scripts
1.2.5 - Support for Autoptimize native lazyload
1.2.4 - Delayed click/mouseover/mouseout events support added
1.2.3 - Native WP Rocket lazyload support
1.2.2 - Phastpress compatibility
1.2.1 - stripped lazysizes added in, with bgsizes plugin
1.2.0 - minor cleanup
1.1.9 - simple lazyload polyfill
1.1.8 - infinite delay added
1.1.7 - rewriting redone to support Google AMP and other plugins that initialize late
1.1.6 - working support Beaver Builder / Edit Mode
1.1.5 - working support Elementor / Edit Mode, Google AMP, AMP for WP
1.1.4 - support for Elementor / Edit Mode
1.1.3 - support for AMP for WP plugin added
1.1.2 - support for Google AMP plugin added
1.1.1 - readme.txt updated, warning added that it might not work for someone
1.1.0 - JetPack compatibility fixes
1.0.9 - ?wpmeteornopreload added to allow testing disabling preload
1.0.8 - data-cfasync="false" added to optimized scripts if behind CloudFlare
1.0.7 - ?wpmeteorcfasync parameter added to test disabling CloudFlare optimizations
1.0.6 - another iteration on domcontentloaded and window.onload handlers, jQuery mock rewrite
1.0.5 - better handling for broken domcontentloaded and window.onload handlers, better jQuery mock
1.0.4 - better cleanup on plugin deactivation
1.0.3 - readme.txt updated
1.0.2 - readme.txt updated
1.0.1 - minor Settings panel improvements
1.0.0 - initial release
