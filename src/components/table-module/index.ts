// Divi dependencies.
import { elementsCallbacks } from '@divi/module-utils';
import {
  type Metadata,
  type ModuleLibrary,
} from '@divi/types';

// Local dependencies.
import metadata from './module.json';
import { TableEdit } from './edit';
import { TableAttrs } from './types';

// Styles.
import './module.scss';

/**
 * Table Module (Parent Module).
 */
export const tableModule: ModuleLibrary.Module.RegisterDefinition<TableAttrs> = {
  metadata: metadata as Metadata.Values<TableAttrs>,
  childModulesName: ['tfdt/table-row'],
  template: [
    ['tfdt/table-row', {}],
    ['tfdt/table-row', {}],
  ],
  renderers: { edit: TableEdit },
  callbacks: { content: { elements: elementsCallbacks } },
};