import { addFilter } from '@wordpress/hooks';
import {
  tableModule,
} from './icons';

// Add module icons to the icon library.
addFilter('divi.iconLibrary.icon.map', 'tfdtTableModule', (icons) => {
  return {
    ...icons, // This is important. Without this, all other icons will be overwritten.
    [tableModule.name]:  tableModule,
  };
});