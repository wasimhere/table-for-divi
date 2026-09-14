<?php
/**
 * TableCellModule::custom_css().
 *
 * @package TFDT\Modules\TableCellModule
 * @since ??
 */

namespace TFDT\Modules\TableCellModule\TableCellModuleTrait;

if ( ! defined( 'ABSPATH' ) ) {
    die( 'Direct access forbidden.' );
}

trait CustomCssTrait {

    /**
     * Custom CSS fields for Table Cell module.
     *
     * @since ??
     */
    public static function custom_css() {
        $block_type = \WP_Block_Type_Registry::get_instance()->get_registered( 'tfdt/table-cell' );
        return $block_type ? $block_type->customCssFields : [];
    }

}