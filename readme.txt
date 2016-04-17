=== Advanced Custom Fields: Accordion Tab Field ===
Contributors: bogdand, tmconnect
Donate link: goo.gl/1w6rU0
Tags: acf, accordion, advanced custom fields, tabs, options
Requires at least: 3.5
Tested up to: 4.5
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

An accordion field that lets you group multiple fields under accordion tabs. This makes a long ACF form break down with style.

== Description ==

The ACF Accordion provides an easy way to organize big forms by grouping the fields in accordion tabs. It works with horizontal tabs and it also supports WordPress icons.

Please contribute here
https://github.com/bvdr/acf-accordion

= Compatibility =

This ACF field type is compatible with:

* ACF PRO
* ACF 5
* ACF 4

== Installation ==

1. Copy the `acf-accordion` folder into your `wp-content/plugins` folder
2. Activate the Accordion Tab plugin via the plugins admin page
3. Create a new field via ACF and select the Accordion Tab type
4. Please refer to the description for more info regarding the field type settings

### Including it in theme

ACF Accordion can be included in the theme by using the `acf/accordion/dir` filter. Here is an example

```php
include_once( 'includes/acf-accordion/acf-accordion.php' );

add_filter( 'acf/accordion/dir', 'acf_accordion_dir' );
function acf_accordion_dir( $dir ) {
    $dir = get_template_directory_uri() . '/includes/acf-accordion/';
    return $dir;
}
```

== Screenshots ==

1. This is an example of how the accordion works in an option menu created with ACF

== Changelog ==

= 1.1.1 - April 17, 2016 =
* [Fix] multi tabs not working with accordion, tab after accordions showing empty;

= 1.1.0 =
* [Fix] styling in ACF5 free version;
* [Fix] gallery crashing in accordion tab;
* [Fix] google map crashing in accordion tab;
* [Fix] repeater field crashing in accordion tab;
* [Add] support for ACF-Column-Field, contribution by Thomas Meyer;
* [Add] add icon picker in admin section, contribution by Thomas Meyer;
* [Add] refactored the accordion script, contribution by Thomas Meyer;

= 1.0.2 =
* [Fix] Tabs after accordion not showing in latest version of ACF;

= 1.0.1 =
* [Add] support for V4;
* [Add] 'acf/accordion/dir' filter to allow the plugin to be integrated in themes;

= 1.0.0 =
* It works!
