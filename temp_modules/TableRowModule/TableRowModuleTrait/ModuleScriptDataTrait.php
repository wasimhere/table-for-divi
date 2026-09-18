<?php
/**
 * Module Library: Table Row Module - Script Data
 *
 * @package TFDT\Modules\TableRowModule
 * @since ??
 */

namespace TFDT\Modules\TableRowModule\TableRowModuleTrait;

if ( ! defined( 'ABSPATH' ) ) {
    die( 'Direct access forbidden.' );
}

use ET\Builder\Packages\Module\Options\Element\ElementScriptData;

trait ModuleScriptDataTrait {

    /**
     * Set script data of used module options.
     *
     * @since ??
     *
     * @param array $args
     */
    public static function module_script_data( $args ) {
        $id             = $args['id'] ?? '';
        $name           = $args['name'] ?? '';
        $selector       = $args['selector'] ?? '';
        $attrs          = $args['attrs'] ?? [];
        $store_instance = $args['storeInstance'] ?? null;

        $module_decoration_attrs = $attrs['module']['decoration'] ?? [];

        ElementScriptData::set(
            [
                'id'            => $id,
                'selector'      => $selector,
                'attrs'         => array_merge(
                    $module_decoration_attrs,
                    [
                        'link' => $args['attrs']['module']['advanced']['link'] ?? [],
                    ]
                ),
                'storeInstance' => $store_instance,
            ]
        );
    }
}