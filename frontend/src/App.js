import React from 'react';
import { BrowserRouter as Router, Route, Routes } from 'react-router-dom';
import HomePage from './Components/HomePage/HomePage'; 
import './App.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';




function App() {
  return (
    <Router>
      <div className="App">
        <Routes>
          <Route path="/" element={<HomePage />} />
        
          <Route path="/login" element={<h2>Login Page</h2>} />
          <Route path="/register" element={<h2>Register Page</h2>} />
        </Routes>
      </div>
    </Router>
  );
}

export default App;
