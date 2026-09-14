<?php
/**
 * TableRowModule::module_classnames().
 *
 * @package TFDT\Modules\TableRowModule
 * @since ??
 */

namespace TFDT\Modules\TableRowModule\TableRowModuleTrait;

if ( ! defined( 'ABSPATH' ) ) {
    die( 'Direct access forbidden.' );
}

use ET\Builder\Packages\Module\Options\Text\TextClassnames;

trait ModuleClassnamesTrait {

    /**
     * Module classnames function for Table Row module.
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