import React from 'react';
import 'bootstrap/dist/css/bootstrap.min.css';
import styles from './HomePageStyles';

const SearchBar = () => {
    return (
        <div 
            className="search-bar-container" 
            style={{
                display: 'flex', 
                justifyContent: 'center', 
                padding: '20px', 
            
                borderRadius: '8px', 
                backdropFilter: 'blur(5px)'
            }}
        >
            <form className="row g-3 justify-content-center" style={{ width: '100%', maxWidth: '800px' }}>
                <div className="col-md-4">
                    <input 
                        type="text" 
                        className="form-control form-control-lg" 
                        placeholder="Search here" 
                        style={{ height: '40px' }} 
                    />
                </div>
                <div className="col-md-3">
                    <select 
                        className="form-select form-select-lg" 
                        style={{ height: '40px' }}
                    >
                        <option defaultValue>Category</option>
                        <option value="1">Health</option>
                        <option value="2">Education</option>
                        <option value="3">Environment</option>
                    </select>
                </div>
                <div className="col-md-3">
                    <select 
                        className="form-select form-select-lg" 
                        style={{ height: '40px' }}
                    >
                        <option defaultValue>Location</option>
                        <option value="1">Colombo</option>
                        <option value="2">Kandy</option>
                        <option value="3">Galle</option>
                    </select>
                </div>
                <div className="col-md-2">
                    <button 
                        type="submit" 
                        className="btn btn-primary btn-lg" 
                        style={{ 
                            height: '40px', 
                            backgroundColor: '#28a745', 
                            borderColor: '#28a745' 
                        }}
                    >
                        Search
                    </button>
                </div>
            </form>
        </div>
    );
};

export default SearchBar;
