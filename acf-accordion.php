<?php

/*
Plugin Name: ACF Accordion
Plugin URI: http://bogdandragomir.com/acf-accordion
Description: An accordion field that lets you group multiple fields under accordion tabs. This makes a long ACF form break down with style.
Version: 1.0.0
Author: Bogdan Dragomir
Author URI: http://bogdandragomir.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/




// 1. set text domain
// Reference: https://codex.wordpress.org/Function_Reference/load_plugin_textdomain
load_plugin_textdomain( 'acf-accordion', false, dirname( plugin_basename(__FILE__) ) . '/lang/' );




// 2. Include field type for ACF5
// $version = 5 and can be ignored until ACF6 exists
function include_field_types_accordion( $version ) {
	
	include_once('acf-accordion-v5.php');
	
}

add_action('acf/include_field_types', 'include_field_types_accordion');




// 3. Include field type for ACF4
function register_fields_accordion() {
	
	include_once('acf-accordion-v4.php');
	
}

add_action('acf/register_fields', 'register_fields_accordion');



	
?>