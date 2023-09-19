<?php
/*
Plugin Name: WP Divi Table
Plugin URI:  https://elegantthemes.com
Description: Custom module examples for Divi built using create-divi-extension
Version:     1.0.0
Author:      Elegant Themes
Author URI:  https://elegantthemes.com
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: wp-divi-table
Domain Path: /languages

*/


if ( ! function_exists( 'wp_initialize_divi_table' ) ):
	
	/**
	 * Creates the extension's main class instance.
	 *
	 * @since 1.0.0
	 */

	function wp_initialize_divi_table() {

		require_once plugin_dir_path( __FILE__ ) . 'includes/wpDiviTable.php';

	}

	add_action( 'divi_extensions_init', 'wp_initialize_divi_table' );

endif;