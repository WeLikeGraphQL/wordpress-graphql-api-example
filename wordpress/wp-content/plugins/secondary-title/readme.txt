=== Secondary Title ===
Contributors:        thaikolja
Tags: title,         alternative title, secondary title, second title, additional title, post title, title
Tested up to:        4.4.1
Stable tag:          0.1
Requires at least:   3.0.1
License:             GPLv2 or later
License URI:         http://www.gnu.org/licenses/gpl-2.0.html

Adds a secondary title to posts, pages and custom post types.

== Description ==

**Secondary Title** is a simple, light-weight plugin that adds an alternative title to posts, pages and/or [custom post types](http://codex.wordpress.org/Post_Types).

The plugin comes with an extra settings page which allows you to customize the plugin according to your needs. You can change:

* [post types](http://codex.wordpress.org/Post_Types), categories and specific post IDs the secondary title will be
shown on,
* whether the secondary title should be automatically inserted with the standard title (*Auto show*),
* the format both titles are being shown (only works when *Auto show* is activated),
* the position where the secondary title input field should be displayed (above or below the standard title) within the admin interface,
* whether the secondary title should only be displayed in the main post and not within widgets etc.,
* if the secondary title should be usable in [permalinks](http://codex.wordpress.org/Using_Permalinks).

**Please see the [official website](http://www.koljanolte.com/wordpress/plugins/secondary-title/) for a full
documentation.**

If you have any other ideas for features, please don't hesitate to submit them by [sending me an e-mail](mailto:kolja.nolte@gmail.com) and I'll try my best to implement it in the next version. Your WP.org username will be added to the plugin's contributor list, of course (if you provide one).

*Feel free to make Secondary Title easier to use for non-English speaking users by [helping to translate the plugin on Transifex](https://www.transifex.com/projects/p/secondary-title/)*.

== Installation ==

= How to install =

1. Install Secondary Title either through WordPress' native plugin installer found under *Plugins > Install* or copy the *secondary-title* folder into the */wp-content/plugins/* directory of your WordPress installation.
2. Activate the plugin in the plugin section of your admin interface.
3. Go to *Settings > Secondary Title* to customize the plugin as desired.

**IMPORTANT:** If *Insert automatically* is set to *No*, you have to use either

`<?php echo get_secondary_title($post_id, $prefix, $suffix); ?>`

or

`<?php the_secondary_title($post_id, $prefix, $suffix); ?>`

in your theme file(s) (e.g. single.php) to display the secondary title.

**For a more detailed documentation with parameters, functions and examples, please see the [official documentation](http://www.koljanolte.com/wordpress/plugins/secondary-title/)**.

== Frequently Asked Questions ==

**The full FAQ can be found on the [official website](http://www.koljanolte.com/wordpress/plugins/secondary-title/#FAQ).**

== Screenshots ==

1. Secondary Title with activated "auto show" function that automatically adds the secondary title to the standard post/page title.

2. Secondary Title with "auto show" off. Displays the secondary title wherever `<?php the_secondary_title(); ?>` is called.

3. A section of the plugin's settings page on the admin interface.

== Changelog ==

= 1.9.0 =
* Fixed [issue with "Include in search"](https://wordpress.org/support/topic/multiple-keyword-search-is-broken) when using more than one search terms (thanks to [lonefur](https://wordpress.org/support/profile/lonefur)).
* Added setting "Column position" to allow users to place the secondary title on post overview pages left or right of the primary title.
* JavaScript/jQuery code now follows JSLint and JSHint coding standards.
* Allowed to use placeholder more than once in "Title format" preview field on settings page.

= 1.8.0 =
* Added option "Only show in main post".
* Added option "Include in search".
* Secondary Title now (properly) installs default plugin settings on first activation.
* "Title format" preview on settings page now displays HTML (not just text as before).
* "Title format" doesn't reset itself anymore when "Auto show" is activated.

= 1.7.2 =
* Hotfix for 1.7.1.

= 1.7.1 =
* Hotfix for 1.7.0.

= 1.7.0 =
* Removed permalinks function from front-end.
* Redesigned plugin's settings page.
* Fixed small bugs.
* Updated translations.
* PHP 7 support.
* Minor tweaks and adjustments.

= 1.6.2 =
* Fixed bug occurring when clicking "Save Changes" on settings page.

= 1.6.1 =
* Fixed bug occurring when clicking "Save Changes" on settings page.

= 1.6.0 =
* Added new setting that can determine whether the secondary title should be displayed before or after the primary title on post, pages or custom post types overview site.
* Added [Font Awesome](http://fortawesome.github.io/Font-Awesome/) icons on Secondary Title settings page.
* General code optimization.
* Updated translations.

= 1.5.6 =
* Remove unnecessary slash in css link.

= 1.5.5 =
* Fixed bug preventing secondary title input field from displaying.
* Updated translations.

= 1.5.4 =
* Removed "Automatically append to permalinks" option because it turned out to cause several 404 errors.
* Added JS fix to let users jump from primary title to secondary title when tab is pressed.
* Fixed bug in "quick edit" dropdown (thanks to [madaplus](https://wordpress.org/support/profile/madaplus) for reporting and [simne7](https://wordpress.org/support/profile/simne7) for offering a fix.

= 1.5.3 =
* Removed [unnecessary character](https://wordpress.org/support/topic/plugin-adds-characters-at-top-of-edit-screens) from post screen (thanks to [Julie @Niackery](https://wordpress.org/support/profile/habannah)).

= 1.5.2 =
* Small bug fix for JavaScript in Firefox.

= 1.5.1 =
* Hotfix for 1.5.1.

= 1.5 =
* Fixed [notice error](https://wordpress.org/support/topic/notice-error-2) when deleting post (thanks to [master412160](https://wordpress.org/support/profile/master412160) and [wido](https://wordpress.org/support/profile/wido)).
* Fixed [bug](https://wordpress.org/support/topic/issue-when-filtering-posts-by-category) occurring when filtering posts within the admin area (thanks to [Chillington](https://wordpress.org/support/profile/chillington)).
* Code cleanup and JS refactoring.
* Performance fixes.
* Updated translations.
* Compatibility for WordPress 4.2.1.

= 1.4 =
* Added `$use_settings` parameter to `get_secondary_title()` and others which defines whether the secondary title should only be displayed if it matches the plugin's settings. Default `false`.
* Code rearrangements and improvements.
* Updated translations.

= 1.3 =
* Fixed [bug](https://wordpress.org/support/topic/missing-secondary-title-column-in-custom-post-type) causing secondary title not to be displayed on certain custom post types overviews (thanks to [saschapi](https://wordpress.org/support/profile/saschapi)).
* Updated translations.

= 1.2 =
* Small bug fixes and corrections.
* Updated translations.

= 1.1 =
* Removed `<?php secondary_title_plugins_settings_link(); ?>` due to compatibility problems.
* Added filter hook `secondary_title_show_overview_column` to disable the secondary title column on post overviews without using the screen options (thanks to [Alkorr](https://wordpress.org/support/topic/hide-secondary-title-description-column)).
* Added Dutch (thanks to [SilverXp](https://www.transifex.com/accounts/profile/SilverXp/)), Turkish (thanks to [mapazarbasi](https://www.transifex.com/accounts/profile/mapazarbasi/)) and other translation.
* Updated existing translations.
* Fixed bug that prevented the "Author" column on post overview page to be shown.
* Further bug fixes.

= 1.0 =
* Allows HTML tags within individual secondary titles (thanks to [brit77](http://wordpress.org/support/topic/adding-html-tags-to-secondary-title)).
* Updated documentation.

= 0.9.2 =
* Fixed [bug](http://wordpress.org/support/topic/secondary-title-field-missing-in-latest-update) that occasionally prevented the secondary title input box from being displayed when creating a new post (thanks to [howorks](http://profiles.wordpress.org/howorks) and [pesunites](http://profiles.wordpress.org/pesunites)).
* Changed the categories view on the settings page.
* jQuery changes.

= 0.9.1 =
* Bug fixes for 0.9.

= 0.9 =
* Removed *Report bug* e-mail form due to compatibility issues.
* Fixed [bug](http://wordpress.org/support/topic/bulk-edit-deletes-secondary-titles) that deleted the secondary
title on selected posts when using *Bulk edit* (thanks to [JacobSchween](http://wordpress.org/support/profile/jacobschween)).
* Fixed bug that occurred when saving a custom menu (only visible with WP_DEBUG).
* Updated translations.
* Several small changes that aren't important enough to be mentioned here.

= 0.8 =
* Some new minor functions and changes on the settings page.
* Allowed to use `%title%` and `%secondary_title%` variable on settings page in *Title format* more than once.
* Added option to [use secondary title in permalinks](http://wordpress.org/support/topic/feature-request-add-secondary-title-to-permalinks?replies=3).
* Added filter hooks to `<?php get_secondary_title(); ?>`, `<?php the_secondary_title(); ?>` and
`<?php get_secondary_title_link(); ?>`.
* Added French translation (thanks to [fxbenard](https://www.transifex.com/accounts/profile/fxbenard/)).
* Updated existing translations.
* Fixed bug that prevented the secondary title to be updated when empty.
* Renamed `<?php get_filtered_post_types(); ?>` to `<?php get_secondary_title_filtered_post_types(); ?>` to avoid
possible
conflicts.

= 0.7 =
* Restructured and split up plugin code into different files for better handling.
* Added *Secondary title* column to posts/pages overview.
* Added secondary title input field to quick edit box on posts/pages overview.
* Added bug report form to settings page.
* Removed secondary title from above/below the standard title on posts/page overview.
* Renamed functions to minimize conflicts with other plugins.
* Updated screenshots.
* Updated translations.
* Bug fixes.

= 0.6 =
* Added compatibility with Word Filter Plus plugin.
* Added *Only show in main post* setting.
* Fixed minor jQuery bug on admin interface.
* Updated FAQ.

= 0.5.1 =
* Fixed bug that falsely added slashes to HTML attributes in title format.
* Fixed jQuery bug in the admin posts/
* Added `<?php has_secondary_title(); ?>` function. See [the official documentation](http://www.koljanolte.com/koljanolte.com/wordpress/plugins/secondary-title/#Parameters) for more information.

= 0.5 =
* Fixed bug where the secondary title was not shown if the standard title contains "..." (thanks to Vangelis).
* Added *Select all* and *Unselect all* script for checkbox lists on settings page.
* Added secondary title display in admin posts/pages list.
* Added `<?php get_secondary_title_link($post_id, $options); ?>` and `<?php the_secondary_title_link($post_id, $options); ?>` functions
  to quickly create the secondary title as a link to its post. See [the official documentation](http://www.koljanolte.com/koljanolte.com/wordpress/plugins/secondary-title/#Parameters) for more information.
* Updated documentation/readme.txt.

= 0.4 =
* Fixed bug that showed secondary title input within the post/page overview.
* Added Italian translation (thanks to [giuseppep](https://www.transifex.com/accounts/profile/giuseppep/)).
* Added Polish translation (thanks to [pawel10](https://www.transifex.com/accounts/profile/pawel10/)).
* Updated existing translations.

= 0.3 =
* Added HTML support in title format (thanks to C0BALT).
* Added option to set the position of the secondary title input field within the admin interface (thanks to Vangelis).
* Added translation to Thai.
* Updated translation files.

= 0.2 =
* Installs default values on plugin activation.
* Added screenshots.
* Added $prefix and $suffix parameter for `<?php get_secondary_title(); ?>` and `<?php the_secondary_title(); ?>`.
* Updated FAQ.

= 0.1 =
* Initial Release.

== Upgrade Notice ==

= 1.9.0 =
Fixed issue with "Include in search" option and added "Column position" setting.

= 1.8.0 =
You can now set whether you'd like the secondary title to be searchable. See plugin settings page.

= 1.7.2 =
Hotfix for 1.7.1.

= 1.7.1 =
Hotfix for 1.7.0.

= 1.7.0 =
Removed permalinks function from front-end; new settings page layout.

= 1.6.2 =
Fixed bug occurring when clicking "Save Changes" on settings page.

= 1.6.1 =
Fixed bug occurring when clicking "Save Changes" on settings page.

= 1.6.0 =
New setting added to change the position of the secondary title column on post, pages or custom post types overview sites.

= 1.5.6 =
Small CSS fix.

= 1.5.5 =
Urgent hotfix for 1.5.4.

= 1.5.4 =
The option "Automatically append to permalink" has been removed; please use "Yes, use custom permalink structure" on the plugin's settings page instead.

= 1.5.3 =
Removed unnecessary character from post screen.

= 1.5.2 =
Small bug fix for JavaScript in Firefox.

= 1.5.1 =
Hotfix for 1.5.1.

= 1.5 =
Two bugs fixed and some code cleanup.

= 1.4 =
Code rearrangements and added `$use_settings` parameter to `get_secondary_title()` and related functions that defines whether or not the plugin settings should be validated.

= 1.3 =
Fixed posts overview bug, added/updated translations.

= 1.2 =
Bug fixes, translation updates.

= 1.1 =
Fixed bug on posts overview page, new/updated translations.

= 1.0 =
HTML allowed in secondary title and small fixes.

= 0.9.2 =
Additional hotfix for 0.9.

= 0.9.1 =
Hotfix for 0.9.

= 0.9 =
Bug fixes.

= 0.8 =
Permalinks support, bug fixes, translation updates.

= 0.7 =
Major changes; restructured plugin files, added "Secondary title" column to posts/page overview and more.

= 0.6 =
Bug fixes, setting added, compatibility with Word Filter Plus plugin.

= 0.5.1 =
Hotfix for 0.5.

= 0.5 =
Bug fixes and some more features.

= 0.4 =
Bug fix and translation update.

= 0.3 =
HTML support and new features.

= 0.2 =
Major changes, screenshots, FAQ, parameters.

= 0.1 =
This is the first release of Secondary Title.