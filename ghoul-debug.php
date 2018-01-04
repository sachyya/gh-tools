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
Text Domain:  ghoul-debug
Domain Path:  /languages
*/

function gh_print( $var ) {
	echo "<pre>";
	print_r( $var );
	echo "</pre>";
}

function gh_add_admin_item() {
    global $wp_admin_bar;

    if ( ! is_super_admin() || ! is_admin_bar_showing() )
        return;

    // Add the item to admin bar.
    $wp_admin_bar->add_menu( 
    	array( 
	    	'id' => 'gd-remove-theme-mods', 
	    	'title' => __( 'Remove Theme Mods', 'ghoul-debug' ), 
	    	'href' => add_query_arg( 'gh-remove-theme-mods', true, wp_customize_url() ),
	    ) 
    );
    
    // If the request is done, remove all theme mods.
    if ( isset( $_GET['gh-remove-theme-mods'] ) && $_GET['gh-remove-theme-mods'] ) {
    	remove_theme_mods();
    } else {
    	return;
    }
}
add_action( 'admin_bar_menu', 'gh_add_admin_item', 1000 );