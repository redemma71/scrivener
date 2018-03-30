import React, { Component } from 'react';

class GenerateItems extends Component {
    
    constructor(props) {
        super(props);
        this.state = {
          item: {
            selectionType: '',
            numItems: ''
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
        this.props.onGenerate(this.state.item);
      }
  
      render() {
            return(
                <div>
                <form onSubmit={this.handleSubmit}>
                    <label htmlFor="MultipleChoice">Multiple-Choice: 
                        <input type="text"  
                        onChange={ (event) => this.handleInput('selectionType', event) } />
                    </label><br />
                    <label htmlFor="NumberOfItems">Number: 
                        <input type="text"
                         onChange={ (event) => this.handleInput('numItems', event)} />
                    </label><br /> 
                </form>
                <button onClick={this.handleSubmit}>Create Items</button>
            </div>                
            )
      }

}

export default GenerateItems