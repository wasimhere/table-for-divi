// External dependencies.
import React, { ReactElement } from 'react';
import { set } from 'lodash';

// Divi dependencies.
import { ModuleGroups } from '@divi/module';
import { mergeAttrs } from '@divi/module-utils';
import { type Module } from '@divi/types';

// Local dependencies.
import { TableRowAttrs } from './types';
import { TableAttrs } from '../table-module/types';

/**
 * Settings design component for Table Row Module (Child).
 *
 * @param {Module.Settings.Panel.Props<TableRowAttrs, TableAttrs>} props Component props.
 * @returns {ReactElement} Settings design panel tree.
 */
export const SettingsDesign = ({
  defaultSettingsAttrs,
  parentAttrs,
  groupConfiguration,
}: Module.Settings.Panel.Props<TableRowAttrs, TableAttrs>): ReactElement => {

  // Inherit text default attribute value from Parent Module if defined.
  if (groupConfiguration?.['module-text']?.component?.props) {
    const defaultTextAttrs = mergeAttrs({
      defaultAttrs: defaultSettingsAttrs?.module?.advanced?.asMutable?.({ deep: true })?.text,
      attrs: parentAttrs?.module?.advanced?.asMutable?.({ deep: true })?.text,
    });

    set(groupConfiguration, ['module-text', 'component', 'props', 'defaultGroupAttr'], defaultTextAttrs);
  }

  return (
    <ModuleGroups
      groups={groupConfiguration}
    />
  );
};