<?php
/**
 * TableModule::module_styles().
 *
 * @package TFDT\Modules\TableModule
 * @since ??
 */

namespace TFDT\Modules\TableModule\TableModuleTrait;

if ( ! defined( 'ABSPATH' ) ) {
    die( 'Direct access forbidden.' );
}

use ET\Builder\FrontEnd\Module\Style;
use ET\Builder\Packages\Module\Options\Css\CssStyle;

trait ModuleStylesTrait {

    use CustomCssTrait;

    /**
     * Table Module's style components.
     *
     * This function is equivalent of JS function ModuleStyles located in
     * src/components/table-module/styles.tsx.
     *
     * @param array $args {
     *     An array of arguments.
     *
     *     @type string $id Module ID. In VB, the ID of module is UUIDV4. In FE, the ID is order index.
     *     @type string $name Module name.
     *     @type string $attrs Module attributes.
     *     @type string $parentAttrs Parent attrs.
     *     @type string $orderClass Selector class name.
     *     @type string $parentOrderClass Parent selector class name.
     *     @type string $wrapperOrderClass Wrapper selector class name.
     *     @type string $settings Custom settings.
     *     @type string $state Attributes state.
     *     @type string $mode Style mode.
     *     @type ModuleElements $elements ModuleElements instance.
     * }
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
                    // Module element styles.
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

                    // Custom CSS.
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