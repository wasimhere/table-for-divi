// External dependencies.
import React, { ReactElement } from 'react';

// Divi dependencies.
import { ModuleGroups } from '@divi/module';
import { type Module } from '@divi/types';

// Local dependencies.
import { TableRowAttrs } from './types';
import { TableAttrs } from '../table-module/types';

/**
 * Settings content component for Table Row Module (Child).
 *
 * @param {Module.Settings.Panel.Props<TableRowAttrs, TableAttrs>} props Component props.
 * @returns {ReactElement} Settings content panel.
 */
export const SettingsContent = ({
  groupConfiguration,
}: Module.Settings.Panel.Props<TableRowAttrs, TableAttrs>): ReactElement => {
  return (
    <ModuleGroups
      groups={groupConfiguration}
    />
  );
};