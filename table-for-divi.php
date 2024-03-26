<?php
/*
Plugin Name: Table for Divi
Plugin URI:  https://github.com/wasimhere/table-for-divi
Description: Table for Divi module can be used for simple and complex table layouts without any code
Version:     1.2.0
Author:      Wasim
Author URI:  https://wasimhere.github.io/
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: table-for-divi
Domain Path: /languages

*/


if ( ! function_exists( 'tfdt_wp_initialize' ) ):
	
	/**
	 * Creates the extension's main class instance.
	 *
	 * @since 1.0.0
	 */

	//table for divi theme initialize
	function tfdt_wp_initialize() {

		require_once plugin_dir_path( __FILE__ ) . 'includes/TFDT_Initialize.php';

	}

	add_action( 'divi_extensions_init', 'tfdt_wp_initialize' );

endif;