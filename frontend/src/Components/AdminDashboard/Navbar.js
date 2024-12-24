import React from "react";
import { Link, useNavigate } from "react-router-dom";
import "./AdminDashboard.css";

const Navbar = () => {
    const navigate = useNavigate();

    const handleLogout = () => {
        // Clear session or tokens here
        console.log("User logged out");
        // Navigate to Homepage
        navigate("/");
    };

    return (
        <nav className="navbar">
            <div className="navbar-container">
                <h1 className="logo">KindledHope</h1>
                <ul className="navbar-links">
                    <li><Link to="/admin">Dashboard</Link></li>
                    <li><Link to="/campaigns">Campaigns</Link></li>
                    <li><Link to="/users">Users</Link></li>
                    <li><Link to="/settings">Settings</Link></li>
                    <li>
                        <button className="logout-button" onClick={handleLogout}>
                            Logout
                        </button>
                    </li>
                </ul>
            </div>
        </nav>
    );
};

export default Navbar;

