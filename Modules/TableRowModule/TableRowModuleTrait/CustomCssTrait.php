<?php
/**
 * TableRowModule::custom_css().
 *
 * @package TFDT\Modules\TableRowModule
 * @since ??
 */

namespace TFDT\Modules\TableRowModule\TableRowModuleTrait;

if ( ! defined( 'ABSPATH' ) ) {
    die( 'Direct access forbidden.' );
}

trait CustomCssTrait {

    /**
     * Custom CSS fields for Table Row module.
     *
     * @since ??
     */
    public static function custom_css() {
        $block_type = \WP_Block_Type_Registry::get_instance()->get_registered( 'tfdt/table-row' );
        return $block_type ? $block_type->customCssFields : [];
    }

}