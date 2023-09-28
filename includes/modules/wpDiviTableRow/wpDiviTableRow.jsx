// External Dependencies
import React, { Component } from 'react';

// Internal Dependencies
import './style.css';

class WP_Divi_Table_Row extends Component {

  static slug = 'wp_divi_table_row';

  /**
   * Module render in VB
   * Basically WP_Divi_Table_Row->render() equivalent in JSX
   */
  render() {

    return (
      
      <div className="table-row">
        
        {

          [...Array(20)].map((element, index) => {

            let textKey = 'text' + (index + 1);

            if(typeof this.props[textKey] !== "undefined"){

              return (

                <div className="table-col" key={textKey}>{this.props[textKey]}</div>

              )

            }

          })

        }

      </div>

    );

  }
  
}

export default WP_Divi_Table_Row;
