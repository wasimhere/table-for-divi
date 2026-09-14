<?php
/**
 * Module: Table Row Module class.
 *
 * @package TFDT\Modules\TableRowModule
 * @since ??
 */

namespace TFDT\Modules\TableRowModule;

if ( ! defined( 'ABSPATH' ) ) {
    die( 'Direct access forbidden.' );
}

use ET\Builder\Framework\DependencyManagement\Interfaces\DependencyInterface;
use ET\Builder\Packages\ModuleLibrary\ModuleRegistration;

/**
 * `TableRowModule` consists of functions used for Table Row Module such as Front-End rendering, REST API Endpoints etc.
 *
 * This is a dependency class and can be used as a dependency for `DependencyTree`.
 *
 * @since ??
 */
class TableRowModule implements DependencyInterface {
    use TableRowModuleTrait\RenderCallbackTrait;

    /**
     * Loads `TableRowModule` and registers Front-End render callback and REST API Endpoints.
     *
     * @since ??
     *
     * @return void
     */
    public function load() {
        $module_json_folder_path = TFDT_JSON_PATH . 'table-row-module/';

        add_action(
            'init',
            function() use ( $module_json_folder_path ) {
                ModuleRegistration::register_module(
                    $module_json_folder_path,
                    [
                        'render_callback' => [ TableRowModule::class, 'render_callback' ],
                    ]
                );
            }
        );
    }
}