=== BuddyPress Member Types ===
Contributors: buddyboss
Requires at least: 3.8
Tested up to: 5.1
Stable tag: 1.1.5
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html

BuddyPress Member Types plugin makes it easy to create and manage member types without having to write a single line of code.

== Description ==

BuddyPress Member Types plugin makes it easy to create and manage member types without having to write a single line of code. If your members can be categorized into more than one Member Type, then BP Member Types is the easy answer for your site.

== Installation ==

1. Make sure BuddyPress is activated.
2. Visit 'Plugins > Add New'
3. Click 'Upload Plugin'
4. Upload the file 'buddypress-member-types.zip'
5. Activate BuddyPress Member Types from your Plugins page.

= Configuration =

1. Enable 'Extended Profiles' at 'Settings > BuddyPress > Components'
2. Visit 'Member Types > Add New' and create your member types.
3. Visit 'Member Types > Options' and select your desired options.

== Changelog ==


= 1.1.5 =

* Fix - Members not getting listed on member directory page

= 1.1.4 =
* Fix - Removed member type metabox for users who doesn't have permission to change member types

= 1.1.3 =
* Fix - Registration fail when default member type has been selected
* Fix - Registration not working after BuddyPress 3.0 update
* Fix - Unable to update member type from admin edit post page when JetPack plugin is active
* Fix - A Visibility option Hide completely from Members Directory does not hide member from search and member directory
* New - Added Gutenberg editor compatibility
* Tweak - Changed WordPress Roles input from checkboxes to radio button
* Tweak - Added member type key MetaBox to take type key from user

= 1.1.2 =
* Fix – Php timeout on a member type assignment

= 1.1.1 =
* Enhancement – License Module

= 1.1.0 =
* Fix - Multi site support
* Fix - Fix duplicate "Change member type" dropdown and Member Type column on users.php
* Fix - Member Types Short Code fix
* Fix - User role are not getting assigned after member type selection and registration if member type name contain space
* Fix - Problem with assigning roles while adding new users
* Fix - Options to customise the member types tabs order
* Fix - Filtering function don’t work on members directory if type name has character "-"


= 1.0.4 =
* New - Option to make the Member Type field mandatory
* Fix - Member types are listed twice on the members page
* Fix - Member Shortcode being overriden by BuddyPress filter
* Fix - User roles are not getting assigned after member type selection and registration
* Fix - New users are automatically assigned to the member type, if Default Member Type has none selected
* Fix - Issue with translating the label 'Member Type'
* Fix - Error with Gravity Forms

= 1.0.3 =
* New - Allow admin to bulk assign member type (in wp-admin/users)
* New - Add shortcode to display member loop on any page [members type=typename]
* Fix - Member type slug
* Fix - WordPress roles not getting saved

= 1.0.2 =
* New - Import existing member types
* New - Assign WordPress roles to member types
* New - Hide member types completely from Members Directory
* New - Require member type selection in Registration Form
* New - Set default member type in Registration Form
* New - Remove member type selection from Registration Form

= 1.0.1 =
* Better compatibility with BP Portfolio (menu position)

= 1.0.0 =
* Initial Release
* Create and manage new Member Types
* Register for Member Type on signup
* Display member types in Members directory
* Supports profile fields per member type
