<?php

/*
Plugin Name: ACF Accordion
Plugin URI: http://bogdandragomir.com/acf-accordion
Description: An accordion field that lets you group multiple fields under accordion tabs. This makes a long ACF form break down with style.
Version: 1.1.1
Author: Bogdan Dragomir
Author URI: http://bogdandragomir.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

load_plugin_textdomain( 'acf-accordion', false, dirname( plugin_basename(__FILE__) ) . '/lang/' );

function include_field_types_accordion( $version ) {
	include_once('acf-accordion-v5.php');
}
add_action('acf/include_field_types', 'include_field_types_accordion');

function register_fields_accordion() {
	include_once('acf-accordion-v4.php');
}
add_action('acf/register_fields', 'register_fields_accordion');
?>