// External dependencies.
import React, { ReactElement } from 'react';

// Divi dependencies.
import { ModuleContainer } from '@divi/module';

// Local dependencies.
import { TableCellEditProps } from './types';
import { ModuleStyles } from './styles';
import { moduleClassnames } from './module-classnames';

/**
 * Table Cell module edit component for Visual Builder canvas.
 */
export const TableCellEdit = (props: TableCellEditProps): ReactElement => {
  const { attrs, elements, id, name, parentAttrs } = props;

  // 1. Tag selection ('td' or 'th')
  const tag = (attrs?.tagField?.innerContent?.desktop?.value || 'td') as 'td' | 'th';

  // 2. Extract configuration values from your schema attributes
  const textAlign = attrs?.textAlign?.innerContent?.desktop?.value;
  const width = attrs?.width?.innerContent?.desktop?.value;
  const customClass = attrs?.customCssClass?.innerContent?.desktop?.value;
  const rowspanVal = attrs?.rowspan?.innerContent?.desktop?.value;
  const colspanVal = attrs?.colspan?.innerContent?.desktop?.value;

  // 3. Compile inline styles for layout properties
  const style: React.CSSProperties = {
    ...(textAlign ? { textAlign: textAlign as React.CSSProperties['textAlign'] } : {}),
    ...(width ? { width } : {}),
  };

  // 4. Construct the native element attributes using Divi's official htmlAttrs prop
  const htmlAttrs: Record<string, any> = {};

  if (rowspanVal && rowspanVal !== '1') {
    htmlAttrs.rowSpan = Number(rowspanVal);
  }
  if (colspanVal && colspanVal !== '1') {
    htmlAttrs.colSpan = Number(colspanVal);
  }
  if (customClass) {
    htmlAttrs.className = customClass;
  }
  if (Object.keys(style).length > 0) {
    htmlAttrs.style = style;
  }

  return (
    <ModuleContainer
      attrs={attrs}
      parentAttrs={parentAttrs}
      elements={elements}
      id={id}
      name={name}
      stylesComponent={ModuleStyles}
      classnamesFunction={moduleClassnames}
      tag={tag}
      htmlAttrs={htmlAttrs}
    >
      {/* Dynamic inline styles container */}
      {elements.styleComponents({
        attrName: 'module',
      })}

      {/* Primary cell content element */}
      {elements.render({
        attrName: 'title',
      })}
    </ModuleContainer>
  );
};