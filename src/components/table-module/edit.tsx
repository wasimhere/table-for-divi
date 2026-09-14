// External Dependencies.
import React, { ReactElement } from 'react';

// Divi Dependencies.
import { ChildModulesContainer, ModuleContainer } from '@divi/module';

// Local Dependencies.
import { TableEditProps } from './types';
import { ModuleStyles } from './styles';
import { moduleClassnames } from './module-classnames';

/**
 * Table Module edit component.
 */
export const TableEdit = (props: TableEditProps): ReactElement => {
  const {
    attrs,
    elements,
    id,
    name,
    parentAttrs,
    childrenIds,
  } = props;

  // 1. Fetch the selected theme value from your module attributes schema
  const tableTheme = attrs?.tableTheme?.innerContent?.desktop?.value || 'default';

  // 2. Build htmlAttrs to apply the theme class unless 'no-style' is chosen
  const htmlAttrs: Record<string, any> = {};
  if (tableTheme !== 'no-style') {
    htmlAttrs.className = `tfdt-theme-${tableTheme}`;
  }

  return (
    <div className="tfdt-table-card-wrapper">
      <div className="tfdt-builder-notice">
        Output in the visual builder might be different from the actual output.<br />
        Please check the actual output on the frontend.
      </div>
      
      <div className="tfdt_module">
        <div className="table-for-divi">
          <ModuleContainer
            attrs={attrs}
            parentAttrs={parentAttrs}
            elements={elements}
            id={id}
            name={name}
            childrenIds={childrenIds}
            stylesComponent={ModuleStyles}
            classnamesFunction={moduleClassnames}
            tag="table"
            htmlAttrs={htmlAttrs}
          >
            {elements.styleComponents({
              attrName: 'module',
            })}
            <tbody>
              {childrenIds && childrenIds.length > 0 && (
                <ChildModulesContainer ids={childrenIds} />
              )}
            </tbody>
          </ModuleContainer>
        </div>
      </div>
    </div>
  );
};