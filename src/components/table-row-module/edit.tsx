// External Dependencies.
import React, { ReactElement } from 'react';

// Divi Dependencies.
import { ChildModulesContainer, ModuleContainer } from '@divi/module';

// Local Dependencies.
import { TableRowEditProps } from './types';
import { ModuleStyles } from './styles';
import { moduleClassnames } from './module-classnames';

/**
 * Table Row Module edit component.
 */
export const TableRowEdit = (props: TableRowEditProps): ReactElement => {
  const {
    attrs,
    elements,
    id,
    name,
    parentAttrs,
    childrenIds,
  } = props;

  // Fallback: If a row has no cells yet (e.g., spawned via parent template), 
  // Divi will render the container. 
  const hasChildren = childrenIds && childrenIds.length > 0;

  return (
    <ModuleContainer
      attrs={attrs}
      parentAttrs={parentAttrs}
      elements={elements}
      id={id}
      name={name}
      childrenIds={childrenIds}
      stylesComponent={ModuleStyles}
      classnamesFunction={moduleClassnames}
      tag="tr"
    >
      {elements.styleComponents({
        attrName: 'module',
      })}

      {hasChildren ? (
        <ChildModulesContainer ids={childrenIds} />
      ) : (
        // Fallback placeholder UI inside the row canvas if cells haven't spawned yet
        <td className="tfdt-empty-row-placeholder" colSpan={100} style={{ padding: '10px', color: '#999', textAlign: 'center' }}>
          Click the + icon inside this row to add Table Cells
        </td>
      )}
    </ModuleContainer>
  );
};