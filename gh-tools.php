<?php
/**
 * Plugin Name: GH Tools
 * Plugin URI: https://github.com/sachyya/gh-tools
 * Description: Collection of tools helpful for WordPress development
 * Version: 1.0.0
 * Author: Ghoul
 * Author URI: 
 * Text Domain: gh-tools
 *
 * @package Devpack
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Debug
require_once 'tools/debug.php';

// Theme mods.
require_once 'tools/rm-theme-mods.php';

// Quick links.
require_once 'tools/quick-links.php';

// Transient cleaner.
require_once 'tools/transient-cleaner.php';
