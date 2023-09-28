// External Dependencies
import React, { Component } from 'react';

// Internal Dependencies
import './style.css';


class WP_Divi_Table extends Component {

  static slug = 'wp_divi_table';

  render() {

    return (

      <div className="wp-divi-table-builder">

        <div className="module-desc">Output in the visual builder might be different from the actual output.<br />Please check the actual output on the frontend.</div>

        <div className="module-table">{this.props.content}</div>        

      </div>
      
    );
  
  }

}

export default WP_Divi_Table;