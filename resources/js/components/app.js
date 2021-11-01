import React, { Component } from 'react'
import ReactDOM from 'react-dom'
import { BrowserRouter, Route, Switch } from 'react-router-dom'
import Header from './Header'

const App = () => {
    return (
        <BrowserRouter>
            <div>
            </div>

            <Switch>
                <Route exact path="/">
                    <Header />
                </Route>
            </Switch>
        </BrowserRouter>
    )
}

ReactDOM.render(<App />, document.getElementById('root'))
