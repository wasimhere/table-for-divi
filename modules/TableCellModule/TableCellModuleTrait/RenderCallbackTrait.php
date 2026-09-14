<?php
/**
 * TableCellModule::render_callback()
 *
 * @package TFDT\Modules\TableCellModule
 * @since ??
 */

namespace TFDT\Modules\TableCellModule\TableCellModuleTrait;

if ( ! defined( 'ABSPATH' ) ) {
    die( 'Direct access forbidden.' );
}

// phpcs:disable ET.Sniffs.ValidVariableName.UsedPropertyNotSnakeCase -- WP use snakeCase in \WP_Block_Parser_Block

use ET\Builder\FrontEnd\BlockParser\BlockParserStore;
use ET\Builder\Packages\Module\Module;
use ET\Builder\Packages\ModuleUtils\ChildrenUtils;
use TFDT\Modules\TableCellModule\TableCellModule;

trait RenderCallbackTrait {
    use ModuleClassnamesTrait;
    use ModuleStylesTrait;
    use ModuleScriptDataTrait;

    /**
     * Table cell module render callback which outputs server side rendered HTML on the Front-End.
     *
     * @since ??
     *
     * @param array             $attrs                        Block attributes that were saved by VB.
     * @param string            $content                      Rendered inner blocks HTML.
     * @param \WP_Block         $block                        Parsed block object that being rendered.
     * @param \ET\Builder\Packages\Module\Layout\Components\ModuleElements\ModuleElements $elements ModuleElements instance.
     * @param array             $_default_printed_style_attrs Optional. Passed by ModuleRegistration; unused here.
     *
     * @return string HTML rendered of Table Cell module.
     */
    public static function render_callback( $attrs, $content, $block, $elements, $_default_printed_style_attrs = [] ) {
        // Extract child module IDs from the block's innerBlocks.
        $children_ids = ChildrenUtils::extract_children_ids( $block );

        $parent       = BlockParserStore::get_parent( $block->parsed_block['id'], $block->parsed_block['storeInstance'] );
        $parent_attrs = $parent->attrs ?? [];

        // 1. Map values directly to your JSON attribute schema keys.
        $cell_type    = $attrs['tagField']['innerContent']['desktop']['value'] ?? 'td';
        $colspan      = $attrs['colspan']['innerContent']['desktop']['value'] ?? '1';
        $rowspan      = $attrs['rowspan']['innerContent']['desktop']['value'] ?? '1';
        $width        = $attrs['width']['innerContent']['desktop']['value'] ?? '';
        $text_align   = $attrs['textAlign']['innerContent']['desktop']['value'] ?? '';
        $custom_class = $attrs['customCssClass']['innerContent']['desktop']['value'] ?? '';

        // Determine whether tag should be 'td' or 'th'
        $tag = 'th' === $cell_type ? 'th' : 'td';

        // 2. Build htmlAttrs array for colspan, rowspan, custom CSS classes, and inline styles (width, textAlign).
        $html_attrs = [];
        if ( ! empty( $colspan ) && intval( $colspan ) > 1 ) {
            $html_attrs['colspan'] = esc_attr( $colspan );
        }
        if ( ! empty( $rowspan ) && intval( $rowspan ) > 1 ) {
            $html_attrs['rowspan'] = esc_attr( $rowspan );
        }
        if ( ! empty( $custom_class ) ) {
            $html_attrs['class'] = esc_attr( $custom_class );
        }

        // Compile inline styles for width and alignment
        $style_styles = [];
        if ( ! empty( $width ) ) {
            $style_styles[] = 'width: ' . esc_attr( $width );
        }
        if ( ! empty( $text_align ) ) {
            $style_styles[] = 'text-align: ' . esc_attr( $text_align );
        }
        if ( ! empty( $style_styles ) ) {
            $html_attrs['style'] = implode( '; ', $style_styles ) . ';';
        }

        return Module::render(
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
                'classnamesFunction'  => [ TableCellModule::class, 'module_classnames' ],
                'scriptDataComponent' => [ TableCellModule::class, 'module_script_data' ],
                'stylesComponent'     => [ TableCellModule::class, 'module_styles' ],
                'parentAttrs'         => $parent_attrs,
                'parentId'            => $parent->id ?? '',
                'parentName'          => $parent->blockName ?? '',
                
                // Dynamic tag and attributes injection
                'tag'                 => $tag,
                'htmlAttrs'           => $html_attrs,

                // Render style components + cell text content ('title' attribute) + any inner content
                'children'            => $elements->style_components(
                    [
                        'attrName' => 'module',
                    ]
                ) . $elements->render(
                    [
                        'attrName' => 'title',
                    ]
                ) . $content,
                'childrenIds'         => $children_ids,
            ]
        );
    }
}