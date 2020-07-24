import React from 'react';
import { BrowserRouter as Router } from 'react-router-dom';
import Nav from '@Components/Nav';
import Routes from '@Components/Routes';

import './App.scss';

const App = () => (
    <Router>
        <Nav/>
        <div className="container">
            <Routes />
        </div>
    </Router>
);

export default App;