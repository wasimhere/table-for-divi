// External Dependencies
import React, { Component } from 'react';

// Internal Dependencies
import './style.css';


class TFDT_Module extends Component {

  static slug = 'tfdt_module';

  render() {

    return (

      <div className="table-for-divi-builder">

        <div className="module-desc">Output in the visual builder might be different from the actual output.<br />Please check the actual output on the frontend.</div>

        <div className="module-table">{this.props.content}</div>     

      </div>
      
    );
  
  }

}

export default TFDT_Module;