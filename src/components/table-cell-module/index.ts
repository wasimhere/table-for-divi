// Divi dependencies.
import {
  type Metadata,
  type ModuleLibrary,
} from '@divi/types';

// Local dependencies.
import metadata from './module.json';
import { TableCellEdit } from './edit';
import { SettingsContent } from './settings-content';
import { SettingsDesign } from './settings-design';
import { TableCellAttrs } from './types';
import { placeholderContent } from './placeholder-content';

// Styles.
import './module.scss';

/**
 * Table Cell module registration object.
 */
export const tableCellModule: ModuleLibrary.Module.RegisterDefinition<TableCellAttrs> = {
  metadata: metadata as Metadata.Values<TableCellAttrs>,
  placeholderContent,
  settings: {
    content: SettingsContent,
    design: SettingsDesign,
  },
  renderers: {
    edit: TableCellEdit,
  },
  parentsName: ['tfdt/table-row'],
};