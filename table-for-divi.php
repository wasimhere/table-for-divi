<?php
/*
Plugin Name: Table for Divi
Plugin URI:  https://github.com/wasimhere/table-for-divi
Description: Table for Divi module can be used for simple and complex table layouts without any code
Version:     1.0.0
Author:      Wasim
Author URI:  https://wasimhere.github.io/
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: table-for-divi
Domain Path: /languages

*/


if ( ! function_exists( 'wp_initialize_table_for_divi' ) ):
	
	/**
	 * Creates the extension's main class instance.
	 *
	 * @since 1.0.0
	 */

	function wp_initialize_table_for_divi() {

		require_once plugin_dir_path( __FILE__ ) . 'includes/tableForDivi.php';

	}

	add_action( 'divi_extensions_init', 'wp_initialize_table_for_divi' );

endif;