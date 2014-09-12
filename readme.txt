=== What's running ===
Contributors: szepeviktor
Donate link: https://szepe.net/wp-donate/
Tags: debug, debugging, developer, development, performance, profiler, profiling
Requires at least: 3.5
Tested up to: 4.0
Stable tag: 1.8
License: GPLv2

Lists WordPress require() calls mainly for plugin code refactoring

== Description ==

= Only for development! =

This plugin dumps the colorized filenames and filesizes after the normal WordPress output, after the closing html tag.
This generates invalid HTML but gives you an overview of loaded plugins and the current theme.

*What's running* lists all files parsed and executed by the PHP engine.
It can be used for plugin or theme refactoring.

= Now you can highlight your own plugin and theme =

Provide a part of its path in wp-config.php:

`define( 'WHATS_RUNNING_HIGHLIGHT', 'wp-content/plugins/my-plugin' );`

= Color codes =

* your code is highlighted with YELLOW background
* plugin files are in BLUE
* themes files are in ORANGE
* files in the wp-includes directory are in GREEN
* files in the wp-admin directory are in GREY
* all other files are in RED
* the PINK bar after the filename represents the file size ( 0.5 kB/px )

= Links =

You can watch [WP core bug #28364](https://core.trac.wordpress.org/ticket/28364) to get more information
about [WordPress entry points](https://github.com/szepeviktor/WPHW/blob/master/wp-entry-points.md).

You can find some documentaion here what makes a WordPress plugin efficient:
https://github.com/szepeviktor/WPHW

[GitHub repo](https://github.com/szepeviktor/whats-running)

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload `wp-requires.php` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

= It messes up my backend, frontend! =

After finishing the refactor, please deactivate and delete this plugin.

== Screenshots ==

1. This is an old screen shot. You can see the filenames after the admin footer.
2. This is the current screen shot of the plugin's output on the dashboard. The colored bars represent the file sizes.
3. You can see some lines highlighted with the WHATS_RUNNING_HIGHLIGHT define.

== Changelog ==

= 1.8 =
* Changed wrapper element to div with id "whats-running"
* Added feature to highlight your code.

= 1.7 =
* Added size in kB to the title of the file size lines

= 1.6 =
* Added file sizes and total file size

= 1.5 =
* Added inline styles
* Link to WP core bug to watch

= 1.4 =
* FIX: don't run on non-AJAX media uploads (async-upload.php)
* tested up to WordPress 3.9

= 1.3 =
* FIX: on file uploads (async-upload.php) DOING_AJAX is defined late

= 1.2 =
* NEW: legend for the colors
* now you don't have to collapse the admin menu

= 1.1 =
* plugin name correction in the readme

= 1.0 =
* Initial release
* Colorized output

