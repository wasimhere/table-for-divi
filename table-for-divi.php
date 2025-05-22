<?php
/*
Plugin Name: Table for Divi
Plugin URI:  https://github.com/wasimhere/table-for-divi
Description: Table for Divi module can be used for simple and complex table layouts without any code
Version:     1.4.0
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

	//table for divi theme (tfdt) initialize
	function tfdt_wp_initialize() {

		require_once plugin_dir_path( __FILE__ ) . 'includes/TFDT_Initialize.php';

	}

	add_action( 'divi_extensions_init', 'tfdt_wp_initialize' );

endif;



// Reset the notification flag on plugin deactivation
function tfdt_reset_review_notification_flag() {
    
	delete_option( 'tfdt_review_notification_status' );
	
}
register_deactivation_hook( __FILE__, 'tfdt_reset_review_notification_flag' );