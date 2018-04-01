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
      let select_type = item.select_type;
      let num_items = item.num_items;
      console.log(select_type);

      fetch('api/generate_items', 
        {
          method: 'post',
          body: `select_type=${select_type}&num_items=${num_items}`,
          headers: {
             'Content-Type': 'application/x-www-form-urlencoded'
          } //,
          // body:JSON.stringify(
          //   { 'select_type': select_type, 
          //     'num_items': num_items
          //   })
        })
        .then( (response) => response.json() )
        .catch( (error) => console.log(error) )
    }

    render() {
        return(
            <div className="description">
              <p>
                Scrivener is your personal SOA file writer. Fill out the following form, and Scrivener
                will create the SOA files for you instantaneously.
              </p>
              <GenerateItems generate={this.handleGenerateItem} />
            </div>
            );
        }
}

export default Main;

if (document.getElementById('root')) {
    ReactDOM.render(<Main />, document.getElementById('root'));
   }
