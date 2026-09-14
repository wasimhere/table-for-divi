import { omit } from 'lodash';
import { addAction } from '@wordpress/hooks';
import { registerModule } from '@divi/module-library';

import { tableModule } from './components/table-module';
import { tableRowModule } from './components/table-row-module';
import { tableCellModule } from './components/table-cell-module';

import './module-icons';

// Register modules into Divi 5 Visual Builder store.
addAction('divi.moduleLibrary.registerModuleLibraryStore.after', 'tfdtTableModules', () => {
  // 1. Register Parent (Table)
  registerModule(tableModule.metadata, omit(tableModule, 'metadata'));

  // 2. Register Middleware Child (Table Row)
  registerModule(tableRowModule.metadata, omit(tableRowModule, 'metadata'));

  // 3. Register Grandchild (Table Cell)
  registerModule(tableCellModule.metadata, omit(tableCellModule, 'metadata'));
});