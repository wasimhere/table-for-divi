// External dependencies.
import React, { ReactElement } from 'react';

// Divi dependencies.
import { StyleContainer, StylesProps, CssStyle } from '@divi/module';

// Local dependencies.
import { TableCellAttrs } from './types';
import { cssFields } from './custom-css';
import { TableAttrs } from '../table-module/types';

/**
 * Module styles component for Table Cell module.
 *
 * @param {StylesProps<TableCellAttrs, TableAttrs>} props Component props.
 * @returns {ReactElement} Style container tree.
 */
export const ModuleStyles = ({
  attrs,
  elements,
  orderClass,
  mode,
  state,
  noStyleTag,
}: StylesProps<TableCellAttrs, TableAttrs>): ReactElement => {
  return (
    <StyleContainer mode={mode} state={state} noStyleTag={noStyleTag}>
      {/* Renders standard module-level style rules */}
      {elements.style({
        attrName: 'module',
      })}

      {/* Renders custom CSS rules entered in Advanced settings */}
      <CssStyle
        selector={orderClass}
        attr={attrs.css}
        cssFields={cssFields}
      />
    </StyleContainer>
  );
};