// Divi dependencies.
import { placeholderContent as placeholder } from '@divi/module-utils';

// Local dependencies.
import { TableCellAttrs } from './types';

/**
 * Placeholder content defaults when inserting a new Table Cell module.
 */
export const placeholderContent: TableCellAttrs = {
  title: {
    innerContent: {
      desktop: {
        value: 'Table Cell', // Or dynamic default text
      },
    },
  },
  tagField: {
    innerContent: {
      desktop: {
        value: 'td',
      },
    },
  },
  textAlign: {
    innerContent: {
      desktop: {
        value: 'left',
      },
    },
  },
  rowspan: {
    innerContent: {
      desktop: {
        value: '1',
      },
    },
  },
  colspan: {
    innerContent: {
      desktop: {
        value: '1',
      },
    },
  },
};