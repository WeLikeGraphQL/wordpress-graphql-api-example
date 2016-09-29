=== Post Types Order  ===
Contributors: nsp-code
Donate link: http://www.nsp-code.com/donate.php
Tags: post order, posts order, sort, post sort, posts sort, post type order, custom order, admin posts order
Requires at least: 2.8
Tested up to: 4.4.2
Stable tag: 1.8.6

Post Order and custom Post Type Objects (posts, any custom post types) using a Drag and Drop Sortable JavaScript AJAX interface. 

== Description ==

<strong>Over 1.500.000 DOWNLOADS and near PERFECT ratting out of 150 REVIEWS</strong>. <br />
A powerful plugin, Order Posts and Post Types Objects using a Drag and Drop Sortable JavaScript capability.
It allow to reorder the posts for any custom post types you defined, including the default Posts. Also you can have the admin posts interface sorted per your new sort. Post Order has never been easier.

= Usage =
This was built considering for everyone to be able to use no matter the WordPress experience, so it's very easy:

* Install the plugin through the Install Plugins interface or by uploading the `post-types-order` folder to your `/wp-content/plugins/` directory.
* Activate the Post Order plugin.
* A new setting page will be created within Settings > Post Types Order, you should check with that, and make a first options save. 
* Using the AutoSort option as ON you don't need to worry about any code changes, the plugin will do the post order update on fly. 
* Use the Re-Order interface which appear to every custom post type (non-hierarchical) to change the post order to a new one.

= Example of Usage =
[youtube http://www.youtube.com/watch?v=VEbNKFSfhCc] 

As you can see just a matter of drag and drop and post ordering will change on front side right away.
If for some reason the post order does not update on your front side, you either do something wrong or the theme code you are using does not use a standard query per WordPress Codex rules and regulations. But we can still help, use the forum to report your issue as there are many peoples who gladly help or get in touch with us.

<br />Something is wrong with this plugin on your site? Just use the forum or get in touch with us at <a target="_blank" href="http://www.nsp-code.com">Contact</a> and we'll check it out.

<br />Check out the advanced version of this plugin at <a target="_blank" href="http://www.nsp-code.com/premium-plugins/wordpress-plugins/advanced-post-types-order/">Advanced Post Types Order</a>

<br />
<br />This plugin is developed by <a target="_blank" href="http://www.nsp-code.com">Nsp-Code</a>

== Installation ==

1. Upload `post-types-order` folder to your `/wp-content/plugins/` directory.
2. Activate the plugin from Admin > Plugins menu.
3. Once activated you should check with Settings > Post Types Order 
4. Use Re-Order link which appear into each post type section to make your sort.


== Screenshots ==

1. The ReOrder interface through which the sort can be created.

== Frequently Asked Questions  ==

Feel free to contact us at electronice_delphi@yahoo.com

= I have no PHP knowledge at all, i will still be able to use this plugin? =

Absolutely you can! Unlike many other plugins, you don't have to do any code changes to make your post order to change accordingly to custom defined post order. There is an option to autoupdate the WordPress queries so the posts order will be returned in the required order. Anyway this can be turned off to allow customized code usage.

= What kind of posts/pages this plugin allow me to sort? =

You can sort ALL post types that you have defined into your wordpress as long they are not <strong>hierarhically</strong> defined: Posts (default WordPress custom post type), Movies, Reviews, Data etc..

= Ok, i understand about the template post types order, how about the admin interface? =

There's a option you can trigger, to see the post types order as you defined in the sort list, right into the main admin post list interface.

= There is a feature that i want it implemented, can you do something about it? =

All ideas are welcome and i put them on my list to be implemented into the new versions. Anyway this may take time, but if you are in a rush, please consider a small donation and we can arrange something.

= Can i make certain queries to ignore the custom sort when Autosort is turned On? =

This can be doe by including the ignore_custom_sort within custom query arguments. An example can be found at http://www.nsp-code.com/advanced-post-types-order-api/sample-usage/

= I still need more features like front sorting interface, shortcodes, filters, conditionals, advanced queries, taxonomy/ category sorting etc =

Consider upgrading to our advanced version of this plugin at a very resonable price <a target="_blank" href="http://www.nsp-code.com/premium-plugins/wordpress-plugins/advanced-post-types-order/">Advanced Post Types Order</a>


== Change Log ==
= 1.8.6 =
  - PHP 7 deprecated nottice fix Deprecated: Methods with the same name as their class will not be constructors in a future version of PHP;  
  - Fix: $_REQUEST['action'] comparison evaluate as Identical instead equal
  - New filter cpto/interface_itme_data to append additional data for items within sortable interface
  - Slight style updates
  - Replaced Socialize FB like page

= 1.8.5 =
  - Text domain change to post-types-order to allow translations at https://translate.wordpress.org/projects/wp-plugins/post-types-order  
  - New query argument ignore_custom_sort , to be used with Autosort. Ignore any customised sort and return posts in default order.

= 1.8.4.1 =
  - Sortable interface styling improvments
  - Portuguese translation update - Pedro Mendonca - http://www.pedromendonca.pt
  - Text doamin fix for few texts
  
= 1.8.3.1 =
  - Advanced Custom Fields Page Rule fix
  - Show / Hide Re_order inderface for certain menus. Option available within Settings area.
  - Media Sort interface objects order fix, when query-attachments REQUEST
  - Bug - Thumbnails test code remove

= 1.8.2 =
  - Media Uploaded To after sort fix

= 1.8.1 =
  - Next / Previous sorting apply bug fix for custom taxonomies
  - Portuguese translation update - Pedro Mendonca - http://www.pedromendonca.pt
  - Options - phrase translation fix  

= 1.7.9 =
  - Next / Previous sorting apply option
  - Filter for Next / Previous sorting applpy
  - Help updates
  - Appearance /css updates
  - Admin columns sort fix
  - Media re-order

= 1.7.7 =
  - Next / Previous post link functionality update
  - Code improvements  
  - Norvegian translation update - Bjorn Johansen bjornjohansen.no
  - Czech translation - dUDLAJ; Martin Kucera - http://jsemweb.cz/

= 1.7.4 =
  - Japanese translation - Git6 Sosuke Watanabe  - http://git6.com/  
  - Portuguese translation update - Pedro Mendon?a - http://www.pedromendonca.pt 
  - Chinese translation - Coolwp coolwp.com@gmail.com

= 1.7.0 =
  - Swedish translation - Onlinebyran - http://onlinebyran.se
  - Portuguese translation - Pedro Mendon?a - http://www.pedromendonca.pt
  - AJAX save filter

= 1.6.8 = 
 - Edit Gallery - image order fix
 - "re-order" menu item allow translation 
 - Hungarian translation - Adam Laki - http://codeguide.hu/
 - Minor admin style improvments

= 1.6.5 = 
 - Updates/Fixes
 - German translation
 - Norwegian (norsk) translation

= 1.6.4 = 
 - DISALLOW_FILE_MODS fix, change the administrator capability to switch_themes

= 1.6.3 = 
 - Updates/Fixes
 - Menu Walker nottices Fix

= 1.6.2 = 
 - Updates/Fixes
 - Turkish - T?rk?e translation
 
= 1.6.1 = 
 - Updates/Fixes
 - Menu Walker nottices Fix
 - Hebrew translation - Lunasite Team http://www.lunasite.co.il
 - Dutch translation - Denver Sessink

= 1.5.8 = 
 - Updates/Fixes
 - Ignore Search queries when Autosort is ON
 - Text Instances translatable fix
 - Italian translation - Black Studio http://www.blackstudio.it 
 - Spanish translation - Marcelo Cannobbio

= 1.5.7 = 
 - Updates/Fixes
 - Using Capabilities instead levels
 - Updating certain code for WordPress 3.5 compatibility
 - Set default order as seccondary query order param

= 1.5.4 = 
 - Updates/Fixes
 
= 1.5.1 = 
 - Updates/Fixes

= 1.4.6 = 
 - Get Previous / Next Posts Update

= 1.4.3 = 
 - Small improvments

= 1.4.1 = 
 - Re-Order Menu Item Appearance fix for update versions
 - Improved post order code
 
= 1.3.9 =
 - Re-Order Menu Item Appearance fix   

= 1.3.8 = 
 - Another Plugin conflict fix (thanks Steve Reed)
 - Multiple Improvments (thanks for support Video Geek - bestpocketvideocams.com)
 - Localisation Update (thanks Gabriel Reguly - ppgr.com.br/wordpress/)

= 1.1.2 = 
 - Bug Fix
 
= 1.0.9 =
 - Admin will set the roles which can use the plugins (thanks for support Nick - peerpressurecreative.com)

= 1.0.2 =
 - Default order used if no sort occour
 
= 1.0.1 =
 - Post order support implemented
 
= 1.0 =
 - First stable version (thanks for support Andrew - PageLines.com)

= 0.9. =
 - Initial Release
 
 
== Upgrade Notice ==

Make sure you get the latest version.


== Localization ==

Available in English, Brazilian Portuguese, Spanish, Romanian, Italian, Dusth, Hebrew, German, Norwegian (norsk), Turkish (t?rk?e), Swedish, Hungarian, Portuguese, Chinese, Czech
Want to contribute with a translation to your language? Please check at https://translate.wordpress.org/projects/wp-plugins/post-types-order
http://www.nsp-code.com
