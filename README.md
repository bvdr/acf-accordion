# ACF Accordion

![acf-accordion](https://cloud.githubusercontent.com/assets/4183317/6965273/eaa12e6e-d958-11e4-854f-f877f6b639a2.gif)

-----------------------

# ACF Accordion Tab Field

An accordion field that lets you group multiple fields under accordion tabs. This makes a long ACF form break down with style.

-----------------------

### Description

The ACF Accordion provides an easy way to organize big forms by grouping the fields in accordion tabs. It works with horizontal tabs and it also supports WordPress icons.

### Compatibility

This ACF field type is compatible with:

* ACF PRO
* ACF 5
* ACF 4

### Installation

1. Copy the `acf-accordion` folder into your `wp-content/plugins` folder
2. Activate the Accordion Tab plugin via the plugins admin page
3. Create a new field via ACF and select the Accordion Tab type
4. Please refer to the description for more info regarding the field type settings

### Include in theme

ACF Accordion can be included in the theme by using the `acf/accordion/dir` filter. Here is an example
```php
include_once( 'includes/acf-accordion/acf-accordion.php' );

add_filter( 'acf/accordion/dir', 'acf_accordion_dir' );
function acf_accordion_dir( $dir ) {
    $dir = get_template_directory_uri() . '/includes/acf-accordion/';

    return $dir;
}
```

### Changelog
Please see `readme.txt` for changelog
