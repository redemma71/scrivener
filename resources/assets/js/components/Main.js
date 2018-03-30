import React, { Component } from 'react';
import ReactDOM from 'react-dom';

class Main extends Component {
    constructor(props) {
      super(props);
      this.state = {
        items: {
          selectionType: '',
          numItems: ''
        }
      };
      this.handleInput = this.handleInput.bind(this);
      this.handleSubmit = this.handleSubmit.bind(this);
    }

    handleInput(key, event) {
      var state = Object.assign({}, this.state.items);
      state[key] = event.target.value;
      this.setState({
        items: state}
      );
    }

    handleSubmit(event) {
      event.preventDefault();
      this.props.onAdd(this.state.items);
    }

    render() {
        return(
            <div className="description">
              <p>
                Scrivener is your personal SOA file writer. Fill out the following form, and Scrivener
                will create the SOA files for you instantaneously.
              </p>
              <form onSubmit={this.handleSubmit}>
                  <label htmlFor="MultipleChoice">MultipleChoice: <input type="text" value={this.state.value} onChange={this.handleChange} /></label><br />
                  <label htmlFor="MultipleChoice">Number: <input type="text" value={this.state.value} onChange={this.handleChange} /></label><br />
                  <input type="submit" value="Submit"/> 
              </form>
            </div>
            );
        }
}

export default Main;

if (document.getElementById('root')) {
    ReactDOM.render(<Main />, document.getElementById('root'));
   }
