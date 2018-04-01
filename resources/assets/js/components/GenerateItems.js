import React, { Component } from 'react';

class GenerateItems extends Component {
    
    constructor(props) {
        super(props);
        this.state = {
          item: {
            question_type: '',
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
                <form id="generate_items" onSubmit={this.handleSubmit}>
                    <label htmlFor="question_type">Question Type: 
                      <select name="question_type"  
                        onChange={ (event) => this.handleInput('question_type', event) }>
                          <option value="multi">Multi-Select</option>
                          <option value="single">Single-Select</option>
                          <option value="tf">True/False</option>
                        </select>
                    </label><br />
                    <label htmlFor="NumberOfItems">Number: 
                        <input type="number"
                         onChange={ (event) => this.handleInput('num_items', event)} />
                    </label><br /> 
                </form>
                <button className="btn btn-primary" 
                  onClick={this.handleSubmit}>Create Items</button>
                <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
            </div>                
            )
      }

}

export default GenerateItems