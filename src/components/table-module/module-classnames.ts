// Divi dependencies.
import { ModuleClassnamesParams, textOptionsClassnames } from '@divi/module';

// Local dependencies.
import { TableAttrs } from './types';

/**
 * Module classnames function for Table Module (Parent).
 *
 * @param {ModuleClassnamesParams<TableAttrs>} param0 Function parameters.
 */
export const moduleClassnames = ({
  classnamesInstance,
  attrs,
}: ModuleClassnamesParams<TableAttrs>): void => {
  // Text Options.
  classnamesInstance.add(textOptionsClassnames(attrs?.module?.advanced?.text ?? {}));
};