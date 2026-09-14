// Divi dependencies.
import { ModuleEditProps } from '@divi/module-library';
import {
  FormatBreakpointStateAttr,
  InternalAttrs,
  type Element,
  type Module,
} from '@divi/types';

export type TableCssGroupAttr = FormatBreakpointStateAttr<Module.Css.AttributeValue>;

export interface TableAttrs extends InternalAttrs {
  // Base CSS options
  css?: TableCssGroupAttr;

  // Module
  module?: {
    meta?: Element.Meta.Attributes;
    advanced?: {
      link?: Element.Advanced.Link.Attributes;
      htmlAttributes?: Element.Advanced.IdClasses.Attributes;
      text?: Element.Advanced.Text.Attributes;
    };
    decoration?: Element.Decoration.PickedAttributes<
      | 'animation'
      | 'background'
      | 'border'
      | 'boxShadow'
      | 'disabledOn'
      | 'filters'
      | 'overflow'
      | 'position'
      | 'scroll'
      | 'sizing'
      | 'spacing'
      | 'sticky'
      | 'transform'
      | 'transition'
      | 'zIndex'
    >;
  };
}

export type TableEditProps = ModuleEditProps<TableAttrs>;