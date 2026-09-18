<?php
/**
 * TableModule::render_callback()
 *
 * @package TFDT\Modules\TableModule
 * @since ??
 */

namespace TFDT\Modules\TableModule\TableModuleTrait;

if ( ! defined( 'ABSPATH' ) ) {
    die( 'Direct access forbidden.' );
}

// phpcs:disable ET.Sniffs.ValidVariableName.UsedPropertyNotSnakeCase -- WP use snakeCase in \WP_Block_Parser_Block

use ET\Builder\FrontEnd\BlockParser\BlockParserStore;
use ET\Builder\Packages\Module\Module;
use ET\Builder\Packages\ModuleUtils\ChildrenUtils;
use TFDT\Modules\TableModule\TableModule;

trait RenderCallbackTrait {
    use ModuleClassnamesTrait;
    use ModuleStylesTrait;
    use ModuleScriptDataTrait;

    /**
     * Table module render callback which outputs server side rendered HTML on the Front-End.
     *
     * @since ??
     *
     * @param array                     $attrs              Block attributes that were saved by VB.
     * @param string                    $content            Rendered inner blocks HTML.
     * @param \WP_Block                 $block              Parsed block object that being rendered.
     * @param \ET\Builder\Packages\Module\Layout\Components\ModuleElements\ModuleElements $elements ModuleElements instance.
     * @param array                     $_default_printed_style_attrs Optional. Passed by ModuleRegistration; unused here.
     *
     * @return string HTML rendered of Table module.
     */
    public static function render_callback( $attrs, $content, $block, $elements, $_default_printed_style_attrs = [] ) {
        // Extract child module IDs from the block's innerBlocks.
        $children_ids = ChildrenUtils::extract_children_ids( $block );

        $parent       = BlockParserStore::get_parent( $block->parsed_block['id'], $block->parsed_block['storeInstance'] );
        $parent_attrs = $parent->attrs ?? [];

        // Fetch theme option (defaults to 'default' if empty)
        $table_theme = $attrs['tableTheme']['innerContent']['desktop']['value'] ?? 'default';

        $html_attrs = [];
        // Apply class for default, bordered, striped, and dark. Skip only if 'no-style'.
        if ( 'no-style' !== $table_theme ) {
            $html_attrs['class'] = 'tfdt-theme-' . esc_attr( $table_theme );
        }

        // 3. Render the module using 'table' as the tag so module classes apply directly to it.
        $rendered_table = Module::render(
            [
                // FE only.
                'orderIndex'          => $block->parsed_block['orderIndex'],
                'storeInstance'       => $block->parsed_block['storeInstance'],

                // VB equivalent.
                'id'                  => $block->parsed_block['id'],
                'name'                => $block->block_type->name,
                'moduleCategory'      => $block->block_type->category,
                'attrs'               => $attrs,
                'elements'            => $elements,
                'classnamesFunction'  => [ TableModule::class, 'module_classnames' ],
                'scriptDataComponent' => [ TableModule::class, 'module_script_data' ],
                'stylesComponent'     => [ TableModule::class, 'module_styles' ],
                'parentAttrs'         => $parent_attrs,
                'parentId'            => $parent->id ?? '',
                'parentName'          => $parent->blockName ?? '',
                
                // Keep tag as table so module classes and style components bind to the <table> element.
                'tag'                 => 'table',
                'htmlAttrs'           => $html_attrs,

                'children'            => $elements->style_components(
                    [
                        'attrName' => 'module',
                    ]
                ) . '<tbody>' . $content . '</tbody>',
                'childrenIds'         => $children_ids,
            ]
        );

        // 4. Wrap the rendered table module inside a div with your target class.
        return sprintf( '<div class="tfdt_module"><div class="table-for-divi">%s</div></div>', $rendered_table );
    }
}