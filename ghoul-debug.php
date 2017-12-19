<?php
/*
Plugin Name:  Sachyya Debug
Plugin URI:
Description:  Debugging functions.
Version:      1.0.0
Author:       ghoul
Author URI:   https://developer.wordpress.org/
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  sachyya-debug
Domain Path:  /languages
*/

function gh_dump( $var ) {
	echo "<pre>";
	print_r( $var );
	echo "</pre>";
}