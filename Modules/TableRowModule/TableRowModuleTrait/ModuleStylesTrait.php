<?php
/**
 * TableRowModule::module_styles().
 *
 * @package TFDT\Modules\TableRowModule
 * @since ??
 */

namespace TFDT\Modules\TableRowModule\TableRowModuleTrait;

if ( ! defined( 'ABSPATH' ) ) {
    die( 'Direct access forbidden.' );
}

use ET\Builder\FrontEnd\Module\Style;
use ET\Builder\Packages\Module\Options\Css\CssStyle;

trait ModuleStylesTrait {

    use CustomCssTrait;

    /**
     * Table Row Module's style components.
     *
     * @param array $args
     * @since ??
     */
    public static function module_styles( $args ) {
        $attrs        = $args['attrs'] ?? [];
        $parent_attrs = $args['parentAttrs'] ?? [];
        $order_class  = $args['orderClass'];
        $elements     = $args['elements'];
        $settings     = $args['settings'] ?? [];

        Style::add(
            [
                'id'            => $args['id'],
                'name'          => $args['name'],
                'orderIndex'    => $args['orderIndex'],
                'storeInstance' => $args['storeInstance'],
                'styles'        => [
                    $elements->style(
                        [
                            'attrName'   => 'module',
                            'styleProps' => [
                                'disabledOn' => [
                                    'disabledModuleVisibility' => $settings['disabledModuleVisibility'] ?? null,
                                ],
                            ],
                        ]
                    ),
                    CssStyle::style(
                        [
                            'selector'  => $args['orderClass'],
                            'attr'      => $attrs['css'] ?? [],
                            'cssFields' => self::custom_css(),
                        ]
                    ),
                ],
            ]
        );
    }

}