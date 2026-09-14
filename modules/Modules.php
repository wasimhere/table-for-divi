<?php

/**
 * Register all modules with dependency tree.
 *
 * @package TFDT\Modules
 */

namespace TFDT\Modules;

if ( ! defined( 'ABSPATH' ) ) {

  die( 'Direct access forbidden.' );

}

use TFDT\Modules\TableModule\TableModule;
use TFDT\Modules\TableRowModule\TableRowModule;
use TFDT\Modules\TableCellModule\TableCellModule;

add_action(

  'divi_module_library_modules_dependency_tree',

  function ( $dependency_tree ) {

    $dependency_tree->add_dependency( new TableModule() );
    $dependency_tree->add_dependency( new TableRowModule() );
    $dependency_tree->add_dependency( new TableCellModule() );

  }

);