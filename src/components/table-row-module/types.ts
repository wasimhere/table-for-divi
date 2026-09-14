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
 * Custom CSS group attributes for Table Row module.
 */
export type TableRowCssGroupAttr = FormatBreakpointStateAttr<Module.Css.AttributeValue>;

/**
 * Table Row attribute interface.
 */
export interface TableRowAttrs extends InternalAttrs {
  css?: TableRowCssGroupAttr;
  module?: {
    meta?: Element.Meta.Attributes;
  };
}

/**
 * Props for Table Row edit component.
 */
export type TableRowEditProps = ModuleEditProps<TableRowAttrs, TableAttrs>;