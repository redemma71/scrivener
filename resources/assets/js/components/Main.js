import React, { Component } from 'react';
import ReactDOM from 'react-dom';

class Main extends Component {
    render() {
        return(
            <div class="description">
              <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing
                elit. Totam perferendis ut, aspernatur dolores molestiae
                dignissimos asperiores, nobis quaerat impedit at dolor
                eius reiciendis suscipit! Esse excepturi quas corrupti
                eos dolorem.
              </p>
              <p>
                Minima, nam, modi? Mollitia, aliquam. At pariatur
                doloribus velit ab distinctio, assumenda vel
                architecto quisquam nesciunt, officia ut sed magnam
                odit saepe in maiores dolorem praesentium
                necessitatibus veniam sequi. Maxime.
              </p>
              <input class="btn btn-primary" type="submit" value="Get Started" />
            </div>
            )
        }
}

export default Main;

if (document.getElementById('root')) {
    ReactDOM.render(<Main />, document.getElementById('root'));
}
