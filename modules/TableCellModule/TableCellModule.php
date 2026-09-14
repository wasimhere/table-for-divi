<?php
/**
 * Module: Table Cell Module class.
 *
 * @package TFDT\Modules\TableCellModule
 * @since ??
 */

namespace TFDT\Modules\TableCellModule;

if ( ! defined( 'ABSPATH' ) ) {
    die( 'Direct access forbidden.' );
}

use ET\Builder\Framework\DependencyManagement\Interfaces\DependencyInterface;
use ET\Builder\Packages\ModuleLibrary\ModuleRegistration;

/**
 * `TableCellModule` consists of functions used for Table Cell Module such as Front-End rendering, REST API Endpoints etc.
 *
 * This is a dependency class and can be used as a dependency for `DependencyTree`.
 *
 * @since ??
 */
class TableCellModule implements DependencyInterface {
    use TableCellModuleTrait\RenderCallbackTrait;

    /**
     * Loads `TableCellModule` and registers Front-End render callback and REST API Endpoints.
     *
     * @since ??
     *
     * @return void
     */
    public function load() {
        $module_json_folder_path = TFDT_JSON_PATH . 'table-cell-module/';

        add_action(
            'init',
            function() use ( $module_json_folder_path ) {
                ModuleRegistration::register_module(
                    $module_json_folder_path,
                    [
                        'render_callback' => [ TableCellModule::class, 'render_callback' ],
                    ]
                );
            }
        );
    }
}