import React from 'react';
import './NavBarStyles.css'; // Import the CSS file
import { Link } from 'react-router-dom';

const NavBar = () => {
  return (
    <nav className="navbar navbar-expand-lg navbar-light bg-light">
      <div className="container">
        <Link className="navbar-brand" to="/">
          <img 
            src="/images/logo.png" 
            alt="KindledHope.lk" 
            style={{ height: "40px" }} 
          />

        </Link>
        <button
          className="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span className="navbar-toggler-icon"></span>
        </button>
        <div className="collapse navbar-collapse" id="navbarNav">
          <ul className="navbar-nav ms-auto align-items-center">
            <li className="nav-item">
              <Link className="nav-link" to="/">Home</Link>
            </li>
            <li className="nav-item">
              <a className="nav-link" href="/Campaign/index.html">Campaigns</a>
            </li>
            <li className="nav-item dropdown">
              <a
                className="nav-link dropdown-toggle"
                href="#"
                id="languageDropdown"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                English
              </a>
              <ul className="dropdown-menu" aria-labelledby="languageDropdown">
                <li><a className="dropdown-item" href="#">Sinhala</a></li>
                <li><a className="dropdown-item" href="#">Tamil</a></li>
              </ul>
            </li>
            <li className="nav-item dropdown">
              <a
                className="nav-link dropdown-toggle"
                href="#"
                id="moreDropdown"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                More
              </a>
              <ul className="dropdown-menu" aria-labelledby="moreDropdown">
                <li><a className="dropdown-item" href="#">About Us</a></li>
                <li><a className="dropdown-item" href="#">How it Works</a></li>
                <li><a className="dropdown-item" href="#">Complaints</a></li>
              </ul>
            </li>
            <li className="nav-item">
              <a className="nav-link btn btn-custom-primary text-white" href="/Login/login.html">Donate</a>
            </li>
            <li className="nav-item">
              <a className="nav-link btn btn-outline-custom-primary" href="/Signup/Register.html">Fundraise</a>
            </li>
            <li className="nav-item">
              <Link className="nav-link" to="/admin">Admin</Link>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  );
};

export default NavBar;

