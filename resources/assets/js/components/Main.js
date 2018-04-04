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
      
      let generate_items_form = new FormData();
      generate_items_form.append('question_type',item.question_type);
      generate_items_form.append('num_items',item.num_items);

      if (item.question_type == 'tf') {
        fetch('api/generate_tfs',
        {
          method: 'POST',
          body: generate_items_form,
        })
      .then( (response) => console.log(response) )
      .catch( (error) => console.log(error) )

      } else {
        fetch('api/generate_items', 
        {
          method: 'POST',
          body: generate_items_form,
        })
        .then( (response) => console.log(response) )
        .catch( (error) => console.log(error) )
      }

      
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
