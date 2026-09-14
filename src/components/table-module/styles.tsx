// External dependencies.
import React, { ReactElement } from 'react';

// Divi dependencies.
import {
  StyleContainer,
  StylesProps,
  CssStyle,
} from '@divi/module';

// Local dependencies.
import { TableAttrs } from './types';
import { cssFields } from './custom-css';

/**
 * Table Module (Parent) style components.
 */
export const ModuleStyles = ({
  attrs,
  elements,
  settings,
  orderClass,
  mode,
  state,
  noStyleTag,
}: StylesProps<TableAttrs>): ReactElement => {
  return (
    <StyleContainer mode={mode} state={state} noStyleTag={noStyleTag}>
      {/* Module Base Styles */}
      {elements.style({
        attrName: 'module',
        styleProps: {
          disabledOn: {
            disabledModuleVisibility: settings?.disabledModuleVisibility,
          },
        },
      })}

      {/* Main Module Custom CSS */}
      <CssStyle
        selector={orderClass}
        attr={attrs.css}
        cssFields={cssFields}
      />
    </StyleContainer>
  );
};