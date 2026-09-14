// Divi dependencies.
import { type Metadata, type ModuleLibrary } from '@divi/types';

// Local dependencies.
import metadata from './module.json';
import { TableRowEdit } from './edit';
import { TableRowAttrs } from './types';

/**
 * Registration definition for Table Row module.
 */
export const tableRowModule: ModuleLibrary.Module.RegisterDefinition<TableRowAttrs> = {
  metadata: metadata as Metadata.Values<TableRowAttrs>,
  parentsName: ['tfdt/table-module'],
  childModulesName: ['tfdt/table-cell'],
  template: [
    ['tfdt/table-cell', {}],
    ['tfdt/table-cell', {}],
  ],
  renderers: { edit: TableRowEdit },
};