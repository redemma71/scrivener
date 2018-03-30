import React, { Component } from 'react';
import ReactDOM from "react-dom";
import logo from '../../../../public/images/scrivener.jpg';

console.log(logo);

class Logo extends Component {
    render() {
        return <div>
            <h2 className="text-primary" id="header-scrivener">
              Welcome to Scrivener
            </h2>
            <img src={logo} alt="Logo" />
          </div>;
    }
}

export default Logo;

if (document.getElementById("logo")) {
  ReactDOM.render(<Logo />, document.getElementById("logo"));
}