<?php
/**
 * TableModule::custom_css().
 *
 * @package TFDT\Modules\TableModule
 * @since ??
 */

namespace TFDT\Modules\TableModule\TableModuleTrait;

if ( ! defined( 'ABSPATH' ) ) {
    die( 'Direct access forbidden.' );
}

trait CustomCssTrait {

    /**
     * Custom CSS fields
     *
     * This function is equivalent of JS const cssFields located in
     * src/components/table-module/custom-css.ts.
     *
     * A minor difference with the JS const cssFields, this function did not have `label` property on each array item.
     *
     * @since ??
     */
    public static function custom_css() {
        $block_type = \WP_Block_Type_Registry::get_instance()->get_registered( 'tfdt/table-module' );
        return $block_type ? $block_type->customCssFields : [];
    }

}