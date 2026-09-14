// Divi dependencies.
import { ModuleEditProps } from '@divi/module-library';
import {
  FormatBreakpointStateAttr,
  InternalAttrs,
  type Element,
  type Module,
} from '@divi/types';

// Parent module dependencies.
import { TableAttrs } from '../table-module/types';

/**
 * Custom CSS group attributes for Table Cell module.
 */
export type TableCellCssGroupAttr = FormatBreakpointStateAttr<Module.Css.AttributeValue>;

/**
 * Table Cell attribute interface.
 */
export interface TableCellAttrs extends InternalAttrs {
  css?: TableCellCssGroupAttr;
  module?: {
    meta?: Element.Meta.Attributes;
  };
  title?: Element.Types.Title.Attributes;
  tagField?: {
    innerContent?: FormatBreakpointStateAttr<string>;
  };
  textAlign?: {
    innerContent?: FormatBreakpointStateAttr<string>;
  };
  rowspan?: {
    innerContent?: FormatBreakpointStateAttr<string>;
  };
  colspan?: {
    innerContent?: FormatBreakpointStateAttr<string>;
  };
  width?: {
    innerContent?: FormatBreakpointStateAttr<string>;
  };
  customCssClass?: {
    innerContent?: FormatBreakpointStateAttr<string>;
  };
}

/**
 * Props for Table Cell edit component.
 */
export type TableCellEditProps = ModuleEditProps<TableCellAttrs, TableAttrs>;