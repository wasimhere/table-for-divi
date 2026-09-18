<?php
/**
 * Module: Table Module class.
 *
 * @package TFDT\Modules\TableModule
 * @since ??
 */

namespace TFDT\Modules\TableModule;

if ( ! defined( 'ABSPATH' ) ) {
    die( 'Direct access forbidden.' );
}

use ET\Builder\Framework\DependencyManagement\Interfaces\DependencyInterface;
use ET\Builder\Packages\ModuleLibrary\ModuleRegistration;

/**
 * `TableModule` is consisted of functions used for Table Module such as Front-End rendering, REST API Endpoints etc.
 *
 * This is a dependency class and can be used as a dependency for `DependencyTree`.
 *
 * @since ??
 */
class TableModule implements DependencyInterface {
    use TableModuleTrait\RenderCallbackTrait;

    /**
     * Loads `TableModule` and registers Front-End render callback and REST API Endpoints.
     *
     * @since ??
     *
     * @return void
     */
    public function load() {
        $module_json_folder_path = TFDT_JSON_PATH . 'table-module/';

        add_action(
            'init',
            function() use ( $module_json_folder_path ) {
                ModuleRegistration::register_module(
                    $module_json_folder_path,
                    [
                        'render_callback' => [ TableModule::class, 'render_callback' ],
                    ]
                );
            }
        );
    }
}