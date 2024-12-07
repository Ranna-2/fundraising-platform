// SearchBar.js
import React from 'react';
import 'bootstrap/dist/css/bootstrap.min.css'; // Ensure Bootstrap is imported
import styles from './HomePageStyles';

const SearchBar = () => {
    return (
        <div className="search-bar-container" style={{display:'flex', justifyContent: 'center', padding:'20px',backgroundColor:'rgba(249, 249, 249, 0.8)', borderRadius:'8px', backdropFilter: 'blur(5px)'}}>
            <form className="row g-2 justify-content-center" >
                <div className="col-md-4">
                    <input type="text" className="form-control" placeholder="Search here" />
                </div>
                <div className="col-md-3">
                    <select className="form-select form-select-lg">
                        <option selected>Category</option>
                        <option value="1">Health</option>
                        <option value="2">Education</option>
                        <option value="3">Environment</option>
                    </select>
                </div>
                <div className="col-md-3">
                    <select className="form-select form-select-lg">
                        <option selected>Location</option>
                        <option value="1">Colombo</option>
                        <option value="2">Kandy</option>
                        <option value="3">Galle</option>
                    </select>
                </div>
                <div className="col-md-2">
                    <button type="submit" className="btn" style={styles.ctaButton}>Search</button>
                </div>
            </form>
        </div>
    );
};

export default SearchBar;