# ACF Accordion

Welcome to the ACF Accordion field type repository.



### Structure

* `/css`:  folder for .css files.
* `/images`: folder for image files
* `/js`: folder for .js files
* `/lang`: folder for .pot, .po and .mo files
* `acf-accordion.php`: Main plugin file that includes the correct field file based on the ACF version
* `accordion-v5.php`: Field class compatible with ACF version 5
* `accordion-v4.php`: Field class compatible with ACF version 4
* `readme.txt`: WordPress readme file to be used by the WordPress repository

### step 1.

This template uses `PLACEHOLDERS` such as `accordion` throughout the file names and code. Use the following list of placeholders to do a 'find and replace':

* `accordion`: Single word, no spaces. Underscores allowed. eg. donate_button
* `Accordion Tab`: Multiple words, can include spaces, visible when selecting a field type. eg. Donate Button
* `PLUGIN_URL`: Url to the github or WordPress repository
* `PLUGIN_TAGS`: Comma separated list of relevant tags
* `SHORT_DESCRIPTION`: Brief description of the field type, no longer than 2 lines
* `EXTENDED_DESCRIPTION`: Extended description of the field type
* `AUTHOR_NAME`: Name of field type author
* `AUTHOR_URL`: URL to author's website

### step 2.

Edit the `accordion-v5.php` and `accordion-v4.php` files (now renamed using your field name) and include your custom code in the appropriate functions.
Please note that v4 and v5 field classes have slightly different functions. For more information, please read:
* http://www.advancedcustomfields.com/resources/tutorials/creating-a-new-field-type/

### step 3.

Edit this `README.md` file with the appropriate information and delete all content above and including the following line.

-----------------------

# ACF Accordion Tab Field

SHORT_DESCRIPTION

-----------------------

### Description

EXTENDED_DESCRIPTION

### Compatibility

This ACF field type is compatible with:
* ACF 5
* ACF 4

### Installation

1. Copy the `acf-accordion` folder into your `wp-content/plugins` folder
2. Activate the Accordion Tab plugin via the plugins admin page
3. Create a new field via ACF and select the Accordion Tab type
4. Please refer to the description for more info regarding the field type settings

### Changelog
Please see `readme.txt` for changelog
