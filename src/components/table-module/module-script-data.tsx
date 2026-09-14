import React, {
  Fragment,
  ReactElement,
} from 'react';

// Divi dependencies.
import { ModuleScriptDataProps } from '@divi/module';

// Local dependencies.
import { TableAttrs } from './types';

/**
 * Table Module (Parent) script data component.
 *
 * @param {ModuleScriptDataProps<TableAttrs>} props React component props.
 * @returns {ReactElement} Script data component tree.
 */
export const ModuleScriptData = ({
  elements,
}: ModuleScriptDataProps<TableAttrs>): ReactElement => (
  <Fragment>
    {elements.scriptData({
      attrName: 'module',
    })}
  </Fragment>
);