import React, { Component } from 'react';

class GenerateItems extends Component {
    
    constructor(props) {
        super(props);
        this.state = {
          item: {
            select_type: '',
            num_items: ''
          }
        };
  
        this.handleInput = this.handleInput.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
      }

      handleInput(key, event) {
        var state = Object.assign({}, this.state.item);
        state[key] = event.target.value;
        this.setState({
          item: state}
        );
      }
  
      handleSubmit(event) {
        event.preventDefault();
        this.props.generate(this.state.item);
      }
  
      render() {
            return(
                <div>
                <form onSubmit={this.handleSubmit}>
                    <label htmlFor="MultipleChoice">Multiple-Choice: 
                        <input type="text"  
                        onChange={ (event) => this.handleInput('select_type', event) } />
                    </label><br />
                    <label htmlFor="NumberOfItems">Number: 
                        <input type="text"
                         onChange={ (event) => this.handleInput('num_items', event)} />
                    </label><br /> 
                </form>
                <button onClick={this.handleSubmit}>Create Items</button>
                <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
            </div>                
            )
      }

}

export default GenerateItems