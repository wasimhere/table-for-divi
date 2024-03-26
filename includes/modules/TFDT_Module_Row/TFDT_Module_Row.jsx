// External Dependencies
import React, { Component } from 'react';

// Internal Dependencies
import './style.css';

class TFDT_Module_Row extends Component {

  static slug = 'tfdt_module_row';

  /**
   * Module render in VB
   * Basically TFDT_Module_Row->render() equivalent in JSX
   */
  render() {

    return (
      
      <div className="table-row">
        
        {

          [...Array(20)].map((element, index) => {

            let textKey = 'text' + (index + 1);

            let col_value = this.props[textKey];

            if(typeof col_value !== "undefined"){

              return (

                <div className="table-col" key={textKey}>{col_value}</div>

              )

            }

          })

        }

      </div>

    );

  }
  
}

export default TFDT_Module_Row;
