<?php
/**
 * TableCellModule::module_classnames().
 *
 * @package TFDT\Modules\TableCellModule
 * @since ??
 */

namespace TFDT\Modules\TableCellModule\TableCellModuleTrait;

if ( ! defined( 'ABSPATH' ) ) {
    die( 'Direct access forbidden.' );
}

use ET\Builder\Packages\Module\Options\Text\TextClassnames;

trait ModuleClassnamesTrait {

    /**
     * Module classnames function for Table Cell module.
     *
     * @since ??
     *
     * @param array $args
     */
    public static function module_classnames( $args ) {
        $classnames_instance = $args['classnamesInstance'];
        $attrs               = $args['attrs'];

        $text_options_classnames = TextClassnames::text_options_classnames( $attrs['module']['advanced']['text'] ?? [] );

        if ( $text_options_classnames ) {
            $classnames_instance->add( $text_options_classnames, true );
        }
    }

}