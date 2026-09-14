<?php

/*
Plugin Name: Table for Divi
Plugin URI:  https://github.com/wasimhere/table-for-divi
Description: Table for Divi module can be used for simple and complex table layouts without any code
Version:     2.0.0
Author:      Wasim
Author URI:  https://wasimhere.github.io/
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: table-for-divi
Domain Path: /languages
*/

if ( ! defined( 'ABSPATH' ) ) {

  die( 'Direct access forbidden.' );

}

define( 'TFDT_PATH', plugin_dir_path( __FILE__ ) );

define( 'TFDT_JSON_PATH', TFDT_PATH . 'modules-json/' );

/**
 * Requires Autoloader and Initializers.
 */
if ( file_exists( TFDT_PATH . 'includes/TFDT_Initialize.php' ) ) {

  require_once TFDT_PATH . 'includes/TFDT_Initialize.php';

}

if ( file_exists( TFDT_PATH . 'vendor/autoload.php' ) ) {

  require_once TFDT_PATH . 'vendor/autoload.php';

}

if ( file_exists( TFDT_PATH . 'modules/Modules.php' ) ) {

  require_once TFDT_PATH . 'modules/Modules.php';

}

/**
 * Enqueue styles and scripts for Visual Builder.
 */
function tfdt_enqueue_vb_scripts() {

  if ( et_builder_d5_enabled() && et_core_is_fb_enabled() ) {

    $plugin_dir_url = plugin_dir_url( __FILE__ );

    \ET\Builder\VisualBuilder\Assets\PackageBuildManager::register_package_build(

      [

        'name'    => 'tfdt-builder-bundle-script',

        'version' => '2.0.0',

        'script'  => [

          'src'                => "{$plugin_dir_url}scripts/bundle.js",

          'deps'               => [

            'divi-module-library',

            'divi-vendor-wp-hooks',

          ],

          'enqueue_top_window' => false,

          'enqueue_app_window' => true,

        ],

      ]

    );

    \ET\Builder\VisualBuilder\Assets\PackageBuildManager::register_package_build(

      [

        'name'    => 'tfdt-builder-vb-bundle-style',

        'version' => '2.0.0',

        'style'   => [

          'src'                => "{$plugin_dir_url}styles/bundle.css",

          'deps'               => [],

          'enqueue_top_window' => false,

          'enqueue_app_window' => true,

        ],

      ]

    );

  }

}

add_action( 'divi_visual_builder_assets_before_enqueue_scripts', 'tfdt_enqueue_vb_scripts' );

/**
 * Enqueue frontend styles and scripts for Table for Divi.
 */
function tfdt_enqueue_frontend_scripts() {

  $plugin_dir_url = plugin_dir_url( __FILE__ );

  wp_enqueue_style( 'tfdt-builder-bundle-style', "{$plugin_dir_url}styles/bundle.css", array(), '2.0.0' );

}

add_action( 'wp_enqueue_scripts', 'tfdt_enqueue_frontend_scripts' );

/**
 * Reset the notification flag on plugin deactivation.
 */
function tfdt_reset_review_notification_flag() {

  delete_option( 'tfdt_review_notification_status' );

}

register_deactivation_hook( __FILE__, 'tfdt_reset_review_notification_flag' );