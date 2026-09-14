// Divi dependencies.
import { ModuleClassnamesParams } from '@divi/module';

// Local dependencies.
import { TableCellAttrs } from './types';

/**
 * Generates dynamic class names for the Table Cell module container.
 *
 * @param {ModuleClassnamesParams<TableCellAttrs>} params Parameters object containing classnames instance and attributes.
 */
export const moduleClassnames = ({
  classnamesInstance,
  attrs,
}: ModuleClassnamesParams<TableCellAttrs>): void => {
  // Append text align utility class if set
  const align = attrs?.textAlign?.innerContent?.desktop?.value;
  if (align) {
    classnamesInstance.add(`tfdt-text-align-${align}`);
  }

  // Append custom user CSS class
  const customClass = attrs?.customCssClass?.innerContent?.desktop?.value;
  if (customClass) {
    classnamesInstance.add(customClass);
  }
};