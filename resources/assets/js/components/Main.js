import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import GenerateItems from './GenerateItems';

class Main extends Component {

    constructor() {
      super();
      this.state = {
        items: []
      };
      this.handleGenerateItem = this.handleGenerateItem.bind(this);
    }

    handleGenerateItem(item) {
      fetch( 'api/multi-select/', 
        {
          headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(item)
        }
      )
      .then(response => 
        { return response.json(); }
      )
      .then( (data) => 
        {
        console.log("number of items requested: ", data.numItems);
        console.log("type of items requested: ", data.selectionType);
        }
      );
    }

    render() {
        return(
            <div className="description">
              <p>
                Scrivener is your personal SOA file writer. Fill out the following form, and Scrivener
                will create the SOA files for you instantaneously.
              </p>
              <GenerateItems onGenerate={this.handleGenerateItem} />
            </div>
            );
        }
}

export default Main;

if (document.getElementById('root')) {
    ReactDOM.render(<Main />, document.getElementById('root'));
   }
