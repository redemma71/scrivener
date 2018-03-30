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
      console.log("number of items requested: ", item.numItems);
      console.log("type of items requested: ", item.selectionType);
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
